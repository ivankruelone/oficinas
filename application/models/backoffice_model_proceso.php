<?php
class backoffice_model_proceso extends CI_Model
{
   function __construct()
    {
        parent::__construct();
    }

function enlazar($men)
{
$s="SELECT * FROM oficinas.procesos_controlador where men=$men";
$q=$this->db->query($s);    
return $q;
}
function enlazar_var($id)
{
$s="SELECT * FROM oficinas.procesos_controlador where id=$id";
$q=$this->db->query($s);    
return $q;
}

////////////////////////////////////////////////////////////////////////////////////////////////////
public function genera_gon_imp($fec)
{
$m=substr($fec,5,2);
$s="select (select count(*) from vtadc.venta_ctl b 
where b.suc=a.suc and date_format(fecha,'%Y-%m')='$fec'), a.suc,b.dos,num
from catalogo.sucursal a,catalogo.mes b
where
a.tlid=1 and a.back>0 and
(select count(*) from vtadc.venta_ctl b where b.suc=a.suc and date_format(fecha,'%Y-%m')='$fec')=b.dos and num=$m
and a.suc not in(127,176,177,178,179,180,187)
or
a.tlid=1 and a.back>0 and num=$m 
and a.suc not in(127,176,177,178,179,180,187)";
$q=$this->db->query($s);
if($q->num_rows() > 0){
foreach($q->result() as $r)
        {
            $a = $this->__arreglo_gontor_imperial($r->suc,$fec);
        }}

$borrar="update catalogo.cat_almacen_clasifica a, catalogo.cat_fenix_sec_cod b, oficinas.comisionf_det c
set c.tipo='X'
where b.sec=a.sec and b.cod=c.cod and date_format(c.fecha,'%Y-%m')='$fec'
and a.val=1";
$this->db->query($borrar);
}
function __arreglo_gontor_imperial($suc,$fec)
{
$sql="insert ignore into oficinas.comisionf_det(fecha, suc, tic, cod, des, lin, slin, cant, imp, nomina, cia, nombre, completo)

(SELECT fecha,a.suc,tic,cod,des,
case when b.lin=10 then 1 else b.lin end,
case
when b.lin=10 and b.prv in(391,392) then 3
when b.lin=10 and b.prv<>391 and b.prv<>392 then 4
else b.sublin end,cant,imp,a.nomina,
ifnull((select cia from catalogo.cat_empleado x where x.nomina=a.nomina and tipo=1),0),
nom,
ifnull((select trim(completo) from catalogo.cat_empleado x where x.nomina=a.nomina and tipo=1),'')
FROM vtadc.vta_backoffice a
left join catalogo.almacen b on b.codigo=a.cod
where
a.suc=$suc and b.susa2 not like '%FARMABODEGA%' and vtatip=1 and b.sec>0 and b.sec<=2000 and b.lin=1 and b.sublin in(3,4) and date_format(fecha,'%Y-%m')>='$fec' or
a.suc=$suc and b.susa2 not like '%FARMABODEGA%' and vtatip=1 and b.sec>0 and b.sec<=2000 and b.lin=2 and b.sublin in(30) and date_format(fecha,'%Y-%m')>='$fec' or
a.suc=$suc and b.susa2 not like '%FARMABODEGA%' and vtatip=1 and b.sec>0 and b.sec<=2000 and b.lin=10 and date_format(fecha,'%Y-%m')>='$fec'
)";
$query=$this->db->query($sql);


}
 function envia_gontor_imp($fec)
 { 
  
            $s1="SELECT lin,slin,cia,nomina,replace(nombre,'¥','N')as nombre,
case
when lin=1 and slin=3 then 'GONTOR'
when lin=1 and slin=4 then 'IMPERIALES' else 'GONTOR'end as farma,
date_format(fecha,'%Y%m%d')as fech,month(fecha)as mes, suc,sum(imp)as imp

from oficinas.comisionf_det a
where date_format(fecha,'%Y-%m')='$fec' and tipo='A' and a.suc>100 and a.suc<=1999
and a.suc not in(127,176,177,178,179,180,187)
group by suc,fecha,nomina,farma";
            $q1=$this->db->query($s1);
        
    $File = "./txt/gont_imp.txt";
    $Handle = fopen($File, 'w');
    foreach($q1->result() as $r1)
        {
$imp=round(($r1->imp*100),0);

  $Data=
         str_pad($r1->cia,2,"0",STR_PAD_LEFT)
        .str_pad($r1->nomina,8,"0",STR_PAD_LEFT)
        .str_pad($r1->nombre,40," ",STR_PAD_RIGHT)
        .str_pad($r1->farma,10," ",STR_PAD_RIGHT)
        .str_pad($r1->fech,8,"0",STR_PAD_LEFT)
        .str_pad($r1->mes,2,"0",STR_PAD_LEFT)
        .str_pad($r1->suc,4,"0",STR_PAD_LEFT)
        .str_pad($imp,15,"0",STR_PAD_LEFT)
        ."\r\n";         
         fwrite($Handle, $Data);   
//echo $r1->nombre.'<br />';
        }
        fclose($Handle);
 
//die();        
        /////////////////////////////////////////////////////////////////////////////////////////////////////////



$servidor_ftp    = "192.168.1.83";
$ftp_nombre_usuario = "transfer";
$ftp_contrasenya = "transfer";

$archivo = './txt/gont_imp.txt';
$da = fopen($archivo, 'r');
$archivo_remoto = 'fnxnomdata/cohvta';



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
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function enlace_catalogos($ftp,$usua,$contra,$archivo)
{
ini_set('memory_limit','10000M');
set_time_limit(0);
$this->load->library('ftp');
$fec=date('dmY');
$fectime=date('Y-m-d H:i:s');
$config1['hostname'] =$ftp;
$config1['username'] =$usua;
$config1['password'] =$contra;
$config1['debug']    = FALSE;
$this->ftp->connect($config1);

if($archivo==2){
$this->ftp->download('lidia/rel'.$archivo.'.txt', './transfer/rel'.$archivo.$fec.'.txt');

if(file_exists("c:/wamp/www/oficinas/transfer/rel$archivo.$fec.txt")){
$borra3="delete from subir10.cod_rel2";
$this->db->query($borra3);
$sr="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/rel".$archivo.$fec.".txt' 
replace into table subir10.cod_rel2 FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(ean, cod_rel, @descripcion, lin, slin, pub, far, cos, iva)
set descripcion = CONVERT(CAST(@descripcion as BINARY) USING LATIN1)";
$this->db->query($sr);
}

$this->ftp->download('/saba/catalogo.txt', './transfer/catsab'.$archivo.$fec.'.txt');
if(file_exists("c:/wamp/www/oficinas/transfer/catsab".$archivo.$fec.".txt")){
$s="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/catsab".$archivo.$fec.".txt'
 replace INTO TABLE catalogo.cat_sabap LINES TERMINATED BY '\r\n' (@var1)
SET fecha_alta='$fectime',codigo = trim(SUBSTR(@var1, 1, 13)),descripcion = SUBSTR(@var1,14, 30),
farmacia = SUBSTR(@var1, 56, 9),costo =round(SUBSTR(@var1, 56, 9)-(case when SUBSTR(@var1, 66, 9)>0 then (SUBSTR(@var1, 66, 9)/100)*SUBSTR(@var1, 56, 9) else 0 end),2),lab=SUBSTR(@var1, 85, 30),nivel_existencia = 0,
publico=SUBSTR(@var1, 46,9),oferta=0,antibiotico = ' ',iva = SUBSTR(@var1, 80,5),financiero= SUBSTR(@var1, 66, 9),
producto = case when SUBSTR(@var1, 66, 9)=18 then 'NOR' when SUBSTR(@var1, 66, 9)=0 then 'NET' else 'LIM' end";
$this->db->query($s);
}}
if($archivo==1){
$this->ftp->download('lidia/rel'.$archivo.'.txt', './transfer/rel'.$archivo.$fec.'.txt');
if(file_exists("c:/wamp/www/oficinas/transfer/rel".$archivo.$fec.".txt")){
$borra2="delete from subir10.cod_rel1";
$this->db->query($borra2);
$sr="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/rel".$archivo.$fec.".txt' 
replace into table subir10.cod_rel1 FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(ean, cod_rel, @descripcion, lin, slin, pub, far, cos, iva)
set descripcion = CONVERT(CAST(@descripcion as BINARY) USING LATIN1)";
$this->db->query($sr);
}
$this->ftp->download('/fanasa/catalogo.dat', './transfer/catfan'.$archivo.$fec.'.txt');

if(file_exists("c:/wamp/www/oficinas/transfer/catfan".$archivo.$fec.".txt")){
$s="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/catfan".$archivo.$fec.".txt'
 replace INTO TABLE catalogo.cat_fanasa LINES TERMINATED BY '\r\n' (@var1) SET fecha_alta='$fectime',codigo = case when trim(SUBSTR(@var1, 88, 13))not in('00000002C1082','00000005C4957','2C1071') 
then trim(SUBSTR(@var1, 88, 13)) else 0 end,descripcion = concat(trim(SUBSTR(@var1,18, 25)),' ',trim(SUBSTR(@var1,43, 10))),
farmacia = (SUBSTR(@var1,72, 9)/100),publico = (SUBSTR(@var1,63, 9)/100),costo =0,oferta=0,antibiotico = ' ',iva = 0,
financiero= 0,lab=(SUBSTR(@var1,53, 10))";
$this->db->query($s);
}
$this->ftp->download('/fanasa/SINOFE.txt', './transfer/sinfan'.$archivo.$fec.'.txt');

if(file_exists("c:/wamp/www/oficinas/transfer/sinfan".$archivo.$fec.".txt")){
$borra="delete from subir10.p_cat_fanasa";
$this->db->query($borra);
$s="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/sinfan".$archivo.$fec.".txt'
 replace INTO TABLE subir10.p_cat_fanasa LINES TERMINATED BY '\r\n'
 (@var1) SET fecha_alta='$fectime', codigo =  case when trim(SUBSTR(@var1, 1, 13))not in('00000002C1082','00000005C4957','2C1071')
then trim(SUBSTR(@var1, 1, 13)) else 0 end, descripcion = concat(trim(SUBSTR(@var1,14, 25)),' ',trim(SUBSTR(@var1,39, 10))),
farmacia = SUBSTR(@var1, 49, 9),financiero= case when SUBSTR(@var1, 58,3)='100' then 18 else (SUBSTR(@var1, 58,6)) end,
producto=case when SUBSTR(@var1, 58,6)='100.00' then 'NOR' when SUBSTR(@var1, 58,6)='  0.00' then 'NET' else 'LIM' end";
$this->db->query($s);
}
$this->ftp->download('/fanasa/CONOFE.txt', './transfer/confan'.$archivo.$fec.'.txt');

if(file_exists("c:/wamp/www/oficinas/transfer/confan".$archivo.$fec.".txt")){
$s="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/confan".$archivo.$fec.".txt'
 replace INTO TABLE subir10.p_cat_fanasa LINES TERMINATED BY '\r\n' (@var1) SET fecha_alta='$fectime',
codigo =  case when trim(SUBSTR(@var1, 13, 13))not in('00000002C1082','00000005C4957','2C1071')
then trim(SUBSTR(@var1, 13, 13)) else 0 end,descripcion = concat(trim(SUBSTR(@var1,26, 25)),' ',trim(SUBSTR(@var1,51, 10))),
farmacia = SUBSTR(@var1, 61, 9),oferta= SUBSTR(@var1, 70,6),financiero= case when SUBSTR(@var1, 97,3)='100' then 18 else (SUBSTR(@var1, 97,6)) end,
producto=case when SUBSTR(@var1, 97,6)='100.00' then 'NOR' when SUBSTR(@var1, 97,6)='  0.00' then 'NET' else 'LIM' end";
$this->db->query($s);
}
$this->ftp->download('/saba/SINOFE.txt', './transfer/sinsab'.$archivo.$fec.'.txt');
$this->ftp->download('/saba/conofe.txt', './transfer/consab'.$archivo.$fec.'.txt');

if(file_exists("c:/wamp/www/oficinas/transfer/consab".$archivo.$fec.".txt")){
$borra1="delete from subir10.p_cat_saba";
$this->db->query($borra1);
$s="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/consab".$archivo.$fec.".txt'
 replace INTO TABLE subir10.p_cat_saba LINES TERMINATED BY '\r\n' (@var1) SET fecha_alta=date(now()),codigo = trim(SUBSTR(@var1, 13, 13)),
descripcion = SUBSTR(@var1,26, 30),farmacia = SUBSTR(@var1, 56, 9),oferta=SUBSTR(@var1, 65, 6),financiero= case when SUBSTR(@var1, 92,3)=100 then 18 else (SUBSTR(@var1, 92,5)) end,
producto=case when SUBSTR(@var1, 92,6)='018.00' then 'NOR' when SUBSTR(@var1, 92,6)='000.00' then 'NET' else 'LIM' end";
$this->db->query($s);
}
$this->ftp->download('/nadro/SINOFE.txt', './transfer/sinnad'.$archivo.$fec.'.txt');

if(file_exists("c:/wamp/www/oficinas/transfer/sinnad".$archivo.$fec.".txt")){
$s="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/sinnad".$archivo.$fec.".txt'
 replace INTO TABLE catalogo.cat_nadro  LINES STARTING BY '51          ' (@var1) SET fecha_alta='$fectime',
codigo = case when (trim(SUBSTR(@var1, 1, 13))) <>'' then trim(SUBSTR(@var1, 1, 13)) else 0 end,
descripcion = SUBSTR(@var1,14, 30),costo = SUBSTR(@var1, 44, 9),publico = SUBSTR(@var1, 61, 9),antibiotico =SUBSTR(@var1, 60, 1)";
$this->db->query($s);
}
$this->ftp->download('/marzam/SINOFE.TXT', './transfer/sinmar'.$archivo.$fec.'.txt');

if(file_exists("c:/wamp/www/oficinas/transfer/sinmar".$archivo.$fec.".txt")){
$borra1="delete from subir10.p_cat_marzam";
$this->db->query($borra1);
$s="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/sinmar".$archivo.$fec.".txt'
replace INTO TABLE subir10.p_cat_marzam LINES TERMINATED BY  '\r\n' (@var1)
SET fecha_alta='2014-06-10 13:37:22',codigo = case when trim(SUBSTR(@var1, 1, 13)) = ' ' then 0 else trim(SUBSTR(@var1, 1, 13)) end,descripcion = trim(SUBSTR(@var1,14, 30)),
farmacia = SUBSTR(@var1, 44, 9),financiero= SUBSTR(@var1, 53,6),iva=SUBSTR(@var1, 59,1),oferta=0,
antibiotico=SUBSTR(@var1, 60,1),pub=SUBSTR(@var1, 61,9),lab=SUBSTR(@var1, 71,30),ieps=SUBSTR(@var1, 102,6)";
$this->db->query($s);
}
$this->ftp->download('/marzam/CONOFE.TXT', './transfer/conmar'.$archivo.$fec.'.txt');

if(file_exists("c:/wamp/www/oficinas/transfer/conmar".$archivo.$fec.".txt")){
$borra1="delete from subir10.p_cat_marzam_1";
$this->db->query($borra1);
$s="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/conmar".$archivo.$fec.".txt'
replace INTO TABLE subir10.p_cat_marzam_1 LINES TERMINATED BY '\r\n'
 (@var1) SET fecha_alta=date(now()), codigo =  case when trim(SUBSTR(@var1, 13, 13)) = ' ' then 0 else trim(SUBSTR(@var1, 13, 13)) end,
descripcion = trim(SUBSTR(@var1,27, 30)),farmacia = SUBSTR(@var1, 57, 9),financiero= SUBSTR(@var1, 94,6),
iva=SUBSTR(@var1, 100,1),antibiotico=SUBSTR(@var1, 101,1),pub=SUBSTR(@var1, 102,9),lab=SUBSTR(@var1, 112,30),
ieps=SUBSTR(@var1, 152,6),oferta=SUBSTR(@var1, 67,6)";
$this->db->query($s);
}
$this->__catalogos($fec,$archivo);
}
$fectime2=date('Y-m-d H:i:s');
echo 'INICIO:'.$fectime.'<br />FINALIZA '.$fectime2.'<br /><strong>YA SE GENERO EL ENLACE DE CATALOGOS DE PHARMACY'.$archivo.'</strong>';
}  
function __catalogos($fec,$archivo)
{
$sp="insert into catalogo.cod_rel
(ean, cod_rel1, cod_rel2, descripcion1, descripcion2, lin, slin, pub1, far1, cos1, pub2, far2, cos2, nivel, iva)
(select 
ean, 0, cod_rel, ' ', descripcion, lin, slin, 0, 0, 0, pub, far, cos, 0, iva from subir10.cod_rel2)
on duplicate key update descripcion2=values(descripcion2), pub2=values(pub2),far2=values(far2),cos2=values(cos2), iva=values(iva), cod_rel2=values(cod_rel2),
lin=values(lin),slin=values(slin)";
$this->db->query($sp);   
$sp="insert into catalogo.cod_rel
(ean, cod_rel1, cod_rel2, descripcion1, descripcion2, lin, slin, pub1, far1, cos1, pub2, far2, cos2, nivel, iva)
(select ean, cod_rel,0, descripcion,' ', lin, slin, pub, far, cos, 0, 0, 0, 0, iva from subir10.cod_rel1)
on duplicate key update 
descripcion1=values(descripcion1), pub1=values(pub1),far1=values(far1),cos1=values(cos1), iva=values(iva), cod_rel1=values(cod_rel1)
,lin=values(lin),slin=values(slin)";
$this->db->query($sp);
$fec=date('dmY');
$fectime=date('Y-m-d H:i:s');
$ss0="update catalogo.cat_mercadotecnia a set ofe_saba=0,fin_saba=0,ofe_nadro=0, fin_nadro=0, ofe_fanasa=0, fin_fanasa=0,rel1=0,rel2=0,ofe_marzam=0,fin_marzam=0";
$this->db->query($ss0);
$ss0="update catalogo.cat_mercadotecnia a, catalogo.cod_rel b  set a.rel1=cod_rel1, a.rel2=cod_rel2,a.lin=b.lin,a.sublin=b.slin where a.codigo=b.ean";
$this->db->query($ss0);
}
function procesar_cat()
{
/////////////////////////**
$fectime=date('Y-m-d H:i:s');
$se="update catalogo.cat_sabap a, subir10.p_cat_saba b
set a.oferta=b.oferta,
a.costo=round((a.farmacia-(a.farmacia*(b.financiero/100)))-((a.farmacia-(a.farmacia*(b.financiero/100)))*(b.oferta/100)),2)
where a.codigo=b.codigo";
$this->db->query($se);
$sc="update catalogo.cat_fanasa a, subir10.p_cat_fanasa b set 
a.oferta=b.oferta,a.financiero=b.financiero,a.farmacia=b.farmacia,a.producto=b.producto where a.codigo=b.codigo";
$this->db->query($sc);
$scc="insert into catalogo.cat_marzam(codigo, descripcion, costo, nivel_existencia, publico,
fecha_alta, fecha_modificado, oferta, antibiotico, farmacia, lab, financiero, 
iva, producto, rel1, rel2,ieps)
(select codigo, descripcion, 0, 0, pub,
date(now()), date(now()), 0, case when antibiotico='0' then ' ' else 'A' end, farmacia, lab, financiero, 
iva, ' ',0, 0,ieps from subir10.p_cat_marzam)
on duplicate key update publico=values(publico), iva=values(iva), lab=values(lab), farmacia=values(farmacia),
financiero=values(financiero),fecha_modificado=values(fecha_modificado),ieps=values(ieps)";
$this->db->query($scc);
$scc="insert into catalogo.cat_marzam(codigo, descripcion, costo, nivel_existencia, publico,
fecha_alta, fecha_modificado, oferta, antibiotico, farmacia, lab, financiero, 
iva, producto, rel1, rel2,ieps)
(select codigo, descripcion, 0, 0, pub,
date(now()), date(now()), oferta, case when antibiotico='0' then ' ' else 'A' end, farmacia, lab, financiero, 
iva, ' ', 0, 0,ieps from subir10.p_cat_marzam_1)
on duplicate key update publico=values(publico), iva=values(iva), lab=values(lab), farmacia=values(farmacia),
oferta=values(oferta),fecha_modificado=values(fecha_modificado)";
$this->db->query($scc);
$sc="update catalogo.cat_fanasa a set costo=round( 
(case
when a.financiero>0 and a.oferta>0 
then ((a.farmacia-((a.financiero/100)*a.farmacia))-((a.oferta/100)*(a.farmacia-((a.financiero/100)*a.farmacia))))
when a.financiero>0 and a.oferta=0 then (a.farmacia-((a.financiero/100)*a.farmacia))
when a.financiero=0 and a.oferta>0 then (a.farmacia-((a.oferta/100)*a.farmacia))
when a.financiero=0 and a.oferta=0 then  a.farmacia
else a.farmacia end),2) where a.costo=0";
$this->db->query($sc);

