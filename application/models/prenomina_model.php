<?php
class Prenomina_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function busca_suc_prenom()
{
    $s="select suc, nombre From catalogo.sucursal where tlid=1 and suc in(2078,2085,2189) 
    order by user_id";
    $q=$this->db->query($s);
    $suc[0]= 'Selecciona sucursal';
    foreach($q->result()as $r)
    {
        $suc[$r->suc]=$r->nombre;
    }
    return $suc;
}
function busca_mov_prenomina()
{
    $s="SELECT clave, nombre, tope, aplica FROM catalogo.cat_nom_claves a, catalogo.cat_nominas_calendario b
    where b.movimiento=9 and  date(now()) between inicio and fin and
    case when (select id from catalogo.cat_festivo 
    where farmacia between subdate(date(now()),60) and date(now())) is null
    then a.clave in(333,519,520,535,543,544,613,644) else a.clave in(331,333,519,520,535,543,544,613,644) end";
    $q=$this->db->query($s);
    $clave[0]= 'Selecciona movimiento';
    foreach($q->result()as $r)
    {
        $clave[$r->clave]=$r->nombre;
    }
    return $clave;
}
function busca_mov_prenomina_una($clave)
{
    $s="SELECT clave, nombre, tope, aplica FROM catalogo.cat_nom_claves a, catalogo.cat_nominas_calendario b
    where b.movimiento=9 and  date(now()) 
    between inicio and fin and a.clave in(331,333,519,520,535,543,544,613,644) and clave=$clave";
    $q=$this->db->query($s);
    return $q;
}
function busca_empleado_succ($suc){
        $sql = "SELECT * FROM catalogo.cat_empleado where succ = $suc";
        $query = $this->db->query($sql);        
         if($query->num_rows() == 0){
            $tabla = 0;
         }else{
        $tabla = "<option value=\"-\">Seleccione un empleado</option>";
        foreach($query->result() as $row){
             $tabla.="<option value =\"".$row->id."\">".$row->nomina." - ".$row->completo." - ".$row->puestox."</option>
            ";
         } 
        }  
        return $tabla;  
     }
function busca_fec_prima_dominical(){
        $sql = "select case 
when (weekday(now()))=0 then (subdate(date(now()),1))
when (weekday(now()))=1 then (subdate(date(now()),2))
when (weekday(now()))=2 then (subdate(date(now()),3))
when (weekday(now()))=4 then (subdate(date(now()),4))
when (weekday(now()))=5 then (subdate(date(now()),5))
when (weekday(now()))=6 then (subdate(date(now()),6))
when (weekday(now()))=7 then (subdate(date(now()),0))
end as fecha
union all
select case
when (weekday(now()))=0 then (subdate(date(now()),8))
when (weekday(now()))=1 then (subdate(date(now()),9))
when (weekday(now()))=2 then (subdate(date(now()),10))
when (weekday(now()))=4 then (subdate(date(now()),11))
when (weekday(now()))=5 then (subdate(date(now()),12))
when (weekday(now()))=6 then (subdate(date(now()),13))
when (weekday(now()))=7 then (subdate(date(now()),14))
end as fecha
union all
select case
when (weekday(now()))=0 then (subdate(date(now()),15))
when (weekday(now()))=1 then (subdate(date(now()),16))
when (weekday(now()))=2 then (subdate(date(now()),17))
when (weekday(now()))=4 then (subdate(date(now()),18))
when (weekday(now()))=5 then (subdate(date(now()),19))
when (weekday(now()))=6 then (subdate(date(now()),20))
when (weekday(now()))=7 then (subdate(date(now()),21))
end as fecha
union all
select case
when (weekday(now()))=0 then (subdate(date(now()),22))
when (weekday(now()))=1 then (subdate(date(now()),23))
when (weekday(now()))=2 then (subdate(date(now()),24))
when (weekday(now()))=4 then (subdate(date(now()),25))
when (weekday(now()))=5 then (subdate(date(now()),26))
when (weekday(now()))=6 then (subdate(date(now()),27))
when (weekday(now()))=7 then (subdate(date(now()),28))
end as fecha
";
        $query = $this->db->query($sql);        
        $tabla[0] = "<option value=\"-\">Seleccione un domingo</option>";
        foreach($query->result() as $row){
             $tabla[$row->fecha]=$row->fecha;
        }  
        return $tabla;  
     }
function busca_festivo()
    {
    $s="select *from catalogo.cat_festivo where  farmacia between subdate(date(now()),40) and date(now())";
    $q=$this->db->query($s);
        $tabla[0] = "<option value=\"-\">Seleccione dia festivo</option>";
        foreach($q->result() as $row){
             $tabla[$row->farmacia]=$row->farmacia;
        }  
        return $tabla;  
    }
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////


function agrega_mov_prenomina($fec,$clave,$id_cat,$dias,$monto,$fecpre,$fol)
    {
        $id_user= $this->session->userdata('id');
        $s="select *from catalogo.cat_empleado where id=$id_cat ";
        $q = $this->db->query($s);
        if($q->num_rows() == 1 and $id_user>0){
        $r = $q->row();
        
             $new_member_insert_data = array(
            'id_user'=>$id_user, 
            'fecha_mov'=>$fec, 
            'clave'=>$clave, 
            'id_cat'=>$id_cat, 
            'dias'=>$dias, 
            'monto'=>$monto, 
            'fecpre'=>$fecpre, 
            'fecha_act'=>date('Y-m-d'), 
            'validado'=>0, 
            'suc'=>$r->suc, 
            'folioi'=>$fol,
            'cia'=>$r->cia
            
		);
		$insert = $this->db->insert('prenomina.prenomina_det', $new_member_insert_data);
       }
       }
       
       
       
        
    

}