<?php
class backoffice_model_ventas extends CI_Model
{
   function __construct()
    {
        parent::__construct();
    }

 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //proceso_ventas_llegan_archivos
  //venta_mes
  
  //inserta_cortes_caja
  

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
    
function proceso_ventas_llegan_archivos($aaa,$mes)
{
$sr="LOAD DATA INFILE '/home/central/backoffice/ven1.txt' 
replace into table vtadc.vta_backoffice FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(suc, fecha, tic, cod, @des, @lin, cann, cancelado, cant, imp, vtatip, nomina, @nom,descu,iva,precio_uni,por_des,cos)
set des = CONVERT(CAST(@des as BINARY) USING LATIN1),nom = CONVERT(CAST(@nom as BINARY) USING LATIN1),
lin = CONVERT(CAST(@lin as BINARY) USING LATIN1)";
//$this->db->query($sr);
$sr="LOAD DATA INFILE '/home/central/backoffice/ven2.txt' 
replace into table vtadc.vta_backoffice FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(suc, fecha, tic, cod, @des, @lin, cann, cancelado, cant, imp, vtatip, nomina, @nom,descu,iva,precio_uni,por_des,cos)
set des = CONVERT(CAST(@des as BINARY) USING LATIN1),nom = CONVERT(CAST(@nom as BINARY) USING LATIN1),
lin = CONVERT(CAST(@lin as BINARY) USING LATIN1)";
//$this->db->query($sr);
$cas="select *from catalogo.sucursal where back>0 and tlid=1 and fecha_act='0000-00-00'";
$q4=$this->db->query($cas);
 foreach($q4->result()as $r4)
{
if(file_exists("g:/backoffice/ven".$r4->suc.".txt")){
$this->transferFile('g:/backoffice/ven'.$r4->suc.'.txt','ven'.$r4->suc.'.txt');
$sr="LOAD DATA INFILE '/home/central/backoffice/ven".$r4->suc.".txt' 
replace into table vtadc.vta_backoffice FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(suc, fecha, tic, cod, @des, @lin, cann, cancelado, cant, imp, vtatip, nomina, @nom,descu,iva,precio_uni,por_des,cos,rel)
set des = CONVERT(CAST(@des as BINARY) USING LATIN1),nom = CONVERT(CAST(@nom as BINARY) USING LATIN1),
lin = CONVERT(CAST(@lin as BINARY) USING LATIN1)";
$this->db->query($sr);
}

if(file_exists("g:/backoffice/cor".$r4->suc.".txt")){
$this->transferFile('g:/backoffice/cor'.$r4->suc.'.txt','cor'.$r4->suc.'.txt');
if($r4->back==2){
$mm2="load data infile '/home/central/backoffice/cor".$r4->suc.".txt' replace into table vtadc.vta_backoffice_cortesc FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(fecha, suc, caja, fol, @nomina, @nombre, pago, arqueocaja, cortecaja, turno,dolar)
set nombre = CONVERT(CAST(@nombre as BINARY) USING LATIN1),nomina =replace(@nomina,'C','')";
$this->db->query($mm2);
}
if($r4->back==1){
$mm1="load data infile '/home/central/backoffice/cor".$r4->suc.".txt' replace into table vtadc.vta_backoffice_cortesc FIELDS TERMINATED BY '||' LINES TERMINATED BY '\r\n'
(fecha, suc, caja, @nomina, @nombre, pago, arqueocaja, cortecaja,fol)
set nombre = CONVERT(CAST(@nombre as BINARY) USING LATIN1),nomina =replace(@nomina,'C','')";
$this->db->query($mm1);
}}

}}     
function venta_mes($aaa,$mes)
{
 $ven='venta'.$mes;
 $imp='importe'.$mes;

$s="insert ignore into vtadc.vta_backoffice_credito(suc, fecha, tic, cod, des, lin, cann, cancelado, cant, imp, vtatip, nomina, nom,descu,iva,precio_uni,por_des,cos)
(select suc, fecha, tic, cod, des, lin, cann, cancelado, cant, imp, vtatip, nomina, nom ,descu,iva,precio_uni,por_des,cos
from vtadc.vta_backoffice where vtatip>1 and fecha>=date_sub(date(now()),interval 15 day))
on duplicate key update
imp=values(imp),descu=values(descu),iva=values(iva),precio_uni=values(precio_uni),por_des=values(por_des)
";
$q=$this->db->query($s);
$s1="insert into vtadc.venta_detalle (suc, fecha, tiket, codigo, descri, can, vta, des, importe, iva,  nombre, dire, cedula, tarjeta, tipo,tventa,cancela,cos)
(select suc, fecha, tic, cod, des, cann, round((imp/cann),2),0, imp,0,'','',0,0,0,vtatip,cancelado,cos from vtadc.vta_backoffice where fecha>=date_sub(date(now()),interval 20 day))
on duplicate key update can=values(can),importe=values(importe),vta=values(vta),tventa=values(tventa),cancela=values(cancela)";
$this->db->query($s1);
$x1="insert into vtadc.venta_ctl(fecha, suc, can, imp )
(select fecha, suc, sum(can), sum(importe) from vtadc.venta_detalle where fecha>=date_sub(date(now()),interval 15 day) and can>0
group by fecha,suc)
on duplicate key update can=values(can),imp=values(imp)";
$this->db->query($x1);

$sjorge="insert ignore into vtadc.venta_detalle_nat
(suc, fecha, tiket, codigo, descri, can, vta, des, importe, iva, nombre, dire, cedula, tarjeta, tipo, tventa, consecu, nomina, cancela, sec)
(SELECT
v.suc, v.fecha, v.tiket, v.codigo, v.descri, v.can, v.vta, v.des, v.importe, v.iva,  v.nombre, v.dire, v.cedula, v.tarjeta, v.tipo, v.tventa, v.consecu, v.nomina, v.cancela, b.sec
FROM vtadc.venta_detalle v
left join catalogo.almacen a on v.codigo=a.codigo
left join catalogo.cat_naturistas b on b.codigo=a.codigo
left join catalogo.sucursal c on c.suc=v.suc
where fecha>=date_sub(date(now()),interval 15 day)  and c.tipo3='DA'
and b.sec is not null)";
$this->db->query($sjorge);

$sjorge1="update
vtadc.venta_detalle_nat a, vtadc.cancelados b
set a.cancela=b.pieza, a.imp_cancela=b.impor
where a.suc=b.suc and a.fecha=b.fecha and a.tiket=b.tiket and a.codigo=b.codigo and a.fecha>=date_sub(date(now()),interval 20 day)
";
$this->db->query($sjorge1);

  
   
 $a1="insert into vtadc.producto_mes_suc (aaa, codigo, lin, sublin, suc, descripcion, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12, sec)
(SELECT year(fecha),  codigo, 0, 0,suc,descri,' ',
case when month(fecha)=1 then (sum(can))else 0 end,case when month(fecha)=2 then (sum(can))else 0 end,
case when month(fecha)=3 then (sum(can))else 0 end,case when month(fecha)=4 then (sum(can))else 0 end,
case when month(fecha)=5 then (sum(can))else 0 end,case when month(fecha)=6 then (sum(can))else 0 end,
case when month(fecha)=7 then (sum(can))else 0 end,case when month(fecha)=8 then (sum(can))else 0 end,
case when month(fecha)=9 then (sum(can))else 0 end,case when month(fecha)=10 then (sum(can))else 0 end,
case when month(fecha)=11 then (sum(can))else 0 end,case when month(fecha)=12 then (sum(can))else 0 end,
case when month(fecha)=1 then (sum(importe))else 0 end,case when month(fecha)=2 then (sum(importe))else 0 end,
case when month(fecha)=3 then (sum(importe))else 0 end,case when month(fecha)=4 then (sum(importe))else 0 end,
case when month(fecha)=5 then (sum(importe))else 0 end,case when month(fecha)=6 then (sum(importe))else 0 end,
case when month(fecha)=7 then (sum(importe))else 0 end,case when month(fecha)=8 then (sum(importe))else 0 end,
case when month(fecha)=9 then (sum(importe))else 0 end,case when month(fecha)=10 then (sum(importe))else 0 end,
case when month(fecha)=11 then (sum(importe))else 0 end,case when month(fecha)=12 then (sum(importe))else 0 end,
0
from vtadc.venta_detalle where year(fecha)=$aaa and month(fecha)=$mes  group by year(fecha),month(fecha),suc,codigo)
on duplicate key update $ven=values($ven),$imp=values($imp),lab=values(lab),descripcion=values(descripcion)";
$this->db->query($a1);

$a2="insert into vtadc.a_producto_mes_suc_contado
(aaa, suc, codigo, sec, lin, sublin, descripcion,
venta1, importe1, venta2,importe2, venta3,importe3, venta4,importe4, venta5,importe5, venta6, importe6,
venta7, importe7, venta8, importe8, importe9, venta9, venta10, importe10, venta11, importe11, venta12,importe12)
(select year(fecha), suc, cod, 0,replace(substr(lin,1,2),'-',''), replace(substr(lin,3,2),'-',''), des,
case when month(fecha)=1 then (sum(cant))else 0 end,case when month(fecha)=1 then (sum(imp))else 0 end,
case when month(fecha)=2 then (sum(cant))else 0 end,case when month(fecha)=2 then (sum(imp))else 0 end,
case when month(fecha)=3 then (sum(cant))else 0 end,case when month(fecha)=3 then (sum(imp))else 0 end,
case when month(fecha)=4 then (sum(cant))else 0 end,case when month(fecha)=4 then (sum(imp))else 0 end,
case when month(fecha)=5 then (sum(cant))else 0 end,case when month(fecha)=5 then (sum(imp))else 0 end,
case when month(fecha)=6 then (sum(cant))else 0 end,case when month(fecha)=6 then (sum(imp))else 0 end,
case when month(fecha)=7 then (sum(cant))else 0 end,case when month(fecha)=7 then (sum(imp))else 0 end,
case when month(fecha)=8 then (sum(cant))else 0 end,case when month(fecha)=8 then (sum(imp))else 0 end,
case when month(fecha)=9 then (sum(cant))else 0 end,case when month(fecha)=9 then (sum(imp))else 0 end,
case when month(fecha)=10 then (sum(cant))else 0 end,case when month(fecha)=10 then (sum(imp))else 0 end,
case when month(fecha)=11 then (sum(cant))else 0 end,case when month(fecha)=11 then (sum(imp))else 0 end,
case when month(fecha)=12 then (sum(cant))else 0 end,case when month(fecha)=12 then (sum(imp))else 0 end

from vtadc.vta_backoffice a where year(fecha)=$aaa and month(fecha)=$mes and a.cod>0 and vtatip=1
group by a.suc,a.cod)
on duplicate key update $ven=values($ven), $imp=values($imp)";
$this->db->query($a2);
$b="update vtadc.a_producto_mes_suc_contado a,catalogo.cod_rel b
set rel1=cod_rel1, rel2=cod_Rel2
where a.codigo=b.ean and (rel1=0 or rel2=0)";
$this->db->query($b);

$b1="insert into vtadc.a_prox_det
(aaa,id_prox, nlab,suc, inv, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12)
(SELECT aaa,a.id,nlab,b.suc,0, sum(venta1), sum(venta2), sum(venta3), sum(venta4), sum(venta5), sum(venta6), sum(venta7), sum(venta8), sum(venta9), sum(venta10), sum(venta11), sum(venta12)
FROM vtadc.a_prox a,vtadc.a_producto_mes_suc_contado b
where a.rel1=b.rel1 and a.rel2=b.rel2 and (a.rel1>0 or a.rel2>0)
group by b.suc,a.codigo)
on duplicate key update
venta1=values(venta1), venta2=values(venta2), venta3=values(venta3),
venta4=values(venta4), venta5=values(venta5), venta6=values(venta6),
venta7=values(venta7), venta8=values(venta8), venta9=values(venta9),
venta10=values(venta10), venta11=values(venta11), venta12=values(venta12)";
$this->db->query($b1);
$sz2="update vtadc.producto_mes_suc a, catalogo.almacen b
set a.sec=b.sec,a.costo=b.costo
where a.codigo=b.codigo and a.sec=0 and b.sec>0 and b.sec<=2000 or
 a.codigo=b.codigo and a.sec=0 and b.sec>3000 and b.sec<=3999";
$this->db->query($sz2);

$sz2x="insert into vtadc.producto_mes(
aaa, codigo, lin, sublin, descripcion, lab, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9,
venta10, venta11, venta12, importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9,
importe10, importe11, importe12, inv, sec)
(select aaa, codigo, lin, sublin, descripcion, lab,
sum(venta1),sum(venta2),
sum(venta3),sum(venta4),
sum(venta5),sum(venta6),
sum(venta7),sum(venta8),
sum(venta9),sum(venta10),
sum(venta11),sum(venta12),
sum(importe1),sum(importe2),
sum(importe3),sum(importe4),
sum(importe5),sum(importe6),
sum(importe7),sum(importe8),
sum(importe9),sum(importe10),
sum(importe11),sum(importe12),
0,sec
from vtadc.producto_mes_suc group by aaa,sec,codigo)
on duplicate key update
venta1=values(venta1),importe1=values(importe1),
venta2=values(venta2),importe2=values(importe2),
venta3=values(venta3),importe3=values(importe3),
venta4=values(venta4),importe4=values(importe4),
venta5=values(venta5),importe5=values(importe5),
venta6=values(venta6),importe6=values(importe6),
venta7=values(venta7),importe7=values(importe7),
venta8=values(venta8),importe8=values(importe8),
venta9=values(venta9),importe9=values(importe9),
venta10=values(venta10),importe10=values(importe10),
venta11=values(venta11),importe11=values(importe11),
venta12=values(venta12),importe12=values(importe12)
";
$this->db->query($sz2x);
$lidia="insert into vtadc.producto_mes_suc_gen( aaa, sec, suc, descripcion,
venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, 
importe11, importe12,tipo3)
(select a.aaa,a.sec,a.suc,a.descripcion,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12,
sum(importe1),
sum(importe2),
sum(importe3),
sum(importe4),
sum(importe5),
sum(importe6),
sum(importe7),
sum(importe8),
sum(importe9),
sum(importe10),
sum(importe11),
sum(importe12),tipo3
from  vtadc.producto_mes_suc a
join catalogo.sucursal b on b.suc=a.suc
where sec>0 and sec<=2000  and aaa=year(now()) and a.suc>100 and a.suc<=2899
or
sec>=3000 and sec<=3999 and aaa=year(now()) and a.suc>100 and a.suc<=2899
group by suc,sec) 
on duplicate key update
venta1=values(venta1),importe1=values(importe1),
venta2=values(venta2),importe2=values(importe2),
venta3=values(venta3),importe3=values(importe3),
venta4=values(venta4),importe4=values(importe4),
venta5=values(venta5),importe5=values(importe5),
venta6=values(venta6),importe6=values(importe6),
venta7=values(venta7),importe7=values(importe7),
venta8=values(venta8),importe8=values(importe8),
venta9=values(venta9),importe9=values(importe9),
venta10=values(venta10),importe10=values(importe10),
venta11=values(venta11),importe11=values(importe11),
venta12=values(venta12),importe12=values(importe12),
tipo3=values(tipo3)
";
$this->db->query($lidia);
$lidia_sec="insert into vtadc.producto_sec(
aaa, sec, descripcion,
venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12,
a1, a2, a3, a4, a5, a6, a7, a8, a9, a10, a11, a12,
aa1, aa2, aa3, aa4, aa5, aa6, aa7, aa8, aa9, aa10, aa11, aa12)
(select a.aaa, sec, descripcion,

sum(venta1), sum(venta2), sum(venta3), sum(venta4), sum(venta5), sum(venta6),
sum(venta7),sum(venta8), sum(venta9), sum(venta10), sum(venta11), sum(venta12),
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0

from vtadc.producto_mes_suc_gen a
left join catalogo.sucursal b on b.suc=a.suc
where aaa=year(date(now())) and a.suc>100 and a.suc<2899
and b.tlid=1 and b.tipo3 in('DA')
 group by sec)
