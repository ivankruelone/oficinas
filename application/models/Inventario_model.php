<?php
class Inventario_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function inv_sem()
    {
        $s = "SELECT date(concat(a.aaa,'-',a.mes,'-',a.dia))as fecha,a.tsuc,b.nombre as imagen, a.sem, 
sum(a.piezas)as inv,sum(a.importe)as inv_imp,
sum(c.ent1+ent2)as ent, sum(c.ent_imp1+c.ent_imp2)as ent_imp,
sum(c.sal1+sal2)as sal, sum(c.sal_imp1+c.sal_imp2)as sal_imp

FROM oficinas.inv_mes_suc_his a
left join catalogo.cat_imagen b on b.tipo=a.tsuc
left join oficinas.salidas_entradas_inv c on c.suc=a.suc  and c.sem=a.sem+1
where
a.suc>100 and a.suc<176 and a.suc<>127 and a.suc<>900
or
a.suc>200 and a.suc<=2000 and a.suc<>900
group by a.sem
order by a.sem desc";
        $q = $this->db->query($s);

        return $q;
    }
    public function inv_imagen($sem)
    {
        $s = "SELECT a.tsuc,b.nombre as imagen, a.sem, sum(a.piezas)as inv,sum(a.importe)as inv_imp,
sum(c.ent1+ent2)as ent, sum(c.ent_imp1+c.ent_imp2)as ent_imp,
sum(c.sal1+sal2)as sal, sum(c.sal_imp1+c.sal_imp2)as sal_imp

FROM oficinas.inv_mes_suc_his a
left join catalogo.cat_imagen b on b.tipo=a.tsuc
left join oficinas.salidas_entradas_inv c on c.suc=a.suc  and c.sem=$sem+1
where
a.suc>100 and a.suc<176 and a.suc<>127 and a.suc<>900 and a.sem=$sem
or
a.suc>200 and a.suc<=2000 and a.suc<>900 and a.sem=$sem
group by a.tsuc";
        $q = $this->db->query($s);

        return $q;
    }
    public function inv_imagen_tsuc($sem, $tsuc)
    {
        $s = "SELECT a.tsuc,a.suc,b.nombre as sucx, a.sem, (a.piezas)as inv,(a.importe)as inv_imp,
(c.ent1+ent2)as ent, (c.ent_imp1+c.ent_imp2)as ent_imp,
(c.sal1+sal2)as sal, (c.sal_imp1+c.sal_imp2)as sal_imp

FROM oficinas.inv_mes_suc_his a
left join catalogo.sucursal b on b.suc=a.suc
left join oficinas.salidas_entradas_inv c on c.suc=a.suc  and c.sem=$sem+1
where
a.suc>100 and a.suc<176 and a.suc<>127 and a.suc<>900 and a.sem=$sem  and a.tsuc='$tsuc'
or
a.suc>200 and a.suc<=2000 and a.suc<>900 and a.sem=$sem and a.tsuc='$tsuc'
";
        $q = $this->db->query($s);

        return $q;
    }


    public function busca_inv()
    {
        $s = "select *from oficinas.inv_mes_suc group by aaa";
        $q = $this->db->query($s);
        $r = $q->row();
        return $r->dia;
    }


    public function mes()
    {
        $aaa = date('Y') - 1;
        $mes = 10;
        $mesa = $mes - 1;
        $s = "select $aaa as aaa,a.num, a.mes as mesx,
 
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

        $q = $this->db->query($s);
        return $q;
    }
    public function compa($aaa, $mes)
    {
        $aaa = $aaa - 1;
        $mesa = $mes - 1;
        $s = "select a.*,$aaa as aaa, $mes as mes,
 
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

        $q = $this->db->query($s);
        return $q;
    }

    public function compa_cia($aaa, $mes, $cia)
    {
        $mesa = $mes - 1;
        $s = "select a.*,


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
        $q = $this->db->query($s);
        return $q;
    }


    public function mes_alm()
    {
        $aaa = date('Y') - 1;
        $mesa = date('m') - 1;
        $s = "select $aaa as aaa,a.num, a.mes as mesx,
 
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

        $q = $this->db->query($s);
        return $q;
    }

    public function div_alm($aaa, $mes)
    {
        $aaa = $aaa - 1;
        $mesa = $mes - 1;
        $s = "SELECT a.nombre as tipox,a.tipo,
case
when a.tipo='agu'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where suc=14000 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='alm'
then (select sum(piezas) from oficinas.inv_mes_suc_det_his b where b.suc=900 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='cht'
then (select sum(piezas) from oficinas.inv_mes_suc_his b where b.suc=16000 and b.aaa=$aaa and b.mes=$mesa)
when a.tipo='con'
then (select sum(piezas) from oficinas.inv_mes_suc_det_his b where b.suc=100 and b.tipo='ALM CONTROLADOS' and b.aaa=$aaa and b.mes=$mesa)
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
where a.tipo in('agu','alm','cht','con','fbo','met','tra','zac','seg')";
        $q = $this->db->query($s);

        return $q;
    }


    public function div_alm_uno($aaa, $mes, $tipo)
    {
        if ($tipo == 'tra') {
            $s = "select a.*,
ifnull((select costo from catalogo.costos_gobierno b where b.clave=a.clave),0)as costo_base,
ifnull((select paquete from catalogo.costos_gobierno b where b.clave=a.clave),0)as paquetes
from trasimeno140.inventario_d a";
            $q = $this->db->query($s);
        } elseif ($tipo == 'seg') {
            $s = "select a.*,
ifnull((select costo from catalogo.costos_gobierno b where b.clave=a.clave),0)as costo_base,
ifnull((select paquete from catalogo.costos_gobierno b where b.clave=a.clave),0)as paquetes
from segpop.inventario_d a";
            $q = $this->db->query($s);
        } elseif ($tipo == 'alm') {
            $s = "select a.sec as clave, b.susa1 as descri, a.lote,a.cadu as caducidad, a.inv1 as cantidad,
  a.costo as costo_base, 1 as paquetes
from desarrollo.inv_cedis a
left join catalogo.sec_generica b on b.sec=a.sec
where inv1>0 
";
            $q = $this->db->query($s);
        } elseif ($tipo == 'fbo') {
            $s = "select a.clave as clave, b.susa1 as descri, a.lote,a.caducidad as caducidad, a.cantidad as cantidad,
  a.costo as costo_base, 1 as paquetes
from farmabodega.inventario_d a
left join catalogo.catalogo_bodega b on b.clabo=a.clave
where cantidad>0 
";
            $q = $this->db->query($s);
        } elseif ($tipo == 'con') {
            $s = "select a.clave as clave, b.susa1 as descri, a.lote,a.caducidad as caducidad, a.invf as cantidad,
  a.costo as costo_base, 1 as paquetes
from almacen.control_invd a
left join catalogo.segpop b on b.claves=a.clave
where invf>0 
group by a.clave,a.lote
";
            $q = $this->db->query($s);
        } elseif ($tipo == 'met') {
            $s = "select a.clave as clave, a.susa as descri, a.lote,a.caducidad as caducidad, a.cantidad as cantidad,
  a.costo as costo_base, 1 as paquetes
from metro.inventario_d a
left join catalogo.almacen b on b.sec=a.clave
where cantidad>0 
group by a.clave,a.lote
";
            $q = $this->db->query($s);
        }

        return $q;
    }

    public function sdsdsd()
    {
        $aaa = date('Y');
        $s = "SELECT aa.*,bb.num,bb.mes,

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
        $q = $this->db->query($s);
        return $q;
    }

    public function entrada($tipo, $mes)
    {
        $aaa = date('Y') - 1;
        $b = "select *from catalogo.cat_inv_divicion where tipo='$tipo' ";
        $b1 = $this->db->query($b);
        if ($b1->num_rows() > 0) {
            $b2 = $b1->row();
            $condicion = $b2->condicion;
        }
        $aaa = date('Y') - 1;
        $s = "select b.tipo2,b.nombre as sucx,a.*from vtadc.gc_factura_suc a 
    left join catalogo.sucursal b on a.suc=b.suc where mes=$mes and aaa=$aaa
and $condicion";

        $q = $this->db->query($s);
        return $q;
    }

    public function entrada_suc($suc, $mes)
    {
        $aaa = date('Y') - 1;
        $s = "select b.tipo2,b.nombre as sucx,a.*,case when prv=100 then 'ALMACEN CEDIS' else c.corto end as prvx from vtadc.gc_factura a 
    left join catalogo.sucursal b on a.suc=b.suc 
    left join catalogo.provedor c on c.prov=a.prv
    where mes=$mes and aaa=$aaa and a.suc=$suc";

        $q = $this->db->query($s);
        return $q;
    }

    //when a.tipo='cht'
    //then (select sum(cantidad) from  oficinas.inv_seguros_lote where suc=16000)

    public function almacen()
    {
        $aaa = date('Y') - 1;
        $s = "SELECT a.tipo, a.nombre as almacen,
case
when a.tipo='alm'
then (select sum(inv1) from  desarrollo.inv_cedis)
when a.tipo='fbo'
then (select sum(cantidad) from  farmabodega.inventario_d)
when a.tipo='con'
then (select sum(invf) from  almacen.control_invd)
when a.tipo='agu'
then (select sum(inv) from  aguascalientes.inventario)
when a.tipo='cht'
then (SELECT SUM(inv) FROM chetumal.inventario)
when a.tipo='tra'
then (SELECT SUM(cantidad) FROM trasimeno140.inventario_d)
when a.tipo='seg'
then (SELECT SUM(cantidad) FROM segpop.inventario_d)
when a.tipo='mic'
then (SELECT SUM(inv) FROM michoacan.inventario)
when a.tipo='oax'
then (SELECT SUM(inv) FROM oaxaca.inventario)
when a.tipo='pat'
then (SELECT SUM(inv) FROM patente.inventario)
else 0
end as piezas,

case
when a.tipo='alm'
then (select sum(inv1*costo) from  desarrollo.inv_cedis)
when a.tipo='fbo'
then (select sum(cantidad*costo) from  farmabodega.inventario_d)
when a.tipo='con'
then (select sum(invf*costo) from  almacen.control_invd)
when a.tipo='agu'
then (select sum(inv*costo) from  aguascalientes.inventario a left join aguascalientes.costos d on a.p_id=d.p_id)
when a.tipo='cht'
then (select sum(cantidad*costo) from  oficinas.inv_seguros_lote where suc=16000)
when a.tipo='tra'
then (SELECT SUM(cantidad/contable_div*costo) FROM trasimeno140.inventario_d)
when a.tipo='seg'
then (SELECT SUM(cantidad*costo) FROM segpop.inventario_d)
else 0
end as importe,
case
when a.tipo='alm'
then (select sum(inv1*costo) from  desarrollo.inv_cedis)
when a.tipo='fbo'
then (select sum(cantidad*costo) from  farmabodega.inventario_d)
when a.tipo='con'
then (select sum(invf*costo) from  almacen.control_invd)
when a.tipo='agu'
then (select sum(piezas_paquete*costo) from  oficinas.inv_seguros where suc=14000)
when a.tipo='cht'
then (select sum(piezas_paquete*costo) from  oficinas.inv_seguros where suc=16000)
when a.tipo='mic'
then (select sum(piezas_paquete*costo) from  oficinas.inv_seguros where suc=12000)
else 0
end as importe_paq,

case
when a.tipo='agu'
then (select sum(piezas) from  oficinas.inv_seguros where suc>=14001 and suc<=14999)
when a.tipo='cht'
then (select sum(piezas) from  oficinas.inv_seguros where suc>=16001 and suc<=16999)
when a.tipo='mic'
then (select sum(piezas) from  oficinas.inv_seguros where suc>=12000 and suc<=12999)
else 0
end as modulos,
case
when a.tipo='agu'
then (select sum(piezas_paquete*costo) from  oficinas.inv_seguros where suc>=14001 and suc<=14999)
when a.tipo='cht'
then (select sum(piezas_paquete*costo) from  oficinas.inv_seguros where suc>=16001 and suc<=16999)
when a.tipo='mic'
then (select sum(piezas_paquete*costo) from  oficinas.inv_seguros where suc>=12000 and suc<=12999)
else 0
end as modulos_importe

FROM catalogo.cat_almacenes a

where a.tipo='alm'
or  a.tipo='fbo' or a.tipo='agu' or a.tipo='con' or a.tipo='cht' or a.tipo='tra' or a.tipo='seg' or a.tipo='mic' or a.tipo='oax' or a.tipo='pat'";
        $q = $this->db->query($s);

        return $q;
    }

    public function almacen_lot($tipo)
    {
        if ($tipo == 'alm') {
            $s = "select a.*,b.susa,case when a.costo=0 then b.cos else a.costo end as costoo  
from desarrollo.inv_cedis a
left join catalogo.cat_nuevo_general_sec b on a.sec=b.sec 
where inv1>0";
            $q = $this->db->query($s);
        } elseif ($tipo == 'agu') {
            $s = "select b.clave as sec ,b.descripcion as susa,a.lote,a.caducidad as cadu,a.inv as inv1, 0 as costoo
from aguascalientes.inventario a
left join aguascalientes.productos b on a.p_id=b.id
where inv<>0";
        } elseif ($tipo == 'cht') {
            $s = "select b.clave as sec ,b.descripcion as susa,a.lote,a.caducidad as cadu,a.inv as inv1, 0 as costoo
from chetumal.inventario a
left join chetumal.productos b on a.p_id=b.id
where inv<>0";
            //$s="select clave as sec,descri as susa, lote, caducidad as cadu, cantidad as inv1,
            //case when div_precio>0 then  (costo/div_precio) else costo end as costoo,lab
            //from oficinas.inv_seguros_lote a where suc=16000 and cantidad<>0";
            $q = $this->db->query($s);
        } elseif ($tipo == 'con') {
            $s = "SELECT a.clave as sec, b.susa, a.lote, a.caducidad as cadu, a.invf as inv1, a.costo as costoo, '' as lab
FROM almacen.control_invd a
left join catalogo.cat_con b on a.clave=b.clave
where invf<>0;";
            $q = $this->db->query($s);
        } elseif ($tipo == 'fbo') {
            $s = "SELECT a.clave as sec, f.susa1 as susa, a.lote, a.caducidad as cadu, a.cantidad as inv1, a.costo as costoo, '' as lab
FROM farmabodega.inventario_d a
left join farmabodega.farmabodega_salidas_entradas14 f on  a.clave=f.clabo
where cantidad<>0;";
            $q = $this->db->query($s);
        } elseif ($tipo == 'seg') {
            $s = "SELECT clave as sec, descri as susa, lote, caducidad as cadu, cantidad as inv1, costo as costoo
FROM segpop.inventario_d i 
where cantidad<>0";
            $q = $this->db->query($s);
        } elseif ($tipo == 'tra') {
            $s = "SELECT clave as sec, descri as susa, caducidad as cadu, lote, cantidad/contable_div as inv1, costo as costoo
FROM trasimeno140.inventario_d i 
where cantidad<>0";
            $q = $this->db->query($s);
        }
        return $q;
    }


    public function almacen_lot_s($tipo)
    {
        if ($tipo == 'alm') {
            $s = "select a.sec, a.lote, a.cadu, a.inv1, a.costo, b.susa,'' as lab
from desarrollo.inv_cedis a
left join catalogo.cat_nuevo_general_sec b on a.sec=b.sec
where inv1<>0";
            $q = $this->db->query($s);
        } elseif ($tipo == 'cht') {
            $s = "SELECT b.clave as sec, b.descripcion as susa, a.lote, a.caducidad as cadu, a.inv as inv1, (0) as costo, '' as lab
FROM chetumal.inventario a
join chetumal.productos b on a.p_id=b.id
where inv<>0";
            //$s="select clave as sec,descri as susa, lote, caducidad as cadu, cantidad as inv1,
            //case when div_precio>0 then  (costo/div_precio) else costo end as costo,lab
            //from oficinas.inv_seguros_lote a where suc=16000 and cantidad<>0";
            $q = $this->db->query($s);
        } elseif ($tipo == 'agu') {
            $s = "SELECT b.clave as sec, b.susa, a.lote, a.caducidad as cadu, a.inv as inv1, ifnull(d.costo, 0) as costo, '' as lab
FROM aguascalientes.inventario a
join aguascalientes.productos b on a.p_id=b.id
left join aguascalientes.costos d on a.p_id=d.p_id
where inv<>0;";
            $q = $this->db->query($s);
        } elseif ($tipo == 'fbo') {
            $s = "SELECT a.clave as sec, f.susa1 as susa, a.lote, a.caducidad as cadu, a.cantidad as inv1, a.costo, '' as lab
FROM farmabodega.inventario_d a
left join farmabodega.farmabodega_salidas_entradas14 f on  a.clave=f.clabo
where cantidad<>0;";
            $q = $this->db->query($s);
        } elseif ($tipo == 'con') {
            $s = "SELECT a.clave as sec, b.susa, a.lote, a.caducidad as cadu, a.invf as inv1, a.costo, '' as lab
FROM almacen.control_invd a
left join catalogo.cat_con b on a.clave=b.clave
where invf<>0;";
            $q = $this->db->query($s);
        } elseif ($tipo == 'tra') {
            $s = "SELECT clave as sec, descri as susa, caducidad as cadu, lote, cantidad/contable_div as inv1, costo
FROM trasimeno140.inventario_d i 
where cantidad<>0";
            $q = $this->db->query($s);
        } elseif ($tipo == 'seg') {
            $s = "SELECT clave as sec, descri as susa, lote, caducidad as cadu, cantidad as inv1, costo 
FROM segpop.inventario_d i 
where cantidad<>0";
            $q = $this->db->query($s);
        } elseif ($tipo == 'pat') {
            $s = "SELECT b.clave as sec, b.descripcion as susa, a.lote, a.caducidad as cadu, a.inv as inv1, (0) as costo, '' as lab
FROM patente.inventario a
join patente.productos b on a.p_id=b.id
where inv<>0";
            $q = $this->db->query($s);
        } elseif ($tipo == 'mic') {
            $s = "SELECT b.clave as sec, b.descripcion as susa, a.lote, a.caducidad as cadu, a.inv as inv1, (0) as costo, '' as lab
FROM michoacan.inventario a
join michoacan.productos b on a.p_id=b.id
where inv<>0;";
            $q = $this->db->query($s);
        } elseif ($tipo == 'oax') {
            $s = "SELECT b.clave as sec, b.descripcion as susa, a.lote, a.caducidad as cadu, a.inv as inv1, (0) as costo, '' as lab
FROM oaxaca.inventario a
join oaxaca.productos b on a.p_id=b.id
where inv<>0;";
            $q = $this->db->query($s);

        }
        return $q;
    }


    public function almacen_det($tipo)
    {
$aaa=date('Y');
        if ($tipo == 'alm') {
            $s = "select a.descon,a.tipo, a.sec,replace(a.susa, '(DESCONTINUADO)', '') as susa,
ifnull(venta1,0)as venta1,
ifnull(venta2,0)as venta2,
ifnull(venta3,0)as venta3,
ifnull(venta4,0)as venta4,
ifnull(venta5,0)as venta5,
ifnull(venta6,0)as venta6,
ifnull(venta7,0)as venta7,
ifnull(venta8,0)as venta8,
ifnull(venta9,0)as venta9,
ifnull(venta10,0)as venta10,
ifnull(venta11,0)as venta11,
ifnull(venta12,0)as venta12,

ifnull(a1,0)as a1,
ifnull(a2,0)as a2,
ifnull(a3,0)as a3,
ifnull(a4,0)as a4,
ifnull(a5,0)as a5,
ifnull(a6,0)as a6,
ifnull(a7,0)as a7,
ifnull(a8,0)as a8,
ifnull(a9,0)as a9,
ifnull(a10,0)as a10,
ifnull(a11,0)as a11,
ifnull(a12,0)as a12,

ifnull(aa1,0)as aa1,
ifnull(aa2,0)as aa2,
ifnull(aa3,0)as aa3,
ifnull(aa4,0)as aa4,
ifnull(aa5,0)as aa5,
ifnull(aa6,0)as aa6,
ifnull(aa7,0)as aa7,
ifnull(aa8,0)as aa8,
ifnull(aa9,0)as aa9,
ifnull(aa10,0)as aa10,
ifnull(aa11,0)as aa11,
ifnull(aa12,0)as aa12,

ifnull(inv1,0)as inv1

from catalogo.cat_almacen_clasifica a
left join vtadc.producto_sec b on b.sec=a.sec and aaa = $aaa
left join desarrollo.inv_cedis_sec1 c on c.sec=a.sec
where a.sec <= 3999 and descon='N'
or
(venta1+
venta2+
venta3+
venta4+
venta5+
venta6+
venta7+
venta8+
venta9+
venta10+
venta11+
venta12
)>0
group by a.sec";

            $q = $this->db->query($s);
        } elseif ($tipo == 'con') {
            $s = "select '' as tipo, a.clave as sec,b.susa as susa, 
0 as m7,0 as m8,0 as m9,0 as m10,0 as m11,0 as m12,sum(invf) as inv1,
0 as venta1,0 as venta2,0 as venta3,0 as venta4,0 as venta5,0 as venta6,
0 as venta7,0 as venta8,0 as venta9,0 as venta10,0 as venta11,0 as venta12,
0 as a1,0 as a2,0 as a3,0 as a4,0 as a5,0 as a6,0 as a7,0 as a8,0 as a9,
0 as a10,0 as a11,0 as a12,
0 as aa1,0 as aa2,0 as aa3,0 as aa4,0 as aa5,0 as aa6,0 as aa7,0 as aa8,
0 as aa9,0 as aa10,0 as aa11,0 as aa12
from almacen.control_invd a 
left join catalogo.cat_nuevo_general_cla b on b.clagob=a.clave and b.tipo<>'X'
where invf>0
group by a.clave
";
            $q = $this->db->query($s);
        } elseif ($tipo == 'fbo') {
            $s = "select ''as tipo,'N'as descon, '' as clasi, a.clave as sec,b.susa1 as susa, 
0 as m7,0 as m8,0 as m9,0 as m10,0 as m11,0 as m12,sum(cantidad) as inv1,
0 as venta1,0 as venta2,0 as venta3,0 as venta4,0 as venta5,0 as venta6,
0 as venta7,0 as venta8,0 as venta9,0 as venta10,0 as venta11,0 as venta12,
0 as a1,0 as a2,0 as a3,0 as a4,0 as a5,0 as a6,0 as a7,0 as a8,0 as a9,
0 as a10,0 as a11,0 as a12,
0 as aa1,0 as aa2,0 as aa3,0 as aa4,0 as aa5,0 as aa6,0 as aa7,0 as aa8,
0 as aa9,0 as aa10,0 as aa11,0 as aa12
from farmabodega.inventario_d a 
left join catalogo.catalogo_bodega_clave b on b.clabo=a.clave 
where cantidad>0 
group by a.clave
";
            $q = $this->db->query($s);
           
        }

        return $q;
    }

    public function almacen_det1($tipo)
    {

        if ($tipo == 'alm') {
            $s = "SELECT a.clave as clabo, a.susa1, ifnull(d.inv1, 0) as inv,
canp012012, cans012012, cane012012,
canp022012, cans022012, cane022012,
canp032012, cans032012, cane032012,
canp042012, cans042012, cane042012,
canp052012, cans052012, cane052012,
canp062012, cans062012, cane062012,
canp072012, cans072012, cane072012,
canp082012, cans082012, cane082012,
canp092012, cans092012, cane092012,
canp102012, cans102012, cane102012,
canp112012, cans112012, cane112012,
canp122012, cans122012, cane122012,
canp012013, cans012013, cane012013,
canp022013, cans022013, cane022013,
canp032013, cans032013, cane032013,
canp042013, cans042013, cane042013,
canp052013, cans052013, cane052013,
canp062013, cans062013, cane062013,
canp072013, cans072013, cane072013,
canp082013, cans082013, cane082013,
canp092013, cans092013, cane092013,
canp102013, cans102013, cane102013,
canp112013, cans112013, cane112013,
canp122013, cans122013, cane122013,
canp012014, cans012014, cane012014,
canp022014, cans022014, cane022014,
canp032014, cans032014, cane032014,
canp042014, cans042014, cane042014,
canp052014, cans052014, cane052014,
canp062014, cans062014, cane062014,
canp072014, cans072014, cane072014,
canp082014, cans082014, cane082014,
canp092014, cans092014, cane092014,
canp102014, cans102014, cane102014,
canp112014, cans112014, cane112014,
canp122014, cans122014, cane122014
FROM desarrollo.cedis_salidas_entradas12 a
left join desarrollo.cedis_salidas_entradas13 b on a.clave=b.clave
left join desarrollo.cedis_salidas_entradas14 c on b.clave=c.clave
left join desarrollo.inv_cedis_sec1 d on a.clave=d.sec;";
            $q = $this->db->query($s);
        } elseif ($tipo == 'con') {
            $s = "SELECT a.clave as clabo, a.susa1, ifnull(d.inv, 0) as inv,
canp012012, cans012012, cane012012,
canp022012, cans022012, cane022012,
canp032012, cans032012, cane032012,
canp042012, cans042012, cane042012,
canp052012, cans052012, cane052012,
canp062012, cans062012, cane062012,
canp072012, cans072012, cane072012,
canp082012, cans082012, cane082012,
canp092012, cans092012, cane092012,
canp102012, cans102012, cane102012,
canp112012, cans112012, cane112012,
canp122012, cans122012, cane122012,
canp012013, cans012013, cane012013,
canp022013, cans022013, cane022013,
canp032013, cans032013, cane032013,
canp042013, cans042013, cane042013,
canp052013, cans052013, cane052013,
canp062013, cans062013, cane062013,
canp072013, cans072013, cane072013,
canp082013, cans082013, cane082013,
canp092013, cans092013, cane092013,
canp102013, cans102013, cane102013,
canp112013, cans112013, cane112013,
canp122013, cans122013, cane122013,
canp012014, cans012014, cane012014,
canp022014, cans022014, cane022014,
canp032014, cans032014, cane032014,
canp042014, cans042014, cane042014,
canp052014, cans052014, cane052014,
canp062014, cans062014, cane062014,
canp072014, cans072014, cane072014,
canp082014, cans082014, cane082014,
canp092014, cans092014, cane092014,
canp102014, cans102014, cane102014,
canp112014, cans112014, cane112014,
canp122014, cans122014, cane122014
FROM almacen.control_salidas_entradas12 a
left join almacen.control_salidas_entradas13 b on a.clave=b.clave
left join almacen.control_salidas_entradas14 c on b.clave=c.clave
left join almacen.inv_controlados d on a.clave=d.clave;";
            $q = $this->db->query($s);

        } elseif ($tipo == 'fbo') {
            $s = "SELECT  a.clabo, a.susa1, ifnull(c.cantidad,0) as inv,
canp012012, cans012012, cane012012,
canp022012, cans022012, cane022012,
canp032012, cans032012, cane032012,
canp042012, cans042012, cane042012,
canp052012, cans052012, cane052012,
canp062012, cans062012, cane062012,
canp072012, cans072012, cane072012,
canp082012, cans082012, cane082012,
canp092012, cans092012, cane092012,
canp102012, cans102012, cane102012,
canp112012, cans112012, cane112012,
canp122012, cans122012, cane122012, 
canp012013, cans012013, cane012013,
canp022013, cans022013, cane022013,
canp032013, cans032013, cane032013,
canp042013, cans042013, cane042013,
canp052013, cans052013, cane052013,
canp062013, cans062013, cane062013,
canp072013, cans072013, cane072013, 
canp082013, cans082013, cane082013, 
canp092013, cans092013, cane092013, 
canp102013, cans102013, cane102013, 
canp112013, cans112013, cane112013, 
canp122013, cans122013, cane122013, 
canp012014, cans012014, cane012014, 
canp022014, cans022014, cane022014, 
canp032014, cans032014, cane032014, 
canp042014, cans042014, cane042014, 
canp052014, cans052014, cane052014, 
canp062014, cans062014, cane062014, 
canp072014, cans072014, cane072014, 
canp082014, cans082014, cane082014, 
canp092014, cans092014, cane092014, 
canp102014, cans102014, cane102014, 
canp112014, cans112014, cane112014, 
canp122014, cans122014, cane122014 
FROM farmabodega.farmabodega_salidas_entradas12 a
left join farmabodega.farmabodega_salidas_entradas13 b on a.clabo=b.clabo
left join farmabodega.farmabodega_salidas_entradas14 d on b.clabo=d.clabo
left join farmabodega.inventario_d_clave c on c.clave=a.clabo";
            $q = $this->db->query($s);
            //echo $this->db->last_query();
            //die();
        } elseif ($tipo == 'agu') {
            $s = "SELECT b.clave as clabo, c.susa1, ifnull(a.inv,0) as inv,
canp012012, cans012012, cane012012,
canp022012, cans022012, cane022012,
canp032012, cans032012, cane032012,
canp042012, cans042012, cane042012,
canp052012, cans052012, cane052012,
canp062012, cans062012, cane062012,
canp072012, cans072012, cane072012,
canp082012, cans082012, cane082012,
canp092012, cans092012, cane092012,
canp102012, cans102012, cane102012,
canp112012, cans112012, cane112012,
canp122012, cans122012, cane122012, 
canp012013, cans012013, cane012013,
canp022013, cans022013, cane022013,
canp032013, cans032013, cane032013,
canp042013, cans042013, cane042013,
canp052013, cans052013, cane052013,
canp062013, cans062013, cane062013,
canp072013, cans072013, cane072013, 
canp082013, cans082013, cane082013, 
canp092013, cans092013, cane092013, 
canp102013, cans102013, cane102013, 
canp112013, cans112013, cane112013, 
canp122013, cans122013, cane122013, 
canp012014, cans012014, cane012014, 
canp022014, cans022014, cane022014,
canp032014, cans032014, cane032014,
canp042014, cans042014, cane042014,
canp052014, cans052014, cane052014,
canp062014, cans062014, cane062014,
canp072014, cans072014, cane072014,
canp082014, cans082014, cane082014,
canp092014, cans092014, cane092014,
canp102014, cans102014, cane102014,
canp112014, cans112014, cane112014,
canp122014, cans122014, cane122014
FROM aguascalientes.inventario_total a
left join aguascalientes.productos b on b.id=a.p_id
left join aguascalientes.aguas_salidas_entradas14 c on c.clave=b.clave
left join aguascalientes.aguas_salidas_entradas13 d on d.clave=b.clave
left join aguascalientes.aguas_salidas_entradas12 e on e.clave=b.clave;";
            $q = $this->db->query($s);
            //echo $this->db->last_query();
            //die();
        } elseif ($tipo == 'tra') {
            $s = "SELECT id, t.clave as clabo, susa1, ifnull(a.cantidad,0) as inv, 
'' as canp012012, '' as cans012012, '' as cane012012,
'' as canp022012, '' as cans022012, '' as cane022012,
'' as canp032012, '' as cans032012, '' as cane032012,
'' as canp042012, '' as cans042012, '' as cane042012,
'' as canp052012, '' as cans052012, '' as cane052012,
'' as canp062012, '' as cans062012, '' as cane062012,
'' as canp072012, '' as cans072012, '' as cane072012,
'' as canp082012, '' as cans082012, '' as cane082012,
'' as canp092012, '' as cans092012, '' as cane092012,
'' as canp102012, '' as cans102012, '' as cane102012,
'' as canp112012, '' as cans112012, '' as cane112012,
'' as canp122012, '' as cans122012, '' as cane122012, 
'' as canp012013, '' as cans012013, '' as cane012013,
'' as canp022013, '' as cans022013, '' as cane022013,
'' as canp032013, '' as cans032013, '' as cane032013,
'' as canp042013, '' as cans042013, '' as cane042013,
'' as canp052013, '' as cans052013, '' as cane052013,
'' as canp062013, '' as cans062013, '' as cane062013,
'' as canp072013, '' as cans072013, '' as cane072013, 
'' as canp082013, '' as cans082013, '' as cane082013, 
'' as canp092013, '' as cans092013, '' as cane092013, 
'' as canp102013, '' as cans102013, '' as cane102013, 
'' as canp112013, '' as cans112013, '' as cane112013, 
'' as canp122013, '' as cans122013, '' as cane122013,
canp012014, cans012014, cane012014, 
canp022014, cans022014, cane022014, 
canp032014, cans032014, cane032014, 
canp042014, cans042014, cane042014, 
canp052014, cans052014, cane052014, 
canp062014, cans062014, cane062014, 
canp072014, cans072014, cane072014, 
canp082014, cans082014, cane082014, 
canp092014, cans092014, cane092014, 
canp102014, cans102014, cane102014, 
canp112014, cans112014, cane112014, 
canp122014, cans122014, cane122014
FROM trasimeno140.trasimeno140_salidas_entradas14 t
left join trasimeno140.inventario_d_clave a on a.clave=t.clave;";
            $q = $this->db->query($s);
            
        }

        return $q;
    }


    public function almacen_det_seg($tipo)
    {
        $s = "SELECT ifnull(c.clave,' ')as clavecat,b.clave,b.descripcion,
case when tipo_producto=1 then 1 else 5 end line,sum(inv)as existencia,
ifnull((select sum(cantidad) from segpop.inventario_d x where x.clave=c.clave and caducidad<adddate(date(now()),interval 1 year) and caducidad<>'0000-00-00' group by x.clave),0)+
ifnull((select sum(cantidad) from trasimeno140.inventario_d x where x.clave=c.clave and caducidad<adddate(date(now()),interval 1 year) and caducidad<>'0000-00-00' group by x.clave),0)
as ofimenor,
ifnull((select sum(cantidad) from segpop.inventario_d x where x.clave=c.clave and caducidad>=adddate(date(now()),interval 1 year) or  x.clave=c.clave and caducidad='0000-00-00' group by x.clave),0)+
ifnull((select sum(cantidad) from trasimeno140.inventario_d x where x.clave=c.clave and caducidad>=adddate(date(now()),interval 1 year)  or  x.clave=c.clave and caducidad='0000-00-00' group by x.clave),0)
as ofimayor,

ifnull((SELECT sum(cans) FROM almacen.compraped_l x
WHERE aaap=year(now()) and mesp=1 and tipo='agu' and x.claves=c.clave
group by x.claves),0)ene,
ifnull((SELECT sum(cans) FROM almacen.compraped_l x
WHERE aaap=year(now()) and mesp=2 and tipo='agu' and x.claves=c.clave
group by x.claves),0)feb,
ifnull((SELECT sum(cans) FROM almacen.compraped_l x
WHERE aaap=year(now()) and mesp=3 and tipo='agu' and x.claves=c.clave
group by x.claves),0)mar,
ifnull((SELECT sum(cans) FROM almacen.compraped_l x
WHERE aaap=year(now()) and mesp=4 and tipo='agu' and x.claves=c.clave
group by x.claves),0)abr,
ifnull((SELECT sum(cans) FROM almacen.compraped_l x
WHERE aaap=year(now()) and mesp=5 and tipo='agu' and x.claves=c.clave
group by x.claves),0)may,
ifnull((SELECT sum(cans) FROM almacen.compraped_l x
WHERE aaap=year(now()) and mesp=6 and tipo='agu' and x.claves=c.clave
group by x.claves),0)jun,
ifnull((SELECT sum(cans) FROM almacen.compraped_l x
WHERE aaap=year(now()) and mesp=7 and tipo='agu' and x.claves=c.clave
group by x.claves),0)jul,
ifnull((SELECT sum(cans) FROM almacen.compraped_l x
WHERE aaap=year(now()) and mesp=8 and tipo='agu' and x.claves=c.clave
group by x.claves),0)ago,
ifnull((SELECT sum(cans) FROM almacen.compraped_l x
WHERE aaap=year(now()) and mesp=9 and tipo='agu' and x.claves=c.clave
group by x.claves),0)sep,
ifnull((SELECT sum(cans) FROM almacen.compraped_l x
WHERE aaap=year(now()) and mesp=10 and tipo='agu' and x.claves=c.clave
group by x.claves),0)oct,
ifnull((SELECT sum(cans) FROM almacen.compraped_l x
WHERE aaap=year(now()) and mesp=11 and tipo='agu' and x.claves=c.clave
group by x.claves),0)nov,
ifnull((SELECT sum(cans) FROM almacen.compraped_l x
WHERE aaap=year(now()) and mesp=12 and tipo='agu' and x.claves=c.clave
group by x.claves),0)dic
FROM aguascalientes.inventario a
left join aguascalientes.productos b on b.id=a.p_id
left join oficinas.convertir_claves c on c.clave_punto=b.clave

where inv>0
group by b.clave
order by c.clave";
        $q = $this->db->query($s);
        return $q;
    }


    public function inv_sucursal()
    {
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
        if($nivel==12){$var='regional ='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv ='.$id_plaza.' and ';}else{$var='';}    
        $s = "select a.tipo as clasi, a.sec,a.susa,sum(cantidad)as cantidad,inv1,sum(d.final)as optimo,
                    sum(case when cantidad>=d.final then d.final else cantidad end)as exis_sin_exc
from catalogo.cat_almacen_clasifica a 
left join desarrollo.inv b on a.sec=b.sec 
left join desarrollo.inv_cedis_sec1 c on c.sec=a.sec
left join catalogo.sucursal c on c.suc=b.suc
left join almacen.max_sucursal d on d.suc=b.suc and d.sec=a.sec
where $var mov=7 and a.sec>=1 and a.sec<=2000 and b.suc>100  and descon='N' and fechai>=subdate(date(now()),2) and tipo3='DA'
group by a.sec";
        $q = $this->db->query($s);
        return $q;
    }
    public function inv_sucursal_espe($sec)
    {
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
        if($nivel==12){$var='regional ='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv ='.$id_plaza.' and ';}else{$var='';}
        $s = "select b.nombre as sucx,a.* from desarrollo.inv a
left join catalogo.sucursal b on b.suc=a.suc
where $var mov=7 and a.sec=$sec and a.suc>100 and a.cantidad>0 and fechai>=subdate(date(now()),2) and tipo3 in ('DA','FA') ";
        $q = $this->db->query($s);
        return $q;
    }
public function inv_sucursal_descon()
    {
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
        if($nivel==12){$var='regional ='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv ='.$id_plaza.' and ';}else{$var='';}    
        $s = "select b.tipo as clasi, b.sec,b.susa,ifnull(a.inv1,0)as inv1,sum(c.cantidad)as exis_suc

From catalogo.cat_almacen_clasifica b
left join desarrollo.inv_cedis_sec1 a on a.sec=b.sec
join desarrollo.inv c on c.sec=b.sec and mov=7 and fechai>=subdate(date(now()),2)
join catalogo.sucursal d on d.suc=c.suc
where $var  descon='S' and tipo3='DA' group by b.sec";
        $q = $this->db->query($s);
        return $q;
    }
    
    public function inv_gral()
    {

        $s = "select a.*,
ifnull((select m11 from almacen.max_cedis x where x.sec=a.sec),0)as farmacia,
ifnull((select inv1 from desarrollo.inv_cedis_sec1 x where x.sec=a.sec),0)as cedis,
ifnull((select sum(cantidad)  From farmabodega.inventario_d where left(clave,(LENGTH(clave)-1))=a.sec group by left(clave,(LENGTH(clave)-1))),0)as fbo,
0 as cht,
ifnull((
select SUM(a.inv)
from aguascalientes.inventario a
left join aguascalientes.productos b on a.p_id=b.id
left join oficinas.convertir_claves c on c.clave_punto=b.clave
where inv<>0 and c.clave=a.clagob
GROUP BY b.clave
order by c.clave
),0)as agu,
ifnull((select sum(cantidad) from trasimeno140.inventario_d x where  x.clave=a.clagob group by clave),0)as tra,
ifnull((select sum(cantidad) from segpop.inventario_d x where x.clave=a.clagob group by clave),0)as seg,
ifnull((select sum(invf) from almacen.control_invd x where x.clave=a.clagob group by clave),0)as con,
ifnull((select sum(cantidad) from desarrollo.inv x where x.sec=a.sec and x.suc in(176,177,178,179,180,187) and mov=7 group by sec),0)as modu
from catalogo.cat_nuevo_general_cla a
where   a.tipo<>'X'
order by sec";
        $q = $this->db->query($s);
        return $q;
    }


    public function busca_inventario_clave($descri, $clave, $lot)
    {


        $this->db->select('o.almacen as almacen, i.clave as clave, i.descripcion as descripcion, i.lote as lote, i.caducidad as caducidad, i.inventario as inventario');
        $this->db->select("case when caducidad = '0000-00-00' then '9999-12-31' else caducidad end as caducidad", false);
        $this->db->from('inventarios.inventario i');
        $this->db->join('inventarios.origen o', 'i.origen=o.origen', 'left');
        $this->db->where('inventario<>0', '', false);
        $this->db->order_by('almacen', 'clave', 'caducidad', 'acs');

        if (isset($clave) && strlen(trim($clave)) > 0) {
            $this->db->like('clave', $clave);
        }

        if (isset($descri) && strlen(trim($descri)) > 0) {
            $this->db->like('descripcion', $descri);
        }

        if (isset($lot) && strlen(trim($lot)) > 0) {
            $this->db->like('lote', $lot);
        }

        $query = $this->db->get();
        //echo $this->db->last_query();
        //echo die();

        return $query;
    }


    function busca_caducidad()
    {

        $sql = "SELECT * FROM inventarios.caducidad";
        $query = $this->db->query($sql);

        $id = array();
        $id[0] = "Selecciona una opcion";

        foreach ($query->result() as $row) {
            $id[$row->id] = $row->vigencia;
        }

        return $id;
    }


    function consulta_caducidad($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('inventarios.caducidad');
        $row = $query->row();
        $s = "SELECT *, almacen, DATEDIFF(caducidad, now()) as diferencia FROM inventarios.inventario i
            left join inventarios.origen o on i.origen=o.origen
            where caducidad <> '0000-00-00' and DATEDIFF(caducidad, now()) between $row->de and $row->hasta order by diferencia";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
    }


    //////////////////////////////////////////////////////////////////////moronatti/////////////////////////////////////////////////////////////////////////
    public function inv_metro_model()
    {
        $s = "select a.fechai,a.suc,c.nombre as sucx,a.codigo, b.descripcion, a.cantidad
from desarrollo.inv a
left join catalogo.cat_mercadotecnia b on a.codigo=b.codigo
left join catalogo.sucursal c on a.suc=c.suc
where a.suc in(176,177,178,179,180) and mov=03
and b.descripcion is null
group by a.suc
order by suc
";
        $q = $this->db->query($s);

        return $q;
    }
    public function inv_metro_model_det($suc)
    {
        $s = "select a.fechai,a.suc,c.nombre as sucx,a.codigo, case when mov=3 then ifnull(b.descripcion,' ') else d.susa end as descri, a.cantidad
from desarrollo.inv a
left join catalogo.cat_mercadotecnia b on a.codigo=b.codigo
left join catalogo.sucursal c on a.suc=c.suc
left join catalogo.cat_almacen_clasifica d on d.sec=a.sec
where a.cantidad>0 and a.suc in(176,177,178,179,180) and mov in(03,07)
and  a.suc=$suc
";
        $q = $this->db->query($s);
        return $q;
    }

    public function inv_metro_model_det_back($suc)
    {
        $s = "select a.suc,c.nombre as sucx,fechai,a.codigo,b.descripcion2 as descri,a.cantidad
from desarrollo.inv a
join catalogo.cod_rel b on b.ean=a.codigo
join catalogo.sucursal c on c.suc=a.suc
where a.suc=$suc and mov=3
order by descri
";
        $q = $this->db->query($s);
        return $q;
    }
    
    function getBusquedaSecForDevolucion($sec)
    {
        $sql = "SELECT d.sec, lote, cadu, susa1, d.id, c.prv, razo FROM desarrollo.compra_d d
join desarrollo.compra_c c on d.id_cc = c.id
join catalogo.sec_unica s on d.sec = s.sec
left join catalogo.provedor p on c.prv = p.prov
where d.sec = ? and c.tipo = 'C'
group by lote, c.prv
order by cadu desc;";

        $query = $this->db->query($sql, $sec);
        
        return $query;
    }
    
    function getBusquedaSecForDevolucionInv($sec)
    {
        $sql = "SELECT i.id, sec, susa1, lote, cadu
FROM desarrollo.inv_cedis i
left join catalogo.sec_unica using(sec)
where sec = ?;";
        
        $query = $this->db->query($sql, $sec);
        return $query;
    }
    
    function getCompraDetalleByID($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('desarrollo.compra_d');
        
        return $query;
    }
    
    function permitirSecuencia($id)
    {
        $query = $this->getCompraDetalleByID($id);
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            
            $this->db->where('sec', $row->sec);
            $this->db->where('lote', $row->lote);
            $query2 = $this->db->get('catalogo.cat_devolucion_autorizados_compras');
            
            if($query2->num_rows() == 0)
            {
                $data = array('sec' => $row->sec, 'lote' => $row->lote, 'caducidad' => $row->cadu);
                $this->db->insert('catalogo.cat_devolucion_autorizados_compras', $data);
            }
        }
    }
    
    function getInvCedisByID($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('desarrollo.inv_cedis');
        
        return $query;
    }

    function permitirSecuencia2($id)
    {
        $query = $this->getInvCedisByID($id);
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            
            $this->db->where('sec', $row->sec);
            $this->db->where('lote', trim($row->lote));
            $query2 = $this->db->get('catalogo.cat_devolucion_autorizados_compras');
            
            if($query2->num_rows() == 0)
            {
                $data = array('sec' => $row->sec, 'lote' => $row->lote, 'caducidad' => $row->cadu);
                $this->db->insert('catalogo.cat_devolucion_autorizados_compras', $data);
            }
        }
    }

    function getPermitidosDevolucionSucursal()
    {
        $sql = "SELECT devolverID, c.sec, lote, caducidad, susa1
FROM catalogo.cat_devolucion_autorizados_compras c
join catalogo.sec_unica s on c.sec = s.sec
;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function eliminarSecuencia($devolverID)
    {
        $this->db->delete('catalogo.cat_devolucion_autorizados_compras', array('devolverID' => $devolverID));
    }
    
    function devolucion_compras_autiruzada()
    {
        $s="select x.sec,f.susa,x.lote,caducidad,
(SELECT sum(cantidad)
FROM desarrollo.devolucion_sucursal_control a
join desarrollo.devolucion_sucursal_detalle b on b.devolucion=a.devolucion
where statusdevolucion in(1,2) and b.sec=x.sec and b.lote = x.lote and a.tipo=2
group by b.sec,b.lote)as capturadas,

(SELECT

sum(ifnull((select  sum(can)
from  desarrollo.devolucion_c c,desarrollo.devolucion_d d 
where d.id_cc=c.id and d.sec=b.sec and d.lote=b.lote
and c.suc=a.suc and c.tipo='E' and  c.fecha> a.fecha_cierre
),0))

FROM desarrollo.devolucion_sucursal_control a
join desarrollo.devolucion_sucursal_detalle b on b.devolucion=a.devolucion
where statusdevolucion in(1,2) and b.sec=x.sec and b.lote = x.lote and a.tipo=2
group by b.sec,b.lote)as validadas

from catalogo.cat_devolucion_autorizados_compras x
join catalogo.cat_almacen_clasifica f on f.sec=x.sec";
$q = $this->db->query($s);
return $q;

    }
    function devolucion_compras_autiruzada_det($sec,$lote)
    {
        $s="SELECT statusdevolucion,a.tipo,a.suc,e.nombre,b.sec,f.susa,lote,caducidad,(cantidad)as capturadas,

ifnull((select  sum(can)
from  desarrollo.devolucion_c c,
desarrollo.devolucion_d d where d.id_cc=c.id and d.sec=b.sec and d.lote=b.lote
and c.suc=a.suc and c.tipo='E' and  c.fecha> a.fecha_cierre
),0)as validadas

FROM desarrollo.devolucion_sucursal_control a
join desarrollo.devolucion_sucursal_detalle b on b.devolucion=a.devolucion
join catalogo.sucursal e on e.suc=a.suc
join catalogo.cat_almacen_clasifica f on f.sec=b.sec
where statusdevolucion in(1,2) and b.sec=$sec and b.lote ='$lote' and a.tipo=2
order by  suc";
$q = $this->db->query($s);
return $q;

    }
function inv_segpop_almacenes($tipoprod)
    {
        $s="SELECT 'ALMACEN PATENTE'as almacenx,cvearticulo,a.ean,concat(trim(b.susa),ifnull(trim(pres),' '))as susa,
            concat(trim(b.descripcion))as des,a.cantidad,a.lote,a.caducidad,a.cantidad,
            case when subdate(caducidad,30) <= date(now()) then a.cantidad else 0 end as caducado,
            case when subdate(caducidad,30) > date(now()) then a.cantidad else 0 end as existencia
            FROM patente2.inventario a
            join patente2.articulos b on b.id=a.id
            where cantidad>0 and tipoprod=$tipoprod
                    union all
            SELECT 'SEGPOP CENTRAL'as almacenx,cvearticulo,a.ean,concat(trim(b.susa),ifnull(trim(pres),' '))as susa,
            concat(trim(b.descripcion))as des,a.cantidad,a.lote,a.caducidad,a.cantidad,
            case when subdate(caducidad,30) <= date(now()) then a.cantidad else 0 end as caducado,
            case when subdate(caducidad,30) > date(now()) then a.cantidad else 0 end as existencia
            FROM spcentral.inventario a
            join spcentral.articulos b on b.id=a.id
            where cantidad>0 and tipoprod=$tipoprod;";
$q = $this->db->query($s);
return $q;

    }

}
