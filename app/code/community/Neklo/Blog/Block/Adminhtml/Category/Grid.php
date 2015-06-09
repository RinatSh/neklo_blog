<?php

/**
 * Category List admin grid
 */

class Neklo_Blog_Block_Adminhtml_Category_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Init Grid default properties
     */

    public function __construct()
    {
        parent::__construct();
        $this->setId('category_list_grid');
        $this->setDefaultSort('category_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * Prepare collection for Grid
     *
     * @return Neklo_Blog_Block_Adminhtml_Category_Grid
     */

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('neklo_blog/category')->getResourceCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * Prepare Grid columns
     *
     * @return Mage_Adminhtml_Block_Catalog_Search_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('category_id', array(
            'header'    => Mage::helper('neklo_blog/config')->__('ID'),
            'width'     => '50px',
            'index'     => 'category_id',
        ));
        $this->addColumn('title', array(
            'header'    => Mage::helper('neklo_blog/config')->__('Category Title'),
            'index'     => 'title',
        ));
        $this->addColumn('url_key', array(
            'header'    => Mage::helper('neklo_blog/config')->__('Url Key'),
            'index'     => 'url_key',
        ));
        $this->addColumn('sort_order', array(
            'header'   => Mage::helper('neklo_blog/config')->__('Sort Order'),
            'sortable' => true,
            'width'    => '170px',
            'index'    => 'sort_order',
        ));

        $this->addColumn('action',
            array(
                'header'    => Mage::helper('neklo_blog/config')->__('Action'),
                'width'     => '100px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(array(
                    'caption' => Mage::helper('neklo_blog/config')->__('Edit'),
                    'url'     => array('base' => '*/*/edit'),
                    'field'   => 'id'
                )),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'category',
            ));
        return parent::_prepareColumns();
    }

    /**
     * Return row URL for js event handlers
     *
     * @return string
     */

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * Grid url getter
     *
     * @return string current grid url
     */

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }



}