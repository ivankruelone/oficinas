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
then sum(sur*(costo*1.10))
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
then sum(sur*(costo*1.10))
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
$s1="select *from vtadc.gc_factura where aaa=2013 and mes>=10";
$q1=$this->db->query($s1);
 foreach ($q1->result() as $r1) {
$s="update vtadc.gc_factura a,vtadc.gc_compra_det b set importe_suc=imp_fac,fecha_suc=fecha   
where   a.suc=b.suc and a.factura=b.factura and date_format(fecha,'%Y')=b.aaa and a.mes=b.mes and  
date_format(fecha,'%Y')=$r1->aaa and  date_format(fecha,'%m')=$r1->mes and b.suc=$r1->suc and b.factura='$r1->factura'"; 
$this->db->query($s); 
$ss="update vtadc.gc_factura a,vtadc.gc_compra_det_back b set importe_suc=importe,fecha_suc=fecha   
where   a.suc=b.suc and a.factura=b.factura  and  
date_format(fecha,'%Y')=$r1->aaa and  date_format(fecha,'%m')=$r1->mes and b.suc=$r1->suc and b.factura='$r1->factura'"; 
$this->db->query($ss); 
}
$s3="insert into vtadc.gc_factura_suc(aaa, mes, suc, importe_prvo, importe_suco, importe_prvs, importe_sucs,importe_prvocosto,cia)
(SELECT aaa,mes,suc,0,0, sum(importe_prv), sum(importe_suc),0,cia FROM vtadc.gc_factura  where importe_prv=0 group by aaa,mes,suc)
on duplicate key update importe_prvs=values(importe_prvs),importe_sucs=values(importe_sucs);";
$this->db->query($s3);
$s4="insert into vtadc.gc_factura_suc(aaa, mes, suc, importe_prvo, importe_suco, importe_prvs, importe_sucs,importe_prvocosto,cia)
(SELECT aaa,mes,suc, sum(importe_prv), sum(importe_suc),0,0 ,sum(importe_prvcosto),cia FROM vtadc.gc_factura  where importe_prv>0 group by aaa,mes,suc)
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
$s="update vtadc.producto_mes_suc_gen a, almacen.max_sucursal b
set a.final=b.final where a.suc=b.suc and a.sec=b.sec ";
$this->db->query($s);
$s="";
$this->db->query($s);
    }    

 
 
 
 
    
    public function inventarios()
    {
/////////farmabodega
$s = "insert into oficinas.inv_mes_suc(aaa, mes, cia, suc, piezas, importe)
(SELECT year(now()),month(now()),13,1600,sum(cantidad),sum(cantidad*costo) FROM farmabodega.inventario_d where cantidad>0)";
 $q = $this->db->query($s);
 /////////especialidad
$s = "insert ignore into oficinas.inv_mes_suc(aaa, mes, cia, suc, piezas, importe)
(SELECT year(now()),month(now()),1,90030,sum(cantidad),sum(cantidad*costo) FROM especialidad.inventario_d where cantidad>0)";
 $q = $this->db->query($s);
 /////////almacencedis
$s = "insert ignore into oficinas.inv_mes_suc(aaa, mes, cia, suc, piezas, importe)
(SELECT year(now()),month(now()),13,900,sum(inv1),sum(inv1*costo) FROM desarrollo.inv_cedis where inv1>0)";
 $q = $this->db->query($s);
 
  /////////controlados
 $s = "update almacen.control_invd a,catalogo.segpop b
set a.costo=b.costo
where a.clave=b.claves and b.costo>10 and b.costo>0";
 $q = $this->db->query($s);

 $s = "insert ignore into oficinas.inv_mes_suc(aaa, mes, cia, suc, piezas, importe)
(SELECT year(now()),month(now()),1,100,sum(invf),sum(invf*costo) FROM almacen.control_invd where invf>0)";
 $q = $this->db->query($s);
       
/////////metro
 $s = "update inventario_d a, compra_d b
set a.costo=b.costo
where a.clave=b.clave";
 $q = $this->db->query($s);

 $s = "insert ignore into oficinas.inv_mes_suc(aaa, mes, cia, suc, piezas, importe)
(SELECT year(now()),month(now()),1,100,sum(invf),sum(invf*costo) FROM almacen.control_invd where invf>0)";
 $q = $this->db->query($s);    
    
    
    }


}
