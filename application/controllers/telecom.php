<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Telecom extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api_model');
    }
    
 
 function sube_archivo()
 {
    $aaa=2016;$mes=6;
    $this->load->library('ftp');
    $s="delete from telecom.gastos_tel_plano";
    $this->db->query($s);
    if(file_exists("c:/wamp/www/subir10/telecom.txt")){$this->transferFile('c:/wamp/www/subir10/telecom.txt','telecom.txt');}
    
    $s0="load data infile '/home/central/telecom.txt' 
        replace into table telecom.gastos_tel_plano FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
    $this->db->query($s0);
    
    $s1="insert ignore into telecom.gastos_tel(aaa, mes, tel, monto,suc)
        (select aaa, mes, tel, monto,0 from telecom.gastos_tel_plano)";
    $this->db->query($s1);
    $s2="update telecom.gastos_tel a,telecom.tel_suc b
        set a.suc=b.suc
        where a.tel=b.tel and a.aaa=$aaa and a.mes=$mes";
    $this->db->query($s2);
    
    $s3="insert ignore into telecom.gastos_tel(aaa, mes, tel, monto,suc)
(select $aaa,$mes,tel,169,suc from telecom.tel_suc
where tel='VOIP/CABLE')";
    $this->db->query($s3);
    
    $s4="INSERT INTO vtadc.gasto(aaa, mes, suc, auxi, importe, ob)
        (SELECT aaa,mes,a.suc,'4008',sum(a.monto) as monto,'TEL'
        from telecom.gastos_tel a
        left join catalogo.sucursal c on c.suc=a.suc and tlid=1
        where aaa=$aaa and mes=$mes and a.suc>0
        group by suc order by suc)
        ON DUPLICATE KEY UPDATE importe=values(importe)";
    $this->db->query($s4);
    echo 'Ya termine de generar';
 
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