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
        
         $s="select b.sucursal, c.nombre, sum(b.venta) as venta,sum(b.importe) as importe from catalogo.almacen a
left join vtadc.venta b on b.codigo=a.codigo and b.aaa=$aaa and b.mes=$mes and b.sucursal in(602,603,604,605,606,608,552,553,593)
left join catalogo.sucursal c on b.sucursal=c.suc
where a.sec>0 and a.sec<=2000 and a.prv<>392 AND A.PRV<>391 AND A.TSEC<>'M' and venta is not null
group by sucursal";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

function reporte_imperial_suc($mes, $aaa, $sucursal)
    {
        
         $s="select prv,d.razo, b.sucursal,c.nombre, a.sec,a.codigo, a.susa1,(b.venta),(b.importe) from catalogo.almacen a
left join vtadc.venta b on b.codigo=a.codigo and b.aaa=$aaa and b.mes=$mes and b.sucursal in(602,603,604,605,606,608,552,553,593)
left join catalogo.sucursal c on b.sucursal=c.suc
left join catalogo.cat_mer_prv d on d.prov=a.prv
where a.sec>0 and a.sec<=2000 and a.prv<>392 and a.prv<>391 AND A.TSEC<>'M' and sucursal=$sucursal and venta is not null";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
return $q;        
}

function reporte_gontor($mes, $aaa)
    {
        
         $s="select b.sucursal, c.nombre, sum(b.venta) as venta,sum(b.importe) as importe from catalogo.almacen a
left join vtadc.venta b on b.codigo=a.codigo and b.aaa=$aaa and b.mes=$mes and b.sucursal in(602,603,604,605,606,608,552,553,593)
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
        
         $s="select prv,d.razo, b.sucursal,c.nombre, a.sec,a.codigo, a.susa1,(b.venta),(b.importe) from catalogo.almacen a
left join vtadc.venta b on b.codigo=a.codigo and b.aaa=$aaa and b.mes=$mes and b.sucursal in(602,603,604,605,606,608,552,553,593)
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

}