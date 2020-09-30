<?php

namespace TrainingAnkit\Loginip\Controller\Adminhtml\Allcustomer;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }
    
    /**
     * Authorization level
     *
     * @see _isAllowed()
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrainingAnkit_Loginip::save');
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Allcustomer
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Allcustomer $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('TrainingAnkit_Loginip::loginip_allcustomer')
            ->addBreadcrumb(__('Loginip'), __('Loginip'))
            ->addBreadcrumb(__('Manage All Loginip'), __('Manage All customer'));
        return $resultPage;
    }

    /**
     * Edit Allcustomer
     *
     * @return \Magento\Backend\Model\View\Result\Allcustomer|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('customer_id');
        $model = $this->_objectManager->create(\TrainingAnkit\Loginip\Model\Allcustomer::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This loginip no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('loginip_allcustomer', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Allcustomer $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Customer') : __('Add Customer'),
            $id ? __('Edit Customer') : __('Add Customer')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('AllCustomer'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getName() : __('Add Customer'));

        return $resultPage;
    }
}
