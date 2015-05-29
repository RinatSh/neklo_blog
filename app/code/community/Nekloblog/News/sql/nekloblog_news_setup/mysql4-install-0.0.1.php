<?php
/**
 * News installation script
 */

/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */

$installer = $this;

/**
 * Creating table nekloblog_news
 */
$installer->startSetup();
$table = $installer->getConnection()
    ->newTable($installer->getTable('nekloblog_news/news'))
    ->addColumn('news_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'identity' => true,
        'nullable' => false,
        'primary'  => true,
    ), 'Entity id')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
        'nullable' => true,
    ), 'Title')
    ->addColumn('author', Varien_Db_Ddl_Table::TYPE_VARCHAR, 63, array(
        'nullable' => true,
        'default'  => null,
    ), 'Author')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_VARCHAR, '2M', array(
        'nullable' => true,
        'default'  => null,
    ), 'Content')
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
        'default'  => null,
    ), 'News image media path')
    ->addColumn('published_at', Varien_Db_Ddl_Table::TYPE_DATE, null, array(
        'nullable' => true,
        'default'  => null,
    ), 'World publish date')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable' => true,
        'default'  => null,
    ), 'Creation Time');
$installer->getConnection()->createTable($table);