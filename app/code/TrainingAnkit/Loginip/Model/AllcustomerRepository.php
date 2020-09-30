<?php

namespace TrainingAnkit\Loginip\Model;

use TrainingAnkit\Loginip\Api\Data;
use TrainingAnkit\Loginip\Api\AllcustomerRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use TrainingAnkit\Loginip\Model\ResourceModel\Allcustomer as ResourceAllcustomer;
use TrainingAnkit\Loginip\Model\ResourceModel\Allcustomer\CollectionFactory as AllcustomerCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class AllcustomerRepository implements AllcustomerRepositoryInterface
{
    protected $resource;

    protected $allcustomerFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataAllcustomerFactory;

    private $storeManager;

    /**
     * AllcustomerRepository constructor.
     * @param ResourceAllcustomer $resource
     * @param AllcustomerFactory $allcustomerFactory
     * @param Data\AllcustomerInterfaceFactory $dataAllcustomerFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceAllcustomer $resource,
        AllcustomerFactory $allcustomerFactory,
        Data\AllcustomerInterfaceFactory $dataAllcustomerFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->allcustomerFactory = $allcustomerFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataAllcustomerFactory = $dataAllcustomerFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * @param Data\AllcustomerInterface $customer
     * @return Data\AllcustomerInterface|mixed
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function save(\TrainingAnkit\Loginip\Api\Data\AllcustomerInterface $customer)
    {
        if ($customer->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $customer->setStoreId($storeId);
        }
        try {
            $this->resource->save($customer);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the customer: %1', $exception->getMessage()),
                $exception
            );
        }
        return $customer;
    }

    /**
     * @param $customerId
     * @return Allcustomer|mixed
     * @throws NoSuchEntityException
     */
    public function getById($customerId)
    {
        $customer = $this->allcustomerFactory->create();
        $customer->load($customerId);
        if (!$customer->getId()) {
            throw new NoSuchEntityException(__('customer with id "%1" does not exist.', $customerId));
        }
        return $customer;
    }

    /**
     * @param Data\AllcustomerInterface $customer
     * @return bool|mixed
     * @throws CouldNotDeleteException
     */
    public function delete(\TrainingAnkit\Loginip\Api\Data\AllcustomerInterface $customer)
    {
        try {
            $this->resource->delete($customer);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the customer: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @param $customerId
     * @return bool|mixed
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($customerId)
    {
        return $this->delete($this->getById($customerId));
    }
}
