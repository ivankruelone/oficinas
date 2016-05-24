<?php
class backoffice_model_central extends CI_Model
{
   function __construct()
    {
        parent::__construct();
    }

function sol_catalogos()
{
    ini_set('memory_limit','5000M');
    set_time_limit(0);
    $aaa=date('Y');
    $mes=date('m');
    $mesa=$mes-1;
    $fectime=date('Y-m-d H:i:s');
    $dia=date('d');
    $this->__extrae_archivos();
    $this->__proceso_codigos_rel();
    $this->__proceso_catalogos_mayoristas();
    $fectime2=date('Y-m-d H:i:s');
    echo "Inicia proceso de catalogos :".$fectime."<br />Finaliza proceso de catalogos :".$fectime2;
}
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function envio_archivos($ftp_s,$usua,$contra,$var)
     {
     $fechatime=date('Y-m-d H:i:s');
     $this->__envio_ofertas_caducados($var);
     $this->__envio_ofertas_caducados_envio($var);
     $ar1=$this->__descuentos($var);
     $ar2=$this->__envio_precios($var);
     $ar3=$this->__envio_ofertas($var);
     $ar4=$this->__envio_precios_imperiales($var);
     
$servidor_ftp    = $ftp_s;
$ftp_nombre_usuario = $usua;
$ftp_contrasenya = $contra;

$archivo1 = "./txt/$ar1";
$da1 = fopen($archivo1, 'r');
$archivo_remoto1 = "lidia/$ar1";

$archivo2 = "./txt/$ar2";
$da2 = fopen($archivo2, 'r');
$archivo_remoto2 = "lidia/$ar2";

$archivo3 = "./txt/$ar3";
$da3 = fopen($archivo3, 'r');
$archivo_remoto3 = "lidia/$ar3";

$archivo4 = "./txt/$ar4";
$da4 = fopen($archivo4, 'r');
$archivo_remoto4 = "lidia/$ar4";

$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto1, $archivo1, FTP_ASCII)){$mensaje=1;} else {$mensaje=2;}
if (ftp_put($id_con, $archivo_remoto2, $archivo2, FTP_ASCII)){$mensaje=1;} else {$mensaje=2;}
if (ftp_put($id_con, $archivo_remoto3, $archivo3, FTP_ASCII)){$mensaje=1;} else {$mensaje=2;}
if (ftp_put($id_con, $archivo_remoto4, $archivo4, FTP_ASCII)){$mensaje=1;} else {$mensaje=2;}

ftp_close($id_con);
fclose($da1);
fclose($da2);
fclose($da3);
     $fechatime2=date('Y-m-d H:i:s');
     echo 'Envio archivos a servidor '.$ftp_s.' '.$fechatime.'<br />Finalizo '.$fechatime2;
     }

function envio_pedido_fanasa($ftp_s,$usua,$contra,$var,$nom)
     {
     $fechatime=date('Y-m-d H:i:s');
     
$servidor_ftp    = $ftp_s;
$ftp_nombre_usuario = $usua;
$ftp_contrasenya = $contra;

$archivo1 = "./txt/$nom";
$da1 = fopen($archivo1, 'r');
$archivo_remoto1 = "fanasa/pedidos/$nom";



$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto1, $archivo1, FTP_ASCII)){$mensaje=1;} else {$mensaje=2;}

ftp_close($id_con);
fclose($da1);
   $fechatime2=date('Y-m-d H:i:s');
     echo 'Envio archivos a servidor '.$ftp_s.' '.$fechatime.'<br />Finalizo '.$fechatime2;
     }
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
     
