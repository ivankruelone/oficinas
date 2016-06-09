<?php
class Finanzas_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////pago mayoristas
function rentabilidad_farmacia($aaa,$tipo)
{
    
$s="SELECT a.tipo3,a.aaa,a.mes,b.mes as mesx,sum(venta)as venta,sum(costo_venta)as costo_venta, count(*)as num_suc,
sum(renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros)as gastos,
(sum(venta))-sum(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros) as utilidad,
(((sum(venta))-sum(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros))/sum(venta)*100) as p_utilidad,

(SELECT por_suc FROM finanzas.gasto_oficinas_suc x where x.aaa=a.aaa and x.mes=a.mes)as gas_x_suc,

sum(renta)as renta,
sum(nomina)as nomina, sum(isr_nomina)as isr_nomina,sum(insumos)as insumos,sum(dev)as dev,sum(luz)as luz,
sum(tel)as tel,sum(otros)as otros,

(SELECT monto FROM finanzas.gasto_oficinas_suc x where x.aaa=a.aaa and x.mes=a.mes)as gasto_oficina_tot

FROM oficinas.pianel_sucursal a
join catalogo.mes b on b.num=a.mes
where a.tipo3='$tipo' and a.aaa>=$aaa
group by a.aaa,a.mes";
$q=$this->db->query($s);
return $q;    
}
function rentabilidad_farmacia_grafica1($aaa,$tipo,$nombre)
    {
        $this->load->model('grafica');
        $this->load->library('Multidata');
        
        $cat = array();
        $arregloA = array();
        $arregloB = array();
        $arregloC = array();
        $query = $this->rentabilidad_farmacia($aaa,$tipo);
        foreach($query->result() as $row)
        {
            $mas_gasto=(($row->gas_x_suc)*($row->num_suc))+$row->gastos;
            $utilidad_40=$row->venta-(+$row->costo_venta+$mas_gasto);
            
            array_push($cat,$row->mesx);
            array_push($arregloA,$row->utilidad);
            array_push($arregloB,$utilidad_40);
        }
        $a = new Multidata();
        
        $a->agrega($cat, 'Utilidad', $arregloA, 'Utilidad con 40% de gastos de oficinas', $arregloB);
        
        $fuente = $this->grafica->multi('UTILIDAD DE FARMACIAS', utf8_encode($aaa), 'Meses', '$ Pesos', 2, 1, $a->retorno());
        $json1  = $this->grafica->chart('msline', $nombre, '1100', '300', $fuente);
        //print_r($a->retorno());
        //die();
    return $json1;

    }
    function rentabilidad_farmacia_grafica2($aaa,$tipo,$nombre)
    {
        $this->load->model('grafica');
        $this->load->library('Multidata');
        
        $cat = array();
        $arregloA = array();
        $arregloB = array();
        $arregloC = array();
        $p1=0;$p2=0;
        $query = $this->rentabilidad_farmacia($aaa,$tipo);
        foreach($query->result() as $row)
        {
            $mas_gasto=(($row->gas_x_suc)*($row->num_suc))+$row->gastos;
            $utilidad_40=$row->venta-(+$row->costo_venta+$mas_gasto);
            $p1=($row->utilidad/$row->venta)*100;
            $p2=($utilidad_40/$row->venta)*100;
            
            array_push($cat,$row->mesx);
            array_push($arregloA,number_format($p1,2));
            array_push($arregloB,number_format($p2,2));
        }
        $a = new Multidata();
        
        $a->agrega($cat, 'Utilidad', $arregloA, 'Utilidad con 40% de gastos de oficinas', $arregloB);
        
        $fuente = $this->grafica->multi('UTILIDAD DE FARMACIAS FACTOR VENTA MES', utf8_encode($aaa), 'Meses', '%', 2, 1, $a->retorno());
        $json2  = $this->grafica->chart('msline', $nombre, '1100', '300', $fuente);
        //print_r($a->retorno());
        //die();
    return $json2;

    }
    function rentabilidad_farmacia_grafica3($aaa,$tipo,$nombre)
    {
        $this->load->model('grafica');
        $this->load->library('Multidata');
        
        $cat = array();
        $arregloA = array();
        $arregloB = array();
        $arregloC = array();
        $query = $this->rentabilidad_farmacia($aaa,$tipo);
        foreach($query->result() as $row)
        {
            $mas_gasto=(($row->gas_x_suc)*($row->num_suc))+$row->gastos;
            $utilidad_40=$row->venta-(+$row->costo_venta+$mas_gasto);
            
            array_push($cat,$row->mesx);
            array_push($arregloA,($row->venta));
            array_push($arregloB,($row->gastos+$row->costo_venta));
        }
        $a = new Multidata();
        
        $a->agrega($cat, 'Ventas', $arregloA, 'GASTOS Y COSTO DE PRODUCTO', $arregloB);
        
        $fuente = $this->grafica->multi('VENTAS CONTRA GASTOS Y COSTO DE PRODUCTO', utf8_encode($aaa), 'Meses', '$ Pesos', 2, 3, $a->retorno());
        $json1  = $this->grafica->chart('msline', $nombre, '1100', '600', $fuente);
        //print_r($a->retorno());
        //die();
    return $json1;

    }
 function rentabilidad_farmacia_det($aaa,$mes,$tipo)
{
    
$s="SELECT a.tipo3,a.aaa,a.mes,a.suc,b.nombre as sucx,sum(venta)as venta,sum(costo_venta)as costo_venta, count(*)as num_suc,
sum(a.renta+a.nomina+a.isr_nomina+a.insumos+a.dev+a.agua+a.luz+a.tel+a.otros)as gastos,
(sum(a.venta))-sum(a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.dev+a.agua+a.luz+a.tel+a.otros) as utilidad,
(((sum(a.venta))-sum(a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.dev+a.agua+a.luz+a.tel+a.otros))/sum(a.venta)*100) as p_utilidad,

(SELECT por_suc FROM finanzas.gasto_oficinas_suc x where x.aaa=a.aaa and x.mes=a.mes)as gas_x_suc



FROM oficinas.pianel_sucursal a
join catalogo.sucursal b on b.suc=a.suc
where a.tipo3='$tipo' and a.aaa=$aaa and a.mes=$mes
group by a.aaa,a.mes,a.suc
order by utilidad desc";
$q=$this->db->query($s);
return $q;    
}
function rentabilidad_farmacia_grafica_det1($aaa,$mes,$tipo,$nombre)
    {
        $this->load->model('grafica');
        $this->load->library('Multidata');
        
        $cat = array();
        $arregloA = array();
        $arregloB = array();
        $arregloC = array();
        $p1=0;$p2=0;$num_util_40=0;$num_util=0;
        $query = $this->rentabilidad_farmacia_det($aaa,$mes,$tipo);
        foreach($query->result() as $row)
        {
            $mas_gasto=(($row->gas_x_suc)*($row->num_suc))+$row->gastos;
            $utilidad_40=$row->venta-(+$row->costo_venta+$mas_gasto);
            if($row->p_utilidad>=10){$num_util=$num_util+1;}else{$num_util=$num_util+0;}
            if($utilidad_40>=10){$num_util_40=$num_util_40+1;}else{$num_util_40=$num_util_40+0;}
            
            array_push($cat,'');
            array_push($arregloA,number_format($p1,2));
            array_push($arregloB,number_format($p2,2));
        }
        
        $a = new Multidata();
        $a->agregaData('Sucursales Mayor al 10 % de utilidad', $num_util);
        $a->agregaData('' , $num_util_40);
        
        $a->agrega($cat, 'Utilidad', $arregloA, 'Utilidad con 40% de gastos de oficinas', $arregloB);
        
        $fuente = $this->grafica->multi('UTILIDAD DE FARMACIAS FACTOR VENTA MES', utf8_encode($aaa), 'Meses', '%', 2, 1, $a->retorno());
        $json2  = $this->grafica->chart('column3d', $nombre, '1100', '300', $fuente);
        //print_r($a->retorno());
        //die();
    return $json1;

}
   
   function ventas_aaa6($tipo)
{
        $v1='a'.(date('Y')-5);$v2='a'.(date('Y')-4);$v3='a'.(date('Y')-3);
        $v4='a'.(date('Y')-2);$v5='a'.(date('Y')-1);$v6='a'.(date('Y'));    
$s="SELECT c.mes as mesx, a.suc,
concat(trim(b.nombre),' ', case when fecha_act<>'0000-00-00' then fecha_act else ' ' end) as sucx,
sum(a.$v1)as var1,sum(a.$v2)as var2,sum(a.$v3)as var3,sum(a.$v4)as var4,
sum(a.$v5)as var5,sum(a.$v6)as var6,
case 
when tipo3='DA' then 'DOCTOR AHORRO'
when tipo3='FE' then 'FENIX' 
when tipo3='DA' then 'FARMABODEGA'
end as tipox
FROM cortes_resp.cortes_venta_diaria a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=a.mes
where 
a.mes=month(date(now())) and tlid=1 and tipo3='$tipo' and fecha_act='0000-00-00' or

a.mes=month(date(now())) and tlid=1 and tipo3='$tipo' and fecha_act>=concat(year(date(now())),'-',month(date(now())),'-01')
group by a.suc
";
$q=$this->db->query($s);

//die();
return $q;    
} 
    
    
function grafica_venta_aaa6($tipo,$nombre)
    {
        $this->load->model('grafica');
        $this->load->library('data');
        $a = new Data(); 
        $var1=0;$var2=0;$var3=0;$var4=0;$var5=0;$var6=0;$mesx='';$tipox='';
        $v1=(date('Y')-5);$v2=(date('Y')-4);$v3=(date('Y')-3);
        $v4=(date('Y')-2);$v5=(date('Y')-1);$v6=(date('Y'));
        $query = $this->ventas_aaa6($tipo);
            foreach($query->result() as $row)
                {
                    $var1=$var1+$row->var1;
                    $var2=$var2+$row->var2;
                    $var3=$var3+$row->var3;
                    $var4=$var4+$row->var4;
                    $var5=$var5+$row->var5;
                    $var6=$var6+$row->var6;
                    $mesx=$row->mesx;
                    $tipox=$row->tipox;
                }
        $a->agregaData('VENTA ANUAL '.$v1 , $var1);
        $a->agregaData('VENTA ANUAL '.$v2 , $var2);
        $a->agregaData('VENTA ANUAL '.$v3 , $var3);
        $a->agregaData('VENTA ANUAL '.$v4 , $var4);
        $a->agregaData('VENTA ANUAL '.$v5 , $var5);
        $a->agregaData('VENTA ANUAL '.$v6 , $var6);
        $fuente = $this->grafica->fuente('COMPARATIVO DE VENTAS ANUALES', utf8_encode('DE ENERO A '.$mesx.' DE SUCURSALES '.$tipox), utf8_encode('Años'), '$ Pesos', 1, 1, $a->retornaData());
        $json1 = $this->grafica->chart('column3d', $nombre, '1100', '300', $fuente);
        
        return $json1;
    }
   function grafica_venta_aaa6_por($tipo,$nombre)
    {
        $this->load->model('grafica');
        $this->load->library('data');
        $a = new Data(); 
        $var1=0;$var2=0;$var3=0;$var4=0;$var5=0;$var6=0;$mesx='';$p1=0;$p2=0;$p3=0;$p4=0;$p5=0;$tipox='';
        $v1=(date('Y')-5);$v2=(date('Y')-4);$v3=(date('Y')-3);
        $v4=(date('Y')-2);$v5=(date('Y')-1);$v6=(date('Y'));
        $query = $this->ventas_aaa6($tipo);
            foreach($query->result() as $row)
                {
                    $var1=$var1+$row->var1;
                    $var2=$var2+$row->var2;
                    $var3=$var3+$row->var3;
                    $var4=$var4+$row->var4;
                    $var5=$var5+$row->var5;
                    $var6=$var6+$row->var6;
                    $mesx=$row->mesx;
                    $tipox=$row->tipox;
                }
                if($var1>0){$p1=((($var2-$var1)/$var1)*100);}
                if($var1>0){$p2=((($var3-$var1)/$var1)*100);}
                if($var1>0){$p3=((($var4-$var1)/$var1)*100);}
                if($var1>0){$p4=((($var5-$var1)/$var1)*100);}
                if($var1>0){$p5=((($var6-$var1)/$var1)*100);}
                
                
        $a->agregaData('VENTA ANUAL '.$v1.' CON '.$v2 , number_format($p1,2));
        $a->agregaData('VENTA ANUAL '.$v1.' CON '.$v3 , number_format($p2,2));
        $a->agregaData('VENTA ANUAL '.$v1.' CON '.$v4 , number_format($p3,2));
        $a->agregaData('VENTA ANUAL '.$v1.' CON '.$v5 , number_format($p4,2));
        $a->agregaData('VENTA ANUAL '.$v1.' CON '.$v6 , number_format($p5,2));
        
        $fuente = $this->grafica->fuente('COMPARATIVO DE VENTAS ANUALES EN %', utf8_encode('DE ENERO A '.$mesx.' DE SUCURSALES '.$tipox), utf8_encode('Años'), '% ', 1, 1, $a->retornaData());
        $json1 = $this->grafica->chart('column3d', $nombre, '1100', '300', $fuente);
        
        return $json1;
    }        
    
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
function objetivo_mes($tipo3,$var,$aaa,$mes,$aaa_a,$mes_a,$aaa_a2,$mes_a2)
{
    $s="select aa.suc,
((sum(aa.costo_venta+aa.renta+aa.nomina+aa.isr_nomina+aa.insumos+aa.agua+aa.luz+aa.tel+aa.otros+
(select por_suc from finanzas.gasto_oficinas_suc xx where xx.aaa=$aaa and xx.mes=$aaa)))*1.4)objetivo_100,

(((sum(aa.costo_venta+aa.renta+aa.nomina+aa.isr_nomina+aa.insumos+aa.agua+aa.luz+aa.tel+aa.otros+
(select por_suc from finanzas.gasto_oficinas_suc xx where xx.aaa=$aaa and xx.mes=$mes)))*1.4)*

ifnull((SELECT ((sum(abasto)/count(*))/100)
FROM oficinas.nivel_surtido_suc x, catalogo.sucursal z
where $var abasto>0 and x.suc=z.suc and x.suc=aa.suc and year(x.fecha)=$aaa and month(x.fecha)=$mes
group by month(fecha),superv),1))as objetivo_mes

 FROM oficinas.pianel_sucursal aa
join catalogo.sucursal b on b.suc=aa.suc
where $var
aa.aaa=$aaa_a2 and aa.mes=$mes_a2 and aa.tipo3='$tipo3' and year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes) and
(select count(*) from desarrollo.cortes_c m where m.suc=aa.suc and year(m.fechacorte)=$aaa and month(m.fechacorte)=$mes)>0
group by aa.suc";

