<?php

/**
 * News Item block
 */

class Neklo_Blog_Block_Item extends Mage_Core_Block_Template
{
    /**
     * Current news item instance
     *
     * @var Neklo_Blog_Model_News
     */

    protected $_item;

    /**
     * Return parameters for back url
     *
     * @param array $additionalParams
     * @return array
     */

    protected function _getBackUrlQueryParams($additionalParams = array())
    {
        return array_merge(array('p' => $this->getPage()), $additionalParams);
    }

    /**
     * Return URL to the news list page
     *
     * @return string
     */

    public function getBackUrl()
    {
        return $this->getUrl('*/', array('_query' => $this->_getBackUrlQueryParams()));
    }

    /**
     * Return URL for resized News Item image
     *
     * @param Neklo_Blog_Model_News $item
     * @param integer $width
     * @return string|false
     */

    public function getImageUrl($item, $width)
    {
        return Mage::helper('neklo_blog/image')->resize($item, $width);
    }

}