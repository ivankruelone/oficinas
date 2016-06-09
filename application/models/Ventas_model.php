<?php
class Ventas_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
function suc_evaluadas($aaa,$mes)
{

$s="SELECT
sum(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros)as gasto ,
(sum(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros)*.4) as gasto_40,

(SELECT count(*)as num
FROM oficinas.pianel_sucursal a
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('FE','DA','FA')
group by a.aaa,a.mes)as num,


round(((sum(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros)*.4)/
(SELECT count(*)as num
FROM oficinas.pianel_sucursal a
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('FE','DA','FA')
group by a.aaa,a.mes)),2)as monto

FROM oficinas.pianel_sucursal a
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('AN','OF','CE',' ')
group by a.aaa,a.mes
";
$q=$this->db->query($s);
if($q->num_rows()>0){
    $r=$q->row();
    $monto=$r->monto;    
}else{
    $monto=0;
}

return $monto;
  
} 
function suc_evaluadas_datos($aaa,$mes)
{

$s="SELECT
sum(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros)as gasto ,
(sum(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros)*.4) as gasto_40,

(SELECT count(*)as num
FROM oficinas.pianel_sucursal a
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('FE','DA','FA')
group by a.aaa,a.mes)as num,


round(((sum(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros)*.4)/
(SELECT count(*)as num
FROM oficinas.pianel_sucursal a
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('FE','DA','FA')
group by a.aaa,a.mes)),2)as monto

FROM oficinas.pianel_sucursal a
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('AN','OF','CE',' ')
group by a.aaa,a.mes
";
$q=$this->db->query($s);
return $q;
} 
    
    public function ventas_aaa_mes($tipo3,$aaa)
    {
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
    $aaa_a=$aaa-1;
    if($nivel==12){$var='regional='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var='';}
    $s="SELECT tipo3,c.mes as mesx,a.mes,
case when tipo3='DA' then 'DOCTOR AHORRO' when tipo3='FE' then 'FENIX' when tipo3='FA' then 'FARMABODEGA' end as imagen,
sum(a.a2012)as a2012,sum(a.a2013)as a2013,sum(a.a2014)as a2014,sum(a.a2015)as a2015,sum(a.a2016)as a2016,

(select count(*) From cortes_resp.cortes_venta_diaria_mes x join catalogo.sucursal z on z.suc=x.suc
where 
$var x.mes=a.mes and  z.tipo3=b.tipo3  and fecha_act='0000-00-00' and tlid=1 or 
$var x.mes=a.mes and  z.tipo3=b.tipo3  and date_format(fecha_act,'%Y-%m')>=concat(case when a.mes> month(now())then $aaa_a else $aaa end,'-',case when a.mes<=9 then concat('0',a.mes) else a.mes end)
)as num_suc

FROM
cortes_resp.cortes_venta_diaria_mes a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=a.mes
where 
$var tipo3 in('$tipo3') and tlid=1 and fecha_act='0000-00-00' or
$var tipo3 in('$tipo3') and date_format(fecha_act,'%Y-%m')>=concat(case when a.mes > month(now())then $aaa_a else $aaa end,'-',case when a.mes<=9 then concat('0',a.mes) else a.mes end)

group by tipo3,a.mes";
    $q=$this->db->query($s);
    return $q;
    
    }
    
    function graficaAnio($tipo, $nombre,$aaa)
    {
        $this->load->model('grafica');
        $this->load->library('Multidata');
        
        $cat = array();
        $arregloA = array();
        $arregloB = array();
        $arregloC = array();
        $query = $this->ventas_aaa_mes($tipo,$aaa);
        foreach($query->result() as $row)
        {
            array_push($cat,$row->mesx);
            array_push($arregloA,$row->a2015);
            array_push($arregloB,$row->a2014);
           
        }
        
        
        $a = new Multidata();
       $a->agrega($cat, '2015', $arregloA, '2014', $arregloB);
        
        $fuente = $this->grafica->multi('VENTAS COMPARATIVAS', utf8_encode('2015'), 'Meses', '$ Pesos', 2, 0, $a->retorno());
        $json   = $this->grafica->chart('msline', $nombre, '1100', '400', $fuente);
        
        
        
        return $json;
    }
public function ventas_aaa_mes_det($aaa,$mes,$tipo3,$monto)
    {
     $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
    $aaa_a=$aaa-1;
    if($nivel==12){$var='regional='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var='';}
    $s="SELECT fecha_act,tipo3,c.mes as mesx,a.mes,a.suc,b.nombre as sucx,
case when tipo3='DA' then 'DOCTOR AHORRO' when tipo3='FE' then 'FENIX' when tipo3='FA' then 'FARMABODEGA' end as imagen,
sum(a2012)as a2012,sum(a2013)as a2013,sum(a2014)as a2014,sum(a2015)as a2015,sum(a2016)as a2016

FROM
cortes_resp.cortes_venta_diaria_mes a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=a.mes
where 
$var tipo3 in('$tipo3') and a.mes=$mes  and fecha_act='0000-00-00' and tlid=1 or
$var tipo3 in('$tipo3') and a.mes=$mes  and date_format(fecha_act,'%Y-%m')>=concat(case when $mes> month(now())then $aaa_a else $aaa end,'-',case when a.mes<=9 then concat('0',a.mes) else a.mes end)
group by tipo3,a.mes,a.suc
order by suc";

    $q=$this->db->query($s);
    return $q;
    
    } 
 