$sc="update catalogo.cat_marzam a set costo=round( 
(case
when a.financiero>0 and a.oferta>0 
then ((a.farmacia-((a.financiero/100)*a.farmacia))-((a.oferta/100)*(a.farmacia-((a.financiero/100)*a.farmacia))))
when a.financiero>0 and a.oferta=0 then (a.farmacia-((a.financiero/100)*a.farmacia))
when a.financiero=0 and a.oferta>0 then (a.farmacia-((a.oferta/100)*a.farmacia))
when a.financiero=0 and a.oferta=0 then  a.farmacia
else a.farmacia end),2)";
$this->db->query($sc);
$s="update  catalogo.cat_sabap a, catalogo.cod_rel b
set a.rel1=b.cod_rel1,a.rel2=b.cod_rel2 where a.codigo=b.ean";
$this->db->query($s);
$s="update  catalogo.cat_marzam a, catalogo.cod_rel b
set a.rel1=b.cod_rel1,a.rel2=b.cod_rel2 where a.codigo=b.ean";
$this->db->query($s);
$s="update  catalogo.cat_nadro a, catalogo.cod_rel b
set a.rel1=b.cod_rel1,a.rel2=b.cod_rel2 where a.codigo=b.ean";
$this->db->query($s);
$s="update  catalogo.cat_fanasa a, catalogo.cod_rel b
set a.rel1=b.cod_rel1,a.rel2=b.cod_rel2 where a.codigo=b.ean";
$this->db->query($s);
$s="update  catalogo.cat_marzam a, catalogo.cod_rel b
set a.rel1=b.cod_rel1,a.rel2=b.cod_rel2 where a.codigo=b.ean";
$this->db->query($s);
$ss3="update catalogo.cat_mercadotecnia a, catalogo.cat_nadro b
set 
a.cos_nadro=b.costo,a.antibiotico=case when b.antibiotico='A' then 1 else 0 end,ofe_nadro=0,fin_nadro=0,
fecha_archivo=date(now()),
a.far_nad=b.costo, a.pub_nad=b.publico
where a.rel1=b.rel1 and a.rel2=b.rel2  and b.rel1>0 or 
a.rel1=b.rel1 and a.rel2=b.rel2  and b.rel2>0";
$this->db->query($ss3);

