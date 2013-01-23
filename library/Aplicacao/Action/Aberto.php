<?php
class Aplicacao_Action_Aberto extends Zend_Controller_Action {

    /**
     * @param  string $tipo
     * @param  string $mensagem
     * @return void
     */
    protected function _mensagem($tipo, $mensagens) {
        $session = new Zend_Session_Namespace ( 'app-message' );
        if (! isset ( $session->mensagens )) {
            $session->mensagens = array ();
        }

        foreach ( ( array ) $mensagens as $mensagem ) {
            $session->mensagens [] = array ($tipo, trim ( $mensagem ) );
        }
    }

}
