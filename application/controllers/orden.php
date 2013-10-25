<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Orden extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('catalogos_model');
        $this->load->model('orden_model');

    }
    function orden_compra()
    {
        $data['titulo'] = "Ordenes  de compra";
        $data['a'] = $this->orden_model->orden_compra();
        $data['js'] = 'orden/orden_compra_js';
        $this->load->view('main', $data);
    }
   function orden_compra_detalle($prv,$id_ped)
    {
        $prvx=$this->catalogos_model->busca_prv_uno($prv);
        $data['titulo'] = "Ordenes  de compra para $prvx";
        $data['a'] = $this->orden_model->orden_compra_detalle($prv,$id_ped);
        $data['js'] = 'orden/orden_compra_detalle_js';
        $this->load->view('main', $data);
    }
     function cambia()
    {
     $this->orden_model->cambia(
     $this->input->post('ca'),
     $this->input->post('prv'),
     $this->input->post('id_ped'),
     $this->input->post('sec'),
     $this->input->post('clagob')
     );   
      redirect('orden/orden_compra_detalle/'.$this->input->post('prv').'/'.$this->input->post('id_ped'));   
    }
   
    function cerrar($prv,$id_ped)
    {
     $this->orden_model->cerrar($this->input->post('prv'), $this->input->post('id_ped'), $this->input->post('cia'),'cxp');   
      redirect('orden/orden_compra'); 
    } 
   function historico()
    {
        $data['titulo'] = "Historico de orden de compra";
        $data['a'] = $this->orden_model->historico();
        $data['js'] = 'orden/historico_js';
        $this->load->view('main', $data);
    }
     function historico_detalle($folprv)
    {
        $data['titulo'] = "Historico de orden de compra";
        $data['a'] = $this->orden_model->historico_detalle($folprv);
        $data['js'] = 'orden/historico_detalle_js';
        $this->load->view('main', $data);
    }
   
    function imprime($folprv)
    {
     
       $query=$this->catalogos_model->firma();
       $row=$query->row();
       $imagen=$row->imagen;
       $nombre=$row->nombre;
        $data['cabeza'] = $this->orden_model->imprime_cabeza($folprv);
        $data['a'] = $this->orden_model->imprime($folprv,$imagen,$nombre);
        //$data['js'] = 'orden/imprime_js';
        $this->load->view('impresion/orden_imprime', $data);
   }
   
   
   
   
   
   
   
   
   
   
     function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
}
