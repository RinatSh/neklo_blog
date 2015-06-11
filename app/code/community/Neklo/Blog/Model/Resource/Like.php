<?php

/**
 * Class  Neklo_Blog_Model_Resource_Like
 */

class Neklo_Blog_Model_Resource_Like extends Mage_Core_Model_Mysql4_Abstract
{

    /**
     * Resource initialization
     */

    protected function _construct()
    {

        $this->_init('neklo_blog/like', 'like_id');

    }

}