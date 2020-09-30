<?php

namespace TrainingAnkit\Loginip\Block\Adminhtml\Allcustomer\Edit;

use Magento\Backend\Block\Widget\Context;
use TrainingAnkit\Loginip\Api\AllcustomerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    protected $context;
   
    protected $allcustomerRepository;

    /**
     * GenericButton constructor.
     * @param Context $context
     * @param AllcustomerRepositoryInterface $allcustomerRepository
     */
    public function __construct(
        Context $context,
        AllcustomerRepositoryInterface $allcustomerRepository
    ) {
        $this->context = $context;
        $this->allcustomerRepository = $allcustomerRepository;
    }

    /**
     * @return |null
     */
    public function getcustomerId()
    {
        try {
            return $this->allcustomerRepository->getById(
                $this->context->getRequest()->getParam('customer_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
            return false;
        }
        return null;
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
