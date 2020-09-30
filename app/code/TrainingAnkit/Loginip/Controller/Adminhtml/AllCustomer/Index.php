<?php
namespace TrainingAnkit\Loginip\Controller\Adminhtml\AllCustomer;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    /**
     * @var \Magento\Backend\App\Action\Context
     */
    protected $context;

    /**
     * @var \TrainingAnkit\Loginip\Model\Allcustomer
     */
    private $allCustomerFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \TrainingAnkit\Loginip\Model\AllcustomerFactory $allCustomerFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->context = $context;
        $this->allCustomerFactory = $allCustomerFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('All Customer'));
        return $resultPage;
    }
}