function evaluacion_porce_det0($aaa,$mes)
{
$s="SELECT a.aaa,a.mes,'DOCTOR AHORRO' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('DA')
group by a.aaa,a.mes
union all
SELECT a.aaa,a.mes,'FENIX' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('FE')
group by a.aaa,a.mes
union all
SELECT a.aaa,a.mes,'FARMABODEGA' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('FA')
group by a.aaa,a.mes

union all
SELECT a.aaa,a.mes,'SUC CERRADAS O MAL APLICADAS' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('CE','AN',' ')
group by a.aaa,a.mes

union all
SELECT a.aaa,a.mes,'OFICINAS' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('OF')
group by a.aaa,a.mes
union all
SELECT a.aaa,a.mes,'SUC FRANQUICIAS O CEROS' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('FR')
group by a.aaa,a.mes
union all
SELECT a.aaa,a.mes,'SEGURO POPULAR' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('SE')
group by a.aaa,a.mes
union all
SELECT a.aaa,a.mes,'MODULOS' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('MO')
group by a.aaa,a.mes
union all
SELECT a.aaa,a.mes,'GLOBAL CAPS' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa and a.mes=$mes
and a.tipo3 in('LA')
group by a.aaa,a.mes
";
$q=$this->db->query($s);
return $q;
}
function evaluacion_porce_det1($var,$monto,$aaa,$mes)
{
 $s="SELECT
case when fecha_act<>'0000-00-00' then concat(trim(b.nombre),' ',trim(fecha_act)) else trim(b.nombre) end as sucx,
a.suc,a.tipo3,a.venta,
(a.renta+a.nomina+a.isr_nomina+a.insumos+a.dev+a.agua+a.luz+a.tel+a.otros)as gastos,
(((a.renta+a.nomina+a.isr_nomina+a.insumos+a.dev+a.agua+a.luz+a.tel+a.otros)/a.venta)*100)as porg_gastos,
((a.venta)-(a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.dev+a.agua+a.luz+a.tel+a.otros))as utilidad,
ifnull(100-((((a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.dev+a.agua+a.luz+a.tel+a.otros)/a.venta)*100)),-100)as por_utilidad,

ifnull(100-((((a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.dev+a.agua+a.luz+a.tel+a.otros+'$monto')/a.venta)*100)),-100)as por_utilidad_pror,

ifnull(((costo_venta/venta)*100),0)por_costo_venta,
ifnull((((a.renTA)/venta)*100),0)por_renta,
ifnull((((a.nomina+isr_nomina)/venta)*100),0)por_nomina,
ifnull((((a.insumos+dev+agua+luz+tel+otros)/venta)*100),0)por_gastos,
(a.venta)as venta,
(a.costo_venta)as costo_venta,
(a.renta)as renta,

(a.nomina)as nomina,
(a.isr_nomina)as isr_nomina,
(a.insumos)as insumos,
(a.dev)as dev,
(a.agua)as agua,
(a.luz)as luz,
(a.tel)as tel,
(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa and a.mes=$mes
and a.tipo3 in($var)
order by por_utilidad desc";
 $q=$this->db->query($s);
return $q;
}
   
function graficaAnio_det_compara($mes,$tipo,$monto,$nombre)
    {
        $this->load->model('grafica');
        $this->load->library('Multidata');
        
        $cat = array();
        $arregloA = array();
        $arregloB = array();
        $arregloC = array();
        $query = $this->ventas_aaa_mes_det($mes,$tipo,$monto,$nombre);
        foreach($query->result() as $row)
        {
            array_push($cat,$row->mesx);
            array_push($arregloA,$row->a2015);
            array_push($arregloB,$row->mes_ant);
        }
        $a = new Multidata();
        
        $a->agrega($cat, 'Utilidad', $arregloA, 'Utilidad con 40% de gastos de oficinas', $arregloB);
        
        $fuente = $this->grafica->multi('UTILIDAD DE FARMACIAS', utf8_encode(date('Y')), 'Meses', '$ Pesos', 2, 1, $a->retorno());
        //print_r($a->retorno());
        //die();
    return $json1;

    }       
function nivel_surtido_far($aaa,$mes)
{
 $s="select round(avg(farmacia),2)as nivel_surtido
from oficinas.nivel_surtido where year(fecha)=2015 and month(fecha)=6";
$q=$this->db->query($s);
$r=$q->row();
$nivel=$r->nivel_surtido;
return $nivel;   
}
function estadistica_ventas_nac($mes,$aaa,$vta,$gas,$inv,$util,$mer,$nivel_sur,$monto,$tipo3)
{
$nivel_sur=($nivel_sur/100);
$s="select a.tipo3,
b.regional as reg,
(select nombre from compras.usuarios x where x.id_plaza=b.regional and x.nivel=12 and tipo=1 group by id_plaza)as regx,
b.superv,
(select nombre from compras.usuarios x where x.id_plaza=b.superv and x.nivel=13 and tipo=1 group by id_plaza)as supervx,
a.suc,b.nombre as sucx,

(a.venta*.001) as obj_dev, 
a.dev,
((a.dev/a.venta)*100)as por_dev,
case when ((a.dev/a.venta)*100)>'.01' then ' ' else $mer end resul_dev,

(venta*.05)obj_gas,
a.insumos,a.agua, a.luz, a.tel, a.otros,a.renta, (a.nomina+a.isr_nomina)as nomina,
(a.insumos+a.agua+a.luz+a.tel+a.otros+a.renta+a.nomina+a.isr_nomina)as tot_gas,
(((a.insumos+a.agua+a.luz+a.tel+a.otros+a.renta+a.nomina+a.isr_nomina)/venta)*100)as por_gas,
case when (((a.insumos+a.agua+a.luz+a.tel+a.otros+a.renta+a.nomina+a.isr_nomina)/venta)*100)<5
then $gas else ' ' end as resul_gas,

a.venta,c.prome,(c.prome*($nivel_sur))as ob_abas,
ifnull((((a.venta)/(c.prome*($nivel_sur)))*100),0)as alcance,
((a.venta*$vta)/(c.prome*($nivel_sur)))as resul_ven,

a.venta,a.costo_venta,
(a.renta+a.nomina+a.isr_nomina+a.insumos+a.agua+a.dev+a.luz+a.tel+a.otros+$monto)as gastos,
(a.venta-(a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.agua+a.dev+a.luz+a.tel+a.otros+'$monto'))as utilidad,
(((a.venta-(a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.agua+a.dev+a.luz+a.tel+a.otros+'$monto'))/a.venta)*100)as por_util,
case when (((a.venta-(a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.agua+a.dev+a.luz+a.tel+a.otros+'$monto'))/a.venta)*100)>10
then $util else ' 'end as resul_util,

(SELECT sum(cantidad*p_cos)
FROM desarrollo.inv x
join catalogo.costo_ponderado_prome y on y.sec=x.sec
where x.mov=7 and x.cantidad>0 and x.suc=a.suc
group by x.suc)as costo_inv

from oficinas.pianel_sucursal a
join catalogo.sucursal b on b.suc=a.suc and b.regional>90 and b.superv>0
left join cortes_resp.cortes_venta_diaria_mes c on c.suc=a.suc and c.mes=a.mes
where
a.aaa=$aaa and a.mes=$mes and a.tipo3='$tipo3' and venta>0 or
a.aaa=$aaa and a.mes=$mes and a.tipo3='$tipo3' and tlid=1
order by b.superv,b.suc";
$q=$this->db->query($s);
foreach ($q->result() as $r) {
    $a[$r->superv]['superv']=$r->superv;
    $a[$r->superv]['supervx']=$r->supervx;
    $a[$r->superv]['d'][$r->suc]['superv']=$r->superv;
    $a[$r->superv]['d'][$r->suc]['supervx']=$r->supervx;
    $a[$r->superv]['d'][$r->suc]['reg']=$r->reg;
    $a[$r->superv]['d'][$r->suc]['regx']=$r->regx;
    $a[$r->superv]['d'][$r->suc]['tipo3']=$r->tipo3;
    $a[$r->superv]['d'][$r->suc]['suc']=$r->suc;
    $a[$r->superv]['d'][$r->suc]['sucx']=$r->sucx;
    $a[$r->superv]['d'][$r->suc]['obj_gas']=$r->obj_gas;
    $a[$r->superv]['d'][$r->suc]['agua']=$r->agua;
    $a[$r->superv]['d'][$r->suc]['luz']=$r->luz;
    $a[$r->superv]['d'][$r->suc]['tel']=$r->tel;
    $a[$r->superv]['d'][$r->suc]['insumos']=$r->insumos;
    $a[$r->superv]['d'][$r->suc]['otros']=$r->otros;
    $a[$r->superv]['d'][$r->suc]['renta']=$r->renta;
    $a[$r->superv]['d'][$r->suc]['nomina']=$r->nomina;
    $a[$r->superv]['d'][$r->suc]['tot_gas']=$r->tot_gas;
    $a[$r->superv]['d'][$r->suc]['por_gas']=$r->por_gas;
    $a[$r->superv]['d'][$r->suc]['resul_gas']=$r->resul_gas;
    $a[$r->superv]['d'][$r->suc]['obj_dev']=$r->obj_dev;
    $a[$r->superv]['d'][$r->suc]['dev']=$r->dev;
    $a[$r->superv]['d'][$r->suc]['por_dev']=$r->por_dev;
    $a[$r->superv]['d'][$r->suc]['resul_dev']=$r->resul_dev;
    $a[$r->superv]['d'][$r->suc]['prome']=$r->prome;
    $a[$r->superv]['d'][$r->suc]['ob_abas']=$r->ob_abas;
    $a[$r->superv]['d'][$r->suc]['alcance']=$r->alcance;
    $a[$r->superv]['d'][$r->suc]['resul_ven']=$r->resul_ven;
    $a[$r->superv]['d'][$r->suc]['costo_venta']=$r->costo_venta;
    $a[$r->superv]['d'][$r->suc]['gastos']=$r->gastos;
    $a[$r->superv]['d'][$r->suc]['utilidad']=$r->utilidad;
    $a[$r->superv]['d'][$r->suc]['por_util']=$r->por_util;
    $a[$r->superv]['d'][$r->suc]['resul_util']=$r->resul_util;
    $a[$r->superv]['d'][$r->suc]['costo_inv']=$r->costo_inv;
    $a[$r->superv]['d'][$r->suc]['venta']=$r->venta;
}
return $a;    
}
////////////////////////////////////////////////////////////////////////////////////////////////// 
 public function s_ventas_captura_diaria_nac()
    {
 $s="SELECT fecha_vta,b.tipo3,c.nombre as imagen,DAYOFWEEK(fecha_vta),
sum(ticket)as tic, sum(vta_servicio)as vta_servicio,sum(vta_contado)as vta_contado, sum(vta_credito)as vta_credito,sum(vta_contado+vta_credito+vta_servicio)as vta_total,
sum(vta_contado+vta_credito+vta_servicio)/sum(ticket)as prome,
case
when DAYOFWEEK(fecha_vta)=1 then 'DOMINGO'
when DAYOFWEEK(fecha_vta)=2 then 'LUNES'
when DAYOFWEEK(fecha_vta)=3 then 'MARTES'
when DAYOFWEEK(fecha_vta)=4 then 'MIERCOLES'
when DAYOFWEEK(fecha_vta)=5 then 'JUEVES'
when DAYOFWEEK(fecha_vta)=6 then 'VIERNES'
when DAYOFWEEK(fecha_vta)=7 then 'SABADO'
else ' ' end as nom_dia
FROM vtadc.vta_captura_diaria a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_imagen c on c.tipo=b.tipo3
where fecha_vta>=subdate(date(now()),7) and fecha_vta<=date(now()) and a.activo=1
group by DAYOFWEEK(fecha_vta),b.tipo3
order by fecha_vta desc,b.tipo3
";
 $q=$this->db->query($s);   
 foreach ($q->result()as $r)
        {
        $a[$r->fecha_vta]['fecha_vta'] = $r->fecha_vta;
        $a[$r->fecha_vta]['nom_dia'] = $r->nom_dia;
        $a[$r->fecha_vta]['d'][$r->tipo3]['tipo2'] = $r->tipo3;
        $a[$r->fecha_vta]['d'][$r->tipo3]['imagen'] = $r->imagen;
        $a[$r->fecha_vta]['d'][$r->tipo3]['tic'] = $r->tic;
        $a[$r->fecha_vta]['d'][$r->tipo3]['vta_credito'] = $r->vta_credito;
        $a[$r->fecha_vta]['d'][$r->tipo3]['vta_contado'] = $r->vta_contado;
        $a[$r->fecha_vta]['d'][$r->tipo3]['vta_servicio'] = $r->vta_servicio;
        $a[$r->fecha_vta]['d'][$r->tipo3]['vta_total'] = $r->vta_total;
        $a[$r->fecha_vta]['d'][$r->tipo3]['prome'] = $r->prome;
        }

     return $a;
 
    }
public function s_no_captura()
    {
 $s="SELECT ifnull(d.nombre,' ') as regionalx,ifnull(c.nombre,' ') as supervisorx,tipo2,a.suc,a.nombre,a.obser 
 from  catalogo.sucursal a
left join vtadc.vta_captura_diaria b on b.suc=a.suc and b.fecha_vta= (date(now())-1) and b.activo=1 and ticket>0
left join compras.usuarios c on c.id_plaza=a.superv and c.tipo=1 and c.nivel=13
left join compras.usuarios d on d.id_plaza=a.regional and c.tipo=1 and d.nivel=12
where  a.tlid=1 and  a.suc>100 and a.suc<=1999 and b.suc is null and a.suc not in(176,177,178,179,180,181,187)
and fecha_act='0000-00-00'
group by fecha_vta,a.suc";
$q = $this->db->query($s);
return $q; 
    }
function ventas_acumuladas_excel($mes, $aaa)
    {
        $sql = "SELECT DAY(FECHA_VTA)as d_num, CONCAT(DAY(FECHA_VTA),'-',substr(mes,1,10))as fecha,day(fecha_vta)as dia,
sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)as con,
sum(vta_credito)as cre,sum(vta_servicio)as ser,sum(ticket)as tic,
(select count(*) from vtadc.vta_captura_diaria_suc x where x.fecha_vta=a.fecha_vta and x.tipo3=c.tipo3)as num_suc
FROM vtadc.vta_captura_diaria a
join catalogo.mes b on b.num=month(fecha_vta)
join catalogo.sucursal c on c.suc=a.suc and tipo3='DA'
where
year(fecha_vta)=$aaa and month(fecha_vta)=$mes and day(fecha_vta)>0 and 
  fecha_vta<=subdate(date(now()),1) and activo=1
GROUP BY fecha_vta
order by fecha_vta";

        return $this->db->query($sql);
    }
