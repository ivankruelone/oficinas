<?php
	class Pedido_model_fenix extends CI_Model {


    function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        
    }


////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////pedido a 60 dias o mas
function formula_fanasa_dias($sucursales)
{
$dias=60;
$aa="select
case when day(date(now()))<3 then month(subdate(date(now()),interval 3 month)) else  month(subdate(date(now()),interval 2 month)) end as mes1,
case when day(date(now()))<3 then month(subdate(date(now()),interval 2 month)) else  month(subdate(date(now()),interval 1 month)) end as mes2,
case when day(date(now()))<3 then month(subdate(date(now()),interval 1 month)) else  month(date(now())) end as mes3";
$qq=$this->db->query($aa);
$rr=$qq->row();
$mes1=$rr->mes1;
$mes2=$rr->mes2;
$mes3=$rr->mes3;
$ver_s="select *from catalogo.sucursal where suc in $sucursales";
$ver_q=$this->db->query($ver_s);
$filtro1='0';$filtro2='0'; 
foreach($ver_q->result()as $ver_r)
{
    if($ver_r->back==1){$filtro1.=','.$ver_r->suc;}else{$filtro2.=','.$ver_r->suc;}
}
$s1="delete from compras.pre_pedido_fenix_for";
$this->db->query($s1);
  $central1="insert ignore into compras.pre_pedido_fenix_for(fecha, suc, cod, descri, pedido,venta,inv, costo, prv, rel, far, oferta, financiero,iva)
(select date(now()),a.suc,c.codigo,c.descripcion,0,sum(cant),
ifnull((select sum(cantidad) from desarrollo.inv m where m.suc=a.suc and m.rel=a.rel),0)
,costo,825,a.rel,farmacia,d.oferta,financiero,c.iva
From vtadc.vta_backoffice a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.cat_fanasa c on c.rel1=a.rel
join compras.ofertas_fanasa_especiales d on d.codigo=c.codigo
where fecha >=subdate(date(now()),$dias) and vtatip=1 and rel>0 and a.suc in($filtro1) and
fecha_modificado>=date(now()) and
(select rel1 from compras.bloqueados_x_mes_todas x where x.rel1=a.rel and date(now()) between fecha1 and fecha2 group by rel1) is null and
(select rel1 from catalogo.cat_mercadotecnia x where x.rel1=a.rel and lin=1 and sublin in(3,4,5,7,8) group by rel1) is null and
(select rel1 from catalogo.cat_fenix_sec_cod x where x.rel1=a.rel group by rel1)is null and
(select rel1 from sucursal.codigos_bloqueados_pedido x where x.rel1=a.rel and activo=1 group by rel1)is null and
(select rel1 from compras.ofertas_lab_far x 
where x.rel1=a.rel and activo=2 and  date(now()) between fecha1 and fecha2 and rel1 not in(3409) group by rel1)is null
group  by a.suc,rel)";
$this->db->query($central1);
   $central2="insert ignore into compras.pre_pedido_fenix_for(fecha, suc, cod, descri, pedido,venta,inv, costo, prv, rel, far, oferta, financiero,iva)
(select date(now()),a.suc,c.codigo,c.descripcion,0,sum(cant),
ifnull((select sum(cantidad) from desarrollo.inv m where m.suc=a.suc and m.rel=a.rel),0)
,costo,825,a.rel,farmacia,oferta,financiero,c.iva
From vtadc.vta_backoffice a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.cat_fanasa c on c.rel2=a.rel
where fecha >=subdate(date(now()),$dias) and vtatip=1 and rel>0 and a.suc in($filtro2) and
fecha_modificado>=date(now()) and
(select rel2 from compras.bloqueados_x_mes_todas x where x.rel2=a.rel and date(now()) between fecha1 and fecha2 group by rel2) is null and
(select rel2 from catalogo.cat_mercadotecnia x where x.rel2=a.rel and lin=1 and sublin in(3,4,5,7,8) group by rel2) is null and
(select rel2 from catalogo.cat_fenix_sec_cod x where x.rel2=a.rel group by rel2)is null and
(select rel2 from sucursal.codigos_bloqueados_pedido x where x.rel2=a.rel and activo=1 group by rel2)is null and
(select rel2 from compras.ofertas_lab_far x 
where x.rel2=a.rel and activo=2 and  date(now()) between fecha1 and fecha2 and rel2 not in(3409) group by rel2)is null
group  by a.suc,rel)";
$this->db->query($central2); 

$pedido="update compras.pre_pedido_fenix_for
set pedido=case 
when inv=0 and venta>2 then round(venta*1.5) 
when inv=0 and venta<=2 then (venta)
when round(venta)>inv then round(venta)-inv end 
where fol=0 and venta>0";
$this->db->query($pedido);
$fol="update compras.pre_pedido_fenix_for
set fol=((select max(fol) from compras.pre_pedido_fenix_ctl)+1)
where fol=0 and pedido>0";
$this->db->query($fol);
}
////////////////////////////////////////////////////////////////////////////////////pedido a 60 dias o mas
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

