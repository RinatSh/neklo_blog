<?php

/**
 * Customer Tab block
 */
class Neklo_Blog_Block_Customer extends Mage_Core_Block_Template
{

    /**
     * Collection like customer news
     *
     * @return object
     */

    public function getCollection()
    {
        $customer = Mage::getSingleton('customer/session')->getCustomer();

        if ($customer->getId()) {

            $collection = Mage::getModel('neklo_blog/like')->getCollection();
            $collection->addFieldToFilter('customer_id', $customer->getId());
            $collection->getSelect()
                ->joinLeft(array('news' => 'neklo_blog_news'), 'news.entity_id = main_table.news_id');

        }

        return $collection;
    }

    public function getItemUrl($newsItemLike)
    {

        if ($newsItemLike->getIdentifierUrl()) {

            return $this->getUrl($newsItemLike->getIdentifierUrl());

        } else {

            return $this->getUrl('*/*/view', array('id' => $newsItemLike->getId()));

        }

    }
}