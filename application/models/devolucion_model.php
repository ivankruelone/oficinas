<?php
class devolucion_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 

 function devolucion_ctl()
{
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
    if($nivel==12){$var='regional='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var='';}
    $s="SELECT year(fecha_cierre)as aaa,month(fecha_cierre)as mes,c.mes as mesx,count(*)as rrm,
(select sum(cantidad)
from desarrollo.devolucion_sucursal_detalle x join desarrollo.devolucion_sucursal_control y on x.devolucion=y.devolucion 
join catalogo.sucursal z on z.suc=y.suc
where $var year(y.fecha_cierre)=year(a.fecha_cierre) and month(y.fecha_cierre)=month(a.fecha_cierre))as piezas,

(select sum(cantidad*vtagen)
from desarrollo.devolucion_sucursal_detalle x
join desarrollo.devolucion_sucursal_control y on x.devolucion=y.devolucion
join catalogo.sec_generica z on z.sec=x.sec
join catalogo.sucursal zz on zz.suc=y.suc
where $var year(y.fecha_cierre)=year(a.fecha_cierre) and month(y.fecha_cierre)=month(a.fecha_cierre))as importe_vta,

(select sum(validado)
from desarrollo.devolucion_sucursal_detalle x
join desarrollo.devolucion_sucursal_control y on x.devolucion=y.devolucion
join catalogo.sec_generica z on z.sec=x.sec
join catalogo.sucursal zz on zz.suc=y.suc
where $var year(y.fecha_cierre)=year(a.fecha_cierre) and month(y.fecha_cierre)=month(a.fecha_cierre)
and statusdevolucion in(1,2))as p_validados,

(select sum(validado*vtagen)
from desarrollo.devolucion_sucursal_detalle x
join desarrollo.devolucion_sucursal_control y on x.devolucion=y.devolucion
join catalogo.sec_generica z on z.sec=x.sec
join catalogo.sucursal zz on zz.suc=y.suc
where $var year(y.fecha_cierre)=year(a.fecha_cierre) and month(y.fecha_cierre)=month(a.fecha_cierre)
and statusdevolucion in(1,2))as imp_validados,


(((select sum(validado)
from desarrollo.devolucion_sucursal_detalle x
join desarrollo.devolucion_sucursal_control y on x.devolucion=y.devolucion
join catalogo.sec_generica z on z.sec=x.sec
join catalogo.sucursal zz on zz.suc=y.suc
where $var year(y.fecha_cierre)=year(a.fecha_cierre) and month(y.fecha_cierre)=month(a.fecha_cierre)
and statusdevolucion in(1,2))/
(select sum(cantidad)
from desarrollo.devolucion_sucursal_detalle x join desarrollo.devolucion_sucursal_control y on x.devolucion=y.devolucion
join catalogo.sucursal zz on zz.suc=y.suc
where $var year(y.fecha_cierre)=year(a.fecha_cierre) and month(y.fecha_cierre)=month(a.fecha_cierre)))*100)as por_val


FROM desarrollo.devolucion_sucursal_control a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=month(fecha_cierre)
where $var statusdevolucion in(1,2) and fecha_cierre is not null
group by year(fecha_cierre),month(fecha_cierre)
";
    $q=$this->db->query($s);
    return $q;
}

function devolucion_pro($aaa,$mes)
{
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
    if($nivel==12){$var='regional='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var='';}
    $s="SELECT year(fecha_cierre)as aaa,month(fecha_cierre)as mes,aa.sec,aa.descripcion,
    sum(cantidad)as piezas,sum(cantidad*vtagen)as importe_vta,sum(validado)as validados,sum(validado*vtagen)as importe_val

FROM desarrollo.devolucion_sucursal_control a
join desarrollo.devolucion_sucursal_detalle aa on aa.devolucion=a.devolucion
join catalogo.sucursal b on b.suc=a.suc
join catalogo.sec_generica c on c.sec=aa.sec
where $var statusdevolucion>0 and fecha_cierre is not null  and year(fecha_cierre)=$aaa and month(fecha_cierre)=$mes
group by year(fecha_cierre),month(fecha_cierre),aa.sec
";
    $q=$this->db->query($s);
    return $q;
}
function devolucion_pro_suc($aaa,$mes,$sec)
{
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
    if($nivel==12){$var='regional='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var='';}
    $s="SELECT a.suc,b.nombre as sucx,aa.sec,aa.descripcion,sum(cantidad)as piezas,sum(cantidad*vtagen)as importe_vta,sum(validado)as validados,sum(validado*vtagen)as importe_val

FROM desarrollo.devolucion_sucursal_control a
join desarrollo.devolucion_sucursal_detalle aa on aa.devolucion=a.devolucion
join catalogo.sucursal b on b.suc=a.suc
join catalogo.sec_generica c on c.sec=aa.sec
where $var statusdevolucion>0 and fecha_cierre is not null  and year(fecha_cierre)=$aaa and month(fecha_cierre)=$mes
and aa.sec=$sec
group by a.suc
";
    $q=$this->db->query($s);
    return $q;
}

