
<?php
class Lidia_model extends CI_Model
{



function lllll()
{
 $s="SELECT a.clave as clave_p,a.id,a.susa,a.presenta, b.id as id_det,b.*
FROM compras.licita_p a
left join compras.licita_pd b on b.id_licita=a.id ";
 $q=$this->db->query($s);
 return $q;   
}


function inserta_pedido_for_especial()
    {
    ini_set('memory_limit','15000M');
    set_time_limit(0);
$foliou=9108867;

        $x1="select a.suc,b.fec
from catalogo.sucursal a
left join desarrollo.pedido_esp_global b on b.suc=a.suc
where b.suc is not null and b.fec='2014-11-22'
group by a.suc";
        $q1=$this->db->query($x1);
 foreach($q1->result() as $r1)
        {
        $suc=$r1->suc;
        
        $a = $this->__arreglo_pedido_formulado_una($suc);
        $fec=date('Y-m-d');
        $b = "insert ignore into desarrollo.pedido_formulado (promant, fecg, tsuc, suc, sec, porce, descri, promact, 
        maxi, inv, ped, exc, costo, venta, impo, lin, iva,inv_cedis,mue,bloque) values ";
        
        foreach($a as $ped)
        {
            //id, cia, nomina, aaa1, aaa2, dias, aaa, dias_ley
              foreach($ped as $fin)
            {
                
        
                $b .= "(".$fin['promeant'].",date(now()),'".$fin['tsuc']."',".$fin['suc'].",".$fin['sec'].",".$fin['por'].",
                '".$fin['susa1']."',".$fin['promeact'].",".round($fin['promeact']*$fin['por'],2).",".$fin['inv'].",
                ".$fin['ped'].",".$fin['exc'].",".$fin['costo'].",".$fin['venta'].",".$fin['venta']*$fin['ped'].",
                ".$fin['lin'].",".$fin['iva'].",".$fin['inv_cedis'].",".$fin['mue'].",".$fin['ruta']."),";
            }
            
        }
        
        $b = substr($b, 0, -1) . ";";
     $this->db->query($b);
///////////////////////////////////////////////////////////////////////////////// pedido que remplace los datos.
$ff=date('Ymd');

/////////////////////////////////////////////////////////////////////////////////

//die();
$sx8="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',0,1,0,0 
FROM desarrollo.pedido_formulado WHERE MUE<>6  and ped>0 and fecg='$fec' GROUP BY SUC)";
$this->db->query($sx8);

$sx9="insert into catalogo.folio_pedidos_cedis (suc, fechas, tid, fechasur, id_user, id_captura, id_surtido, id_empaque)
( SELECT suc,fecg,'A', '0000-00-00 00:00:00',mue,1,0,0 
FROM desarrollo.pedido_formulado WHERE MUE=6  and ped>0 and fecg='$fec' GROUP BY SUC)";
$this->db->query($sx9);
$sx10="insert into desarrollo.pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM desarrollo.pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=a.mue
where ped>0 and fecg='$fec' and id_user=6 and a.mue=6 and b.id>=$foliou order by a.suc)";
$this->db->query($sx10);
$sx11="insert into desarrollo.pedidos
(suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis)
(SELECT
a.suc,a.fecg,a.sec,a.ped,a.fecg,1,a.mue,a.descri,a.ped,b.id,a.bloque,a.tsuc,
case when descon=1 or inv_cedis > 0
then a.ped
else
0
end
as piezas,
0,'0000-00-00','N',costo,iva,venta,lin,inv_cedis
FROM desarrollo.pedido_formulado a
left join catalogo.folio_pedidos_cedis b on b.suc=a.suc and b.fechas=a.fecg and b.id_user=0
where ped>0 and fecg='$fec' and id_user=0  and a.mue<>6 and b.id>=$foliou order by a.suc)
on duplicate key update sec=values(sec)";
$this->db->query($sx11);

$sx12="update  desarrollo.pedidos set sur=0 where fecha='$fec' and sur>0 and invcedis=0 and suc=$suc and fol>$foliou";
$this->db->query($sx12);



$sx14="delete FROM desarrollo.pedido_formulado";
$this->db->query($sx14);
}
    
 //echo "<pre>";
  //print_r($a);
  //echo "</pre>";
  //die();
		
        
    }