$ss4="update catalogo.cat_mercadotecnia a, catalogo.cat_sabap b
set a.iva=case when a.iva=0 then 0 else ((b.iva)/100) end,a.cos_saba=b.costo,
a.labprv=b.lab,ofe_saba=oferta,fin_saba=financiero,
fecha_archivo=date(now()),
a.far_sab=b.farmacia,
a.pub_sab=b.publico
where a.rel1=b.rel1 and a.rel2=b.rel2 and b.rel1>0
or a.rel1=b.rel1 and a.rel2=b.rel2 and b.rel2>0";
$this->db->query($ss4);

$ss2="update catalogo.cat_mercadotecnia a, catalogo.cat_fanasa b
set a.iva=case when a.iva=0 then 0 else ((b.iva)/100) end,
a.cos_fanasa=b.costo,a.labprv=b.lab,ofe_fanasa=oferta,fin_fanasa=financiero,
fecha_archivo=date(now()),
a.pub_fan=b.publico, a.far_fan=b.farmacia
where a.rel1=b.rel1 and a.rel2=b.rel2 and b.rel1>0
or a.rel1=b.rel1 and a.rel2=b.rel2 and b.rel2>0";
$this->db->query($ss2); 
$ss2="update catalogo.cat_mercadotecnia a, catalogo.cat_marzam b
set
a.cos_marzam=b.costo,a.labprv=b.lab,ofe_marzam=oferta,fin_marzam=financiero,
fecha_archivo=date(now()),
a.pub_mar=b.publico, a.far_fan=b.farmacia,a.ieps=b.ieps,
a.antibiotico=case when b.antibiotico='A' then 1 else 0 end
where a.rel1=b.rel1 and a.rel2=b.rel2 and b.rel1>0
or a.rel1=b.rel1 and a.rel2=b.rel2 and b.rel2>0";
$this->db->query($ss2); 

$sff="update catalogo.cat_mercadotecnia
set
farmacia=(case
when far_mar>=far_nad and far_mar>=far_fan and far_mar>=far_sab then far_mar
when far_nad>=far_mar and far_nad>=far_fan and far_nad>=far_sab then far_nad
when far_fan>=far_mar and far_fan>=far_nad and far_fan>=far_sab then far_fan
when far_sab>=far_mar and far_sab>=far_nad and far_sab>=far_fan then far_sab else 0 end),
pub=(case
when pub_mar>=pub_nad and pub_mar>=pub_fan and pub_mar>=pub_sab then pub_mar
when pub_nad>=pub_mar and pub_nad>=pub_fan and pub_nad>=pub_sab then pub_nad
when pub_fan>=pub_mar and pub_fan>=pub_nad and pub_fan>=pub_sab then pub_fan
when pub_sab>=pub_mar and pub_sab>=pub_nad and pub_sab>=pub_fan then pub_sab else 0 end)

where

case
when far_mar>=far_nad and far_mar>=far_fan and far_mar>=far_sab then far_mar
when far_nad>=far_mar and far_nad>=far_fan and far_nad>=far_sab then far_nad
when far_fan>=far_mar and far_fan>=far_nad and far_fan>=far_sab then far_fan
when far_sab>=far_mar and far_sab>=far_nad and far_sab>=far_fan then far_sab else 0 end>0
and

(case
when pub_mar>=pub_nad and pub_mar>=pub_fan and pub_mar>=pub_sab then pub_mar
when pub_nad>=pub_mar and pub_nad>=pub_fan and pub_nad>=pub_sab then pub_nad
when pub_fan>=pub_mar and pub_fan>=pub_nad and pub_fan>=pub_sab then pub_fan
when pub_sab>=pub_mar and pub_sab>=pub_nad and pub_sab>=pub_fan then pub_sab else 0 end)>0
";
$this->db->query($sff);

$ss5="update catalogo.cat_mercadotecnia
set cos=round(case
when cos_saba>0 and cos_saba>=cos_nadro and cos_saba>=cos_fanasa and cos_saba>=cos_marzam
then cos_saba
when cos_nadro>0 and cos_nadro>=cos_saba and cos_nadro>=cos_fanasa and cos_nadro>=cos_marzam
then cos_nadro
when cos_fanasa>0 and cos_fanasa>=cos_saba and cos_fanasa>=cos_nadro and cos_fanasa>=cos_marzam
then cos_fanasa
when cos_marzam>0 and cos_marzam>=cos_saba and cos_marzam>=cos_nadro and cos_marzam>=cos_fanasa
then cos_marzam
else ult_costo end,2),

ult_costo=round(case
when cos_saba>0 and cos_nadro>0 and cos_fanasa>0 and cos_marzam>0
then ((cos_saba-(cos_saba*.04))+cos_nadro+(cos_fanasa-(cos_fanasa*.03))+(cos_marzam-(cos_marzam*.04)))/4

when cos_saba=0 and cos_nadro>0 and cos_fanasa>0 and cos_marzam>0
then (cos_nadro+(cos_fanasa-(cos_fanasa*.03))+(cos_marzam-(cos_marzam*.04)))/3
when cos_saba>0 and cos_nadro=0 and cos_fanasa>0 and cos_marzam>0
then ((cos_saba-(cos_saba*.04))+(cos_fanasa-(cos_fanasa*.03))+(cos_marzam-(cos_marzam*.04)))/3
when cos_saba>0 and cos_nadro>0 and cos_fanasa=0 and cos_marzam>0
then ((cos_saba-(cos_saba*.04))+cos_nadro+(cos_marzam-(cos_marzam*.04)))/3
when cos_saba>0 and cos_nadro>0 and cos_fanasa>0 and cos_marzam=0
then ((cos_saba-(cos_saba*.04))+cos_nadro+(cos_fanasa-(cos_fanasa*.03)))/3

when cos_saba=0 and cos_nadro=0 and cos_fanasa>0  and cos_marzam>0
then ((cos_fanasa-(cos_fanasa*.03))+(cos_marzam-(cos_marzam*.04)))/2
when cos_saba>0 and cos_nadro=0 and cos_fanasa=0  and cos_marzam>0
then ((cos_saba-(cos_saba*.04))+(cos_marzam-(cos_marzam*.04)))/2
when cos_saba>0 and cos_nadro>0 and cos_fanasa=0  and cos_marzam=0
then ((cos_saba-(cos_saba*.04))+cos_nadro)/2
when cos_saba=0 and cos_nadro>0 and cos_fanasa>0  and cos_marzam=0
then ((cos_fanasa-(cos_fanasa*.03))+cos_nadro)/2
when cos_saba>0 and cos_nadro=0 and cos_fanasa>0  and cos_marzam=0
then ((cos_saba-(cos_saba*.04))+(cos_fanasa-(cos_fanasa*.03)))/2
when cos_saba=0 and cos_nadro>0 and cos_fanasa=0  and cos_marzam>0
then (cos_nadro+(cos_marzam-(cos_marzam*.04)))/2


when cos_saba>0 and cos_nadro=0 and cos_fanasa=0 and cos_marzam=0
then (cos_saba-(cos_saba*.04))
when cos_saba=0 and cos_nadro>0 and cos_fanasa=0 and cos_marzam=0
then cos_nadro
when cos_saba=0 and cos_nadro=0 and cos_fanasa>0 and cos_marzam=0
then (cos_fanasa-(cos_fanasa*.03))
when cos_saba=0 and cos_nadro=0 and cos_fanasa=0 and cos_marzam>0
then (cos_marzam-(cos_marzam*.04))
else farmacia end,2)
";
$this->db->query($ss5);
$ss5="UPDATE CATALOGO.CAT_MERCADOTECNIA a
SET PRODUCTO=case
when ((fin_saba=18 and fin_fanasa=18)||(fin_saba=18))then 'NOR'
when ((fin_fanasa>0 and fin_fanasa<>18)||(fin_saba>0 AND fin_saba<>18)) then'LIM'
when ((fin_fanasa>0 and fin_fanasa<>18 and fin_saba=0)||(fin_saba>0 AND fin_saba<>18 and fin_fanasa=0)||(fin_fanasa<>0)) then'LIM'
when ( fin_saba=0 and fin_fanasa=0 and fin_nadro=0) then 'NET'
else ' ' end,
farmacia=case when rel1=2495 then far_nad else farmacia end,
pub=case when rel1=2495 then pub_nad else pub end
 WHERE lin=1 and sublin not in(3,4,5) or lin<>1";
