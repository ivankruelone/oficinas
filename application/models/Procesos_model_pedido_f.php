<?php
	class Procesos_model_pedido_f extends CI_Model {


    function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        
    }
function sin_inv_actual()
{
    $s="select *from desarrollo.sin_inv_dia_anterior";
    $q=$this->db->query($s);
    return $q;
}
function transmision_especial($in_suc)
{
        $dianombre=date('D');
//$dianombre='Wed';
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($dianombre=='Mon'){$dia='LUN';$diap='PLU';}
if($dianombre=='Tue'){$dia='MAR';$diap='PMA';}
if($dianombre=='Wed'){$dia='MIE';$diap='PMI';}
if($dianombre=='Thu'){$dia='JUE';$diap='PJU';}
if($dianombre=='Fri'){$dia='VIE';$diap='PVI';}
$s="select a.*,b.fechai,subdate(date(now()),2)as limite,sum(cantidad)as inv,c.tel,c.tel1,
ifnull((select count(*) from catalogo.folio_pedidos_cedis where fechas=date(now()) and suc=a.suc and tid<>'X'),0)as pedido
from catalogo.sucursal a 
left join desarrollo.inv b on b.suc=a.suc and mov=07
left join desarrollo.sucursales c on c.suc=a.suc
where 
a.tlid=1 and a.dia in('LUN','MAR','MIE','JUE') and ger=1
group by a.suc order by pedido,fechai,a.suc"; 
$q=$this->db->query($s);
return $q;   
}

function inserta_pedido_for_especial($in_suc,$por1,$por2,$por3,$por4,$por5,$in_sec)
    {
    ini_set('memory_limit','15000M');
    set_time_limit(0);
       $x1="select a.suc,b.fechai,subdate(date(now()),3)as limite,sum(cantidad)as inv,
ifnull((select count(*) from catalogo.folio_pedidos_cedis where fechas=date(now()) and suc=a.suc),0)as pedido
from catalogo.sucursal a
left join desarrollo.inv b on b.suc=a.suc and mov=07
where a.tlid=1 and a.suc in($in_suc) and a.dia<>'CER' and 
(select count(*) from catalogo.folio_pedidos_cedis where fechas=date(now()) and suc=a.suc and tid<>'X')=0
and (select sum(cantidad) from desarrollo.inv xx where  xx.suc=a.suc)>0
and fechai>=subdate(date(now()),3)
group by a.suc order by pedido";
        $q1=$this->db->query($x1);
 foreach($q1->result() as $r1)
        {
        $suc=$r1->suc;
        
        $a = $this->__arreglo_pedido_formulado_una_especial($suc,$por1,$por2,$por3,$por4,$por5,$in_sec);
        $fec=date('Y-m-d');
        $b = "insert ignore into desarrollo.pedido_formulado (promant, fecg, tsuc, suc, sec, porce, descri, promact, 
        maxi, inv, ped, exc, costo, venta, impo, lin, iva,inv_cedis,mue,bloque) values ";
        
        foreach($a as $ped)
        {
            //id, cia, nomina, aaa1, aaa2, dias, aaa, dias_ley
              foreach($ped as $fin)
            {
                
        
                $b .= "(".$fin['promeant'].",date(now()),'".$fin['tsuc']."',".$fin['suc'].",".$fin['sec'].",".$fin['por'].",
                '".$fin['susa1']."',".$fin['promeact'].",".round($fin['promeact']*$fin['por'],2).",".$fin['inv'].",
                ".$fin['ped'].",".$fin['exc'].",".$fin['costo'].",".$fin['venta'].",".$fin['venta']*$fin['ped'].",
                ".$fin['lin'].",".$fin['iva'].",".$fin['inv_cedis'].",".$fin['mue'].",".$fin['ruta']."),";
            }
            
        }
        
        $b = substr($b, 0, -1) . ";";
     $this->db->query($b);
///////////////////////////////////////////////////////////////////////////////// pedido que remplace los datos.
/////////////////////////////////////////////////////////////////////////////////
$transito_sem="update  desarrollo.pedido_formulado a, desarrollo.pedidos b
set a.inv=b.sur
where week(b.fecha)= week(date(now())) and a.suc=b.suc and a.sec=b.sec
and a.suc=$suc and b.sur>0";
$this->db->query($transito_sem);

$bor=" delete from desarrollo.pedido_formulado where suc=$suc and inv>0";
$this->db->query($bor);
$sx8="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',0,1,0,0 
FROM desarrollo.pedido_formulado WHERE MUE<>6  and ped>0 and fecg='$fec' GROUP BY SUC)";
$this->db->query($sx8);

$sx9="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',mue,1,0,0 
FROM desarrollo.pedido_formulado WHERE MUE=6  and ped>0 and fecg='$fec' GROUP BY SUC)";
$this->db->query($sx9);
$sx10="insert into desarrollo.pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM desarrollo.pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=a.mue
where ped>0 and fecg='$fec' and id_user=6 and a.mue=6 order by a.suc)";
$this->db->query($sx10);
$sx11="insert into desarrollo.pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1 or inv_cedis > 0
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM desarrollo.pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=0
where ped>0 and fecg='$fec' and id_user=0  and a.mue<>6 order by a.suc)
on duplicate key update sec=values(sec)";
$this->db->query($sx11);

$sx12="update  desarrollo.pedidos set sur=0 where fecha='$fec' and sur>0 and invcedis=0 and suc=$suc";
$this->db->query($sx12);


$sx13="insert into formulados.pedido_formulado_resp15
(promant, fecg, tsuc, suc, sec, porce, descri, promact, maxi, inv, ped, exc, costo, venta, impo, fecha, id, descon, producto, inv_cedis, lin, mue, bloque, iva,fec_respaldo)
(select
 promant, fecg, tsuc, suc, sec, porce, descri, promact, maxi, inv, ped, exc, costo, venta, impo, fecha, id, descon, producto, inv_cedis, lin, mue, bloque, iva,date(now())
from desarrollo.pedido_formulado where ped>0)";
$this->db->query($sx13);
$sx14="delete FROM desarrollo.pedido_formulado";
$this->db->query($sx14);
}
 		
        
    }
