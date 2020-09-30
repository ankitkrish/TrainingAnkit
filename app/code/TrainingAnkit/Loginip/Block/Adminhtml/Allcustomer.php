<?php
namespace TrainingAnkit\Loginip\Block\Adminhtml;

class Allcustomer extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_allcustomer';
        $this->_blockGroup = 'TrainingAnkit_Loginip';
        $this->_headerText = __('Manage Customer');

        parent::_construct();

        if ($this->_isAllowedAction('TrainingAnkit_Loginip::save')) {
            $this->buttonList->update('add', 'label', __('Add Customer'));
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
