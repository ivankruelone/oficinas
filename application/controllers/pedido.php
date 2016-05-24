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

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
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
        if ($this->input->post('pass') == 'unicoo') {
            $this->Pedido_model->generar_sumit($this->input->post('por1'), $this->input->
                post('por2'), $this->input->post('por3'), $this->input->post('por4'), $this->
                input->post('por5'), $this->input->post('alm'));
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
    function valida_ped($fechag, $xtipo)
    {
        $this->Pedido_model->sumit_valida_ped($fechag, $xtipo);
        redirect('pedido/pedidos');
    }
    function pedido_compra()
    {
        $data['titulo'] = "Pedidos por provedor sin trabajar compradores";
        $data['a'] = $this->Pedido_model->pedido_compra();
        $data['js'] = 'pedido/pedido_compra_js';
        $this->load->view('main', $data);
    }
    function borrar_pedido($prv, $id_ped)
    {
        $data = array('tipo' => 'X');
        $this->db->where('id_ped', $id_ped);
        $this->db->where('prv', $prv);
        $this->db->update('compras.orden_c', $data);
        redirect('pedido/pedido_compra');
    }
    function pedido_compra_detalle($prv, $id_ped)
    {
        $data['titulo'] = "Ordenes  de compra";
        $data['a'] = $this->Pedido_model->pedido_compra_detalle($prv, $id_ped);
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

    function autoriza($id_ped, $prv, $sec)
    {

        if ($clagob == null) {
            $data = array('autoriza' => date('Y-m-d'));
            $this->db->where('id_ped', $id_ped);
            $this->db->where('prv', $prv);
            $this->db->where('tipo', 'A');
            $this->db->where('sec', $sec);
            $this->db->update('compras.orden_d', $data);
        } else {
            $data = array('autoriza' => date('Y-m-d'));
            $this->db->where('id_ped', $id_ped);
            $this->db->where('prv', $prv);
            $this->db->where('tipo', 'A');
            $this->db->where('sec', $sec);
            $this->db->where('clagob', $clagob);
            $this->db->update('compras.orden_d', $data);
        }
        redirect('pedido/precios');
    }

    function com_pedido()
    {
        $data['titulo'] = "Generar pedido";
        $data['alm'] = $this->catalogos_model->busca_almacen_pedidos();
        $data['prv'] = $this->catalogos_model->busca_prv();
        $data['lic'] = $this->catalogos_model->busca_licitacion();
        $data['q'] = $this->Pedido_model->com_pedido();
        $data['cia'] = 13;
        $this->load->view('main', $data);
    }
    function com_pedido_borrado($id)
    {
        $data = array('tipo' => 'X');
        $this->db->where('id', $id);
        $this->db->where('tipo', 'A');
        $this->db->update('compras.pedido_c', $data);
        $this->db->delete('compras.pedido_d', array('id_cc' => $id));
        
        redirect('pedido/com_pedido');
    }
    function com_generar_sumit()
    {
        if ($this->input->post('pass') == 'unico') {
            $por = $this->catalogos_model->busca_almacen_por($this->input->post('alm'));
            $cia = $this->input->post('cia');
            //die();
            if ($this->input->post('prv') == 0) {
                $data = array(
                    'fecha' => date('Y-m-d'),
                    'id_user' => $this->session->userdata('id'),
                    'almacen' => $this->input->post('alm'),
                    'prv' => $this->input->post('prv'),
                    'licita' => $this->input->post('lic'),
                    'cia' => $cia);
                $this->db->insert('compras.pedido_c', $data);
            } else {
                if ($por == 'sec') {
                    $this->Pedido_model->agrega_pedido_det_prv_sec($this->input->post('alm'), $this->
                        input->post('prv'), $cia,$this->input->post('lic'));
                } else {
                    $this->Pedido_model->agrega_pedido_det_prv_cla($this->input->post('alm'), $this->
                        input->post('prv'), $cia,$this->input->post('lic'));
                }

            }
        }
        redirect('pedido/com_pedido');
    }
    function com_pedido_det($id)
    {
        $alma = $this->catalogos_model->busca_almacen_ped($id);
        $pr = $this->catalogos_model->busca_almacen_ped_prv($id);
        $data['titulo'] = "Generar pedido " . $alma;
        $data['id_cc'] = $id;
        $data['q'] = $this->Pedido_model->com_pedido_det($id);
        $data['js'] = 'pedido/com_pedido_det_js';
        $this->load->view('main', $data);
    }
    function com_pedido_det_clave($id)
    {
        $alma = $this->catalogos_model->busca_almacen_ped($id);
        $data['codigo'] = $this->catalogos_model->busca_codigo_especialidad();
        $data['titulo'] = "Generar pedido " . $alma;
        $data['id_cc'] = $id;
        $data['q'] = $this->Pedido_model->com_pedido_det_clave($id);
        $data['js'] = 'pedido/com_pedido_det_js';
        $this->load->view('main', $data);
    }
    function com_generar_det_sumit_cla()
    {
        $regalo=$this->input->post('regalo');
        $codigo=$this->input->post('codigo');
        $can=$this->input->post('can');
        $costo=$this->input->post('costo');
        $id_cc=$this->input->post('id_cc');
        $this->Pedido_model->agrega_pedido_det_cla($id_cc,$codigo,$can,$regalo,$costo);
        redirect('pedido/com_pedido_det_clave/'.$id_cc);
    }
    
    function com_generar_det_sumit()
    {
        echo $this->input->post('regalo');
        die();
        $this->Pedido_model->agrega_pedido_det($this->input->post('id_cc'), $this->
            input->post('sec'), $this->input->post('can'), $this->input->post('regalo'), $this->
            input->post('descu'));
        redirect('pedido/com_pedido_det/' . $this->input->post('id_cc'));
    }
    function com_ped_cambia()
    {
        $data = array(
            'ped' => $this->input->post('pedi'),
            'fecha' => date('Y-m-d H:i:s'),
            'regalo' => $this->input->post('regalo'),
            'descu' => $this->input->post('descu'),
            'costo' => $this->input->post('costo'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('compras.pedido_d', $data);
        redirect('pedido/com_pedido_det/' . $this->input->post('id_cc'));
    }
    function com_pedido_det_b($id_cc, $id)
    {
        $this->db->delete('compras.pedido_d', array('id' => $id));
        redirect('pedido/com_pedido_det/' . $id_cc);
    }
    function com_pedido_cer($id)
    {
        $this->Pedido_model->com_cerrar_pedido($id);
        redirect('pedido/com_pedido');
    }
    function com_pedido_his()
    {
        $data['titulo'] = "Generar pedido";
        $data['q'] = $this->Pedido_model->com_pedido_his();
        $this->load->view('main', $data);
    }
    function borrar_orden_cerrada($id)
    {
        $a=array('estatus' => 0,'fecha_desactivado' => date('Y-m-d H:i:s'));
        $this->db->where('id',$id);
        $this->db->update('compras.pedido_c',$a);
        redirect('pedido/com_pedido_his');
    }
    function com_pedido_det_his($id)
    {
        $alma = $this->catalogos_model->busca_almacen_ped($id);
        $data['titulo'] = "Generar pedido " . $alma;
        $data['id_cc'] = $id;
        $data['q'] = $this->Pedido_model->com_pedido_det_his($id);
        $data['js'] = 'pedido/com_pedido_det_js';
        $this->load->view('main', $data);
    }
    function com_pedido_imp($id,$estatus)
    {
        $data['a'] = $this->Pedido_model->com_pedido_det_his($id);
        $data['id'] = $id;
        $data['estatus'] = $estatus;
        //$data['js'] = 'orden/imprime_js';
        $this->load->view('impresion/com_pedido_orden', $data);
    }
    
    function precios_mal()
    {
        $data['titulo'] = "Comparar precios";
        $data['q'] = $this->Pedido_model->precios_mal();
        $data['js'] = 'pedido/precios_mal_js';
        $this->load->view('main', $data);
    }

    function com_pedido_det_auto($id)
    {
        $a = array('val' => 1, 'fecha_val' => date('Y-m-d H:i:s'));
        $this->db->where('id', $id);
        $this->db->update('compras.pedido_d', $a);
        redirect('pedido/precios_mal');
    }
    function precios_mal_his()
    {
        $data['titulo'] = "Comparar precios";
        $data['q'] = $this->Pedido_model->precios_mal();
        $this->load->view('main', $data);
    }
    function precios_mal_imprime()
    {
        $fec1 = $this->input->post('fec1');
        $fec2 = $this->input->post('fec2');
        $data['a'] = $this->Pedido_model->precios_mal_r($fec1, $fec2);
        $data['fec1'] = $fec1;
        $data['fec2'] = $fec2;
        $this->load->view('impresion/precios_mal_imp', $data);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function pedido_far()
    {
        $data['titulo'] = "Generar pedido para Farmacia";
        $data['suc'] = $this->catalogos_model->busca_suc();
        $data['q'] = $this->Pedido_model->far_pedido();
        $data['cia'] = 13;
        $this->load->view('main', $data);
    }
    function far_generar_sumit()
    {

        $data = array(
            'fecha' => date('Y-m-d'),
            'id_user' => $this->session->userdata('id'),
            'suc' => $this->input->post('suc'),
            'folio' => 0);
        $this->db->insert('almacen.salidas_ped', $data);

        redirect('pedido/pedido_far');
    }
    function far_pedido_det($id)
    {
        $data['titulo'] = "Generar pedido " . $id;
        $data['id_cc'] = $id;
        $data['codigo'] = $this->catalogos_model->busca_codigo_especialidad();
        $data['q'] = $this->Pedido_model->far_pedido_det($id);
        $data['js'] = 'pedido/com_pedido_det_js';
        $this->load->view('main', $data);
    }
    function far_generar_sumit_det()
    {
        $id_cc = $this->input->post('id_cc');
        $codigo = $this->input->post('codigo');
        $can = $this->input->post('can');
        $receta = $this->input->post('receta');
        $this->Pedido_model->graba_far_pedido_det($id_cc, $codigo, $can,$receta);
        redirect('pedido/far_pedido_det/' . $id_cc);
    }
    function far_pedido_det_b($id_cc, $id)
    {
        $this->db->delete('almacen.salidas_ped_det', array('id' => $id));
        redirect('pedido/far_pedido_det/' . $id_cc);
    }
    function far_pedido_cer($id_cc)
    {
        $this->Pedido_model->far_pedido_det_cer($id_cc);
        redirect('pedido/pedido_far');
    }
    function pedido_far_his()
    {
        $data['titulo'] = "Generar pedido para Farmacia";
        $data['suc'] = $this->catalogos_model->busca_suc();
        $data['q'] = $this->Pedido_model->far_pedido_his();
        $data['cia'] = 13;
        $this->load->view('main', $data);
    }
    function far_pedido_det_his($id)
    {
        $data['titulo'] = "Pedido generado " . $id;
        $data['id_cc'] = $id;
        $data['q'] = $this->Pedido_model->far_pedido_det_his($id);
        $data['js'] = 'pedido/com_pedido_det_js';
        $this->load->view('main', $data);
    }
    function pedido_far_rec()
    {
        $data['titulo'] = "Recetas Capturadas";
        $data['q'] = $this->Pedido_model->far_pedido_rec();
        $data['js'] = 'pedido/com_pedido_det_js';
        $this->load->view('main', $data);
    }
    function pedido_far_rec_una($receta)
    {
        $data['titulo'] = "Recetas Capturadas";
        $data['q'] = $this->Pedido_model->far_pedido_rec_una($receta);
        $data['js'] = 'pedido/com_pedido_det_js';
        $this->load->view('main', $data);
    }
    function far_pedido_imp($id)
    {
        $data['a'] = $this->Pedido_model->far_pedido_det_his($id);
        $data['id'] = $id;
        $this->load->view('impresion/far_pedido', $data);
    }
    function pedido_far_pend()
    {
        $data['titulo'] = "Recetas pendientes";
        $data['q'] = $this->Pedido_model->pedido_far_pend();
        $data['js'] = 'pedido/pedido_compra_js';
        $this->load->view('main', $data);
    }

    function actualiza_detalle_pedido()
    {
        $id = $this->input->post('id');
        $pedido = $this->input->post('pedido');
        echo $this->Pedido_model->actualiza_detalle_pedido($id, $pedido);
    }

    function actualiza_detalle_descuento()
    {
        $id = $this->input->post('id');
        $descuento = $this->input->post('descuento');
        echo $this->Pedido_model->actualiza_detalle_descuento($id, $descuento);
    }

    function actualiza_detalle_regalo()
    {
        $id = $this->input->post('id');
        $regalo = $this->input->post('regalo');
        echo $this->Pedido_model->actualiza_detalle_regalo($id, $regalo);
    }
    function actualiza_detalle_costo()
    {
        $id = $this->input->post('id');
        $costo = $this->input->post('costo');
        echo $this->Pedido_model->actualiza_detalle_costo($id, $costo);
    }
//////////////////////////////////////////////////////////////////////////////Mover a insumos
//////////////////////////////////////////////////////////////////////////////Mover a insumos
//////////////////////////////////////////////////////////////////////////////Mover a insumos
function s_val_pedido_ins()
{
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Pedidos de insumos para validar";
        $data['titulo1'] = "Pedidos que la sucursal no valido o que el supervisor los regreso a sucursal";
        $data['q'] = $this->Pedido_model->val_pedido_ins($id_plaza);
        $data['q1'] = $this->Pedido_model->val_pedido_no_terminados($id_plaza);
        $data['js'] = 'pedido/pedido_compra_js';
        $this->load->view('main', $data);  
}
function s_val_pedido_ins_regreso($id_cc)
{
        $a=array('stat_sup'=>' ');
        $this->db->where('id',$id_cc);
        $this->db->where('tipo',0);
        $this->db->update('papeleria.insumos_c',$a);
        redirect('pedido/s_val_pedido_ins');
}
function s_val_pedido_ins_det($id_cc)
{
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Pedidos de insumos para validar del folio ".$id_cc;
        $data['id_cc'] = $id_cc;
        $data['q'] = $this->Pedido_model->val_pedido_ins_det($id_cc);
        $data['js'] = 'pedido/pedido_compra_js';
        $this->load->view('main', $data);  
}
function s_val_pedido_det_sin_validar($id_cc)
{
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Pedidos de insumos para validar del folio ".$id_cc;
        $data['id_cc'] = $id_cc;
        $data['q'] = $this->Pedido_model->val_pedido_ins_det($id_cc);
        $data['js'] = 'pedido/pedido_compra_js';
        $this->load->view('main', $data);  
}
function s_val_pedido_ins_det_c($id_cc,$id)
{
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Pedidos de insumos para validar del folio ".$id_cc;
        $q = $this->Pedido_model->val_pedido_ins_det_uno($id_cc,$id);
        $r=$q->row();
        $data['descripcion']=$r->descripcion;
        $data['id_cc']=$id_cc;
        $data['id']=$id;
        $data['canp']=$r->canp;
        $data['canp_sup']=$r->canp_sup;
        $this->load->view('main', $data);  
}
function sumit_ins_det_c()
{
        $a=array('canp_sup'=>$this->input->post('can'));
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('papeleria.insumos_d',$a);
        redirect('pedido/s_val_pedido_ins_det/'.$this->input->post('id_cc'));  
}
function sumit_ins_det_cerrar($id_cc)
{
        $this->Pedido_model->inserta_insumos_s($id_cc);
        redirect('pedido/s_val_pedido_ins');  
}
function s_val_pedido_ins_his()
{
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Pedidos de insumos para validar";
        $data['q'] = $this->Pedido_model->val_pedido_ins_his($id_plaza);
        $data['js'] = 'pedido/s_val_pedido_ins_his_js';
        $this->load->view('main', $data);  
}
function s_val_pedido_ins_his_det($id_cc,$fol)
{
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Pedidos de insumos para validar";
        $data['q'] = $this->Pedido_model->val_pedido_ins_his_det($id_plaza,$id_cc,$fol);
        $data['js'] = 'pedido/pedido_compra_js';
        $this->load->view('main', $data);  
}
function s_val_pedido_ins_his_glo()
{
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Pedidos de insumos para validar";
        $data['q'] = $this->Pedido_model->val_pedido_ins_his_glo($id_plaza);
        $data['js'] = 'pedido/s_val_pedido_ins_his_glo_js';
        $this->load->view('main', $data);  
}
//////////////////////////////////////////////////////////////////////////////Mover a insumos
//////////////////////////////////////////////////////////////////////////////Mover a insumos
//////////////////////////////////////////////////////////////////////////////Mover a insumos


/*********************************Pedidos especiales fanasa*************************/


    function c_ped_esp_fanasa(){
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Pedido Especial fanasa ";
        $data['suc'] = $this->Pedido_model->busca_sucursal_feni($id_plaza);
        $data['q'] = $this->Pedido_model->desc_pend_pre_pedido($id_plaza);
        $data['q1'] = $this->Pedido_model->desc_pre_pedido_fen($id_plaza);
        $data['js'] = 'pedido/c_ped_esp_fanasa_js';
        $this->load->view('main', $data);
    }

    function ins_pre_pedido_fenix(){

         $data = array (
        'suc' => $this->input->post('suc'),
        'codigo' => $this->input->post('codigo'),
        'piezas' => $this->input->post('piezas'),
        'activo' => 0
         );
        $code= $this->input->post('codigo');

        $satisfactorio= $this->Pedido_model->ins_pre_pedido($data,$code);
        $id_plaza=$this->session->userdata('id_plaza');

        if($satisfactorio){

               echo 'incorrecto';
       
    }else {
         redirect('pedido/c_ped_esp_fanasa/');
    }

        }

     function aplic_cod_pre_pedido($suc,$cod){

       $this->Pedido_model->upd_pre_pedido($suc,$cod);
       redirect('pedido/c_ped_esp_fanasa/');

        }

    function del_codi_pre_pedido($suc,$cod){

       $this->Pedido_model->del_cod_pre_pedido($suc,$cod);
       redirect('pedido/c_ped_esp_fanasa/');

   }

   function bus_codi_fanasa(){
    $id_plaza=$this->session->userdata('id_plaza');
    $descripcion= $this->input->post('descripcion');
    $data['suc'] = $this->Pedido_model->busca_sucursal_feni($id_plaza);
    $data['q2'] = $this->Pedido_model->bus_cod_fanasa($descripcion);
    $data['js'] = 'pedido/bus_codi_fanasa_js';
    $this->load->view('main',$data);

   }


   function busq_num_ser(){
        $codigo = $this->input->post('ean');
        echo $this->Pedido_model->bus_cod_fanas($codigo);
   }

   function ped_esp_sucur_fen(){

    $data['q'] = $this->Pedido_model->sol_pedido_sup();
    $data['q1'] = $this->Pedido_model->ped_autoriza_compr();
    $this->load->view('main', $data);
   }
  
    function generar_pedido_f(){
    $data['suc'] = $this->Pedido_model->buscar_suc_fen_act();
    $data['js'] = 'pedido/generar_pedido_f_js';
    $data['q'] = $this->Pedido_model->desc_ppedido_f_com();
    $data['q1'] = $this->Pedido_model->pp_act_compras();
    $this->load->view('main', $data);

    }

    function ver_pedido_sup($suc){
    
    $data['js'] = 'pedido/ver_pedido_sup_js';
    $data['q'] = $this->Pedido_model->ver_pedido_suc_f($suc);
    $this->load->view('main', $data);
    }

    function actualiza_ped_c($suc,$cod){
    if($suc<0){
        echo 'no tiene valor suc';
    }else{
      $this->Pedido_model->upd_pre_pedido_c($suc,$cod);
    redirect('pedido/ver_pedido_sup/'.$suc);
    }
    }

    function actualiza_ped_com($suc){
 
    $this->Pedido_model->actualiza_ped_com($suc);
    redirect('pedido/ped_esp_sucur_fen');
    }

    function ver_pedido_a_com($suc){
    $data['q'] = $this->Pedido_model->ver_pedido_a_com($suc);
    $this->load->view('main', $data);
    }

   function ins_prepedido_f_com(){

         $data = array (
        'suc' => $this->input->post('suc'),
        'codigo' => $this->input->post('codigo'),
        'piezas' => $this->input->post('piezas'),
        'activo' => 2
         );
        $code= $this->input->post('codigo');

        $satisfactorio= $this->Pedido_model->ins_pre_pedido($data,$code);
        $id_plaza=$this->session->userdata('id_plaza');

        if($satisfactorio){

               echo 'incorrecto';
       
    }else {
         redirect('pedido/generar_pedido_f/');
    }

        }

  
     function aplic_ppedido_c($suc,$cod){
       $this->Pedido_model->actualiza_pp_com($suc,$cod);
       redirect('pedido/generar_pedido_f');

        }


    function upd_ppedido_c($suc,$cod){
        $this->Pedido_model->upd_pre_pedido_c($suc,$cod);
        redirect('pedido/generar_pedido_f');

    }








}