//
function __arreglo_pedido_formulado_una($suc)
    {

$sql = "SELECT * FROM catalogo.sucursal where suc=$suc and tlid=1";
        
        $sql2 = "select a.*,b.can as final from catalogo.almacen a
        left join desarrollo.pedido_esp_global b on b.sec=a.sec and b.suc=$suc
        left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
        left join desarrollo.inv_cedis_sec1 d on d.sec=a.sec
        where
        c.sec is not null and b.suc=$suc and c.descon='N' and tsec='G'
        or
        d.sec is not null and b.suc=$suc and c.descon='S' and d.inv1>0
        group by a.sec order by descon";
        
        $query = $this->db->query($sql);
        $a = array();
        
        $query2 = $this->db->query($sql2);
        
        $c = array();
        $d = array();
        $e = array();
        $b = 0;
        foreach($query2->result() as $row2)
        {
        foreach($query->result() as $row)
        {

$inv=0;    

$s3="select * from desarrollo.inv_cedis_sec1 where sec=$row2->sec and inv1>0;";   
$q3 = $this->db->query($s3);
if($q3->num_rows()==1){
$r3 = $q3->row();
$inv_cedis=$r3->inv1;    
}else{
$inv_cedis=0;
}
$s4="select * from catalogo.almacen_mue where sec=$row2->sec;";   
$q4 = $this->db->query($s4);
if($q4->num_rows()==1){
$r4 = $q4->row();
$mue=$r4->mueble;    
}else{
$mue=0;
}
$s5="select * from catalogo.almacen_rutas where suc=$row->suc;";   
$q5 = $this->db->query($s5);
if($q5->num_rows()==1){
$r5 = $q5->row();
$ruta=$r5->ruta;    
}else{
$ruta=0;
}
$s6="select * from catalogo.almacen_paquetes  where sec=$row2->sec";
$q6 = $this->db->query($s6);
if($q6->num_rows()==1){
$r6 = $q6->row();
$paq=$r6->can;    
}else{
$paq=0;
}
$s7="select * from catalogo.cat_almacen_clasifica  where sec=$row2->sec";
$q7 = $this->db->query($s7);
if($q7->num_rows()==1){
$r7 = $q7->row();
$tip=$r7->tipo;    
}else{
$tip=0;
}
$promeant=0;
$promeact=0;
$ped=$row2->final;

if($paq > 0 and $ped>0){$ped=round(($ped/$paq),0)*$paq;}

if($row->tipo2=='D'){$vta=$row2->vtaddr;}else{$vta=$row2->vtagen;}
            $a[$row->suc][$row2->sec]['tsuc'] = $row->tipo2;
			$a[$row->suc][$row2->sec]['suc'] = $row->suc;
            $a[$row->suc][$row2->sec]['iva'] = $row->iva;
			$a[$row->suc][$row2->sec]['sec'] = $row2->sec;
            $a[$row->suc][$row2->sec]['susa1'] = $row2->susa1;
            $a[$row->suc][$row2->sec]['lin'] = $row2->lin;
            $a[$row->suc][$row2->sec]['costo'] = $row2->costo;
            $a[$row->suc][$row2->sec]['venta'] = $vta;
            $a[$row->suc][$row2->sec]['promeact'] = round($promeact);
            $a[$row->suc][$row2->sec]['promeant'] = round($promeant);
            $a[$row->suc][$row2->sec]['inv'] = $inv;
            $a[$row->suc][$row2->sec]['inv_cedis'] = $inv_cedis;
            $a[$row->suc][$row2->sec]['maxi'] = 0;
            $a[$row->suc][$row2->sec]['ped'] = $ped;
            $a[$row->suc][$row2->sec]['exc'] = 0;
            $a[$row->suc][$row2->sec]['ruta'] = $ruta;
            $a[$row->suc][$row2->sec]['mue'] = $mue;
            $a[$row->suc][$row2->sec]['por'] = 0;
        }
        $b++;
		}
   
 //echo "<pre>";
 //print_r($a);
 //echo "</pre>";
 //die();
        return $a;
    
}  

