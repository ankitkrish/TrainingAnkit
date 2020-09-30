<?php

namespace TrainingAnkit\Student\Model;

use TrainingAnkit\Student\Api\Data;
use TrainingAnkit\Student\Api\AllstudentRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use TrainingAnkit\Student\Model\ResourceModel\Allcustomer as ResourceAllstudent;
use TrainingAnkit\Student\Model\ResourceModel\Allstudent\CollectionFactory as AllstudentCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class AllstudentRepository implements AllstudentRepositoryInterface
{
    protected $resource;

    protected $allstudentFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataAllstudentFactory;

    private $storeManager;

    /**
     * AllstudentRepository constructor.
     * @param ResourceAllstudent $resource
     * @param AllstudentFactory $allstudentFactory
     * @param Data\AllstudentInterfaceFactory $dataAllstudentFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceAllstudent $resource,
        AllstudentFactory $allstudentFactory,
        Data\AllstudentInterfaceFactory $dataAllstudentFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->allstudentFactory = $allstudentFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataAllstudentFactory = $dataAllstudentFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * @param Data\AllstudentInterface $student
     * @return Data\AllstudentInterface|mixed
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     */
    public function save(\TrainingAnkit\Student\Api\Data\AllstudentInterface $student)
    {
        if ($student->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $student->setStoreId($storeId);
        }
        try {
            $this->resource->save($student);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the student: %1', $exception->getMessage()),
                $exception
            );
        }
        return $student;
    }

    /**
     * @param $studentId
     * @return Allcustomer|mixed
     * @throws NoSuchEntityException
     */
    public function getById($studentId)
    {
        $student = $this->allstudentFactory->create();
        $student->load($studentId);
        if (!$student->getId()) {
            throw new NoSuchEntityException(__('Student with id "%1" does not exist.', $studentId));
        }
        return $student;
    }

    /**
     * @param Data\AllstudentInterface $student
     * @return bool|mixed
     * @throws CouldNotDeleteException
     */
    public function delete(\TrainingAnkit\Student\Api\Data\AllstudentInterface $student)
    {
        try {
            $this->resource->delete($student);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the student: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @param $studentId
     * @return bool|mixed
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($studentId)
    {
        return $this->delete($this->getById($studentId));
    }
}
