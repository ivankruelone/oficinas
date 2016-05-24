<?php
class Procesos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 
 public function inv_yucif($in, $carpeta, $archivo, $metodo = FALSE)
 {
       $mov=0;
        if($metodo == FALSE){
            $string = file($in.$carpeta.'/'.$archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }else{
            $string = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }
                    
        $extrae=$string[0];
        $suc=substr($extrae,1,4);
        $diap=substr($extrae,6,2);
        $mesp=substr($extrae,8,2);
        $aaap=substr($extrae,10,2);
        $fechap='20'.$aaap.'-'.str_pad($mesp,2,"0",STR_PAD_LEFT)."-".str_pad($diap,2,"0",STR_PAD_LEFT);
        $sxz="select SUBDATE(date(now()),INTERVAL 2 DAY)as di, a.*from catalogo.sucursal a where a.suc=$suc";
        $qxz=$this->db->query($sxz);
        if($qxz->num_rows() > 0){
            $rxz=$qxz->row();
            $tsuc=$rxz->tipo2;
            $cia=$rxz->cia;
            $fecha_limite=$rxz->di;
        }else{
            $tsuc=' ';
			$fecha_limite=date('Y-m-d');   
        }
        //echo "<pre>";
           
        //echo "$archivo - $fechap</pre>";
        //die(); 
           
        
        $this->db->delete('desarrollo.inv', array('suc' => $suc));
                   
        $linea = array_map('rtrim', $string);
        
        $a = array();
        
        foreach($linea as $lin){
   
            $x5='';
            $b= $lin."<br />";
                        
            $x=substr($lin,0,1);
            $x2=substr($lin,5,1);
            $x3=substr($lin,0,4);
            $x4=substr($lin,0,9);
            $x5=substr($lin,0,1);
            //tsuc, id, suc, mov, codigo, cantidad, fechai, fechag, sec
            $cod=substr($lin,0,13);   
            $can=substr($lin,14,4);
            
            if($x3=='>07+'){$mov=7;}
            if($x3=='>03+'){$mov=3;}
            if($x3=='>91+'){$mov=0;}
            if($x3=='>41+'){$mov=41;}  
            $x5=substr($lin,18,1);
            if($x5=='+' and $mov>0){//$x5=='+' and $can>0 para que no pase inventario en cero
                if($mov==7){$sec=$cod;}
                if($mov==3){$sec=0;}
                
                //$sww="insert ignore into desarrollo.inv(tsuc,mov,suc,codigo,cantidad,fechai,sec,cia)
                //values('$tsuc',$mov,$suc,$cod,$can,$fechap,$sec,$cia)";
                //$qww=$this->db->query($sww);
                
                $sww="select a.*from desarrollo.inv a where a.suc=$suc and a.codigo=$cod and mov=$mov and fechai=$fechap";
                $qww=$this->db->query($sww);
                if($qww->num_rows() == 0){
                   $new_member_insert_data = array(
         	                               'tsuc' => $tsuc,
                                            'mov' => $mov,
                                            'suc' => $suc,
                                            'codigo' => $cod,
                                            'cantidad' => $can,
                                            'fechai' => $fechap,
                                            'sec' => $sec,
                                            'cia' => $cia
                                            );
//$insert = $this->db->insert('desarrollo.inv', $new_member_insert_data);
$cos=0;$vta=0;
                    array_push($a, $new_member_insert_data);
                }  
            }
                   
        }
       $this->db->insert_batch('desarrollo.inv', $a);
  
 }

function rv_ad($in, $carpeta, $archivo)
    {
$sql = "LOAD DATA INFILE ? REPLACE INTO TABLE vtadc.venta_detalle
LINES STARTING BY 'VE0' TERMINATED BY '\r\n'
(@var1)
SET
suc = SUBSTR(@var1, 1, 7),
fecha = SUBSTR(@var1, 8, 8),
tiket = SUBSTR(@var1,16, 10),
codigo = SUBSTR(@var1, 26, 13),
descri = UCASE(TRIM(SUBSTR(@var1, 39, 35))),
can = TRIM(SUBSTR(@var1, 74, 7)),
vta = ROUND(TRIM(SUBSTR(@var1, 81, 11))/100, 2),
des = ROUND(TRIM(SUBSTR(@var1, 92, 11))/100, 3),
importe = ROUND((TRIM(SUBSTR(@var1, 81, 11))/100 - TRIM(SUBSTR(@var1, 92, 11))/100) * TRIM(SUBSTR(@var1, 74, 7)), 2),
iva = ROUND(TRIM(SUBSTR(@var1, 103, 11))/100, 2),
nombre = UCASE(TRIM(SUBSTR(@var1, 125, 30))),
dire = UCASE(TRIM(SUBSTR(@var1, 175, 100))),
cedula = TRIM(SUBSTR(@var1, 275, 10)),

tventa = TRIM(SUBSTR(@var1, 286, 1)),
tarjeta = TRIM(SUBSTR(@var1, 297, 13)),
tipo = SUBSTR(@var1, 310, 2),
consecu = TRIM(SUBSTR(@var1, 312, 10)),
nomina = TRIM(SUBSTR(@var1, 322, 7))
;";
$this->db->query($sql, $in.$carpeta.'/'.$archivo);

$sa = "LOAD DATA INFILE ? REPLACE INTO TABLE vtadc.gc_compra_det
LINES STARTING BY 'CO0000'
(@var2)
SET
suc = SUBSTR(@var2, 1, 4),
aaa = SUBSTR(@var2, 5, 4),
mes = SUBSTR(@var2, 9, 2),
fecha = SUBSTR(@var2, 5, 8),
factura =UCASE(TRIM(SUBSTR(@var2,13, 17))),
codigo = SUBSTR(@var2, 30, 13),
can = TRIM(SUBSTR(@var2, 43, 7)),
costo = ROUND((TRIM(SUBSTR(@var2, 50, 11))/100), 2),
iva = ROUND((TRIM(SUBSTR(@var2, 76, 11))/100), 2),
impo = ROUND((TRIM(SUBSTR(@var2, 87, 11))/100), 2),
imp_fac = ROUND((TRIM(SUBSTR(@var2, 106, 11))/100), 2)
;"; 
 
$this->db->query($sa, $in.$carpeta.'/'.$archivo);}
 
  function rv_can($in, $carpeta, $archivo)
    {

$s = "LOAD DATA INFILE ? REPLACE INTO TABLE vtadc.cancelados
LINES STARTING BY '||CA0000'
(@var2)
SET
suc = SUBSTR(@var2, 1, 4),
aaa = SUBSTR(@var2, 5, 4),
mes = SUBSTR(@var2, 9, 2),
dia = SUBSTR(@var2, 11, 2),
fecha = SUBSTR(@var2, 5, 8),
tiket = SUBSTR(@var2,13, 10),
codigo = SUBSTR(@var2, 23, 13),
pieza = TRIM(SUBSTR(@var2, 71, 7)),
impor = ROUND((TRIM(SUBSTR(@var2, 78, 11))/100 - TRIM(SUBSTR(@var2, 89, 11))/100) * TRIM(SUBSTR(@var2, 71, 7)), 2)
;"; 

$this->db->query($s, $in.$carpeta.'/'.$archivo);
}
   function rv($in, $carpeta, $archivo)
    {
        $x1 = substr($archivo, 2, 4);

                    $string = file($in.$carpeta.'/'.$archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                   //////////////////////////////////////////////////////////////////////////////////////////
                   ////////////////////////////////////////////////////////////////////////////////////////// 
                   $linea = array_map('rtrim', $string); 
                      foreach($linea as $lin)
                    {

                        $x = substr($lin,0,3);
                        $xx = substr($lin,0,4);
                        $y = substr($lin,0,5);
                        $yy = substr($lin,0,5);
                        
                        if($x == 'TCP' and $xx <> 'TCP*'){
echo $xx;
                        $tarjeta=substr($lin,3,13);
                        $tipo=substr($lin,17,1);
                        $nombre=utf8_encode(substr($lin,18,35));
                        $dire=utf8_encode(substr($lin,118,200));
                        $dire2=utf8_encode(substr($lin,318,200));
                        $vigencia=substr($lin,628,8);
                        $venta=substr($lin,636,8);
                        $nomina=substr($lin,644,10);
                        $sx="select *from vtadc.tarjetas where suc = $x1 and codigo = $tarjeta and tipo = $tipo;";
                        $qx=$this->db->query($sx);
                        if(($qx->num_rows() == 0) and ($tipo<>'*')){
                        $new_member_insert_data_tar = array(
//codigo, tipo, nombre, dire, dire2, vigencia, venta, nomina, suc, id
        	                                 'tipo' => $tipo,
                                             'nombre' => $nombre,
                                             'dire' => $dire,
                                             
                                             'dire2' => $dire2,
                                             'codigo' => $tarjeta,
                                             'vigencia' => $vigencia,
                                             'venta'=>$venta,
                                             'nomina'=>$nomina,
                                             'suc'=>$x1
                                            );
		                      $insert = $this->db->insert('vtadc.tarjetas', $new_member_insert_data_tar);   
                            }
                        
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                        }elseif($y == '||TCP' and $yy <> '||TCP*' ){



                        $tarjeta=substr($lin,5,13);
                        $tipo=substr($lin,19,1);
                        $nombre=utf8_encode(substr($lin,20,35));
                        $dire=utf8_encode(substr($lin,120,200));
                        $dire2=utf8_encode(substr($lin,320,200));
                        $vigencia=substr($lin,630,8);
                        $venta=substr($lin,638,8);
                        $nomina=substr($lin,646,10);
                        $sx="select *from vtadc.tarjetas where suc = $x1 and codigo = $tarjeta and tipo = $tipo;";
                        $qx=$this->db->query($sx);
                        if(($qx->num_rows() == 0) and ($tipo<>'*')){
                        $new_member_insert_data_tar = array(
//codigo, tipo, nombre, dire, dire2, vigencia, venta, nomina, suc, id
        	                                 'tipo' => $tipo,
                                             'nombre' => $nombre,
                                             'dire' => $dire,
                                             
                                             'dire2' => $dire2,
                                             'codigo' => $tarjeta,
                                             'vigencia' => $vigencia,
                                             'venta'=>$venta,
                                             'nomina'=>$nomina,
                                             'suc'=>$x1
                                            );
		                      $insert = $this->db->insert('vtadc.tarjetas', $new_member_insert_data_tar);   
                            }

                            
                        }
                    }   
        
    
            
    }











 

 
 
 
 
 
 
 
 
 
 
 
 
 
public function llena_mov_inv($fec1,$fec2,$sem)
{
$e1="insert into oficinas.salidas_entradas_inv
(tsuc, suc, sem, sal1, sal_imp1, sal2, sal_imp2, fec1, fec2, ent1, ent_imp1, ent2, ent_imp2)
(select b.tipo2,a.suc,$sem,0,0,0,0,'$fec1','$fec2',sum(c.sur),sum(c.sur*costo*1.10),0,0
from catalogo.folio_pedidos_cedis a
left join desarrollo.pedidos c on c.fol=a.id
left join catalogo.sucursal b on b.suc=a.suc
where a.suc>100 and a.suc<=1999 and a.tid='C' and c.sur>0 and a.fechas>='$fec1' and a.fechas<='$fec2'
group by a.suc)
on duplicate key update ent1=values(ent1), ent_imp2=values(ent_imp1)";
$this->db->query($e1);
$e2="insert into oficinas.salidas_entradas_inv
(tsuc, suc, sem, sal1, sal_imp1, sal2, sal_imp2, fec1, fec2, ent1, ent_imp1, ent2, ent_imp2)
(select b.tipo2,a.suc,$sem,0,0,0,0,'$fec1','$fec2',0,0,sum(c.sur),sum(c.sur*costo*1.10)
from catalogo.folio_pedidos_cedis_especial a
left join desarrollo.pedidos c on c.fol=a.id
left join catalogo.sucursal b on b.suc=a.suc
where a.suc>100 and a.suc<=1999 and a.tid='C' and c.sur>0 and a.fechas>='$fec1' and a.fechas<='$fec2'
group by a.suc
)
on duplicate key update ent2=values(ent2), ent_imp2=values(ent_imp2);";
$this->db->query($e2);

$s="insert into oficinas.salidas_entradas_inv
(tsuc, suc, sem, sal1, sal_imp1, sal2, sal_imp2, fec1, fec2, ent1, ent_imp1, ent2, ent_imp2)
(select b.tipo2,a.suc,$sem,sum(can),sum(importe),0,0,'$fec1','$fec2',0,0,0,0
from vtadc.venta_detalle a
left join catalogo.sucursal b on b.suc=a.suc
where a.suc>100 and fecha>='$fec1' and fecha<='$fec2'
group by a.suc)
on duplicate key update sal1=values(sal1), sal_imp1=values(sal_imp1)
";
$this->db->query($s);
die();
}


public function facturas_oficinas()
{
$cat="update metro.surtido_d a,catalogo.almacen b
set a.costo=b.costo
where a.clave=b.sec and b.costo>0";
$this->db->query($cat);
$cat="update almacen.salidas_c a,catalogo.cat_nuevo_general_prv b
set a.costo=b.costo
where a.codigo=b.codigo and a.claves=b.clagob and aaap>=2013 and a.costo=0 and b.costo>0";
$this->db->query($cat);


$fec=date('Y-m-d')-15;
/////////////////////////////////////////////////////////////////////////////////////////surtido de farmabodega
$f="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(SELECT a.suc,concat('FBO',a.id),sum(cans*vta),0,date_format(fechasur,'%Y-%m-%d'),'0000-00-00',
date_format(fechasur,'%Y'),date_format(fechasur,'%m'),1600,sum(cans*(costo*1.1)),13
FROM farmabodega.pedido_c a left join farmabodega.surtido_d b on b.id_ped=a.id
where fechasur>=subdate(date(now()),15) and cans>0
group by a.id)
on duplicate key update importe_prvcosto=values(importe_prvcosto),importe_prv=values(importe_prv)";
$this->db->query($f);
/////////////////////////////////////////////////////////////////////////////////////////surtido de especialidad
$ff="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(SELECT a.suc,concat('ESP',a.id),sum(cans*costo),0,date_format(fechasur,'%Y-%m-%d'),'0000-00-00',
date_format(fechasur,'%Y'),date_format(fechasur,'%m'),1600,sum(cans*(costo)),13
FROM especialidad.pedido_c a left join especialidad.surtido_d b on b.id_ped=a.id
where fechasur>=subdate(date(now()),15) and cans>0
group by a.id)
on duplicate key update importe_prvcosto=values(importe_prvcosto),importe_prv=values(importe_prv)
";
$this->db->query($ff);
/////////////////////////////////////////////////////////////////////////////////////////surtido de controlados_espe
$f1="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select sucursal,folio,
sum(cantidads*costo),0,concat(aaas,'-',mess,'-',dias),'0000-00-00',aaas,mess,100,sum(cantidads*costo),0
from almacen.salidas_c where
aaas>=year(now())
group by folio)
on duplicate key update importe_prvcosto=values(importe_prvcosto),importe_prv=values(importe_prv)";
$this->db->query($f1);
/////////////////////////////////////////////////////////////////////////////////////////surtido de metro
$f2="insert into vtadc.gc_factura
(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(SELECT a.suc,concat('METRO',a.id),sum(cans*costo),0, date_format(fechasur,'%Y-%m-%d'),'0000-00-00',
date_format(fechasur,'%Y'),date_format(fechasur,'%m'),100,sum(cans*costo),0
 FROM metro.pedido_c a
left join metro.surtido_d b on b.id_ped=a.id
where fechasur>=subdate(date(now()),15) and cans>0
group by a.id)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f2);
/////////////////////////////////////////////////////////////////////////////////////////traspaso de farmabodega
$f3="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select 1600,concat('TRA',x.id,'_',sale,entra),sum(cans*costo),
0, date(x.fecha),'0000-00-00', year(x.fecha), month(x.fecha),0,sum(cans*costo),13 from farmabodega.traspaso_c x
left join farmabodega.traspaso_d b on b.id_cc=x.id
where year(x.fecha)>=year(now())
 and cans>0
