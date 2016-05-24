<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Belem extends CI_Controller {

       public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if (!Current_User::user()) {
            redirect('landing');
        }
        $this->load->model('belem_model');
    }
/***************************************************************************************************************/
    function ticket_so()
    {
     $data['titulo'] = "Nuevos Tickets";
     $this->load->view('main', $data);   
    }
    
       function nuevo_ticket_submit()
   {
              
        $titulo = $this->input->post('titulo');
        $correo = trim($this->input->post('correo'));
        $mensaje = trim($this->input->post('mensaje'));
        $data = array(
        'titulo' => $titulo,
        'correo' => $correo,
        'mensaje' => $mensaje);
        $this->db->insert('belem.tickets_sistemas', $data);
        redirect('belem/ticket_so/');
    
   }
    
    
    
}