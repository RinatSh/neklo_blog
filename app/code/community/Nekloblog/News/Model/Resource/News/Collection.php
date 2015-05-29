<?php

/**
 * Class Nekloblog_News_Model_Resource_News_Collection
 */
class Nekloblog_News_Model_Resource_News_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract{


    protected function _construct()
    {
        $this->_init('nekloblog_news/news');
    }


}