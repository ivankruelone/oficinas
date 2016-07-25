<?php
class Insumos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

function insumos_ctl_p($id_comprar)
{
$s="SELECT b.nombre as sucx,a.*,sum(canp*costo)as impp,b.plantilla,c.id_cc,c.fol
FROM papeleria.insumos_c a
join catalogo.sucursal b on b.suc=a.suc
join papeleria.insumos_s c on c.id_cc=a.id
where c.tipo=1 and a.tipo in(1,2,3) and id_comprar=$id_comprar and b.tipo3 in('FA','FE','DA','MO') and date_format(a.fecha,'%Y-%m-%d') > subdate(date(now()),33)
group by a.id,fol";
$q=$this->db->query($s);
return $q;    
}

function insumos_ctl_p_dep($id_comprar)
{
$s="SELECT b.nombre as sucx,a.*,sum(canp*costo)as impp,b.plantilla,c.id_cc,c.fol
FROM papeleria.insumos_c a
join catalogo.sucursal b on b.suc=a.suc
join papeleria.insumos_s c on c.id_cc=a.id
where c.tipo=1 and a.tipo in(1,2,3) and id_comprar = $id_comprar and b.tipo3 not in('FA','FE','DA','MO') and a.id not in (select x.id_cc from catalogo.bata_rhe x where x.id_cc = a.id) and a.id not in(select x.id_cc from papeleria.pedido_extra x where x.id_cc = a.id) and date_format(a.fecha,'%Y-%m-%d') > subdate(date(now()),33)
group by a.id,fol";
$q=$this->db->query($s);
return $q;    
}
function insumos_det_p($id_cc, $fol)
{
$s="SELECT c.descripcion,c.empaque,b.*
FROM papeleria.insumos_s b
join catalogo.cat_insumos c on c.id_insumos=b.id_insumos
where b.tipo=1 and b.fol = '$fol' and b.id_cc=$id_cc";
$q=$this->db->query($s);
return $q;    
}
function insumos_det_busca($id)
{
$s="SELECT c.*,b.*
from papeleria.insumos_s b 
join catalogo.cat_insumos c on c.id_insumos=b.id_insumos
where  b.id=$id and b.tipo=1";
$q=$this->db->query($s);
return $q;    
}
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function valida_piezas_insumos_d($id_cc,$fol,$surtidor)
{
$s="update papeleria.insumos_c a, papeleria.insumos_d b
set b.tipo=2
where a.tipo=2 and a.id=b.id_cc and b.canp>0 and a.id=$id_cc";
$this->db->query($s);
  
$s1="update papeleria.insumos_c a, papeleria.insumos_s b
set b.tipo=2, b.fecha_sur=CURRENT_TIMESTAMP(),b.id_surtidor=$surtidor
where a.tipo=2 and a.id=b.id_cc and a.id=$id_cc and b.fol='$fol'";
$this->db->query($s1); 

$s3="select fol from papeleria.insumos_s where id_cc=$id_cc and fol>='A' group by fol";
$q3=$this->db->query($s3);
$con=($q3->num_rows()+65);
 for ($i=65;$i<=$con;$i++) {
     $letra=chr($i);                 
     }
$s4="insert ignore into
papeleria.insumos_s(id_cc, id_dd, fol, id_insumos, canp, cans, fecha_cap, tipo, costo, costo_cat, canr, fecha_sur, fecha_val)
(select
id_cc, id_dd, '$letra', id_insumos, (canp-cans),(canp-cans), fecha_cap, 1, costo, costo_cat, (canp-cans), '0000-00-00', '0000-00-00'
from papeleria.insumos_s where id_cc=$id_cc and fol='$fol' and canp>0 and cans<>canp)";
$this->db->query($s4);
$s5="delete from papeleria.insumos_s where id_cc=$id_cc and fol='$fol' and cans=0";
$this->db->query($s5);

$s6="select (sum(a.canp)-(select sum(x.cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and x.tipo=2))as dif
from papeleria.insumos_d a where id_cc=$id_cc";
$q6=$this->db->query($s6);
if($q6->num_rows()>0)
{$r6=$q6->row();
if($r6->dif<=0){
$s7="update papeleria.insumos_c set tipo=3 where id=$id_cc";
$this->db->query($s7);    
}}




}
function imprime_insumos_detalle_previo($fol1,$fol2,$letra,$id_comprar)
    {
$a='';    
$s="SELECT c.suc,d.nombre,a.id_cc,a.id_insumos,b.descripcion,b.empaque,canp,cans,a.fol,
    case 
    when tipo3='FE' then 'FENIX' 
    when tipo3='MO' then 'MODULO' 
    when tipo3='FA' then 'FARMABODEGA'
    when tipo3='DA' then 'DOCTOR AHORRO' end as sucx
FROM papeleria.insumos_s a
join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
join papeleria.insumos_c c on c.id=a.id_cc
join catalogo.sucursal d on d.suc=c.suc
where  a.canp>0 and id_comprar=$id_comprar and a.tipo=1 and a.id_cc between $fol1 and $fol2 and a.fol='$letra' and c.fecha>=subdate(date(now()),28)";
$q=$this->db->query($s);
foreach($q->result() as $r)
{
    $a[$r->suc]['suc']=$r->suc;
    $a[$r->suc]['id_cc']=$r->id_cc;
    $a[$r->suc]['fol']=$r->fol;
    $a[$r->suc]['nombre']=$r->nombre;
    $a[$r->suc]['sucx']=$r->sucx;
    $a[$r->suc]['d'][$r->id_insumos]['id_insumos']=$r->id_insumos;
    $a[$r->suc]['d'][$r->id_insumos]['descripcion']=$r->descripcion;
    $a[$r->suc]['d'][$r->id_insumos]['empaque']=$r->empaque;
    $a[$r->suc]['d'][$r->id_insumos]['canp']=$r->canp;
    $a[$r->suc]['d'][$r->id_insumos]['cans']=$r->cans;
}   
return $a;       
    }
    
    function imprime_insumos_detalle_previo_depto($fol1,$fol2,$letra)
    {
$a='';    
$s="SELECT c.suc,d.nombre,a.id_cc,a.id_insumos,b.descripcion,b.empaque,canp,cans,a.fol,
    case 
    when tipo3='OF' then 'OFICINA'
    when tipo3='SE' then 'SEG'
    end as sucx
FROM papeleria.insumos_s a
join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
join papeleria.insumos_c c on c.id=a.id_cc
join catalogo.sucursal d on d.suc=c.suc
where  a.cans>0 and id_comprar=1 and a.tipo=1 and tipo3 not in('FA','MO','DA','FE')
and a.id_cc between $fol1 and $fol2 and a.fol='$letra'";
$q=$this->db->query($s);
foreach($q->result() as $r)
{
    $a[$r->suc]['suc']=$r->suc;
    $a[$r->suc]['id_cc']=$r->id_cc;
    $a[$r->suc]['fol']=$r->fol;
    $a[$r->suc]['nombre']=$r->nombre;
    $a[$r->suc]['sucx']=$r->sucx;
    $a[$r->suc]['d'][$r->id_insumos]['id_insumos']=$r->id_insumos;
    $a[$r->suc]['d'][$r->id_insumos]['descripcion']=$r->descripcion;
    $a[$r->suc]['d'][$r->id_insumos]['empaque']=$r->empaque;
    $a[$r->suc]['d'][$r->id_insumos]['cans']=$r->cans;
    $a[$r->suc]['d'][$r->id_insumos]['canp']=$r->canp;
}   
return $a;       
    }
function insumos_ctl_his()
{
$s="select year(fecha_sur)as aaa,month(fecha_sur)as mes ,b.mes as mesx
from papeleria.insumos_s a
join catalogo.mes b on b.num=month(fecha_sur)
where tipo in(2,3)
group by year(fecha_sur),month(fecha_sur)
order by year(fecha_sur) desc ,month(fecha_sur) desc";
$q=$this->db->query($s);
return $q;    
}
function insumos_ctl_his_c($aaa,$mes)
{
$s="SELECT b.nombre as sucx,a.*,aa.fol,aa.fecha_sur
FROM papeleria.insumos_c a
join papeleria.insumos_s aa on aa.id_cc=a.id
join catalogo.sucursal b on b.suc=a.suc
where aa.tipo in(2,3) and a.id_comprar in(1,2) and year(aa.fecha_sur)=$aaa and month(aa.fecha_sur)=$mes and b.tipo3 in('FA','MO','DA','FE')
group by a.id, aa.fol
order by aa.fecha_sur desc";
$q=$this->db->query($s);
return $q;    
}

function insumos_ctl_his_c2($aaa,$mes)
{
  $s = "SELECT b.nombre as sucx,a.*,aa.fol,aa.fecha_sur
  FROM papeleria.insumos_c a
  join papeleria.insumos_s aa on aa.id_cc=a.id
  join catalogo.sucursal b on b.suc=a.suc
  where aa.tipo in(2,3) and year(aa.fecha_sur)= '$aaa' and month(aa.fecha_sur)= '$mes' and b.tipo3 not in('FA','MO','DA','FE')
  and a.id not in (SELECT id_cc FROM papeleria.pedido_extra x where x.id_cc = a.id) and a.id not in (SELECT x.id_cc FROM catalogo.bata_rhe x where x.id_cc = a.id)
  group by a.id, aa.fol
  order by aa.fecha_sur desc";
    $q = $this->db->query($s);
    return $q;
}

function insumos_ctl_his_c3($aaa,$mes)
{
  $s = "SELECT b.nombre as sucx,a.*,aa.fol,aa.fecha_sur
FROM papeleria.insumos_c a
join papeleria.insumos_s aa on aa.id_cc=a.id
join catalogo.sucursal b on b.suc=a.suc
where aa.tipo in(2,3) and a.id_comprar in(3) and year(aa.fecha_sur)=$aaa and month(aa.fecha_sur)=$mes and b.tipo3 in('FA','MO','DA','FE')
group by a.id, aa.fol
order by aa.fecha_sur desc";
    $q = $this->db->query($s);
    return $q;
}

function verifica_datos_impresos($id,$fol)
{
  $s = "SELECT a.id,a.suc,b.nombre as sucx,a.fecha_cierre,aa.fecha_sur,aa.fol
FROM papeleria.insumos_c a
join papeleria.insumos_s aa on aa.id_cc=a.id
join catalogo.sucursal b on b.suc=a.suc
where aa.tipo=2 and a.id=$id and aa.fol='$fol' and b.tipo3 not in('FA','MO','DA','FE')
group by aa.fol"; 
$q = $this->db->query($s);
    return $q; 
}

public function imprime_insumos_cabeza($id,$fol,$var1)
    {
        $fec=date('Y-m-d H:i:s');
    $s="SELECT a.id,a.suc,b.nombre as sucx,a.fecha_cierre,aa.fecha_sur,aa.fol,
    ifnull((select trim(completo) from catalogo.cat_empleado x where x.id=aa.id_surtidor),'SIN SURTIDOR')as surtidorx
FROM papeleria.insumos_c a
join papeleria.insumos_s aa on aa.id_cc=a.id
join catalogo.sucursal b on b.suc=a.suc
where a.id=$id and aa.fol='$fol'
group by aa.fol";
  
    $q=$this->db->query($s);
    if($q->num_rows()>0){
        $r=$q->row();
        //$l0='<img src="'.base_url().'/img/logos.png" border="0" width="100px" />';
        $l0='<img style=\"position:relative; width:100px;\", src=\"'.base_url().'../../img/logos.png\" />';
        $a="<table>
        <tr>
        <th>$l0</th>
        <th align=\"center\"> <font size=\"+3\"><strong>CONTROL DE PEDIDOS DE PAPELERIA</strong></font></th>
        <th align=\"right\"><font size=\"+3\"><strong>$var1</strong></font></th>
        </tr>
         <tr>
        <th colspan=\"1\" align=\"left\"><font size=\"+3\"><strong>Fecha de surtido $r->fecha_sur</strong></font></th>
        <th colspan=\"1\" align=\"left\"><font size=\"+2\"><strong>$r->surtidorx</strong></font></th>
        <th colspan=\"1\" align=\"right\"><font size=\"-2\"><strong>Fecha de impresion $fec</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"1\" align=\"left\"><font size=\"+1\"><strong>Pedido.: $id $fol</strong></font></th>
        <th colspan=\"2\" align=\"right\"><font size=\"+1\"><strong>$r->suc ".trim($r->sucx)."</strong></font></th>
        
        </tr>
        </table>";
        
    }else{$a='';}
    return $a;
    
    }
    function imprime_insumos_detalle($id,$fol)
    {
    $s="SELECT a.id_cc,a.id_insumos,b.descripcion,b.empaque,cans
FROM papeleria.insumos_s a
join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
where  a.cans>0 and a.id_cc=$id and fol='$fol'";
$q=$this->db->query($s);
foreach($q->result() as $r)
{
    $a[$r->id_insumos]['id_insumos']=$r->id_insumos;
    $a[$r->id_insumos]['descripcion']=$r->descripcion;
    $a[$r->id_insumos]['empaque']=$r->empaque;
    $a[$r->id_insumos]['cans']=$r->cans;
}   
return $a;       
    }
