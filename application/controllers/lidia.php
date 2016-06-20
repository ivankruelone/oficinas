
<?php
class lidia extends CI_Controller
{
public function __construct()
    {
       
        parent::__construct();
           
        $this->load->helper('directory');
        $this->load->helper('file');
        $this->load->model('lidia_model');
        $this->load->model('backoffice_model_replicas');
        $this->load->model('backoffice_model_central');
        $this->load->model('ventas_model');
        $this->load->model('Evaluacion_model');
        $this->load->model('Catalogos_model');
        $this->load->model('comision_model');
    }   

function comision_insentivo()
{
$aaa=2016;
$mes=1;
$comision='INCENTIVO'; 


$this->comision_model->ins_insentivo_ctl($aaa,$mes,$comision);

    
}


function archivo_para_suc()
{
    
    $nombre_archivo='';
    $s="select *From catalogo.sucursal where tipo3='DA'  and tlid=1 limit 200";
    $q=$this->db->query($s);
    foreach($q->result() as $r)
    {
        $Data='';
        $File = "./txt/TRACLI".$r->suc.".txt";
        $Handle = fopen($File, 'w');
        $s1="SELECT * FROM catalogo.cat_tarjetas where num>0";
        $q1=$this->db->query($s1);
        foreach($q1->result()as $r1)
        {//num, nombre, descuento, dias, costo, renova, desren, aviso, folpre
           $Data.= str_pad('CTP',3," ",STR_PAD_LEFT)
                  .str_pad($r1->num,13,"0",STR_PAD_LEFT)
                  .str_pad($r1->nombre,30," ",STR_PAD_RIGHT)
                  .str_pad(number_format($r1->descuento,2),6,"0",STR_PAD_LEFT)
                  .str_pad($r1->dias,5,"0",STR_PAD_LEFT)
                  .str_pad(number_format($r1->costo,2),12,"0",STR_PAD_LEFT)
                  .str_pad(number_format($r1->renova,2),12,"0",STR_PAD_LEFT)
                  .str_pad(number_format($r1->desren,2),6,"0",STR_PAD_LEFT)
                  .str_pad($r1->aviso,5,"0",STR_PAD_LEFT)
                  .str_pad($r1->folpre,1,"0",STR_PAD_LEFT)
                  ."\r\n";
        }
        $s2 = "select *From vtadc.tarjetas_suc where suc = $r->suc and tipo=1 and activo=1";
        $q2 = $this->db->query($s2);
        
        foreach($q2->result()as $r2)
        {
            for ($i = $r2->fol1; $i <= $r2->fol2; $i++) 
            {
             $Data.= str_pad('NTP',3," ",STR_PAD_LEFT)
                    .str_pad($r->suc,8,"0",STR_PAD_LEFT)
                    .str_pad(1,13,"0",STR_PAD_LEFT)
                    .str_pad($i,13,"0",STR_PAD_LEFT)
                    ."\r\n";
             }
        }
        fwrite($Handle, $Data);
        fclose($Handle);
                    
    



$zip = new ZipArchive();
$filename = "G:\pdvsube\pasucursales\SUC".str_pad($r->suc,4,"0",STR_PAD_LEFT).".zip";

if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
    exit("cannot open <$filename>\n");
}
$zip->addFile($File,"tracli.txt");
echo "numficheros: " . $zip->numFiles . "\n";
echo "estado:" . $zip->status . "\n";
$zip->close();
}
 

} 




  
function calcula_rentabilidad()
{
$aaa=2016;$mes=5;
$an="insert ignore into catalogo.costo_ponderado(aaa, cod, mes, sec, cosf, cosd)
(select year(a.fechai),codigo,month(a.fechai),sec,0,round((sum(costo*can)/sum(can)),2) from desarrollo.compra_d a
where costo>0 and year(a.fechai)=$aaa
group by codigo, year(a.fechai),month(a.fechai))";
$this->db->query($an);
$an1="update  vtadc.venta_detalle a, catalogo.sucursal b,catalogo.costo_ponderado c
set a.cos=c.cosd
where a.codigo=c.cod and b.suc=a.suc and
c.aaa=year(a.fecha) and c.mes=month(a.fecha) and
tipo3 in('FA','DA') and year(a.fecha)=$aaa  and month(a.fecha)=$mes and a.cos=0 and
a.codigo not in(783523530,783523520,783523510,783523550,783523100,783523200,
783523300,7835235100,7835235200,4423174088000,9144221209277,7835235150,7835235300,
783523560,7835235500
) and descri not like '%tarjeta%'";
$this->db->query($an1);

$an2="update  vtadc.venta_detalle  a, catalogo.sucursal b,catalogo.costo_ponderado c
set a.cos=c.cosd
where a.codigo=c.cod and b.suc=a.suc and
c.aaa=year(subdate(date(now()),interval 1 month)) and 
c.mes=month(subdate(date(now()),interval 1 month)) and
tipo3 in('FA','DA') and year(a.fecha)=$aaa  and month(a.fecha)=$mes and a.cos=0 and
a.codigo not in(783523530,783523520,783523510,783523550,783523100,783523200,
783523300,7835235100,7835235200,4423174088000,9144221209277,7835235150,7835235300,
783523560,7835235500
) and descri not like '%tarjeta%'";
$this->db->query($an2);

$an3="update  vtadc.venta_detalle  a, catalogo.sucursal b,catalogo.costo_ponderado c
set a.cos=c.cosd
where a.codigo=c.cod and b.suc=a.suc and
c.aaa=year(subdate(date(now()),interval 2 month)) and 
c.mes=month(subdate(date(now()),interval 2 month)) and
tipo3 in('FA','DA')  and year(a.fecha)=$aaa  and month(a.fecha)=$mes and a.cos=0 and
a.codigo not in(783523530,783523520,783523510,783523550,783523100,783523200,
783523300,7835235100,7835235200,4423174088000,9144221209277,7835235150,7835235300,
783523560,7835235500
) and descri not like '%tarjeta%'";
$this->db->query($an3);
$an4="update  vtadc.venta_detalle  a, catalogo.sucursal b,catalogo.costo_ponderado c
set a.cos=c.cosd
where a.codigo=c.cod and b.suc=a.suc and
c.aaa=year(subdate(date(now()),interval 3 month)) and 
c.mes=month(subdate(date(now()),interval 3 month)) and
tipo3 in('FA','DA') and year(a.fecha)=$aaa  and month(a.fecha)=$mes and a.cos=0 and
a.codigo not in(783523530,783523520,783523510,783523550,783523100,783523200,
783523300,7835235100,7835235200,4423174088000,9144221209277,7835235150,7835235300,
783523560,7835235500
) and descri not like '%tarjeta%'";
$this->db->query($an4);
$an5="update  vtadc.venta_detalle  a, catalogo.sucursal b,catalogo.costo_ponderado c
set a.cos=c.cosd
where a.codigo=c.cod and b.suc=a.suc and
c.aaa=year(subdate(date(now()),interval 4 month)) and 
c.mes=month(subdate(date(now()),interval 4 month)) and
tipo3 in('FA','DA')  and year(a.fecha)=$aaa  and month(a.fecha)=$mes and a.cos=0 and
a.codigo not in(783523530,783523520,783523510,783523550,783523100,783523200,
783523300,7835235100,7835235200,4423174088000,9144221209277,7835235150,7835235300,
783523560,7835235500
) and descri not like '%tarjeta%'";
$this->db->query($an5);
$an6="update  vtadc.venta_detalle   a, catalogo.sucursal b,catalogo.costo_ponderado c
set a.cos=c.cosd
where a.codigo=c.cod and b.suc=a.suc and
c.aaa=year(subdate(date(now()),interval 5 month)) and 
c.mes=month(subdate(date(now()),interval 5 month)) and
tipo3 in('FA','DA')  and year(a.fecha)=$aaa  and month(a.fecha)=$mes and a.cos=0 and
a.codigo not in(783523530,783523520,783523510,783523550,783523100,783523200,
783523300,7835235100,7835235200,4423174088000,9144221209277,7835235150,7835235300,
783523560,7835235500
) and descri not like '%tarjeta%'";
$this->db->query($an6);
$an7="update  vtadc.venta_detalle  a, catalogo.sucursal b,catalogo.costo_ponderado c
set a.cos=c.cosd
where a.codigo=c.cod and b.suc=a.suc and
tipo3 in('FA','DA')  and year(a.fecha)=$aaa  and month(a.fecha)=$mes and a.cos=0 and
a.codigo not in(783523530,783523520,783523510,783523550,783523100,783523200,
783523300,7835235100,7835235200,4423174088000,9144221209277,7835235150,7835235300,
783523560,7835235500
) and descri not like '%tarjeta%'";
$this->db->query($an7);
$an8="update  vtadc.venta_detalle  a, catalogo.sucursal b,catalogo.almacen c
set a.cos=c.costo
where a.codigo=c.codigo and b.suc=a.suc and

tipo3 in('FA','DA')  and year(a.fecha)=$aaa  and month(a.fecha)=$mes and a.cos=0 and
a.codigo not in(783523530,783523520,783523510,783523550,783523100,783523200,
783523300,7835235100,7835235200,4423174088000,9144221209277,7835235150,7835235300,
783523560,7835235500
) and descri not like '%tarjeta%' and c.sec between 1 and 1999";
$this->db->query($an8);
$an9="update  vtadc.venta_detalle  a, catalogo.sucursal b
set a.cos=round(((importe/can)*.8),2)
where b.suc=a.suc and

tipo3 in('FA','DA')  and year(a.fecha)=$aaa  and month(a.fecha)=$mes and a.cos=0 and importe>0 and
a.codigo not in(783523530,783523520,783523510,783523550,783523100,783523200,
783523300,7835235100,7835235200,4423174088000,9144221209277,7835235150,7835235300,
783523560,7835235500
) and descri not like '%tarjeta%'";
$this->db->query($an9);

$an10="INSERT INTO vtadc.gasto(aaa, mes, suc, auxi, importe, ob)

(SELECT aaa,mes,a.suc,'4008',sum(case when a.tel='VOIP/CABLE' then 169 else b.monto end) as monto,'TEL' FROM catalogo.cat_tel a
left join borrar.gas_tel b on b.tel=a.tel
left join catalogo.sucursal c on c.suc=a.suc
where aaa=$aaa and mes=$mes
group by suc)
ON DUPLICATE KEY UPDATE importe=values(importe)

";
$this->db->query($an10);


$s0="Delete from oficinas.pianel_sucursal where aaa=$aaa and mes=$mes";
$this->db->query($s0);
$s1="update oficinas.nomina_suc a, catalogo.sucursal b
set empresa_imp_nomina=(percepcionestotalgravado+percepcionestotalexento)*impu_nomina
where a.suc=b.suc and  a.pago='NOMINA' and
year(a.fecha)=$aaa and month(a.fecha)=$mes";
$this->db->query($s1);    
$s2="load data infile '/home/central/gas.txt' replace into table vtadc.gasto FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n';";
$this->db->query($s2);

$s2x="update oficinas.nomina_suc_sua s
set
s.ims=ifnull((SELECT sum(ims) FROM oficinas.nomina_suc a
where pago='NOMINA' and year(a.fecha)=s.aaa and month(a.fecha)=s.mes and a.nomina=s.nomina group by nomina),0),
s.infonavit=ifnull((SELECT sum(infonavit) FROM oficinas.nomina_suc a
where pago='NOMINA' and year(a.fecha)=s.aaa and month(a.fecha)=s.mes and a.nomina=s.nomina group by nomina),0),
s.impuesto_nomina=ifnull((SELECT sum(empresa_imp_nomina) FROM oficinas.nomina_suc a
where pago='NOMINA' and year(a.fecha)=s.aaa and month(a.fecha)=s.mes and a.nomina=s.nomina group by nomina),0),
s.vales=ifnull((SELECT sum(percepcionesTotalExento) FROM oficinas.nomina_suc a
where pago='VALES' and year(a.fecha)=s.aaa and month(a.fecha)=s.mes and a.nomina=s.nomina group by nomina),0)
where s.aaa=$aaa and s.mes=$mes";
$this->db->query($s2x);

$s2xx="update oficinas.nomina_suc_sua s
set sua_final=(ims_mensual+resto_bimestral+impuesto_nomina)-(ims + infonavit)
where s.aaa=$aaa and s.mes=$mes";
$this->db->query($s2xx);

$s3="insert into  oficinas.pianel_sucursal
(aaa, mes, tipo3, suc, venta, costo_venta, renta, nomina, isr_nomina, insumos, dev, agua, luz, tel, otros)
(SELECT a.aaa,a.mes,ifnull(b.tipo3,' '),a.suc,0,0,0,0,
sum(sua_final+impuesto_nomina),0,0,0,0,0,0
FROM  oficinas.nomina_suc_sua a
left join catalogo.sucursal b on b.suc=a.suc
where a.aaa=$aaa and a.mes=$mes
group by a.suc)
on duplicate key update isr_nomina=values(isr_nomina)
";
$this->db->query($s3); 

$s4="insert into  oficinas.pianel_sucursal
(aaa, mes, tipo3, suc, venta, costo_venta, renta,  nomina, isr_nomina, insumos, dev, agua, luz, tel, otros)
(select $aaa,$mes,a.tipo3,a.suc,ifnull(sum(siniva),0),
ifnull((select sum(x.can*x.cos) from vtadc.venta_detalle x where x.suc=a.suc and  year(x.fecha)=$aaa and month(x.fecha)=$mes),0)as cos_venta,
0,0,0,0,0,0,0,0,0
from catalogo.sucursal a
left join desarrollo.cortes_c b on a.suc=b.suc and  year(fechacorte)=$aaa and month(fechacorte)=$mes
left join desarrollo.cortes_d c on c.id_cc=b.id and clave1 not in(0,20,30,40,49)
where a.tipo3 IN('DA','FA','MO') AND a.TLID=1
group by a.suc)
on duplicate key update venta=values(venta),costo_venta=values(costo_venta)";
$this->db->query($s4);

$s4fenix="insert into  oficinas.pianel_sucursal
(aaa, mes, tipo3, suc, venta, costo_venta, renta,  nomina, isr_nomina, insumos, dev, agua, luz, tel, otros)
(select $aaa,$mes,a.tipo3,a.suc,ifnull(sum(siniva),0),

ifnull((select sum(x.cant*x.cos) 
from vtadc.vta_backoffice x 
where des not like '%tarjeta%' and vtatip=1 and x.suc=a.suc and  year(x.fecha)=$aaa and month(x.fecha)=$mes),0)as cos_venta,
0,0,0,0,0,0,0,0,0
from catalogo.sucursal a
left join desarrollo.cortes_c b on a.suc=b.suc and  year(fechacorte)=$aaa and month(fechacorte)=$mes
left join desarrollo.cortes_d c on c.id_cc=b.id and clave1 not in(0,20,30,40,49)
where a.tipo3 IN('FE') AND a.TLID=1
group by a.suc)
on duplicate key update venta=values(venta),costo_venta=values(costo_venta)";
$this->db->query($s4fenix);
     
$s5="insert into  oficinas.pianel_sucursal
(aaa, mes, tipo3, suc, venta, costo_venta, renta,  nomina, isr_nomina, insumos, dev, agua, luz, tel, otros)
(SELECT x.aaa,x.mes, b.tipo3,a.suc,0,0,
sum(
case
when pago='MN' then
case
when a.auxi=7004  then imp+(imp*a.iva)+agua
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo+agua
end
else
((case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo+agua
end
)*tipo_cambio)
end),

0,0,0,0,0,0,0,0
FROM juridico.rentas_c x
join juridico.rentas_d a on a.id_renta=x.id_renta
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=x.mes
where x.activo=1 and x.aaa=$aaa and x.mes=$mes
group by a.suc)
on duplicate key update renta=values(renta)";
$this->db->query($s5);    
$s6="insert into  oficinas.pianel_sucursal
(aaa, mes, tipo3, suc, venta, costo_venta, renta,  nomina, isr_nomina, insumos, dev, agua, luz, tel, otros)
(select
year(a.fecha),month(a.fecha), ifnull(b.tipo3,' '),a.suc,0,0,0,
sum(percepcionesTotalGravado+percepcionesTotalExento),
0,0,0,0,0,0,0

from oficinas.nomina_suc a
left join catalogo.sucursal b on b.suc=a.suc
where a.cia<>30 and year(a.fecha)=$aaa and month(a.fecha)=$mes
group by a.suc)
on duplicate key update nomina=values(nomina)
";
$this->db->query($s6);
    
$s7="insert into  oficinas.pianel_sucursal
(aaa, mes, tipo3, suc, venta, costo_venta, renta,  nomina, isr_nomina, insumos, dev, agua, luz, tel, otros)
(select year(a.fecha_sur),month(a.fecha_sur),c.tipo3,b.suc,0,0,0,0,0,
sum(cans*costo),
0,0,0,0,0
from papeleria. insumos_s a
join papeleria.insumos_c b on b.id=a.id_cc
join catalogo.sucursal c on c.suc=b.suc
where a.tipo in(2,3) and year(a.fecha_sur)= $aaa and month(a.fecha_sur)= $mes
group by b.suc)
on duplicate key update insumos=values(insumos)";
$this->db->query($s7);    
$s8="insert into  oficinas.pianel_sucursal
(aaa, mes, tipo3, suc, venta, costo_venta, renta,  nomina, isr_nomina, insumos, dev, agua, luz, tel, otros)

(SELECT year(a.fecha_cierre),month(a.fecha_cierre),b.tipo3,a.suc,0,0,0,0,0,0,
sum(c.cantidad*c.cos_dev),
0,0,0,0
FROM desarrollo.devolucion_sucursal_control a
join desarrollo.devolucion_sucursal_detalle c on c.devolucion=a.devolucion
join catalogo.sucursal b on b.suc=a.suc
where statusDevolucion=1 and year(a.fecha_cierre)= $aaa and month(a.fecha_cierre)= $mes and c.id_devolucion in(8,9)
group by a.suc)
on duplicate key update dev=values(dev)";
$this->db->query($s8);


$s9="insert into oficinas.pianel_sucursal
(aaa, mes, suc,tipo3, venta, costo_venta, renta,  nomina, isr_nomina, insumos, dev, agua, luz, tel, otros)
(SELECT a.aaa,a.mes,a.suc,b.tipo3,
0,0,0,0,0,0,0,sum(importe),0,0,0
FROM vtadc.gasto  a
join catalogo.sucursal b on b.suc=a.suc
where a.aaa=$aaa and a.mes=$mes and a.auxi  in(4005)
group by a.suc)
on duplicate key update agua=values(agua)";
$this->db->query($s9);

$s10="insert into oficinas.pianel_sucursal
(aaa, mes, suc,tipo3, venta, costo_venta, renta,  nomina, isr_nomina, insumos, dev, agua, luz, tel, otros)
(SELECT a.aaa,a.mes,a.suc,b.tipo3,
0,0,0,0,0,0,0,0,sum(importe),0,0
FROM vtadc.gasto  a
join catalogo.sucursal b on b.suc=a.suc
where a.aaa=$aaa and a.mes=$mes and a.auxi  in(4004)
group by a.suc)
on duplicate key update luz=values(luz)";
$this->db->query($s10);    
$s11="insert into oficinas.pianel_sucursal
(aaa, mes, suc,tipo3, venta, costo_venta, renta,  nomina, isr_nomina, insumos, dev, agua, luz, tel, otros)
(SELECT a.aaa,a.mes,a.suc,b.tipo3,
0,0,0,0,0,0,0,0,0,sum(importe),0
FROM vtadc.gasto  a
join catalogo.sucursal b on b.suc=a.suc
where a.aaa=$aaa and a.mes=$mes and a.auxi  in(4008)
group by a.suc)
on duplicate key update tel=values(tel)";
$this->db->query($s11); 
$s12="insert into oficinas.pianel_sucursal
(aaa, mes, suc,tipo3, venta, costo_venta, renta,  nomina, isr_nomina, insumos, dev, agua, luz, tel, otros)
(SELECT a.aaa,a.mes,a.suc,b.tipo3,
0,0,0,0,0,0,0,0,0,0,
sum(importe)
FROM vtadc.gasto  a
join catalogo.sucursal b on b.suc=a.suc
where a.aaa=$aaa and a.mes=$mes and a.auxi not in(1,5,4004,4005,4008)
group by a.suc)
on duplicate key update otros=values(otros)";
$this->db->query($s12);    
    
   

$s13="update oficinas.pianel_sucursal a
set costo_venta=
ifnull((select  sum(cann*cos)from vtadc.vta_backoffice x
where year(x.fecha)=a.aaa and month(x.fecha)=a.mes and vtatip=1 and x.suc=a.suc and 
x.cod not in(92,93,94,95,99,101,7835235100,100,783523530,7835235500,783523520,783523550,7835235200,7835235300,7835235150,783523510)
group by x.suc),0)
where tipo3='FE' and a.aaa=$aaa and mes=$mes";
$this->db->query($s13);
$s14="update  oficinas.pianel_sucursal a set tipo3='CE' 
where tipo3 in('DA','FE','FA') and venta=0 and a.aaa=$aaa and mes=$mes";
$this->db->query($s14);
}
////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////
////////////////////////////////////////////////////

