<?php
class ofertas_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


function cap_ofe_lab()
{
$ee="SELECT a.*,b.descripcion,labprv,farmacia,fin_marzam,fin_fanasa,pub,
pub-(pub*(ofe_far/100))as venta,
case when farmacia>0 then (case when fin_marzam>0 and farmacia>0  then farmacia-(farmacia*(fin_marzam/100)) else farmacia end)-((case when fin_marzam>0 and farmacia>0  then farmacia-(farmacia*(fin_marzam/100)) else farmacia end)*(ofe_lab/100))else 0 end as cos_marzam,
case when farmacia>0 then (case when fin_fanasa>0 and farmacia>0  then farmacia-(farmacia*(fin_fanasa/100)) else farmacia end)-((case when fin_fanasa>0 and farmacia>0  then farmacia-(farmacia*(fin_fanasa/100)) else farmacia end)*(ofe_lab/100))else 0 end as cos_fanasa,

case when farmacia>0 then
round((100-(100*(((case when fin_marzam>0 and farmacia>0  then farmacia-(farmacia*(fin_marzam/100)) else farmacia end)-((case when fin_marzam>0 and farmacia>0  then farmacia-(farmacia*(fin_marzam/100)) else farmacia end)*(ofe_lab/100)))/
(pub-(pub*(ofe_far/100)))))),2) else 0 end as util_marzam,

case when farmacia>0 then
round((100-(100*(((case when fin_fanasa>0 and farmacia>0  then farmacia-(farmacia*(fin_fanasa/100)) else farmacia end)-((case when fin_fanasa>0 and farmacia>0  then farmacia-(farmacia*(fin_fanasa/100)) else farmacia end)*(ofe_lab/100)))/
(pub-(pub*(ofe_far/100)))))),2) else 0 end as util_fanasa


FROM compras.ofertas_lab_far a
left join catalogo.cat_mercadotecnia b on b.codigo=a.codigo
where activo=1 order by id desc";
$q=$this->db->query($ee);
return $q;
}
function graba_producto_ofe($codigo,$fec1,$fec2,$ofe_lab,$ofe_far)
{
if($codigo>0){
$ee="insert  into compras.ofertas_lab_far(codigo,fecha1, fecha2,ofe_lab, ofe_far,fecha_act)values(?,?,?,?,?,CURRENT_TIMESTAMP()) 
on duplicate key update fecha2='$fec2',ofe_lab='$ofe_lab', ofe_far='$ofe_far',fecha_act=CURRENT_TIMESTAMP()";
$q=$this->db->query($ee,array($codigo,$fec1,$fec2,$ofe_lab,$ofe_far));
}}
function borra_producto_ofe($id)
{
$ee="update compras.ofertas_lab_far set activo=4 where  id = ? ";
$q=$this->db->query($ee,array($id));
}
function val_producto_ofe($id)
{
$ee="update compras.ofertas_lab_far set activo=2 where  id = ? ";
$q=$this->db->query($ee,array($id));
}
function ofe_val()
{
$ee="SELECT a.*,b.descripcion,labprv,farmacia,fin_marzam,fin_fanasa,pub,
pub-(pub*(ofe_far/100))as venta,
case when farmacia>0 then (case when fin_marzam>0 and farmacia>0  then farmacia-(farmacia*(fin_marzam/100)) else farmacia end)-((case when fin_marzam>0 and farmacia>0  then farmacia-(farmacia*(fin_marzam/100)) else farmacia end)*(ofe_lab/100))else 0 end as cos_marzam,
case when farmacia>0 then (case when fin_fanasa>0 and farmacia>0  then farmacia-(farmacia*(fin_fanasa/100)) else farmacia end)-((case when fin_fanasa>0 and farmacia>0  then farmacia-(farmacia*(fin_fanasa/100)) else farmacia end)*(ofe_lab/100))else 0 end as cos_fanasa,

case when farmacia>0 then
round((100-(100*(((case when fin_marzam>0 and farmacia>0  then farmacia-(farmacia*(fin_marzam/100)) else farmacia end)-((case when fin_marzam>0 and farmacia>0  then farmacia-(farmacia*(fin_marzam/100)) else farmacia end)*(ofe_lab/100)))/
(pub-(pub*(ofe_far/100)))))),2) else 0 end as util_marzam,

case when farmacia>0 then
round((100-(100*(((case when fin_fanasa>0 and farmacia>0  then farmacia-(farmacia*(fin_fanasa/100)) else farmacia end)-((case when fin_fanasa>0 and farmacia>0  then farmacia-(farmacia*(fin_fanasa/100)) else farmacia end)*(ofe_lab/100)))/
(pub-(pub*(ofe_far/100)))))),2) else 0 end as util_fanasa


FROM compras.ofertas_lab_far a
left join catalogo.cat_mercadotecnia b on b.codigo=a.codigo
where activo=2 order by id desc";
$q=$this->db->query($ee);
return $q;
}

