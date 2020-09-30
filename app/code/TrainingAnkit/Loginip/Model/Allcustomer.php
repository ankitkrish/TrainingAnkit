<?php
namespace TrainingAnkit\Loginip\Model;

use Magento\Framework\Model\AbstractModel;
use TrainingAnkit\Loginip\Api\Data\AllcustomerInterface;

class Allcustomer extends AbstractModel implements AllcustomerInterface
{

    const CACHE_TAG = 'trainingankit_loginip';

    //Unique identifier for use within caching
    protected $_cacheTag = self::CACHE_TAG;

    protected function _construct()
    {
        $this->_init(\TrainingAnkit\Loginip\Model\ResourceModel\Allcustomer::class);
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
        return parent::getData(self::CUSTOMER_ID);
    }

    public function setId($id)
    {
        return $this->setData(self::CUSTOMER_ID, $id);
    }

    public function getName()
    {
        return $this->getData(self::NAME);
    }

    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    public function getAddress()
    {
        return $this->getData(self::ADDRESS);
    }

    public function setAddress($address)
    {
        return $this->setData(self::ADDRESS, $address);
    }
}
