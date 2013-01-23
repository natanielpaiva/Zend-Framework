<?php
class AbertaController extends Aplicacao_Action_Aberto
{

    public function indexAction()
    {
        $this->_helper->viewRenderer->setNoRender();

        echo "index do aberta";
    }

    public function addAdminAction(){

        $this->_helper->viewRenderer->setNoRender();

        echo "add aberta";
    }

    public function deleteAction(){

        $this->_helper->viewRenderer->setNoRender();

        echo "delete";
    }



}