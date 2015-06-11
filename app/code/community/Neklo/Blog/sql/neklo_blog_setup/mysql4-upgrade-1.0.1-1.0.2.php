<?php

/**
 * Add column table 'neklo_blog_news'
 */

$installer = $this;
$installer->startSetup();

$installer->run("
	ALTER TABLE `{$this->getTable('neklo_blog/news')}`
	  ADD `identifier_url` VARCHAR(255) NOT NULL DEFAULT ''
    ;
");

$installer->endSetup();