<?php

namespace TrainingAnkit\Student\Model\Allstudent\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Gender implements OptionSourceInterface
{
    protected $allBlog;

    /**
     * Status constructor.
     * @param \TrainingAnkit\Student\Model\Allstudent $allstudent
     */
    public function __construct(\TrainingAnkit\Student\Model\Allstudent $allstudent)
    {
        $this->allstudent = $allstudent;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->allstudent->getGender();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