function ofertas_periodo()
{
$ee="SELECT aa.fecha1,aa.fecha2,x.labprv,x.lab,xx.labor,count(aa.codigo)as productos,

(SELECT
sum(can-devuelta)
FROM compras.ofertas_lab_far a,catalogo.cat_mercadotecnia b,compras.pre_factura_fenix c
where a.codigo=b.codigo and a.codigo=c.cod and
 c.fecha between fecha1 and fecha2 and a.activo<>4 and b.lab=x.lab and prv=500 and c.ofe_lab>0
)as compra,

(SELECT
sum((((c.far*c.can)-((c.far*c.can)*fin)))-(((c.far*c.can)-((c.far*c.can)*fin))-((((c.far*c.can)-((c.far*c.can)*fin)))*c.ofe_lab)))
FROM compras.ofertas_lab_far a,catalogo.cat_mercadotecnia b,compras.pre_factura_fenix c
where a.codigo=b.codigo and a.codigo=c.cod and
 c.fecha between fecha1 and fecha2 and a.activo<>4 and b.lab=x.lab and prv=500 and c.ofe_lab>0
)as n500,
(SELECT
sum((((c.far*c.can)-((c.far*c.can)*fin)))-(((c.far*c.can)-((c.far*c.can)*fin))-((((c.far*c.can)-((c.far*c.can)*fin)))*c.ofe_lab)))
FROM compras.ofertas_lab_far a,catalogo.cat_mercadotecnia b,compras.pre_factura_fenix c
where a.codigo=b.codigo and a.codigo=c.cod and
 c.fecha between fecha1 and fecha2 and a.activo<>4 and b.lab=x.lab and prv=825 and c.ofe_lab>0
)as n825


FROM compras.ofertas_lab_far aa
left join catalogo.cat_mercadotecnia x on x.codigo=aa.codigo
left join catalogo.laboratorios xx on xx.num=x.lab
where  aa.activo<>4
group by fecha1,fecha2,x.lab";
$q=$this->db->query($ee);
return $q;
}
function ofertas_periodo_det($inicio,$final,$lab,$prv)
{
$ee="SELECT c.fecha,m.suc,d.nombre,c.fac,c.cod,b.descripcion,c.can,c.far,c.fin,c.ofe_lab,
round(((c.can*c.far)-c.descuento),2)as imp_factura,
round(((c.can*c.far)-(c.can*c.far)*c.fin)-(((c.can*c.far)-(c.can*c.far)*c.fin)*c.ofe_lab),2)as imp_con_ofe,
round(((c.can*c.far)-c.descuento)-(((c.can*c.far)-(c.can*c.far)*c.fin)-(((c.can*c.far)-(c.can*c.far)*c.fin)*c.ofe_lab)),2)as nota

FROM
compras.ofertas_lab_far a,catalogo.cat_mercadotecnia b,compras.pre_factura_fenix c
left join compras.pre_factura_fenix_ctl m on m.fac=c.fac and m.fecha=c.fecha and m.prv=c.prv 
left join catalogo.sucursal d on m.suc=d.suc
where a.codigo=b.codigo and a.codigo=c.cod and c.fecha between '$inicio' and '$final' and a.activo<>4
 and b.lab=$lab and c.prv=$prv and c.ofe_lab>0
";
$q=$this->db->query($ee);
return $q;
}
function ofertas_periodo_det_ven($inicio,$final)
{
$ee="SELECT a.*,
ifnull(venta1,0)venta1,
ifnull(venta2,0)venta2,
ifnull(venta3,0)venta3,
ifnull(venta4,0)venta4,
ifnull(venta5,0)venta5,
ifnull(venta6,0)venta6,
ifnull(venta7,0)venta7,
ifnull(venta8,0)venta8,
ifnull(venta9,0)venta9,
ifnull(venta10,0)venta10,
ifnull(venta11,0)venta11,
ifnull(venta12,0)venta12
FROM compras.ofertas_lab_far a a
left join vtadc.producto_mes b on b.codigo=a.codigo and b.aaa between year(fecha1) and year(fecha2)
where a.fecha1='$inicio' and a.fecha2='$final'  and activo=1
group by codigo";
$q=$this->db->query($ee);
return $q;
}

