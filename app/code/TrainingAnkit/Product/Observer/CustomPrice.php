<?php

namespace TrainingAnkit\Product\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
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
     )
     {
         $this->scopeConfig = $scopeConfig;
         $this->cart = $cart;
     }

    public function execute(Observer $observer) {

        $item = $observer->getEvent()->getQuoteItem();
        $item->getQuote()->collectTotals();
        $subtotal = $item->getQuote()->getSubtotal();

       /* $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info($grandTotal);*/

        $orderPrice=12;//Suppose admin value in percentage
        $subtotalDiscount  = ($subtotal * $orderPrice)/100;
        $subtotals = ($subtotal + $subtotalDiscount);
        $price =$subtotals;

        /*$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/test.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info($price);*/

        $item->setCustomPrice($price);
        $item->setOriginalCustomPrice($price);
        $item->getProduct()->setIsSuperMode(true);

    }
}