function ventas_acumuladas_excel_cortes($mes, $aaa)
    {
    $fec1=$aaa.'-'.str_pad($mes,'0',STR_PAD_RIGHT).'-01';


        $sql = "select DAY(fechacorte)as d_num,b.tipo3,CONCAT(DAY(fechacorte),'-',substr(c.mes,1,10))as fechacorte,count(a.suc)as num_suc,
(select count(*) from catalogo.sucursal x where x.tlid=1 and dia<>'cer'and x.tipo3=b.tipo3)as hab,
sum(turno1_pesos+turno2_pesos+turno3_pesos+turno4_pesos+turno1_mn+turno2_mn+turno3_mn+turno4_mn)as pesos,
sum(turno1_san+turno2_san+turno3_san+turno4_san+turno1_bbv+turno2_bbv+turno3_bbv+turno4_bbv)as tar,
sum(turno1_vale+turno2_vale+turno3_vale+turno4_vale)as val,
sum(turno1_fal+turno2_fal+turno3_fal+turno4_fal)as fal,
sum(turno1_sob+turno2_sob+turno3_sob+turno4_sob)as sob,
(select sum(corregido) from
desarrollo.cortes_c x
join desarrollo.cortes_d y on y.id_cc=x.id  and y.clave1 in(40,30)
join catalogo.sucursal z on z.suc=x.suc
where tlid=1 and fecha_act='0000-00-00' and z.tipo3=b.tipo3 and fechacorte=a.fechacorte)as credito,

(select sum(corregido) from
desarrollo.cortes_c x
join desarrollo.cortes_d y on y.id_cc=x.id  and y.clave1 in(20)
join catalogo.sucursal z on z.suc=x.suc
where tlid=1 and fecha_act='0000-00-00' and z.tipo3=b.tipo3 and fechacorte=a.fechacorte)as recarga


from desarrollo.cortes_c a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=month(fechacorte)
where fechacorte between '$fec1' and subdate(date(now()),1)and tipo3='DA'
group by tipo3,a.fechacorte
order by a.fechacorte";

        return $this->db->query($sql);
    }