$this->db->query($ss5);

$fectime2=date('Y-m-d H:i:s');
echo 'INICIO:'.$fectime.'<br />FINALIZA '.$fectime2.'<br /><strong>YA SE GENERO EL PROCESO DE CATALOGOS</strong>';
}
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
function __envio_precios_cat()
{
$s="select codigo,descripcion,farmacia,publico,financiero,
(select case when lin in(2,5,9,10) then 16 else 0 end  from catalogo.cat_mercadotecnia x where x.codigo=a.codigo)as iva
,lab,1
from catalogo.cat_fanasa a
where codigo>0 and descripcion not like '%TELCEL%' AND 
(select case when lin in(2,5,9,10) then 16 else 0 end  from catalogo.cat_mercadotecnia x where x.codigo=a.codigo) is not null
and publico>0 
";
$q=$this->db->query($s);
$File1 = "./txt/catalogo.txt";
$Handle1 = fopen($File1, 'w');
foreach($q->result() as $r)
{
    $des=substr($r->descripcion,0,30);
    $lab=substr($r->lab,0,30);
 $Data1=
         
        str_pad($r->codigo,13," ",STR_PAD_RIGHT)
        .str_pad($des,30," ",STR_PAD_RIGHT)
        .str_pad(number_format($r->publico,4),11," ",STR_PAD_LEFT)
        .str_pad(number_format($r->farmacia,4),10," ",STR_PAD_LEFT)
        .str_pad(number_format($r->financiero,2),10," ",STR_PAD_LEFT)
        .str_pad(number_format($r->iva,2),10," ",STR_PAD_LEFT)
        .str_pad($lab,30," ",STR_PAD_RIGHT)
        .str_pad('0',8," ",STR_PAD_LEFT)
        
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle1, $Data1);
    
}
fwrite($Handle1, $Data1);
fclose($Handle1);    
$s="select '00'as ceros,codigo,descripcion,farmacia,oferta,1 as uno,0 as cer, financiero,publico from catalogo.cat_fanasa
where codigo>0 and oferta>0
";
$q=$this->db->query($s);
$File2 = "./txt/ofertas.txt";
$Handle2 = fopen($File2, 'w');
foreach($q->result() as $r)
{
    $des=substr($r->descripcion,0,30);
    
 $Data2=
         str_pad($r->ceros,12," ",STR_PAD_RIGHT)
        .str_pad($r->codigo,13," ",STR_PAD_RIGHT)
        .str_pad($des,30," ",STR_PAD_RIGHT)
        .str_pad(number_format($r->farmacia,2),9," ",STR_PAD_LEFT)
        .str_pad(number_format($r->oferta,2),6," ",STR_PAD_LEFT)
        .str_pad($r->uno,7," ",STR_PAD_LEFT)
        .str_pad($r->cer,7," ",STR_PAD_LEFT)
        .str_pad($r->cer,7," ",STR_PAD_LEFT)
        .str_pad(number_format($r->financiero,2),6," ",STR_PAD_LEFT)
        .str_pad(number_format($r->publico,2),9," ",STR_PAD_LEFT)
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle2, $Data2);
    
}
fwrite($Handle2, $Data2);
fclose($Handle2);    
////////////////////////////enlace
$servidor_ftp    = "fenixcentral01.homeip.net";
$ftp_nombre_usuario = "Fanasa";
$ftp_contrasenya = "F@naxam3d";

$archivo1 = './txt/catalogo.txt';
$da1 = fopen($archivo1, 'r');
$archivo_remoto1 = 'catalogo.txt';

$archivo2 = './txt/ofertas.txt';
$da2 = fopen($archivo2, 'r');
$archivo_remoto2 = 'ofertas.txt';


$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto1, $archivo1, FTP_ASCII)){$mensaje=1;} else {$mensaje=2;}
if (ftp_put($id_con, $archivo_remoto2, $archivo2, FTP_ASCII)){$mensaje=1;} else {$mensaje=2;}
ftp_close($id_con);
fclose($da1);
fclose($da2);  
}    

/////////////////////////////////////////////////////////////////////inventario

  function enlace_inventario($ftp,$usua,$contra,$archivo)
{
ini_set('memory_limit','5000M');
set_time_limit(0);
$this->load->library('ftp');
$fec=date('dmY');
$fectime=date('Y-m-d H:i:s');
$config1['hostname'] =$ftp;
$config1['username'] =$usua;
$config1['password'] =$contra;
$config1['debug']    = TRUE;
$this->ftp->connect($config1);
$this->ftp->download('lidia/invctl'.$archivo.'.txt', './transfer/invctl'.$archivo.$fec.'.txt');
$this->ftp->download('lidia/invdet'.$archivo.'.txt', './transfer/invdet'.$archivo.$fec.'.txt');
$this->___inventario($fec,$archivo);
$fectime2=date('Y-m-d H:i:s');
echo 'INICIO:'.$fectime.'<BR />FINALIZA '.$fectime2.'<BR /><strong>YA SE GENERO EL PROCESO DE INVENTARIO DE PHARMACY'.$archivo.'</strong>'; 

}
function ___inventario($fec,$archivo)
{
 ini_set('memory_limit','5000M');
set_time_limit(0);   
$fectime=date('Y-m-d H:i:s');
$sr="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/invctl".$archivo.$fec.".txt' 
replace into table oficinas.inv_ctl_bak FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
$this->db->query($sr);  
$sr="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/invdet".$archivo.$fec.".txt' 
replace into table oficinas.inv_det_bak FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
$this->db->query($sr);    
$s="select *from oficinas.inv_ctl_bak where sem=WEEKOFYEAR(date(now())) and day(fecha)= day(now())";
$q=$this->db->query($s);
foreach($q->result() as $r)
{
$d="delete from desarrollo.inv where suc=$r->suc";
$this->db->query($d);    
$ad="insert into desarrollo.inv(tsuc, suc, mov, codigo, cantidad, fechai,sec)
(select 'F',suc,3,codigo,piezas,fecha,0 from oficinas.inv_det_bak where fecha=date(now()) and suc=$r->suc)";
$this->db->query($ad); 
}
}



public function genera_inv($aaa,$mes,$dia,$sem)
{
$x1="delete from oficinas.inv_mes_suc_det";$this->db->query($x1);
$x="delete from oficinas.inv_mes_suc";$this->db->query($x);
$x2="delete from oficinas.inv_seguros";$this->db->query($x2);

$s="insert ignore into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(SELECT $aaa,$mes, b.cia,a.suc,a.sec,' ',a.codigo,' ',a.cantidad,
0,0,'FARMACIA',$dia
FROM desarrollo.inv a
left join catalogo.sucursal b on b.suc=a.suc
where a.mov=03 and a.cantidad>0 and a.suc>100 and tlid=1 and fecha_act='0000-00-00')";
$this->db->query($s);

$s="update metro.inventario_d a, catalogo.cat_mercadotecnia b
set a.costo=b.cos
 where a.codigo=b.codigo and a.codigo>0 and costo=0";
$this->db->query($s);

$s="update catalogo.cat_nuevo_general_cla b, metro.inventario_d a
set a.costo=b.cos
where a.sec_nueva=b.sec  and a.sec_nueva>0 and a.costo=0";
$this->db->query($s);

$s="update oficinas.inv_mes_suc_det a, catalogo.cat_mercadotecnia b
set a.costo=b.cos,a.lin=b.lin
where a.codigo=b.codigo and a.aaa=$aaa and a.mes=$mes";
$this->db->query($s); 
  

$s="insert ignore into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(SELECT $aaa,$mes, x.cia,a.suc,a.sec,' ',a.codigo,b.susa1,a.cantidad,
case when x.cia=13 then round((b.costo*1.20),2)else round((b.costo*1.20),2) end,b.lin,'FARMACIA',$dia
FROM desarrollo.inv a
left join catalogo.sucursal x on x.suc=a.suc
left join catalogo.almacen b on b.sec=a.sec
where 
 tsuc<>'F' and a.mov=07 and a.cantidad>0 and a.suc<1600  and x.tlid=1  and fecha_act='0000-00-00' or
 tsuc<>'F' and a.mov=07 and a.cantidad>0 and x.tlid=1  and fecha_act='0000-00-00' and a.suc>=2000  and a.suc<=2899) ";
$this->db->query($s);
$s="insert ignore into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(SELECT $aaa,$mes, x.cia,a.suc,a.sec,' ',a.codigo,b.susa1,a.cantidad,
case when x.cia=13 then round((b.costo*1.10),2)else round((b.costo*1.10),2) end,b.lin,'FARMACIA',$dia
FROM desarrollo.inv a
left join catalogo.sucursal x on x.suc=a.suc
left join catalogo.almacen b on b.clabo=a.sec
where a.tsuc<>'F' and a.mov=07 and a.cantidad>0 and a.suc in(1601,1602,1603,1604) and x.tlid=1)";
$this->db->query($s);
$s="update desarrollo.inv_cedis a, catalogo.almacen b
set a.costo=b.costo
where a.inv1>0 and a.costo=0 and a.sec=b.sec and b.tsec='G'";
$this->db->query($s);
$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,13,900,aa.sec,' ',aa.codigo,ifnull(bb.susa1,' '),sum(inv1),aa.costo,ifnull(bb.lin,0),'ALM CEDIS',$dia
from desarrollo.inv_cedis aa left join catalogo.sec_generica bb on bb.sec=aa.sec where aa.inv1>0 group by aa.sec)
";
$this->db->query($s);

