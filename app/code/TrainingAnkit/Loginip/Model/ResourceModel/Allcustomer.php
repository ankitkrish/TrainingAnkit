<?php
namespace TrainingAnkit\Loginip\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Allcustomer extends AbstractDb
{

    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('trainingankit_loginip', 'customer_id');
    }
}
