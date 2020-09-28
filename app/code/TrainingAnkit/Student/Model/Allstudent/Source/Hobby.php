<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace TrainingAnkit\Student\Model\Allstudent\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Catalog\Model\Category as CategoryModel;

/**
 * Options tree for "Categories" field
 */
class Hobby implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [['value' => 'cricket', 'label' => __('Cricket')],
            ['value' => 'football', 'label' => __('FootBall')],
            ['value' => 'chess', 'label' => __('Chess')]
        ];
    }
}