//


    
function transmision()
{
        $dianombre=date('D');
//$dianombre='Wed';
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($dianombre=='Mon'){$dia='LUN';$diap='PLU';}
if($dianombre=='Tue'){$dia='MAR';$diap='PMA';}
if($dianombre=='Wed'){$dia='MIE';$diap='PMI';}
if($dianombre=='Thu'){$dia='JUE';$diap='PJU';}
if($dianombre=='Fri'){$dia='VIE';$diap='PVI';}
$s="select a.*,b.fechai,subdate(date(now()),2)as limite,sum(cantidad)as inv,c.tel,c.tel1,
ifnull((select count(*) from catalogo.folio_pedidos_cedis where fechas=date(now()) and suc=a.suc and tid<>'X'),0)as pedido
from catalogo.sucursal a 
left join desarrollo.inv b on b.suc=a.suc and mov=07
left join desarrollo.sucursales c on c.suc=a.suc
where 
a.tlid=1 and a.dia='$dia' or
a.tlid=1 and a.dia='$diap' 
group by a.suc order by pedido,fechai,a.suc"; 
$q=$this->db->query($s);
return $q;   
}   

function inserta_pedido_for($por1,$por2,$por3,$por4,$por5)
    {
    ini_set('memory_limit','15000M');
    set_time_limit(0);
$dianombre=date('D');
//$dianombre='Wed';
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($dianombre=='Mon'){$dia='LUN';}
if($dianombre=='Tue'){$dia='MAR';}
if($dianombre=='Wed'){$dia='MIE';}
if($dianombre=='Thu'){$dia='JUE';}
if($dianombre=='Fri'){$dia='VIE';}
        $si="insert ignore into inventarios.historico_inv_cedis(fecha, sec, susa, tipo, existencia,
        exis_kardex, sal_aju, sal_dev, sal_tra, sal_sur, ent_aju, ent_dev, ent_tra, ent_com)
        (select date(now()),sec,' ',' ',inv1,
        0,0,0,0,0,0,0,0,0 from desarrollo.inv_cedis_sec1 where inv1>0)";
        $this->db->query($si);
        $ins2="insert ignore into inventarios.historico_inv_cedis(fecha, sec, susa, tipo, existencia,
        exis_kardex, sal_aju, sal_dev, sal_tra, sal_sur, ent_aju, ent_dev, ent_tra, ent_com)
        (select date(now()),sec,susa,' ',0,0,0,0,0,0,0,0,0,0 from catalogo.cat_almacen_clasifica where descon='N')";
        $this->db->query($ins2);
        $ins3="insert ignore into inventarios.historico_inv_cedis
(fecha, sec, susa, tipo, existencia, exis_kardex, sal_aju, sal_dev, sal_tra, sal_sur, ent_aju, ent_dev, ent_tra, ent_com)
(SELECT
date(now()), sec, susa, tipo, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
FROM inventarios.historico_inv_cedis group by sec)";
        $this->db->query($ins3);
        $ins4="insert into inventarios.historico_inv_cedis
(fecha, sec, susa, tipo, existencia,
exis_kardex, sal_aju, sal_dev, sal_tra, sal_sur, ent_aju, ent_dev, ent_tra, ent_com)


(select subdate(a.fecha,0),

a.sec,a.susa,a.tipo,0,0,0,
ifnull((SELECT sum(can) FROM desarrollo.devolucion_c x
join desarrollo.devolucion_d y on y.id_cc=x.id
where y.sec=a.sec
 and x.tipo='S' and date_format(y.fechai,'%Y-%m-%d')=subdate(a.fecha,0)),0),

ifnull((SELECT sum(can) FROM desarrollo.traspaso_c x
join desarrollo.traspaso_d y on y.id_cc=x.id
where y.sec=a.sec
 and x.tipo='S' and date_format(y.fechai,'%Y-%m-%d')=subdate(a.fecha,0)),0),

ifnull((select sum(sur) from desarrollo.pedidos n
where n.sec=a.sec and date_format(fechasur,'%Y-%m-%d')=subdate(a.fecha,0)),0),

0,

ifnull((SELECT sum(can) FROM desarrollo.devolucion_c x
join desarrollo.devolucion_d y on y.id_cc=x.id
where mov in(1,2)
and x.tipo='E' and y.sec=a.sec and date_format(y.fechai,'%Y-%m-%d')=subdate(a.fecha,0)),0),

ifnull((SELECT sum(can) FROM desarrollo.traspaso_c x
join desarrollo.traspaso_d y on y.id_cc=x.id
where y.sec=a.sec  and x.tipo='E' and date_format(y.fechai,'%Y-%m-%d')=subdate(a.fecha,0)),0),

ifnull((select sum(can) from desarrollo.compra_c x
join desarrollo.compra_d y on y.id_cc=x.id and y.inv='S'
where x.tipo='C' and y.sec=a.sec and date_format(x.fecha,'%Y-%m-%d')=subdate(a.fecha,0)),0)



from inventarios.historico_inv_cedis a where a.fecha=case when weekday(date(now()))=0 then subdate(date(now()),3) else subdate(date(now()),1) end
)
on duplicate key update
sal_tra=values(sal_tra),
sal_dev=values(sal_dev),

sal_sur=values(sal_sur),

ent_tra=values(ent_tra),
ent_dev=values(ent_dev),
ent_com=values(ent_com)";
        $this->db->query($ins4);
        
        
$l0="insert ignore into almacen.max_sucursal (sec, suc, susa, m2011, m2012, m2013, m2014, final, paquete)
(select b.sec,a.suc,b.susa,0,0,0,0,2,0
from catalogo.sucursal a,
catalogo.cat_almacen_clasifica b
where tipo3='DA' and tlid=1 and descon='N' and fecha_act='0000-00-00' and b.sec not in(872,874,1026)
and
(select count(*) from almacen.max_sucursal x where x.sec=b.sec and x.suc=a.suc) is null)";
$this->db->query($l0);
$n1="update catalogo.sucursal a
set dia=case when
ifnull((select sum(cantidad) from desarrollo.inv b where b.suc=a.suc),0)=0
then concat('P',left(dia,2))
else dia end
where dia='$dia'";
$this->db->query($n1);

$opt="
update almacen.max_sucursal a, vtadc.venta_detalle_semana_sec b
set a.final=
case
when (select can from catalogo.almacen_paquetes x where x.sec=a.sec)is null
then round((final*1.20))
when (select can from catalogo.almacen_paquetes x where x.sec=a.sec)>0
then
((round((round((final*1.11)))/(select can from catalogo.almacen_paquetes x where x.sec=a.sec)))*
(select can from catalogo.almacen_paquetes x where x.sec=a.sec))
end
where a.suc=b.suc and a.sec=b.sec and round(a.final*1.20)<(b.vendio)";
$this->db->query($opt);

