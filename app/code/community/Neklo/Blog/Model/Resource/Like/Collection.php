<?php

/**
 * Class Neklo_Blog_Model_Resource_Like_Collection
 */

class Neklo_Blog_Model_Resource_Like_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{


    protected function _construct()
    {

        $this->_init('neklo_blog/like');

    }

}