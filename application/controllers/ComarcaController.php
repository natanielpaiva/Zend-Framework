<?php

class ComarcaController extends Aplicacao_Action_Seguro
{

    public function formAction()
    {

        $modelComarca  = new Application_Model_DbTable_Comarca();
        $dados = $this->_getAllParams();
        $id_comarca = $this->_getParam("ID_COMARCA");

        if ( $id_comarca )
            $comarca = $modelComarca->find( $id_comarca )->current();
        else
            $comarca           = $modelComarca->createRow();

        if ( $this->_request->isPost() ){
            $comarca->setFromArray($dados);
            $comarca->ST_ATIVO = 1;

            try {
                $comarca->save();
                $this->_mensagem("ok", "Salvo com sucesso!");
                $this->_redirect("comarca/index");
            } catch (Exception $e) {
                $this->_mensagem("error", "Algo inesperado ocorreu e registro não foi Salvo");
                $this->_redirect("comarca/index");
            }
        }

        $this->view->comarca = $comarca;

    }

    public function indexAction(){
        $modelComarca  = new Application_Model_DbTable_Comarca();
        $this->view->comarca = $modelComarca->fetchAll("ST_ATIVO = 1");
    }


    public function deletarAction(){
        $modelComarca = new Application_Model_DbTable_Comarca();
        $id  = $this->_getParam("ID_COMARCA");

        $comarca = $modelComarca->find( $id )->current();
        $comarca->ST_ATIVO = 0;

        try {
            $comarca->save();
            $this->_mensagem("ok", "Comarca excluída com sucesso!");
            $this->_redirect("comarca/index");
        } catch (Exception $e) {
            $this->_mensagem("error", "Algo inesperado ocorreu e registro não foi apagado");
            $this->_redirect("comarca/index");
        }
    }

}

