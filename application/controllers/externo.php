<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Externo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('catalogos_model');
        $this->load->model('orden_model');

    }

    function com_orden_imp($id, $estatus = 1)
    {
        $data['a'] = $this->orden_model->com_orden_det_his($id);
        $data['id'] = $id;
        $data['estatus'] = $estatus;
        //$data['js'] = 'orden/imprime_js';
        $this->load->view('impresion/com_orden_C', $data);
    }

}