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
    
    function cuenta_control_tar(){
    
    $s="SELECT count(*) as cuenta
          from vtadc.tarjetas_suc a
          left join catalogo.sucursal d on d.suc=a.suc
          where a.tipo=1
          order by a.suc";
          
    $query = $this->db->query($s);
        $r = $query->row();
        return $r->cuenta;
    
}
////////////////////////////////////////////////////////////////////////////////////////////

function control_tar($inicio,$fin) 
{
    
    $s="select s.suc, u.nombre as sucursal, fol1, fol2, (fol2 + 1 - fol1) as tarjetas, count(*) as vendidas, (fol2 + 1 - fol1) - count(*) as inv
        from vtadc.tarjetas_suc s
        join vtadc.tarjetas t on codigo between fol1 and fol2 and s.suc = t.suc
        join catalogo.sucursal u on s.suc = u.suc
        where s.tipo=1 and t.venta between '$inicio' and '$fin'
        group by s.id
        order by fol1";
    
    /*$s="SELECT a.*,(a.fol2-a.fol1+1)as tar ,d.nombre as sucx,d.tipo2,c.venta
          from vtadc.tarjetas_suc a
          left join catalogo.sucursal d on d.suc=a.suc
          join vtadc.tarjetas c on c.suc=a.suc and a.fol1 = c.codigo 
          where a.tipo=1 and c.venta between '$inicio' and '$fin'
          order by suc";
          
          */
          
            $q=$this->db->query($s);
            return $q;
        
        } 
    
    function detalle_tar_med($suc,$fol1,$fol2,$inicio,$fin) 
{
    
    $s="SELECT a.codigo,a.tipo,a.nombre,a.dire,a.vigencia,a.venta,a.nomina,b.completo
        from vtadc.tarjetas a
        left join catalogo.cat_empleado b on b.nomina = a.nomina
        where a.tipo=1 and a.suc=$suc and a.codigo>=$fol1 and a.codigo<=$fol2
        and a.venta between '$inicio' and '$fin' order by a.venta";
          
            $q=$this->db->query($s);
            return $q;
       } 
}

    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////