on duplicate key update
venta1=values(venta1),
venta2=values(venta2),
venta3=values(venta3),
venta4=values(venta4),
venta5=values(venta5),
venta6=values(venta6),
venta7=values(venta7),
venta8=values(venta8),
venta9=values(venta9),
venta10=values(venta10),
venta11=values(venta11),
venta12=values(venta12)";
$this->db->query($lidia_sec);
$lidia1="update vtadc.producto_mes_suc_gen a, catalogo.almacen b
set a.costo=b.costo
where a.sec=b.sec and b.sec>0 and b.sec<=2000 and tsec<>'M'
or a.sec=b.sec and b.sec>3000 and b.sec<=3999 and tsec<>'M' ";
$this->db->query($lidia1);
}


function inserta_cortes_caja($aaa)
{
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

$s1="select *from vtadc.vta_backoffice_cortesc where fecha>=subdate(date(now()),30) and turno>0
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
$x2="update vtadc.venta_ctl a, desarrollo.cortes_c b, desarrollo.cortes_d_c01_c40 c
set cortes=corregido
where a.fecha>=b.fechacorte and b.id=c.id_cc and  a.suc=b.suc and a.fecha>=date_sub(date(now()),interval 15 day)";
$this->db->query($x2);
$x3="update vtadc.venta_ctl a
set a.tic=ifnull((select count(tiket) from vtadc.venta_detalle_tic_dia x where x.suc=a.suc and x.fecha=a.fecha group by suc,fecha),0)
where fecha>=(subdate(date(now()),interval 15 day))";
$this->db->query($x3);
$x3con="update vtadc.venta_ctl a
set a.tic_contado=ifnull((select count(tiket) from vtadc.venta_detalle_tic_dia_contado x where x.suc=a.suc and x.fecha=a.fecha group by suc,fecha),0)
where fecha>=(subdate(date(now()),interval 15 day))";
$this->db->query($x3con);
$cortes="insert into cortes_resp.cortes_venta_diaria(mes, dia, suc, a2012, a2013, a2014, a2015, a2016, prome)
(select month(a.fechacorte),day(a.fechacorte),a.suc,0,0,0,0,ifnull(sum(d.siniva),0),0
from desarrollo.cortes_c a
left join desarrollo.cortes_d d on d.id_cc=a.id and d.clave1 not in(0,20,30,40,49)
where a.fechacorte>=subdate(date(now()),20) and year(fechacorte)=$aaa
group by a.fechacorte,a.suc)
on duplicate key update a2016=values(a2016)";
$this->db->query($cortes);
}
function cortes_ctl_fin($aaa,$mes)
{
    $genera=" insert into vtadc.gc_venta_mes(aaa, mes, tipo2, suc, recarga, credito, contado, num_dias, cia)
(
select $aaa,$mes,x.tipo2,x.suc,
ifnull((select sum(d.siniva)
from desarrollo.cortes_c a
left join desarrollo.cortes_d d on d.id_cc=a.id and d.clave1  in(20)
where year(a.fechacorte)=$aaa and month(a.fechacorte)=$mes and a.suc=x.suc
),0),
ifnull((select sum(d.siniva)
from desarrollo.cortes_c a
left join desarrollo.cortes_d d on d.id_cc=a.id and d.clave1  in(30,40)
where year(a.fechacorte)=$aaa and month(a.fechacorte)=$mes and a.suc=x.suc
),0),
ifnull((select sum(d.siniva)
from desarrollo.cortes_c a
left join desarrollo.cortes_d d on d.id_cc=a.id and d.clave1 not in(20,30,40)
where year(a.fechacorte)=$aaa and month(a.fechacorte)=$mes and a.suc=x.suc
),0),
ifnull((select count(*) from desarrollo.cortes_c a
where year(a.fechacorte)=$aaa and month(a.fechacorte)=$mes and a.suc=x.suc),0)
,cia
from catalogo.sucursal x
where tlid=1 and x.suc>100 and x.suc<=1999
or
(select count(*) from desarrollo.cortes_c a
where year(a.fechacorte)=$aaa and month(a.fechacorte)=$mes and a.suc=x.suc)
)
on duplicate key update
recarga=values(recarga), credito=values(credito), contado=values(contado),num_dias=values(num_dias)
";
$this->db->query($genera);
}
//////////////////////////////////////////////////////
//////////////////////////////////////////////////////grabar CONCENTRADOS EN DESPLAZAMIENTOS ESPECIFICOS DE DIRECCION
function viejo_proceso()
{
$sa1="insert into vtadc.n_prox_det(aaa, codigo, lab,nlab, suc,fami,
venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
venta_act_11, venta_act_12,
venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
venta_ant_11, venta_ant_12,

venta_actt_1, venta_actt_2, venta_actt_3, venta_actt_4, venta_actt_5,
venta_actt_6, venta_actt_7, venta_actt_8, venta_actt_9, venta_actt_10,
venta_actt_11, venta_actt_12,
venta_antt_1, venta_antt_2, venta_antt_3, venta_antt_4, venta_antt_5,
venta_antt_6, venta_antt_7, venta_antt_8, venta_antt_9, venta_antt_10,
venta_antt_11, venta_antt_12,inv)

