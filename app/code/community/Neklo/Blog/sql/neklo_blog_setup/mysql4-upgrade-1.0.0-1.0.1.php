<?php
/**
 * News installation script
 *
 * @var $installer Mage_Core_Model_Resource_Setup
 */

$installer = $this;

$installer->startSetup();

/**
 * Create table 'neklo_blog_category'
 */

$installer->run("
    CREATE TABLE IF NOT EXISTS `{$installer->getTable('neklo_blog/category')}` (
        `category_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `title` VARCHAR(255) NOT NULL,
        `identifier` VARCHAR(255) NOT NULL,
        `sort_order` INT UNSIGNED NOT NULL,
        `store_id` INT UNSIGNED NOT NULL,
        `meta_keywords` VARCHAR(255) NOT NULL,
        `meta_description` TEXT NOT NULL,
        PRIMARY KEY (`category_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Category item';
");

$installer->endSetup();

$installer->getTable('neklo_blog/category');