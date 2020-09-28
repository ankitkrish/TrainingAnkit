<?php
namespace TrainingAnkit\Student\Block\Adminhtml;

class Allstudent extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_allstudent';
        $this->_blockGroup = 'TrainingAnkit_Student';
        $this->_headerText = __('Manage Student');

        parent::_construct();

        if ($this->_isAllowedAction('TrainingAnkit_Student::save')) {
            $this->buttonList->update('add', 'label', __('Add Student'));
        } else {
            $this->buttonList->remove('add');
        }
    }

    /**
     * @param $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
