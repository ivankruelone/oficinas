<?php
class Comision_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

function calculo_comisiones_20150901($tipo3,$aaa,$mes,$aaa_a,$mes_a,$aaa_a2,$mes_a2,$fec_alta,$dias)
{
  //echo $mes_a;
    $s="select superv,regional,aa.suc,b.nombre as sucx,
sum(aa.costo_venta)as costo_venta,
sum(aa.renta)as renta,
sum(aa.nomina+aa.isr_nomina)as nomina,
sum(aa.insumos)as insumos,
sum(aa.agua)as agua,
sum(aa.luz)as luz,
sum(aa.tel)as tel,
sum(+aa.otros)as otros,
(select por_suc from finanzas.gasto_oficinas_suc xx where xx.aaa=$aaa and xx.mes=$mes)as gastos_oficina,
    
    
    
(sum(aa.costo_venta+aa.renta+aa.nomina+aa.isr_nomina+aa.insumos+aa.agua+aa.luz+aa.tel+aa.otros+
(select por_suc from finanzas.gasto_oficinas_suc xx where xx.aaa=$aaa and xx.mes=$mes)))punto_equilibrio,

((sum(aa.costo_venta+aa.renta+aa.nomina+aa.isr_nomina+aa.insumos+aa.agua+aa.luz+aa.tel+aa.otros+
(select por_suc from finanzas.gasto_oficinas_suc xx where xx.aaa=$aaa and xx.mes=$mes)))*1.4)objetivo_100,

(((sum(aa.costo_venta+aa.renta+aa.nomina+aa.isr_nomina+aa.insumos+aa.agua+aa.luz+aa.tel+aa.otros+
(select por_suc from finanzas.gasto_oficinas_suc xx where xx.aaa=$aaa and xx.mes=$mes)))*1.4)*
ifnull((SELECT ((sum(abasto)/count(*))/100)
FROM oficinas.nivel_surtido_suc x, catalogo.sucursal z
where x.suc=z.suc and x.suc=aa.suc and year(x.fecha)=$aaa and month(x.fecha)=$mes
group by month(fecha),superv),1))as objetivo_mes,

ifnull((SELECT ((sum(abasto)/count(*))/100)
FROM oficinas.nivel_surtido_suc x, catalogo.sucursal z
where x.suc=z.suc and x.suc=aa.suc and year(x.fecha)=$aaa and month(x.fecha)=$mes
group by month(fecha),superv),1)as nivel_surtido,

(select sum(siniva) from desarrollo.cortes_c x 
join desarrollo.cortes_d z on z.id_cc=x.id and clave1 not in(0,20,30,40,49) 
where year(fechacorte)=$aaa and month(fechacorte)=$mes and x.suc=aa.suc
group by x.suc)as venta_mes,

ifnull((SELECT sum(cantidad*cos_dev) FROM desarrollo.devolucion_sucursal_control x
join desarrollo.devolucion_sucursal_detalle z on z.devolucion=x.devolucion
where tipo=1 and statusDevolucion>0 and id_devolucion=9 and x.suc=aa.suc and year(fecha_cierre)=$aaa and month(fecha_cierre)=$mes),0)as merma,

(sum(aa.insumos+aa.agua+aa.luz+aa.tel+aa.otros))as gastos_operativos,
(SELECT porcentaje FROM checklist.ponderacion x where x.ano=$aaa and x.mes=$mes and x.suc=aa.suc)as eval_suc


 FROM oficinas.pianel_sucursal aa
join catalogo.sucursal b on b.suc=aa.suc
where 
aa.aaa=$aaa_a and aa.mes=$mes_a and aa.tipo3='$tipo3' and year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes)
group by aa.suc
order by regional,superv,aa.suc";