public function imprime_insumos_final()
    {
        $a="<table>
        <tr>
        <td align=\"center\">________________________________</td>
        <td align=\"center\">________________________________</td>
        <td align=\"center\">________________________________</td>
        </tr>
        <tr>
        <td align=\"center\">FIRMA DEL CHOFER</td>
        <td align=\"center\">FIRMA DE RECIBIDO EN SUCURSAL</td>
        <td align=\"center\">FECHA DE ENTREGA</td>
        </tr>
        </table>
        ";
        return $a;
    }
    
    public function imprime_insumos_final2()
    {
        $a="<table>
        <br />
        <br />
        <tr>
        <td align=\"center\">_____________________________________</td>
        <td align=\"center\">________________________________</td>
        </tr>
        <tr>
        <td align=\"center\">FIRMA DE RECIBIDO EN DEPARTAMENTO</td>
        <td align=\"center\">FECHA DE ENTREGA</td>
        </tr>
        </table>
        ";
        return $a;
    }
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function ver_pedido_for()
{
    $s="select *from papeleria.insumos_c
    where fecha_cap>subdate(date(now()),5) and tipo=1 and id_comprar=3 and stat_sup='F'";
    $q=$this->db->query($s);
    if($q->num_rows()>0)
    {$val=1;}else{$val=0;}
    return $val;
}
function insumos_pre_pedido()
{
    $s="select a.suc,b.descripcion,b.empaque,c.nombre,sum(pedido)pedido, count(a.id_insumos)as articulos
FROM papeleria.pedido_formulado_med a
left join catalogo.cat_insumos b on b.id_insumos=substr(a.id_insumos,1,3)
join catalogo.sucursal c on c.suc=a.suc
group by a.suc";
    $q=$this->db->query($s);
    return $q;
}
function insumos_pre_pedido_det($suc)
{
    $s="select b.descripcion,b.empaque,c.nombre,a.*
FROM papeleria.pedido_formulado_med a
left join catalogo.cat_insumos b on b.id_insumos=substr(a.id_insumos,1,3)
join catalogo.sucursal c on c.suc=a.suc
where a.suc=$suc";
    $q=$this->db->query($s);
    return $q;
}
function procesa_pedidos_medicos()
{
    $mes=date('m')-1;
    if($mes==0){$aaa=date('Y')-1;}else{$aaa=date('Y');}
    $s0="delete from papeleria.pedido_formulado_med";
    $this->db->query($s0);
    $s1="insert ignore into papeleria.pedido_formulado_med(suc, id_insumos, mov, solicita, exis, pedido, fecha)
    (select a.suc, id_insumos,count(*)as mov,
    case when round((count(*)/multiplo)+.30)=1 then 1 else round((count(*)/multiplo)+.33) end soli,
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)as exis,
    (case
    when (case when round((count(*)/multiplo)+.30)=1 then 1 else round((count(*)/multiplo)+.33) end)>
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    then
    (case when round((count(*)/multiplo)+.30)=1 then 1 else round((count(*)/multiplo)+.33) end) -
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    else 0 end)as pedido,date(now())
    from vtadc.ticket_med a
    join catalogo.cat_insumos x
    join catalogo.sucursal c on c.suc=a.suc and tlid=1
    where x.id_insumos in(388) and a.concepto>0 and year(a.fecha)=$aaa and concepto in(26678582) and month(a.fecha)=$mes
    group by a.suc)";
    $this->db->query($s1);       
    
    $s2="insert ignore into papeleria.pedido_formulado_med(suc, id_insumos, mov, solicita, exis, pedido, fecha)
    (select a.suc, id_insumos,count(*)as mov,
    case when round(((count(*)/2)/multiplo)+.30)=1 then 1 else round(((count(*)/2)/multiplo)) end soli,
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)as exis,
    (case
    when (case when round(((count(*)/2)/multiplo)+.30)=1 then 1 else round(((count(*)/2)/multiplo)) end)>
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    then
    (case when round(((count(*)/2)/multiplo)+.30)=1 then 1 else round(((count(*)/2)/multiplo)) end) -
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    else 0 end)as pedido,date(now())
    from vtadc.ticket_med a
    join catalogo.cat_insumos x
    join catalogo.sucursal c on c.suc=a.suc and tlid=1 and dia<>'CER'
    where x.id_insumos in(295) and a.concepto>0 and year(a.fecha)=$aaa and concepto in(26678582) and month(a.fecha)=$mes
    group by a.suc)";
    $this->db->query($s2);
    $s3="insert ignore into papeleria.pedido_formulado_med(suc, id_insumos, mov, solicita, exis, pedido, fecha)
    (select a.suc, id_insumos,count(*)as mov,
    case when round(((count(*)*.15)/multiplo)*.30)<=.50 then 1 else round(((count(*)*.15)/multiplo)*.30) end soli,
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)as exis,
    (case
    when (case when round(((count(*)*.15)/multiplo)*.30)<=.50 then 1 else round(((count(*)*.15)/multiplo)*.30) end)>
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    then
    (case when round(((count(*)*.15)/multiplo)*.30)<=.50 then 1 else round(((count(*)*.15)/multiplo)*.30) end) -
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    else 0 end)as pedido,date(now())
    from vtadc.ticket_med a
    join catalogo.cat_insumos x
    join catalogo.sucursal c on c.suc=a.suc and tlid=1
    where x.id_insumos =232 and a.concepto>0 and year(a.fecha)=$aaa and concepto in(26678582) and month(a.fecha)=$mes
    group by a.suc)";
    $this->db->query($s3);
    $s4="insert ignore into papeleria.pedido_formulado_med(suc, id_insumos, mov, solicita, exis, pedido, fecha)
    (select a.suc, id_insumos,count(*)as mov,
    case when round(((count(*)*.35)/multiplo)*.30)<=.50 then 1 else round(((count(*)*.35)/multiplo)*.30) end soli,
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)as exis,
    (case
    when (case when round(((count(*)*.35)/multiplo)*.30)<=.50 then 1 else round(((count(*)*.35)/multiplo)*.30) end)>
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    then
    (case when round(((count(*)*.35)/multiplo)*.30)<=.50 then 1 else round(((count(*)*.35)/multiplo)*.30) end) -
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    else 0 end)as pedido,date(now())
    from vtadc.ticket_med a
    join catalogo.cat_insumos x
    join catalogo.sucursal c on c.suc=a.suc and tlid=1
    where x.id_insumos =233 and a.concepto>0 and year(a.fecha)=$aaa and concepto in(26678582) and month(a.fecha)=$mes
    group by a.suc)";
    $this->db->query($s4);
    $s5="insert ignore into papeleria.pedido_formulado_med(suc, id_insumos, mov, solicita, exis, pedido, fecha)
    (select a.suc,id_insumos,count(*)as mov,
    case when round(((count(*)*.65)/multiplo)*.30)<=.50 then 1 else round(((count(*)*.65)/multiplo)*.50) end soli,
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)as exis,
    (case
    when (case when round(((count(*)*.65)/multiplo)*.30)<=.50 then 1 else round(((count(*)*.65)/multiplo)*.50) end)>
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    then
    (case when round(((count(*)*.65)/multiplo)*.30)<=.50 then 1 else round(((count(*)*.65)/multiplo)*.50) end) -
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    else 0 end)as pedido,date(now())
    from vtadc.ticket_med a
    join catalogo.cat_insumos x
    join catalogo.sucursal c on c.suc=a.suc and tlid=1
    where x.id_insumos =234 and a.concepto>0 and year(a.fecha)=$aaa and concepto in(26678582) and month(a.fecha)=$mes
    group by a.suc)";
    $this->db->query($s5);
    $s6="insert ignore into papeleria.pedido_formulado_med(suc, id_insumos, mov, solicita, exis, pedido, fecha)
    (select a.suc,x.id_insumos,count(*)as mov,
    case when round((count(*)/multiplo)+.30)=1 then 1 else round((count(*)/multiplo)+.5) end soli,
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)as exis,
    (case
    when (case when round((count(*)/multiplo)+.30)=1 then 1 else round((count(*)/multiplo)+.5) end)>
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    then
    (case when round((count(*)/multiplo)+.30)=1 then 1 else round((count(*)/multiplo)+.5) end) -
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    else 0 end)as pedido,date(now())
    from vtadc.ticket_med a
    join catalogo.cat_concepto_medicos b on b.codigo=a.concepto
    join catalogo.sucursal c on c.suc=a.suc and tlid=1
    join catalogo.cat_insumos x on x.id_insumos=b.id_insumos
    where a.concepto>0 and year(a.fecha)=$aaa and concepto in(26678584) and month(a.fecha)=$mes
    group by a.suc, a.concepto)";
    $this->db->query($s6);
    $s6x="insert ignore into papeleria.pedido_formulado_med(suc, id_insumos, mov, solicita, exis, pedido, fecha)
    (select a.suc,x.id_insumos,count(*)as mov,
    case when round(((count(*)*.10)/multiplo)+.30)=1 then 1 else round(((count(*)*.10)/multiplo)+.5) end soli,
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)as exis,
    (case
    when (case when round(((count(*)*.10)/multiplo)+.30)=1 then 1 else round(((count(*)*.10)/multiplo)+.5) end)>
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    then
    (case when round(((count(*)*.10)/multiplo)+.30)=1 then 1 else round(((count(*)*.10)/multiplo)+.5) end) -
    ifnull((select cantidad from papeleria.inventario_cap n where n.id_insumos=x.id_insumos and n.suc=c.suc),0)
    else 0 end)as pedido,date(now())
    from vtadc.ticket_med a
    join catalogo.cat_concepto_medicos b on b.codigo=a.concepto
    join catalogo.sucursal c on c.suc=a.suc and tlid=1
    join catalogo.cat_insumos x on x.id_insumos=b.id_insumos
    where a.concepto>0 and year(a.fecha)=$aaa and concepto in(26678583) and month(a.fecha)=$mes
    group by a.suc, a.concepto)";
    $this->db->query($s6x);
    
    $s8="insert ignore into papeleria.pedido_formulado_med(suc, id_insumos, mov, solicita, exis, pedido, fecha)
    (select a.suc,case when personalizado=1 then concat(412,a.nomina) else concat(413,a.nomina) end, count(*),
    (case when ((count(*)/100))<=.15  then 1 else round(((count(*)/100)+.33)) end)as pedir,
    ifnull((select cantidad from papeleria.inventario_cap n
    where n.id_insumos=case when personalizado=1 then 412 else 413 end and n.suc=a.suc),0) as exis,
    case when (case when ((count(*)/100))<=.15  then 1 else round(((count(*)/100)+.33)) end)>
    ifnull((select cantidad from papeleria.inventario_cap n
    where n.id_insumos=case when personalizado=1 then 412 else 413 end and n.suc=a.suc),0)
    then
    (case when ((count(*)/100))<=.15  then 1 else round(((count(*)/100)+.33)) end)-
    ifnull((select cantidad from papeleria.inventario_cap n
    where n.id_insumos=case when personalizado=1 then 412 else 413 end and n.suc=a.suc),0)
    else 0 end, date(now())
    from vtadc.ticket_med a
    join catalogo.sucursal b on b.suc=a.suc and tlid=1 and dia<>'CER'
    join catalogo.cat_medicos c on c.nomina=a.nomina and c.tipo=1
    where concepto=26678582 and year(fecha)=$aaa and month(fecha)=$mes
    group by a.suc,a.nomina)";
    $this->db->query($s8);
    $s9="insert into papeleria.pedido_formulado_med(suc, id_insumos, mov, solicita, exis, pedido, fecha)
(select a.suc,32,1,1,0,1,date(now()) From catalogo.sucursal a
join catalogo.cat_medicos b on b.matutino=a.suc and b.tipo=1 or b.vespertino=a.suc and b.tipo=1
where a.tlid=1 and a.dia<>'cer' and a.suc>100
group by a.suc)
";
    $this->db->query($s9);
    $s10="insert into papeleria.pedido_formulado_med(suc, id_insumos, mov, solicita, exis, pedido, fecha)
(select a.suc,33,1,1,0,1,date(now()) From catalogo.sucursal a
join catalogo.cat_medicos b on b.matutino=a.suc and b.tipo=1 or b.vespertino=a.suc and b.tipo=1
where a.tlid=1 and a.dia<>'cer' and a.suc>100
group by a.suc)
";
    $this->db->query($s10);
    $s11="insert into papeleria.pedido_formulado_med(suc, id_insumos, mov, solicita, exis, pedido, fecha)
(select a.suc,36,1,1,0,1,date(now()) From catalogo.sucursal a
join catalogo.cat_medicos b on b.matutino=a.suc and b.tipo=1 or b.vespertino=a.suc and b.tipo=1
where a.tlid=1 and a.dia<>'cer' and a.suc>100
group by a.suc)
";
    $this->db->query($s11);
    
$suc_activas="select *From catalogo.sucursal a
join catalogo.cat_medicos b on b.matutino=a.suc and b.tipo=1 or b.vespertino=a.suc and b.tipo=1
where a.tlid=1 and a.dia<>'cer' and a.suc>100
group by a.suc";
$q_activas=$this->db->query($suc_activas);
foreach ($q_activas->result()as $r_activas)
{
    
$m1="select *from papeleria.insumos_c x
join papeleria.insumos_s xx on xx.id_cc=x.id
where x.suc=$r_activas->suc and x.id_comprar=3 and fecha>=subdate(date(now()),interval 45 day) and xx.id_insumos=32 and xx.tipo=2";
$qm1=$this->db->query($m1);
if($qm1->num_rows()>0){$max_32=0;}else{$max_32=1;}

$m3="select *from papeleria.insumos_c x
join papeleria.insumos_s xx on xx.id_cc=x.id
where x.suc=$r_activas->suc and x.id_comprar=3 and fecha>=subdate(date(now()),interval 45 day) and xx.id_insumos=33 and xx.tipo=2";
$qm3=$this->db->query($m3);
if($qm3->num_rows()>0){$max_33=0;}else{$max_33=1;}

$m5="select *from papeleria.insumos_c x
join papeleria.insumos_s xx on xx.id_cc=x.id
where x.suc=$r_activas->suc and x.id_comprar=3 and fecha>=subdate(date(now()),interval 45 day) and xx.id_insumos=36 and xx.tipo=2";
$qm5=$this->db->query($m5);
if($qm5->num_rows()>0){$max_36=0;}else{$max_36=1;}

$actualiza="update papeleria.pedido_formulado_med 
set pedido=case when id_insumos=32 then $max_32 when id_insumos=33 then $max_33 when id_insumos=36 then $max_36 end    
where id_cc=0 and id_insumos in(32,33,36) and suc=$r_activas->suc";
$this->db->query($actualiza);
}
}

function inserta_pre_pedido()
{
    $s1="insert into papeleria.insumos_c(suc, id_comprar, fecha, fecha_cap, tipo, fecha_cierre, fecha_sur, stat_sup)
(SELECT a.suc,3,date(now()),CURRENT_TIMESTAMP,1,'0000-00-00','0000-00-00','F'
FROM papeleria.pedido_formulado_med a where id_cc=0
group by a.suc)";
    $this->db->query($s1);
    $s2="update papeleria.insumos_c a, papeleria.pedido_formulado_med b
set b.id_cc=a.id
where a.suc=b.suc and a.tipo=1 and a.stat_sup='F' and b.id_cc=0 and a.fecha>=subdate(date(now()),10)";
    $this->db->query($s2);
    $s3="insert into papeleria.insumos_d
(id_cc, id_insumos, canp, canp_suc, fecha_cap, tipo,  costo, costo_cat, canp_sup)

(SELECT a.id_cc, substr(a.id_insumos,1,3),sum(pedido),sum(pedido),CURRENT_TIMESTAMP,1,c.costo,c.costo,sum(pedido)
FROM  papeleria.pedido_formulado_med a
join catalogo.cat_insumos c on c.id_insumos=substr(a.id_insumos,1,3)
where a.id_cc>0 and a.fecha>=subdate(date(now()),10) and a.pedido>0
group by a.suc,substr(a.id_insumos,1,3))";
    $this->db->query($s3);
    $s4="insert ignore into papeleria.insumos_s
(id_cc, id_dd, fol, id_insumos, canp, cans, fecha_cap, tipo, costo, costo_cat, canr, fecha_sur, fecha_val)

(sELECT a.id_cc,(select id from papeleria.insumos_d x where x.id_cc=a.id_cc and x.id_insumos=substr(a.id_insumos,1,3)),
'A',
substr(a.id_insumos,1,3),sum(pedido),sum(pedido),CURRENT_TIMESTAMP,1,c.costo,c.costo,sum(pedido),'0000-00-00','0000-00-00'
FROM  papeleria.pedido_formulado_med a
join catalogo.cat_insumos c on c.id_insumos=substr(a.id_insumos,1,3)
where a.id_cc>0 and a.fecha>=subdate(date(now()),10) and a.pedido>0
group by a.suc,substr(a.id_insumos,1,3))";
    $this->db->query($s4);
    $s5="delete from papeleria.pedido_formulado_med";
    $this->db->query($s5);
}

