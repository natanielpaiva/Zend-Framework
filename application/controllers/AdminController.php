<?php
class AdminController extends Aplicacao_Action_Seguro
{

    public function indexAction()
    {
        $this->_helper->viewRenderer->setNoRender();

        echo "index do admin";
    }

    public function addAdminAction(){

        $this->_helper->viewRenderer->setNoRender();

        echo "add admin";
    }

    public function deleteAction(){

        $this->_helper->viewRenderer->setNoRender();

        echo "delete";
    }



}