$q=$this->db->query($s);
$objetivo_mes=0;
foreach($q->result()as $r)
{
$objetivo_mes=$objetivo_mes+$r->objetivo_mes;    
}
return $objetivo_mes;
}  
function objetivo_mes_suc($tipo3,$aaa,$mes,$aaa_a,$mes_a,$aaa_a2,$mes_a2,$suc)
{
    $s="select aa.suc,
((sum(aa.costo_venta+aa.renta+aa.nomina+aa.isr_nomina+aa.dev+aa.insumos+aa.agua+aa.luz+aa.tel+aa.otros+
(select por_suc from finanzas.gasto_oficinas_suc xx where xx.aaa=$aaa and xx.mes=$mes)))*1.4)objetivo_100,

(((sum(aa.costo_venta+aa.renta+aa.nomina+aa.isr_nomina+aa.dev+aa.insumos+aa.agua+aa.luz+aa.tel+aa.otros+
(select por_suc from finanzas.gasto_oficinas_suc xx where xx.aaa=aa.aaa and xx.mes=aa.mes)))*1.4)*

ifnull((SELECT ((sum(abasto)/count(*))/100)
FROM oficinas.nivel_surtido_suc x, catalogo.sucursal z
where abasto>0 and x.suc=z.suc and x.suc=aa.suc and year(x.fecha)=$aaa and month(x.fecha)=$mes
group by month(fecha),superv),1))as objetivo_mes


 FROM oficinas.pianel_sucursal aa
join catalogo.sucursal b on b.suc=aa.suc
where 
aa.aaa=$aaa_a2 and aa.mes=$mes_a2 and aa.tipo3='$tipo3' and year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes)
and aa.suc=$suc
group by aa.suc";
$q=$this->db->query($s);
$objetivo_mes=0;
foreach($q->result()as $r)
{
//$objetivo_100=$objetivo_100+$r->objetivo_100;
$objetivo_mes=$objetivo_mes+$r->objetivo_mes;    
}
return $objetivo_mes;
}     

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function proyeccion_v($aaa)
{
$s="select *from catalogo.mes where num between (case when $aaa=2015 then 8 else 1 end) and month(date(now())) or ((case when 2015=2015 then 12 else 12 end) and num = 12)";
//$s="select *from catalogo.mes where num between (case when $aaa =2015 then 8 else 1 end) and month(date(now()))";
$q=$this->db->query($s);
return $q;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function proyeccion_venta($tipo,$aaa,$mes)
{
$nivel=$this->session->userdata('nivel');
$id_plaza=$this->session->userdata('id_plaza');

if($nivel==13){$var='superv='.$id_plaza.' and ';}
elseif($nivel==12){$var='regional='.$id_plaza.' and ';}
else{$var='';}
$s="
select 'DIAS HABILES' as var, dos as valor  from catalogo.mes where num=$mes and month(date(now()))=$mes
union all
select 'DIAS TRANSCURRIDOS' as var, case when month(date(now())) > $mes then dos else  day(subdate(date(now()),1)) end as valor from catalogo.mes where num=$mes
union all
select 'DIAS RESTANTES' as var, case when month(date(now())) > $mes then dos else  dos-day(subdate(date(now()),1)) end as valor from catalogo.mes where num=$mes
union all
select concat('SUCURSALES ACTIVAS AL ',case when month(date(now()))>$mes then concat('$aaa-','$mes-',dos) else subdate(date(now()),1)  end) as var,count(*) From catalogo.sucursal a,catalogo.mes b
where $var
tipo3='$tipo' and num=$mes and fecha_act>=case when month(date(now()))>$mes then concat('$aaa-','$mes-',dos) else subdate(date(now()),1)  end
or
$var tipo3='$tipo' and num=$mes and fecha_act='0000-00-00'
union all
select 'SUCURSALES ACTIVAS EN EL MES' as var,count(*) as valor  From catalogo.sucursal
where $var year(fecha_act) in(0000,$aaa)  and month(fecha_act) in (00,$mes) and tipo3='$tipo'
";
    $q=$this->db->query($s);
    return $q;
}
function proyeccion_venta_dia($tipo,$aaa,$mes)
{
$nivel=$this->session->userdata('nivel');
$id_plaza=$this->session->userdata('id_plaza');
if($nivel==13){$var='superv='.$id_plaza.' and ';}
elseif($nivel==12){$var='regional='.$id_plaza.' and ';}
else{$var='';}
    $s="
select 'VENTA ACUMULADA'as var, sum(siniva)as venta_acumulada ,

(sum(siniva)/max(day(fechacorte)))as prome_venta,

(((round((select dos from catalogo.mes xx where xx.num=month(a.fechacorte)))-
(day(max(a.fechacorte))*1))*round((sum(siniva)/max(day(fechacorte))),2))+sum(siniva))as proyeccion_mes_act

from desarrollo.cortes_c a
join catalogo.sucursal b on b.suc=a.suc
join desarrollo.cortes_d c on c.id_cc=a.id
where $var year(fechacorte)=$aaa and month(fechacorte)=$mes and fechacorte<=subdate(date(now()),1) and 
tipo3='$tipo' and c.clave1 not in(0,20,30,40,49)
";

    $q=$this->db->query($s);
    return $q;
}
function proyeccion_venta_dif($tipo,$aaa,$mes,$aaa_a,$mes_a,$aaa_a2,$mes_a2)
{
$nivel=$this->session->userdata('nivel');
$id_plaza=$this->session->userdata('id_plaza');
if($nivel==13){$var='superv='.$id_plaza.' and ';}
elseif($nivel==12){$var='regional='.$id_plaza.' and ';}
else{$var='';}
    $aaa_ant=$aaa-1;
$objetivo_mes=$this->objetivo_mes($tipo,$var,$aaa,$mes,$aaa_a,$mes_a,$aaa_a2,$mes_a2);

    $s="select sum(siniva)as venta,
(select
(sum(aa.costo_venta+aa.renta+aa.nomina+aa.isr_nomina+aa.insumos+aa.agua+aa.luz+aa.tel+aa.otros+
(select por_suc from finanzas.gasto_oficinas_suc xx where xx.aaa=$aaa and xx.mes=$mes)))
 FROM oficinas.pianel_sucursal aa
join catalogo.sucursal b on b.suc=aa.suc
where $var
aa.aaa=$aaa_a2 and aa.mes=$mes_a2 and aa.tipo3='$tipo' and year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes)) as punto_equilibrio,


'$objetivo_mes' as objetivo_mes,


case when '$tipo'='DA'
then (select
sum(((a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.agua+a.luz+a.tel+a.otros)*1.4)*
(SELECT (round(avg(abasto),2)/100)
FROM oficinas.nivel_surtido_suc x
where abasto>0 and year(x.fecha)=$aaa and month(x.fecha)=$mes
and x.suc=a.suc
group by month(fecha)))
 FROM oficinas.pianel_sucursal a
join catalogo.sucursal b on b.suc=a.suc
where $var
a.aaa=$aaa_a2 and a.mes=$mes_a2 and a.tipo3='$tipo' and year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes))
else
'$objetivo_mes'
end
as objetivo_mes_sin_oficinas,