////////////////////////////////////////////////////
////////////////////////////////////////////////////


function query_prueba_venta()
{
$g="select month(fechacorte),a.superv,a.suc,a.nombre,


sum(turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn+turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv)as venta,

((sum(turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn+turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv))*.01)as objetivo_merma,


(select sum(prome) from cortes_resp.cortes_venta_diaria x where  x.mes=month(b.fechacorte) and year(date(now()))=year(b.fechacorte)and x.suc=a.suc
group by x.suc) as objetivo_mes,

((select sum(prome) from cortes_resp.cortes_venta_diaria x where  x.mes=month(b.fechacorte) and year(date(now()))=year(b.fechacorte)and x.suc=a.suc
group by x.suc)*.65) as objetivo_mes_65,

(((sum(turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn+turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv))/
((select sum(prome) from cortes_resp.cortes_venta_diaria x where  x.mes=month(b.fechacorte) and year(date(now()))=year(b.fechacorte)and x.suc=a.suc
group by x.suc)*.65))*100)as alcance







from catalogo.sucursal a
left join desarrollo.cortes_c b on b.suc=a.suc and month(fechacorte)=3
left join desarrollo.cortes_d c on c.id_cc=b.id and clave1=20
where tlid=1 and a.regional=93
group by a.suc
order by alcance desc";


$sf="select a.superv,b.mes,b.dia,a.suc,a.nombre,

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
left join catalogo.dia_mes b on b.mes=4
left join desarrollo.cortes_c c on c.suc=a.suc and month(fechacorte)=b.mes and day(fechacorte)=b.dia
left join desarrollo.cortes_d d on d.id_cc=c.id and clave1=20
where  tlid=1 and tipo3<>' ' and b.mes=4 and a.regional=92
group by suc
order by a.superv,a.tipo3,a.suc,b.dia
limit 5";
$qf=$this->db->query($sf);

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
left join catalogo.dia_mes b on b.mes=4
left join desarrollo.cortes_c c on c.suc=a.suc and month(fechacorte)=b.mes and day(fechacorte)=b.dia
left join desarrollo.cortes_d d on d.id_cc=c.id and clave1=20
where  tlid=1 and tipo3<>' ' and b.mes=4 and a.regional=92
order by a.superv,a.tipo3,a.suc,b.dia
limit 150
";
 $q=$this->db->query($s);
$lidia='';
$lidia.="
<table>
<tr>
<td>Buenos d&iacute;as</td>
</tr>
<tr>
<td>Env&iacute;o reporte de ventas</td>
<tr>
</table>";
$timporte=0;$dn=0;
 

       
 foreach ($q->result()as $r)
        {
       
        $b[$r->suc]['nombre'] = $r->nombre;
        $b[$r->suc]['suc'] = $r->suc;
        
        
        $a[$r->dia]['d'][$r->suc]['suc'] = $r->suc;
        $a[$r->dia]['d'][$r->suc]['dia'] = $r->dia;
        $a[$r->dia]['d'][$r->suc]['pesos'] = $r->pesos;
        $a[$r->dia]['d'][$r->suc]['tar'] = $r->tar;
        $a[$r->dia]['d'][$r->suc]['total'] = $r->total;
        $a[$r->dia]['d'][$r->suc]['tot_sin_recarga'] = $r->tot_sin_recarga;
        $a[$r->dia]['d'][$r->suc]['recarga'] = $r->recarga;
        
        
        } 
        
        //echo "<pre>";
        //print_r($b);
        //echo "</pre>";
        //die();
        
 $tic=0;$importe=0;
 $num=1;$am=0;
 $lidia.="<table border='1' celpadding='2'>
 <thead>
 <title>Prueba de correo</title> 
 </thead>
 <tbody>
<tr> 
 ";
foreach ($b as $r0) {
$lidia.="
<th colspan=\"5\" bgcolor=\"#E7E7E9\" align=\"center\">".$r0['suc']." ".$r0['nombre']."</th>
<th colspan=\"1\" bgcolor=\"red\"></th>
";
}
$lidia.="</tr>";
 foreach ($b as $r0) {
$lidia.="
<th bgcolor=\"#E7E7E9\" >Dia</th>
<th bgcolor=\"#E7E7E9\" >VENTA M.N + VALES</th>
<th bgcolor=\"#E7E7E9\" >VENTA C TARJETA</th>
<th bgcolor=\"#E7E7E9\" >TOTAL SIN RECARGAS</th>
<th bgcolor=\"#E7E7E9\" >RECARGAS</th>
<th colspan=\"1\" bgcolor=\"red\"></th>";
}
$lidia.="</tr>";
foreach ($a as $r0) {
$lidia.="<tr>";
foreach ($r0['d'] as $r) {

$lidia.="

<td colspan=\"1\"><strong>".$r['dia']."</td>
<td colspan=\"1\" align=\"right\">".number_format($r['pesos'],2)."</td>
<td colspan=\"1\" align=\"right\">".number_format($r['tar'],2)."</td>
<td colspan=\"1\" align=\"right\">".number_format($r['tot_sin_recarga'],2)."</td>
<td colspan=\"1\" align=\"right\">".number_format($r['recarga'],2)."</td>
<td colspan=\"1\" bgcolor=\"red\"></td>
";
$num=$num+1;
}
$lidia.="
</tr>
";
}
$lidia.="
</tr>
</tbody>
<tfoot>";
foreach ($qf->result()as $rf)
{
$lidia.="
<td><strong>Total</strong></td>
<td align=\"right\"><strong>".number_format($rf->pesos,2)."</strong></td>
<td align=\"right\"><strong>".number_format($rf->tar,2)."</strong></td>
<td align=\"right\"><strong>".number_format($rf->tot_sin_recarga,2)."</strong></td>
<td align=\"right\"><strong>".number_format($rf->recarga,2)."</strong></td>
<td bgcolor=\"red\"></td>
";

}
$lidia.="
</tfoot></table>"; 
 
echo $lidia;
die();
return $lidia;   
}
















