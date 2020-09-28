<?php
namespace TrainingAnkit\Student\Controller\Adminhtml\AllStudent;

use Magento\Backend\App\Action\Context;
use TrainingAnkit\Student\Api\AllstudentRepositoryInterface as AllstudentRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use TrainingAnkit\Student\Api\Data\AllstudentInterface;

class InlineEdit extends \Magento\Backend\App\Action
{
    protected $allstudentRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    public function __construct(
        Context $context,
        AllstudentRepository $allstudentRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->allstudentRepository = $allstudentRepository;
        $this->jsonFactory = $jsonFactory;
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
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach (array_keys($postItems) as $studentId) {
            $student = $this->allstudentRepository->getById($studentId);
            try {
                $studentData = $postItems[$studentId];
                $extendedStudentData = $student->getData();
                $this->setStudentData($student, $extendedStudentData, $studentData);
                $this->allstudentRepository->save($student);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithStudentId($student, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithStudentId($student, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithStudentId(
                    $student,
                    __('Something went wrong while saving the student.')
                );
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    protected function getErrorWithStudentId(AllstudentInterface $student, $errorText)
    {
        return '[Student ID: ' . $student->getId() . '] ' . $errorText;
    }

    public function setStudentData(
        \TrainingAnkit\Student\Model\Allstudent $student,
        array $extendedstudentData,
        array $studentData
    ) {
        $student->setData(array_merge($student->getData(), $extendedStudentData, $studentData));
        return $this;
    }
}
