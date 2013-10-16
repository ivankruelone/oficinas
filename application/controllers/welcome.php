<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

    }

	public function index()
	{
	   $data['titulo'] = "Hola, Bienvenido...";
		$this->load->view('main', $data);
	}
}

