<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cxp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('cxp_model');
    }
    
    public function sube_compra()
    {
        $data['titulo'] = "Genera compras";
        //$data['js'] = 'maestro/captura_producto_js';
        $this->load->view('main', $data);
    }

    public function sube_ftp()
    {
        $data['titulo'] = "Sube compras al AS-400";
        //$data['js'] = 'maestro/captura_producto_js';
        $this->load->view('main', $data);
    }

    function prueba()
    {
        $data = $this->cxp_model->getCompraMichoacan2016();
        echo "<pre>";
        echo $data;
        echo "</pre>";
    }

}