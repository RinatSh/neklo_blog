<?php

/**
 * News List admin edit form short content tab
 */

class Neklo_Blog_Block_Adminhtml_News_Edit_Tab_Short
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    /**
     * Load WYSIWYG on demand and prepare layout
     *
     * @return Neklo_Blog_Block_Adminhtml_News_Edit_Tab_Short
     */

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        return $this;
    }

    /**
     * Prepares tab form
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */

    protected function _prepareForm()
    {
        $model = Mage::helper('neklo_blog/config')->getNewsItemInstance();

        // Checking if user have permissions to save information

        if (Mage::helper('neklo_blog/admin')->isActionAllowed('save')) {

            $isElementDisabled = false;

        } else {

            $isElementDisabled = true;

        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('news_short_');

        $fieldset = $form->addFieldset('short_fieldset', array(
            'legend' => Mage::helper('neklo_blog/config')->__('Short Content'),
            'class'  => 'fieldset-wide'
        ));

        $wysiwygConfig = Mage::getSingleton('cms/wysiwyg_config')->getConfig(array(
            'tab_id' => $this->getTabId()
        ));

        $contentField = $fieldset->addField('short', 'editor', array(
            'name'     => 'short',
            'style'    => 'height:36em;',
            'required' => true,
            'disabled' => $isElementDisabled,
            'config'   => $wysiwygConfig
        ));

        // Setting custom renderer for short field to remove label column
        $renderer = $this->getLayout()->createBlock('adminhtml/widget_form_renderer_fieldset_element')
            ->setTemplate('cms/page/edit/form/renderer/content.phtml');
        $contentField->setRenderer($renderer);
        $form->setValues($model->getData());
        $this->setForm($form);
        Mage::dispatchEvent('adminhtml_news_edit_tab_short_prepare_form', array('form' => $form));
        return parent::_prepareForm();

    }

    /**
     * Prepare label for tab
     *
     * @return string
     */

    public function getTabLabel()
    {
        return Mage::helper('neklo_blog/config')->__('Short Content');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */

    public function getTabTitle()
    {
        return Mage::helper('neklo_blog/config')->__('Short Content');
    }

    /**
     * Returns status flag about this tab can be shown or not
     *
     * @return true
     */

    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */

    public function isHidden()
    {
        return false;
    }

}