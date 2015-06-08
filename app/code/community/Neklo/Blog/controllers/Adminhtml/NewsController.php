<?php

/**
 * News controller
 */

class Neklo_Blog_Adminhtml_NewsController extends Mage_Adminhtml_Controller_Action
{

    /**
     * Instance news model
     *
     * @param string $idFieldName
     * @return $this
     */

    protected function _initNewsAdmin($idFieldName = 'id')
    {
        $newsId = (int) $this->getRequest()->getParam($idFieldName);
        $model = Mage::getModel('neklo_blog/news');

        if ($newsId) {
            $model->load($newsId);
        }

        Mage::register('manage_news', $model);
        return $this;
    }

    /**
     * Init actions
     *
     * @return Neklo_Blog_Adminhtml_NewsController
     */

    protected function _initAction()
    {

        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('news/manage')
            ->_addBreadcrumb(
                Mage::helper('neklo_blog/config')->__('News'),
                Mage::helper('neklo_blog/config')->__('News')
            )
            ->_addBreadcrumb(
                Mage::helper('neklo_blog/config')->__('Manage News'),
                Mage::helper('neklo_blog/config')->__('Manage News')
            );

        return $this;

    }

    /**
     * Index action
     */

    public function indexAction()
    {

        $this->_title($this->__('News'))
             ->_title($this->__('Manage News'));
        $this->_initAction();
        $this->renderLayout();

    }

    /**
     * Create new News item
     */

    public function newAction()
    {

        // the same form is used to create and edit
        $this->_forward('edit');

    }

    /**
     * Edit News item
     */

    public function editAction()
    {
        $this->_title($this->__('News'))
             ->_title($this->__('Manage News'));

        $this->_initNewsAdmin();
        $model = Mage::registry('manage_news');

        // if exists id, check it and load data
        $newsId = $this->getRequest()->getParam('id');

        if ($newsId) {

            $model->load($newsId);

            if (!$model->getId()) {
                $this->_getSession()->addError(
                    Mage::helper('neklo_blog/config')->__('News item does not exist.')
                );
                return $this->_redirect('*/*/');
            }

            // prepare title
            $this->_title($model->getTitle());
            $breadCrumb = Mage::helper('neklo_blog/config')->__('Edit Item');

        } else {

            $this->_title(Mage::helper('neklo_blog/config')->__('New Item'));
            $breadCrumb = Mage::helper('neklo_blog/config')->__('New Item');

        }

        // Init breadcrumbs
        $this->_initAction()->_addBreadcrumb($breadCrumb, $breadCrumb);

        //  Set entered data if was error when we do save
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);

        if (!empty($data)) {
            $model->addData($data);
        }

        // 4. Register model to use later in blocks
        Mage::register('news_item', $model);

        // 5. render layout
        $this->renderLayout();

    }

    /**
     * Save action
     */

    public function saveAction()
    {
        $redirectPath = '*/*';

        $redirectParams = array();

        // check if data sent
        $data = $this->getRequest()->getPost();

        if ($data) {

            $data = $this->_filterPostData($data);

            // init model and set data
            /* @var $model Neklo_Blog_Model_News */
            $model = Mage::getModel('neklo_blog/news');

            // if news item exists, try to load it
            $newsId = $this->getRequest()->getParam('entity_id');

            if ($newsId) {

                $model->load($newsId);

            }


            $model->addData($data);

            try {

                $hasError = false;

                // save the data
                $model->save();

                // display success message
                $this->_getSession()->addSuccess(

                    Mage::helper('neklo_blog/config')->__('The news item has been saved.')

                );

                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {

                    $redirectPath = '*/*/edit';
                    $redirectParams = array('id' => $model->getId());

                }
            } catch (Mage_Core_Exception $e) {

                $hasError = true;

                $this->_getSession()->addError($e->getMessage());

            } catch (Exception $e) {

                $hasError = true;

                $this->_getSession()->addException($e,
                    Mage::helper('neklo_blog/config')->__('An error occurred while saving the news item.')
                );

            }
            if ($hasError) {

                $this->_getSession()->setFormData($data);

                $redirectPath = '*/*/edit';

                $redirectParams = array('id' => $this->getRequest()->getParam('id'));

            }
        }
        $this->_redirect($redirectPath, $redirectParams);
    }

    /**
     * Delete action
     */

    public function deleteAction()
    {

        $this->_initNewsAdmin();

        // check if we know what should be deleted
        $itemId = $this->getRequest()->getParam('id');

        if ($itemId) {

            try {

                // init model and delete
                $model = Mage::registry('manage_news');

                $model->load($itemId);

                if (!$model->getId()) {

                    Mage::throwException(Mage::helper('neklo_blog/config')->__('Unable to find a news item.'));

                }

                $model->delete();

                // display success message
                $this->_getSession()->addSuccess(

                    Mage::helper('neklo_blog/config')->__('The news item has been deleted.')

                );
            } catch (Mage_Core_Exception $e) {

                $this->_getSession()->addError($e->getMessage());

            } catch (Exception $e) {

                $this->_getSession()->addException($e,

                    Mage::helper('neklo_blog/config')->__('An error occurred while deleting the news item.')

                );

            }

        }

        // go to grid
        $this->_redirect('*/*/');

    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */

    protected function _isAllowed()
    {

        switch ($this->getRequest()->getActionName()) {

            case 'new':
            case 'save':
                return Mage::getSingleton('admin/session')->isAllowed('news/manage/save');
                break;

            case 'delete':
                return Mage::getSingleton('admin/session')->isAllowed('news/manage/delete');
                break;

            default:
                return Mage::getSingleton('admin/session')->isAllowed('news/manage');
                break;

        }

    }

    /**
     * Filtering posted data. Converting localized data if needed
     *
     * @param array
     * @return array
     */

    protected function _filterPostData($data)
    {

        $data = $this->_filterDates($data, array('time_published'));
        return $data;

    }

    /**
     * Grid ajax action
     */

    public function gridAction()
    {

        $this->loadLayout();
        $this->renderLayout();

    }


}