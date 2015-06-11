<?php
/**
 * Like installation script
 *
 * @var $installer Mage_Core_Model_Resource_Setup
 */

$installer = $this;

$installer->startSetup();

/**
 * Create table 'neklo_blog_like'
 */

$installer->run("
    CREATE TABLE IF NOT EXISTS `{$installer->getTable('neklo_blog/like')}` (
        `like_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `customer_id` INT UNSIGNED NULL,
        `news_id` INT UNSIGNED NULL,
        PRIMARY KEY (`like_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Like item';
");

$installer->endSetup();

$installer->getTable('neklo_blog/like');
