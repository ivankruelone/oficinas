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
        $data['prv'] = $this->catalogos_model->busca_prv_mer();
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
  /////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////////surtido de pedidos
       function pedido()
    {
        $data['titulo'] = "Pedido";
        $data['suc'] = $this->catalogos_model->busca_suc();
        $data['q'] = $this->mercadotecnia_model->mer_surtido();
        $this->load->view('main', $data);
    } 
    
   function agrega_ped_sumit()
    {
   $b = array(
   'suc' => $this->input->post('suc'),
   'fecha'=>date('Y-m-d'),
   'tipo'=>'A',
   'id_user'=>$this->session->userdata('id')
   );
   $this->db->insert('compras.mer_surtido', $b);
      redirect('mercadotecnia/pedido'); 
    }
  function pedido_det($id)
    {
        $data['titulo'] = "Detalle de factura";
        $data['q'] = $this->mercadotecnia_model->surtido_det($id);
        $data['id'] = $id;
        $this->load->view('main', $data);
    }
   function agrega_ped_det_sumit()
    {
     $this->mercadotecnia_model->agrega_surtido_det($this->input->post('codigo'),$this->input->post('costo')
     ,$this->input->post('cantidad'),$this->input->post('publico'),$this->input->post('id'));
      redirect('mercadotecnia/pedido_det/'.$this->input->post('id')); 
    }
     function sumit_ped_borrar($id,$id_cc)
    {
        $this->db->delete('compras.mer_surtido_det', array('id' => $id));
        redirect('mercadotecnia/pedido_det/'.$id_cc);
    }
     function sumit_ped_cerrar($id)
    {
        $this->mercadotecnia_model->cerrar_surtido($id);
        redirect('mercadotecnia/pedido');
    }
   function his_sur()
    {
        $data['titulo'] = "Historioco de Pedidos";
        $data['q'] = $this->mercadotecnia_model->his_sur();
        $data['js'] = 'mercadotecnia/factura_js';
        $this->load->view('main', $data);
    } 
     function his_sur_det($id)
    {
        $data['titulo'] = "Detalle de Pedidos";
        $data['q'] = $this->mercadotecnia_model->surtido_det($id);
        $data['id'] = $id;
        $this->load->view('main', $data);
    }
    function sumit_ped_imprimir($id)
    {
        $data['cabeza'] = $this->mercadotecnia_model->imprime_ped_cabeza($id);
        $data['a'] = $this->mercadotecnia_model->surtido_det($id);
        //$data['js'] = 'orden/imprime_js';
        $this->load->view('impresion/mer_surtido', $data);
   }

  /////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////////inventario
   function mer_inv()
    {
        $data['titulo'] = "Inventario";
        $data['q'] = $this->mercadotecnia_model->mer_inv();
        $this->load->view('main', $data);
    } 

    function agrega_inv_sumit()
    {
    $this->mercadotecnia_model->agrega_inv($this->input->post('codigo'),$this->input->post('can'),$this->input->post('costo'));
    redirect('mercadotecnia/mer_inv'); 
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////////catalogo de productos
    function productos()
    {
        $data['titulo'] = "Catalogo de Productos";
        $data['lab']=$this->mercadotecnia_model->busca_lab();
        $data['lin']=$this->mercadotecnia_model->busca_lin();
        $data['iva']=0;
        $data['tipo_p']='NOR';
        $data['q'] = $this->mercadotecnia_model->cat_productos();
        $data['q1'] = $this->mercadotecnia_model->cat_productos_lab();
        $data['js'] = 'mercadotecnia/productos_js';
        $this->load->view('main', $data); 
    }
    function agrega_productos_sumit()
    {
    $this->mercadotecnia_model->agrega_producto(
    $this->input->post('codigo'),
    $this->input->post('descri'),
    $this->input->post('registro'),
    $this->input->post('registro_fec'),
    $this->input->post('clave'),
    $this->input->post('susa'),
    $this->input->post('tipo_p'),
    $this->input->post('iva'),
    $this->input->post('lab'),
    $this->input->post('farmacia'),
    $this->input->post('venta'),
    $this->input->post('publico'),
    $this->input->post('lin'),
    $this->input->post('sublin')
    
    );
    $lab=$this->input->post('lab');
    redirect('mercadotecnia/productos_labora/'.$lab); 
    }
    function productos_letra($letra)
    {
        $data['titulo'] = "Catalogo de Productos";
        $data['lab']=$this->mercadotecnia_model->busca_lab();
        $data['lin']=$this->mercadotecnia_model->busca_lin();
        $data['iva']=0;
        $data['sublin']=$this->mercadotecnia_model->busca_lin();
        $data['tipo_p']='NOR';
        $data['q'] = $this->mercadotecnia_model->cat_productos_letra($letra);
        $data['js'] = 'mercadotecnia/productos_labora_js';
        $this->load->view('main', $data); 
    }
    function productos_labora($l)
    {
        $data['titulo'] = "Catalogo de Productos";
        $data['lab']=$this->mercadotecnia_model->busca_lab();
        $data['lin']=$this->mercadotecnia_model->busca_lin();
        $data['iva']=0;
        $data['sublin']=$this->mercadotecnia_model->busca_lin();
        $data['tipo_p']='NOR';
        $data['q'] = $this->mercadotecnia_model->cat_productos_labor($l);
        $data['js'] = 'mercadotecnia/productos_labora_js';
        $this->load->view('main', $data); 
    }
    function productos_modifica($id)
    {
        $data['titulo'] = "Catalogo de Productos";
        $query=$this->mercadotecnia_model->busca_producto($id);
        $r=$query->row();
        $data['codigo']=$r->codigo;
        $data['descripcion']=$r->descripcion;
        $data['lab']=$this->mercadotecnia_model->busca_lab_uno($r->lab);
        $data['lin']=$this->mercadotecnia_model->busca_lin_uno($r->lin);
        $data['sublin']=$this->mercadotecnia_model->busca_sublin_uno($r->lin,$r->sublin);
        $data['iva']=$r->iva;
        $data['farmacia']=$r->farmacia;
        $data['pub']=$r->pub;
        $data['venta']=$r->venta;
        $data['tipo']=$this->mercadotecnia_model->busca_activo_uno($r->tipo);
        $data['registro']=$r->registro;
        $data['fecha_registro']=$r->fecha_registro;
        $data['tipo_p']=$this->mercadotecnia_model->busca_pro_uno($r->producto);
        $data['clave']=$r->clave;
        $data['susa']=$r->susa;
        $data['id']=$r->id;
        
        $this->load->view('main', $data); 
    }
    public function cambia_productos_sumit()
    {
    $this->mercadotecnia_model->cambia_producto(
    $this->input->post('id'),
    $this->input->post('descripcion'),
    $this->input->post('registro'),
    $this->input->post('registro_fec'),
    $this->input->post('clave'),
    $this->input->post('susa'),
    $this->input->post('tipo_p'),
    $this->input->post('iva'),
    $this->input->post('lab'),
    $this->input->post('farmacia'),
    $this->input->post('venta'),
    $this->input->post('publico'),
    $this->input->post('tipo'),
    $this->input->post('lin'),
    $this->input->post('sublin')
    );
    $lab=$this->input->post('lab');
    redirect('mercadotecnia/productos_labora/'.$lab); 
    }
    ///////////////////////////////////////////////////////////77//////////////////////////////////////////////////////7
    ///////////////////////////////////////////////////////////77//////////////////////////////////////////////////////7
     function provedor()
    {
        $data['titulo'] = "Provedores";
        $data['q'] = $this->mercadotecnia_model->provedor();
        $data['js'] = 'mercadotecnia/provedor_js';
        $this->load->view('main', $data);
    }
     function graba_mer_prv()
    {
    $this->mercadotecnia_model->graba_prv(
    $this->input->post('prv'),
    $this->input->post('razo'),
    $this->input->post('dire'),
    $this->input->post('cp'),
    $this->input->post('pobla'),
    $this->input->post('rfc'),
    $this->input->post('corto'),
    $this->input->post('tel')
    );    
    redirect('mercadotecnia/provedor/'.$lab);     
    }
        function modifica_prv($prov)
    {
        $data['titulo'] = "Provedor";
        $query=$this->mercadotecnia_model->busca_prv_unico($prov);
        $r=$query->row();
        $data['razo']=$r->razo;
        $data['dire']=$r->dire;
        $data['cp']=$r->cp;
        $data['pobla']=$r->pobla;
        $data['rfc']=$r->rfc;
        $data['tel']=$r->tel;
        $data['corto']=$r->corto;
        $data['prov']=$r->prov;
        $this->load->view('main', $data);
    }
    
    function sumit_cambia_prv()
    {
    
    $this->mercadotecnia_model->cambiar_prv(
    $this->input->post('prov'),
    $this->input->post('razo'),
    $this->input->post('dire'),
    $this->input->post('cp'),
    $this->input->post('pobla'),
    $this->input->post('rfc'),
    $this->input->post('corto'),
    $this->input->post('tel')
    );
    redirect('mercadotecnia/provedor/'.$lab);       
    }
    
    function sumit_borra_prv($prv)
    {
    
    $a=array('tipo'=>'B');
    $this->db->where('prov',$prv);
    $this->db->update('catalogo.cat_mer_prv',$a);
    redirect('mercadotecnia/provedor/'.$lab);       
    }
    ///////////////////////////////////////////////////////////77//////////////////////////////////////////////////////7
    ///////////////////////////////////////////////////////////77//////////////////////////////////////////////////////7
     function laboratorios()
    {
        $data['titulo'] = "Laboratorios";
        $data['q'] = $this->mercadotecnia_model->laboratorios();
        $data['js'] = 'mercadotecnia/labortorios_js';
        $this->load->view('main', $data);
    }  
    
/////////////////////////////////////////////////////////////////////////////////////////Orden de compra de patente  
 function orden()
    {
        $data['titulo'] = "Orden de compra a provedor";
        $data['prv'] = $this->catalogos_model->busca_prv_mer();
        $data['q'] = $this->mercadotecnia_model->orden();
        $this->load->view('main', $data);
    }
    function agrega_orden_sumit()
    {
        $a=array(//almacen, prv, prvx, fechag, tipo, fechae, id_userg, id_usere, cia, id_ped, fecha_ped, folprv, producto
        'almacen'=>'alm',
        'prv'=>$this->input->post('prv'),
        'prvx'=>$this->catalogos_model->busca_prv_uno_mer($this->input->post('prv')),
        'fechag'=>date('Y-m-d'),
        'fechae'=>'0000-00-00',
        'tipo'=>'A',
        'id_userg'=>$this->session->userdata('id'),
        'id_usere'=>0,
        'cia'=>1,
        'id_ped'=>0,
        'fecha_ped'=>'0000-00-00',
        'folprv'=>0,
        'producto'=>'PATENTE'
        );
        $this->db->insert('compras.orden_c',$a);
        redirect('mercadotecnia/orden'); 
        
    }
    function orden_det($id)
    {
        $data['titulo'] = "Detalle de orden";
        $data['q'] = $this->mercadotecnia_model->orden_det($id);
        $data['id'] = $id;
        $this->load->view('main', $data);
    }
    function agrega_ord_det_sumit()
    {
     $this->mercadotecnia_model->agrega_orden_det(
     $this->input->post('codigo'),$this->input->post('costo'),
     $this->input->post('cantidad'),$this->input->post('publico'),
     $this->input->post('id')
     );
     
      redirect('mercadotecnia/orden_det/'.$this->input->post('id')); 
    }
     function sumit_ord_det_borrar($id,$id_cc)
    {
        $this->db->delete('compras.mer_surtido_det', array('id' => $id));
        redirect('mercadotecnia/pedido_det/'.$id_cc);
    }
     function sumit_ord_cerrar($id)
    {
        $this->mercadotecnia_model->cerrar_surtido($id);
        redirect('mercadotecnia/pedido');
    }











    

}