(select dos from catalogo.mes x where x.num=month(a.fechacorte)) as dias_mes,

case when month(a.fechacorte)=month(date(now())) 
then day(subdate(date(now()),1)) 
else (select dos from catalogo.mes x where x.num=month(a.fechacorte)) end as dias_trans,

(select sum(siniva) from desarrollo.cortes_c aa
join catalogo.sucursal bb on bb.suc=aa.suc
join desarrollo.cortes_d cc on cc.id_cc=aa.id
where $var year(aa.fechacorte)=$aaa_a and month(aa.fechacorte)=$mes_a and bb.tipo3='$tipo' and cc.clave1 not in(0,20,30,40,49) and
year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes)
group by month(aa.fechacorte))as venta_mes_ant,

(SELECT sum(a$aaa_ant) FROM cortes_resp.cortes_venta_diaria a
join catalogo.sucursal b on b.suc=a.suc and mes=$mes
where $var tlid=1 and tipo3='$tipo' and  year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes))as venta_aaa_ant

from desarrollo.cortes_c a
join catalogo.sucursal b on b.suc=a.suc
join desarrollo.cortes_d c on c.id_cc=a.id
where $var year(fechacorte)=$aaa and month(fechacorte)=$mes and tipo3='$tipo' and c.clave1 not in(0,20,30,40,49)
group by month(fechacorte)";



    $q=$this->db->query($s);

    return $q;

}

