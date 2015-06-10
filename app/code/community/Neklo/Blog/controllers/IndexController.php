<?php

/**
 * Class Neklo_Blog_IndexController
 */

class Neklo_Blog_IndexController extends Mage_Core_Controller_Front_Action
{

    /**
     * Object initialization
     *
     * @param string $idFieldName
     * @return $this
     */

    protected function _initNews($idFieldName = 'id')
    {
        $newsId = (int) $this->getRequest()->getParam($idFieldName);
        $model = Mage::getModel('neklo_blog/news');

        if ($newsId) {
            $model->load($newsId);
        }

        Mage::register('news_item', $model);
        return $this;
    }

    /**
     * Object initialization category
     *
     * @param string $idFieldName
     * @return $this
     */

    protected function _initNewsCategory($idFieldName = 'id')
    {
        $categoryId = (int) $this->getRequest()->getParam($idFieldName);
        $model = Mage::getModel('neklo_blog/category');

        if ($categoryId) {
            $model->load($categoryId);
        }

        Mage::register('news_category', $model);
        return $this;
    }

    /**
     * Pre dispatch action that allows to redirect to no route page in case of disabled extension through admin panel
     */

    public function preDispatch()
    {
        parent::preDispatch();

        if(!Mage::helper('neklo_blog/config')->isEnabled()){

            $this->setFlag('','no-dispatch', true);
            $this->_redirect('noRoute');

        }

    }

    /**
     * Index action
     */

    public function indexAction()
    {
        $this->loadLayout();

        $listBlock = $this->getLayout()->getBlock('news.list');

        if($listBlock){

            $listBlock->setCurrentPage($listBlock->getCurrentPage());

        }

        $this->renderLayout();
    }

    /**
     * News view action
     */

    public function viewAction()
    {

        $this->_initNews();
        $model = Mage::registry('news_item');

        if (!$model->getId()) {
            return $this->_forward('noRoute');
        }

        if (Neklo_Blog_Model_News::isNew($model->getCreatedAt())) {
            Mage::getSingleton('core/session')->addSuccess(Mage::helper('neklo_blog/config')->__('Recently added'));
        }

        Mage::dispatchEvent('before_news_item_display', array('news_item' => $model));
        $this->loadLayout();

        $itemBlock = $this->getLayout()->getBlock('news.item');
        if ($itemBlock) {

            // add breadcrumbs
            if ($breadcrumbsBlock = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbsBlock->addCrumb('home', array(
                    'label'    => $this->__('Home'),
                    'title'    => $this->__('Home'),
                    'link'     => Mage::getBaseUrl(),
                ));
                $breadcrumbsBlock->addCrumb('news', array('label'=>$model->getTitle(), 'title'=>$model->getTitle()));
            }

            $listBlock = $this->getLayout()->getBlock('news.list');

            if ($listBlock) {
               $page = $listBlock->getCurrentPage();
            } else {
               $page = 1;
            }

            $itemBlock->setPage($page);

        }

        $this->renderLayout();

    }

    /**
     * Index category action
     */

    public function categoryAction()
    {

        $categoryId = $this->getRequest()->getParam('id');

        $model = Mage::getModel('neklo_blog/category');
        $model->load($categoryId);

        if(!$model->getId()){
            return $this->_forward('noRoute');
        }


        $this->loadLayout();

        $listBlock = $this->getLayout()->getBlock('news.list');

        if($listBlock){

            $listBlock->setCurrentPage($listBlock->getCurrentPage());

        }

        $this->renderLayout();


    }


}