////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
function insumos_ctl_f($id_comprar)
{
    $s="select fecha,a.fecha_cap,a.id_cc,b.suc,c.nombre as sucx,
(select sum(canp_sup) from papeleria.insumos_d x where x.id_cc=a.id_cc and tipo in (1,2,3) group by x.id_cc)as ped,
ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and  fecha_sur>'0000-00-00' group by x.id_cc ),0)as sur,

((ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and  fecha_sur>'0000-00-00' group by x.id_cc ),0)/
(select sum(canp_sup) from papeleria.insumos_d x where x.id_cc=a.id_cc and tipo in (1,2,3) group by x.id_cc))*100)as nivel_sur
from papeleria.insumos_s a
join papeleria.insumos_c b on b.id=a.id_cc
join catalogo.sucursal c on c.suc=b.suc
where b.tipo in(1,2,3) and b.id_comprar=$id_comprar and c.tipo3 in('FA','MO','DA','FE') and date_format(b.fecha_cap,'%Y-%m-%d') > subdate(date(now()),28)
and
(select sum(canp) from papeleria.insumos_d x where x.id_cc=a.id_cc and tipo in (1,2,3) group by x.id_cc)>
ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and tipo=2 group by x.id_cc ),0)
and (select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and x.tipo=4 group by x.id_cc ) is null
and b.fecha>='2015-07-28'
group by id_cc;";
$q=$this->db->query($s);
return $q;    
}
function insumos_ctl_f_dep($id_comprar)
{
    $s="select fecha,a.id_cc,b.suc,c.nombre as sucx,
(select sum(canp_sup) from papeleria.insumos_d x where x.id_cc=a.id_cc and tipo>0 group by x.id_cc)as ped,
ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and tipo=2 group by x.id_cc ),0)as sur,

((ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and tipo=2 group by x.id_cc ),0)/
(select sum(canp_sup) from papeleria.insumos_d x where x.id_cc=a.id_cc and tipo>0 group by x.id_cc))*100)as nivel_sur
from papeleria.insumos_s a
join papeleria.insumos_c b on b.id=a.id_cc
join catalogo.sucursal c on c.suc=b.suc
where b.tipo in(1,2,3) and b.id_comprar=$id_comprar and a.id_cc not in (select x.id_cc from catalogo.bata_rhe x where x.id_cc = a.id group by x.id_cc) and a.id_cc not in(select x.id_cc from papeleria.pedidoextra_s x where x.id_cc = a.id_cc group by x.id_cc) and c.tipo3 not in('FA','MO','DA','FE') and date_format(b.fecha_cap,'%Y-%m-%d') > subdate(date(now()),28)
and
(select sum(canp) from papeleria.insumos_d x where x.id_cc=a.id_cc and tipo>0 group by x.id_cc)>
ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and tipo=2 group by x.id_cc ),0)
and (select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and x.tipo=4 group by x.id_cc ) is null
group by id_cc;";
$q=$this->db->query($s);
return $q;    
}
function insumos_det_f($id)
{
$s="SELECT
a.id_cc, a.id_insumos, a.canp, a.canp_suc, a.canp_sup, a.costo, b.descripcion, b.empaque,
ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and x.id_dd=a.id and x.fecha_sur>'0000-00-00'),0) as sur
FROM papeleria.insumos_d a
join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
where a.tipo in (1,2,3) and a.id_cc not in(select x.id_cc from papeleria.pedido_extra x where x.id_cc = a.id_cc) and a.id_cc=$id";
$q=$this->db->query($s);
return $q;    
}
function insumos_det_fsuc($id,$suc)
{
  $s = "SELECT  a.id,a.suc, x.nombre
FROM papeleria.insumos_c a
join papeleria.insumos_s b on b.id_cc = a.id
join catalogo.cat_insumos c on c.id_insumos = b.id_insumos
join catalogo.sucursal x on x.suc=a.suc

where a.id_comprar in(1,3)
and a.tipo in(1,2,3)
and a.suc = $suc and a.id = $id
group by x.nombre";
$q=$this->db->query($s);
return $q;    
}

function insumos_ctl_his_f_sec_pa($fec1,$fec2,$id_comprar)
{
    $fec2=$fec2." 23;59:59";
    $s="select b.id_insumos,c.descripcion,sum(b.canp)as canp,
ifnull((select sum(cans) from papeleria.insumos_s x
join papeleria.insumos_c  y on y.id=x.id_cc and y.id_comprar= $id_comprar
where x.id_insumos=b.id_insumos and x.tipo in(2,3) and x.fecha_cap between '$fec1' and '$fec2'),0)as cans,

ifnull((((select sum(cans) from papeleria.insumos_s x
join papeleria.insumos_c  y on y.id=x.id_cc and y.id_comprar= $id_comprar
where x.id_insumos=b.id_insumos and x.tipo in(2,3) and x.fecha_cap between '$fec1' and '$fec2')
/sum(canp))*100),0)as por_sur

from papeleria.insumos_c  a
join papeleria.insumos_d b on b.id_cc=a.id
join catalogo.cat_insumos c on c.id_insumos=b.id_insumos
where a.id not in(select x.id_cc from papeleria.pedido_extra x where a.id = x.id_cc) 
and a.tipo in(1,2,3) and id_comprar = $id_comprar and a.fecha_cap between '$fec1' and '$fec2' and canp>0
group by b.id_insumos";
$q=$this->db->query($s);
return $q;    
}

function insumos_ctl_his_e_sec_pa($fec1,$fec2,$id_comprar)
{
    $fec2=$fec2." 23;59:59";
    $s="select b.id_insumos,c.descripcion,sum(b.canp)as canp,
ifnull((select sum(cans) from papeleria.insumos_s x
join papeleria.insumos_c  y on y.id=x.id_cc and y.id_comprar= $id_comprar
where x.id_insumos=b.id_insumos and x.tipo in(2,3) and x.fecha_cap between '$fec1' and '$fec2'),0)as cans,

ifnull((((select sum(cans) from papeleria.insumos_s x
join papeleria.insumos_c  y on y.id=x.id_cc and y.id_comprar= $id_comprar
where x.id_insumos=b.id_insumos and x.tipo in(2,3) and x.fecha_cap between '$fec1' and '$fec2')
/sum(canp))*100),0)as por_sur

from papeleria.insumos_c  a
join papeleria.insumos_d b on b.id_cc=a.id
join catalogo.cat_insumos c on c.id_insumos=b.id_insumos
where a.id in(select x.id_cc from papeleria.pedido_extra x where a.id = x.id_cc) and a.id not in(select x.id_cc from catalogo.bata_rhe x where a.id = x.id_cc)
and a.tipo in(1,2,3) and id_comprar = $id_comprar and a.fecha_cap between '$fec1' and '$fec2' and canp>0
group by b.id_insumos";
$q=$this->db->query($s);
return $q;    
}

function insumos_ctl_his_f_sec_pa_suc($fec1,$fec2,$id_comprar,$id_insumos)
{
    $fec2=$fec2." 23:59:59";
    $s="select a.id as id_cc,a.suc,d.nombre as sucx,id_comprar, b.id_insumos,c.descripcion,sum(b.canp)as canp,
(select sum(cans) from papeleria.insumos_s x 
join papeleria.insumos_c  y on y.id=x.id_cc and y.id_comprar=$id_comprar
where  y.suc=a.suc and x.id_insumos=b.id_insumos and x.tipo in(2,3) and x.fecha_cap between '$fec1' and '$fec2')as cans,

(((select sum(cans) from papeleria.insumos_s x 
join papeleria.insumos_c  y on y.id=x.id_cc and y.id_comprar=$id_comprar
where  y.suc=a.suc and x.id_insumos=b.id_insumos and x.tipo in(2,3) and x.fecha_cap between '$fec1' and '$fec2')
/sum(canp))*100)as por_sur

from papeleria.insumos_c a
join papeleria.insumos_d b on b.id_cc=a.id
join catalogo.cat_insumos c on c.id_insumos=b.id_insumos
join catalogo.sucursal d on d.suc=a.suc
where a.tipo in(1,2,3) and id_comprar =$id_comprar and a.fecha_cap between '$fec1' and '$fec2' and canp>0
and b.id_insumos=$id_insumos
group by a.suc";
$q=$this->db->query($s);
return $q;    
}
function insumos_ctl_his_f()
{
    $s="select a.suc,b.nombre as sucx, count(*)as num_ped,
(SELECT sum(cans*costo)
FROM papeleria.insumos_s aa join papeleria.insumos_c bb on bb.id=aa.id_cc where aa.tipo in(2,3) and bb.suc=a.suc
group by bb.suc)imp_sur
from papeleria.insumos_c a
join catalogo.sucursal b on a.suc=b.suc
where a.tipo in(1,2,3)
group by a.suc";
$q=$this->db->query($s);
return $q;    
}
function insumos_ctl_his_f_det($suc)
{
    $s="select a.suc,b.nombre as sucx,a.fecha,a.id as id_cc,id_comprar,c.descri as comprax,

ifnull((select sum(canp_sup) from papeleria.insumos_d x
where x.id_cc=a.id and x.tipo in(1,2,3)),0)as canp,

ifnull((select sum(cans) from papeleria.insumos_s x
where x.id_cc=a.id and x.tipo in(2,3)),0)as cans,

case
when ifnull((select sum(canp_sup) from papeleria.insumos_d x where x.id_cc=a.id and x.tipo in(1,2,3)),0)>=
ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id and x.tipo in(2,3)),0)
then
(ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id and x.tipo in(2,3)),0)/
ifnull((select sum(canp_sup) from papeleria.insumos_d x where x.id_cc=a.id and x.tipo in(1,2,3)),0))*100
end as nivel_surtido,

(SELECT sum(cans*costo)
FROM papeleria.insumos_s aa join papeleria.insumos_c bb on bb.id=aa.id_cc where aa.tipo in(2,3) and aa.id_cc=a.id
group by aa.id_cc)imp_sur

from papeleria.insumos_c a
join catalogo.sucursal b on a.suc=b.suc
join catalogo.cat_insumos_compra c on c.id_insumo=id_comprar
where a.tipo in(1,2,3) and a.suc=$suc
order by fecha desc";
$q=$this->db->query($s);
return $q;    
}
function insumos_ctl_his_busca_det($fec1,$fec2)
{
    $s="SELECT b.id_insumos,c.descripcion,sum(b.canp_sup)as can_ped,
ifnull((SELECT sum(cans)
FROM papeleria.insumos_s aa join papeleria.insumos_c bb on bb.id=aa.id_cc
where aa.tipo in(2,3) and aa.id_insumos=b.id_insumos and bb.fecha between '$fec1' and '$fec2'
group by aa.id_insumos),0)can_sur

FROM papeleria.insumos_c a
join papeleria.insumos_d b on b.id_cc=a.id
join catalogo.cat_insumos c on c.id_insumos=b.id_insumos

where canp_sup>0 and a.tipo in(1,2,3) and a.fecha between '$fec1' and '$fec2'
group by b.id_insumos";
$q=$this->db->query($s);
return $q;    
}
   function esp_insumos_sup_c()
   {
   $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
    if($nivel==12){$var='regional='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var='';}
   $s="SELECT b.nombre as sucx,a.* FROM papeleria.insumos_c a
    join catalogo.sucursal b on b.suc=a.suc
    where $var tipo=0 and stat_sup='E' 
    ";
   $q=$this->db->query($s);
   return $q;
   }
   function esp_insumos_sup_d($id_cc)
   {
   $s="select b.descripcion,a.*from papeleria.insumos_d a
    join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
    join papeleria.insumos_c c on c.id=a.id_cc 
    where c.tipo=0 and c.stat_sup='E' and id_cc=$id_cc";
   $q=$this->db->query($s);
   return $q;
   }
   function insert_esp_ped($id_cc,$id_insumos,$can)
   {
   $s="insert ignore into papeleria.insumos_d(id_cc, id_insumos, canp, canp_suc, fecha_cap, tipo, costo, costo_cat, canp_sup)
    (select $id_cc, $id_insumos, $can, $can, LOCALTIME, 1, a.costo, a.costo, $can 
    from catalogo.cat_insumos a, papeleria.insumos_c b
    where b.tipo=0 and b.stat_sup='E' and b.id=$id_cc and a.id_insumos=$id_insumos)";
   $this->db->query($s);
   }
   
function inserta_insumos_s($id)
{
$inss="insert ignore into
papeleria.insumos_s(id_cc, id_dd, fol, id_insumos, canp, cans, fecha_cap, tipo, costo, costo_cat, canr, fecha_sur, fecha_val)
(select
id_cc, id, 'A', id_insumos, (canp_sup),(canp_sup), fecha_cap, 1, costo, costo_cat, (canp_sup), '0000-00-00', '0000-00-00'
from papeleria.insumos_d where id_cc=$id and canp_sup>0)";
$this->db->query($inss);    
    
} 
function esp_insumos_sup_cer()
   {
   $s="SELECT b.nombre as sucx,a.* FROM papeleria.insumos_c a
    join catalogo.sucursal b on b.suc=a.suc
    where tipo=0 and stat_sup='EC'";
   $q=$this->db->query($s);
   return $q;
   }   
   
 function esp_insumos_sup_val_d($id_cc)
   {
   $s="select b.descripcion,a.*from papeleria.insumos_d a
    join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
    join papeleria.insumos_c c on c.id=a.id_cc 
    where c.tipo=0 and c.stat_sup='EC' and id_cc=$id_cc and a.tipo=1";
   $q=$this->db->query($s);
   return $q;
   }  
   
   function val_esp_ped($id_cc)
   {
$s1="insert ignore into
papeleria.insumos_s(id_cc, id_dd, fol, id_insumos, canp, cans, fecha_cap, tipo, costo, costo_cat, canr, fecha_sur, fecha_val)
(select
id_cc, id, 'A', id_insumos, canp_sup,canp_sup, fecha_cap, 1, costo, costo_cat, canp_sup, '0000-00-00', '0000-00-00'
from papeleria.insumos_d where id_cc=$id_cc and canp_sup>0 and tipo=1)";
$this->db->query($s1);
$s2="update papeleria.insumos_c  set tipo=1,fecha_cap=LOCALTIME where id=$id_cc and tipo=0";
$this->db->query($s2);
   }
   
   





