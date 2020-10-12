<?php
/**
 * Copyright © TrainingAnkit. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace TrainingAnkit\OrderComment\Plugin\Model\Order;

use Magento\Sales\Api\Data\OrderSearchResultInterface;
use Magento\Sales\Model\OrderFactory;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Api\Data\OrderExtensionFactory;
use Magento\Sales\Api\Data\OrderInterface;

class AddTaOrderComment
{
    /**
     * @var OrderFactory
     */
    private $orderFactory;

    /**
     * @var OrderExtensionFactory
     */
    private $orderExtensionFactory;

    /**
     * @param OrderExtensionFactory $extensionFactory
     * @param OrderFactory $orderFactory
     */
    public function __construct(
        OrderExtensionFactory $extensionFactory,
        OrderFactory $orderFactory
    ) {
        $this->orderExtensionFactory = $extensionFactory;
        $this->orderFactory = $orderFactory;
    }

    /**
     * Set "ta_order_comment" to order data
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderSearchResultInterface $searchResult
     *
     * @return OrderSearchResultInterface
     */
    public function setOrderComment(OrderInterface $order)
    {
        if ($order instanceof \Magento\Sales\Model\Order) {
            $umOrderComment = $order->getTaOrderComment();
        } else {
            $orderModel = $this->orderFactory->create();
            $orderModel->load($order->getId());
            $umOrderComment = $orderModel->getTaOrderComment();
        }

        $extensionAttributes = $order->getExtensionAttributes();
        $orderExtensionAttributes = $extensionAttributes ? $extensionAttributes
            : $this->orderExtensionFactory->create();

        $orderExtensionAttributes->setTaOrderComment($umOrderComment);

        $order->setExtensionAttributes($orderExtensionAttributes);
    }

    /**
     * Add "ta_order_comment" extension attribute to order data object
     * to make it accessible in API data
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderSearchResultInterface $searchResult
     *
     * @return OrderSearchResultInterface
     */
    public function afterGetList(
        OrderRepositoryInterface $subject,
        OrderSearchResultInterface $orderSearchResult
    ) {
        foreach ($orderSearchResult->getItems() as $order) {
            $this->setOrderComment($order);
        }
        return $orderSearchResult;
    }

    /**
     * Add "ta_order_comment" extension attribute to order data object
     * to make it accessible in API data
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $order
     *
     * @return OrderInterface
     */
    public function afterGet(
        OrderRepositoryInterface $subject,
        OrderInterface $resultOrder
    ) {
        $this->setOrderComment($resultOrder);
        return $resultOrder;
    }
}