and x.entra=999
group by x.id
)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f3);
/////////////////////////////////////////////////////////////////////////////////////////devolucion de farmabodega
$f4="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select 1600,concat('DEV',x.id,'_',sale,entra),sum(cans*costo),
0, date(x.fecha),'0000-00-00', year(x.fecha), month(x.fecha),0,sum(cans*costo),13 from farmabodega.devolucion_c x
left join farmabodega.devolucion_d b on b.id_cc=x.id
where year(x.fecha)>=year(now())
 and cans>0
and x.entra=999
group by x.id
)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f4);
/////////////////////////////////////////////////////////////////////////////////////////devolucion de metro
$f5="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select 100,concat('DEV',x.id,'_',sale,entra),sum(cans*costo),
0, date(x.fecha),'0000-00-00', year(x.fecha), month(x.fecha),0,sum(cans*costo),1 from metro.devolucion_c x
left join metro.devolucion_d b on b.id_cc=x.id
where year(x.fecha)>=year(now()) and cans>0
and x.entra=100
group by x.id
)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f5);
/////////////////////////////////////////////////////////////////////////////////////////traspaso de metro
$f5="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select 100,concat('TRA',x.id,'_',sale,entra),sum(cans*costo),
0, date(x.fecha),'0000-00-00', year(x.fecha), month(x.fecha),0,sum(cans*costo),1 from metro.traspaso_c x
left join metro.traspaso_d b on b.id_cc=x.id
where year(x.fecha)>=year(now()) and cans>0
and x.entra=100
group by x.id
)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f5);
/////////////////////////////////////////////////////////////////////////////////////////traspaso de cedis
$f6="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select 900,concat('TCEDIS',x.id,'_',suc), sum(can*costo),0,fecha,'0000-00-00',year(fecha),month(fecha),0,sum(can*costo),1 from desarrollo.traspaso_c x
left join desarrollo.traspaso_d b on b.id_cc=x.id
where x.fechai>=subdate(date(now()),200)   and x.tipo='E' and tipo2='C'
group by x.id
)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f6);
/////////////////////////////////////////////////////////////////////////////////////////devolucion de cedis
$f7="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv, importe_prvcosto, cia)
(select 900,concat('DCEDIS',x.id,'_',suc), sum(can*costo),0,fecha,'0000-00-00',year(fecha),month(fecha),0,sum(can*costo),1
from desarrollo.devolucion_c x
left join desarrollo.devolucion_d b on b.id_cc=x.id
where x.tipo='E' and x.fechai>=subdate(date(now()),15)  and tipo2='C'
group by x.id
)
on duplicate key update importe_prv=values(importe_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($f7);















$s="insert into vtadc.gc_factura
(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc,aaa,mes,prv,importe_prvcosto,cia)
(
select
a.suc,a.id,sum(sur*vta),0,date_format(a.fechasur,'%Y-%m-%d'),'0000-00-00',date_format(a.fechasur,'%Y'),date_format(a.fechasur,'%m'),
100,

case
when c.cia=13
then sum(sur*(costo*1.20))
else sum(sur*(costo*1.20))
end,c.cia from  catalogo.folio_pedidos_cedis_especial a
left join desarrollo.pedidos b on a.id=b.fol
left join catalogo.sucursal c on c.suc=a.suc
where a.fechasur>=date_add(now(),interval-15 day) and a.tid='C' and b.sur>0 group by a.id)
on duplicate key update fecha_prv=values(fecha_prv),importe_prv=values(importe_prv),
importe_prvcosto=values(importe_prvcosto),cia=values(cia)"; 
$this->db->query($s);
    
$s1="insert into vtadc.gc_factura
(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc,aaa,mes,prv,importe_prvcosto,cia)
(
select
a.suc,a.id,sum(sur*vta),0,date_format(a.fechasur,'%Y-%m-%d'),'0000-00-00',date_format(a.fechasur,'%Y'),date_format(a.fechasur,'%m'),
100,

case
when c.cia=13
then sum(sur*(costo*1.20))
else sum(sur*(costo*1.20))
end,c.cia from  catalogo.folio_pedidos_cedis a
left join desarrollo.pedidos b on a.id=b.fol
left join catalogo.sucursal c on c.suc=a.suc
where a.fechasur>=date_add(now(),interval-15 day) and a.tid='C' and b.sur>0 group by a.id)
on duplicate key update fecha_prv=values(fecha_prv),importe_prv=values(importe_prv),
importe_prvcosto=values(importe_prvcosto),cia=values(cia)"; 
$this->db->query($s1);    

$s2="load data infile 'c:/wamp/www/subir10/factu.txt' replace into table vtadc.gc_compra_mayorista FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'";
$this->db->query($s2);
$s3="insert into vtadc.gc_factura(suc, factura, importe_prv, importe_suc, fecha_prv, fecha_suc, aaa, mes, prv,importe_prvcosto,cia)
(select a.suc,factura,importe,0,fecha,'0000-00-00',date_format(fecha,'%Y'),date_format(fecha,'%m'),prv,importe, b.cia
from vtadc.gc_compra_mayorista a
left join catalogo.sucursal b on b.suc=a.suc
where fecha>=date_add(now(),interval-15 day))
on duplicate key update importe_prv=values(importe_prv),fecha_prv=values(fecha_prv),importe_prvcosto=values(importe_prvcosto)";
$this->db->query($s3);

}
public function facturas_pdv()
{
$s="update vtadc.gc_factura a,vtadc.gc_compra_det_suc_fac b set importe_suc=b.importe, fecha_suc=fecha   
where   a.suc=b.suc and a.factura=b.factura and  
a.suc=b.suc and a.factura=b.factura"; 
$this->db->query($s); 

$s1="select *from vtadc.gc_factura where aaa=year(now()) and mes>=10";
$q1=$this->db->query($s1);
 foreach ($q1->result() as $r1) {

$ss="update vtadc.gc_factura a,vtadc.gc_compra_det_back b set importe_suc=importe,fecha_suc=fecha   
where   a.suc=b.suc and a.factura=b.factura  and  
date_format(fecha,'%Y')=$r1->aaa and  date_format(fecha,'%m')=$r1->mes and b.suc=$r1->suc and b.factura='$r1->factura'"; 
$this->db->query($ss); 
}
$s3="insert into vtadc.gc_factura_suc(aaa, mes, suc, importe_prvo, importe_suco, importe_prvs, importe_sucs,importe_prvocosto,cia)
(SELECT aaa,mes,suc,0,0, sum(importe_prv), sum(importe_suc),0,cia FROM vtadc.gc_factura   group by aaa,mes,suc)
on duplicate key update importe_prvs=values(importe_prvs),importe_sucs=values(importe_sucs);";
$this->db->query($s3);
$s4="insert into vtadc.gc_factura_suc(aaa, mes, suc, importe_prvo, importe_suco, importe_prvs, importe_sucs,importe_prvocosto,cia)
(SELECT aaa,mes,suc, sum(importe_prv), sum(importe_suc),0,0 ,sum(importe_prvcosto),cia FROM vtadc.gc_factura  group by aaa,mes,suc)
on duplicate key update importe_prvo=values(importe_prvo),importe_suco=values(importe_suco),importe_prvocosto=values(importe_prvocosto);";
$this->db->query($s4);
}












