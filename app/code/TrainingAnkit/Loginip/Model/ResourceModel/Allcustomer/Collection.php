<?php
namespace TrainingAnkit\Loginip\Model\ResourceModel\Allcustomer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'customer_id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'loginip_allcustomer_collection';

    /**
     * @var string
     */
    protected $_eventObject = 'allcustomer_collection';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init(
            \TrainingAnkit\Loginip\Model\Allcustomer::class,
            \TrainingAnkit\Loginip\Model\ResourceModel\Allcustomer::class
        );
    }
}
