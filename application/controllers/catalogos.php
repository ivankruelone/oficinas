<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Catalogos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('catalogos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
    function genericos()
    {
        $data['titulo'] = "Catalogo de Genericos";
        $data['a'] = $this->catalogos_model->genericos();
        $data['js'] = 'catalogos/genericos_js';
        $this->load->view('main', $data);
    }
    
    function seguro_popular()
    {
        $data['titulo'] = "Catalogo de Seguro Popular";
        $data['a'] = $this->catalogos_model->seguro_popular();
        $data['js'] = 'catalogos/seguro_popular_js';
        $this->load->view('main', $data);
    }

    function especialidad()
    {
        $data['titulo'] = "Catalogo de Especialidades";
                $data['a'] = $this->catalogos_model->especialidad();
        $data['js'] = 'catalogos/especialidad_js';
        $this->load->view('main', $data);

    }
    
    
     function genericos_venta()
    {
        $data['titulo'] = "Catalogo de Genericos";
        $data['a'] = $this->catalogos_model->genericos();
        $data['js'] = 'catalogos/genericos_venta_js';
        $this->load->view('main', $data);
    }
    
    
    
    
}
