<?php
class Aplicacao_Action_Seguro extends Aplicacao_Action_Aberto  {

    /**
     * @var Zend_Auth
     */
    protected $_auth = null;
    /**
     * @var Zend_Acl
     */
    protected $_acl = null;
    /**
     * @var array
     */
    protected $_notLoggedRoute = array(
            'controller' => 'auth',
            'action'     => 'login',
            'module'     => 'default'
    );
    /**
     * @var array
     */
    protected $_forbiddenRoute = array(
            'controller' => 'alerta',
            'action'     => 'index',
            'module'     => 'default'
    );

    public function init(){
        $aclSetup = new Aplicacao_Acl_Setup();
        $this->_auth = Zend_Auth::getInstance();
        $this->_acl = Zend_Registry::get('acl');

        $request = $this->_request;

        $controller = "";
        $action     = "";
        $module     = "";
        if ( !$this->_auth->hasIdentity() ) {

            $controller = $this->_notLoggedRoute['controller'];
            $action     = $this->_notLoggedRoute['action'];
            $module     = $this->_notLoggedRoute['module'];
            $this->_redirect("{$controller}/$action");
        } else if ( !$this->_isAuthorized($request->getControllerName(),
                $request->getActionName()) ) {

            $controller = $this->_forbiddenRoute['controller'];
            $action     = $this->_forbiddenRoute['action'];
            $module     = $this->_forbiddenRoute['module'];
            $this->_redirect("{$controller}/$action");
        }


    }

    protected function _isAuthorized($controller, $action)
    {
        $this->_acl = Zend_Registry::get('acl');

        if ( !$this->_acl->has( $controller ) || !$this->_acl->isAllowed( Zend_Auth::getInstance()->getIdentity()->nome_perfil, $controller, $action ) )
            return false;
        return true;
    }

}