(SELECT a.aaa, a.codigo, a.lab,a.nlab,c.suc,a.fami,

b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
b.venta11,b.venta12,

0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
0
from vtadc.n_prox a
left join vtadc.producto_mes_suc b on a.codigo=b.codigo
left join catalogo.suc_fenix c on c.suc=b.suc
where c.suc>0 and c.filtro=2)
on duplicate key update
venta_act_1=values(venta_act_1),
venta_act_2=values(venta_act_2),
venta_act_3=values(venta_act_3),
venta_act_4=values(venta_act_4),
venta_act_5=values(venta_act_5),
venta_act_6=values(venta_act_6),
venta_act_7=values(venta_act_7),
venta_act_8=values(venta_act_8),
venta_act_9=values(venta_act_9),
venta_act_10=values(venta_act_10),
venta_act_11=values(venta_act_11),
venta_act_12=values(venta_act_12);
"; $this->db->query($sa1);
$sa1t="insert into vtadc.n_prox_det(aaa, codigo, lab,nlab, suc,fami,
venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
venta_act_11, venta_act_12,
venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
venta_ant_11, venta_ant_12,

venta_actt_1, venta_actt_2, venta_actt_3, venta_actt_4, venta_actt_5,
venta_actt_6, venta_actt_7, venta_actt_8, venta_actt_9, venta_actt_10,
venta_actt_11, venta_actt_12,
venta_antt_1, venta_antt_2, venta_antt_3, venta_antt_4, venta_antt_5,
venta_antt_6, venta_antt_7, venta_antt_8, venta_antt_9, venta_antt_10,
venta_antt_11, venta_antt_12,inv)

