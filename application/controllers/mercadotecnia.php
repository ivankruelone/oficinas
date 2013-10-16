<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mercadotecnia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('catalogos_model');
        $this->load->model('mercadotecnia_model');

    }
     function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
    function factura()
    {
        $data['titulo'] = "Factura";
        $data['prv'] = $this->catalogos_model->busca_prv();
        $data['q'] = $this->mercadotecnia_model->factura();
        $this->load->view('main', $data);
    }
  function agrega_sumit()
    {
     $this->mercadotecnia_model->agrega_factura($this->input->post('prv'),$this->input->post('factura'));
      redirect('mercadotecnia/factura'); 
    }
  function factura_det($id)
    {
        $data['titulo'] = "Detalle de factura";
        $data['codigo'] = $this->catalogos_model->busca_codigo();
        $data['q'] = $this->mercadotecnia_model->factura_det($id);
        $data['id'] = $id;
        $this->load->view('main', $data);
    }
   function agrega_det_sumit()
    {
     $this->mercadotecnia_model->agrega_factura_det($this->input->post('codigo'),$this->input->post('costo')
     ,$this->input->post('cantidad'),$this->input->post('id'));
      redirect('mercadotecnia/factura_det/'.$this->input->post('id')); 
    }
     function sumit_borrar($id,$id_cc)
    {
        $this->db->delete('compras.mer_factura_det', array('id' => $id));
        redirect('mercadotecnia/factura_det/'.$id_cc);
    }
     function sumit_cerrar($id)
    {
        $this->mercadotecnia_model->cerrar_factura($id);
        redirect('mercadotecnia/factura');
    }
   function his_fac()
    {
        $data['titulo'] = "Historioco de facturas";
        $data['q'] = $this->mercadotecnia_model->his_fac();
        $data['js'] = 'mercadotecnia/factura_js';
        $this->load->view('main', $data);
    } 
     function his_fac_det($id)
    {
        $data['titulo'] = "Detalle de facturas";
        $data['q'] = $this->mercadotecnia_model->factura_det($id);
        $data['id'] = $id;
        $this->load->view('main', $data);
    }
    function sumit_imprimir($id)
    {
        $data['cabeza'] = $this->mercadotecnia_model->imprime_cabeza($id);
        $data['a'] = $this->mercadotecnia_model->factura_det($id);
        //$data['js'] = 'orden/imprime_js';
        $this->load->view('impresion/mer_factura', $data);
   }
 
    
}