function insumos_ctl_depto()
{
    $s="SELECT b.nombre as sucx,a.id, a.suc, a.fecha_cap
FROM papeleria.insumos_c a
join catalogo.sucursal b on b.suc=a.suc
join desarrollo.usuarios x on a.suc = x.suc
where
a.tipo=1 and id_comprar=1
and x.nivel in (54) and x.activo = 1
group by a.id";
$q=$this->db->query($s);
return $q;  
}

function insumos_ctl_suc()
{
  $s="SELECT b.nombre as sucx,a.*,sum(canp*costo)as impp,b.plantilla,c.id_cc,c.fol
FROM papeleria.insumos_c a
join catalogo.sucursal b on b.suc=a.suc
join papeleria.insumos_s c on c.id_cc=a.id
where c.tipo=1 and id_comprar=1
and b.tipo3 in ('FA', 'DA', 'FE', 'MO')
group by a.id,fol";
$q=$this->db->query($s);
return $q;    
}


function insumos_det($suc, $id)
{
$s="SELECT c.*,b.*
FROM papeleria.insumos_c a
join catalogo.cat_insumos c on c.id_insumos=b.id_insumos
where a.tipo>=1 and a.suc = $suc
and a.id=$id";
$q=$this->db->query($s);
return $q;    
}










   /************************************ form_dropdown ***********************************************/ 
function insumos_deptos()
{
    $depto=$this->session->userdata('depto'); /*se crea una session de depto almacenado en login_model*/
    $s="select a.*,b.nombre as sucx
    from papeleria.insumos_c a
    join catalogo.sucursal b on b.suc=a.suc 
    where a.tipo=0 and a.suc=$depto" ; /*Se toma en cuenta que suc es igual que la session depto*/
    $q=$this->db->query($s);
    return $q;
}

   /********************************** form_dropdown ************************************************/ 
function ped_insumos_det($id_cc)
{
    $depto=$this->session->userdata('depto');
    $s="select a.*,b.descripcion,empaque
    from papeleria.insumos_d a
    join catalogo.cat_insumos b on b.id_insumos=a.id_insumos and depto>0 
    where id_cc= $id_cc"; 
    $q=$this->db->query($s);
    return $q;
}
/* ******************************************************************************************************** */

