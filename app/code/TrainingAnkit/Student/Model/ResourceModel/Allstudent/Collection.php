<?php
namespace TrainingAnkit\Student\Model\ResourceModel\Allstudent;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'student_id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'student_allstudent_collection';

    /**
     * @var string
     */
    protected $_eventObject = 'allstudent_collection';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init(
            'TrainingAnkit\Student\Model\Allstudent',
            'TrainingAnkit\Student\Model\ResourceModel\Allstudent'
        );
    }
}
