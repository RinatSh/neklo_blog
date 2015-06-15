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

            $collection = Mage::getModel('neklo_blog/news')->getCollection();
            $collection->getSelect()
                ->joinLeft(array('like' => 'neklo_blog_like'), 'main_table.entity_id = like.news_id');
             $collection->addFieldToFilter('customer_id', $customer->getId());
            
            return $collection;

        }

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