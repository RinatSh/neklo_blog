<?php

/**
 * Class Neklo_Blog_CustomerController
 */

class Neklo_Blog_CustomerController extends Mage_Core_Controller_Front_Action
{

    /**
     * Index customer action
     */

    public function indexAction()
    {
        if (!Mage::getSingleton('customer/session')->isLoggedIn()) {

            $this->_redirect('customer/account/login');
            return;

        }

        $this->loadLayout();
        $this->renderLayout();
    }

}