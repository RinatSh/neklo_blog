<?php

/**
 * Class Neklo_Blog_Model_News
 */
class Neklo_Blog_Model_News extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('neklo_blog/news');
    }

    /**
     * add creation date
     * @return $this Neklo_Blog_Model_News
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        if ($this->_isObjectNew) {
            //$this->setData('created_at', Varien_Date::now());
        }
        return $this;
    }

}