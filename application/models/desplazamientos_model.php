<?php
class Desplazamientos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
  
    
function control_desplaza_suc($var,$reg)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
        if($var==4){$varx='A,B,C,D y E';$var0="'a','b','c','d','e'";}
$uno=date('m')-3;

$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
    if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
         $s="select b.tipo2, a.suc,c.tipo,a.sec,c.susa,b.nombre as sucx,b.regional,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12
from vtadc.producto_mes_suc a
left join catalogo.sucursal b on b.suc=a.suc and tlid=1 and dia<>'CER'
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
where  
b.regional=$reg and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0) and c.descon='N' or
b.superv=$reg and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0) and c.descon='N'
group by regional,a.suc

"; 
        $q = $this->db->query($s);

return $q;        
}
function control_desplaza_suc_una($var,$suc)
    {
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
        if($var==4){$varx='A,B,C,D y E';$var0="'a','b','c','d','e'";}
         $s="select a.*,mm.correcto,
         ifnull((select (cantidad) from desarrollo.inv where suc = $suc and sec = a.sec and mov<>41 group by suc,sec), 0) as cantidad,
         (select fechai+ INTERVAL 1 day from desarrollo.inv where suc = $suc and sec = a.sec and mov<>41 group by suc,sec) as fechai,
ifnull(b.m2013,0)as m2013,
ifnull(b.m2012,0)as m2012,
ifnull(b.m2011,0)as m2011,
ifnull(mm.final,2)as final,
ifnull(b.venta1,0)as venta1,
ifnull(b.venta2,0)as venta2,
ifnull(b.venta3,0)as venta3,
ifnull(b.venta4,0)as venta4,
ifnull(b.venta5,0)as venta5,
ifnull(b.venta6,0)as venta6,
ifnull(b.venta7,0)as venta7,
ifnull(b.venta8,0)as venta8,
ifnull(b.venta9,0)as venta9,
ifnull(b.venta10,0)as venta10,
ifnull(b.venta11,0)as venta11,
ifnull(b.venta12,0)as venta12,
a.susa
from catalogo.cat_almacen_clasifica a
left join vtadc.producto_mes_suc_gen b on a.sec=b.sec  and  b.suc=$suc
join almacen.max_sucursal mm on mm.suc=b.suc and mm.sec=a.sec
where  a.tipo in($var0) and descon='N'
order by tipo
"; 
        $q = $this->db->query($s);
        //ECHO $this->db->last_query();
        //echo die;
 return $q;   
    
    
    }
    
    
 function nivel_surtido($id_plaza)
 {
 $nivel=$this->session->userdata('nivel');
if($nivel==13){$var='d.superv='.$id_plaza.' and ';}elseif($nivel==13){$var='d.regional='.$id_plaza.' and ';}else{$var=' ';}
 $s="select a.*,d.nombre ,
sum(case when tipo='a' then abasto end) as tipo1,
sum(case when tipo='b' then abasto end) as tipo2,
sum(case when tipo='c' then abasto end) as tipo3,
sum(case when tipo='d' then abasto end) as tipo4,
sum(case when tipo='e' then abasto end) as tipo5

From oficinas.nivel_surtido_suc_cla a
join catalogo.sucursal d on d.suc=a.suc
where $var fecha=date(now())
group by suc";
 $q=$this->db->query($s);
 return $q;  
 }


function archivo_exel_gerente($ger,$aaa)
{
if($aaa==date('Y')){$ar='';}else{$ar=substr($aaa,2,2);}
$s="SELECT a.aaa, a.suc,b.nombre,a.codigo,descripcion,
venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12
FROM vtadc.producto_mes_suc$ar a
join catalogo.sucursal b on b.suc=a.suc and tipo3='FE' and tlid=1
where aaa=$aaa and regional=$ger
";
$q=$this->db->query($s);
return $q;
}
function archivo_exel_optimo_ger($aaa,$id_plaza)/////lo direcciono controlador de ventas
{
$actual=date('Y');
if($aaa==$actual){
    $var='producto_mes_suc_gen';    
}else{
    $var='producto_mes_suc_gen'.substr($aaa,2,2);
}

$s="select aaa,c.tipo,a.suc,b.nombre as sucx,a.sec,a.susa,a.final,a.correcto,
venta1,venta2,venta3,venta4,venta5,venta6,venta7,venta8,venta9,venta10,venta11,venta12,
ifnull(d.cantidad,0) as inv,ifnull(e.vtagen,0)as venta
from almacen.max_sucursal a
left join vtadc.$var x on x.suc=a.suc and x.sec=a.sec and x.aaa=$aaa
left join desarrollo.inv d on  d.suc=a.suc and d.sec=a.sec and cantidad>0
join catalogo.sucursal b on b.suc=a.suc
join catalogo.cat_almacen_clasifica c on c.sec=a.sec and descon='N'
join catalogo.sec_unica e on e.sec=a.sec
where  tlid=1 and superv=$id_plaza 
order by a.suc,a.sec 
";
$q=$this->db->query($s);
return $q;
}

