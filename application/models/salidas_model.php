<?php
class Salidas_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

       
    public function salidas_esp()
    {
        
        $s = "SELECT 1 as uno,'PEDIDOS ESPECIALES'as var,month(a.fechasur)as mes,c.mes as mesx,sum(sur)as piezas,sum(costo*sur)as imp
FROM catalogo.folio_pedidos_cedis_especial a

join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=month(a.fechasur)
join desarrollo.pedidos d on d.fol=a.id
where
year(a.fechasur)=year(date(now())) and b.tipo3 in('MO','FA') and tid='C' or
year(a.fechasur)=year(date(now()))and a.suc<=100 and a.suc>0
group by month(fechasur)

union all

select 2 as uno,'TRASPASOS'as var,month(a.fechai)as mes,s.mes as mesx,sum(can)as piezas , sum(can*costo)as imp
from desarrollo.traspaso_c a
join desarrollo.traspaso_d x on x.id_cc=a.id
join catalogo.mes s on s.num=month(a.fechai)
where  year(a.fechai)=year(date(now()))
and a.tipo2='C' and a.tipo='S' and a.suc<>100
group by year(a.fechai),month(a.fechai)";
        $q = $this->db->query($s);
        return $q;
    }
 public function salidas_esp_cli($mes,$uno)
  {
if($uno==1){
    $mylton ="select a.suc, a.fechasur, b.nombre, sum(c.sur) as piezas,
sum(c.sur * c.costo) as importe
from catalogo.folio_pedidos_cedis_especial a
join catalogo.sucursal b on b.suc=a.suc
join desarrollo.pedidos c on c.fol=a.id
where
year(a.fechasur) = year(date(now())) and month(a.fechasur)= $mes and b.tipo3 in ('MO','FA') and a.tid = 'C' or
year(a.fechasur) = year(date(now())) and month(a.fechasur)= $mes and a.suc > 0 and a.suc <= 100
group by a.suc";
$luna = $this->db->query($mylton);
}else{
    $mylton ="select a.suc,a.fechai as fechasur,t.nombre,sum(can)as piezas , sum(can*costo)as importe
from desarrollo.traspaso_c a
join desarrollo.traspaso_d x on x.id_cc=a.id
join catalogo.sucursal t on t.suc=a.suc
where  year(a.fechai)=year(date(now()))
and a.tipo2='C' and a.tipo='S' and a.suc<>100 and month(a.fechai)=$mes
group by year(a.fechai),month(a.fechai),a.suc";
$luna = $this->db->query($mylton);
    
}

return $luna;
    
 }
 public function salidas_esp_cli_fol($mes,$uno,$suc)
  {
if($uno==1){
    $mylton ="select a.suc, a.id, a.fechasur, b.nombre, sum(c.sur) as piezas,
sum(c.sur * c.costo) as importe
from catalogo.folio_pedidos_cedis_especial a
join catalogo.sucursal b on b.suc=a.suc
join desarrollo.pedidos c on c.fol=a.id
where
year(a.fechasur) = year(date(now())) and month(a.fechasur)= $mes and b.tipo3 in ('MO','FA') and a.tid = 'C' and a.suc = $suc or
year(a.fechasur) = year(date(now())) and month(a.fechasur)= $mes and a.suc > 0 and a.suc <= 100 and a.suc = $suc
group by a.suc, a.id";
$luna = $this->db->query($mylton);
}else{
    $mylton ="select a.suc,a.fechai as fechasur,t.nombre,a.id,sum(can)as piezas , sum(can*costo)as importe
from desarrollo.traspaso_c a
join desarrollo.traspaso_d x on x.id_cc=a.id
join catalogo.sucursal t on t.suc=a.suc
where  year(a.fechai)=year(date(now()))
and a.tipo2='C' and a.tipo='S' and a.suc<>100 and month(a.fechai)=$mes and a.suc=$suc
group by year(a.fechai),month(a.fechai),a.suc,a.id";
$luna = $this->db->query($mylton);
}
return $luna; 
}

