<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Directivos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('directivos_model');
        $this->load->model('Catalogos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }

    function plantilla()
    {
        $data['titulo'] = "Personal Activo";
        $data['tit'] = 'Personal Activo de Sistemas';
        $data['q'] = $this->directivos_model->plantilla();
        $data['js'] = 'directivos/plantilla_js';
        $this->load->view('main', $data);
    }
    
 
 
 }
