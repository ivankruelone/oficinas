<?php
class Directivos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


    public function plantilla()
    {
        $suc=$this->session->userdata('depto');
        $s = "select ifnull(d.motivo,' ')as mot,c.nombre as deptox,a.*,(year(now())-year(fechahis))as antiguedad 
        from catalogo.cat_empleado a 
        left join catalogo.cat_deptos b on b.depto=a.depto 
        left join catalogo.cat_deptos c on c.num=a.succ
        left join catalogo.cat_alta_empleado d on d.empleado=a.nomina and d.motivo='RETENCION'
        where a.depto=$suc and a.tipo=1 group by a.nomina
        order by a.succ,antiguedad desc";
        $q = $this->db->query($s);
        return $q;
        
    }
    
    
    
    

}