function busca_id_ofe($id)
{
$ee="SELECT a.*,b.descripcion,labprv,farmacia,fin_marzam,fin_fanasa,pub,
pub-(pub*(ofe_far/100))as venta,
case when farmacia>0 then (case when fin_marzam>0 and farmacia>0  then farmacia-(farmacia*(fin_marzam/100)) else farmacia end)-((case when fin_marzam>0 and farmacia>0  then farmacia-(farmacia*(fin_marzam/100)) else farmacia end)*(ofe_lab/100))else 0 end as cos_marzam,
case when farmacia>0 then (case when fin_fanasa>0 and farmacia>0  then farmacia-(farmacia*(fin_fanasa/100)) else farmacia end)-((case when fin_fanasa>0 and farmacia>0  then farmacia-(farmacia*(fin_fanasa/100)) else farmacia end)*(ofe_lab/100))else 0 end as cos_fanasa,

case when farmacia>0 then
round((100-(100*(((case when fin_marzam>0 and farmacia>0  then farmacia-(farmacia*(fin_marzam/100)) else farmacia end)-((case when fin_marzam>0 and farmacia>0  then farmacia-(farmacia*(fin_marzam/100)) else farmacia end)*(ofe_lab/100)))/
(pub-(pub*(ofe_far/100)))))),2) else 0 end as util_marzam,

case when farmacia>0 then
round((100-(100*(((case when fin_fanasa>0 and farmacia>0  then farmacia-(farmacia*(fin_fanasa/100)) else farmacia end)-((case when fin_fanasa>0 and farmacia>0  then farmacia-(farmacia*(fin_fanasa/100)) else farmacia end)*(ofe_lab/100)))/
(pub-(pub*(ofe_far/100)))))),2) else 0 end as util_fanasa


FROM compras.ofertas_lab_far a
left join catalogo.cat_mercadotecnia b on b.codigo=a.codigo
where activo=1 and a.id=$id order by id desc";
$q=$this->db->query($ee);
return $q;
}

function ofertas_corta_caducidad()
{
$ee="SELECT a.id,a.suc,b.nombre as sucx,fecha_suc FROM compras.corta_caducidad_ctl a
join catalogo.sucursal b on b.suc=a.suc
where fecha_suc>'0000-00-00' and fecha_compra='0000-00-00' and a.activo=1
";
$q=$this->db->query($ee);
return $q;
}


