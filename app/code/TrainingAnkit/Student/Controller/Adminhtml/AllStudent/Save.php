<?php

namespace TrainingAnkit\Student\Controller\Adminhtml\Allstudent;

use Magento\Backend\App\Action;
use TrainingAnkit\Student\Model\Allstudent;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \TrainingAnkit\Student\Model\AllstudentFactory
     */
    private $allstudentFactory;

    /**
     * @var \TrainingAnkit\Student\Api\AllstudentRepositoryInterface
     */
    private $allstudentRepository;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param \TrainingAnkit\Student\Model\AllstudentFactory $allstudentFactory
     * @param \TrainingAnkit\Student\Api\AllstudentRepositoryInterface $allstudentRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \TrainingAnkit\Student\Model\AllstudentFactory $allstudentFactory = null,
        \TrainingAnkit\Student\Api\AllstudentRepositoryInterface $allstudentRepository = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->allstudentFactory = $allstudentFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\TrainingAnkit\Student\Model\AllstudentFactory::class);
        $this->allstudentRepository = $allstudentRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\TrainingAnkit\Student\Api\AllstudentRepositoryInterface::class);
        parent::__construct($context);
    }
	
	/**
     * Authorization level
     *
     * @see _isAllowed()
     */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('TrainingAnkit_Student::save');
	}

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (empty($data['student_id'])) {
                $data['student_id'] = null;
            }

            /** @var \TrainingAnkit\Student\Model\Allstudent $model */
            $model = $this->allstudentFactory->create();

            $id = $this->getRequest()->getParam('student_id');
            if ($id) {
                try {
                    $model = $this->allstudentRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This student no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            $model->setData($data);

            $this->_eventManager->dispatch(
                'student_allstudent_prepare_save',
                ['allstudent' => $model, 'request' => $this->getRequest()]
            );

            try {
                $this->allstudentRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the student.'));
                $this->dataPersistor->clear('student_allstudent');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['student_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?:$e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the student.'));
            }
            $this->dataPersistor->set('student_allstudent', $data);
            return $resultRedirect->setPath('*/*/edit', ['student_id' => $this->getRequest()->getParam('student_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
