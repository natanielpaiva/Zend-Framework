<?php
class AuthController extends Aplicacao_Action_Aberto
{

    public function init()
    {
    }

    public function indexAction()
    {
        return $this->_helper->redirector('login');
    }

    public function loginAction()
    {
        $this->_helper->_layout->setLayout('layout-login');
        //Verifica se existem dados de POST
        if ( $this->getRequest()->isPost() ) {
            $data = $this->getRequest()->getPost();
            //Formulário corretamente preenchido?
                $login = $this->_getParam("txtUsuario");
                $senha = $this->_getParam("txtSenha");

                try {
                    $authLogin = new Application_Model_Auth();
                    $authLogin->login($login, $senha);
                    //Redireciona para o Controller protegido
                    return $this->_redirect("admin");
                } catch (Exception $e) {
                    //Dados inválidos
                    $this->_mensagem("error", "error ao tentar logar");
                    $this->_redirect('/auth/login');
                }
        }
    }

    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        Zend_Session::destroy("Zend_Auth");
        return $this->_helper->redirector('index');
    }
}