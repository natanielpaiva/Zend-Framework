<?php

class Application_Model_DbTable_Comarca extends Zend_Db_Table_Abstract
{
    protected $_name = 'TB_COMARCA';
    protected $_primary = 'ID_COMARCA';

    public function fetchPairs($chave, $valor, $where = null, $ordem = null, $limit = null)
    {

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
