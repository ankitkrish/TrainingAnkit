<?php
namespace TrainingAnkit\Student\Model;

use Magento\Framework\Model\AbstractModel;
use TrainingAnkit\Student\Api\Data\AllstudentInterface;

class Allstudent extends AbstractModel implements AllstudentInterface
{

    const CACHE_TAG = 'trainingankit_crud';

    //Unique identifier for use within caching
    protected $_cacheTag = self::CACHE_TAG;

    protected function _construct()
    {
        $this->_init(\TrainingAnkit\Student\Model\ResourceModel\Allstudent::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }

    public function getId()
    {
        return parent::getData(self::STUDENT_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::STUDENT_ID, $id);
    }
    public function setColor($color)
    {
        return $this->setData(self::COLOR, $color);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function getColor()
    {
        return $this->getData(self::COLOR);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function getGender()
    {
        return $this->getData(self::GENDER);
    }

    public function getHobby()
    {
        return $this->getData(self::HOBBY);
    }

    public function getCity()
    {
        return $this->getData(self::CITY);
    }

    public function setCity($city)
    {
        return $this->setData(self::CITY, $city);
    }

    public function setGender($gender)
    {
        return $this->setData(self::GENDER, $gender);
    }

    public function setHobby($hobby)
    {
        return $this->setData(self::HOBBY, $hobby);
    }

    public function getQualification()
    {
        return $this->setData(self::QUALIFICATION);
    }

    public function setQualification($qualification)
    {
        return $this->setData(self::QUALIFICATION, $qualification);
    }
}