function formula_fanasa($sucursales)
{
$aa="select
case when day(date(now()))<3 then month(subdate(date(now()),interval 3 month)) else  month(subdate(date(now()),interval 2 month)) end as mes1,
case when day(date(now()))<3 then month(subdate(date(now()),interval 2 month)) else  month(subdate(date(now()),interval 1 month)) end as mes2,
case when day(date(now()))<3 then month(subdate(date(now()),interval 1 month)) else  month(date(now())) end as mes3";
$qq=$this->db->query($aa);
$rr=$qq->row();
$mes1=$rr->mes1;
$mes2=$rr->mes2;
$mes3=$rr->mes3;
$ver_s="select *from catalogo.sucursal where suc in $sucursales";
$ver_q=$this->db->query($ver_s);
$filtro1='0';$filtro2='0'; 
foreach($ver_q->result()as $ver_r)
{
    if($ver_r->back==1){$filtro1.=','.$ver_r->suc;}else{$filtro2.=','.$ver_r->suc;}
}
$s1="delete from compras.pre_pedido_fenix_for";
$this->db->query($s1);
  $central1="insert ignore into compras.pre_pedido_fenix_for(fecha, suc, cod, descri, pedido,venta,inv, costo, prv, rel, far, oferta, financiero,iva)
(select date(now()),a.suc,c.codigo,c.descripcion,0,sum(cant),
ifnull((select sum(cantidad) from desarrollo.inv m where m.suc=a.suc and m.rel=a.rel),0)
,costo,825,a.rel,farmacia,oferta,financiero,c.iva
From vtadc.vta_backoffice a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.cat_fanasa c on c.rel1=a.rel
where fecha >=subdate(date(now()),15) and vtatip=1 and rel>0 and a.suc in($filtro1) and
fecha_modificado>=date(now()) and
(select rel1 from compras.bloqueados_x_mes_todas x where x.rel1=a.rel and date(now()) between fecha1 and fecha2 group by rel1) is null and
(select rel1 from catalogo.cat_mercadotecnia x where x.rel1=a.rel and lin=1 and sublin in(3,4,5,7,8) group by rel1) is null and
(select rel1 from catalogo.cat_fenix_sec_cod x where x.rel1=a.rel group by rel1)is null and
(select rel1 from sucursal.codigos_bloqueados_pedido x where x.rel1=a.rel and activo=1 group by rel1)is null and
(select rel1 from compras.ofertas_lab_far x 
where x.rel1=a.rel and activo=2 and  date(now()) between fecha1 and fecha2 and rel1 not in(3409) group by rel1)is null
group  by a.suc,rel)";
$this->db->query($central1);
   $central2="insert ignore into compras.pre_pedido_fenix_for(fecha, suc, cod, descri, pedido,venta,inv, costo, prv, rel, far, oferta, financiero,iva)
(select date(now()),a.suc,c.codigo,c.descripcion,0,sum(cant),
ifnull((select sum(cantidad) from desarrollo.inv m where m.suc=a.suc and m.rel=a.rel),0)
,costo,825,a.rel,farmacia,oferta,financiero,c.iva
From vtadc.vta_backoffice a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.cat_fanasa c on c.rel2=a.rel
where fecha >=subdate(date(now()),15) and vtatip=1 and rel>0 and a.suc in($filtro2) and
fecha_modificado>=date(now()) and
(select rel2 from compras.bloqueados_x_mes_todas x where x.rel2=a.rel and date(now()) between fecha1 and fecha2 group by rel2) is null and
(select rel2 from catalogo.cat_mercadotecnia x where x.rel2=a.rel and lin=1 and sublin in(3,4,5,7,8) group by rel2) is null and
(select rel2 from catalogo.cat_fenix_sec_cod x where x.rel2=a.rel group by rel2)is null and
(select rel2 from sucursal.codigos_bloqueados_pedido x where x.rel2=a.rel and activo=1 group by rel2)is null and
(select rel2 from compras.ofertas_lab_far x 
where x.rel2=a.rel and activo=2 and  date(now()) between fecha1 and fecha2 and rel2 not in(3409) group by rel2)is null
group  by a.suc,rel)";
$this->db->query($central2); 

$pedido="update compras.pre_pedido_fenix_for
set pedido=case 
when inv=0 and venta>2 then round(venta*1.5) 
when inv=0 and venta<=2 then (venta)
when round(venta*.4)>inv then round(venta*.4)-inv end 
where fol=0 and venta>0";
$this->db->query($pedido);
$fol="update compras.pre_pedido_fenix_for
set fol=((select max(fol) from compras.pre_pedido_fenix_ctl)+1)
where fol=0 and pedido>0";
$this->db->query($fol);
}
function pre_pedido_fanasa_adisiona_especial()
{
$s1="insert ignore into compras.pre_pedido_fenix_for
(fecha, suc, cod, descri, pedido, venta, inv, costo, prv, rel, far, oferta, financiero,  fol, iva)
(SELECT
a.fecha, a.suc, a.cod, a.descri, piezas, 0, 0,  c.costo, a.prv, c.rel2, farmacia, oferta, financiero, 0,c.iva
FROM compras.pre_pedido_fenix a
join catalogo.sucursal b on a.suc=b.suc and back=2
join catalogo.cat_fanasa c on c.codigo=a.cod and rel2>0 and fecha_modificado>=date(now())
where fecha=date(now()) and 
(select rel2 from compras.bloqueados_x_mes_todas x where x.codigo=a.cod and date(now()) between fecha1 and fecha2) is null)";
$q=$this->db->query($s1);

$s2="insert ignore into compras.pre_pedido_fenix_for
(fecha, suc, cod, descri, pedido, venta, inv, costo, prv, rel, far, oferta, financiero, fol, iva)
(SELECT
a.fecha, a.suc, a.cod, a.descri, piezas, 0, 0,  c.costo, a.prv, c.rel1, farmacia, oferta, financiero, 0,c.iva
FROM compras.pre_pedido_fenix a
join catalogo.sucursal b on a.suc=b.suc and back=1
join catalogo.cat_fanasa c on c.codigo=a.cod  and rel1>0 and fecha_modificado>=date(now())
where fecha=date(now()) and  
(select rel2 from compras.bloqueados_x_mes_todas x where x.codigo=a.cod and date(now()) between fecha1 and fecha2) is null)";
$q=$this->db->query($s2);

$s3="update compras.pre_pedido_fenix_for
set fol=((select max(fol) from compras.pre_pedido_fenix_ctl)+1)
where fol=0 and pedido>0";
$q=$this->db->query($s3);
}
function pre_pedido_fanasa()
{
$s="SELECT fecha,a.fol,a.suc,b.nombre,sum(pedido)as pedido,sum(pedido*costo)as importe,
(select sum(cantidad) from desarrollo.inv x where x.suc=a.suc)as inv
FROM compras.pre_pedido_fenix_for a join catalogo.sucursal b on b.suc=a.suc
where fecha=date(now()) and fol>0 group by fecha,fol,suc";
$q=$this->db->query($s);
return $q;
}
function pre_pedido_fanasa_borra_suc($suc)
{
$s="delete from compras.pre_pedido_fenix_for where suc=$suc";
$q=$this->db->query($s);
}

