<?php
class Application_Model_Auth
{
    public function login($login, $senha)
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        //Inicia o adaptador Zend_Auth para banco de dados
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
        $authAdapter->setTableName('TB_USUARIO')
                    ->setIdentityColumn('USUARIO')
                    ->setCredentialColumn('SENHA');
        //Define os dados para processar o login
        $authAdapter->setIdentity($login)
                    ->setCredential($senha);
        //Faz inner join dos dados do perfil no SELECT do Auth_Adapter
        $select = $authAdapter->getDbSelect();
        $select->join( array('p' => 'TB_PERFIL'), 'p.ID_PERFIL = TB_USUARIO.ID_PERFIL', array('nome_perfil' => 'p.NO_PERFIL') );
        //Efetua o login
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($authAdapter);
        //Verifica se o login foi efetuado com sucesso
        if ( $result->isValid() ) {
            //Recupera o objeto do usuário, sem a senha
            $info = $authAdapter->getResultRowObject(null, 'SENHA');

            $storage = $auth->getStorage();
            $storage->write($info);


            return true;
        }
        throw new Exception('Nome de usuário ou senha inválida');
    }

}