<?php

namespace TrainingAnkit\Student\Controller\Adminhtml\Allstudent;

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
        return $this->_authorization->isAllowed('TrainingAnkit_Student::save');
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Allstudent
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Allstudent $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('TrainingAnkit_Student::student_allstudent')
            ->addBreadcrumb(__('Student'), __('Student'))
            ->addBreadcrumb(__('Manage All Student'), __('Manage All Student'));
        return $resultPage;
    }

    /**
     * Edit Allstudent
     *
     * @return \Magento\Backend\Model\View\Result\Allstudent|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('student_id');
        $model = $this->_objectManager->create(\TrainingAnkit\Student\Model\Allstudent::class);

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This student no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('student_allstudent', $model);

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Allstudent $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Student') : __('Add Student'),
            $id ? __('Edit Student') : __('Add Student')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Allstudent'));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? $model->getName() : __('Add Student'));

        return $resultPage;
    }
}
