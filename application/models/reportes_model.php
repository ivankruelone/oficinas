<?php
class Reportes_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
  
    
function poliza_inventario($semana,$aaa)
    {
        
         $s="SELECT i.cia, a.razon,  sum(i.importe) as importe
FROM desarrollo.inv_cosvta i
left join catalogo.compa a on i.cia=a.cia
where sem=$semana and aaaa=$aaa
group by i.cia;"; 
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

function poliza_inventario_cia($semana,$aaa,$cia)
    {
        
         $s="SELECT i.cia, a.razon, i.suc, b.nombre as sucx, i.sem, i.aaaa, i.mes, i.lin, c.linx, i.plaza, i.succ, importe,piezas
FROM desarrollo.inv_cosvta i
left join catalogo.compa a on i.cia=a.cia
left join catalogo.sucursal b on i.suc=b.suc
left join catalogo.lineas_cosvta c on i.lin=c.lin
where sem=$semana and aaaa=$aaa and i.cia=$cia order by i.suc";
        $q = $this->db->query($s);
foreach($q->result()as $r){
$a[$r->cia]['cia']=$r->cia;
$a[$r->cia]['ciax']=$r->razon;
$a[$r->cia]['segundo'][$r->suc]['suc']=$r->suc;
$a[$r->cia]['segundo'][$r->suc]['sucx']=$r->sucx;
$a[$r->cia]['segundo'][$r->suc]['tercero'][$r->lin]['lin']=$r->lin;
$a[$r->cia]['segundo'][$r->suc]['tercero'][$r->lin]['linx']=$r->linx;
$a[$r->cia]['segundo'][$r->suc]['tercero'][$r->lin]['piezas']=$r->piezas;
$a[$r->cia]['segundo'][$r->suc]['tercero'][$r->lin]['importe']=$r->importe; 
}
return $a;        
}

function poliza_inventario_cia_suc($semana,$aaa,$cia,$suc)
    {
        
         $s="SELECT i.cia, a.razon, i.suc, b.nombre, i.sem, i.aaaa, i.mes, i.lin, c.linx, i.plaza, i.succ, i.importe
FROM desarrollo.inv_cosvta i
left join catalogo.compa a on i.cia=a.cia
left join catalogo.sucursal b on i.suc=b.suc
left join catalogo.lineas_cosvta c on i.lin=c.lin
where sem=$semana and aaaa=$aaa and i.cia=$cia and i.suc=$suc";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

function reporte_imperial($mes, $aaa)
    {
if($aaa<>date('Y')){
$var='venta'.substr($aaa,2,2);        
}else{
$var='venta';    
}        
         $s="select b.sucursal, c.nombre, sum(b.venta) as venta,sum(b.importe) as importe from catalogo.almacen a
left join vtadc.$var b on b.codigo=a.codigo and b.aaa=$aaa and b.mes=$mes and b.sucursal in(602,603,604,605,606,608,552,553,593)
left join catalogo.sucursal c on b.sucursal=c.suc
where a.sec>0 and a.sec<=2000 and a.prv<>392 AND A.PRV<>391 AND A.TSEC<>'M'
and a.codigo <>7501318691728
and a.codigo <> 7501009071358
and a.codigo <> 7502213040048
and a.codigo <>7501409201522
and a.codigo <>7501871720552
and a.codigo <>7501318697287
and a.codigo <>7501390912551
and a.codigo <>7501559604518
and a.codigo <>7501836003256
and a.codigo <>7501050611428
and a.codigo <>7501070903473
and a.codigo <>7501124850166
and a.codigo <>880127402
and a.codigo <>7896116880543
and a.codigo <>7896116861559
and a.codigo <>7501201400833
and a.codigo <>7501070903497
and a.codigo <>7501070903688
and a.codigo <>7501298234809
and a.codigo <>7501293201677
and a.codigo <>7501050693806
and a.codigo <>7501409201096
and a.codigo <>7501008465684
and a.codigo <>7501108762997
and a.codigo <>7501318612082
and a.codigo <>7501109911202
and a.codigo <>7501303467505
and a.codigo <>7501303469103
and a.codigo <>7503000997958
and venta is not null
group by sucursal";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

function reporte_imperial_suc($mes, $aaa, $sucursal)
    {
if($aaa<>date('Y')){
$var='venta'.substr($aaa,2,2);        
}else{
$var='venta';    
}
        
         $s="select prv,d.razo, b.sucursal,c.nombre, a.sec,a.codigo, a.susa1,(b.venta),(b.importe) from catalogo.almacen a
left join vtadc.$var b on b.codigo=a.codigo and b.aaa=$aaa and b.mes=$mes and b.sucursal in(602,603,604,605,606,608,552,553,593)
left join catalogo.sucursal c on b.sucursal=c.suc
left join catalogo.cat_mer_prv d on d.prov=a.prv
where a.sec>0 and a.sec<=2000 and a.prv<>392 AND A.PRV<>391 AND A.TSEC<>'M'
and a.codigo <>7501318691728
and a.codigo <> 7501009071358
and a.codigo <> 7502213040048
and a.codigo <>7501409201522
and a.codigo <>7501871720552
and a.codigo <>7501318697287
and a.codigo <>7501390912551
and a.codigo <>7501559604518
and a.codigo <>7501836003256
and a.codigo <>7501050611428
and a.codigo <>7501070903473
and a.codigo <>7501124850166
and a.codigo <>880127402
and a.codigo <>7896116880543
and a.codigo <>7896116861559
and a.codigo <>7501201400833
and a.codigo <>7501070903497
and a.codigo <>7501070903688
and a.codigo <>7501298234809
and a.codigo <>7501293201677
and a.codigo <>7501050693806
and a.codigo <>7501409201096
and a.codigo <>7501008465684
and a.codigo <>7501108762997
and a.codigo <>7501318612082
and a.codigo <>7501109911202
and a.codigo <>7501303467505
and a.codigo <>7501303469103
and a.codigo <>7503000997958
and sucursal=$sucursal and venta is not null";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

function reporte_gontor($mes, $aaa)
    {
if($aaa<>date('Y')){
$var='venta'.substr($aaa,2,2);        
}else{
$var='venta';    
}
         $s="select b.sucursal, c.nombre, sum(b.venta) as venta,sum(b.importe) as importe from catalogo.almacen a
left join vtadc.$var b on b.codigo=a.codigo and b.aaa=$aaa and b.mes=$mes and b.sucursal in(602,603,604,605,606,608,552,553,593)
left join catalogo.sucursal c on b.sucursal=c.suc
where a.sec>0 and a.sec<=2000 and a.prv in(392,391) and venta is not null
group by sucursal";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

function reporte_gontor_suc($mes, $aaa, $sucursal)
    {
if($aaa<>date('Y')){
$var='venta'.substr($aaa,2,2);        
}else{
$var='venta';    
}        
         $s="select prv,d.razo, b.sucursal,c.nombre, a.sec,a.codigo, a.susa1,(b.venta),(b.importe) from catalogo.almacen a
left join vtadc.$var b on b.codigo=a.codigo and b.aaa=$aaa and b.mes=$mes and b.sucursal in(602,603,604,605,606,608,552,553,593)
left join catalogo.sucursal c on b.sucursal=c.suc
left join catalogo.cat_mer_prv d on d.prov=a.prv
where a.sec>0 and a.sec<=2000 and a.prv in(392,391) and sucursal=$sucursal and venta is not null";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

function claves_promocion()
    {
        
         $s="SELECT codigo, descri, sum(can) as cantidad
FROM vtadc.venta_detalle
where codigo in (7502248230599, 7502248230575, 7503001467375)
and fecha between '2013-11-23' and '2013-12-31' group by codigo;"; 
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

function claves_promocion_x_sucursal($codigo)
    {
        
         $s="SELECT a.suc, b.nombre, a.codigo, a.descri, sum(a.can) as cantidad
FROM vtadc.venta_detalle a
left join catalogo.sucursal b on a.suc=b.suc
where codigo = $codigo
and fecha between '2013-11-23' and '2013-12-31' group by suc;"; 
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}


//////////////////////////////////////////////////////supervisor///////////////////////////////

function claves_promocion_sup($reg)
    {
        
         $s="SELECT a.codigo, a.descri, a.nomina, c.completo, sum(a.can) as cantidad, b.regional
FROM vtadc.venta_detalle a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_empleado c on c.nomina=a.nomina
where codigo in (7502248230599, 7502248230575, 7503001467375)
and fecha between '2013-11-23' and '2013-12-31' 
and b.superv=$reg and b.tipo2<>'F'
group by nomina;"; 
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

function claves_promocion_x_sucursal_sup($codigo, $reg)
    {
        
         $s="SELECT a.suc, b.nombre, a.codigo, a.descri, a.tiket, a.fecha, a.nomina,  a.can
FROM vtadc.venta_detalle a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.cat_empleado c on c.nomina=a.nomina
where codigo in (7502248230599, 7502248230575, 7503001467375) and a.nomina=$codigo
and fecha between '2013-11-23' and '2013-12-31' 
and b.superv=$reg and b.tipo2<>'F'
"; 
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

//////////////////////////////////////////////////////gerente///////////////////////////////

function claves_promocion_ger($reg)
    {
        
         $s="SELECT a.codigo, a.descri, a.nomina, c.completo, sum(a.can) as cantidad, b.regional
FROM vtadc.venta_detalle a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_empleado c on c.nomina=a.nomina
where codigo in (7502248230599, 7502248230575, 7503001467375)
and fecha between '2013-11-23' and '2013-12-31' 
and b.regional=$reg and b.tipo2<>'F'
group by nomina;"; 
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

function claves_promocion_general()
    {
        
         $s="SELECT sum(a.can) as cantidad
FROM vtadc.venta_detalle a
where codigo in (7502248230599, 7502248230575, 7503001467375)
and fecha between '2013-11-23' and '2013-12-31'"; 
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

function claves_promocion_x_sucursal_ger($codigo, $reg)
    {
        
         $s="SELECT a.suc, b.nombre, a.codigo, a.descri, a.tiket, a.fecha, a.nomina,  a.can
FROM vtadc.venta_detalle a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.cat_empleado c on c.nomina=a.nomina
where codigo in (7502248230599, 7502248230575, 7503001467375) and a.nomina=$codigo
and fecha between '2013-11-23' and '2013-12-31' 
and b.regional=$reg and b.tipo2<>'F'
"; 
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

///////////////////////////////////////////////////////////////////////xochitl//////////////////////////////////////////////

function reporte_siniva($mes, $aaa)
    {
        
         $s="select a.suc, c.nombre, sum(siniva)as siniva from desarrollo.cortes_c a
left join  desarrollo.cortes_d b on b.id_cc=a.id
left join catalogo.sucursal c on a.suc=c.suc
where fechacorte>='$aaa-$mes-01' and fechacorte<='$aaa-$mes-31' and clave1 in(10,11,16,24) and a.suc>100
group by a.suc";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

////////////////////////////////////////////////////////jessica/////////////////////////////////////////////////////////////

        function compra_equipo($mes,$aaa)
            {
                
                 $s="SELECT a.id,year(fechav)as aaa,month(fechav)as mes,b.equipo,c.nombre,b.acce,ifnull(d.nombre,'PRODUCTO COMPLETO') as accesorio, count(b.acce) as total
        
        FROM sistema01.solicitud_cc a
        
        left join sistema01.solicitud_dd b on b.id_cc=a.id
        
        left join sistema01.equipo c on c.id=b.equipo
        
        left join sistema01.accesorio d on d.equipo=b.equipo and d.id=b.acce
        
        where a.tipo='C' and year(fechav)=$aaa and month(fechav)=$mes
        
        group by year(fechav),month(fechav),b.equipo,b.acce
        
        order by year(fechav),month(fechav),b.equipo,b.acce"; 
                $q = $this->db->query($s);
                //echo $this->db->last_query();
                //echo die;
        return $q;        
        }
        
/////////////////////////////////////////victor//////////////////////////////////////////////////////////////////////////////        
        
        function reporte_salidas($mes, $aaa, $tecnico)
        {
        
        if($tecnico<>0){
        $s="SELECT w.id,id_entra,w.suc,b.nombre,b.tipo2, e.fecha as fece, w.fecha, x.equipo,c.nombre as equipo, marca,modelo,x.serie,solucion, x.revisa, u.nombre as empleado
            FROM sistema01.salida_cc w
            left join sistema01.salida_dd x on x.id_cc=w.id
            left join catalogo.sucursal b on b.suc=w.suc
            left join sistema01.equipo c on c.id=x.equipo
            left join sistema01.`user` u on u.id=x.revisa
            left join sistema01.entrada_cc e on w.id_entra=e.id
            where month(w.created_at)=$mes and year(w.created_at)=$aaa and w.tipo='B' and revisa=$tecnico";
            }else{
                $s="SELECT w.id,id_entra,w.suc,b.nombre,b.tipo2, e.fecha as fece, w.fecha, x.equipo,c.nombre as equipo, marca,modelo,x.serie,solucion, x.revisa, u.nombre as empleado
            FROM sistema01.salida_cc w
            left join sistema01.salida_dd x on x.id_cc=w.id
            left join catalogo.sucursal b on b.suc=w.suc
            left join sistema01.equipo c on c.id=x.equipo
            left join sistema01.`user` u on u.id=x.revisa
            left join sistema01.entrada_cc e on w.id_entra=e.id
            where month(w.created_at)=$mes and year(w.created_at)=$aaa and w.tipo='B'";
                
            }
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
        return $q;        
        }
        
        function reporte_salidas1($mes, $aaa)
        {

        $s="SELECT w.id,id_entra,w.suc,b.nombre,b.tipo2, w.fecha, x.equipo,c.nombre as equipo, marca,modelo,serie,solucion FROM sistema01.salida_cc  w

            left join sistema01.salida_dd x on x.id_cc=w.id
            
            left join catalogo.sucursal b on b.suc=w.suc
            
            left join sistema01.equipo c on c.id=x.equipo
            
            where month(w.created_at)=$mes and year(w.created_at)=$aaa and w.tipo='B'";
        $q = $this->db->query($s);
        echo $this->db->last_query();
        echo die;
        return $q;        
        }
        
         function reporte_entradas($mes, $aaa, $tecnico)
        {
        
        if($tecnico<>0){
        $s="SELECT a.id, a.suc, c.nombre, a.fecha, d.nombre as equipo, b.marca, b.modelo, b.serie, b.proble, e.nombre as empleado
            FROM sistema01.entrada_cc a
            left join sistema01.entrada_dd b on a.id=b.id_cc
            left join catalogo.sucursal c on a.suc=c.suc
            left join sistema01.equipo d on b.equipo=d.id
            left join sistema01.user e on b.revisa=e.id
            where month(a.created_at)=$mes and year(a.created_at)=$aaa and a.tipo='B' and revisa=$tecnico";
            }else{
        $s="SELECT a.id, a.suc, c.nombre, a.fecha, d.nombre as equipo, b.marca, b.modelo, b.serie, b.proble, e.nombre as empleado
            FROM sistema01.entrada_cc a
            left join sistema01.entrada_dd b on a.id=b.id_cc
            left join catalogo.sucursal c on a.suc=c.suc
            left join sistema01.equipo d on b.equipo=d.id
            left join sistema01.user e on b.revisa=e.id
            where month(a.created_at)=$mes and year(a.created_at)=$aaa and a.tipo='B'";
                
            }
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
        return $q;        
        }
        
        function reporte_bitacora($inicio, $fin, $tecnico)
        {
            if($tecnico<>0){
            $sql="SELECT b.*, u.nombre as empleado, d.nombre as departamento FROM sistema01.bitacora b
                left join sistema01.`user` u on b.revisa=u.id
                left join sistema01.depto d on b.depto=d.id
                where b.tipo='B' and date(b.created_at)>='$inicio' and date(b.created_at)<='$fin' and revisa=$tecnico;";
            }else{
            $sql="SELECT b.*, u.nombre as empleado, d.nombre as departamento FROM sistema01.bitacora b
                left join sistema01.`user` u on b.revisa=u.id
                left join sistema01.depto d on b.depto=d.id
                where b.tipo='B' and date(b.created_at)>='$inicio' and date(b.created_at)<='$fin'";
                
            }
            
            $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $q;    
                
            
        }
        
}