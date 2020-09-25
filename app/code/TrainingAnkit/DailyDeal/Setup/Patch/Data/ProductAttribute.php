<?php
/**
 * TrainingAnkit
 * Copyright (C) 2019 TrainingAnkit <info@magentocoders.com>
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
 * @copyright   Copyright (c) 2012 MagentoCoders (http://www.magentocoders.com/)
 * @license     http://www.TrainingAnkit.com/license-agreement.html
 * @author      MagentoCoders <info@magentocoders.com>
 */
namespace TrainingAnkit\DailyDeal\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class ProductAttribute
 * @package TrainingAnkit\DailyDeal\Setup\Patch\Data
 */
class ProductAttribute implements DataPatchInterface {
    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * EavSetupFactory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory          $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }
    /**
     * {@inheritdoc}
     */
    public function apply() {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute('catalog_product', 'daily_deal_status', [
            'group'              => 'Dailydeal',
            'input'              => 'select',
            'type'               => 'int',
            'label'              => 'Deal Status',
            'visible'            => true,
            'required'           => true,
            'user_defined'               => true,
            'searchable'                 => false,
            'filterable'                 => false,
            'comparable'                 => false,
            'visible_on_front'           => false,
            'visible_in_advanced_search' => false,
            'is_html_allowed_on_front'   => false,
            'used_for_promo_rules'       => true,
            'source'                     => 'TrainingAnkit\DailyDeal\Model\Config\Source\Options',
            'frontend_class'             => '',
            'global'                     =>  \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'unique'                     => false,
            'apply_to'                   => 'simple,grouped,configurable,downloadable,virtual,bundle'
        ]);
         $eavSetup->addAttribute('catalog_product', 'deal_sell_from', [
             'group'              => 'Dailydeal',
             'type' => 'datetime',
             'input' => 'date',
             'label' => 'Deal From',
             'input_renderer' => 'TrainingAnkit\DailyDeal\Block\Adminhtml\Form\Element\Datetime',
             'class' => 'validate-date',
             'backend' => 'Magento\Catalog\Model\Attribute\Backend\Startdate',
             'required' => false,
             'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
             'visible' => true,
             'user_defined' => true,
             'default' => '',
             'searchable' => true,
             'filterable' => true,
             'filterable_in_search' => true,
             'visible_in_advanced_search' => true,
             'comparable' => false,
             'visible_on_front' => false,
             'used_in_product_listing' => true,
             'unique' => false,
             'apply_to'  => 'simple,grouped,configurable,downloadable,virtual,bundle'
         ]);
        $eavSetup->addAttribute('catalog_product', 'deal_sell_to', [
            'group'              => 'Dailydeal',
            'type' => 'datetime',
            'input' => 'date',
            'label' => 'Deal To',
            'input_renderer' => 'TrainingAnkit\DailyDeal\Block\Adminhtml\Form\Element\Datetime',
            'class' => 'validate-date',
            'backend' => 'Magento\Catalog\Model\Attribute\Backend\Startdate',
            'required' => false,
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
            'visible' => true,
            'user_defined' => true,
            'default' => '',
            'searchable' => true,
            'filterable' => true,
            'filterable_in_search' => true,
            'visible_in_advanced_search' => true,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
            'apply_to'  => 'simple,grouped,configurable,downloadable,virtual,bundle'
        ]);

    }
    /**
     * {@inheritdoc}
     */
    public static function getDependencies() {
        return [];
    }
    /**
     * {@inheritdoc}
     */
    public function getAliases() {
        return [];
    }
}