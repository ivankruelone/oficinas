<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proveedor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('maestro_model');

    }

    function muestra_proveedor()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "PROVEEDOR";
        $data['s'] = $this->maestro_model->consulta_proveedor();
        $data['js'] = 'proveedor/muestra_proveedor_js';
        $this->load->view('main', $data);
    }

    function captura_proveedor()
    {
        $data['titulo'] = "";
        $this->load->view('main', $data);
    }

    function submit_proveedor()
    {
        $this->load->model('maestro_model');
        $id = $this->maestro_model->captura_proveedor();
        redirect('proveedor/muestra_proveedor/' . $idProveedor);
    }

    public function editar_proveedor($idProveedor)
    {
        $data['titulo'] = 'Editar Proveedor';
        $data['idProveedor'] = $idProveedor;
        $data['row'] = $this->maestro_model->getProveedor($idProveedor);

        $this->load->view('main', $data);
    }

    public function actualiza_proveedor()
    {
        $idProveedor = $this->input->post('idProveedor');
        $rfc = $this->input->post('rfc');
        $razonSocial = $this->input->post('razonSocial');
        $limiteCredito = $this->input->post('limiteCredito');
        $this->load->model('maestro_model');
        $this->maestro_model->actualiza_model_proveedor($idProveedor, $rfc, $razonSocial,
            $limiteCredito);
        redirect('proveedor/muestra_proveedor');
    }

}