function cierra_ped_insumos($id_cc)
    {
$s1="update
papeleria.insumos_c a,papeleria.insumos_d b,catalogo.sucursal c,catalogo.cat_insumos d
set 
canp=
case when
(case
when b.id_insumos in(46,7,10,11,12,39) and canp>=plantilla
then plantilla
when b.id_insumos in(22,23,26,27,28,29) and canp>=(SELECT (round((sum(tic)/multiplo))) FROM vtadc.venta_ctl x where month(x.fecha)=(month(a.fecha)-1)
and x.suc=a.suc group by suc)
then (SELECT (round((sum(tic)/multiplo))) FROM vtadc.venta_ctl x where month(x.fecha)=(month(a.fecha)-1)
and x.suc=a.suc group by suc)
else canp end)<=0
then 1 else
case
when b.id_insumos in(46,7,10,11,12,39) and canp>=plantilla
then plantilla
when b.id_insumos in(22,23,26,27,28,29) and canp>=(SELECT (round((sum(tic)/multiplo))) FROM vtadc.venta_ctl x where month(x.fecha)=(month(a.fecha)-1)
and x.suc=a.suc group by suc)
then (SELECT (round((sum(tic)/multiplo))) FROM vtadc.venta_ctl x where month(x.fecha)=(month(a.fecha)-1)
and x.suc=a.suc group by suc)
else canp end
end


where
a.suc=c.suc and b.id_insumos=d.id_insumos  and a.id=b.id_cc
and a.tipo=0 and id_comprar=1 and a.id=$id_cc";
$this->db->query($s1);

$s2="update papeleria.insumos_d a,papeleria.insumos_c b ,catalogo.cat_insumos c
set canp=maxi
where a.id_cc=b.id and a.id_insumos=c.id_insumos
and  a.id_insumos not in(46,7,10,11,12,39,22,23,26,27,28,29,32) and canp>maxi
and b.id_comprar=1 and b.tipo=0 and b.id=$id_cc";
$this->db->query($s2);

$s3="update papeleria.insumos_d a,papeleria.insumos_c b ,catalogo.sucursal c
set
canp=case when round(select ifnull((select count(x.succ) from catalogo.cat_empleado x where x.succ = a.succ and x.tipo = 1),0) as sumas
from catalogo.cat_empleado a
join catalogo.sucursal b on a.succ = b.suc
where
a.tipo = 1 and b.tipo3 in('FA', 'FE', 'DA','MO') and (a.puestox like 'ENCARGADO %' or
a.puestox like 'JEFE MOSTRADOR %' or
a.puestox like'MULTIFUNCIONAL%')
group by a.succ
order by a.succ/3)<=0 then 1 else round(select ifnull((select count(x.succ) from catalogo.cat_empleado x where x.succ = a.succ and x.tipo = 1),0) as sumas
from catalogo.cat_empleado a
join catalogo.sucursal b on a.succ = b.suc
where
a.tipo = 1 and b.tipo3 in('FA', 'FE', 'DA','MO') and (a.puestox like 'ENCARGADO %' or
a.puestox like 'JEFE MOSTRADOR %' or
a.puestox like'MULTIFUNCIONAL%')
group by a.succ
order by a.succ/3) end
where a.id_cc=b.id and b.suc=b.suc
and  a.id_insumos in(32)
and b.id_comprar=1 and b.tipo=0 and b.id=$id_cc";
//set
//canp=case when round(plantilla/3)<=0 then 1 else round(plantilla/3) end
$this->db->query($s3);

$s4="update papeleria.insumos_d a,papeleria.insumos_c b ,catalogo.cat_insumos c
set canp=maxi
where a.id_cc=b.id and a.id_insumos=c.id_insumos
and  a.id_insumos in(34,35) 
and b.id_comprar=1 and b.tipo=0 and b.id=$id_cc";
$this->db->query($s4);


$s10="insert ignore into papeleria.insumos_s
(id_cc, id_dd, fol, id_insumos, canp, fecha_cap, tipo, costo, costo_cat, canr, fecha_sur, fecha_val)

(SELECT
b.id_cc, b.id,'A',b.id_insumos, canp, b.fecha_cap, 1, b.costo, b.costo_cat, canp,date(now()),'0000-00-00'
FROM papeleria.insumos_c a, papeleria.insumos_d b
where a.tipo=0 and canp>0 and a.id=b.id_cc and a.id=$id_cc)";
$this->db->query($s10);
}
/***************************************************************************************/
function departamentobyInsumo()
{
     $sql = "SELECT a.suc,a.nombre,
ifnull((select nombre from catalogo.cat_medicos x
where x.matutino=a.suc and x.tipo=1  group by x.matutino),' ')as matutino,
ifnull((select nombre from catalogo.cat_medicos x
where x.vespertino=a.suc and x.tipo=1  group by x.vespertino),' ')as vespertino,
ifnull((select sum(cantidad) from papeleria.inventario_cap y where y.suc=a.suc),0)as exis

FROM catalogo.sucursal a
join catalogo.cat_medicos b on b.matutino=a.suc or b.vespertino=a.suc
where a.suc>100 and tlid=1 and dia<>'CER' and b.tipo=1
group by suc
";

        $query = $this->db->query($sql);

        return $query;
}
function insumos_medicos_inv_menu($suc){
$sql = "SELECT a.id_insumos, a.suc, b.descripcion, a.cantidad,a.fecha_cap
FROM papeleria.inventario_cap a
JOIN catalogo.cat_insumos b on b.id_insumos = a.id_insumos
and a.suc = ?;";
        $query = $this->db->query($sql, array($suc));
        return $query;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
function insumos_nac()
{
$s="select b.mes as mesx,'INSUMOS',sum(canp_suc*costo)as sucursal,sum(canp*costo)as calculo,(sum(canp_suc*costo)-sum(canp*costo))as dif
from
papeleria.insumos_c a
join papeleria.insumos_d b on b.id_cc=a.id
join catalogo.mes b on b.num=month(a.fecha_cap)
where  a.tipo in(1,2,3)
group by month(a.fecha_cap)";
$q=$this->db->query($s);
return $q;    
}
/////////////////////////////////////////////////////////////////////////////////

function pre_pedido_formulado_medico()
{
    $s="SELECT a.suc,c.nombre, sum(a.pedido*costo)as importe,fecha
    FROM papeleria.pedido_formulado_med a
    join catalogo.cat_insumos b on b.id_insumos=substr(a.id_insumos,1,3)
    join catalogo.sucursal c on c.suc=a.suc
    group by a.suc
    order by importe desc";
    $q=$this->db->query($s);
    return $q;    
}

function pre_pedido_formulado_medico_det($suc)
{
    $s="SELECT
    substr(a.id_insumos,1,3)as id_insumos,
    concat(b.descripcion,'-',ifnull((select trim(completo) from catalogo.cat_empleado xx where xx.nomina=substr(a.id_insumos,4,7)),''))as descripcion,
    a.pedido,(a.pedido*costo)as importe,fecha
    FROM papeleria.pedido_formulado_med a
    join catalogo.cat_insumos b on b.id_insumos=substr(a.id_insumos,1,3)
    join catalogo.sucursal c on c.suc=a.suc
    where a.suc=$suc
    order by importe desc";
    $q=$this->db->query($s);
    return $q;    
}

/************************************* Supervisores pedidos *****************************************************/
      function sucbyinsumo()
    {
        $sql = "select ifnull(x.especial,0) as especial,a.suc,a.nombre as sucx, a.superv, b.id_plaza
from catalogo.sucursal a
join catalogo.cat_empleado b on b.succ=a.suc and tipo=1
left join catalogo.supervisor e on e.zona=a.superv
left join catalogo.gerente d on d.ger=a.regional
left join catalogo.cat_supv_especial x on x.suc = a.suc
where a.tlid=1 and a.suc>100 and a.suc<=2899 and a.superv = ?
group by a.suc";
        $query = $this->db->query($sql, array($this->session->userdata('id_plaza')));
        return $query;
    }
   
     function pedidos_insumos_super($suc)
     {
        //$suc = $this->input->post('suc');
           $s="select a.*,f.nombre as sucx, f.superv, b.id_plaza
from papeleria.insumos_c a
join catalogo.cat_empleado b on b.succ=a.suc and b.tipo=1
join catalogo.sucursal f on a.suc = f.suc
left join catalogo.supervisor e on e.zona=f.superv
left join catalogo.gerente d on d.ger=f.regional
where f.tlid=1 and a.tipo=0 and f.superv = ?
and f.suc =  ?
group by a.id";
           $q=$this->db->query($s, array($this->session->userdata('id_plaza'), $suc));
           return $q;
     }
     
     function saca_menu_desple()
     {
         $sql = "select i.id_insumos, i.descripcion
                 from catalogo.cat_insumos i
                  where activo = 1
                  order by i.descripcion";
        $query = $this->db->query($sql); //lo almacena en login_model que es depto
        $consul = array(); //lo lanza com un arreglo para la vista
        foreach ($query->result() as $row) {
            $consul[$row->id_insumos] = $row->descripcion; //enlaza la relacion de id_insumos con su descripcion
        }
        return $consul;

     }
     
     function pedidos_super_det($id_cc)
     {
        //$id_cc = $this->input->post('id_cc');
        $s="select a.*,b.descripcion,empaque
            from papeleria.insumos_d a
            join catalogo.cat_insumos b on b.id_insumos=a.id_insumos and depto > 0
            where id_cc = ?"; 
    $q=$this->db->query($s, array($id_cc));
    return $q;
     }
     
       function getInsumoByID($id_insumos)
    {
        $this->db->where('id_insumos', $id_insumos);
        $query = $this->db->get('catalogo.cat_insumos');
        return $query;
    }

    
    
    
    
    
    
    
    
    
    
     function insumos_ctl_cont($id_comprar)
    {
       $s = "SELECT b.nombre as sucx,a.*,sum(canp*costo)as impp,b.plantilla,c.id_cc,c.fol
             FROM papeleria.insumos_c a
             join catalogo.sucursal b on b.suc=a.suc
             join papeleria.insumos_s c on c.id_cc=a.id
             join catalogo.bata_rhe d on c.id_cc = d.id_cc
             where c.tipo=1 and id_comprar= $id_comprar
             group by a.id,fol";
       $q=$this->db->query($s);
       return $q;
    }
     
     function insumos_det_cont($id_cc, $fol)
    {
     $s="select a.*,b.descripcion, b.empaque, c.id as ide,CONCAT(d.pat,'  ',d.mat,'  ',d.nom) as name ,  d.suc, e.nombre, p.puesto as puestox
              from papeleria.insumos_s a
             join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
             join catalogo.bata_rhe c on c.id_insumos = a.id_insumos and c.id_cc = a.id_cc
             left join catalogo.cat_alta_empleado d on c.id = d.id
             left join catalogo.sucursal e on d.suc = e.suc
             join catalogo.cat_puesto p on d.puesto = p.id
             where a.id_cc= $id_cc and a.fol = '$fol'
             order by b.descripcion";
     $q=$this->db->query($s);
     return $q; 
    }
    
    
    function insumos_det_cont_busca($id,$ide)
    {
      $s = "SELECT c.*,b.*,d.*,x.id as ide,CONCAT(x.pat,'  ',x.mat,'  ',x.nom) as name, p.puesto as puestox
            from papeleria.insumos_s b
            join catalogo.cat_insumos c on c.id_insumos=b.id_insumos
            join catalogo.bata_rhe d on d.id_cc = b.id_cc and d.id_insumos = b.id_insumos
            join catalogo.cat_alta_empleado x on d.id = x.id
            left join catalogo.cat_puesto p on x.puesto = p.id
            where  b.id= $id and x.id = $ide and b.tipo=1";
      $q=$this->db->query($s);
      return $q; 
    }
    
    function saca_menu_insumito($ide)
    {
      $s="SELECT trim(upper(p.puesto)) as puesto, tipo3 FROM catalogo.cat_alta_empleado c
          join catalogo.cat_puesto p on c.puesto = p.id
          join catalogo.sucursal s on c.suc = s.suc
          where c.id = $ide";
      $q = $this->db->query($s);
         if($q->num_rows() > 0)
        {
            $row = $q->row();
            $a = array();
            $a[0] = "Selecciona un producto";
            if($row->puesto == 'MEDICO')
            {
                $s1 = "select * from catalogo.cat_insumos
                where id_insumos in (65,66,67,68,69,70,71,72,73,74,75);";
                $q1 = $this->db->query($s1);
                
                foreach($q1->result() as $r)
                {
                    $a[$r->id_insumos] = $r->descripcion;
                }
            }else{
                if($row->tipo3 == 'DA')
                {
                    $s1 = "select * from catalogo.cat_insumos
                    where id_insumos in (86,87,88,89,90);";
                    $q1 = $this->db->query($s1);
                    foreach($q1->result() as $r)
                {
                    $a[$r->id_insumos] = $r->descripcion;
                }
                    
                }elseif($row->tipo3 == 'FE')
                {
                    $s1 ="select * from catalogo.cat_insumos
                     where id_insumos in (91,92,93,94,95);";
                    $q1 = $this->db->query($s1);
                    foreach($q1->result() as $r)
                {  
                    $a[$r->id_insumos] = $r->descripcion;
                }
                    
                }elseif($row->tipo3 == 'FA')
                {
                    $s1 = "select * from catalogo.cat_insumos
                    where id_insumos in (62,63,64);";
                  $q1 = $this->db->query($s1);
                      foreach($q1->result() as $r)
                {
                    $a[$r->id_insumos] = $r->descripcion;
                }
                    
                }elseif($row->puesto == 'INTENDENCIA' || $row->puesto == 'MANTENIMIENTO'){
                    $s1 = "select * from catalogo.cat_insumos
                where id_insumos in (373,374,375,376,377,378,379,380,142,143,144,145,146,147,148,149,150,151,152,153,154);";
                  $q1 = $this->db->query($s1);
                      foreach($q1->result() as $r)
                {
                    $a[$r->id_insumos] = $r->descripcion;
                }
                }
            }
      
          return $a;
       }
    }
    
    function insumos_cont_his()
    {
     $s="select year(fecha_sur)as aaa,month(fecha_sur)as mes ,b.mes as mesx
         from papeleria.insumos_s a
         join catalogo.mes b on b.num=month(fecha_sur)
         join catalogo.bata_rhe x on a.id_cc = x.id_cc
         where tipo in(2,3)
         group by year(fecha_sur),month(fecha_sur)
         order by year(fecha_sur) desc ,month(fecha_sur) desc";
     $q=$this->db->query($s);
     return $q;    
    }
    
    function insumos_cont_his_c($aaa,$mes)
    {
        $s = "SELECT b.nombre as sucx,a.*,aa.fol,aa.fecha_sur
              FROM papeleria.insumos_c a
              join papeleria.insumos_s aa on aa.id_cc=a.id
              join catalogo.bata_rhe x on aa.id_cc = x.id_cc
              join catalogo.sucursal b on b.suc=a.suc
              where aa.tipo in(2,3) and year(aa.fecha_sur)=$aaa and month(aa.fecha_sur)= $mes and b.tipo3 not in('FA','MO','DA','FE')
              group by a.id, aa.fol
              order by aa.fecha_sur desc";
    $q = $this->db->query($s);
    return $q;  
    }
   
    
    public function imprime_cont_final()
    {
      $a="<table>
        <tr>
        </ br>
        <td align=\"center\">________________________________</td>
        <td align=\"center\">_____________________________________</td>
        <td align=\"center\">________________________________</td>
        </tr>
        <tr>
        <td align=\"center\">FIRMA DEL EMPLEADO</td>
        <td align=\"center\">FIRMA DE RECURSOS HUMANOS</td>
        <td align=\"center\">FECHA DE ENTREGA</td>
        </tr>
        </table>
        ";
        return $a;  
    }
    
    public function imprime_cont_cabeza($id,$fol,$var1)
    {
     $fec=date('Y-m-d H:i:s');
     $s="SELECT a.id,a.suc,b.nombre as sucx,a.fecha_cierre,aa.fecha_sur,aa.fol,x.id as ide,CONCAT(u.pat,'  ',u.mat,'  ',u.nom) as name,p.puesto as puestox,u.suc as suce,ifnull((select trim(completo) from catalogo.cat_empleado x where x.id=aa.id_surtidor),'SIN SURTIDOR')as surtidorx
         FROM papeleria.insumos_c a
         join papeleria.insumos_s aa on aa.id_cc=a.id
         join catalogo.bata_rhe x on aa.id_cc = x.id_cc
         join catalogo.cat_alta_empleado u on x.id = u.id
         left join catalogo.cat_puesto p on u.puesto = p.id
         join catalogo.sucursal b on b.suc=u.suc
         where aa.tipo=2 and a.id=$id and aa.fol='$fol'
         group by aa.fol";
    $q=$this->db->query($s);
    if($q->num_rows()>0){
        $r=$q->row();
        //$l0='<img src="'.base_url().'img/logos.png" border="0" width="100px" />';
        $l0='<img style=\"position:relative; width:100px;\", src=\"'.base_url().'../../img/logos.png\" />';
        $a="<table>
        <tr>
        <th>$l0</th>
        <th align=\"center\"> <font size=\"+3\"><strong>CONTROL DE PEDIDOS DE PAPELERIA</strong></font></th>
        <th align=\"right\"><font size=\"+3\"><strong>$var1</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"1\" align=\"left\"><font size=\"+3\"><strong>Fecha de surtido $r->fecha_sur</strong></font></th>
        <th colspan=\"1\" align=\"left\"><font size=\"+2\"><strong>$r->surtidorx</strong></font></th>
        <th colspan=\"1\" align=\"right\"><font size=\"-2\"><strong>Fecha de impresion $fec</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"1\" align=\"left\"><font size=\"+1\"><strong>Pedido.: $id $fol</strong></font></th>
        <th colspan=\"2\" align=\"right\"><font size=\"+1\"><strong>$r->suce ".trim($r->sucx)."</strong></font></th>
        </ br>
        </tr>
        <tr>
        <th align=\"left\"><strong>Nombre del empleado: $r->name</strong></th>
        <th align=\"left\"><strong></strong></th>
        </tr>
        </ br>
        </table>
        </ br>";
        
    }else{$a='';}
    return $a;   
    }
    
   function imprime_cont_detalle($id,$fol)
    {
      $s="SELECT a.id_cc,a.id_insumos,b.descripcion,b.empaque,cans
          FROM papeleria.insumos_s a
          join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
          where  a.cans>0 and a.id_cc=$id and fol='$fol'";
      $q=$this->db->query($s);
      foreach($q->result() as $r)
    {
     $a[$r->id_insumos]['id_insumos']=$r->id_insumos;
     $a[$r->id_insumos]['descripcion']=$r->descripcion;
     $a[$r->id_insumos]['empaque']=$r->empaque;
     $a[$r->id_insumos]['cans']=$r->cans;
    }   
     return $a;         
   }
   
   function insumos_ctl_extra($id_comprar)
   {
    $s = "SELECT b.nombre as sucx,a.*,sum(canp*costo)as impp,b.plantilla,c.id_cc,c.fol
          FROM papeleria.insumos_c a
          join catalogo.sucursal b on b.suc=a.suc
          join papeleria.insumos_s c on c.id_cc=a.id and c.tipo = 1
          join papeleria.pedidoextra_s d on c.id_cc = d.id_cc and a.id = d.id_cc and d.id_insumos_s = c.id
          where d.tipo = 1 and id_comprar = $id_comprar and a.fecha > subdate(date(now()),95)
          group by a.id,d.folio";
    $q=$this->db->query($s);
    return $q;
   }
   
   function insumos_extra_det($id_cc,$fol)
   {
    $s="SELECT a.*,c.descripcion, c.empaque,b.can_p,b.can_s as sur,b.nomina as nom,d.completo, d.succ as suc,e.nombre as sucx, d.puestox, b.id_ex
        FROM papeleria.insumos_s a        
        join catalogo.cat_insumos c on c.id_insumos=a.id_insumos
        join papeleria.pedidoextra_s b on b.id_cc = a.id_cc and b.id_insumos = a.id_insumos and a.id = b.id_insumos_s and b.id_insumos = c.id_insumos
        left join catalogo.cat_empleado d on b.nomina = d.nomina and d.tipo = 1
        left join catalogo.sucursal e on d.succ = e.suc
        join catalogo.cat_puesto p on d.puesto = p.id
        where a.id_cc = $id_cc and b.folio = '$fol' and a.fol = '$fol' and a.tipo<>4
        order by b.nomina, c.descripcion";
     $q=$this->db->query($s);
     return $q; 
   }
   
   function insumos_extra_det2($id_cc, $fol)
   {
    $s="select a.id_insumos,a.costo, b.descripcion, b.empaque, ifnull((select sum(x.canp) from papeleria.insumos_s x where x.id_insumos = b.id_insumos and x.id_cc = $id_cc and fol = '$fol'),0) as canp, ifnull((select sum(x.cans) from papeleria.insumos_s x where x.id_insumos = b.id_insumos and x.id_cc = $id_cc and fol = '$fol'),0) as cans
        from papeleria.insumos_s a
        join catalogo.cat_insumos b using(id_insumos)
        where a.tipo = 1 and a.id_cc = $id_cc and a.fol = '$fol'
        group by id_insumos
        order by b.descripcion";
     $q=$this->db->query($s);
     return $q; 
   }
   
   function actualiza_ped_cero($sur,$id_cc, $id)
   {
    $s="update papeleria.insumos_s a,papeleria.pedido_extra b, catalogo.cat_insumos c, papeleria.insumos_c d
         set a.cans = a.cans - $sur, a.canr = a.cans
         where a.id_cc = b.id_cc and a.id_insumos = c.id_insumos and a.id_insumos = b.id_insumos
         and  d.id_comprar=1 and a.tipo=1 and a.id_cc = $id_cc and a.id = $id";
    $this->db->query($s); 
   }
   
      
   function actualiza_ped_cani($cantidad,$id_cc, $id)
   {
    $s="update papeleria.insumos_s a,papeleria.pedidoextra_s b, catalogo.cat_insumos c, papeleria.insumos_c d
        set cans = a.cans - $cantidad, a.canr = a.cans
        where a.id_cc = b.id_cc and a.id_cc = d.id and a.id_insumos = c.id_insumos and a.id_insumos = b.id_insumos
        and  d.id_comprar=1 and a.tipo=1 and a.id_cc = $id_cc and a.id = $id";
    $this->db->query($s);
   }
   
   function actualiza_ped_can($cantidad,$id_cc, $id_insumos)
   {
    $s="update papeleria.insumos_s a,papeleria.pedidoextra_s b, catalogo.cat_insumos c, papeleria.insumos_c d
        set a.canp = a.canp + $cantidad, a.cans = a.cans + $cantidad , a.canr = a.cans
        where a.id_cc = b.id_cc and a.id_cc = d.id and a.id_insumos = c.id_insumos and a.id_insumos = b.id_insumos
        and d.id_comprar=1 and a.tipo=1 and a.id_cc = $id_cc and a.id_insumos = $id_insumos";
    $this->db->query($s);
   }
   
   function  actualiza_ped_can2($cantidad,$id_cc, $id)
   {
    $s="update papeleria.insumos_s a,papeleria.pedidoextra_s b, catalogo.cat_insumos c, papeleria.insumos_c d
        set cans = a.cans - $cantidad, a.canr = a.cans
        where a.id_cc = b.id_cc and a.id_insumos = c.id_insumos and a.id_insumos = b.id_insumos
        and  d.id_comprar=1 and a.tipo=1 and a.id_cc = $id_cc and a.id = $id";
    $this->db->query($s);
   }
   
   function can_mas2_extra($can, $id_cc,$insumos,$id,$id_dd)
   {
     $s="update papeleria.insumos_s a,papeleria.pedidoextra_s b, catalogo.cat_insumos c, papeleria.insumos_c d
        set a.cans = a.cans + $can, a.canr = a.cans + $can
        where a.id_cc = b.id_cc and a.id_cc = d.id and a.id_insumos = c.id_insumos and a.id_insumos = b.id_insumos
        and  d.id_comprar=1 and a.tipo=1 and a.id_cc = $id_cc and  a.id_insumos  = $insumos and a.id = $id and a.id_dd=$id_dd";
    $this->db->query($s);
   }
   
   function can_menos_extra($can, $id_cc,$insumos,$id,$id_dd)
   {
     $s="update papeleria.insumos_s a,papeleria.pedidoextra_s b, catalogo.cat_insumos c, papeleria.insumos_c d
        set a.cans = a.cans - $can, a.canr = a.cans - $can
        where a.id_cc = b.id_cc and a.id_cc = d.id and a.id_insumos = c.id_insumos and a.id_insumos = b.id_insumos
        and  d.id_comprar=1 and a.tipo=1 and a.id_cc = $id_cc and  a.id_insumos  = $insumos and a.id = $id and a.id_dd=$id_dd";
    $this->db->query($s);
   }
   
      function can_mas_extra($can_despues, $can, $id_cc,$insumos,$id,$id_dd)
   {
     $s="update papeleria.insumos_s a,papeleria.pedidoextra_s b, catalogo.cat_insumos c, papeleria.insumos_c d
        set a.cans = (a.cans - $can_despues)+ $can, a.canr = (a.cans - $can_despues)+ $can
        where a.id_cc = b.id_cc and a.id_cc = d.id and a.id_insumos = c.id_insumos and a.id_insumos = b.id_insumos
        and  d.id_comprar=1 and a.tipo=1 and a.id_cc = $id_cc and  a.id_insumos  = $insumos and a.id = $id and a.id_dd = $id_dd";
    $this->db->query($s);
   }

   function insumos_extra_bus($id_cc,$id,$id_ex)
   {
    $s="select a.*,b.descripcion, b.empaque,d.nomina,d.completo, d.succ as suc,e.nombre as sucx, d.puestox,c.id_ex,c.can_p as cantidad,c.can_s
        from papeleria.insumos_s a
        join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
        join papeleria.pedidoextra_s c on c.id_insumos = a.id_insumos and c.id_cc = a.id_cc and c.id_insumos_s = a.id
        left join catalogo.cat_empleado d on c.nomina = d.nomina
        left join catalogo.sucursal e on d.succ = e.suc
        join catalogo.cat_puesto p on d.puesto = p.id
        where a.id_cc= $id_cc and a.id = $id and c.id_ex = $id_ex
        order by b.descripcion";
    $q=$this->db->query($s);
    return $q;            
   }
      function insumos_extra_bus2($id_cc,$id,$id_dd,$id_ex)
   {
    $s="select a.*,b.descripcion, b.empaque,d.nomina,d.completo, d.succ as suc,e.nombre as sucx, d.puestox,c.id_ex,c.can_p as cantidad,c.can_s
        from papeleria.insumos_s a
        join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
        join papeleria.pedidoextra_s c on c.id_insumos = a.id_insumos and c.id_cc = a.id_cc and c.id_insumos_s = a.id
        left join catalogo.cat_empleado d on c.nomina = d.nomina
        left join catalogo.sucursal e on d.succ = e.suc
        join catalogo.cat_puesto p on d.puesto = p.id
        where a.id_cc= $id_cc and a.id = $id and a.id_dd = $id_dd and c.id_ex = $id_ex
        order by b.descripcion";
    $q=$this->db->query($s);
    return $q;            
   }
   
   function menu_emple_extra($nomina)
   {
    $sql ="select a.*, x.id_inicio from catalogo.cat_empleado a
           join catalogo.sucursal b on a.succ = b.suc
           join catalogo.cat_puesto c on a.puesto = c.id
           join papeleria.pedidoextra_s x on a.nomina = x.nomina
           where a.nomina = ?";
    $query = $this->db->query($sql, $nomina);
    $r =  $query->row();
    $suc = array();
         if($r->personal == 'SIND' and $r->id_inicio == 907){ //SINDICALIZADOS
             $s1 = "SELECT  id_insumos, descripcion, empaque
                    from catalogo.cat_insumos
                    where id_insumos in(719,720,721,722,723,724,725,726)
                    order by descripcion;";
             $q1 = $this->db->query($s1);
             foreach ($q1->result() as $r) {
             $suc[$r->id_insumos] = $r->descripcion;
               }
         }else{
          $sql ="select a.*, x.id_inicio from catalogo.cat_empleado a
           join catalogo.sucursal b on a.succ = b.suc
           join catalogo.cat_puesto c on a.puesto = c.id
           join papeleria.pedidoextra_s x on a.nomina = x.nomina
           where a.nomina = ?";
         $query = $this->db->query($sql, $nomina);
         if($query->num_rows() > 0){
            
           $r =  $query->row();  
           $suc = null;
		   
               if($r->succ == 90029 and $r->id_inicio == 1244){ //PAPELERIA
               $s1 = "SELECT  id_insumos, descripcion, empaque
                      from catalogo.cat_insumos
                      where id_insumos in(373,374,375,376,377,378,379,380,142,143,144,145,146,147,148,149,150,151,152,153,154,719,720,721,722,723,724,725,726,727,728,729,730,731,732,733)
                      order by descripcion;";
               $q1 = $this->db->query($s1);
               foreach ($q1->result() as $r) {
               $suc[$r->id_insumos] = $r->descripcion;
              }
             }elseif(($r->puesto== 4 || $r->puesto== 17) and $r->id_inicio == 1235){ //CHOFER
               $s1 = "SELECT  id_insumos, descripcion, empaque
                      from catalogo.cat_insumos
                      where id_insumos in(723,724,725,726,727,728,729,730,731,732,733)
                      order by descripcion;";
               $q1 = $this->db->query($s1);
               foreach ($q1->result() as $r) {
               $suc[$r->id_insumos] = $r->descripcion;
               }
             }elseif(($r->puesto == 24 || $r->puesto == 25 || $r->puesto == 26) and ($r->id_inicio == 1242 || $r->id_inicio == 824)){ //CHOFER CAMION || CHOFER CAMIONETA
               $s1 = "SELECT  id_insumos, descripcion, empaque
                      from catalogo.cat_insumos
                      where id_insumos in(365,366,367,368,369,370,371,372,155,156,157,158,159,160,161,162,163,723,724,725,726,727,728,729,730,731,732,733)
                      order by descripcion;";
               $q1 = $this->db->query($s1);
               foreach ($q1->result() as $r) {
               $suc[$r->id_insumos] = $r->descripcion;
               }
             }elseif($r->puesto == 49 and $r->id_inicio == 845){ //INTENDENCIA
               $s1 = "SELECT  id_insumos, descripcion, empaque
                      from catalogo.cat_insumos
                      where id_insumos in(142,143,144,145,146,147,148,149,150,151,152,153,154,719,720,721,722,723,724,725,726,727,728,729,730,731,732,733)
                      order by descripcion;";
               $q1 = $this->db->query($s1);
               foreach ($q1->result() as $r) {
                $suc[$r->id_insumos] = $r->descripcion;
              }
             }elseif($r->puesto == 62 and $r->id_inicio == 845){ //MANTENIMIENTO
                if($r->nomina == 71305){
                 $s1 = "SELECT  id_insumos, descripcion, empaque
                      from catalogo.cat_insumos
                      where id_insumos in (365,366,367,368,369,370,371,372,155,156,157,158,159,160,161,162,163)
                      order by descripcion;";
               $q1 = $this->db->query($s1);
               foreach ($q1->result() as $r) {
                $suc .= '<option value="'.$r->id_insumos.'">'.$r->descripcion.'</option>';
                 }
               }else{
               $s1 = "SELECT  id_insumos, descripcion, empaque
                      from catalogo.cat_insumos
                      where id_insumos in (373,374,375,376,377,378,379,380,142,143,144,145,146,147,
                      148,149,150,151,152,153,154,719,720,721,722,723,724,725,726,727,728,729,730,731,732,733)
                      order by descripcion;";
               $q1 = $this->db->query($s1);
               foreach ($q1->result() as $r) {
                $suc .= '<option value="'.$r->id_insumos.'">'.$r->descripcion.'</option>';
               }
              }
             }elseif($r->puesto == 63 and ($r->id_inicio == 1242 || $r->id_inicio == 824)){ //MECANICO
               $s1 = "SELECT  id_insumos, descripcion, empaque
                      from catalogo.cat_insumos
                      where id_insumos in(723,724,725,726,727,728,729,730,731,732,733)
                      order by descripcion;";
               $q1 = $this->db->query($s1);
               foreach ($q1->result() as $r) {
                $suc[$r->id_insumos] = $r->descripcion;
              }
             }elseif(($r->puesto == 67 || $r->puesto = 11) and ($r->id_inicio == 1242 || $r->id_inicio == 824)){ //11->AUXILIAR DE ALMACEN || 67->MULTIFUNCIONAL
               $s1 = "SELECT  id_insumos, descripcion, empaque
                      from catalogo.cat_insumos
                      where id_insumos in(373,374,375,376,377,378,379,380,142,143,144,145,146,147,
                      148,149,150,151,152,153,154)
                      order by descripcion;";
               $q1 = $this->db->query($s1);
               foreach ($q1->result() as $r) {
                $suc[$r->id_insumos] = $r->descripcion;
              }
             }elseif(($r->puesto = 91 || $r->puesto == 101) and ($r->id_inicio == 1242 || $r->id_inicio == 824)){ //91->SUPERVISOR DE ALMACEN 101->ENCARGADO DE ALMACEN
               $s1 = "SELECT  id_insumos, descripcion, empaque
                      from catalogo.cat_insumos
                      where id_insumos in (62,63,64,723,724,725,726)
                      order by descripcion;";
               $q1 = $this->db->query($s1);
               foreach ($q1->result() as $r) {
                $suc[$r->id_insumos] = $r->descripcion;
              }
             }
            }
		  }
          return $suc;
       }



       function getPedidoExtra_sByID_ex($id_ex)
    {
        $this->db->where('id_ex', $id_ex);
        $query = $this->db->get('papeleria.pedidoextra_s');
        return $query;
    }
    
    function getInsumo_sByID($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('papeleria.insumos_s');
        return $query;   
    }
    
    function valida_piezas_insumos_d2($id_cc,$fol,$id_surtidor)
    {
     $s="update papeleria.insumos_c a, papeleria.insumos_d b
         set b.tipo=2
         where a.tipo=2 and a.id=b.id_cc and b.canp>0 and a.id=$id_cc";
     $this->db->query($s);
  
     $s1="update papeleria.insumos_c a, papeleria.insumos_s b, papeleria.pedido_extra u,papeleria.pedidoextra_s x
          set b.tipo=2, b.fecha_sur=CURRENT_TIMESTAMP(), x.fecha_sur = CURRENT_TIMESTAMP(), x.tipo = 2, b.id_surtidor=$id_surtidor
          where a.tipo=2 and u.tipo = 2 and a.id=b.id_cc and a.id = x.id_cc and a.id = u.id_cc and b.fol = x.folio and a.id=$id_cc and b.fol='$fol'";
     $this->db->query($s1); 

     $s3="select fol from papeleria.insumos_s where id_cc=$id_cc and fol>='A' group by fol";
     $q3=$this->db->query($s3);
     $con=($q3->num_rows()+65);
           for ($i=65;$i<=$con;$i++) {
                $letra=chr($i);                 
               }
     $s4="insert into
          papeleria.insumos_s(id_cc, id_dd, fol, id_insumos, canp, cans, fecha_cap, tipo, costo,id, costo_cat, canr, fecha_sur, fecha_val)
          (select
          id_cc, id_dd, 'A', id_insumos, (canp-cans),(canp-cans), fecha_cap, 4,id, costo, costo_cat, (canp-cans), '0000-00-00', '0000-00-00'
          from papeleria.insumos_s where id_cc= $id_cc and fol='$fol' and canp>0 and cans<>canp and concat(id_insumos, id) not in(select concat(id_insumos, id_insumos_s) from papeleria.pedidoextra_s where id_cc = $id_cc)) on duplicate key update tipo = 4;";
     $this->db->query($s4);
     
     $max = "insert ignore into
          papeleria.insumos_s(id_cc, id_dd, fol, id_insumos, canp, cans, fecha_cap, tipo,id, costo, costo_cat, canr, fecha_sur, fecha_val)
          (select
          id_cc, id_dd, '$letra', id_insumos, (canp-cans),(canp-cans), fecha_cap, 1, id,costo, costo_cat, (canp-cans), '0000-00-00', '0000-00-00'
          from papeleria.insumos_s where id_cc=$id_cc and fol='$fol' and canp>0 and cans<>canp and concat(id_insumos, id) in(select concat(id_insumos, id_insumos_s) from papeleria.pedidoextra_s where id_cc = $id_cc))";
     $this->db->query($max);

     $max2 = "insert ignore into papeleria.pedidoextra_s
     (id_cc,id_ex,nomina,id_inicio,id_insumos,fecha_cap,fecha_sur,can_p, can_s,tipo,folio,id_insumos_s)
     (select id_cc,id_ex,nomina,id_inicio,id_insumos,fecha_cap,'0000-00-00',(pedidoextra_s.can_p-pedidoextra_s.can_s),(pedidoextra_s.can_p-pedidoextra_s.can_s),1,'$letra',id_insumos_s
     from papeleria.pedidoextra_s where id_cc = $id_cc and folio = '$fol' and can_p>0 and can_s<>can_p)";
      $this->db->query($max2);
     $s6="select (sum(a.canp)-(select sum(x.cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and x.tipo=2))as dif
          from papeleria.insumos_d a where id_cc=$id_cc";
     $q6=$this->db->query($s6);
         if($q6->num_rows()>0){
            $r6=$q6->row();
              if($r6->dif<=0){
     $s7="update papeleria.insumos_c set tipo=3 where id=$id_cc";
     $this->db->query($s7);    
     }}   
    }
    
     
   function insumos_extra_his()
   {
     $s="select year(a.fecha_sur)as aaa,month(a.fecha_sur)as mes ,b.mes as mesx
         from papeleria.insumos_s a
         join catalogo.mes b on b.num=month(a.fecha_sur)
         join papeleria.pedidoextra_s x on a.id_cc = x.id_cc
         where a.tipo in(2,3) and x.tipo in (2,3)
         group by year(a.fecha_sur),month(a.fecha_sur)
         order by year(a.fecha_sur) desc ,month(a.fecha_sur) desc";
     $q=$this->db->query($s);
     return $q;   
   }

   function insumos_extra_hisc($aaa,$mes)
   {
    $s = "SELECT b.nombre as sucx,a.*,aa.fol,aa.fecha_sur
          FROM papeleria.insumos_c a
          join papeleria.insumos_s aa on aa.id_cc=a.id
          join papeleria.pedidoextra_s x on aa.id_cc = x.id_cc
          join catalogo.sucursal b on b.suc=a.suc
          where aa.tipo in(2,3) and x.tipo in (2,3) and year(aa.fecha_sur)=$aaa and month(aa.fecha_sur)= $mes and b.tipo3 not in('FA','MO','DA','FE')
          group by a.id, aa.fol
          order by aa.fecha_sur desc";
    $q = $this->db->query($s);
    return $q;
   }
   
    function insumos_extra_hisc2($id,$fol)
   {
    $s = "select a.*,x.fol, b.nomina,c.completo,c.puestox, c.succ  as suc, d.nombre as sucx
          from papeleria.insumos_c a
          join papeleria.insumos_s x on a.id = x.id_cc and x.cans>0
          join papeleria.pedidoextra_s b on a.id = b.id_cc and b.id_insumos = x.id_insumos and b.id_insumos_s = x.id and b.can_s>0
          join catalogo.cat_empleado c on b.nomina = c.nomina
          join catalogo.sucursal d on c.succ = d.suc
          where a.tipo in (2,3) and b.tipo in (2,3) and x.tipo in(2,3) and a.id = $id and b.folio = '$fol' and b.folio = '$fol'
          group by b.nomina order by c.completo";
    $q = $this->db->query($s);
    return $q;
   }
    
   function imprime_extra_final($id, $nomina)
   {
    $s="SELECT a.*,b.nombre, b.puesto,d.completo,d.puestox FROM papeleria.pedidoextra_s a
        join papeleria.insumos_c c on a.id_cc = c.id
        join desarrollo.usuarios b on a.id_inicio = b.id
        join catalogo.cat_empleado d on a.nomina = d.nomina
        join catalogo.sucursal x on x.suc = d.succ
        where a.id_cc = $id and a.nomina = $nomina";
    $q=$this->db->query($s);
     if($q->num_rows()>0){
        $r=$q->row();
    $a="<table>
        <tr>
        </ br>
        <td align=\"center\">______________________________________</td>
        <td align=\"center\">________________________________________</td>
        <td align=\"center\">________________________________</td>
        </tr>
        <tr>
        <td align=\"center\">FIRMA DEL EMPLEADO</td>
        <td align=\"center\">$r->nombre - ".trim($r->puesto)."</td>
        <td align=\"center\">FECHA DE ENTREGA</td>
        </tr>
        </table>
        ";
        }
    return $a;
   }
   
   function imprime_extra_cabeza($id,$fol,$nomina,$var1)
   {
     $fec=date('Y-m-d H:i:s');
     $s="select a.id, a.fecha_cierre,aa.fecha_sur,b.descripcion, b.empaque,d.nomina as nom,d.completo, d.succ as suc,e.nombre as sucx, d.puestox, c.id_ex, ifnull((select trim(completo) from catalogo.cat_empleado x where x.id=aa.id_surtidor),'SIN SURTIDOR')as surtidorx
         FROM papeleria.insumos_c a
         join papeleria.insumos_s aa on aa.id_cc=a.id
         join catalogo.cat_insumos b on b.id_insumos=aa.id_insumos
         join papeleria.pedidoextra_s c on c.id_insumos = aa.id_insumos and c.id_cc = aa.id_cc and c.folio = aa.fol
         left join catalogo.cat_empleado d on c.nomina = d.nomina
         left join catalogo.sucursal e on d.succ = e.suc
         join catalogo.cat_puesto p on d.puesto = p.id
         where aa.tipo in (2,3) and c.tipo in (2,3) and a.id= $id and aa.fol = '$fol' and d.nomina = $nomina
         order by b.descripcion";
    $q=$this->db->query($s);
    if($q->num_rows()>0){
        $r=$q->row();
        //$l0='<img src="'.base_url().'img/logos.png" border="0" width="100px" />';
        $l0='<img style=\"position:relative; width:100px;\", src=\"'.base_url().'../../img/logos.png\" />';
        $a="<table>
        <tr>
        <th>$l0</th>
        <th align=\"center\"> <font size=\"+3\"><strong>CONTROL DE PEDIDOS DE PAPELERIA</strong></font></th>
        <th align=\"right\"><font size=\"+3\"><strong>$var1</strong></font></th>
        </tr>
         <tr>
        <th colspan=\"1\" align=\"left\"><font size=\"+3\"><strong>Fecha de surtido $r->fecha_sur</strong></font></th>
        <th colspan=\"1\" align=\"left\"><font size=\"+2\"><strong>$r->surtidorx</strong></font></th>
        <th colspan=\"1\" align=\"right\"><font size=\"-2\"><strong>Fecha de impresion $fec</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"1\" align=\"left\"><font size=\"+1\"><strong>Pedido.: $id $fol</strong></font></th>
        <th colspan=\"2\" align=\"right\"><font size=\"+1\"><strong>$r->suc ".trim($r->sucx)."</strong></font></th>
        </ br>
        </tr>
        <tr>
        <th align=\"left\"><strong>Nombre del empleado: ".trim($r->completo)."</strong></th>
        <th align=\"left\"><strong></strong></th>
        <th align=\"right\"><strong>N&oacute;mina: $r->nom</strong></th>
        </tr>
        </ br>
        </table>
        </ br>";
        
    }else{$a='';}
    return $a; 
   }
   
   function imprime_extra_detalle($id,$fol,$nomina)
   {
    $s="SELECT a.id_cc,a.id_insumos,b.descripcion,b.empaque, x.can_s as cans
          FROM papeleria.insumos_s a
          join papeleria.pedidoextra_s x on a.id_cc = x.id_cc and a.id = x.id_insumos_s
          join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
          where  a.tipo in (2,3) and x.tipo in (2,3) and a.cans>0 and a.id_cc=$id and x.folio ='$fol' and nomina = $nomina";
    $q=$this->db->query($s);
      foreach($q->result() as $r){
     $a[$r->id_insumos]['id_insumos']=$r->id_insumos;
     $a[$r->id_insumos]['descripcion']=$r->descripcion;
     $a[$r->id_insumos]['empaque']=$r->empaque;
     $a[$r->id_insumos]['cans']=$r->cans;
      }   
     return $a;  
   }




/***************************************** inventario *********************************/
function inventario_insumos()
{
  $s="select a.*,b.descripcion,b.empaque
      from papeleria.inv_insumos a
      join catalogo.cat_insumos b on a.id_insumos = b.id_insumos";
  $q = $this->db->query($s);
  return $q;
}


function obten_insumo($id_insumos)
{
  $s="select a.*,b.descripcion,b.empaque
      from papeleria.inv_insumos a
      join catalogo.cat_insumos b on a.id_insumos = b.id_insumos
      where a.id_insumos = $id_insumos";
  $q = $this->db->query($s);
  return $q;  
}

function actualiza_inventario($data,$id_insumos)
{
     $this->db->where('id_insumos', $id_insumos);
        $query = $this->db->get('papeleria.inv_insumos');
        if ($query->num_rows() > 0) {
            $this->db->update('papeleria.inv_insumos', $data, array('id_insumos' => $id_insumos));
        } else {

        }
}


function imprime_inventario_cabeza()
{
  $fec=date('Y-m-d H:i:s');
  $l0='<img src="'.base_url().'img/logos.png" border="0" width="100px" />';
  $tabla ="<table>
  <tr>
  <th>$l0</th>
  <th align=\"center\"> <font size=\"+3\"><strong>CONTROL DE INVENTARIO DE PAPELERIA</strong></font></th>
  </tr>
  <tr>
  <th colspan=\"1\" align=\"right\"><font size=\"-2\"><strong>Fecha de impresion $fec</strong></font></th>
  </tr>
  </table>";
  return $tabla;   
}

 function imprime_inv_detalle()
 {
  $s = "select a.*, b.descripcion, b.empaque from papeleria.inv_insumos a
        join catalogo.cat_insumos b on b.id_insumos = a.id_insumos
        where b.activo = 1";
  $q = $this->db->query($s);
   if($q->num_rows()>0){     
        $tabla .= '
       <table style="font-size: 18px;" border="1" cellpadding="3">
        <thead>
         <tr> 
           <th width="10%" style="font-size: 25px;"><strong>Cod</strong></th>
           <th width="40%" style="font-size: 25px;"><strong>Descripcion</strong></th>
           <th width="20%" style="font-size: 25px;"><strong>Empaque</strong></th>
           <th width="20%" style="font-size: 25px;"><strong>En existencia</strong></th>                      
       </tr>
       </thead>
       <tbody>';
        foreach ($q->result() as $row) {
            $tabla .= '
        <tr>
        <td width="10%" style="font-size: 18px;">'.$row->id_insumos.'</td>
        <td width="40%" style="font-size: 18px;">'.$row->descripcion.'</td>
        <td width="20%" style="font-size: 18px;">'.$row->empaque.'</td>
        <td width="20%" style="font-size: 18px;">'.$row->existencia.'</td>
        </tr>
            ';
            }
        $tabla .= '
    </tbody>
    </table>'; 
    } 
    return $tabla;  
 }
 
 function inventario_facturitas()
{
 $s="select a.folio, b.razon_social, a.fecha
     from papeleria.control_facturas a
     join catalogo.proveedor_insumos b on a.id_prov = b.id
     where a.tipo = 0";
 $q = $this->db->query($s);
 return $q;   
}

function busca_proveedor_ins()
{
  $sql = "select * from catalogo.proveedor_insumos
          order by razon_social";
  $query = $this->db->query($sql);
  $proveedor = array(); 
    foreach ($query->result() as $row) {
  $proveedor[$row->id] = $row->razon_social;
   }
   return $proveedor;   
}

function inserta_folio_fact($folio, $id)
{
  $this->db->where('folio', $folio);
  $query = $this->db->get('papeleria.control_facturas');
    if ($query->num_rows() == 0) {
    $data = array(
    'folio' => $folio,
    'id_prov' => $id,
    'fecha' => date('Y-m-d'),
    'fecha_cap' => date('Y-m-d H:i:s'),
    'fecha_cierre' =>date('0000-00-00 00:00:00'),
    'tipo' => 0);
  $this->db->insert('papeleria.control_facturas', $data);
  } else {}   
}

function obten_insumobyfact()
{
   $sql = "select a.id_insumos, b.descripcion, b.empaque from papeleria.inv_insumos a
          join catalogo.cat_insumos b on a.id_insumos = b.id_insumos
          where b.activo = 1 order by b.descripcion";
   $query = $this->db->query($sql);
   $id_insumos = array(); 
   foreach ($query->result() as $row) {
   $id_insumos[$row->id_insumos] = $row->descripcion;
   }
   return $id_insumos;    
}

function muestra_ins_byfact($folio)
{
 $s="select a.folio, a.id_insumos, c.descripcion, c.empaque, a.cantidad, a.precio, a.subtotal, (a.subtotal * a.iva) as iva, a.total
     from papeleria.detalle_facturas a
     join papeleria.control_facturas b on a.folio = b.folio
     join catalogo.cat_insumos c on a.id_insumos = c.id_insumos
     where a.folio = '$folio' and a.tipo = 0";
 $q = $this->db->query($s);
 return $q;
}

function muestra_total_fact($folio)
{
 $s="select ifnull(sum(a.subtotal * a.iva),0.00) as iva_total, ifnull(sum(total),0.00) as total
     from papeleria.detalle_facturas a
     join papeleria.control_facturas b on a.folio = b.folio
     join catalogo.cat_insumos c on a.id_insumos = c.id_insumos
     where a.folio = '$folio' and a.tipo = 0";
 $q = $this->db->query($s);
 return $q;   
}

function ver_ins_fact($folio, $id_insumos)
{
 $s = "select a.folio, a.id_insumos, c.descripcion,  a.cantidad, a.precio, a.iva
       from papeleria.detalle_facturas a
       join papeleria.control_facturas b on a.folio = b.folio
       join catalogo.cat_insumos c on a.id_insumos = c.id_insumos
       where a.folio = '$folio' and a.id_insumos  = $id_insumos and a.tipo = 0";
 $q = $this->db->query($s);
 return $q;
}
 
 function actualiza_ins_fact($data, $folio, $id_insumos)
 {
  $s = "select a.folio, a.id_insumos, c.descripcion,  a.cantidad, a.precio, a.subtotal, a.total, a.iva
       from papeleria.detalle_facturas a
       join papeleria.control_facturas b on a.folio = b.folio
       join catalogo.cat_insumos c on a.id_insumos = c.id_insumos
       where a.folio = '$folio' and a.id_insumos  = $id_insumos and a.tipo = 0";
  $q = $this->db->query($s);
  if ($q->num_rows() > 0) { 
       $this->db->update('papeleria.detalle_facturas', $data, array('folio' => $folio, 'id_insumos' => $id_insumos));
        } else {}
 }
 
 function actualiza_inv_exis($folio)
 {
  $s="update papeleria.detalle_facturas a, papeleria.control_facturas b,  papeleria.inv_insumos c, catalogo.cat_insumos d
      set c.existencia = a.cantidad + c.existencia
      where a.folio = b.folio and a.id_insumos = c.id_insumos and a.id_insumos = d.id_insumos
      and a.tipo = 1 and b.tipo = 1 and a.folio = '$folio'";
  $this->db->query($s);
 }
 
  function facturas_his()
  {
     $s = "select year(a.fecha_cierre)as aaa,month(a.fecha_cierre)as mes ,c.mes as mesx
           from papeleria.control_facturas a
           join catalogo.proveedor_insumos b on b.id = a.id_prov
           join catalogo.mes c on c.num=month(a.fecha_cierre)
           where a.tipo = 1
           group by year(a.fecha_cierre),month(a.fecha_cierre)
           order by year(a.fecha_cierre) desc ,month(a.fecha_cierre) desc";
  $q = $this->db->query($s);
  return $q;   
  }
  
  function facturas_hisc($aaa,$mes)
  {
   $s="select a.folio,a.id_prov, b.razon_social as proveedor, year(a.fecha_cierre)as aaa,month(a.fecha_cierre)as mes ,c.mes as mesx
       from papeleria.control_facturas a
       join catalogo.proveedor_insumos b on b.id = a.id_prov
       join catalogo.mes c on c.num=month(a.fecha_cierre)
       where a.tipo = 1 and year(a.fecha_cierre)='$aaa' and month(a.fecha_cierre)='$mes'
       group by a.folio order by a.folio";
  $q = $this->db->query($s);
  return $q; 
  }
  
  function cabeza_facturas_imp($folio,$id_prov)
  {
   $fec=date('Y-m-d H:i:s');
   $s="select a.folio, b.id_prov, c.razon_social as proveedor, b.fecha
          from papeleria.detalle_facturas a
          join papeleria.control_facturas b on a.folio = b.folio
          join catalogo.proveedor_insumos c on b.id_prov = c.id
          join catalogo.cat_insumos d on d.id_insumos = a.id_insumos
          where a.tipo = 1 and b.tipo = 1 and a.folio = '$folio' and id_prov = $id_prov
          group by a.folio";
   $q = $this->db->query($s);
   if($q->num_rows() > 0){
   $r=$q->row();
   $l0='<img src="'.base_url().'img/logos.png" border="0" width="100px" />';
   $tabla .="<table>
   <tr>
   <th align=\"center\">$l0</th>
   <th align=\"center\"><font size=\"+3\"><strong>CONTROL DE ENTRADA DE FACTURAS PAPELERIA</strong></font></th>
   </tr>
   <tr>
   <th colspan=\"1\" align=\"left\"><font size=\"+1\"><strong>Fecha de ingreso:  $r->fecha</strong></font></th>
   <th colspan=\"1\" align=\"right\"><font size=\"-2\"><strong>Fecha de impresion:  $fec</strong></font></th>
   </tr>
   <tr>
   <th colspan=\"1\" align=\"left\"><font size=\"+1\"><strong>Proveedor:  $r->proveedor</strong></font></th>
   <th colspan=\"1\" align=\"right\"><font size=\"-2\"><strong></strong></font></th>
   </tr>
   </table>";
   }
  return $tabla;   
  }
  
  function imprime_fact_detalle($folio, $id_prov)
  {
    $s = "select a.folio, b.id_prov, c.razon_social, a.id_insumos, d.descripcion, d.empaque, a.cantidad, a.precio, a.total
          from papeleria.detalle_facturas a
          join papeleria.control_facturas b on a.folio = b.folio
          join catalogo.proveedor_insumos c on b.id_prov = c.id
          join catalogo.cat_insumos d on d.id_insumos = a.id_insumos
          where a.tipo = 1 and b.tipo = 1 and a.folio = '$folio' and id_prov = $id_prov";
  $q = $this->db->query($s);
   if($q->num_rows()>0){     
        $tabla .= '
       <table style="font-size: 18px; align: center" border="1" cellpadding="3">
        <thead>
         <tr> 
           <th width="8%"  style="font-size: 25px;"><strong>Cod</strong></th>
           <th width="35%" style="font-size: 25px;"><strong>Descripcion</strong></th>
           <th width="15%" style="font-size: 20px;"><strong>Empaque</strong></th>
           <th width="15%" style="font-size: 20px;"><strong>Cantidad</strong></th>
           <th width="15%" style="font-size: 20px;"><strong>Precio Unit</strong></th>
           <th width="15%" style="font-size: 20px;"><strong>Precio Total</strong></th>                     
       </tr>
       </thead>
       <tbody>';
        foreach ($q->result() as $row) {
            $tabla .= '
        <tr>
        <td width="8%"  style="font-size: 18px;">'.$row->id_insumos.'</td>
        <td width="35%" style="font-size: 18px;">'.$row->descripcion.'</td>
        <td width="15%" style="font-size: 18px;">'.$row->empaque.'</td>
        <td width="15%" style="font-size: 18px;">'.$row->cantidad.'</td>
        <td width="15%" style="font-size: 18px;">$'.$row->precio.'</td>
        <td width="15%" style="font-size: 18px;">$'.$row->total.'</td>
        </tr>
            ';
            }
        $tabla .= '
    </tbody>
    </table>'; 
    } 
    return $tabla;   
  }
  
  function pie_facturas_imp($folio)
  {
   $s="select ifnull(sum(a.subtotal * a.iva),0.00) as iva_total, ifnull(sum(total),0.00) as total,ifnull(sum(a.subtotal),0.00) as subtotal
       from papeleria.detalle_facturas a
       join papeleria.control_facturas b on a.folio = b.folio
       join catalogo.cat_insumos c on a.id_insumos = c.id_insumos
       where a.folio = '$folio' and a.tipo = 1 and b.tipo = 1";
   $q = $this->db->query($s);
   if($q->num_rows()>0){   
    foreach($q->result() as $row){
   $tabla ='
        <div align="right">
        <table style="font-size: 18px;" align="right">
        <tr>
        <td width="103%" style="text-align: right">TOTALES</td>        
        </tr>
        <tr>
        <td width="103%" style="font-size: 25px; text-align: right;"><strong>Subtotal: </strong> $'.$row->subtotal.'</td>
        </tr>
        <tr>
        <td width="103%" style="font-size: 25px; text-align: right;"><strong>Iva total: </strong> $'.$row->iva_total.'</td>
        </tr>
        <tr>
        <td width="103%" style="font-size: 25px; text-align: right;"><strong>Total: </strong> $'.$row->total.' </td>
        </tr>
        </table>
        </div>
        ';
     }
   }
       return $tabla;   
       
  }
  
 
 function devolucion_insumos_hisc()
 {
  $s = "select year(b.fecha_cierre)as aaa,month(b.fecha_cierre)as mes ,c.mes as mesx
        from papeleria.inv_dev_ins a
        join papeleria.folio_devoluciones b on b.folio = a.folio
        join catalogo.mes c on c.num=month(b.fecha_cierre)
        where b.estado = 1
       group by year(b.fecha_cierre),month(b.fecha_cierre)
       order by year(b.fecha_cierre) desc ,month(b.fecha_cierre) desc";
  $q = $this->db->query($s);
  return $q;  
 }
 
 function devolucion_ins_hisc2($aaa,$mes)
 {
  $s = "select a.suc,x.nombre as sucx, b.folio,  year(b.fecha_cierre)as aaa,month(b.fecha_cierre)as mes ,c.mes as mesx
        from papeleria.inv_dev_ins a
        join papeleria.folio_devoluciones b on b.folio = a.folio
        join catalogo.sucursal x on a.suc = x.suc
        join catalogo.mes c on c.num=month(b.fecha_cierre)
        where b.estado = 1 and year(b.fecha_cierre)='$aaa' and month(b.fecha_cierre)='$mes'
        group by b.folio order by b.folio";
  $q = $this->db->query($s);
  return $q;  
 }
 
 
 function folios_devoluciones()
 {
  $s = "select a.folio,a.suc, b.nombre as sucx, a.fecha_cap from papeleria.folio_devoluciones a
        join catalogo.sucursal b on b.suc = a.suc
        where a.estado = 0 order by a.folio";
  $q = $this->db->query($s);
  return $q; 
 }
 
 
 function obten_sucus()
 {
   $sql = "select * from catalogo.sucursal where tlid = 1  and suc < 99990 order by suc";
   $query = $this->db->query($sql);
   $suc = array(); 
   foreach ($query->result() as $row) {
   $suc[$row->suc] = $row->suc.'-'.$row->nombre;
   }
   return $suc;  
 }
 
 
 function obten_insdev()
 {
   $sql = "select a.id_insumos, b.descripcion, b.empaque from papeleria.inv_insumos a
          join catalogo.cat_insumos b on a.id_insumos = b.id_insumos
          where b.activo = 1 order by b.descripcion";
   $query = $this->db->query($sql);
   $id_insumos = array(); 
   foreach ($query->result() as $row) {
   $id_insumos[$row->id_insumos] = $row->descripcion;
   }
   return $id_insumos;   
 }
 
 function dev_ins_det($folio, $suc)
 {
  $s = "SELECT a.folio,a.suc, a.id_insumos, b.descripcion, b.empaque, a.cantidad
        from papeleria.inv_dev_ins a
        join catalogo.cat_insumos b on a.id_insumos = b.id_insumos
        join papeleria.folio_devoluciones d on d.folio = a.folio
        where d.estado = 0 and a.tipo = 0 and a.folio = $folio and d.suc = $suc";
  $q = $this->db->query($s);
  return $q;   
 }
 
 function actualiza_ins_inv($folio)
 {
  $s="update papeleria.inv_dev_ins a, papeleria.folio_devoluciones b,  papeleria.inv_insumos c, catalogo.cat_insumos d
      set c.existencia = a.cantidad + c.existencia
      where a.folio = b.folio and a.id_insumos = c.id_insumos and a.id_insumos = d.id_insumos
      and a.tipo = 1 and b.estado = 1 and a.folio = '$folio'";
  $this->db->query($s);   
 }
 
 function imprime_pie_devolucion()
 {
   $a="<table>
       <tr>
       <td align=\"center\">________________________________</td>
       <td align=\"center\">________________________________</td>
       <td align=\"center\">________________________________</td>
       </tr>
       <tr>
       <td align=\"center\">FIRMA DE DEVOLUCI&Oacute;N</td>
       <td align=\"center\">FIRMA DE RECIBIDO EN PAPELERIA</td>
       <td align=\"center\">FECHA DE ENTREGA</td>
       </tr>
       </table>";
   return $a;  
 }
 
 function imprime_dev_cabeza($suc,$folio,$var1)
 {
   $fec=date('Y-m-d H:i:s');
   $s="SELECT a.*,b.nombre as sucx,d.fecha_cierre
       FROM papeleria.inv_dev_ins a
       join catalogo.cat_insumos c on c.id_insumos = a.id_insumos
       join papeleria.folio_devoluciones d on d.folio = a.folio
       join catalogo.sucursal b on b.suc=a.suc and b.suc = d.suc
       where d.estado = 1 and a.folio = $folio and a.suc = $suc
       order by a.fecha desc";
     $q=$this->db->query($s);
     if($q->num_rows()>0){
        $r=$q->row();
        $l0='<img src="'.base_url().'img/logos.png" border="0" width="100px" />';
        $a="<table>
        <tr>
        <th>$l0</th>
        <th align=\"center\"> <font size=\"+3\"><strong>CONTROL DE DEVOLUCIONES DE PAPELERIA</strong></font></th>
        <th align=\"right\"><font size=\"+3\"><strong>$var1</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"2\" align=\"left\"><font size=\"+3\"><strong>Fecha de devoluci&oacute;n $r->fecha_cierre</strong></font></th>
        <th colspan=\"1\" align=\"right\"><font size=\"-2\"><strong>Fecha de impresi&oacute;n $fec</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"1\" align=\"left\"><font size=\"+1\"><strong>Folio: $folio</strong></font></th>
        <th colspan=\"2\" align=\"right\"><font size=\"+1\"><strong>$r->suc ".trim($r->sucx)."</strong></font></th>
        </tr>
        </table>";
    }else{$a='';}
    return $a;  
 }
 
 function imp_devolucion_detalle($suc,$folio)
 {
   $s="SELECT a.folio,a.suc,c.nombre as sucx, a.id_insumos, b.descripcion, b.empaque, a.cantidad, d.fecha_cierre
       FROM papeleria.inv_dev_ins a
       join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
       join papeleria.folio_devoluciones d on d.folio = a.folio
       join catalogo.sucursal c on c.suc=a.suc and c.suc = d.suc
       where d.estado = 1 and d.suc = $suc and a.folio = $folio";
  $q=$this->db->query($s);
  foreach($q->result() as $r)
 {
    $a[$r->id_insumos]['id_insumos']=$r->id_insumos;
    $a[$r->id_insumos]['descripcion']=$r->descripcion;
    $a[$r->id_insumos]['empaque']=$r->empaque;
    $a[$r->id_insumos]['cantidad']=$r->cantidad;
 }   
  return $a;   
 }

function inv_insumos_medicos()
{
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
    if($nivel==12){$var='regional='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var='';}
    $s="select a.suc,a.nombre as sucx,ifnull((select sum(cantidad) from papeleria.inventario_cap x where x.suc=a.suc),0)as cantidad,
    ifnull((select min(fecha_cap) from papeleria.inventario_cap x where x.suc=a.suc),'NO HIZO INVENTARIO')as fecha_cap,
    ifnull((select count(completo) from catalogo.cat_medicos x join catalogo.cat_empleado z on z.nomina=x.nomina
    where x.matutino=a.suc and x.tipo=1 or x.vespertino=a.suc and x.tipo=1),' ')as medico
from catalogo.sucursal a
where $var tlid=1 and tipo3 in('DA','MO','FE','FA') order by fecha_cap";
    $q=$this->db->query($s);
    return $q;
}
function inv_insumos_medicos_det($suc)
{
    $s="select
    a.fecha_cap,a.suc,b.nombre as sucx,a.id_insumos,c.descripcion,c.empaque,(a.cantidad)as cantidad
    From papeleria.inventario_cap a
    join catalogo.sucursal b on b.suc=a.suc
    join catalogo.cat_insumos c on c.id_insumos=a.id_insumos
    where tlid=1 and a.suc=$suc
    order by a.id_insumos";
    $q=$this->db->query($s);
    return $q;
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function insumos_ctl_en($id_comprar)
{
 $s="select fecha,a.id_cc,b.suc,c.nombre as sucx,
(select sum(canp_sup) from papeleria.insumos_d x where x.id_cc=a.id_cc and tipo>0 group by x.id_cc)as ped,
ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and tipo=2 group by x.id_cc ),0)as sur,

((ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and tipo=2 group by x.id_cc ),0)/
(select sum(canp_sup) from papeleria.insumos_d x where x.id_cc=a.id_cc and tipo>0 group by x.id_cc))*100)as nivel_sur
from papeleria.insumos_s a
join papeleria.insumos_c b on b.id=a.id_cc
join catalogo.sucursal c on c.suc=b.suc
where b.tipo in(1,2,3) and b.id_comprar=$id_comprar and a.id_cc in(select x.id_cc from catalogo.bata_rhe x where x.id_cc = a.id_cc group by x.id_cc) and a.id_cc not in(select x.id_cc from papeleria.pedidoextra_s x where x.id_cc = a.id_cc group by x.id_cc) and c.tipo3 not in('FA','MO','DA','FE') and b.fecha_cap > subdate(date(now()),28)
and
(select sum(canp) from papeleria.insumos_d x where x.id_cc=a.id_cc and tipo>0 group by x.id_cc)>
ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and tipo=2 group by x.id_cc ),0)
and (select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and x.tipo=4 group by x.id_cc ) is null
group by id_cc;";
$q=$this->db->query($s);
return $q;    
}

