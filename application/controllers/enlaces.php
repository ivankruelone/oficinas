<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Enlaces extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('enlaces_model');

    }

    function index()
    {
        $this->enlaces_model->getInventarioAguascalientes();
    }
    
    
    
    
}
