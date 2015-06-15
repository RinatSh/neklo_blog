<?php

/**
 * News list block
 */

class Neklo_Blog_Block_List extends Mage_Core_Block_Template
{
    /**
     * News collection
     *
     * @var Neklo_Blog_Model_Resource_News_Collection
     */

    protected $_newsCollection = null;

    /**
     * Retrieve news collection
     *
     * @return Neklo_Blog_Model_Resource_News_Collection
     */

    protected function _getCollection()
    {
        return Mage::getResourceModel('neklo_blog/news_collection');
    }

    /**
     * Retrieve prepared news collection
     *
     * @return Neklo_Blog_Model_Resource_News_Collection
     */

    public function getCollection()
    {
        if (is_null($this->_newsCollection)) {
            $this->_newsCollection = $this->_getCollection();
            $this->_newsCollection->prepareForList($this->getCurrentPage());

            $currentDate = date('Y-m-d');

            $this->_newsCollection->addFieldToFilter(
                'published_at',
                array(
                    'lteq'=>$currentDate
                )
            );

            $categoryId = $this->getRequest()->getParam('id');
            $model = Mage::getModel('neklo_blog/category');
            $model->load($categoryId);

            if($model->getId()){
                $this->_newsCollection->addFieldToFilter('category' , $categoryId);
            }

        }

        return $this->_newsCollection;
    }

    /**
     * Return URL to item's view page
     *
     * @param Neklo_Blog_Model_Resource_News $newsItem
     * @return string
     */

    public function getItemUrl($newsItem)
    {

        if($newsItem->getIdentifierUrl()){
            return $this->getUrl($newsItem->getIdentifierUrl());
        } else {
            return $this->getUrl('*/*/view', array('id' => $newsItem->getId()));
        }

    }

    /**
     * Fetch  the current page for the news list
     *
     * @return int
     */

    public function getCurrentPage()
    {
        return abs(intval(Mage::app()->getRequest()->getParam('p', 1)));
    }

    /**
     * Get a pager
     *
     * @return string|null
     */

    public function getPager()
    {
        $pager = $this->getChild('news_list_pager');
        if ($pager) {
            $newsPerPage = Mage::helper('neklo_blog/config')->getNewsPerPage();
            $pager->setAvailableLimit(array($newsPerPage => $newsPerPage));
            $pager->setTotalNum($this->getCollection()->getSize());
            $pager->setCollection($this->getCollection());
            $pager->setShowPerPage(true);
            return $pager->toHtml();
        }
        return null;
    }

    /**
     * Return URL category
     *
     * @param $newsItem
     * @return string
     */

    public function getItemUrlCategory($newsItem)
    {
        return $this->getUrl('*/*/category', array('id' => $newsItem->getCategory()));
    }

    /**
     * Category on the list
     *
     * @param $categoryId
     * @return mixed
     */

    public function getItemCategory($categoryId)
    {
        $model = Mage::getModel('neklo_blog/category');

        if ($categoryId) {

            $model->load($categoryId);

            return $model->getTitle();
        }

    }

    /**
     * Get count like
     *
     * @return mixed
     */


    public function getCountLike($newsId)
    {

        $modelCount = Mage::getModel('neklo_blog/like')->getCollection()->addFieldToFilter('news_id', $newsId);

        $modelCount->getSelect();

        if ($modelCount->getSize()) {

            return $modelCount->getSize();

        }

    }

}