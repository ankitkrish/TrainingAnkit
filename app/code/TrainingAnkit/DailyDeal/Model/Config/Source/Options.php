<?php
/**
 * TrainingAnkit
 * Copyright (C) 2019 TrainingAnkit <info@training.com>
 *
 * NOTICE OF LICENSE
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    TrainingAnkit
 * @package     TrainingAnkit_DailyDeal
 * @copyright   Copyright (c) 2012 Training (http://www.training.com/)
 * @license     http://www.TrainingAnkit.com/license-agreement.html
 * @author      Training <info@training.com>
 */
namespace TrainingAnkit\DailyDeal\Model\Config\Source;

class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
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