function proyeccion_venta_dia_mes($tipo,$aaa,$mes,$aaa_a,$mes_a)
{
$nivel=$this->session->userdata('nivel');
$id_plaza=$this->session->userdata('id_plaza');
if($nivel==13){$var='superv='.$id_plaza.' and ';}
elseif($nivel==12){$var='regional='.$id_plaza.' and ';}
else{$var='';}
$s="select a.fechacorte,trim(c.nombre) as diax,

(select avg(abasto) from oficinas.nivel_surtido_suc x ,catalogo.sucursal z
where abasto>0 and $var x.suc=z.suc and tipo3='$tipo' and year(fecha)=$aaa and month(fecha)=$mes and x.fecha<=a.fechacorte)as nivel_surtido,

(SELECT sum(tic) FROM vtadc.venta_ctl x,catalogo.sucursal y where $var x.suc=y.suc and y.tipo3=b.tipo3 and x.fecha=a.fechacorte)as tic,
(select count(*) From catalogo.sucursal a
where $var fecha_act>= a.fechacorte and tipo3='$tipo' or $var fecha_act='0000-00-00' and tipo3='$tipo')as num_suc,
count(a.suc)as suc_cortes,
ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
join catalogo.sucursal z on z.suc=y.suc
where $var clave1 not in(0,49,30,40,20) and z.tipo3=b.tipo3 and y.fechacorte=a.fechacorte),0) as venta_contado,
ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
join catalogo.sucursal z on z.suc=y.suc
where $var clave1 in (20) and z.tipo3=b.tipo3 and y.fechacorte=a.fechacorte),0) as venta_servicio,
ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
join catalogo.sucursal z on z.suc=y.suc
where $var clave1 in (30,40) and z.tipo3=b.tipo3 and y.fechacorte=a.fechacorte),0) as venta_credito,
ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
join catalogo.sucursal z on z.suc=y.suc
where $var clave1 not in(0,49,20) and z.tipo3=b.tipo3 and y.fechacorte=a.fechacorte),0) as venta_sin_servicio,
ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
join catalogo.sucursal z on z.suc=y.suc
where $var clave1 not in(0,49) and z.tipo3=b.tipo3 and y.fechacorte=a.fechacorte),0) as venta_total,
ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
join catalogo.sucursal z on z.suc=y.suc
where $var clave1 not in(0,49) and z.tipo3=b.tipo3 and date_format(y.fechacorte,'%Y-%m')=date_format(a.fechacorte,'%Y-%m') and y.fechacorte<=a.fechacorte),0) as venta_acumulada,

