<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Insumos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('insumos_model');
        $this->load->model('Catalogos_model');
        

    }
    function s_insumos_ctl()
    {
        $data['titulo'] = "Insumos Pendientes Sucursales y Modulos";
        $data['id_comprar'] = 1;
        $data['q']=$this->insumos_model->insumos_ctl_p('1');
        $data['q1']=$this->insumos_model->insumos_ctl_p_dep('1');
        $data['js'] = 'insumos/s_insumos_ctl_js';
        $this->load->view('main', $data);
    }
    function s_insumos_ctl_med()
    {
        $data['titulo'] = "Insumos Pendientes Medicos";
        $data['id_comprar'] =3;
        $data['q1']=$this->insumos_model->insumos_ctl_p('3');
        $data['js'] = 'insumos/s_insumos_ctl_med_js';
        $this->load->view('main', $data);
    }
    function s_insumos_det($id_cc,$fol,$id_comprar)
    {
        $data['titulo'] = "Insumos Detalle del pedido: ".$id_cc;
        $data['surtidor']=$this->Catalogos_model->busca_empleado_succ($this->session->userdata('depto'));
        $data['id_cc'] =$id_cc;
        $data['fol'] =$fol;
        $data['id_comprar'] =$id_comprar; 
        $data['q']=$this->insumos_model->insumos_det_p($id_cc,$fol);
        $this->load->view('main', $data);
    }
    
    function s_insumos_det_excel($id_cc,$fol,$id_comprar)
    {
        $data['id_cc'] = $id_cc;
        $data['fol'] = $fol;
        $data['id_comprar'] = $id_comprar;
        //$data['query']=$this->insumos_model->insumos_det_p($id_cc,$fol);
        $this->load->view('excel/s_insumos_det_excel', $data);
    }
    
    function s_insumos_det_cambio($id,$fol,$id_cc,$id_comprar)
    {
        $data['titulo'] = "Insumos Detalle del pedido ".$id;
        $data['id']=$id;
        $data['id_comprar']=$id_comprar;
        $data['id_cc']=$id_cc;
        $data['fol']=$fol;
        $q=$this->insumos_model->insumos_det_busca($id);
        $r=$q->row();
        $data['descripcion']=$r->descripcion;
        $data['codigo']=$r->id_insumos;
        $data['canp']=$r->canp;
        $data['can']=$r->cans;
        $data['empaque']=$r->empaque;
        $this->load->view('main', $data);
    }
    function s_insumos_det_cero($id,$fol,$id_cc,$id_comprar)
    {
        $a=array('cans'=>0,'canr'=>0);
        $this->db->where('id',$id);
        $this->db->update('papeleria.insumos_s',$a);
        redirect('insumos/s_insumos_det/'.$id_cc.'/'.$fol.'/'.$id_comprar);
    }
     function s_insumos_det_c()
    {
        $can=$this->input->post('can');
        $id=$this->input->post('id');
        $id_cc=$this->input->post('id_cc'); 
        $fol=$this->input->post('fol');
        $canp=$this->input->post('canp'); 
        if($can<=$canp)
        {  
        $a=array('cans'=>$can,'canr'=>$can);
        $this->db->where('id',$id);
        $this->db->update('papeleria.insumos_s',$a);
    }
    redirect('insumos/s_insumos_det/'.$id_cc.'/'.$fol.'/'.$this->input->post('id_comprar'));
    } 
    function s_insumos_cer()
    {
        $id_cc=$this->input->post('id_cc');
        $fol=$this->input->post('fol');
        $id_comprar=$this->input->post('id_comprar');
        $id_surtidor=$this->input->post('surtidor');
        $a=array('tipo'=>2,'fecha_sur'=>date('Y-m-d H:i:s'));
        $this->db->where('id',$id_cc);
        $this->db->update('papeleria.insumos_c',$a);
        $this->insumos_model->valida_piezas_insumos_d($id_cc,$fol,$id_surtidor);
        redirect('insumos/s_insumos_ctl/'.$id_comprar);
    }
    function s_insumos_imp_p($id_comprar)
    {
        $data['titulo'] = "Previos";
        $data['id_comprar'] = $id_comprar;
        $this->load->view('main', $data);
    }
    function s_insumos_imp_pre()
    {
        $fol1=$this->input->post('fol1');
        $fol2=$this->input->post('fol2');
        $letra=$this->input->post('letra');
        $id_comprar=$this->input->post('id_comprar');
        $data['cabeza']='Previo de pedidos';
        $data['a'] = $this->insumos_model->imprime_insumos_detalle_previo($fol1,$fol2,$letra,$id_comprar);
        $this->load->view('impresion/insumos_imprime_previo', $data);
    }
    function s_insumos_imp_p_depto()
    {
        $data['titulo'] = "Previos";
        $this->load->view('main', $data);
    }
    function s_insumos_imp_pre_depto()
    {
        $fol1=$this->input->post('fol1');
        $fol2=$this->input->post('fol2');
        $letra=$this->input->post('letra');
        $data['cabeza']='Previo de pedidos';
        $data['a'] = $this->insumos_model->imprime_insumos_detalle_previo_depto($fol1,$fol2,$letra);
        $this->load->view('impresion/insumos_imprime_previo', $data);
    }
    
   function s_insumos_ctl_his()
    {
        $data['titulo'] = "Insumos Surtidos";
        $data['q']=$this->insumos_model->insumos_ctl_his();
        $data['js'] = 'insumos/s_insumos_ctl_his_js';
        $this->load->view('main', $data);
    }
    function s_insumos_ctl_his_c($aaa,$mes)
    {
        $data['titulo'] = "Insumos Surtidos Sucursales";
        $data['titulo2'] = "Insumos Surtidos Departamentos";
        $data['titulo3'] = "Insumos Surtidos Medicos";
        $data['q']=$this->insumos_model->insumos_ctl_his_c($aaa,$mes);
        $data['q2']=$this->insumos_model->insumos_ctl_his_c2($aaa,$mes);
        $data['q3']=$this->insumos_model->insumos_ctl_his_c3($aaa,$mes);
        $data['js'] = 'insumos/s_insumos_ctl_his_js';
        $this->load->view('main', $data);
    }
   
    function insumos_imp($id,$fol)
    {
        $var1='ORIGINAL';
        $var2='COPIA';
        $data['div']='-  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  ';
        $data['final'] = $this->insumos_model->imprime_insumos_final();
        $data['cabeza'] = $this->insumos_model->imprime_insumos_cabeza($id,$fol,$var1);
        $data['cabeza2'] = $this->insumos_model->imprime_insumos_cabeza($id,$fol,$var2);
        
        $data['a'] = $this->insumos_model->imprime_insumos_detalle($id,$fol);
        $data['verifica'] = $this->insumos_model->verifica_datos_impresos($id,$fol);
        $data['final2'] = $this->insumos_model->imprime_insumos_final2();
        $this->load->view('impresion/insumos_imprime', $data);
    }
   
    function s_insumos_ctl_f()
    {
        $data['titulo1'] = "Insumos Pendientes de Departamentos";
        $data['titulo2'] = "Insumos Pendientes de Farmacias y Modulos";
        $data['titulo3'] = "Insumos Pendientes de Medicos";
        $data['q1']=$this->insumos_model->insumos_ctl_f_dep('1');
        $data['q2']=$this->insumos_model->insumos_ctl_f('1');
        $data['q3']=$this->insumos_model->insumos_ctl_f('3');
        $data['js'] = 'insumos/s_insumos_ctl_f_js';
        $this->load->view('main', $data);
    }
    
    function s_insumos_det_f($id,$suc)
    {
        $data['titulo'] = "Insumos Detalle del pedido ".$id;
        $data['id']=$id;
        $data['q']=$this->insumos_model->insumos_det_f($id);
        $data['q2']=$this->insumos_model->insumos_det_fsuc($id,$suc);
        $data['js'] = 'insumos/s_insumos_det_f_js';
        $this->load->view('main', $data);
    }
    
      
    function s_insumos_ctl_his_f_sec($id_comprar)
    {
        $data['titulo'] = "Insumos surtidos por Art&iacute;culo";
        $data['id_comprar'] = $id_comprar;
        $this->load->view('main', $data);
    }
   function s_insumos_ctl_his_f_sec_p()
    {
        $fec1=$this->input->post('fec1');
        $fec2=$this->input->post('fec2');
        $id_comprar=$this->input->post('id_comprar');
        $data['fec1']=$fec1;
        $data['fec2']=$fec2;
        $data['id_comprar']=$id_comprar;
        $data['q']=$this->insumos_model->insumos_ctl_his_f_sec_pa($fec1,$fec2,$id_comprar);
        $data['titulo'] = "Insumos surtidos por Art&iacute;culo de la fecha ".$fec1." al ".$fec2;
        $this->load->view('main', $data);
    }
    function s_insumos_ctl_his_f_sec_p_suc($fec1,$fec2,$id_comprar,$id_insumos)
    {
        $data['q']=$this->insumos_model->insumos_ctl_his_f_sec_pa_suc($fec1,$fec2,$id_comprar,$id_insumos);
        $data['titulo'] = "Insumos surtidos por Art&iacute;culo de la fecha ".$fec1." al ".$fec2;
        $this->load->view('main', $data);
    }
   function s_insumos_ctl_his_f()
    {
        $data['titulo'] = "Insumos Surtidos";
        $data['q']=$this->insumos_model->insumos_ctl_his_f();
        $data['js'] = 'insumos/s_insumos_ctl_his_f_js';
        $this->load->view('main', $data);
    }
    function s_insumos_ctl_his_f_det($suc)
    {
        $data['titulo'] = "Insumos Surtidos";
        $data['q']=$this->insumos_model->insumos_ctl_his_f_det($suc);
        $data['js'] = 'insumos/s_insumos_ctl_his_f_det_js';
        $this->load->view('main', $data);
    }
    function s_insumos_ctl_his_busca()
    {
        $data['titulo'] = "Insumos Surtidos";
        $this->load->view('main', $data);
    }
    function s_insumos_ctl_his_busca_det()
    {
        $data['titulo'] = "Insumos Surtidos";
        $fec1=$this->input->post('fec1');
        $fec2=$this->input->post('fec2');
        $data['q1']=$this->insumos_model->insumos_ctl_his_busca_det($fec1,$fec2);
        $data['js'] = 'insumos/s_insumos_ctl_his_busca_det_js';
        $this->load->view('main', $data);
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function s_insumos_ctl_his_e_sec($id_comprar)
    {
        $data['titulo'] = "Insumos surtidos por Art&iacute;culo";
        $data['id_comprar'] = $id_comprar;
        $this->load->view('main', $data);
    }
    
     function s_insumos_ctl_his_e_sec_p()
    {
        $fec1=$this->input->post('fec1');
        $fec2=$this->input->post('fec2');
        $id_comprar=$this->input->post('id_comprar');
        $data['fec1']=$fec1;
        $data['fec2']=$fec2;
        $data['id_comprar']=$id_comprar;
        $data['q']=$this->insumos_model->insumos_ctl_his_e_sec_pa($fec1,$fec2,$id_comprar);
        $data['titulo'] = "Insumos surtidos por Art&iacute;culo de la fecha ".$fec1." al ".$fec2;
        $this->load->view('main', $data);
    }

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
 function s_insumos_proceso_medicos_ver()
 {
        $data['titulo'] = "Insumos Surtidos";
        $data['valida']=$this->insumos_model->ver_pedido_for();
        $data['q']=$this->insumos_model->insumos_pre_pedido();
        $data['js'] = 'insumos/s_insumos_proceso_medicos_ver_js';
        $this->load->view('main', $data); 
 }
 function s_insumos_proceso_medicos()
 {
    $this->insumos_model->procesa_pedidos_medicos();
    redirect('insumos/s_insumos_proceso_medicos_ver');   
 }
 function s_insumos_proceso_medicos_ver_det($suc)
 {
        $data['titulo'] = "Insumos Surtidos";
        $data['q']=$this->insumos_model->insumos_pre_pedido_det($suc);
        $data['js'] = 'insumos/s_insumos_proceso_medicos_ver_det_js';
        $this->load->view('main', $data); 
 }
 
 function inserta_pre_pedido_cds()
 {
    $this->insumos_model->inserta_pre_pedido();
    redirect('insumos/s_insumos_proceso_medicos_ver');   
 }
 
 function s_insumos_nac()
    {
        $data['titulo'] = "Insumos Solicitados";
        $data['q']=$this->insumos_model->insumos_nac();
        //$data['js'] = 'insumos/insumos_det_f_js';
        $this->load->view('main', $data);
    } 
   
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function s_esp_insumos_sup()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Pedidos especiales";
        $data['suc'] = $this->Catalogos_model->busca_sucursal_zona($id_plaza);
        $data['q'] = $this->insumos_model->esp_insumos_sup_c();
        $data['js'] = 'insumos/s_esp_insumos_sup_js';
        $this->load->view('main', $data);
    }