$activa_pag="update  catalogo.cat_almacen_clasifica set descon='N'
where sec in(969,970,971)";
//$this->db->query($activa_pag);

$ver_activar="select
a.sec,a.susa,sum(b.final),d.final
from catalogo.cat_almacen_clasifica a,almacen.max_sucursal b, catalogo.sucursal c, almacen.max_cedis d

where a.sec=b.sec and b.suc=c.suc and a.sec=d.sec and a.descon='N' and c.tipo3='DA' and c.dia<>'CER'
group by a.sec";
$actualiza_max_cedis="
insert ignore into almacen.max_cedis(sec,final)
(select
a.sec,sum(b.final)
from catalogo.cat_almacen_clasifica a,almacen.max_sucursal b, catalogo.sucursal c

where a.sec=b.sec and b.suc=c.suc and a.descon='N' and c.tipo3='DA' and c.dia<>'CER'
group by a.sec
order by sec)";
$this->db->query($actualiza_max_cedis);

$actualiza_max_cedis1="
update desarrollo.inv_cedis_sec1 a, catalogo.cat_almacen_clasifica b,almacen.max_cedis c
set
final_act=(select sum(final)
from almacen.max_sucursal x join catalogo.sucursal y on y.suc=x.suc where tlid=1 and tipo3='DA' and x.sec=a.sec),

porce=case when(
(a.inv1+
ifnull((select sum(sur) From desarrollo.pedidos x
where fecha>=subdate(date(now()),6) and fol<99999999 and inv='S' and x.sec=a.sec ),0))/

(select sum(final)
from almacen.max_sucursal x join catalogo.sucursal y on y.suc=x.suc where tlid=1 and tipo3='DA' and x.sec=a.sec)
)>=1

then 1

else(
(a.inv1+
ifnull((select sum(sur) From desarrollo.pedidos x
where fecha>=subdate(date(now()),6) and fol<99999999 and inv='S' and x.sec=a.sec ),0))/

(select sum(final)
from almacen.max_sucursal x join catalogo.sucursal y on y.suc=x.suc where tlid=1 and tipo3='DA' and x.sec=a.sec)
)
end



where b.sec=a.sec and a.sec=c.sec
and descon='N' and inv1>0";
$this->db->query($actualiza_max_cedis1);




         $x1="select a.suc,b.fechai,subdate(date(now()),2)as limite,sum(cantidad)as inv,
ifnull((select count(*) from catalogo.folio_pedidos_cedis where fechas=date(now()) and suc=a.suc),0)as pedido
from catalogo.sucursal a
left join desarrollo.inv b on b.suc=a.suc and mov=07
where a.tlid=1 and a.dia='$dia' and
(select count(*) from catalogo.folio_pedidos_cedis where fechas=date(now()) and suc=a.suc and tid<>'X')=0
and 
(select sum(cantidad) from desarrollo.inv xx where xx.mov=7 and xx.suc=a.suc and fechai>=subdate(date(now()),2))>0

group by a.suc order by pedido";
        $q1=$this->db->query($x1);
 foreach($q1->result() as $r1)
        {
        $suc=$r1->suc;
        
        $a = $this->__arreglo_pedido_formulado_una($suc,$por1,$por2,$por3,$por4,$por5);
        
        $fec=date('Y-m-d');
        $b = "insert ignore into desarrollo.pedido_formulado (promant, fecg, tsuc, suc, sec, porce, descri, promact, 
        maxi, inv, ped, exc, costo, venta, impo, lin, iva,inv_cedis,mue,bloque) values ";
        
        foreach($a as $ped)
        {
            //id, cia, nomina, aaa1, aaa2, dias, aaa, dias_ley
              foreach($ped as $fin)
            {
                
        
                $b .= "(".$fin['promeant'].",date(now()),'".$fin['tsuc']."',".$fin['suc'].",".$fin['sec'].",".$fin['por'].",
                '".$fin['susa1']."',".$fin['promeact'].",".round($fin['promeact']*$fin['por'],2).",".$fin['inv'].",
                ".$fin['ped'].",".$fin['exc'].",".$fin['costo'].",".$fin['venta'].",".$fin['venta']*$fin['ped'].",
                ".$fin['lin'].",".$fin['iva'].",".$fin['inv_cedis'].",".$fin['mue'].",".$fin['ruta']."),";
            }
            
        }
        
        $b = substr($b, 0, -1) . ";";
     $this->db->query($b);
///////////////////////////////////////////////////////////////////////////////// pedido que remplace los datos.



$adicional="update desarrollo.pedido_formulado xx
set xx.ped=((select

case when (inv1+ifnull((select sum(sur) from desarrollo.pedidos x
where x.fol<99999999 and x.sec=a.sec and fechasur>=subdate(date(now()),6) group by x.sec),0))/sum(final)<1
then
round((inv1+ifnull((select sum(sur) from desarrollo.pedidos x
where x.fol<99999999 and x.sec=a.sec and fechasur>=subdate(date(now()),6) group by x.sec),0))/sum(final)*xx.ped)
else
xx.ped
end

from desarrollo.inv_cedis_sec1 a
join almacen.max_sucursal b on b.sec=a.sec
join catalogo.sucursal c on c.suc=b.suc
where inv1>0 and tipo3='DA' and tlid=1 and a.sec=xx.sec
group by a.sec))

where ped>0 and suc=$suc";
$this->db->query($adicional);

$adicional1="update desarrollo.pedido_formulado a, catalogo.almacen_paquetes b 
set a.ped=(round((ped/b.can))*b.can)
where a.sec=b.sec and ped>0";
$this->db->query($adicional1);

//die();
/////////////////////////////////////////////////////////////////////////////////

$sx8="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',0,1,0,0 
FROM desarrollo.pedido_formulado WHERE MUE<>6  and ped>0 and fecg='$fec' GROUP BY SUC)";
$this->db->query($sx8);

$sx9="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',mue,1,0,0 
FROM desarrollo.pedido_formulado WHERE MUE=6  and ped>0 and fecg='$fec' GROUP BY SUC)";
$this->db->query($sx9);
$sx10="insert into desarrollo.pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM desarrollo.pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=a.mue
where ped>0 and fecg='$fec' and id_user=6 and a.mue=6 order by a.suc)";
$this->db->query($sx10);

$sx11="insert into desarrollo.pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1 or inv_cedis > 0
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM desarrollo.pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=0
where ped>0 and fecg='$fec' and id_user=0  and a.mue<>6 order by a.suc)
on duplicate key update sec=values(sec)";
$this->db->query($sx11);