function sol_inventarios()
{
    $this->__proceso_inv();
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
function sol_movimientos()
{
    ini_set('memory_limit','5000M');
    set_time_limit(0);
    $aaa=date('Y');
    $mes=date('m');
    $mesa=$mes-1;
    $fectime=date('Y-m-d H:i:s');
    $dia=date('d');
    $this->__proceso_movimientos($aaa,$mes);
    $fectime2=date('Y-m-d H:i:s');
    
    
    echo "Inicio :".$fectime."<br />Finaliza :".$fectime2;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////

function sol_facturas()
{
    ini_set('memory_limit','5000M');
    set_time_limit(0);
    $aaa=date('Y');
    $mes=date('m');
    $mesa=$mes-1;
    $fectime=date('Y-m-d H:i:s');
    $dia=date('d');
    $this->__factura_fanasa();
    $this->__proceso_facturas();
 
    echo "Inicio :".$fectime."<br />Finaliza :".$fectime2;
}
//////////////////////////////////////////////////////////////////////////////////////subfunciones
//////////////////////////////////////////////////////////////////////////////////////subfunciones
function __solo_fanasa()
{
$this->load->library('ftp');
$config1['hostname'] ='fenixcentral.homeip.net';
$config1['username'] ='administrador';
$config1['password'] ='PharmaF3n1x';
$config1['debug']    = false;
$this->ftp->connect($config1);
$this->ftp->download('/fanasa/catalogo.dat', './transfer/catfan1.txt');
$this->ftp->download('/fanasa/SINOFE.txt', './transfer/sinfan1.txt');
$this->ftp->download('/fanasa/CONOFE.txt', './transfer/confan1.txt');
if(file_exists("c:/wamp/www/oficinas/transfer/catfan1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/catfan1.txt','catfan1.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/sinfan1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/sinfan1.txt','sinfan1.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/confan1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/confan1.txt','confan1.txt');}
$borra4="delete from subir10.cat_fanasa_compara";$this->db->query($borra4);

$compara="insert ignore into subir10.cat_fanasa_compara(codigo, descripcion, costo, nivel_existencia, publico, fecha_alta, fecha_modificado, oferta, antibiotico, farmacia, lab, financiero, iva, producto, rel1, rel2)
(SELECT codigo, descripcion, costo, nivel_existencia, publico, fecha_alta, fecha_modificado, oferta, antibiotico, farmacia, lab, financiero, iva, producto, rel1, rel2
FROM catalogo.cat_fanasa)";
$this->db->query($compara);

$fectime=date('Y-m-d H:i:s');
//if(file_exists("/home/central/backoffice/catfan1.txt")){
$s1="LOAD DATA INFILE '/home/central/backoffice/catfan1.txt'
 replace INTO TABLE catalogo.cat_fanasa LINES TERMINATED BY '\r\n' (@var1) SET fecha_alta='$fectime',codigo = case when trim(SUBSTR(@var1, 88, 13))not in('00000002C1082','00000005C4957','2C1071') 
then trim(SUBSTR(@var1, 88, 13)) else 0 end,descripcion = concat(trim(SUBSTR(@var1,18, 25)),' ',trim(SUBSTR(@var1,43, 10))),
farmacia = (SUBSTR(@var1,72, 9)/100),publico = (SUBSTR(@var1,63, 9)/100),costo =0,oferta=0,antibiotico = ' ',iva = 0,
financiero= 0,lab=(SUBSTR(@var1,53, 10))";
$this->db->query($s1);
//}
//if(file_exists("/home/central/backoffice/sinfan1.txt")){
$borra="delete from subir10.p_cat_fanasa";$this->db->query($borra);
$s2="LOAD DATA INFILE '/home/central/backoffice/sinfan1.txt'
 replace INTO TABLE subir10.p_cat_fanasa LINES TERMINATED BY '\r\n'
 (@var1) SET fecha_alta='$fectime', codigo =  case when trim(SUBSTR(@var1, 1, 13))not in('00000002C1082','00000005C4957','2C1071')
then trim(SUBSTR(@var1, 1, 13)) else 0 end, descripcion = concat(trim(SUBSTR(@var1,14, 25)),' ',trim(SUBSTR(@var1,39, 10))),
farmacia = SUBSTR(@var1, 49, 9),financiero= case when SUBSTR(@var1, 58,3)='100' then 18 else (SUBSTR(@var1, 58,6)) end,
producto=case when SUBSTR(@var1, 58,6)='100.00' then 'NOR' when SUBSTR(@var1, 58,6)='  0.00' then 'NET' else 'LIM' end";
$this->db->query($s2);
//}
//if(file_exists("/home/central/backoffice/confan1.txt")){
$s3="LOAD DATA INFILE '/home/central/backoffice/confan1.txt'
 replace INTO TABLE subir10.p_cat_fanasa LINES TERMINATED BY '\r\n' (@var1) SET fecha_alta='$fectime',
codigo =  case when trim(SUBSTR(@var1, 13, 13))not in('00000002C1082','00000005C4957','2C1071')
then trim(SUBSTR(@var1, 13, 13)) else 0 end,descripcion = concat(trim(SUBSTR(@var1,26, 25)),' ',trim(SUBSTR(@var1,51, 10))),
farmacia = SUBSTR(@var1, 61, 9),oferta= SUBSTR(@var1, 70,6),financiero= case when SUBSTR(@var1, 97,3)='100' then 18 else (SUBSTR(@var1, 97,6)) end,
producto=case when SUBSTR(@var1, 97,6)='100.00' then 'NOR' when SUBSTR(@var1, 97,6)='  0.00' then 'NET' else 'LIM' end";
$this->db->query($s3);

$sc="update catalogo.cat_fanasa a, subir10.p_cat_fanasa b set 
a.oferta=b.oferta,a.financiero=b.financiero,a.farmacia=b.farmacia,a.producto=b.producto,fecha_modificado=now() 
where a.codigo=b.codigo";
$this->db->query($sc);
$cambio_precio="insert ignore into sucursal.cambio_precios(fecha, codigo, descripcion, pub_ant, pub_act, far_ant, far_act, grabado)
(select date(now()),a.codigo,a.descripcion, b.publico,a.publico,b.farmacia,a.farmacia,now() From catalogo.cat_fanasa a
join subir10.cat_fanasa_compara b on b.codigo=a.codigo
where a.publico<>b.publico)";
$this->db->query($cambio_precio);
$sc2="update catalogo.cat_fanasa a set costo=round( 
(case
when a.financiero>0 and a.oferta>0 
then ((a.farmacia-((a.financiero/100)*a.farmacia))-((a.oferta/100)*(a.farmacia-((a.financiero/100)*a.farmacia))))
when a.financiero>0 and a.oferta=0 then (a.farmacia-((a.financiero/100)*a.farmacia))
when a.financiero=0 and a.oferta>0 then (a.farmacia-((a.oferta/100)*a.farmacia))
when a.financiero=0 and a.oferta=0 then  a.farmacia
else a.farmacia end),2) where a.costo=0";
$this->db->query($sc2);
$che="update  catalogo.cat_fanasa a , catalogo.cod_rel b
set a.rel1=b.cod_rel1,a.rel2=b.cod_rel2
where ean=codigo";
$this->db->query($che);
}

function __extrae_archivos()
{
$this->load->library('ftp');
$config1['hostname'] ='fenixcentral.homeip.net';
$config1['username'] ='administrador';
$config1['password'] ='PharmaF3n1x';
$config1['debug']    = false;
$this->ftp->connect($config1);



$this->ftp->download('/fanasa/sinofe.txt', './transfer/sinfan1.txt');
$this->ftp->download('/fanasa/conofe.txt', './transfer/confan1.txt');
$this->ftp->download('/fanasa/catalogo.dat', './transfer/catfan1.txt');
$this->ftp->download('lidia/rel1.txt', './transfer/rel1.txt');



$this->ftp->download('/nadro/SINOFE.txt', './transfer/sinnad1.txt');
$this->ftp->download('lidia/invdet1.txt', './transfer/invdet1.txt');
$this->ftp->download("lidia/comp1.txt", "./transfer/comp1.txt");
$this->ftp->download("lidia/mov1.txt", "./transfer/mov1.txt");
$this->ftp->download('lidia/ven1.txt', './transfer/ven1.txt');
$fechaf=date('ymd');
$this->ftp->download('marzam/fac'.$fechaf.'.txt', './transfer/fac'.$fechaf.'.txt');
$fechaf=date('dmY');
$this->ftp->download('fanasa/FACTURA'.$fechaf.'.txt','./transfer/FANASA'.$fechaf.'.txt');
$fechaf=date('Ymd');
$this->ftp->download('nadro/FA'.$fechaf.'.33', './transfer/FA'.$fechaf.'.33');
if(file_exists("c:/wamp/www/oficinas/transfer/rel1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/rel1.txt','rel1.txt');}

if(file_exists("c:/wamp/www/oficinas/transfer/catfan1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/catfan1.txt','catfan1.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/sinfan1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/sinfan1.txt','sinfan1.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/confan1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/confan1.txt','confan1.txt');}

if(file_exists("c:/wamp/www/oficinas/transfer/invdet1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/invdet1.txt','invdet1.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/comp1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/comp1.txt','comp1.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/mov1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/mov1.txt','mov1.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/ven1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/ven1.txt','ven1.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/fac".$fechaf.".txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/fac'.$fechaf.'.txt','facmarzam.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/FANASA".$fechaf.".txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/FANASA'.$fechaf.'.txt','facfanasa.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/FA".$fechaf.".33")){$this->transferFile('c:/wamp/www/oficinas/transfer/FA'.$fechaf.'.33','facnadro.33');}

$config2['hostname'] ='fenixcentral01.homeip.net';
$config2['username'] ='administrador';
$config2['password'] ='PharmaF3n1x';
$config2['debug']    = TRUE;
$this->ftp->connect($config2);
$this->ftp->download('lidia/rel2.txt', './transfer/rel2.txt');
//$this->ftp->download('/fanasa/catalogo.dat', './transfer/catfan1.txt');
//$this->ftp->download('/fanasa/SINOFE.txt', './transfer/sinfan1.txt');
//$this->ftp->download('/fanasa/CONOFE.txt', './transfer/confan1.txt');

$this->ftp->download("lidia/comp2.txt", "./transfer/comp2.txt");
$this->ftp->download("lidia/mov2.txt", "./transfer/mov2.txt");
$this->ftp->download('lidia/ven2.txt', './transfer/ven2.txt');
//if(file_exists("c:/wamp/www/oficinas/transfer/catfan1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/catfan1.txt','catfan1.txt');}
//if(file_exists("c:/wamp/www/oficinas/transfer/sinfan1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/sinfan1.txt','sinfan1.txt');}
//if(file_exists("c:/wamp/www/oficinas/transfer/confan1.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/confan1.txt','confan1.txt');}

if(file_exists("c:/wamp/www/oficinas/transfer/rel2.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/rel2.txt','rel2.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/invdet2.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/invdet2.txt','invdet2.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/comp2.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/comp2.txt','comp2.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/mov2.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/mov2.txt','mov2.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/ven2.txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/ven2.txt','ven2.txt');}
$fectime2=date('Y-m-d H:i:s');
    
}
function transferFile($ruta, $archivo)
    {
        $this->load->library('ftp');
        $config['hostname'] = '192.168.1.221';
        $config['username'] = 'central';
        $config['password'] = 'hachi1417';
        $config['debug'] = TRUE;
        
        $this->ftp->connect($config);
        $this->ftp->upload($ruta, 'backoffice/'.$archivo, 'auto', 0777);
        $this->ftp->close(); 
    }
    
     
function __proceso_codigos_rel()
{
//if(file_exists("/home/central/backoffice/rel1.txt")){
//echo 'SI';
//die();
$borra1="delete from subir10.cod_rel1";
$this->db->query($borra1);
$sr="LOAD DATA INFILE '/home/central/backoffice/rel1.txt' 
replace into table subir10.cod_rel1 FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(ean, cod_rel, @descripcion, lin, slin, pub, far, cos, iva)
set descripcion = CONVERT(CAST(@descripcion as BINARY) USING LATIN1)";
$this->db->query($sr);
//}
//if(file_exists("/home/central/backoffice/rel2.txt")){
$borra2="delete from subir10.cod_rel2";
$this->db->query($borra2);
$sr="LOAD DATA INFILE '/home/central/backoffice/rel2.txt' 
replace into table subir10.cod_rel2 FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(ean, cod_rel, @descripcion, lin, slin, pub, far, cos, iva)
set descripcion = CONVERT(CAST(@descripcion as BINARY) USING LATIN1)";
//$this->db->query($sr);
//}
$sp2="insert into catalogo.cod_rel
(ean, cod_rel1, cod_rel2, descripcion1, descripcion2, lin, slin, pub1, far1, cos1, pub2, far2, cos2, nivel, iva)
(select 
ean, 0, cod_rel, ' ', descripcion, lin, slin, 0, 0, 0, pub, far, cos, 0, iva from subir10.cod_rel2)
on duplicate key update 
descripcion2=values(descripcion2), pub2=values(pub2),far2=values(far2),cos2=values(cos2),iva=values(iva),
cod_rel2=values(cod_rel2),lin=values(lin),slin=values(slin)";
$this->db->query($sp2);   
$sp1="insert into catalogo.cod_rel
(ean, cod_rel1, cod_rel2, descripcion1, descripcion2, lin, slin, pub1, far1, cos1, pub2, far2, cos2, nivel, iva)
(select ean, cod_rel,0, descripcion,' ', lin, slin, pub, far, cos, 0, 0, 0, 0, iva from subir10.cod_rel1)
on duplicate key update 
descripcion1=values(descripcion1), pub1=values(pub1),far1=values(far1),cos1=values(cos1), iva=values(iva),
cod_rel1=values(cod_rel1),lin=values(lin),slin=values(slin)";
$this->db->query($sp1);
$fec=date('dmY');
$fectime=date('Y-m-d H:i:s');
$ss0="update catalogo.cat_mercadotecnia a set ofe_saba=0,fin_saba=0,ofe_nadro=0, fin_nadro=0, ofe_fanasa=0, fin_fanasa=0,rel1=0,rel2=0,ofe_marzam=0,fin_marzam=0";
$this->db->query($ss0);
$ss0="update catalogo.cat_mercadotecnia a, catalogo.cod_rel b  set a.rel1=cod_rel1, a.rel2=cod_rel2,a.lin=b.lin,a.sublin=b.slin where a.codigo=b.ean";
$this->db->query($ss0);
}

function __proceso_catalogos_mayoristas()
{

//if(file_exists("g:/backoffice/fanasa/CATALOGO.DAT")){$this->transferFile('g:/backoffice/fanasa/CATALOGO.DAT','catfan1.txt');}
//if(file_exists("g:/backoffice/fanasa/SINOFE.txt")){$this->transferFile('g:/backoffice/fanasa/SINOFE.txt','sinfan1.txt');}
//if(file_exists("g:/backoffice/fanasa/CONOFE.txt")){$this->transferFile('g:/backoffice/fanasa/CONOFE.txt','confan1.txt');}
//if(file_exists("g:/backoffice/fanasa/FACTURA.txt")){$this->transferFile('g:/backoffice/fanasa/FACTURA.txt','facfanasa.txt');}
$borra4="delete from subir10.cat_fanasa_compara";$this->db->query($borra4);

$compara="insert ignore into subir10.cat_fanasa_compara(codigo, descripcion, costo, nivel_existencia, publico, fecha_alta, fecha_modificado, oferta, antibiotico, farmacia, lab, financiero, iva, producto, rel1, rel2)
(SELECT codigo, descripcion, costo, nivel_existencia, publico, fecha_alta, fecha_modificado, oferta, antibiotico, farmacia, lab, financiero, iva, producto, rel1, rel2
FROM catalogo.cat_fanasa)";
$this->db->query($compara);

$fectime=date('Y-m-d H:i:s');
//if(file_exists("/home/central/backoffice/catfan1.txt")){
$s1="LOAD DATA INFILE '/home/central/backoffice/catfan1.txt'
 replace INTO TABLE catalogo.cat_fanasa LINES TERMINATED BY '\r\n' (@var1) SET fecha_alta='$fectime',codigo = case when trim(SUBSTR(@var1, 88, 13))not in('00000002C1082','00000005C4957','2C1071') 
then trim(SUBSTR(@var1, 88, 13)) else 0 end,descripcion = concat(trim(SUBSTR(@var1,18, 25)),' ',trim(SUBSTR(@var1,43, 10))),
farmacia = (SUBSTR(@var1,72, 9)/100),publico = (SUBSTR(@var1,63, 9)/100),costo =0,oferta=0,antibiotico = ' ',iva = 0,
financiero= 0,lab=(SUBSTR(@var1,53, 10))";
$this->db->query($s1);
//}
//if(file_exists("/home/central/backoffice/sinfan1.txt")){
$borra="delete from subir10.p_cat_fanasa";$this->db->query($borra);
$s2="LOAD DATA INFILE '/home/central/backoffice/sinfan1.txt'
 replace INTO TABLE subir10.p_cat_fanasa LINES TERMINATED BY '\r\n'
 (@var1) SET fecha_alta='$fectime', codigo =  case when trim(SUBSTR(@var1, 1, 13))not in('00000002C1082','00000005C4957','2C1071')
then trim(SUBSTR(@var1, 1, 13)) else 0 end, descripcion = concat(trim(SUBSTR(@var1,14, 25)),' ',trim(SUBSTR(@var1,39, 10))),
farmacia = SUBSTR(@var1, 49, 9),financiero= case when SUBSTR(@var1, 58,3)='100' then 18 else (SUBSTR(@var1, 58,6)) end,
producto=case when SUBSTR(@var1, 58,6)='100.00' then 'NOR' when SUBSTR(@var1, 58,6)='  0.00' then 'NET' else 'LIM' end";
$this->db->query($s2);
//}
//if(file_exists("/home/central/backoffice/confan1.txt")){
$s3="LOAD DATA INFILE '/home/central/backoffice/confan1.txt'
 replace INTO TABLE subir10.p_cat_fanasa LINES TERMINATED BY '\r\n' (@var1) SET fecha_alta='$fectime',
codigo =  case when trim(SUBSTR(@var1, 13, 13))not in('00000002C1082','00000005C4957','2C1071')
then trim(SUBSTR(@var1, 13, 13)) else 0 end,descripcion = concat(trim(SUBSTR(@var1,26, 25)),' ',trim(SUBSTR(@var1,51, 10))),
farmacia = SUBSTR(@var1, 61, 9),oferta= SUBSTR(@var1, 70,6),financiero= case when SUBSTR(@var1, 97,3)='100' then 18 else (SUBSTR(@var1, 97,6)) end,
producto=case when SUBSTR(@var1, 97,6)='100.00' then 'NOR' when SUBSTR(@var1, 97,6)='  0.00' then 'NET' else 'LIM' end";
$this->db->query($s3);
//}

$sc="update catalogo.cat_fanasa a, subir10.p_cat_fanasa b set 
a.oferta=b.oferta,a.financiero=b.financiero,a.farmacia=b.farmacia,a.producto=b.producto,fecha_modificado=now() 
where a.codigo=b.codigo";
$this->db->query($sc);

$cambio_precio="insert ignore into sucursal.cambio_precios(fecha, codigo, descripcion, pub_ant, pub_act, far_ant, far_act, grabado)
(select date(now()),a.codigo,a.descripcion, b.publico,a.publico,b.farmacia,a.farmacia,now() From catalogo.cat_fanasa a
join subir10.cat_fanasa_compara b on b.codigo=a.codigo
where a.publico<>b.publico)";
$this->db->query($cambio_precio);

$relacionado="update  catalogo.cat_fanasa a, catalogo.cod_rel b
set a.rel1=b.cod_rel1, rel2=cod_rel2
where a.codigo=b.ean and codigo>0";
$this->db->query($relacionado);
$relacionado_mer="update  catalogo.cat_mercadotecnia a, catalogo.cod_rel b
set a.rel1=b.cod_rel1, rel2=cod_rel2
where a.codigo=b.ean and codigo>0";
$this->db->query($relacionado_mer);

$sc2="update catalogo.cat_fanasa a set costo=round( 
(case
when a.financiero>0 and a.oferta>0 
then ((a.farmacia-((a.financiero/100)*a.farmacia))-((a.oferta/100)*(a.farmacia-((a.financiero/100)*a.farmacia))))
when a.financiero>0 and a.oferta=0 then (a.farmacia-((a.financiero/100)*a.farmacia))
when a.financiero=0 and a.oferta>0 then (a.farmacia-((a.oferta/100)*a.farmacia))
when a.financiero=0 and a.oferta=0 then  a.farmacia
else a.farmacia end),2) where a.costo=0";
$this->db->query($sc2);

$in_far="insert ignore into catalogo.cat_mercadotecnia
(codigo, descripcion, lab, iva, farmacia, pub, venta, tipo, registro,
id, id_user, fecha_archivo, producto, clave, susa, lin, sublin,
 max, min, antibiotico, labprv, aaa_registro,
cos, cos_fanasa,ofe_fanasa, fin_fanasa,rel1, rel2, ult_costo,far_fan, pub_fan)
(select codigo, descripcion,0,iva,farmacia,publico,0,1,' ',
0,0,now(),producto,' ',' ',0,0,
0,0,0,lab,0,
costo,costo,oferta,financiero,rel1,rel2,costo,farmacia,publico 
from catalogo.cat_fanasa a where fecha_modificado>=date(now()) and codigo>0)";
$this->db->query($in_far);

$sfanasa="update catalogo.cat_mercadotecnia a, catalogo.cat_fanasa b
set
a.iva=case when a.iva=0 then 0 else ((b.iva)/100) end,
a.cos_fanasa=b.costo,
a.cos=b.costo,
a.farmacia=b.farmacia,
a.pub=b.publico,
a.labprv=b.lab,
ofe_fanasa=oferta,
fin_fanasa=financiero,
fecha_archivo=date(now()),
a.pub_fan=b.publico,
a.far_fan=b.farmacia,
a.producto=b.producto

where
b.rel1=a.rel1 and b.rel2=a.rel2 and a.rel1>0  and fecha_modificado>=date(now())
or
b.rel1=a.rel1 and b.rel2=a.rel2 and a.rel2>0  and fecha_modificado>=date(now())";
$this->db->query($sfanasa);


////////////////////////////////////////////////////////////////////tomar como preferencia FANASA.
////////////////////////////////////////////////////////////////////tomar como preferencia FANASA.



////////////////////////////////////////////////////////////////////tomar como preferencia FANASA.
////////////////////////////////////////////////////////////////////tomar como preferencia FANASA.

$cos1="insert ignore into compras.costos_generales(codigo, susa, descri, costo_gen, costo_patente, costo_segpop, costo_back, lin, sec, clagob)
(SELECT codigo,susa1,susa2,costo,0,0,0,lin,sec,' ' FROM catalogo.almacen where tsec not in('X','M') and codigo>3999 and sec<=3999 and costo>0)
on duplicate key update costo_gen=values(costo_gen)";
$this->db->query($cos1);
$cos2="insert ignore into compras.costos_generales(codigo, susa, descri, costo_gen, costo_patente, costo_segpop, costo_back, lin, sec, clagob)
(SELECT codigo,susa,descripcion,0,cos,0,0,lin,sec,' ' FROM catalogo.cat_mercadotecnia where codigo>3999 and cos>0)
on duplicate key update costo_patente=(costo_patente)";
$this->db->query($cos2);
$cos3="insert ignore into compras.costos_generales(codigo, susa, descri, costo_gen, costo_patente, costo_segpop, costo_back, lin, sec, clagob)
(SELECT codigo,susa1,susa2,0,0,costo,0,lin,0,claves FROM catalogo.segpop where codigo>3999 and costo>0)
on duplicate key update costo_segpop=(costo_segpop),clagob=values(clagob)";
$this->db->query($cos3);
$cos4="insert ignore into compras.costos_generales
(codigo, susa, descri, costo_gen, costo_patente, costo_segpop, costo_back, lin, sec, clagob)
(SELECT a.codigo,concat(trim(susa),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta)),
concat(trim(marca_comercial),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta)),
0,0,b.costo,0,lin,a.sec_cedis, trim(a.clagob)
FROM catalogo.cat_nuevo_general  a
join catalogo.cat_nuevo_general_prv b on b.codigo=a.codigo
where a.codigo>0 and b.costo>0)
on duplicate key update costo_segpop=(costo_segpop),clagob=values(clagob)";
$this->db->query($cos4);
$cos5="insert into compras.costos_generales(codigo, susa, descri, costo_gen, costo_patente, costo_segpop, costo_back, lin, sec, clagob)
(SELECT ean,'',
case when descripcion1='' then descripcion2 else descripcion1 end,0,0,0,
case when cos2=0 then cos1 else cos2 end
,lin,0,'' FROM catalogo.cod_rel where ean>0)
on duplicate key update costo_back=values(costo_back)";
$this->db->query($cos5);
$cos6="update compras.costos_generales a,catalogo.cod_rel b
set costo_back=case when far2=0 then far1 else far2 end
where a.codigo=b.ean and a.costo_back=0";
$this->db->query($cos6);
$cos7="update compras.costos_generales x
set costo_segpop=
round((SELECT sum(a.piezas*a.costo)/sum(piezas)
FROM spcentral.movimiento_detalle a where costo>0 and a.ean=x.codigo and movimientodetallefecha between subdate(date(now()),30) and date(now())
group by a.ean),2)
where
(SELECT sum(a.piezas*a.costo)/sum(piezas)
FROM spcentral.movimiento_detalle a where costo>0 and a.ean=x.codigo and movimientodetallefecha between subdate(date(now()),30) and date(now())
group by a.ean) >0
";
$this->db->query($cos7);

}
function __descuentos($var)
{
if($var==1){$lista=75;}else{$lista=71;}
$s="select $lista as lista,rel$var as rel,
case when cos>0 then case
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'0.00'	and 	'17.00'	then	0
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'17.01'	and 	'20.00'	then	5
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'20.01'	and 	'25.00'	then	8
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'25.01'	and 	'30.00'	then	10
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'30.01'	and 	'35.00'	then	15
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'35.01'	and 	'45.00'	then	20
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'45.01'	and 	'55.00'	then	25
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'55.01'	and 	'70.00'	then	30
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'70.01'	and 	'85.00'	then	35
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'85.01'	and 	'100.00'	then	40
when	producto='NET' and round((100-((cos/pub)*100)),2)	>	100.01			then	45
when	producto='LIM' and round((100-((cos/pub)*100)),2)	between	0.00	and 	12.00	then	0
when	producto='LIM' and round((100-((cos/pub)*100)),2)	between	12.01	and 	30.00	then	10
when	producto='LIM' and round((100-((cos/pub)*100)),2)	between	30.01	and 	40.00	then	15
when	producto='LIM' and round((100-((cos/pub)*100)),2)	between	40.01	and 	45.00	then	20
when	producto='LIM' and round((100-((cos/pub)*100)),2)	>	45.01			then	25
when	producto='NOR' and round((100-((cos/pub)*100)),2)	between	0.00	and 	25.00	then	0
when	producto='NOR' and round((100-((cos/pub)*100)),2)	between	25.01	and 	30.00	then	10
when	producto='NOR' and round((100-((cos/pub)*100)),2)	between	30.01	and 	40.00	then	15
when	producto='NOR' and round((100-((cos/pub)*100)),2)	between	40.01	and 	45.00	then	20
when	producto='NOR' and round((100-((cos/pub)*100)),2)	between	45.01	and 	58.00	then	25
when	producto='NOR' and round((100-((cos/pub)*100)),2)	>	58.01			then	30
else 0 end  
else 0 end as descu
from catalogo.cat_mercadotecnia a
where
a.cos_fanasa=0 and a.lin=1 and a.sublin not in(3,4,5) and pub>0 and cos>0  and codigo>0 and rel$var>0 or
a.cos_fanasa=0 and a.lin>1 and pub>0 and cos>0  and codigo>0  and rel$var>0 or
a.cos_fanasa=0 and a.lin=1 and a.sublin not in(3,4,5) and pub>0  and codigo>0  and rel$var>0 or
a.cos_fanasa=0 and a.lin>1 and pub>0   and codigo>0  and rel$var>0

group by rel$var



order by producto,
(case when cos>0 then case
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'0.00'	and 	'17.00'	then	0
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'17.01'	and 	'20.00'	then	5
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'20.01'	and 	'25.00'	then	8
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'25.01'	and 	'30.00'	then	10
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'30.01'	and 	'35.00'	then	15
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'35.01'	and 	'45.00'	then	20
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'45.01'	and 	'55.00'	then	25
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'55.01'	and 	'70.00'	then	30
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'70.01'	and 	'85.00'	then	35
when	producto='NET' and round((100-((cos/pub)*100)),2)	between	'85.01'	and 	'100.00'	then	40
when	producto='NET' and round((100-((cos/pub)*100)),2)	>	100.01			then	45
when	producto='LIM' and round((100-((cos/pub)*100)),2)	between	0.00	and 	12.00	then	0
when	producto='LIM' and round((100-((cos/pub)*100)),2)	between	12.01	and 	30.00	then	10
when	producto='LIM' and round((100-((cos/pub)*100)),2)	between	30.01	and 	40.00	then	15
when	producto='LIM' and round((100-((cos/pub)*100)),2)	between	40.01	and 	45.00	then	20
when	producto='LIM' and round((100-((cos/pub)*100)),2)	>	45.01			then	25
when	producto='NOR' and round((100-((cos/pub)*100)),2)	between	0.00	and 	25.00	then	0
when	producto='NOR' and round((100-((cos/pub)*100)),2)	between	25.01	and 	30.00	then	10
when	producto='NOR' and round((100-((cos/pub)*100)),2)	between	30.01	and 	40.00	then	15
when	producto='NOR' and round((100-((cos/pub)*100)),2)	between	40.01	and 	45.00	then	20
when	producto='NOR' and round((100-((cos/pub)*100)),2)	between	45.01	and 	58.00	then	25
when	producto='NOR' and round((100-((cos/pub)*100)),2)	>	58.01			then	30
else 0 end
else 0 end)";

$q=$this->db->query($s);

$File = "./txt/descu$var.txt";
$Handle = fopen($File, 'w');
foreach($q->result() as $r)
{
 $Data=
         str_pad($r->lista,2,"0",STR_PAD_LEFT)
        .str_pad('||',2,"0",STR_PAD_RIGHT)
        .str_pad($r->rel,13,"0",STR_PAD_LEFT)
        .str_pad('||',2,"0",STR_PAD_RIGHT)
        .str_pad($r->descu,6,"0",STR_PAD_LEFT)
        .str_pad('||',2,"0",STR_PAD_RIGHT)
        .str_pad('1',1," ",STR_PAD_RIGHT)
        .str_pad('||',2,"0",STR_PAD_RIGHT)
        .str_pad('0',1," ",STR_PAD_RIGHT)
        ."\r\n";   
fwrite($Handle, $Data);
}

fwrite($Handle, $Data);
fclose($Handle);
$archivo="descu$var.txt"; 
return $archivo;
}
function __envio_precios($var)
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////envia del server a backoffice

$s="
select cod_rel$var, lidia
from
(select b.cod_rel$var,
concat(a.lin,'||',a.sublin,'||',cod_rel$var,'||',a.codigo,'||', a.susa$var,'||', a.publico,'||',round((vtagen-(vtagen*.10))),'||',pub$var,'||',far$var)
as lidia
from catalogo.almacen a
join catalogo.cod_rel b on b.ean=a.codigo
where a.prv<>825 and a.publico>0 and vtaddr>0 and a.sec between 1 and 1999 and pub$var<>publico and cod_rel$var>0 and tsec<>'X' and a.lin<>2
and codigo not in(7501088509773)
group by cod_rel$var

union all
select b.cod_rel$var,

concat(a.lin,'||',a.sublin,'||',b.cod_rel$var,'||',codigo,'||', descripcion,'||', round(max(pub)+.33),'||',max(farmacia),'||',pub$var,'||',far$var)
as lidia
from
catalogo.cat_mercadotecnia a
left join catalogo.cod_rel b on b.cod_rel$var=a.rel$var and a.codigo=b.ean
where
a.lin=1 and a.sublin not in(3,4,5) and a.codigo>0 and b.cod_rel$var>0 and pub1<>pub and pub>0  and farmacia>0
and b.cod_rel$var not in(0)  and descripcion$var not like  '%$%' and descripcion$var not like '%recarga%'
and (select codigo from catalogo.cat_empaque_fenix x where x.rel$var=a.rel$var group by x.rel$var) is null
or
a.lin>1 and a.codigo>0 and b.cod_rel$var>0 and pub$var<>pub and pub>0 and farmacia>0
and b.cod_rel$var not in(0) and descripcion$var not like '%$%' and descripcion$var not like '%recarga%'
and (select codigo from catalogo.cat_empaque_fenix x where x.rel$var=a.rel$var group by x.rel$var) is null
group by cod_rel$var

union all
select a.rel$var as cod_rel$var,

concat(a.lin,'||',a.sublin,'||',b.cod_rel$var,'||',a.codigo,'||', descripcion,'||', max(pub/can),'||',max(farmacia/can),'||',pub$var,'||',far$var)
as lidia
from catalogo.cat_mercadotecnia a
join catalogo.cod_rel b on b.cod_rel$var=a.rel$var and a.codigo=b.ean
join catalogo.cat_empaque_fenix c on c.rel$var=b.cod_rel$var
) todo

group by cod_rel$var
order by cod_rel$var

";    
$q=$this->db->query($s);

$File = "./txt/preci$var.txt";
$Handle = fopen($File, 'w');
foreach($q->result() as $r)
{
$Data=
        str_pad($r->lidia,500," ",STR_PAD_RIGHT)
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle, $Data);
    
}


fclose($Handle); 
$archivo="preci$var.txt";
return $archivo;
}

function __envio_precios_imperiales($var)
{
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////envia del server a backoffice
$s="select cod_rel$var, lidia
from
(select cod_rel$var, concat(11,'||',bx.cod_rel$var,'||',
case when venta_pub<publico then
case when cx.lin in(2,5,9,10) then round((cx.venta_pub/1.16),4) else round(cx.venta_pub+.33) end
else
case when cx.lin in(2,5,9,10) then round((dx.publico/1.16),4) else round(dx.publico+.33) end
end)as lidia from
catalogo.cat_fenix_sec_cod ax,
catalogo.cod_rel bx,
catalogo.cat_almacen_clasifica cx,
catalogo.almacen dx
where dx.codigo=ax.cod and ax.sec between 1 and 1999 and ax.cod=bx.ean and  cx.sec=ax.sec and cod_rel$var>0 and
ax.cod not in(7501590211232,7501590233043,7501836002686,7501289511469,7501125102929) and ax.sec not in(154,3102,1026) and venta_pub>0
and
(select cod From catalogo.cat_fanasa x where x.codigo not in(7502004530758,7501493888760)
and x.rel$var=bx.cod_rel$var group by x.rel$var)is null
group by cod_rel$var
union all

select rel$var as cod_rel$var,concat(11,'||',rel$var,'||',
case when publico<case
when financiero<=2 and oferta=0 then round((costo/.9)+.5)
when financiero=0 and oferta>0 and oferta<=10 then round((costo/.87)+.5)
when financiero=0 and oferta>10 then round((costo/.87)+.5)
when financiero>0 and oferta>10 then round((costo/.75)+.5)
when financiero>2 and oferta=0 then round((costo/.85)+.5)
when financiero>0 and oferta>0 then round((costo/.85)+.5)
end then round(publico) else
case
when financiero<=2 and oferta=0 then round((costo/.9)+.5)
when financiero=0 and oferta>0 and oferta<=10 then round((costo/.87)+.5)
when financiero=0 and oferta>10 then round((costo/.87)+.5)
when financiero>0 and oferta>10 then round((costo/.75)+.5)
when financiero>2 and oferta=0 then round((costo/.85)+.5)
when financiero>0 and oferta>0 then round((costo/.85)+.5)
end
end
) as lidia
from catalogo.cat_fanasa a
where
codigo>0 and rel$var>0 and fecha_modificado>=date(now()) and codigo not in(7502004530758,7501493888760)
and (select codigo from catalogo.cat_empaque_fenix x where x.rel$var=a.rel$var group by x.rel$var) is null
or
codigo>0 and rel$var>0 and fecha_alta>=subdate(date(now()),300) and codigo not in(7502004530758)
and (select codigo from catalogo.cat_empaque_fenix x where x.rel$var=a.rel$var group by x.rel$var) is null
group by rel$var

union all
select case when $var=1 then 20393 else 21081 end as cod_rel$var,
concat(11,'||',case when $var=1 then 20393 else 21081 end,'||',round((vtagen/1.16),4))as lidia
from catalogo.almacen where sec in(1026)
union all
select a.rel$var as cod_rel$var,concat(11,'||',a.rel$var,'||',
case when (publico/can)<case
when financiero<=2 and oferta=0 then round(((costo/can)/.9)+.5)
when financiero=0 and oferta>0 and oferta<=10 then round(((costo/can)/.87)+.5)
when financiero=0 and oferta>10 then round(((costo/can)/.87)+.5)
when financiero>0 and oferta>10 then round(((costo/can)/.75)+.5)
when financiero>2 and oferta=0 then round(((costo/can)/.85)+.5)
when financiero>0 and oferta>0 then round(((costo/can)/.85)+.5)
end then round(publico) else
case
when financiero<=2 and oferta=0 then round(((costo/can)/.9)+.5)
when financiero=0 and oferta>0 and oferta<=10 then round(((costo/can)/.87)+.5)
when financiero=0 and oferta>10 then round(((costo/can)/.87)+.5)
when financiero>0 and oferta>10 then round(((costo/can)/.75)+.5)
when financiero>2 and oferta=0 then round(((costo/can)/.85)+.5)
when financiero>0 and oferta>0 then round(((costo/can)/.85)+.5)
end
end
) as lidia
from catalogo.cat_fanasa a
join catalogo.cat_empaque_fenix x on x.rel$var=a.rel$var
group by a.rel$var
) todo
group by cod_rel$var
order by cod_rel$var
";    
$q=$this->db->query($s);


$File = "./txt/preci_impe$var.txt";
$Handle = fopen($File, 'w');
foreach($q->result() as $r)
{
$Data=str_pad($r->lidia,500," ",STR_PAD_RIGHT)."\r\n";
    //echo $linea;
    fwrite($Handle, $Data);
    
}

fclose($Handle); 
$archivo="preci_impe$var.txt";
return $archivo;
}

function __envio_ofertas_caducados($var)
{
/////////////////////////////////////////////////////////////////////////////////////////////////////////////ofertas_-proximos a caducar
$desactiva="update compras.corta_caducidad_ctl a, compras.corta_caducidad_det b
set b.activo=4
where b.id_cc=a.id and a.activo=1 and b.activo=1 and date(now()) between fecha_inicio and fecha_fin and
(select sum(cant) from vtadc.vta_backoffice x where x.suc=a.suc and x.rel=cod_rel and x.fecha between fecha_inicio and fecha_fin)>=cantidad";
$this->db->query($desactiva);

$s="select suc,interno,lista_oferta
From catalogo.cat_replicas where lista_oferta>0 and servidor=$var";
$q=$this->db->query($s);
    foreach($q->result() as $r)
    {
        $File = "./txt/$var"."ofe".$r->lista_oferta.".txt";
        $s1="SELECT concat($r->lista_oferta,'||',cod_rel,'||0||',oferta)as lidia
        FROM compras.corta_caducidad_ctl a
        join compras.corta_caducidad_det b on b.id_cc=a.id
        where a.activo=1 and b.activo=1 and date(now()) between a.fecha_inicio and  a.fecha_fin and 
        a.suc = $r->suc and a.fecha_compra>'0000-00-00' and oferta>0
        group by cod_rel";
        $q1=$this->db->query($s1);
        $Handle = fopen($File, 'w');
        $Data='';
            foreach($q1->result() as $r1)
            {
            $Data.=str_pad($r1->lidia,500," ",STR_PAD_RIGHT)
            ."\r\n";
            }
            fwrite($Handle, $Data);
            fclose($Handle);
            $Data='';
            
    $File='';
    }
    
}

function __envio_ofertas_caducados_envio($var)
{
/////////////////////////////////////////////////////////////////////////////////////////////////////////////ofertas_-proximos a caducar
$s="select ftp,usuario,contra, b.lista_oferta,a.archivo from oficinas.procesos_controlador a
join catalogo.cat_replicas b on b.servidor=a.archivo
where a.id in(9,10) and lista_oferta>0 and archivo=$var";
$q=$this->db->query($s);
    foreach($q->result() as $r)
    {
$ar1=$r->archivo."ofe".$r->lista_oferta.".txt";   
$servidor_ftp    = $r->ftp;
$ftp_nombre_usuario = $r->usuario;
$ftp_contrasenya = $r->contra;


$archivo = "./txt/$ar1";
$da = fopen($archivo, 'r');
$archivo_remoto = "lidia/$ar1";

$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto, $archivo, FTP_ASCII)){$mensaje=1;} else {$mensaje=2;}


ftp_close($id_con);
fclose($da);
    }
}

function __envio_ofertas($var)
{
 if($var==1){$lista=6;}else{$lista=79;}
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////envia del server a backoffice
$s="SELECT concat($lista,'||',cod_rel$var,'||',0,'||',round(a.ofe_far,2),'||',date(now()))as lidia
FROM compras.ofertas_lab_far a
left join catalogo.cod_rel b on b.ean=a.codigo
where a.activo=2 and cod_rel$var>0 and date(now()) between fecha1 and fecha2
group by cod_rel$var
order by cod_rel$var";    
$q=$this->db->query($s);
$File = "./txt/oferta$var.txt";
$Handle = fopen($File, 'w');
foreach($q->result() as $r)
{
$Data=
        str_pad($r->lidia,500," ",STR_PAD_RIGHT)
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle, $Data);
    
}
fclose($Handle); 
$archivo="oferta$var.txt";
return $archivo;
}

function enlazar_var($id)
{
$s="SELECT * FROM oficinas.procesos_controlador where id=$id";
$q=$this->db->query($s);    
return $q;
}


function __proceso_movimientos()
{
//$sr="LOAD DATA INFILE '/home/central/backoffice/mov1.txt' 
//replace into table oficinas.movimientos FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
//(fecha,suc,  tipo, folio_ref,@movimiento, codigo, @descri, cantidad, costo,rel)
//set descri = CONVERT(CAST(@descri as BINARY) USING LATIN1),movimiento = CONVERT(CAST(@movimiento as BINARY) USING LATIN1)";
//$this->db->query($sr);
//$sr="LOAD DATA INFILE '/home/central/backoffice/mov2.txt' 
//replace into table oficinas.movimientos FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
//(fecha,suc,folio_ref,  tipo,@movimiento, codigo, @descri, cantidad, costo,rel)
//set descri = CONVERT(CAST(@descri as BINARY) USING LATIN1),movimiento = CONVERT(CAST(@movimiento as BINARY) USING LATIN1)";
//$this->db->query($sr);
$cas="select *from catalogo.sucursal where back>0 and tlid=1 and fecha_act='0000-00-00'";
$q4=$this->db->query($cas);
 foreach($q4->result()as $r4)
{
if(file_exists("g:/backoffice/mov".$r4->suc.".txt")){$this->transferFile('g:/backoffice/mov'.$r4->suc.'.txt','mov'.$r4->suc.'.txt');   
if($r4->back==1){
$sr="LOAD DATA INFILE '/home/central/backoffice/mov".$r4->suc.".txt' 
replace into table oficinas.movimientos FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(fecha,suc,  tipo, folio_ref, @movimiento, codigo, @descri, cantidad, costo,rel)
set descri = CONVERT(CAST(@descri as BINARY) USING LATIN1),movimiento = CONVERT(CAST(@movimiento as BINARY) USING LATIN1)";
$this->db->query($sr);   
}
if($r4->back==2){
$sr="LOAD DATA INFILE '/home/central/backoffice/mov".$r4->suc.".txt' 
replace into table oficinas.movimientos FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(fecha,suc,  folio_ref, tipo, @movimiento, codigo, @descri, cantidad, costo,rel)
set descri = CONVERT(CAST(@descri as BINARY) USING LATIN1),movimiento = CONVERT(CAST(@movimiento as BINARY) USING LATIN1)";
$this->db->query($sr);   
}}}
}

function __proceso_inv()
{
//$sr1="LOAD DATA INFILE '/home/central/backoffice/invdet1.txt' 
//replace into table oficinas.inv_det_bak FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
//$this->db->query($sr1);
//$sr2="LOAD DATA INFILE '/home/central/backoffice/invdet2.txt' 
//replace into table oficinas.inv_det_bak FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
//$this->db->query($sr2);
$cas="select *from catalogo.sucursal where back>0 and tlid=1 and fecha_act='0000-00-00'";
$q4=$this->db->query($cas);
 foreach($q4->result()as $r4)
{
if(file_exists("g:/backoffice/invdet".$r4->suc.".txt"))
{
$this->transferFile('g:/backoffice/invdet'.$r4->suc.'.txt','invdet'.$r4->suc.'.txt');
$s="delete from desarrollo.inv where suc=$r4->suc";
$this->db->query($s);
$sx="delete from subir10.p_inv_det_bak where fecha=date(now()) and suc=$r4->suc";
$this->db->query($sx);
$sr="LOAD DATA INFILE '/home/central/backoffice/invdet".$r4->suc.".txt' 
replace into table subir10.p_inv_det_bak FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
$this->db->query($sr);
$ad="insert into desarrollo.inv(tsuc, suc, mov, codigo, cantidad, fechai,sec,rel)
(select 'F',suc,3,codigo,piezas,fecha,0,rel from subir10.p_inv_det_bak where fecha=date(now()) and suc=$r4->suc)";
$this->db->query($ad); 
}}
}

function __proceso_facturas()
{

$por='insert ignore into vtadc.gc_compra_ctl_suc(suc, fecha, factura)
(select suc,fecha,factura from vtadc.gc_compra_det where fecha>=subdate(date(now()),20) group by suc,factura)';
$this->db->query($por);
$por1='update catalogo.folio_pedidos_cedis a, vtadc.gc_compra_ctl_suc b
set val_llego=1
where a.id=trim(b.factura)';
$this->db->query($por1);
$por2='update catalogo.folio_pedidos_cedis_especial a, vtadc.gc_compra_ctl_suc b
set val_llego=1
where a.id=trim(b.factura)';
$this->db->query($por2);

$fecha=date('Y-m-d');
$sr="LOAD DATA INFILE '/home/central/backoffice/comp2.txt'
replace into table vtadc.gc_compra_det FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(aaa, mes, suc, fecha, @factura, codigo, can, costo, iva, impo, imp_fac, prv, devuelta,rel)
set factura=replace(convert(cast(@factura as binary) using latin1),' ','');";
$this->db->query($sr);
$sr="LOAD DATA INFILE '/home/central/backoffice/comp1.txt'
replace into table vtadc.gc_compra_det FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(aaa, mes, suc, fecha, @factura, codigo, can, costo, iva, impo, imp_fac, prv, devuelta,rel)
set factura=replace(convert(cast(@factura as binary) using latin1),' ','');";
$this->db->query($sr);
$cas="select *from catalogo.sucursal where back>0 and tlid=1 and fecha_act='0000-00-00'";
$q4=$this->db->query($cas);
 foreach($q4->result()as $r4)
{
if(file_exists("g:/backoffice/comp".$r4->suc.".txt")){$this->transferFile('g:/backoffice/comp'.$r4->suc.'.txt','comp'.$r4->suc.'.txt');
if($r4->back==2){
$sr="LOAD DATA INFILE '/home/central/backoffice/com".$r4->suc.".txt' 
replace into table vtadc.gc_compra_det FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(aaa, mes, suc, fecha, @factura, codigo, can, costo, iva, impo, imp_fac, prv, devuelta,rel)
set factura=replace(convert(cast(@factura as binary) using latin1),' ','');";
$this->db->query($sr);
}
if($r4->back==1){
$sr="LOAD DATA INFILE '/home/central/backoffice/com".$r4->suc.".txt' 
replace into table vtadc.gc_compra_det FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(aaa, mes, suc, fecha, @factura, codigo, can, costo, iva, impo, imp_fac, prv, devuelta,rel)
set factura=replace(convert(cast(@factura as binary) using latin1),' ','');";
$this->db->query($sr);
}}}

$nivel_surtido="update compras.pre_pedido_fenix_det a, compras.pre_factura_fenix b
set a.sur=b.can, b.pedido=a.fol, cos_fac=((((can*far)-descuento)-adicional)/can),a.factura=b.fac
where a.suc=b.suc and a.cod=b.cod and b.fecha=adddate(a.fecha,1) and  a.fecha>=subdate(date(now()),4)
and pedido=0";
$this->db->query($nivel_surtido);
$nivel_surtido_ctl="insert compras.pre_pedido_fenix_ctl(fecha, suc, prv, importe, fol, tipo, canp,
imp_facturado, cans,t_pedido,pro_ped,pro_fac)
(select fecha, suc, prv,  round(sum((piezas*costo)*(1+iva)),4), fol, 'A', sum(piezas),
round(sum((sur*costo)*(1+iva)),4),sum(sur),'f',count(*),sum(case when sur>0 then +1 else +0 end)
from compras.pre_pedido_fenix_det where fecha>=subdate(date(now()),4) group by fol,suc )
on duplicate key update
importe=values(importe),imp_facturado=values(imp_facturado),cans=values(cans),pro_ped=values(pro_ped),pro_fac=values(pro_fac)";
$this->db->query($nivel_surtido_ctl);


}
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
function back_controlador($id)
{
$s="select *from back.controlodar_nuevo where id=$id";
$q=$this->db->query($s);
return $q;
}
/////////////////////////////////////////////////////////////////////////////
function __factura_fanasa()
{
ini_set('memory_limit','9000M');
set_time_limit(0);
$ss="delete from subir10.p_pre_factura_fenix";
$this->db->query($ss);
$this->load->library('ftp');
$fectime=date('Y-m-d H:i:s');
$config1['hostname'] ='fenixcentral01.homeip.net';
$config1['username'] ='administrador';
$config1['password'] ='PharmaF3n1x';
$config1['debug']    = FALSE;
$this->ftp->connect($config1);
$fec2=date('ymd');    
$am2=$this->ftp->download('fanasa/FACTURA.TXT','./transfer/facfan'.$fec2.'.txt');

if(file_exists("c:/wamp/www/oficinas/transfer/facfan".$fec2.".txt")){
    $this->transferFile('c:/wamp/www/oficinas/transfer/facfan'.$fec2.'.txt','facfanasa.txt');}
 $s1="LOAD DATA INFILE '/home/central/backoffice/facfanasa.txt'
replace INTO TABLE subir10.p_pre_factura_fenix LINES TERMINATED BY '\r\n' (@var1)
SET prv=825,
fecha=SUBSTRING(@var1,25,8),
suc=ifnull((select suc from compras.cuentas_mayorista where num_prv=trim(SUBSTRING(@var1,20,5)) and prv=825),0),
fac=SUBSTRING(@var1,1,10),
cod=SUBSTRING(@var1,33,13),
can=SUBSTRING(@var1,55,7),
far=SUBSTRING(@var1,46,9),

descuento= case when SUBSTRING(@var1,84,6)>0 then
(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end,

adicional= case when SUBSTRING(@var1,78,6)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end))
*((SUBSTRING(@var1,78,6)/100))
else 0 end,

