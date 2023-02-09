<?php

namespace App\Tests\Unit\Notification\Infrastructure\Domain\EmailTemplate;

use App\Characteristics\Domain\FindCharacteristicByOffer;
use App\DataFeed\Domain\Brand\BrandRepositoryInterface;
use App\DataFeed\Domain\Category\CategoryRepositoryInterface;
use App\DataFeed\Domain\Mktp\MktpRepositoryInterface;
use App\Iprice\Domain\Model\Offer;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\BasePriceHigh;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\BasePriceHighInactive;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\BasePriceLow;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\BasePriceLowInactive;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\CategoryLow;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\DocMin;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\InactivationDataFactory;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\PromoValidationLow;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\SalePriceHigh;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationData\SalePriceLow;
use App\Notification\Infrastructure\Domain\EmailTemplate\InactivationEmail;
use App\Rule\Domain\Model\BasePriceHistoryVariationHigh;
use App\Rule\Domain\Model\BasePriceHistoryVariationLow;
use App\Rule\Domain\Model\BasePriceHistoryVariationRepositoryHighInterface as BasePriceVariationHighInterface;
use App\Rule\Domain\Model\BasePriceHistoryVariationRepositoryLowInterface as BasePriceVariationLowInterface;
use App\Rule\Domain\Model\BasePriceInactiveHistoryVariationHigh;
use App\Rule\Domain\Model\BasePriceInactiveHistoryVariationLow;
use App\Rule\Domain\Model\BasePriceInactiveHistoryVariationRepositoryHighInterface;
use App\Rule\Domain\Model\BasePriceInactiveHistoryVariationRepositoryLowInterface;
use App\Rule\Domain\Model\CategoryHistoryVariationLow;
use App\Rule\Domain\Model\CategoryHistoryVariationRepositoryLowInterface;
use App\Rule\Domain\Model\DocPriceHistoryVariationLow;
use App\Rule\Domain\Model\DocPriceHistoryVariationRepositoryLowInterface;
use App\Rule\Domain\Model\SalePriceHistoryVariationHigh;
use App\Rule\Domain\Model\SalePriceHistoryVariationLow;
use App\Rule\Domain\Model\SalePriceHistoryVariationRepositoryHighInterface;
use App\Rule\Domain\Model\SalePriceHistoryVariationRepositoryLowInterface;
use App\Rule\Domain\Rules\Rules;
use Doctrine\Persistence\ManagerRegistry;
use JMS\Serializer\ArrayTransformerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Twig\Environment;
use Twig\Loader\LoaderInterface;

class InactivationEmailTest extends WebTestCase
{
        private ArrayTransformerInterface $serializer;
        private LoaderInterface $loaderInterface;
        private Offer $offer;
        private BrandRepositoryInterface $brandRepository;
        private MktpRepositoryInterface $mktpRepository;
        private CategoryRepositoryInterface $categoryRepository;
        private Environment $twig;

    protected function setUp(): void
    {
        $this->offer = new Offer(90, 1, 2, 1, 63204, 1);
        $this->offer->getOfferStatus()->setCritical(false);
        $this->offer->setInactivated();
        $this->offer->setBrandId(10);
        $this->offer->setSalePrice(123);
        $this->offer->setBasePrice(178);
        $this->offer->setCategoryId(31);
        $this->offer->setAvailabilityId(3);
        $this->offer->setName('Laptop ASUS');
        $this->offer->setPartNumber('HD*HDUS');
        $this->offer->setVatRate(0.19);
        $this->offer->setPartNumberKey('DLZ01FMBM');
        $this->offer->setProductTypeId(1);
        $this->offer->setPromoPrice(45);

        $this->serializer = $this->createMock(ArrayTransformerInterface::class);
        $this->loaderInterface = $this->createMock(LoaderInterface::class);
        $this->brandRepository = $this->createMock(BrandRepositoryInterface::class);
        $this->brandRepository->expects($this->once())
            ->method('getBrandByIds')
            ->with([$this->offer->getBrandId()])
            ->willReturn([0 => ['brand_name' => 'name', 'id' => 1]]);
        $this->mktpRepository = $this->createMock(MktpRepositoryInterface::class);
        $this->mktpRepository->expects($this->once())
            ->method('getVendorNameById')
            ->with($this->offer->getVendorId())
            ->willReturn('Doron Land');
        $this->categoryRepository = $this->createMock(CategoryRepositoryInterface::class);
        $this->categoryRepository->expects($this->once())
            ->method('getCategoryTreeForRoot')
            ->with($this->offer->getCategoryId())
            ->willReturn(['results' => [0 => ['title' => 'ceva']] ]);
        $this->serializer->expects($this->once())
            ->method('toArray')
            ->with($this->offer);
        $this->twig = $this->createMock(Environment::class);
        $this->twig->expects($this->once())
            ->method('getLoader')
            ->willReturn($this->loaderInterface);
    }

