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
namespace TrainingAnkit\DailyDeal\Block\Product;

class View extends \Magento\Catalog\Block\Product\View
{
    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $status =  $this->getProduct()->getData('daily_deal_status');
    }

    /**
     * @return mixed
     */
    public function getDealFrom()
    {
        return $dealFrom =  $this->getProduct()->getData('deal_sell_from');
    }

    /**
     * @return mixed
     */
    public function getDealTo()
    {
         return $dealTo =  $this->getProduct()->getData('deal_sell_to');
    }

    /**
     * @return bool
     */
    public function getPriceCountDown()
    {
        if ($this->getProduct()->getData('daily_deal_status')) {
            $todate      =  $this->getProduct()->getData('deal_sell_to');
            $fromdate    =  $this->getProduct()->getData('deal_sell_from');
            if ($this->getProduct()->getSpecialPrice() != 0 || $this->getProduct()->getSpecialPrice()) {
                if ($this->getProduct()->getSpecialToDate() != null) {
                    if (strtotime($todate) >= strtotime($fromdate)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}
