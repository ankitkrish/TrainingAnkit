<?php

namespace TrainingAnkit\Customer\Ui\Component\Listing\Column;

use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Customer\Model\Customer;

class MotherName extends Column
{
    protected $customerFactory;

    protected $_searchCriteria;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        SearchCriteriaBuilder $criteria,
        CustomerFactory $customerFactory,
        array $components = [],
        array $data = []
    ) {
        $this->_searchCriteria = $criteria;
        $this->customerFactory = $customerFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $customer = $this->customerFactory->create()->load($item['entity_id']);
                $item[$this->getData('name')] = $customer->getMotherName();
            }
        }
        return $dataSource;
    }
}