function ventas_correo($qq)
{
$actual=$qq->row();
$up="update cortes_resp.cortes_venta_diaria a, desarrollo.cortes_c b
set cortes_banco15=(turno1_pesos+turno2_pesos+turno1_mn+turno1_sob-turno1_fal)
 where a.suc=b.suc and a.dia=day(fechacorte) and a.mes=month(fechacorte) and  year(b.fechacorte)=year((now()))";
$this->db->query($up);
$sa="SELECT a.fecha_vta,b.tipo2,b.tipo3,case when b.tipo3='FE'then 'FENIX' when b.tipo3='DA'then 'DOCTOR.AHORRO' when b.tipo3='FA'then 'FARMABODEGA' else '' end as imagen,DAYOFWEEK(a.fecha_vta),
sum(ticket)as tic, 
sum(vta_servicio)as vta_servicio,
sum(case when fecha_vta>'2015-03-10' 
then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)as vta_contado,
sum(vta_credito)as vta_credito,

sum(vta_credito+vta_contado+val+tar+con_usd+fal-sob)as vta_total,
sum(vta_credito+vta_contado+val+tar+con_usd+fal-sob)/sum(ticket)as prome,


case
when DAYOFWEEK(a.fecha_vta)=1 then 'DOMINGO'
when DAYOFWEEK(a.fecha_vta)=2 then 'LUNES'
when DAYOFWEEK(a.fecha_vta)=3 then 'MARTES'
when DAYOFWEEK(a.fecha_vta)=4 then 'MIERCOLES'
when DAYOFWEEK(a.fecha_vta)=5 then 'JUEVES'
when DAYOFWEEK(a.fecha_vta)=6 then 'VIERNES'
when DAYOFWEEK(a.fecha_vta)=7 then 'SABADO'
else ' ' end as nom_dia,
(select count(*) from vtadc.vta_captura_diaria_suc c
where c.fecha_vta=a.fecha_vta and c.tipo3=b.tipo3 group by c.fecha_vta, c.tipo3) as suc_cap,

(select count(*) from catalogo.sucursal m where m.tipo3=b.tipo3 and dia<>'CER' and tlid=1)as num_suc,
(select count(*) from catalogo.sucursal where tipo3 in ('FA','DA','FE') and dia<>'CER' and tlid=1)as num_suc_total
FROM vtadc.vta_captura_diaria a
left join catalogo.sucursal b on b.suc=a.suc

where a.fecha_vta>=subdate(date(now()),3) and a.fecha_vta < date(now()) and a.activo=1 and b.tipo3 in('FA','FE','DA')
group by DAYOFWEEK(a.fecha_vta),b.tipo3
order by a.fecha_vta desc,b.tipo3

";
$q=$this->db->query($sa);
$lidia="<table border='1' celpadding='2'>";

$lidia.=$this->_acumulado_mes($actual->aaa_act,$actual->mes_act,$actual->mes_actx);

$num=0;$num_suc=0;$suc_cap=0;$tic=0;$vta_contado=0;$vta_credito=0;$vta_servicio=0;$vta_total=0;$prome=0;
 foreach ($q->result()as $r)
        {
$num_suc=$num_suc+$r->num_suc;
$suc_cap=$suc_cap+$r->suc_cap;
$tic=$tic+$r->tic;
$vta_contado=$vta_contado+$r->vta_contado;
$vta_credito=$vta_credito+$r->vta_credito;
$vta_servicio=$vta_servicio+$r->vta_servicio;
$vta_total=$vta_total+$r->vta_total;

 $num=$num+1;
if($num==1){
$lidia.="
 <tr bgcolor=\"#B2DAFD\">
 <td colspan=\"8\">.</td>
 </tr>
 <tr bgcolor=\"#B2DAFD\">
 <td colspan=\"8\">.</td>
 </tr>
<tr>
<th colspan=\"8\">".$r->nom_dia."</th>
</tr>
<tr bgcolor=\"#B2DAFD\">
    <th style=\"color: blue;\">".$r->fecha_vta."</th>
    <th style=\"color: blue;\">Sucursal</th>
    <th style=\"color: blue;\">Ticket</th>
    <th style=\"color: blue;\">Vta Contado</th>
    <th style=\"color: blue;\">Vta Credito</th>
    <th style=\"color: blue;\">Vta Servicio</th>
    <th style=\"color: blue;\">Vta Total</th>
    <th style=\"color: blue;\">Prom.por Ticket</th>
 </tr>
<tr>
    <td style=\"color: blue;\">".$r->imagen."</td>
    <td style=\"color: gray;\">".$r->num_suc."/".$r->suc_cap."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->tic,0)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_contado,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_credito,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_servicio,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_total,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->prome,2)."</td>
 </tr>";
}
if($num==2){
$lidia.="
<tr>
    <td style=\"color: blue;\">".$r->imagen."</td>
    <td style=\"color: gray;\">".$r->num_suc."/".$r->suc_cap."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->tic,0)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_contado,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_credito,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_servicio,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_total,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->prome,2)."</td>
 </tr>";
}
if($num==3){
$lidia.="
<tr>
    <td style=\"color: blue;\">".$r->imagen."</td>
    <td style=\"color: gray;\">".$r->num_suc."/".$r->suc_cap."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->tic,0)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_contado,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_credito,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_servicio,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_total,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->prome,2)."</td>
 </tr>";
$lidia.="
<tr>
    <td><strong>TOTAL".$r->nom_dia."</strong></td>
    <td><strong>".$num_suc."/".$suc_cap."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($tic,0)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_contado,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_credito,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_servicio,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_total,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($prome,2)."</strong></td>
 </tr>";
$num_suc=0;$suc_cap=0;$tic=0;$vta_contado=0;$vta_credito=0;$vta_servicio=0;$vta_total=0;$prome=0;
}

 
if($num==4){
$lidia.="
<tr>
<th colspan=\"8\">".$r->nom_dia."</th>
</tr>
<tr bgcolor=\"#B2DAFD\">
    <th style=\"color: blue;\">".$r->fecha_vta."</th>
    <th style=\"color: blue;\">Sucursal</th>
    <th style=\"color: blue;\">Ticket</th>
    <th style=\"color: blue;\">Vta Contado</th>
    <th style=\"color: blue;\">Vta Credito</th>
    <th style=\"color: blue;\">Vta Servicio</th>
    <th style=\"color: blue;\">Vta Total</th>
    <th style=\"color: blue;\">Prom.por Ticket</th>
 </tr>
<tr>
    <td style=\"color: blue;\">".$r->imagen."</td>
    <td style=\"color: gray;\">".$r->num_suc."/".$r->suc_cap."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->tic,0)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_contado,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_credito,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_servicio,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_total,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->prome,2)."</td>
 </tr>";
}
if($num==5){
$lidia.="
<tr>
    <td style=\"color: blue;\">".$r->imagen."</td>
    <td style=\"color: gray;\">".$r->num_suc."/".$r->suc_cap."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->tic,0)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_contado,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_credito,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_servicio,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_total,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->prome,2)."</td>
 </tr>";
}
if($num==6){
$lidia.="
<tr>
    <td style=\"color: blue;\">".$r->imagen."</td>
    <td style=\"color: gray;\">".$r->num_suc."/".$r->suc_cap."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->tic,0)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_contado,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_credito,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_servicio,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_total,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->prome,2)."</td>
 </tr>";
$lidia.="
<tr>
    <td><strong>TOTAL".$r->nom_dia."</strong></td>
    <td><strong>".$num_suc."/".$suc_cap."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($tic,0)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_contado,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_credito,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_servicio,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_total,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($prome,2)."</strong></td>
 </tr>";
$num_suc=0;$suc_cap=0;$tic=0;$vta_contado=0;$vta_credito=0;$vta_servicio=0;$vta_total=0;$prome=0;
}
if($num==7){
$lidia.="
<tr>
<th colspan=\"8\">".$r->nom_dia."</th>
</tr>
<tr bgcolor=\"#B2DAFD\">
    <th style=\"color: blue;\">".$r->fecha_vta."</th>
    <th style=\"color: blue;\">Sucursal</th>
    <th style=\"color: blue;\">Ticket</th>
    <th style=\"color: blue;\">Vta Contado</th>
    <th style=\"color: blue;\">Vta Credito</th>
    <th style=\"color: blue;\">Vta Servicio</th>
    <th style=\"color: blue;\">Vta Total</th>
    <th style=\"color: blue;\">Prom.por Ticket</th>
 </tr>
<tr>
    <td style=\"color: blue;\">".$r->imagen."</td>
    <td style=\"color: gray;\">".$r->num_suc."/".$r->suc_cap."</td>
    <td style=\"text-align: right;\">".number_format($r->tic,0)."</td>
    <td style=\"text-align: right;\">".number_format($r->vta_contado,2)."</td>
    <td style=\"text-align: right;\">".number_format($r->vta_credito,2)."</td>
    <td style=\"text-align: right;\">".number_format($r->vta_servicio,2)."</td>
    <td style=\"text-align: right;\">".number_format($r->vta_total,2)."</td>
    <td style=\"text-align: right;\">".number_format($r->prome,2)."</td>
 </tr>";
}
if($num==8){
$lidia.="
<tr>
    <td style=\"color: blue;\">".$r->imagen."</td>
    <td style=\"color: gray;\">".$r->num_suc."/".$r->suc_cap."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->tic,0)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_contado,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_credito,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_servicio,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_total,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->prome,2)."</td>
 </tr>";
}
if($num==9){
$lidia.="
<tr>
    <td style=\"color: blue;\">".$r->imagen."</td>
    <td style=\"color: gray;\">".$r->num_suc."/".$r->suc_cap."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->tic,0)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_contado,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_credito,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_servicio,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_total,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->prome,2)."</td>
 </tr>";
$lidia.="
<tr>
    <td><strong>TOTAL ".$r->nom_dia."</strong></td>
    <td><strong>".$num_suc."/".$suc_cap."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($tic,0)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_contado,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_credito,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_servicio,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_total,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($prome,2)."</strong></td>
 </tr>
 <tr bgcolor=\"#B2DAFD\">
 <td colspan=\"8\">.</td>
 </tr>
 <tr bgcolor=\"#B2DAFD\">
 <td colspan=\"8\">.</td>
 </tr>";
$num_suc=0;$suc_cap=0;$tic=0;$vta_contado=0;$vta_credito=0;$vta_servicio=0;$vta_total=0;$prome=0;
}
}
$lidia.=$this->_acumulado_mes($actual->aaa_ant,$actual->mes_ant,$actual->mes_antx);
$lidia.="

</table>";

return $lidia;   
}


