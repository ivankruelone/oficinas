<?php
class backoffice_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


 function ver_facturas()
{
    $s="SELECT year(a.fecha)as aaa,month(a.fecha)as mes,c.mes as mesx,prv,b.razo,sum(imp_prv)as monto,count(*)as num_fac
    FROM compras.pre_factura_fenix_ctl a
    join catalogo.provedor b on b.prov=a.prv
    join catalogo.mes c on c.num=month(a.fecha)
    where year(a.fecha)=year(date(now()))
    group by a.prv,year(a.fecha),month(a.fecha)
    order by fecha desc";
    $q=$this->db->query($s);
    return $q;    
}
function ver_facturas_producto($aaa,$mes,$prv)
{
    $s="SELECT a.cod,b.descripcion,sum(can)as can,sum(importe)as monto, 
    ifnull((select sum(cant) from vtadc.vta_backoffice x where x.cod=a.cod and year(x.fecha)=2016 and month(x.fecha)=3),0)as venta
    FROM compras.pre_factura_fenix a
join catalogo.cat_fanasa b on b.codigo=a.cod
where prv=$prv and year(fecha)=$aaa and month(fecha)=$mes
group by cod
order by can desc";
    $q=$this->db->query($s);
    return $q;    
}
function ver_facturas_factura($aaa,$mes,$prv)
{
    $s="SELECT fecha,c.nombre,a.suc,fac,sum(can)as can,sum(importe)as monto FROM compras.pre_factura_fenix a
join catalogo.cat_fanasa b on b.codigo=a.cod
join catalogo.sucursal c on c.suc=a.suc
where prv=$prv and year(fecha)=$aaa and month(fecha)=$mes
group by fac
order by fecha desc,a.suc";
    $q=$this->db->query($s);
    return $q;    
}
function ver_facturas_sucursal($aaa,$mes,$prv)
{
    $s="SELECT c.nombre,a.suc,sum(can)as can,sum(importe)as monto
    FROM compras.pre_factura_fenix a
join catalogo.cat_fanasa b on b.codigo=a.cod
join catalogo.sucursal c on c.suc=a.suc
where prv=$prv and year(fecha)=$aaa and month(fecha)=$mes
group by a.suc
order by suc";
    $q=$this->db->query($s);
    return $q;    
}
function ver_facturas_dia($aaa,$mes,$prv)
{
    $s="SELECT fecha,sum(can)as can,sum(importe)as monto 
    FROM compras.pre_factura_fenix a
join catalogo.cat_fanasa b on b.codigo=a.cod
join catalogo.sucursal c on c.suc=a.suc
where prv=$prv and year(fecha)=$aaa and month(fecha)=$mes
group by fecha
order by fecha desc";
    $q=$this->db->query($s);
    return $q;    
}
function ver_pedidos_nivel()
{
    $s="SELECT prv,razo,year(fecha)as aaa,month(fecha)as mes,c.mes as mesx,count(*)as producto,sum(case when sur>0 then +1 else +0 end) as pro_surtido,
((sum(case when sur>0 then +1 else +0 end)/count(*))*100)as nivel_surtido_pro,
sum(piezas)as piezas, sum(sur)as surtido,((sum(sur)/sum(piezas))*100) as nivel_surtido_pie
FROM compras.pre_pedido_fenix_det a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=month(fecha)
join catalogo.provedor d on d.prov=a.prv
where  a.fol>=119 and a.suc<>193
group by year(fecha),month(fecha),prv";
    $q=$this->db->query($s);
    return $q;    
}
function ver_ped_suc($aaa,$mes,$prv)
{
    $s="SELECT year(fecha)as aaa,month(fecha)as mes,a.suc,b.nombre as sucx,count(*)as producto,sum(case when sur>0 then +1 else +0 end) as pro_surtido,
((sum(case when sur>0 then +1 else +0 end)/count(*))*100)as nivel_surtido_pro,
sum(piezas)as piezas, sum(sur)as surtido,((sum(sur)/sum(piezas))*100) as nivel_surtido_pie
FROM compras.pre_pedido_fenix_det a
join catalogo.sucursal b on b.suc=a.suc
where  a.fol>=119 and a.suc<>193 and year(fecha)=$aaa and month(fecha)=$mes and a.prv=$prv
group by year(fecha),month(fecha),a.suc";
    $q=$this->db->query($s);
    return $q;    
}
function ver_ped_pro($aaa,$mes,$prv)
{
    $s="SELECT year(fecha)as aaa,month(fecha)as mes,cod,descri,count(*)as producto,sum(case when sur>0 then +1 else +0 end) as pro_surtido,
((sum(case when sur>0 then +1 else +0 end)/count(*))*100)as nivel_surtido_pro,
sum(piezas)as piezas, sum(sur)as surtido,((sum(sur)/sum(piezas))*100) as nivel_surtido_pie
FROM compras.pre_pedido_fenix_det a
join catalogo.sucursal b on b.suc=a.suc
where  a.fol>=119 and a.suc<>193 and year(fecha)=$aaa and month(fecha)=$mes and a.prv=$prv
group by year(fecha),month(fecha),cod";
    $q=$this->db->query($s);
    return $q;    
}
function ver_ped_dia($aaa,$mes,$prv)
{
    $s="SELECT year(fecha)as aaa,month(fecha)as mes,fecha,count(*)as producto,sum(case when sur>0 then +1 else +0 end) as pro_surtido,
((sum(case when sur>0 then +1 else +0 end)/count(*))*100)as nivel_surtido_pro,
sum(piezas)as piezas, sum(sur)as surtido,((sum(sur)/sum(piezas))*100) as nivel_surtido_pie
FROM compras.pre_pedido_fenix_det a
join catalogo.sucursal b on b.suc=a.suc
where  a.fol>=119 and a.suc<>193 and year(fecha)=$aaa and month(fecha)=$mes and a.prv=$prv
group by fecha";
    $q=$this->db->query($s);
    return $q;    
}
