$q=$this->db->query($s);
$l1=anchor('comision/inserta_comision_desem/'.$aaa.'/'.$mes.'/'.$dias,'INSERTA PERSONAL a PRENOMINA');
$tabla='
<table border=\"1\">
<tr>
<td colspan=5>'.$l1.'</td>
</tr>
<tr>
<th>#</th>
<th>Regional</th>
<th>Zona</th>
<th>Nid</th>
<th>Suc</th>
<th>Costo de la<br />Venta</th>
<th>Renta</th>
<th>Nomina</th>
<th>Insumos</th>
<th>Agua</th>
<th>Luz</th>
<th>Tel</th>
<th>Otros</th>
<th>Monto<br />Gasto Oficinas</th>
<th>Punto Equilibrio</th>
<th>Objetivo al 100</th>
<th>Nivel Surtido</th>
<th>Objetivo nivel_surtido</th>
<th>Venta</th>
<th>Utilidad</th>
<th>Alcance del Objetivo</th>
<th>Puntuacion<br />Rentabilidad</th>
<th>Objetivo<br />Merma</th>
<th>Merma</th>
<th>Puntos<br />Merma</th>
<th>Objetivo<br />Gastos Operativos</th>
<th>Gastos</th>
<th>Puntos<br />Gastos Operativos</th>
<th>Evaluacion<br />Farmacia</th>
<th>Puntos<br />Evaluacion Farmacia</th>
<th>Suma de puntos</th>
<th>Comision</th>
<th>Comision<br />Farmacia</th>
<th>Comision<br />Supervisor</th>
<th>Comision<br />Regional</th>
<th>Comision<br />Nacional</th>
</tr>';
$objetivo_mes=0;
$num=0;$t1=0;$suc_comisionadas=0;
$fec=$aaa.'-'.str_pad($mes,2,0,STR_PAD_LEFT).'-01';
foreach($q->result()as $r)
{
$num=$num+1;
$utilidad=($r->venta_mes)-($r->objetivo_mes);
$alcance_ob=((($r->venta_mes)/($r->objetivo_mes))*100);
    if($alcance_ob>='99.99'){$punto_rentabilidad=60;}
elseif($alcance_ob>='80.00' and $alcance_ob<='99.98'){$punto_rentabilidad=30;}
  else{$punto_rentabilidad=' ';}
$obj_merma=(($r->venta_mes)*.01);

if($obj_merma>$r->merma){$punto_merma=20;}else{$punto_merma='';}
    if($r->venta_mes<='80000'){$obj_gastos='3500';}
elseif($r->venta_mes>='80001' and $r->venta_mes<='120000'){$obj_gastos='4000';}
  else{$obj_gastos='4500';}
if($obj_gastos>=$r->gastos_operativos){$punto_gastos=10;}else{$punto_gastos='';}

if($r->eval_suc>=80){$punto_eval_suc=10;}else{$punto_eval_suc=' ';}

$suma_puntos=$punto_rentabilidad+$punto_merma+$punto_gastos+$punto_eval_suc;

$dif_al_punto_de_equilibrio=$r->venta_mes-($r->punto_equilibrio);
if($dif_al_punto_de_equilibrio>8000 and $suma_puntos>=80){
        $comision=(($r->venta_mes)*.02);
        $comi_far=(($r->venta_mes)*.015);
        $comi_sup=(($r->venta_mes)*.003);
        $comi_ger=(($r->venta_mes)*.0015);
        $comi_nac=(($r->venta_mes)*.0005);
    }else{
        $comision=0;
        $comi_far=0;
        $comi_sup=0;
        $comi_ger=0;
        $comi_nac=0;
        }

$tabla.="

<tr>
<td>$num</td>
<td>$r->regional</td>
<td>$r->superv</td>
<td>$r->suc</td>
<td>$r->sucx</td>
<td>".number_format($r->costo_venta,2)."</td>
<td>".number_format($r->renta,2)."</td>
<td>".number_format($r->nomina,2)."</td>
<td>".number_format($r->insumos,2)."</td>
<td>".number_format($r->agua,2)."</td>
<td>".number_format($r->luz,2)."</td>
<td>".number_format($r->tel,2)."</td>
<td>".number_format($r->otros,2)."</td>
<td>".number_format($r->gastos_oficina,2)."</td>
<td>".number_format($r->punto_equilibrio,2)."</td>
<td>".number_format($r->objetivo_100,2)."</td>
<td>".number_format($r->nivel_surtido,5)."</td>
<td>".number_format($r->objetivo_mes,2)."</td>
<td>".number_format($r->venta_mes,2)."</td>
<td>".number_format($utilidad,2)."</td>
<td>".number_format($alcance_ob,2)."</td>
<td>".$punto_rentabilidad."</td>
<td>".number_format($obj_merma,2)."</td>
<td>".number_format($r->merma,2)."</td>
<td>".$punto_merma."</td>
<td>".number_format($obj_gastos,2)."</td>
<td>".number_format($r->gastos_operativos,2)."</td>
<td>".$punto_gastos."</td>
<td>".number_format($r->eval_suc,2)."</td>
<td>".$punto_eval_suc."</td>
<td>".$suma_puntos."</td>
<td>".number_format($comision,2)."</td>
<td>".number_format($comi_far,2)."</td>
<td>".number_format($comi_sup,2)."</td>
<td>".number_format($comi_ger,2)."</td>
<td>".number_format($comi_nac,2)."</td>

</tr>
";
$t1=$t1+$comision;
if($comision>0){
    $suc_comisionadas=$suc_comisionadas+1;
$s="insert ignore into prenomina.comision_c(comision, aaa, mes, suc, puntos, farmacia, superv, regional, nacional,sup,reg)
(select 'DESEMPENO',$aaa,$mes,$r->suc,$suma_puntos,'$comi_far','$comi_sup','$comi_ger','$comi_nac',$r->superv,$r->regional)";
$this->db->query($s);
}
}
$s1="insert ignore into prenomina.comision_d(id_comision, suc, cia, nomina, clave, importe)
(SELECT a.id_comision,a.suc,b.cia,b.nomina,144,
round((a.farmacia/

((SELECT count(*) from  catalogo.cat_empleado x where x.succ= a.suc and x.tipo=1 and 
trim(x.puestox) not in('MEDICO') and x.fechaalta<='$fec_alta' group by x.succ)-
ifnull((select 1 from catalogo.cat_alta_empleado xx
where xx.motivo='RETENCION' and xx.fecha_i<'$fec' and xx.empleado=b.nomina and xx.id_causa<>7 and xx.activo=1),0))


),2)
FROM prenomina.comision_c a,catalogo.cat_empleado b
where a.suc=b.succ and b.tipo=1
and trim(puestox) not in('MEDICO') and fechaalta<='$fec_alta'
and aaa=$aaa and mes=$mes and activo=0 and 
(select 1 from catalogo.cat_alta_empleado xx
where xx.motivo='RETENCION' and xx.fecha_i<'$fec' and xx.empleado=b.nomina and xx.id_causa<>7 and xx.activo=1)is null
)";
$this->db->query($s1);
$s2="insert ignore into prenomina.comision_d(id_comision, suc, cia, nomina, clave, importe)
(SELECT a.id_comision,a.suc,b.cia,b.nomina,144,a.superv FROM prenomina.comision_c a, compras.usuarios b
where a.sup=b.id_plaza and b.nivel=13 and b.tipo=1 and aaa=$aaa and mes=$mes and activo=0)";
$this->db->query($s2);
$s3="insert ignore into prenomina.comision_d(id_comision, suc, cia, nomina, clave, importe)
(SELECT a.id_comision,a.suc,b.cia,b.nomina,144,a.regional FROM prenomina.comision_c a, compras.usuarios b
where a.reg=b.id_plaza and b.nivel=12 and b.tipo=1 and aaa=$aaa and mes=$mes and activo=0)";
$this->db->query($s3);
$s4="insert ignore into prenomina.comision_d(id_comision, suc, cia, nomina, clave, importe)
(SELECT a.id_comision,a.suc,b.cia,b.nomina,144,a.nacional FROM prenomina.comision_c a, compras.usuarios b
where b.id_plaza=1 and b.nivel=11 and b.tipo=1 and aaa=$aaa and mes=$mes and activo=0)";
$this->db->query($s4);
$tabla.="
<tr>
<td colspan=\"31\" align=\"right\"><strong>TOTAL DE SUCURSALES CON COMISION ".number_format($suc_comisionadas,0)." __</strong></td>
<td colspan=\"1\" align=\"right\"><strong>".number_format($t1,2)."</strong></td>
</tr>
</table>";
echo $tabla;
} 
    

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function ins_insentivo_ctl($aaa,$mes,$comision,$comision1)
{
//die();
$s1 = "delete from prenomina.comision_detalle_paso";
$this->db->query($s1);
                            ////////////////////////////////////////////////////////////////Solo balsedrina
$s2 = "insert ignore into prenomina.comision_detalle_paso(fecha, suc, tic, can, nomina, cod,sec,insentivo)
(select b.fecha,b.suc,b.tiket,can,b.nomina,a.codigo,sec,case when sec in(154) then 1 else 2 end
from catalogo.almacen a
join vtadc.venta_detalle b on b.codigo=a.codigo
join catalogo.sucursal c  on c.suc=b.suc and c.tipo3 in('DA','FA')
where sec in(975,154) and tsec<>'M' and tventa=1 and year(fecha)=$aaa and month(fecha)=$mes)";
$this->db->query($s2);
$s3 = "insert ignore into prenomina.comision_detalle_paso(fecha, suc, tic, can, nomina, cod,sec,insentivo)
(select b.fecha,b.suc,b.tic,cann,b.nomina,b.cod,sec,case when sec=154 then 1 else 2 end
from catalogo.almacen a
join vtadc.vta_backoffice b on b.cod=a.codigo
join catalogo.sucursal c  on c.suc=b.suc and c.tipo3 in('FE')
where sec in(975,154) and vtatip=1 and tsec<>'M' and vtatip=1 and year(fecha)=$aaa and month(fecha)=$mes)";
$this->db->query($s3);
$s2xx = "insert ignore into prenomina.comision_detalle_paso(fecha, suc, tic, can, nomina, cod,sec,insentivo)
(select b.fecha,b.suc,b.tiket,can,b.nomina,a.codigo,sec,10
from catalogo.almacen a
join vtadc.venta_detalle b on b.codigo=a.codigo
join catalogo.sucursal c  on c.suc=b.suc and c.tipo3 in('DA','FA')
where sec in(90) and tsec<>'M' and tventa=1 and year(fecha)=$aaa and month(fecha)=$mes)";
$this->db->query($s2xx);
                                ///////////////////////////////////////////////////////////////solo caseinato


$s5 = "insert ignore into prenomina.comision_c(comision, aaa, mes, suc, puntos, farmacia, superv, regional, nacional, activo, fecpre, sup, reg, tic_nopago)
(select
'$comision',year(fecha),month(fecha),a.suc,0,0,0,0,0,0,'0000-00-00',superv,regional,' '
from prenomina.comision_detalle_paso a
join catalogo.sucursal c  on c.suc=a.suc and c.tipo3 in('FA','DA','FE')
where   a.sec in(154,975) and year(fecha)=$aaa and month(fecha)=$mes
group by a.suc)";
$this->db->query($s5);
$s5 = "insert ignore into prenomina.comision_c(comision, aaa, mes, suc, puntos, farmacia, superv, regional, nacional, activo, fecpre, sup, reg, tic_nopago)
(select
'$comision1',year(fecha),month(fecha),a.suc,0,0,0,0,0,0,'0000-00-00',superv,regional,' '
from prenomina.comision_detalle_paso a
join catalogo.sucursal c  on c.suc=a.suc and c.tipo3 in('FA','DA','FE')
where   a.sec=90 and year(fecha)=$aaa and month(fecha)=$mes
group by a.suc)";
//$this->db->query($s5);

$s9="update  prenomina.comision_detalle_paso a
set
nomina=case when nomina = 5889 then 79761
when nomina = 61436 then 79762
when nomina = 64165 then 79763
when nomina = 14145 then 79764
when nomina = 52206 then 79765
when nomina = 79724 then 79766
when nomina = 17973 then 79767
end
where nomina in(5889,61436,64165,14145,52206,79724,17973)";
$this->db->query($s9);




$s10="insert ignore into prenomina.comision_d(id_comision, suc, cia, nomina, clave, importe, activo)
(SELECT a.id_comision,
a.suc,
ifnull((select cia from catalogo.cat_empleado x where x.nomina=b.nomina and x.tipo=1),0)as cia,
nomina,
144,
sum(can*insentivo)as imp,0

FROM prenomina.comision_c a
join prenomina.comision_detalle_paso b  on b.suc=a.suc and year(fecha)=a.aaa and month(fecha)=a.mes
where b.sec<>90 and can>0 and a.comision='$comision' and aaa=$aaa and mes=$mes
group by aaa,mes,a.id_comision,a.suc,b.nomina
order by mes,suc)";
$this->db->query($s10);

$s11="insert ignore into prenomina.comision_d(id_comision, suc, cia, nomina, clave, importe, activo)
(SELECT a.id_comision,
a.suc,
ifnull((select cia from catalogo.cat_empleado x where x.nomina=b.nomina and x.tipo=1),0)as cia,
nomina,
150,
sum(can*insentivo)as imp,0

FROM prenomina.comision_c a
join prenomina.comision_detalle_paso b  on b.suc=a.suc and year(fecha)=a.aaa and month(fecha)=a.mes
where b.sec=90 and can>0 and a.comision='$comision1' and aaa=$aaa and mes=$mes
group by aaa,mes,a.id_comision,a.suc,b.nomina
order by mes,suc)";
//$this->db->query($s11);
$s11="insert ignore into prenomina.comision_detalle_his(fecha, suc, tic, can, nomina, cod, sec, insentivo,fecha_generado)
(SELECT fecha, suc, tic, can, nomina, cod, sec, insentivo, now() FROM prenomina.comision_detalle_paso)";
$this->db->query($s11);

}
  






}