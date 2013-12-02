<?php
class Inventario_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 public function busca_inv()
 {
 $s="select *from oficinas.inv_mes_suc group by aaa";
 $q=$this->db->query($s);
 $r=$q->row();
 return $r->dia;
 }
 
 
 public function mes()
 {
 $aaa=date('Y');$mes=10; $mesa=$mes-1;
 $s="select $aaa as aaa,a.num, a.mes as mesx,
 
 ifnull((select sum(piezas) from oficinas.inv_mes_suc_his x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=a.num-1),0)as ini_piezas,

ifnull((select sum(importe) from oficinas.inv_mes_suc_his x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=a.num-1),0)as ini_importe,

ifnull(case when a.num=month(now())
then (select sum(piezas) from oficinas.inv_mes_suc x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=a.num)
else
(select sum(piezas) from oficinas.inv_mes_suc_his x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=a.num)
end,0) as fin_piezas,

ifnull(case when a.num=month(now())
then (select sum(importe) from oficinas.inv_mes_suc x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=a.num)
else
(select sum(importe) from oficinas.inv_mes_suc_his x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=a.num)
end,0) as fin_importe,

(select sum(importe_prvocosto) from vtadc.gc_factura_suc aa 
where aa.suc>100 and aa.suc<=2000 and aa.suc<>900 and aa.suc<>1600 and aa.aaa=$aaa and aa.mes=a.num)as facturas,
(select sum(contado) from  vtadc.gc_venta_mes aa 
where aa.suc>100 and aa.suc<=2000 and aa.suc<>900 and aa.suc<>1600 and aa.aaa=$aaa and aa.mes=a.num)as contado,
(select sum(credito) from  vtadc.gc_venta_mes aa 
where aa.suc>100 and aa.suc<=2000 and aa.suc<>900 and aa.suc<>1600 and aa.aaa=$aaa and aa.mes=a.num)as credito ,
(select sum(recarga) from  vtadc.gc_venta_mes aa 
where aa.suc>100 and aa.suc<=2000 and aa.suc<>900 and aa.suc<>1600 and aa.aaa=$aaa and aa.mes=a.num)as recarga

from catalogo.mes a
where num>9 
group by a.num";  

 $q=$this->db->query($s);
 return $q;
 }   
 public function compa($aaa,$mes)
 {
 $mesa=$mes-1;
 $s="select a.*,$aaa as aaa, $mes as mes,
 
 ifnull((select sum(piezas) from oficinas.inv_mes_suc_his x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=$mesa and x.cia=a.cia),0)as ini_piezas,

ifnull((select sum(importe) from oficinas.inv_mes_suc_his x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=$mesa and x.cia=a.cia),0)as ini_importe,
 
ifnull(case when $mes=month(now())
then (select sum(piezas) from oficinas.inv_mes_suc x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=$mes and x.cia=a.cia)
else
(select sum(piezas) from oficinas.inv_mes_suc_his x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=$mes and x.cia=a.cia)
end,0) as fin_piezas,

ifnull(case when $mes=month(now())
then (select sum(importe) from oficinas.inv_mes_suc x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=$mes and x.cia=a.cia)
else
(select sum(importe) from oficinas.inv_mes_suc_his x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=$mes and x.cia=a.cia)
end,0) as fin_importe,


(select sum(importe_prvocosto) from vtadc.gc_factura_suc aa 
where aa.cia=a.cia and aa.suc>100 and aa.suc<=2000 and aa.suc<>900 and aa.suc<>1600 and aa.aaa=$aaa and aa.mes=$mes and aa.cia=a.cia
) as facturas,
(select sum(contado) from  vtadc.gc_venta_mes aa 
where aa.cia=a.cia  and aa.suc>100 and aa.suc<=2000 and aa.suc<>900 and aa.suc<>1600 and aa.aaa=$aaa and aa.mes=$mes and aa.cia=a.cia)
as contado,
(select sum(credito) from  vtadc.gc_venta_mes aa 
where aa.cia=a.cia  and aa.suc>100 and aa.suc<=2000 and aa.suc<>900 and aa.suc<>1600 and aa.aaa=$aaa and aa.mes=$mes and aa.cia=a.cia)
as credito ,
(select sum(recarga) from  vtadc.gc_venta_mes aa 
where aa.cia=a.cia  and aa.suc>100 and aa.suc<=2000 and aa.suc<>900 and aa.suc<>1600 and aa.aaa=$aaa and aa.mes=$mes and aa.cia=a.cia)
as recarga
from catalogo.compa a
where cia_activa=1 
group by a.cia";  

 $q=$this->db->query($s);
 return $q;
 }
 
 public function compa_cia($aaa,$mes,$cia)
 {
 $mesa=$mes-1;
$s="select a.*,


 ifnull((select sum(piezas) from oficinas.inv_mes_suc_his x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=$mesa and x.cia=$cia and x.suc=a.suc),0)as ini_piezas,

ifnull((select sum(importe) from oficinas.inv_mes_suc_his x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=$mesa and x.cia=$cia and x.suc=a.suc),0)as ini_importe,
 
ifnull(case when $mes=month(now())
then (select sum(piezas) from oficinas.inv_mes_suc x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=$mes and x.cia=$cia and x.suc=a.suc)
else
(select sum(piezas) from oficinas.inv_mes_suc_his x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=$mes and x.cia=$cia and x.suc=a.suc)
end,0) as fin_piezas,

ifnull(case when $mes=month(now())
then (select sum(importe) from oficinas.inv_mes_suc x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=$mes and x.cia=$cia and x.suc=a.suc)
else
(select sum(importe) from oficinas.inv_mes_suc_his x where x.suc>100 and x.suc<2000 and x.suc<>900 and x.suc<>1600 and
x.aaa=$aaa and x.mes=$mes and x.cia=$cia and x.suc=a.suc)
end,0) as fin_importe,


(select (importe_prvocosto) from vtadc.gc_factura_suc aa 
where aa.suc=a.suc and aa.aaa=$aaa and aa.mes=$mes)
 as facturas,
(select (contado) from  vtadc.gc_venta_mes aa 
where aa.suc=a.suc and aa.aaa=$aaa and aa.mes=$mes)
as contado,
(select (credito) from  vtadc.gc_venta_mes aa 
where aa.suc=a.suc and aa.aaa=$aaa and aa.mes=$mes)
as credito ,
(select (recarga) from  vtadc.gc_venta_mes aa 
where aa.suc=a.suc and aa.aaa=$aaa and aa.mes=$mes)
as recarga,

(select num_dias from  vtadc.gc_venta_mes aa 
where aa.suc=a.suc and aa.aaa=$aaa and aa.mes=$mes)
as num_dias
from catalogo.sucursal a
where a.cia=$cia and a.suc>100 and a.suc<=2000 and a.suc<>900 and a.suc<>1600 and tlid=1 ";  
$q=$this->db->query($s);
 return $q;
 }  

 
