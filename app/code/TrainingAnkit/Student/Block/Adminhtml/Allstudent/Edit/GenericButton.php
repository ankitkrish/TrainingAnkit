<?php

namespace TrainingAnkit\Student\Block\Adminhtml\Allstudent\Edit;

use Magento\Backend\Block\Widget\Context;
use TrainingAnkit\Student\Api\AllstudentRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 * @package TrainingAnkit\Student\Block\Adminhtml\Allstudent\Edit
 */
class GenericButton
{
    protected $context;
   
    protected $allstudentRepository;

    /**
     * GenericButton constructor.
     * @param Context $context
     * @param AllstudentRepositoryInterface $allstudentRepository
     */
    public function __construct(
        Context $context,
        AllstudentRepositoryInterface $allstudentRepository
    ) {
        $this->context = $context;
        $this->allstudentRepository = $allstudentRepository;
    }

    /**
     * @return |null
     */
    public function getstudentId()
    {
        try {
            return $this->allstudentRepository->getById(
                $this->context->getRequest()->getParam('student_id')
            )->getId();
        }
		catch (NoSuchEntityException $e) {
        
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
