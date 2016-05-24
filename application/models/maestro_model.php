<?php
class Maestro_model extends CI_Model
{


    public function consulta_secuencia($limit, $offset = 0)
    {
        $this->db->limit($limit, $offset);

        $q = $this->db->get('maestro.secuencia');
        //echo $this->db->last_query();
        //die();
        return $q;
    }

    public function getSecuenciaAll()
    {
        $sql = "SELECT * FROM maestro.secuencia s join maestro.secuenciastatus using(secuenciastatus);";
        $q = $this->db->query($sql);
        return $q;
    }

    public function getSecuenciaBySustancia($dato)
    {
        $this->db->or_like('sustanciaActiva', $dato);
        $query = $this->db->get('maestro.secuencia');

        return $query;
    }

    public function getSecuenciaBySustanciaGobierno($dato)
    {
        $this->db->or_like('nombreGenerico', $dato);
        $this->db->or_like('formaFarmaceutica', $dato);
        $query = $this->db->get('maestro.gobierno');

        return $query;
    }

    public function getSecuenciaBySecuencia($dato)
    {
        $this->db->where('secuencia', $dato);
        $query = $this->db->get('maestro.secuencia');

        return $query;
    }

    public function getGobiernoByClave($dato)
    {
        $this->db->where('clave', $dato);
        $query = $this->db->get('maestro.gobierno');

        return $query;
    }

    public function getProductoByIDProducto($dato)
    {
        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea');
        $this->db->where('idProducto', $dato);
        $query = $this->db->get();

        return $query;
    }

    function getProductoByEAN($dato)
    {
        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea', 'LEFT');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea', 'LEFT');
        $this->db->where('ean', $dato);
        $query = $this->db->get();

