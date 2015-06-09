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
     *
     * @return $this Neklo_Blog_Model_News
     */

    protected function _beforeSave()
    {
        parent::_beforeSave();

        if ($this->_isObjectNew) {

            $this->setData('created_at', date(Varien_Date::DATETIME_INTERNAL_FORMAT, time()));

        }
        return $this;

    }

    /**
     * Event before show news item on frontend
     * If specified new post was added recently (term is defined in config) we'll see message about this on front-end.
     */

    public function isNew($createdAt)
    {

        $currentDate = Mage::app()->getLocale()->date();
        $newsCreatedAt = Mage::app()->getLocale()->date(strtotime($createdAt));
        $daysDifference = $currentDate->sub($newsCreatedAt)->getTimestamp() / (60 * 60 * 24);

        if ($daysDifference < Mage::helper('neklo_blog/config')->getDaysDifference()) {
            return true;
        }

    }

}