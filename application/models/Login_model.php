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
            
            $sql = "select * from catalogo.cat_empleado where nomina = ? and pass = ? and tipo = 1;";
            $query = $this->db->query($sql, array($usuario, $password));
            
            if($query->num_rows() > 0)
            {
                $this->__asignSessionParameters2($query);
                return true;
            }else{
                return false;
            }
            
            
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
            'responsable' => $row->responsable,
            'logged_in' => true);
            
            

        $this->session->set_userdata($newdata);

    }

    function __asignSessionParameters2($query)
    {
        
        $row = $query->row();

        $newdata = array(
            'id' => $row->id,
            'username' => $row->nomina,
            'nombre' => $row->completo,
            'puesto' => $row->puestox,
            'email' => $row->correo,
            'nomina' => $row->nomina,
            'nivel' => 22,
            'id_firma' => $row->id,
            'id_plaza' => $row->id,
            'depto' => null,
            'id_desarro' => $row->id,
            'responsable' => $row->responsable,
            'logged_in' => true);
            
            

        $this->session->set_userdata($newdata);

    }

}