function desplaza_paquetes()/////lo direcciono controlador de ventas
{
$id_plaza=$this->session->userdata('id_plaza');
if($id_plaza==12){$var='regional='.$id_plaza.' and';}
elseif($id_plaza==13){$var='superv='.$id_plaza.' and';}else{$var=' ';}
$s="select a.sec,a.sec_igual,pak,susa,
ifnull((select inv1 from desarrollo.inv_cedis_sec1 x where x.sec=a.sec),0)as inv_cedis,
(select sum(cantidad) from desarrollo.inv x where x.sec=a.sec and mov=7 and fechai>=subdate(date(now()),2) group by sec)as inv,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12,
(select inv1 from desarrollo.inv_cedis_sec1 x where x.sec=a.sec)as inv_cedis
from catalogo.cat_almacen_clasifica a
left join vtadc.producto_mes_suc_gen b on b.sec=a.sec
join catalogo.sucursal c on c.suc=b.suc
where $var pak>0 and tlid=1 and c.tipo3='DA'
group by a.sec
order by sec_igual,a.sec";
$q=$this->db->query($s);
return $q;
}


function desplaza_ofertas_gen($aaa)/////lo 
{
$id_plaza=$this->session->userdata('id_plaza');
if($id_plaza==0){$var='';}else{$var='c.regional='.$id_plaza.' and';}
$s="SELECT fecha_activos,a.sec,a.codigo,d.susa,
sum(b.venta1)as venta1,
sum(b.venta2)as venta2,
sum(b.venta3)as venta3,
sum(b.venta4)as venta4,
sum(b.venta5)as venta5,
sum(b.venta6)as venta6,
sum(b.venta7)as venta7,
sum(b.venta8)as venta8,
sum(b.venta9)as venta9,
sum(b.venta10)as venta10,
sum(b.venta11)as venta11,
sum(b.venta12)as venta12,
insentivo

FROM compras.ofertas_genericos a
join vtadc.producto_mes_suc b on b.codigo=a.codigo
join catalogo.sucursal c on c.suc=b.suc
join catalogo.cat_almacen_clasifica d on d.sec=a.sec
where $var seguimiento=1  and c.tipo3 in('DA','FA')
group by a.codigo
order by sec
";
$q=$this->db->query($s);
return $q;
}function desplaza_ofertas_gen_det($aaa,$cod)/////lo 
{
$id_plaza=$this->session->userdata('id_plaza');
if($id_plaza==0){$var='';}else{$var='c.regional='.$id_plaza.' and';}
$s="SELECT b.suc,c.nombre as sucx, fecha_activos,a.sec,a.codigo,d.susa,
sum(b.venta1)as venta1,
sum(b.venta2)as venta2,
sum(b.venta3)as venta3,
sum(b.venta4)as venta4,
sum(b.venta5)as venta5,
sum(b.venta6)as venta6,
sum(b.venta7)as venta7,
sum(b.venta8)as venta8,
sum(b.venta9)as venta9,
sum(b.venta10)as venta10,
sum(b.venta11)as venta11,
sum(b.venta12)as venta12,
insentivo

FROM compras.ofertas_genericos a
join vtadc.producto_mes_suc b on b.codigo=a.codigo
join catalogo.sucursal c on c.suc=b.suc
join catalogo.cat_almacen_clasifica d on d.sec=a.sec
where $var seguimiento=1 and a.codigo=$cod and c.tipo3 in('DA','FA')
group by a.codigo,b.suc
order by sec
";
$q=$this->db->query($s);
return $q;
}