$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,1,100,0,aa.clave,aa.codigo,ifnull((select substr(susa1,1,100) from catalogo.almacen bb where bb.sec=aa.clave group by bb.sec),''),sum(cantidad),aa.costo,1,'ALM METRO',$dia
from metro.inventario_d aa left join catalogo.almacen bb on bb.sec=aa.clave where aa.cantidad>0 group by aa.clave)";
$this->db->query($s);

$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,13,1600 ,aa.clave,' ',aa.codigo,ifnull(bb.susa1,' '),sum(cantidad),ifnull(bb.costo,0),ifnull(bb.lin,0),'ALM FARMABODEGA',$dia
from farmabodega.inventario_d aa left join catalogo.almacen bb on bb.clabo=aa.clave where aa.cantidad>0 group by aa.clave)
";
$this->db->query($s);
$s="insert into oficinas.inv_seguros(aaa, mes, dia, suc, clave, descripcion, piezas, costo, lin, piezas_paquete, clave_sin_punto)
(select $aaa,$mes,$dia,90002,clave,'',sum(cantidad), 0,1,sum(cantidad),clave from segpop.inventario_d  where cantidad>0 group by clave)
";
$this->db->query($s);
//$s="insert into oficinas.inv_seguros(aaa, mes, dia, suc, clave, descripcion, piezas, costo, lin, piezas_paquete, clave_sin_punto)
//(select $aaa,$mes,$dia,6050,clave,' ',sum(cantidad/(case when contable_div >0 then contable_div else 1 end)),
//costo,5,sum(cantidad/(case when contable_div >0 then contable_div else 1 end)),clave
//from trasimeno140.inventario_d where cantidad>0 group by clave)
//";
//$this->db->query($s);
  
$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(select $aaa,$mes,1,100,0,aa.clave,aa.codigo,ifnull(trim(susa),' '),sum(invf)as invf,aa.costo,1,'ALM CONTROLADOS',$dia
from almacen.control_invd aa
left join catalogo.cat_con bb on bb.clave=aa.clave
where aa.invf>0  group by aa.clave)";
$this->db->query($s);

//////////////seguros populares
$ss="insert into oficinas.inv_seguros (aaa, mes, dia, suc, clave, descripcion, piezas, costo, lin, piezas_paquete, clave_sin_punto)
(select $aaa,$mes,$dia,suc,clave,descri,sum(cantidad),costo,lin,
SUM(case when div_conta>0 then cantidad/div_conta else cantidad end),clave 
from oficinas.inv_seguros_lote group by suc,clave)";
$this->db->query($ss);
$s="update oficinas.inv_seguros a,catalogo.segpop b set a.costo=b.costo where a.clave=b.claves and a.costo=0";
$this->db->query($s);
$s="update oficinas.inv_seguros a,catalogo.cat_mercadotecnia b set a.costo=b.cos where a.clave=b.clave and a.costo=0";
$this->db->query($s);

$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo,dia)
(select aaa, mes, 1, suc,0, clave_sin_punto,0, substr(descripcion,1,70), piezas_paquete, costo, lin, 'ALM SEGPOP',$dia 
from oficinas.inv_seguros a where a.aaa=$aaa and a.mes=$mes and suc in(16000,6050,90002) and piezas_paquete>0)";
$this->db->query($s);
$s="
insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo, dia)
(
SELECT $aaa,$mes,1,14000,0,c.clave,0,substring(b.descripcion,0,70),ifnull(sum(inv),0),
ifnull((costo/div_agu),0), ifnull((case when tipo_producto=2 then 5 else 1 end),0),
'ALM AGUASCALIENTES',$dia
 FROM aguascalientes.inventario a
left join aguascalientes.productos b on b.id=a.p_id
left join oficinas.convertir_claves c on c.clave_punto=b.clave
left join catalogo.costos_gobierno d on d.clave=c.clave
where inv>0 and c.clave is not null
group by c.clave
)
";
$this->db->query($s);
$s="
insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo, dia)
(SELECT $aaa,$mes,1,19000,0,c.clave,0,substring(b.descripcion,0,70),ifnull(sum(inv),0),
ifnull((d.costo/div_agu),0), ifnull((case when tipo_producto=2 then 5 else 1 end),0),
'ALM OAXACA',$dia
 FROM oaxaca.inventario a
left join oaxaca.productos b on b.id=a.p_id
left join oficinas.convertir_claves c on c.clave_punto=b.clave
left join catalogo.costos_gobierno d on d.clave=c.clave
where inv>0 and c.clave is not null
group by c.clave
)";
$this->db->query($s);

$s="
insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo, dia)
(SELECT $aaa,$mes,1,16000,0,c.clave,0,substring(b.descripcion,0,70),ifnull(sum(inv),0),
ifnull((d.costo/div_agu),0), ifnull((case when tipo_producto=2 then 5 else 1 end),0),
'ALM CHETUMAL',$dia
 FROM chetumal.inventario a
left join chetumal.productos b on b.id=a.p_id
left join oficinas.convertir_claves c on c.clave_punto=b.clave
left join catalogo.costos_gobierno d on d.clave=c.clave
where inv>0 and c.clave is not null
group by c.clave
)";
$this->db->query($s);

$s="
insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo, dia)
(SELECT $aaa,$mes,1,12000,0,c.clave,0,substring(b.descripcion,0,70),ifnull(sum(inv),0),
ifnull((d.costo/div_agu),0), ifnull((case when tipo_producto=2 then 5 else 1 end),0),
'ALM NICHOACAN',$dia
 FROM michoacan.inventario a
left join michoacan.productos b on b.id=a.p_id
left join oficinas.convertir_claves c on c.clave_punto=b.clave
left join catalogo.costos_gobierno d on d.clave=c.clave
where inv>0 and c.clave is not null
group by c.clave
)";
$this->db->query($s);
 
$s="insert into oficinas.inv_mes_suc(aaa, mes, cia, suc, piezas, importe,dia,sem,tsuc)
(select a.aaa,a.mes,a.cia,a.suc,sum(a.piezas),sum(a.piezas*a.costo),a.dia,$sem,b.tipo2 
from oficinas.inv_mes_suc_det a
left join catalogo.sucursal b on b.suc=a.suc
where  aaa=$aaa and mes=$mes group by a.aaa,a.mes,a.suc)";
$this->db->query($s);

}
public function respalda_inv($aaa,$mes,$dia,$sem)
{
ini_set('memory_limit','20000M');
set_time_limit(0);    
$s="insert ignore into desarrollo.inv_cosvta(cia, suc, sem, aaaa, mes, lin, plaza, succ, importe,piezas)
(select case when a.cia=0 then b.cia else a.cia end,a.suc,$sem,aaa,mes,lin,b.plaza,b.suc_contable,
 sum(piezas*costo), sum(piezas)
from oficinas.inv_mes_suc_det a
left join catalogo.sucursal b on b.suc=a.suc
where 
a.costo>0 and a.aaa=$aaa and a.mes=$mes and a.dia=$dia and a.suc>=100 and b.tlid=1 and b.tipo1='A' or 
a.costo>0 and a.aaa=$aaa and a.mes=$mes and a.dia=$dia and a.suc in(1,2,100,12000,900,14000,16000,19000,1600)
group by a.aaa,a.mes,a.dia,a.suc,a.lin
)";
$this->db->query($s);
$s1="insert into oficinas.inv_mes_suc_his(aaa, mes, cia, suc, piezas, importe, dia,sem,tsuc)
(select a.aaa, a.mes, a.cia, a.suc, a.piezas, a.importe, a.dia,a.sem,a.tsuc 
from oficinas.inv_mes_suc a  where a.aaa=$aaa and a.mes=$mes and a.dia=$dia)";
$this->db->query($s1);
$s="insert into oficinas.inv_mes_suc_det_sem
(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo, dia,sem)
(select aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo, dia,$sem 
from  oficinas.inv_mes_suc_det where aaa=$aaa and mes=$mes and dia=$dia)";
$this->db->query($s);


}



function envio_banxico($fec,$lis,$rel)
{

 /////////////////////////////////////////////////////////////////////////////////////////////////////////////envia del server a backoffice
$s="SELECT concat($lis,'||',cod_rel$rel,'||','0','||','1','||',venta,'||',venta)as todo
FROM oficinas.cliente_banxico a
left join catalogo.cod_rel b on b.ean=a.codigo
where fecha_activo='$fec' and cod_rel$rel>0
group by cod_rel$rel";    
$q=$this->db->query($s);
$File = "./txt/ban$rel.prn";
$Handle = fopen($File, 'w');
foreach($q->result() as $r)
{
$Data=
        str_pad($r->todo,500," ",STR_PAD_RIGHT)
        ."\r\n";
    $importe=0;
    //echo $linea;
    fwrite($Handle, $Data);
    
}
fclose($Handle); 
$archivo="ban$rel.prn";
$fechatime=date('Y-m-d H:i:s');   
      
$servidor_ftp    = 'fenixcentral.homeip.net';
$ftp_nombre_usuario = 'administrador';
$ftp_contrasenya = 'PharmaF3n1x';

$archivo1 = "./txt/ban$rel.prn";
$da1 = fopen($archivo1, 'r');
$archivo_remoto1 = "lidia/ban$rel.prn";



$id_con = ftp_connect($servidor_ftp);
$resultado_login = ftp_login($id_con, $ftp_nombre_usuario, $ftp_contrasenya);


if (ftp_put($id_con, $archivo_remoto1, $archivo1, FTP_ASCII)){$mensaje=1;} else {$mensaje=2;}

ftp_close($id_con);
fclose($da1);

     $fechatime2=date('Y-m-d H:i:s');
     echo $fechatime.'<br />'.$fechatime2;





}





























