<?php

namespace App\Notification\Infrastructure\Domain\EmailTemplate;

use App\DataFeed\Domain\Brand\BrandRepositoryInterface;
use App\DataFeed\Domain\Category\CategoryRepositoryInterface;
use App\DataFeed\Domain\Mktp\MktpRepositoryInterface;
use App\Iprice\Domain\Model\Country;
use App\Iprice\Domain\Model\Offer;
use App\Iprice\Domain\Model\OfferStatus;
use App\Iprice\Domain\Model\Platform;
use App\Iprice\Infrastructure\Domain\Adapter\ErrorCodeAdapter;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\Basic;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\InactivationDataFactory;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\PromoValidationLow;
use JMS\Serializer\ArrayTransformerInterface;
use Twig\Environment;
use Twig\Loader\LoaderInterface;

class InactivationEmail implements EmailTemplateInterface
{
    const EMAIL_FROM = 'pricecheck.team@emag.ro';
    const PRODUCT_PLATFORM_URL = 'https://www.emag.%s/a/pd/{partNumberKey}';
    const CHARACTERISTICS_VALUE_PRECISION = 2;
    const RULE_STATUS_LABEL = '[Product Warning]';
    const PART_NUMBER_KEY = '{partNumberKey}';
    const MAIL_TO_RO = 'pricecheck.marketplace@emag.ro';
    const MAIL_TO_BG = 'seller.performance@emag.bg';
    const MAIL_TO_HU = 'marketplace.support@emag.hu';
    const PRICE_LIMIT_PERCENT = 'priceLimitPercent';
    const PRICE_LIMIT_VALUE = 'priceLimitValue';

    private LoaderInterface $templating;
    private string $subject = '';
    private array $options = [];
    private int $errorCode;

    public function __construct(
        private int $defaultCountryId, 
        private string $defaultCountryCode,
        private BrandRepositoryInterface $brandRepository,
        private MktpRepositoryInterface $mktpRepository,
        private CategoryRepositoryInterface $categoryRepository,
        private ArrayTransformerInterface $serializer,
        private InactivationDataFactory $inactivationDataFactory,
        Environment $twig,
    ) {
        $this->templating = $twig->getLoader();
    }

    public function __invoke(Offer $offer): InactivationEmail
    {
        $vendor = $this->mktpRepository->getVendorNameById($offer->getVendorId());
        $brands = $this->brandRepository->getBrandByIds([$offer->getBrandId()]);
        $this->errorCode = ErrorCodeAdapter::getErrorCodeFromMessage($offer->getOfferStatus()->getInactivationReason());
        $this->buildSubject($offer, $vendor);

        $this->options = [
            'object' => $this->serializer->toArray($offer),
            'productUrl' => $this->generateProductUrl($offer),
            'vendor' => $vendor,
            'category' => [
                'name' => $this->categoryRepository->getCategoryTreeForRoot($offer->getCategoryId())['results'][0]['title'],
                'id' => $offer->getCategoryId()
            ],
            'manufacturer' => [
                'name' => $brands[0]['brand_name'],
                'id' => $brands[0]['id']
            ],
            'characteristics' => $this->buildCharacteristics($offer),
            'currency' => Country::countryIdToCurrencyCode($this->defaultCountryId),
            'availability' => Offer::AVAILABILITIES[$offer->getAvailabilityId()],
            'ruleStatusLabel' => self::RULE_STATUS_LABEL,
            'platformName' => Platform::getPlatformNameByCountry($this->defaultCountryId),
            'isResealed' => $offer->isResealed(),
        ];

        return $this;
    }

    private function generateProductUrl(Offer $offer): string
    {
        $placeholders = [self::PART_NUMBER_KEY];
        $placeholderValues = [$offer->getPartNumberKey()];
        $platformProductUrl = sprintf(self::PRODUCT_PLATFORM_URL, strtolower($this->defaultCountryCode));
        return str_replace($placeholders, $placeholderValues, $platformProductUrl);
    }

    private function buildCharacteristics(Offer $offer): array
    {
        $inactivationData = $this->inactivationDataFactory->initiateInactivationData($this->errorCode, $offer);
        $this->addToSubject($inactivationData->getSubject());

        if($inactivationData instanceof Basic || $inactivationData instanceof PromoValidationLow) {
            return [];
        }

        $characteristics[$inactivationData->getPercentKeyName()] = $inactivationData->getPercent();
        $characteristics[$inactivationData->getValueKeyName()] = $inactivationData->getValue();
        return $characteristics;
    }

    private function buildSubject(Offer $offer, string $vendor): void
    {
        $vendorSubject = str_replace('|', '', $vendor);
        $criticalFlag = $offer->getOfferStatus()->isCritical() == OfferStatus::CRITICAL_ON ? '][CRITICAL][' : '][';
        $this->subject = '['.gethostname().$criticalFlag.$this->defaultCountryCode.']['.$vendorSubject.'] '.self::RULE_STATUS_LABEL;
    }

    private function addToSubject(string $text): void
    {
        $this->subject .= $text;
    }

    public function getFrom(): string
    {
        return self::EMAIL_FROM;
    }

    public function getTo(): string
    {
        return match ($this->defaultCountryId) {
            Country::RO_ID => self::MAIL_TO_RO,
            Country::BG_ID => self::MAIL_TO_BG,
            Country::HU_ID => self::MAIL_TO_HU,
            default => '',
        };
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getTemplate(): string
    {
        $mailTemplate = 'Email/error'.$this->errorCode.'.html.twig';
        if (!$this->templating->exists($mailTemplate)) {
            $mailTemplate = 'Email/error.html.twig';
        }
        return $mailTemplate;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}