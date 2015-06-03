<?php

/**
 * Custom image form element that generates correct thumbnail image URL
 */

class Neklo_Blog_Block_Adminhtml_News_Edit_Form_Element_Image extends Varien_Data_Form_Element_Image
{

    /**
     * Get image preview url
     *
     * @return string
     */

    protected function _getUrl()
    {
        $url = false;
        if ($this->getValue()) {
            $url = Mage::helper('neklo_blog/image')->getBaseUrl() . '/' . $this->getValue();
        }
        return $url;
    }

}