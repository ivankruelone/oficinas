<?php
class Procesos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 
public function facturas_oficinas()
{
$cat="update metro.surtido_d a,catalogo.almacen b
set a.costo=b.costo
where a.clave=b.sec and b.costo>0";
$this->db->query($cat);
$cat="update almacen.salidas_c a,catalogo.cat_nuevo_general_prv b
set a.costo=b.costo
where a.codigo=b.codigo and a.claves=b.clagob and aaap>=2013 and a.costo=0 and b.costo>0";
$this->db->query($cat);


$fec=date('Y-m-d')-15;
/////////////////////////////////////////////////////////////////////////////////////////surtido de farmabodega
$f="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(SELECT a.suc,concat('FBO',a.id),sum(cans*vta),0,date_format(fechasur,'%Y-%m-%d'),'0000-00-00',
date_format(fechasur,'%Y'),date_format(fechasur,'%m'),1600,sum(cans*(costo*1.1)),13
FROM farmabodega.pedido_c a left join farmabodega.surtido_d b on b.id_ped=a.id
where fechasur>=subdate(date(now()),15) and cans>0
group by a.id)
on duplicate key update importe_prvcosto=values(importe_prvcosto),importe_prv=values(importe_prv)";
$this->db->query($f);
/////////////////////////////////////////////////////////////////////////////////////////surtido de especialidad
$ff="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(SELECT a.suc,concat('ESP',a.id),sum(cans*costo),0,date_format(fechasur,'%Y-%m-%d'),'0000-00-00',
date_format(fechasur,'%Y'),date_format(fechasur,'%m'),1600,sum(cans*(costo)),13
FROM especialidad.pedido_c a left join especialidad.surtido_d b on b.id_ped=a.id
where fechasur>=subdate(date(now()),15) and cans>0
group by a.id)
on duplicate key update importe_prvcosto=values(importe_prvcosto),importe_prv=values(importe_prv)
";
$this->db->query($ff);
/////////////////////////////////////////////////////////////////////////////////////////surtido de controlados_espe
$f1="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select sucursal,folio,
sum(cantidads*costo),0,concat(aaas,'-',mess,'-',dias),'0000-00-00',aaas,mess,100,sum(cantidads*costo),0
from almacen.salidas_c where
aaas>=year(now())
group by folio)
on duplicate key update importe_prvcosto=values(importe_prvcosto),importe_prv=values(importe_prv)";
$this->db->query($f1);
/////////////////////////////////////////////////////////////////////////////////////////surtido de metro
$f2="insert into vtadc.gc_factura
(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(SELECT a.suc,concat('METRO',a.id),sum(cans*costo),0, date_format(fechasur,'%Y-%m-%d'),'0000-00-00',
date_format(fechasur,'%Y'),date_format(fechasur,'%m'),100,sum(cans*costo),0
 FROM metro.pedido_c a
left join metro.surtido_d b on b.id_ped=a.id
where fechasur>=subdate(date(now()),15) and cans>0
group by a.id)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f2);
/////////////////////////////////////////////////////////////////////////////////////////traspaso de farmabodega
$f3="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select 1600,concat('TRA',x.id,'_',sale,entra),sum(cans*costo),
0, date(x.fecha),'0000-00-00', year(x.fecha), month(x.fecha),0,sum(cans*costo),13 from farmabodega.traspaso_c x
left join farmabodega.traspaso_d b on b.id_cc=x.id
where year(x.fecha)>=year(now())
 and cans>0
and x.entra=1600
group by x.id
)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f3);
/////////////////////////////////////////////////////////////////////////////////////////devolucion de farmabodega
$f4="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select 1600,concat('DEV',x.id,'_',sale,entra),sum(cans*costo),
0, date(x.fecha),'0000-00-00', year(x.fecha), month(x.fecha),0,sum(cans*costo),13 from farmabodega.devolucion_c x
left join farmabodega.devolucion_d b on b.id_cc=x.id
where year(x.fecha)>=year(now())
 and cans>0
and x.entra=1600
group by x.id
)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f4);
/////////////////////////////////////////////////////////////////////////////////////////devolucion de metro
$f5="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select 100,concat('DEV',x.id,'_',sale,entra),sum(cans*costo),
0, date(x.fecha),'0000-00-00', year(x.fecha), month(x.fecha),0,sum(cans*costo),1 from metro.devolucion_c x
left join metro.devolucion_d b on b.id_cc=x.id
where year(x.fecha)>=year(now()) and cans>0
and x.entra=100
group by x.id
)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f5);
/////////////////////////////////////////////////////////////////////////////////////////traspaso de metro
$f5="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select 100,concat('TRA',x.id,'_',sale,entra),sum(cans*costo),
0, date(x.fecha),'0000-00-00', year(x.fecha), month(x.fecha),0,sum(cans*costo),1 from metro.traspaso_c x
left join metro.traspaso_d b on b.id_cc=x.id
where year(x.fecha)>=year(now()) and cans>0
and x.entra=100
group by x.id
)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f5);
/////////////////////////////////////////////////////////////////////////////////////////traspaso de cedis
$f6="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select 900,concat('TCEDIS',x.id,'_',suc), sum(can*costo),0,fecha,'0000-00-00',year(fecha),month(fecha),0,sum(can*costo),1 from desarrollo.traspaso_c x
left join desarrollo.traspaso_d b on b.id_cc=x.id
where x.fechai>=subdate(date(now()),200)   and x.tipo='E' and tipo2='C'
group by x.id
)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f6);
/////////////////////////////////////////////////////////////////////////////////////////devolucion de cedis
$f7="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select 900,concat('DCEDIS',x.id,'_',suc), sum(can*costo),0,fecha,'0000-00-00',year(fecha),month(fecha),0,sum(can*costo),1
from desarrollo.devolucion_c x
left join desarrollo.devolucion_d b on b.id_cc=x.id
where x.tipo='E' and x.fechai>=subdate(date(now()),15)  and tipo2='C'
group by x.id
)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f7);