function _acumulado_mes($aaa,$mes,$mesx)
{
    $s="SELECT month(a.fecha_vta)as mes,c.mes as mesx,b.tipo2,b.tipo3,case when b.tipo3='FE'then 'FENIX' when b.tipo3='DA'then 'DOCTOR.AHORRO' when b.tipo3='FA'then 'FARMABODEGA' else '' end as imagen,
sum(ticket)as tic,
sum(vta_servicio)as vta_servicio,
sum(case when fecha_vta>'2015-03-10'
then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)as vta_contado,
sum(vta_credito)as vta_credito,

sum(vta_credito+vta_contado+val+tar+con_usd+fal-sob)as vta_total,
sum(vta_credito+vta_contado+val+tar+con_usd+fal-sob)/sum(ticket)as prome,


(select count(*) from vtadc.vta_captura_diaria_suc c
where c.fecha_vta=a.fecha_vta and c.tipo3=b.tipo3 group by c.fecha_vta, c.tipo3) as suc_cap,

(select count(*) from catalogo.sucursal m where m.tipo3=b.tipo3 and dia<>'CER' and tlid=1)as num_suc,
(select count(*) from catalogo.sucursal where tipo3 in ('FA','DA','FE') and dia<>'CER' and tlid=1)as num_suc_total
FROM vtadc.vta_captura_diaria a
left join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=month(a.fecha_vta)

where year(a.fecha_vta)=$aaa and month(a.fecha_vta)=$mes and a.activo=1 and b.tipo3 in('FA','FE','DA')
group by month(a.fecha_vta),b.tipo3
order by b.tipo3";
$q=$this->db->query($s);
$li="
<tr>
<th colspan=\"8\"> ACUMULADO DEL MES DE ".$mesx."</th>
</tr>
<tr bgcolor=\"#B2DAFD\">
    <th style=\"color: blue;\"></th>
    <th style=\"color: blue;\">Sucursal</th>
    <th style=\"color: blue;\">Ticket</th>
    <th style=\"color: blue;\">Vta Contado</th>
    <th style=\"color: blue;\">Vta Credito</th>
    <th style=\"color: blue;\">Vta Servicio</th>
    <th style=\"color: blue;\">Vta Total</th>
    <th style=\"color: blue;\">Prom.por Ticket</th>
 </tr>
";
$num_suc=0;$suc_cap=0;$tic=0;$vta_contado=0;$vta_credito=0;$vta_servicio=0;$vta_total=0;$prome=0;
foreach($q->result()as $r)
{
    $li.="
<tr>
    <td style=\"color: blue;\">".$r->imagen."</td>
    <td style=\"color: gray;\">".$r->num_suc."/".$r->suc_cap."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->tic,0)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_contado,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_credito,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_servicio,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->vta_total,2)."</td>
    <td style=\"text-align: right; color: gray;\">".number_format($r->prome,2)."</td>
 </tr>";
$num_suc=$num_suc+$r->num_suc;
$suc_cap=$suc_cap+$r->suc_cap;
$tic=$tic+$r->tic;
$vta_contado=$vta_contado+$r->vta_contado;
$vta_credito=$vta_credito+$r->vta_credito;
$vta_servicio=$vta_servicio+$r->vta_servicio;
$vta_total=$vta_total+$r->vta_total;
}
$li.="
<tr>
    <td><strong>TOTAL DEL MES</strong></td>
    <td><strong>".$num_suc."/".$suc_cap."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($tic,0)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_contado,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_credito,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_servicio,2)."</strong></td>
    <td style=\"text-align: right;\"><strong>".number_format($vta_total,2)."</strong></td>
    <td style=\"text-align: right;\"></td>
 </tr>