round(((ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
join catalogo.sucursal z on z.suc=y.suc
where $var clave1 not in(0,20,30,40,49) and z.tipo3=b.tipo3 and date_format(y.fechacorte,'%Y-%m')=date_format(a.fechacorte,'%Y-%m') and y.fechacorte<=a.fechacorte),0)/
(select

sum(((a.costo_venta+a.renta+a.nomina+a.isr_nomina+a.insumos+a.agua+a.luz+a.tel+a.otros+'9367.46')*1.4)*.74)

 FROM oficinas.pianel_sucursal a
join catalogo.sucursal b on b.suc=a.suc
where $var
a.aaa=$aaa_a and a.mes=$mes_a and a.tipo3='$tipo' and year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes))

)*100),2) as por_alcance_contado,

ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
join catalogo.sucursal z on z.suc=y.suc
where $var clave1 not in(0,20,30,40,49) and z.tipo3=b.tipo3 and date_format(y.fechacorte,'%Y-%m')=date_format(a.fechacorte,'%Y-%m') and y.fechacorte<=a.fechacorte),0) as venta_acumulada_contado


From desarrollo.cortes_c a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.cat_dias c on c.dia=weekday(a.fechacorte)
where $var year(fechacorte)=$aaa and month(fechacorte)=$mes and b.tipo3='$tipo'
group by a.fechacorte";
$q=$this->db->query($s);
return $q;
}
function grafica_proyeccion($tipo,$aaa,$mes,$aaa_a,$mes_a,$mesx,$nombre)
    {
        $this->load->model('grafica');
        $this->load->library('Multidata');
        
        $cat = array();
        $arregloA = array();
        
        $query = $this->proyeccion_venta_dia_mes($tipo,$aaa,$mes,$aaa_a,$mes_a);
        foreach($query->result() as $row)
        {
            array_push($cat,substr($row->fechacorte,8,2));
            array_push($arregloA,$row->venta_contado);
        }
        $a = new Multidata();
       $a->agrega($cat, '', $arregloA);
        
        $fuente = $this->grafica->multi('VENTA CONTADO', utf8_encode($mesx.' '.$aaa), 'DIAS', '$ Pesos', 2, 0, $a->retorno());
        $json   = $this->grafica->chart('msline', $nombre, '1200', '350', $fuente);
        
        return $json;
    }
function proyeccion_venta_dia_mes_detalle($tipo,$fecha)
{
$nivel=$this->session->userdata('nivel');
$id_plaza=$this->session->userdata('id_plaza');
if($nivel==13){$var='superv='.$id_plaza.' and ';}
elseif($nivel==12){$var='regional='.$id_plaza.' and ';}
else{$var='';}
$s="
select '$fecha' as fechacorte, a.suc,a.nombre,'Falta Corte' as diax,0 as nivel_surtido, 0 as tic,0 as venta_contado,
0 as venta_servicio,0 as venta_credito, 0 as venta_total
From catalogo.sucursal a
where
$var a.tipo3='$tipo' and fecha_act>='$fecha' and (select suc from desarrollo.cortes_c x where x.suc=a.suc and fechacorte='$fecha')is null
or
$var a.tipo3='$tipo' and
tlid=1 and fecha_act='0000-00-00' and (select suc from desarrollo.cortes_c x where x.suc=a.suc and fechacorte='$fecha')is null
union all

select a.fechacorte,a.suc,b.nombre,trim(c.nombre) as diax,

ifnull((select (abasto) from oficinas.nivel_surtido_suc x
where  x.suc=a.suc and x.fecha=a.fechacorte),0)as nivel_surtido,

(SELECT (tic) FROM vtadc.venta_ctl x where  x.suc=a.suc and x.fecha=a.fechacorte)as tic,


ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
where  clave1 not in(0,49,30,40,20) and y.suc=a.suc and y.fechacorte=a.fechacorte),0) as venta_contado,

ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
where  clave1  in(20) and y.suc=a.suc and y.fechacorte=a.fechacorte),0) as venta_servicio,

ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
where  clave1 in(30,40) and y.suc=a.suc and y.fechacorte=a.fechacorte),0) as venta_credito,


ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
where  clave1 not in(0,49) and y.suc=a.suc and y.fechacorte=a.fechacorte),0) as venta_total


From desarrollo.cortes_c a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.cat_dias c on c.dia=weekday(a.fechacorte)
where $var fechacorte='$fecha' and b.tipo3='$tipo'
group by a.suc";
$q=$this->db->query($s);
return $q;
}
function proyeccion_venta_dia_mes_detalle_limite($tipo,$fecha)
{
$nivel=$this->session->userdata('nivel');
$id_plaza=$this->session->userdata('id_plaza');
if($nivel==13){$var='superv='.$id_plaza.' and ';}
elseif($nivel==12){$var='regional='.$id_plaza.' and ';}
else{$var='';}
$s="select a.fechacorte,a.suc,b.nombre,trim(c.nombre) as diax,

ifnull((select (abasto) from oficinas.nivel_surtido_suc x
where  x.suc=a.suc and x.fecha=a.fechacorte),0)as nivel_surtido,

(SELECT (tic) FROM vtadc.venta_ctl x where  x.suc=a.suc and x.fecha=a.fechacorte)as tic,


ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
where  clave1 not in(0,49,30,40,20) and y.suc=a.suc and y.fechacorte=a.fechacorte),0) as venta_contado,

ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
where  clave1  in(20) and y.suc=a.suc and y.fechacorte=a.fechacorte),0) as venta_servicio,

ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
where  clave1 in(30,40) and y.suc=a.suc and y.fechacorte=a.fechacorte),0) as venta_credito,


