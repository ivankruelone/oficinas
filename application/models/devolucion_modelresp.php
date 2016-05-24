<?php
class devolucion_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 

protected function devolucion_ctl()
{
    $s="SELECT year(fecha_cierre)as aaa,month(fecha_cierre)as mes,c.mes as mesx,count(*)as rrm,
sum(case when statusdevolucion=2 then 1 else 0 end)as validados

FROM devolucion_sucursal_control a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=month(fecha_cierre)
where  statusdevolucion>0 and fecha_cierre is not null
group by year(fecha_cierre),month(fecha_cierre)
";
    $q=$this->db->query($s);
    return $q;
}





public function devolucion_inv()
{
$s3="update borrar.inv_preparado a, compras.campra_agu b
set a.factura=b.factura, a.prv_real=0, a.prvx_real=b.prv,
a.factura=b.factura, a.fecha_factura=b.fecha,
a.costo=b.costo,a.obser='COMPRAS DIRECTAS EN AGUASCALIENTES'
where a.clave=b.clave and a.lote=b.lote  and a.factura=' '";
$this->db->query($s3);



$s="update borrar.inv_preparado a, almacen.compraped_l b
set a.factura=b.factura, a.prv_real=b.prv, a.prvx_real=b.prvx,
a.factura=b.factura, a.fecha_factura=concat(b.aaas,'-',b.mess,'-',b.dias),
a.costo=b.costo,a.obser='CORRECTO EL LOTE CON PRV 2013'
where a.prv=b.prv and a.clave=b.claves and a.lote=b.lote and b.prv in(771,257,476,766) 
and a.factura=' ' and b.aaas=2013"; 
$this->db->query($s);
    
$s1="update borrar.inv_preparado a, almacen.compraped_l b
set a.factura=b.factura, a.prv_real=b.prv, a.prvx_real=b.prvx,
a.factura=b.factura, a.fecha_factura=concat(b.aaas,'-',b.mess,'-',b.dias),
a.costo=b.costo,a.obser='CORRECTO EL LOTE CON PRV 2012'
where a.prv=b.prv and a.clave=b.claves  and a.lote=b.lote and b.prv in(771,257,476,766) 
and a.factura=' ' and b.aaas=2012"; 
$this->db->query($s1);    

$s2="update borrar.inv_preparado a, almacen.compraped_l b
set a.factura=b.factura, a.prv_real=b.prv, a.prvx_real=b.prvx,
a.factura=b.factura, a.fecha_factura=concat(b.aaas,'-',b.mess,'-',b.dias),
a.costo=b.costo,a.obser='CORRECTO EL LOTE CON PRV MENOR 2012'
where a.prv=b.prv and a.clave=b.claves  and a.lote=b.lote and b.prv in(771,257,476,766) and a.factura=' '";
$this->db->query($s2);
$s3="update borrar.inv_preparado a, almacen.compraped_l b
set a.factura=b.factura, a.prv_real=b.prv, a.prvx_real=b.prvx,
a.factura=b.factura, a.fecha_factura=concat(b.aaas,'-',b.mess,'-',b.dias),
a.costo=b.costo,a.obser='CORRECTO CLAVE-LOTE'
where a.clave=b.claves   and a.lote=b.lote and a.factura=' '";
$this->db->query($s3);
$s3="update borrar.inv_preparado a, almacen.compraped_l b
set a.factura=b.factura, a.prv_real=b.prv, a.prvx_real=b.prvx,
a.factura=b.factura, a.fecha_factura=concat(b.aaas,'-',b.mess,'-',b.dias),
a.costo=b.costo,a.obser='SOLO ES POR CLAVE POR PROVEDOR'
where a.clave=b.claves   and a.factura=' '";
$this->db->query($s3);

$s3="update borrar.inv_preparado a, compras.campra_agu b
set a.factura=b.factura, a.prv_real=0, a.prvx_real=b.prv,
a.factura=b.factura, a.fecha_factura=b.fecha,
a.costo=b.costo,obser='COMPRAS DIRECTAS EN AGUASCALIENTES NO COINSIDEN LOS LOTES'
where a.clave=b.clave and a.factura=' '";
$this->db->query($s3);
$s3="update borrar.inv_preparado a, catalogo.segpop b
set a.costo=b.costo,a.factura='CATALOGO', a.prv_real=b.prv, a.prvx_real=b.prvx and a.fecha_FACTURA='0000-00-00',
obser='PRECIOS DE CATALOGO'
where a.prv=b.prv and a.clave=b.claves and a.factura=' '";
$this->db->query($s3);



$s3="insert ignore into borrar.inv_preparado_cla(suc, lab, prv, clave, descri, piezas, empaque, costo, maximo, comprado)
(select suc,lab,prv,clave,descri,sum(piezas),empaque,costo,0,0 from borrar.inv_preparado group by suc,prv,clave)";
$this->db->query($s3);

$s3="update borrar.inv_preparado_cla a, compras.maximo_seguros b
set a.maximo=b.maximo
where a.suc=b.suc and a.clave=b.clave";
$this->db->query($s3);

$s3="update borrar.inv_preparado_cla a, catalogo.costos_gobierno b
set a.empaque=b.empaque
where a.clave=b.clave";
$this->db->query($s3);

$s3="update borrar.inv_preparado_cla b
set comprado=
ifnull((select sum(cans) from almacen.compraped_l a where a.prv=b.prv and a.claves=b.clave and aaas>=2012 group by prv,claves),0)";
$this->db->query($s3);
$s3="SELECT  a.*, case when piezas>maximo then piezas-maximo else 0 end as dev
 FROM borrar.inv_preparado_cla a";
$this->db->query($s3);
$s3="SELECT  clave, descri, sum(piezas),costo, sum(maximo),sum(maximo)*3, comprado
 FROM borrar.inv_preparado_cla a where prv=257 group by clave";
$this->db->query($s3);
$s3="";
$this->db->query($s3);
$s3="";
$this->db->query($s3);
$s3="";
$this->db->query($s3);
$s3="";
$this->db->query($s3);
$s3="";
$this->db->query($s3);
$s3="";
$this->db->query($s3);
$s3="";
$this->db->query($s3);

}
public function entradas_salidas()
{
//////////////////////////////////////////////////cedis
$fec1='2013-11-01';$fec2='2013-11-08';
$s3="select a.sec,a.susa1,

(ifnull((select sum(can) from desarrollo.compra_d b where b.sec=a.sec and fechai>='2013-11-01' and date_format(fechai,'%Y-%m-%d')<='2013-11-08'
group by a.sec),0)
+
ifnull((select sum(can) from desarrollo.traspaso_c x
left join desarrollo.traspaso_d b on b.id_cc=x.id
where x.fechai>='2013-11-01' and date_format(x.fechai,'%Y-%m-%d')<='2013-11-08' and x.tipo='E' and tipo2='C' and b.sec=a.sec
group by b.sec),0)
+
ifnull((select sum(can) from desarrollo.devolucion_c x
left join desarrollo.devolucion_d b on b.id_cc=x.id
where x.tipo='E' and x.fechai>='2013-11-01' and date_format(x.fechai,'%Y-%m-%d')<='2013-11-08' and mov in(1,2)
and tipo2='C' and b.sec=a.sec group by b.sec),0))
as entradas,

(ifnull((select sum(can) from desarrollo.surtido x where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08'
and x.sec=a.sec group by x.sec ),0)
+
ifnull((select sum(can) from desarrollo.traspaso_c x
left join desarrollo.traspaso_d b on b.id_cc=x.id
where x.fechai>='2013-11-01' and date_format(x.fechai,'%Y-%m-%d')<='2013-11-08' and x.tipo='S' and tipo2='C' and b.sec=a.sec
group by b.sec),0)
+
ifnull((select sum(can) from desarrollo.devolucion_c x
left join desarrollo.devolucion_d b on b.id_cc=x.id
where x.tipo='S' and x.fechai>='2013-11-01' and date_format(x.fechai,'%Y-%m-%d')<='2013-11-08' and suc=100
and tipo2='C' and b.sec=a.sec group by b.sec),0))as salidas

from catalogo.sec_generica a

where sec>0 and sec<=2000";
$this->db->query($s3);
//////////////////////////////////////////////////controlados
$s3="SELECT a.clave,a.descri,
ifnull((SELECT sum(cans) FROM almacen.control_comprac x
left join almacen.control_comprad b on b.folio=x.folio
where x.aaas=2013 and x.mess=4 and x.dias>=1 and x.dias<=8 and b.claves=a.clave
group by b.claves),0)
+
ifnull((SELECT sum(can) FROM almacen.control_dev x
left join almacen.control_devd b on b.folio=x.folio
where x.aaas=2013 and x.mess=4 and x.dias>=1 and x.dias<=8 and b.claves=a.clave
group by b.claves and suc<>100),0)as entrada,

ifnull((SELECT sum(cantidads) FROM almacen.salidas_c x where x.aaas=2013 and x.mess=11 and x.dias>=1 and x.dias<=8
 and x.claves=a.clave),0)
+
ifnull((SELECT sum(can) FROM almacen.control_dev x
left join almacen.control_devd b on b.folio=x.folio
where x.aaas=2013 and x.mess=4 and x.dias>=1 and x.dias<=8 and b.claves=a.clave
group by b.claves and suc=100),0)as salida


FROM catalogo.cat_con a";
$this->db->query($s3);
///////////////////////////////////////////////////farmabodega
$s3="select a.clabo,susa1,
ifnull((select sum(can) from farmabodega.compra_c x
left join farmabodega.compra_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clabo
group by b.clave),0)
+
ifnull((select sum(cans) from farmabodega.traspaso_c x
left join farmabodega.traspaso_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clabo
and x.entra=1600
group by b.clave),0)
+
ifnull((select sum(cans) from farmabodega.devolucion_c x
left join farmabodega.devolucion_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clabo
and x.entra=1600 and concepto<=2
group by b.clave),0)as entrada,

ifnull((select sum(cans) from farmabodega.surtido_d x
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and x.clave=a.clabo),0)
+
ifnull((select sum(cans) from farmabodega.traspaso_c x
left join farmabodega.traspaso_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clabo
and x.sale=1600
group by b.clave),0)
+
ifnull((select sum(cans) from farmabodega.devolucion_c x
left join farmabodega.devolucion_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clabo
and x.sale=1600
group by b.clave),0)as salida

from  catalogo.catalogo_bodega a";
$this->db->query($s3);
/////////////////////////////////////////////////especialidad
$s3="SELECT a.clagob,concat(trim(susa),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta))as susa,

ifnull((select sum(can) from especialidad.compra_c x
left join especialidad.compra_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clagob
group by b.clave),0)
+
ifnull((select sum(cans) from especialidad.devolucion_c x
left join especialidad.devolucion_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clagob
and x.entra=100 and concepto<=2
group by b.clave),0)as entrada,

ifnull((select sum(cans) from especialidad.surtido_d x
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and x.clave=a.clagob),0)
+
ifnull((select sum(cans) from especialidad.devolucion_c x
left join especialidad.devolucion_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clagob
and x.sale=100
group by b.clave),0)as salida

FROM catalogo.cat_nuevo_general_cla a
where a.esp='E'
group by a.clagob
";
$this->db->query($s3);
//////////////////////////////////////////////////////////////////////segpop
$s3="select clave,descri,

ifnull((select sum(can) from segpop.compra_c x
left join segpop.compra_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clave
group by b.clave),0)
+
ifnull((select sum(cans) from segpop.traspaso_c x
left join segpop.traspaso_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clave
and x.entra=90002  and b.activo=1
group by b.clave),0)
+
ifnull((select sum(cans) from segpop.devolucion_c x
left join segpop.devolucion_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clave
and x.entra=90002 and concepto<=2 and b.activo=1
group by b.clave),0)as entrada,

ifnull((select sum(cans) from segpop.surtido_d x
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and x.clave=a.clave),0)
+
ifnull((select sum(cans) from segpop.traspaso_c x
left join segpop.traspaso_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clave
and x.sale=90002  and b.activo=1
group by b.clave),0)
+
ifnull((select sum(cans) from segpop.devolucion_c x
left join segpop.devolucion_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clave
and x.sale=90002  and b.activo=1
group by b.clave),0)as salida
from catalogo.costos_gobierno a
";
$this->db->query($s3); 
//////////////////////////////////////////trasimeno140
$s="select clave,descri,

ifnull((select sum(can) from trasimeno140.compra_c x
left join trasimeno140.compra_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clave
group by b.clave),0)
+
ifnull((select sum(cans) from trasimeno140.traspaso_c x
left join trasimeno140.traspaso_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clave
and x.entra=6050  and b.activo=1
group by b.clave),0)
+
ifnull((select sum(cans) from trasimeno140.devolucion_c x
left join trasimeno140.devolucion_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clave
and x.entra=6050 and concepto<=2 and b.activo=1
group by b.clave),0)as entrada,

ifnull((select sum(cans) from trasimeno140.surtido_d x
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and x.clave=a.clave),0)
+
ifnull((select sum(cans) from trasimeno140.traspaso_c x
left join trasimeno140.traspaso_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clave
and x.sale=6050  and b.activo=1
group by b.clave),0)
+
ifnull((select sum(cans) from trasimeno140.devolucion_c x
left join trasimeno140.devolucion_d b on b.id_cc=x.id
where x.fecha>='2013-11-01' and date_format(x.fecha,'%Y-%m-%d')<='2013-11-08' and b.clave=a.clave
and x.sale=6050  and b.activo=1
group by b.clave),0)as salida
from catalogo.costos_gobierno a";
$this->db->query($s);
//////////////////////////////////////////////////////aguascalientes
$s="SELECT clave,p.descripcion, sum(nueva -vieja) as piezas
FROM fenixsp.kardex k
INNER JOIN fenixsp.productos p on k.p_id = p.id
where modiicada between '2013-11-01 00:00:00' and '2013-11-08 23:59:59' 
and (tipo <> 3 and subtipo <> 300) and tipo = 1
group by p.id;";
$this->db->query($s);
//////////////////////////////////////////////////////
$s="SELECT clave,p.descripcion sum(vieja - nueva) as piezas
FROM fenixsp.kardex k
INNER JOIN fenixsp.productos p on k.p_id = p.id
where modiicada between '2013-11-01 00:00:00' and '2013-11-08 23:59:59' 
and (tipo <> 3 and subtipo <> 300) and tipo = 2
group by p.id
having piezas > 0;";
$this->db->query($s);
//////////////////////////////////////////////////////   
$s="";
$this->db->query($s);
//////////////////////////////////////////////////////






}



}
