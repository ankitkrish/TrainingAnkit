<?php
namespace TrainingAnkit\Student\Model;

use Magento\Framework\Model\AbstractModel;

class Allstudent extends AbstractModel
{

    const MALE = 1;
    const FEMALE = 0;

    const CACHE_TAG = 'trainingankit_crud';

    //Unique identifier for use within caching
    protected $_cacheTag = self::CACHE_TAG;

    protected function _construct()
    {
        $this->_init('TrainingAnkit\Student\Model\ResourceModel\Allstudent');
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
    public function getGender()
    {
        return [self::MALE => __('Male'), self::FEMALE => __('Female')];
    }
}
