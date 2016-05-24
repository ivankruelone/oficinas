<?php
class Recursos_humanos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function agrega_movimiento($mov,$nomina,$suc,$fec,$mot)
    {
       //
        $id_user= $this->session->userdata('id');
        $s="select a.succ,a.nomina,concat(trim(a.pat),' ',trim(a.mat),' ',trim(a.nom))as nombre,
        b.id_plaza as plaza1,c.id_plaza as plaza2
        from catalogo.cat_empleado a
        join catalogo.sucursal b on  b.suc=a.succ
        join catalogo.sucursal c on  c.suc=$suc
        where a.nomina=$nomina and a.tipo=1 ";
        $q = $this->db->query($s);
        if($q->num_rows() == 1 and $id_user>0 and $mot>0){
        $r = $q->row();
        if($suc==0){$id_plaza=$r->plaza1;$suc2=$r->succ;}else{$id_plaza=$r->plaza2;$suc2=$suc;}
             $new_member_insert_data = array(
            'cia'=>0,
            'nomina'=>$nomina,
            'motivo'=>$mov,
            'causa'=>$mot,
            'suc1'=>$r->succ,
            'suc2'=>$suc2,
            'id_user'=>$id_user,
            'dias'=>1,
            'fecha_c'=> date('Y-m-d H:i:s'),
            'id_plaza'=>$id_plaza,
            'fecha_mov'=>$fec,
            'nombre'=>$r->nombre,
            'tipo'=>1
            
		);
		$insert = $this->db->insert('desarrollo.mov_supervisor', $new_member_insert_data);
       }
        
    }

function mov_captura($mov)
{
$id_user= $this->session->userdata('id');
$s="select a.*, a.nomina,a.nombre,a.motivo,b.nombre as motivox,a.causa,c.nombre as causax, a.suc1,a.suc2,d.aplica
from desarrollo.mov_supervisor a
join catalogo.cat_mov_super b on b.id=a.motivo
join catalogo.cat_mov_super_det c on c.movimiento=a.motivo and c.id_motivo=a.causa
join catalogo.cat_nominas_calendario d on date(now()) between d.inicio and d.fin and a.motivo=d.movimiento
 where  id_user=$id_user and a.tipo=1";
$q=$this->db->query($s);
return $q;    
}

function valida_movimiento_faltante($id,$clave)
{
$id_user= $this->session->userdata('id');
$s="select a.id_plaza,a.fecha_mov,a.nomina,a.dias,a.suc1,e.cia as cianom,d.aplica,concat(b.nombre,' - ',c.nombre) as causax
from desarrollo.mov_supervisor a
join catalogo.cat_mov_super b on b.id=a.motivo
join catalogo.cat_mov_super_det c on c.movimiento=a.motivo and c.id_motivo=a.causa
join catalogo.cat_nominas_calendario d on date(now()) between d.inicio and d.fin and a.motivo=d.movimiento
join catalogo.cat_empleado e on e.nomina=a.nomina and e.tipo=1
 where a.id=$id and a.tipo=1";
$q=$this->db->query($s);
$r= $q->row();
if($q->num_rows() > 0){    
$s1 = "SELECT a.* FROM desarrollo.faltante a where  nomina=$r->nomina and cianom=$r->cianom and fecha='$r->fecha_mov' and clave=$clave";
 $q1 = $this->db->query($s1);
  if($q1->num_rows() == 0){
$r1= $q1->row();
$dataz= array(
            'fecha'   =>$r->fecha_mov,
            'corte'   =>0,  
            'nomina'  =>$r->nomina,
            'turno'   =>0,
            'fal'     =>$r->dias,
            'id_cor'  =>$id_user,
            'id_user' =>$id_user,
            'succ'    =>$r->suc1,
            'suc'     =>$r->suc1,
            'plaza'  =>0,
            'cia'    =>0,
            'plazanom'=>0,
            'clave'  =>$clave,
            'folioi'  => ' ',
            'fechai'  =>'0000-00-00',
            'cianom' =>$r->cianom,
            'tipo'=>2,
            'fecpre'=>$r->aplica,
            'id_plaza' =>$r->id_plaza,
            'observacion'=>$r->causax,
            'fechacaptura'=>date('Y-m-d H:i:s')
            );
$insert = $this->db->insert('desarrollo.faltante', $dataz);
    $a=array('tipo'=>2,'aplica'=>$r->aplica,'fecha_rh'=>$r->aplica);
    $this->db->where('id',$id);
    $this->db->update('desarrollo.mov_supervisor',$a); 
}}
}
function mov_captura_his()
{
$id_user= $this->session->userdata('id');
$s="select a.*, a.nomina,a.nombre,a.motivo,b.nombre as motivox,a.causa,c.nombre as causax, a.suc1,a.suc2,d.aplica
from desarrollo.mov_supervisor a
join catalogo.cat_mov_super b on b.id=a.motivo
join catalogo.cat_mov_super_det c on c.movimiento=a.motivo and c.id_motivo=a.causa
join catalogo.cat_nominas_calendario d on date(now()) between d.inicio and d.fin and a.motivo=d.movimiento
 where  id_user=$id_user and a.tipo>1 order by fecha_c desc";
$q=$this->db->query($s);
return $q;    
}
////////////////////////////////////////////////////////////////////////////////////////////////Lic.marysol
function horas_depto()
{
$s="select a.suc,a.nombre,count(*)as empleados,sum(checa)as checa  From catalogo.sucursal a
join catalogo.cat_empleado b on b.succ=a.suc and b.tipo=1
where a.suc>=90006 and a.suc<=90037 or a.suc in(100,900,6050)
group by a.suc
";    
$q=$this->db->query($s);
return $q;
}
function horas_trabajadas($suc)
{
$s="SELECT 
inicio,fin, month(a.fecha)as mes,e.mes as mesx,b.succ,sum(case when a.motivo='VACACIONES' and falta=1 then +1 else +0 end)as falta,
c.nombre,b.nomina,trim(b.completo)as completo,trim(b.puestox)as puestox,

sum(horas_decimal+case when a.motivo='VACACIONES' then hour(subtime(hsalida,hentrada)) else 0 end)as horas,

horas_laboradas,

((sum(horas_decimal+case when a.motivo='VACACIONES' 
then hour(subtime(hsalida,hentrada)) else 0 end))-horas_laboradas)as diff,

sum(case when a.entrada=a.salida  and falta=0 and a.entrada<>'0000-00-00 00:00:00' 
and a.salida<>'0000-00-00 00:00:00' then +1 else +0 end)no_checo,
(select sum(fal) from desarrollo.faltante x where x.clave=613 and x.fecha between inicio and fin and x.nomina=b.nomina and x.tipo=2)as descu
FROM desarrollo.checador_asistencia a
join catalogo.cat_empleado b on b.id=a.empleado_id and fecha_as400<a.fecha and b.tipo=1
join catalogo.sucursal c on c.suc=b.succ
join desarrollo.checador_quincenas d on a.fecha between d.inicio and d.fin
join catalogo.mes e on e.num=month(a.fecha)
left join catalogo.cat_alta_empleado f on f.nomina=b.nomina and f.motivo='RETENCION'
where a.fecha>='2015-01-01' and a.fecha between d.inicio and d.fin 
and d.fin<=date(now()) and  f.motivo is null and succ=$suc  and b.checa>0
group by d.id,empleado_id
order by b.nomina,a.fecha
";    
$q=$this->db->query($s);
return $q;
}








}