<?php

$installer = $this;
$installer->startSetup();

$bloodTable = $installer->getConnection()
    ->newTable($installer->getTable('product_blood/blood'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
    ))
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('image_url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array())
    ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null, array())
    ->addColumn('price', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array())
    ->addColumn('qty', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array())
    ->addColumn('slug', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array());

$installer->getConnection()->createTable($bloodTable);

$installer->endSetup();