iva=case when SUBSTRING(@var1,69,9)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then
(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end)-(case when SUBSTRING(@var1,78,6)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end))*((SUBSTRING(@var1,78,6)/100))else 0 end))
*((SUBSTRING(@var1,69,9)/100))
else 0 end,

ieps=case when SUBSTRING(@var1,62,9)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then
(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end)-(case when SUBSTRING(@var1,78,6)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end))*((SUBSTRING(@var1,78,6)/100))else 0 end))
*((SUBSTRING(@var1,62,9)/100))
else 0 end,

importe=
(
(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-
(case when SUBSTRING(@var1,84,6)>0 then
(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end)-
(case when SUBSTRING(@var1,78,6)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end))
*((SUBSTRING(@var1,78,6)/100))
else 0 end)+
(case when SUBSTRING(@var1,69,9)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then
(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end)-(case when SUBSTRING(@var1,78,6)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end))*((SUBSTRING(@var1,78,6)/100))else 0 end))
*((SUBSTRING(@var1,69,9)/100))
else 0 end)+
(case when SUBSTRING(@var1,62,9)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then
(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end)-(case when SUBSTRING(@var1,78,6)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end))*((SUBSTRING(@var1,78,6)/100))else 0 end))
*((SUBSTRING(@var1,62,9)/100))
else 0 end))
,
fec_pedido=subdate((SUBSTRING(@var1,25,8)),1)";
$this->db->query($s1);


