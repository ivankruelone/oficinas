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
    
    function compa()
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->inventario_model->compa();
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    
    function compa_cia($mes,$cia)
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->inventario_model->compa_cia($mes,$cia);
        //$data['js'] = 'inventario/inventario_js';
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