public function mes_alm()
 {
 $aaa=date('Y'); $mesa=date('m')-1;
 $s="select $aaa as aaa,a.num, a.mes as mesx,
 
ifnull((select sum(piezas) from oficinas.inv_mes_suc_his x where x.suc in(100,17000,14000,16000,6050,900,90002,1600) and
x.aaa=$aaa and x.mes=a.num-1),0)as ini_piezas,

ifnull((select sum(importe) from oficinas.inv_mes_suc_his x where x.suc in(100,17000,14000,16000,6050,900,90002,1600) and
x.aaa=$aaa and x.mes=a.num-1),0)as ini_importe,

ifnull(case when a.num=month(now())
then (select sum(piezas) from oficinas.inv_mes_suc x where x.suc in(100,17000,14000,16000,6050,900,90002,1600) and
x.aaa=$aaa and x.mes=a.num)
else
(select sum(piezas) from oficinas.inv_mes_suc_his x where x.suc in(100,17000,14000,16000,6050,900,90002,1600) and
x.aaa=$aaa and x.mes=a.num)
end,0) as fin_piezas,

ifnull(case when a.num=month(now())
then (select sum(importe) from oficinas.inv_mes_suc x where x.suc in(100,17000,14000,16000,6050,900,90002,1600) and
x.aaa=$aaa and x.mes=a.num)
else
(select sum(importe) from oficinas.inv_mes_suc_his x where x.suc in(100,17000,14000,16000,6050,900,90002,1600) and
x.aaa=$aaa and x.mes=a.num)
end,0) as fin_importe,

 
(select sum(importe) from vtadc.gc_compra_mayorista
where suc in(100,17000,17900,14000,14900,16000,16900,6050,900) 
and date_format(fecha,'%Y')=$aaa and date_format(fecha,'%m')=a.num ) as facturas,

(select sum(importe_prvcosto) 
from vtadc.gc_factura where prv=100 and aaa=$aaa and mes=a.num group by aaa,mes)
as facturado,
(select sum(cans*(vta-(vta*.10))) from farmabodega.surtido_d b where date_format(b.fecha,'%Y')=$aaa and date_format(b.fecha,'%m')=a.num)
as facturadofbo,
(SELECT sum(cantidads*costo) FROM almacen.salidas_c where aaas=$aaa and mess=a.num)as facturadocon
from catalogo.mes a
where num>9 
group by a.num";  

 $q=$this->db->query($s);
 return $q;
 }   
   
 public function div_alm($aaa,$mes)
 {
 $mesa=$mes-1;
    $s="SELECT a.nombre as tipox,a.tipo,
case
when a.tipo='agu'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where suc=14000 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='alm'
then (select sum(piezas) from oficinas.inv_mes_suc_det_his b where b.suc=900 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='cht'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where b.suc=16000 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='con'
then (select sum(piezas) from oficinas.inv_mes_suc_det_his b where b.suc=100 and b.tipo='ALM CONTROLADOS' and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='esp'
then (select sum(piezas) from oficinas.inv_mes_suc_det_his b where b.suc=100 and b.tipo='ALM ESPECIALIDAD'  and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='fbo'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where b.suc=1600 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='met'
then (select sum(piezas) from oficinas.inv_mes_suc_det_his b where b.suc=100 and b.tipo='ALM METRO' and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='seg'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where b.suc=90002 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='tra'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where b.suc=6050 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='zac'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where b.suc=17000 and b.aaa=$aaa and b.mes=$mesa)
else 0 end as in_piezas,

case
when a.tipo='agu'
then (select sum(importe) from oficinas.inv_mes_suc_his b where suc=14000 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='alm'
then (select sum(piezas*costo) from oficinas.inv_mes_suc_det_his b where b.suc=900 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='cht'
then (select sum(importe) from oficinas.inv_mes_suc_his b where b.suc=16000 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='con'
then (select sum(piezas*costo) from oficinas.inv_mes_suc_det_his b where b.suc=100 and b.tipo='ALM CONTROLADOS' and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='esp'
then (select sum(piezas*costo) from oficinas.inv_mes_suc_det_his b where b.suc=100  and b.tipo='ALM ESPECIALIDAD' and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='fbo'
then (select sum(importe) from oficinas.inv_mes_suc_his b where b.suc=1600 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='met'
then (select sum(piezas*costo) from oficinas.inv_mes_suc_det_his b where b.suc=100 and b.tipo='ALM METRO' and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='seg'
then (select sum(importe) from oficinas.inv_mes_suc_his b where b.suc=90002 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='tra'
then (select sum(importe) from oficinas.inv_mes_suc_his b where b.suc=6050 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='zac'
then (select sum(importe) from oficinas.inv_mes_suc_his b where b.suc=17000 and b.aaa=$aaa and b.mes=$mesa)
else 0 end as in_importe,

case
when a.tipo='agu'
then (select sum(importe_prvcosto) from vtadc.gc_factura b where suc>=14000 and suc<=14999 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='alm'
then (select sum(importe_prvcosto) from vtadc.gc_factura b where  b.suc=900 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='cht'
then (select sum(importe_prvcosto) from vtadc.gc_factura b where suc>=16000 and suc<=16999 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='con'
then 0
when a.tipo='esp'
then 0
when a.tipo='fbo'
then (select sum(importe_prvcosto) from vtadc.gc_factura b where b.suc=1600 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='met'
then (select sum(importe_prvcosto) from vtadc.gc_factura b where b.suc=100 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='seg'
then 0
when a.tipo='tra'
then 0
when a.tipo='zac'
then (select sum(importe_prvcosto) from vtadc.gc_factura b where suc>=17000 and suc<=17999 and b.aaa=$aaa and b.mes=$mes)
else 0 end as compra,

case
when a.tipo='agu'
then 0
when a.tipo='alm'
then (select sum(importe_prvcosto) from vtadc.gc_factura b where  b.prv=100 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='cht'
then 0
when a.tipo='con'
then (SELECT sum(cantidads*costo) FROM almacen.salidas_c where aaas=$aaa and mess=$mes)
when a.tipo='esp'
then 0
when a.tipo='fbo'
then (select sum(cans*(vta-(vta*.10))) from farmabodega.surtido_d b where date_format(b.fecha,'%Y')=$aaa and date_format(b.fecha,'%m')=$mes)
when a.tipo='met'
then 0
when a.tipo='seg'
then 0
when a.tipo='tra'
then 0
when a.tipo='zac'
then 0
else 0 end as facturado,

case
when a.tipo='agu'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where suc=14000 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='alm'
then (select sum(piezas) from oficinas.inv_mes_suc_det_his b where b.suc=900 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='cht'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where b.suc=16000 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='con'
then (select sum(piezas) from oficinas.inv_mes_suc_det_his b where b.suc=100 and b.tipo='ALM CONTROLADOS' and b.aaa=$aaa and b.mes=$mes)
when a.tipo='esp'
then (select sum(piezas) from oficinas.inv_mes_suc_det_his b where b.suc=100  and b.tipo='ALM ESPECIALIDAD' and b.aaa=$aaa and b.mes=$mes)
when a.tipo='fbo'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where b.suc=1600 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='met'
then (select sum(piezas) from oficinas.inv_mes_suc_det_his b where b.suc=100 and b.tipo='ALM METRO' and b.aaa=$aaa and b.mes=$mes)
when a.tipo='seg'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where b.suc=90002 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='tra'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where b.suc=6050 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='zac'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where b.suc=17000 and b.aaa=$aaa and b.mes=$mes)
else 0 end as fi_piezas,

case
when a.tipo='agu'
then (select sum(importe) from oficinas.inv_mes_suc b where suc=14000 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='alm'
then (select sum(piezas*costo) from oficinas.inv_mes_suc_det b where b.suc=900 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='cht'
then (select sum(importe) from oficinas.inv_mes_suc b where b.suc=16000 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='con'
then (select sum(piezas*costo) from oficinas.inv_mes_suc_det b where b.suc=100 and b.tipo='ALM CONTROLADOS' and b.aaa=$aaa and b.mes=$mes)
when a.tipo='esp'
then (select sum(piezas*costo) from oficinas.inv_mes_suc_det b where b.suc=100  and b.tipo='ALM ESPECIALIDAD' and b.aaa=$aaa and b.mes=$mes)
when a.tipo='fbo'
then (select sum(importe) from oficinas.inv_mes_suc b where b.suc=1600 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='met'
then (select sum(piezas*costo) from oficinas.inv_mes_suc_det b where b.suc=100 and b.tipo='ALM METRO' and b.aaa=$aaa and b.mes=$mes)
when a.tipo='seg'
then (select sum(importe) from oficinas.inv_mes_suc b where b.suc=90002 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='tra'
then (select sum(importe) from oficinas.inv_mes_suc b where b.suc=6050 and b.aaa=$aaa and b.mes=$mes)
when a.tipo='zac'
then (select sum(importe) from oficinas.inv_mes_suc b where b.suc=17000 and b.aaa=$aaa and b.mes=$mes)
else 0 end as fi_importe,
$aaa as aaa, $mes as mes

FROM catalogo.cat_almacenes a
where a.tipo in('agu','alm','cht','con','esp','fbo','met','tra','zac','seg')";
    $q=$this->db->query($s);
    
    return $q;
    }
 
 
  public function div_alm_uno($aaa,$mes,$tipo)
{
 if($tipo=='tra'){
 $s="select a.*,
ifnull((select costo from catalogo.costos_gobierno b where b.clave=a.clave),0)as costo_base,
ifnull((select paquete from catalogo.costos_gobierno b where b.clave=a.clave),0)as paquetes
from trasimeno140.inventario_d a";
 $q=$this->db->query($s);   
 }elseif($tipo=='seg'){
  $s="select a.*,
ifnull((select costo from catalogo.costos_gobierno b where b.clave=a.clave),0)as costo_base,
ifnull((select paquete from catalogo.costos_gobierno b where b.clave=a.clave),0)as paquetes
from segpop.inventario_d a";
 $q=$this->db->query($s);   
 }
 elseif($tipo=='alm'){
  $s="select a.sec as clave, b.susa1 as descri, a.lote,a.cadu as caducidad, a.inv1 as cantidad,
  a.costo as costo_base, 1 as paquetes
from desarrollo.inv_cedis a
left join catalogo.sec_generica b on b.sec=a.sec
where inv1>0 
";
 $q=$this->db->query($s);   
 } 
 elseif($tipo=='fbo'){
  $s="select a.clave as clave, b.susa1 as descri, a.lote,a.caducidad as caducidad, a.cantidad as cantidad,
  a.costo as costo_base, 1 as paquetes
from farmabodega.inventario_d a
left join catalogo.catalogo_bodega b on b.clabo=a.clave
where cantidad>0 
";
 $q=$this->db->query($s);   
 }
  elseif($tipo=='con'){
  $s="select a.clave as clave, b.susa1 as descri, a.lote,a.caducidad as caducidad, a.invf as cantidad,
  a.costo as costo_base, 1 as paquetes
from almacen.control_invd a
left join catalogo.segpop b on b.claves=a.clave
where invf>0 
group by a.clave,a.lote
";
 $q=$this->db->query($s);   
 }
   elseif($tipo=='met'){
  $s="select a.clave as clave, a.susa as descri, a.lote,a.caducidad as caducidad, a.cantidad as cantidad,
  a.costo as costo_base, 1 as paquetes
from metro.inventario_d a
left join catalogo.almacen b on b.sec=a.clave
where cantidad>0 
group by a.clave,a.lote
";
 $q=$this->db->query($s);   
 }   

return $q;
}
  
  public function sdsdsd()
    { $aaa=date('Y'); 
    $s="SELECT aa.*,bb.num,bb.mes,

case
when tipo='alm'
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a left join catalogo.sucursal b on b.suc=a.suc
where a.mes=bb.num  and a.suc in(100,900) and a.aaa=$aaa group by b.tipo2 )

when tipo='far'
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a left join catalogo.sucursal b on b.suc=a.suc
where a.mes=bb.num  and a.suc =1600 and a.aaa=$aaa group by b.tipo2 )

when tipo='D' or aa.tipo='G' or aa.tipo='F'
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a left join catalogo.sucursal b on b.suc=a.suc
where a.mes=bb.num  and aa.tipo=b.tipo2 and a.suc>100 and a.suc<1600 and a.aaa=$aaa 
and a.suc>100 and a.suc<1600 and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>181
and a.suc<>187 and a.suc<>900 group by b.tipo2 )

when tipo='met' 
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a left join catalogo.sucursal b on b.suc=a.suc
where a.mes=bb.num  and a.aaa=$aaa and
a.suc in(100,170,171,172,173,174,175,176,177,178,179,180,181) group by b.tipo2 )

when tipo='ban' 
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a left join catalogo.sucursal b on b.suc=a.suc
where a.mes=bb.num  and a.aaa=$aaa and
a.suc =187 group by b.tipo2 )

when tipo='cht'
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a
where a.mes=bb.num  and a.suc in(16000,16900) and a.aaa=$aaa)

when tipo='agu'
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a
where a.mes=bb.num  and a.suc in(14000,14900) and a.aaa=$aaa)

when tipo='zac'
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a
where a.mes=bb.num  and a.suc in(17000,17900) and a.aaa=$aaa)

else
0
end
as entrada,

case
when aa.tipo='D' or aa.tipo='G' or aa.tipo='F'
then (select sum(credito) from vtadc.gc_venta_mes a where aaa=$aaa and a.mes=bb.num and a.tipo2=aa.tipo 
and a.suc>100 and a.suc<1600 and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>181
and a.suc<>187 and a.suc<>900
group by tipo2)
when aa.tipo='agu' or aa.tipo='ban' or aa.tipo='cht' or aa.tipo='zac' or aa.tipo='met' or aa.tipo='edo'
then (select sum(importe) from vtadc.gc_venta_clientes a where a.tipo=aa.tipo and aaa=$aaa and a.mes=bb.num
group by a.tipo)
else
0
end as credito,

case
when aa.tipo='D' or aa.tipo='G' or aa.tipo='F'
then (select sum(contado) from vtadc.gc_venta_mes a where aaa=$aaa and a.mes=bb.num and a.tipo2=aa.tipo 
and a.suc>100 and a.suc<1600 and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>181
and a.suc<>187  and a.suc<>900
group by tipo2)
else
0
end as contado,

case 
when aa.tipo='ALM'
then (select sum(inv1*costo) from desarrollo.inv_cedis) 
else
0
end as inv

FROM catalogo.cat_inv_divicion aa,catalogo.mes bb
";
    $q=$this->db->query($s);
     return $q;  
    }
 
 public function entrada($tipo,$mes)
    {
 $aaa=date('Y');
$b="select *from catalogo.cat_inv_divicion where tipo='$tipo' ";
$b1=$this->db->query($b);
if($b1->num_rows()>0)
{$b2=$b1->row();
$condicion=$b2->condicion;
}
$aaa=date('Y');
    $s="select b.tipo2,b.nombre as sucx,a.*from vtadc.gc_factura_suc a 
    left join catalogo.sucursal b on a.suc=b.suc where mes=$mes and aaa=$aaa
and $condicion";

    $q=$this->db->query($s);
    return $q;
    }   

 public function entrada_suc($suc,$mes)
    {
 $aaa=date('Y');
    $s="select b.tipo2,b.nombre as sucx,a.*,case when prv=100 then 'ALMACEN CEDIS' else c.corto end as prvx from vtadc.gc_factura a 
    left join catalogo.sucursal b on a.suc=b.suc 
    left join catalogo.provedor c on c.prov=a.prv
    where mes=$mes and aaa=$aaa and a.suc=$suc";

    $q=$this->db->query($s);
    return $q;
    }


 public function almacen()
    {
 $aaa=date('Y');
    $s="SELECT a.tipo, a.nombre as almacen,
case
when a.tipo='alm'
then (select sum(inv1) from  desarrollo.inv_cedis)
when a.tipo='fbo'
then (select sum(cantidad) from  farmabodega.inventario_d)
when a.tipo='con'
then (select sum(invf) from  almacen.control_invd)
when a.tipo='esp'
then (select sum(cantidad) from  especialidad.inventario_d)
when a.tipo='agu'
then (select sum(piezas) from  oficinas.inv_seguros where suc=14000)
when a.tipo='cht'
then (select sum(piezas) from  oficinas.inv_seguros where suc=16000)
when a.tipo='zac'
then (select sum(piezas) from  oficinas.inv_seguros where suc=17000)
else 0
end as piezas,

case
when a.tipo='alm'
then (select sum(inv1*costo) from  desarrollo.inv_cedis)
when a.tipo='fbo'
then (select sum(cantidad*costo) from  farmabodega.inventario_d)
when a.tipo='con'
then (select sum(invf*costo) from  almacen.control_invd)
when a.tipo='esp'
then (select sum(cantidad*costo) from  especialidad.inventario_d)
when a.tipo='agu'
then (select sum(piezas*costo) from  oficinas.inv_seguros where suc=14000)
when a.tipo='cht'
then (select sum(piezas*costo) from  oficinas.inv_seguros where suc=16000)
when a.tipo='zac'
then (select sum(piezas*costo) from  oficinas.inv_seguros where suc=17000)

else 0
end as importe,
case
when a.tipo='alm'
then (select sum(inv1*costo) from  desarrollo.inv_cedis)
when a.tipo='fbo'
then (select sum(cantidad*costo) from  farmabodega.inventario_d)
when a.tipo='con'
then (select sum(invf*costo) from  almacen.control_invd)
when a.tipo='esp'
then (select sum(cantidad*costo) from  especialidad.inventario_d)
when a.tipo='agu'
then (select sum(piezas_paquete*costo) from  oficinas.inv_seguros where suc=14000)
when a.tipo='cht'
then (select sum(piezas_paquete*costo) from  oficinas.inv_seguros where suc=16000)
when a.tipo='zac'
then (select sum(piezas_paquete*costo) from  oficinas.inv_seguros where suc=17000)
else 0
end as importe_paq,

case
when a.tipo='agu'
then (select sum(piezas) from  oficinas.inv_seguros where suc>=14001 and suc<=14999)
when a.tipo='cht'
then (select sum(piezas) from  oficinas.inv_seguros where suc>=16001 and suc<=16999)
when a.tipo='zac'
then (select sum(piezas) from  oficinas.inv_seguros where suc>=17001 and suc<=17999)
else 0
end as modulos,
case
when a.tipo='agu'
then (select sum(piezas_paquete*costo) from  oficinas.inv_seguros where suc>=14001 and suc<=14999)
when a.tipo='cht'
then (select sum(piezas_paquete*costo) from  oficinas.inv_seguros where suc>=16001 and suc<=16999)
when a.tipo='zac'
then (select sum(piezas_paquete*costo) from  oficinas.inv_seguros where suc>=17001 and suc<=17999)
else 0
end as modulos_importe

FROM catalogo.cat_almacenes a

where a.tipo='alm'
or a.tipo='cht' or a.tipo='esp' or a.tipo='fbo' or a.tipo='agu' or a.tipo='zac' or a.tipo='con'";
    $q=$this->db->query($s);
    
    return $q;
    } 
    
  public function almacen_lot($tipo)
    {
if($tipo=='alm'){
$s="select a.*,b.susa,case when a.costo=0 then b.cos else a.costo end as costoo  
from desarrollo.inv_cedis a
left join catalogo.cat_nuevo_general_sec b on a.sec=b.sec 
where inv1>0";
$q=$this->db->query($s);
}elseif($tipo=='agu'){
$s="select a.*
from oficinas.inv_seguros where suc=14000";
$q=$this->db->query($s);
}
    return $q;
}


public function almacen_lot_s($tipo)
    {
if($tipo=='alm'){
$s="select a.*,b.susa 
from desarrollo.inv_cedis a
left join catalogo.cat_nuevo_general_sec b on a.sec=b.sec 
where inv1>0";
$q=$this->db->query($s);
}elseif($tipo=='agu'){
$s="select a.*
from oficinas.inv_seguros where suc=14000";
$q=$this->db->query($s);
}
    return $q;
}


 public function almacen_det($tipo)
    {
if($tipo=='alm'){
$s="select a.clasi, a.sec,a.susa,
ifnull(m7,0)as m7,ifnull(m8,0)as m8,ifnull(m9,0)as m9,ifnull(m10,0)as m10,ifnull(m11,0)as m11,ifnull(m12,0)as m12,
ifnull(inv1,0)as inv1,
sum(venta7)as venta7,sum(venta8)as venta8,sum(venta9)as venta9,sum(venta10)as venta10,sum(venta11)as venta11,
sum(venta12)as venta12
from catalogo.cat_nuevo_general_sec a
left join almacen.max_cedis b on b.sec=a.sec
left join desarrollo.inv_cedis_sec1 c on c.sec=a.sec
left join vtadc.producto_mes_suc_gen d on d.sec=a.sec
group by a.sec";
$q=$this->db->query($s);
}elseif($tipo=='agu'){
$s="select '' as clasi, a.clave_sin_punto as sec,a.descripcion as susa, 
0 as m7,0 as m8,0 as m9,0 as m10,0 as m11,0 as m12,piezas as inv1,
0 as venta7,0 as venta8,0 as venta9,0 as venta10,0 as venta11,0 as venta12
from oficinas.inv_seguros a where suc=14000";
$q=$this->db->query($s);
}
elseif($tipo=='zac'){
$s="select '' as clasi, a.clave_sin_punto as sec,a.descripcion as susa, 
0 as m7,0 as m8,0 as m9,0 as m10,0 as m11,0 as m12,piezas as inv1,
0 as venta7,0 as venta8,0 as venta9,0 as venta10,0 as venta11,0 as venta12
from oficinas.inv_seguros a where suc=17000";
$q=$this->db->query($s);
}
elseif($tipo=='cht'){
$s="select '' as clasi, a.clave_sin_punto as sec,a.descripcion as susa, 
0 as m7,0 as m8,0 as m9,0 as m10,0 as m11,0 as m12,piezas as inv1,
0 as venta7,0 as venta8,0 as venta9,0 as venta10,0 as venta11,0 as venta12
from oficinas.inv_seguros a where suc=16000";
$q=$this->db->query($s);
}
elseif($tipo=='con'){
$s="select '' as clasi, a.clave as sec,b.susa as susa, 
0 as m7,0 as m8,0 as m9,0 as m10,0 as m11,0 as m12,sum(invf) as inv1,
0 as venta7,0 as venta8,0 as venta9,0 as venta10,0 as venta11,0 as venta12
from almacen.control_invd a 
left join catalogo.cat_nuevo_general_cla b on b.clagob=a.clave
where invf>0 
group by a.clave
";
$q=$this->db->query($s);
}
elseif($tipo=='esp'){
$s="select '' as clasi, a.clave as sec,b.susa as susa, 
0 as m7,0 as m8,0 as m9,0 as m10,0 as m11,0 as m12,sum(cantidad) as inv1,
0 as venta7,0 as venta8,0 as venta9,0 as venta10,0 as venta11,0 as venta12
from especialidad.inventario_d a 
left join catalogo.cat_nuevo_general_cla b on b.clagob=a.clave
where cantidad>0 
group by a.clave
";
$q=$this->db->query($s);
}
elseif($tipo=='fbo'){
$s="select '' as clasi, a.clave as sec,b.susa1 as susa, 
0 as m7,0 as m8,0 as m9,0 as m10,0 as m11,0 as m12,sum(cantidad) as inv1,
0 as venta7,0 as venta8,0 as venta9,0 as venta10,0 as venta11,0 as venta12
from farmabodega.inventario_d a 
left join catalogo.catalogo_bodega_clave b on b.clabo=a.clave
where cantidad>0 
group by a.clave
";
$q=$this->db->query($s);
}
    
    return $q;
    }
 
public function inv_sucursal()
    {

$s="select a.clasi, a.sec,a.susa,sum(cantidad)as cantidad,inv1 from catalogo.cat_nuevo_general_sec a 
left join desarrollo.inv b on a.sec=b.sec 
left join desarrollo.inv_cedis_sec1 c on c.sec=a.sec
where mov=7 and a.sec>=1 and a.sec<=2000 and b.suc>100
group by a.sec";
$q=$this->db->query($s);
return $q;
}
public function inv_sucursal_espe($sec)
    {

$s="select b.nombre as sucx,a.* from desarrollo.inv a
left join catalogo.sucursal b on b.suc=a.suc
where mov=7 and a.sec=$sec and a.suc>100 and a.cantidad>0";
$q=$this->db->query($s);
return $q;
}

public function inv_gral()
    {

$s="select a.*,
ifnull((select m11 from almacen.max_cedis x where x.sec=a.sec),0)as farmacia,
ifnull((select inv1 from desarrollo.inv_cedis_sec1 x where x.sec=a.sec),0)as cedis,
ifnull((select sum(cantidad)  From farmabodega.inventario_d where left(clave,(LENGTH(clave)-1))=a.sec group by left(clave,(LENGTH(clave)-1))),0)as fbo,
ifnull((select sum(piezas) from oficinas.inv_seguros x where x.suc=16000 and x.clave=a.clagob group by clave),0)as cht,
ifnull((select sum(piezas) from oficinas.inv_seguros x where x.suc=17000 and x.clave=a.clagob group by clave),0)as zac,
ifnull((select sum(piezas) from oficinas.inv_seguros x where x.suc=14000 and x.clave=a.clagob group by clave),0)as agu,
ifnull((select sum(cantidad) from trasimeno140.inventario_d x where  x.clave=a.clagob group by clave),0)as tra,
ifnull((select sum(cantidad) from segpop.inventario_d x where x.clave=a.clagob group by clave),0)as seg,
ifnull((select sum(cantidad) from especialidad.inventario_d x where x.clave=a.clagob group by clave),0)as esp,
ifnull((select sum(invf) from almacen.control_invd x where x.clave=a.clagob group by clave),0)as con,
ifnull((select sum(cantidad) from desarrollo.inv x where x.sec=a.sec and x.suc in(176,177,178,179,180,187) and mov=7 group by sec),0)as modu
from catalogo.cat_nuevo_general_cla a

order by sec";
$q=$this->db->query($s);
return $q;
}


}