function s_inserta_esp_insumo_sup()
{
        $a=array(
        'suc'=>$this->input->post('suc'), 
        'id_comprar'=>1, 
        'fecha'=>date('Y-m-d'), 
        'fecha_cap'=>'0000-00-00', 
        'tipo'=>0, 
        'fecha_cierre'=>'0000-00-00', 
        'fecha_sur'=>'0000-00-00', 
        'stat_sup'=>'E');
        $this->db->insert('papeleria.insumos_c',$a);
redirect('insumos/s_esp_insumos_sup');    
}
function s_esp_insumos_sup_det($id_cc,$suc)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['id_cc'] = $id_cc;
        $data['suc'] = $suc; 
        $data['titulo'] = "PEDIDO ESPECIAL DE ".$sucx;
        $data['id_insumos'] = $this->Catalogos_model->busca_insumo_ped_especial();
        $data['q'] = $this->insumos_model->esp_insumos_sup_d($id_cc);
        $data['js'] = 'insumos/s_esp_insumos_sup_det_js';
        $this->load->view('main', $data);
    }
function s_inserta_esp_insumo_sup_det()
{
        $this->insumos_model->insert_esp_ped(
        $this->input->post('id_cc'),
        $this->input->post('id_insumos'),
        $this->input->post('can'));        
        redirect('insumos/s_esp_insumos_sup_det/'.$this->input->post('id_cc').'/'.$this->input->post('suc'));    
}
function esp_borra_det($id,$id_cc,$suc)
{
        $data = array('id' => $id);
        $this->db->where('id',$id);
        $this->db->delete('papeleria.insumos_d',$data);
        redirect('insumos/s_esp_insumos_sup_det/'.$id_cc.'/'.$suc);       
}
function cerrar_esp_insumos($id,$id_cc,$suc)
{
        $this->insumos_model->inserta_insumos_s($id);
        
        $data = array('stat_sup' => 'EC');
        $this->db->where('id',$id);
        $this->db->where('stat_sup','E');
        $this->db->update('papeleria.insumos_c',$data);
        redirect('insumos/s_esp_insumos_sup');       
}
function s_esp_insumos_sup_val()
    {
        $data['titulo'] = "Pedidos especiales";
        $data['q'] = $this->insumos_model->esp_insumos_sup_cer();
        $data['js'] = 'insumos/s_esp_insumos_sup_val_js';
        $this->load->view('main', $data);
    }