$sx12="update  desarrollo.pedidos set sur=0 where fecha='$fec' and sur>0 and invcedis=0 and suc=$suc";
$this->db->query($sx12);


$sx13="insert into formulados.pedido_formulado_resp15
(promant, fecg, tsuc, suc, sec, porce, descri, promact, maxi, inv, ped, exc, costo, venta, impo, fecha, id, descon, producto, inv_cedis, lin, mue, bloque, iva,fec_respaldo)
(select
 promant, fecg, tsuc, suc, sec, porce, descri, promact, maxi, inv, ped, exc, costo, venta, impo, fecha, id, descon, producto, inv_cedis, lin, mue, bloque, iva,date(now())
from desarrollo.pedido_formulado)";
$this->db->query($sx13);
$sx14="delete FROM desarrollo.pedido_formulado";
$this->db->query($sx14);
}
    
$des_activa_pag="update  catalogo.cat_almacen_clasifica set descon='S'
where sec in(969,970,971)";
//$this->db->query($activa_pag);

 //echo "<pre>";
  //print_r($a);
  //echo "</pre>";
  //die();
		
        
    }
//
function __arreglo_pedido_formulado_una($suc,$por1,$por2,$por3,$por4,$por5)
    {
$dianombre=date('D');
//$dianombre='Wed';
$uno=date('m')-3;
$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($dianombre=='Mon'){$dia='LUN';}
if($dianombre=='Tue'){$dia='MAR';}
if($dianombre=='Wed'){$dia='MIE';}
if($dianombre=='Thu'){$dia='JUE';}
if($dianombre=='Fri'){$dia='VIE';}

$sql = "SELECT * FROM catalogo.sucursal where  suc=$suc and tlid=1";
        $query = $this->db->query($sql);
        
        $sql2 = "select a.*,b.final from catalogo.almacen a
        left join almacen.max_sucursal b on b.sec=a.sec and b.suc=$suc
        left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
        left join desarrollo.inv_cedis_sec1 d on d.sec=a.sec
        where
        c.sec is not null and b.suc=$suc and c.descon='N' and tsec='G'
        or
        d.inv1>0 and b.suc=$suc and c.descon='S' 
        group by a.sec order by descon";
        $query2 = $this->db->query($sql2);
        
        $a = array();
        $c = array();
        $d = array();
        $e = array();
        $b = 0;
        foreach($query2->result() as $row2)
        {
        foreach($query->result() as $row)
        {



$s2="select suc,sec,sum(cantidad)as cantidad  from desarrollo.inv where suc=$row->suc and sec=$row2->sec group by sec;";   
$q2 = $this->db->query($s2);
if($q2->num_rows()==1){
$r2 = $q2->row();
$inv=$r2->cantidad;    
}else{
$inv=0;
}
$s3="select * from desarrollo.inv_cedis_sec1 where sec=$row2->sec and inv1>0;";   
$q3 = $this->db->query($s3);
if($q3->num_rows()==1){
$r3 = $q3->row();
$inv_cedis=$r3->inv1;    
}else{
$inv_cedis=0;
}
$s4="select * from catalogo.almacen_mue where sec=$row2->sec;";   
$q4 = $this->db->query($s4);
if($q4->num_rows()==1){
$r4 = $q4->row();
$mue=$r4->mueble;    
}else{
$mue=0;
}
$s5="select * from catalogo.almacen_rutas where suc=$row->suc;";   
$q5 = $this->db->query($s5);
if($q5->num_rows()==1){
$r5 = $q5->row();
$ruta=$r5->ruta;    
}else{
$ruta=0;
}
$s6="select * from catalogo.almacen_paquetes  where sec=$row2->sec";
$q6 = $this->db->query($s6);
if($q6->num_rows()==1){
$r6 = $q6->row();
$paq=$r6->can;    
}else{
$paq=0;
}
$s7="select * from catalogo.cat_almacen_clasifica  where sec=$row2->sec";
$q7 = $this->db->query($s7);
if($q7->num_rows()==1){
$r7 = $q7->row();
$tip=$r7->tipo;    
}else{
$tip='e';
}
$promeant=0;
$promeact=$row2->final;
if($tip=='a'){$por=$por1;}elseif($tip=='b'){$por=$por2;}elseif($tip=='c'){$por=$por3;}elseif($tip=='d'){$por=$por4;}elseif($tip=='e'){$por=$por5;}else{$por=$por5;}
if($promeact==0){$maxi=round($promeant*$por);}else{$maxi=round($promeact*$por);}

if($maxi > $inv){$ped=$maxi-$inv;$exc=0;}else{$ped=0;$exc=$inv-$maxi;}
if($paq > 0 and $ped>0){$ped=round(($ped/$paq),0)*$paq;}
if($inv==0 & $ped==0 & $exc==0 & $paq>0){$ped=$paq;} 


 
            $a[$row->suc][$row2->sec]['tsuc'] = $row->tipo2;
			$a[$row->suc][$row2->sec]['suc'] = $row->suc;
            $a[$row->suc][$row2->sec]['iva'] = $row->iva;
			$a[$row->suc][$row2->sec]['sec'] = $row2->sec;
            $a[$row->suc][$row2->sec]['susa1'] = $row2->susa1;
            $a[$row->suc][$row2->sec]['lin'] = $row2->lin;
            $a[$row->suc][$row2->sec]['costo'] = $row2->costo;
            $a[$row->suc][$row2->sec]['venta'] = $row2->vtagen;
            $a[$row->suc][$row2->sec]['promeact'] = round($promeact);
            $a[$row->suc][$row2->sec]['promeant'] = round($promeant);
            $a[$row->suc][$row2->sec]['inv'] = $inv;
            $a[$row->suc][$row2->sec]['inv_cedis'] = $inv_cedis;
            $a[$row->suc][$row2->sec]['maxi'] = $maxi;
            $a[$row->suc][$row2->sec]['ped'] = $ped;
            $a[$row->suc][$row2->sec]['exc'] = $exc;
            $a[$row->suc][$row2->sec]['ruta'] = $ruta;
            $a[$row->suc][$row2->sec]['mue'] = $mue;
            $a[$row->suc][$row2->sec]['por'] = $por;
        }
        $b++;
		}
   
 //echo "<pre>";
 //print_r($a);
 //echo "</pre>";
 //die();
        return $a;
    
}

