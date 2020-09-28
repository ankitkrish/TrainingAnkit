<?php
namespace TrainingAnkit\Student\Model\Allstudent\Source;

use Magento\Framework\Option\ArrayInterface;

class Gender implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = [
            0 => [
                'label' => 'Male',
                'value' => 'male'
            ],
            1 => [
                'label' => 'Female',
                'value' => 'female'
            ],
        ];

        return $options;
    }
}