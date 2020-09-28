<?php

namespace TrainingAnkit\Student\Controller\Adminhtml\Allstudent;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * Authorization level
     *
     * @see _isAllowed()
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('TrainingAnkit_Student::student_delete');
    }
    
    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('student_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $name = "";
            try {
                // init model and delete
                $model = $this->_objectManager->create(\TrainingAnkit\Student\Model\Allstudent::class);
                $model->load($id);
                $name = $model->getName();
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('The student has been deleted.'));
                // go to grid
                $this->_eventManager->dispatch(
                    'adminhtml_student_on_delete',
                    ['name' => $name, 'status' => 'success']
                );
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_student_on_delete',
                    ['name' => $name, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['student_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a student to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
