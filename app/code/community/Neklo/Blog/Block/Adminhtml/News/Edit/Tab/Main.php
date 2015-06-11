<?php

/**
 * News List admin edit form main tab
 */

class Neklo_Blog_Block_Adminhtml_News_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    /**
     * Prepare form elements for tab
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

        $_menus = Mage::getSingleton('neklo_blog/category')->getCollection();
        foreach($_menus as $item)
        {
            if($item->getParent == NULL){
                $_menuItems[] = array(
                    'value'     => $item->getId(),
                    'label'     => $item->getTitle(),
                );
            }
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('news_main_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('neklo_blog/config')->__('News Item Info')
        ));

        if ($model->getId()) {
            $fieldset->addField('entity_id', 'hidden', array(
                'name' => 'entity_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'     => 'title',
            'label'    => Mage::helper('neklo_blog/config')->__('News Title'),
            'title'    => Mage::helper('neklo_blog/config')->__('News Title'),
            'required' => true,
            'disabled' => $isElementDisabled
        ));

        $fieldset->addField('identifier_url', 'text', array(
            'name'     => 'identifier_url',
            'label'    => Mage::helper('neklo_blog/config')->__('News Url'),
            'title'    => Mage::helper('neklo_blog/config')->__('News Url'),
            'required' => true,
            'disabled' => $isElementDisabled
        ));


        $fieldset->addField('author', 'text', array(
            'name'     => 'author',
            'label'    => Mage::helper('neklo_blog/config')->__('Author'),
            'title'    => Mage::helper('neklo_blog/config')->__('Author'),
            'required' => true,
            'disabled' => $isElementDisabled
        ));

        $fieldset->addField('published_at', 'date', array(
            'name'     => 'published_at',
            'format'   => Varien_Date::DATE_INTERNAL_FORMAT,
            'image'    => $this->getSkinUrl('images/grid-cal.gif'),
            'label'    => Mage::helper('neklo_blog/config')->__('Publishing Date'),
            'title'    => Mage::helper('neklo_blog/config')->__('Publishing Date'),
            'required' => true
        ));

        $fieldset->addField('category', 'select', array(
            'name'      => 'category',
            'label'     => Mage::helper('neklo_blog/config')->__('Category'),
            'title'     => Mage::helper('neklo_blog/config')->__('Category'),
            'required'  => true,
            'disabled' => $isElementDisabled,
            'class'     => 'HideIt',
            'values'    => $_menuItems,
        ));

        Mage::dispatchEvent('adminhtml_news_edit_tab_main_prepare_form', array('form' => $form));
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();

    }

    /**
     * Prepare label for tab
     *
     * @return string
     */

    public function getTabLabel()
    {
        return Mage::helper('neklo_blog/config')->__('News Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */

    public function getTabTitle()
    {
        return Mage::helper('neklo_blog/config')->__('News Info');
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