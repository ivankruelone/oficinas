<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laboratorio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('maestro_model');

    }

    function muestra_laboratorio()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "LABORATORIO";
        $data['s'] = $this->maestro_model->consulta_laboratorio();
        $data['js'] = 'laboratorio/muestra_laboratorio_js';
        $this->load->view('main', $data);
    }

    function captura_laboratorio()
    {
        $data['titulo'] = "";
        $this->load->view('main', $data);
    }

    function submit_laboratorio()
    {
        $this->load->model('maestro_model');
        $id = $this->maestro_model->captura_laboratorio();
        redirect('laboratorio/muestra_laboratorio/' . $idLaboratorio);
    }

    public function editar_laboratorio($idLaboratorio)
    {
        $data['titulo'] = 'Editar Laboratorio';
        $data['idLaboratorio'] = $idLaboratorio;
        $data['row'] = $this->maestro_model->getLaboratorio($idLaboratorio);

        $this->load->view('main', $data);
    }

    public function actualiza_laboratorio()
    {
        $idLaboratorio = $this->input->post('idLaboratorio');
        $laboratorio = $this->input->post('laboratorio');
        $this->load->model('maestro_model');
        $this->maestro_model->actualiza_model_laboratorio($idLaboratorio, $laboratorio);
        redirect('laboratorio/muestra_laboratorio');
    }

}
