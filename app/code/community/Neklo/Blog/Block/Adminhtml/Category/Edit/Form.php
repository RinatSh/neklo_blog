<?php

/**
 * News category List admin edit form block
 */

class Neklo_Blog_Block_Adminhtml_Category_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Prepare form action
     *
     * @return Neklo_Blog_Block_Adminhtml_Category_Edit_Form
     */

    protected function _prepareForm()
    {
        $model = Mage::helper('neklo_blog/config')->getNewsCategoryInstance();
        /**
         * Checking if user have permission to save information
         */
        if(Mage::helper('neklo_blog/admin')->isActionAllowed('category', 'save')){
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save'),
            'method'    => 'post',
            'enctype'   => 'multipart/form-data'
        ));
        $form->setUseContainer(true);
        $form->setHtmlIdPrefix('news_category_');
        $fieldset = $form->addFieldset('base_fieldset', array(
                'legend' => Mage::helper('neklo_blog/config')->__('News Category')
            )
        );
        if($model->getId()){
            $fieldset->addField('category_id', 'hidden', array(
                'name' => 'category_id',
            ));
        }
        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('neklo_blog/config')->__('Category Name'),
            'title'     => Mage::helper('neklo_blog/config')->__('Category Name'),
            'required'  => true,
            'disabled'  => $isElementDisabled
        ));

        $fieldset->addField('url_key', 'text', array(
            'name'      => 'url_key',
            'label'     => Mage::helper('neklo_blog/config')->__('Category Name'),
            'title'     => Mage::helper('neklo_blog/config')->__('Category Name'),
            'required'  => true,
            'disabled'  => $isElementDisabled
        ));

        $fieldset->addField('sort_order', 'text', array(
            'name'      => 'sort_order',
            'label'     => Mage::helper('neklo_blog/config')->__('Sort Order'),
            'title'     => Mage::helper('neklo_blog/config')->__('Sort Order'),
            'required'  => true,
            'disabled'  => $isElementDisabled
        ));

        $fieldset->addField('meta_keywords', 'text', array(
            'name'      => 'meta_keywords',
            'label'     => Mage::helper('neklo_blog/config')->__('Meta Keywords'),
            'title'     => Mage::helper('neklo_blog/config')->__('Meta Keywords'),
            'required'  => true,
            'disabled'  => $isElementDisabled
        ));

        $fieldset->addField('meta_description', 'text', array(
            'name'      => 'meta_description',
            'label'     => Mage::helper('neklo_blog/config')->__('Meta Description'),
            'title'     => Mage::helper('neklo_blog/config')->__('Meta Description'),
            'required'  => true,
            'disabled'  => $isElementDisabled
        ));

        $this->setForm($form);
        $form->setValues($model->getData());
        return parent::_prepareForm();
    }


    protected function _getLinkedNewsIds()
    {
        $linked = array();
        if($categoryId = $this->_getCategory()->getId()) {
            $linked = Mage::getModel('neklo_blog/category')
                ->getLinkedNewsIds($categoryId);
        }
        return $linked;
    }

}