public function max_sucursal()
    {
$s="update vtadc.producto_mes_suc_gen a, almacen.max_sucursal b
set b.final=round((venta10+venta8+venta9)/case when
venta10=0 and venta8=0 and venta9>0 or
venta10=0 and venta8>0 and venta9=0 or
venta10>0 and venta8=0 and venta9=0
then 1
when
venta10=0 and venta8>0 and venta9>0 or
venta10>0 and venta8>0 and venta9=0 or
venta10>0 and venta8=0 and venta9>0
then 2
when
venta10>0 and venta8>0 and venta9>0
then 3
end)

  where a.suc=b.suc and a.sec=b.sec and (venta10+venta9+venta8)>0";
$this->db->query($s);
$s="update vtadc.producto_mes_suc_gen a, almacen.max_sucursal b
set b.final=venta10
where a.suc=b.suc and a.sec=b.sec and b.final=0";
$this->db->query($s);
$s="update vtadc.producto_mes_suc_gen a, almacen.max_sucursal b
set b.final=venta10
where a.suc=b.suc and a.sec=b.sec and b.final=0";
$this->db->query($s);
$s="update vtadc.producto_mes_suc_gen set final=0";
$this->db->query($s);

$s="update desarrollo.inv_cedis_sec1 a, almacen.max_sucursal b
set b.final=2
where a.sec=b.sec and final=0 and inv1>0";
$this->db->query($s);

$s="update vtadc.producto_mes_suc_gen a, almacen.max_sucursal b
set a.final=b.final where a.suc=b.suc and a.sec=b.sec ";
$this->db->query($s);

    }    

    public function max_por($clave)
    {
 $s="insert ignore into almacen.max_sucursal(sec, suc, susa, m2011, m2012, m2013, m2014, final, paquete, obser)
(select b.sec,a.suc,b.susa,0,0,0,0,3,0,'ASTA AGOTAR EXIS. SP'
from catalogo.sucursal a,
 catalogo.cat_almacen_clasifica b
where a.tlid=1 and a.suc>100 and a.suc<=2000 and a.tipo2<>'F'
and a.suc<>170
and a.suc<>171
and a.suc<>172
and a.suc<>173
and a.suc<>174
and a.suc<>175
and a.suc<>176
and a.suc<>177
and a.suc<>178
and a.suc<>179
and a.suc<>180
and a.suc<>181
and a.suc<>187
and a.dia<>' '
and b.sec in ($clave))";
 $this->db->query($s);   

$s="insert into vtadc.producto_mes_suc_gen(aaa, sec, suc, descripcion,
venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12,
costo, m2011, m2012, m2013, final)
(select year(now()),sec,suc,susa,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0, final from almacen.max_sucursal where sec in ($clave))
on duplicate key update final=values(final)
";
 $this->db->query($s);
} 
 
