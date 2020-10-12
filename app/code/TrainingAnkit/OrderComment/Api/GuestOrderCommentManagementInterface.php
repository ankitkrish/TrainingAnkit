<?php
/**
 * Copyright © TrainingAnkit. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace TrainingAnkit\OrderComment\Api;

use TrainingAnkit\OrderComment\Api\Data\OrderCommentInterface;

/**
 * Interface for saving the checkout order comment
 * to the quote for guest users
 * @api
 */
interface GuestOrderCommentManagementInterface
{
    /**
     * @param string $cartId
     * @param OrderCommentInterface $orderComment
     * @return \Magento\Checkout\Api\Data\PaymentDetailsInterface
     */
    public function saveOrderComment(
        $cartId,
        OrderCommentInterface $orderComment
    );
}