$s="insert into vtadc.gc_factura
(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc,aaa,mes,prv,importe_prvcosto,cia)
(
select
a.suc,a.id,sum(sur*vta),0,date_format(a.fechasur,'%Y-%m-%d'),'0000-00-00',date_format(a.fechasur,'%Y'),date_format(a.fechasur,'%m'),
100,

case
when c.cia=13
then sum(sur*(costo*1.20))
else sum(sur*(costo*1.20))
end,c.cia from  catalogo.folio_pedidos_cedis_especial a
left join desarrollo.pedidos b on a.id=b.fol
left join catalogo.sucursal c on c.suc=a.suc
where a.fechasur>=date_add(now(),interval-15 day) and a.tid='C' and b.sur>0 group by a.id)
on duplicate key update fecha_prv=values(fecha_prv),importe_prv=values(importe_prv),
importe_prvcosto=values(importe_prvcosto),cia=values(cia)"; 
$this->db->query($s);
    
$s1="insert into vtadc.gc_factura
(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc,aaa,mes,prv,importe_prvcosto,cia)
(
select
a.suc,a.id,sum(sur*vta),0,date_format(a.fechasur,'%Y-%m-%d'),'0000-00-00',date_format(a.fechasur,'%Y'),date_format(a.fechasur,'%m'),
100,

case
when c.cia=13
then sum(sur*(costo*1.20))
else sum(sur*(costo*1.20))
end,c.cia from  catalogo.folio_pedidos_cedis a
left join desarrollo.pedidos b on a.id=b.fol
left join catalogo.sucursal c on c.suc=a.suc
where a.fechasur>=date_add(now(),interval-15 day) and a.tid='C' and b.sur>0 group by a.id)
on duplicate key update fecha_prv=values(fecha_prv),importe_prv=values(importe_prv),
importe_prvcosto=values(importe_prvcosto),cia=values(cia)"; 
$this->db->query($s1);    

$s2="load data infile 'c:/wamp/www/subir10/factu.txt' replace into table vtadc.gc_compra_mayorista FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
$this->db->query($s2);
$s3="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv,importe_prvcosto,cia)
(select a.suc,factura,importe,0,fecha,'0000-00-00',date_format(fecha,'%Y'),date_format(fecha,'%m'),prv,importe, b.cia
from vtadc.gc_compra_mayorista a
left join catalogo.sucursal b on b.suc=a.suc
where fecha>=date_add(now(),interval-15 day))
on duplicate key update importe_prv=values(importe_prv),fecha_prv=values(fecha_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($s3);

}
public function facturas_pdv()
{
$s="update vtadc.gc_factura a,vtadc.gc_compra_det_suc_fac b set importe_suc=b.importe, fecha_suc=fecha   
where   a.suc=b.suc and a.factura=b.factura and  
a.suc=b.suc and a.factura=b.factura"; 
$this->db->query($s); 

$s1="select *from vtadc.gc_factura where aaa=year(now()) and mes>=10";
$q1=$this->db->query($s1);
 foreach ($q1->result() as $r1) {

$ss="update vtadc.gc_factura a,vtadc.gc_compra_det_back b set importe_suc=importe,fecha_suc=fecha   
where   a.suc=b.suc and a.factura=b.factura  and  
date_format(fecha,'%Y')=$r1->aaa and  date_format(fecha,'%m')=$r1->mes and b.suc=$r1->suc and b.factura='$r1->factura'"; 
$this->db->query($ss); 
}
$s3="insert into vtadc.gc_factura_suc(aaa, mes, suc, importe_prvo, importe_suco, importe_prvs, importe_sucs,importe_prvocosto,cia)
(SELECT aaa,mes,suc,0,0, sum(importe_prv), sum(importe_suc),0,cia FROM vtadc.gc_factura   group by aaa,mes,suc)
on duplicate key update importe_prvs=values(importe_prvs),importe_sucs=values(importe_sucs);";
$this->db->query($s3);
$s4="insert into vtadc.gc_factura_suc(aaa, mes, suc, importe_prvo, importe_suco, importe_prvs, importe_sucs,importe_prvocosto,cia)
(SELECT aaa,mes,suc, sum(importe_prv), sum(importe_suc),0,0 ,sum(importe_prvcosto),cia FROM vtadc.gc_factura  group by aaa,mes,suc)
on duplicate key update importe_prvo=values(importe_prvo),importe_suco=values(importe_suco),importe_prvocosto=values(importe_prvocosto);";
$this->db->query($s4);
}












