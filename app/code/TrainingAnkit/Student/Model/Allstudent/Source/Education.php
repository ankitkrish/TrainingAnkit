<?php

namespace TrainingAnkit\Student\Model\Allstudent\Source;

use Magento\Framework\Option\ArrayInterface;

class Education implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'higherSecondary', 'label' => __('Higher Secondary')],
            ['value' => 'Graduation', 'label' => __('Graduation')],
            ['value' => 'Post Graduation','label' => __('Post Graduation')],
        ];
    }
}
