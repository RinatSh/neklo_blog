<?php
/**
 * News installation script
 *
 * @var $installer Mage_Core_Model_Resource_Setup
 */

$installer = $this;

$installer->startSetup();

/**
 * Create table 'neklo_blog_news'
 */

$installer->run("
    CREATE TABLE IF NOT EXISTS `{$installer->getTable('neklo_blog/news')}` (
        `entity_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
        `title` VARCHAR(255) NOT NULL,
        `author` VARCHAR(63) NOT NULL,
        `content` TEXT NOT NULL,
        `short` TEXT NOT NULL,
        `published_at` DATE NOT NULL,
        `created_at` TIMESTAMP NOT NULL,
        PRIMARY KEY (`entity_id`),
        INDEX `inx_neklo_blog_news_published_at` (`published_at`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='News item';
");

$installer->endSetup();

$installer->getTable('neklo_blog/news');