function __arreglo_pedido_formulado_una_especial($suc,$por1,$por2,$por3,$por4,$por5,$in_sec)
    {
$sql = "SELECT * FROM catalogo.sucursal where  suc=$suc and tlid=1";
        $query = $this->db->query($sql);
        
        $sql2 = "select a.*,b.final from catalogo.almacen a
        left join almacen.max_sucursal b on b.sec=a.sec and b.suc=$suc
        left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
        left join desarrollo.inv_cedis_sec1 d on d.sec=a.sec
        where
        c.sec is not null and b.suc=$suc and c.descon='N' and tsec='G' and a.sec in($in_sec)
        or
        d.inv1>0 and b.suc=$suc and c.descon='S'  and a.sec in($in_sec)
        group by a.sec order by descon";
        $query2 = $this->db->query($sql2);
        
        $a = array();
        $c = array();
        $d = array();
        $e = array();
        $b = 0;
        foreach($query2->result() as $row2)
        {
        foreach($query->result() as $row)
        {



$s2="select suc,sec,(cantidad)as cantidad  from desarrollo.inv where suc=$row->suc and sec=$row2->sec  group by sec;";   
$q2 = $this->db->query($s2);
if($q2->num_rows()==1){
$r2 = $q2->row();
$inv=$r2->cantidad;    
}else{
$inv=0;
}
$s3="select * from desarrollo.inv_cedis_sec1 where sec=$row2->sec and inv1>0;";   
$q3 = $this->db->query($s3);
if($q3->num_rows()==1){
$r3 = $q3->row();
$inv_cedis=$r3->inv1;    
}else{
$inv_cedis=0;
}
$s4="select * from catalogo.almacen_mue where sec=$row2->sec;";   
$q4 = $this->db->query($s4);
if($q4->num_rows()==1){
$r4 = $q4->row();
$mue=$r4->mueble;    
}else{
$mue=0;
}
$s5="select * from catalogo.almacen_rutas where suc=$row->suc;";   
$q5 = $this->db->query($s5);
if($q5->num_rows()==1){
$r5 = $q5->row();
$ruta=$r5->ruta;    
}else{
$ruta=0;
}
$s6="select * from catalogo.almacen_paquetes  where sec=$row2->sec";
$q6 = $this->db->query($s6);
if($q6->num_rows()==1){
$r6 = $q6->row();
$paq=$r6->can;    
}else{
$paq=0;
}
$s7="select * from catalogo.cat_almacen_clasifica  where sec=$row2->sec";
$q7 = $this->db->query($s7);
if($q7->num_rows()==1){
$r7 = $q7->row();
$tip=$r7->tipo;    
}else{
$tip='e';
}
$promeant=0;
$promeact=$row2->final;
if($tip=='a'){$por=$por1;}elseif($tip=='b'){$por=$por2;}elseif($tip=='c'){$por=$por3;}elseif($tip=='d'){$por=$por4;}elseif($tip=='e'){$por=$por5;}else{$por=$por5;}
if($promeact==0){$maxi=round($promeant*$por);}else{$maxi=round($promeact*$por);}
if($maxi > $inv){$ped=$maxi-$inv;$exc=0;}else{$ped=0;$exc=$inv-$maxi;}

if($paq > 0 and $ped>0){$ped=round(($ped/$paq),0)*$paq;}
if($inv==0 & $ped==0 & $exc==0 & $paq>0){$ped=$paq;}

            $a[$row->suc][$row2->sec]['tsuc'] = $row->tipo2;
			$a[$row->suc][$row2->sec]['suc'] = $row->suc;
            $a[$row->suc][$row2->sec]['iva'] = $row->iva;
			$a[$row->suc][$row2->sec]['sec'] = $row2->sec;
            $a[$row->suc][$row2->sec]['susa1'] = $row2->susa1;
            $a[$row->suc][$row2->sec]['lin'] = $row2->lin;
            $a[$row->suc][$row2->sec]['costo'] = $row2->costo;
            $a[$row->suc][$row2->sec]['venta'] = $row2->vtagen;
            $a[$row->suc][$row2->sec]['promeact'] = round($promeact);
            $a[$row->suc][$row2->sec]['promeant'] = round($promeant);
            $a[$row->suc][$row2->sec]['inv'] = $inv;
            $a[$row->suc][$row2->sec]['inv_cedis'] = $inv_cedis;
            $a[$row->suc][$row2->sec]['maxi'] = $maxi;
            $a[$row->suc][$row2->sec]['ped'] = $ped;
            $a[$row->suc][$row2->sec]['exc'] = $exc;
            $a[$row->suc][$row2->sec]['ruta'] = $ruta;
            $a[$row->suc][$row2->sec]['mue'] = $mue;
            $a[$row->suc][$row2->sec]['por'] = $por;
        }
        $b++;
		}
   
 //echo "<pre>";
 //print_r($a);
 //echo "</pre>";
 //die();
        return $a;
    
}  