function viejo_mayoristas()
{
 $fec=substr($fecha,2,2).substr($fecha,5,2).substr($fecha,8,2);
///////////////////////////////////////////////////////////////////////////////////MARZAM
if(file_exists('/home/central/backoffice/facmarzam.txt')){
$s1="LOAD DATA INFILE '/home/central/backoffice/facmarzam.txt'
replace INTO TABLE subir10.p_pre_factura_fenix LINES TERMINATED BY '\r\n' (@var1)
SET prv=SUBSTRING(@var1,3,4),
fecha=SUBSTRING(@var1,7,8),
suc=SUBSTRING(@var1,118,4),
fac=SUBSTRING(@var1,222,9),
cod=SUBSTRING(@var1,530,14),
can=SUBSTRING(@var1,450,6),
far=(SUBSTRING(@var1,467,8)/100),
descuento=(SUBSTRING(@var1,258,12)/100),
ieps=(SUBSTRING(@var1,294,12)/100),
iva=(SUBSTRING(@var1,282,12)/100),
importe=(SUBSTRING(@var1,246,12)/100),
fec_pedido=subdate((SUBSTRING(@var1,7,8)),1)";
$this->db->query($s1);
echo 'marzam/facmarzam.txt'.' Factura de MARZAM<br />';
}
//////////////////////////////////////////////////////////////////////////////FARMACOS
$fec=substr($fecha,8,2).substr($fecha,5,2).substr($fecha,0,4);
if(file_exists('/home/central/backoffice/facfanasa.txt')){
$s1="LOAD DATA INFILE '/home/central/backoffice/facfanasa.txt'
replace INTO TABLE subir10.p_pre_factura_fenix LINES TERMINATED BY '\r\n' (@var1)
SET prv=825,
fecha=SUBSTRING(@var1,25,8),
suc=ifnull((select suc from catalogo.cat_clientes_mayoris where num=trim(SUBSTRING(@var1,20,5)) and id_prv=4),0),
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
echo 'fanasa/facfanasa.txt'.' Factura de FARMACOS<br />';
}
///////////////////////////////////////////////////////////////////////////////NADRO
$fec=substr($fecha,0,4).substr($fecha,5,2).substr($fecha,8,2);
$fectime=date('Y-m-d H:i:s');
$ss="delete from subir10.p_factura_n";
$this->db->query($ss);
if(file_exists('/home/central/backoffice/facnadro.33')){
$s1="LOAD DATA INFILE '/home/central/backoffice/facnadro.33'
replace INTO TABLE subir10.p_factura_n LINES TERMINATED BY '\r\n'";
$this->db->query($s1);

$s1="SELECT
case when substring(todo,1,2)='C:' then  substring(todo,12,7) end suc,
case when substring(todo,1,1)='F' then  substring(todo,2,10) end fac,
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
$guarda="insert ignore subir10.p_pre_factura_fenix
(prv, fecha, suc, fac, cod, can, far, importe, iva, ieps, descuento, fec_pedido)
values(221,adddate($fecha,1),$suc,'$fac',$cod,$can,'$cos','$impor','$iva','$ieps',0,'$fecha')";
$this->db->query($guarda);
}}
echo 'nadro/FA'.$fec.'.33'.' Factura de NADRO<br />';
}
   
}






















































































////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////////////////////////////ventas    
////////////////////////////////////////////////////////////////////////////////////////////////////////movimientos
function __movimientos($fec)
{
$fectime=date('Y-m-d H:i:s');
$sr="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/mov01".$fec.".txt' 
replace into table oficinas.movimientos FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(fecha,suc, folio_ref, tipo, @movimiento, codigo, @descri, cantidad, costo)
set descri = CONVERT(CAST(@descri as BINARY) USING LATIN1),movimiento = CONVERT(CAST(@movimiento as BINARY) USING LATIN1)";
$this->db->query($sr);
$sr="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/mov1".$fec.".txt' 
replace into table oficinas.movimientos FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(fecha,suc, tipo,folio_ref, @movimiento, codigo, @descri, cantidad, costo)
set descri = CONVERT(CAST(@descri as BINARY) USING LATIN1),movimiento = CONVERT(CAST(@movimiento as BINARY) USING LATIN1)";
$this->db->query($sr);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////movimientos
////////////////////////////////////////////////////////////////////////////////////////////////////////////compras
function __compras($fec)
{
$fectime=date('Y-m-d H:i:s');
$sr="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/comprad01".$fec.".txt'
replace into table vtadc.gc_compra_det FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
$this->db->query($sr);
$sr="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/comp1".$fec.".txt'
replace into table vtadc.gc_compra_det FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(aaa, mes, suc, fecha, factura, codigo, can, costo, iva, impo, imp_fac, prv)";
$this->db->query($sr);

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////facturas central

function recupera_factura_central($fecha)
{

ini_set('memory_limit','9000M');
set_time_limit(0);
$ss="delete from subir10.p_pre_factura_fenix";
$this->db->query($ss);
$ss="delete from subir10.p_pre_factura_fenix";
$this->db->query($ss);
$this->load->library('ftp');
$fectime=date('Y-m-d H:i:s');
$config1['hostname'] ='fenixcentral.homeip.net';
$config1['username'] ='administrador';
$config1['password'] ='PharmaF3n1x';
$config1['debug']    = FALSE;
$this->ftp->connect($config1);
///////////////////////////////////////////////////////////////////////////////////MARZAM
$fec=substr($fecha,2,2).substr($fecha,5,2).substr($fecha,8,2);
$am1=$this->ftp->download('marzam/fac'.$fec.'.txt', './transfer/fac'.$fec.'.txt');

$fec2=substr($fecha,8,2).substr($fecha,5,2).substr($fecha,0,4);
//$am2=$this->ftp->download('fanasa/FACTURA'.$fec2.'.txt','./transfer/FANASA'.$fec2.'.txt');
$am2=$this->ftp->download('fanasa/FACTURA.txt','./transfer/FANASA'.$fec2.'.txt');
die();
$fec3=date('Ymd');
$this->ftp->download('nadro/FA'.$fec3.'.33', './transfer/FA'.$fec3.'.33');

if(file_exists("c:/wamp/www/oficinas/transfer/fac".$fec.".txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/fac'.$fec.'.txt','facmarzam.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/FANASA".$fec2.".txt")){$this->transferFile('c:/wamp/www/oficinas/transfer/FANASA'.$fec2.'.txt','facfanasa.txt');}
if(file_exists("c:/wamp/www/oficinas/transfer/FA".$fec3.".33")){$this->transferFile('c:/wamp/www/oficinas/transfer/FA'.$fec3.'.33','facnadro.33');}

if(file_exists('/home/central/facmarzam.txt')){
$s1="LOAD DATA INFILE '/home/central/facmarzam.txt'
replace INTO TABLE subir10.p_pre_factura_fenix LINES TERMINATED BY '\r\n' (@var1)
SET prv=SUBSTRING(@var1,3,4),
fecha=SUBSTRING(@var1,7,8),
suc=SUBSTRING(@var1,118,4),
fac=SUBSTRING(@var1,222,9),
cod=SUBSTRING(@var1,530,14),
can=SUBSTRING(@var1,450,6),
far=(SUBSTRING(@var1,467,8)/100),
descuento=(SUBSTRING(@var1,258,12)/100),
ieps=(SUBSTRING(@var1,294,12)/100),
iva=(SUBSTRING(@var1,282,12)/100),
importe=(SUBSTRING(@var1,246,12)/100),
fec_pedido=subdate((SUBSTRING(@var1,7,8)),1)";
$this->db->query($s1);
echo 'marzam/facmarzam.txt'.' Factura de MARZAM<br />';
}
//////////////////////////////////////////////////////////////////////////////FARMACOS

$s1="LOAD DATA INFILE '/home/central/facfanasa.txt'
replace INTO TABLE subir10.p_pre_factura_fenix LINES TERMINATED BY '\r\n' (@var1)
SET prv=825,
fecha=SUBSTRING(@var1,25,8),
suc=ifnull((select suc from catalogo.cat_clientes_mayoris where num=trim(SUBSTRING(@var1,20,5)) and id_prv=4),0),
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
echo 'fanasa/facfanasa.txt'.' Factura de FARMACOS<br />';

///////////////////////////////////////////////////////////////////////////////NADRO
$fec=substr($fecha,0,4).substr($fecha,5,2).substr($fecha,8,2);
$fectime=date('Y-m-d H:i:s');
$ss="delete from subir10.p_factura_n";
$this->db->query($ss);
if(file_exists('/home/central/facnadro.33')){
$s1="LOAD DATA INFILE '/home/central/facnadro.33'
replace INTO TABLE subir10.p_factura_n LINES TERMINATED BY '\r\n'";
$this->db->query($s1);

$s1="SELECT
case when substring(todo,1,2)='C:' then  substring(todo,12,7) end suc,
case when substring(todo,1,1)='F' then  substring(todo,2,10) end fac,
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
$guarda="insert ignore subir10.p_pre_factura_fenix
(prv, fecha, suc, fac, cod, can, far, importe, iva, ieps, descuento, fec_pedido)
values(221,adddate($fecha,1),$suc,'$fac',$cod,$can,'$cos','$impor','$iva','$ieps',0,'$fecha')";
$this->db->query($guarda);
}}
echo 'nadro/FA'.$fec.'.33'.' Factura de NADRO<br />';
}
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
}

  function enlace_facturas($ftp,$usua,$contra,$archivo)
{
ini_set('memory_limit','5000M');
set_time_limit(0);
$this->load->library('ftp');
$fec=date('dmY');
$fectime=date('Y-m-d H:i:s');
$config1['hostname'] =$ftp;
$config1['username'] =$usua;
$config1['password'] =$contra;
$config1['debug']    = TRUE;
$this->ftp->connect($config1);
$am=$this->ftp->download("lidia/comp$archivo.txt", "./transfer/comp$archivo.txt");
$sr="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/comp$archivo.txt'
replace into table vtadc.gc_compra_det FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(aaa, mes, suc, fecha, @factura, codigo, can, costo, iva, impo, imp_fac, prv,devuelta)
set factura=replace(convert(cast(@factura as binary) using latin1),' ','');";
$this->db->query($sr);
$fectime2=date('Y-m-d H:i:s');


echo 'INICIO:'.$fectime.'<br />FINALIZA '.$fectime2.'<br /><strong>YA SE GENERO EL ENLACE DE FACTURAS DE PHARMACY'.$archivo.'</strong>';
}