function graba_archivo($fol)
{

$spro2="insert compras.pre_pedido_fenix_ctl(fecha, suc, prv, importe, fol, tipo, canp, imp_facturado, cans,t_pedido,pro_ped)
(select fecha, suc, prv, round(sum((pedido*costo)*(1+iva)),4), fol, 'A', sum(pedido), 0, 0,'f',count(*) 
from compras.pre_pedido_fenix_for where pedido>0 and fol=$fol group by suc)";
$this->db->query($spro2);
$spro3="insert into compras.pre_pedido_fenix_det
(fecha, tipo, fol, prv, suc, cod, descri, piezas, costo, sur, cos_fac, factura,iva)
(select fecha, 'A', fol, prv, suc, cod, descri, pedido,  costo, 0, 0, '',iva 
from compras.pre_pedido_fenix_for where pedido>0 and fol=$fol)";
$this->db->query($spro3);

$sql="SELECT concat(cuenta,'|',date_format(a.fecha,'%Y%m%d'),'|',cod,'|',pedido,'|',far,'|', oferta,'|', financiero) as plano1,
costo,pedido
FROM compras.pre_pedido_fenix_for a
join compras.cuentas_mayorista b on b.suc=a.suc and b.prv=a.prv
where pedido>0 and fol=$fol";
$query=$this->db->query($sql);
     $imp=0;
    $datos=date('Ymd');
    $File = "./txt/PEDFENIX$datos.txt";
    $nom="PEDFENIX$datos.txt";
    $Handle = fopen($File, 'w');
foreach($query->result() as $row)
{
    $imp=$imp+($row->pedido*$row->costo); 
    $Data=
        str_pad($row->plano1,500," ",STR_PAD_RIGHT)
        ."\r\n";
    fwrite($Handle, $Data);
    
}
echo "FORM. AUTORIZADOS ".number_format($imp,2);
return $nom;
}



