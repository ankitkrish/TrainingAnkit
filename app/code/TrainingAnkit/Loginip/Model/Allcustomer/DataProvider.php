<?php
namespace TrainingAnkit\Loginip\Model\Allcustomer;

use TrainingAnkit\Loginip\Model\ResourceModel\Allcustomer\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $allcustomerCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $allcustomerCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $allcustomerCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
    }

    /**
     * Prepares Meta
     *
     * @param array $meta
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $customers) {
            $this->loadedData[$customers->getId()] = $customers->getData();
        }
        $data = $this->dataPersistor->get('loginip_allcustomer');
        if (!empty($data)) {
            $customer = $this->collection->getNewEmptyItem();
            $customer->setData($data);
            $this->loadedData[$customer->getId()] = $customer->getData();
            $this->dataPersistor->clear('loginip_allcustomer');
        }

        return $this->loadedData;
    }
}
