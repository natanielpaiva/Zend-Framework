<?php
class AlertaController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
        $this->_helper->viewRenderer->setNoRender();
        echo "Você não tem permissão para acessar essa página!";
    }

}