public function max_sucursal()
    {
$s="update vtadc.producto_mes_suc_gen a, almacen.max_sucursal b
set b.final=round((venta10+venta8+venta9)/case when
venta10=0 and venta8=0 and venta9>0 or
venta10=0 and venta8>0 and venta9=0 or
venta10>0 and venta8=0 and venta9=0
then 1
when
venta10=0 and venta8>0 and venta9>0 or
venta10>0 and venta8>0 and venta9=0 or
venta10>0 and venta8=0 and venta9>0
then 2
when
venta10>0 and venta8>0 and venta9>0
then 3
end)

  where a.suc=b.suc and a.sec=b.sec and (venta10+venta9+venta8)>0";
$this->db->query($s);
$s="update vtadc.producto_mes_suc_gen a, almacen.max_sucursal b
set b.final=venta10
where a.suc=b.suc and a.sec=b.sec and b.final=0";
$this->db->query($s);
$s="update vtadc.producto_mes_suc_gen a, almacen.max_sucursal b
set b.final=venta10
where a.suc=b.suc and a.sec=b.sec and b.final=0";
$this->db->query($s);
$s="update vtadc.producto_mes_suc_gen set final=0";
$this->db->query($s);

$s="update desarrollo.inv_cedis_sec1 a, almacen.max_sucursal b
set b.final=2
where a.sec=b.sec and final=0 and inv1>0";
$this->db->query($s);

$s="update vtadc.producto_mes_suc_gen a, almacen.max_sucursal b
set a.final=b.final where a.suc=b.suc and a.sec=b.sec ";
$this->db->query($s);

    }    

    public function max_por($clave)
    {
 $s="insert ignore into almacen.max_sucursal(sec, suc, susa, m2011, m2012, m2013, m2014, final, paquete, obser)
(select b.sec,a.suc,b.susa,0,0,0,0,3,0,'ASTA AGOTAR EXIS. SP'
from catalogo.sucursal a,
 catalogo.cat_almacen_clasifica b
where a.tlid=1 and a.suc>100 and a.suc<=2000 and a.tipo2<>'F'
and a.suc<>170
and a.suc<>171
and a.suc<>172
and a.suc<>173
and a.suc<>174
and a.suc<>175
and a.suc<>176
and a.suc<>177
and a.suc<>178
and a.suc<>179
and a.suc<>180
and a.suc<>181
and a.suc<>187
and a.dia<>' '
and b.sec in ($clave))";
 $this->db->query($s);   

$s="insert into vtadc.producto_mes_suc_gen(aaa, sec, suc, descripcion,
venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12,
costo, m2011, m2012, m2013, final)
(select year(now()),sec,suc,susa,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0, final from almacen.max_sucursal where sec in ($clave))
on duplicate key update final=values(final)
";
 $this->db->query($s);
} 
 
public function ver_inv()
    {
$s="select aaa,mes,dia,sum(piezas)as piezas, count(suc)as numero,sum(importe)as importe  from oficinas.inv_mes_suc group by aaa,mes";
$q=$this->db->query($s);
return $q;
    }
public function ver_inv_suc()
    {
$s="select date_add(b.fechai,interval +1 day)as fecha,a.suc,a.nombre,ifnull(sum(b.cantidad),0)as inv
from catalogo.sucursal a
left join desarrollo.inv b on b.suc=a.suc and b.mov=7 or b.suc=a.suc and b.mov=3
where a.suc>=100 and a.suc<=1999 and a.tlid=1
group by a.suc order by fecha";
$q=$this->db->query($s);
return $q;
    }
public function ver_inv_suc_his()
    {
$s="select aaa,mes,dia,sum(piezas)as piezas, count(suc)as numero,sum(importe)as importe 
from oficinas.inv_mes_suc_his group by aaa,mes";
$q=$this->db->query($s);
return $q;
    }
 
    
public function genera_inv($aaa,$mes,$dia,$sem)
{
$x1="delete from oficinas.inv_mes_suc_det";$this->db->query($x1);
$x="delete from oficinas.inv_mes_suc";$this->db->query($x);
$x2="delete from oficinas.inv_seguros where suc in(6050,90002)";$this->db->query($x2);

$s="insert ignore into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(SELECT $aaa,$mes, a.cia,a.suc,a.sec,' ',a.codigo,' ',a.cantidad,
0,0,'FARMACIA',$dia
FROM desarrollo.inv a
where a.mov=03 and a.cantidad>0 and suc>100)";
$this->db->query($s);

$s="update metro.inventario_d a, catalogo.cat_mercadotecnia b
set a.costo=b.farmacia
 where a.codigo=b.codigo and a.codigo>0 and costo=0";
$this->db->query($s);

$s="update catalogo.cat_nuevo_general_cla b, metro.inventario_d a
set a.costo=b.cos
where a.sec_nueva=b.sec  and a.sec_nueva>0 and a.costo=0";
$this->db->query($s);


$s="load data infile 'c:/wamp/www/subir10/costop.txt'
replace into table catalogo.cat_costo_fac FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n' (prv, codigo, @descri, iva, far, cos, margen) set descri = CONVERT(CAST(@descri as BINARY) USING LATIN1);";        
$this->db->query($s);