///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////ventas
function diario_ven_back($id)
{
$s="select c.tel,c.tel1,
case when fecha_act='0000-00-00' then ' ' else fecha_act end as fecha_act,date(now())as fecha_hoy,
ifnull(WEEKDAY(fecha),0)as dia,a.back,a.suc,a.nombre as sucx ,
ifnull(b.fecha,'0000-00-00')as fecha,ifnull(sum(cant),0) as piezas
from catalogo.sucursal a
left join vtadc.vta_backoffice b on b.suc=a.suc and b.fecha=case when $id=1 then date(now()) else subdate(date(now()),1) end
left join desarrollo.sucursales c on c.suc=a.suc
where a.back>0 and a.tlid=1 group by a.suc,b.fecha
order by fecha,back,a.suc";
$q=$this->db->query($s);
return $q;
}
function guarda_ventas_f()
{
$s="insert ignore into oficinas.problemas_conexion(fecha, procesos, suc, tipo, observacion)
(select date(now()),'VENTAS',a.suc,'A',''
from catalogo.sucursal a
left join vtadc.vta_backoffice b on b.suc=a.suc and b.fecha>= subdate(date(now()),1)
where a.back>0 and a.tlid=1 and cant is null
group by a.suc,day(b.fecha)
order by fecha,back,a.suc)";
$q=$this->db->query($s);
}
function vista_todo()
{
$s="select a.*,b.nombre,b.back,b.fecha_act from oficinas.problemas_conexion a
left join catalogo.sucursal b on b.suc=a.suc
where tipo='A' and fecha_act='0000-00-00'
order by fecha desc,back,suc";
$q=$this->db->query($s);
return $q;
}
function vista_todo_una($id)
{
$s="select a.*,b.nombre,b.back,b.fecha_act from oficinas.problemas_conexion a
left join catalogo.sucursal b on b.suc=a.suc
where tipo='A' and a.id=$id
order by fecha desc,back,suc";
$q=$this->db->query($s);
return $q;
}

function ventas_mensuales_general($aaa,$mes)
{
$formato=$aaa.'-'.$mes.'-01';


$s="select 
a.fecha,
day(LAST_DAY('$formato'))as dia_limite,
b.obser,
b.back,
fecha_act,month(a.fecha)as mes,
case when b.dia='CER' then b.dia else ' ' end as tras,
b.fecha_act,
b.tipo2,
a.suc,
b.nombre,
month(a.fecha),count(a.suc)dias,
c.tel,c.tel1
from vtadc.venta_ctl a
left join catalogo.sucursal b on b.suc=a.suc
left join desarrollo.sucursales c on c.suc=a.suc
where month(a.fecha)=$mes and year(a.fecha)=$aaa
group by month(a.fecha),a.suc order by tras,dias";
$q=$this->db->query($s);

return $q;   
}
function ventas_mensuales_suc($suc,$mes)
{

$s="select x.fecha,month(now())as mes,a.back,a.dia,a.tipo2,a.suc,a.nombre, imp
from catalogo.sucursal a
left join  vtadc.venta_ctl x on x.suc=a.suc and month(x.fecha)= $mes
where a.suc>100 and a.suc<=1999 and a.tlid=1 and a.suc=$suc
ORDER BY  fecha";
$q=$this->db->query($s);
return $q;   
}

