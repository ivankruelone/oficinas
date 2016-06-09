<?php
	class Envio_model_as400_fin extends CI_Model {


    function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
public function envia_inv_as400($aaa,$sem)
{
 
$sqlx="select *from inventarios.inv_cosvta where importe>0 and sem=$sem and aaa=$aaa";
//$sqlx="select *from inv_cosvta where importe>0 and sem>7 and aaaa=$aaa order by sem";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/cosvta.txt";
    $Handle = fopen($File, 'w');
$imp=0;
foreach($queryx->result() as $rowx)  
{
  $imp= round(($rowx->importe*100),0);
    $Data=
         str_pad($rowx->cia,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->suc,8,"0",STR_PAD_LEFT)
        .str_pad($rowx->sem,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->aaa,4,"0",STR_PAD_LEFT)
        .str_pad($rowx->mes,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->lin,5,"0",STR_PAD_LEFT)
        .str_pad($rowx->plaza,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->succ,4,"0",STR_PAD_LEFT)
        .str_pad(number_format($imp, 0, '', ''),11,"0",STR_PAD_LEFT)
        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
    
}
fclose($Handle); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$mensaje='Hola';
$servidor_ftp    = '192.168.1.3';
$ftp_nombre_usuario = "lidia";
$ftp_contrasenya = "puepue19";

$archivo = './txt/cosvta.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'candado/invliw';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)) {
    $mensaje='Ya fue enviado el archivo de la poliza de inventario semanal de la semana '.$sem.' al as400; por favor continua con tu proceso en el sistema';
} else {
    $mensaje='Hay problemas al enviar el archivo';
}

ftp_close($id_con);
fclose($da);
}
  
    return $mensaje; 

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////




public function poliza_almacen($fecha)
{

$as="update  pedidos a, catalogo.almacen b set a.lin=b.lin where a.sec=b.sec and a.lin=0";
$this->db->query($as);

$sqlx="SELECT b.cia,34 as pol,date_format(fechasur,'%Y')as aaa,date_format(fechasur,'%m')as mes,a.costo,sum(sur*costo)as bb,
date_format(fechasur,'%d')as dia, b.plaza,b.suc_contable,a.lin,b.iva,
a.suc,

case when b.cia=13
then sum(sur*costo)*1.2
else
sum(sur*costo)*1.2
end as sub,

case when a.lin=5 or a.lin=2
then (
(case when b.cia=13
then sum(sur*costo)*1.2
else
sum(sur*costo)*1.2
end)
*b.iva)
else
0
end as ivaimp,



(case when b.cia=13
then sum(sur*costo)*1.2
else
sum(sur*costo)*1.2
end)+(case when a.lin=5 or a.lin=2
then (
(case when b.cia=13
then sum(sur*costo)*1.2
else
sum(sur*costo)*1.2
end)
*b.iva)
else
0
end)
as total

FROM  PEDIDOS a
left join catalogo.sucursal b on b.suc=a.suc
WHERE a.SUC>100  AND DATE_FORMAT(FECHASUR,'%Y-%m')='$fecha' and sur>0 
group by suc, lin
order by suc ";


$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/cosalm.txt";
    $Handle = fopen($File, 'w');
$cero=0;
foreach($queryx->result() as $rowx)  
{
    

$subx=round($rowx->sub*100);
$ivax=round($rowx->ivaimp*100);
$tot=round($rowx->total*100);



echo $subx.' suc-'.$ivax.'-'.$rowx->suc.'<br />';   
$Data=
         str_pad($rowx->cia,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->pol,7,"0",STR_PAD_LEFT)
        .str_pad($rowx->aaa,4,"0",STR_PAD_LEFT)
        .str_pad($rowx->mes,2,"0",STR_PAD_LEFT)
        .str_pad('31',2,"0",STR_PAD_LEFT)
        .str_pad($rowx->plaza,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->suc_contable,2,"0",STR_PAD_LEFT)
        .str_pad($rowx->lin,5,"0",STR_PAD_LEFT)
        .str_pad($subx,11,"0",STR_PAD_LEFT)
        .str_pad($cero,4,"0",STR_PAD_LEFT)
        .str_pad($ivax,11,"0",STR_PAD_LEFT)
        .str_pad($cero,4,"0",STR_PAD_LEFT)
        .str_pad($tot,11,"0",STR_PAD_LEFT)
        .str_pad($cero,4,"0",STR_PAD_LEFT)
        .str_pad($rowx->suc,8,"0",STR_PAD_LEFT)
        ."\r\n";
    //echo $linea;
    
    fwrite($Handle, $Data);
}

fclose($Handle); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

//die();
$servidor_ftp    = "10.10.0.5";
$ftp_nombre_usuario = "lidia";
$ftp_contrasenya = "puepue19";

$archivo = './txt/cosalm.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'formula/almcona';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)) {
    $mensaje=1;
} else {
    $mensaje=2;
}