(SELECT a.aaa, a.codigo, a.lab,a.nlab,b.suc,a.fami,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,

b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
b.venta11,b.venta12,
0,0,0,0,0,0,0,0,0,0,0,0,
0
from vtadc.n_prox a
join vtadc.producto_mes_suc b on a.codigo=b.codigo and a.aaa=b.aaa

where a.aaa=year(date(now())) )
on duplicate key update
venta_actt_1=values(venta_actt_1),
venta_actt_2=values(venta_actt_2),
venta_actt_3=values(venta_actt_3),
venta_actt_4=values(venta_actt_4),
venta_actt_5=values(venta_actt_5),
venta_actt_6=values(venta_actt_6),
venta_actt_7=values(venta_actt_7),
venta_actt_8=values(venta_actt_8),
venta_actt_9=values(venta_actt_9),
venta_actt_10=values(venta_actt_10),
venta_actt_11=values(venta_actt_11),
venta_actt_12=values(venta_actt_12);
"; $this->db->query($sa1t);
///////////////////////////////////////////////////////////////////////////////

$sa2="insert into vtadc.n_prox_det(aaa, codigo, lab,nlab, suc,fami,
venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
venta_act_11, venta_act_12,
venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
venta_ant_11, venta_ant_12,
venta_actt_1, venta_actt_2, venta_actt_3, venta_actt_4, venta_actt_5,
venta_actt_6, venta_actt_7, venta_actt_8, venta_actt_9, venta_actt_10,
venta_actt_11, venta_actt_12,
venta_antt_1, venta_antt_2, venta_antt_3, venta_antt_4, venta_antt_5,
venta_antt_6, venta_antt_7, venta_antt_8, venta_antt_9, venta_antt_10,
venta_antt_11, venta_antt_12,
inv)