function s_deposito_p()
    {
        $data['titulo'] = "DEPOSITOS";
        //$data['q']=$this->licita_model->licita_ctl();
        $this->load->view('main', $data);
    }
    

function subida_submit_depo()
    {
        $target_dir = "uploads/";
        $target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
        $uploadOk = 1;
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) {
                //echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
                $this->getFileContent($target_dir);
            
                
            } else {
                echo "No se subio el archivo";
            }
        }
        
       

    }


  function getFileContent($file)
    {
       

        $handle = fopen($file, "r");
       
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
           
                $row1 = explode(',', $line);
                $row1[0] = trim(str_replace(array('"', ','), array('', ''), $row1[0]));//fecha
                $row1[3] = trim(str_replace(array('"', ',','DEP.EFECTIVO ','?','|'), array('', '','','',''), $row1[3]));//referencia
                $row1[5] = trim(str_replace(array('"', ',','?','|'), array('', '','',''), $row1[5]));//ref
                $row1[6] = trim(str_replace(array('"', ',','$'), array('', '',''), $row1[6]));//miles imp
                $row1[7] = trim(str_replace(array('"', ',','$'), array('', '',''), $row1[7]));//centenas imp
                $row1[9] = trim(str_replace(array('"', ',','$'), array('', '',''), $row1[9]));//centenas imp
                
                $suc=0;
                if($row1[0]=='CHQ'){
                $fecha=substr($row1[4],1,4).'-'.substr($row1[4],6,2).'-'.substr($row1[4],9,2);
                $mov=$row1[12];
                $ref=substr(($row1[5]*1),0,4);
                $ref2=$row1[5];
                $importe=$row1[6];
                $abono=$row1[7];
                $banco=1;
                }else{
                $abono='ABONO';
                $refx=($row1[3]*1);
                $ref=(substr($refx,0,4));
                $ref2=$row1[3];
                $importe=$row1[6].$row1[7];
                $mov=$row1[9];
                $fecha=substr($row1[0],6,4).'-'.substr($row1[0],3,2).'-'.substr($row1[0],0,2);
                $banco=2;
                }
                
                
                if($ref>0 and $importe>0 and $abono=='ABONO'){
                $s="select *from catalogo.sucursal where referencia=$ref and banco=$banco";
                $q=$this->db->query($s);
                if($q->num_rows()>0){
                $r=$q->row();
                $suc=$r->suc;}else{$suc=0;}//echo $ref;
                
                $ins="insert ignore into vtadc.banco_deposito_venta(fecha,ref1,ref2,importe,suc,mov,banco)values
                ('$fecha',$ref,$ref2,'$importe',$suc,$mov,$banco)";
                $this->db->query($ins);
                }
                
                
              }
            
            ///Escribir codigo siguiente aqui
        } else {
            echo 'error opening the file.';
        }
        
        die(); 
        fclose($handle);    
    redirect('lidia/s_deposito_p');
    }