$s="update  catalogo.cat_costo_fac  a, desarrollo.catbackoffice b
set a.descri=b.descripcion,
lin=substring(linea,1,1)
where a.codigo=b.ean";
$this->db->query($s);
$s="insert into catalogo.cat_costo_fac(prv, codigo, descri, iva, far, cos, margen, lin)
(select prv,codigo,susa2,case when lin in(2,5,9) then 1 else 0 end,round((costo*1.20),2),round((costo*1.20),2),0,lin
from catalogo.almacen where sec>0 and costo>0 and sec<=2000)
on duplicate key update cos=values(cos)";
$this->db->query($s);
$s="update oficinas.inv_mes_suc_det a, catalogo.cat_costo_fac b
set a.costo=b.cos,a.lin=b.lin
where a.codigo=b.codigo and a.aaa=$aaa and a.mes=$mes";
$this->db->query($s); 
$s="update oficinas.inv_mes_suc_det a, catalogo.cat_nadro b
set a.costo=b.costo
where a.codigo=b.codigo and a.aaa=$aaa and a.mes=$mes";
$this->db->query($s);       

$s="insert ignore into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(SELECT $aaa,$mes, a.cia,a.suc,a.sec,' ',a.codigo,b.susa1,a.cantidad,
case when a.cia=13 then round((b.costo*1.20),2)else round((b.costo*1.20),2) end,b.lin,'FARMACIA',$dia
FROM desarrollo.inv a
left join catalogo.almacen b on b.sec=a.sec
where tsuc<>'F' and a.mov=07 and a.cantidad>0 and a.suc<1600 group by a.suc,a.sec)";
$this->db->query($s);
$s="insert ignore into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(SELECT $aaa,$mes, a.cia,a.suc,a.sec,' ',a.codigo,b.susa1,a.cantidad,
case when a.cia=13 then round((b.costo*1.10),2)else round((b.costo*1.10),2) end,b.lin,'FARMACIA',$dia
FROM desarrollo.inv a
left join catalogo.almacen b on b.clabo=a.sec
where tsuc<>'F' and a.mov=07 and a.cantidad>0 and a.suc in(1601,1602,1603) group by a.suc,a.sec)";
$this->db->query($s);
$s="update desarrollo.inv_cedis a, catalogo.almacen b
set a.costo=b.costo
where a.inv1>0 and a.costo=0 and a.sec=b.sec and b.tsec='G'";
$this->db->query($s);
$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,13,900,aa.sec,' ',aa.codigo,bb.susa1,sum(inv1),aa.costo,bb.lin,'ALM CEDIS',$dia
from desarrollo.inv_cedis aa left join catalogo.sec_generica bb on bb.sec=aa.sec where aa.inv1>0 group by aa.sec)
";
$this->db->query($s);

//$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
//(select $aaa,$mes,1,100,0,aa.clave,aa.codigo,aa.descri,sum(cantidad),aa.costo,1,'ALM ESPECIALIDAD',$dia
//from especialidad.inventario_d aa where aa.cantidad>0 group by aa.clave)";
//$this->db->query($s);

$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,1,100,0,aa.clave,aa.codigo,ifnull((select susa1 from catalogo.almacen bb where bb.sec=aa.clave group by bb.sec),''),sum(cantidad),aa.costo,1,'ALM METRO',$dia
from metro.inventario_d aa left join catalogo.almacen bb on bb.sec=aa.clave where aa.cantidad>0 group by aa.clave)";
$this->db->query($s);

$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,13,1600 ,aa.clave,' ',aa.codigo,bb.susa1,sum(cantidad),bb.costo,bb.lin,'ALM FARMABODEGA',$dia
from farmabodega.inventario_d aa left join catalogo.almacen bb on bb.clabo=aa.clave where aa.cantidad>0 group by aa.clave)
";
$this->db->query($s);
$s="insert into oficinas.inv_seguros(aaa, mes, dia, suc, clave, descripcion, piezas, costo, lin, piezas_paquete, clave_sin_punto)
(select $aaa,$mes,$dia,90002,clave,descri,sum(cantidad), 0,1,sum(cantidad),clave from segpop.inventario_d  where cantidad>0 group by clave)
";
$this->db->query($s);
$s="insert into oficinas.inv_seguros(aaa, mes, dia, suc, clave, descripcion, piezas, costo, lin, piezas_paquete, clave_sin_punto)
(select $aaa,$mes,$dia,6050,clave,descri,sum(cantidad/contable_div), 0,5,sum(cantidad/contable_div),clave from trasimeno140.inventario_d  where cantidad>0 group by clave)
";
$this->db->query($s);

  
$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,1,100,0,aa.clave,aa.codigo,ifnull(trim(susa),' '),sum(invf)as invf,aa.costo,1,'ALM CONTROLADOS',$dia
from almacen.control_invd aa
left join catalogo.cat_con bb on bb.clave=aa.clave
where aa.invf>0  group by aa.clave)";
$this->db->query($s);