public function salidas_esp_cli_sec($mes,$uno,$suc)
  {
if($uno==1){
    $mylton ="select c.sec,c.susa,sum(c.sur) as piezas,
sum(c.sur * c.costo) as importe
from catalogo.folio_pedidos_cedis_especial a
join catalogo.sucursal b on b.suc=a.suc
join desarrollo.pedidos c on c.fol=a.id
where
year(a.fechasur) = year(date(now())) and month(a.fechasur)= $mes and b.tipo3 in ('MO','FA') and a.tid = 'C' and a.suc = $suc or
year(a.fechasur) = year(date(now())) and month(a.fechasur)= $mes and a.suc > 0 and a.suc <= 100 and a.suc = $suc
group by a.suc, c.sec";
$luna = $this->db->query($mylton);
}else{
    $mylton ="select x.sec,u.susa,sum(can)as piezas , sum(can*costo)as importe
from desarrollo.traspaso_c a
join desarrollo.traspaso_d x on x.id_cc=a.id
join catalogo.sucursal t on t.suc=a.suc
join catalogo.cat_almacen_clasifica u on u.sec=x.sec
where  year(a.fechai)=year(date(now()))
and a.tipo2='C' and a.tipo='S' and a.suc<>100 and month(a.fechai)=$mes and a.suc=$suc
group by year(a.fechai),month(a.fechai),a.suc,x.sec";
$luna = $this->db->query($mylton);
}

return $luna; 

}

function salidas_segpop()
{
    $s = "select clvsucursal, clvsucursalx, aaa, mes, mesx, clvsucursalReferencia, clvsucursalReferenciax,sum(embarque)as embarque,sum(importe)as importe
from
(SELECT clvsucursal,f.nombre as clvsucursalx,year(a.fechaCierre)as aaa,month(a.fechaCierre)as mes,c.mes as mesx,clvsucursalReferencia,e.nombre as clvsucursalReferenciax,sum(piezas)as embarque,sum(piezas*costo)as importe
FROM spcentral.movimiento a
join spcentral.movimiento_detalle b on b.movimientoID=a.movimientoID
join catalogo.mes c on c.num=month(a.fechaCierre)
join catalogo.cat_compras_segpop d on d.suc=a.clvsucursalReferencia
join catalogo.sucursal e on e.suc=a.clvsucursalReferencia
join catalogo.sucursal f on f.suc=a.clvsucursal
where a.tipoMovimiento=2 and year(a.fechaCierre)>=2016
group by year(a.fechaCierre), month(a.fechaCierre),clvsucursalReferencia
union all
SELECT clvsucursal,concat(f.nombre,' ','CONTROLADOS') as clvsucursalx,year(a.fechaCierre)as aaa,month(a.fechaCierre)as mes,c.mes as mesx,clvsucursalReferencia,e.nombre as clvsucursalReferenciax,sum(piezas)as embarque,sum(piezas*costo)as importe
FROM controlado.movimiento a
join controlado.movimiento_detalle b on b.movimientoID=a.movimientoID
join catalogo.mes c on c.num=month(a.fechaCierre)
join catalogo.cat_compras_segpop d on d.suc=a.clvsucursalReferencia
join catalogo.sucursal e on e.suc=a.clvsucursalReferencia
join catalogo.sucursal f on f.suc=a.clvsucursal
where a.tipoMovimiento=2 and year(a.fechaCierre)>=2016
group by year(a.fechaCierre), month(a.fechaCierre),clvsucursalReferencia)
t
group by  aaa, mes,clvsucursalReferencia
";
    $q = $this->db->query($s);
    return $q;
}
function salidas_segpop_pro($aaa,$mes,$suc)
{
    $s = "select id, cvearticulo, susa, descripcion, pres, sum(piezas)as piezas, sum(importe)as importe
from
(SELECT b.id,cvearticulo,susa, descripcion, pres, sum(piezas)as piezas, sum(piezas*costo)as importe
FROM spcentral.movimiento a
join spcentral.movimiento_detalle b on b.movimientoID=a.movimientoID
join spcentral.articulos c on c.id=b.id
where a.tipoMovimiento=2 and year(a.fechaCierre)=$aaa and month(a.fechaCierre)=$mes and a.clvsucursalReferencia=$suc
group by year(a.fechaCierre), month(a.fechaCierre),b.id
union all
SELECT b.id,cvearticulo,susa, descripcion, pres, sum(piezas)as piezas, sum(piezas*costo)as importe
FROM controlado.movimiento a
join controlado.movimiento_detalle b on b.movimientoID=a.movimientoID
join controlado.articulos c on c.id=b.id
where a.tipoMovimiento=2 and year(a.fechaCierre)=$aaa and month(a.fechaCierre)=$mes and a.clvsucursalReferencia=$suc
group by year(a.fechaCierre), month(a.fechaCierre),b.id
)t
group by id";
    $q = $this->db->query($s);
    return $q;
}




















}
