<?php

/**
 * Class  Neklo_Blog_Model_Resource_Category
 */

class Neklo_Blog_Model_Resource_Category extends Mage_Core_Model_Mysql4_Abstract
{

    /**
     * Resource initialization
     */

    protected function _construct()
    {

        $this->_init('neklo_blog/category', 'category_id');

    }

}