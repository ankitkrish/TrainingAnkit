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

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function getGender()
    {
        return $this->getData(self::GENDER);
    }

    public function setGender($gender)
    {
        return $this->setData(self::GENDER, $gender);
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
