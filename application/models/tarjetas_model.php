<?php
class Tarjetas_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

function control_tarjetas()
{
    $s="Select b.nombre as sucx,a.*, 1+(fol2-fol1)as tar from vtadc.tarjetas_suc a join catalogo.sucursal b on b.suc=a.suc 
    where tipo=0 and activo=1";
$q=$this->db->query($s);
return $q;
}    
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

function archivo_para_suc($suc)
{
    
    $nombre_archivo='';
    $s="select *From catalogo.sucursal where tipo3='DA'  and tlid=1 and suc=$suc";
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
        $s2 = "select *From vtadc.tarjetas_suc where suc = $suc and tipo=1 and activo=1";
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
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

function control_tarjetas_historicas($suc)
{
    $s="Select b.nombre as sucx,a.*, 1+(fol2-fol1)as tar from vtadc.tarjetas_suc a 
    join catalogo.sucursal b on b.suc=a.suc 
    where tipo=1 and activo=1 and a.suc=$suc";
$q=$this->db->query($s);
return $q;
}    
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
    
    
    
    
    
    
    
    
    
    






}