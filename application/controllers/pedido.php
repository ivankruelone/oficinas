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
        $data['q'] = $this->Pedido_model->com_pedido();
        $data['cia'] = 13;
        $this->load->view('main', $data);
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
                    'cia' => $cia);
                $this->db->insert('compras.pedido_c', $data);
            } else {
                if ($por == 'sec') {
                    $this->Pedido_model->agrega_pedido_det_prv_sec($this->input->post('alm'), $this->
                        input->post('prv'), $cia);
                } else {
                    $this->Pedido_model->agrega_pedido_det_prv_cla($this->input->post('alm'), $this->
                        input->post('prv'), $cia);
                }

            }
        }
        redirect('pedido/com_pedido');
    }
    function com_pedido_det($id)
    {
        $alma = $this->catalogos_model->busca_almacen_ped($id);
        $data['titulo'] = "Generar pedido " . $alma;
        $data['id_cc'] = $id;
        $data['q'] = $this->Pedido_model->com_pedido_det($id);
        $data['js'] = 'pedido/com_pedido_det_js';
        $this->load->view('main', $data);
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
            'descu' => $this->input->post('descu'));
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
    function com_pedido_det_his($id)
    {
        $alma = $this->catalogos_model->busca_almacen_ped($id);
        $data['titulo'] = "Generar pedido " . $alma;
        $data['id_cc'] = $id;
        $data['q'] = $this->Pedido_model->com_pedido_det_his($id);
        $data['js'] = 'pedido/com_pedido_det_js';
        $this->load->view('main', $data);
    }
    function com_pedido_imp($id)
    {
        $data['a'] = $this->Pedido_model->com_pedido_det_his($id);
        $data['id'] = $id;
        //$data['js'] = 'orden/imprime_js';
        $this->load->view('impresion/com_pedido_orden', $data);
    }
    function precios_mal()
    {
        $data['titulo'] = "Comparar precios";
        $data['q'] = $this->Pedido_model->precios_mal();
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
        $data['titulo'] = "Generar pedido " . $id;
        $data['id_cc'] = $id;
        $data['q'] = $this->Pedido_model->far_pedido_det_his($id);
        $data['js'] = 'pedido/com_pedido_det_js';
        $this->load->view('main', $data);
    }
    function far_pedido_imp($id)
    {
        $data['a'] = $this->Pedido_model->far_pedido_det_his($id);
        $data['id'] = $id;
        $this->load->view('impresion/far_pedido', $data);
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

}