$config2['hostname'] ='fenixcentral.homeip.net';
$config2['username'] ='administrador';
$config2['password'] ='PharmaF3n1x';
$config2['debug']    = FALSE;
$this->ftp->connect($config2);
$fec2=date('ymd');    
$this->ftp->download('fanasa/FACTURA.TXT','./transfer/facfan'.$fec2.'.txt');

if(file_exists("c:/wamp/www/oficinas/transfer/facfan".$fec2.".txt")){
    $this->transferFile('c:/wamp/www/oficinas/transfer/facfan'.$fec2.'.txt','facfanasa.txt');}
 $s1dos="LOAD DATA INFILE '/home/central/backoffice/facfanasa.txt'
replace INTO TABLE subir10.p_pre_factura_fenix LINES TERMINATED BY '\r\n' (@var1)
SET prv=825,
fecha=SUBSTRING(@var1,25,8),
suc=ifnull((select suc from compras.cuentas_mayorista where num_prv=trim(SUBSTRING(@var1,20,5)) and prv=825),0),
fac=SUBSTRING(@var1,1,10),
cod=SUBSTRING(@var1,33,13),
can=SUBSTRING(@var1,55,7),
far=SUBSTRING(@var1,46,9),

descuento= case when SUBSTRING(@var1,84,6)>0 then
(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end,

adicional= case when SUBSTRING(@var1,78,6)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end))
*((SUBSTRING(@var1,78,6)/100))
else 0 end,

