<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace TrainingAnkit\DailyDeal\Block\Product;
/**
 * Class View
 * @package TrainingAnkit\DailyDeal\Block\Product
 */
class View extends \Magento\Catalog\Block\Product\View
{

    public function getStatus()
    {
        return $status =  $this->getProduct()->getData('daily_deal_status');
    }
    public function getDealFrom()
    {
        return $dealFrom =  $this->getProduct()->getData('deal_sell_from');
    }
    public function getDealTo(){
         return $dealTo =  $this->getProduct()->getData('deal_sell_to');
    }

    public function getPriceCountDown(){
        if($this->getProduct()->getData('daily_deal_status')){
            $todate      =  $this->getProduct()->getData('deal_sell_to');
            $fromdate    =  $this->getProduct()->getData('deal_sell_from');
            if($this->getProduct()->getSpecialPrice() != 0 || $this->getProduct()->getSpecialPrice()) {
                if($this->getProduct()->getSpecialToDate() != null) {
                    if(strtotime($todate) >= strtotime($fromdate)){
                        return true;
                    }
                }
            }
        }
        return false;
    }
}