/////////////////////////////////////////////////////////////////////////////////////

function pedidos_genericos_sec()
{
 $s="delete FROM sucursal.pedido_formulado_fenix";
 $this->db->query($s);
 $s1="insert ignore into sucursal.pedido_formulado_fenix(fecha, suc, sec, venta, exis, pedido, mue, fol)
(select date(now()),a.suc,b.sec,sum(a.cant),ifnull(cantidad,0),
case
when((sum(a.cant)))>ifnull(cantidad,0) and ifnull(cantidad,0)>0
then round((sum(a.cant)))-ifnull(cantidad,0)
when ifnull(cantidad,0)=0
then round((1.5*sum(a.cant)))-ifnull(cantidad,0)
else 0 end, mueble,0
From vtadc.vta_backoffice a
join catalogo.almacen b on b.codigo=a.cod
join catalogo.cat_almacen_clasifica c on c.sec=b.sec and val=1 and c.sec not in(3102,518)
join catalogo.almacen_mue x on x.sec=b.sec
left join desarrollo.inv d on d.suc=a.suc and d.codigo=a.cod
where fecha between subdate(date(now()),15) and date(now()) and vtatip=1 
and a.suc in(103,105,106,107,108,109,112,114,116,129,193,201,202,501,504,511,552,806,812)
group by a.suc,b.sec)";
$this->db->query($s1);
 $s1adicion="insert ignore into sucursal.pedido_formulado_fenix(fecha, suc, sec, venta, exis, pedido, mue, fol)
(select date(now()),a.suc, c.sec,0,0,case when c.sec=3134 then 3 else 2 end, mueble,0
From catalogo.sucursal a,catalogo.cat_almacen_clasifica c
join catalogo.almacen_mue x on x.sec=c.sec

where  c.sec in(3134,3135) and a.suc in(103,105,106,107,108,109,112,114,116,129,193,201,202,501,504,511,552,806,812)
group by a.suc,c.sec)";
$this->db->query($s1adicion);

$s2="insert into catalogo.folio_pedidos_cedis(suc, fechas, tid, fechasur, id_user)
(SELECT suc,fecha,'A','0000-00-00',mue FROM sucursal.pedido_formulado_fenix
where pedido>0 and mue=6 and fecha=date(now())
group by  suc)";
$this->db->query($s2);   

$s4="update sucursal.pedido_formulado_fenix a,catalogo.folio_pedidos_cedis b
set a.fol=b.id
where a.mue=b.id_user and a.suc=b.suc and  a.fecha=b.fechas and a.mue=6";
$this->db->query($s4);
$s5="insert into catalogo.folio_pedidos_cedis(suc, fechas, tid, fechasur, id_user)
(SELECT suc,fecha,'A','0000-00-00',0 FROM sucursal.pedido_formulado_fenix
where pedido>0 and mue<>6 and fecha=date(now())
group by  suc)";
$this->db->query($s5);
$s6="update sucursal.pedido_formulado_fenix a,catalogo.folio_pedidos_cedis b
set a.fol=b.id
where b.id_user=0 and a.suc=b.suc and  a.fecha=b.fechas and a.mue<>6";
$this->db->query($s6);
$s7="insert into desarrollo.pedidos
(suc, fecha, sec, can, fechas,  tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis, verificada)
(SELECT a.suc,a.fecha,a.sec,a.pedido, fecha,1,c.mueble,b.susa,pedido,fol,d.ruta,'F',case when inv1>0 then pedido else 0 end,0,'0000-00-00','N',b.cos_almacen,'0.16',cos_almacen,b.lin,ifnull(inv1,0),0
FROM sucursal.pedido_formulado_fenix a
join catalogo.cat_almacen_clasifica b on b.sec=a.sec
join catalogo.almacen_mue c on c.sec=a.sec
join catalogo.almacen_rutas d on d.suc=a.suc
left join desarrollo.inv_cedis_sec1 e on e.sec=a.sec
WHERE pedido>0 order by fol)";
$this->db->query($s7);
$s8="insert ignore into formulados.pedido_formulado_fenix16(fecha, suc, sec, venta, exis, pedido, mue, fol)
(select fecha, suc, sec, venta, exis, pedido, mue, fol from sucursal.pedido_formulado_fenix)";
$this->db->query($s8);
}























    
    
    }