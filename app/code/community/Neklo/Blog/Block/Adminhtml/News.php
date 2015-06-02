<?php

/**
 * News List admin grid container
 */
class Neklo_Blog_Block_Adminhtml_News extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    /**
     * Block constructor
     */

    public function __construct()
    {
        $this->_blockGroup = 'neklo_blog';
        $this->_controller = 'adminhtml_news';
        $this->_headerText = Mage::helper('neklo_blog')->__('Manage News');
        parent::__construct();
        if (Mage::helper('neklo_blog/admin')->isActionAllowed('save')) {
            $this->_updateButton('add', 'label', Mage::helper('neklo_blog')->__('Add New News'));
        } else {
            $this->_removeButton('add');
        }
        $this->addButton(
            'news_flush_images_cache',
            array(
                'label' => Mage::helper('neklo_blog')->__('Flush Images Cache'),
                'onclick' => 'setLocation(\'' . $this->getUrl('*/*/flush') . '\')',
            )
        );
    }

}