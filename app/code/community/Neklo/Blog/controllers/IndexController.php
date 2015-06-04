<?php

/**
 * Class Neklo_Blog_IndexController
 */

class Neklo_Blog_IndexController extends Mage_Core_Controller_Front_Action
{

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

            $currentPage = abs(intval($this->getRequest()->getParam('p')));

            if($currentPage < 1){

                $currentPage = 1;

            }

            $listBlock->setCurrentPage($currentPage);

        }

        $this->renderLayout();
    }

    /**
     * News view action
     */

    public function viewAction()
    {
        $newsId = $this->getRequest()->getParam('id');

        if (!$newsId) {

            return $this->_forward('noRoute');

        }

        /** @var  $model Neklo_Blog_Model_News */
        $model = Mage::getModel('neklo_blog/news');

        $model->load($newsId);

        if (!$model->getId()) {

            return $this->_forward('noRoute');

        }

        Mage::register('news_item', $model);

        Mage::dispatchEvent('before_news_item_display', array('news_item' => $model));

        $this->loadLayout();

        $itemBlock = $this->getLayout()->getBlock('news.item');

        if ($itemBlock) {

            $listBlock = $this->getLayout()->getBlock('news.list');

            if ($listBlock) {

                $page = (int)$listBlock->getCurrentPage() ? (int)$listBlock->getCurrentPage() : 1;

            } else {

                $page = 1;

            }

            $itemBlock->setPage($page);

        }

        $this->renderLayout();

    }

}