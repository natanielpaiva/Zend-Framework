<?php

class Application_Model_DbTable_Perfil extends Zend_Db_Table_Abstract
{
    protected $_name = 'perfil';
    protected $_primary = 'id';

    public function fetchPairs($chave, $valor, $where = null, $ordem = null, $limit = null)
    {
        if ( empty($chave) ) {
            $chave = $this->_primary;
        }
        $select = $this->_db
        ->select()
        ->from($this->_name, array($chave, $valor))
        ->order($ordem ? $ordem : $valor);
        if ($where) {
            $select->where($where);
        }

        if( is_numeric( $limit ) ){
            $select->limit( $limit );
        }

        return $this->_db->fetchPairs($select);
    }

}