public function ver_inv()
    {
$s="select sem, aaa,mes,dia, date(concat(aaa,'-',mes,'-',dia))as fecha,sum(piezas)as piezas, count(suc)as numero,sum(importe)as importe  from oficinas.inv_mes_suc group by aaa,mes";
$q=$this->db->query($s);
return $q;
    }
public function ver_inv_suc()
    {
$s="select a.obser,date_add(b.fechai,interval +1 day)as fecha,a.suc,a.nombre,ifnull(sum(b.cantidad),0)as inv
from catalogo.sucursal a
left join desarrollo.inv b on b.suc=a.suc and b.mov=7 or b.suc=a.suc and b.mov=3
where a.suc>=100 and a.suc<=1999 and a.tlid=1
group by a.suc order by fecha";
$q=$this->db->query($s);
return $q;
    }
public function ver_inv_suc_his()
    {
$s="select sem,date(concat(aaa,'-',mes,'-',dia))as fecha,aaa,mes,dia,sum(piezas)as piezas, count(suc)as numero,sum(importe)as importe 
from oficinas.inv_mes_suc_his group by aaa,mes,sem
order by sem desc";
$q=$this->db->query($s);
return $q;
    }
    
    function cargaInvChetumal($a)
    {
        $this->db->insert_batch('oficinas.inv_seguros_lote', $a);
    }
    
    function invChetumal()
    {
        $this->db->delete('oficinas.inv_seguros_lote', array('suc' => 16000));
        $QUINTANA = $this->load->database('quintana', TRUE);
        
        $sql = "select 16000 as sucursal, trim(codbarras) as clave, trim(descripcion) as descripcion, a.cantidad, trim(lote) as lote, fechacaducidad, fechainv from almacen a
join lotes l on a.idlote = l.id
join articulos s on a.articulo = s.cvearticulo
where idalmacen = 350;";
        $query = $QUINTANA->query($sql);
        
        $a = array();
        foreach($query->result() as $row)
        {
            $b = array(
                'suc'=>$row->sucursal, 
                'clave'=>str_replace('.', '', $row->clave), 
                'lote'=>$row->lote, 
                'caducidad'=>$row->fechacaducidad, 
                'cantidad'=>$row->cantidad, 
                'codigo'=>0, 
                'descri'=>utf8_encode($row->descripcion), 
                'costo'=>0
                );
                
           array_push($a, $b);
        }
        
        $this->cargaInvChetumal($a);
    }
    
