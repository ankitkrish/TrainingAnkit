<?php
namespace TrainingAnkit\DailyDeal\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Context;

/**
 * Class ProductSaveAfter
 * @package TrainingAnkit\DailyDeal\Observer
 */
class ProductSaveAfter implements ObserverInterface
{
    /**
     * ProductSaveAfter constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context     = $context;
        $this->_request   = $context->getRequest();
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
     public function execute(\Magento\Framework\Event\Observer $observer)
        {
            $params = $this->_request->getParams();
            $customFieldData = $params['dailydeal'];
            return $customFieldData;

        }
}