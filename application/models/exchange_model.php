<?php
class Exchange_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function getOrdenByOrden_id($folprv)
    {
        $this->db->where('folprv', $folprv);
        $query = $this->db->get('compras.orden_c');
        return $query->result();
    }
    
    function getOrdenDetalleByOrden_id($folprv)
    {
        $sql = "SELECT o.* FROM compras.orden_d o
join compras.orden_c c using(id_orden)
where folprv = ?;";
        
        $query = $this->db->query($sql, $folprv);
        return $query->result();
    }

    function getOrdenDetalleByCodigo($folprv, $codigo)
    {
        $sql = "SELECT o.* FROM compras.orden_d o
join compras.orden_c c using(id_orden)
where folprv = ? and codigo = ?;";
        
        $query = $this->db->query($sql, array((int)$folprv, (double)$codigo));
        
        return $query->result();
    }

    function getOrdenDetalleBySec($folprv, $sec)
    {
        $sql = "SELECT o.* FROM compras.orden_d o
join compras.orden_c c using(id_orden)
where folprv = ? and sec = ?;";
        
        $query = $this->db->query($sql, array((int)$folprv, (int)$sec));
        
        return $query->result();
    }

    function getOrdenDetalleByClave($folprv, $clave)
    {
        $clave = str_replace('diagonal', '/', $clave);
        $sql = "SELECT o.* FROM compras.orden_d o
join compras.orden_c c using(id_orden)
where folprv = ? and clagob = ?;";
        
        $query = $this->db->query($sql, array((int)$folprv, (string)$clave));
        
        return $query->result();
    }
    
    function getProveedor()
    {
        $sql = "SELECT prov as proveedorID, trim(replace(rfc, '-', '')) as rfc, trim(replace(razo, '\'', '')) as razon, concat(trim(replace(rfc, '-', '')), ' - ', trim(replace(razo, '\'', '')), ' (', prov, ')') as value FROM catalogo.provedor p where tipo = 'A' order by proveedorID;";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    function getSucursal()
    {
        $sql = "SELECT suc as clvsucursal, upper(trim(replace(nombre, '\'', ''))) as descsucursal,  0 as tiposucursal, 1 as numjurisd, 0 as diaped, upper(trim(replace(dire, '\'', ''))) as calle, ' ' as noexterior, ' ' as nointerior, upper(trim(replace(col, '\'', ''))) as colonia, upper(trim(replace(pobla, '\'', ''))) as municipio, ' ' as estado, ' ' as pais, case when cp = ' ' then 0 else cp end as cp, cia  FROM catalogo.sucursal s where tipo1 = 'A';";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    function getArticulo()
    {
        $sql = "SELECT clave as cvearticulo, nombreGenerico as susa, concat(formaFarmaceutica, ' ', concentracion) as descripcion, presentacion as pres, case when gobiernoTipo = 1 then 0 else 1 end as tipoprod, 0 as ventaxuni, 1 as numunidades, 0 as fcb, 1 as sp, 1 as pa, 1 as op, 0 as preciocon, 0 as precioven, 0 as servicio, 0 as preciosinser, 0 as ultimo_costo, 1 as activo, 1 as tipoPresentacion, ' ' as cvecliente, 0 as antibiotico, 0 as semaforo
FROM maestro.gobierno g;";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    function getArticuloPatente()
    {
        $sql = "SELECT ean as cvearticulo, descripcion, presentacion as pres, sustancia as susa, ifnull(iva, 0) as tipoprod, 'maestro' as cvecliente
FROM maestro.producto p;";
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    function getArticuloByClave($clave)
    {
        $clave = str_replace('|', '/', $clave);
        $sql = "SELECT clave as cvearticulo, nombreGenerico as susa, concat(formaFarmaceutica, ' ', concentracion) as descripcion, presentacion as pres, case when gobiernoTipo = 1 then 0 else 1 end as tipoprod, 0 as ventaxuni, 1 as numunidades, 0 as fcb, 1 as sp, 1 as pa, 1 as op, 0 as preciocon, 0 as precioven, 0 as servicio, 0 as preciosinser, 0 as ultimo_costo, 1 as activo, 1 as tipoPresentacion, ' ' as cvecliente, 0 as antibiotico, 0 as semaforo
FROM maestro.gobierno g where clave = ?;";
        $query = $this->db->query($sql, $clave);
        
        if($query->num_rows() > 0)
        {
            return $query->result();
            
        }else{
            
            $sql2 = "SELECT TRIM(upper(clagob)) as cvearticulo, trim(upper(susa)) as susa, concat(trim(upper(presenta)), ' ', trim(upper(gramaje))) as descripcion, concat(trim(upper(contenido)), ' ', trim(upper(presenta))) as pres, iva as tipoprod,  0 as ventaxuni, 1 as numunidades, 0 as fcb, 1 as sp, 1 as pa, 1 as op, 0 as preciocon, 0 as precioven, 0 as servicio, 0 as preciosinser, 0 as ultimo_costo, 1 as activo, 1 as tipoPresentacion, ' ' as cvecliente, 0 as antibiotico, 0 as semaforo
FROM catalogo.cat_nuevo_general c where clagob = ? group by clagob;";
            $query2 = $this->db->query($sql2, $clave);
            
            return $query2->result();
        }
        
    }

    function getArticuloBySusa($susa)
    {
        $sql = "SELECT clave as cvearticulo, nombreGenerico as susa, concat(formaFarmaceutica, ' ', concentracion) as descripcion, presentacion as pres, case when gobiernoTipo = 1 then 0 else 1 end as tipoprod, 0 as ventaxuni, 1 as numunidades, 0 as fcb, 1 as sp, 1 as pa, 1 as op, 0 as preciocon, 0 as precioven, 0 as servicio, 0 as preciosinser, 0 as ultimo_costo, 1 as activo, 1 as tipoPresentacion, ' ' as cvecliente, 0 as antibiotico, 0 as semaforo
FROM maestro.gobierno g where nombreGenerico like '%$susa%'
union all
SELECT TRIM(upper(clagob)) as cvearticulo, trim(upper(susa)) as susa, concat(trim(upper(presenta)), ' ', trim(upper(gramaje))) as descripcion, concat(trim(upper(contenido)), ' ', trim(upper(presenta))) as pres, iva as tipoprod,  0 as ventaxuni, 1 as numunidades, 0 as fcb, 1 as sp, 1 as pa, 1 as op, 0 as preciocon, 0 as precioven, 0 as servicio, 0 as preciosinser, 0 as ultimo_costo, 1 as activo, 1 as tipoPresentacion, ' ' as cvecliente, 0 as antibiotico, 0 as semaforo
FROM catalogo.cat_nuevo_general c where susa like '%$susa%' group by clagob;";
        $query = $this->db->query($sql);
        
        return $query->result();
        
        
    }
    
    function getLaboratorio()
    {
        $sql = "SELECT trim(replace(laboratorio, '\'', '')) as value FROM maestro.laboratorio where idLaboratorio <> 0;";
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    function getCliente($rfc)
    {
        $F = $this->load->database('facturacion', TRUE);
        $F->where('rfc', $rfc);
        $query = $F->get('receptores');
        return $query->result();
    }
    
    function getClienteBusqueda($busca)
    {
        $sql = "select * from receptores where rfc like '%$busca%' or razon like '%$busca%';";
        $F = $this->load->database('facturacion', TRUE);
        $query = $F->query($sql);
        return $query->result();
    }

    function getFolio($foliador)
    {
        $this->db->trans_start();
        $sql = "SELECT * FROM catalogo.foliador1 where clav = ?;";
        $query = $this->db->query($sql, (string)$foliador);
        
        if($query->num_rows > 0)
        {
            $row = $query->row();
            
            $folio = $row->num;
            
            $this->db->update('catalogo.foliador1', array('num' => ($folio + 1)), array('clav' => (string)$foliador));
        }else{
            $folio = array('folio' => 0);
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE)
        {
            return array('folio' => 0);
        }else{
            return array('folio' => $folio);
        }
        
    }
    
    function actualizaAplicadas($arr)
    {
        $this->db->where('folprv', $arr->orden);
        $query = $this->db->get('compras.orden_c');
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            
            
            
            foreach($arr->detalle as $det)
            {
                $sql = "update compras.orden_d set aplica = aplica + ? where id_orden = ? and clagob = ?;";
                $this->db->query($sql, array((int)$det->piezas, (int)$row->id_orden, (string)$det->clave));
                
            }
            
            
        }
    }

    function buscaTraspaso($referencia, $clvsucursal, $cvearticulo)
    {
        $sql = "SELECT 'spcentral' as base, movimientoDetalle, aplicadas
FROM spcentral.movimiento m
join spcentral.movimiento_detalle d using(movimientoID)
join spcentral.articulos a using(id)
where referencia = ? and clvsucursal = ? and cvearticulo = ?
union all
SELECT 'controlado' as base, movimientoDetalle, aplicadas
FROM controlado.movimiento m
join controlado.movimiento_detalle d using(movimientoID)
join controlado.articulos a using(id)
where referencia = ? and clvsucursal = ? and cvearticulo = ?
;";
        $query = $this->db->query($sql, array((string)$referencia, (int)$clvsucursal, (string)$cvearticulo, (string)$referencia, (int)$clvsucursal, (string)$cvearticulo));

        return $query;
    }

    function actualizaAplicadasTraspaso($arr)
    {
        foreach ($arr as $a) {
            $query = $this->buscaTraspaso($a->referencia, $a->clvsucursalReferencia, $a->cvearticulo);
            if($query->num_rows() > 0)
            {
                $row = $query->row();

                $sql_update = "UPDATE " . $row->base . ".movimiento_detalle set aplicadas = aplicadas + ? where movimientoDetalle = ?;";
                $this->db->query($sql_update, array($a->piezas, $row->movimientoDetalle));
            }
        }
    }
    
    function getTicketBySucTicket($suc, $ticket)
    {
        $sql = "SELECT * FROM vtadc.venta_detalle v where suc = ? and tiket = ?;";
        $query = $this->db->query($sql, array($suc, (string)$ticket));
        
        return $query->result();
    }
    
    function getPatenteByEAN($ean)
    {
        $sql = "SELECT ean, descripcion, sustancia, laboratorioProvisional, iva, 'maestro' as origen
FROM maestro.producto p
where ean = ?
union all
SELECT codigo as ean, descripcion, susa as sustancia, labprv as laboratorioProvisional, case when iva = 0 then 0 else 1 end as iva, 'catalogo' as origen
FROM catalogo.cat_mercadotecnia c
where codigo = ?;";
        
        $query = $this->db->query($sql, array((string)$ean, (string)$ean));
        
        return $query->result();
    }

    function getPatenteByEANOrigen($ean, $origen)
    {
        $sql = "SELECT ean as cvearticulo, descripcion, presentacion as pres, sustancia as susa, iva as tipoprod, 'maestro' as cvecliente
FROM maestro.producto p
where ean = ?
having cvecliente = ?
union all
SELECT codigo as cvearticulo, descripcion, '' as pres, susa, case when iva = 0 then 0 else 1 end as tipoprod, 'catalogo' as cvecliente
FROM catalogo.cat_mercadotecnia c
where codigo = ?
having cvecliente = ?
;";
        
        $query = $this->db->query($sql, array((string)$ean, (string)$origen, (string)$ean, (string)$origen));
        
        return $query->result();
    }

    function getPatenteByEANSinOrigen($ean)
    {
        $sql = "SELECT ean as cvearticulo, descripcion, presentacion as pres, sustancia as susa, iva as tipoprod, 'maestro' as cvecliente
FROM maestro.producto p
where ean = ?
union all
SELECT codigo as cvearticulo, descripcion, '' as pres, susa, case when iva = 0 then 0 else 1 end as tipoprod, 'catalogo' as cvecliente
FROM catalogo.cat_mercadotecnia c
where codigo = ?
;";
        
        $query = $this->db->query($sql, array((string)$ean, (string)$ean));
        
        return $query->result();
    }

    function getPatenteByDescripcion($descripcion)
    {
        $sql = "SELECT ean, descripcion, sustancia, laboratorioProvisional, iva, 'maestro' as origen
FROM maestro.producto p
where descripcion like '%$descripcion%' or sustancia like '%$descripcion%'
union all
SELECT codigo as ean, descripcion, susa as sustancia, labprv as laboratorioProvisional, case when iva = 0 then 0 else 1 end as iva, 'catalogo' as origen
FROM catalogo.cat_mercadotecnia c
where descripcion like '%$descripcion%' or susa like '%$descripcion%';";
        
        $query = $this->db->query($sql);
        
        return $query->result();
    }

    function getCatAhorro()
    {
        $sql = "SELECT
sec, codigo as cvearticulo, trim(upper(susa1)) as susa, trim(upper(susa2)) as descripcion, lin, sublin, costo as ultimo_costo, publico, vtagen as precio, case when antibio = 'S' then 1 else 0 end as antibiotico, case when lin in(2, 5, 9, 10) then 1 else 0 end as iva, case when lin in(5) and sublin in(17) then 1 else 0 end as servicio
FROM catalogo.almacen a
where (sec between 1 and 2000 or sec between 3000 and 3999) and codigo > 0 and vtagen > 0 and sec > 0
group by codigo
order by sec, codigo;";
        
        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    function getCatEmpleado()
    {
        $sql = "SELECT nomina as clvusuario, md5(pdvpw) as password, trim(upper(completo)) as nombreusuario, tipo as estaactivo, case when puestox like '%SUPERVISOR%' then 3 when puestox like '%MULTIFUNCIONAL%' then 1 when puestox like '%GERENTE%' then 4 when puestox like '%MEDICO%' then 5 else 2 end as clvpuesto, succ as clvsucursal, correo
FROM catalogo.cat_empleado c
where tipo = 1 and (succ between 101 and 2999 and succ not in(900)) or (nomina in(SELECT nomina FROM compras.usuarios u where nivel = 13 and id_plaza > 0) and tipo = 1) or (nomina in(SELECT nomina FROM compras.usuarios u where nivel = 12 and id_plaza > 0) and tipo = 1)
UNION ALL
SELECT nomina as clvusuario, md5(pdvpw) as password, trim(upper(completo)) as nombreusuario, tipo as estaactivo, 6 as clvpuesto, succ as clvsucursal, correo
FROM catalogo.cat_empleado c
where nomina in(select nomina from catalogo.pdv_usuarios_sistemas)
;";

        $query = $this->db->query($sql);
        
        return $query->result();
    }
    
    function getCatSucursal()
    {
        $sql = "SELECT suc as clvsucursal, trim(nombre) as descsucursal, 0 as tiposucursal, juris as numjurisd,
case when dia = 'LUN' then 0 when dia = 'MAR' then 1 when dia = 'MIE' then 2 when dia = 'JUE' then 3 when dia = 'VIE' then 4 when dia = 'SAB' then 5 else 6 end as diaped,
trim(dire) as calle, ' ' as noexterior, ' ' as nointerior, trim(col) as colonia, trim(pobla) as municipio, ' ' as estado, ' ' as pais, cp, cia, 1 as activa
FROM catalogo.sucursal s
where (suc between 100 and 2899 and tipo1 = 'A' and tlid =  1) or suc = 0;";

        $query = $this->db->query($sql);
        
        return $query->result();
    }

    function getCatCia()
    {
        $FE = $this->load->database('facturacion', TRUE);
        $sql = "SELECT cia_id as cia, rfc, razon, calle, exterior, interior, colonia, referencia, municipio, ciudad, estado, pais, cp, tel, email, created_at, updated_at, timbra, compania FROM cia where cia_id in(1,2,4,12,13);";
        $query = $FE->query($sql);

        return $query->result();
    }

    function getTarjetaByCodigo($codigo)
    {
        $sql = "SELECT codigo, nombre, vigencia, case when DATEDIFF(vigencia, now()) >= 0 then 1 else 0 end as vigente, case when DATEDIFF(vigencia, now()) and tipo = 1 then 10 else 0 end as descuento FROM vtadc.tarjetas t WHERE codigo = ? and tipo = 1;";
        
        $query = $this->db->query($sql, (double)$codigo);
        
        return $query->result();
    }

    function getTransitoByClvsucursal($clvsucursal)
    {
        $sql = "SELECT * from (SELECT movimientoID, referencia, fechaCierre, clvsucursal, descsucursal, observaciones, sum(piezas) as enviadas, sum(aplicadas) as recibidas, sum(cast(piezas as signed) - cast(aplicadas as signed)) as piezas
FROM spcentral.movimiento m
join spcentral.movimiento_detalle d using(movimientoID)
join spcentral.sucursales s using(clvsucursal)
where tipoMovimiento = 2 and statusMovimiento = 1 and clvsucursalReferencia = $clvsucursal
group by movimientoID
having sum(cast(aplicadas as signed)) = 0
union all
SELECT movimientoID, referencia, fechaCierre, clvsucursal, descsucursal, observaciones, sum(piezas) as enviadas, sum(aplicadas) as recibidas, sum(cast(piezas as signed) - cast(aplicadas as signed)) as piezas
FROM patente2.movimiento m
join patente2.movimiento_detalle d using(movimientoID)
join patente2.sucursales s using(clvsucursal)
where tipoMovimiento = 2 and statusMovimiento = 1 and clvsucursalReferencia = $clvsucursal
group by movimientoID
having sum(cast(aplicadas as signed)) = 0
union all
SELECT movimientoID, referencia, fechaCierre, clvsucursal, descsucursal, observaciones, sum(piezas) as enviadas, sum(aplicadas) as recibidas, sum(cast(piezas as signed) - cast(aplicadas as signed)) as piezas
FROM controlado.movimiento m
join controlado.movimiento_detalle d using(movimientoID)
join controlado.sucursales s using(clvsucursal)
where tipoMovimiento = 2 and statusMovimiento = 1 and clvsucursalReferencia = $clvsucursal
group by movimientoID
having sum(cast(aplicadas as signed)) = 0
) as t order by fechaCierre desc 
;";
        
        $query = $this->db->query($sql);

        return $query->result();

    }

    function getTraspasosValidadosByClvsucursal($clvsucursal)
    {
        $sql = "SELECT * from (SELECT movimientoID, referencia, fechaCierre, clvsucursal, descsucursal, observaciones, sum(piezas) as enviadas, sum(aplicadas) as recibidas, sum(cast(piezas as signed) - cast(aplicadas as signed)) as piezas
FROM spcentral.movimiento m
join spcentral.movimiento_detalle d using(movimientoID)
join spcentral.sucursales s using(clvsucursal)
where tipoMovimiento = 2 and statusMovimiento = 1 and clvsucursalReferencia = $clvsucursal
group by movimientoID
having sum(cast(aplicadas as signed)) > 0
union all
SELECT movimientoID, referencia, fechaCierre, clvsucursal, descsucursal, observaciones, sum(piezas) as enviadas, sum(aplicadas) as recibidas, sum(cast(piezas as signed) - cast(aplicadas as signed)) as piezas
FROM patente2.movimiento m
join patente2.movimiento_detalle d using(movimientoID)
join patente2.sucursales s using(clvsucursal)
where tipoMovimiento = 2 and statusMovimiento = 1 and clvsucursalReferencia = $clvsucursal
group by movimientoID
having sum(cast(aplicadas as signed)) > 0
union all
SELECT movimientoID, referencia, fechaCierre, clvsucursal, descsucursal, observaciones, sum(piezas) as enviadas, sum(aplicadas) as recibidas, sum(cast(piezas as signed) - cast(aplicadas as signed)) as piezas
FROM controlado.movimiento m
join controlado.movimiento_detalle d using(movimientoID)
join controlado.sucursales s using(clvsucursal)
where tipoMovimiento = 2 and statusMovimiento = 1 and clvsucursalReferencia = $clvsucursal
group by movimientoID
having sum(cast(aplicadas as signed)) > 0
) as t order by fechaCierre desc 
;";
        
        $query = $this->db->query($sql);

        return $query->result();

    }

    function getTransitoDetalleByReferencia($referencia)
    {
        $sql = "SELECT * from (SELECT id, cvearticulo, susa, descripcion, pres, piezas, aplicadas, lote, caducidad, tipoprod, ean, marca, costo, UPPER(comercial) as comercial, movimientoDetalle
FROM spcentral.movimiento m
join spcentral.movimiento_detalle d using(movimientoID)
join spcentral.articulos a using(id)
where statusMovimiento = 1 and referencia = '$referencia'
union all
SELECT id, cvearticulo, susa, descripcion, pres, piezas, aplicadas, lote, caducidad, tipoprod, ean, marca, costo, UPPER(comercial) as comercial, movimientoDetalle
FROM controlado.movimiento m
join controlado.movimiento_detalle d using(movimientoID)
join controlado.articulos a using(id)
where statusMovimiento = 1 and referencia = '$referencia'
union all
SELECT id, cvearticulo, susa, descripcion, pres, piezas, aplicadas, lote, caducidad, tipoprod, ean, marca, costo, UPPER(comercial) as comercial, movimientoDetalle
FROM patente2.movimiento m
join patente2.movimiento_detalle d using(movimientoID)
join patente2.articulos a using(id)
where statusMovimiento = 1 and referencia = '$referencia'
) as t order by tipoprod, cvearticulo * 1
;";
        
        $query = $this->db->query($sql);

        return $query->result();

    }

    function getTransitoControlByReferencia($referencia)
    {
        $sql = "SELECT fecha, clvsucursal, observaciones
FROM spcentral.movimiento m
where statusMovimiento = 1 and referencia = '$referencia'
union all
SELECT fecha, clvsucursal, observaciones
FROM controlado.movimiento m
where statusMovimiento = 1 and referencia = '$referencia'
union all
SELECT fecha, clvsucursal, observaciones
FROM patente2.movimiento m
where statusMovimiento = 1 and referencia = '$referencia'
;";
        
        $query = $this->db->query($sql);

        return $query->result();

    }

    function getLastOrdenes()
    {
        $sql = "SELECT id_orden, folprv, prv, razo, fecha_captura, fecha_envio, fecha_limite, sum(cans) as cans, sum(aplica) as aplica, fecha_limite >= date(now()) as activa
from compras.orden_c c
join compras.orden_d d using(id_orden)
left join catalogo.provedor p on c.prv = p.prov
where id_estado not in(7, 8) and c.tipo = 1 and fecha_captura >= date(now()) - interval 6 month
group by id_orden
order by folprv desc;";
        
        $query = $this->db->query($sql);

        return $query->result();
    }

    function getDetalleOrdenByIDOrden($id_orden)
    {
        $sql = "SELECT * FROM compras.orden_d o
where id_orden = ?;";
        
        $query = $this->db->query($sql, $id_orden);
        return $query->result();
    }

    function getOrdenCompraPendiente()
    {
        $sql = "SELECT id_orden, prv, razo, fecha_envio, fecha_limite, folprv, sum(cans) as cans, sum(aplica) as aplica
FROM orden_c o
join orden_d using(id_orden)
left join catalogo.provedor p on prv = prov
where embarca = 12000 and recibe = 12000 and fecha_limite >= date(now()) and o.tipo = 1
group by id_orden
having cans <> aplica
order by folprv;";
        
        $query = $this->db->query($sql, $id_orden);
        return $query->result();
    }

}