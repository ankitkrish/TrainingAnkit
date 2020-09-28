<?php

namespace TrainingAnkit\Student\Model\Allstudent\Source;

use Magento\Framework\Option\ArrayInterface;

class Education implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Higher Secondary')],
            ['value' => 2, 'label' => __('Graduation')],
            ['value' => 3, 'label' => __('Post Graduation')],
        ];
    }
}