function procesa_factura_suc($aaa,$mes)
{
$fectime=date('Y-m-d H:i:s');
$sss="load data infile 'c:/wamp/www/subir10/factu.txt' replace into table vtadc.gc_compra_as400 FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
$this->db->query($sss);

$ss="update vtadc.gc_compra_as400 a, compras.pre_factura_fenix_ctl b
set b.imp_cxp=a.imp, b.suc=a.suc,fecven=fecha_ven,b.contra=a.cxp
where a.factura=b.fac and year(a.fecha)=$aaa and month(a.fecha)>=$mes"; 
$this->db->query($ss);

$s="insert into vtadc.gc_compra_ctl(aaa, mes, fecha, prv, suc, fac, imp_suc, imp_prv, imp_cxp, prv_cxp)
(select aaa,mes,fecha,prv,suc,factura,round(sum(case when iva=0 then can*costo else can*(costo*(1+(iva/100))) end),2),
0,0,0 FROM vtadc.gc_compra_det where aaa=$aaa and mes>=$mes and factura<>' ' group by aaa,mes,suc,factura,prv)
on duplicate key update imp_suc=values(imp_suc)";
$this->db->query($s);

$s2="update vtadc.gc_compra_ctl a, compras.pre_factura_fenix_ctl b
set b.suc=a.suc
where b.fac=a.fac and b.suc=0 and a.aaa=$aaa and a.mes>=$mes";
$this->db->query($s2);

$s="update almacen.control_comprac a, compras.pre_factura_fenix_ctl b
set b.imp_suc=(select sum(cans*costo) from almacen.control_comprad x where x.folio=a.folio group by  folio )

where a.factura=b.fac and a.prv in(500,825) and month(b.fecha)>=$mes and year(b.fecha)=$aaa;";
$this->db->query($s);

$s="update patente.entradas_c a ,compras.pre_factura_fenix_ctl b
set b.suc=100, imp_suc=monto
where a.referencia=b.fac and proveedor_id in(500,825)  and month(b.fecha)>=$mes and year(b.fecha)=$aaa;";
$this->db->query($s);

$s="update compras.pre_factura_fenix_ctl a,  vtadc.gc_compra_ctl b
set a.imp_suc=b.imp_suc, b.imp_prv=a.imp_prv
where a.suc=b.suc and a.fac=b.fac and a.suc>0 and month(a.fecha)>=$mes and year(a.fecha)=$aaa;";
$this->db->query($s);

$s1="insert into vtadc.gc_compra_ctl(aaa, mes, fecha, prv, suc, fac, imp_suc, imp_prv, imp_cxp, prv_cxp)
(SELECT year(fecha), month(fecha),fecha,0,suc,fac,0,sum(importe),0,prv 
FROM compras.pre_factura_fenix where suc>0 
and year(fecha)=$aaa and month(fecha)>=$mes
group by prv,fac)
on duplicate key update imp_prv=values(imp_prv),prv_cxp=values(prv_cxp)";
$this->db->query($s1);

$fe="update compras.pre_factura_fenix_ctl
set fec_calculada=
case
when DAYOFWEEK(adddate(fecha,35))=1 and prv in(825,400,221) then adddate(fecha,(35-2))
when DAYOFWEEK(adddate(fecha,35))=2 and prv in(825,400,221) then adddate(fecha,(35-3))
when DAYOFWEEK(adddate(fecha,35))=3 and prv in(825,400,221) then adddate(fecha,(35-4))
when DAYOFWEEK(adddate(fecha,35))=4 and prv in(825,400,221) then adddate(fecha,(35+2))
when DAYOFWEEK(adddate(fecha,35))=5 and prv in(825,400,221) then adddate(fecha,(35+1))
when DAYOFWEEK(adddate(fecha,35))=6 and prv in(825,400,221) then adddate(fecha,(35))
when DAYOFWEEK(adddate(fecha,35))=7 and prv in(825,400,221) then adddate(fecha,35-1)
when DAYOFWEEK(adddate(fecha,45))=1 and prv=500 then adddate(fecha,(45-2))
when DAYOFWEEK(adddate(fecha,45))=2 and prv=500 then adddate(fecha,(45-3))
when DAYOFWEEK(adddate(fecha,45))=3 and prv=500 then adddate(fecha,(45-4))
when DAYOFWEEK(adddate(fecha,45))=4 and prv=500 then adddate(fecha,(45+2))
when DAYOFWEEK(adddate(fecha,45))=5 and prv=500 then adddate(fecha,(45+1))
when DAYOFWEEK(adddate(fecha,45))=6 and prv=500 then adddate(fecha,(45))
when DAYOFWEEK(adddate(fecha,45))=7 and prv=500 then adddate(fecha,45-1)
else '0000-00-00' end
where fecven >'0000-00-00'
";
$this->db->query($fe);
$ss="select a.cod,c.descripcion,a.can,b.can,
case when a.can>=b.can then (a.can-b.can) else ((b.can-a.can)*-1) end as dif,
a.far,a.ieps,descuento,(a.iva/a.can) From  compras.pre_factura_fenix a
left join vtadc.gc_compra_det b on b.factura=a.fac and b.codigo=a.cod
left join catalogo.cat_mercadotecnia c on c.codigo=a.cod
where  a.fac='PM8522271' and a.can<>b.can";



$fectime2=date('Y-m-d H:i:s');
echo 'INICIO:'.$fectime.'<br />FINALIZA '.$fectime2.'<br /><strong>YA SE PROCESO LA CONCILIACION  DE FACTURAS</strong>';
}

function cortes_control($suc)
{
$this->__cortes_bat($suc,'\cor');

die();    
}

