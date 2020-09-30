<?php

namespace TrainingAnkit\Loginip\Controller\Adminhtml\Allcustomer;

use Magento\Backend\App\Action;
use TrainingAnkit\Loginip\Model\Allcustomer;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \TrainingAnkit\Loginip\Model\AllcustomerFactory
     */
    private $allcustomerFactory;

    /**
     * @var \TrainingAnkit\Loginip\Api\AllcustomerRepositoryInterface
     */
    private $allcustomerRepository;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param \TrainingAnkit\Loginip\Model\AllcustomerFactory $allcustomerFactory
     * @param \TrainingAnkit\Loginip\Api\AllcustomerRepositoryInterface $allcustomerRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \TrainingAnkit\Loginip\Model\AllcustomerFactory $allcustomerFactory = null,
        \TrainingAnkit\Loginip\Api\AllcustomerRepositoryInterface $allcustomerRepository = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->allcustomerFactory = $allcustomerFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\TrainingAnkit\Loginip\Model\AllcustomerFactory::class);
        $this->allcustomerRepository = $allcustomerRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\TrainingAnkit\Loginip\Api\AllcustomerRepositoryInterface::class);
        parent::__construct($context);
    }

    /**
     * Authorization level
     *
     * @see _isAllowed()
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrainingAnkit_Loginip::save');
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data[]='';
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (empty($data['customer_id'])) {
                $data['customer_id'] = null;
            }
            /** @var \TrainingAnkit\Loginip\Model\Allcustomer $model */
            $model = $this->allcustomerFactory->create();
            $id = $this->getRequest()->getParam('customer_id');
            if ($id) {
                try {
                    $model = $this->allcustomerRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This customer no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            $model->setData($data);
            $this->_eventManager->dispatch(
                'loginip_allcustomer_prepare_save',
                ['allcustomer' => $model, 'request' => $this->getRequest()]
            );
            try {
                $this->allcustomerRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the customer.'));
                $this->dataPersistor->clear('loginip_allcustomer');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['customer_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?:$e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the customer.'));
            }
            $this->dataPersistor->set('loginip_allcustomer', $data);
            return $resultRedirect->setPath('*/*/edit', ['customer_id' => $this->getRequest()
                ->getParam('customer_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