iva=case when SUBSTRING(@var1,69,9)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then
(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end)-(case when SUBSTRING(@var1,78,6)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end))*((SUBSTRING(@var1,78,6)/100))else 0 end))
*((SUBSTRING(@var1,69,9)/100))
else 0 end,

ieps=case when SUBSTRING(@var1,62,9)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then
(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end)-(case when SUBSTRING(@var1,78,6)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end))*((SUBSTRING(@var1,78,6)/100))else 0 end))
*((SUBSTRING(@var1,62,9)/100))
else 0 end,

importe=
(
(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-
(case when SUBSTRING(@var1,84,6)>0 then
(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end)-
(case when SUBSTRING(@var1,78,6)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end))
*((SUBSTRING(@var1,78,6)/100))
else 0 end)+
(case when SUBSTRING(@var1,69,9)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then
(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end)-(case when SUBSTRING(@var1,78,6)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end))*((SUBSTRING(@var1,78,6)/100))else 0 end))
*((SUBSTRING(@var1,69,9)/100))
else 0 end)+
(case when SUBSTRING(@var1,62,9)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then
(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end)-(case when SUBSTRING(@var1,78,6)>0 then
((SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))-(case when SUBSTRING(@var1,84,6)>0 then(SUBSTRING(@var1,84,6)/100)*(SUBSTRING(@var1,46,9)*SUBSTRING(@var1,55,7))
else 0 end))*((SUBSTRING(@var1,78,6)/100))else 0 end))
*((SUBSTRING(@var1,62,9)/100))
else 0 end))
,
fec_pedido=subdate((SUBSTRING(@var1,25,8)),1)";
$this->db->query($s1dos);