    public function testMailSalePriceVsDwhReference()
    {
        $inactivationDataFactory = new InactivationDataFactory();

        $this->offer->getOfferStatus()->setInactivationReason(Rules::SALE_PRICE_VS_DWH_REFERENCE);
        $test = new InactivationEmail('1', 'ro', $this->brandRepository,
        $this->mktpRepository, $this->categoryRepository, $this->serializer, $inactivationDataFactory, $this->twig);

        $test($this->offer);
    }

    public function testMailPromoValidationLow()
    {
        $promoValidation = $this->createMock(PromoValidationLow::class);
        $promoValidation->expects($this->once())
            ->method('getSubject');

        $inactivationDataFactory = $this->createMock(InactivationDataFactory::class);
        $inactivationDataFactory->expects($this->once())
            ->method('initiateInactivationData')
            ->willReturn($promoValidation);

        $this->offer->getOfferStatus()->setInactivationReason(Rules::PROMO_VALIDATION_LOW);
        $test = new InactivationEmail('1', 'ro', $this->brandRepository,
            $this->mktpRepository, $this->categoryRepository, $this->serializer, $inactivationDataFactory, $this->twig);

        $test($this->offer);
    }

    public function testMailLastActiveBasePriceLow()
    {
        $this->offer->getOfferStatus()->setInactivationReason(Rules::LAST_ACTIVE_BASE_PRICE_LOW);

        $basePriceLow = $this->createMock(BasePriceLow::class);
        $basePriceLow->expects($this->once())
            ->method('getSubject');
        $basePriceLow->expects($this->once())
            ->method('getPercent');
        $basePriceLow->expects($this->once())
            ->method('getValue');
        $basePriceLow->expects($this->once())
            ->method('getPercentKeyName');
        $basePriceLow->expects($this->once())
            ->method('getValueKeyName');

        $inactivationDataFactory = $this->createMock(InactivationDataFactory::class);
        $inactivationDataFactory->expects($this->once())
            ->method('initiateInactivationData')
            ->willReturn($basePriceLow);

        $test = new InactivationEmail('1', 'ro', $this->brandRepository,
            $this->mktpRepository, $this->categoryRepository, $this->serializer, $inactivationDataFactory, $this->twig);
        $test($this->offer);
    }

    public function testMailLastActiveBasePriceHigh()
    {
        $this->offer->getOfferStatus()->setInactivationReason(Rules::LAST_ACTIVE_BASE_PRICE_HIGH);

        $basePriceHigh = $this->createMock(BasePriceHigh::class);
        $basePriceHigh->expects($this->once())
            ->method('getSubject');
        $basePriceHigh->expects($this->once())
            ->method('getPercent');
        $basePriceHigh->expects($this->once())
            ->method('getValue');
        $basePriceHigh->expects($this->once())
            ->method('getPercentKeyName');
        $basePriceHigh->expects($this->once())
            ->method('getValueKeyName');

        $inactivationDataFactory = $this->createMock(InactivationDataFactory::class);
        $inactivationDataFactory->expects($this->once())
            ->method('initiateInactivationData')
            ->willReturn($basePriceHigh);

        $test = new InactivationEmail('1', 'ro', $this->brandRepository,
            $this->mktpRepository, $this->categoryRepository, $this->serializer, $inactivationDataFactory, $this->twig);
        $test($this->offer);
    }

    public function testMailLastInactiveBasePriceHigh()
    {
        $this->offer->getOfferStatus()->setInactivationReason(Rules::LAST_INACTIVE_BASE_PRICE_HIGH);

        $basePriceHighInactive = $this->createMock(BasePriceHighInactive::class);
        $basePriceHighInactive->expects($this->once())
            ->method('getSubject');
        $basePriceHighInactive->expects($this->once())
            ->method('getPercent');
        $basePriceHighInactive->expects($this->once())
            ->method('getValue');
        $basePriceHighInactive->expects($this->once())
            ->method('getPercentKeyName');
        $basePriceHighInactive->expects($this->once())
            ->method('getValueKeyName');

        $inactivationDataFactory = $this->createMock(InactivationDataFactory::class);
        $inactivationDataFactory->expects($this->once())
            ->method('initiateInactivationData')
            ->willReturn($basePriceHighInactive);

        $test = new InactivationEmail('1', 'ro', $this->brandRepository,
            $this->mktpRepository, $this->categoryRepository, $this->serializer, $inactivationDataFactory, $this->twig);
        $test($this->offer);
    }