(SELECT a.aaa, a.codigo, a.lab,a.nlab,c.suc,a.fami,
0,0,0,0,0,0,0,0,0,0,0,0,
b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
b.venta11,b.venta12,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
0
from vtadc.n_prox a
left join vtadc.producto_mes_suc14 b on a.codigo=b.codigo
left join catalogo.suc_fenix c on c.suc=b.suc
where c.suc>0 and c.filtro=2)
on duplicate key update
venta_ant_1=values(venta_ant_1),
venta_ant_2=values(venta_ant_2),
venta_ant_3=values(venta_ant_3),
venta_ant_4=values(venta_ant_4),
venta_ant_5=values(venta_ant_5),
venta_ant_6=values(venta_ant_6),
venta_ant_7=values(venta_ant_7),
venta_ant_8=values(venta_ant_8),
venta_ant_9=values(venta_ant_9),
venta_ant_10=values(venta_ant_10),
venta_ant_11=values(venta_ant_11),
venta_ant_12=values(venta_ant_12);
"; $this->db->query($sa2);
$sa2t="insert into vtadc.n_prox_det(aaa, codigo, lab,nlab, suc,fami,
venta_act_1, venta_act_2, venta_act_3, venta_act_4, venta_act_5,
venta_act_6, venta_act_7, venta_act_8, venta_act_9, venta_act_10,
venta_act_11, venta_act_12,
venta_ant_1, venta_ant_2, venta_ant_3, venta_ant_4, venta_ant_5,
venta_ant_6, venta_ant_7, venta_ant_8, venta_ant_9, venta_ant_10,
venta_ant_11, venta_ant_12,
venta_actt_1, venta_actt_2, venta_actt_3, venta_actt_4, venta_actt_5,
venta_actt_6, venta_actt_7, venta_actt_8, venta_actt_9, venta_actt_10,
venta_actt_11, venta_actt_12,
venta_antt_1, venta_antt_2, venta_antt_3, venta_antt_4, venta_antt_5,
venta_antt_6, venta_antt_7, venta_antt_8, venta_antt_9, venta_antt_10,
venta_antt_11, venta_antt_12,
inv)