function imprime_pedidos()
    {
        set_time_limit(0);
        ini_set('memory_limit','2000M');
        $this->load->helper('file');
        $aaa=date('Y');
        $mes=date('m');
        $otra_fecha1 = date('Y-m').'01';
		$otra_fecha2 = date('Y-m-d');
        $sql0 = "update catalogo.folio_pedidos_cedis_especial a
set tid='S'
where  a.fechas between '$otra_fecha1' and '$otra_fecha2 23:59:59' and tid='A' and
(select sum(sur) from desarrollo.pedidos x where x.fol=a.id)=0
or
a.fechas between '$otra_fecha1' and '$otra_fecha2 23:59:59' and tid='A' and
(select sum(sur) from desarrollo.pedidos x where x.fol=a.id)is null
";
$q0 = $this->db->query($sql0);
$sql1 = "update catalogo.folio_pedidos_cedis a
set tid='S'
where  a.fechas between '$otra_fecha1' and '$otra_fecha2 23:59:59' and tid='A' and
(select sum(sur) from desarrollo.pedidos x where x.fol=a.id)=0
or
a.fechas between '$otra_fecha1' and '$otra_fecha2 23:59:59' and tid='A' and
(select sum(sur) from desarrollo.pedidos x where x.fol=a.id)is null";
$q1 = $this->db->query($sql1);
        
        
        $sql = "SELECT id as fol, suc,id_user
        from catalogo.folio_pedidos_cedis b 
        where b.fechas between date(now()) and concat(date(now()),' 23:59:59')
        order by id_user,id";
       $q = $this->db->query($sql);
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
$bat = "@echo off
";
$bat1 = "@echo off
";
$bat3 = "@echo off
";
$bat4 = "@echo off
";
        foreach($q->result() as $r)
        {
        $fol = $r->fol;
        $suc = $r->suc;
        $data['fol']=$fol;
            if($r->id_user==6)
            {
                $tit='PREVIO DE PEDIDOS DE CONTROL MUEBLE 6';
                $nomarchivo = 'C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/'.$fol.'_06.pdf';
            }else{
                $tit='PREVIO DE PEDIDOS DE ALMACEN GENERAL';
                $nomarchivo = 'C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/'.$fol.'.pdf';
            }            //echo $r->fol.'<br />';
             
          $nomarchivofal = 'C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/rf_fal.pdf';
          $data['nomarchivo'] = $nomarchivo;
          if (file_exists($nomarchivo)){
            //echo "El fichero $nombre_fichero existe";
          }else{
              $mesx = $this->Catalogos_model->busca_mes_uno($mes);
              $sucx = $this->Catalogos_model->busca_suc_una($suc);
              $rutax = $this->Catalogos_model->busca_sucursal_ruta($suc,$fol);  
                $data['cabeza']= "
               <table>
               
               <tr>
               <td colspan=\"5\" align=\"center\"><strong>".$tit."</strong></td>
               </tr>
               
               <tr>
               <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
               </tr>
               <tr>
               <td colspan=\"3\" align=\"right\">RUTA.:".$rutax." </td>
               <td colspan=\"2\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
               </tr>
               <tr>
               <td colspan=\"2\" align=\"left\"><strong>SUCURSAL..:$suc - $sucx </strong> <br /></td>
                <td colspan=\"3\" align=\"ribht\"><strong>FOLIO..:$fol </strong> <br /></td>
               </tr>
                <tr>
               <th width=\"40\" align=\"center\"><strong>UBIC</strong></th>
               <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
               <th width=\"310\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
               <th width=\"220\" align=\"left\"><strong>DESCRIPCION</strong></th>
               <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
               
              </tr>
               </table> 
                ";
                
                $this->load->view('impresion/previo_de_pedidos', $data);
          }
            
if($r->id_user==0){
$bat.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\".$fol.".pdf\" \"pedidos\"
";
$bat3.= "\"C:\\Archivos de programa\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\pedidos\\".$fol.".pdf\" \"pedidos\"
";    
}else{
$bat1.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\".$fol."_06.pdf\" \"pedidos\"
";    
$bat4.= "\"C:\\Archivos de programa\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\pedidos\\".$fol."_06.pdf\" \"pedidos\"
";        
}            

            
        }

$bat.="exit";
$bat1.="exit";
$bat3.="exit";
$bat4.="exit";
        
        write_file('C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/imprime1.bat', $bat);
        write_file('C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/imprime2.bat', $bat1);
        write_file('C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/imprime3.bat', $bat3);
        write_file('C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/imprime4.bat', $bat4);
echo "Ya se Generaron los pedidos de almacen central";
}



function imprime_pedidos_especiales()
    {
        set_time_limit(0);
        ini_set('memory_limit','2000M');
        $this->load->helper('file');
        $aaa=date('Y');
        $mes=date('m');
        $otra_fecha1 = date('Y-m').'01';
		$otra_fecha2 = date('Y-m-d');
    
        $sql = "SELECT a.id as fol, a.suc,b.nombre,id_user,dia,weekday(date(now()))
        from catalogo.folio_pedidos_cedis a
        join catalogo.sucursal b on b.suc=a.suc
        where a.fechas between date(now()) and concat(date(now()),' 23:59:59') and b.dia<>case
when weekday(date(now()))=0 then 'LUN'
when weekday(date(now()))=1 then 'MAR'
when weekday(date(now()))=2 then 'MIE'
when weekday(date(now()))=3 then 'JUE'
when weekday(date(now()))=4 then 'VIE'
end
order by id_user,a.id";
       $q = $this->db->query($sql);
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
$bat = "@echo off
";
$bat1 = "@echo off
";
$bat3 = "@echo off
";
$bat4 = "@echo off
";
        foreach($q->result() as $r)
        {
        $fol = $r->fol;
        $suc = $r->suc;
        $data['fol']=$fol;
            if($r->id_user==6)
            {
                $tit='PREVIO DE PEDIDOS DE CONTROL MUEBLE 6';
                $nomarchivo = 'C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/'.$fol.'_06.pdf';
            }else{
                $tit='PREVIO DE PEDIDOS DE ALMACEN GENERAL';
                $nomarchivo = 'C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/'.$fol.'.pdf';
            }            //echo $r->fol.'<br />';
             
          $nomarchivofal = 'C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/rf_fal.pdf';
          $data['nomarchivo'] = $nomarchivo;
          if (file_exists($nomarchivo)){
            //echo "El fichero $nombre_fichero existe";
          }else{
              $mesx = $this->Catalogos_model->busca_mes_uno($mes);
              $sucx = $this->Catalogos_model->busca_suc_una($suc);
              $rutax = $this->Catalogos_model->busca_sucursal_ruta($suc,$fol);  
                $data['cabeza']= "
               <table>
               
               <tr>
               <td colspan=\"5\" align=\"center\"><strong>".$tit."</strong></td>
               </tr>
               
               <tr>
               <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
               </tr>
               <tr>
               <td colspan=\"3\" align=\"right\">RUTA.:".$rutax." </td>
               <td colspan=\"2\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
               </tr>
               <tr>
               <td colspan=\"2\" align=\"left\"><strong>SUCURSAL..:$suc - $sucx </strong> <br /></td>
                <td colspan=\"3\" align=\"ribht\"><strong>FOLIO..:$fol </strong> <br /></td>
               </tr>
                <tr>
               <th width=\"40\" align=\"center\"><strong>UBIC</strong></th>
               <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
               <th width=\"310\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
               <th width=\"220\" align=\"left\"><strong>DESCRIPCION</strong></th>
               <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
               
              </tr>
               </table> 
                ";
                
                $this->load->view('impresion/previo_de_pedidos', $data);
          }
            
if($r->id_user==0){
$bat.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\".$fol.".pdf\" \"pedidos\"
";
$bat3.= "\"C:\\Archivos de programa\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\pedidos\\".$fol.".pdf\" \"pedidos\"
";    
}else{
$bat1.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\".$fol."_06.pdf\" \"pedidos\"
";    
$bat4.= "\"C:\\Archivos de programa\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\pedidos\\".$fol."_06.pdf\" \"pedidos\"
";        
}            

            
        }

$bat.="exit";
$bat1.="exit";
$bat3.="exit";
$bat4.="exit";
        
        write_file('C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/imprime10.bat', $bat);
        write_file('C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/imprime11.bat', $bat1);
        
echo "Ya se Generaron los pedidos de almacen central";
}