//////////////seguros populares
$ss="delete from oficinas.inv_seguros where suc=16000";
$this->db->query($ss);
$ss="insert into oficinas.inv_seguros (aaa, mes, dia, suc, clave, descripcion, piezas, costo, lin, piezas_paquete, clave_sin_punto)
(select $aaa,$mes,$dia,16000,clave,descri,sum(cantidad),costo,lin,
SUM(case when div_conta>0 then cantidad/div_conta else cantidad end),clave from oficinas.inv_seguros_lote group by clave)";
$this->db->query($ss);
$s = "update  oficinas.inv_seguros a set piezas_paquete=piezas, clave_sin_punto=clave 
where  a.aaa=$aaa and a.mes=$mes and suc<>16000";
$q = $this->db->query($s);
 
$s = "update  oficinas.inv_seguros a,oficinas.convertir_claves b
set clave_sin_punto=b.clave
where a.clave=b.clave_punto and a.aaa=$aaa and a.mes=$mes and suc<>16000";
$q = $this->db->query($s);

$s = "update oficinas.inv_seguros a, catalogo.costos_gobierno b
set a.costo=b.costo,piezas_paquete= case when paquete>1 then (a.piezas/b.paquete) else a.piezas end
where a.clave_sin_punto=b.clave and  a.aaa=$aaa and a.mes=$mes and suc <> 16000";
$q = $this->db->query($s);

$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo,dia)
(select aaa, mes, 1, suc,0, clave_sin_punto,0, substr(descripcion,1,70), piezas_paquete, costo, lin, 'ALM SEGPOP',$dia 
from oficinas.inv_seguros a where a.aaa=$aaa and a.mes=$mes and suc in(17000,14000,16000,6050,90002) and piezas_paquete>0)";
$this->db->query($s);
 
$s="insert into oficinas.inv_mes_suc(aaa, mes, cia, suc, piezas, importe,dia,sem)
(select aaa,mes,cia,suc,sum(piezas),sum(piezas*costo),dia,$sem from oficinas.inv_mes_suc_det where  aaa=$aaa and mes=$mes group by aaa,mes,suc)";
$this->db->query($s);
die();
$s="insert into desarrollo.inv_cosvta(cia, suc, sem, aaaa, mes, lin, plaza, succ, importe,piezas)
(select a.cia,a.suc,$sem,aaa,mes,lin,b.plaza,b.suc_contable,
 sum(piezas*costo), sum(piezas)
from oficinas.inv_mes_suc_det a
left join catalogo.sucursal b on b.suc=a.suc
where a.costo>0 and a.aaa=$aaa and a.mes=$mes and a.dia=$dia and a.suc>=100
group by a.aaa,a.mes,a.dia,a.suc,a.lin
)";
$this->db->query($s);

}


public function respalda_inv()
{
$s="insert into oficinas.inv_mes_suc_det_his (aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo, dia)
(select aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo, dia from  oficinas.inv_mes_suc_det)";
$this->db->query($s);
$s1="insert into oficinas.inv_mes_suc_his(aaa, mes, cia, suc, piezas, importe, dia,sem)
(select aaa, mes, cia, suc, piezas, importe, dia from oficinas.inv_mes_suc)";
$this->db->query($s1);    
}

public function ver_ent_sal()
{
$s="select sem,fec1,fec2,sum(ent)as ent,sum(sal)as sal from oficinas.sem_ent_sal where suc>=100
group by sem,fec1";
$q=$this->db->query($s);
return $q;
}

public function p_ent_sal()
{
$s="select a.*,b.nombre as sucx from oficinas.sem_ent_sal a 
left join catalogo.sucursal b on b.suc=a.suc where a.suc>100 and a.suc<>1045 and a.suc<1603";
$q=$this->db->query($s);
return $q;
}

