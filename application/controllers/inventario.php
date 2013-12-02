<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventario extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('inventario_model');
        $this->load->model('Catalogos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    function mes()
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->inventario_model->mes();
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    function compa($aaa,$mes)
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit']='Reporte de inventario';
        
        $data['a'] = $this->inventario_model->compa($aaa,$mes);
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    
    function compa_cia($aaa,$mes,$cia)
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit']='Reporte de inventario';
        $data['aaa']=$aaa;
        $data['mesx']=$this->Catalogos_model->busca_mes_uno($mes);
        $data['dia']=$this->inventario_model->busca_inv();
        $data['a'] = $this->inventario_model->compa_cia($aaa,$mes,$cia);
        $data['js'] = 'inventario/compa_cia_js';
        $this->load->view('main', $data);
    }
     function sumit_imprimir($aaa,$mes,$cia)
    {
        $data['a'] = $this->inventario_model->compa_cia($aaa,$mes,$cia);
        $data['aaa'] =$aaa;
        $data['mes'] =$mes;
        $data['cia'] =$cia;
        //$data['js'] = 'orden/imprime_js';
        $this->load->view('impresion/inv_cia', $data);
   }
    function mes_tod()
    {
        $data['titulo'] = "Reporte de inventario General";
        $data['tit1']='Reporte de inventario Sucursales';
        $data['tit2']='Reporte de inventario Almacenes';
        $data['a'] = $this->inventario_model->mes();
        $data['b'] = $this->inventario_model->mes_alm();
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    function mes_alm()
    {
        $data['titulo'] = "Reporte de inventario General";
        $data['tit1']='Reporte de inventario Sucursales';
        $data['tit2']='Reporte de inventario Almacenes';
        $data['b'] = $this->inventario_model->mes_alm();
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    function div_alm($aaa,$mes)
    {
        $data['titulo'] = "Reporte de inventario General";
        $data['tit']='Reporte de inventario Almacenes';
        $data['a'] = $this->inventario_model->div_alm($aaa,$mes);
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
     function div_alm_uno($aaa,$mes,$tipo)
    {
        $data['titulo'] = "Reporte de inventario General";
        $data['tit']='Reporte de inventario Almacenes';
        $data['a'] = $this->inventario_model->div_alm_uno($aaa,$mes,$tipo);
        $data['js'] = 'inventario/div_alm_uno_js';
        $this->load->view('main', $data);
    }
    
    
    
    function entrada($tipo,$mes)
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->inventario_model->entrada($tipo,$mes);
        $data['js'] = 'inventario/entrada_js';
        $this->load->view('main', $data);
    }
    function entrada_suc($suc,$mes)
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->inventario_model->entrada_suc($suc,$mes);
        $data['js'] = 'inventario/entrada_suc_js';
        $this->load->view('main', $data);
    }
 
 
  function almacen()
    {
        $data['titulo'] = "Reporte de inventario de almacen";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->inventario_model->almacen();
        //$data['js'] = 'inventario/entrada_suc_js';
        $this->load->view('main', $data);
    }
  function almacen_lot($tipo)
    {
        $data['titulo'] = "Reporte de inventario de almacen";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->inventario_model->almacen_lot($tipo);
        $data['js'] = 'inventario/almacen_lot_js';
        $this->load->view('main', $data);
    }
    function almacen_lot_s($tipo)
    {
        $data['titulo'] = "Reporte de inventario de almacen";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->inventario_model->almacen_lot_s($tipo);
        $data['js'] = 'inventario/almacen_lot_s_js';
        $this->load->view('main', $data);
    }
    function almacen_det($tipo)
    {
        $data['titulo'] = "Reporte de inventario de almacen";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->inventario_model->almacen_det($tipo);
        $data['js'] = 'inventario/almacen_det_js';
        $this->load->view('main', $data);
    }
    function inv_sucursal()
    {
        $data['titulo'] = "Reporte de inventario de almacen y farmacias";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->inventario_model->inv_sucursal();
        $data['js'] = 'inventario/inv_sucursal_js';
        $this->load->view('main', $data);
    }
    function inv_sucursal_espe($sec)
    {
        $data['titulo'] = "Reporte de inventario de farmacias";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->inventario_model->inv_sucursal_espe($sec);
        $data['js'] = 'inventario/inv_sucursal_espe_js';
        $this->load->view('main', $data);
    }
    function inv_gral()
    {
        $data['titulo'] = "Reporte de inventario de farmacias";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->inventario_model->inv_gral();
        $data['js'] = 'inventario/inv_gral_js';
        $this->load->view('main', $data);
    }
 
 
 
 
 
 
 
 
 
 
 
 
 
    
    function ventas_cortes()
    {
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR IMAGEN SIN IVA';
        $data['a'] = $this->ventas_model->ventas_cortes('','');
        $data['js'] = 'ventas/ventas_cortes_js';
        $this->load->view('main', $data);
    }
    function ventas_cortes_suc($mes,$tipo2)
    {
        $imagen=$this->Catalogos_model->busca_imagen_uno($tipo2);
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR IMAGEN SIN IVA DE '.trim($imagen).' DEL MES DE '.trim($mesx);
        $data['a'] = $this->ventas_model->ventas_cortes($mes,$tipo2);
        $data['js'] = 'ventas/ventas_cortes_suc_js';
        $this->load->view('main', $data);
    }
    function ventas_cortes_ger()
    {
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR GERENTE SIN IVA';
        $data['a'] = $this->ventas_model->ventas_cortes_ger('','');
        $data['js'] = 'ventas/ventas_cortes_ger_js';
        $this->load->view('main', $data);
    }
    function ventas_cortes_ger_mes($mes,$ger)
    {
        $data['titulo'] = "Venta de cortes";
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $gerx=$this->Catalogos_model->busca_ger_uno($ger);
        $data['tit']='CONCENTRADO DE VENTAS POR GERENTE SIN IVA DE '.trim($gerx).' DEL MES DE '.trim($mesx);
        $data['a'] = $this->ventas_model->ventas_cortes_ger($mes,$ger);
        $data['js'] = 'ventas/ventas_cortes_ger_js';
        $this->load->view('main', $data);
    }    
     function ventas_cortes_ger_mes_sup($mes,$sup)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $supx=$this->Catalogos_model->busca_sup_uno($sup);
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR GERENTE SIN IVA DE '.trim($supx).' DEL MES DE '.trim($mesx);
        $data['a'] = $this->ventas_model->ventas_cortes_ger($mes,$sup);
        $data['js'] = 'ventas/ventas_cortes_suc_js';
        $this->load->view('main', $data);
    }
    function ventas_cortes_sup()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA';
        $data['a'] = $this->ventas_model->ventas_cortes_ger('',$id_plaza);
        $data['js'] = 'ventas/ventas_cortes_sup_js';
        $this->load->view('main', $data);
    }
    function ventas_cortes_succ()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA';
        $data['a'] = $this->ventas_model->ventas_succ('',$id_plaza);
        $data['js'] = 'ventas/ventas_cortes_succ_js';
        $this->load->view('main', $data);
    }
    
    
}