function imprime_pedidos()
    {
        set_time_limit(0);
        ini_set('memory_limit','2000M');
        $this->load->helper('file');
        $aaa=date('Y');
        $mes=date('m');
        $otra_fecha1 = date('Y-m').'01';
		$otra_fecha2 = date('Y-m-d');
        $sql0 = "update catalogo.folio_pedidos_cedis_especial a
set tid='S'
where  a.fechas between '$otra_fecha1' and '$otra_fecha2 23:59:59' and tid='A' and
(select sum(sur) from desarrollo.pedidos x where x.fol=a.id)=0
or
a.fechas between '$otra_fecha1' and '$otra_fecha2 23:59:59' and tid='A' and
(select sum(sur) from desarrollo.pedidos x where x.fol=a.id)is null
";
$q0 = $this->db->query($sql0);
$sql1 = "update catalogo.folio_pedidos_cedis a
set tid='S'
where  a.fechas between '$otra_fecha1' and '$otra_fecha2 23:59:59' and tid='A' and
(select sum(sur) from desarrollo.pedidos x where x.fol=a.id)=0
or
a.fechas between '$otra_fecha1' and '$otra_fecha2 23:59:59' and tid='A' and
(select sum(sur) from desarrollo.pedidos x where x.fol=a.id)is null";
$q1 = $this->db->query($sql1);
        
        
        $sql = "SELECT id as fol, suc,id_user
        from catalogo.folio_pedidos_cedis b 
        where b.fechas between date(now()) and concat(date(now()),' 23:59:59')
        order by id_user,id";
       $q = $this->db->query($sql);
	    $aaa=date('Y');
        $mes=date('m');
        $dia=date('d');
        
$bat = "@echo off
";
$bat1 = "@echo off
";
$bat3 = "@echo off
";
$bat4 = "@echo off
";
        foreach($q->result() as $r)
        {
        $fol = $r->fol;
        $suc = $r->suc;
        $data['fol']=$fol;
            if($r->id_user==6)
            {
                $tit='PREVIO DE PEDIDOS DE CONTROL MUEBLE 6';
                $nomarchivo = 'C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/'.$fol.'_06.pdf';
            }else{
                $tit='PREVIO DE PEDIDOS DE ALMACEN GENERAL';
                $nomarchivo = 'C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/'.$fol.'.pdf';
            }            //echo $r->fol.'<br />';
             
          $nomarchivofal = 'C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/rf_fal.pdf';
          $data['nomarchivo'] = $nomarchivo;
          if (file_exists($nomarchivo)){
            //echo "El fichero $nombre_fichero existe";
          }else{
              $mesx = $this->Catalogos_model->busca_mes_uno($mes);
              $sucx = $this->Catalogos_model->busca_suc_una($suc);
              $rutax = $this->Catalogos_model->busca_sucursal_ruta($suc,$fol);  
                $data['cabeza']= "
               <table>
               
               <tr>
               <td colspan=\"5\" align=\"center\"><strong>".$tit."</strong></td>
               </tr>
               
               <tr>
               <td colspan=\"5\" align=\"right\">Fecha de impresion.:".date('Y-m-d H:s:i')." </td>
               </tr>
               <tr>
               <td colspan=\"3\" align=\"right\">RUTA.:".$rutax." </td>
               <td colspan=\"2\" align=\"right\">Fecha .:".date('Y-m-d')." </td>
               </tr>
               <tr>
               <td colspan=\"2\" align=\"left\"><strong>SUCURSAL..:$suc - $sucx </strong> <br /></td>
                <td colspan=\"3\" align=\"ribht\"><strong>FOLIO..:$fol </strong> <br /></td>
               </tr>
                <tr>
               <th width=\"40\" align=\"center\"><strong>UBIC</strong></th>
               <th width=\"40\" align=\"left\"><strong>CVE</strong></th>
               <th width=\"310\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
               <th width=\"220\" align=\"left\"><strong>DESCRIPCION</strong></th>
               <th width=\"70\" align=\"right\"><strong>CANTIDAD</strong></th>
               
              </tr>
               </table> 
                ";
                
                $this->load->view('impresion/previo_de_pedidos', $data);
          }
            
if($r->id_user==0){
$bat.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\".$fol.".pdf\" \"pedidos\"
";
$bat3.= "\"C:\\Archivos de programa\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\pedidos\\".$fol.".pdf\" \"pedidos\"
";    
}else{
$bat1.= "\"C:\\Program Files\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\wamp\\www\\f\\resp\\".date('Y_m_d')."\\pdf\\".$fol."_06.pdf\" \"pedidos\"
";    
$bat4.= "\"C:\\Archivos de programa\\Foxit Software\\Foxit Reader\\Foxit Reader.exe\" -t \"C:\\pedidos\\".$fol."_06.pdf\" \"pedidos\"
";        
}            

            
        }

$bat.="exit";
$bat1.="exit";
$bat3.="exit";
$bat4.="exit";
        
        write_file('C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/imprime1.bat', $bat);
        write_file('C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/imprime2.bat', $bat1);
        write_file('C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/imprime3.bat', $bat3);
        write_file('C:\wamp\www\f\resp/'.date('Y_m_d').'/pdf/imprime4.bat', $bat4);
echo "Ya se Generaron los pedidos de almacen central";
}    





























































////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function enlace_ftp()
{
$my_file='surc.txt';
$this->load->library('ftp');

$config['hostname'] = 'fenixcentral.homeip.net';
$config['username'] = 'nadro';
$config['password'] = 'N4dr08';
$config['debug']    = TRUE;

$this->ftp->connect($config);
$li=$this->ftp->download('/conofe.txt', './transfer/lidiaofe.txt');
}

function pinche_baras()
{
$ss="select *from aguascalientes.entradas_c a, catalogo.foliador1 b
where a.tipo=1 and a.subtipo=4  and a.estatus=1 and b.clav='fto' and nuevof=0";
$q=$this->db->query($ss);
foreach ($q->result() as $rr)
{
$s="update aguascalientes.entradas_c a, catalogo.foliador1 b
set a.nuevof=b.num, b.num=b.num+1
where a.tipo=1 and a.subtipo=4 and a.estatus=1 and b.clav='fto' and a.id=$rr->id and nuevof=0";
$this->db->query($s);    
}
$ss="select *from chetumal.entradas_c a, catalogo.foliador1 b
where a.tipo=1 and a.subtipo=4  and a.estatus=1 and b.clav='fto' and nuevof=0";
$q=$this->db->query($ss);
foreach ($q->result() as $rr)
{
$s="update chetumal.entradas_c a, catalogo.foliador1 b
set a.nuevof=b.num, b.num=b.num+1
where a.tipo=1 and a.subtipo=4 and a.estatus=1 and b.clav='fto' and a.id=$rr->id and nuevof=0";
$this->db->query($s);    
}
$ss="select *from oaxaca.entradas_c a, catalogo.foliador1 b
where a.tipo=1 and a.subtipo=4  and a.estatus=1 and b.clav='fto' and nuevof=0";
$q=$this->db->query($ss);
foreach ($q->result() as $rr)
{
$s="update oaxaca.entradas_c a, catalogo.foliador1 b
set a.nuevof=b.num, b.num=b.num+1
where a.tipo=1 and a.subtipo=4 and a.estatus=1 and b.clav='fto' and a.id=$rr->id and nuevof=0";
$this->db->query($s);    
}
$ss="select *from michoacan.entradas_c a, catalogo.foliador1 b
where a.tipo=1 and a.subtipo=4  and a.estatus=1 and b.clav='fto' and nuevof=0";
$q=$this->db->query($ss);
foreach ($q->result() as $rr)
{
$s="update michoacan.entradas_c a, catalogo.foliador1 b
set a.nuevof=b.num, b.num=b.num+1
where a.tipo=1 and a.subtipo=4 and a.estatus=1 and b.clav='fto' and a.id=$rr->id and nuevof=0";
$this->db->query($s);    
}

$s="select b.cod_rel1,b.cod_rel2,a.cod,c.descripcion,c.lin,c.sublin,c.labprv,a.far,c.cos,c.pub,a.fac,a.prv,max(fecha)
from compras.pre_factura_fenix a
left join catalogo.cod_rel b on a.cod=b.ean
left join catalogo.cat_mercadotecnia c on c.codigo=a.cod
where
fecha>='2014-10-01' and (b.cod_rel1=0 or b.cod_rel2=0 or b.ean is null)
group by a.cod";


}