ftp_close($id_con);
fclose($da);
}
  
    return $mensaje; 
}
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
public function poliza_almacen_exel($fecha)
{


$sqlx="SELECT b.cia,34 as pol,date_format(fechasur,'%Y')as aaa,date_format(fechasur,'%m')as mes,
a.costo,

case when b.cia=13
then sum(sur*costo)*1.2
else
sum(sur*costo)*1.2
end as sub,

case when a.lin=5 or a.lin=2
then (
(case when b.cia=13
then sum(sur*costo)*1.2
else
sum(sur*costo)*1.2
end)
*b.iva)
else
0
end as ivaimp,



(case when b.cia=13
then sum(sur*costo)*1.2
else
sum(sur*costo)*1.2
end)+(case when a.lin=5 or a.lin=2
then (
(case when b.cia=13
then sum(sur*costo)
else
sum(sur*costo)*1.2
end)
*b.iva)
else
0
end)
as total,
sum(sur*costo)as bb, b.plaza,b.suc_contable,a.lin,a.iva,
a.suc,a.sec,a.vta,a.susa,b.nombre,sum(sur)as sur
FROM  PEDIDOS a
left join catalogo.sucursal b on b.suc=a.suc
WHERE a.SUC>100  AND DATE_FORMAT(FECHASUR,'%Y-%m')='$fecha' and sur>0 
group by suc, sec
order by suc ";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/cosalmdet.txt";
    $Handle = fopen($File, 'w');
$cero=0;
$corte='|';
$Data=
         str_pad('CIA',3," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('POL',7," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('AAAA',4," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('MES',3," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SUC',8," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SUCURSAL',15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('PLAZA',5," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SUCC',2," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SEC',4," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SUSTANCIA ACTIVA',60," ",STR_PAD_RIGHT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('PIEZAS',7," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SUB_COST',15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('IVA_COS',15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('TOT_COS',15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('SUB_VTA',15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('IVA_VTA',15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad('TOT_VTA',15," ",STR_PAD_LEFT)
        
        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);

foreach($queryx->result() as $rowx)  
{
if($rowx->cia==13){$sub=$rowx->bb;$sub_vta=$sub*1.15;}else{$sub=$rowx->bb*1.15;$sub_vta=($rowx->bb*1.15)*1.15;}
if($rowx->lin==2 || $rowx->lin==5){$iva=$sub*$rowx->iva;$iva_vta=$sub_vta*$rowx->iva;}else{$iva=0;$iva_vta=0;}
$subx=round($sub,2);
$ivax=round($iva,2);
$tot=round($sub,2)+round($iva,2);
$sub_vtax=round($sub_vta,2);
$iva_vtax=round($iva_vta,2);
$tot_vta=round($sub_vta,2)+round($iva_vta,2);

echo $subx.'suc-'.$ivax.'-'.'<br />';   
$Data=
         str_pad($rowx->cia,2,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->pol,7,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->aaa,4,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->mes,2,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->suc,8,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->nombre,15," ",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->plaza,2,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->suc_contable,2,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->sec,4,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->susa,60," ",STR_PAD_RIGHT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->sur,7,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->sub,15,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->ivaimp,15,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($rowx->total,15,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($sub_vtax,15,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($iva_vtax,15,"0",STR_PAD_LEFT)
        .str_pad($corte,1," ",STR_PAD_LEFT)
        .str_pad($tot_vta,15,"0",STR_PAD_LEFT)
        
        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
}
fclose($Handle); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//die();

$servidor_ftp    = "10.10.0.5";
$ftp_nombre_usuario = "lidia";
$ftp_contrasenya = "puepue19";

$archivo = './txt/cosvta.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'formula/invliw';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)) {
    $mensaje=1;
} else {
    $mensaje=2;
}

ftp_close($id_con);
fclose($da);
}
  
    return $mensaje; 
    
}
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
public function reporte_entradas_salidas()
{
$fec1='2013-11-01';
$fec2='2013-11-08';    
$aaa=2013; $mes=11;
$s="select a.sec,a.susa1,

(ifnull((select sum(can) from desarrollo.compra_d b where b.sec=a.sec and fechai>='$fec1' and date_format(fechai,'%Y-%m-%d')<='$fec2'
group by a.sec),0)
+
ifnull((select sum(can) from desarrollo.traspaso_c x
left join desarrollo.traspaso_d b on b.id_cc=x.id
where x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and x.tipo='E' and tipo2='C' and b.sec=a.sec
group by b.sec),0)
+
ifnull((select sum(can) from desarrollo.devolucion_c x
left join desarrollo.devolucion_d b on b.id_cc=x.id
where x.tipo='E' and x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and mov in(1,2)
and tipo2='C' and b.sec=a.sec group by b.sec),0))
as entradas,

(ifnull((select sum(can) from desarrollo.surtido x where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sec=a.sec group by x.sec ),0)
+
ifnull((select sum(can) from desarrollo.traspaso_c x
left join desarrollo.traspaso_d b on b.id_cc=x.id
where x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and x.tipo='S' and tipo2='C' and b.sec=a.sec
group by b.sec),0)
+
ifnull((select sum(can) from desarrollo.devolucion_c x
left join desarrollo.devolucion_d b on b.id_cc=x.id
where x.tipo='S' and x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and suc=100
and tipo2='C' and b.sec=a.sec group by b.sec),0))as salidas

from catalogo.sec_generica a

where sec>0 and sec<=2000";
$q = $this->db->query($s);

$File = "./txt/entrada_salida.txt";
    $Handle = fopen($File, 'w');
$cero=0;
$corte='||';
$Data=
         str_pad('ALM',3," ",STR_PAD_LEFT)
        .str_pad($corte,2," ",STR_PAD_LEFT)
        .str_pad('ALMACEN',7," ",STR_PAD_LEFT)
        .str_pad($corte,2," ",STR_PAD_LEFT)
        .str_pad('CLAVE',4," ",STR_PAD_LEFT)
        .str_pad($corte,2," ",STR_PAD_LEFT)
        .str_pad('SEC',3," ",STR_PAD_LEFT)
        .str_pad($corte,2," ",STR_PAD_LEFT)
        .str_pad('SUSTANCIA ACTIVA',8," ",STR_PAD_LEFT)
        .str_pad($corte,2," ",STR_PAD_LEFT)
        .str_pad('ENTRADAS',15," ",STR_PAD_LEFT)
        .str_pad($corte,2," ",STR_PAD_LEFT)
        .str_pad('SALIDAS',5," ",STR_PAD_LEFT)
         ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);

foreach($q->result() as $r)  
{
if($r->entrada>0 || $r->salida>0){
$Data=
         str_pad('900',8,"0",STR_PAD_LEFT)
        .str_pad($corte,2," ",STR_PAD_LEFT)
        .str_pad('ALM. CEDIS',15," ",STR_PAD_LEFT)
        .str_pad($corte,2," ",STR_PAD_LEFT)
        .str_pad($r->sec,4,"0",STR_PAD_LEFT)
        .str_pad($corte,2," ",STR_PAD_LEFT)
        .str_pad($r->susa1,2,"0",STR_PAD_LEFT)
        .str_pad($corte,2," ",STR_PAD_LEFT)    
        .str_pad($r->entrada,7,"0",STR_PAD_LEFT)
        .str_pad($corte,2," ",STR_PAD_LEFT)
        .str_pad($r->salida,7,"0",STR_PAD_LEFT)
        ."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
}}
fclose($Handle); 




}

///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
 


}

/////////////////////////////////////////////////////////////////////////////////////////////////////////