public function genera_inv($aaa,$mes,$dia,$sem)
{
    
    $this->invChetumal();
$x1="delete from oficinas.inv_mes_suc_det";$this->db->query($x1);
$x="delete from oficinas.inv_mes_suc";$this->db->query($x);
$x2="delete from oficinas.inv_seguros where suc in(6050,90002)";$this->db->query($x2);

$s="insert ignore into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(SELECT $aaa,$mes, a.cia,a.suc,a.sec,' ',a.codigo,' ',a.cantidad,
0,0,'FARMACIA',$dia
FROM desarrollo.inv a
left join catalogo.sucursal b on b.suc=a.suc
where a.mov=03 and a.cantidad>0 and a.suc>100 and tlid=1)";
$this->db->query($s);

$s="update metro.inventario_d a, catalogo.cat_mercadotecnia b
set a.costo=b.farmacia
 where a.codigo=b.codigo and a.codigo>0 and costo=0";
$this->db->query($s);

$s="update catalogo.cat_nuevo_general_cla b, metro.inventario_d a
set a.costo=b.cos
where a.sec_nueva=b.sec  and a.sec_nueva>0 and a.costo=0";
$this->db->query($s);


$s="load data infile 'c:/wamp/www/subir10/costop.txt'
replace into table catalogo.cat_costo_fac FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n' (prv, codigo, @descri, iva, far, cos, margen) set descri = CONVERT(CAST(@descri as BINARY) USING LATIN1);";        
$this->db->query($s);

$s="update  catalogo.cat_costo_fac  a, desarrollo.catbackoffice b
set a.descri=b.descripcion,
lin=substring(linea,1,1)
where a.codigo=b.ean";
$this->db->query($s);
$s="insert into catalogo.cat_costo_fac(prv, codigo, descri, iva, far, cos, margen, lin)
(select prv,codigo,susa2,case when lin in(2,5,9) then 1 else 0 end,round((costo*1.20),2),round((costo*1.20),2),0,lin
from catalogo.almacen where sec>0 and costo>0 and sec<=2000)
on duplicate key update cos=values(cos)";
$this->db->query($s);
$s="update oficinas.inv_mes_suc_det a, catalogo.cat_costo_fac b
set a.costo=b.cos,a.lin=b.lin
where a.codigo=b.codigo and a.aaa=$aaa and a.mes=$mes";
$this->db->query($s); 
$s="update oficinas.inv_mes_suc_det a, catalogo.cat_nadro b
set a.costo=b.costo
where a.codigo=b.codigo and a.aaa=$aaa and a.mes=$mes";
$this->db->query($s);       

$s="insert ignore into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(SELECT $aaa,$mes, a.cia,a.suc,a.sec,' ',a.codigo,b.susa1,a.cantidad,
case when a.cia=13 then round((b.costo*1.20),2)else round((b.costo*1.20),2) end,b.lin,'FARMACIA',$dia
FROM desarrollo.inv a
left join catalogo.almacen b on b.sec=a.sec
where tsuc<>'F' and a.mov=07 and a.cantidad>0 and a.suc<1600 group by a.suc,a.sec)";
$this->db->query($s);
$s="insert ignore into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(SELECT $aaa,$mes, a.cia,a.suc,a.sec,' ',a.codigo,b.susa1,a.cantidad,
case when a.cia=13 then round((b.costo*1.10),2)else round((b.costo*1.10),2) end,b.lin,'FARMACIA',$dia
FROM desarrollo.inv a
left join catalogo.almacen b on b.clabo=a.sec
where tsuc<>'F' and a.mov=07 and a.cantidad>0 and a.suc in(1601,1602,1603) group by a.suc,a.sec)";
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

//$s="insert into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
//(select $aaa,$mes,1,100,0,aa.clave,aa.codigo,aa.descri,sum(cantidad),aa.costo,1,'ALM ESPECIALIDAD',$dia
//from especialidad.inventario_d aa where aa.cantidad>0 group by aa.clave)";
//$this->db->query($s);

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
// costo,5,sum(cantidad/(case when contable_div >0 then contable_div else 1 end)),clave
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
$ss="delete from oficinas.inv_seguros where suc in (16000)";
$this->db->query($ss);
$ss="insert into oficinas.inv_seguros (aaa, mes, dia, suc, clave, descripcion, piezas, costo, lin, piezas_paquete, clave_sin_punto)
(select $aaa,$mes,$dia,suc,clave,descri,sum(cantidad),costo,lin,
SUM(case when div_conta>0 then cantidad/div_conta else cantidad end),clave 
from oficinas.inv_seguros_lote group by suc,clave)";
$this->db->query($ss);


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
 
$s="insert into oficinas.inv_mes_suc(aaa, mes, cia, suc, piezas, importe,dia,sem,tsuc)
(select a.aaa,a.mes,a.cia,a.suc,sum(a.piezas),sum(a.piezas*a.costo),a.dia,$sem,b.tipo2 
from oficinas.inv_mes_suc_det a
left join catalogo.sucursal b on b.suc=a.suc
where  aaa=$aaa and mes=$mes group by a.aaa,a.mes,a.suc)";
$this->db->query($s);

$s="insert into desarrollo.inv_cosvta(cia, suc, sem, aaaa, mes, lin, plaza, succ, importe,piezas)
(select a.cia,a.suc,$sem,aaa,mes,lin,b.plaza,b.suc_contable,
 sum(piezas*costo), sum(piezas)
from oficinas.inv_mes_suc_det a
left join catalogo.sucursal b on b.suc=a.suc
where a.costo>0 and a.aaa=$aaa and a.mes=$mes and a.dia=$dia and a.suc>=100
group by a.aaa,a.mes,a.dia,a.suc,a.lin
)";
//$this->db->query($s);

}
public function respalda_inv($aaa,$mes,$dia,$sem)
{
$s="insert into oficinas.inv_mes_suc_det_sem
(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo, dia,sem)
(select aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin, tipo, dia,$sem 
from  oficinas.inv_mes_suc_det where aaa=$aaa and mes=$mes and dia=$dia)";
$this->db->query($s);
$s1="insert into oficinas.inv_mes_suc_his(aaa, mes, cia, suc, piezas, importe, dia,sem,tsuc)
(select aaa, mes, cia, suc, piezas, importe, dia,sem,tsuc 
from oficinas.inv_mes_suc  where aaa=$aaa and mes=$mes and dia=$dia)";
$this->db->query($s1);

}

public function ver_ent_sal()
{
$s="select sem,fec1,fec2,sum(ent)as ent,sum(sal)as sal from oficinas.sem_ent_sal where suc>=100
group by sem,fec1";
$q=$this->db->query($s);
return $q;
}

public function p_ent_sal()
{
$s="select a.*,b.nombre as sucx from oficinas.sem_ent_sal a 
left join catalogo.sucursal b on b.suc=a.suc where a.suc>100 and a.suc<>1045 and a.suc<1603";
$q=$this->db->query($s);
return $q;
}