(SELECT a.aaa, a.codigo, a.lab,a.nlab,b.suc,a.fami,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
b.venta1,b.venta2,b.venta3,b.venta4,b.venta5,
b.venta6,b.venta7,b.venta8,b.venta9,b.venta10,
b.venta11,b.venta12,

0
from vtadc.n_prox a
left join vtadc.producto_mes_suc14 b on a.codigo=b.codigo
where b.suc>0 )
on duplicate key update
venta_antt_1=values(venta_antt_1),
venta_antt_2=values(venta_antt_2),
venta_antt_3=values(venta_antt_3),
venta_antt_4=values(venta_antt_4),
venta_antt_5=values(venta_antt_5),
venta_antt_6=values(venta_antt_6),
venta_antt_7=values(venta_antt_7),
venta_antt_8=values(venta_antt_8),
venta_antt_9=values(venta_antt_9),
venta_antt_10=values(venta_antt_10),
venta_antt_11=values(venta_antt_11),
venta_antt_12=values(venta_antt_12);
"; $this->db->query($sa2t);

$sc2="update vtadc.n_prox set inv=0"; $this->db->query($sc2);
$sc3="update vtadc.nn_prox set inv=0"; $this->db->query($sc3);
$sc5="update vtadc.n_prox_det set inv=0"; $this->db->query($sc5);
$sc6="update vtadc.nn_prox_det set inv=0"; $this->db->query($sc6);

$sc7="insert into vtadc.n_prox_det(aaa, codigo, lab, nlab,suc,fami,inv)
(SELECT a.aaa, a.codigo, a.lab, a.nlab, b.suc,a.fami,cantidad
from vtadc.n_prox a
left join desarrollo.inv b on a.codigo=b.codigo
where b.suc>0 and date_format(fechai,'%Y')=$aaa)
on duplicate key update inv=values(inv)"; $this->db->query($sc7);

$sc8="insert into vtadc.nn_prox_det(aaa, codigo, lab,nlab, suc,grupo,descri,inv)
(SELECT a.aaa, a.codigo, a.lab, a.nlab, b.suc,a.grupo,a.descri,cantidad
from vtadc.nn_prox a
left join desarrollo.inv b on a.codigo=b.codigo
where b.suc>0 and date_format(fechai,'%Y')=$aaa)
on duplicate key update inv=values(inv)"; $this->db->query($sc8);


$ss="update vtadc.n_prox a,vtadc.n_prox_det_aaa_lab_cod1 b set
a.venta_act_1=b.venta_act_1,
a.venta_act_2=b.venta_act_2,
a.venta_act_3=b.venta_act_3,
a.venta_act_4=b.venta_act_4,
a.venta_act_5=b.venta_act_5,
a.venta_act_6=b.venta_act_6,
a.venta_act_7=b.venta_act_7,
a.venta_act_8=b.venta_act_8,
a.venta_act_9=b.venta_act_9,
a.venta_act_10=b.venta_act_10,
a.venta_act_11=b.venta_act_11,
a.venta_act_12=b.venta_act_12,

a.venta_ant_1=b.venta_ant_1,
a.venta_ant_2=b.venta_ant_2,
a.venta_ant_3=b.venta_ant_3,
a.venta_ant_4=b.venta_ant_4,
a.venta_ant_5=b.venta_ant_5,
a.venta_ant_6=b.venta_ant_6,
a.venta_ant_7=b.venta_ant_7,
a.venta_ant_8=b.venta_ant_8,
a.venta_ant_9=b.venta_ant_9,
a.venta_ant_10=b.venta_ant_10,
a.venta_ant_11=b.venta_ant_11,
a.venta_ant_12=b.venta_ant_12,

a.venta_actt_1=b.venta_actt_1,
a.venta_actt_2=b.venta_actt_2,
a.venta_actt_3=b.venta_actt_3,
a.venta_actt_4=b.venta_actt_4,
a.venta_actt_5=b.venta_actt_5,
a.venta_actt_6=b.venta_actt_6,
a.venta_actt_7=b.venta_actt_7,
a.venta_actt_8=b.venta_actt_8,
a.venta_actt_9=b.venta_actt_9,
a.venta_actt_10=b.venta_actt_10,
a.venta_actt_11=b.venta_actt_11,
a.venta_actt_12=b.venta_actt_12,

a.venta_antt_1=b.venta_antt_1,
a.venta_antt_2=b.venta_antt_2,
a.venta_antt_3=b.venta_antt_3,
a.venta_antt_4=b.venta_antt_4,
a.venta_antt_5=b.venta_antt_5,
a.venta_antt_6=b.venta_antt_6,
a.venta_antt_7=b.venta_antt_7,
a.venta_antt_8=b.venta_antt_8,
a.venta_antt_9=b.venta_antt_9,
a.venta_antt_10=b.venta_antt_10,
a.venta_antt_11=b.venta_antt_11,
a.venta_antt_12=b.venta_antt_12,
a.inv=b.inv
where a.aaa=b.aaa and a.nlab=b.nlab and a.codigo=b.codigo";
$this->db->query($ss);
$sc11="update vtadc.nn_prox a,vtadc.nn_prox_det_aaa_grup_lab_cod b set
a.venta_act_1=b.venta_act_1,
a.venta_act_2=b.venta_act_2,
a.venta_act_3=b.venta_act_3,
a.venta_act_4=b.venta_act_4,
a.venta_act_5=b.venta_act_5,
a.venta_act_6=b.venta_act_6,
a.venta_act_7=b.venta_act_7,
a.venta_act_8=b.venta_act_8,
a.venta_act_9=b.venta_act_9,
a.venta_act_10=b.venta_act_10,
a.venta_act_11=b.venta_act_11,
a.venta_act_12=b.venta_act_12,

