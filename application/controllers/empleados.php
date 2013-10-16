<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empleados extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('empleados_model');
        $this->load->model('Catalogos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
    function plantilla()
    {
        $data['titulo'] = "PLANTILLAS";
        $data['tit']='PLANTILLA DE PERSONAL EN FARMACIA';
        $data['a'] = $this->empleados_model->plantilla('');
        //$data['js'] = 'empleados/plantilla_js';
        $this->load->view('main', $data);
    }
    function plantilla_s($ger)
    {
        $gerx=$this->Catalogos_model->busca_ger_uno($ger);
        $data['titulo'] = "PLANTILLAS";
        $data['tit']='PLANTILLA DE PERSONAL EN FARMACIA DE '.trim($gerx);
        $data['a'] = $this->empleados_model->plantilla($ger);
        //$data['js'] = 'entradas/facturas_suc_js';
        $this->load->view('main', $data);
    }
    function plantilla_ss($sup)
    {
        $supx=$this->Catalogos_model->busca_ger_uno($sup);
        $data['titulo'] = "PLANTILLAS";
        $data['tit']='PLANTILLA DE PERSONAL EN FARMACIA DE '.trim($supx);
        $data['a'] = $this->empleados_model->plantilla($sup);
        //$data['js'] = 'entradas/facturas_suc_js';
        $this->load->view('main', $data);
    }
     function plantilla_sse($suc)
    {
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['titulo'] = "PLANTILLAS";
        $data['tit']='PLANTILLA DE PERSONAL EN FARMACIA DE '.trim($sucx);
        $data['a'] = $this->empleados_model->plantilla($suc);
        //$data['js'] = 'entradas/facturas_suc_js';
        $this->load->view('main', $data);
    }
    
    
   
    
    
    
    
    
    
    }