public function ent_sal($fec1,$fec2,$sem)
{
$aaa=substr($fec1,0,4);$mes=substr($fec1,5,2); $dia1=substr($fec1,8,2); $dia2=substr($fec2,8,2);
////////////////////////////////////////////////////////////////////entradas y salidas sucursales
$s="insert into oficinas.sem_ent_sal(suc, ent, sal, fec1, fec2, sem)
(
select suc,0,sum(can),'$fec1','$fec2',$sem
from vtadc.venta_detalle where fecha between '$fec1' and '$fec2'
 and descri not like'%tarjeta%' and descri not like '%recarga%'
and suc>100
 group by suc

)
on duplicate key update sal=values(sal)";
$this->db->query($s);
$s="insert into oficinas.sem_ent_sal(suc, ent, sal, fec1, fec2, sem)
(
SELECT suc,sum(can),0,'$fec1','$fec2',$sem
FROM vtadc.gc_compra_det where fecha between '$fec1' and '$fec2'
and suc>100
group by suc
)
on duplicate key update ent=values(ent)";
$this->db->query($s);
$s="update oficinas.sem_ent_sal a
set
ent_back=ifnull((SELECT sum(piezas)
frOM vtadc.gc_compra_det_back b where b.suc=a.suc and fecha between fec1 and fec2 group by suc)-
(SELECT sum(piezas)
frOM vtadc.gc_compra_dev_back b where b.suc=a.suc and fecha between fec1 and fec2 group by suc),0),

imp_ent_back=ifnull((SELECT sum(importe)
frOM vtadc.gc_compra_det_back b where b.suc=a.suc and fecha between fec1 and fec2 group by suc)-
(SELECT sum(importe)
frOM vtadc.gc_compra_dev_back b where b.suc=a.suc and fecha between fec1 and fec2 group by suc),0)
where a.fec1='$fec1' and a.fec2='$fec2'
";
$this->db->query($s);
//////////////////////////////////////7////////////////////////////////////////////////////////importe de entradas
$s="insert into oficinas.sem_ent_sal (suc, ent, sal, fec1, fec2, sem, imp_ent)
(select case
when suc=14000 or suc=14900 then 14000
when suc=17000 or suc=17900 then 17000
when suc=16000 or suc=16900 then 16000
else suc end as suca,
0,0,'$fec1','$fec2',0,
sum(importe_prvcosto) from vtadc.gc_factura
where fecha_prv>='$fec1' and fecha_prv<='$fec2'
and suc>=100
group by suc)
on duplicate key update imp_ent=values(imp_ent);";
$this->db->query($s);
if($mes==1){$aaas=$aaa-1;$mes=12;}else{$aaas=$aaa;$mess=$mes-1;}
$s="insert into sem_ent_sal (suc, ent, sal, fec1, fec2, sem, inv_ini, imp_inv_ini)
(select suc,0,0,'$fec1','$fec2',$sem,piezas,importe from oficinas.inv_mes_suc_his where aaa=$aaas and mes=$mess)
on duplicate key update inv_ini=values(inv_ini),imp_inv_ini=values(imp_inv_ini)";
$this->db->query($s);
$s="insert into sem_ent_sal (suc, ent, sal, fec1, fec2, sem, inv_fin, imp_inv_fin)
(select suc,0,0,'$fec1','$fec2',$sem,piezas,importe from oficinas.inv_mes_suc_his where aaa=$aaa and mes=$mes)
on duplicate key update inv_fin=values(inv_fin),imp_inv_fin=values(imp_inv_fin)";
$this->db->query($s);
if($sem==0){
$s="insert into sem_ent_sal(suc, ent, sal, fec1, fec2, sem, ent_back, imp_ent, imp_sal, imp_ent_back, imp_cred, imp_rec)
(select suc,0,0,'$fec1','$fec2',0,0,0,contado,0,credito,recarga from vtadc.gc_venta_mes where aaa=$aaa and mes=$mes)
on duplicate key update imp_sal=values(imp_sal),imp_cred=values(imp_cred),imp_rec=values(imp_rec)";
$this->db->query($s);
 
}














die();
//////////////////////////////////////////////////////////////// entradas y salidas almacen cedis 900
$s="insert into oficinas.sem_ent_sal (suc, ent,sal,imp_sal,fec1, fec2, sem)
(
select 900,
sum(ifnull((select sum(can) from desarrollo.compra_d b where fechai>='$fec1' and date_format(fechai,'%Y-%m-%d')<='$fec2'
),0)
+
ifnull((select sum(can) from desarrollo.traspaso_c x
left join desarrollo.traspaso_d b on b.id_cc=x.id
where x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and x.tipo='E' and tipo2='C'
),0)
+
ifnull((select sum(can) from desarrollo.devolucion_c x
left join desarrollo.devolucion_d b on b.id_cc=x.id
where x.tipo='E' and x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and mov in(1,2)
and tipo2='C' ),0))
as entradas,

sum(ifnull((select sum(sur) from desarrollo.pedidos x 
where date_format(x.fechasur,'%Y-%m-%d')>='$fec1' and date_format(x.fechasur,'%Y-%m-%d')<='$fec2' and sur>0
),0)
+
ifnull((select sum(can) from desarrollo.traspaso_c x
left join desarrollo.traspaso_d b on b.id_cc=x.id
where x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and x.tipo='S' and tipo2='C' ),0)
+
ifnull((select sum(can) from desarrollo.devolucion_c x
left join desarrollo.devolucion_d b on b.id_cc=x.id
where x.tipo='S' and x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and suc=100
and tipo2='C' ),0))as salidas,


sum(ifnull((select sum(sur*(costo*1.2)) from desarrollo.pedidos x 
where date_format(fechasur,'%Y-%m-%d')>='$fec1' and date_format(x.fechasur,'%Y-%m-%d')<='$fec2' and sur>0
),0)
+
ifnull((select sum(can*costo) from desarrollo.traspaso_c x
left join desarrollo.traspaso_d b on b.id_cc=x.id
where x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and x.tipo='S' and tipo2='C'
),0)
+
ifnull((select sum(can*(costo*1.2)) from desarrollo.devolucion_c x
left join desarrollo.devolucion_d b on b.id_cc=x.id
where x.tipo='S' and x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and suc=100
and tipo2='C' ),0))as imp_sal,


'$fec1','$fec2',$sem
)
on duplicate key update ent=values(ent),sal=values(sal)";
$this->db->query($s);
//////////////////////////////////////////////////////////////// entradas y salidas controlados 1 equivale a la 100
$s="insert into oficinas.sem_ent_sal (suc, ent, sal,imp_sal, fec1, fec2, sem)
(
SELECT 1,
sum(ifnull((SELECT sum(cans) FROM almacen.control_comprac x
left join almacen.control_comprad b on b.folio=x.folio
where x.aaas=$aaa and x.mess=$mes and x.dias>=$dia1 and x.dias<=$dia2 
),0)
+
ifnull((SELECT sum(can) FROM almacen.control_dev x
left join almacen.control_devd b on b.folio=x.folio
where x.aaas=$aaa and x.mess=$mes and x.dias>=$dia1 and x.dias<=$dia2
and suc<>100),0))as entrada,

sum(ifnull((SELECT sum(cantidads) FROM almacen.salidas_c x 
where x.aaas=$aaa and x.mess=$mes and x.dias>=$dia1 and x.dias<=$dia2
 ),0)
+
ifnull((SELECT sum(can) FROM almacen.control_dev x
left join almacen.control_devd b on b.folio=x.folio
where x.aaas=$aaa and x.mess=$mes and x.dias>=$dia1 and x.dias<=$dia2 
and suc=100),0))as salida,

sum(ifnull((SELECT sum(cantidads*costo) FROM almacen.salidas_c x 
where x.aaas=$aaa and x.mess=$mes and x.dias>=$dia1 and x.dias<=$dia2
 ),0)
+
ifnull((SELECT sum(can*costo) FROM almacen.control_dev x
left join almacen.control_devd b on b.folio=x.folio
where x.aaas=$aaa and x.mess=$mes and x.dias>=$dia1 and x.dias<=$dia2 
and suc=100),0))as imp_sal,
'$fec1','$fec2',$sem

)
on duplicate key update ent=values(ent),sal=values(sal),imp_sal=values(imp_sal)";
$this->db->query($s);
//////////////////////////////////////////////////////////////// entradas y salidas especialidad 2 equivale a la 100
$s="insert into oficinas.sem_ent_sal (suc, ent, sal,imp_sal, fec1, fec2, sem)
(
SELECT 2,

sum(ifnull((select sum(can) from especialidad.compra_c x
left join especialidad.compra_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
),0)
+
ifnull((select sum(cans) from especialidad.devolucion_c x
left join especialidad.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.entra=100 and concepto<=2
),0))as entrada,

sum(ifnull((select sum(cans) from especialidad.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'),0)
+
ifnull((select sum(cans) from especialidad.devolucion_c x
left join especialidad.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' 
and x.sale=100
),0))as salida,

sum(ifnull((select sum(cans*costo) from especialidad.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'),0)
)as imp_sal,

'$fec1','$fec2',$sem
)
on duplicate key update ent=values(ent),sal=values(sal),imp_sal=values(imp_sal)";
$this->db->query($s);
//////////////////////////////////////////////////////////////// 3 metroo
$s="insert into oficinas.sem_ent_sal (suc, ent, sal,imp_sal, fec1, fec2, sem)
(
select 3,
sum(ifnull((select sum(can) from metro.compra_c x
left join metro.compra_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
),0)
+
ifnull((select sum(cans) from metro.traspaso_c x
left join metro.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.entra=100
),0)
+
ifnull((select sum(cans) from metro.devolucion_c x
left join metro.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.entra=100 and concepto<=2
),0))as entrada,

sum(ifnull((select sum(cans) from metro.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'),0)
+
ifnull((select sum(cans) from metro.traspaso_c x
left join metro.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=100
),0)
+
ifnull((select sum(cans) from metro.devolucion_c x
left join metro.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=100
),0))as salida,

sum(ifnull((select sum(cans*costo) from metro.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'),0)
+
ifnull((select sum(cans*costo) from metro.traspaso_c x
left join metro.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=100
),0)
+
ifnull((select sum(cans*costo) from metro.devolucion_c x
left join metro.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=100
),0))as imp_sal,

'$fec1','$fec2',$sem


)
on duplicate key update ent=values(ent),sal=values(sal)";
$this->db->query($s);
//////////////////////////////////////////////////////////////// agrupa 100

$sa="INSERT INTO oficinas.sem_ent_sal (suc, ent, sal, fec1, fec2, sem,imp_sal)
(SELECT 100, sum(ent), sum(sal), fec1, fec2, sem, sum(imp_sal) FROM oficinas.sem_ent_sal 
where suc<100 and fec1='$fec1' and fec2='$fec2' group by sem,fec1)
on duplicate key update sal=values(sal),ent=values(ent),imp_sal=values(imp_sal)";
$this->db->query($sa); 

//////////////////////////////////////////////////////////////// entradas y salidas farmabodega
$s="insert into oficinas.sem_ent_sal (suc, ent, sal, imp_sal, fec1, fec2, sem)
(
select 1600,
sum(ifnull((select sum(can) from farmabodega.compra_c x
left join farmabodega.compra_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
),0)
+
ifnull((select sum(cans) from farmabodega.traspaso_c x
left join farmabodega.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.entra=1600
),0)
+
ifnull((select sum(cans) from farmabodega.devolucion_c x
left join farmabodega.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.entra=1600 and concepto<=2
),0))as entrada,

sum(ifnull((select sum(cans) from farmabodega.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'),0)
+
ifnull((select sum(cans) from farmabodega.traspaso_c x
left join farmabodega.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=1600
),0)
+
ifnull((select sum(cans) from farmabodega.devolucion_c x
left join farmabodega.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=1600
),0))as salida,
sum(ifnull((select sum(cans*costo) from farmabodega.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'),0)
+
ifnull((select sum(cans*costo) from farmabodega.traspaso_c x
left join farmabodega.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=1600
),0)
+
ifnull((select sum(cans*costo) from farmabodega.devolucion_c x
left join farmabodega.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=1600
),0))as imp_sal,
'$fec1','$fec2',$sem


)
on duplicate key update ent=values(ent),sal=values(sal),imp_sal=values(imp_sal)";
$this->db->query($s);
//////////////////////////////////////////////////////////////// entradas y salidas segpop 90002
$s="insert into oficinas.sem_ent_sal (suc, ent, sal, fec1, fec2, sem)
(
select 90002,

sum(ifnull((select sum(can) from segpop.compra_c x
left join segpop.compra_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
group by b.clave),0)
+
ifnull((select sum(cans) from segpop.traspaso_c x
left join segpop.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.entra=90002  and b.activo=1
group by b.clave),0)
+
ifnull((select sum(cans) from segpop.devolucion_c x
left join segpop.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.entra=90002 and concepto<=2 and b.activo=1
group by b.clave),0))as entrada,

sum(ifnull((select sum(cans) from segpop.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and x.clave=a.clave),0)
+
ifnull((select sum(cans) from segpop.traspaso_c x
left join segpop.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.sale=90002  and b.activo=1
group by b.clave),0)
+
ifnull((select sum(cans) from segpop.devolucion_c x
left join segpop.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.sale=90002  and b.activo=1
group by b.clave),0))as salida,
'$fec1','$fec2',$sem
from catalogo.costos_gobierno a


)
on duplicate key update ent=values(ent),sal=values(sal)";
$this->db->query($s);
//////////////////////////////////////////////////////////////// entradas y salidas trasimeno 140 6050
$s="insert into oficinas.sem_ent_sal (suc, ent, sal, fec1, fec2, sem)
(
select 6050,

sum(ifnull((select sum(can) from trasimeno140.compra_c x
left join trasimeno140.compra_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
group by b.clave),0)
+
ifnull((select sum(cans) from trasimeno140.traspaso_c x
left join trasimeno140.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.entra=6050  and b.activo=1
group by b.clave),0)
+
ifnull((select sum(cans) from trasimeno140.devolucion_c x
left join trasimeno140.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.entra=6050 and concepto<=2 and b.activo=1
group by b.clave),0))as entrada,

sum(ifnull((select sum(cans) from trasimeno140.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and x.clave=a.clave),0)
+
ifnull((select sum(cans) from trasimeno140.traspaso_c x
left join trasimeno140.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.sale=6050  and b.activo=1
group by b.clave),0)
+
ifnull((select sum(cans) from trasimeno140.devolucion_c x
left join trasimeno140.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.sale=6050  and b.activo=1
group by b.clave),0))as salida,
'$fec1','$fec2',$sem
from catalogo.costos_gobierno a
)
on duplicate key update ent=values(ent),sal=values(sal)";
$this->db->query($s);

//////////////////////////////////////7////////////////////////////////////////////////////////salidas aguascalientes
$s="insert into oficinas.sem_ent_sal (suc, ent, sal, fec1, fec2, sem)
(
SELECT 14000,sum(nueva -vieja),0,'$fec1','$fec2',$sem
FROM fenixsp.kardex k
INNER JOIN fenixsp.productos p on k.p_id = p.id
where modiicada between '$fec1 00:00:00' and '$fec2 23:59:59'
and (tipo <> 3 and subtipo <> 300) and tipo = 1
)
on duplicate key update ent=values(ent)";
$this->db->query($s);
//////////////////////////////////////7////////////////////////////////////////////////////////entradas aguascalientes
$s="insert into oficinas.sem_ent_sal (suc, ent, sal, fec1, fec2, sem)
(
SELECT 14000, 0,sum(vieja - nueva) as piezas,'$fec1','$fec2',$sem
FROM fenixsp.kardex k
INNER JOIN fenixsp.productos p on k.p_id = p.id
where modiicada between '$fec1 00:00:00' and '$fec2 23:59:59'
and (tipo <> 3 and subtipo <> 300) and tipo = 2
)
on duplicate key update sal=values(sal)";
$this->db->query($s);

  
}

public function desplazamientos()
{
$s="load data infile 'c:/wamp/www/subir10/seg.prn'
replace into table vtadc.venta_segpop FIELDS TERMINATED BY '||'
LINES TERMINATED BY '\r\n' (aaa, mes,suc,clave,codigo, @descri, piezas,importe)
set descri = CONVERT(CAST(@descri as BINARY) USING LATIN1),
piezas=(piezas),importe=(importe),
su_fenix=case
 when suc=20000 then 187
 when suc=19020 then 179
 when suc=19021 then 176
 when suc=19022 then 180
else
suc
end"; 
$this->db->query($s); 


}

public function elimina_suc($sucx)
{
$s="delete from desarrollo.inv where suc=$sucx"; 


$this->db->query($s); 
//echo $this->db->last_query();
//echo die;

}

public function sube_suc()
{
$s="load data infile 'c:/wamp/www/subir10/inventarios.prn'
replace into table desarrollo.inv FIELDS TERMINATED BY '||'
LINES TERMINATED BY '\r\n' (suc, codigo, cantidad, fechai, cia)
set tsuc='F', mov=3, sec=0"; 

$this->db->query($s); 
//echo $this->db->last_query();
//echo die;

}





}
