<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pedido extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('catalogos_model');
        $this->load->model('Pedido_model');

    }
    function generar()
    {
        $data['titulo'] = "Genera Pedidos de compra";
        $data['alm'] = $this->catalogos_model->busca_almacen();
        $data['por1'] = $this->catalogos_model->busca_ord_dias();
        $data['por2'] = $this->catalogos_model->busca_ord_dias();
        $data['por3'] = $this->catalogos_model->busca_ord_dias();
        $data['por4'] = $this->catalogos_model->busca_ord_dias();
        $data['por5'] = $this->catalogos_model->busca_ord_dias();
        $this->load->view('main', $data);
    }
    function generar_sumit()
    {
     if($this->input->post('pass') == 'unicoo'){
     $this->Pedido_model->generar_sumit(
     $this->input->post('por1'),$this->input->post('por2'),$this->input->post('por3'),
     $this->input->post('por4'),$this->input->post('por5'),$this->input->post('alm'));
     }
     redirect('pedido/pedidos');
    }
    
   
    function pedidos()
    {
        $data['titulo'] = "Pedidos de compra";
        $data['a'] = $this->Pedido_model->pedidos();
        $data['js'] = 'pedido/pedidos_js';
        $this->load->view('main', $data);
    }
    function valida_ped($fechag,$xtipo)
    {
     $this->Pedido_model->sumit_valida_ped($fechag,$xtipo);
     redirect('pedido/pedidos');
    }
    function pedido_compra()
    {
        $data['titulo'] = "Pedidos por provedor sin trabajar compradores";
        $data['a'] = $this->Pedido_model->pedido_compra();
        $data['js'] = 'pedido/pedido_compra_js';
        $this->load->view('main', $data);
    }
    function borrar_pedido($prv,$id_ped)
    {
        $data = array('tipo' => 'X');
        $this->db->where('id_ped', $id_ped);
        $this->db->where('prv', $prv);
        $this->db->update('compras.orden_c', $data); 
      redirect('pedido/pedido_compra');   
    }
   function pedido_compra_detalle($prv,$id_ped)
    {
        $data['titulo'] = "Ordenes  de compra";
        $data['a'] = $this->Pedido_model->pedido_compra_detalle($prv,$id_ped);
        $data['js'] = 'pedido/pedido_compra_detalle_js';
        $this->load->view('main', $data);
    }
    function precios()
    {
        $data['titulo'] = "Validar precios en orden de compras";
        $data['a'] = $this->Pedido_model->precios();
        $data['js'] = 'pedido/precios_js';
        $this->load->view('main', $data);
    }
     
   function autoriza($id_ped,$prv,$sec)
    {

if($clagob==null){
        $data = array('autoriza' =>date('Y-m-d'));
        $this->db->where('id_ped', $id_ped);
        $this->db->where('prv', $prv);
        $this->db->where('tipo', 'A');
        $this->db->where('sec', $sec);
        $this->db->update('compras.orden_d', $data);  
        }else{
        $data = array('autoriza' =>date('Y-m-d'));
        $this->db->where('id_ped', $id_ped);
        $this->db->where('prv', $prv);
        $this->db->where('tipo', 'A');
        $this->db->where('sec', $sec);
        $this->db->where('clagob', $clagob);
        $this->db->update('compras.orden_d', $data);
        }  
        redirect('pedido/precios');   
    }
   
   
   
   
     function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
}
