<?php
/**
 * Created by PhpStorm.
 * User: brent
 * Date: 7/04/14
 * Time: 10:41 AM
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$oConnection = $installer->getConnection();

$oConnection->addColumn(
    $installer->getTable('widget/widget_instance'),
    'from_date',
    'DATE'
);

$oConnection->addColumn(
    $installer->getTable('widget/widget_instance'),
    'to_date',
    'DATE'
);

$oConnection->addColumn(
    $installer->getTable('widget/widget_instance'),
    'enabled',
    'TINYINT(1) unsigned NOT NULL default 1'
);

$installer->endSetup();