        return $query;
    }

    function getProductoByDescrpcion($dato)
    {
        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea');
        $this->db->or_like('descripcion', $dato);
        $this->db->or_like('sustancia', $dato);
        $this->db->or_like('laboratorioProvisional', $dato);
        $query = $this->db->get();

        return $query;
    }

    function getProductoBySecuencia($dato)
    {
        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea');
        $this->db->where('secuencia', $dato);
        $query = $this->db->get();

        return $query;
    }

    function getProductoByClave($dato)
    {
        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea');
        $this->db->where('clave', $dato);
        $query = $this->db->get();

        return $query;
    }

    public function consulta_secuencia_cuenta()
    {
        $this->db->select('secuencia');
        $q = $this->db->get('maestro.secuencia');
        //echo $this->db->last_query();
        //die();
        return $q->num_rows();
    }

    public function captura_secuencia()
    {
        $s = "SELECT * FROM maestro.secuencia";
        $q = $this->db->query($s);
        $si = $q->num_rows();

        $data = array(
            'secuencia' => $this->input->post('secuencia'),
            'sustanciaActiva' => $this->input->post('sustanciaActiva'),
            'ventaDrd' => $this->input->post('ventaDrd'),
            'ventaGen' => $this->input->post('ventaGen'),
            'ventaFen' => $this->input->post('ventaFen'),
            'ventaFbo' => $this->input->post('ventaFbo'),
            );
        $this->db->insert('maestro.secuencia', $data);
    }

    function actualiza_model_secuencia($secuencia, $sustanciaActiva, $ventaDrd, $ventaGen,
        $ventaFen, $ventaFbo)
    {
        $data = array(

            'sustanciaActiva' => $sustanciaActiva,
            'ventaDrd' => $ventaDrd,
            'ventaGen' => $ventaGen,
            'ventaFen' => $ventaFen,
            'ventaFbo' => $ventaFbo);

        $this->db->set('secuenciaCambio', 'now()', false);
        $this->db->where('secuencia', $secuencia);
        $this->db->update('maestro.secuencia', $data);
        return $this->db->affected_rows();
    }

    function getSecuencia($secuencia)
    {
        $this->db->where('secuencia', $secuencia);
        $query = $this->db->get('maestro.secuencia')->row();

        return $query;
    }


    public function consulta_gobierno($limit, $offset = 0)
    {
        $this->db->limit($limit, $offset);
        $this->db->order_by('clave * 1');
        $q = $this->db->get('maestro.gobierno');

        //echo $this->db->last_query();
        //die();
        return $q;
    }

    public function getGobiernoAll()
    {
        $sql = "SELECT * FROM maestro.gobierno g
join maestro.gobiernotipo t using(gobiernoTipo)
join maestro.gobiernoStatus s using(gobiernoStatus)
order by gobiernoTipo, clave * 1;";
        $q = $this->db->query($sql);

        //echo $this->db->last_query();
        //die();
        return $q;
    }

    public function consulta_gobierno_cuenta()
    {
        $this->db->select('clave');
        $q = $this->db->get('maestro.gobierno');
        //echo $this->db->last_query();
        //die();
        return $q->num_rows();
    }


    public function captura_gobierno()
    {
        $s = "SELECT * FROM maestro.gobierno";
        $q = $this->db->query($s);
        $si = $q->num_rows();

        $data = array(
            'clave' => $this->input->post('clave'),
            'nombreGenerico' => $this->input->post('nombreGenerico'),
            'formaFarmaceutica' => $this->input->post('formaFarmaceutica'),
            'concentracion' => $this->input->post('concentracion'),
            'presentacion' => $this->input->post('presentacion'),
            'unidadMedida' => $this->input->post('unidadMedida'),
            );
        $this->db->insert('maestro.gobierno', $data);
    }

    function actualiza_model_gobierno($clave, $nombreGenerico, $formaFarmaceutica, $concentracion,
        $presentacion, $unidadMedida, $envase)
    {
        $data = array(

            'nombreGenerico' => $nombreGenerico,
            'formaFarmaceutica' => $formaFarmaceutica,
            'concentracion' => $concentracion,
            'presentacion' => $presentacion,
            'unidadMedida' => $unidadMedida,
            'envase' => $envase);

        $this->db->set('gobiernoCambio', 'now()', false);
        $this->db->where('clave', $clave);
        $this->db->update('maestro.gobierno', $data);
        return $this->db->affected_rows();
    }

    function getClaveGobierno($clave)
    {
        $this->db->where('clave', $clave);
        $query = $this->db->get('maestro.gobierno')->row();

        return $query;
    }


    public function consulta_linea()
    {
        $s = "SELECT * FROM maestro.linea;";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
    }

    public function captura_linea()
    {
        $s = "SELECT * FROM maestro.linea";
        $q = $this->db->query($s);
        $si = $q->num_rows();

        $data = array(
            'idLinea' => $this->input->post('idLinea'),
            'linea' => $this->input->post('linea'),
            );
        $this->db->insert('maestro.linea', $data);
    }

    function actualiza_model_linea($idLinea, $linea)
    {
        $data = array('linea' => $linea);

        $this->db->where('idLinea', $idLinea);
        $this->db->update('maestro.linea', $data);
        return $this->db->affected_rows();
    }

    function getLinea($idLinea)
    {
        $this->db->where('idLinea', $idLinea);
        $query = $this->db->get('maestro.linea')->row();

        return $query;
    }

    public function consulta_sublinea()
    {
        $s = "SELECT * FROM maestro.sublinea s join maestro.linea using(idLinea);";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
    }

    public function captura_sublinea()
    {
        $s = "SELECT * FROM maestro.sublinea";
        $q = $this->db->query($s);
        $si = $q->num_rows();

        $data = array(
            'idLinea' => $this->input->post('idLinea'),
            'idSublinea' => $this->input->post('idSublinea'),
            'sublinea' => $this->input->post('sublinea'),
            );
        $this->db->insert('maestro.sublinea', $data);
    }

    function actualiza_model_sublinea($idLinea, $idSublinea, $sublinea)
    {
        $data = array('idSublinea' => $idSublinea, 'sublinea' => $sublinea);

        $this->db->where('idLinea', $idLinea);
        $this->db->update('maestro.sublinea', $data);
        return $this->db->affected_rows();
    }

    function getSublinea($idLinea)
    {
        $this->db->where('idLinea', $idLinea);
        $query = $this->db->get('maestro.sublinea')->row();

        return $query;
    }

    public function consulta_laboratorio()
    {
        $s = "SELECT * FROM maestro.laboratorio;";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
    }

    public function captura_laboratorio()
    {
        $s = "SELECT * FROM maestro.laboratorio";
        $q = $this->db->query($s);
        $si = $q->num_rows();

        $data = array(
            'idLaboratorio' => $this->input->post('idLaboratorio'),
            'laboratorio' => $this->input->post('laboratorio'),
            );
        $this->db->insert('maestro.laboratorio', $data);
    }

    function actualiza_model_laboratorio($idLaboratorio, $laboratorio)
    {
        $data = array('laboratorio' => $laboratorio);

        $this->db->set('laboratorioCambio', 'now()', false);
        $this->db->where('idLaboratorio', $idLaboratorio);
        $this->db->update('maestro.laboratorio', $data);
        return $this->db->affected_rows();
    }

    function getLaboratorio($idLaboratorio)
    {
        $this->db->where('idLaboratorio', $idLaboratorio);
        $query = $this->db->get('maestro.laboratorio')->row();

        return $query;
    }

    public function consulta_proveedor()
    {
        $s = "SELECT * FROM maestro.proveedor;";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
    }

    public function captura_proveedor()
    {
        $s = "SELECT * FROM maestro.proveedor";
        $q = $this->db->query($s);
        $si = $q->num_rows();

        $data = array(
            'idProveedor' => $this->input->post('idProveedor'),
            'rfc' => $this->input->post('rfc'),
            'razonSocial' => $this->input->post('razonSocial'),
            'limiteCredito' => $this->input->post('limiteCredito'),
            );
        $this->db->insert('maestro.proveedor', $data);
    }

    function actualiza_model_proveedor($idProveedor, $rfc, $razonSocial, $limiteCredito)
    {
        $data = array(

            'rfc' => $rfc,
            'razonSocial' => $razonSocial,
            'limiteCredito' => $limiteCredito);

        $this->db->set('proveedorCambio', 'now()', false);
        $this->db->where('idProveedor', $idProveedor);
        $this->db->update('maestro.proveedor', $data);
        return $this->db->affected_rows();
    }

    function getProveedor($idProveedor)
    {
        $this->db->where('idProveedor', $idProveedor);
        $query = $this->db->get('maestro.proveedor')->row();

        return $query;
    }

    public function getSucursalAll()
    {
        $sql = "SELECT tipo2, suc, c.nombre as farmacia, s.nombre, dire, col, cp, pobla, e.estado, brick1300, clasificacion
        FROM catalogo.sucursal s
        left join catalogo.cat_imagen c on s.tipo2=c.tipo
        left join catalogo.cat_estados e on s.estado=e.estado_int
        where suc between 101 and 2200 and tlid=1 and dia<>'cer' and s.suc not in(127, 176, 177, 178, 179, 180, 187)";
        $q = $this->db->query($sql);
        return $q;
    }

    public function consulta_sucursal()
    {
        //$s="SELECT * FROM catalogo.cat_imagen;";
        $s = "SELECT *, (select count(*) from catalogo.sucursal
        where tipo2 = cat_imagen.tipo and clasificacion = 1 and tlid = 1 and dia<>'CER') as clasificacion80,
        (select count(*) from catalogo.sucursal
        where tipo2 = cat_imagen.tipo and clasificacion = 2 and tlid = 1 and dia<>'CER') as clasificacion20
        FROM catalogo.cat_imagen;";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
    }

    function getNombreImagen($tipo)
    {
        $this->db->select('nombre');
        $this->db->where('tipo', $tipo);
        $query = $this->db->get('catalogo.cat_imagen');

        $row = $query->row();
        return $row->nombre;
    }

    public function farmacia_tipo($tipo)
    {
        $s = "SELECT tipo2, suc, nombre, dire, col, cp, pobla, e.estado, brick1300, clasificacion
        FROM catalogo.sucursal s
        left join catalogo.cat_estados e on s.estado=e.estado_int
        where suc between 101 and 2200 and tlid=1 and dia<>'cer' and tipo2=? and s.suc not in(127, 176, 177, 178, 179, 180, 187)";
        $q = $this->db->query($s, $tipo);
        //echo $this->db->last_query();
        //die();
        return $q;
    }

    public function mas_vendidos_precio($suc)
    {
        $s = "SELECT codigo, descri, sum(can-cancela) as cantidad, sum(importe-cancela*vta) as importe FROM vtadc.venta_detalle v
        where suc=? group by codigo order by importe desc limit 1000";
        $q = $this->db->query($s, $suc);
        //echo $this->db->last_query();
        //die();
        return $q;
    }

    public function mas_vendidos_pieza($suc)
    {
        $s = "SELECT codigo, descri, sum(can-cancela) as cantidad, sum(importe-cancela*vta) as importe FROM vtadc.venta_detalle v
        where suc=? group by codigo order by cantidad desc limit 1000";
        $q = $this->db->query($s, $suc);
        //echo $this->db->last_query();
        //die();
        return $q;
    }

    function getNombreSucursal($suc)
    {
        $this->db->select('nombre');
        $this->db->where('suc', $suc);
        $query = $this->db->get('catalogo.sucursal');

        $row = $query->row();
        return $row->nombre;
    }

    public function farmacia_tipo_clasificacion($tipo, $clasificacion)
    {
        $s = "SELECT ranking, tipo2, suc, nombre, dire, col, cp, pobla, e.estado, brick1300, clasificacion
        FROM catalogo.sucursal s
        left join catalogo.cat_estados e on s.estado=e.estado_int
        where suc between 101 and 2200 and tlid=1 and dia<>'cer' and tipo2=? and s.suc not in(127, 176, 177, 178, 179, 180, 187) and clasificacion=?";
        $q = $this->db->query($s, array($tipo, $clasificacion));
        //echo $this->db->last_query();
        //die();
        return $q;
    }

    public function consulta_producto($limit, $offset = 0)
    {
        $this->db->limit($limit, $offset);

        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea');
        $q = $this->db->get();
        //echo $this->db->last_query();
        //die();
        return $q;
    }

    public function getProductoAll()
    {
        $sql = "SELECT idProducto, ean, descripcion, sustancia, linea, sublinea, productoStatusDescripcion, secuencia, clave, laboratorioProvisional, registro, precioMaximoPublico, precioFarmacia, iva, servicio, antibiotico, descontinuado, productoAlta, productoBaja, productoCambio FROM maestro.producto p
join maestro.linea l using(idLinea)
join maestro.sublinea s using(idLinea, idSublinea)
join maestro.productostatus e using(productoStatus)
order by idLinea, idSublinea, descripcion
;";
        $query = $this->db->query($sql);
        return $query;
    }
    
    public function get_ultimosCostos_All()
    {
        $sql = "SELECT distinct sec, prv, razo, codigo, sustanciaActiva, clave, costo, fechai FROM desarrollo.compra_ultimo_precio c
            join desarrollo.compra_ultimo_precio2 d using(sec, prv, fechai)
            left join catalogo.provedor p on p.prov = c.prv
            left join maestro.secuencia a on a.secuencia = c.sec;";
        $query = $this->db->query($sql);
        return $query;
    }

    public function consulta_producto_cuenta()
    {
        $this->db->select('idProducto');
        $q = $this->db->get('maestro.producto');
        //echo $this->db->last_query();
        //die();
        return $q->num_rows();
    }

    function addProducto($ean, $descripcion, $sustancia, $formaFarmaceutica, $concentracion,
        $presentacion, $unidadMedida, $idLaboratorio, $laboratorioProvisional, $registro,
        $secuencia, $precioMaximoPublico, $precioFarmacia, $clave, $iva, $servicio, $idLinea,
        $idSublinea, $antibiotico, $claseTerapeutica)
    {
        $data = array(
            'ean' => $ean,
            'descripcion' => trim($descripcion),
            'sustancia' => trim($sustancia),
            'formaFarmaceutica' => trim($formaFarmaceutica),
            'concentracion' => trim($concentracion),
            'presentacion' => trim($presentacion),
            'unidadMedida' => trim($unidadMedida),
            'idLaboratorio' => $idLaboratorio,
            'laboratorioProvisional' => trim($laboratorioProvisional),
            'registro' => trim($registro),
            'secuencia' => $secuencia,
            'precioMaximoPublico' => $precioMaximoPublico,
            'precioFarmacia' => $precioFarmacia,
            'clave' => $clave,
            'iva' => $iva,
            'servicio' => $servicio,
            'idLinea' => $idLinea,
            'idSublinea' => $idSublinea,
            'antibiotico' => $antibiotico,
            'claseTerapeutica' => trim($claseTerapeutica),
            'id' => $this->session->userdata('id_desarro'));

        $this->db->insert('maestro.producto', $data);
        return $this->db->insert_id();
    }

    function changeProducto($idProducto, $ean, $descripcion, $sustancia, $formaFarmaceutica,
        $concentracion, $presentacion, $unidadMedida, $idLaboratorio, $laboratorioProvisional,
        $registro, $secuencia, $precioMaximoPublico, $precioFarmacia, $clave, $iva, $servicio,
        $idLinea, $idSublinea, $antibiotico, $claseTerapeutica)
    {
        $data = array(
            'ean' => $ean,
            'descripcion' => trim($descripcion),
            'sustancia' => trim($sustancia),
            'formaFarmaceutica' => trim($formaFarmaceutica),
            'concentracion' => trim($concentracion),
            'presentacion' => trim($presentacion),
            'unidadMedida' => trim($unidadMedida),
            'idLaboratorio' => $idLaboratorio,
            'laboratorioProvisional' => trim($laboratorioProvisional),
            'registro' => trim($registro),
            'secuencia' => $secuencia,
            'precioMaximoPublico' => $precioMaximoPublico,
            'precioFarmacia' => $precioFarmacia,
            'clave' => $clave,
            'iva' => $iva,
            'servicio' => $servicio,
            'idLinea' => $idLinea,
            'idSublinea' => $idSublinea,
            'antibiotico' => $antibiotico,
            'claseTerapeutica' => trim($claseTerapeutica),
            'id' => $this->session->userdata('id_desarro'));

        $this->db->set('productoCambio', 'now()', false);
        $this->db->update('maestro.producto', $data, array('idProducto' => $idProducto));
        return $this->db->affected_rows();
    }

    public function captura_producto()
    {
        $s = "SELECT * FROM maestro.producto";
        $q = $this->db->query($s);
        $si = $q->num_rows();

        $data = array(
            'idProducto' => $this->input->post('idProducto'),
            'ean' => $this->input->post('ean'),
            'descripcion' => $this->input->post('descripcion'),
            'sustancia' => $this->input->post('sustancia'),
            'secuencia' => $this->input->post('secuencia'),
            'precioMaximoPublico' => $this->input->post('precioMaximoPublico'),
            'precioFarmacia' => $this->input->post('precioFarmacia'),

            );
        $this->db->insert('maestro.producto', $data);
    }

    function actualiza_model_producto($idProducto, $ean, $descripcion, $precioMaximoPublico,
        $precioFarmacia)
    {
        $data = array(

            'ean' => $ean,
            'descripcion' => $descripcion,
            'precioMaximoPublico' => $precioMaximoPublico,
            'precioFarmacia' => $precioFarmacia);

        $this->db->set('productoCambio', 'now()', false);
        $this->db->where('idProducto', $idProducto);
        $this->db->update('maestro.producto', $data);
        return $this->db->affected_rows();
    }

    function getProducto($idProducto)
    {
        $this->db->where('idProducto', $idProducto);
        $query = $this->db->get('maestro.producto')->row();

        return $query;
    }

    function getLineaCombo()
    {
        $query = $this->db->get('maestro.linea');

        $a = array();

        foreach ($query->result() as $row) {
            $a[$row->idLinea] = $row->linea;
        }

        return $a;
    }

    function getSublineaCombo($idLinea = 0)
    {
        $this->db->where('idLinea', $idLinea);
        $query = $this->db->get('maestro.sublinea');

        $a = array();

        foreach ($query->result() as $row) {
            $a[$row->idSublinea] = $row->sublinea;
        }

        return $a;
    }

    function getSublineaSelect($idLinea = 0)
    {
        $this->db->where('idLinea', $idLinea);
        $query = $this->db->get('maestro.sublinea');

        $a = null;

        foreach ($query->result() as $row) {
            $a .= '<option value="' . $row->idSublinea . '">' . $row->idSublinea . ' - ' . $row->
                sublinea . '</option>';
        }

        return $a;
    }

    function getCuentaProductosProveedor($idProveedor)
    {
        $sql = "SELECT count(*) as cuenta FROM maestro.catalogoproveedor c
join maestro.producto using(idProducto)
where idProveedor = ?;";

        $row = $this->db->query($sql, $idProveedor)->row();

        return $row->cuenta;

    }

    function getproductosByProveedor($idProveedor, $limit, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.catalogoproveedor c', 'p.idProducto = c.idProducto');
        $this->db->join('maestro.proveedor v', 'c.idProveedor = v.idProveedor');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea');
        $this->db->where('c.idProveedor', $idProveedor);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();


        return $query;
    }

    function getProductoByIDProductoProveedor($dato, $idProveedor)
    {
        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.catalogoproveedor c', 'p.idProducto = c.idProducto');
        $this->db->join('maestro.proveedor v', 'c.idProveedor = v.idProveedor');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea');
        if ($idProveedor == 0) {

        } else {
            $this->db->where('c.idProveedor', $idProveedor);
        }
        $this->db->where('p.idProducto', $dato);
        $query = $this->db->get();


        return $query;
    }

    function getProductoByDescripcionProveedor($dato, $idProveedor)
    {
        if ($idProveedor == 0) {
            $sql = "SELECT * FROM maestro.producto p
    JOIN maestro.catalogoproveedor c using(idProducto)
    JOIN maestro.proveedor v using(idProveedor)
    JOIN maestro.linea l using(idLinea)
    JOIN maestro.sublinea s using(idLinea, idSublinea)
    WHERE (p.descripcion LIKE '%$dato%' OR sustancia LIKE '%$dato%');";

            $query = $this->db->query($sql);
        } else {
            $sql = "SELECT * FROM maestro.producto p
    JOIN maestro.catalogoproveedor c using(idProducto)
    JOIN maestro.proveedor v using(idProveedor)
    JOIN maestro.linea l using(idLinea)
    JOIN maestro.sublinea s using(idLinea, idSublinea)
    WHERE idProveedor = ? AND (p.descripcion LIKE '%$dato%' OR sustancia LIKE '%$dato%');";

            $query = $this->db->query($sql, $idProveedor);
        }


        return $query;
    }

    function getProductoByEANProveedor($dato, $idProveedor)
    {
        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.catalogoproveedor c', 'p.idProducto = c.idProducto');
        $this->db->join('maestro.proveedor v', 'c.idProveedor = v.idProveedor');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea');
        $this->db->where('c.idProveedor', $idProveedor);
        $this->db->where('p.ean', $dato);
        $query = $this->db->get();


        return $query;
    }

    function getProductoBySecuenciaProveedor($dato, $idProveedor)
    {
        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.catalogoproveedor c', 'p.idProducto = c.idProducto');
        $this->db->join('maestro.proveedor v', 'c.idProveedor = v.idProveedor');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea');
        $this->db->where('c.idProveedor', $idProveedor);
        $this->db->where('p.secuencia', $dato);
        $query = $this->db->get();


        return $query;
    }

    function getProductoByClaveProveedor($dato, $idProveedor)
    {
        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.catalogoproveedor c', 'p.idProducto = c.idProducto');
        $this->db->join('maestro.proveedor v', 'c.idProveedor = v.idProveedor');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea');
        $this->db->where('c.idProveedor', $idProveedor);
        $this->db->where('p.clave', $dato);
        $query = $this->db->get();


        return $query;
    }

    function getCuentaProductosAll()
    {
        $sql = "SELECT count(*) as cuenta FROM maestro.catalogoproveedor c
join maestro.producto using(idProducto);";

        $row = $this->db->query($sql)->row();

        return $row->cuenta;

    }

    function getproductosAll($limit, $offset = 0)
    {
        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.catalogoproveedor c', 'p.idProducto = c.idProducto');
        $this->db->join('maestro.proveedor v', 'c.idProveedor = v.idProveedor');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();


        return $query;
    }

    function getproductosAllNoLimit()
    {
        $this->db->select('*');
        $this->db->from('maestro.producto p');
        $this->db->join('maestro.catalogoproveedor c', 'p.idProducto = c.idProducto');
        $this->db->join('maestro.proveedor v', 'c.idProveedor = v.idProveedor');
        $this->db->join('maestro.linea l', 'p.idLinea = l.idLinea');
        $this->db->join('maestro.sublinea s',
            'p.idLinea = s.idLinea and p.idSublinea = s.idSublinea');
        $query = $this->db->get();


        return $query;
    }

    function getLaboratorioCombo()
    {
        $query = $this->db->get('maestro.laboratorio');

        $a = array();

        foreach ($query->result() as $row) {
            $a[$row->idLaboratorio] = $row->laboratorio;
        }

        return $a;

    }

    function getSecuenciaCombo()
    {
        $query = $this->db->get('maestro.secuencia');

        $a = array();

        foreach ($query->result() as $row) {
            $a[$row->secuencia] = $row->secuencia . ' - ' . $row->sustanciaActiva;
        }

        return $a;

    }

    function getGobiernoCombo()
    {
        $sql = "SELECT clave, ifnull(concat(nombreGenerico, ' ', formaFarmaceutica, ' ', concentracion, ' ', presentacion), 'SIN CLAVE') as descripcion FROM maestro.gobierno g where clave <> '' order by gobiernoTipo, clave * 1;";
        $query = $this->db->query($sql);

        $a = array();

        foreach ($query->result() as $row) {
            $a[$row->clave] = $row->clave . ' - ' . $row->descripcion;
        }

        return $a;

    }

    function getSiNo()
    {
        $a = array('0' => 'NO', '1' => 'SI');

        return $a;
    }

    function get8020($mes, $tipo)
    {
        $mes = $mes * 1;
        $sql1 = "SELECT  sum(importe$mes) as venta
FROM vtadc.producto_mes_suc p
left join catalogo.sucursal  s on s.suc=p.suc
where s.suc between 101 and 2200 and tlid=1 and dia<>'cer' and tipo2='$tipo' and s.suc not in(127, 176, 177, 178, 179, 180, 187)
order by venta desc";

        $sql2 = "SELECT p.suc, sum(importe$mes) as venta, s.clasificacion
FROM vtadc.producto_mes_suc p
left join catalogo.sucursal  s on s.suc=p.suc
where s.suc between 101 and 2200 and tlid=1 and dia<>'cer' and tipo2='$tipo' and s.suc not in(127, 176, 177, 178, 179, 180, 187)
group by p.suc order by venta desc";


        $query1 = $this->db->query($sql1);
        $row1 = $query1->row();

        $query2 = $this->db->query($sql2);


        $tope = $row1->venta * .8;

        $venta_acumulada = 0;

        $res = "Resultado<br /><br />";

        $num = 1;

        foreach ($query2->result() as $row2) {
            $venta_acumulada = $venta_acumulada + $row2->venta;

            $res .= "Sucursal: " . $row2->suc . "<br />";
            $res .= "Venta acumulada: " . number_format($venta_acumulada, 2) . "<br />";
            $res .= "Tope: " . number_format($tope, 2) . "<br /><br />";

            if ($venta_acumulada <= $tope) {
                $data = array('clasificacion' => 1, 'ranking' => $num);
                $this->db->update('catalogo.sucursal', $data, array('suc' => $row2->suc));
                $res .= "Clasificacion: 1";
            } else {
                $data = array('clasificacion' => 2, 'ranking' => $num);
                $this->db->update('catalogo.sucursal', $data, array('suc' => $row2->suc));
                $res .= "Clasificacion: 2";
            }

            $num++;
        }

        return $res;

    }


    function actualiza_model_brick1300($suc, $brick1300)
    {
        $data = array('brick1300' => $brick1300);

        $this->db->set('brick1300', $brick1300);
        $this->db->where('suc', $suc);
        $this->db->update('catalogo.sucursal', $data);
        return $this->db->affected_rows();

    }
    
    function productos_actuales()
    {
        return $this->db->count_all('maestro.producto');
    }
    
    function productos_sin_sustancia()
    {
        $sql = "SELECT idProducto FROM maestro.producto p where sustancia is null;";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function productos_sin_precioMaximoPublico()
    {
        $sql = "SELECT idProducto FROM maestro.producto p where precioMaximoPublico = 0;";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function productos_sin_laboratorio()
    {
        $sql = "SELECT idProducto FROM maestro.producto p where laboratorioProvisional is null;";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function productos_sin_linea()
    {
        $sql = "SELECT idProducto FROM maestro.producto p where idLinea = 0;";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function productos_sin_sublinea()
    {
        $sql = "SELECT idProducto FROM maestro.producto p where idLinea > 0 and idSublinea = 0;";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function productos_sin_formaFarmaceutica()
    {
        $sql = "SELECT idProducto FROM maestro.producto p where formaFarmaceutica is null;";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function productos_sin_concentracion()
    {
        $sql = "SELECT idProducto FROM maestro.producto p where concentracion is null;";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    
    public function consulta_costos_cedis()
    {
        $s = "SELECT * FROM maestro.secuencia where secuenciaStatus=1;";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    public function mostrar_consulta_costos_cedis($secuencia)
    {
        $s = "SELECT a.codigo, a.sec, c.sustanciaActiva, a.lote, a.cadu, a.costo, d.razonSocial, a.fechai
                FROM desarrollo.compra_d a
                left join desarrollo.compra_c b on id_cc=b.id
                left join maestro.secuencia c on sec=secuencia
                left join maestro.proveedor d on idProveedor=prv
                where b.tipo='C' and a.sec = ? order by a.fechai desc;";
        $q = $this->db->query($s, $secuencia);
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    
     public function consulta_ultimos_costos()
    {
        $s = "SELECT distinct sec, prv, razo, codigo, sustanciaActiva, clave, costo, fechai FROM desarrollo.compra_ultimo_precio c
            join desarrollo.compra_ultimo_precio2 d using(sec, prv, fechai)
            left join catalogo.provedor p on p.prov = c.prv
            left join maestro.secuencia a on a.secuencia = c.sec;";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    
    function getUltimoCostoSecuencia()
    {
        $sql = "SELECT distinct * FROM compra_ultimo_precio c
join compra_ultimo_precio2 d using(sec, prv, fechai)
left join maestro.secuencia s on c.sec = s.secuencia
left join maestro.proveedor p on c.prv = idProveedor;";
        $query  = $this->db->query($sql);
        return $query;
    }
    
    function getFirstElement()
    {
        $sql = "SELECT * FROM maestro.secuencia s where clave = '' and secuenciaStatus = 1 limit 1;";
        $query = $this->db->query($sql);
        return $query;
    }

}