public function ent_sal($fec1,$fec2,$sem)
{
$aaa=substr($fec1,0,4);$mes=substr($fec1,5,2); $dia1=substr($fec1,8,2); $dia2=substr($fec2,8,2);
////////////////////////////////////////////////////////////////////entradas y salidas sucursales
$s="insert into oficinas.sem_ent_sal(suc, ent, sal, fec1, fec2, sem)
(
select suc,0,sum(can),'$fec1','$fec2',$sem
from vtadc.venta_detalle where fecha between '$fec1' and '$fec2'
 and descri not like'%tarjeta%' and descri not like '%recarga%'
and suc>100
 group by suc

)
on duplicate key update sal=values(sal)";
$this->db->query($s);
$s="insert into oficinas.sem_ent_sal(suc, ent, sal, fec1, fec2, sem)
(
SELECT suc,sum(can),0,'$fec1','$fec2',$sem
FROM vtadc.gc_compra_det where fecha between '$fec1' and '$fec2'
and suc>100
group by suc
)
on duplicate key update ent=values(ent)";
$this->db->query($s);
$s="update oficinas.sem_ent_sal a
set
ent_back=ifnull((SELECT sum(piezas)
frOM vtadc.gc_compra_det_back b where b.suc=a.suc and fecha between fec1 and fec2 group by suc)-
(SELECT sum(piezas)
frOM vtadc.gc_compra_dev_back b where b.suc=a.suc and fecha between fec1 and fec2 group by suc),0),

imp_ent_back=ifnull((SELECT sum(importe)
frOM vtadc.gc_compra_det_back b where b.suc=a.suc and fecha between fec1 and fec2 group by suc)-
(SELECT sum(importe)
frOM vtadc.gc_compra_dev_back b where b.suc=a.suc and fecha between fec1 and fec2 group by suc),0)
where a.fec1='$fec1' and a.fec2='$fec2'
";
$this->db->query($s);
//////////////////////////////////////7////////////////////////////////////////////////////////importe de entradas
$s="insert into oficinas.sem_ent_sal (suc, ent, sal, fec1, fec2, sem, imp_ent)
(select case
when suc=14000 or suc=14900 then 14000
when suc=17000 or suc=17900 then 17000
when suc=16000 or suc=16900 then 16000
else suc end as suca,
0,0,'$fec1','$fec2',0,
sum(importe_prvcosto) from vtadc.gc_factura
where fecha_prv>='$fec1' and fecha_prv<='$fec2'
and suc>=100
group by suc)
on duplicate key update imp_ent=values(imp_ent);";
$this->db->query($s);
if($mes==1){$aaas=$aaa-1;$mes=12;}else{$aaas=$aaa;$mess=$mes-1;}
$s="insert into sem_ent_sal (suc, ent, sal, fec1, fec2, sem, inv_ini, imp_inv_ini)
(select suc,0,0,'$fec1','$fec2',$sem,piezas,importe from oficinas.inv_mes_suc_his where aaa=$aaas and mes=$mess)
on duplicate key update inv_ini=values(inv_ini),imp_inv_ini=values(imp_inv_ini)";
$this->db->query($s);
$s="insert into sem_ent_sal (suc, ent, sal, fec1, fec2, sem, inv_fin, imp_inv_fin)
(select suc,0,0,'$fec1','$fec2',$sem,piezas,importe from oficinas.inv_mes_suc_his where aaa=$aaa and mes=$mes)
on duplicate key update inv_fin=values(inv_fin),imp_inv_fin=values(imp_inv_fin)";
$this->db->query($s);
if($sem==0){
$s="insert into sem_ent_sal(suc, ent, sal, fec1, fec2, sem, ent_back, imp_ent, imp_sal, imp_ent_back, imp_cred, imp_rec)
(select suc,0,0,'$fec1','$fec2',0,0,0,contado,0,credito,recarga from vtadc.gc_venta_mes where aaa=$aaa and mes=$mes)
on duplicate key update imp_sal=values(imp_sal),imp_cred=values(imp_cred),imp_rec=values(imp_rec)";
$this->db->query($s);
}














die();
//////////////////////////////////////////////////////////////// entradas y salidas almacen cedis 900
$s="insert into oficinas.sem_ent_sal (suc, ent,sal,imp_sal,fec1, fec2, sem)
(
select 900,
sum(ifnull((select sum(can) from desarrollo.compra_d b where fechai>='$fec1' and date_format(fechai,'%Y-%m-%d')<='$fec2'
),0)
+
ifnull((select sum(can) from desarrollo.traspaso_c x
left join desarrollo.traspaso_d b on b.id_cc=x.id
where x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and x.tipo='E' and tipo2='C'
),0)
+
ifnull((select sum(can) from desarrollo.devolucion_c x
left join desarrollo.devolucion_d b on b.id_cc=x.id
where x.tipo='E' and x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and mov in(1,2)
and tipo2='C' ),0))
as entradas,

sum(ifnull((select sum(sur) from desarrollo.pedidos x 
where date_format(x.fechasur,'%Y-%m-%d')>='$fec1' and date_format(x.fechasur,'%Y-%m-%d')<='$fec2' and sur>0
),0)
+
ifnull((select sum(can) from desarrollo.traspaso_c x
left join desarrollo.traspaso_d b on b.id_cc=x.id
where x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and x.tipo='S' and tipo2='C' ),0)
+
ifnull((select sum(can) from desarrollo.devolucion_c x
left join desarrollo.devolucion_d b on b.id_cc=x.id
where x.tipo='S' and x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and suc=100
and tipo2='C' ),0))as salidas,


sum(ifnull((select sum(sur*(costo*1.2)) from desarrollo.pedidos x 
where date_format(fechasur,'%Y-%m-%d')>='$fec1' and date_format(x.fechasur,'%Y-%m-%d')<='$fec2' and sur>0
),0)
+
ifnull((select sum(can*costo) from desarrollo.traspaso_c x
left join desarrollo.traspaso_d b on b.id_cc=x.id
where x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and x.tipo='S' and tipo2='C'
),0)
+
ifnull((select sum(can*(costo*1.2)) from desarrollo.devolucion_c x
left join desarrollo.devolucion_d b on b.id_cc=x.id
where x.tipo='S' and x.fechai>='$fec1' and date_format(x.fechai,'%Y-%m-%d')<='$fec2' and suc=100
and tipo2='C' ),0))as imp_sal,


'$fec1','$fec2',$sem
)
on duplicate key update ent=values(ent),sal=values(sal)";
$this->db->query($s);
//////////////////////////////////////////////////////////////// entradas y salidas controlados 1 equivale a la 100
$s="insert into oficinas.sem_ent_sal (suc, ent, sal,imp_sal, fec1, fec2, sem)
(
SELECT 1,
sum(ifnull((SELECT sum(cans) FROM almacen.control_comprac x
left join almacen.control_comprad b on b.folio=x.folio
where x.aaas=$aaa and x.mess=$mes and x.dias>=$dia1 and x.dias<=$dia2 
),0)
+
ifnull((SELECT sum(can) FROM almacen.control_dev x
left join almacen.control_devd b on b.folio=x.folio
where x.aaas=$aaa and x.mess=$mes and x.dias>=$dia1 and x.dias<=$dia2
and suc<>100),0))as entrada,

sum(ifnull((SELECT sum(cantidads) FROM almacen.salidas_c x 
where x.aaas=$aaa and x.mess=$mes and x.dias>=$dia1 and x.dias<=$dia2
 ),0)
+
ifnull((SELECT sum(can) FROM almacen.control_dev x
left join almacen.control_devd b on b.folio=x.folio
where x.aaas=$aaa and x.mess=$mes and x.dias>=$dia1 and x.dias<=$dia2 
and suc=100),0))as salida,

sum(ifnull((SELECT sum(cantidads*costo) FROM almacen.salidas_c x 
where x.aaas=$aaa and x.mess=$mes and x.dias>=$dia1 and x.dias<=$dia2
 ),0)
+
ifnull((SELECT sum(can*costo) FROM almacen.control_dev x
left join almacen.control_devd b on b.folio=x.folio
where x.aaas=$aaa and x.mess=$mes and x.dias>=$dia1 and x.dias<=$dia2 
and suc=100),0))as imp_sal,
'$fec1','$fec2',$sem

)
on duplicate key update ent=values(ent),sal=values(sal),imp_sal=values(imp_sal)";
$this->db->query($s);
//////////////////////////////////////////////////////////////// entradas y salidas especialidad 2 equivale a la 100
$s="insert into oficinas.sem_ent_sal (suc, ent, sal,imp_sal, fec1, fec2, sem)
(
SELECT 2,

sum(ifnull((select sum(can) from especialidad.compra_c x
left join especialidad.compra_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
),0)
+
ifnull((select sum(cans) from especialidad.devolucion_c x
left join especialidad.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.entra=100 and concepto<=2
),0))as entrada,

sum(ifnull((select sum(cans) from especialidad.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'),0)
+
ifnull((select sum(cans) from especialidad.devolucion_c x
left join especialidad.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' 
and x.sale=100
),0))as salida,

sum(ifnull((select sum(cans*costo) from especialidad.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'),0)
)as imp_sal,

'$fec1','$fec2',$sem
)
on duplicate key update ent=values(ent),sal=values(sal),imp_sal=values(imp_sal)";
$this->db->query($s);
//////////////////////////////////////////////////////////////// 3 metroo
$s="insert into oficinas.sem_ent_sal (suc, ent, sal,imp_sal, fec1, fec2, sem)
(
select 3,
sum(ifnull((select sum(can) from metro.compra_c x
left join metro.compra_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
),0)
+
ifnull((select sum(cans) from metro.traspaso_c x
left join metro.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.entra=100
),0)
+
ifnull((select sum(cans) from metro.devolucion_c x
left join metro.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.entra=100 and concepto<=2
),0))as entrada,

sum(ifnull((select sum(cans) from metro.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'),0)
+
ifnull((select sum(cans) from metro.traspaso_c x
left join metro.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=100
),0)
+
ifnull((select sum(cans) from metro.devolucion_c x
left join metro.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=100
),0))as salida,

sum(ifnull((select sum(cans*costo) from metro.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'),0)
+
ifnull((select sum(cans*costo) from metro.traspaso_c x
left join metro.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=100
),0)
+
ifnull((select sum(cans*costo) from metro.devolucion_c x
left join metro.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=100
),0))as imp_sal,

'$fec1','$fec2',$sem


)
on duplicate key update ent=values(ent),sal=values(sal)";
$this->db->query($s);
//////////////////////////////////////////////////////////////// agrupa 100

$sa="INSERT INTO oficinas.sem_ent_sal (suc, ent, sal, fec1, fec2, sem,imp_sal)
(SELECT 100, sum(ent), sum(sal), fec1, fec2, sem, sum(imp_sal) FROM oficinas.sem_ent_sal 
where suc<100 and fec1='$fec1' and fec2='$fec2' group by sem,fec1)
on duplicate key update sal=values(sal),ent=values(ent),imp_sal=values(imp_sal)";
$this->db->query($sa); 

//////////////////////////////////////////////////////////////// entradas y salidas farmabodega
$s="insert into oficinas.sem_ent_sal (suc, ent, sal, imp_sal, fec1, fec2, sem)
(
select 1600,
sum(ifnull((select sum(can) from farmabodega.compra_c x
left join farmabodega.compra_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
),0)
+
ifnull((select sum(cans) from farmabodega.traspaso_c x
left join farmabodega.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.entra=1600
),0)
+
ifnull((select sum(cans) from farmabodega.devolucion_c x
left join farmabodega.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.entra=1600 and concepto<=2
),0))as entrada,

sum(ifnull((select sum(cans) from farmabodega.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'),0)
+
ifnull((select sum(cans) from farmabodega.traspaso_c x
left join farmabodega.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=1600
),0)
+
ifnull((select sum(cans) from farmabodega.devolucion_c x
left join farmabodega.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=1600
),0))as salida,
sum(ifnull((select sum(cans*costo) from farmabodega.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'),0)
+
ifnull((select sum(cans*costo) from farmabodega.traspaso_c x
left join farmabodega.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=1600
),0)
+
ifnull((select sum(cans*costo) from farmabodega.devolucion_c x
left join farmabodega.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2'
and x.sale=1600
),0))as imp_sal,
'$fec1','$fec2',$sem


)
on duplicate key update ent=values(ent),sal=values(sal),imp_sal=values(imp_sal)";
$this->db->query($s);
//////////////////////////////////////////////////////////////// entradas y salidas segpop 90002
$s="insert into oficinas.sem_ent_sal (suc, ent, sal, fec1, fec2, sem)
(
select 90002,

sum(ifnull((select sum(can) from segpop.compra_c x
left join segpop.compra_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
group by b.clave),0)
+
ifnull((select sum(cans) from segpop.traspaso_c x
left join segpop.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.entra=90002  and b.activo=1
group by b.clave),0)
+
ifnull((select sum(cans) from segpop.devolucion_c x
left join segpop.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.entra=90002 and concepto<=2 and b.activo=1
group by b.clave),0))as entrada,

sum(ifnull((select sum(cans) from segpop.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and x.clave=a.clave),0)
+
ifnull((select sum(cans) from segpop.traspaso_c x
left join segpop.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.sale=90002  and b.activo=1
group by b.clave),0)
+
ifnull((select sum(cans) from segpop.devolucion_c x
left join segpop.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.sale=90002  and b.activo=1
group by b.clave),0))as salida,
'$fec1','$fec2',$sem
from catalogo.costos_gobierno a


)
on duplicate key update ent=values(ent),sal=values(sal)";
$this->db->query($s);
//////////////////////////////////////////////////////////////// entradas y salidas trasimeno 140 6050
$s="insert into oficinas.sem_ent_sal (suc, ent, sal, fec1, fec2, sem)
(
select 6050,

sum(ifnull((select sum(can) from trasimeno140.compra_c x
left join trasimeno140.compra_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
group by b.clave),0)
+
ifnull((select sum(cans) from trasimeno140.traspaso_c x
left join trasimeno140.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.entra=6050  and b.activo=1
group by b.clave),0)
+
ifnull((select sum(cans) from trasimeno140.devolucion_c x
left join trasimeno140.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.entra=6050 and concepto<=2 and b.activo=1
group by b.clave),0))as entrada,

sum(ifnull((select sum(cans) from trasimeno140.surtido_d x
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and x.clave=a.clave),0)
+
ifnull((select sum(cans) from trasimeno140.traspaso_c x
left join trasimeno140.traspaso_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.sale=6050  and b.activo=1
group by b.clave),0)
+
ifnull((select sum(cans) from trasimeno140.devolucion_c x
left join trasimeno140.devolucion_d b on b.id_cc=x.id
where x.fecha>='$fec1' and date_format(x.fecha,'%Y-%m-%d')<='$fec2' and b.clave=a.clave
and x.sale=6050  and b.activo=1
group by b.clave),0))as salida,
'$fec1','$fec2',$sem
from catalogo.costos_gobierno a
)
on duplicate key update ent=values(ent),sal=values(sal)";
$this->db->query($s);

//////////////////////////////////////7////////////////////////////////////////////////////////salidas aguascalientes
$s="insert into oficinas.sem_ent_sal (suc, ent, sal, fec1, fec2, sem)
(
SELECT 14000,sum(nueva -vieja),0,'$fec1','$fec2',$sem
FROM fenixsp.kardex k
INNER JOIN fenixsp.productos p on k.p_id = p.id
where modiicada between '$fec1 00:00:00' and '$fec2 23:59:59'
and (tipo <> 3 and subtipo <> 300) and tipo = 1
)
on duplicate key update ent=values(ent)";
$this->db->query($s);
//////////////////////////////////////7////////////////////////////////////////////////////////entradas aguascalientes
$s="insert into oficinas.sem_ent_sal (suc, ent, sal, fec1, fec2, sem)
(
SELECT 14000, 0,sum(vieja - nueva) as piezas,'$fec1','$fec2',$sem
FROM fenixsp.kardex k
INNER JOIN fenixsp.productos p on k.p_id = p.id
where modiicada between '$fec1 00:00:00' and '$fec2 23:59:59'
and (tipo <> 3 and subtipo <> 300) and tipo = 2
)
on duplicate key update sal=values(sal)";
$this->db->query($s);

  
}

public function desplazamientos()
{
$s="load data infile 'c:/wamp/www/subir10/seg.prn'
replace into table vtadc.venta_segpop FIELDS TERMINATED BY '||'
LINES TERMINATED BY '\r\n' (aaa, mes,suc,clave,codigo, @descri, piezas,importe)
set descri = CONVERT(CAST(@descri as BINARY) USING LATIN1),
piezas=(piezas),importe=(importe),
su_fenix=case
 when suc=20000 then 187
 when suc=19020 then 179
 when suc=19021 then 176
 when suc=19022 then 180
else
suc
end"; 
$this->db->query($s); 


}

public function elimina_suc($sucx)
{
$s="delete from desarrollo.inv where suc=$sucx"; 


$this->db->query($s); 
//echo $this->db->last_query();
//echo die;

}

public function sube_suc()
{
$s="load data infile 'c:/wamp/www/subir10/inventarios.prn'
replace into table desarrollo.inv FIELDS TERMINATED BY '||'
LINES TERMINATED BY '\r\n' (suc, codigo, cantidad, fechai, cia)
set tsuc='F', mov=3, sec=0"; 

$this->db->query($s); 
//echo $this->db->last_query();
//echo die;

}



    function bansefiDesplazamiento($perini, $perfin)
    {
        $sql = "Delete from vtadc.desplazamiento_credito_paso;";
        $this->db->query($sql);
        
        $BANSEFI = $this->load->database('bansefi', TRUE);
        
        $sql = "select 2 as cliente, extract(year from fecha)as aaa, extract(month from fecha)as mes, trim(cvearticulo) as ean, trim(descripcion) as descripcion, sum(cantidadsurtida) as cantidad, sum(saldo) as saldo
from receta where fecha between ? and ? and status = 't' and cvearticulo <> ''
group by cliente, aaa, mes, ean, descripcion";
        $query = $BANSEFI->query($sql, array($perini, $perfin));
        
        $a = array();
        
        foreach($query->result() as $row)
        {
            $b = array(
                'cliente'       => $row->cliente, 
                'aaa'           => $row->aaa, 
                'mes'           => $row->mes, 
                'ean'           => $row->ean, 
                'descripcion'   => utf8_encode($row->descripcion), 
                'cantidad'      => $row->cantidad,
                'saldo'         => $row->saldo
            );
            
            array_push($a, $b);
        }
        
        $this->db->insert_batch('vtadc.desplazamiento_credito_paso', $a);

        $sql = "SELECT cliente, aaa, mes FROM vtadc.desplazamiento_credito_paso d group by cliente, aaa, mes;";
        $query = $this->db->query($sql);
        
        foreach($query->result() as $row)
        {
            $this->db->delete('vtadc.desplazamiento_credito', array('cliente' => $row->cliente, 'aaa' => $row->aaa, 'mes' => $row->mes));
        }

        $sql = "insert into vtadc.desplazamiento_credito (SELECT cliente, aaa, mes, ean, descripcion, sum(cantidad), sum(saldo) FROM vtadc.desplazamiento_credito_paso d group by cliente, aaa, mes, ean);";
        $this->db->query($sql);
    }

    function metroDesplazamiento($perini, $perfin)
    {
        $sql = "Delete from vtadc.desplazamiento_credito_paso;";
        $this->db->query($sql);
        
        $METRO = $this->load->database('metro', TRUE);
        
        $sql = "select 1 as cliente, extract(year from fecha)as aaa, extract(month from fecha)as mes, trim(cvearticulo) as ean, trim(descripcion) as descripcion, sum(cantidadsurtida) as cantidad, sum(saldo) as saldo
from receta where fecha between ? and ? and status = 't' and cvearticulo <> ''
group by cliente, aaa, mes, ean, descripcion";
        $query = $METRO->query($sql, array($perini, $perfin));
        
        $a = array();
        
        foreach($query->result() as $row)
        {
            $b = array(
                'cliente'       => $row->cliente, 
                'aaa'           => $row->aaa, 
                'mes'           => $row->mes, 
                'ean'           => $row->ean, 
                'descripcion'   => utf8_encode($row->descripcion), 
                'cantidad'      => $row->cantidad,
                'saldo'         => $row->saldo
            );
            
            array_push($a, $b);
        }
        
        $this->db->insert_batch('vtadc.desplazamiento_credito_paso', $a);

        $sql = "SELECT cliente, aaa, mes FROM vtadc.desplazamiento_credito_paso d group by cliente, aaa, mes;";
        $query = $this->db->query($sql);
        
        foreach($query->result() as $row)
        {
            $this->db->delete('vtadc.desplazamiento_credito', array('cliente' => $row->cliente, 'aaa' => $row->aaa, 'mes' => $row->mes));
        }

        $sql = "insert into vtadc.desplazamiento_credito (SELECT cliente, aaa, mes, ean, descripcion, sum(cantidad), sum(saldo) FROM vtadc.desplazamiento_credito_paso d group by cliente, aaa, mes, ean);";
        $this->db->query($sql);
    }


////////////////////////////////////borrarlo
 function prueba_ped($id_plaza)
 {
    $s="SELECT b.nombre,a.*
FROM compras.pre_pedido_f a
join catalogo.sucursal b on a.suc=b.suc
where activo=0 and superv=$id_plaza";
    $q=$this->db->query($s);
    return $q;
 }
function prueba_ped_det($id_cc)
 {
    $s="SELECT * FROM compras.pre_pedido_fenix where id_cc=$id_cc";
    $q=$this->db->query($s);
    return $q;
 }

}