function s_deposito_p_consilia()
    {
        $data['titulo']='';
        $this->ventas_model->consilia_ficha();
        $this->load->view('main', $data);
    }































////////////////////////////////////////////////////
////////////////////////////////////////////////////


function __depositos_correo()
{
$s="SELECT b.cia,fecha_ficha,b.tipo2,c.corto as imagen,DAYOFWEEK(fecha_ficha),
sum(importe)as importe,
case
when DAYOFWEEK(fecha_ficha)=1 then 'DOMINGO'
when DAYOFWEEK(fecha_ficha)=2 then 'LUNES'
when DAYOFWEEK(fecha_ficha)=3 then 'MARTES'
when DAYOFWEEK(fecha_ficha)=4 then 'MIERCOLES'
when DAYOFWEEK(fecha_ficha)=5 then 'JUEVES'
when DAYOFWEEK(fecha_ficha)=6 then 'VIERNES'
when DAYOFWEEK(fecha_ficha)=7 then 'SABADO'
else ' ' end as nom_dia
FROM vtadc.vta_captura_diaria_deposito a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.COMPA c on c.cia=b.cia
where fecha_ficha>=subdate(date(now()),3) and fecha_ficha < date(now()) and a.activo=1
group by DAYOFWEEK(fecha_ficha),b.cia
order by fecha_ficha desc,b.cia
";
$lidia='';
$lidia.="
<table>
<tr>
<td>Buenos d&iacute;as</td>
</tr>
<tr>
<td>Env&iacute;o reporte de ventas</td>
<tr>
</table>";
 $q=$this->db->query($s);$timporte=0;   
 foreach ($q->result()as $r)
        {
        $a[$r->fecha_ficha]['fecha_ficha'] = $r->fecha_ficha;
        $a[$r->fecha_ficha]['nom_dia'] = $r->nom_dia;
        $a[$r->fecha_ficha]['d'][$r->cia]['cia'] = $r->cia;
        $a[$r->fecha_ficha]['d'][$r->cia]['imagen'] = $r->imagen;
        $a[$r->fecha_ficha]['d'][$r->cia]['importe'] = $r->importe;
        }
 $tic=0;$importe=0;
 $num=0;
 $lidia.="<table border='1' celpadding='2'>
 <thead>
 <title>Prueba de correo</title> 
 </thead>
 <tbody>
 ";
 foreach ($a as $r0) {
$lidia.="
<tr>
<td></td>
<td></td>
</tr>
<tr>
<th style=\"color: blue; text-align: center\">".$r0['fecha_ficha']."</th>
<th style=\"color: blue; text-align: right\">Importe</th>

</tr>";
foreach ($r0['d'] as $r) {
$lidia.="
<tr>
                                
<td style=\"color: blue; text-align: left\">".$r['imagen']."</td>
<td style=\"color: gray;text-align: right;\">".number_format($r['importe'],2)."</td>
</tr>";
$importe=$importe+$r['importe']; 
$timporte=$timporte+$r['importe'];
}
$lidia.="
<tr>
<td style=\"text-align: left\"><strong> TOTAL ".$r0['nom_dia']."</strong></td>
<td style=\"text-align: right;\"><strong>".number_format($timporte,2)."</strong></td>                                  
</tr>";
$importe=0;}
$lidia.="
</tbody>
</table>";
return $lidia;   
}
////////////////////////////////////////////////////
function prueba_enlace()
{
 $this->backoffice_model_central->global_total();    
}