////////////////////////////////////////////comisiones gontor e imperiales
public function gon_imp()
{
$s="SELECT case when month(date(now()))=1 then (year(date(now())))-1 else year(date(now())) end as aaa,num as mes,mes as mesx,dos as dias 
from catalogo.mes where num<=12";
$q=$this->db->query($s);
return $q;
}

public function gon_imp_mes($fec)
{
$s="SELECT  case when fecha_act='0000-00-00' then ' ' else fecha_act end as fecha_act,a.tipo2,a.suc,a.nombre as sucx,count(b.suc)as dias, 
(select sum(imp) from oficinas.comisionf_det x where x.suc=a.suc and date_format(x.fecha,'%Y-%m')='$fec' and x.tipo='A')as venta
FROM catalogo.sucursal a
left join  vtadc.venta_ctl  b on a.suc=b.suc and date_format(fecha,'%Y-%m')='$fec'
where a.back>0 and tlid=1 and a.suc not in(127,176,177,178,179,180,187)
group by a.suc order by dias, a.suc";
$q=$this->db->query($s);
return $q;
}
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////inventario
public function ver_inv()
    {
$s="select sem, aaa,mes,dia, date(concat(aaa,'-',mes,'-',dia))as fecha,sum(piezas)as piezas, 
count(suc)as numero,sum(importe)as importe  from oficinas.inv_mes_suc group by aaa,mes";
$q=$this->db->query($s);
return $q;
    }
public function ver_inv_suc()
    {
$s="select c.tel,c.tel1,fecha_act, date_add(b.fechai,interval +1 day)as fecha,a.suc,a.nombre,ifnull(sum(b.cantidad),0)as inv
from catalogo.sucursal a
left join desarrollo.inv b on b.suc=a.suc and b.mov=7 or b.suc=a.suc and b.mov=3
left join desarrollo.sucursales c on c.suc=a.suc
where a.suc>=100 and a.suc<=1999 and a.tlid=1  and fecha_act='0000-00-00'
group by a.suc order by fecha";
$q=$this->db->query($s);
return $q;
    }
public function ver_inv_suc_his()
    {
$s="select sem,date(concat(aaa,'-',mes,'-',dia))as fecha,aaa,mes,dia,sum(piezas)as piezas, count(suc)as numero,sum(importe)as importe 
from oficinas.inv_mes_suc_his group by aaa,mes,sem
order by sem desc";
$q=$this->db->query($s);
return $q;
    }
public function diario_inv_back()
    {
$s="SELECT DAYOFWEEK(now())as dia_hoy,
DAYOFWEEK(subdate(now(),1))as dia_ayer,a.back,year(b.fecha)as aaa,month(b.fecha)as mes ,
DAYOFWEEK(b.fecha)as dia,b.sem,b.fecha,b.suc,a.nombre,b.piezas
FROM catalogo.sucursal a
left join oficinas.inv_ctl_bak b on b.suc=a.suc and  b.sem=WEEKOFYEAR(now())
where back>0 and tlid=1
order by a.back,suc,dia";
$q=$this->db->query($s);

foreach($q->result() as $r){
            $a[$r->suc]['sem'] = $r->sem;
            $a[$r->suc]['back'] = $r->back;
            $a[$r->suc]['suc'] = $r->suc;
            $a[$r->suc]['sucx'] = $r->nombre;
            $a[$r->suc]['segundo'][$r->dia]['dia_hoy'] = $r->dia_hoy;
            $a[$r->suc]['segundo'][$r->dia]['dia_ayer'] = $r->dia_ayer;
            $a[$r->suc]['segundo'][$r->dia]['dia'] = $r->dia;
            $a[$r->suc]['segundo'][$r->dia]['piezas'] = $r->piezas;
            
        }
        return $a;
    }
