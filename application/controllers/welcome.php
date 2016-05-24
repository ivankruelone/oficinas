<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
         $this->load->model('evaluacion_model');

    }

	public function index()
	{
      $nivel=$this->session->userdata('nivel');
      $data['titulo'] = "Hola, Bienvenido...";
       if($nivel==13 || $nivel==12){
       $data['mensaje'] ='<p><font color="red" size="+2"><strong>ULTIMO DIA PARA VALIDAR PLANTILLA EL 10 DE FEBRERO DEL 2016 A LAS 12 DEL DIA</strong></font></p>';
       $data['mensaje'].= $this->evaluacion_model->sin_inv();
       $data['mensaje'].= $this->evaluacion_model->sin_venta();  
       }else{
       $data['mensaje'] = " "; 
       } 
		$this->load->view('main', $data);
	}
}