function imprime_pedidos_fecha()
    {
        set_time_limit(0);
        ini_set('memory_limit','2000M');
        $this->load->helper('file');
        $aaa=date('Y');
        $mes=date('m');
        
		$otra_fecha = '2014-12-23';
        $carpeta='2014_12_23';
        
        
        $sql = "SELECT id as fol, suc,id_user
        from catalogo.folio_pedidos_cedis b 
        where b.fechas between '$otra_fecha' and concat('$otra_fecha',' 23:59:59')
        order by id_user,id";
       $q = $this->db->query($sql);
       
       
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
$bat = "@echo off
";
$bat1 = "@echo off
";
$bat3 = "@echo off
";
$bat4 = "@echo off
";
        foreach($q->result() as $r)
        {
        $fol = $r->fol;
        $suc = $r->suc;
        $data['fol']=$fol;
            if($r->id_user==6)
            {
                $tit='PREVIO DE PEDIDOS DE CONTROL MUEBLE 6';
                $nomarchivo = 'C:\wamp\www\f\resp/'.$carpeta.'/pdf/'.$fol.'_06.pdf';
            }else{
                $tit='PREVIO DE PEDIDOS DE ALMACEN GENERAL';
                $nomarchivo = 'C:\wamp\www\f\resp/'.$carpeta.'/pdf/'.$fol.'.pdf';
            }            //echo $r->fol.'<br />';
             
          $nomarchivofal = 'C:\wamp\www\f\resp/'.$carpeta.'/pdf/rf_fal.pdf';
          $data['nomarchivo'] = $nomarchivo;
          if (file_exists($nomarchivo)){
            //echo "El fichero $nombre_fichero existe";
          }else{
              $mesx = $this->Catalogos_model->busca_mes_uno($mes);
              $sucx = $this->Catalogos_model->busca_suc_una($suc);
              $rutax = $this->Catalogos_model->busca_sucursal_ruta($suc,$fol);  
                $data['cabeza']= "
               <table>
               
               <tr>
               <td colspan=\"5\" align=\"center\"><strong>".$tit."</strong></td>
               </tr>
               
               <tr>
               <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
               </tr>
               <tr>
               <td colspan=\"3\" align=\"right\">RUTA.:".$rutax." </td>
               <td colspan=\"2\" align=\"right\">Fecha .:".$carpeta." </td>
               </tr>
               <tr>
               <td colspan=\"2\" align=\"left\"><strong>SUCURSAL..:$suc - $sucx </strong> <br /></td>
                <td colspan=\"3\" align=\"ribht\"><strong>FOLIO..:$fol </strong> <br /></td>
               </tr>
                <tr>
               <th width=\"40\" align=\"center\"><strong>UBIC</strong></th>
               <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
               <th width=\"310\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
               <th width=\"220\" align=\"left\"><strong>DESCRIPCION</strong></th>
               <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
               
              </tr>
               </table> 
                ";
                
                $this->load->view('impresion/previo_de_pedidos', $data);
          }
            
if($r->id_user==0){
$bat.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".$carpeta."\\pdf\\".$fol.".pdf\" \"pedidos\"
";
$bat3.= "\"C:\\Archivos de programa\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\pedidos\\".$fol.".pdf\" \"pedidos\"
";    
}else{
$bat1.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".$carpeta."\\pdf\\".$fol."_06.pdf\" \"pedidos\"
";    
$bat4.= "\"C:\\Archivos de programa\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\pedidos\\".$fol."_06.pdf\" \"pedidos\"
";        
}            

            
        }

$bat.="exit";
$bat1.="exit";
$bat3.="exit";
$bat4.="exit";
        
        write_file('C:\wamp\www\f\resp/'.$carpeta.'/pdf/imprime1.bat', $bat);
        write_file('C:\wamp\www\f\resp/'.$carpeta.'/pdf/imprime2.bat', $bat1);
        write_file('C:\wamp\www\f\resp/'.$carpeta.'/pdf/imprime3.bat', $bat3);
        write_file('C:\wamp\www\f\resp/'.$carpeta.'/pdf/imprime4.bat', $bat4);
echo "Ya se Generaron los pedidos de almacen central";
}



function genera_optimogs_p($uno,$dos,$tres,$cuatro)
{
$aaa_1=date('y')-1;
$aaa_2=date('y')-2;
$s1="update vtadc.producto_mes_suc_gen a,catalogo.sucursal b, almacen.max_sucursal c
set uno=venta$uno,dos=venta$dos
where b.suc=a.suc and a.suc=c.suc and a.sec=c.sec and b.dia in('LUN','MAR','MIE','JUE','VIE','PLU','PMA','PMI','PJU','PVI')";
$this->db->query($s1);
$s2="update vtadc.producto_mes_suc_gen$aaa_2 a,catalogo.sucursal b, almacen.max_sucursal c
set tres=venta$tres,cuatro=venta$cuatro
where b.suc=a.suc and a.suc=c.suc and a.sec=c.sec and b.dia in('LUN','MAR','MIE','JUE','VIE','PLU','PMA','PMI','PJU','PVI')";
$this->db->query($s2);
$s3="update vtadc.producto_mes_suc_gen$aaa_1 a,catalogo.sucursal b, almacen.max_sucursal c
set tres=venta$tres
where b.suc=a.suc and a.suc=c.suc and a.sec=c.sec and b.dia in('LUN','MAR','MIE','JUE','VIE','PLU','PMA','PMI','PJU','PVI')
and tres=0";
$this->db->query($s3);
$s4="update vtadc.producto_mes_suc_gen$aaa_1 a,catalogo.sucursal b, almacen.max_sucursal c
set cuatro=venta$cuatro
where b.suc=a.suc and a.suc=c.suc and a.sec=c.sec and b.dia in('LUN','MAR','MIE','JUE','VIE','PLU','PMA','PMI','PJU','PVI')
and cuatro=0";
$this->db->query($s4);
$s5="update almacen.max_sucursal set final=0";
$this->db->query($s5);
$s6="update almacen.max_sucursal a,catalogo.sucursal b
set final=round(case
when uno=0 and dos=0 and tres=0 and cuatro=0 then 1
when uno=0 and dos=0 and tres=0 and cuatro>0 then cuatro
when uno=0 and dos=0 and tres>0 and cuatro=0 then tres
when uno=0 and dos>0 and tres=0 and cuatro=0 then dos
when uno>0 and dos=0 and tres=0 and cuatro=0 then uno
when uno=0 and dos=0 and tres>0 and cuatro>0 then ((cuatro+tres)/2)
when uno=0 and dos>0 and tres=0 and cuatro>0 then ((cuatro+dos)/2)
when uno>0 and dos=0 and tres=0 and cuatro>0 then ((cuatro+uno)/2)
when uno=0 and dos>0 and tres>0 and cuatro=0 then ((tres+dos)/2)
when uno>0 and dos=0 and tres>0 and cuatro=0 then ((tres+uno)/2)
when uno>0 and dos>0 and tres=0 and cuatro=0 then ((dos+uno)/2)
when uno>0 and dos>0 and tres>0 and cuatro=0 then ((uno+dos+tres)/3)
when uno>0 and dos=0 and tres>0 and cuatro>0 then ((uno+tres+cuatro)/3)
when uno>0 and dos>0 and tres=0 and cuatro>0 then ((uno+dos+cuatro)/3)
when uno=0 and dos>0 and tres>0 and cuatro>0 then ((dos+tres+cuatro)/3)
when uno>0 and dos>0 and tres>0 and cuatro>0 then ((uno+dos+tres+cuatro)/4)
else 0 end)
where b.suc=a.suc and
b.dia in('LUN','MAR','MIE','JUE','VIE','PLU','PMA','PMI','PJU','PVI')
";
$this->db->query($s6);

$s6="update almacen.max_sucursal a, catalogo.almacen_paquetes b,catalogo.sucursal c
set final=case when round(final/can)=0 then can else can*(round(final/can)) end
where a.sec=b.sec and a.suc=c.suc and dia in('LUN','MAR','MIE','JUE','VIE','PLU','PMA','PMI','PJU','PVI')";
$this->db->query($s6);

}
  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////pedido marzam
