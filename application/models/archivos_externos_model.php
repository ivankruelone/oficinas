<?php
class Archivos_externos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 
public function genera_ims_e($fec1,$fec2)
{
$aaa=date('Y');
$fec1x=substr($fec1,0,4).substr($fec1,5,2).substr($fec1,7,2);
$fec2x=substr($fec2,0,4).substr($fec2,5,2).substr($fec2,7,2);

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
    $File = "./txt/ims_suc.txt";
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
where suc>100 and suc<1999 and tlid=1";
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
    
    $File = "./txt/ims_pro.txt";
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

    $File = "./txt/ims_vta.txt";
    $Handle = fopen($File, 'w');
$numpro=0;
$Data='4'.$pipe.$cero.$pipe.$empresa.$pipe.$fec1x.$pipe.$fec2x.$pipe.date('dmY').$pipe.$rango.$pipe.'imsMXven4'."\r\n";
$numpro=$numpro+1;  


$sqlxc="select codigo,suc,sum(can) as can,sum(importe)as importe 
from vtadc.venta_detalle where fecha>='$fec1' and fecha<='$fec2' 
and codigo<>9144221209277 
and importe>0 and suc>100 and suc<=1599
and codigo<>783523510
and codigo<>783523520
and codigo<>783523530
and codigo<>783523550
and codigo<>783523560
and codigo<>7835235100
and codigo<>7835235120
and codigo<>7835235150
and codigo<>7835235200
and codigo<>7835235300
and codigo<>7835235500
and codigo<>78352351000
and codigo<>4423174088000
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


$servidor_ftp    = "ftp.ims-canada.com";
$ftp_nombre_usuario = "mex_fenix";
$ftp_contrasenya = "Anin_*9";

$archivo_vta = './txt/ims_vta.txt';
$archivo_suc = './txt/ims_suc.txt';
$archivo_pro = './txt/ims_pro.txt';
$archivo_remoto_vta = 'ims_vta.txt';
$archivo_remoto_suc = 'ims_suc.txt';
$archivo_remoto_pro = 'ims_pro.txt';
$da = fopen($archivo, 'r');
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
fclose($da);
}
  
//    return $mensaje; 

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////














}