function ofertas_corta_caducidad_det($id_cc)
{
$q='';
$ee="SELECT a.id,a.codigo,cadu,
case when sistema=1 then descripcion1 else descripcion2 end as descripcion,
case when sistema=1 then cos1 else cos2 end as costo_pdv,
case when sistema=1 then pub1 else pub2 end as pub_pdv,
c.cos as costo_catalogo,
cantidad
FROM compras.corta_caducidad_det a
join catalogo.cod_rel b on b.ean=a.codigo
join catalogo.cat_mercadotecnia c on c.codigo=a.codigo 
where a.fecha_compra='0000-00-00 00:00:00' and id_cc=$id_cc and a.activo=1
order by costo_catalogo, costo_pdv";
$q=$this->db->query($ee);
return $q;
}
function ofertas_corta_caducidad_det_cos($id)
{
$ee="SELECT a.id,a.codigo,cadu,
case when sistema=1 then descripcion1 else descripcion2 end as descripcion,
case when sistema=1 then cos1 else cos2 end as costo_pdv,
case when sistema=1 then pub1 else pub2 end as pub_pdv,
c.cos as costo_catalogo,
cantidad
FROM compras.corta_caducidad_det a
join catalogo.cod_rel b on b.ean=a.codigo
join catalogo.cat_mercadotecnia c on c.codigo=a.codigo
where a.fecha_compra='0000-00-00 00:00:00' and a.id=$id and a.activo=1";
$q=$this->db->query($ee);
return $q;
}
function ofertas_corta_caducidad_det_cer($id_cc)
{
$ee="SELECT a.*,
case when a.activo=0 then 'CANCELADO' else 'ACTIVO' end as activox,
case when sistema=1 then descripcion1 else descripcion2 end as descripcion
FROM compras.corta_caducidad_det a
join catalogo.cod_rel b on b.ean=a.codigo
where a.fecha_compra<>'0000-00-00 00:00:00' and id_cc=$id_cc ";
$q=$this->db->query($ee);
return $q;
}
function valida_corta_caducidad_det($id_cc,$fec1,$fec2)
{
$ee="SELECT a.*,
case when sistema=1 then descripcion1 else descripcion2 end as descripcion
FROM compras.corta_caducidad_det a
join catalogo.cod_rel b on b.ean=a.codigo
where a.fecha_compra='0000-00-00 00:00:00' and id_cc=$id_cc and a.activo=1 and cod_rel>0";
$q=$this->db->query($ee);
if($q->num_rows()==0){
    $s="update compras.corta_caducidad_ctl set fecha_compra=CURRENT_TIMESTAMP,fecha_inicio='$fec1',fecha_fin='$fec2' 
    where id=$id_cc and activo=1";
    $this->db->query($s);

}}
function valida_corta_caducidad_det_gral($tipo,$mas,$id_cc)
{

if($tipo==1){$co='case when sistema=1 then cos1 else cos2 end';}else{$co='c.cos';}
$ee="update compras.corta_caducidad_det a,catalogo.cod_rel b,catalogo.cat_mercadotecnia c
set
a.costo=$co,
a.pub=case when sistema=1 then pub1 else pub2 end,
a.oferta=$co+(case when $mas <>0 then (($mas/100)*$co) else 0 end),
a.fecha_compra=CURRENT_TIMESTAMP
where b.ean=a.codigo and c.codigo=a.codigo and a.fecha_compra='0000-00-00 00:00:00' and a.id_cc=$id_cc and a.activo=1";
$this->db->query($ee);
}
function ofertas_corta_caducidad_his()
{
$ee="SELECT case when a.activo=0 then 'CANCELADO' else 'ACTIVO' end as activox,fecha_inicio,fecha_fin,    
a.fecha_suc,a.id,a.suc,b.nombre as sucx,a.fecha_compra, sum(c.oferta*c.cantidad) as imp 
FROM compras.corta_caducidad_ctl a
join compras.corta_caducidad_det c on c.id_cc=a.id
join catalogo.sucursal b on b.suc=a.suc
where a.fecha_compra>'0000-00-00'
group by a.id
order by a.fecha_compra desc";
$q=$this->db->query($ee);
return $q;
}

function ofertas_activas_gen()
{
$s="SELECT * FROM ofertas_genericos where date(now()) between fecha_activos and fecha_fin order by sec";
$q=$this->db->query($s);
return $q;
}
function ofertas_activas_gen_cad()
{
$s="SELECT * FROM ofertas_genericos where date(now())>fecha_fin order by sec";
$q=$this->db->query($s);
return $q;
}
function busca_pro_gen($sec){
        $sql = "SELECT * FROM catalogo.almacen where sec = $sec and tsec not in('X','M') order by susa2; ";
        $query = $this->db->query($sql);        
         if($query->num_rows() == 0){
            $tabla = 0;
         }else{
        $tabla = "<option value=\"-\">Seleccione una producto</option>";
        foreach($query->result() as $row){
             $tabla.="<option value =\"".$row->codigo."\">".$row->codigo." - ".$row->tsec." - ".$row->susa2." - ".$row->vtagen."</option>
            ";
         } 
        }  
        return $tabla;  
     }
