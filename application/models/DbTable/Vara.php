<?php

class Application_Model_DbTable_Vara extends Zend_Db_Table_Abstract
{
    protected $_name = 'TB_VARA';
    protected $_primary = 'ID_VARA';

    public function getVara(){
        $select = $this->_db->select();


        $select->from(array( "v" => $this->_name ), array( "v.*", "codigo_comarca" => "c.CODIGO" ) )
               ->join( array( "c" => "TB_COMARCA" ) , "c.ID_COMARCA = v.ID_COMARCA", array())
               ->where("v.ST_ATIVO = 1");

        return $this->_db->fetchAll($select);

    }
}