    public function testMailLastInactiveBasePriceLow()
    {
        $this->offer->getOfferStatus()->setInactivationReason(Rules::LAST_INACTIVE_BASE_PRICE_LOW);

        $basePriceLowInactive = $this->createMock(BasePriceLowInactive::class);
        $basePriceLowInactive->expects($this->once())
            ->method('getSubject');
        $basePriceLowInactive->expects($this->once())
            ->method('getPercent');
        $basePriceLowInactive->expects($this->once())
            ->method('getValue');
        $basePriceLowInactive->expects($this->once())
            ->method('getPercentKeyName');
        $basePriceLowInactive->expects($this->once())
            ->method('getValueKeyName');

        $inactivationDataFactory = $this->createMock(InactivationDataFactory::class);
        $inactivationDataFactory->expects($this->once())
            ->method('initiateInactivationData')
            ->willReturn($basePriceLowInactive);

        $test = new InactivationEmail('1', 'ro', $this->brandRepository,
            $this->mktpRepository, $this->categoryRepository, $this->serializer, $inactivationDataFactory, $this->twig);
        $test($this->offer);
    }

    public function testMailLastActiveSalePriceLow()
    {
        $this->offer->getOfferStatus()->setInactivationReason(Rules::LAST_ACTIVE_SALE_PRICE_LOW);

        $salePriceLow = $this->createMock(SalePriceLow::class);
        $salePriceLow->expects($this->once())
            ->method('getSubject');
        $salePriceLow->expects($this->once())
            ->method('getPercent');
        $salePriceLow->expects($this->once())
            ->method('getValue');
        $salePriceLow->expects($this->once())
            ->method('getPercentKeyName');
        $salePriceLow->expects($this->once())
            ->method('getValueKeyName');

        $inactivationDataFactory = $this->createMock(InactivationDataFactory::class);
        $inactivationDataFactory->expects($this->once())
            ->method('initiateInactivationData')
            ->willReturn($salePriceLow);

        $test = new InactivationEmail('1', 'ro', $this->brandRepository,
            $this->mktpRepository, $this->categoryRepository, $this->serializer, $inactivationDataFactory, $this->twig);
        $test($this->offer);
    }

    public function testMailLastActiveSalePriceHigh()
    {
        $this->offer->getOfferStatus()->setInactivationReason(Rules::LAST_ACTIVE_SALE_PRICE_HIGH);

        $salePriceHigh = $this->createMock(SalePriceHigh::class);
        $salePriceHigh->expects($this->once())
            ->method('getSubject');
        $salePriceHigh->expects($this->once())
            ->method('getPercent');
        $salePriceHigh->expects($this->once())
            ->method('getValue');
        $salePriceHigh->expects($this->once())
            ->method('getPercentKeyName');
        $salePriceHigh->expects($this->once())
            ->method('getValueKeyName');

        $inactivationDataFactory = $this->createMock(InactivationDataFactory::class);
        $inactivationDataFactory->expects($this->once())
            ->method('initiateInactivationData')
            ->willReturn($salePriceHigh);

        $test = new InactivationEmail('1', 'ro', $this->brandRepository,
            $this->mktpRepository, $this->categoryRepository, $this->serializer, $inactivationDataFactory, $this->twig);
        $test($this->offer);
    }

    public function testMailCategoryLow()
    {
        $this->offer->getOfferStatus()->setInactivationReason(Rules::CATEGORY_LOW);

        $categoryLow = $this->createMock(CategoryLow::class);
        $categoryLow->expects($this->once())
            ->method('getSubject');
        $categoryLow->expects($this->once())
            ->method('getPercent');
        $categoryLow->expects($this->once())
            ->method('getValue');
        $categoryLow->expects($this->once())
            ->method('getPercentKeyName');
        $categoryLow->expects($this->once())
            ->method('getValueKeyName');

        $inactivationDataFactory = $this->createMock(InactivationDataFactory::class);
        $inactivationDataFactory->expects($this->once())
            ->method('initiateInactivationData')
            ->willReturn($categoryLow);

        $test = new InactivationEmail('1', 'ro', $this->brandRepository,
            $this->mktpRepository, $this->categoryRepository, $this->serializer, $inactivationDataFactory, $this->twig);
        $test($this->offer);
    }

    public function testMailDocMinBasePrice()
    {
        $this->offer->getOfferStatus()->setInactivationReason(Rules::DOC_MIN_BASE_PRICE);

        $docMin = $this->createMock(DocMin::class);
        $docMin->expects($this->once())
            ->method('getSubject');
        $docMin->expects($this->once())
            ->method('getPercent');
        $docMin->expects($this->once())
            ->method('getValue');
        $docMin->expects($this->once())
            ->method('getPercentKeyName');
        $docMin->expects($this->once())
            ->method('getValueKeyName');

        $inactivationDataFactory = $this->createMock(InactivationDataFactory::class);
        $inactivationDataFactory->expects($this->once())
            ->method('initiateInactivationData')
            ->willReturn($docMin);

        $test = new InactivationEmail('1', 'ro', $this->brandRepository,
            $this->mktpRepository, $this->categoryRepository, $this->serializer, $inactivationDataFactory, $this->twig);
        $test($this->offer);
    }
}