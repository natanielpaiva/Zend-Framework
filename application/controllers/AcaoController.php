<?php

class AcaoController extends Aplicacao_Action_Seguro
{

    public function formAction()
    {

        $modelAcao  = new Application_Model_DbTable_Acao();
        $dados = $this->_getAllParams();
        $id_acao = $this->_getParam("ID_ACAO");

        if ( $id_acao )
            $acao = $modelAcao->find( $id_acao )->current();
        else
            $acao           = $modelAcao->createRow();

        if ( $this->_request->isPost() ){
            $acao->setFromArray($dados);
            $acao->ST_ATIVO = 1;

            try {
                $acao->save();
                $this->_mensagem("ok", "Salvo com sucesso!");
                $this->_redirect("acao/index");
            } catch (Exception $e) {
                $this->_mensagem("error", "Algo inesperado ocorreu e registro não foi Salvo");
                $this->_redirect("acao/index");
            }
        }

        $this->view->acao = $acao;

    }

    public function indexAction(){
        $modelAcao  = new Application_Model_DbTable_Acao();
        $this->view->acao = $modelAcao->fetchAll("ST_ATIVO = 1");
    }


    public function deletarAction(){
        $modelAcao = new Application_Model_DbTable_Acao();
        $id  = $this->_getParam("ID_ACAO");

        $acao = $modelAcao->find( $id )->current();
        $acao->ST_ATIVO = 0;

        try {
            $acao->save();
            $this->_mensagem("ok", "Ação excluída com sucesso!");
            $this->_redirect("acao/index");
        } catch (Exception $e) {
            $this->_mensagem("error", "Algo inesperado ocorreu e registro não foi apagado");
            $this->_redirect("acao/index");
        }
    }

}