";
return $li;
}
/////////////////////////////////////////////////////////////////////////////////////////////////GERENTE NACIONAL
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
 /////////////////////////////////////////////////////////////////////////////////////////////////REGIONAL
function ventas_suc_captura($suc)
 {
    $s="SELECT a.*,b.nombre as sucx FROM vtadc.vta_captura_diaria a 
        join catalogo.sucursal b on b.suc=a.suc 
        where a.suc=$suc and a.fecha_vta between subdate(date(now()),15) and subdate(date(now()),1)
        and activo in(1,5)
        order by a.fecha_vta desc";
    $q=$this->db->query($s);
    return $q;
 }
 function depositos_suc_captura($suc)
 {
    $s="SELECT a.*,b.nombre as sucx FROM vtadc.vta_captura_diaria_deposito a
        join catalogo.sucursal b on b.suc=a.suc
        where a.suc=$suc and a.fecha_ficha between subdate(date(now()),15) and subdate(date(now()),1)
        and activo in(1,5)
        order by a.fecha_ficha desc,a.fecha_venta desc";
    $q=$this->db->query($s);
    return $q;
 }
 
  public function venta_zona_dia($id_plaza)
    {

 $s="select regional,superv,concat('ZONA ',superv)as zona,count(suc)as tot_suc
from catalogo.sucursal
where 
tlid=1 and fecha_act='0000-00-00' and superv>0 and superv<80 and regional=$id_plaza or
tlid=1 and fecha_act='0000-00-00' and superv>0 and superv<80 and superv=$id_plaza
group by regional,superv";
$a=$this->db->query($s);
 return $a;   
    }
 public function venta_ctl_sup($aaa,$mes,$id_plaza)
 {
 $sf="select a.superv,b.mes,b.dia,a.suc,a.nombre,max(b.dia)as max_dia,

sum(ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn),0))as pesos,

sum(ifnull((turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv),0))as tar,

sum(ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn+turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv),0))as total,

(sum(ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn),0))-
sum(ifnull(corregido,0)))as tot_sin_recarga,

sum(ifnull(corregido,0))as recarga
from catalogo.sucursal a
left join catalogo.dia_mes b on b.mes=$mes
left join desarrollo.cortes_c c on c.suc=a.suc and month(fechacorte)=b.mes and day(fechacorte)=b.dia  and year(fechacorte)=$aaa
left join desarrollo.cortes_d d on d.id_cc=c.id and clave1=20
where  
tlid=1 and tipo3<>' ' and b.mes=$mes and a.regional=$id_plaza or
tlid=1 and tipo3<>' ' and b.mes=$mes and a.superv=$id_plaza
group by suc
order by a.superv,a.tipo3,a.suc,b.dia
";
$qf=$this->db->query($sf);
return $qf;
 }
 
  public function venta_ctl_det($aaa,$mes,$id_plaza)
 {
$s="select a.superv,b.mes,b.dia,a.suc,a.nombre,

ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn),0)as pesos,

ifnull((turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv),0)as tar,

ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn+turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv),0)as total,

(ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn+turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv),0)-
ifnull(corregido,0))as tot_sin_recarga,

ifnull(corregido,0)as recarga

from catalogo.sucursal a
left join catalogo.dia_mes b on b.mes=$mes
left join desarrollo.cortes_c c on c.suc=a.suc and month(fechacorte)=b.mes and day(fechacorte)=b.dia and  year(fechacorte)=$aaa
left join desarrollo.cortes_d d on d.id_cc=c.id and clave1=20
where  
tlid=1 and tipo3<>' ' and b.mes=$mes and a.regional=$id_plaza or
tlid=1 and tipo3<>' ' and b.mes=$mes and a.superv=$id_plaza
order by a.superv,a.tipo3,a.suc,b.dia
";
 $q=$this->db->query($s);
 
 foreach ($q->result()as $r)
        {
        $a[$r->dia]['su'] = $r->suc;
        $a[$r->dia]['d'][$r->suc]['suc'] = $r->suc;
        $a[$r->dia]['d'][$r->suc]['dia'] = $r->dia;
        $a[$r->dia]['d'][$r->suc]['pesos'] = $r->pesos;
        $a[$r->dia]['d'][$r->suc]['tar'] = $r->tar;
        $a[$r->dia]['d'][$r->suc]['total'] = $r->total;
        $a[$r->dia]['d'][$r->suc]['tot_sin_recarga'] = $r->tot_sin_recarga;
        $a[$r->dia]['d'][$r->suc]['recarga'] = $r->recarga;
        } 
return $a;
 }

public function ventas_aaa_mes_ger($tipo3,$id_plaza)
    {
        $nivel=$this->session->userdata('nivel');
        if($nivel==12){$var='regional='.$id_plaza.' and ';}
        elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var=' ';}
    $s="SELECT tipo3,c.mes as mesx,a.mes,
case when tipo3='DA' then 'DOCTOR AHORRO' when tipo3='FE' then 'FENIX' when tipo3='FA' then 'FARMABODEGA' end as imagen,
sum(a2012)as a2012,sum(a2013)as a2013,sum(a2014)as a2014,sum(a2015)as a2015
FROM
cortes_resp.cortes_venta_diaria a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=a.mes
where $var tipo3 in('$tipo3') and year(fecha_act) in(0000,year(date(now()))) and month(fecha_act) in('00',a.mes)
group by tipo3,a.mes";
    $q=$this->db->query($s);
    return $q;
    
    } 
 public function ventas_aaa_mes_det_ger($mes,$tipo3,$monto,$id_plaza)
    {
        $nivel=$this->session->userdata('nivel');
        if($nivel==12){$var='regional='.$id_plaza.' and ';}
        elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var=' ';}
    $s="SELECT fecha_act , tipo3,c.mes as mesx,a.mes,a.suc,b.nombre as sucx,
case when tipo3='DA' then 'DOCTOR AHORRO' when tipo3='FE' then 'FENIX' when tipo3='FA' then 'FARMABODEGA' end as imagen,
sum(a2012)as a2012,sum(a2013)as a2013,sum(a2014)as a2014,sum(a2015)as a2015,
sum(a.prome)as prome, ifnull(((sum(a2015)/sum(prome))*100),0)as alcance,

ifnull((SELECT round(avg(farmacia),2)
FROM oficinas.nivel_surtido where year(fecha)=year(date(now())) and month(fecha)=a.mes
group by month(fecha)),0)as nivel_surtido,

ifnull((sum(a.prome)*(SELECT (round(avg(farmacia),2)/100)
FROM oficinas.nivel_surtido where year(fecha)=year(date(now())) and month(fecha)=a.mes
group by month(fecha))),0)as prome_surtido,

ifnull(((sum(a2015)/
ifnull((sum(a.prome)*(SELECT (round(avg(farmacia),2)/100)
FROM oficinas.nivel_surtido where year(fecha)=year(date(now())) and month(fecha)=a.mes
group by month(fecha))),0))*100),0)as alcance_surtido,

(select sum(a2015) from cortes_resp.cortes_venta_diaria x where x.suc=a.suc and x.mes=(a.mes-1) group by x.suc)as mes_ant,

(select (venta-(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros+($monto)))
From oficinas.pianel_sucursal x where x.aaa=year(date(now())) and x.mes=a.mes and x.suc=a.suc)as utilidad,

