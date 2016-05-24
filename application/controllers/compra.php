<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Compra extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('inventario_model');
        $this->load->model('Catalogos_model');
        $this->load->model('Procesos_model');
        $this->load->model('backoffice_model');
        $this->load->model('lidia_model');
        $this->load->model('compra_model');

    }
    
    function factura()
    {
        $data['titulo'] = "REPORTE DE COMPRA A MAYORISTAS";
        $data['tit']='Reporte de compras';
        $data['q']=$this->backoffice_model->fac_central();
        $this->load->view('main', $data);
    }
    
    function genericos()
    {
        $data['titulo'] = "Reporte de compras";
        $data['tit']='Reporte de compras';
        //$data['a'] = $this->Procesos_model->llena_mov_inv($fec1,$fec2,$sem);
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    function s_factura_central()
    {
    $data['titulo']="REPORTE DE COMPRA MAYORISTAS";    
    $data['q']=$this->backoffice_model->fac_central();
    $data['js'] = 'backoffice/s_factura_central_js';
    $this->load->view('main', $data);
    }
    function s_pago_mayoristas()
    {
        $data['titulo'] = "REPORTE DE PAGOS Y VENCIMIENTOS";
        $data['q']=$this->compra_model->pago_mayoristas();
        $data['qq']=$this->compra_model->pago_mayoristas_cal();
        $data['js'] = 'compra/s_pago_mayoristas_js';
        $this->load->view('main', $data);
    }
    function s_pago_mayoristas_prv($aaa,$mes)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "REPORTE DE PAGOS Y VENCIMIENTOS CXP DEL MES DE $mesx";
        $data['a']=$this->compra_model->pago_mayoristas_prv($aaa,$mes);
        $data['js'] = 'compra/s_pago_mayoristas_prv_js';
        $this->load->view('main', $data);
    }
    function s_pago_mayoristas_prv_ven($fecven)
    {
        $data['titulo'] = "REPORTE DE PAGOS Y VENCIMIENTOS CXP DE $fecven";
        $data['a']=$this->compra_model->pago_mayoristas_prv_ven($fecven);
        $data['js'] = 'compra/s_pago_mayoristas_prv_ven_js';
        $this->load->view('main', $data);
    }
    function s_pago_mayoristas_prv_ven_suc($fecven,$suc)
    {
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['titulo'] = "REPORTE DE PAGOS Y VENCIMIENTOS CXP DE $fecven DE LA SUCURSAL $sucx";
        $data['a']=$this->compra_model->pago_mayoristas_prv_ven_suc($fecven,$suc);
        $data['js'] = 'compra/s_pago_mayoristas_prv_ven_js';
        $this->load->view('main', $data);
    }
    function s_pago_mayoristas_prv_cal($aaa,$mes)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "REPORTE DE PAGOS Y VENCIMIENTOS CALCULADOS DEL MES DE $mesx";
        $data['a']=$this->compra_model->pago_mayoristas_prv_cal($aaa,$mes);
        $data['js'] = 'compra/s_pago_mayoristas_prv_js';
        $this->load->view('main', $data);
    }
    function s_pago_mayoristas_prv_ven_cal($fecven)
    {
        $data['titulo'] = "REPORTE DE PAGOS Y VENCIMIENTOS CALCULADOS DE $fecven";
        $data['a']=$this->compra_model->pago_mayoristas_prv_ven_cal($fecven);
        $data['js'] = 'compra/s_pago_mayoristas_prv_ven_js';
        $this->load->view('main', $data);
    }
    function s_pago_mayoristas_prv_ven_suc_cal($fecven,$suc)
    {
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['titulo'] = "REPORTE DE PAGOS Y VENCIMIENTOS CALCULADOS DE $fecven DE LA SUCURSAL $sucx";
        $data['a']=$this->compra_model->pago_mayoristas_prv_ven_suc_cal($fecven,$suc);
        $data['js'] = 'compra/s_pago_mayoristas_prv_ven_js';
        $this->load->view('main', $data);
    }
    function s_compras_ventas()
    {
        $data['titulo'] = "REPORTE DE COMPRAS CONTRA VENTAS";
        $data['mes']=$this->Catalogos_model->busca_mes();
        $data['js'] = 'compra/s_pago_mayoristas_prv_ven_js';
        $this->load->view('main', $data);
    }
    function s_compras_ventas_mes()
    {
        $data['titulo'] = "REPORTE DE COMPRAS CONTRA VENTAS";
        $fec=date('Y').'-'.str_pad($this->input->post('mes'),2,'0',STR_PAD_LEFT);
        $data['q']=$this->compra_model->compras_ventas_mes($fec);
        $data['js'] = 'compra/s_pago_mayoristas_prv_ven_js';
        $this->load->view('main', $data);
    }
    function a_pedido_fanasa()
    {
        $data['titulo'] = "Evaluacion de pedido";
        $data['q']=$this->compra_model->pedido_fanasa();
        $data['js'] = 'compra/a_pedido_fanasa_js';
        $this->load->view('main', $data);
    }
    
    function a_pedido_fanasa_suc($mes)
    {
        
        $data['titulo'] = "Evaluacion de pedido por sucursal";
        $data['q']=$this->compra_model->pedido_fanasa_suc($mes);
        $data['js'] = 'compra/a_pedido_fanasa_suc_js';
        $this->load->view('main', $data);  
    }

     function a_pedido_fanasa_suc_day($suc,$mes)
    {
        $data['titulo'] = "Evaluacion de pedido por dia";
        $data['q']=$this->compra_model->pedido_fanasa_suc_day($suc,$mes);
        $data['js'] = 'compra/a_pedido_fanasa_suc_day_js';
        $this->load->view('main', $data);
    }
 
 
}
