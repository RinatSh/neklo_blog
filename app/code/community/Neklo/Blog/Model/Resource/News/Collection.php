<?php

/**
 * Class Neklo_Blog_Model_Resource_News_Collection
 */

class Neklo_Blog_Model_Resource_News_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{


    protected function _construct()
    {

        $this->_init('neklo_blog/news');

    }

    /**
     * Prepare for displaying in list
     *
     * @param $page $page
     * @return $this Neklo_Blog_Model_Resource_News_Collection
     */

    public function prepareForList($page)
    {

        $this->setPageSize(Mage::helper('neklo_blog')->getNewsPerPage());
        $this->setCurPage($page)->setOrder('published_at', Varien_Data_Collection::SORT_ORDER_DESC);

        return $this;

    }

}