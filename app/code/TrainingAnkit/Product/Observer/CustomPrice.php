<?php

namespace TrainingAnkit\Product\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Checkout\Model\Cart as CustomerCart;

class CustomPrice implements ObserverInterface
{

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var CustomerCart
     */
    protected $cart;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        CustomerCart $cart
    ) {
         $this->scopeConfig = $scopeConfig;
         $this->cart = $cart;
    }

    public function execute(Observer $observer)
    {

        $item = $observer->getEvent()->getQuoteItem();
        $item->getQuote()->collectTotals();
        $subtotal = $item->getQuote()->getSubtotal();
        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info($subtotal);

        $orderPrice = 12;//Suppose admin config value in percentage
        $subtotalDiscount  = ($subtotal * $orderPrice)/100;
        $updatedSubtotal = ($subtotal + $subtotalDiscount);

        /*$item->setCustomPrice($price);
        $item->setOriginalCustomPrice($price);
        $item->getProduct()->setIsSuperMode(true);
        */
        $item->getQuote()->setSubtotal($updatedSubtotal)->save();
        $item->getQuote()->collectTotals();
        /*$item->setSubtotal($updatedSubtotal);
        $item->save();*/
    }
}
