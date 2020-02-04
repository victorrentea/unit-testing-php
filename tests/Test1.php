<?php
declare(strict_types=1);

namespace PhpUnitWorkshopTest;


use PHPUnit\Framework\TestCase;

class Test1 extends TestCase
{

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        echo "It's a new test\n";

    }

    private $a;

    protected function setUp()
    {
        $this->a = (new A("naame"))
            ->setAge(2)
            ->addB(new B());
    }

    /** @test */
    public function nTest()
    {
        $this->a->setName("old");
    }
    /** @test */
    public function mTest()
    {
        $this->a->setName("new");
        self::assertTrue(true);
    }
    /** @test */
    public function pTest()
    {
        echo 'name:' . $this->a->getName();
        self::assertTrue(true);
    }

}

class B
{

}
// embeddable
class TrackingInfo {
    private $createdBy;
    private $createdDate;
    private $modifiedBy;
    private $modifiedDate;

    /**
     * TrackingInfo constructor.
     * @param $createdBy
     * @param $createdDate
     * @param $modifiedBy
     * @param $modifiedDate
     */
    public function __construct($createdBy, $createdDate, $modifiedBy, $modifiedDate)
    {
        if ($createdBy == "") throw new \Exception("mama ta");
        $this->createdBy = $createdBy;
        $this->createdDate = $createdDate;
        $this->modifiedBy = $modifiedBy;
        $this->modifiedDate = $modifiedDate;
    }


}
class A
{
    private $name;
    private $age;
    // @embedded
    /** @var TrackingInfo */
    private $trackingInfo;

    private $bList = [];
    private $creationDate;

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     * @return A
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
        return $this;
    }

    public function setCreationDateStr(string $creationDateStr)
    {
        $this->creationDate = date("yyyy-MM-dd", $creationDateStr);
        return $this;
    }



    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getBList(): array
    {
        return $this->bList;
    }

    public function addB(B $b): A
    {
        $this->bList[] = $b;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return A
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     * @return A
     */
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }


}