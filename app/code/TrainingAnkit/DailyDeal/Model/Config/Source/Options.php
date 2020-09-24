<?php

namespace TrainingAnkit\DailyDeal\Model\Config\Source;

class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options = [
            ['label' => __('Disable'), 'value'=>'0'],
            ['label' => __('Enable'), 'value'=>'1'],
        ];

        return $this->_options;

    }

}