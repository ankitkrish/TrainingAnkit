<?php
namespace TrainingAnkit\Student\Model\Allstudent\Source;

use Magento\Framework\Option\ArrayInterface;

class City implements ArrayInterface
{
    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                'value' => $value,
                'label' => $label,
            ];
        }

        return $result;
    }

    public function getOptions()
    {
        return [
            '1' => __('Gwalior'),
            '2' => __('Ahmedabad'),
            '3' => __('Pune'),
        ];
    }
}
