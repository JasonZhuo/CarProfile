<?php

/**
 * Public alias for the application entry point
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 * Created By: jason
 * 9/16/24
 */

namespace Razoyo\CarProfile\Setup\Patch\Data;

use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddCarProfileCustomerAttribute implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private EavSetupFactory $eavSetupFactory;

    /**
     * @var Config
     */
    private Config $eavConfig;

    /**
     * @var Attribute
     */
    private Attribute $attributeResource;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     * @param Config $eavConfig
     * @param Attribute $attributeResource
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory          $eavSetupFactory,
        Config                   $eavConfig,
        Attribute                $attributeResource
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeResource = $attributeResource;
    }

    /**
     * Run code inside patch
     * If code fails, patch must be reverted, in case when we are speaking about schema - then under revert
     * means run PatchInterface::revert()
     *
     * If we speak about data, under revert means: $transaction->rollback()
     *
     * @return $this
     */
    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(
            Customer::ENTITY,
            'car_profile',
            [
                'input' => 'text',
                'is_visible_in_grid' => true,
                'visible' => true,
                'user_defined' => true,
                'is_filterable_in_grid' => true,
                'system' => false,
                'label' => 'Car Profile ID',
                'source' => null,
                'position' => 100,
                'type' => 'varchar',
                'is_used_in_grid' => true,
                'required' => false,
            ]
        );

        $eavSetup->addAttributeToSet(
            CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
            CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER,
            'Default',
            'car_profile'
        );

        $attribute = $this->eavConfig->getAttribute(Customer::ENTITY, 'car_profile');
        $attribute->setData(
            'used_in_forms',
            ['adminhtml_customer', 'customer_account_create', 'customer_account_edit']
        );
        $this->attributeResource->save($attribute);

        return $this;
    }

    /**
     * Get array of patches that have to be executed prior to this.
     *
     * Example of implementation:
     *
     * [
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch1::class,
     *      \Vendor_Name\Module_Name\Setup\Patch\Patch2::class
     * ]
     *
     * @return string[]
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Get aliases (previous names) for the patch.
     *
     * @return string[]
     */
    public function getAliases()
    {
        return [];
    }
}