a.venta_ant_1=b.venta_ant_1,
a.venta_ant_2=b.venta_ant_2,
a.venta_ant_3=b.venta_ant_3,
a.venta_ant_4=b.venta_ant_4,
a.venta_ant_5=b.venta_ant_5,
a.venta_ant_6=b.venta_ant_6,
a.venta_ant_7=b.venta_ant_7,
a.venta_ant_8=b.venta_ant_8,
a.venta_ant_9=b.venta_ant_9,
a.venta_ant_10=b.venta_ant_10,
a.venta_ant_11=b.venta_ant_11,
a.venta_ant_12=b.venta_ant_12,

a.importe_act_1=b.importe_act_1,
a.importe_act_2=b.importe_act_2,
a.importe_act_3=b.importe_act_3,
a.importe_act_4=b.importe_act_4,
a.importe_act_5=b.importe_act_5,
a.importe_act_6=b.importe_act_6,
a.importe_act_7=b.importe_act_7,
a.importe_act_8=b.importe_act_8,
a.importe_act_9=b.importe_act_9,
a.importe_act_10=b.importe_act_10,
a.importe_act_11=b.importe_act_11,
a.importe_act_12=b.importe_act_12,

a.importe_ant_1=b.importe_ant_1,
a.importe_ant_2=b.importe_ant_2,
a.importe_ant_3=b.importe_ant_3,
a.importe_ant_4=b.importe_ant_4,
a.importe_ant_5=b.importe_ant_5,
a.importe_ant_6=b.importe_ant_6,
a.importe_ant_7=b.importe_ant_7,
a.importe_ant_8=b.importe_ant_8,
a.importe_ant_9=b.importe_ant_9,
a.importe_ant_10=b.importe_ant_10,
a.importe_ant_11=b.importe_ant_11,
a.importe_ant_12=b.importe_ant_12,

a.inv=b.inv
where a.aaa=b.aaa and a.nlab=b.nlab and a.codigo=b.codigo
"; $this->db->query($sc11);
}