//recorer todos los meses del año

function actua()
{
$this->lidia_model->pinche_baras();    
}
function asi()
{
$this->lidia_model->pp();    
}


function glo()
{
$this->lidia_model->inserta_pedido_for_especial();    
}


public function evalua_inv_para_poliza()
{
$s="SELECT a.back,a.tipo2,a.suc,a.nombre,b.piezas as p_ant,b.importe as i_ant,c.piezas as p_ant,c.importe as i_ant
FROM catalogo.sucursal a
left join oficinas.inv_mes_suc_his b on b.suc=a.suc and b.sem=(select max(sem) from oficinas.inv_mes_suc_his)
left join oficinas.inv_mes_suc c on c.suc=a.suc
where
tlid=1 and a.suc>100 and a.suc<=1605 and b.piezas=c.piezas
or
a.suc in(100,16000,14000,12000,19000) and b.piezas=c.piezas
or
tlid=1 and a.suc>100 and a.suc<=1605 and c.piezas is null
or
a.suc in(100,16000,14000,12000,19000) and c.piezas is null
or
tlid=1 and a.suc>100 and a.suc<=1605 and c.importe=0
or
a.suc in(100,16000,14000,12000,19000)  and c.importe=0";
}
////////////////////////////////////////////////////
function correo_faltantes()
{
$cuerpo=$this->__faltantes();
         $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.farfenix.com.mx',
            'smtp_user' => 'lidia.velazquez@farfenix.com.mx',
            'smtp_pass' => 'li9469',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $subject='Envio Ventas diarias';
        $cc='
'; 
        $correo='

lidia.velazquez@farfenix.com.mx
';
        $this->email->from('lidia.velazquez@farfenix.com.mx','Ventas diarias');
        $this->email->to($correo);
        $this->email->cc($cc);
        $this->email->subject($subject);
        $this->email->message($cuerpo);

        $this->email->send();
        
        echo 'Correos Enviados a: '.$correo.' '.date('Y-m-d H:i:s');
}
function __faltantes()
{
$s="SELECT a.tipo,x.obser,count(*)as productos,
(sum(case when existencia<=0 or existencia is null then (1) else (0) end))as faltantes,
round((((sum(case when existencia=0 or existencia is null then (1) else (0) end))/count(*))*100),2)as p_faltante,
(sum(case when existencia>0  then (1) else (0) end))as abasto,
100-(round((((sum(case when existencia=0 or existencia is null then (1) else (0) end))/count(*))*100),2))as p_abasto,


(select
(round((100*(sum(case when ifnull(cantidad,0)>ifnull(final,0) then ifnull(final,0) else ifnull(cantidad,0) end)/sum(aa.final))),2))nivel_surtido

from catalogo.cat_almacen_clasifica xx
left join almacen.max_sucursal aa on aa.sec=xx.sec
left join desarrollo.inv bb on bb.suc=aa.suc and bb.sec=xx.sec and mov=7
join catalogo.sucursal cc on cc.suc=aa.suc and dia<>'CER' and tipo3='DA' and tlid=1
where xx.descon='N' and xx.tipo=a.tipo
group by xx.tipo)as p_abasto_far


FROM catalogo.cat_almacen_clasifica a
left join inventarios.historico_inv_cedis c on c.sec=a.sec and fecha=date(now())
left join catalogo.cat_clasifica x on x.var=a.tipo and x.descontinua=a.descon
where descon='N'
group by tipo
";
$lidia='';
$lidia.="
<table>
<tr>
<td>Buenos d&iacute;as</td>
</tr>
<tr>
<td>Env&iacute;o reporte de ventas</td>
<tr>
</table>";
 $q=$this->db->query($s);$timporte=0;   
 foreach ($q->result()as $r)
        {
        $a[$r->fecha_ficha]['fecha_ficha'] = $r->fecha_ficha;
        $a[$r->fecha_ficha]['nom_dia'] = $r->nom_dia;
        $a[$r->fecha_ficha]['d'][$r->cia]['cia'] = $r->cia;
        $a[$r->fecha_ficha]['d'][$r->cia]['imagen'] = $r->imagen;
        $a[$r->fecha_ficha]['d'][$r->cia]['importe'] = $r->importe;
        }
 $tic=0;$importe=0;
 $num=0;
 $lidia.="<table border='1' celpadding='2'>
 <thead>
 <title>Prueba de correo</title> 
 </thead>
 <tbody>
 ";
 foreach ($a as $r0) {
$lidia.="
<tr>
<td></td>
<td></td>
</tr>
<tr>
<th style=\"color: blue; text-align: center\">".$r0['fecha_ficha']."</th>
<th style=\"color: blue; text-align: right\">Importe</th>

</tr>";
foreach ($r0['d'] as $r) {
$lidia.="
<tr>
                                
<td style=\"color: blue; text-align: left\">".$r['imagen']."</td>
<td style=\"color: gray;text-align: right;\">".number_format($r['importe'],2)."</td>
</tr>";
$importe=$importe+$r['importe']; 
$timporte=$timporte+$r['importe'];
}
$lidia.="
<tr>
<td style=\"text-align: left\"><strong> TOTAL ".$r0['nom_dia']."</strong></td>
<td style=\"text-align: right;\"><strong>".number_format($timporte,2)."</strong></td>                                  
</tr>";
$importe=0;}
$lidia.="
</tbody>
</table>";
return $lidia;    
}







































