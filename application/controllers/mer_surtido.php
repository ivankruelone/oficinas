<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mer_surtido extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('catalogos_model');
        $this->load->model('mer_surtido_model');
        
    }
    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
     function pedido()
    {
        $data['titulo'] = "Pedido";
        $data['suc'] = $this->catalogos_model->busca_suc();
        $data['q'] = $this->mer_surtido_model->mer_surtido();
        $this->load->view('main', $data);
    } 
    
   function agrega_sumit()
    {
   $b = array(
   'suc' => $this->input->post('suc'),
   'fecha'=>date('Y-m-d'),
   'tipo'=>'A',
   'id_user'=>$this->session->userdata('id')
   );
   $this->db->insert('compras.mer_surtido', $b);
      redirect('mer_surtido/pedido'); 
    }
  function pedido_det($id)
    {
        $data['titulo'] = "Detalle de factura";
        $data['codigo'] = $this->mer_surtido_model->busca_inv();
        $data['q'] = $this->mer_surtido_model->surtido_det($id);
        $data['id'] = $id;
        $this->load->view('main', $data);
    }
   function agrega_det_sumit()
    {
     $this->mer_surtido_model->agrega_surtido_det($this->input->post('codigo'),$this->input->post('costo')
     ,$this->input->post('cantidad'),$this->input->post('publico'),$this->input->post('id'));
      redirect('mer_surtido/pedido_det/'.$this->input->post('id')); 
    }
     function sumit_borrar($id,$id_cc)
    {
        $this->db->delete('compras.mer_surtido_det', array('id' => $id));
        redirect('mer_surtido/pedido_det/'.$id_cc);
    }
     function sumit_cerrar($id)
    {
        $this->mer_surtido_model->cerrar_surtido($id);
        redirect('mer_surtido/pedido');
    }
   function his_sur()
    {
        $data['titulo'] = "Historioco de Pedidos";
        $data['q'] = $this->mer_surtido_model->his_sur();
        $data['js'] = 'mercadotecnia/factura_js';
        $this->load->view('main', $data);
    } 
     function his_sur_det($id)
    {
        $data['titulo'] = "Detalle de Pedidos";
        $data['q'] = $this->mer_surtido_model->surtido_det($id);
        $data['id'] = $id;
        $this->load->view('main', $data);
    }
    function sumit_imprimir($id)
    {
        $data['cabeza'] = $this->mer_surtido_model->imprime_cabeza($id);
        $data['a'] = $this->mer_surtido_model->surtido_det($id);
        //$data['js'] = 'orden/imprime_js';
        $this->load->view('impresion/mer_surtido', $data);
   }
   
   
     
    
    
    }