function s_esp_insumos_sup_val_det($id_cc,$suc)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $id_plaza=11;
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['id_cc'] = $id_cc;
        $data['suc'] = $suc; 
        $data['titulo'] = "PEDIDO ESPECIAL DE ".$sucx;
        $data['q'] = $this->insumos_model->esp_insumos_sup_val_d($id_cc);
        $data['js'] = 'insumos/s_esp_insumos_sup_det_js';
        $this->load->view('main', $data);
    }

function cerrar_val_esp_borc($id_cc)
{
        $data = array('tipo' => 4);
        $this->db->where('id',$id_cc);
        $this->db->where('stat_sup','EC');
        $this->db->update('papeleria.insumos_c',$data);
        redirect('insumos/s_esp_insumos_sup_val');       
}
function cerrar_val_esp_bord($id,$id_cc,$suc)
{
        $data = array('tipo' => 4);
        $this->db->where('id',$id);
        $this->db->where('tipo',1);
        $this->db->update('papeleria.insumos_d',$data);
        redirect('insumos/s_esp_insumos_sup_val_det/'.$id_cc.'/'.$suc);       
}
function cerrar_val_esp($id_cc)
{
        $this->insumos_model->val_esp_ped($id_cc);
        redirect('insumos/s_esp_insumos_sup_val');       
}
function s_inv_insumos_medicos()
{
        $data['titulo'] = "Inventario de Insumos para supervisores";
        $data['q1'] = $this->insumos_model->inv_insumos_medicos();
        $data['js'] = 'insumos/s_inv_insumos_medicos_js';
        $this->load->view('main', $data);
}
function s_inv_insumos_medicos_det($suc)
{
        $data['titulo'] = "Inventario de Insumos para supervisores";
        $data['q1'] = $this->insumos_model->inv_insumos_medicos_det($suc);
        $data['js'] = 'insumos/s_inv_insumos_medicos_det_js';
        $this->load->view('main', $data);
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     function insumos_ctl_depto()
    {
        $data['titulo'] = "Insumos Pendientes de Departamentos";
        $data['q']=$this->insumos_model->insumos_ctl_depto();
        $data['js'] = 'insumos/insumos_ctl_depto_js';
        $this->load->view('main', $data);
    }
    
     function insumos_ctl_suc()
    {
        $data['titulo'] = "Insumos Pendientes de Sucursales";
        $data['q']=$this->insumos_model->insumos_ctl_suc();
        $data['js'] = 'insumos/insumos_ctl_suc_js';
        $this->load->view('main', $data);
    }
    
     
    
       function imp_depto_pend()
    {
        $data['titulo'] = "Previos";
        $this->load->view('main', $data);
    }
    
      function imp_suc_pend()
    {
        $data['titulo'] = "Previos";
        $this->load->view('main', $data);
    }
    
    
    
        function insumos_imp_depto()
    {
        $fol1=$this->input->post('fol1');
        $fol2=$this->input->post('fol2');
        $letra=$this->input->post('letra');
        $data['cabeza']='Previo de pedidos';
        $data['a'] = $this->insumos_model->imprime_insumos_previod_depto($fol1,$fol2,$letra);
        $this->load->view('impresion/insumos_imprime_previo', $data);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function insumos_det($suc,$id)
    {
        $data['titulo'] = "Insumos Detalle del pedido: ".$id;
        $data['suc']=$suc;
        $data['id']=$id;
        $data['q']=$this->insumos_model->insumos_det($suc,$id);
        $this->load->view('main', $data);
    }
       
    /***********************************************************************************************/
       function insumos_ctl_his_f_sec_2()
    {
        $data['titulo'] = "Insumos surtidos por Art&iacute;culo";
        $this->load->view('main', $data);
    }
    function insumos_ctl_his_f_sec_2p()
    {
        $fec1=$this->input->post('fec1');
        $fec2=$this->input->post('fec2');
        $data['q']=$this->insumos_model->insumos_ctl_his_f_sec_2p($fec1,$fec2);
        $data['titulo'] = "Insumos surtidos por Art&iacute;culo de la fecha: ".$fec1." al ".$fec2;
        $this->load->view('main', $data);
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function s_ped_insumos()
    {
        $data['titulo'] = "PEDIDO DE INSUMOS";
        $data['q']=$this->insumos_model->insumos_deptos();
        $this->load->view('main', $data);
    }
    /************************************************/
    function insert_ctl_insumo()
    {
        $depto=$this->session->userdata('depto');
        $a=array(
        'suc'=>$depto,
        'id_comprar'=>1,
        'fecha'=>date('Y-m-d'),
        'fecha_cap'=>date('Y-m-d'),
        'tipo'=>0);
        $this->db->insert('papeleria.insumos_c',$a);
    
        redirect('insumos/s_ped_insumos');
    }
    
   /*form_dropdown*/ 
    function s_ped_insumos_det($id_cc)
    {
        $suc = $this->session->userdata('suc'); //suc es la session de la sucursal y puede ser tomana como depto
        $data['id_cc'] = $id_cc; //obtiene en id de insumos_d
        $data['titulo'] = "PEDIDO DE INSUMOS";
        $data['suc'] = $this->Catalogos_model->saca_menu_desplegable($suc);    //obtenemos en menu desplegable por un arrar tomando   
        $data['q']=$this->insumos_model->ped_insumos_det($id_cc); //en cuenta a un arreglo
        $this->load->view('main', $data);
    } 

     /*form_dropdown*/   
    function inserta_producto_insumo()
    {//id_cc, id_insumos, canp, canp_suc, cans, fecha_cap, tipo,costo, costo_cat
        
        $id_insumos = $this->input->post('id_insumos');  /* Almacena a id_insumos*/
        
        $q=$this->Catalogos_model->getInsumoByID($id_insumos); /*obtiene la funcion del modelo*/
        $r=$q->row();
        $a=array( /*Lo almacena como un arreglo para insertarlo en la tabla insumos_d*/
        'id_cc'=>$this->input->post('id_cc'), //inserta a id_cc y el resto de sus variables
        'id_insumos'=>$id_insumos,
        'canp'=>$this->input->post('can'),
        'canp_suc'=>$this->input->post('can'),
        'fecha_cap'=>date('Y-m-d H:i:s'),
        'costo'=>$r->costo,
        'costo_cat'=>$r->costo,
        'tipo'=>0
        );
        $this->db->insert('papeleria.insumos_d',$a); 
        redirect('insumos/s_ped_insumos_det/'.$this->input->post('id_cc'));
    }
 
    function s_ped_insumos_det_delete($id_cc,$id)
    {
        $this->db->delete('papeleria.insumos_d', array('id' => $id));
        redirect('insumos/s_ped_insumos_det/'.$id_cc);
    }
    
    
    function s_ped_insumos_cer($id_cc)
    {
        $a=array('tipo'=>1,'fecha_cierre'=>date('Y-m-d H:i:s'));
        $this->db->where('id',$id_cc);
        $this->db->update('papeleria.insumos_c',$a);
        $this->insumos_model->cierra_ped_insumos($id_cc);  
     redirect('insumos/s_ped_insumos/'.$id_cc);
    }
    
    
    /***************************************************************************************************************/
    function insumos_medicos_inv()
    {
        $data['subtitulo'] = "Inventario de Medicos";
        $data['query'] = $this->insumos_model->departamentobyInsumo();
        $data['js'] = 'insumos/insumos_medicos_inv_js';
        $this->load->view('main', $data);
    }
    
    function insumos_medicos_inv_menu($suc)
    {
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['titulo'] = "Inventario de: ".$sucx;
        $data['query'] = $this->insumos_model->insumos_medicos_inv_menu($suc);
        $data['suc'] = $suc;
        $data['js'] = 'insumos/insumos_medicos_inv_menu_js';
        $this->load->view('main', $data);

    }
    function s_pre_pedido_formulado_medico()
    {
        $data['subtitulo'] = "Monto de Pre pedidos formulados medicos";
        $data['query'] = $this->insumos_model->pre_pedido_formulado_medico();
        $data['js'] = 'insumos/s_pre_pedido_formulado_medico_js';
        $this->load->view('main', $data);

    }
    function s_pre_pedido_formulado_medico_det($suc)
    {
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['titulo'] = "DETALLE DE PEDIDO FORMULADO DE ".$sucx;
        $data['query'] = $this->insumos_model->pre_pedido_formulado_medico_det($suc);
        $data['js'] = 'insumos/s_pre_pedido_formulado_medico_js';
        $this->load->view('main', $data);

    } 
    
    /******************************** Permisos Supervisores **********************************************************/
      function s_ctl_permisos()
    {
        $id_plaza = $this->session->userdata('id_plaza');
        $data['titulo'] = "Permisos de insumos";
        $data['query'] = $this->insumos_model->sucbyinsumo();
        $data['js'] = 'insumos/s_ctl_permisos_js';
        $this->load->view('main', $data);
    }
    
     function s_ctl_superv_esp($suc)
     {
           $data['titulo'] = "Pedido Especial";
           $data['suc'] = $suc;
           $data['q']=$this->insumos_model->pedidos_insumos_super($suc);
           $this->load->view('main', $data);
     }
     
    function inserta_insumo_super($suc)
    {
       //$suc = $this->input->post('suc');
        $data['suc'] = $suc;  
           $a=array(
           'suc'=>$suc,
           'id_comprar'=>1,
           'fecha'=>date('Y-m-d'),
           'fecha_cap'=>date('Y-m-d'),
           'tipo'=>0);
        $this->db->insert('papeleria.insumos_c',$a);
        redirect('insumos/s_ctl_superv_esp/'.$suc);
    }
    
    function pedidos_super_det($id_cc)
    {
        //$suc = $this->input->post('suc');
        $data['id_cc'] = $id_cc;
        $data['titulo'] = "PEDIDO DE INSUMOS";
        $data['suc'] = $this->insumos_model->saca_menu_desple();  
        $data['q']=$this->insumos_model->pedidos_super_det($id_cc);
        $this->load->view('main', $data);
    }
    
    function inserta_ins_super($id_cc)
    {
        $data['id_cc'] = $id_cc;
        $id_insumos = $this->input->post('id_insumos'); 
        $q=$this->insumos_model->getInsumoByID($id_insumos);
        $r=$q->row();
        $a=array( 
        'id_cc'=>$this->input->post('id_cc'), 
        'id_insumos'=>$id_insumos,
        'canp'=>$this->input->post('can'),
        'canp_suc'=>$this->input->post('can'),
        'fecha_cap'=>date('Y-m-d H:i:s'),
        'costo'=>$r->costo,
        'costo_cat'=>$r->costo,
        'tipo'=>0
        );
        $this->db->insert('papeleria.insumos_d',$a); 
        redirect('insumos/pedidos_super_det/'.$id_cc);
    }
    
     function pedidos_superins_delete($id_cc,$id)
    {
        $this->db->delete('papeleria.insumos_d', array('id' => $id));
        redirect('insumos/pedidos_super_det/'.$id_cc);
    }
    
    function pedidos_super_borrar($suc,$id)
    {
       $suc = $this->input->post('suc'); 
       $this->db->set('tipo', '4', false);
       $this->db->update('papeleria.insumos_c',null, array('id' => $id));
       redirect('insumos/s_ctl_superv_esp/'.$suc);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     function s_insumos_ctl_cont()
    {
        $data['titulo'] = "Insumos Pendientes Contrataciones";
        $data['id_comprar'] = 1;
        $data['q']=$this->insumos_model->insumos_ctl_cont('1');
        $data['js'] = 'insumos/s_insumos_ctl_cont_js';
        $this->load->view('main', $data);
   }
   
   function s_insumos_cont_det($id_cc,$fol,$id_comprar)
   {
     $data['titulo'] = "Insumos Detalle del pedido: ".$id_cc;
     $data['surtidor']=$this->Catalogos_model->busca_empleado_succ($this->session->userdata('depto'));
     $data['id_cc'] =$id_cc;
     $data['fol'] =$fol;
     $data['id_comprar'] =$id_comprar; 
     $data['q']=$this->insumos_model->insumos_det_cont($id_cc,$fol);
     $this->load->view('main', $data);
   }
   
   function s_insumos_det_cero_cont($id,$fol,$id_cc,$id_comprar)
   {
    $s = "select a.*, b.*
          from papeleria.insumos_s a
          join catalogo.bata_rhe b on b.id_cc = a.id_cc and b.id_insumos = a.id_insumos
          where a.id_cc = $id_cc
          and a.id = $id";
    $q = $this->db->query($s);
    if ($q->num_rows() == 0) {  
    } else {
        $this->db->set('cans', 'cans - 1', false);
        $this->db->set('canr', 'cans', false);
        $this->db->update('papeleria.insumos_s',null, array('id_cc' => $id_cc, 'id' => $id));       
     }
     redirect('insumos/s_insumos_cont_det/'.$id_cc.'/'.$fol.'/'.$id_comprar);
    
   }
   
   function s_insumos_det_cambio_cont($id,$fol,$id_cc,$id_comprar,$ide)
   {
      $data['titulo'] = "Insumos Detalle del pedido ".$id;
      $data['ide']=$ide;
      $data['id']=$id;
      $data['id_comprar']=$id_comprar;
      $data['id_cc']=$id_cc;
      $data['fol']=$fol;
      $q=$this->insumos_model->insumos_det_cont_busca($id,$ide);
      $r=$q->row();
      $data['nombre']=$r->name;
      $data['puestox']=$r->puestox;
      $data['descripcion']=$r->descripcion;
      $data['codigo']=$r->id_insumos;
      $data['empaque']=$r->empaque;
      $data['ide']=$this->insumos_model->saca_menu_insumito($ide);
      $this->load->view('main', $data);
   }
    
    function s_insumos_cambiar_cont()
    {
      $id_insumos_antes=$this->input->post('id_insumos_antes');
      $id_insumos_despues=$this->input->post('id_insumos_despues');
      $id_cc=$this->input->post('id_cc');
      $id_comprar=$this->input->post('id_comprar'); 
      $fol=$this->input->post('fol'); 
      if($id_insumos_antes <> $id_insumos_despues)
      {
      $s="select costo from catalogo.cat_insumos where id_insumos = $id_insumos_despues";
      $q=$this->db->query($s);
      $r=$q->row();
      $a=array('id_insumos' => $id_insumos_despues,'cans' => 1,'canr' => 1,'costo' => $r->costo,'costo_cat' => $r->costo);
      $b=array('id_insumos' => $id_insumos_despues);
      $this->db->update('papeleria.insumos_s',$a,array('id_cc' => $id_cc));
      $this->db->update('catalogo.bata_rhe',$b,array('id_cc' => $id_cc));
      }     
      redirect('insumos/s_insumos_cont_det/'.$id_cc.'/'.$fol.'/'.$id_comprar); 
    }
    
    function s_insumos_cer_cont()
    {
      $id_cc = $this->input->post('id_cc');
      $fol = $this->input->post('fol');
      $id_comprar = $this->input->post('id_comprar');
      $id_surtidor = $this->input->post('surtidor');
      $a=array('tipo'=>2,'fecha_sur'=>date('Y-m-d H:i:s'));
      $this->db->where('id',$id_cc);
      $this->db->update('papeleria.insumos_c',$a);
      $this->insumos_model->valida_piezas_insumos_d($id_cc,$fol,$id_surtidor);
      redirect('insumos/s_insumos_ctl_cont/'.$id_comprar);  
    }
    
    function s_insumos_cont_his()
    {
      $data['titulo'] = "Insumos Surtidos";
      $data['q']=$this->insumos_model->insumos_cont_his();
      $data['js'] = 'insumos/s_insumos_cont_his_js';
      $this->load->view('main', $data);
    }
    
    function s_insumos_cont_his_c($aaa,$mes)
    {
     $data['titulo'] = "Insumos Surtidos Contrataciones";
     $data['q']=$this->insumos_model->insumos_cont_his_c($aaa,$mes);
     $data['js'] = 'insumos/s_insumos_cont_hisc_js';
     $this->load->view('main', $data);   
    }
    
    function insumos_cont_imp($id,$fol)
    {
      $var1='ORIGINAL';
      $var2='COPIA';
      $data['div']='-  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  ';
      $data['finalc'] = $this->insumos_model->imprime_cont_final();
      $data['cabeza'] = $this->insumos_model->imprime_cont_cabeza($id,$fol,$var1);
      $data['cabeza2'] = $this->insumos_model->imprime_cont_cabeza($id,$fol,$var2);
      $data['a'] = $this->insumos_model->imprime_cont_detalle($id,$fol);
      $this->load->view('impresion/cont_imprime', $data);   
    }
    
    
    function s_insumos_ctl_extra()
    {
      $data['titulo'] = "Insumos Pendientes Uniformes";
      $data['id_comprar'] = 1;
      $data['q']=$this->insumos_model->insumos_ctl_extra('1');
      $data['js'] = 'insumos/s_insumos_ctl_extra_js';
      $this->load->view('main', $data);   
    }
    
    function s_insumos_extra_det($id_cc,$fol,$id_comprar)
    {
     $data['titulo'] = "Detalle del pedido: ".$id_cc;
     $data['surtidor']=$this->Catalogos_model->busca_empleado_succ($this->session->userdata('depto'));
     $data['id_cc'] =$id_cc;
     $data['fol'] =$fol;
     $data['id_comprar'] =$id_comprar;
     $data['q']=$this->insumos_model->insumos_extra_det($id_cc,$fol);
     $data['q2']=$this->insumos_model->insumos_extra_det2($id_cc,$fol);
     $data['js'] = 'insumos/s_insumos_extra_det_js';
     $this->load->view('main', $data);   
    }
    
    function s_insumos_extra_det_cero($id_cc,$id,$fol,$id_comprar,$nom,$id_ex,$sur)
    {
     $b=array('can_s' => 0);
     $this->db->update('papeleria.pedidoextra_s',$b,array('id_cc' => $id_cc, 'nomina' => $nom, 'id_ex' => $id_ex)); 
     $this->insumos_model->actualiza_ped_cero($sur,$id_cc, $id);
     redirect('insumos/s_insumos_extra_det/'.$id_cc.'/'.$fol.'/'.$id_comprar);   
    }
    
    function s_insumos_extra_cambio($id_cc,$id,$id_comprar,$id_ex)
    {
      $data['titulo'] = "Insumos Detalle del pedido ".$id_cc;
      $data['id_cc']=$id_cc;
      $data['id']=$id;
      $data['id_comprar'] = $id_comprar;
      $data['id_ex'] = $id_ex;
      $q=$this->insumos_model->insumos_extra_bus($id_cc,$id,$id_ex);
      $r=$q->row();
      $data['nombre']=$r->completo;
      $data['puestox']=$r->puestox;
      $data['descripcion']=$r->descripcion;
      $data['fol'] = $r->fol;
      $data['id_dd'] = $r->id_dd;
      $data['insumos']=$r->id_insumos;
      $data['cantidad'] =$r->cantidad;
      $data['canp'] = $r->canp;
      $data['can'] = $r->can_s;
      $data['nom'] = $r->nomina;
      $data['nomina']=$this->insumos_model->menu_emple_extra($r->nomina);
      $this->load->view('main', $data);    
    }
    
    
    function s_insumos_extra_cambiar2()
    {
        $id_cc = $this->input->post('id_cc');
        $id_dd = $this->input->post('id_dd');
        $id_ex = $this->input->post('id_ex');
        $id = $this->input->post('id');
        $fol = $this->input->post('fol');
        $id_comprar = $this->input->post('id_comprar');
        $id_insumos_antes=$this->input->post('id_insumos_antes');
        $id_insumos_despues=$this->input->post('id_insumos_despues');
    
        if($id_insumos_antes <> $id_insumos_despues)
        {
            
            $this->db->trans_start();
            $f1=array('id_insumos' => $id_insumos_despues);
            $this->db->update('papeleria.pedidoextra_s',$f1,array('id_ex' => $id_ex));
            
            $q1 = $this->insumos_model->getPedidoExtra_sByID_ex($id_ex);
            $r1 = $q1->row();
            $q3 = $this->insumos_model->getInsumo_sByID($id);
            $r3 = $q3->row();
            $s2="select costo from catalogo.cat_insumos where id_insumos = $id_insumos_despues";
            $q2=$this->db->query($s2);
            $r2 = $q2->row();
            
            $sql1 = "insert into papeleria.insumos_s (id_cc, id_dd, fol, id_insumos, canp, cans, fecha_cap, tipo, id,costo, costo_cat, canr, fecha_sur, fecha_val) 
            values($id_cc, $id_dd, '$r3->fol', $id_insumos_despues, $r1->can_p, $r1->can_s, '$r3->fecha_cap', $r3->tipo,$id,$r2->costo, $r2->costo, $r1->can_s, '0000-00-00', '0000-00-00') on duplicate key update cans = cans  + values(cans),canr = cans
            ";
            $this->db->query($sql1);
           
            $sql2 = "insert into papeleria.insumos_s (id_cc, id_dd, fol, id_insumos, canp, cans, fecha_cap, tipo, id, costo, costo_cat, canr, fecha_sur, fecha_val) 
            values($id_cc, $id_dd, '$r3->fol', $id_insumos_antes, $r1->can_p, $r1->can_s, '$r3->fecha_cap', $r3->tipo,$id, $r3->costo, $r3->costo_cat, $r3->canr, '$r3->fecha_sur', '$r3->fecha_val') on duplicate key update cans = cans - values(cans),canr = cans
            ";
            $this->db->query($sql2);
            $this->db->trans_complete();
        }
       redirect('insumos/s_insumos_extra_det/'.$id_cc.'/'.$fol.'/'.$id_comprar);  
    }
    
   
    function insumos_extra_cant($id_cc,$id,$id_dd,$id_comprar,$id_ex)
    {
      $data['titulo'] = "Insumos Detalle del pedido ".$id_cc;
      $data['id_ex'] = $id_ex;
      $data['id']=$id;
      $data['id_dd']=$id_dd;
      $data['id_comprar'] = $id_comprar;
      $data['id_cc']=$id_cc;
      $q=$this->insumos_model->insumos_extra_bus2($id_cc,$id,$id_dd,$id_ex);
      $r=$q->row();
      $data['nom'] = $r->nomina;
      $data['nombre']=$r->completo;
      $data['puestox']=$r->puestox;
      $data['descripcion']=$r->descripcion;
      $data['insumos']=$r->id_insumos;
      $data['cantidad'] =$r->cantidad;
      $data['fol'] = $r->fol;
      $data['canp'] = $r->canp;
      $data['can'] = $r->can_s;
      $this->load->view('main', $data);    
    }
    
    function s_insumos_extra_can()
    {
     $can = $this->input->post('can');
     $can_despues = $this->input->post('can_despues');
     $cantidad = $this->input->post('cantidad');
     $id_cc = $this->input->post('id_cc');
     $fol = $this->input->post('fol');
     $id_comprar = $this->input->post('id_comprar');
     $id_dd = $this->input->post('id_dd');
     $id = $this->input->post('id');
     $nom = $this->input->post('nom');
     $id_ex = $this->input->post('id_ex');
     $insumos = $this->input->post('insumos');
      /*
       echo $can_despues .'can_antes <br />';
      echo $can .'can_despues<br />';
      echo $cantidad .'nose <br />';
     die();
     */
     if($can_despues <> $can){
     if($can<=$cantidad and $can_despues == 0){
        $a = array('can_s' => $can);
        $this->db->update('papeleria.pedidoextra_s',$a,array('id_ex'=>$id_ex));
        $this->insumos_model->can_mas2_extra($can, $id_cc,$insumos,$id,$id_dd);
        }elseif($can<=$cantidad and $can_despues > 0){
        $a = array('can_s' => $can);
        $this->db->update('papeleria.pedidoextra_s',$a,array('id_ex'=>$id_ex));
        $this->insumos_model->can_menos_extra($can, $id_cc,$insumos,$id,$id_dd);
     }elseif($can = $cantidad and $can_despues > 0){
        $a = array('can_s' => $can);
        $this->db->update('papeleria.pedidoextra_s',$a,array('id_ex'=>$id_ex));
        $this->insumos_model->can_mas_extra($can_despues,$can, $id_cc,$insumos,$id,$id_dd);
      }
     }
     redirect('insumos/s_insumos_extra_det/'.$id_cc.'/'.$fol.'/'.$id_comprar);    
     
    }
    
    function s_insumos_extra_cer()
    {
     $id_cc = $this->input->post('id_cc');
     $fol = $this->input->post('fol');
     $id_comprar = $this->input->post('id_comprar');
     $id_surtidor=$this->input->post('surtidor');
     $a=array('tipo'=>2,'fecha_sur'=>date('Y-m-d H:i:s'));
     $this->db->where('id',$id_cc);
     $this->db->update('papeleria.insumos_c',$a);
     $b=array('tipo' => 2);
     $this->db->where('id_cc',$id_cc);
     $this->db->update('papeleria.pedido_extra',$b);
     $this->insumos_model->valida_piezas_insumos_d2($id_cc,$fol,$id_surtidor);
     redirect('insumos/s_insumos_ctl_extra/');    
    }
    
    function s_insumos_extra_his()
    {
      $data['titulo'] = "Insumos Surtidos";
      $data['q']=$this->insumos_model->insumos_extra_his();
      $data['js'] = 'insumos/s_insumos_cont_his_js';
      $this->load->view('main', $data);   
    }
    
    function s_insumos_extra_hisc($aaa,$mes)
    {
     $data['titulo'] = "Insumos Surtidos Uniformes";
     $data['q']=$this->insumos_model->insumos_extra_hisc($aaa,$mes);
     $data['js'] = 'insumos/s_insumos_extra_hisc_js';
     $this->load->view('main', $data);     
    }
    
      function s_insumos_extra_hisc2($id,$fol)
    {
     $data['titulo'] = "Insumos Surtidos Uniformes";
     $data['q']=$this->insumos_model->insumos_extra_hisc2($id,$fol);
     $data['js'] = 'insumos/s_insumos_extra_hisc2_js';
     $this->load->view('main', $data);     
    }
    
    function insumos_extra_imp($id,$fol,$nomina)
    {
      $var1='ORIGINAL';
      $var2='COPIA';
      $data['div']='-  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  ';
      $data['finalc'] = $this->insumos_model->imprime_extra_final($id,$nomina);
      $data['cabeza'] = $this->insumos_model->imprime_extra_cabeza($id,$fol,$nomina,$var1);
      $data['cabeza2'] = $this->insumos_model->imprime_extra_cabeza($id,$fol,$nomina,$var2);
      $data['a'] = $this->insumos_model->imprime_extra_detalle($id,$fol,$nomina);
      $this->load->view('impresion/extra_imprime', $data);      
    }
   
  
  /************************************************** Inventario oficinas *********************************************/ 
  function inventario_insumos_depto()
  {
     $data['titulo'] = "Inventario de Insumos en Oficinas";
     $data['q']=$this->insumos_model->inventario_insumos();
     $data['js'] = 'insumos/inventario_insumos_depto_js';
     $this->load->view('main', $data);
  }
  
  function inventario_insumos_depto_det($id_insumos)
  {
    $data['titulo'] = "Cambiar Existencia de: ".$id_insumos;
    $data['id_insumos']=$id_insumos;
    $q = $this->insumos_model->obten_insumo($id_insumos);
    $r=$q->row();
    $data['descripcion']=$r->descripcion;
    $data['existencia']=$r->existencia;    
    $this->load->view('main', $data); 
  }
  
   function inventario_insumo_cambiar()
   {
    $id_insumos = $this->input->post('id_insumos');
    $data = array('existencia' => $this->input->post('existencia'));
    $this->insumos_model->actualiza_inventario($data,$id_insumos);
    redirect('insumos/inventario_insumos_depto/');
   }
    
    
    function imp_inv_ins()
    {
      $data['cabeza'] = $this->insumos_model->imprime_inventario_cabeza();
      $data['detalle'] = $this->insumos_model->imprime_inv_detalle();
      $this->load->view('impresion/inventario_imprime', $data);     
    }
    
       
    /******************************************** Facturas ***********************************************************************/
      function inventario_facturas()
   {
    $data['titulo'] = "Facturas";
    $data['q']=$this->insumos_model->inventario_facturitas();
    $data['js'] = 'insumos/inventario_facturas_js';
    $this->load->view('main', $data);
   }
   
   function factura_inv_nuevo()
   {
    $data['titulo'] = "Nueva factura";
    $data['proveedor'] = $this->insumos_model->busca_proveedor_ins();
    $data['js'] = 'catalogos/factura_inv_nuevo_js';
    $this->load->view('main', $data);
   }
   
   function factura_nueva_submit()
   {
    $folio = $this->input->post('folio');
    $id = $this->input->post('id');
    $this->insumos_model->inserta_folio_fact($folio, $id);
    redirect('insumos/inventario_facturas/');
   }
   
    function factura_inv_borrar($folio)
   {
    $this->db->set('tipo', '4', false);
    $this->db->update('papeleria.control_facturas',null, array('folio' => $folio));
    redirect('insumos/inventario_facturas');
   }
   
   function factura_inv_det($folio)
   {
    $data['titulo'] = "Contenido de la factura: ".$folio;
    $data['folio'] = $folio;
    $data['id_insumos'] = $this->insumos_model->obten_insumobyfact();
    $data['q'] = $this->insumos_model->muestra_ins_byfact($folio);
    $data['q2'] = $this->insumos_model->muestra_total_fact($folio);
    $data['js'] = 'insumos/devolucion_insumos_js';
    $this->load->view('main', $data); 
   }
   
   function agrega_insumo_factura()
   {
    $folio = $this->input->post('folio');
    $id_insumos = $this->input->post('id_insumos');
    $cantidad = $this->input->post('cantidad');
    $precio = $this->input->post('precio');
    $iva = $this->input->post('iva');
    $data=array(      
        'folio'        => $folio,
        'id_insumos'   => $id_insumos,
        'cantidad'     => $this->input->post('cantidad'),
        'precio'       => $this->input->post('precio'),
        'subtotal'     => $precio * $cantidad,
        'total'        => ($precio * $cantidad)+(($precio * $cantidad)*($iva/100)),
        'iva'          => $iva/100,
        'tipo'         => 0
        );
    $this->db->insert('papeleria.detalle_facturas', $data);
    redirect('insumos/factura_inv_det/'.$folio);
   }
    
    function fact_inv_delete($folio, $id_insumos)
    {
     $this->db->delete('papeleria.detalle_facturas', array('folio' => $folio, 'id_insumos' => $id_insumos));
     redirect('insumos/factura_inv_det/'.$folio); 
    }
    
    function fact_inv_editar($folio, $id_insumos)
    {
     $data['titulo'] = "Edicion del producto: ".$id_insumos;
     $data['folio'] = $folio;
     $data['id_insumos'] = $id_insumos; 
     $data['q'] = $this->insumos_model->ver_ins_fact($folio, $id_insumos);
     $this->load->view('main', $data); 
    }
    
    function fact_inv_edita_submit()
    {       
      $folio = $this->input->post('folio');
      $id_insumos = $this->input->post('id_insumos');
      $precio = $this->input->post('precio');
      $cantidad = $this->input->post('cantidad');
      $iva = $this->input->post('iva');
                       
      $data=array(      
      'precio'      => $precio,
      'cantidad'    => $cantidad,
      'subtotal'    => $precio * $cantidad, 
      'total'       => ($precio * $cantidad)+(($precio * $cantidad)*($iva/100)),
      'iva'         => $iva/100,
      );
      $this->insumos_model->actualiza_ins_fact($data, $folio, $id_insumos);
      redirect('insumos/factura_inv_det/'.$folio);
    }
    
    function fact_inv_cer($folio)
    {
      $a=array('tipo'=>1,'fecha_cierre'=>date('Y-m-d H:i:s'));
      $b = array('tipo' => 1);
      $this->db->where('folio',$folio);
      $this->db->update('papeleria.control_facturas',$a);
      
      $this->db->where('folio',$folio);
      $this->db->update('papeleria.detalle_facturas',$b);
      
      $this->insumos_model->actualiza_inv_exis($folio);  
      redirect('insumos/inventario_facturas/');   
    }
    
    function inventario_facturas_his()
    {
     $data['titulo'] = "Historial de Facturas";
     $data['q']=$this->insumos_model->facturas_his();
     //$data['js'] = 'insumos/inventa_fact_js';
     $this->load->view('main', $data);   
    }
    
    function inv_fact_hisc($aaa, $mes)
    {
      $data['titulo'] = "Historial de Facturas Mensuales";
      $data['q'] = $this->insumos_model->facturas_hisc($aaa,$mes);
      $data['js'] = 'insumos/inv_fact_js';
      $this->load->view('main', $data);    
    }
    
    function factura_imp($folio, $id_prov)
    {
     $data['cabeza'] = $this->insumos_model->cabeza_facturas_imp($folio,$id_prov);
     $data['detalle'] = $this->insumos_model->imprime_fact_detalle($folio, $id_prov);
     $data['final'] = $this->insumos_model->pie_facturas_imp($folio);
     $this->load->view('impresion/facturas_imprime', $data);   
    }
    
    
    /****************************************** Devoluciones ***************************************************************/
    
    function folio_devolucion()
    {
     $data['titulo'] = "folios";
     $data['q'] = $this->insumos_model->folios_devoluciones();
     $this->load->view('main', $data);       
    }
    
    function folio_dev_nuevo()
    {
     $data['titulo'] = "Nuevos Folios";
     $data['suc'] = $this->insumos_model->obten_sucus();
     $this->load->view('main', $data);
    }
    
    function inserta_folio_devoluciones()
    {
      $suc = $this->input->post('suc'); 
           $a=array(
           'fecha_cap'=>date('Y-m-d H:i:s'),
           'fecha_cierre'=>date('0000-00-00 00:00:00'),
           'estado'=>0,
           'suc' => $suc);
        $this->db->insert('papeleria.folio_devoluciones',$a);
        redirect('insumos/folio_devolucion');     
    }
    
    function dev_ins_borrar($folio)
    {
       $this->db->set('estado', '4', false);
       $this->db->update('papeleria.folio_devoluciones',null, array('folio' => $folio));
       redirect('insumos/folio_devolucion');    
    }
    
    function devolucion_insumos($folio, $suc)
    {
     $data['folio'] = $folio;
     $data['suc'] = $suc;
     $data['subtitulo'] = "Nuevos insumos";
     $data['id_insumos'] = $this->insumos_model->obten_insdev();
     $data['q'] = $this->insumos_model->dev_ins_det($folio, $suc);
     $data['js'] = 'insumos/devolucion_insumos_js';
     $this->load->view('main', $data);    
    }
    
    function agrega_devolucion()
    {
     $id_insumos = $this->input->post('id_insumos');
     $suc = $this->input->post('suc');
     $cantidad = $this->input->post('cantidad');
     $folio = $this->input->post('folio');
     $a=array( 
        'folio' => $this->input->post('folio'),
        'id_insumos'=>$id_insumos,
        'suc'=>$suc,
        'cantidad'=>$cantidad,
        'fecha'=>date('Y-m-d'),
        'fecha_cap'=>date('Y-m-d H:i:s'),
        'tipo' => 0);
     $this->db->insert('papeleria.inv_dev_ins',$a);
     redirect('insumos/devolucion_insumos/'.$folio.'/'.$suc);   
    }
    
    function  dev_insumos_delete($folio, $id_insumos)
    {
      $this->db->delete('papeleria.inv_dev_ins', array('folio' => $folio, 'id_insumos' => $id_insumos));
      redirect('insumos/devolucion_insumos/'.$folio);   
    }
    
    function dev_insumos_cerrar($folio)
    {
     $a=array('estado'=>1,'fecha_cierre'=>date('Y-m-d H:i:s'));
     $b=array('tipo' => 1);
     $this->db->where('folio',$folio);
     $this->db->update('papeleria.folio_devoluciones',$a);
     
     $this->db->where('folio',$folio);
     $this->db->update('papeleria.inv_dev_ins', $b);
     $this->insumos_model->actualiza_ins_inv($folio);
     redirect('insumos/folio_devolucion/');    
    }
    
    
    function devolucion_insumos_hisc()
    {
      $data['titulo'] = "Devoluciones mensuales";
      $data['q']=$this->insumos_model->devolucion_insumos_hisc();
      $this->load->view('main', $data);
    }
    
    
    function devolucion_insumos_hisc2($aaa,$mes)
    {
      $data['titulo'] = "Devoluciones mensuales";
      $data['q'] = $this->insumos_model->devolucion_ins_hisc2($aaa,$mes);
      $data['js'] = 'insumos/devolucion_insumos_hisc2_js';
      $this->load->view('main', $data);
    }
  
    function devolucion_imp($suc, $folio)
    {
     $var1='ORIGINAL';
     $var2='COPIA';
     $data['div']='-  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  ';
     $data['final'] = $this->insumos_model->imprime_pie_devolucion();
     $data['cabeza'] = $this->insumos_model->imprime_dev_cabeza($suc,$folio,$var1);
     $data['cabeza2'] = $this->insumos_model->imprime_dev_cabeza($suc,$folio,$var2);
     $data['a'] = $this->insumos_model->imp_devolucion_detalle($suc,$folio);
     $this->load->view('impresion/devolucion_imprime', $data);   
    }
  
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      function s_insumos_ctl_e()
     {
      $data['titulo1'] = "Insumos Pendientes de Contrataciones";
      $data['titulo2'] = "Insumos Pendientes de Uniformes";
      $data['q1']=$this->insumos_model->insumos_ctl_en('1');
      $data['q2']=$this->insumos_model->insumos_ctl_eu('1');
      $data['js'] = 'insumos/s_insumos_ctl_e_js';
      $this->load->view('main', $data);
     }
    
    
     function s_insumos_det_e($id, $suc)
     {
      $data['titulo'] = "Insumos Detalle del pedido ".$id;
      $data['id']=$id;
      $data['q']=$this->insumos_model->insumos_det_e($id);
      $data['q2']=$this->insumos_model->insumos_det_fsuc($id,$suc);
      $data['js'] = 'insumos/s_insumos_det_e_js';
      $this->load->view('main', $data);  
     }
    
    
    
    
    

     

}
?>
