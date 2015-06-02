<?php

/** News List admin edit form image tab */

class Neklo_Blog_Block_Adminhtml_News_Edit_Tab_Image
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    /**
     * Prepare form elements
     * @return Mage_Adminhtml_Block_Widget_Form
     */

    protected function _prepareForm()
    {

        /** Checking if user have permissions to save information */

        if (Mage::helper('neklo_blog/admin')->isActionAllowed('save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('news_image_');
        $model = Mage::helper('neklo_blog')->getNewsItemInstance();
        $fieldset = $form->addFieldset('image_fieldset', array(
            'legend' => Mage::helper('neklo_blog')->__('Image Thumbnail'), 'class' => 'fieldset-wide'
        ));

        $this->_addElementTypes($fieldset);
        $fieldset->addField('image', 'image', array(
            'name' => 'image',
            'label' => Mage::helper('neklo_blog')->__('Image'),
            'title' => Mage::helper('neklo_blog')->__('Image'),
            'required' => false,
            'disabled' => $isElementDisabled
        ));

        Mage::dispatchEvent('adminhtml_news_edit_tab_image_prepare_form', array('form' => $form));
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();

    }

    /**
     * Prepare label for tab
     * @return string
     */

    public function getTabLabel()
    {
        return Mage::helper('neklo_blog')->__('Image Thumbnail');
    }

    /**
     * Prepare title for tab
     * @return string
     */

    public function getTabTitle()
    {
        return Mage::helper('neklo_blog')->__('Image Thumbnail');
    }

    /**
     * Returns status flag about this tab can be showen or not
     * @return true
     */

    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     * @return true
     */

    public function isHidden()
    {
        return false;
    }

    /**
     * Retrieve predefined additional element types
     * @return array
     */

    protected function _getAdditionalElementTypes()
    {
        return array(
            'image' => Mage::getConfig()->getBlockClassName('neklo_blog/adminhtml_news_edit_form_element_image')
        );
    }

}