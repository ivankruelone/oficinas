<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auxiliar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('maestro_model');

    }

    function muestra_secuencia()
    {
        $this->load->library('pagination');
        $this->load->model('maestro_model');
        $config['base_url'] = site_url() . "/auxiliar/muestra_secuencia";
        $config['total_rows'] = $this->maestro_model->consulta_secuencia_cuenta();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '100';
        $config['display_pages'] = true;

        $this->pagination->initialize($config);

        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "SECUENCIA";
        $data['s'] = $this->maestro_model->consulta_secuencia($config['per_page'], $this->
            uri->segment(3));
        $data['js'] = 'auxiliar/muestra_secuencia_js';
        $this->load->view('main', $data);
    }

    function muestra_secuencia_excel()
    {
        $data['query'] = $this->maestro_model->getSecuenciaAll();
        $this->load->view('excel/muestra_secuencia_excel', $data);
    }

    function busquedaSecuencia()
    {
        $dato = $this->input->post('dato');
        $data['query'] = $this->maestro_model->getSecuenciaBySecuencia($dato);
        $this->load->view('auxiliar/busquedaSecuencia', $data);
    }

    function busquedaSustancia()
    {
        $dato = $this->input->post('dato');
        $data['query'] = $this->maestro_model->getSecuenciaBySustancia($dato);
        $this->load->view('auxiliar/busquedaSecuencia', $data);
    }

    function captura_secuencia()
    {
        $data['titulo'] = "";
        $this->load->view('main', $data);
    }

    function submit_nueva_secuencia()
    {
        $this->load->model('maestro_model');
        $id = $this->maestro_model->captura_secuencia();
        redirect('auxiliar/muestra_secuencia/' . $secuencia);
    }

    public function editar_secuencia($secuencia)
    {
        $data['titulo'] = 'Editar Secuencia';
        $data['contenido'] = 'maestro/editar_secuencia';
        $data['secuencia'] = $secuencia;
        $data['row'] = $this->maestro_model->getSecuencia($secuencia);

        $this->load->view('main', $data);
    }

    public function actualiza_secuencia()
    {
        $secuencia = $this->input->post('secuencia');
        $sustanciaActiva = $this->input->post('sustanciaActiva');
        $ventaDrd = $this->input->post('ventaDrd');
        $ventaGen = $this->input->post('ventaGen');
        $ventaFen = $this->input->post('ventaFen');
        $ventaFbo = $this->input->post('ventaFbo');
        $this->load->model('maestro_model');
        $this->maestro_model->actualiza_model_secuencia($secuencia, $sustanciaActiva, $ventaDrd,
            $ventaGen, $ventaFen, $ventaFbo);
        redirect('auxiliar/muestra_secuencia');
    }

    function muestra_gobierno()
    {
        $this->load->library('pagination');
        $this->load->model('maestro_model');
        $config['base_url'] = site_url() . "/auxiliar/muestra_gobierno";
        $config['total_rows'] = $this->maestro_model->consulta_gobierno_cuenta();
        $config['first_link'] = '<font size="+1">Primero</font>';
        $config['last_link'] = '<font size="+1">Ultimo</font>';
        $config['next_link'] = '<font size="+1">Siguiente</font>';
        $config['prev_link'] = '<font size="+1">Anterior</font>';
        $config['per_page'] = '100';
        $config['display_pages'] = true;

        $this->pagination->initialize($config);

        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "GOBIERNO";
        $data['s'] = $this->maestro_model->consulta_gobierno($config['per_page'], $this->
            uri->segment(3));
        $data['js'] = 'auxiliar/muestra_gobierno_js';
        $this->load->view('main', $data);
    }

    function muestra_gobierno_excel()
    {

        $data['query'] = $this->maestro_model->getGobiernoAll();
        $this->load->view('excel/muestra_gobierno_excel', $data);
    }

    function captura_gobierno()
    {
        $data['titulo'] = "";
        $this->load->view('main', $data);
    }

    function submit_gobierno()
    {
        $this->load->model('maestro_model');
        $id = $this->maestro_model->captura_gobierno();
        redirect('auxiliar/muestra_gobierno/' . $clave);
    }

    public function editar_gobierno($clave)
    {
        $data['titulo'] = 'Editar Clave Gobierno';
        $data['clave'] = $clave;
        $data['row'] = $this->maestro_model->getClaveGobierno($clave);

        $this->load->view('main', $data);
    }

    public function actualiza_gobierno()
    {
        $clave = $this->input->post('clave');
        $nombreGenerico = $this->input->post('nombreGenerico');
        $formaFarmaceutica = $this->input->post('formaFarmaceutica');
        $concentracion = $this->input->post('concentracion');
        $presentacion = $this->input->post('presentacion');
        $unidadMedida = $this->input->post('unidadMedida');
        $envase = $this->input->post('envase');
        $this->load->model('maestro_model');
        $this->maestro_model->actualiza_model_gobierno($clave, $nombreGenerico, $formaFarmaceutica,
            $concentracion, $presentacion, $unidadMedida, $envase);
        redirect('auxiliar/muestra_gobierno');
    }

    function busquedaSustanciaGobierno()
    {
        $dato = $this->input->post('dato');
        $data['query'] = $this->maestro_model->getSecuenciaBySustanciaGobierno($dato);
        $this->load->view('auxiliar/busquedaGobierno', $data);
    }

    function busquedaClaveGobierno()
    {
        $dato = $this->input->post('dato');
        $data['query'] = $this->maestro_model->getGobiernoByClave($dato);
        $this->load->view('auxiliar/busquedaGobierno', $data);
    }

    function muestra_linea()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "LINEA";
        $data['s'] = $this->maestro_model->consulta_linea();
        $data['js'] = 'auxiliar/muestra_linea_js';
        $this->load->view('main', $data);
    }

    function captura_linea()
    {
        $data['titulo'] = "";
        $this->load->view('main', $data);
    }

    function submit_linea()
    {
        $this->load->model('maestro_model');
        $id = $this->maestro_model->captura_linea();
        redirect('auxiliar/muestra_linea/' . $idLinea);
    }

    public function editar_linea($idLinea)
    {
        $data['titulo'] = 'Editar Linea';
        $data['idLinea'] = $idLinea;
        $data['row'] = $this->maestro_model->getLinea($idLinea);

        $this->load->view('main', $data);
    }

    public function actualiza_linea()
    {
        $idLinea = $this->input->post('idLinea');
        $linea = $this->input->post('linea');
        $this->load->model('maestro_model');
        $this->maestro_model->actualiza_model_linea($idLinea, $linea);
        redirect('auxiliar/muestra_linea');
    }

    function muestra_sublinea()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "SUBLINEA";
        $data['s'] = $this->maestro_model->consulta_sublinea();
        $data['js'] = 'auxiliar/muestra_sublinea_js';
        $this->load->view('main', $data);
    }

    function captura_sublinea()
    {
        $data['titulo'] = "";
        $data['linea'] = $this->maestro_model->getLineaCombo();
        $this->load->view('main', $data);
    }

    function submit_sublinea()
    {
        $this->load->model('maestro_model');
        $id = $this->maestro_model->captura_sublinea();
        redirect('auxiliar/muestra_sublinea/' . $idLinea);
    }

    public function editar_sublinea($idLinea)
    {
        $data['titulo'] = 'Editar Sublinea';
        $data['idLinea'] = $idLinea;
        $data['row'] = $this->maestro_model->getSublinea($idLinea);

        $this->load->view('header');
        $this->load->view('main', $data);
    }

    public function actualiza_sublinea()
    {
        $idLinea = $this->input->post('idLinea');
        $idSublinea = $this->input->post('idSublinea');
        $sublinea = $this->input->post('sublinea');
        $this->load->model('maestro_model');
        $this->maestro_model->actualiza_model_sublinea($idLinea, $idSublinea, $sublinea);
        redirect('auxiliar/muestra_sublinea');
    }

    public function busca_clave_secuencia()
    {
        $data['titulo'] = 'Buscar Clave Secuencia';
        $data['query'] = $this->maestro_model->getFirstElement();
        $data['gobierno'] = $this->maestro_model->getGobiernoCombo();

        $this->load->view('header');
        $this->load->view('main', $data);
    }
    
    function busca_clave_secuencia_submit()
    {
        $clave = $this->input->post('clave');
        $secuencia = $this->input->post('secuencia');
        
        $data = array('clave' => $clave);
        $this->db->update('maestro.secuencia', $data, array('secuencia' => $secuencia));
        redirect('auxiliar/busca_clave_secuencia');
    }

}
