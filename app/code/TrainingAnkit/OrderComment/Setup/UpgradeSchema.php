<?php

namespace TrainingAnkit\OrderComment\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $quoteAddressTable = 'quote';
        $orderTable = 'sales_order';

        //Quote address table
        $setup->getConnection()
            ->addColumn(
                $setup->getTable($quoteAddressTable),
                'order_comment',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'comment' =>'Order Commentt'
                ]
            );
        $setup->endSetup();
    }
}
