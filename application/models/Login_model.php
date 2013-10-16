<?php
class Login_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function verifyCredentials($usuario, $password)
    {

        $sql = "select * from usuarios where username = ? and password = ? and tipo = 1;";
        $query = $this->db->query($sql, array($usuario, $password));

        if ($query->num_rows() > 0) {
            $this->__asignSessionParameters($query);
            return true;
        } else {
            return false;
        }

    }

    function __asignSessionParameters($query)
    {
        
        $row = $query->row();

        $newdata = array(
            'id' => $row->id,
            'username' => $row->nombrecompleto,
            'nombre' => $row->nombre,
            'puesto' => $row->puesto,
            'email' => $row->email,
            'nomina' => $row->nomina,
            'nivel' => $row->nivel,
            'id_firma' => $row->id_firma,
            'id_plaza' => $row->id_plaza,
            'depto' => $row->depto,
            'id_desarro' => $row->id_desarro,
            'logged_in' => true);

        $this->session->set_userdata($newdata);

    }


}
