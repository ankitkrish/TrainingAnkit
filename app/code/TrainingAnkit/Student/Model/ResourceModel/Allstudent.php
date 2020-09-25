<?php
namespace TrainingAnkit\Student\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Allstudent extends AbstractDb
{

    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('trainingankit_crud', 'student_id');
    }
}