$asi="insert ignore into compras.pre_factura_fenix
(prv, fecha, suc, fac, cod, can, far, descuento, ieps, iva, importe, adicional, sur, fec_pedido)
(select prv, fecha, suc, fac, cod, can, far, descuento, ieps, iva, importe, adicional, sur, fec_pedido 
from subir10.p_pre_factura_fenix)";
$this->db->query($asi);
$descu="update compras.pre_factura_fenix a, catalogo.cat_condisiones_mayoristas b
 set a.vol=b.volumen ,a.p_pago=p_pago,fin=b.base
where a.cod=b.codigo and a.prv=b.prv";
$this->db->query($descu);
$des="update compras.pre_factura_fenix a, compras.ofertas_lab_far b
set a.ofe_lab=(b.ofe_lab/100)
where a.cod=b.codigo and a.fecha between b.fecha1 and b.fecha2";
$this->db->query($des);

$s="insert ignore into  compras.pre_factura_fenix_ctl(prv, suc, fac, imp_prv, imp_suc, imp_cxp, fecha,can_prv)
(select prv, suc, fac, sum(importe), 0, 0, fecha,sum(can) from compras.pre_factura_fenix group by prv,fac)";
$this->db->query($s);
echo 'fanasa/facfanasa.txt'.' Factura de FARMACOS<br />';       

