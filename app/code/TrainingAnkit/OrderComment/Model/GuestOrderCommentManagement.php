<?php
/**
 * Copyright © TrainingAnkit. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace TrainingAnkit\OrderComment\Model;

use TrainingAnkit\OrderComment\Api\GuestOrderCommentManagementInterface;
use Magento\Quote\Model\QuoteIdMaskFactory;
use TrainingAnkit\OrderComment\Api\OrderCommentManagementInterface;
use TrainingAnkit\OrderComment\Api\Data\OrderCommentInterface;

class GuestOrderCommentManagement implements GuestOrderCommentManagementInterface
{
    /**
     * @var QuoteIdMaskFactory
     */
    protected $quoteIdMaskFactory;

    /**
     * @var OrderCommentManagementInterface
     */
    protected $orderCommentManagement;

    /**
     * GuestOrderCommentManagement constructor.
     * @param QuoteIdMaskFactory $quoteIdMaskFactory
     * @param OrderCommentManagementInterface $orderCommentManagement
     */
    public function __construct(
        QuoteIdMaskFactory $quoteIdMaskFactory,
        OrderCommentManagementInterface $orderCommentManagement
    ) {
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
        $this->orderCommentManagement = $orderCommentManagement;
    }

    /**
     * {@inheritDoc}
     */
    public function saveOrderComment(
        $cartId,
        OrderCommentInterface $orderComment
    ) {
        $quoteIdMask = $this->quoteIdMaskFactory->create()
            ->load($cartId, 'masked_id');

        return $this->orderCommentManagement->saveOrderComment(
            $quoteIdMask->getQuoteId(),
            $orderComment
        );
    }
}
