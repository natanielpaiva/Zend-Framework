<?php
class Aplicacao_Acl_Setup
{
    /**
     * @var Zend_Acl
     */
    protected $_acl;

    public function __construct()
    {
        $this->_acl = new Zend_Acl();
        $this->_initialize();
    }

    protected function _initialize()
    {
        $this->_setupRoles();
        $this->_setupResources();
        $this->_setupPrivileges();
        $this->_saveAcl();
    }

    protected function _setupRoles()
    {
        $this->_acl->addRole( new Zend_Acl_Role('ADMINISTRADOR') );
    }

    protected function _setupResources()
    {
        $this->_acl->addResource( new Zend_Acl_Resource('admin') );
        $this->_acl->addResource( new Zend_Acl_Resource('auth') );
        $this->_acl->addResource( new Zend_Acl_Resource('index') );
        $this->_acl->addResource( new Zend_Acl_Resource('vara') );
        $this->_acl->addResource( new Zend_Acl_Resource('comarca') );
        $this->_acl->addResource( new Zend_Acl_Resource('acao') );
    }

    protected function _setupPrivileges()
    {
        $this->_acl->allow( 'ADMINISTRADOR', 'admin', array('index', 'delete') )
                   ->allow( 'ADMINISTRADOR', 'auth', array( 'logout' ) )
                   ;

        $this->_acl->allow( 'ADMINISTRADOR', 'vara', array('index', 'form', 'deletar') );
        $this->_acl->allow( 'ADMINISTRADOR', 'comarca', array('index', 'form', 'deletar') );
        $this->_acl->allow( 'ADMINISTRADOR', 'acao', array('index', 'form', 'deletar') );


    }

    protected function _saveAcl()
    {
        $registry = Zend_Registry::getInstance();
        $registry->set('acl', $this->_acl);
    }
}