function insumos_ctl_eu($id_comprar)
{
 $s = "select fecha,a.id_cc,b.suc,c.nombre as sucx,
(select sum(canp_sup) from papeleria.insumos_d x where x.id_cc=a.id_cc and tipo>0 group by x.id_cc)as ped,
ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and tipo=2 group by x.id_cc ),0)as sur,

((ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and tipo=2 group by x.id_cc ),0)/
(select sum(canp_sup) from papeleria.insumos_d x where x.id_cc=a.id_cc and tipo>0 group by x.id_cc))*100)as nivel_sur
from papeleria.insumos_s a
join papeleria.insumos_c b on b.id=a.id_cc
join catalogo.sucursal c on c.suc=b.suc
where b.tipo in(1,2,3) and b.id_comprar= $id_comprar and a.id_cc not in (select x.id_cc from catalogo.bata_rhe x where x.id_cc = a.id_cc group by x.id_cc) and a.id_cc in(select x.id_cc from papeleria.pedido_extra x where x.id_cc = a.id_cc group by x.id_cc) and c.tipo3 not in('FA','MO','DA','FE')
and
(select sum(canp) from papeleria.insumos_d x where x.id_cc=a.id_cc and tipo>0 group by x.id_cc)>
ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and tipo=2 group by x.id_cc ),0)
and (select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and x.tipo=4 group by x.id_cc ) is null
group by id_cc;";  
$q=$this->db->query($s);
return $q;  
}

function insumos_det_e($id)
{
 $s="SELECT a.id_cc, a.nomina, e.completo, f.nombre as sucx, e.puestox, a.id_insumos, a.cantidad as canp, b.costo, b.descripcion,b.empaque,
ifnull((select sum(can_s) from papeleria.pedidoextra_s x where x.id_cc=a.id_cc and x.id_insumos_s=c.id and x.tipo=2 and x.nomina = e.nomina),0) as sur
FROM papeleria.pedido_extra a
join papeleria.insumos_s c on c.id_cc = a.id_cc
join catalogo.cat_insumos b on b.id_insumos=c.id_insumos and b.id_insumos = a.id_insumos
left join catalogo.cat_empleado e on e.nomina = a.nomina and (e.tipo in(1) or a.nomina = e.nomina)
left join catalogo.sucursal f on e.succ = f.suc
where a.id_cc = $id
group by a.id_ex
order by completo";
 $q=$this->db->query($s);
 return $q;       
}









//////////////////////////////////////////////////////////////////////////////////////////

}