function venta_90_dias()
{
    $s1="insert ignore into vtadc.a_venta_dia_90
(suc, dia1, dia2, dia3, dia4, dia5, dia6, dia7, dia8, dia9, dia10, dia11, dia12, dia13, dia14, dia15, dia16, dia17, dia18, dia19, dia20, dia21, dia22, dia23, dia24, dia25, dia26, dia27, dia28, dia29, dia30, dia31, dia32, dia33, dia34, dia35, dia36, dia37, dia38, dia39, dia40, dia41, dia42, dia43, dia44, dia45, dia46, dia47, dia48, dia49, dia50, dia51, dia52, dia53, dia54, dia55, dia56, dia57, dia58, dia59, dia60, dia61, dia62, dia63, dia64, dia65, dia66, dia67, dia68, dia69, dia70, dia71, dia72, dia73, dia74, dia75, dia76, dia77, dia78, dia79, dia80, dia81, dia82, dia83, dia84, dia85, dia86, dia87, dia88, dia89, dia90)
(select suc,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0
from catalogo.sucursal a where tlid=1 and tipo3 in('DA','FE','FA') and fecha_act='0000-00-00'
order by suc)";
    $this->db->query($s1);
    $s2="update vtadc.a_venta_dia_90 a
set
dia1=0,dia2=0,dia3=0,dia4=0,dia5=0,dia6=0,dia7=0,dia8=0,dia9=0,dia10=0,
dia11=0,dia12=0,dia13=0,dia14=0,dia15=0,dia16=0,dia17=0,dia18=0,dia19=0,dia20=0,
dia21=0,dia22=0,dia23=0,dia24=0,dia25=0,dia26=0,dia27=0,dia28=0,dia29=0,dia30=0,
dia31=0,dia32=0,dia33=0,dia34=0,dia35=0,dia36=0,dia37=0,dia38=0,dia39=0,dia40=0,
dia41=0,dia42=0,dia43=0,dia44=0,dia45=0,dia46=0,dia47=0,dia48=0,dia49=0,dia50=0,
dia51=0,dia52=0,dia53=0,dia54=0,dia55=0,dia56=0,dia57=0,dia58=0,dia59=0,dia60=0,
dia61=0,dia62=0,dia63=0,dia64=0,dia65=0,dia66=0,dia67=0,dia68=0,dia69=0,dia70=0,
dia71=0,dia72=0,dia73=0,dia74=0,dia75=0,dia76=0,dia77=0,dia78=0,dia79=0,dia80=0,
dia81=0,dia82=0,dia83=0,dia84=0,dia85=0,dia86=0,dia87=0,dia88=0,dia89=0,dia90=0";
    $this->db->query($s2);
    $s3="update vtadc.a_venta_dia_90 a
set
dia1=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),1) where x.suc=a.suc group by a.suc),0),
dia2=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),2) where x.suc=a.suc group by a.suc),0),
dia3=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),3) where x.suc=a.suc group by a.suc),0),
dia4=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),4) where x.suc=a.suc group by a.suc),0),
dia5=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),5) where x.suc=a.suc group by a.suc),0),
dia6=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),6) where x.suc=a.suc group by a.suc),0),
dia7=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),7) where x.suc=a.suc group by a.suc),0),
dia8=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),8) where x.suc=a.suc group by a.suc),0),
dia9=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),9) where x.suc=a.suc group by a.suc),0),
dia10=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),10) where x.suc=a.suc group by a.suc),0),
dia11=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),11) where x.suc=a.suc group by a.suc),0),
dia12=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),12) where x.suc=a.suc group by a.suc),0),
dia13=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),13) where x.suc=a.suc group by a.suc),0),
dia14=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),14) where x.suc=a.suc group by a.suc),0),
dia15=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),15) where x.suc=a.suc group by a.suc),0),
dia16=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),16) where x.suc=a.suc group by a.suc),0),
dia17=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),17) where x.suc=a.suc group by a.suc),0),
dia18=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),18) where x.suc=a.suc group by a.suc),0),
dia19=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),19) where x.suc=a.suc group by a.suc),0),
dia20=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),20) where x.suc=a.suc group by a.suc),0),
dia21=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),21) where x.suc=a.suc group by a.suc),0),
dia22=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),22) where x.suc=a.suc group by a.suc),0),
dia23=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),23) where x.suc=a.suc group by a.suc),0),
dia24=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),24) where x.suc=a.suc group by a.suc),0),
dia25=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),25) where x.suc=a.suc group by a.suc),0),
dia26=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),26) where x.suc=a.suc group by a.suc),0),
dia27=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),27) where x.suc=a.suc group by a.suc),0),
dia28=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),28) where x.suc=a.suc group by a.suc),0),
dia29=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),29) where x.suc=a.suc group by a.suc),0),
dia30=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),30) where x.suc=a.suc group by a.suc),0),
dia31=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),31) where x.suc=a.suc group by a.suc),0),
dia32=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),32) where x.suc=a.suc group by a.suc),0),
dia33=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),33) where x.suc=a.suc group by a.suc),0),
dia34=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),34) where x.suc=a.suc group by a.suc),0),
dia35=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),35) where x.suc=a.suc group by a.suc),0),
dia36=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),36) where x.suc=a.suc group by a.suc),0),
dia37=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),37) where x.suc=a.suc group by a.suc),0),
dia38=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),38) where x.suc=a.suc group by a.suc),0),
dia39=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),39) where x.suc=a.suc group by a.suc),0),
dia40=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),40) where x.suc=a.suc group by a.suc),0),
dia41=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),41) where x.suc=a.suc group by a.suc),0),
dia42=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),42) where x.suc=a.suc group by a.suc),0),
dia43=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),43) where x.suc=a.suc group by a.suc),0),
dia44=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),44) where x.suc=a.suc group by a.suc),0),
dia45=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),45) where x.suc=a.suc group by a.suc),0),
dia46=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),46) where x.suc=a.suc group by a.suc),0),
dia47=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),47) where x.suc=a.suc group by a.suc),0),
dia48=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),48) where x.suc=a.suc group by a.suc),0),
dia49=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),49) where x.suc=a.suc group by a.suc),0),
dia50=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),50) where x.suc=a.suc group by a.suc),0),
dia51=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),51) where x.suc=a.suc group by a.suc),0),
dia52=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),52) where x.suc=a.suc group by a.suc),0),
dia53=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),53) where x.suc=a.suc group by a.suc),0),
dia54=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),54) where x.suc=a.suc group by a.suc),0),
dia55=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),55) where x.suc=a.suc group by a.suc),0),
dia56=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),56) where x.suc=a.suc group by a.suc),0),
dia57=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),57) where x.suc=a.suc group by a.suc),0),
dia58=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),58) where x.suc=a.suc group by a.suc),0),
dia59=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),59) where x.suc=a.suc group by a.suc),0),
dia60=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),60) where x.suc=a.suc group by a.suc),0),
dia61=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),61) where x.suc=a.suc group by a.suc),0),
dia62=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),62) where x.suc=a.suc group by a.suc),0),
dia63=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),63) where x.suc=a.suc group by a.suc),0),
dia64=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),64) where x.suc=a.suc group by a.suc),0),
dia65=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),65) where x.suc=a.suc group by a.suc),0),
dia66=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),66) where x.suc=a.suc group by a.suc),0),
dia67=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),67) where x.suc=a.suc group by a.suc),0),
dia68=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),68) where x.suc=a.suc group by a.suc),0),
dia69=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),69) where x.suc=a.suc group by a.suc),0),
dia70=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),70) where x.suc=a.suc group by a.suc),0),
dia71=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),71) where x.suc=a.suc group by a.suc),0),
dia72=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),72) where x.suc=a.suc group by a.suc),0),
dia73=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),73) where x.suc=a.suc group by a.suc),0),
dia74=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),74) where x.suc=a.suc group by a.suc),0),
dia75=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),75) where x.suc=a.suc group by a.suc),0),
dia76=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),76) where x.suc=a.suc group by a.suc),0),
dia77=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),77) where x.suc=a.suc group by a.suc),0),
dia78=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),78) where x.suc=a.suc group by a.suc),0),
dia79=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),79) where x.suc=a.suc group by a.suc),0),
dia80=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),80) where x.suc=a.suc group by a.suc),0),
dia81=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),81) where x.suc=a.suc group by a.suc),0),
dia82=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),82) where x.suc=a.suc group by a.suc),0),
dia83=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),83) where x.suc=a.suc group by a.suc),0),
dia84=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),84) where x.suc=a.suc group by a.suc),0),
dia85=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),85) where x.suc=a.suc group by a.suc),0),
dia86=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),86) where x.suc=a.suc group by a.suc),0),
dia87=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),87) where x.suc=a.suc group by a.suc),0),
dia88=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),88) where x.suc=a.suc group by a.suc),0),
dia89=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),89) where x.suc=a.suc group by a.suc),0),
dia90=ifnull((select sum(siniva)as vta from desarrollo.cortes_c x join desarrollo.cortes_d y on
y.id_cc=x.id and clave1 not in(0,20,30,40,49) and fechacorte=subdate(date(now()),90) where x.suc=a.suc group by a.suc),0)

";
    $this->db->query($s3);
   
}

}