<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class inv_control_espe extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('catalogos_model');
        $this->load->model('Inv_control_espe_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    function esp_control_inv()
    {
        $var='susa';
        $data['titulo'] = "Inventario de Controlados y especialidad";
        $data['q'] = $this->Inv_control_espe_model->inv_control_e();
        $data['js'] = 'inv_control_espe/esp_control_inv_js';
        $this->load->view('main', $data);
    }
   
       
    
    
    
}