function __cortes_bat($suc,$archivo)
{
$ss="select suc,base_suc,servidor from catalogo.cat_replicas where suc=$suc";
$qq=$this->db->query($ss);
$rr=$qq->row();
$var1='@Echo off';
$var2='<strong>bcp "</strong>';
$cor4='<strong>" queryout C:\pharmacy\ArchivoInventarioActual\cor'.$rr->suc.'.txt -c  -U sa -P PharmaF3n1x</strong>';
$ven4='<strong>" queryout C:\pharmacy\ArchivoInventarioActual\ven'.$rr->suc.'.txt -c  -U sa -P PharmaF3n1x</strong>';
$mov4='<strong>" queryout C:\pharmacy\ArchivoInventarioActual\mov'.$rr->suc.'.txt -c  -U sa -P PharmaF3n1x</strong>';
$com4='<strong>" queryout C:\pharmacy\ArchivoInventarioActual\com'.$rr->suc.'.txt -c  -U sa -P PharmaF3n1x</strong>';
$inv4='<strong>" queryout C:\pharmacy\ArchivoInventarioActual\invdet'.$rr->suc.'.txt -c  -U sa -P PharmaF3n1x</strong>';
if($rr->servidor==1)
{$cor3= "select convert(varchar(10),fecha,20)+'||'+cast($rr->suc as varchar(4))+'||'+cast(caja as varchar(2))+'||'+cast(b.nombre as varchar(9))+'||'+rtrim(ltrim(b.nombrecompleto))+'||'+cast(formapago as varchar(2))+'||'+ cast((imptefisico+impteretiro)as varchar(11))+'||'+cast((impteteorico+impteretiro) as varchar(11))+'||'+folio from $rr->base_suc.dbo.CorteX a inner join $rr->base_suc.dbo.catusuarios b on b.codigo=a.cajero where fecha>=getdate()-30 and fecha< getdate()-1 and auditoria=0 and formapago <>3 and imptefisico>0 order by fecha,folio";
echo $var1.'<br />'.$var2.$cor3.$cor4;   
}else{
$cor3= "select convert(varchar(10),a.fechaVentaSinHora,20)+'||'+min(substring(b.descripcion,0,4))+'||'+cast(a.codigoCaja as varchar(2))+'||'+SUBSTRING(a.foliocorte,7,10)+'||'+cast(min(c.codigoExterno)as varchar(9))+'||'+min(c.nombreUsuario)+'||1||'+cast((select SUM(d.importefisico+importeRetiro) from $rr->base_suc.dbo.venCortesParcialesReg d where d.folioCorte=a.folioCorte  and codigoFormaPago=1                and auditoria=0 group by folioCorte) as varchar(12))+'||'+cast((select SUM(d.importefisico+d.importeRetiro-x.importeDiferencia) from $rr->base_suc.dbo.venCortesParcialesReg d inner join $rr->base_suc.dbo.venCortesBitacoraDiferenciasReg x on x.folioCorte=d.folioCorte where d.folioCorte=a.folioCorte  and codigoFormaPago=1 and auditoria=0)as varchar(12))+'||'+cast(case when (select cierreTurno from $rr->base_suc.dbo.venTurnosCajaCierreReg y where convert(char(10),y.fechaOperacion,(20))=a.fechaVentaSinHora and y.codigoUsuario=a.codigoCajero)=1 then 2 else 1 end as varchar(1))+'||0' from $rr->base_suc.dbo.venVentasCab a inner join $rr->base_suc.dbo.genSucursalesCat b on b.codigoSucursal=a.codigoSucursal inner join $rr->base_suc.dbo.segUsuariosCodigosExternosCat c on c.id =a.codigoCajero where a.fechaVentaSinHora>=GETDATE()-15 and a.tipoVenta='C' and (select SUM(d.importefisico*tipoDeCambio) from $rr->base_suc.dbo.venCortesParcialesReg d where d.folioCorte=a.folioCorte  and codigoFormaPago=1          and auditoria=0) is not null group by a.fechaVentaSinHora ,a.codigoCaja,a.codigoCajero,a.folioCorte 
union all select convert(varchar(10),a.fechaVentaSinHora,20)+'||'+min(substring(b.descripcion,0,4))+'||'+cast(a.codigoCaja as varchar(2))+'||'+SUBSTRING(a.foliocorte,7,10)+'||'+cast(min(c.codigoExterno)as varchar(9))+'||'+min(c.nombreUsuario)+'||16||'+cast((select SUM(d.importefisico+importeRetiro) from $rr->base_suc.dbo.venCortesParcialesReg d where d.folioCorte=a.folioCorte  and codigoFormaPago=10              and auditoria=0 group by folioCorte) as varchar(12))+'||'+cast((select SUM(d.importefisico+d.importeRetiro) from $rr->base_suc.dbo.venCortesParcialesReg d inner join $rr->base_suc.dbo.venCortesBitacoraDiferenciasReg x on x.folioCorte=d.folioCorte where d.folioCorte=a.folioCorte  and codigoFormaPago=10               and auditoria=0)as varchar(12))+'||'+cast(case when (select cierreTurno from $rr->base_suc.dbo.venTurnosCajaCierreReg y where convert(char(10),y.fechaOperacion,(20))=a.fechaVentaSinHora and y.codigoUsuario=a.codigoCajero)=1 then 2 else 1 end as varchar(1))+'||0' from $rr->base_suc.dbo.venVentasCab a inner join $rr->base_suc.dbo.genSucursalesCat b on b.codigoSucursal=a.codigoSucursal inner join $rr->base_suc.dbo.segUsuariosCodigosExternosCat c on c.id =a.codigoCajero where a.fechaVentaSinHora>=GETDATE()-15 and a.tipoVenta='C' and (select SUM(d.importefisico*tipoDeCambio) from $rr->base_suc.dbo.venCortesParcialesReg d where d.folioCorte=a.folioCorte  and codigoFormaPago=10              and auditoria=0) is not null group by a.fechaVentaSinHora ,a.codigoCaja,a.codigoCajero,a.folioCorte
union all select convert(varchar(10),a.fechaVentaSinHora,20)+'||'+min(substring(b.descripcion,0,4))+'||'+cast(a.codigoCaja as varchar(2))+'||'+SUBSTRING(a.foliocorte,7,10)+'||'+cast(min(c.codigoExterno)as varchar(9))+'||'+min(c.nombreUsuario)+'||80||'+cast((select SUM(d.importefisico+importeRetiro) from $rr->base_suc.dbo.venCortesParcialesReg d where d.folioCorte=a.folioCorte  and codigoFormaPago in(11,12,13,14) and auditoria=0 group by folioCorte) as varchar(12))+'||'+cast((select SUM(d.importefisico+d.importeRetiro) from $rr->base_suc.dbo.venCortesParcialesReg d inner join $rr->base_suc.dbo.venCortesBitacoraDiferenciasReg x on x.folioCorte=d.folioCorte where d.folioCorte=a.folioCorte  and codigoFormaPago in(11,12,13,14)  and auditoria=0)as varchar(12))+'||'+cast(case when (select cierreTurno from $rr->base_suc.dbo.venTurnosCajaCierreReg y where convert(char(10),y.fechaOperacion,(20))=a.fechaVentaSinHora and y.codigoUsuario=a.codigoCajero)=1 then 2 else 1 end as varchar(1))+'||0' from $rr->base_suc.dbo.venVentasCab a inner join $rr->base_suc.dbo.genSucursalesCat b on b.codigoSucursal=a.codigoSucursal inner join $rr->base_suc.dbo.segUsuariosCodigosExternosCat c on c.id =a.codigoCajero where a.fechaVentaSinHora>=GETDATE()-15 and a.tipoVenta='C' and (select SUM(d.importefisico*tipoDeCambio) from $rr->base_suc.dbo.venCortesParcialesReg d where d.folioCorte=a.folioCorte  and codigoFormaPago in(11,12,13,14) and auditoria=0) is not null group by a.fechaVentaSinHora ,a.codigoCaja,a.codigoCajero,a.folioCorte 
union all select convert(varchar(10),a.fechaVentaSinHora,20)+'||'+min(substring(b.descripcion,0,4))+'||'+cast(a.codigoCaja as varchar(2))+'||'+SUBSTRING(a.foliocorte,7,10)+'||'+cast(min(c.codigoExterno)as varchar(9))+'||'+min(c.nombreUsuario)+'||2||'+cast((select SUM((d.importefisico+importeRetiro)*tipoDeCambio) from $rr->base_suc.dbo.venCortesParcialesReg d where d.folioCorte=a.folioCorte  and codigoFormaPago=2 and auditoria=0 group by folioCorte) as varchar(12))+'||'+cast((select SUM((d.importefisico+d.importeRetiro)*tipoDeCambio) from $rr->base_suc.dbo.venCortesParcialesReg d inner join $rr->base_suc.dbo.venCortesBitacoraDiferenciasReg x on x.folioCorte=d.folioCorte where d.folioCorte=a.folioCorte  and codigoFormaPago=2 and auditoria=0)as varchar(12))+'||'+cast(case when (select cierreTurno from $rr->base_suc.dbo.venTurnosCajaCierreReg y where convert(char(10),y.fechaOperacion,(20))=a.fechaVentaSinHora and y.codigoUsuario=a.codigoCajero)=1 then 2 else 1 end as varchar(1))+'||'+ cast((select min(m.tipoDeCambio) from $rr->base_suc.dbo.venRetiroValoresReg m where m.foliocorte=a.folioCorte and codigoFormaPago=2) as varchar(12)) from $rr->base_suc.dbo.venVentasCab a inner join $rr->base_suc.dbo.genSucursalesCat b on b.codigoSucursal=a.codigoSucursal inner join $rr->base_suc.dbo.segUsuariosCodigosExternosCat c on c.id =a.codigoCajero where a.fechaVentaSinHora>=GETDATE()-15 and a.tipoVenta='C' and (select SUM(d.importefisico*tipoDeCambio) from $rr->base_suc.dbo.venCortesParcialesReg d where d.folioCorte=a.folioCorte  and codigoFormaPago=2 and auditoria=0) is not null group by a.fechaVentaSinHora ,a.codigoCaja,a.codigoCajero,a.folioCorte"; 
$ven3="SELECT substring(b.descripcion,1,3)+'||'+convert(varchar(10),a.fechaventa, 20)+'||'+a.folioVenta+'||'+  c.codigoRelacionado+'||'+ d.descripcion+'||'+  e.descripcion+'||'+  cast(c.cantidadVendida as varchar(7))+'||'+ cast(cantidadDevuelta as varchar(7))+'||'+  cast((cantidadVendida-cantidadDevuelta)as varchar(7))+'||'+ cast(case when (cantidadVendida-cantidadDevuelta)=0  then 0 else (((cantidadVendida-cantidadDevuelta)*c.precioVenta)-c.importeDescuento)+importeIva  end as varchar(15))+'||'+ cast(c.codigoCliente as varchar(5))+'||'+ cast(f.codigoExterno as varchar(9))+'||'+  f.nombreUsuario+'||'+ cast(((cantidadVendida-cantidadDevuelta)*importeDescuento)as varchar(15))+'||'+ cast(((cantidadVendida-cantidadDevuelta)*importeIva)as varchar(15))+'||'+ cast(c.precioVenta as varchar(15))+'||'+ cast(porcentajeDescuento as varchar(15))+'||'+ cast(c.costoUnitario as varchar(15))  FROM $rr->base_suc.dbo.venVentascab a,  $rr->base_suc.dbo.genSucursalesCat b,   $rr->base_suc.dbo.venVentasdet c,  $rr->base_suc.dbo.genProductosCat d,  $rr->base_suc.dbo.genFamiliasCat e,  $rr->base_suc.dbo.segUsuariosCodigosExternosCat f   where  b.codigoSucursal=a.codigosucursal and   a.codigoSucursal=c.codigoSucursal and   a.folioVenta=c.folioVenta and  c.codigoProducto=d.codigoProducto and  d.codigoFamiliaUno=e.codigoFamiliaUno and  d.codigoFamiliaDos=e.codigoFamiliaDos and   a.codigovendedor=f.ID and  a.fechaVenta>(GETDATE()-15)";
$com3="SELECT CONVERT(varchar(4), a.fecha,20)+'||'+CONVERT(varchar(2), a.fecha,101)+'||'+cast(substring(b.descripcion,1,4) as varchar(4))+'||'+CONVERT(varchar(10), a.fecha,20)+'||'+ cast(a.folioReferencia as varchar(20))+'||'+ cast(a.codigoRelacionado as varchar(14))+'||'+ cast(a.cantidad as varchar(10))+'||'+ cast(a.costoUnitario as varchar(15))+'||'+ cast(a.tasaiva as varchar(12))+'||'+ cast((a.cantidad*costoUnitario) as varchar(15))+'||'+ cast((d.subtotal+d.iva) as varchar(18))+'||'+ cast(a.codigoProveedor as varchar(4))+'||'+ cast(a.cantidadDevuelta as varchar(10)) FROM   $rr->base_suc.dbo.cmpComprasDirectasdet a,   $rr->base_suc.dbo.genSucursalesCat b,  $rr->base_suc.dbo.cmpComprasDirectascab d where   a.codigoSucursal=b.codigoSucursal and  a.folioCompra=d.folioCompra and a.codigoSucursal=d.codigoSucursal and a.codigoProveedor=d.codigoProveedor and  a.fecha>=(GETDATE()-15)";
$mov3="select convert(varchar(10),a.fechamovimiento,20)+'||'+SUBSTRING(c.descripcion,1,4)+'||'+folioreferencia+'||'+b.afectacion+'||'+b.descripcion+'||'+codigorelacionado+'||'+d.descripcion+'||'+cast(a.cantidad as varchar(10))+'||'+cast(a.costototal as varchar(15)) from $rr->base_suc.dbo.invHistorialMovimientosDet a, $rr->base_suc.dbo.genTipoMovimientoInventarioCat b, $rr->base_suc.dbo.genSucursalesCat c, $rr->base_suc.dbo.genProductosCat d where a.codigoMovimiento=b.codigoTipoMovimiento and a.codigoSucursal=c.codigoSucursal and a.codigoProducto=d.codigoProducto and a.fechaMovimiento>=GETDATE()-15 and a.codigoMovimiento <>13 and a.codigoMovimiento<>23";
$inv3="select cast((DATEPART( wk, GETDATE())) as varchar(2))+'||'+CONVERT(char(10), getdate(), 20)+'||'+substring(b.descripcion,1,4)+'||'+ rtrim(ltrim(c.codigorelacionado))+'||'+cast(a.existencia as varchar(10))+'||',convert(money, optimo)from $rr->base_suc.dbo.invControlExistenciasReg a, $rr->base_suc.dbo.genSucursalesCat b,$rr->base_suc.dbo.genProductosCodigosRelacionadosCat c where a.codigoSucursal=b.codigoSucursal and a.codigoproducto = c.codigoproducto and a.existencia>0 and renglon=2";
echo $var1.'<br />'.$var2.$cor3.$cor4.'<br />'.$var2.$ven3.$ven4.'<br />'.$var2.$com3.$com4.'<br />'.$var2.$mov3.$mov4.'<br />'.$var2.$inv3.$inv4;
}
}

function transferFile($ruta, $archivo)
    {
       
        $this->load->library('ftp');
        $config['hostname'] = '192.168.1.221';
        $config['username'] = 'central';
        $config['password'] = 'hachi1417';
        $config['debug'] = TRUE;
        
        $this->ftp->connect($config);
        $this->ftp->upload($ruta, $archivo, 'auto', 0777);
        $this->ftp->close();
         
    }













































}