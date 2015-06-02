<?php

/**
 * Class  Neklo_Blog_Model_Resource_News
 */

class Neklo_Blog_Model_Resource_News extends Mage_Core_Model_Mysql4_Abstract
{

    /**
     * Resource initialization
     */
    protected function _construct()
    {
        $this->_init('neklo_blog/news', 'entity_id');
    }

}