ifnull((select sum(siniva) from desarrollo.cortes_d x
join desarrollo.cortes_c y  on y.id=x.id_cc
where  clave1 not in(0,49) and y.suc=a.suc and y.fechacorte=a.fechacorte),0) as venta_total


From desarrollo.cortes_c a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.cat_dias c on c.dia=weekday(a.fechacorte)
where $var fechacorte='$fecha' and b.tipo3='$tipo'
group by a.suc
order by  venta_contado desc limit 50";
$q=$this->db->query($s);
return $q;
}
function grafica_proyeccion_detalle($tipo,$fecha,$nombre)
    {
        $this->load->model('grafica');
        $this->load->library('data');
        $a = new Data();
        $query = $this->proyeccion_venta_dia_mes_detalle_limite($tipo,$fecha);
        foreach($query->result() as $row)
        {
            $a->agregaData($row->suc.'-'.trim($row->nombre), $row->venta_contado);
              
        }
       
        $fuente = $this->grafica->fuente('VENTA CONTADO', utf8_encode($fecha), 'Sucursal', '$ Pesos', 1, 0, $a->retornaData());
        $json   = $this->grafica->chart('column3d', $nombre, '1250', '400', $fuente);
        
        return $json;
    }


function proyeccion_venta_dif_suc($tipo,$aaa,$mes,$aaa_a,$mes_a,$aaa_a2,$mes_a2)
{
$nivel=$this->session->userdata('nivel');
$id_plaza=$this->session->userdata('id_plaza');
if($nivel==13){$var='superv='.$id_plaza.' and ';}
elseif($nivel==12){$var='regional='.$id_plaza.' and ';}
else{$var='';}
    $aaa_ant=$aaa-1;
    
    $s="select a.suc,b.nombre as sucx,sum(siniva)as venta,
(select
(
sum(aa.costo_venta+aa.renta+aa.nomina+aa.isr_nomina+aa.insumos+aa.agua+aa.luz+aa.tel+aa.otros)+
(select por_suc from finanzas.gasto_oficinas_suc xx where xx.aaa=$aaa and xx.mes=$mes))


 FROM oficinas.pianel_sucursal aa
join catalogo.sucursal bb on bb.suc=aa.suc
where $var aa.suc=a.suc and
aa.aaa=$aaa_a2 and aa.mes=$mes_a2 and aa.tipo3='$tipo' 
and year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes))as punto_equilibrio,

(select ((sum(aa.costo_venta+aa.renta+aa.nomina+aa.isr_nomina+aa.insumos+aa.agua+aa.luz+aa.tel+aa.otros+
(select por_suc from finanzas.gasto_oficinas_suc xx where xx.aaa=$aaa and xx.mes=$mes)))*1.4)

FROM oficinas.pianel_sucursal aa
join catalogo.sucursal b on b.suc=aa.suc
where $var aa.suc=a.suc and aa.aaa=$aaa_a2 and aa.mes=$mes_a2 and aa.tipo3='$tipo'
and year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes)) as objetivo_mes,


(select ((sum(aa.costo_venta+aa.renta+aa.nomina+aa.isr_nomina+aa.insumos+aa.agua+aa.luz+aa.tel+aa.otros+
(select por_suc from finanzas.gasto_oficinas_suc xx where xx.aaa=$aaa and xx.mes=$mes)))*1.4)*
(SELECT (round(avg(abasto),5)/100)
FROM oficinas.nivel_surtido_suc x
where abasto>0 and year(x.fecha)=$aaa and month(x.fecha)=$mes and x.suc=a.suc
group by month(fecha))

FROM oficinas.pianel_sucursal aa
join catalogo.sucursal b on b.suc=aa.suc
where $var aa.suc=a.suc and aa.aaa=$aaa_a2 and aa.mes=$mes_a2 and aa.tipo3='$tipo'
and year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes)) as objetivo_mes_abasto,

(SELECT (round(avg(abasto),5)/100)
FROM oficinas.nivel_surtido_suc x
where abasto>0 and year(x.fecha)=$aaa and month(x.fecha)=$mes and x.suc=a.suc
group by month(fecha))as abasto_act,

(select
sum(((xa.costo_venta+xa.renta+xa.nomina+xa.isr_nomina+xa.insumos+xa.agua+xa.luz+xa.tel+xa.otros)*1.4)*
(SELECT (round(avg(abasto),5)/100)
FROM oficinas.nivel_surtido_suc x
where abasto>0 and year(x.fecha)=$aaa and month(x.fecha)=$mes and x.suc=a.suc
group by month(fecha)))
 FROM oficinas.pianel_sucursal xa
join catalogo.sucursal b on b.suc=xa.suc
where $var
xa.suc=a.suc and xa.aaa=$aaa_a2 and xa.mes=$mes_a2 and  xa.tipo3='$tipo' and year(fecha_act) in(0000,$aaa) 
and month (fecha_act) in(0,$mes)) as objetivo_mes_sin_oficinas,

(select dos from catalogo.mes x where x.num=month(a.fechacorte)) as dias_mes,
day(subdate(date(now()),1))as dias_trans,

(select sum(siniva) from desarrollo.cortes_c aa
join catalogo.sucursal bb on bb.suc=aa.suc
join desarrollo.cortes_d cc on cc.id_cc=aa.id
where $var aa.suc=a.suc and year(aa.fechacorte)=$aaa_a and month(aa.fechacorte)=$mes_a and bb.tipo3='$tipo' and cc.clave1 not in(0,20,30,40,49) and
year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes)
group by month(aa.fechacorte))as venta_mes_ant,
--
(SELECT sum(a$aaa_ant) FROM cortes_resp.cortes_venta_diaria aa
join catalogo.sucursal b on b.suc=aa.suc and mes=$mes
where $var  aa.suc=a.suc and tlid=1 and tipo3='$tipo' and  year(fecha_act) in(0000,$aaa) and month (fecha_act) in(0,$mes))as venta_aaa_ant,
--
(select count(*) from desarrollo.cortes_c zz where year(zz.fechacorte)=year(a.fechacorte) and month(zz.fechacorte)=month(a.fechacorte) and zz.suc=a.suc)as dia_venta
--
from desarrollo.cortes_c a
join catalogo.sucursal b on b.suc=a.suc
join desarrollo.cortes_d c on c.id_cc=a.id
where $var year(fechacorte)=$aaa and month(fechacorte)=$mes and tipo3='$tipo' and c.clave1 not in(0,20,30,40,49)
group by month(fechacorte),a.suc
order by dia_venta";
    $q=$this->db->query($s);
