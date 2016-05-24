<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Maestro extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('maestro_model');

    }

    function busquedaIDProducto()
    {
        $dato = $this->input->post('dato');
        $data['query'] = $this->maestro_model->getProductoByIDProducto($dato);
        $this->load->view('maestro/busquedaProducto', $data);
    }

    function searchEAN()
    {
        $ean = $this->input->post('ean');
        $query = $this->maestro_model->getProductoByEAN($ean);
        echo $query->num_rows();
    }

    function busquedaEAN()
    {
        $dato = $this->input->post('dato');
        $data['query'] = $this->maestro_model->getProductoByEAN($dato);
        $this->load->view('maestro/busquedaProducto', $data);
    }

    function busquedaDescripcion()
    {
        $dato = $this->input->post('dato');
        $data['query'] = $this->maestro_model->getProductoByDescrpcion($dato);
        $this->load->view('maestro/busquedaProducto', $data);
    }

    function busquedaSecuenciaProducto()
    {
        $dato = $this->input->post('dato');
        $data['query'] = $this->maestro_model->getProductoBySecuencia($dato);
        $this->load->view('maestro/busquedaProducto', $data);
    }

    function busquedaClaveProducto()
    {
        $dato = $this->input->post('dato');
        $data['query'] = $this->maestro_model->getProductoByClave($dato);
        $this->load->view('maestro/busquedaProducto', $data);
    }

    function busquedaIDProductoProveedor()
    {
        $dato = $this->input->post('dato');
        $idProveedor = $this->input->post('idProveedor');
        $data['query'] = $this->maestro_model->getProductoByIDProductoProveedor($dato, $idProveedor);
        $this->load->view('maestro/busquedaProductosByProveedor', $data);
    }

    function busquedaDescripcionProveedor()
    {
        $dato = $this->input->post('dato');
        $idProveedor = $this->input->post('idProveedor');
        $data['query'] = $this->maestro_model->getProductoByDescripcionProveedor($dato,
            $idProveedor);
        $this->load->view('maestro/busquedaProductosByProveedor', $data);
    }

    function busquedaEANProveedor()
    {
        $dato = $this->input->post('dato');
        $idProveedor = $this->input->post('idProveedor');
        $data['query'] = $this->maestro_model->getProductoByEANProveedor($dato, $idProveedor);
        $this->load->view('maestro/busquedaProductosByProveedor', $data);
    }

    function busquedaSecuenciaProductoProveedor()
    {
        $dato = $this->input->post('dato');
        $idProveedor = $this->input->post('idProveedor');
        $data['query'] = $this->maestro_model->getProductoBySecuenciaProveedor($dato, $idProveedor);
        $this->load->view('maestro/busquedaProductosByProveedor', $data);
    }

    function busquedaClaveProductoProveedor()
    {
        $dato = $this->input->post('dato');
        $idProveedor = $this->input->post('idProveedor');
        $data['query'] = $this->maestro_model->getProductoByClaveProveedor($dato, $idProveedor);
        $this->load->view('maestro/busquedaProductosByProveedor', $data);
    }

    function muestra_producto()
    {
        $this->load->library('pagination');
        $this->load->model('maestro_model');
        $config['base_url'] = site_url() . "/maestro/muestra_producto";
        $config['total_rows'] = $this->maestro_model->consulta_producto_cuenta();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '100';
        $config['display_pages'] = true;

        $this->pagination->initialize($config);

        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "PRODUCTO";
        $data['s'] = $this->maestro_model->consulta_producto($config['per_page'], $this->
            uri->segment(3));
        ;
        $data['js'] = 'maestro/muestra_producto_js';
        $this->load->view('main', $data);
    }

    function muestra_producto_excel()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $data['query'] = $this->maestro_model->getProductoAll();
        $this->load->view('excel/muestra_producto_excel', $data);
    }

    function captura_producto()
    {
        $data['titulo'] = "";
        $data['laboratorios'] = $this->maestro_model->getLaboratorioCombo();
        $data['secuencias'] = $this->maestro_model->getSecuenciaCombo();
        $data['gobierno'] = $this->maestro_model->getGobiernoCombo();
        $data['sino'] = $this->maestro_model->getSiNo();
        $data['linea'] = $this->maestro_model->getLineaCombo();
        $data['sublinea'] = $this->maestro_model->getSublineaCombo();
        $data['js'] = 'maestro/captura_producto_js';
        $this->load->view('main', $data);
    }

    function actualizaComboIdSublinea()
    {
        $idLinea = $this->input->post('idLinea');
        echo $this->maestro_model->getSublineaSelect($idLinea);
    }
    
    function saveProducto()
    {
        $ean = $this->input->post('ean');
        $descripcion = $this->input->post('descripcion');
        $sustancia = $this->input->post('sustancia');
        $formaFarmaceutica = $this->input->post('formaFarmaceutica');
        $concentracion = $this->input->post('concentracion');
        $presentacion = $this->input->post('presentacion');
        $unidadMedida = $this->input->post('unidadMedida');
        $idLaboratorio = $this->input->post('idLaboratorio');
        $laboratorioProvisional = $this->input->post('laboratorioProvisional');
        $registro = $this->input->post('registro');
        $secuencia = $this->input->post('secuencia');
        $clave = $this->input->post('clave');
        $precioMaximoPublico = $this->input->post('precioMaximoPublico');
        $precioFarmacia = $this->input->post('precioFarmacia');
        $iva = $this->input->post('iva');
        $servicio = $this->input->post('servicio');
        $idLinea = $this->input->post('idLinea');
        $idSublinea = $this->input->post('idSublinea');
        $antibiotico = $this->input->post('antibiotico');
        $claseTerapeutica = $this->input->post('claseTerapeutica');
        
        echo $this->maestro_model->addProducto($ean, $descripcion, $sustancia, $formaFarmaceutica, $concentracion, $presentacion, $unidadMedida, $idLaboratorio, $laboratorioProvisional, $registro, $secuencia, $precioMaximoPublico, $precioFarmacia, $clave, $iva, $servicio, $idLinea, $idSublinea, $antibiotico, $claseTerapeutica);
    }

    function updateProducto()
    {
        $idProducto = $this->input->post('idProducto');
        $ean = $this->input->post('ean');
        $descripcion = $this->input->post('descripcion');
        $sustancia = $this->input->post('sustancia');
        $formaFarmaceutica = $this->input->post('formaFarmaceutica');
        $concentracion = $this->input->post('concentracion');
        $presentacion = $this->input->post('presentacion');
        $unidadMedida = $this->input->post('unidadMedida');
        $idLaboratorio = $this->input->post('idLaboratorio');
        $laboratorioProvisional = $this->input->post('laboratorioProvisional');
        $registro = $this->input->post('registro');
        $secuencia = $this->input->post('secuencia');
        $clave = $this->input->post('clave');
        $precioMaximoPublico = $this->input->post('precioMaximoPublico');
        $precioFarmacia = $this->input->post('precioFarmacia');
        $iva = $this->input->post('iva');
        $servicio = $this->input->post('servicio');
        $idLinea = $this->input->post('idLinea');
        $idSublinea = $this->input->post('idSublinea');
        $antibiotico = $this->input->post('antibiotico');
        $claseTerapeutica = $this->input->post('claseTerapeutica');
        
        echo $this->maestro_model->changeProducto($idProducto, $ean, $descripcion, $sustancia, $formaFarmaceutica, $concentracion, $presentacion, $unidadMedida, $idLaboratorio, $laboratorioProvisional, $registro, $secuencia, $precioMaximoPublico, $precioFarmacia, $clave, $iva, $servicio, $idLinea, $idSublinea, $antibiotico, $claseTerapeutica);
    }

    function submit_producto()
    {
        $this->load->model('maestro_model');
        $id = $this->maestro_model->captura_producto();
        redirect('maestro/muestra_producto/' . $idProducto);
    }

    public function editar_producto($idProducto)
    {
        $data['titulo'] = 'Editar Producto';
        $data['idProducto'] = $idProducto;
        $data['laboratorios'] = $this->maestro_model->getLaboratorioCombo();
        $data['secuencias'] = $this->maestro_model->getSecuenciaCombo();
        $data['gobierno'] = $this->maestro_model->getGobiernoCombo();
        $data['sino'] = $this->maestro_model->getSiNo();
        $data['linea'] = $this->maestro_model->getLineaCombo();
        $data['sublinea'] = $this->maestro_model->getSublineaCombo();
        $data['js'] = 'maestro/editar_producto_js';
        $data['row'] = $this->maestro_model->getProducto($idProducto);

        $this->load->view('main', $data);
    }

    public function actualiza_producto()
    {
        $idProducto = $this->input->post('idProducto');
        $ean = $this->input->post('ean');
        $descripcion = $this->input->post('descripcion');
        $precioMaximoPublico = $this->input->post('precioMaximoPublico');
        $precioFarmacia = $this->input->post('precioFarmacia');
        $this->load->model('maestro_model');
        $this->maestro_model->actualiza_model_producto($idProducto, $ean, $descripcion,
            $precioMaximoPublico, $precioFarmacia);
        redirect('maestro/muestra_producto');
    }

    function productosByProveedor($idProveedor)
    {
        $this->load->library('pagination');
        $this->load->model('maestro_model');
        $config['base_url'] = site_url() . "/maestro/productosByProveedor/" . $idProveedor;
        $config['total_rows'] = $this->maestro_model->getCuentaProductosProveedor($idProveedor);
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '200';
        $config['uri_segment'] = 4;
        $config['display_pages'] = true;

        $this->pagination->initialize($config);

        $data['titulo'] = 'Productos por proveedor';
        $data['idProveedor'] = $idProveedor;
        $data['query'] = $this->maestro_model->getProductosByProveedor($idProveedor, $config['per_page'],
            $this->uri->segment(4));
        $data['js'] = "maestro/productosByProveedor_js";

        $this->load->view('main', $data);
    }


    function muestra_todo()
    {
        $this->load->library('pagination');
        $this->load->model('maestro_model');
        $config['base_url'] = site_url() . "/maestro/muestra_todo/";
        $config['total_rows'] = $this->maestro_model->getCuentaProductosAll();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '200';
        $config['uri_segment'] = 3;
        $config['display_pages'] = true;

        $this->pagination->initialize($config);

        $data['titulo'] = 'Productos por proveedor';
        $data['idProveedor'] = 0;
        $data['query'] = $this->maestro_model->getProductosAll($config['per_page'], $this->
            uri->segment(3));
        $data['js'] = "maestro/muestra_todo_js";

        $this->load->view('main', $data);
    }

    function muestra_todo_excel()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $data['query'] = $this->maestro_model->getproductosAllNoLimit();
        $this->load->view('excel/muestra_todo_excel', $data);
    }

    public function indicadores()
    {
        $data['titulo'] = 'Indicadores';
        $data['productos_meta'] = 40000;
        $data['productos_actuales'] = $this->maestro_model->productos_actuales();
        $data['productos_sin_sustancia'] =  $this->maestro_model->productos_sin_sustancia();
        $data['productos_sin_precioMaximoPublico'] =  $this->maestro_model->productos_sin_precioMaximoPublico();
        $data['productos_sin_laboratorio'] =  $this->maestro_model->productos_sin_laboratorio();
        $data['productos_sin_linea'] =  $this->maestro_model->productos_sin_linea();
        $data['productos_sin_sublinea'] =  $this->maestro_model->productos_sin_sublinea();
        $data['productos_sin_formaFarmaceutica'] =  $this->maestro_model->productos_sin_formaFarmaceutica();
        $data['productos_sin_concentracion'] =  $this->maestro_model->productos_sin_concentracion();
        //$data['js'] = 'maestro/editar_producto_js';

        $this->load->view('main', $data);
    }
    
    function costos_cedis()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "COSTOS CEDIS";
        $data['s'] = $this->maestro_model->consulta_costos_cedis();
        $data['js'] = 'maestro/costos_cedis_js';
        $this->load->view('main', $data);
    }
    
    function mostrar_costos_cedis($secuencia)
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "COSTOS CEDIS A DETALLE";
        $data['secuencia'] = $secuencia;
        $data['s'] = $this->maestro_model->mostrar_consulta_costos_cedis($secuencia);
        $data['js'] = 'maestro/mostrar_costos_cedis_js';
        $this->load->view('main', $data);
    }
    
    function ultimos_costos()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "Ultimos Costos";
        $data['s'] = $this->maestro_model->consulta_ultimos_costos();
        $data['js'] = 'maestro/ultimos_costos_js';
        $this->load->view('main', $data);
    }
    
    function muestra_ultimosCostos_excel()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $data['query'] = $this->maestro_model->get_ultimosCostos_All();
        $this->load->view('excel/muestra_ultimosCostos_excel', $data);
    }

}