$rel1="update compras.pre_factura_fenix a, catalogo.cod_rel b,catalogo.sucursal c
set rel=cod_rel1
where a.cod=b.ean and a.suc=c.suc and back=1 and a.rel=0";
$this->db->query($rel1);
$rel2="update compras.pre_factura_fenix a, catalogo.cod_rel b,catalogo.sucursal c
set rel=cod_rel2
where a.cod=b.ean and a.suc=c.suc and back=2 and a.rel=0";
$this->db->query($rel2);

}
/////////////////////////////////////////////////////////////////////////////
     

function poliza_inv()
{
$s="select fecha_act,a.suc,a.nombre,sum(cantidad)as exis,obser
from catalogo.sucursal a
left join desarrollo.inv b on b.suc=a.suc and fechai>=subdate(date(now()),2) and mov in(3,7)
where tlid=1 and tipo3 in('DA','FE','FA','MO') and a.suc<>194 and fecha_act='0000-00-00'
group by a.suc
order by exis,a.suc";
$q = $this->db->query($s);    
 return $q;    
}
function poliza_inv_detalle($aaa,$mes,$dia,$sem)
{
$s1="insert ignore into inventarios.inv_mes_suc_det(sem,aaa, mes, dia, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo)
(select $sem,$aaa,$mes,$dia,13,900,a.sec,' ',a.codigo,' ',sum(inv1),a.costo,b.lin,'INV CEDIS'
from desarrollo.inv_cedis a
join catalogo.sec_generica_t b on b.sec=a.sec
where a.inv1>0
group by a.codigo)";
$this->db->query($s1);

$s2="insert ignore into inventarios.inv_mes_suc_det(sem, aaa, mes, dia, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo)
(select $sem,$aaa,$mes,$dia,b.cia,a.suc,c.sec,c.clagob,a.codigo,descri,cantidad,costo_back,lin, 'INV FENIX'
from desarrollo.inv a
join catalogo.sucursal b on b.suc = a.suc
left join compras.costos_generales c on c.codigo=a.codigo and fecha_act='0000-00-00'
where fechai>=subdate(date(now()),2) and tipo3='FE' and mov=3)";
$this->db->query($s2);
$s3="insert ignore into inventarios.inv_mes_suc_det(sem, aaa, mes, dia, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo)
(select $sem,$aaa,$mes,$dia,b.cia,a.suc,a.sec,'',a.codigo,c.susa,cantidad,round((costo_entrada*1.10)),lin, 'INV DOCTOR AHORRO'
from desarrollo.inv a
join catalogo.sucursal b on b.suc = a.suc
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec and fecha_act='0000-00-00'
where fechai>=subdate(date(now()),2) and tipo3='DA' and mov=7 and cantidad>0)";  
$this->db->query($s3);
$s4="insert ignore into inventarios.inv_mes_suc_det(sem, aaa, mes, dia, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo)
(SELECT
$sem,$aaa,$mes,$dia,1,100,b.sec,clagob,a.ean,b.susa,sum(cantidad),

(case
when costo>0 then a.costo
when costo=0 and costo_segpop>0 then costo_segpop
when costo=0 and costo_segpop=0 and costo_gen>0 then costo_gen
when costo=0 and costo_segpop=0 and costo_gen=0 and costo_patente>0 then costo_patente
when costo=0 and costo_segpop=0 and costo_gen=0 and costo_patente=0 and costo_back>0 then costo_back
end),
b.lin,
'INV_CONTROLADOS'
FROM controlado.inventario a
join compras.costos_generales b on b.codigo=a.ean
where a.cantidad>0
group by ean)";
$this->db->query($s4);
$s5="insert ignore into inventarios.inv_mes_suc_det(sem, aaa, mes, dia, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo)
(SELECT
$sem,$aaa,$mes,$dia, 1,case when areaID=4 then 19000 when areaID=5 then 100 when areaID=2 then 16000 end ,0,cvearticulo,ean,concat(a.susa,' ',a.descripcion,' ', a.pres), sum(cantidad),
ifnull(
case
when
(select case when (costo_segpop)>0 then (costo_segpop) when (costo_segpop)=0 then (costo_patente) when (costo_segpop)=0 then (costo_gen) end
from compras.costos_generales a where a.codigo=i.ean)>0
then
(select case when (costo_segpop)>0 then (costo_segpop) when (costo_segpop)=0 then (costo_patente) when (costo_segpop)=0 then (costo_gen)
end from compras.costos_generales a where a.codigo=i.ean)
when
(select case when (costo_segpop)>0 then (costo_segpop) when (costo_segpop)=0 then (costo_patente) when (costo_segpop)=0 then (costo_gen)
end from compras.costos_generales a where a.codigo=i.ean) is null
then
(select case when max(costo_segpop)>0 then max(costo_segpop) when max(costo_segpop)=0 then max(costo_patente) when max(costo_segpop)=0 then max(costo_gen)
end from compras.costos_generales a where a.clagob=cvearticulo group by cvearticulo)
end,
(select costo from catalogo.segpop x where x.claves=cvearticulo and costo>0 group by claves ))
,
0,
case when areaID=4 then 'INV OAXACA' when areaID=5 then 'INV SP' when areaID=2 then 'INV CHETUMAL' end
FROM spcentral.inventario i
join spcentral.articulos a using(id)
join spcentral.temporal_suministro s on a.tipoprod = s.cvesuministro
left join spcentral.ubicacion u using(ubicacion)


where cantidad <> 0 and i.clvsucursal = 90002
group by tipoprod, ean,cvearticulo
order by areaID)";
$this->db->query($s5);
$s6="update inventarios.inv_mes_suc_det a,catalogo.cat_mercadotecnia b
set a.lin=b.lin
where a.codigo=b.codigo and b.lin>0 and a.lin=0 and a.codigo>0 and aaa=$aaa and sem=$sem";
$this->db->query($s6);
$s7="update inventarios.inv_mes_suc_det a,catalogo.segpop b
set a.lin=b.lin
where a.clave=b.claves and b.lin>0 and a.lin=0 and aaa=$aaa and sem=$sem";
$this->db->query($s7);


$s8="insert ignore into inventarios.inv_mes_suc_ctl(sem, aaa, mes, dia, cia, suc, piezas, importe)
(select sem, aaa, mes, dia, cia, suc, sum(piezas), sum(piezas*costo) 
from inventarios.inv_mes_suc_det where sem=$sem and aaa=$aaa group by sem,suc)";
$this->db->query($s8);
}
function respaldo_poliza_inv($sem,$aaa)
{
$sf1="insert ignore into inventarios.inv_cosvta(cia, suc, sem, aaa, mes, dia, lin, plaza, succ, importe, piezas)
(select cia, suc, sem, aaa, mes, dia, lin, 0, 0, sum(piezas), sum(piezas*costo)
from inventarios.inv_mes_suc_det where sem=$sem and aaa=$aaa group by sem,suc,lin)";
$this->db->query($sf1);

$sf2="insert into inventarios.inv_mes_suc_his(sem, aaa, mes, dia, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo)
(select sem, aaa, mes, dia, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo from inventarios.inv_mes_suc_det)";
$this->db->query($sf2);
$sf3="delete  from inventarios.inv_mes_suc_det";
$this->db->query($sf3);    
}
function semana_corrida()
{
$s="SELECT max(sem) as sem FROM inventarios.inv_mes_suc_ctl";    
$q=$this->db->query($s);
$r=$q->row();
$sem=$r->sem;
return $sem;
}
function semana_respaldada()
{
$s="SELECT max(sem) as sem FROM inventarios.inv_cosvta ";    
$q=$this->db->query($s);
$r=$q->row();
$sem=$r->sem;
return $sem;
}
function poliza_34_almacen($aaa,$mes)
{
$as="update  desarrollo.pedidos a, catalogo.almacen b set a.lin=b.lin where a.sec=b.sec and a.lin=0";
$this->db->query($as);

$sqlx="select b.cia,34 as pol,year(fechasur)as aaa,month(fechasur)as mes,a.suc as suc,plaza,
suc_contable,a.lin,sum(sur) as piezas,
case when b.cia=4 then sum(sur*(costo*1.2)) else sum(sur*costo) end as sub,
case when b.cia=4
then case when a.lin in(2,5,10,9) then sum((sur*(costo*1.2))*b.iva) else 0 end
else
case when a.lin in(2,5,10,9) then sum((sur*costo)*b.iva) else 0 end end as ivaimp,

case when b.cia=4 then case when a.lin in(2,5,10,9) then sum(sur*(costo*1.2)) + sum((sur*(costo*1.2))*b.iva)
else
sum(sur*(costo*1.2)) end else case when a.lin in(2,5,10,9) then sum(sur*costo) + sum((sur*costo)*b.iva)
else sum(sur*costo) end
end as total

FROM  desarrollo.pedidos a
left join catalogo.sucursal b on b.suc=a.suc
where a.suc>100 and year(fechasur)=$aaa and month(fechasur)=$mes and sur>0
group by a.suc, a.lin
order by a.suc";
$queryx = $this->db->query($sqlx);
//echo $this->db->last_query();
//die();
if($queryx->num_rows() > 0){//cia, suc, sem, aaaa, mes, lin, plaza, succ, importe
    
    $File = "./txt/cosalm.txt";
    $Handle = fopen($File, 'w');
$cero=0;$subx=0;$ivax=0;$tot=0;
foreach($queryx->result() as $rowx)  
{
$subx=round($rowx->sub*100);
$ivax=round($rowx->ivaimp*100);
$tot=round($rowx->total*100);
   
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
$servidor_ftp    = '192.168.1.3';
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


function poliza_34_almacen_excel($aaa,$mes)
{
$s = "select b.cia,34 as POLIZA,year(fechasur)as AAA,month(fechasur)as MES,a.suc as NID,b.nombre as SUCURSAL,plaza as PLAZA,suc_contable as SUC_CONTABLE,a.lin as LINEA,sec as SEC,susa as PRODUCTO,sum(sur) as PIEZAS,
case when b.cia=4 then (sum(sur*(costo*1.2))/sum(sur)) else (sum(sur*costo)/sum(sur)) end as COSTO_PONDERADO,
case when b.cia=4 then sum(sur*(costo*1.2)) else sum(sur*costo) end as SUBTOTAL,
case when b.cia=4
then case when a.lin in(2,5,10,9) then sum((sur*(costo*1.2))*b.iva) else 0 end
else
case when a.lin in(2,5,10,9) then sum((sur*costo)*b.iva) else 0 end end as IVA,
case when b.cia=4 then case when a.lin in(2,5,10,9) then sum(sur*(costo*1.2)) + sum((sur*(costo*1.2))*b.iva)
else
sum(sur*(costo*1.2)) end else case when a.lin in(2,5,10,9) then sum(sur*costo) + sum((sur*costo)*b.iva)
else sum(sur*costo) end
end as TOTAL

FROM  desarrollo.pedidos a
left join catalogo.sucursal b on b.suc=a.suc
where a.suc>100 and year(fechasur)=$aaa and month(fechasur)=$mes and sur>0
group by a.suc, a.sec
order by a.suc
";
        $q = $this->db->query($s);
        return $q;    
}













}