function desplaza_ofertas_gen_in($aaa)/////lo 
{
$id_plaza=$this->session->userdata('id_plaza');
if($id_plaza==0){$var='';}else{$var='c.regional='.$id_plaza.' and';}
$s="SELECT fecha_activos,a.sec,a.codigo,d.susa,
sum(b.venta1)as venta1,
sum(b.venta2)as venta2,
sum(b.venta3)as venta3,
sum(b.venta4)as venta4,
sum(b.venta5)as venta5,
sum(b.venta6)as venta6,
sum(b.venta7)as venta7,
sum(b.venta8)as venta8,
sum(b.venta9)as venta9,
sum(b.venta10)as venta10,
sum(b.venta11)as venta11,
sum(b.venta12)as venta12,
insentivo

FROM compras.ofertas_genericos a
join vtadc.producto_mes_suc b on b.codigo=a.codigo
join catalogo.sucursal c on c.suc=b.suc
join catalogo.cat_almacen_clasifica d on d.sec=a.sec
where $var insentivo>0  and c.tipo3 in('DA','FA')
group by a.codigo
order by sec
";
$q=$this->db->query($s);
return $q;
}function desplaza_ofertas_gen_in_det($aaa,$cod)/////lo 
{
$id_plaza=$this->session->userdata('id_plaza');
if($id_plaza==0){$var='';}else{$var='c.regional='.$id_plaza.' and';}
$s="SELECT b.suc,c.nombre as sucx, fecha_activos,a.sec,a.codigo,d.susa,
sum(b.venta1)as venta1,
sum(b.venta2)as venta2,
sum(b.venta3)as venta3,
sum(b.venta4)as venta4,
sum(b.venta5)as venta5,
sum(b.venta6)as venta6,
sum(b.venta7)as venta7,
sum(b.venta8)as venta8,
sum(b.venta9)as venta9,
sum(b.venta10)as venta10,
sum(b.venta11)as venta11,
sum(b.venta12)as venta12,
insentivo

FROM compras.ofertas_genericos a
join vtadc.producto_mes_suc b on b.codigo=a.codigo
join catalogo.sucursal c on c.suc=b.suc
join catalogo.cat_almacen_clasifica d on d.sec=a.sec
where $var insentivo>0 and a.codigo=$cod and c.tipo3 in('DA','FA')
group by a.codigo,b.suc
order by sec
";
$q=$this->db->query($s);
return $q;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////COMPRAS

  function des_diario()
 {
 $s="select fecha,sec,susa1,sum(can)as venta, weekday(fecha)as dia  From vtadc.venta_detalle a
join catalogo.almacen_codigos_unicos b on
b.codigo=a.codigo and sec>0 and sec<=1999 or
b.codigo=a.codigo and sec in(3102,3074,3071)
join catalogo.sucursal c on c.suc=a.suc and tipo3='DA'
where fecha>=case
when weekday(date(now()))=0 then subdate(date(now()),7)
when weekday(date(now()))=1 then subdate(date(now()),1)
when weekday(date(now()))=2 then subdate(date(now()),2)
when weekday(date(now()))=3 then subdate(date(now()),3)
when weekday(date(now()))=4 then subdate(date(now()),4)
when weekday(date(now()))=5 then subdate(date(now()),5)
when weekday(date(now()))=6 then subdate(date(now()),6) end
group by fecha,sec";
 $q=$this->db->query($s);
 foreach ($q->result()as $r)
        {
        $a[$r->sec]['sec'] = $r->sec;
        $a[$r->sec]['susa1'] = $r->susa1;
        $a[$r->sec]['m'][$r->dia]['dia'] = $r->dia;
        $a[$r->sec]['m'][$r->dia]['fecha'] = $r->fecha;
        $a[$r->sec]['m'][$r->dia]['dia'] = $r->dia;
        $a[$r->sec]['m'][$r->dia]['venta'] = $r->venta;
        }
     return $a;  
 
 }  
function des_diario_sem($fec1,$fec2)
 {
 $s="select fecha,sec,susa1,sum(can)as venta, weekday(fecha)as dia  From vtadc.venta_detalle a
join catalogo.almacen b on
b.codigo=a.codigo and sec>0 and sec<=1999 or
b.codigo=a.codigo and sec in(3102,3074,3071)
join catalogo.sucursal c on c.suc=a.suc and tipo3='DA'
where fecha between '$fec1' and '$fec2'
group by fecha,sec";
 $q=$this->db->query($s);
 foreach ($q->result()as $r)
        {
        $a[$r->sec]['sec'] = $r->sec;
        $a[$r->sec]['susa1'] = $r->susa1;
        $a[$r->sec]['m'][$r->dia]['dia'] = $r->dia;
        $a[$r->sec]['m'][$r->dia]['fecha'] = $r->fecha;
        $a[$r->sec]['m'][$r->dia]['dia'] = $r->dia;
        $a[$r->sec]['m'][$r->dia]['venta'] = $r->venta;
        }
        
     return $a;  
 }
 function des_metro()
 {
 $s="select year(fecha)as aaa,month(fecha)as mes,c.mes as mesx,sum(cant)as piezas,sum(imp)as imp
from vtadc.vta_backoffice a
join catalogo.sucursal b on a.suc=b.suc
join catalogo.mes c on c.num=month(fecha)
where a.vtatip=case when back=1 then 71 else '101'end and year(fecha)=year(date(now()))
group by year(fecha),month(fecha)";
 $q=$this->db->query($s);
 return $q;  
 }
 function des_metro_suc($aaa,$mes)
 {
 $s="select a.suc,b.nombre as sucx,year(fecha)as aaa,month(fecha)as mes,sum(cant)as piezas,sum(imp)as imp
from vtadc.vta_backoffice a
join catalogo.sucursal b on a.suc=b.suc
where a.vtatip=case when back=1 then 71 else '101'end
and year(fecha)=$aaa and month(fecha)=$mes
group by a.suc
";
 $q=$this->db->query($s);
 return $q;  
 }
 function des_metro_suc_det($aaa,$mes,$suc)
 {
 $s="select a.suc,b.nombre as sucx,year(fecha)as aaa,month(fecha)as mes,a.cod,a.des,sum(cant)as piezas,sum(imp)as imp
from vtadc.vta_backoffice a
join catalogo.sucursal b on a.suc=b.suc
where a.vtatip=case when back=1 then 71 else '101'end
and year(fecha)=$aaa and month(fecha)=$mes and a.suc=$suc
group by a.cod
";
 $q=$this->db->query($s);
 return $q;  
 }
  function des_metro_pro($aaa,$mes)
 {
 $s="select year(fecha)as aaa,month(fecha)as mes,a.cod,a.des,sum(cant)as piezas,sum(imp)as imp
from vtadc.vta_backoffice a
join catalogo.sucursal b on a.suc=b.suc
where a.vtatip=case when back=1 then 71 else '101'end
and year(fecha)=$aaa and month(fecha)=$mes
group by a.cod
";
$q=$this->db->query($s);
 return $q;  
 }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function desplaza_fenix_contado_pat($aaa)
 {
  $nivel=$this->session->userdata('nivel');
  $id_plaza=$this->session->userdata('id_plaza');
  if($nivel==12){$var='regional='.$id_plaza.' and';}
  if($nivel==13){$var='superv='.$id_plaza.' and';} else $var=' ';  
 $s="SELECT a.sec,a.codigo,descripcion,
sum(venta1)as venta1,
sum(venta2)as venta2, 
sum(venta3)as venta3, 
sum(venta4)as venta4, 
sum(venta5)as venta5, 
sum(venta6)as venta6, 
sum(venta7)as venta7, 
sum(venta8)as venta8, 
sum(venta9)as venta9, 
sum(venta10)as venta10, 
sum(venta11)as venta11, 
sum(venta12)as venta12 
FROM vtadc.a_producto_mes_suc_contado a
join catalogo.sucursal b on b.suc=a.suc
 
where $var a.sec=0 and aaa=$aaa
group by a.rel1,a.rel2
";
$q=$this->db->query($s);
 return $q;  
 }
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  function desplaza_optimo_venta($aaa)
 {
  $nivel=$this->session->userdata('nivel');
  $id_plaza=$this->session->userdata('id_plaza');
  if($nivel==12){$var='regional='.$id_plaza.' and';}
  if($nivel==13){$var='superv='.$id_plaza.' and';} else $var=' ';
  $mes_act='venta'.(date('m')*1);
  $mes_ant='venta'.((date('m')-1)*1);  
 $s="select b.val,b.tipo,a.sec,b.susa,a.final as optimo_cedis,
(select sum(correcto) from almacen.max_sucursal x, catalogo.sucursal y where x.suc=y.suc and tlid=1 and tipo3='DA' and x.sec=a.sec and fecha_act='0000-00-00')as necesidad_ant,
(select sum(final) from almacen.max_sucursal x, catalogo.sucursal y where x.suc=y.suc and tlid=1 and tipo3='DA' and x.sec=a.sec and fecha_act='0000-00-00')as necesidad_act,
ifnull(inv1,0) as exis,
ifnull(sum($mes_act),0)as venta_act,ifnull(sum($mes_ant),0)as venta_ant,

((ifnull(sum($mes_act),0)/day(subdate(date(now()),1)))*dos)as proyeccion,

ifnull((SELECT sum($mes_act)
FROM vtadc.a_producto_mes_suc_contado aa
join catalogo.cat_fenix_sec_cod bb on bb.cod=aa.codigo
join catalogo.sucursal cc on cc.suc=aa.suc and tlid=1 and fecha_act='0000-00-00' 
where bb.sec=a.sec
group by bb.sec),0)as venta_actf,

ifnull((SELECT sum($mes_ant)
FROM vtadc.a_producto_mes_suc_contado aa
join catalogo.cat_fenix_sec_cod bb on bb.cod=aa.codigo
join catalogo.sucursal cc on cc.suc=aa.suc and tlid=1 and fecha_act='0000-00-00'
where bb.sec=a.sec
group by bb.sec),0)as venta_antf,

((ifnull((SELECT sum($mes_act)
FROM vtadc.a_producto_mes_suc_contado aa
join catalogo.cat_fenix_sec_cod bb on bb.cod=aa.codigo
join catalogo.sucursal cc on cc.suc=aa.suc and tlid=1 and fecha_act='0000-00-00' 
where bb.sec=a.sec
group by bb.sec),0)/day(subdate(date(now()),1)))*dos)as proyeccion_f,

round(((((select sum(final) from almacen.max_sucursal x, catalogo.sucursal y where x.suc=y.suc and tlid=1 and tipo3='DA' and x.sec=a.sec and fecha_act='0000-00-00'))
+((ifnull((SELECT sum($mes_act)
FROM vtadc.a_producto_mes_suc_contado aa
join catalogo.cat_fenix_sec_cod bb on bb.cod=aa.codigo
join catalogo.sucursal cc on cc.suc=aa.suc and tlid=1 and fecha_act='0000-00-00' 
where bb.sec=a.sec
group by bb.sec),0)/day(subdate(date(now()),1)))*dos))*1.10))as optimo_ideal,

(round(((((select sum(final) from almacen.max_sucursal x, catalogo.sucursal y where x.suc=y.suc and tlid=1 and tipo3='DA' and x.sec=a.sec and fecha_act='0000-00-00'))
+((ifnull((SELECT sum($mes_act)
FROM vtadc.a_producto_mes_suc_contado aa
join catalogo.cat_fenix_sec_cod bb on bb.cod=aa.codigo
join catalogo.sucursal cc on cc.suc=aa.suc and tlid=1 and fecha_act='0000-00-00' 
where bb.sec=a.sec
group by bb.sec),0)/day(subdate(date(now()),1)))*dos))*1.10))-a.final)as dif,
ifnull(can,1)as paq
 from almacen.max_cedis a
join catalogo.cat_almacen_clasifica b on b.sec=a.sec
left join vtadc.producto_mes_suc_gen c on c.sec=a.sec and aaa=$aaa
left join desarrollo.inv_cedis_sec1 d on d.sec=a.sec
join catalogo.mes e on e.num=month(date(now()))
left join catalogo.almacen_paquetes f on f.sec=a.sec
where descon='N'
group by a.sec
order by tipo,sec";
$q=$this->db->query($s);
return $q;
 }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function fanasa_excel($mes)
    {
        $s = "select year(fecha)as AAA,month(fecha)as MES,a.suc as NID,c.nombre as SUCURSAL, b.codigo as CODIGO, descripcion as DESCRIPCION,(sum(cant)) as VENTA
from vtadc.vta_backoffice a join catalogo.cat_fanasa b on b.rel1=rel join catalogo.sucursal c on c.suc=a.suc
where a.suc in(103,105,106,107,108,109,112,116,129,202,504,511,806,812)
and vtatip=1 and year(fecha)=year(date(now())) and month(fecha)=$mes
group by a.suc,a.rel
union all
select year(fecha),month(fecha),a.suc,c.nombre, b.codigo, descripcion,sum(cant)
from vtadc.vta_backoffice a join catalogo.cat_fanasa b on b.rel2=rel join catalogo.sucursal c on c.suc=a.suc
where a.suc in(114,193,201,552)
and vtatip=1 and year(fecha)=year(date(now())) and month(fecha)=$mes
group by a.suc,a.rel
";
        $q = $this->db->query($s);
        return $q;
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////



}