<?php
namespace TrainingAnkit\Student\Controller\Adminhtml\AllStudent;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    /**
     * @var \Magento\Backend\App\Action\Context
     */
    protected $context;

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
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('All Student'));
        return $resultPage;
    }
}
