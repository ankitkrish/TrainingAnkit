<?php
namespace TrainingAnkit\Student\Controller\Adminhtml\AllStudent;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    protected $context;

    protected $allstudentFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->context = $context;
    }

    public function execute()
    {
        /** @var TYPE_NAME $allstudent */

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('All Students'));
        return $resultPage;
    }
}
