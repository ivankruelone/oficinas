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
    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    function orden_compra()
    {
        $data['titulo'] = "Ordenes  de compra";
        $data['a'] = $this->orden_model->orden_compra();
        $data['js'] = 'orden/orden_compra_js';
        $this->load->view('main', $data);
    }
    function orden_compra_detalle($prv, $id_ped)
    {
        $prvx = $this->catalogos_model->busca_prv_uno($prv);
        $data['titulo'] = "Ordenes  de compra para $prvx";
        $data['a'] = $this->orden_model->orden_compra_detalle($prv, $id_ped);
        $data['js'] = 'orden/orden_compra_detalle_js';
        $this->load->view('main', $data);
    }
    function cambia()
    {
        $this->orden_model->cambia($this->input->post('ca'), $this->input->post('prv'),
            $this->input->post('id_ped'), $this->input->post('sec'), $this->input->post('clagob'));
        redirect('orden/orden_compra_detalle/' . $this->input->post('prv') . '/' . $this->
            input->post('id_ped'));
    }

    function cerrar($prv, $id_ped)
    {
        $this->orden_model->cerrar($this->input->post('prv'), $this->input->post('id_ped'),
            $this->input->post('cia'), 'cxp');
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

        $query = $this->catalogos_model->firma();
        $row = $query->row();
        $imagen = $row->imagen;
        $nombre = $row->nombre;
        $data['cabeza'] = $this->orden_model->imprime_cabeza($folprv);
        $data['a'] = $this->orden_model->imprime($folprv, $imagen, $nombre);
        //$data['js'] = 'orden/imprime_js';
        $this->load->view('impresion/orden_imprime', $data);
    }

    ////////////////////////////////////////////////////////////////////////////cambia order de compra cerrada
    function s_orden_mes()
    {

        $data['titulo'] = "Historico de orden de compra";
        $data['a'] = $this->orden_model->order_mes();
        $data['js'] = 'orden/s_orden_cambia_js';
        $this->load->view('main', $data);
    }
    function s_orden_cambia($aaa, $mes)
    {

        $data['titulo'] = "Historico de orden de compra del mes de " . $mes . " del " .
            $aaa;
        $data['a'] = $this->orden_model->order_cambia($aaa, $mes);
        $data['js'] = 'orden/s_orden_cambia_js';
        $this->load->view('main', $data);
    }
    function s_orden_cambia_ctl($id_orden)
    {


        $a = $this->orden_model->order_ctl($id_orden);
        $r = $a->row();
        $data['titulo'] = "Historico de orden de compra del mes de " . $r->mes . " del " .
            $r->aaa;
        $data['titulo1'] = "Folio " . $r->folprv;
        $data['folprv'] = $r->folprv;
        $data['consigna'] =$this->catalogos_model->busca_consigna($r->consigna);
        $data['edo'] = $r->edo;
        $data['id_orden'] = $id_orden;
        $data['base'] = $r->base;
        $data['fecha'] = $r->fecha_envio;
        $data['base'] = $r->base;
        $data['licitacion'] = $this->catalogos_model->busca_licita($r->licitacion);
        $data['aaa'] = $r->aaa;
        $data['mes'] = $r->mes;
        $data['prv'] = $this->catalogos_model->busca_prv_indicado($r->prv, $r->prvx);
        $data['id_estado'] = $this->catalogos_model->busca_almacen_licitado($r->
            id_estado, $r->estado);
        $data['cia'] = $this->catalogos_model->busca_cia_filtro($r->cia, $r->ciax);
        $data['js'] = 'orden/historico_detalle_js';
        $this->load->view('main', $data);
    }
    function sumit_cambia_orden_ctl()
    {
        $a = $this->orden_model->update_orden_cambia_ctl($this->input->post('id_orden'),
            $this->input->post('prv'), $this->input->post('cia'), $this->input->post('id_estado'),
            $this->input->post('fecha'), $this->input->post('folprv'), $this->input->post('edo'),
            $this->input->post('base'), $this->input->post('licitacion'), $this->input->post('consigna'));
        redirect('orden/s_orden_cambia/' . substr($this->input->post('fecha'), 0, 4) .
            '/' . substr($this->input->post('fecha'), 5, 2));
    }
    function s_orden_cambia_det($id_orden)
    {

        $data['titulo'] = "Historico de orden de compra";
        $data['q'] = $this->orden_model->orden_det($id_orden);
        $data['js'] = 'orden/s_orden_cambia_det_js';
        $this->load->view('main', $data);
    }

    function s_orden_cambia_det_id($id_orden, $id_detalle)
    {

        $data['titulo'] = "Historico de orden de compra";
        $a = $this->orden_model->orden_det_id($id_detalle);
        $r = $a->row();

        $data['id_orden'] = $id_orden;
        $data['id_detalle'] = $id_detalle;
        $data['folprv'] = $r->folprv;
        $data['id_estado'] = $r->id_estado;
        $data['edo'] = $r->edo;
        $data['canp'] = $r->canp;
        $data['descu'] = $r->descuento;
        $data['costo'] = $r->costo;
        $data['base'] = $r->base;
        $data['prv'] = $r->prv;
        $data['codigo'] = $r->codigo;
        $data['id_responsable'] = $r->id_responsable;
        $data['fecha_envio'] = $r->fecha_envio;
       
        if ($r->base == 1) {
            
            if ($r->edo == 'alm' and $r->id_responsable==0 or $r->edo == 'met' and $r->id_responsable==0) {
                
                $data['sec'] = $this->catalogos_model->busca_sec_filtro($r->sec, $r->susa2,$r->prv);
                $data['clagob'] = ' ';
            } else{
                $data['clagob'] = $this->catalogos_model->busca_clagob_filtro($r->clagob, $r->
                    susa2);
                $data['sec'] = 0;
            }
        }elseif($r->base == 2 and  ($r->edo == 'alm' || $r->edo == 'met' )) {
            $data['sec'] = $this->catalogos_model->busca_sec_filtro($r->sec, $r->susa2, $r->prv);
            $data['clagob'] = ' ';
        }elseif($r->base == 3) {
            $data['clagob'] = $this->catalogos_model->busca_clagob_filtro($r->clagob, $r->
                susa2, $r->prv);
            $data['sec'] = 0;
        }elseif($r->base == 4){
            $data['clagob'] = $this->catalogos_model->busca_clagob_filtro_gral($r->clagob, $r->
                susa2, $r->prv,$r->codigo);
            $data['sec'] = 0;
        }
        $data['js'] = 'orden/s_orden_cambia_det_js';
        $this->load->view('main', $data);
    }
    
    function s_orden_cambia_det_id2($id_orden, $id_detalle)
    {
        $data['titulo'] = "Historico de orden de compra";
        $a = $this->orden_model->orden_det_id($id_detalle);
        $r = $a->row();
        
        $data['id_orden'] = $id_orden;
        $data['id_detalle'] = $id_detalle;
        $data['folprv'] = $r->folprv;
        $data['id_estado'] = $r->id_estado;
        $data['edo'] = $r->edo;
        $data['canp'] = $r->canp;
        $data['descu'] = $r->descuento;
        $data['costo'] = $r->costo;
        $data['susa1'] = $r->susa1;
        $data['susa2'] = $r->susa2;
        $data['sec'] = $r->sec;
        $data['codigo'] = $r->codigo;
        $data['clagob'] = $r->clagob;
        $data['base'] = $r->base;
        $data['id_responsable'] = $r->id_responsable;
        $data['id_compraped'] = $r->id_compraped;
        $data['js'] = 'orden/s_orden_cambia_det_js';
        $this->load->view('main', $data);
    }
    
    function sumit_cambia_orden_det2()
    {
        
        $cantidad = $this->input->post('canp');
        $costo = $this->input->post('costo');
        $descu = $this->input->post('descu');
        $id_detalle = $this->input->post('id_detalle');
        $id_base = $this->input->post('base');
        $id_compraped = $this->input->post('id_compraped');
        $id_pedido_d= $this->orden_model->busca_id_pedido_d($id_detalle);
        $arr = array(
            'costo' => $costo,
            'canp'  => $cantidad,
            'cans'  => $cantidad,
            'descuento' => $descu
        );
        $arr2 = array(
            'costo' => $costo,
            'canp'  => $cantidad,
            'cans'  => $cantidad,
            'canm'  => $cantidad,
            'porcen' => $descu
        );
        $arr3 = array(
            'costo' => $costo,
            'ped'  => $cantidad,
            'descu' => $descu
        );
        
        
        $this->orden_model->actualizaDataOrden_d($arr, $id_detalle,$id_base,$id_compraped,$arr2,$arr3,$id_pedido_d);
        redirect('orden/s_orden_cambia_det/' . $this->input->post('id_orden'));
    }
    
    
    function sumit_cambia_orden_det()
    {
        
        if ($this->input->post('sec') == null) {
            
            $sec = 0;
            $dato = $this->input->post('clagob');
            $var = explode('|', $dato);
            
            
            if(isset($var[0]))
            {
                $clagob = $var[0];
            }else{
                $clagob = $dato;
            }
            
            if(isset($var[1]))
            {
                $codigo = $var[1];
            }else{
                $codigo = 0;
            }
            
            
        } else {
            $dato = $this->input->post('sec');
            $var = explode('|', $dato);
            $clagob = '';
            
            if(isset($var[0]))
            {
                $sec = $var[0];
            }else{
                $sec = $dato;
            }
            
            if(isset($var[1]))
            {
                $codigo = $var[1];
            }else{
                $codigo = 0;
            }
        }
       
        $this->orden_model->update_order_cambia_det($this->input->post('id_orden'), $this->
            input->post('id_estado'), $this->input->post('folprv'), $this->input->post('edo'),
            $this->input->post('id_detalle'), $sec, $clagob, $this->
            input->post('canp'), $this->input->post('costo'), $this->input->post('descu'), $this->
            input->post('base'), $codigo,$this->input->post('id_responsable'));
        redirect('orden/s_orden_cambia_det/' . $this->input->post('id_orden'));
    }
    
    function getAlmacenBySecCodigo($sec, $codigo)
    {
        $this->db->where('sec', $sec);
        $this->db->where('codigo', $codigo);
        $query = $this->db->get('catalogo.almacen');
        
        return $query;
    }
    
    function sumit_agrega_orden_det()
    {
        if ($this->input->post('sec') == null) {
            $sec = 0;
        } else {
            $dato = $this->input->post('sec');
            $var = explode('|', $dato);
            if(isset($var[0]))
            {
                $sec = $var[0];
            }else{
                $sec = $dato;
            }
            
            if(isset($var[1]))
            {
                $codigo = $var[1];
            }else{
                $codigo = 0;
            }
        }
        
        if($this->input->post('clagob') == null)
        {
            $clagob = 0;
        }else{
            $dato1 = $this->input->post('clagob');
            $var1 = explode('|', $dato1);
            if(isset($var1[0]))
            {
                $clagob = $var1[0];
            }else{
                $clagob = $dato1;
            }
            
            if(isset($var1[1]))
            {
                $codigo = $var1[1];
            }else{
                $codigo = 0;
            }
        }
    
        $this->orden_model->insert_order_det($this->input->post('id_orden'), $this->
            input->post('id_estado'), $this->input->post('folprv'), $this->input->post('edo'),
            $sec, $clagob, $this->input->post('canp'), $this->input->
            post('costo'), $this->input->post('descu'), $this->input->post('base'), $this->
            input->post('prv'), $this->input->post('fecha_envio'), $codigo);
        redirect('orden/s_orden_cambia_det/' . $this->input->post('id_orden'));
    }

    function com_orden_imp($id,$estatus)
    {
        $data['a'] = $this->orden_model->com_orden_det_his($id);
        $data['id'] = $id;
        $data['estatus'] = $estatus;
        //$data['js'] = 'orden/imprime_js';
        $this->load->view('impresion/com_orden_C', $data);
    }
    function actualiza_orden_d_canp()
    {
        $id = $this->input->post('id');
        $canp = $this->input->post('canp');

        echo $this->orden_model->update_orden_can($id, $canp);
    }


    ///////////////////////////////////////////////////////////////////////////////lo nuevo de ordenes para trabajar
    function s_pre_orden()
    {
        $data['titulo'] = "PRE ORDEN PARA MODIFICACIONES";
        $data['q'] = $this->orden_model->pre_orden();
        $data['js'] = 'orden/s_pre_orden_js';
        $this->load->view('main', $data);
    }

    function s_pre_orden_modi($id_pre_orden)
    {
        $data['titulo'] = "PRE ORDEN PARA MODIFICACIONES";
        $data['q'] = $this->orden_model->pre_orden_modi($id_pre_orden);
        $data['js'] = 'orden/s_pre_orden_modi_js';
        $this->load->view('main', $data);
    }

    function s_pre_orden_borrar($id_pre_orden)
    {
        $this->orden_model->pre_orden_borrar_ceros($id_pre_orden);
        redirect('orden/s_pre_orden');
    }

    function s_pre_orden_modi_sec($id_pre_orden, $id)
    {
        $data['titulo'] = "PRE ORDEN PARA MODIFICACIONES";

        $q = $this->orden_model->busca_sec_preorden($id);
        $r = $q->row();
        $data['sec'] = $r->sec;
        $data['susa'] = $r->susa;
        $data['prv'] = $this->catalogos_model->busca_prv_indicado_cedis($r->prv, $r->
            sec);
        $data['corto'] = $r->corto;
        $data['compra'] = $r->compra;
        $data['costo'] = $r->costo;
        $data['descu'] = $r->descu;
        $data['id_pre_orden'] = $id_pre_orden;
        $data['id'] = $id;
        $fec = date('Y') . '-' . str_pad($this->input->post('mes'), 2, '0', STR_PAD_LEFT);
        $this->load->view('main', $data);
    }

    function sumit_cambia_pre_orden()
    {
        $id_pre_orden = $this->input->post('id_pre_orden');
        $id = $this->input->post('id');
        $prv = $this->input->post('prv');
        $sec = $this->input->post('sec');
        $costo = $this->catalogos_model->busca_prv_indicado_cedis_costo($prv, $sec);

        $a = array(
            'prv' => $this->input->post('prv'),
            'compra' => $this->input->post('compra'),
            'costo' => $costo,
            'descu' => $this->input->post('descu'),
            'fecha_cambio' => date('Y-m-d H:i:s'));
        $this->db->where('id', $id);
        $this->db->where('folprv', '0');
        $this->db->update('compras.orden_a', $a);
        redirect('orden/s_pre_orden_modi/' . $id_pre_orden);

    }
    function s_pre_orden_cerrar($id_pre_orden)
    {
        $data['titulo'] = "PRE ORDEN PARA CERRAR";
        $data['q'] = $this->orden_model->pre_orden_cerrar($id_pre_orden);
        //$data['js'] = 'compra/s_pago_mayoristas_prv_ven_js';
        $this->load->view('main', $data);
    }

    function s_pre_orden_cerrar_par($id_pre_orden, $prv)
    {
        $data['titulo'] = "PRE ORDEN PARA CERRAR";
        $q = $this->orden_model->busca_otro_prv_preorden($id_pre_orden, $prv);
        $r = $q->row();
        $data['id_pre_orden'] = $id_pre_orden;
        $data['prv'] = $prv;
        $data['corto'] = $r->corto;
        $data['total'] = $r->importe - $r->descu + $r->iva;
        $data['cia'] = $this->catalogos_model->busca_cia_filtro_pre();
        $data['q'] = $this->orden_model->pre_orden_cerrar_detalle($id_pre_orden, $prv);
        $this->load->view('main', $data);

    }
    function sumit_preorden_prv()
    {
        $this->orden_model->write_preorden($this->input->post('id_pre_orden'), $this->
            input->post('prv'), $this->input->post('cia'));
        redirect('s_pre_orden_cerrar/' . $this->input->post('id_pre_orden'));
    }

    //////////
    function s_orden_historico()
    {
        $data['titulo'] = "PRE ORDEN PARA CERRAR";
        $data['q'] = $this->orden_model->orden_historico();
        $data['js'] = 'orden/s_orden_historico_js';
        $this->load->view('main', $data);
    }
    function borrar_orden_cerrada($id_orden,$folprv)
    {
        $a=array('estatus' => 0,'fecha_desactivado' => date('Y-m-d H:i:s'));
        $this->db->where('id_orden',$id_orden);
        $this->db->update('compras.orden_c',$a);
        redirect('orden/s_orden_historico');
    }

    function s_busca_orden()
    {
        $data['titulo'] = "Busca orden en seguimiento de almacen";
        $this->load->view('main', $data);
    }
    function s_busca_orden_resultado()
    {
        $orden = $this->input->post('orden');
        $corto = $this->orden_model->busca_orden_prv($orden);
        $data['q'] = $this->orden_model->busca_orden_almacen($orden);
        $data['q1'] = $this->orden_model->busca_orden_almacen_sin($orden);
        $data['titulo'] = "Busca orden en seguimiento de almacen folio " . $orden .
            ' del proveedor ' . $corto;
        $data['titulo1'] = "Busca orden en seguimiento de almacen folio " . $orden .
            ' del proveedor ' . $corto . " NO RECIBIDOS";
        $data['js'] = 'orden/s_busca_orden_resultado_js';
        $this->load->view('main', $data);
    }
    function s_busca_producto_orden()
    {
        $data['titulo'] = "Busca producto en ordenes de compra";
        $this->load->view('main', $data);
    }
    function s_busca_pro_orden_resultado()
    {
        $sec = $this->input->post('sec');
        $data['q'] = $this->orden_model->busca_sec_orden_almacen($sec);
        $data['titulo'] = "";
        $data['js'] = 'orden/s_busca_pro_orden_resultado_js';
        $this->load->view('main', $data);
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////ORDEN ESPECIAL
//////////////////////////////////////////////////////////////////////////////////////////////ORDEN por codigo y clavegob
    function busca_producto_segpop()
    {
        $cla=$this->Catalogos->model->busca_clave_secuencia();
    }
    function s_orden_especial()
    {
        $nivel=$this->session->userdata('nivel');
        $data['titulo'] = "Generar orden de compra especial";
        $data['alm'] = $this->catalogos_model->busca_almacen_id();
        $data['prv'] = $this->catalogos_model->busca_prv();
        $data['lic'] = $this->catalogos_model->busca_licitacion();
        $data['q'] = $this->orden_model->orden_captura_especial();
        $data['cia'] = $this->catalogos_model->busca_cia_filtro_pre();
        $this->load->view('main', $data);   
    }
    function com_generar_sumit()
    {
            $id_responsable = $this->session->userdata('responsable');
            $embarca = $this->catalogos_model->busca_licitacion_una($this->input->post('lic'));
            $recibe = $this->catalogos_model->busca_alma_uno($this->input->post('alm'));
        if ($this->input->post('pass') == 'unico') {
            $por = $this->catalogos_model->busca_almacen_por($this->input->post('alm'));
            
            if ($this->input->post('prv') > 0) {
                $data = array(
                    'fecha_captura' => date('Y-m-d H:i:s'),
                    'id_captura' => $this->session->userdata('id'),
                    'id_estado' => $this->input->post('alm'),
                    'prv' => $this->input->post('prv'),
                    'licita' => $this->input->post('lic'),
                    'cia' => $this->input->post('cia'),
                    'id_responsable'=>$id_responsable,
                    'embarca'=>$embarca,
                    'recibe'=>$recibe,
                    'fecha_envio' => '0000-00-00',
                    'fecha_limite' => '0000-00-00',
                    'base'=>2,
                    'tipo'=> 0);
                $this->db->insert('compras.orden_c', $data);
                
            } 
        }
        redirect('orden/s_orden_especial');
    }
    function s_orden_especial_det($id_orden,$prv)
    {
        $nivel=$this->session->userdata('nivel');
        $data['titulo'] = "Generar orden de compra especial";
        $data['id_orden'] = $id_orden;
        $data['prv'] = $prv;
        $data['q'] = $this->orden_model->orden_captura_especial_det($id_orden);
        $data['js'] =  'orden/s_orden_especial_det_js';
        $this->load->view('main', $data);   
    }
    function s_orden_especial_det_agrega()
	{
	$this->orden_model->sumit_detalle_pat(
    $this->input->post('cod'),
    $this->input->post('can'),
    $this->input->post('des'),
    $this->input->post('cos'),
    $this->input->post('id_orden'),
    $this->input->post('prv'));
    redirect('orden/s_orden_especial_det/'.$this->input->post('id_orden').'/'.$this->input->post('prv'));
    }
    function s_orden_especial_det_agrega_fac()
    {
     $prv = $this->input->post('prv');
     $id_orden = $this->input->post('id_orden');
     $this->orden_model->sumit_detalle_pat_fac($this->input->post('fac'),$id_orden);
     redirect('orden/s_orden_especial_det/'.$id_orden.'/'.$prv);
    }
    
    
    function orden_especial_det_bor($id_orden,$prv,$id_detalle)
	{
	$this->db->delete('compras.orden_d', array('id_detalle' => $id_detalle));
    redirect('orden/s_orden_especial_det/'.$id_orden.'/'.$prv);
    }
    function cerrar_especial($id_orden,$prv,$cia)
    {
        $this->orden_model->cerrar_especial_f($id_orden,$cia,'osi');
        redirect('orden/s_orden_especial');
    }
    
    function s_orden_especial_his()
    {
        $nivel=$this->session->userdata('nivel');
        
        $data['q'] = $this->orden_model->orden_captura_especial_his();
        $this->load->view('main', $data);   
    }
    
 //////////////////////////////////////////////////////////////////////////////////////////////ORDEN ESPECIAL por sec
 function s_orden_especial_sec()
    {
        $nivel=$this->session->userdata('nivel');
        $data['titulo'] = "Generar orden de compra especial";
        $data['alm'] = $this->catalogos_model->busca_almacen_id();
        $data['prv'] = $this->catalogos_model->busca_prv();
        $data['lic'] = $this->catalogos_model->busca_licitacion();
        $data['q'] = $this->orden_model->orden_captura_especial();
        $data['cia'] = 13;
        $this->load->view('main', $data);   
    }
 function com_generar_sumit_sec()
    {
            $id_responsable = $this->session->userdata('responsable');
            $embarca = $this->catalogos_model->busca_licitacion_una($this->input->post('lic'));
            $recibe = $this->catalogos_model->busca_alma_uno($this->input->post('alm'));
        if ($this->input->post('pass') == 'lamisma') {
            $por = $this->catalogos_model->busca_almacen_por($this->input->post('alm'));
            
            if ($this->input->post('prv') > 0) {
                $data = array(
                    'fecha_captura' => date('Y-m-d H:i:s'),
                    'id_captura' => $this->session->userdata('id'),
                    'id_estado' => $this->input->post('alm'),
                    'prv' => $this->input->post('prv'),
                    'licita' => $this->input->post('lic'),
                    'cia' => $this->input->post('cia'),
                    'id_responsable'=>$id_responsable,
                    'embarca'=>$embarca,
                    'recibe'=>$recibe,
                    'fecha_envio' => '0000-00-00',
                    'fecha_limite' => '0000-00-00',
                    'base'=>2,
                    'tipo'=> 0);
                $this->db->insert('compras.orden_c', $data);
                
            } 
        }
        redirect('orden/s_orden_especial_sec');
    }
 function s_orden_especial_det_sec($id_orden,$prv)
    {
        $nivel=$this->session->userdata('nivel');
        $data['titulo'] = "Generar orden de compra especial";
        $data['id_orden'] = $id_orden;
        $data['prv'] = $prv;
        $data['q'] = $this->orden_model->orden_captura_especial_det($id_orden);
        $this->load->view('main', $data);   
    }
    function s_orden_especial_det_agrega_sec()
	{
	$this->orden_model->sumit_detalle_sec(
    $this->input->post('sec'),
    $this->input->post('can'),
    $this->input->post('canr'),
    $this->input->post('des'),
    $this->input->post('id_orden'),
    $this->input->post('prv'));
    redirect('orden/s_orden_especial_det_sec/'.$this->input->post('id_orden').'/'.$this->input->post('prv'));
    }
    function orden_especial_det_bor_sec($id_orden,$prv,$id_detalle)
	{
	$this->db->delete('compras.orden_d', array('id_detalle' => $id_detalle));
    redirect('orden/s_orden_especial_det_sec/'.$id_orden.'/'.$prv);
    }
    function s_orden_his_global()
    {
        $data['titulo'] = "Ordenes de compra Global en usuarios de Oficinas";
        $data['q'] = $this->orden_model->orden_captura_his_global();
        $this->load->view('main', $data);   
    }
    function s_orden_his_global_det($aaa,$mes)
    {
        $data['q'] = $this->orden_model->orden_captura_his_global_mes($aaa,$mes);
        $data['js'] = 'orden/s_orden_his_global_det_js';
        $this->load->view('main', $data);   
    }    
//////////////////////////////////////////////////////////////////////////////////////////////ORDEN ESPECIAL
//////////////////////////////////////////////////////////////////////////////////////////////ORDEN SEGURO POPULAR NUEVO PROGRAMA
//////////////////////////////////////////////////////////////////////////////////////////////ORDEN SEGURO POPULAR NUEVO PROGRAMA
   function a_orden_segpop()
    {
        $nivel=$this->session->userdata('nivel');
        $data['titulo'] = "Generar orden de compra especial";
        $data['alm'] = $this->catalogos_model->busca_almacen_id();
        $data['prv'] = $this->catalogos_model->busca_prv();
        $data['lic'] = $this->catalogos_model->busca_licitacion();
        $data['q'] = $this->orden_model->orden_captura_especial();
        $data['cia'] = $this->catalogos_model->busca_cia_filtro_pre();
        $this->load->view('main', $data);   
    }
    function a_com_generar_sumit()
    {
        $id_responsable = $this->session->userdata('responsable');
        if ($this->input->post('pass') == 'unico_seg') {
            $base=3;
            $por = $this->catalogos_model->busca_almacen_por($this->input->post('alm'));
            $embarca = $this->catalogos_model->busca_licitacion_una($this->input->post('lic'));
            $recibe = $this->catalogos_model->busca_alma_uno($this->input->post('alm'));
            if ($this->input->post('prv') > 0) {
                $data = array(
                    'fecha_captura' => date('Y-m-d H:i:s'),
                    'id_captura' => $this->session->userdata('id'),
                    'id_estado' => $this->input->post('alm'),
                    'prv' => $this->input->post('prv'),
                    'licita' => $this->input->post('lic'),
                    'cia' => $this->input->post('cia'),
                    'id_responsable'=>$id_responsable,
                    'embarca'=>$embarca,
                    'recibe'=>$recibe,
                    'fecha_envio' => '0000-00-00',
                    'fecha_limite' => '0000-00-00',
                    'base'=>$base,
                    'tipo'=> 0);
                $this->db->insert('compras.orden_c', $data);
                
            } 
        }
        redirect('orden/a_orden_segpop');
    }
    
    
    function a_mostrar()
    {
        $id_orden = $this->input->post('id_orden');
        $data['q'] = $this->orden_model->orden_captura_especial_det($id_orden);
        $this->load->view('orden/a_mostrar', $data);
    }
    function a_orden_segpop_det($id_orden,$prv)
    {
        
        $nivel=$this->session->userdata('nivel');
        $data['titulo'] = "Generar orden de compra especial";
        $data['id_orden'] = $id_orden;
        $data['prv'] = $prv;
        $data['q'] = $this->orden_model->orden_captura_especial_det($id_orden);
        $data['js'] = 'orden/a_orden_segpop_det_js';
        $this->load->view('main', $data);   
    }
    function a_orden_segpop_det_agrega()
	{
	$id_orden=$this->input->post('id_orden');
    $prv=$this->input->post('prv');
    $id_cat=$this->input->post('id_cat');
    $can=$this->input->post('can');
    $canr=$this->input->post('canr');
    $des=$this->input->post('des');
    echo $this->orden_model->sumit_segpop_det($id_orden,$prv,$id_cat,$can,$canr,$des);
    }
    
    
    function a_orden_segpop_det_bor($id_orden,$prv,$id_detalle)
	{
	$this->db->delete('compras.orden_d', array('id_detalle' => $id_detalle));
    redirect('orden/a_orden_segpop_det/'.$id_orden.'/'.$prv);
    }
    function a_cerrar_segpop($id_orden,$prv,$cia)
    {
        $this->orden_model->cerrar_especial_f($id_orden,$cia,'osi');
        redirect('orden/a_orden_segpop');
    }
    
    
    function a_busco_clave_segpop()
    {
        $cla=$this->input->post('cla');
        $prv=$this->input->post('prv');
        echo $this->catalogos_model->busca_bloq_cla($cla,$prv);
    }
    
    function a_busco_id_cat()
    {
        $id_cat = $this->input->post('id_cat');
        $id_orden = $this->input->post('id_orden');
        echo $this->catalogos_model->busca_id_cat($id_cat,$id_orden);
    }
     
//////////////////////////////////////////////////////////////////////////////////////////////ORDEN SEGURO POPULAR NUEVO PROGRAMA
//////////////////////////////////////////////////////////////////////////////////////////////ORDEN SEGURO POPULAR NUEVO PROGRAMA
 function a_orden_segpop_esp()
    {
        $nivel=$this->session->userdata('nivel');
        $data['titulo'] = "Generar orden de compra especial";
        $data['alm'] = $this->catalogos_model->busca_almacen_id();
        $data['prv'] = $this->catalogos_model->busca_prv();
        $data['lic'] = $this->catalogos_model->busca_licitacion();
        $data['q'] = $this->orden_model->orden_captura_especial();
        $data['cia'] = $this->catalogos_model->busca_cia_filtro_pre();
        $this->load->view('main', $data);   
    }
    function a_com_generar_sumit_esp()
    {
        $id_responsable = $this->session->userdata('responsable');
        if ($this->input->post('pass') == 'unico_esp') {
            $base=4;
            $por = $this->catalogos_model->busca_almacen_por($this->input->post('alm'));
            $embarca = $this->catalogos_model->busca_licitacion_una($this->input->post('lic'));
            $recibe = $this->catalogos_model->busca_alma_uno($this->input->post('alm'));
            if ($this->input->post('prv') > 0) {
                $data = array(
                    'fecha_captura' => date('Y-m-d H:i:s'),
                    'id_captura' => $this->session->userdata('id'),
                    'id_estado' => $this->input->post('alm'),
                    'prv' => $this->input->post('prv'),
                    'licita' => $this->input->post('lic'),
                    'cia' => $this->input->post('cia'),
                    'id_responsable'=>$id_responsable,
                    'embarca'=>$embarca,
                    'recibe'=>$recibe,
                    'fecha_envio' => '0000-00-00',
                    'fecha_limite' => '0000-00-00',
                    'base'=>$base,
                    'tipo'=> 0);
                $this->db->insert('compras.orden_c', $data);
                
            } 
        }
        redirect('orden/a_orden_segpop_esp');
    }
    
    
    function a_mostrar_esp()
    {
        $id_orden = $this->input->post('id_orden');
        $data['q'] = $this->orden_model->orden_captura_especial_det($id_orden);
        $this->load->view('orden/a_mostrar_esp', $data);
    }
    function a_orden_segpop_det_esp($id_orden,$prv)
    {
        
        $nivel=$this->session->userdata('nivel');
        $data['titulo'] = "Generar orden de compra especial";
        $data['id_orden'] = $id_orden;
        $data['prv'] = $prv;
        $data['q'] = $this->orden_model->orden_captura_especial_det($id_orden);
        $data['js'] = 'orden/a_orden_segpop_det_esp_js';
        $this->load->view('main', $data);   
    }
    function a_orden_segpop_det_agrega_esp()
	{
	$id_orden=$this->input->post('id_orden');
    $prv=$this->input->post('prv');
    $id_cat=$this->input->post('id_cat');
    $can=$this->input->post('can');
    $canr=$this->input->post('canr');
    $des=$this->input->post('des');
    //$id_orden=4717;$prv=190;$id_cat=14766418;$can=1;$canr=1;$des=0;
    echo $this->orden_model->sumit_segpop_det_esp($id_orden,$prv,$id_cat,$can,$canr,$des);
    }
    
    
    function a_orden_segpop_det_bor_esp($id_orden,$prv,$id_detalle)
	{
	$this->db->delete('compras.orden_d', array('id_detalle' => $id_detalle));
    redirect('orden/a_orden_segpop_det_esp/'.$id_orden.'/'.$prv);
    }
    function a_cerrar_segpop_esp($id_orden,$prv,$cia)
    {
        $this->orden_model->cerrar_especial_f($id_orden,$cia,'osi');
        redirect('orden/a_orden_segpop_esp');
    }
    
    function a_orden_segpop_his_esp()
    {
        $nivel=$this->session->userdata('nivel');
        
        $data['q'] = $this->orden_model->orden_segpop_his_esp();
        $data['js'] = 'orden/a_orden_segpop_his_esp_js';
        $this->load->view('main', $data);   
    }
    function borrar_orden_segpop_cerrada($id_orden)
    {
        $a=array('estatus' => 0,'fecha_desactivado' => date('Y-m-d H:i:s'));
        $this->db->where('id_orden',$id_orden);
        $this->db->update('compras.orden_c',$a);
        redirect('orden/a_orden_segpop_his_esp');
    }
    function a_orden_segpop_his_global()
    {
        $nivel=$this->session->userdata('nivel');
        $data['titulo']='ORDEN DE COMPRAS ACTIVAS';
        $data['q'] = $this->orden_model->orden_segpop_his_global();
        $data['js'] = 'orden/a_orden_segpop_his_esp_js';
        $this->load->view('main', $data);   
    }
    function a_orden_segpop_nivel_s_prv()
    {
        $nivel=$this->session->userdata('nivel');
        $data['titulo']='ORDEN DE COMPRAS ACTIVAS';
        $data['q'] = $this->orden_model->nivel_surtido_prv();
        $data['js'] = 'orden/a_orden_segpop_nivel_s_prv_js';
        $this->load->view('main', $data);   
    }
    function a_orden_segpop_nivel_s_prv_det($prv)
    {
        $nivel=$this->session->userdata('nivel');
        $prvx=$this->catalogos_model->busca_prv_uno($prv);
        $data['titulo']='ORDEN DE COMPRAS ACTIVAS DEL PROVEDOR '.$prvx;
        $data['q'] = $this->orden_model->nivel_surtido_prv_det($prv);
        $data['js'] = 'orden/a_orden_segpop_nivel_s_prv_det_js';
        $this->load->view('main', $data);   
    }
    function a_orden_segpop_nivel_prv_rango()
    {
         $data['fec1']=date('Y-m-d');
         $data['fec2']=date('Y-m-d');
         $nivel=$this->session->userdata('nivel');
         $data['titulo']='ORDEN DE COMPRAS POR RANGO';
         $data['js'] = 'orden/a_orden_segpop_nivel_prv_rango_js';
         $this->load->view('main', $data);   
    }
    function a_orden_segpop_nivel_s_prv_rango()
    {
        $fec1=$this->input->post('fec1');
        $fec2=$this->input->post('fec2');
        $data['fec1'] =$fec1;
        $data['fec2'] =$fec2;
        $nivel=$this->session->userdata('nivel');
        $data['titulo']='ORDEN DE COMPRAS ACTIVAS DEL '.$fec1.' AL '.$fec2;
        $data['q'] = $this->orden_model->nivel_surtido_prv_rango($fec1,$fec2);
        $data['js'] = 'orden/a_orden_segpop_nivel_s_prv_js';
        $this->load->view('main', $data);   
    }
    function a_orden_segpop_nivel_s_prv_det_rango($prv,$fec1,$fec2)
    {
        $nivel=$this->session->userdata('nivel');
        $prvx=$this->catalogos_model->busca_prv_uno($prv);
        $data['titulo']='ORDEN DE COMPRAS ACTIVAS DEL PROVEDOR '.$prvx.' DEL '.$fec1.' AL '.$fec2;
        $data['q'] = $this->orden_model->nivel_surtido_prv_det_rango($prv,$fec1,$fec2);
        $data['js'] = 'orden/a_orden_segpop_nivel_s_prv_det_js';
        $this->load->view('main', $data);   
    }
    function a_busco_clave_segpop_esp()
    {
        $cla=$this->input->post('cla');
        $prv=$this->input->post('prv');
        echo $this->catalogos_model->busca_bloq_cla_esp($cla,$prv);
    }
    
    function a_busco_id_cat_esp()
    {
        $id_cat = $this->input->post('id_cat');
        $id_orden = $this->input->post('id_orden');
        echo $this->catalogos_model->busca_id_cat_especialidad($id_cat,$id_orden);
    }




}