public function pdv_promosion_yucif()
{
 $aaa=2014; $sem=33;   
$sqlx="select b.codigo,'50.00'as des,'20140813'as feci,'20151231'as fecf 
from almacen.pdv_promo a,catalogo.almacen b where b.sec=a.sec";
//$sqlx="select *from inv_cosvta where importe>0 and sem>7 and aaaa=$aaa order by sem";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/cDpromo.txt";
    $Handle = fopen($File, 'w');

foreach($queryx->result() as $rowx)  
{
    $Data=
         str_pad($rowx->codigo,13,"0",STR_PAD_LEFT)
        .str_pad($rowx->des,6,"0",STR_PAD_LEFT)
        .str_pad($rowx->feci,8,"0",STR_PAD_LEFT)
        .str_pad($rowx->fecf,8,"0",STR_PAD_LEFT)
        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
}
fclose($Handle); 

die();
}}

public function pdv_promosion_yucif_archivo()
{
$sqlx="select a.codigo,round((100-((precio_oferta/vtagen)*100)),2)as des,replace(fecha_activos,'-','') as feci,replace(fecha_fin,'-','') as fecf
FROM compras.ofertas_genericos a
join catalogo.almacen b on b.codigo=a.codigo
where precio_oferta<=vtagen and a.sec>0 and a.sec<=1999 and date(now()) between fecha_activos and fecha_fin
order by a.sec";
//$sqlx="select *from inv_cosvta where importe>0 and sem>7 and aaaa=$aaa order by sem";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/cDpromo.txt";
    $Handle = fopen($File, 'w');

foreach($queryx->result() as $rowx)  
{
    $Data=
         str_pad($rowx->codigo,13,"0",STR_PAD_LEFT)
        .str_pad($rowx->des,6,"0",STR_PAD_LEFT)
        .str_pad($rowx->feci,8,"0",STR_PAD_LEFT)
        .str_pad($rowx->fecf,8,"0",STR_PAD_LEFT)
        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
}
fclose($Handle); 

die();
}}
///////////////////////////////////////////////////////////////checame


///////////////////////////////////////////////////////////////checame
function checarr()
{
$s1="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/FA20140728.33'
replace INTO TABLE subir10.p_factura_n LINES TERMINATED BY '\r\n'";
$this->db->query($s1);

$s1="SELECT
case when substring(todo,1,2)='C:' then  substring(todo,12,7) end suc,
case when substring(todo,1,1)='F' then  concat(substring(todo,92,2),substring(todo,98,7)) end fac,
case when substring(todo,1,1)='F' then  substring(todo,18,8) end fecha,
case when substring(todo,1,1)='P' then  substring(todo,90,14) end cod,
case when substring(todo,1,1)='P' then  substring(todo,10,6) end can,
case when substring(todo,1,1)='P' then  (substring(todo,81,8)/100) end cos,
case when substring(todo,1,1)='P' then  (substring(todo,59,8)/100) end iva,
case when substring(todo,1,1)='P' then  (substring(todo,67,8)/100) end ieps
FROM subir10.p_factura_n ";
$q=$this->db->query($s1);
foreach ($q->result() as $r)
{
if($r->suc<>null){$suc=$r->suc;}
if($r->fac<>null){$fac=$r->fac;$fecha=$r->fecha;}

if($r->cod<>null)
 {
 $cod=$r->cod;
 $can=$r->can;
 $cos=$r->cos;
 $iva=($r->iva*$r->can);
 $ieps=($r->ieps*$r->can);
 $impor=(($can*$cos)+($iva)+($ieps));
$guarda="insert ignore compras.pre_factura_fenix
(prv, fecha, suc, fac, cod, can, far, importe, iva, ieps, descuento, fec_pedido)
values(221,adddate($fecha,1),$suc,'$fac',$cod,$can,'$cos','$impor','$iva','$ieps',0,'$fecha')";
$this->db->query($guarda);
}}
    
    
}
///////////////////////////////////////////////////////////////checame

































/////////////////////////////////////////////////////7
function arreglo_pre_pedido_todos()
{
    $pat=13;
    $mat=7;
$s1="delete from compras.pre_pedido_fenix_for";
$this->db->query($s1);    
$s2="insert into compras.pre_pedido_fenix (fecha, suc, cod, descri, piezas, costo, prv)
(select date(now()), a.suc,a.codigo,a.descri,
case when b.lin=1 then round(((optimo_d*$pat)-inv),0)
else round(((optimo_d*$mat)-inv),0)
end as can,0,0
FROM oficinas.optimo_fenix a
left join catalogo.cat_mercadotecnia b on b.codigo=a.codigo
where
case when b.lin=1 then round(((optimo_d*$pat)-inv),0)
else round(((optimo_d*$mat)-inv),0)
end>'0.99'
and cod_rel1>0 and optimo_d>0 and b.sublin not in(3,4,5,6) and b.lin=1 and
(case when b.lin=1 then round(((optimo_d*$pat)-inv),0)
else round(((optimo_d*$mat)-inv),0)
end) is not null)";
$this->db->query($s2);    
$s3="update compras.pre_pedido_fenix a,catalogo.cat_marzam b
set a.costo=b.costo,prv=500
where a.cod=b.codigo and b.producto<>' ' and a.costo=0";
$this->db->query($s3);   
die();
$s4="update compras.pre_pedido_fenix a,catalogo.cat_nadro b,catalogo.cat_clientes_mayoris c
set a.costo=b.costo,a.prv=221
where a.cod=b.codigo and a.suc=c.suc and c.prv=221 and a.costo=0";
$this->db->query($s4);    
$s5="update compras.pre_pedido_fenix a,catalogo.cat_fanasa b
set a.costo=b.costo,a.prv=825
where a.cod=b.codigo and a.costo=0";
$this->db->query($s5);    
die();



$i1="insert ignore into compras.pre_pedido_fenix_det(fecha, tipo, fol, prv, suc, cod, descri, piezas, costo)
(select fecha, 'A',0,prv,suc, cod, descri, piezas, costo from compras.pre_pedido_fenix where prv=500 and costo>0)";
$this->db->query($i1);
$i2="insert ignore into compras.pre_pedido_fenix_ctl(fecha, prv, suc, importe, fol, tipo, canp, imp_facturado)
(SELECT fecha,prv,suc,sum(piezas*costo),0,'A',sum(piezas),0
FROM compras.pre_pedido_fenix_det
where fecha=date(now()) and tipo='A' and prv=500 and fol=0
group by fecha,suc,prv)
";
$this->db->query($i2);

}







