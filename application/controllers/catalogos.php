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
    function mante_susa()
    {
        $var='susa';
        $data['titulo'] = "Catalogo por Sustancia";
        $data['q'] = $this->catalogos_model->mante_susa($var);
        $data['js'] = 'catalogos/genericos_js';
        $this->load->view('main', $data);
    }
     function mante_susa_una($id)
    {
        $data['titulo'] = "Catalogo por Sustancia";
        $data['q'] = $this->catalogos_model->mante_susa_una($id);
        $data['js'] = 'catalogos/genericos_js';
        $this->load->view('main', $data);
    }
     function mante_codigo()
    {
        $data['titulo'] = "Catalogo por Codigo de Barras";
        $data['q'] = $this->catalogos_model->mante_codigo();
        $data['js'] = 'catalogos/genericos_js';
        $this->load->view('main', $data);
    }
    
    function mod_generico()
    {
        $var='susa';
        $data['titulo'] = "Catalogo por secuencia interna ";
        $data['q'] = $this->catalogos_model->mod_generico();
        $data['js'] = 'catalogos/mod_generico_js';
        $this->load->view('main', $data);
    }
    function mod_generico_sec($tipo,$sec)
    {
        $data['titulo'] = "Catalogo por secuencia interna ";
        $data['tipo'] = $this->catalogos_model->tipo_producto_uno($tipo);
        $data['q'] = $this->catalogos_model->busca_sec($sec);
        $this->load->view('main', $data);
    }
    function sumit_cambia_sec()
    {
    $a=array(
    'ddr'=>$this->input->post('ddr'),
    'gen'=>$this->input->post('gen'),
    'natur'=>$this->input->post('natur'),
    'clasi'=>$this->input->post('clasi'),
    'tipo'=>$this->input->post('tipo')
    );
    $this->db->where('sec',$this->input->post('sec'));
    $this->db->update('catalogo.cat_nuevo_general_sec',$a);
    redirect('catalogos/mod_generico');    
    }
    
    
    function mante_susa_completa_una($clagob,$sec)
    {
        $data['titulo'] = "Catalogo por Sustancia";
        $data['a'] = $this->catalogos_model->busca_producto_nu($clagob,$sec);
        $data['q'] = $this->catalogos_model->mante_susa_completa_una($clagob,$sec);
        $data['js'] = 'catalogos/mod_generico_js';
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
     function control_especial()
    {
        $data['titulo'] = "Catalogo de Controlados y especialidad";
        $data['q'] = $this->catalogos_model->especial_control();
        $data['js'] = 'catalogos/control_especial_js';
        $this->load->view('main', $data);
    }
    
     function genericos_venta()
    {
        $data['titulo'] = "Catalogo de Genericos";
        $data['a'] = $this->catalogos_model->genericos();
        $data['js'] = 'catalogos/genericos_venta_js';
        $this->load->view('main', $data);
    }
     function causes()
    {
        $data['titulo'] = "Catalogo de causes";
        $data['q'] = $this->catalogos_model->causes();
        $data['js'] = 'catalogos/genericos_venta_js';
        $this->load->view('main', $data);
    }
       function costos_mayoristas()
    {
        $data['titulo'] = "Comparativo de costos Mayoristas";
        $data['q'] = $this->catalogos_model->mayoristas();
        $data['js'] = 'catalogos/costos_mayoristas_js';
        $this->load->view('main', $data);
    }
    
    
    
    
}
