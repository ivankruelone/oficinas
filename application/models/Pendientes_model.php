<?php
class Pendientes_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 
/////////////////////////////////////////////////////
function activo_r()
    {
    $s="SELECT id, completo, subarea
        FROM catalogo.cat_empleado
        where depto=90006 and tipo=1 and responsable='J';"; 
    $q=$this->db->query($s);
    return $q;   
    }

public function sube_pen($res,$pendiente,$fecha)
{
$fechac = Date('Y-m-d H.i.s');
                                   //area, responsable, pendientes, fecha_comp, tipo, dias_retraso, id_resp
$s="INSERT INTO compras.pendientes (area, responsable, pendientes, tipo,dias_retraso,fecha_comp,id_resp, fec_created, fec_updated)
(SELECT subarea, completo, ?,1,0, ?,?,?,?  FROM catalogo.cat_empleado
where id=$res)"; 

$this->db->query($s,array((string)$pendiente,$fecha,$res,$fechac,$fechac)); 
//echo $this->db->last_query();
//echo die;

}

public function concentrado($id_res)
{

$s="SELECT a.*, b.fec_created as fec,
case
when tipo=1 and fecha_comp<>'0000-00-00' and date(now())>fecha_comp
then DATEDIFF(date(now()),date_format(fecha_comp,'%Y-%m-%d'))
else 0 end diasr,b.observa,
case when libera=0 || libera is null  then ' ' else 'LIBERADO' end as libe
FROM compras.pendientes a
left join compras.pendientes_d b on b.id_cc=a.id
where tipo=1 and id_resp=$id_res"; 
$q=$this->db->query($s); 
foreach ($q->result() as $r)
{
$a[$r->id]['id'] = $r->id;
$a[$r->id]['area'] = $r->area;
$a[$r->id]['responsable'] = $r->responsable;
$a[$r->id]['pendientes'] = $r->pendientes;
$a[$r->id]['fecha_comp'] = $r->fecha_comp;
$a[$r->id]['tipo'] = $r->tipo;
$a[$r->id]['dias_retraso'] = $r->dias_retraso;
$a[$r->id]['diasr'] = $r->diasr;
$a[$r->id]['segundo'][$r->observa]['fec'] = $r->fec;
$a[$r->id]['segundo'][$r->observa]['observa'] = $r->observa;
$a[$r->id]['segundo'][$r->observa]['libe'] = $r->libe;
}
return $a;
}


public function valida_pen($id)
{
$fechac = Date('Y-m-d H.i.s');
    
$ss="select
ifnull(case when tipo=1 and date(now())>fecha_comp then DATEDIFF(date(now()),date_format(fecha_comp,'%Y-%m-%d')) else 0 end, 0) diasr 
from compras.pendientes where tipo=1 and id=$id";
$qq=$this->db->query($ss);
if($qq->num_rows()>0){
$rr=$qq->row();
$s="update compras.pendientes set tipo=2,dias_retraso=$rr->diasr, fec_updated='$fechac' where id=$id"; 
$q=$this->db->query($s); 
}
//echo $this->db->last_query();
//echo die;
return $q;
}




/////////////////////////////////////////////////////
function activo_r_val()
    {
    $s="SELECT id, completo, subarea
        FROM catalogo.cat_empleado
        where depto=90006 and tipo=1 and responsable='J'"; 
    $q=$this->db->query($s);
    return $q;   
    }

public function concentrado_val($id_res)
{
$s="SELECT a.*, b.fec_created as fec,
case
when tipo=1 and fecha_comp<>'0000-00-00' and date(now())>fecha_comp
then DATEDIFF(date(now()),date_format(fecha_comp,'%Y-%m-%d'))
else 0 end diasr,b.observa,
case when libera=0 then ' ' else 'LIBERADO' end as libe
FROM compras.pendientes a
left join compras.pendientes_d b on b.id_cc=a.id
where tipo=2 and id_resp=$id_res"; 
$q=$this->db->query($s); 
foreach ($q->result() as $r)
{
$a[$r->id]['id'] = $r->id;
$a[$r->id]['area'] = $r->area;
$a[$r->id]['responsable'] = $r->responsable;
$a[$r->id]['pendientes'] = $r->pendientes;
$a[$r->id]['fecha_comp'] = $r->fecha_comp;
$a[$r->id]['tipo'] = $r->tipo;
$a[$r->id]['dias_retraso'] = $r->dias_retraso;
$a[$r->id]['fec_updated'] = $r->fec_updated;
$a[$r->id]['fec_created'] = $r->fec_created;
$a[$r->id]['diasr'] = $r->diasr;
$a[$r->id]['segundo'][$r->observa]['fec'] = $r->fec;
$a[$r->id]['segundo'][$r->observa]['observa'] = $r->observa;
$a[$r->id]['segundo'][$r->observa]['libe'] = $r->libe;
}
return $a;
}
public function busca_pendiente($id)
{
$s="SELECT *
 FROM compras.pendientes a where id=$id"; 
$q=$this->db->query($s); 
return $q;
}
/////////////////////////////////////////////////////////////////////////////////encargado de area////////////////////////////////////////////

public function concentrado_personal($nomina)
{
    $a=array();
$id_res=$this->session->userdata('id_firma');
$s="SELECT a.*,b.id as id_dd, b.fec_created as fec,
case
when a.tipo=1 and fecha_comp<>'0000-00-00' and date(now())>fecha_comp
then DATEDIFF(date(now()),date_format(fecha_comp,'%Y-%m-%d'))
else 0 end diasr,b.observa,
case when libera=0 then ' ' else 'LIBERADO' end as libe
FROM compras.pendientes a
left join compras.pendientes_d b on b.id_cc=a.id
left join compras.usuarios c on c.id=a.id_resp
where a.tipo=1 and id_resp=$id_res"; 
$q=$this->db->query($s); 
//echo $this->db->last_query();
//die();
foreach ($q->result() as $r)
{
$a[$r->id]['id'] = $r->id;
$a[$r->id]['area'] = $r->area;
$a[$r->id]['responsable'] = $r->responsable;
$a[$r->id]['pendientes'] = $r->pendientes;
$a[$r->id]['fecha_comp'] = $r->fecha_comp;
$a[$r->id]['tipo'] = $r->tipo;
$a[$r->id]['dias_retraso'] = $r->dias_retraso;
$a[$r->id]['diasr'] = $r->diasr;
$a[$r->id]['segundo'][$r->observa]['observa'] = $r->observa;
$a[$r->id]['segundo'][$r->observa]['libe'] = $r->fec;
$a[$r->id]['segundo'][$r->observa]['id_dd'] = $r->id_dd;

}
//print_r($a);
//die();

return $a;



}
public function pendiente_d($id)
{
$s="select *from compras.pendientes_d where id_cc=$id"; 
$q=$this->db->query($s); 
return $q;
}


public function mod($id,$obser,$libera)
{
    $fechac = Date('Y-m-d H.i.s');
    
$id_user=$this->session->userdata('id');
$s="insert into compras.pendientes_d(id_cc, observa, fecha, id_user, libera, fec_created, fec_updated)
(select ?,?,date(now()),?,?,?,?)";
$q=$this->db->query($s,array((string)$id,$obser,$id_user,$libera,$fechac,$fechac)); 
//echo $this->db->last_query();
//echo die;
return $q;
}

public function concentrado_val_per($nombre)
{
$s="SELECT *
 FROM compras.pendientes a where tipo=2 and responsable='$nombre' order by responsable"; 

$q=$this->db->query($s); 
//echo $this->db->last_query();
//echo die;
return $q;
}



}