((select (((venta-(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros+($monto)))/venta)*100)
From oficinas.pianel_sucursal x where x.aaa=year(date(now())) and x.mes=a.mes and x.suc=a.suc))as por_util

FROM
cortes_resp.cortes_venta_diaria a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=a.mes
where $var tipo3 in('$tipo3') and a.mes=$mes and  a2015>0 
group by tipo3,a.mes,a.suc
order by fecha_act,por_util desc ";
    $q=$this->db->query($s);
    return $q;
    
    }

function estadistica_ventas_reg($id_plaza,$mes,$aaa,$vta,$gas,$inv,$util,$mer,$nivel_sur,$monto,$tipo3)
{
$nivel_sur=($nivel_sur/100);
$s="select a.tipo3,fecha_act,
b.regional as reg,
(select nombre from compras.usuarios x where x.id_plaza=b.regional and x.nivel=12 and tipo=1 group by id_plaza)as regx,
b.superv,
(select nombre from compras.usuarios x where x.id_plaza=b.superv and x.nivel=13 and tipo=1 group by id_plaza)as supervx,
a.suc,b.nombre as sucx,

(a.venta*.001) as obj_dev, 
a.dev,
((a.dev/a.venta)*100)as por_dev,
case when ((a.dev/a.venta)*100)>'.01' then ' ' else $mer end resul_dev,

(venta*.05)obj_gas,
a.insumos,a.agua, a.luz, a.tel, a.otros,a.renta, (a.nomina+a.isr_nomina)as nomina,
(a.insumos+a.agua+a.luz+a.tel+a.otros+a.renta+a.nomina+a.isr_nomina)as tot_gas,
(((a.insumos+a.agua+a.luz+a.tel+a.otros+a.renta+a.nomina+a.isr_nomina)/venta)*100)as por_gas,
case when (((a.insumos+a.agua+a.luz+a.tel+a.otros+a.renta+a.nomina+a.isr_nomina)/venta)*100)<5
then $gas else ' ' end as resul_gas,

a.venta,c.prome,(c.prome*($nivel_sur))as ob_abas,
ifnull((((a.venta)/(c.prome*($nivel_sur)))*100),0)as alcance,
((a.venta*$vta)/(c.prome*($nivel_sur)))as resul_ven,

a.venta,a.costo_venta,
(a.renta+a.nomina+a.isr_nomina+a.insumos+a.agua+a.dev+a.luz+a.tel+a.otros+$monto)as gastos,
(a.venta-(a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.agua+a.dev+a.luz+a.tel+a.otros+'$monto'))as utilidad,
(((a.venta-(a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.agua+a.dev+a.luz+a.tel+a.otros+'$monto'))/a.venta)*100)as por_util,
case when (((a.venta-(a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.agua+a.dev+a.luz+a.tel+a.otros+'$monto'))/a.venta)*100)>10
then $util else ' 'end as resul_util,

(SELECT sum(cantidad*p_cos)
FROM desarrollo.inv x
join catalogo.costo_ponderado_prome y on y.sec=x.sec
where x.mov=7 and x.cantidad>0 and x.suc=a.suc
group by x.suc)as costo_inv

from oficinas.pianel_sucursal a
join catalogo.sucursal b on b.suc=a.suc and b.regional>90 and b.superv>0
left join cortes_resp.cortes_venta_diaria_mes c on c.suc=a.suc and c.mes=a.mes
where
a.aaa=$aaa and a.mes=$mes and a.tipo3='$tipo3' and venta>0 and regional=$id_plaza or
a.aaa=$aaa and a.mes=$mes and a.tipo3='$tipo3' and tlid=1 and regional=$id_plaza or
a.aaa=$aaa and a.mes=$mes and a.tipo3='$tipo3' and venta>0 and superv=$id_plaza or
a.aaa=$aaa and a.mes=$mes and a.tipo3='$tipo3' and tlid=1 and superv=$id_plaza

order by b.superv,b.suc";

$q=$this->db->query($s);
foreach ($q->result() as $r) {
    $a[$r->superv]['superv']=$r->superv;
    $a[$r->superv]['supervx']=$r->supervx;
    $a[$r->superv]['d'][$r->suc]['superv']=$r->superv;
    $a[$r->superv]['d'][$r->suc]['supervx']=$r->supervx;
    $a[$r->superv]['d'][$r->suc]['reg']=$r->reg;
    $a[$r->superv]['d'][$r->suc]['regx']=$r->regx;
    $a[$r->superv]['d'][$r->suc]['tipo3']=$r->tipo3;
    $a[$r->superv]['d'][$r->suc]['suc']=$r->suc;
    $a[$r->superv]['d'][$r->suc]['sucx']=$r->sucx;
    $a[$r->superv]['d'][$r->suc]['obj_gas']=$r->obj_gas;
    $a[$r->superv]['d'][$r->suc]['agua']=$r->agua;
    $a[$r->superv]['d'][$r->suc]['luz']=$r->luz;
    $a[$r->superv]['d'][$r->suc]['tel']=$r->tel;
    $a[$r->superv]['d'][$r->suc]['insumos']=$r->insumos;
    $a[$r->superv]['d'][$r->suc]['otros']=$r->otros;
    $a[$r->superv]['d'][$r->suc]['renta']=$r->renta;
    $a[$r->superv]['d'][$r->suc]['nomina']=$r->nomina;
    $a[$r->superv]['d'][$r->suc]['tot_gas']=$r->tot_gas;
    $a[$r->superv]['d'][$r->suc]['por_gas']=$r->por_gas;
    $a[$r->superv]['d'][$r->suc]['resul_gas']=$r->resul_gas;
    $a[$r->superv]['d'][$r->suc]['obj_dev']=$r->obj_dev;
    $a[$r->superv]['d'][$r->suc]['dev']=$r->dev;
    $a[$r->superv]['d'][$r->suc]['por_dev']=$r->por_dev;
    $a[$r->superv]['d'][$r->suc]['resul_dev']=$r->resul_dev;
    $a[$r->superv]['d'][$r->suc]['prome']=$r->prome;
    $a[$r->superv]['d'][$r->suc]['ob_abas']=$r->ob_abas;
    $a[$r->superv]['d'][$r->suc]['alcance']=$r->alcance;
    $a[$r->superv]['d'][$r->suc]['resul_ven']=$r->resul_ven;
    $a[$r->superv]['d'][$r->suc]['costo_venta']=$r->costo_venta;
    $a[$r->superv]['d'][$r->suc]['gastos']=$r->gastos;
    $a[$r->superv]['d'][$r->suc]['utilidad']=$r->utilidad;
    $a[$r->superv]['d'][$r->suc]['por_util']=$r->por_util;
    $a[$r->superv]['d'][$r->suc]['resul_util']=$r->resul_util;
    $a[$r->superv]['d'][$r->suc]['costo_inv']=$r->costo_inv;
    $a[$r->superv]['d'][$r->suc]['venta']=$r->venta;
}
return $a;    
}

