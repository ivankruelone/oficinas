<?php
class Archivos_externos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 
public function envio_gral()
{
    $s="SELECT * FROM oficinas.procesos_controlador  where men=3";
    $q=$this->db->query($s);
    return $q;
}

public function genera_ims_e($fec1,$fec2,$v1,$v2,$ftp,$usuario,$contra)
{
$aaa=date('Y');
$fec1x=substr($fec1,0,4).substr($fec1,5,2).substr($fec1,7,2);
$fec2x=substr($fec2,0,4).substr($fec2,5,2).substr($fec2,7,2);
$nomp='P1304_M'.$v1.'W'.$v2.'.txt';
$noms='S1304_M'.$v1.'W'.$v2.'.txt';
$nomv='V1304_M'.$v1.'W'.$v2.'.txt';
$pipe='|';
$cero=0;
$uno=1;
$dos=2;
$tres=3;
$ocho=8;
$nueve=9;
$empresa=0000;
$mxcli1='MXcli1';
$rango='S';
$totcan=0;
$p='P';
////////////////////////////////////////************************************************************************sucursal*
$sqlx="select razon,rfc,date_format(now(),'%d%m%Y')as fecha from catalogo.compa a where cia=1
or cia=2
or cia=3
or cia=4
or cia=10
or cia=11
or cia=12
or cia=13
";
$queryx = $this->db->query($sqlx);
if($queryx->num_rows() > 0){
    $File = "./txt/".$noms;
    $Handle = fopen($File, 'w');
$numsuc=0;
foreach($queryx->result() as $rowx)
{
    
    $Data=
         str_pad($uno,1," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($cero,1," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($empresa,4,"0",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($rowx->razon,30," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($rowx->rfc,14," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($rowx->fecha,8," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($uno,1," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($mxcli1,5," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle, $Data);
$numsuc=$numsuc+1;
}
}

$sqlxc="select b.razon,a.*
from catalogo.sucursal a
left join catalogo.compa b on a.cia=b.cia
where suc>100 and suc<2899 and tlid=1 and fecha_act='0000-00-00'";
$queryxc = $this->db->query($sqlxc);
if($queryxc->num_rows() > 0){
    
foreach($queryxc->result() as $rowxc)
{
$numsuc=$numsuc+1;    
    $Data=
         $dos
        .$pipe
        .trim($rowxc->suc)
        .$pipe
        .trim($rowxc->rfc)
        .$pipe
        .trim($rowxc->razon)
        .$pipe
        .trim($rowxc->dire)
        .$pipe
        .trim($rowxc->col)
        .$pipe
        .trim($rowxc->cp)
        .$pipe
        .trim($rowxc->pobla)
        .$pipe
        .trim($rowxc->pobla)
        .$pipe
        .'C'
        .$pipe
        ."\r\n";
   fwrite($Handle, $Data);

}
$numsuc=$numsuc+1;
$Data=$tres.$pipe.$cero.$pipe.$empresa.$pipe.$numsuc.$pipe.'imsMXcli3'."\r\n";
fwrite($Handle, $Data);
fclose($Handle); 

////////////////////////////////////////************************************************************************sucursal*
//****************************************************************************************************productos
$sc="INSERT INTO catalogo.fenix(tipo, codigo, sec, prv, prvx, lin, sublin, descri, costo, farmacia, publico, costoc, limi)
(SELECT 'A',codigo,sec,prv,prvx,lin,sublin,susa2,0,vtaddr,0,0,'' from catalogo.almacen where sec>0 and sec<=2000 and tsec<>'X')
on duplicate key update farmacia=values(farmacia)";
$this->db->query($sc);
$s="update catalogo.fenix a, catalogo.cat_costo_fac b
set a.farmacia=b.far
where a.codigo=b.codigo";
$this->db->query($s);
$sqlx1="SELECT * FROM catalogo.fenix 
where descri<>' ' and farmacia>0";
$queryx1 = $this->db->query($sqlx1);
if($queryx1->num_rows() > 0){
    
    $File = "./txt/".$nomp;
    $Handle = fopen($File, 'w');
$numpro=0;
foreach($queryx1->result() as $rowx1)
{
$far=($rowx1->farmacia*100);    
    $Data=
         str_pad($ocho,1," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($rowx1->codigo,13," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($rowx1->codigo,13," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($rowx1->descri,30," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($rowx1->prvx,15," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($far,12," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($uno,1," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        .str_pad($p,5," ",STR_PAD_LEFT)
        .str_pad($pipe,1," ",STR_PAD_LEFT)
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle, $Data);
$numpro=$numpro+1;
}

$Data=$nueve.$pipe.$cero.$pipe.$empresa.$pipe.$numpro.$pipe.'imsMXpro9'."\r\n";
fwrite($Handle, $Data);
fclose($Handle); 
}
//****************************************************************************************************productos
////////////////////////////////////////************************************************************************venta*

    $File = "./txt/".$nomv;
    $Handle = fopen($File, 'w');
$numpro=0;
$Data='4'.$pipe.$cero.$pipe.$empresa.$pipe.$fec1x.$pipe.$fec2x.$pipe.date('dmY').$pipe.$rango.$pipe.'imsMXven4'."\r\n";
$numpro=$numpro+1;  


$sqlxc="select codigo,suc,sum(can) as can,sum(importe)as importe 
from vtadc.venta_detalle where fecha>='$fec1' and fecha<='$fec2' 

and importe>0 and suc>100 and suc<2899
and codigo not in(
9144221209277,
783523510,
783523520,
783523530,
783523550,
783523560,
7835235100,
7835235120,
7835235150,
7835235200,
7835235300,
7835235500,
78352351000,
4423174088000,
76684782760,
78352310,
783523150,
92,
78523560,
783523100,
783523200,
99,
100,
93,
94,
682,
683)
group by suc,codigo order by suc";
$queryxc = $this->db->query($sqlxc);
if($queryxc->num_rows() > 0){
    
foreach($queryxc->result() as $rowxc)
{
$numpro=$numpro+1;    
    $Data=
         '5'
        .$pipe
        .trim($rowxc->suc)
        .$pipe
        .trim($rowxc->codigo)
        .$pipe
        .'+'
        .$pipe
        .'01'
        .$pipe
        .trim($rowxc->can)
        .$pipe
        .str_pad(round($rowxc->importe*100),11,"0",STR_PAD_LEFT)
        .$pipe
        .'V'
        ."\r\n";
   fwrite($Handle, $Data);
$totcan=$totcan+$rowxc->can;
}}
$numpro=$numpro+1;
$Data='6'.$pipe.$cero.$pipe.$empresa.$pipe.$numpro.$pipe.$totcan.$pipe.'0'.'imsMXven6'.$pipe.$fec1.$pipe.$fec2."\r\n";
fwrite($Handle, $Data);
fclose($Handle); 
////////////////////////////////////////************************************************************************venta*


$servidor_ftp    = $ftp;
$ftp_nombre_usuario = $usuario;
$ftp_contrasenya = $contra;

$archivo_vta = './txt/'.$nomv;
$archivo_suc = './txt/'.$noms;
$archivo_pro = './txt/'.$nomp;
$archivo_remoto_vta = $nomv;
$archivo_remoto_suc = $noms;
$archivo_remoto_pro = $nomp;
$da1 = fopen($archivo_vta, 'r');
$da2 = fopen($archivo_suc, 'r');
$da3 = fopen($archivo_pro, 'r');
$id_con = ftp_connect($servidor_ftp);

$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto_vta, $archivo_vta, FTP_ASCII)) {
    $mensaje=1;
}
if (ftp_put($id_con, $archivo_remoto_suc, $archivo_suc, FTP_ASCII)) {
    $mensaje=1;
} 
if (ftp_put($id_con, $archivo_remoto_pro, $archivo_pro, FTP_ASCII)) {
    $mensaje=1;
}  

ftp_close($id_con);
fclose($da1);
fclose($da2);
fclose($da3);
}
  
//    return $mensaje; 

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////

   function genera_nilsen_e($fec1,$fec2,$sem,$ftp,$usuario,$contra)
    {
$mensaje='No se envio';
$sqlx="select 
suc,codigo,'E'as e,descri ,sum(can)as can,sum(importe)as importe,'PZA'as pza,0,date_format(fecha,'%Y')as aaa 
from vtadc.venta_detalle
where fecha between '$fec1' and '$fec2' and importe>0 and suc>100 and
codigo not in(
9144221209277,
783523510,
783523520,
783523530,
783523550,
783523560,
7835235100,
7835235120,
7835235150,
7835235200,
7835235300,
7835235500,
78352351000,
4423174088000,
76684782760,
78352310,
783523150,
92,
78523560,
783523100,
783523200,
99,
100,
93,
94,
682,
683)
group by suc,codigo";
$queryx = $this->db->query($sqlx);
//echo $this->db->last_query();
$blanco=' ';
$cero=0;
//echo $queryx->num_rows();
//echo "<br />";
//echo $this->db->last_query();

if($queryx->num_rows() > 0){
$sem=substr($fec2,0,4).str_pad($sem,2,"0",STR_PAD_LEFT);

    $File = "./txt/nilsen.txt";
    $Handle = fopen($File, 'w');
foreach($queryx->result() as $rowx)
{
    
    $importe=$rowx->importe*100;
    $descri=substr(utf8_decode($rowx->descri),0,77);
    //echo $descri.'<br />';
    $Data=
         str_pad($rowx->suc,4,"0",STR_PAD_LEFT)
        .str_pad($rowx->codigo,13,"0",STR_PAD_LEFT)
        .str_pad($rowx->e,1," ",STR_PAD_LEFT)
        .str_pad($rowx->codigo,13,"0",STR_PAD_LEFT)
        .str_pad($descri,77," ",STR_PAD_RIGHT)
        .str_pad($rowx->can,7,"0",STR_PAD_LEFT)
        .str_pad($importe,11,"0",STR_PAD_LEFT)
        .str_pad($rowx->pza,3," ",STR_PAD_LEFT)
        .str_pad($cero,12,"0",STR_PAD_LEFT)
        .str_pad($blanco,40," ",STR_PAD_LEFT)
        .str_pad($sem,6,"0",STR_PAD_LEFT)."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle, $Data);
}

fclose($Handle); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
//;
$servidor_ftp    = $ftp;
$ftp_nombre_usuario = $usuario;
$ftp_contrasenya = $contra;
$nombre_archivo=$sem.'venta.txt';
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////
$this->load->library('sftp');

        $config['hostname'] = 'namft.nielsen.com';
        $config['username'] = 'mft@farfenix.com';
        $config['password'] = 'iKk1Ni54';
        
        $this->sftp->connect($config);
        
        if($this->sftp->upload('./txt/nilsen.txt', '/FFenix/'.$nombre_archivo, 'auto'))
        {
            
        }
        
        $this->sftp->close();
//////////////////////////////////////////////////////
}
  
    return $mensaje; 

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////

   function genera_noblock_e($aaa,$mes,$fecha,$ftp,$usuario,$contra)
    {
$sqlx="select a.suc,a.codigo,
a.descri,sum(a.can)as venta,sum(a.importe)as importe,'PZA'as pza,0,year(fecha) as aaa,b.cia
from vtadc.venta_detalle a left join catalogo.sucursal b on b.suc=a.suc
where year(fecha)=$aaa and month(fecha)=$mes and a.importe>0 and a.suc>100
and 
a.codigo not in( 9144221209277, 783523510, 783523520, 783523530, 783523550, 783523560, 7835235100, 7835235120, 7835235150,
 7835235200, 7835235300, 7835235500, 78352351000, 4423174088000, 76684782760, 78352310, 783523150, 92, 78523560,
 783523100, 783523200, 99, 100, 93, 94, 682, 683)
 and descri not like '%recarga%'
group by a.suc,a.codigo";
$queryx = $this->db->query($sqlx);
$blanco=' ';
$cero=0;
if($queryx->num_rows() > 0){
    $File = "./txt/noblock.txt";
    $Handle = fopen($File, 'w');

foreach($queryx->result() as $rowx)
{
    $vta=($rowx->importe/$rowx->venta)*100;
    $vta=(int)$vta;
    $Data=
         str_pad($blanco,1," ",STR_PAD_LEFT)        
        .str_pad($rowx->suc,8,"0",STR_PAD_LEFT)
        .str_pad('40',2,"0",STR_PAD_LEFT)
        .str_pad($rowx->cia,2,"0",STR_PAD_LEFT)
        .str_pad($blanco,1," ",STR_PAD_LEFT)
        .str_pad($rowx->codigo,15,"0",STR_PAD_LEFT)
        .str_pad($rowx->venta,7,"0",STR_PAD_LEFT)
        .str_pad($fecha,8,"0",STR_PAD_LEFT)
        .str_pad($vta,11,"0",STR_PAD_LEFT)
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle, $Data);
}
fclose($Handle); 
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$mensaje=0;
$servidor_ftp    = $ftp;
$ftp_nombre_usuario = $usuario;
$ftp_contrasenya = $contra;

$archivo = './txt/noblock.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'venta.txt';
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
  
    //return $mensaje; 

}














}
