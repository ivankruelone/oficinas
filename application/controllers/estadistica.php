<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Estadistica extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('estadistica_model');

    }
    function tablas()
    {

        $data['tit'] = 'LLENADO DE TABLAS';
        $data['js'] = 'desplazamientos/clasificacion_js';
        $this->load->view('main', $data);
    }


    function desplaza_farmabodega_genera()
    {

        $this->estadistica_model->llenado_farmabodega12();
        redirect('estadistica/tablas');
    }

    function desplaza_farmabodega_genera1()
    {

        $this->estadistica_model->llenado_farmabodega_ent_sal();
        redirect('estadistica/tablas');
    }

    function desplaza_control_genera()
    {

        $this->estadistica_model->llenado_controlados_ent_sal();
        redirect('estadistica/tablas');
    }


    function desplaza_aguas_genera()
    {

        $this->estadistica_model->llenado_aguas_ent_sal();
        redirect('estadistica/tablas');
    }

    function desplaza_trasimeno140_genera()
    {

        $this->estadistica_model->llenado_trasimeno140_ent_sal();
        redirect('estadistica/tablas');
    }

    function desplaza_quintana_genera()
    {

        $this->estadistica_model->llenado_quintana_ent_sal();
        redirect('estadistica/tablas');
    }

    function desplaza_cedis_genera()
    {

        $this->estadistica_model->llenado_cedis_ent_sal();
        redirect('estadistica/tablas');
    }

    function llena_pl()
    {

        $this->estadistica_model->llenado_pl();
        redirect('estadistica/tablas');
    }

}