function descuentos_mes()
{
    $s="select case when c.num<=month(date(now())) then year(date(now())) else (year(date(now()))-1) end as aaa, c.num,c.mes from catalogo.mes c ";
$q=$this->db->query($s);
return $q;
}
function descuentos_mes_sup($id_plaza)
{
    $s="select a.superv,
(select nombre from compras.usuarios x where x.id_plaza=a.superv and x.tipo=1 group by id_plaza)as supervx, count(*)as num_suc
From catalogo.sucursal a
where
 regional=$id_plaza and a.superv>0 or
 a.superv=$id_plaza and a.superv>0
group by superv order by superv";
$q=$this->db->query($s);
return $q;
}
function descuentos_mes_sup_excel($aaa,$id_plaza,$mes)
{
    $s="select a.superv as ZONA ,a.suc as NID,a.nombre as SUCURSAL,b.fecha AS FECHA ,tiket AS TICKET,
codigo AS CODIGO,descri AS DESCRIPCION,can AS PIEZAS, (can*vta)AS SUBTOTAL,(can*des)AS DESCUENTO,tarjeta AS FOL_TARJETA,b.tipo AS TIPO,d.nombre as TARJETA,b.nomina AS NOMINA
From catalogo.sucursal a
join vtadc.venta_detalle b on a.suc=b.suc
join catalogo.mes c on c.num=month(b.fecha)
join catalogo.cat_tarjetas d on d.num=b.tipo
where
year(b.fecha)=$aaa and b.des>0 and a.superv>0 and month(b.fecha)=$mes and superv=$id_plaza";
$q=$this->db->query($s);
return $q;
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
/////////////////////////////////////////////////////////////////////////////////////////////////REGIONAL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function ventas_comparativas_his_nac($tipo3)
    {
 $s="SELECT b.tipo3,a.mes,c.mes as mesx,sum(prome)as prome,sum(a2015)as a2015,((sum(a2015)/sum(prome))*100)as porce
FROM cortes_resp.cortes_venta_diaria a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=a.mes
where  tlid=1 and tipo3='$tipo3'
 group by tipo3,a.mes";
 $a=$this->db->query($s);
 return $a;   
    }
public function ventas_comparativas_his_det_nac($mes,$tipo3)
    {
 $s="SELECT a.suc,b.nombre as sucx,a.mes,c.mes as mesx,sum(prome)as prome,sum(a2015)as a2015,((sum(a2015)/sum(prome))*100)as porce
FROM cortes_resp.cortes_venta_diaria a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=a.mes
where  tlid=1 and tipo3='$tipo3' and a.mes=$mes
 group by a.suc";
 $a=$this->db->query($s);
 return $a;   
    }
 
 
 
 function topedia($mes)
 {
 if($mes==date('m')){$tope=date('d')-1;}else{
$s="select *from catalogo.mes where num=$mes";
$q=$this->db->query($s);
$r=$q->row();    
 $tope=$r->dos;
 }
 return $tope;   
 }
 public function clientes_mes()
    {
 $s="select a.num,a.mes as mesx,sum(imp)as imp
from catalogo.mes a,vtadc.vta_backoffice_credito b
where date_format(b.fecha,'%Y')=year(now()) and date_format(b.fecha,'%m')=a.num and num<=month(now()) and vtatip=71
group by date_format(b.fecha,'%Y'),date_format(b.fecha,'%m')";
 $a=$this->db->query($s);
 return $a;   
    }
  public function clientes_mes_det($num)
    {
 $s="select date_format(b.fecha,'%d')as dia,b.suc,c.nombre as sucx,fecha,lin,sum(imp)as imp
from vtadc.vta_backoffice_credito b
left join catalogo.sucursal c on c.suc=b.suc
where date_format(b.fecha,'%Y')=year(now()) and date_format(b.fecha,'%m')=$num and vtatip=71
group by b.suc,lin,fecha";
    $q=$this->db->query($s);
foreach ($q->result()as $r)
        {
        $a[$r->suc]['suc'] = $r->suc;
        $a[$r->suc]['sucx'] = $r->sucx;
        $a[$r->suc]['segundo'][$r->lin]['fecha'] = $r->fecha;
        $a[$r->suc]['segundo'][$r->lin]['lin'] = $r->lin;
        $a[$r->suc]['segundo'][$r->lin]['tercero'][$r->dia]['dia'] = $r->dia;
        $a[$r->suc]['segundo'][$r->lin]['tercero'][$r->dia]['imp'] = $r->imp;
        }
 return $a;   
    }
    
 function venta_tic_det($aaa,$mes)
    {
        $s = "select a.suc,b.nombre,sum(a.tic)as tic,(round(sum(a.tic)/85)+1)as rollos 
        From vtadc.venta_ctl a
        join catalogo.sucursal b on b.suc=a.suc
        where year(a.fecha)=$aaa and  month(a.fecha)=$mes and tlid=1
        group by a.suc";
        $q = $this->db->query($s);
        return $q;
    }

public function ticket_mes_suc()
    {
    $id_plaza=$this->session->userdata('id_plaza');
    $nivel=$this->session->userdata('nivel');
    $aaa=date('Y');
    $aaa_a=$aaa-1;
    if($nivel==12){$var='regional='.$id_plaza.' and ';}
    elseif($nivel==13){$var='superv='.$id_plaza.' and ';}else{$var='';}
    $s="select
year(date(now())) AS AAA,a.suc AS NID,a.nombre AS SUCURSAL,
ifnull((select sum(tic_contado) from vtadc.venta_ctl x where x.suc=a.suc and fecha between '$aaa-01-01' and '$aaa-01-31'),0)as ENE,
ifnull((select sum(tic_contado) from vtadc.venta_ctl x where x.suc=a.suc and fecha between '$aaa-02-01' and '$aaa-02-29'),0)as FEB,
ifnull((select sum(tic_contado) from vtadc.venta_ctl x where x.suc=a.suc and fecha between '$aaa-03-01' and '$aaa-03-31'),0)as MAR,
ifnull((select sum(tic_contado) from vtadc.venta_ctl x where x.suc=a.suc and fecha between '$aaa-04-01' and '$aaa-04-30'),0)as ABR,
ifnull((select sum(tic_contado) from vtadc.venta_ctl x where x.suc=a.suc and fecha between '$aaa-05-01' and '$aaa-05-31'),0)as MAY,
ifnull((select sum(tic_contado) from vtadc.venta_ctl x where x.suc=a.suc and fecha between '$aaa-06-01' and '$aaa-06-30'),0)as JUN,
ifnull((select sum(tic_contado) from vtadc.venta_ctl x where x.suc=a.suc and fecha between '$aaa-07-01' and '$aaa-07-31'),0)as JUL,
ifnull((select sum(tic_contado) from vtadc.venta_ctl x where x.suc=a.suc and fecha between '$aaa-08-01' and '$aaa-08-31'),0)as AGO,
ifnull((select sum(tic_contado) from vtadc.venta_ctl x where x.suc=a.suc and fecha between '$aaa-09-01' and '$aaa-09-30'),0)as SEP,
ifnull((select sum(tic_contado) from vtadc.venta_ctl x where x.suc=a.suc and fecha between '$aaa-10-01' and '$aaa-10-31'),0)as OCT,
ifnull((select sum(tic_contado) from vtadc.venta_ctl x where x.suc=a.suc and fecha between '$aaa-11-01' and '$aaa-11-30'),0)as NOV,
ifnull((select sum(tic_contado) from vtadc.venta_ctl x where x.suc=a.suc and fecha between '$aaa-12-01' and '$aaa-12-31'),0)as DIC
from catalogo.sucursal a
where $var tipo3 in('DA','FE','FA') AND tlid=1;";
    $q=$this->db->query($s);
    return $q;
    }

}