<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mer_inventario extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('catalogos_model');
        $this->load->model('mer_inventa_model');
        
    }
    function index()
    {
        $data['titulo'] = "Indice";     
        $this->load->view('main', $data);
    }
     function mer_inv()
    {
        $data['titulo'] = "Inventario";
        $data['q'] = $this->mer_inventa_model->mer_inv();
        $this->load->view('main', $data);
    } 
    
    
   
     
    
    
    }