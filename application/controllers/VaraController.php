<?php

class VaraController extends Aplicacao_Action_Seguro
{

    public function formAction()
    {

        $modelVara  = new Application_Model_DbTable_Vara();
        $modelComarca= new Application_Model_DbTable_Comarca();
        $dados = $this->_getAllParams();
        $id_vara = $this->_getParam("ID_VARA");

        if ( $id_vara )
            $vara = $modelVara->find( $id_vara )->current();
        else
            $vara           = $modelVara->createRow();

        if ( $this->_request->isPost() ){
            $vara->setFromArray($dados);
            $vara->ST_ATIVO = 1;

            try {
                $vara->save();
                $this->_mensagem("ok", "Salvo com sucesso!");
                $this->_redirect("vara/index");
            } catch (Exception $e) {
                $this->_mensagem("error", "Algo inesperado ocorreu e registro não foi Salvo");
                $this->_redirect("vara/index");
            }
        }

        $this->view->vara = $vara;
        $this->view->comarcas = array( ""  => "Selecione" ) + $modelComarca->fetchPairs("ID_COMARCA", "CODIGO");


    }

    public function indexAction(){
        $modelVara  = new Application_Model_DbTable_Vara();
        $this->view->vara = $modelVara->getVara();
    }


    public function deletarAction(){
        $modelVara = new Application_Model_DbTable_Vara();
        $id  = $this->_getParam("ID_VARA");

        $vara = $modelVara->find( $id )->current();
        $vara->ST_ATIVO = 0;

        try {
            $vara->save();
            $this->_mensagem("ok", "Comarca excluída com sucesso!");
            $this->_redirect("vara/index");
        } catch (Exception $e) {
            $this->_mensagem("error", "Algo inesperado ocorreu e registro não foi apagado");
            $this->_redirect("vara/index");
        }
    }

}

