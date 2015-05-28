<?php

/**
 * Class Nekloblog_News_Model_Resource_News
 */

class Nekloblog_News_Model_Resource_News extends Mage_Core_Model_Resource_Db_Abstract
{

    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('nekloblog_news/news', 'news_id');
    }

}