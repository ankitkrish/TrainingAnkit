<?php
namespace TrainingAnkit\Customer\Setup;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\Set as AttributeSet;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $customerSetupFactory;

    private $attributeSetFactory;

    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        $customerEntity = $customerSetup->getEavConfig()->getEntityType('customer');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
        if (version_compare($context->getVersion(), '1.0.0') < 0) {
            $customerSetup->addAttribute(
                \Magento\Customer\Model\Customer::ENTITY,
                'father_name',
                [
                    'type' => 'text',
                    'label' => 'Father Name',
                    'input' => 'text',
                    'required' => false,
                    'visible' => true,
                    'user_defined' => true,
                    'sort_order' => 1000,
                    'global'     => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'position' => 1000,
                    'system' => 0,
                ]
            );
            $Attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'father_name')
                ->addData([
                    'attribute_set_id' => $attributeSetId,
                    'attribute_group_id' => $attributeGroupId,
                    'used_in_forms' => ['adminhtml_customer','customer_account_create', 'customer_account_edit'],
                ]);

            $Attribute->save();
            $customerSetup->addAttribute(Customer::ENTITY, 'mother_name', [
                'type' => 'varchar',
                'label' => 'Mother Name',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => true,
                'global'     => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'sort_order' => 1000,
                'position' => 1000,
                'system' => 0,
            ]);
            $Attribute2 = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, 'mother_name')
                ->addData([
                    'attribute_set_id' => $attributeSetId,
                    'attribute_group_id' => $attributeGroupId,
                    'used_in_forms' => ['adminhtml_customer', 'customer_account_create', 'customer_account_edit'],
                ]);
            $Attribute2->save();
        }

        $setup->endSetup();
    }
}