return $q;
}

function proyeccion_venta_detalle_suc($suc,$aaa,$mes)
{

$s="SELECT x.dia,f.nombre as diax,ifnull(sum(siniva),0)as venta_contado ,ifnull(tic,0)as tic,
ifnull((ifnull(sum(siniva),0)/ifnull(tic,0)),0)prome_tic,
ifnull(abasto,0)as nivel_surtido

FROM catalogo.dia_mes x
left join desarrollo.cortes_c a on a.suc=$suc and year(a.fechacorte)=$aaa and month(fechacorte)=x.mes and day(fechacorte)=x.dia
left join oficinas.nivel_surtido_suc b on b.suc=a.suc and year(b.fecha)=$aaa and month(b.fecha)=x.mes and day(b.fecha)=x.dia
left join desarrollo.cortes_d d on d.id_cc=a.id and d.clave1 not in(0,20,30,40,49)
left join vtadc.venta_ctl e on e.suc=a.suc and e.fecha=a.fechacorte
left join catalogo.cat_dias f on f.dia=weekday(concat($aaa,'-',x.mes,'-',x.dia))
where x.mes=$mes and x.dia<=day(subdate(date(now()),1))
group by x.dia,a.fechacorte,a.suc";
$q=$this->db->query($s);
return $q;
}


 function rentabilidad_farmacia_imp($aaa,$tipo)
{
    
$s="SELECT a.tipo3,a.aaa,a.mes,b.mes as mesx,sum(venta)as venta,sum(costo_venta)as costo_venta, count(*)as num_suc,
sum(renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros)as gastos,
(sum(venta))-sum(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros) as utilidad,
(((sum(venta))-sum(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros))/sum(venta)*100) as p_utilidad,
(select
round(((sum(x.renta+x.nomina+x.isr_nomina+x.insumos+x.dev+x.agua+x.luz+x.tel+x.otros)*.4)/
(select count(*) from oficinas.pianel_sucursal z where z.aaa=x.aaa and z.mes=x.mes and tipo3 in('FA','DA','FE')
group by z.aaa,z.mes)),2)
from oficinas.pianel_sucursal x where x.tipo3 in('CE','OF','AN',' ') and x.aaa=a.aaa and x.mes=a.mes
group by x.aaa,x.mes)as gas_x_suc

FROM oficinas.pianel_sucursal a
join catalogo.mes b on b.num=a.mes
where a.tipo3='$tipo' and a.aaa=$aaa
group by a.aaa,a.mes";
$q=$this->db->query($s);

        $this->load->model('grafica');
        $this->load->library('Multidata');
        
        $cat = array();
        $arregloA = array();
        $arregloB = array();
        $arregloC = array();
        $query = $this->rentabilidad_farmacia($aaa,$tipo);
        foreach($q->result() as $row)
        {
            $mas_gasto=(($row->gas_x_suc)*($row->num_suc))+$row->gastos;
            $utilidad_40=$row->venta-(+$row->costo_venta+$mas_gasto);
            
            array_push($cat,$row->mesx);
            array_push($arregloA,$row->utilidad);
            array_push($arregloB,$utilidad_40);
        }
        $a = new Multidata();
        
        $a->agrega($cat, 'Utilidad', $arregloA, 'Utilidad con 40% de gastos de oficinas', $arregloB);
        
        $fuente = $this->grafica->multi('UTILIDAD DE FARMACIAS', utf8_encode($aaa), 'Meses', '$ Pesos', 2, 1, $a->retorno());
        $json1  = $this->grafica->chart('msline', 'chart1', '1100', '300', $fuente);
        
    return $json1;

    }
    
  function consulta_venta_90_dias_nombre()
  {
    $s="select
subdate(date(now()),1) as d1,subdate(date(now()),2) as d2,subdate(date(now()),3) as d3,
subdate(date(now()),4) as d4,subdate(date(now()),5) as d5,subdate(date(now()),6) as d6,
subdate(date(now()),7) as d7,subdate(date(now()),8) as d8,subdate(date(now()),9) as d9,
subdate(date(now()),10) as d10,subdate(date(now()),11) as d11,subdate(date(now()),12) as d12,
subdate(date(now()),13) as d13,subdate(date(now()),14) as d14,subdate(date(now()),15) as d15,
subdate(date(now()),16) as d16,subdate(date(now()),17) as d17,subdate(date(now()),18) as d18,
subdate(date(now()),19) as d19,subdate(date(now()),20) as d20,subdate(date(now()),21) as d21,
subdate(date(now()),22) as d22,subdate(date(now()),23) as d23,subdate(date(now()),24) as d24,
subdate(date(now()),25) as d25,subdate(date(now()),26) as d26,subdate(date(now()),27) as d27,
subdate(date(now()),28) as d28,subdate(date(now()),29) as d29,subdate(date(now()),30) as d30,
subdate(date(now()),31) as d31,subdate(date(now()),32) as d32,subdate(date(now()),33) as d33,
subdate(date(now()),34) as d34,subdate(date(now()),35) as d35,subdate(date(now()),36) as d36,
subdate(date(now()),37) as d37,subdate(date(now()),38) as d38,subdate(date(now()),39) as d39,
subdate(date(now()),40) as d40,subdate(date(now()),41) as d41,subdate(date(now()),42) as d42,
subdate(date(now()),43) as d43,subdate(date(now()),44) as d44,subdate(date(now()),45) as d45,
subdate(date(now()),46) as d46,subdate(date(now()),47) as d47,subdate(date(now()),48) as d48,
subdate(date(now()),49) as d49,subdate(date(now()),50) as d50,subdate(date(now()),51) as d51,
subdate(date(now()),52) as d52,subdate(date(now()),53) as d53,subdate(date(now()),54) as d54,
subdate(date(now()),55) as d55,subdate(date(now()),56) as d56,subdate(date(now()),57) as d57,
subdate(date(now()),58) as d58,subdate(date(now()),59) as d59,subdate(date(now()),60) as d60,
subdate(date(now()),61) as d61,subdate(date(now()),62) as d62,subdate(date(now()),63) as d63,
subdate(date(now()),64) as d64,subdate(date(now()),65) as d65,subdate(date(now()),66) as d66,
subdate(date(now()),67) as d67,subdate(date(now()),68) as d68,subdate(date(now()),69) as d69,
subdate(date(now()),70) as d70,subdate(date(now()),71) as d71,subdate(date(now()),72) as d72,
subdate(date(now()),73) as d73,subdate(date(now()),74) as d74,subdate(date(now()),75) as d75,
subdate(date(now()),76) as d76,subdate(date(now()),77) as d77,subdate(date(now()),78) as d78,
subdate(date(now()),79) as d79,subdate(date(now()),80) as d80,subdate(date(now()),81) as d81,
subdate(date(now()),82) as d82,subdate(date(now()),83) as d83,subdate(date(now()),84) as d84,
subdate(date(now()),85) as d85,subdate(date(now()),86) as d86,subdate(date(now()),87) as d87,
subdate(date(now()),88) as d88,subdate(date(now()),89) as d89,subdate(date(now()),90) as d90

";
    $q=$this->db->query($s);
    return $q;
  }
  function consulta_venta_90_dias($tipo)
  {
    $s="SELECT
regional,superv,tipo3,
(select nombre from compras.usuarios x where x.id_plaza=b.superv and id_plaza>0 and x.nivel=13  and x.tipo=1)as supervx,
a.suc,b.nombre as sucx, dia1, dia2, dia3, dia4, dia5, dia6, dia7, dia8, dia9, dia10, dia11, dia12, dia13, dia14, dia15,
dia16, dia17, dia18, dia19, dia20, dia21, dia22, dia23, dia24, dia25, dia26, dia27, dia28, dia29, dia30, dia31,
dia32, dia33, dia34, dia35, dia36, dia37, dia38, dia39, dia40, dia41, dia42, dia43, dia44, dia45, dia46, dia47,
dia48, dia49, dia50, dia51, dia52, dia53, dia54, dia55, dia56, dia57, dia58, dia59, dia60, dia61, dia62, dia63,
dia64, dia65, dia66, dia67, dia68, dia69, dia70, dia71, dia72, dia73, dia74, dia75, dia76, dia77, dia78, dia79,
dia80, dia81, dia82, dia83, dia84, dia85, dia86, dia87, dia88, dia89, dia90

FROM vtadc.a_venta_dia_90 a
join catalogo.sucursal b on b.suc=a.suc and tipo3='$tipo'
where (dia1+dia2+dia3+dia4+dia5+dia6+dia7+dia8+dia9+dia10+dia11+dia12+dia13+dia14+dia15+
dia16+dia17+dia18+dia19+dia20+dia21+dia22+dia23+dia24+dia25+dia26+dia27+dia28+dia29+dia30+dia31+
dia32+dia33+dia34+dia35+dia36+dia37+dia38+dia39+dia40+dia41+dia42+dia43+dia44+dia45+dia46+dia47+
dia48+dia49+dia50+dia51+dia52+dia53+dia54+dia55+dia56+dia57+dia58+dia59+dia60+dia61+dia62+dia63+
dia64+dia65+dia66+dia67+dia68+dia69+dia70+dia71+dia72+dia73+dia74+dia75+dia76+dia77+dia78+dia79+
dia80+dia81+dia82+dia83+dia84+dia85+dia86+dia87+dia88+dia89+dia90)>0
order by regional,superv,suc";
    $q=$this->db->query($s);
    return $q;
  }
  function consulta_venta_90_dias_todo()
  {
    $s="SELECT
regional,superv,tipo3,
(select nombre from compras.usuarios x where x.id_plaza=b.superv and id_plaza>0 and x.nivel=13  and x.tipo=1)as supervx,
a.suc,b.nombre as sucx, dia1, dia2, dia3, dia4, dia5, dia6, dia7, dia8, dia9, dia10, dia11, dia12, dia13, dia14, dia15,
dia16, dia17, dia18, dia19, dia20, dia21, dia22, dia23, dia24, dia25, dia26, dia27, dia28, dia29, dia30, dia31,
dia32, dia33, dia34, dia35, dia36, dia37, dia38, dia39, dia40, dia41, dia42, dia43, dia44, dia45, dia46, dia47,
dia48, dia49, dia50, dia51, dia52, dia53, dia54, dia55, dia56, dia57, dia58, dia59, dia60, dia61, dia62, dia63,
dia64, dia65, dia66, dia67, dia68, dia69, dia70, dia71, dia72, dia73, dia74, dia75, dia76, dia77, dia78, dia79,
dia80, dia81, dia82, dia83, dia84, dia85, dia86, dia87, dia88, dia89, dia90

FROM vtadc.a_venta_dia_90 a
join catalogo.sucursal b on b.suc=a.suc 
where (dia1+dia2+dia3+dia4+dia5+dia6+dia7+dia8+dia9+dia10+dia11+dia12+dia13+dia14+dia15+
dia16+dia17+dia18+dia19+dia20+dia21+dia22+dia23+dia24+dia25+dia26+dia27+dia28+dia29+dia30+dia31+
dia32+dia33+dia34+dia35+dia36+dia37+dia38+dia39+dia40+dia41+dia42+dia43+dia44+dia45+dia46+dia47+
dia48+dia49+dia50+dia51+dia52+dia53+dia54+dia55+dia56+dia57+dia58+dia59+dia60+dia61+dia62+dia63+
dia64+dia65+dia66+dia67+dia68+dia69+dia70+dia71+dia72+dia73+dia74+dia75+dia76+dia77+dia78+dia79+
dia80+dia81+dia82+dia83+dia84+dia85+dia86+dia87+dia88+dia89+dia90)>0
order by regional,superv,suc";
    $q=$this->db->query($s);
    return $q;
  }  
    
    
    
    
    
    
    
    
    
    
    






}