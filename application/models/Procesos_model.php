<?php
class Procesos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 
public function facturas_oficinas()
{
$fec=date('Y-m-d')-31;
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
where a.fechasur>='$fec' and a.tid='C' and b.sur>0 group by a.id)
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
where a.fechasur>='$fec' and a.tid='C' and b.sur>0 group by a.id)
on duplicate key update fecha_prv=values(fecha_prv),importe_prv=values(importe_prv),
importe_prvcosto=values(importe_prvcosto),cia=values(cia)"; 
$this->db->query($s1);    

$s2="load data infile 'c:/wamp/www/subir10/factu.txt' replace into table vtadc.gc_compra_mayorista FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
$this->db->query($s2);
$s3="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv,importe_prvcosto,cia)
(select a.suc,factura,importe,0,fecha,'0000-00-00',date_format(fecha,'%Y'),date_format(fecha,'%m'),prv,importe, b.cia
from vtadc.gc_compra_mayorista a
left join catalogo.sucursal b on b.suc=a.suc
where fecha>='$fec')
on duplicate key update importe_prv=values(importe_prv),fecha_prv=values(fecha_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($s3);

}
public function facturas_pdv()
{
$s="update vtadc.gc_factura a,vtadc.gc_compra_det_suc_fac b set importe_suc=b.importe, fecha_suc=fecha   
where   a.suc=b.suc and a.factura=b.factura and  
a.suc=b.suc and a.factura=b.factura"; 
$this->db->query($s); 

$s1="select *from vtadc.gc_factura where aaa=year(now()) and mes>=9";
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
set b.final=round((venta7+venta8+venta9)/case when
venta7=0 and venta8=0 and venta9>0 or
venta7=0 and venta8>0 and venta9=0 or
venta7>0 and venta8=0 and venta9=0
then 1
when
venta7=0 and venta8>0 and venta9>0 or
venta7>0 and venta8>0 and venta9=0 or
venta7>0 and venta8=0 and venta9>0
then 2
when
venta7>0 and venta8>0 and venta9>0
then 3
end)

  where a.suc=b.suc and a.sec=b.sec and (venta7+venta8+venta8)>0";
$this->db->query($s);
$s="update vtadc.producto_mes_suc_gen a, almacen.max_sucursal b
set b.final=venta9
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

$s="insert ignore into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(SELECT $aaa,$mes, a.cia,a.suc,a.sec,' ',a.codigo,' ',a.cantidad,
0,0,'FARMACIA',$dia
FROM desarrollo.inv a
where a.mov=03 and a.cantidad>0)";
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

$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,13,900,aa.sec,' ',aa.codigo,bb.susa1,sum(inv1),aa.costo,bb.lin,'ALM CEDIS',$dia
from desarrollo.inv_cedis aa left join catalogo.sec_generica bb on bb.sec=aa.sec where aa.inv1>0 group by aa.sec)
";
$this->db->query($s);

$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,1,100,0,aa.clave,aa.codigo,aa.descri,sum(cantidad),aa.costo,1,'ALM ESPECIALIDAD',$dia
from especialidad.inventario_d aa where aa.cantidad>0 group by aa.clave)";
$this->db->query($s);

$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,1,100,0,aa.clave,aa.codigo,ifnull((select susa1 from catalogo.almacen bb where bb.sec=aa.clave group by bb.sec),''),sum(cantidad),aa.costo,1,'ALM METRO',$dia
from metro.inventario_d aa left join catalogo.almacen bb on bb.sec=aa.clave where aa.cantidad>0 group by aa.clave)";
$this->db->query($s);

$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,13,1600 ,aa.clave,' ',aa.codigo,bb.susa1,sum(cantidad),aa.costo,bb.lin,'ALM FARMABODEGA',$dia
from farmabodega.inventario_d aa left join catalogo.almacen bb on bb.clabo=aa.clave where aa.cantidad>0 group by aa.clave)
";
$this->db->query($s);
  
$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,1,100,0,aa.clave,ifnull(codigo,0),bb.susa1,sum(invf),aa.costo,bb.lin,'ALM CONTROLADOS',$dia
from almacen.control_invd aa left join catalogo.segpop bb on bb.claves=aa.clave where aa.invf>0 and lin is not null group by aa.clave)";
$this->db->query($s);

//////////////seguros populares
$s = "update  oficinas.inv_seguros a set piezas_paquete=piezas, clave_sin_punto=clave where  a.aaa=$aaa and a.mes=$mes";
$q = $this->db->query($s);
 
$s = "update  oficinas.inv_seguros a,oficinas.convertir_claves b
set clave_sin_punto=b.clave
where a.clave=b.clave_punto and a.aaa=$aaa and a.mes=$mes";
$q = $this->db->query($s);

$s = "update oficinas.inv_seguros a, catalogo.costos_gobierno b
set a.costo=b.costo,piezas_paquete= case when paquete>0 then paquete else a.piezas end
where a.clave_sin_punto=b.clave and  a.aaa=$aaa and a.mes=$mes";
$q = $this->db->query($s);

$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo,dia)
(select aaa, mes, 1, suc,0, clave_sin_punto,0, substr(descripcion,1,70), piezas_paquete, costo, lin, 'ALM SEGPOP',$dia 
from oficinas.inv_seguros a where a.aaa=$aaa and a.mes=$mes and suc in(17000,14000,16000,6050,90002))";
$this->db->query($s);
 
$s="insert into oficinas.inv_mes_suc(aaa, mes, cia, suc, piezas, importe,dia)
(select aaa,mes,cia,suc,sum(piezas),sum(piezas*costo),dia from oficinas.inv_mes_suc_det where  aaa=$aaa and mes=$mes group by aaa,mes,suc)";
$this->db->query($s);

$s="insert into desarrollo.inv_cosvta(cia, suc, sem, aaaa, mes, lin, plaza, succ, importe)
(select a.cia,a.suc,$sem,aaa,mes,lin,b.plaza,b.suc_contable,
case when a.suc=900
then (select sum(piezas*costo) from oficinas.inv_mes_suc_det c
where c.suc in(900,1600,6050,90002) and c.lin=a.lin and c.aaa=$aaa and c.mes=$mes and c.dia=$dia)
when a.suc in(1600,6050,90002) then 0 else sum(piezas*costo) end

from oficinas.inv_mes_suc_det a
left join catalogo.sucursal b on b.suc=a.suc
where a.costo>0 and a.aaa=$aaa and a.mes=$mes and a.dia=$dia
group by a.aaa,a.mes,a.dia,a.suc,a.lin
)";
$this->db->query($s);

}


public function respalda_inv()
{
$s="insert into oficinas.inv_mes_suc_det_his (aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo, dia)
(select aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo, dia from  oficinas.inv_mes_suc_det)";
$this->db->query($s);
$s1="insert into oficinas.inv_mes_suc_his(aaa, mes, cia, suc, piezas, importe, dia)
(select aaa, mes, cia, suc, piezas, importe, dia from oficinas.inv_mes_suc)";
$this->db->query($s1);    
}




}