function graba_producto_ofe_gen($sec,$codigo,$fec1,$fec2,$incentivo,$pre_ofe,$tipo)
{
    
if($codigo>0){
$s="insert  into compras.ofertas_genericos(codigo, descripcion, precio_oferta, fecha_activos, fecha_fin, sec, insentivo, seguimiento, sec_igual, motivo, memo_activo)
(select $codigo,susa2,'$pre_ofe','$fec1','$fec2',$sec,'$incentivo',1,0,'$tipo',0 from 
catalogo.almacen where sec=$sec and codigo=$codigo)";
$q=$this->db->query($s);
}}
function borra_producto_ofe_gen($id)
{
$s="insert  into compras.ofertas_genericos_his(codigo, descripcion, precio_oferta, fecha_activos, fecha_fin, sec, insentivo, seguimiento, sec_igual, motivo,  fecha,memo_activo)
(select codigo, descripcion, precio_oferta, fecha_activos, fecha_fin, sec, insentivo, seguimiento, sec_igual, motivo, now(),memo_activo from 
compras.ofertas_genericos where id=$id)";
$this->db->query($s);
$s1="delete from compras.ofertas_genericos where id=$id";
$this->db->query($s1);

}
function bloqueo_transfer()
{
$s="SELECT * FROM compras.bloqueados_x_mes_todas  where date(now()) between fecha1 and fecha2 order by id desc";
$q=$this->db->query($s);
return $q;
}
function bor_bloqueo_t($id)
{
$ee="delete from compras.bloqueados_x_mes_todas where  id = ? ";
$q=$this->db->query($ee,array($id));
}

function graba_bloqueo($codigo,$fec1,$fec2)
{
$s="insert ignore into compras.bloqueados_x_mes_todas(codigo, descripcion, fecha1, fecha2, rel1, rel2)
(select codigo, descripcion, '$fec1', '$fec2', rel1, rel2 from catalogo.cat_fanasa where codigo=$codigo)";
$this->db->query($s);
}
function excel_bloqueo()
{
$s="select fecha1 as FECHA_INICIO, fecha2 as FECHA_FIN, suc as NID, nombre as SUCURSAL, codigo as CODIGO, descripcion as DESCRIPCION,
venta1 as ENE, venta2 as FEB, venta3 as MAR, venta4 as ABR, venta5 as MAY, venta6 as JUN, venta7 as JUL, venta8 as AGO, venta9 as SEP, venta10 as OCT, venta11 as NOV, venta12 as DIC, inv as INV, compra as COMPRA, compra_fecha as FECHA_COMPRA
from(SELECT
fecha1, fecha2,b.suc, b.nombre, a.codigo, a.descripcion,
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
ifnull((select cantidad from desarrollo.inv x where x.suc=c.suc and x.rel=a.rel1 and a.rel1>0),0)as inv,
ifnull((select sum(can) from compras.pre_factura_fenix x
where x.suc=c.suc and x.cod=a.codigo and x.fecha between subdate(fecha1,3) and fecha2),0)as compra,
ifnull((select max(fecha) from compras.pre_factura_fenix x
where x.suc=c.suc and x.cod=a.codigo and x.fecha between subdate(fecha1,3) and fecha2),0)as compra_fecha

FROM compras.bloqueados_x_mes_todas a
left join catalogo.sucursal b on tipo3='FE' and tlid=1
left join vtadc.a_producto_mes_suc_contado c on c.codigo=a.codigo and c.suc=b.suc
where back=1
union all
SELECT
fecha1, fecha2,b.suc, b.nombre, a.codigo, a.descripcion,
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
ifnull((select cantidad from desarrollo.inv x where x.suc=c.suc and x.rel=a.rel2 and a.rel2>0),0)as inv,
ifnull((select sum(can) from compras.pre_factura_fenix x
where x.suc=c.suc and x.cod=a.codigo and x.fecha between subdate(fecha1,3) and fecha2),0)as compra,
ifnull((select max(fecha) from compras.pre_factura_fenix x
where x.suc=c.suc and x.cod=a.codigo and x.fecha between subdate(fecha1,3) and fecha2),0)as compra_fecha

FROM compras.bloqueados_x_mes_todas a
left join catalogo.sucursal b on tipo3='FE' and tlid=1
left join vtadc.a_producto_mes_suc_contado c on c.codigo=a.codigo and c.suc=b.suc
where back=2)todo
order by codigo,suc";
$q = $this->db->query($s);
return $q;
}

}
?>