<?php

namespace TrainingAnkit\Loginip\Observer;

use Magento\Customer\Model\Context;
use Magento\Framework\App\ActionFlag;
use Magento\Framework\App\Response\Http;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\UrlFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\ResponseFactory;
use TrainingAnkit\Loginip\Model\AllcustomerFactory;

class Customerlogin implements ObserverInterface
{

    protected $_responseFactory;
    protected $_url;
    /**
     * @var AllcustomerFactory
     */
    private $allcustomerFactory;
    /**
     * @var ManagerInterface
     */
    private $eventManager;

    /**
     * RestrictWebsite constructor.
     * @param ManagerInterface $eventManager
     * @param Http $response
     * @param UrlFactory $urlFactory
     * @param \Magento\Framework\App\Http\Context $context
     * @param ActionFlag $actionFlag
     * @param ResponseFactory $responseFactory
     * @param AllcustomerFactory $allcustomerFactory
     * @param UrlInterface $url
     */
    public function __construct(
        ManagerInterface $eventManager,
        Http $response,
        UrlFactory $urlFactory,
        \Magento\Framework\App\Http\Context $context,
        ActionFlag $actionFlag,
        ResponseFactory $responseFactory,
        AllcustomerFactory $allcustomerFactory,
        UrlInterface $url
    ) {
        $this->_response = $response;
        $this->_urlFactory = $urlFactory;
        $this->_context = $context;
        $this->_actionFlag = $actionFlag;
        $this->_responseFactory = $responseFactory;
        $this->_url = $url;
        $this->allcustomerFactory = $allcustomerFactory;
        $this->eventManager = $eventManager;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $allowedRoutes = [
            'customer_account_login',
            'customer_account_loginpost'
        ];

        $objctManager = ObjectManager::getInstance();
        $remote = $objctManager->get(\Magento\Framework\HTTP\PhpEnvironment\RemoteAddress::class);
        $currentUserIp =  $remote->getRemoteAddress();
        $loginipCollection = $this->allcustomerFactory->create();
        $collection = $loginipCollection->getCollection();
        $collection->addFieldToFilter('address', $currentUserIp);
        $request = $observer->getEvent()->getRequest();
        $isCustomerLoggedIn = $this->_context->getValue(Context::CONTEXT_AUTH);
        $actionFullName = strtolower($request->getFullActionName());
        if (count($collection->getData()) && in_array($actionFullName, $allowedRoutes)) {
            $this->_response->setRedirect($this->_urlFactory->create()->getUrl('cms/index/index'));
        }
    }
}