public function pre_pedido_nadro()
{
$parametro=7;
$s="select
concat(51,num,'202')as var,

b.lin,b.sublin,c.num,a.suc,a.codigo,b.descripcion,b.cos_nadro,

case when b.lin=1 then round(((optimo_d*$parametro)-inv),0)
else round(((optimo_d*7)-inv),0)
end as can,

case when b.lin=1 then round(((optimo_d*$parametro)-inv),0)*cos_nadro
else round(((optimo_d*7)-inv),0)*cos_nadro
end

FROM oficinas.optimo_fenix a
left join catalogo.cat_mercadotecnia b on b.codigo=a.codigo
LEFT JOIN catalogo.cat_clientes_mayoris c on c.suc=a.suc
LEFT JOIN catalogo.cat_marzam x on x.codigo=a.codigo
where
case when b.lin=1 then round(((optimo_d*$parametro)-inv),0)
else round(((optimo_d*7)-inv),0)
end>'0.99'
and cod_rel1>0 and optimo_d>0 and b.cos_nadro>0 and lin=1 and sublin in(1,2,7,8,9,10,11,12) and x.lab not like'%glaxo%'
or
case when b.lin=1 then round(((optimo_d*$parametro)-inv),0)
else round(((optimo_d*7)-inv),0)
end>'0.99'
and cod_rel1>0 and optimo_d>0 and b.cos_nadro>0 and lin>1  and x.lab not like'%glaxo%'

order by suc
";
$q=$this->db->query($s);

$File = "./txt/pedido.txt";
$Handle = fopen($File, 'w');
foreach($q->result() as $r)
{
if($r->can>0){
    
 $Data=
         
         str_pad($r->var,12," ",STR_PAD_RIGHT)
        .str_pad($r->codigo,14," ",STR_PAD_RIGHT)
        .str_pad($r->can,4,"0",STR_PAD_LEFT)
        .str_pad('0000000000',10," ",STR_PAD_LEFT)
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle, $Data);
    
}}
fwrite($Handle, $Data);
fclose($Handle); 
   
$servidor_ftp    = "fenixcentral.homeip.net";
$ftp_nombre_usuario = "nadro";
$ftp_contrasenya = "N4dr08";

$archivo = './txt/pedido.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'pedido.txt';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (
ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)

){
    $mensaje=1;
} else {
    $mensaje=2;
}
ftp_close($id_con);
fclose($da);    
    
}
public function pre_pedido_nadro_especial()
{
$s="select concat(51,num,'202')as var,a.cod as codigo,sum(piezas) as can
FROM compras.pre_pedido_fenix_especial a
LEFT JOIN catalogo.cat_clientes_mayoris c on c.suc=a.suc and c.prv=a.prv
where
a.prv=221 and num is not null 
group by a.suc,cod
order by a.suc
";
$q=$this->db->query($s);

$File = "./txt/pedido.txt";
$Handle = fopen($File, 'w');
foreach($q->result() as $r)
{
if($r->can>0){
    
 $Data=
         
         str_pad($r->var,12," ",STR_PAD_RIGHT)
        .str_pad($r->codigo,14," ",STR_PAD_RIGHT)
        .str_pad($r->can,4,"0",STR_PAD_LEFT)
        .str_pad('0000000000',10," ",STR_PAD_LEFT)
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle, $Data);
    
}}
fwrite($Handle, $Data);
fclose($Handle); 
   
$servidor_ftp    = "fenixcentral.homeip.net";
$ftp_nombre_usuario = "nadro";
$ftp_contrasenya = "N4dr08";

$archivo = './txt/pedido.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'pedido.txt';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (
ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)

){
    $mensaje=1;
} else {
    $mensaje=2;
}
ftp_close($id_con);
fclose($da);    
    
}

public function pre_pedido_forma2()
{
$ss="select concat('NNADRO',c.num,'000',' ','000000000000000',date_format(date(now()),'%Y%m%d'))as nombre,
a.suc
FROM oficinas.optimo_fenix a
left join catalogo.cat_mercadotecnia b on b.codigo=a.codigo
LEFT JOIN catalogo.cat_clientes_mayoris c on c.suc=a.suc
where
case when b.lin=1 then round(((optimo_d*15)-inv),0)
else round(((optimo_d*7)-inv),0)
end>'0.99'
and cod_rel1>0 and optimo_d>0 and b.cos_nadro>0 and lin=1 and sublin in(1,2,9,10,11,12) and a.suc=230
or
case when b.lin=1 then round(((optimo_d*15)-inv),0)
else round(((optimo_d*7)-inv),0)
end>'0.99'
and cod_rel1>0 and optimo_d>0 and b.cos_nadro>0 and lin>1 and a.suc=230
or
case when b.lin=1 then round(((optimo_d*15)-inv),0)
else round(((optimo_d*7)-inv),0)
end>'0.99'
and cod_rel1>0 and optimo_d>0 and b.cos_nadro>0 and lin=1 and sublin in(7,8)
group by a.suc order by a.suc";
$qq=$this->db->query($ss);
$File = "./txt/NPFFENIX.txt";
$Handle = fopen($File, 'w');

foreach($qq->result() as $rr)
{
    
 $Data=
         
         str_pad($rr->nombre,40," ",STR_PAD_RIGHT)
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle, $Data);
    

$s="select 
concat(51,num,'202')as var,

b.lin,b.sublin,c.num,a.suc,a.codigo,b.descripcion,b.cos_nadro,

case when b.lin=1 then round(((optimo_d*15)-inv),0)
else round(((optimo_d*7)-inv),0)
end as can,

case when b.lin=1 then round(((optimo_d*15)-inv),0)*cos_nadro
else round(((optimo_d*7)-inv),0)*cos_nadro
end

FROM oficinas.optimo_fenix a
left join catalogo.cat_mercadotecnia b on b.codigo=a.codigo
LEFT JOIN catalogo.cat_clientes_mayoris c on c.suc=a.suc
where
case when b.lin=1 then round(((optimo_d*15)-inv),0)
else round(((optimo_d*7)-inv),0)
end>'0.99'
and cod_rel1>0 and optimo_d>0 and b.cos_nadro>0 and lin=1 and sublin in(1,2,9,10,11,12) and a.suc=230 and a.suc=$rr->suc
or
case when b.lin=1 then round(((optimo_d*15)-inv),0)
else round(((optimo_d*7)-inv),0)
end>'0.99'
and cod_rel1>0 and optimo_d>0 and b.cos_nadro>0 and lin>1 and a.suc=230  and a.suc=$rr->suc
or 
case when b.lin=1 then round(((optimo_d*15)-inv),0)
else round(((optimo_d*7)-inv),0)
end>'0.99'
and cod_rel1>0 and optimo_d>0 and b.cos_nadro>0 and lin=1 and sublin in(7,8)  and a.suc=$rr->suc

";
$q=$this->db->query($s);


foreach($q->result() as $r)
{
if($r->can>0){
    
 $Data=
         
         str_pad($r->codigo,14," ",STR_PAD_RIGHT)
        .str_pad($r->can,6,"0",STR_PAD_LEFT)
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle, $Data);
    
}}}
fwrite($Handle, $Data);
fclose($Handle); 
   
$servidor_ftp    = "fenixcentral.homeip.net";
$ftp_nombre_usuario = "nadro";
$ftp_contrasenya = "N4dr08";

$archivo = './txt/NPFFENIX.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'NPFFENIX.txt';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (
ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)

){
    $mensaje=1;
} else {
    $mensaje=2;
}
ftp_close($id_con);
fclose($da);    
    
}