function pedido_for_marzam()
{
$s3="update compras.pre_pedido_fenix_for a,catalogo.cat_marzam b
set a.costo=b.costo,prv=500
where a.cod=b.codigo and b.producto<>' ' and a.costo=0";
$this->db->query($s3); 
   
}
function pedido_for_marzam_graba($prv)
{
$s1="insert ignore into compras.pre_pedido_fenix_det(fecha, tipo, fol, prv, suc, cod, descri, piezas, costo)
(select fecha, 'A',(select max(fol) from compras.pre_pedido_fenix_ctl)+1,prv,suc, cod, descri, piezas, costo 
from compras.pre_pedido_fenix_for where prv=500 and costo>0)";
$this->db->query($s1);
$s2="delete from compras.pre_pedido_fenix_for where  prv=$prv and costo>0";
$this->db->query($s2);    
$s3="insert ignore into compras.pre_pedido_fenix_ctl(fecha, prv, suc, importe, fol, tipo, canp, imp_facturado)
(SELECT fecha,prv,suc,sum(piezas*costo),fol,'C',sum(piezas),0
FROM compras.pre_pedido_fenix_det
where fecha=date(now()) and tipo='A' and prv=$prv
group by fecha,suc,prv,fol)";
$this->db->query($s3);
$s3="delete FROM compras.pre_pedido_fenix_for where prv=$prv";
$this->db->query($s3);
}

function pedido_esp_marzam()
{
$s="update compras.pre_pedido_fenix a,catalogo.cat_marzam b
set a.costo=b.costo,prv=500
where a.cod=b.codigo  and a.costo=0";
$this->db->query($s);    
}

function pedido_esp_marzam_graba($prv)
{

$s1="insert ignore into compras.pre_pedido_fenix_det(fecha, tipo, fol, prv, suc, cod, descri, piezas, costo)
(select fecha, 'A',(select max(fol) from compras.pre_pedido_fenix_ctl)+1,prv,suc, cod, descri, piezas, costo from compras.pre_pedido_fenix where prv=500 and costo>0)";
$this->db->query($s1);
$s2="delete from compras.pre_pedido_fenix where  prv=$prv and costo>0";
$this->db->query($s2);    
$s3="insert ignore into compras.pre_pedido_fenix_ctl(fecha, prv, suc, importe, fol, tipo, canp, imp_facturado)
(SELECT fecha,prv,suc,sum(piezas*costo),fol,'C',sum(piezas),0
FROM compras.pre_pedido_fenix_det
where fecha=date(now()) and tipo='A' and prv=$prv
group by fecha,suc,prv,fol)";
$this->db->query($s3);
$s3="delete FROM compras.pre_pedido_fenix where prv=$prv";
$this->db->query($s3);
}    
public function envia_ped_marzam($fol)
{
$pp=str_pad($fol,4,"0",STR_PAD_LEFT);
$s="select fecha,num as var,a.suc,b.lin,b.sublin,a.cod as codigo,
a.piezas as can
FROM compras.pre_pedido_fenix_det a
left join catalogo.cat_mercadotecnia b on b.codigo=a.cod
LEFT JOIN catalogo.cat_clientes_mayoris c on c.suc=a.suc and a.prv=c.prv
where a.prv=500 and num<>'||' and num<>'__' and fol=$fol
";
$q=$this->db->query($s);

$File = "./txt/marzam.txt";
$Handle = fopen($File, 'w');
foreach($q->result() as $r)
{
if($r->can>0){
    
 $Data=
         
         str_pad($r->var,7," ",STR_PAD_RIGHT)
        .str_pad($r->codigo,13," ",STR_PAD_RIGHT)
        .str_pad($r->can,3,"0",STR_PAD_LEFT)
        .str_pad('000000000',9," ",STR_PAD_LEFT)
        .str_pad('00000000000000000000000000000000000000000000000',47," ",STR_PAD_LEFT)
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle, $Data);
    
}}
fwrite($Handle, $Data);
fclose($Handle);

//die(); 
$servidor_ftp    = "200.38.152.241";
$ftp_nombre_usuario = "fenix";
$ftp_contrasenya = "f3nix";

$archivo = './txt/marzam.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = "in/FF01219$pp.txt";


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (
ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)

){
$sfinal="update compras.pre_pedido_fenix_det set tipo='C' where prv=500 and fol=$fol";
$this->db->query($sfinal);   
    $mensaje='Ya fue enviado el pedido al mayorista MARZAM';
}else{
    $mensaje=2;
}
ftp_close($id_con);
fclose($da);
echo $mensaje;    
}    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    }