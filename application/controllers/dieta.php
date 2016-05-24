<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dieta extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if (!Current_User::user()) {
            redirect('landing');
        }
       
        $this->load->model('dieta_model');

    }
    
    function dieta_catalogo()
    {
        $data['titulo'] = "Descontinuados";
        $data['q'] = $this->dieta_model->dieta_cat();
        //$data['js'] = 'catalogos/descontin_js';
        $this->load->view('main', $data);
    }
    
    
}