function verifica_inv_mov()
{
$s="SELECT a.obser,a.fecha_act,a.dia,a.back,a.tipo2,a.suc,a.nombre,b.piezas as p_ant,b.importe as i_ant,c.piezas as p_act,c.importe as i_act
FROM catalogo.sucursal a
left join oficinas.inv_mes_suc_his b on b.suc=a.suc and b.sem=(select max(sem) from oficinas.inv_mes_suc_his)
left join oficinas.inv_mes_suc c on c.suc=a.suc
where
tlid=1 and a.suc>100 and a.suc<=2899 and a.suc not in(192) and b.piezas=c.piezas  and fecha_act='0000-00-00' and a.dia<>'CER'
or
a.suc in(100,16000,14000,12000,19000) and b.piezas=c.piezas and a.dia<>'CER'
or
tlid=1 and a.suc>100 and a.suc<=2899 and a.suc not in(192) and c.piezas is null  and fecha_act='0000-00-00' and a.dia<>'CER'
or
a.suc in(100,16000,14000,12000,19000) and c.piezas is null and a.dia<>'CER'
or
tlid=1 and a.suc>100 and a.suc<=2899 and a.suc not in(192) and c.importe=0  and fecha_act='0000-00-00' and a.dia<>'CER'
or
a.suc in(100,16000,14000,12000,19000)  and c.importe=0 and a.dia<>'CER'";
$q=$this->db->query($s);
return $q;    
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function genera_optimo($mes,$pat,$mat,$not_in)

{
$fecha=date('Y').str_pad($mes,2,"0",STR_PAD_LEFT);
$parm1='b.venta'.($mes-2);
$parm2='b.venta'.($mes-1);
$parm3='d.venta'.$mes;

$m="delete from oficinas.optimo_fenix";
$this->db->query($m);

$s="select *from catalogo.sucursal  
where tlid=1 and tipo2='F' and fecha_act='0000-00-00' and suc<900 and 
suc $not_in";
$q=$this->db->query($s);
foreach($q->result() as $r)
{
 
    $this->__arreglo_optimo_fenix($fecha,$r->suc,$parm1,$parm2,$parm3);
}
$s1="
update oficinas.optimo_fenix a
set optimo_d=
(case
when parm1>0 and parm2>0 and parm3>0 and parm1>=parm2*.7 and parm2>=parm3*.7 and parm3>=parm1*.7 then (parm1+parm2+parm3)/90
when parm1=0 and parm2>0 and parm3>0 and parm2>parm3 then ((parm2*.7)+parm3)/60
when parm1=0 and parm2>0 and parm3>0 and parm3>=parm2 then ((parm3*.7)+parm2)/60
when parm1>0 and parm2=0 and parm3>0 and parm1>parm3  then ((parm1*.7)+parm3)/60
when parm1>0 and parm2=0 and parm3>0 and parm3>=parm1 then ((parm3*.7)+parm1)/60
when parm1>0 and parm2>0 and parm3=0 and parm1>parm2 then ((parm1*.7)+parm2)/60
when parm1>0 and parm2>0 and parm3=0 and parm2>=parm1 then ((parm2*.7)+parm1)/60
when parm1>0 and parm2>0 and parm3>0 and parm3<parm2 and parm3<=parm1 and parm1>parm2*.7  and parm2>parm1*.7 and parm3<parm1*.7 then (parm1+parm2)/60
when parm1>0 and parm2>0 and parm3>0 and parm2<parm3 and parm2<=parm1 and parm1>parm3*.7  and parm3>parm1*.7 and parm2<parm1*.7 then (parm1+parm3)/60
when parm1>0 and parm2>0 and parm3>0 and parm1<parm2 and parm1<=parm3 and parm3>parm2*.7  and parm2>parm3*.7 and parm1<parm3*.7 then (parm3+parm2)/60
when parm1=0 and parm2=0 and parm3>0 then (parm3)/30
when parm1=0 and parm2>0 and parm3=0 then (parm2)/30
when parm1>0 and parm2=0 and parm3=0 then (parm1)/30

when
(case
when parm1>0 and parm2>0 and parm3>0 and parm1>=parm2*.7 and parm2>=parm3*.7 and parm3>=parm1*.7 then (parm1+parm2+parm3)/90
when parm1=0 and parm2>0 and parm3>0 and parm2>parm3 then ((parm2*.7)+parm3)/60
when parm1=0 and parm2>0 and parm3>0 and parm3>=parm2 then ((parm3*.7)+parm2)/60
when parm1>0 and parm2=0 and parm3>0 and parm1>parm3  then ((parm1*.7)+parm3)/60
when parm1>0 and parm2=0 and parm3>0 and parm3>=parm1 then ((parm3*.7)+parm1)/60
when parm1>0 and parm2>0 and parm3=0 and parm1>parm2 then ((parm1*.7)+parm2)/60
when parm1>0 and parm2>0 and parm3=0 and parm2>=parm1 then ((parm2*.7)+parm1)/60
when parm1>0 and parm2>0 and parm3>0 and parm3<parm2 and parm3<=parm1 and parm1>parm2*.7  and parm2>parm1*.7 and parm3<parm1*.7 then (parm1+parm2)/60
when parm1>0 and parm2>0 and parm3>0 and parm2<parm3 and parm2<=parm1 and parm1>parm3*.7  and parm3>parm1*.7 and parm2<parm1*.7 then (parm1+parm3)/60
when parm1>0 and parm2>0 and parm3>0 and parm1<parm2 and parm1<=parm3 and parm3>parm2*.7  and parm2>parm3*.7 and parm1<parm3*.7 then (parm3+parm2)/60
when parm1=0 and parm2=0 and parm3>0 then (parm3)/30 when parm1=0 and parm2>0 and parm3=0 then (parm2)/30
when parm1>0 and parm2=0 and parm3=0 then (parm1)/30 else 0 end)=0

and parm1>0 and parm2>0 and parm3>0 and parm1>=parm2 and parm1>=parm3 then ((parm1*.7)+parm2+parm3)/90





when
(case
when parm1>0 and parm2>0 and parm3>0 and parm1>=parm2*.7 and parm2>=parm3*.7 and parm3>=parm1*.7 then (parm1+parm2+parm3)/90
when parm1=0 and parm2>0 and parm3>0 and parm2>parm3 then ((parm2*.7)+parm3)/60
when parm1=0 and parm2>0 and parm3>0 and parm3>=parm2 then ((parm3*.7)+parm2)/60
when parm1>0 and parm2=0 and parm3>0 and parm1>parm3  then ((parm1*.7)+parm3)/60
when parm1>0 and parm2=0 and parm3>0 and parm3>=parm1 then ((parm3*.7)+parm1)/60
when parm1>0 and parm2>0 and parm3=0 and parm1>parm2 then ((parm1*.7)+parm2)/60
when parm1>0 and parm2>0 and parm3=0 and parm2>=parm1 then ((parm2*.7)+parm1)/60
when parm1>0 and parm2>0 and parm3>0 and parm3<parm2 and parm3<=parm1 and parm1>parm2*.7  and parm2>parm1*.7 and parm3<parm1*.7 then (parm1+parm2)/60
when parm1>0 and parm2>0 and parm3>0 and parm2<parm3 and parm2<=parm1 and parm1>parm3*.7  and parm3>parm1*.7 and parm2<parm1*.7 then (parm1+parm3)/60
when parm1>0 and parm2>0 and parm3>0 and parm1<parm2 and parm1<=parm3 and parm3>parm2*.7  and parm2>parm3*.7 and parm1<parm3*.7 then (parm3+parm2)/60
when parm1=0 and parm2=0 and parm3>0 then (parm3)/30 when parm1=0 and parm2>0 and parm3=0 then (parm2)/30
when parm1>0 and parm2=0 and parm3=0 then (parm1)/30 else 0 end)=0
and
parm1>0 and parm2>0 and parm3>0 and parm2>=parm3 and parm2>=parm1 then ((parm2*.7)+parm3+parm1)/90

when
(case
when parm1>0 and parm2>0 and parm3>0 and parm1>=parm2*.7 and parm2>=parm3*.7 and parm3>=parm1*.7 then (parm1+parm2+parm3)/90
when parm1=0 and parm2>0 and parm3>0 and parm2>parm3 then ((parm2*.7)+parm3)/60
when parm1=0 and parm2>0 and parm3>0 and parm3>=parm2 then ((parm3*.7)+parm2)/60
when parm1>0 and parm2=0 and parm3>0 and parm1>parm3  then ((parm1*.7)+parm3)/60
when parm1>0 and parm2=0 and parm3>0 and parm3>=parm1 then ((parm3*.7)+parm1)/60
when parm1>0 and parm2>0 and parm3=0 and parm1>parm2 then ((parm1*.7)+parm2)/60
when parm1>0 and parm2>0 and parm3=0 and parm2>=parm1 then ((parm2*.7)+parm1)/60
when parm1>0 and parm2>0 and parm3>0 and parm3<parm2 and parm3<=parm1 and parm1>parm2*.7  and parm2>parm1*.7 and parm3<parm1*.7 then (parm1+parm2)/60
when parm1>0 and parm2>0 and parm3>0 and parm2<parm3 and parm2<=parm1 and parm1>parm3*.7  and parm3>parm1*.7 and parm2<parm1*.7 then (parm1+parm3)/60
when parm1>0 and parm2>0 and parm3>0 and parm1<parm2 and parm1<=parm3 and parm3>parm2*.7  and parm2>parm3*.7 and parm1<parm3*.7 then (parm3+parm2)/60
when parm1=0 and parm2=0 and parm3>0 then (parm3)/30 when parm1=0 and parm2>0 and parm3=0 then (parm2)/30
when parm1>0 and parm2=0 and parm3=0 then (parm1)/30 else 0 end)=0
and parm1>0 and parm2>0 and parm3>0 and parm3>=parm1 and parm3>=parm2 then ((parm3*.7)+parm1+parm2)/90
 else 0 end)
";
$this->db->query($s1); 
$s1="delete from compras.pre_pedido_fenix_for";
$this->db->query($s1);    
$s2="insert ignore into compras.pre_pedido_fenix_for (fecha, suc, cod, descri, piezas, costo, prv,rel1,rel2)
(select date(now()), a.suc,a.codigo,a.descri,
case when b.lin=1 then round(((optimo_d*$pat)-inv),0)
else round(((optimo_d*$mat)-inv),0)
end as can,0,0,cod_rel1,cod_rel2
FROM oficinas.optimo_fenix a
left join catalogo.cat_mercadotecnia b on b.codigo=a.codigo
where
lin=1 and
b.sublin not in(3,4,5,6) and
(case when b.lin=1 then round(((optimo_d*$pat)-inv),0) else round(((optimo_d*$mat)-inv),0) end)>'0.99' and
optimo_d>0
or lin not in(1,2,9,10) and
(case when b.lin=1 then round(((optimo_d*$pat)-inv),0) else round(((optimo_d*$mat)-inv),0) end)>'0.99' and
optimo_d>0)
";
$this->db->query($s2);
//$s3="insert ignore into compras.pre_pedido_fenix_for (fecha, suc, cod, descri, piezas, costo, prv,rel1,rel2)
//(select date(now()),b.suc,a.codigo,descripcion,1,0,0,rel1,rel2 from catalogo.cat_mercadotecnia a,catalogo.sucursal b
//where
//a.nivel=1 and b.tlid=1 and b.suc<900 and fecha_act='0000-00-00' and tipo2='F' 
//and suc $not_in and a.lin=1 and a.sublin not in(3,4,5)
//)";
//$this->db->query($s2);
}
/////////////////////////////////////////////////////7
function __arreglo_optimo_fenix($fecha,$suc,$parm1,$parm2,$parm3)
{
$s="insert ignore into oficinas.optimo_fenix
(fecha_mes, suc, codigo, cod_rel1, cod_rel2, descri, parm1, parm2, parm3, optimo_d, inv, lab, fecha_a)
(select date(now()),a.suc,b.codigo,ifnull(c.cod_rel1,0),ifnull(cod_rel2,0),b.descripcion,
ifnull($parm1,0),
ifnull($parm2,0),
ifnull($parm3,0),
0,
ifnull((select cantidad from desarrollo.inv x where x.codigo=c.ean and a.suc=x.suc),0)as inv,
ifnull(e.labprv,'')as lab,date(now())
From catalogo.sucursal a
left join vtadc.producto_mes_suc b on b.suc=a.suc
left join vtadc.producto_mes_suc13 d on d.suc=a.suc and d.codigo=b.codigo
left join catalogo.cod_rel c on c.ean=b.codigo
left join catalogo.cat_mercadotecnia e on e.codigo=c.ean
where  tlid=1 and a.suc=$suc)
on duplicate key update optimo_d=values(optimo_d),inv=values(inv)";
$this->db->query($s);
}
///////////////////////////////////////////////////////////////////////////////////////////////pedidos
function pedido_especial()
{
$s="select a.fecha,a.suc,sum(piezas)as piezas,sum(piezas*costo)as importe ,b.nombre,
(select count(*) from compras.pre_pedido_fenix x where x.prv=0 and x.suc=a.suc)as ceros 
from compras.pre_pedido_fenix a left join catalogo.sucursal b on b.suc=a.suc 
where a.prv=500 and a.costo>0 group by a.suc";
$q=$this->db->query($s);
return $q;
}
function pedido_especial_final()
{
$ss="select a.fol,a.prv,b.razo,a.tipo, a.fecha,a.suc,sum(piezas)as piezas,sum(piezas*costo)as importe 
from compras.pre_pedido_fenix_det a 
left join catalogo.provedor b on b.prov=a.prv
where a.tipo='A' group by a.prv,a.fol";
$qq=$this->db->query($ss);
return $qq;    
}
function pedido_for_especial()
{
$ss="select a.fecha,a.suc,sum(piezas)as piezas,sum(piezas*costo)as importe ,b.nombre,
(select count(*) from compras.pre_pedido_fenix_for x where x.prv=0 and x.suc=a.suc)as ceros 
from compras.pre_pedido_fenix_for a left join catalogo.sucursal b on b.suc=a.suc 
where a.prv=500 and a.costo>0 group by a.suc";
$q=$this->db->query($ss);
return $q;
}
function pedido_for_final()
{
$ss="select a.fol,a.prv,b.razo,a.tipo, a.fecha,a.suc,sum(piezas)as piezas,sum(piezas*costo)as importe 
from compras.pre_pedido_fenix_det a 
left join catalogo.provedor b on b.prov=a.prv
where a.tipo='A' group by a.prv,a.fol";
$qq=$this->db->query($ss);
return $qq;    
}
///////////////////////////////////////////////////////////////////////////////////////////////facturas_central

///////////////////////////////////////////////////////////////////////////////////////////////catalogo banxico
function detalle_banxico()
{
$s="SELECT fecha_activo,count(*)as productos,lista FROM oficinas.cliente_banxico  group by lista,fecha_activo
order by fecha_activo desc";
$q=$this->db->query($s);
return $q;    
}




























































    
/////////////////////////////////////////////777 optimo de sucursales fenix


///////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////ventas


































///////////////////////////////////////////////////////////////////////////////////////////////////////////
public function boramefenix_descuentos()
{
$s="select rel1,rel2,lin,sublin,codigo,descripcion,ofe_fanasa,ofe_saba,fin_saba,fin_FANASA,cos_saba,cos_nadro,cos_fanasa,cos,pub,
producto,case
when	producto='NET' and (100-((cos/pub)*100))	between	0.00	and 	17.00	then	0
when	producto='NET' and (100-((cos/pub)*100))	between	17.01	and 	20.00	then	5
when	producto='NET' and (100-((cos/pub)*100))	between	20.01	and 	25.00	then	8
when	producto='NET' and (100-((cos/pub)*100))	between	25.01	and 	30.00	then	10
when	producto='NET' and (100-((cos/pub)*100))	between	30.01	and 	35.00	then	15
when	producto='NET' and (100-((cos/pub)*100))	between	35.01	and 	45.00	then	20
when	producto='NET' and (100-((cos/pub)*100))	between	45.01	and 	55.00	then	25
when	producto='NET' and (100-((cos/pub)*100))	between	55.01	and 	70.00	then	30
when	producto='NET' and (100-((cos/pub)*100))	between	70.01	and 	85.00	then	35
when	producto='NET' and (100-((cos/pub)*100))	between	85.01	and 	100.00	then	40
when	producto='NET' and (100-((cos/pub)*100))	>	100.01			then	45
when	producto='LIM' and (100-((cos/pub)*100))	between	0.00	and 	12.00	then	0
when	producto='LIM' and (100-((cos/pub)*100))	between	12.01	and 	30.00	then	10
when	producto='LIM' and (100-((cos/pub)*100))	between	30.01	and 	40.00	then	15
when	producto='LIM' and (100-((cos/pub)*100))	between	40.01	and 	45.00	then	20
when	producto='LIM' and (100-((cos/pub)*100))	>	45.01			then	25
when	producto='NOR' and (100-((cos/pub)*100))	between	0.00	and 	25.00	then	0
when	producto='NOR' and (100-((cos/pub)*100))	between	25.01	and 	30.00	then	10
when	producto='NOR' and (100-((cos/pub)*100))	between	30.01	and 	40.00	then	15
when	producto='NOR' and (100-((cos/pub)*100))	between	40.01	and 	45.00	then	20
when	producto='NOR' and (100-((cos/pub)*100))	between	45.01	and 	58.00	then	25
when	producto='NOR' and (100-((cos/pub)*100))	>	58.01			then	30
else 0 end descu,


pub-(((case
when	producto='NET' and (100-((cos/pub)*100))	between	0.00	and 	17.00	then	0
when	producto='NET' and (100-((cos/pub)*100))	between	17.01	and 	20.00	then	5
when	producto='NET' and (100-((cos/pub)*100))	between	20.01	and 	25.00	then	8
when	producto='NET' and (100-((cos/pub)*100))	between	25.01	and 	30.00	then	10
when	producto='NET' and (100-((cos/pub)*100))	between	30.01	and 	35.00	then	15
when	producto='NET' and (100-((cos/pub)*100))	between	35.01	and 	45.00	then	20
when	producto='NET' and (100-((cos/pub)*100))	between	45.01	and 	55.00	then	25
when	producto='NET' and (100-((cos/pub)*100))	between	55.01	and 	70.00	then	30
when	producto='NET' and (100-((cos/pub)*100))	between	70.01	and 	85.00	then	35
when	producto='NET' and (100-((cos/pub)*100))	between	85.01	and 	100.00	then	40
when	producto='NET' and (100-((cos/pub)*100))	>	100.01			then	45
when	producto='LIM' and (100-((cos/pub)*100))	between	0.00	and 	12.00	then	0
when	producto='LIM' and (100-((cos/pub)*100))	between	12.01	and 	30.00	then	10
when	producto='LIM' and (100-((cos/pub)*100))	between	30.01	and 	40.00	then	15
when	producto='LIM' and (100-((cos/pub)*100))	between	40.01	and 	45.00	then	20
when	producto='LIM' and (100-((cos/pub)*100))	>	45.01			then	25
when	producto='NOR' and (100-((cos/pub)*100))	between	0.00	and 	25.00	then	0
when	producto='NOR' and (100-((cos/pub)*100))	between	25.01	and 	30.00	then	10
when	producto='NOR' and (100-((cos/pub)*100))	between	30.01	and 	40.00	then	15
when	producto='NOR' and (100-((cos/pub)*100))	between	40.01	and 	45.00	then	20
when	producto='NOR' and (100-((cos/pub)*100))	between	45.01	and 	58.00	then	25
when	producto='NOR' and (100-((cos/pub)*100))	>	58.01			then	30
else 0 end)/100)*pub) as venta,




100-((cos/(pub-(((case
when	producto='NET' and (100-((cos/pub)*100))	between	0.00	and 	17.00	then	0
when	producto='NET' and (100-((cos/pub)*100))	between	17.01	and 	20.00	then	5
when	producto='NET' and (100-((cos/pub)*100))	between	20.01	and 	25.00	then	8
when	producto='NET' and (100-((cos/pub)*100))	between	25.01	and 	30.00	then	10
when	producto='NET' and (100-((cos/pub)*100))	between	30.01	and 	35.00	then	15
when	producto='NET' and (100-((cos/pub)*100))	between	35.01	and 	45.00	then	20
when	producto='NET' and (100-((cos/pub)*100))	between	45.01	and 	55.00	then	25
when	producto='NET' and (100-((cos/pub)*100))	between	55.01	and 	70.00	then	30
when	producto='NET' and (100-((cos/pub)*100))	between	70.01	and 	85.00	then	35
when	producto='NET' and (100-((cos/pub)*100))	between	85.01	and 	100.00	then	40
when	producto='NET' and (100-((cos/pub)*100))	>	100.01			then	45
when	producto='LIM' and (100-((cos/pub)*100))	between	0.00	and 	12.00	then	0
when	producto='LIM' and (100-((cos/pub)*100))	between	12.01	and 	30.00	then	10
when	producto='LIM' and (100-((cos/pub)*100))	between	30.01	and 	40.00	then	15
when	producto='LIM' and (100-((cos/pub)*100))	between	40.01	and 	45.00	then	20
when	producto='LIM' and (100-((cos/pub)*100))	>	45.01			then	25
when	producto='NOR' and (100-((cos/pub)*100))	between	0.00	and 	25.00	then	0
when	producto='NOR' and (100-((cos/pub)*100))	between	25.01	and 	30.00	then	10
when	producto='NOR' and (100-((cos/pub)*100))	between	30.01	and 	40.00	then	15
when	producto='NOR' and (100-((cos/pub)*100))	between	40.01	and 	45.00	then	20
when	producto='NOR' and (100-((cos/pub)*100))	between	45.01	and 	58.00	then	25
when	producto='NOR' and (100-((cos/pub)*100))	>	58.01			then	30
else 0 end)/100)*pub)))*100)as util_real
from catalogo.cat_mercadotecnia a

where a.lin=1 and a.sublin not in(3,4,5) and pub>0 and cos>0 and pub>cos or
a.lin>1 and pub>0 and cos>0 and pub>cos
order by util_real";
$q=$this->db->query($s); 
return $q;   
}





}
