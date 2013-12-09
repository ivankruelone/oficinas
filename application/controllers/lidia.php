
<?php
class lidia extends CI_Controller
{
public function __construct()
    {
        parent::__construct();    
        $this->load->helper('directory');
        $this->load->helper('file');
        $this->load->model('lidia_model');
    }   



function enlace()
{

$this->load->library('ftp');
$fec=date('dmY');
$fectime=date('Y-m-d H:i:s');
$config['hostname'] = 'fenixCentral01.homeip.net';
$config['username'] = 'administrador';
$config['password'] = 'PharmaF3n1x';
$config['debug']    = TRUE;
$this->ftp->connect($config);

$li=$this->ftp->download('saba/catalogo.txt', './transfer/sabacata'.$fec.'.txt');
$s="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/sabacata".$fec.".txt'
 replace INTO TABLE catalogo.cat_sabap LINES TERMINATED BY '\r\n'
 (@var1)
SET
fecha_alta='$fectime',
codigo = trim(SUBSTR(@var1, 1, 13)),
descripcion = SUBSTR(@var1,14, 30),
farmacia = SUBSTR(@var1, 56, 9),

costo =round(SUBSTR(@var1, 56, 9)-
(case when
SUBSTR(@var1, 66, 9)>0
then
(SUBSTR(@var1, 66, 9)/100)*SUBSTR(@var1, 56, 9)
 else 0 end),2),
lab=SUBSTR(@var1, 85, 30),
nivel_existencia = 0,
publico=SUBSTR(@var1, 46,9),
oferta=0,
antibiotico = ' ',
iva = SUBSTR(@var1, 80,5),
financiero= SUBSTR(@var1, 66, 9)
";
$this->db->query($s);

$li=$this->ftp->download('saba/ofertas.txt', './transfer/sabaconofe'.$fec.'.txt');
$s="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/sabaconofe".$fec.".txt'
 replace INTO TABLE catalogo.cat_sabap LINES TERMINATED BY '\r\n'
 (@var1)
SET
fecha_alta='$fectime',
codigo = trim(SUBSTR(@var1, 13, 13)),
descripcion = SUBSTR(@var1,26, 30),
farmacia = SUBSTR(@var1, 56, 9),

costo =round(SUBSTR(@var1, 56, 9)-
(case when
SUBSTR(@var1, 65, 6)>0
then
(SUBSTR(@var1, 65, 6)/100)*SUBSTR(@var1, 56, 9)
 else 0 end)-


(case
when SUBSTR(@var1, 92, 6)='100.00'
then (.18)*

(SUBSTR(@var1, 56, 9)-
(case when
SUBSTR(@var1, 65, 6)>0
then
(SUBSTR(@var1, 65, 6)/100)*SUBSTR(@var1, 56, 9)
 else 0 end))

when SUBSTR(@var1, 92, 6)='  0.00'
then 0
else
(SUBSTR(@var1, 92, 6)/100)*
(SUBSTR(@var1, 56, 9)-
(case when
SUBSTR(@var1, 65, 6)>0
then
(SUBSTR(@var1, 65, 6)/100)*SUBSTR(@var1, 56, 9)
 else 0 end))
end),2),
lab=lab,
iva=iva,
nivel_existencia = SUBSTR(@var1, 71, 1),
oferta=SUBSTR(@var1, 65, 6),
antibiotico = SUBSTR(@var1, 99,1),
financiero= case when SUBSTR(@var1, 92,3)=100 then 18 else (SUBSTR(@var1, 92,5)) end,
publico=SUBSTR(@var1, 100,9)
";
$this->db->query($s);



$li=$this->ftp->download('fanasa/catalogo.txt', './transfer/fanasacata'.$fec.'.txt');
$s="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/fanasacata".$fec.".txt'
 replace INTO TABLE catalogo.cat_fanasa LINES TERMINATED BY '\r\n'
 (@var1)
SET
fecha_alta='$fectime',
codigo = trim(SUBSTR(@var1, 1, 13)),
descripcion = SUBSTR(@var1,14, 30),
farmacia = SUBSTR(@var1, 56, 9),

costo =round(SUBSTR(@var1, 56, 9)-
(case when
SUBSTR(@var1, 66, 9)>0
then
(SUBSTR(@var1, 66, 9)/100)*SUBSTR(@var1, 56, 9)
 else 0 end),2),
lab=SUBSTR(@var1, 85, 30),
nivel_existencia = 0,
publico=SUBSTR(@var1, 46,9),
oferta=0,
antibiotico = ' ',
iva = case when SUBSTR(@var1, 84,1)=1 then '16.00' else 0 end,
financiero= SUBSTR(@var1, 66, 9)
";
$this->db->query($s);

$li=$this->ftp->download('fanasa/ofertas.txt', './transfer/fanasaconofe'.$fec.'.txt');
$s="LOAD DATA INFILE 'c:/wamp/www/oficinas/transfer/fanasaconofe".$fec.".txt'
 replace INTO TABLE catalogo.cat_fanasa LINES TERMINATED BY '\r\n'
 (@var1)
SET
fecha_alta='$fectime',
codigo = trim(SUBSTR(@var1, 13, 13)),
descripcion = SUBSTR(@var1,26, 30),
farmacia = SUBSTR(@var1, 56, 9),

costo =round(SUBSTR(@var1, 56, 9)-
(case when
SUBSTR(@var1, 65, 6)>0
then
(SUBSTR(@var1, 65, 6)/100)*SUBSTR(@var1, 56, 9)
 else 0 end)-


(case
when SUBSTR(@var1, 92, 6)='100.00'
then (.18)*

(SUBSTR(@var1, 56, 9)-
(case when
SUBSTR(@var1, 65, 6)>0
then
(SUBSTR(@var1, 65, 6)/100)*SUBSTR(@var1, 56, 9)
 else 0 end))

when SUBSTR(@var1, 92, 6)='  0.00'
then 0
else
(SUBSTR(@var1, 92, 6)/100)*
(SUBSTR(@var1, 56, 9)-
(case when
SUBSTR(@var1, 65, 6)>0
then
(SUBSTR(@var1, 65, 6)/100)*SUBSTR(@var1, 56, 9)
 else 0 end))
end),2),
lab=lab,
iva=iva,
nivel_existencia = SUBSTR(@var1, 71, 1),
oferta=SUBSTR(@var1, 65, 6),
antibiotico = SUBSTR(@var1, 99,1),
financiero= case when SUBSTR(@var1, 92,3)=100 then 18 else (SUBSTR(@var1, 92,5)) end,
publico=SUBSTR(@var1, 100,9)";
$this->db->query($s);

$ss1="update catalogo.cat_mercadotecnia a, catalogo.cat_fanasa b
set a.cos_fanasa=b.costo,a.pub=b.publico,a.farmacia=b.farmacia,a.labprv=b.lab
where a.codigo=b.codigo";
$this->db->query($ss1);
$ss1="update catalogo.cat_mercadotecnia a, catalogo.cat_sabap b
set a.cos_saba=b.costo,a.pub=b.publico,a.farmacia=b.farmacia,a.labprv=b.lab
where a.codigo=b.codigo";
$this->db->query($ss1);
$this->ftp->close();
}




function enlace_nad()
{
$this->load->library('ftp');
$fec=date('dmY');
$config['hostname'] = 'fenixcentral.homeip.net';
$config['username'] = 'nadro';
$config['password'] = 'N4dr08';
$config['debug']    = TRUE;
$li=$this->ftp->download('CONOFE.TXT', './transfer/nadroconofe'.$fec.'.txt');
$li=$this->ftp->download('/SINOFE.TXT', './transfer/nadrosinofe'.$fec.'.txt');
//$this->ftp->close();
}



}
?>
