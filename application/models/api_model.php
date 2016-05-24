<?php
class Api_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function getProveedor($rfc)
    {
        $sql = "SELECT prov as proveedorID, trim(replace(rfc, '-', '')) as rfc, trim(replace(razo, '\'', '')) as razon, concat(trim(replace(rfc, '-', '')), ' - ', trim(replace(razo, '\'', ''))) as value FROM catalogo.provedor p where tipo = 'A' order by proveedorID;";
        $query = $this->db->query($sql);
        
        $a = array();
        
        foreach($query->result() as $row)
        {
            array_push($a, $row);
        }
        
        return json_encode($a);
    }
}
 