function devolucion_suc($aaa,$mes)
{
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
    if($nivel==12){$var='regional='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var='';}
    $s="SELECT a.suc,b.nombre as sucx,sum(cantidad)as piezas,sum(cantidad*vtagen)as importe_vta,sum(validado)as validados,sum(validado*vtagen)as importe_val,
year(fecha_cierre)as aaa,month(fecha_cierre)as mes
FROM desarrollo.devolucion_sucursal_control a
join desarrollo.devolucion_sucursal_detalle aa on aa.devolucion=a.devolucion
join catalogo.sucursal b on b.suc=a.suc
join catalogo.sec_generica c on c.sec=aa.sec
where $var statusdevolucion>0 and fecha_cierre is not null  and year(fecha_cierre)=$aaa and month(fecha_cierre)=$mes
group by year(fecha_cierre),month(fecha_cierre),a.suc
";
    $q=$this->db->query($s);
    return $q;
}
function devolucion_suc_rrm($aaa,$mes,$suc)
{
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
    if($nivel==12){$var='regional='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var='';}
    $s="SELECT fecha_cierre,id_devolucion,d.causa,statusdevolucion,tipo,a.suc,b.nombre as sucx,(cantidad)as piezas,(cantidad*vtagen)as importe_vta,(validado)as validados,
(validado*vtagen)as importe_val,
year(fecha_cierre)as aaa,month(fecha_cierre)as mes,
aa.sec,aa.descripcion,rrm,lote

FROM desarrollo.devolucion_sucursal_control a
join desarrollo.devolucion_sucursal_detalle aa on aa.devolucion=a.devolucion
join catalogo.sucursal b on b.suc=a.suc
join catalogo.sec_generica c on c.sec=aa.sec
join catalogo.cat_devolucion d on d.id=aa.id_devolucion
where $var statusdevolucion>0 and fecha_cierre is not null  and year(fecha_cierre)=$aaa and month(fecha_cierre)=$mes and a.suc=$suc
order by rrm
";
    $q=$this->db->query($s);
    return $q;
}
function devolucion_causa($aaa,$mes)
{
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
    if($nivel==12){$var='regional='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var='';}
    $s="SELECT id_devolucion,causa,a.suc,b.nombre as sucx,
    sum(cantidad)as piezas,sum(cantidad*vtagen)as importe_vta,
    sum(validado)as validados,sum(validado*vtagen)as importe_val,
year(fecha_cierre)as aaa,month(fecha_cierre)as mes,
((sum(validado)/sum(cantidad))*100)as por_val

FROM desarrollo.devolucion_sucursal_control a
join desarrollo.devolucion_sucursal_detalle aa on aa.devolucion=a.devolucion 
join catalogo.sucursal b on b.suc=a.suc
join catalogo.sec_generica c on c.sec=aa.sec
join catalogo.cat_devolucion d on d.id=aa.id_devolucion
where $var statusdevolucion>0 and fecha_cierre is not null  and year(fecha_cierre)=$aaa and month(fecha_cierre)=$mes
group by year(fecha_cierre),month(fecha_cierre),id_devolucion
";
    $q=$this->db->query($s);
    return $q;
}
function devolucion_causa_det($aaa,$mes,$id_devolucion)
{
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
    if($nivel==12){$var='regional='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var='';}
    $s="SELECT rrm,aa.sec,c.susa1,id_devolucion,causa,a.suc,b.nombre as sucx,lote,caducidad,
    (cantidad)as piezas,(cantidad*vtagen)as importe_vta,
    (validado)as validados,(validado*vtagen)as importe_val,
year(fecha_cierre)as aaa,month(fecha_cierre)as mes,
(((validado)/(cantidad))*100)as por_val

FROM desarrollo.devolucion_sucursal_control a
join desarrollo.devolucion_sucursal_detalle aa on aa.devolucion=a.devolucion 
join catalogo.sucursal b on b.suc=a.suc
join catalogo.sec_generica c on c.sec=aa.sec
join catalogo.cat_devolucion d on d.id=aa.id_devolucion
where $var statusdevolucion>0 and fecha_cierre is not null  and year(fecha_cierre)=$aaa and month(fecha_cierre)=$mes
and id_devolucion=$id_devolucion
order by rrm
";
    $q=$this->db->query($s);
    return $q;
}
}