public function pre_pedido_marzam()
{

$s="select num as var,
a.codigo,
case when b.lin=1 then round(((optimo_d*15)-inv),0)
else round(((optimo_d*7)-inv),0)
end as can,

case when b.lin=1 then round(((optimo_d*15)-inv),0)*x.costo
else round(((optimo_d*7)-inv),0)*x.costo
end

FROM oficinas.optimo_fenix a
left join catalogo.cat_mercadotecnia b on b.codigo=a.codigo
LEFT JOIN catalogo.cat_clientes_mayoris c on c.suc=a.suc
LEFT JOIN catalogo.cat_marzam x on x.codigo=a.codigo
where
case when b.lin=1 then round(((optimo_d*15)-inv),0)
else round(((optimo_d*7)-inv),0)
end>'0.99'
and cod_rel1>0 and optimo_d>0 and id_prv=39 and x.lab like '%glaxo%'
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
$servidor_ftp    = "ftp://200.38.152.241";
$ftp_nombre_usuario = "fenix";
$ftp_contrasenya = "f3nix";

$archivo = './txt/marzam.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'FF0121920001.txt';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (
ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)

){
    $mensaje=1;
} else {
    $mensaje=2;
}
ftp_close($id_con);
fclose($da);    
    
}

public function pre_pedido_marzam_solo_patente()
{

$s="select fecha,num as var,a.suc,b.lin,b.sublin,a.cod as codigo,
a.piezas as can
FROM compras.pre_pedido_fenix_det a
left join catalogo.cat_mercadotecnia b on b.codigo=a.cod
LEFT JOIN catalogo.cat_clientes_mayoris c on c.suc=a.suc and a.prv=c.prv
where a.prv=500 and num<>'||' and num<>'__' and fol=15
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
$archivo_remoto = 'in/FF0121920000.txt';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (
ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)

){
    $mensaje=1;
} else {
    $mensaje=2;
}
ftp_close($id_con);
fclose($da);
    
$s1="insert ignore into compras.pre_pedido_fenix_det(fecha, tipo, fol, prv, suc, cod, descri, piezas, costo)
(select fecha, 'C',(select max(fol) from compras.pre_pedido_fenix_ctl)+1,prv,suc, cod, descri, piezas, costo
from compras.pre_pedido_fenix where prv=500)";
//$this->db->query($s1);
$s2="insert into compras.pre_pedido_fenix_ctl(fecha, suc, prv, importe, fol, tipo,canp)
(select fecha, suc,prv,sum(costo*piezas),(select max(fol) from compras.pre_pedido_fenix_ctl)+1,'C',sum(piezas)
from compras.pre_pedido_fenix where prv=500 group by suc)";
//$this->db->query($s2);
$s3="delete from compras.pre_pedido_fenix where prv=500";
//$this->db->query($s3);    
}


public function pre_pedido_marzam_especial()
{

$s="select b.num as var,a.cod as codigo,sum(piezas)as can from compras.pre_pedido_fenix_especial a
left join catalogo.cat_clientes_mayoris b on a.suc=b.suc and b.id_prv=39
where a.costo>0 and b.num is not null and a.prv=500
group by a.suc,a.cod
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
$archivo_remoto = 'in/FF0121920009.txt';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (
ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)

){
    $mensaje=1;
} else {
    $mensaje=2;
}
ftp_close($id_con);
fclose($da);    
    
}

function recalcula_optimo_da()
{
$var1='venta5';
$var2='venta6';
$var3='venta7';
$dia='MAR';
$s="update almacen.max_sucursal set uno=0,dos=0,tres=0,cuatro=0";
$this->db->query($s);

$s0="update almacen.max_sucursal a, catalogo.almacen_paquetes b
set paquete=b.can
where a.sec=b.sec";
$this->db->query($s0);

$s00="update almacen.max_sucursal a, vtadc.producto_mes_suc_gen b, catalogo.sucursal d
set uno=$var1,dos=$var2,tres=$var3
where a.suc=b.suc and a.sec=b.sec and tipo3='DA' and tlid=1";
$this->db->query($s00);

$s1="update almacen.max_sucursal a
set correcto=round(case
when uno>0 and dos>0 and tres>0
then (((uno+dos+tres)/3) *1)
when
uno>0 and dos>0 and tres=0 or
uno>0 and dos=0 and tres>0 or
uno=0 and dos>0 and tres>0
then (((uno+dos+tres)/2) *1)
when
uno=0 and dos=0 and tres>0 or
uno=0 and dos>0 and tres=0 or
uno>0 and dos=0 and tres=0
then (((uno+dos+tres)/1) *1)

else (final/2) end)
";
$this->db->query($s1);
$s2="update almacen.max_sucursal
set correcto=case when round(correcto/paquete)=0 then paquete else (round(correcto/paquete)*paquete) end
where paquete>1 and correcto<>paquete";
$this->db->query($s2);
die();
$s="select regional,superv,
(select nombre from compras.usuarios x where x.tipo=1 and x.nivel=13 and x.id_plaza=b.superv group by x.id_plaza),
a.suc,b.nombre, a.sec,c.susa,final,
case
when uno=0 and dos=0 and tres=0 and cuatro=0
then a.final
when paquete >0
then correcto else
round(((a.correcto)*1.5))
end as nuevo_max,
(uno),(dos),(tres),(cuatro)
From almacen.max_sucursal a
join catalogo.sucursal b on b.suc=a.suc and tipo3='DA'
join catalogo.cat_almacen_clasifica c on c.sec=a.sec
where descon='N' and tlid=1 and regional=91
";

$s="select regional,superv,
(select nombre from compras.usuarios x where x.tipo=1 and x.nivel=13 and x.id_plaza=b.superv group by x.id_plaza),
a.suc,b.nombre, c.tipo,a.sec,c.susa,final,
case
when c.tipo='d' and paquete<=1
then round((a.correcto/2))
when uno=0 and dos=0 and tres=0 and cuatro=0 and c.tipo<>'d'
then a.final
when paquete >0
then correcto else
round(((a.correcto)*1.2))
end as nuevo_max,

(uno),(dos),(tres),(cuatro),

case when round(case
when c.tipo='d' and paquete<=1
then (round((a.correcto/2))*.2)
when uno=0 and dos=0 and tres=0 and cuatro=0 and c.tipo<>'d'
then (a.final*.40)
when paquete >0
then (correcto*.40) else
(round(((a.correcto)*1.2))*.40)
end)=0 then 1 else
round(case
when c.tipo='d' and paquete<=1
then (round((a.correcto/2))*.2)
when uno=0 and dos=0 and tres=0 and cuatro=0 and c.tipo<>'d'
then (a.final*.40)
when paquete >0
then (correcto*.40) else
(round(((a.correcto)*1.2))*.40)
end) end as min,


ifnull((select cantidad from desarrollo.inv x where x.suc=a.suc and x.sec=a.sec and mov=7 and fechai>='2015-07-27'),0)as inv,

case when ifnull((select cantidad from desarrollo.inv x where x.suc=a.suc and x.sec=a.sec and mov=7 and fechai>='2015-07-27'),0)>
(case
when c.tipo='d' and paquete<=1
then round((a.correcto/2))
when uno=0 and dos=0 and tres=0 and cuatro=0 and c.tipo<>'d'
then a.final
when paquete >0
then correcto else
round(((a.correcto)*1.2))
end)
then
(ifnull((select cantidad from desarrollo.inv x where x.suc=a.suc and x.sec=a.sec and mov=7 and fechai>='2015-07-27'),0))-
(case
when c.tipo='d' and paquete<=1
then round((a.correcto/2))
when uno=0 and dos=0 and tres=0 and cuatro=0 and c.tipo<>'d'
then a.final
when paquete >0
then correcto else
round(((a.correcto)*1.2))
end)
else 0 end as exc

From almacen.max_sucursal a
join catalogo.sucursal b on b.suc=a.suc and tipo3='DA'
join catalogo.cat_almacen_clasifica c on c.sec=a.sec
where descon='N' and tlid=1 and regional=92
";
}


}




?>