<?php
class Requisiciones_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getRequisicionByEstatus($estatus)
    {
        $sql = "SELECT * 
        FROM desarrollo.requisicion_control r
join desarrollo.requisicion_tipo using(tipo)
join desarrollo.requisicion_estatus using(estatus)
join catalogo.sucursal using(suc)
where r.estatus = ?;";

        $query = $this->db->query($sql, $estatus);
        
        return $query;
    }

    function getDetallebyRequisicion($requisicion)
    {
        $sql = "SELECT * 
        FROM desarrollo.requisicion_detalle r
join catalogo.secuencias using(sec)
where requisicion = ?
having cantidad > 0;";


        $query = $this->db->query($sql, $requisicion);
        
        return $query;
    }

    function getRequisicionByRequisicion($requisicion)
    {
        $sql = "SELECT * FROM desarrollo.requisicion_control r
join desarrollo.requisicion_tipo using(tipo)
join desarrollo.requisicion_estatus using(estatus)
join catalogo.sucursal using(suc)
where r.requisicion = ?;";

        $query = $this->db->query($sql, $requisicion);
        
        return $query;
    }

    function generaPedidoFromRequisicion($requisicion)
    {
        $this->db->trans_start();
        
        $req = $this->getRequisicionByRequisicion($requisicion)->row();
        
        $folioInsert = array(
            'suc' => $req->suc,
            'fechas' => date('Y-m-d'),
            'id_user' => $this->session->userdata('id')
        );
        
        $this->db->insert('catalogo.folio_pedidos_cedis_especial', $folioInsert);
        $folio = $this->db->insert_id();
        
        $sql = "insert into desarrollo.pedidos (suc, fecha, sec, can, fechas, tipo, mue, susa, ped, fol, bloque, tsuc, sur, id_usercap, fechasur, inv, costo, iva, vta, lin, invcedis, verificada)
        (SELECT suc, date(now()), sec, cantidad, now(), 1, mueble, susa1, cantidad, '$folio', ruta, 'G', cantidad, 0, '0000-00-00 00:00:00', 'N', costo, s.iva, vtagen, 0, inv1, 0
FROM desarrollo.requisicion_detalle r
join desarrollo.requisicion_control c using(requisicion)
left join catalogo.almacen_mue a using(sec)
join catalogo.secuencias s using(sec)
join catalogo.almacen_rutas u using(suc)
join desarrollo.inv_cedis_sec1 i using(sec)
WHERE requisicion = ? and cantidad > 0)";

        
        $this->db->query($sql, $requisicion);
        
        $data2 = array(
            'estatus' => 2,
            'id' => $folio,
            'aprobada' => date('Y-m-d H:i:s')
            );
        
        $where = array('requisicion' => $requisicion);
        
        $this->db->update('desarrollo.requisicion_control', $data2, $where);
        
        $this->db->trans_complete();
        
    }
    
    function getRequisiciones()
    {
        $sql = "SELECT r.suc, estatus, tipo, requisicion, fecha, r.id, aprobada, tipoDescripcion, estatusDescripcion, nombre, case when tid = 'A' then 'Abierto' when tid = 'C' then 'Cerrado' when tid = 'X' then 'Cancelado' else 'Indefinido' end as estatusAlmacen, fechasur
FROM desarrollo.requisicion_control r
join desarrollo.requisicion_tipo using(tipo)
join desarrollo.requisicion_estatus using(estatus)
join catalogo.sucursal using(suc)
left join catalogo.folio_pedidos_cedis_especial w on r.id = w.id
where estatus >= 2;";

        $query = $this->db->query($sql);
        
        return $query;
    }

}