function __llamado($suc,$back)
{

 
if(file_exists('e:/backoffice/cor'.$suc.'.txt') and $back==2){
$mm="load data infile 'e:/backoffice/cor".$suc.".txt' replace into table vtadc.vta_backoffice_cortesc FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(fecha, suc, caja, fol, @nomina, @nombre, pago, arqueocaja, cortecaja, turno,dolar)
set nombre = CONVERT(CAST(@nombre as BINARY) USING LATIN1),nomina =replace(@nomina,'C','')";
$this->db->query($mm);
}
if(file_exists('e:/backoffice/cor'.$suc.'.txt') and $back==1){
$mm="load data infile 'e:/backoffice/cor".$suc.".txt' replace into table vtadc.vta_backoffice_cortesc FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(fecha, suc, caja, @nomina, @nombre, pago, arqueocaja, cortecaja,fol)
set nombre = CONVERT(CAST(@nombre as BINARY) USING LATIN1),nomina =replace(@nomina,'C','')";
$this->db->query($mm);
}
if(file_exists('e:/backoffice/ven'.$suc.'.txt')){
$sr="LOAD DATA INFILE 'e:/backoffice/ven".$suc.".txt' 
replace into table vtadc.vta_backoffice FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(suc, fecha, tic, cod, @des, @lin, cann, cancelado, cant, imp, vtatip, nomina, @nom,descu,iva,precio_uni,por_des,cos)
set des = CONVERT(CAST(@des as BINARY) USING LATIN1),nom = CONVERT(CAST(@nom as BINARY) USING LATIN1),
lin = CONVERT(CAST(@lin as BINARY) USING LATIN1)";
$this->db->query($sr);
}
if(file_exists('e:/backoffice/invdet'.$suc.'.txt')){
$s="delete from desarrollo.inv where suc=$suc";
$this->db->query($s);
$sr="LOAD DATA INFILE 'e:/backoffice/invdet".$suc.".txt' 
replace into table oficinas.inv_det_bak FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
$this->db->query($sr);
$ad="insert into desarrollo.inv(tsuc, suc, mov, codigo, cantidad, fechai,sec)
(select 'F',suc,3,codigo,piezas,fecha,0 from oficinas.inv_det_bak where fecha=date(now()) and suc=$suc)";
$this->db->query($ad); 
}
}
function pp()
{
    
$cas="select *from catalogo.sucursal where back>0 and tlid=1 and fecha_act='0000-00-00'";
$q4=$this->db->query($cas);
 foreach($q4->result()as $r4)
{
$this->__llamado($r4->suc,$r4->back);    
}

$m="insert into vtadc.vta_backoffice_cortesd(suc, fecha, lin, vta, iva, siniva)
(SELECT a.suc,a.fecha,b.lin_cor,sum(a.imp),sum(iva),(sum(a.imp)-sum(a.iva))
FROM vtadc.vta_backoffice a
left join catalogo.sublinea b on
b.lin=(case when substr(a.lin,3,2)>0 then substr(a.lin,1,1) else substr(a.lin,1,2) end) and
b.slin=(case when substr(a.lin,3,2)>0 then substr(a.lin,3,2) else substr(a.lin,4,2) end)

where a.fecha between subdate(date(now()),15) and subdate(date(now()),1) and a.vtatip=1
group by a.fecha,a.suc,b.lin_cor
order by lin_cor
)
on duplicate key update vta=values(vta), iva=values(iva), siniva=values(siniva)";
$this->db->query($m);
$mc="insert into vtadc.vta_backoffice_cortesd(suc, fecha, lin, vta, iva, siniva)
(SELECT a.suc,a.fecha,30,sum(a.imp),0,0
FROM vtadc.vta_backoffice a
where a.fecha between subdate(date(now()),15) and subdate(date(now()),1) and a.vtatip>1 and a.vtatip<>39
group by a.fecha,a.suc
)
on duplicate key update vta=values(vta), iva=values(iva), siniva=values(siniva)";
$this->db->query($mc);

$me="insert into vtadc.vta_backoffice_cortesd(suc, fecha, lin, vta, iva, siniva)
(SELECT a.suc,a.fecha,40,sum(a.imp),0,0
FROM vtadc.vta_backoffice a
where a.fecha between subdate(date(now()),15) and subdate(date(now()),1) and a.vtatip=39
group by a.fecha,a.suc
)
on duplicate key update vta=values(vta), iva=values(iva), siniva=values(siniva)";
$this->db->query($me);

$caja=0;$turno=0;$suc=0;$fecha='0000-00-00';    
$ss="SELECT * FROM vtadc.vta_backoffice_cortesc where turno=0 group by fecha,suc,caja,fol  order by fecha,suc,caja,fol";
$q=$this->db->query($ss);
foreach ($q->result() as $rr)
{
if(($fecha==$rr->fecha and $suc==$rr->suc)){
$turno=$turno+1;    
}else{
$turno=1;
$fecha=$rr->fecha;
$suc=$rr->suc;
$caja=$rr->caja;    
}    
$s="update vtadc.vta_backoffice_cortesc a
set a.turno=$turno
where suc=$rr->suc and fecha='$rr->fecha' and caja=$rr->caja and fol=$rr->fol";
$this->db->query($s);    
$fecha=$rr->fecha;
$suc=$rr->suc;
$caja=$rr->caja;
}

$s1="select *from vtadc.vta_backoffice_cortesc where fecha>=subdate(date(now()),3) and turno>0
group by fecha,suc";
$q1=$this->db->query($s1);
foreach($q1->result()as $r1)
{
$s2="select subdate(date(now()),1), a.*from desarrollo.cortes_c a where suc=$r1->suc and fechacorte='$r1->fecha'";
$q2=$this->db->query($s2);
echo "<br />";
if($q2->num_rows()== 0){
$gra="insert into desarrollo.cortes_c(id, suc, id_user, cia, 
succ, plaza, fechacorte, fecha,turno1_folio1,turno1_folio2, 
turno1_cajera, turno1_pesos, turno1_dolar, turno1_cambio, turno1_mn, turno1_bbv, turno1_san, turno1_exp,turno1_vale, 
turno1_corte, 
turno1_asalto, turno1_fal, turno1_sob, 

turno2_folio1, turno2_folio2, 
turno2_cajera, turno2_pesos,turno2_dolar, turno2_cambio, turno2_mn, turno2_bbv, turno2_san, turno2_exp, turno2_vale, turno2_corte, turno2_asalto, turno2_fal, 
turno2_sob, turno3_folio1, turno3_folio2, turno3_cajera, turno3_pesos, turno3_dolar, turno3_cambio, turno3_mn, turno3_bbv, 
turno3_san, turno3_exp, turno3_vale, turno3_corte, turno3_asalto, turno3_fal, turno3_sob, turno4_folio1, turno4_folio2, 
turno4_cajera, turno4_pesos, turno4_dolar, turno4_cambio, turno4_mn, turno4_bbv, turno4_san, turno4_exp, turno4_vale, 
turno4_corte, turno4_asalto, turno4_fal, turno4_sob, caja, tipo, id_cor, recarga, vta_tot, tsuc, envio, id_plaza, 
vta_comision)
(SELECT 0,a.suc,b.user_id,b.cia,
suc_contable,b.plaza,a.fecha,date(now())
,0,0,
ifnull(x1.nomina,0),ifnull(x1.arqueocaja,0),0,0,0,0,ifnull(y1.arqueocaja,0),0,ifnull(z1.arqueocaja,0),
ifnull((select sum(cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=1 group by m.turno),0),
0,
case when (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=1 group by m.turno)>0
then (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=1 group by m.turno) else 0 end,

case when (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=1 group by m.turno)>0
then (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=1 group by m.turno) else 0 end,


0,0,
ifnull(x2.nomina,0),ifnull(x2.arqueocaja,0),0,0,0,0,ifnull(y2.arqueocaja,0),0,ifnull(z2.arqueocaja,0),
ifnull((select sum(cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=2 group by m.turno),0),
0,
case when (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=2 group by m.turno)>0
then (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=2 group by m.turno) else 0 end,

case when (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=2 group by m.turno)>0
then (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=2 group by m.turno) else 0 end,

0,0,
ifnull(x3.nomina,0),ifnull(x3.arqueocaja,0),0,0,0,0,ifnull(y3.arqueocaja,0),0,ifnull(z3.arqueocaja,0),
ifnull((select sum(cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=3 group by m.turno),0),
0,
case when (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=3 group by m.turno)>0
then (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=3 group by m.turno) else 0 end,

case when (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=3 group by m.turno)>0
then (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=3 group by m.turno) else 0 end,

0,0,
ifnull(x4.nomina,0),ifnull(x4.arqueocaja,0),0,0,0,0,ifnull(y4.arqueocaja,0),0,ifnull(z4.arqueocaja,0),
ifnull((select sum(cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=4 group by m.turno),0),
0,
case when (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=4 group by m.turno)>0
then (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=4 group by m.turno) else 0 end,

case when (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=4 group by m.turno)>0
then (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=4 group by m.turno) else 0 end,
1,2,b.gere,0,
ifnull((select sum(vta) from vtadc.vta_backoffice_cortesd x where x.fecha=a.fecha and x.suc=a.suc and x.lin<>(49) group by x.fecha,x.suc),0),
b.tipo2,'N',b.id_plaza,0
FROM vtadc.vta_backoffice_cortesc a
left join catalogo.sucursal b on b.suc=a.suc
left join vtadc.vta_backoffice_cortesc x1 on  x1.fecha=a.fecha and x1.suc=a.suc and x1.turno=1 and x1.pago in(1,2)
left join vtadc.vta_backoffice_cortesc y1 on  y1.fecha=a.fecha and y1.suc=a.suc and y1.turno=1 and y1.pago=16
left join vtadc.vta_backoffice_cortesc z1 on  z1.fecha=a.fecha and z1.suc=a.suc and z1.turno=1 and z1.pago=80
left join vtadc.vta_backoffice_cortesc x2 on  x2.fecha=a.fecha and x2.suc=a.suc and x2.turno=2 and x2.pago in(1,2)
left join vtadc.vta_backoffice_cortesc y2 on  y2.fecha=a.fecha and y2.suc=a.suc and y2.turno=2 and y2.pago=16
left join vtadc.vta_backoffice_cortesc z2 on  z2.fecha=a.fecha and z2.suc=a.suc and z2.turno=2 and z2.pago=80
left join vtadc.vta_backoffice_cortesc x3 on  x3.fecha=a.fecha and x3.suc=a.suc and x3.turno=3 and x3.pago in(1,2)
left join vtadc.vta_backoffice_cortesc y3 on  y3.fecha=a.fecha and y3.suc=a.suc and y3.turno=3 and y3.pago=16
left join vtadc.vta_backoffice_cortesc z3 on  z3.fecha=a.fecha and z3.suc=a.suc and z3.turno=3 and z3.pago=80
left join vtadc.vta_backoffice_cortesc x4 on  x4.fecha=a.fecha and x4.suc=a.suc and x4.turno=4 and x4.pago in(1,2)
left join vtadc.vta_backoffice_cortesc y4 on  y4.fecha=a.fecha and y4.suc=a.suc and y4.turno=4 and y4.pago=16
left join vtadc.vta_backoffice_cortesc z4 on  z4.fecha=a.fecha and z4.suc=a.suc and z4.turno=4 and z4.pago=80
where a.fecha='$r1->fecha' and a.suc=$r1->suc
group by a.fecha,a.suc)";

$this->db->query($gra);
}else{
$r2=$q2->row();
if($r2->tipo==2){
$update="insert into desarrollo.cortes_c(id, suc, id_user, cia, 
succ, plaza, fechacorte, fecha,turno1_folio1,turno1_folio2, 
turno1_cajera, turno1_pesos, turno1_dolar, turno1_cambio, turno1_mn, turno1_bbv, turno1_san, turno1_exp,turno1_vale, 
turno1_corte, 
turno1_asalto, turno1_fal, turno1_sob, 

turno2_folio1, turno2_folio2, 
turno2_cajera, turno2_pesos,turno2_dolar, turno2_cambio, turno2_mn, turno2_bbv, turno2_san, turno2_exp, turno2_vale, turno2_corte, turno2_asalto, turno2_fal, 
turno2_sob, turno3_folio1, turno3_folio2, turno3_cajera, turno3_pesos, turno3_dolar, turno3_cambio, turno3_mn, turno3_bbv, 
turno3_san, turno3_exp, turno3_vale, turno3_corte, turno3_asalto, turno3_fal, turno3_sob, turno4_folio1, turno4_folio2, 
turno4_cajera, turno4_pesos, turno4_dolar, turno4_cambio, turno4_mn, turno4_bbv, turno4_san, turno4_exp, turno4_vale, 
turno4_corte, turno4_asalto, turno4_fal, turno4_sob, caja, tipo, id_cor, recarga, vta_tot, tsuc, envio, id_plaza, 
vta_comision)
(SELECT 0,a.suc,b.user_id,b.cia,
suc_contable,b.plaza,a.fecha,date(now())
,0,0,
ifnull(x1.nomina,0),ifnull(x1.arqueocaja,0),0,0,0,0,ifnull(y1.arqueocaja,0),0,ifnull(z1.arqueocaja,0),
ifnull((select sum(cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=1 group by m.turno),0),
0,
case when (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=1 group by m.turno)>0
then (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=1 group by m.turno) else 0 end,

case when (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=1 group by m.turno)>0
then (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=1 group by m.turno) else 0 end,


0,0,
ifnull(x2.nomina,0),ifnull(x2.arqueocaja,0),0,0,0,0,ifnull(y2.arqueocaja,0),0,ifnull(z2.arqueocaja,0),
ifnull((select sum(cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=2 group by m.turno),0),
0,
case when (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=2 group by m.turno)>0
then (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=2 group by m.turno) else 0 end,

case when (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=2 group by m.turno)>0
then (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=2 group by m.turno) else 0 end,

0,0,
ifnull(x3.nomina,0),ifnull(x3.arqueocaja,0),0,0,0,0,ifnull(y3.arqueocaja,0),0,ifnull(z3.arqueocaja,0),
ifnull((select sum(cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=3 group by m.turno),0),
0,
case when (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=3 group by m.turno)>0
then (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=3 group by m.turno) else 0 end,

case when (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=3 group by m.turno)>0
then (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=3 group by m.turno) else 0 end,

0,0,
ifnull(x4.nomina,0),ifnull(x4.arqueocaja,0),0,0,0,0,ifnull(y4.arqueocaja,0),0,ifnull(z4.arqueocaja,0),
ifnull((select sum(cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=4 group by m.turno),0),
0,
case when (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=4 group by m.turno)>0
then (select sum(cortecaja-arqueocaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=4 group by m.turno) else 0 end,

case when (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=4 group by m.turno)>0
then (select sum(arqueocaja-cortecaja) from vtadc.vta_backoffice_cortesc m where m.fecha=a.fecha and m.suc=a.suc and m.turno=4 group by m.turno) else 0 end,
1,2,b.gere,0,
ifnull((select sum(vta) from vtadc.vta_backoffice_cortesd x where x.fecha=a.fecha and x.suc=a.suc and x.lin<>(49) group by x.fecha,x.suc),0),
b.tipo2,'N',b.id_plaza,0
FROM vtadc.vta_backoffice_cortesc a
left join catalogo.sucursal b on b.suc=a.suc
left join vtadc.vta_backoffice_cortesc x1 on  x1.fecha=a.fecha and x1.suc=a.suc and x1.turno=1 and x1.pago in(1,2)
left join vtadc.vta_backoffice_cortesc y1 on  y1.fecha=a.fecha and y1.suc=a.suc and y1.turno=1 and y1.pago=16
left join vtadc.vta_backoffice_cortesc z1 on  z1.fecha=a.fecha and z1.suc=a.suc and z1.turno=1 and z1.pago=80
left join vtadc.vta_backoffice_cortesc x2 on  x2.fecha=a.fecha and x2.suc=a.suc and x2.turno=2 and x2.pago in(1,2)
left join vtadc.vta_backoffice_cortesc y2 on  y2.fecha=a.fecha and y2.suc=a.suc and y2.turno=2 and y2.pago=16
left join vtadc.vta_backoffice_cortesc z2 on  z2.fecha=a.fecha and z2.suc=a.suc and z2.turno=2 and z2.pago=80
left join vtadc.vta_backoffice_cortesc x3 on  x3.fecha=a.fecha and x3.suc=a.suc and x3.turno=3 and x3.pago in(1,2)
left join vtadc.vta_backoffice_cortesc y3 on  y3.fecha=a.fecha and y3.suc=a.suc and y3.turno=3 and y3.pago=16
left join vtadc.vta_backoffice_cortesc z3 on  z3.fecha=a.fecha and z3.suc=a.suc and z3.turno=3 and z3.pago=80
left join vtadc.vta_backoffice_cortesc x4 on  x4.fecha=a.fecha and x4.suc=a.suc and x4.turno=4 and x4.pago in(1,2)
left join vtadc.vta_backoffice_cortesc y4 on  y4.fecha=a.fecha and y4.suc=a.suc and y4.turno=4 and y4.pago=16
left join vtadc.vta_backoffice_cortesc z4 on  z4.fecha=a.fecha and z4.suc=a.suc and z4.turno=4 and z4.pago=80
where a.fecha='$r1->fecha' and a.suc=$r1->suc
group by a.fecha,a.suc)
on duplicate key update 
turno1_cajera=values(turno1_cajera), 
turno1_vale  =values(turno1_vale),
turno1_pesos =values(turno1_pesos),  
turno1_san   =values(turno1_san), 
turno1_corte =values(turno1_corte), 
turno1_fal   =values(turno1_fal), 
turno1_sob   =values(turno1_sob),
turno2_cajera=values(turno2_cajera),
turno2_vale  =values(turno2_vale), 
turno2_pesos =values(turno2_pesos),  
turno2_san   =values(turno2_san), 
turno2_corte =values(turno2_corte), 
turno2_fal   =values(turno2_fal), 
turno2_sob   =values(turno2_sob),
turno3_cajera=values(turno3_cajera),
turno3_vale  =values(turno3_vale), 
turno3_pesos =values(turno3_pesos),  
turno3_san   =values(turno3_san), 
turno3_corte =values(turno3_corte), 
turno3_fal   =values(turno3_fal), 
turno3_sob   =values(turno3_sob),
turno4_cajera=values(turno4_cajera),
turno4_vale  =values(turno4_vale), 
turno4_pesos =values(turno4_pesos),  
turno4_san   =values(turno4_san), 
turno4_corte =values(turno4_corte), 
turno4_fal   =values(turno4_fal), 
turno4_sob   =values(turno4_sob) 
";
$this->db->query($update);    
}}}

$det="insert ignore into desarrollo.cortes_d(id_cc, clave1, venta, cancel, corregido, siniva, fecha, id, lin_g, tipo, val_cre, aumento)
(select a.id,b.lin,b.vta,0,b.vta,b.siniva,date(now()),0,0,2,case when b.lin=40 then 1 else 0 end,0 from desarrollo.cortes_c a
left join vtadc.vta_backoffice_cortesd b on b.fecha=a.fechacorte and a.suc=b.suc
where a.fechacorte>=subdate((date(now())),15) and tipo=2)
on duplicate key update venta=values(venta),cancel=values(cancel),corregido=values(corregido)
";
$this->db->query($det);
$s="insert ignore into vtadc.vta_backoffice_credito(suc, fecha, tic, cod, des, lin, cann, cancelado, cant, imp, vtatip, nomina, nom,descu,iva,precio_uni,por_des,cos)
(select suc, fecha, tic, cod, des, lin, cann, cancelado, cant, imp, vtatip, nomina, nom ,descu,iva,precio_uni,por_des,cos
from vtadc.vta_backoffice where vtatip>1 and fecha>=date_sub(date(now()),interval 35 day))
on duplicate key update
imp=values(imp),descu=values(descu),iva=values(iva),precio_uni=values(precio_uni),por_des=values(por_des)
";
$q=$this->db->query($s);
$s1="insert into vtadc.venta_detalle (suc, fecha, tiket, codigo, descri, can, vta, des, importe, iva,  nombre, dire, cedula, tarjeta, tipo,tventa,cancela,cos)
(select suc, fecha, tic, cod, des, cann, round((imp/cann),2),0, imp,0,'','',0,0,0,vtatip,cancelado,cos from vtadc.vta_backoffice where fecha>=date_sub(date(now()),interval 20 day))
on duplicate key update can=values(can),importe=values(importe),vta=values(vta),tventa=values(tventa),cancela=values(cancela)";
$this->db->query($s1);
$s3="insert into vtadc.venta_ctl(fecha, suc, can, imp )
(select fecha, suc, sum(can), sum(importe) from vtadc.venta_detalle where fecha>=date_sub(date(now()),interval 20 day) and can>0
group by fecha,suc)
on duplicate key update can=values(can),imp=values(imp)";
$this->db->query($s3);
$s="update vtadc.venta_ctl a, desarrollo.cortes_c b, desarrollo.cortes_d_c01_c40 c
set cortes=corregido
where a.fecha=b.fechacorte and b.id=c.id_cc and  a.suc=b.suc and a.fecha>='2014-03-01' ";
$this->db->query($s);
$sjorge="insert ignore into vtadc.venta_detalle_nat
(suc, fecha, tiket, codigo, descri, can, vta, des, importe, iva, nombre, dire, cedula, tarjeta, tipo, tventa, consecu, nomina, cancela, sec)
(SELECT
v.suc, v.fecha, v.tiket, v.codigo, v.descri, v.can, v.vta, v.des, v.importe, v.iva,  v.nombre, v.dire, v.cedula, v.tarjeta, v.tipo, v.tventa, v.consecu, v.nomina, v.cancela, b.sec
FROM vtadc.venta_detalle v
left join catalogo.almacen a on v.codigo=a.codigo
left join catalogo.cat_naturistas b on b.sec=a.sec
left join catalogo.sucursal c on c.suc=v.suc
where fecha>=date_sub(date(now()),interval 20 day)  and tipo2<>'F'
and b.sec is not null)";
$this->db->query($sjorge);
$sjorge1="update
vtadc.venta_detalle_nat a, vtadc.cancelados b
set a.cancela=b.pieza, a.imp_cancela=b.impor
where a.suc=b.suc and a.fecha=b.fecha and a.tiket=b.tiket and a.codigo=b.codigo and a.fecha>=date_sub(date(now()),interval 20 day)
";
$this->db->query($sjorge1);

$s2="INSERT INTO VTADC.venta(aaa, mes, sucursal, codigo, descripcion, venta, importe, lin, sublin)
(SELECT date_format(fecha,'%Y'), date_format(fecha,'%m'), suc,  codigo, descri, sum(can)-sum(cancela), sum(importe)-(sum(cancela*vta)-sum(cancela*des)), 0,0 
from vtadc.venta_detalle where date_format(fecha,'%Y')=year(now()) and date_format(fecha,'%m')>=month(now()) 
group by date_format(fecha,'%Y-%m'),suc,codigo)
on duplicate key update venta=values(venta),importe=values(importe)";
$this->db->query($s2);
}















//LOAD DATA INFILE 'c:/wamp/www/subir10/pafvr415.txt' INTO TABLE subir10.p_fiscal_vr_c FIELDS TERMINATED BY ';' LINES TERMINATED BY '\r\n'
//(fec1, fec2, cia, ciax, cheque, @cheque_real, sub, iva, tot)set cheque_real=replace(@cheque_real,' ',0)

//LOAD DATA INFILE 'c:/wamp/www/subir10/pafvr412.txt' INTO TABLE subir10.p_fiscal_vr_d FIELDS TERMINATED BY ';' LINES TERMINATED BY '\r\n'
//(fec1, fec2, cia, ciax, prv, prvx, cheque, @cheque_real, contra, fec_entrada, fec_ven, suc, sucx, fac, nota, sub, iva, tot) set cheque_real=replace(@cheque_real,' ',0)














}
?>
