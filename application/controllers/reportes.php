<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reportes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('reportes_model');
        $this->load->model('Catalogos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
    function reporte()
    {
       
        $data['titulo'] = "Poliza de Inventario";
        $data['tit']='Selecciona la semana y el a&ntilde;o';
        $data['js'] = 'reportes/reporte_js';
        $this->load->view('main', $data);
    }
    
    public function reporte_poliza_inv()
    {
        $semana= $this->input->post('semana');
        $aaa= $this->input->post('anio');
        
        $data['aaa']= $aaa;
        $data['semana']= $semana;
        $data['titulo']= 'Poliza de Inventario de la semana '.$semana;
        $data['a'] = $this->reportes_model->poliza_inventario($semana, $aaa);
        $data['js'] = 'reportes/reporte_poliza_js';
        $this->load->view('main', $data);
    }
    
    public function reporte_cia($semana, $aaa, $cia, $razon)
    {
      
        $data['aaa']= $aaa;
        $data['semana']= $semana;
        $data['cia']= $cia;
        $data['tit']= 'COMPA&Ntilde;IA: '.$cia.' - '.str_replace('%20',' ',$razon);
        $data['titulo']= 'Poliza de Inventario de la semana '.$semana;
        $data['a'] = $this->reportes_model->poliza_inventario_cia($semana, $aaa, $cia);
        $data['js'] = 'reportes/reporte_cia_js';
        $this->load->view('main', $data);
    }
    
    public function reporte_cia_suc($semana, $aaa, $cia, $suc, $nombre)
    {
      
        
        $data['tit']= 'SUCURSAL: '.$suc.' - '.str_replace('%20',' ',$nombre);
        $data['titulo']= 'Poliza de Inventario de la semana '.$semana;
        $data['a'] = $this->reportes_model->poliza_inventario_cia_suc($semana, $aaa, $cia, $suc);
        $data['js'] = 'reportes/reporte_cia_suc_js';
        $this->load->view('main', $data);
    }
    
/////////////////////////////////////////////////////////arzate////////////////////////////////////////////////////////  
   function ventas_imp()
    {
       
        $data['titulo'] = "Reporte de Venatas Imperial";
        $data['tit']='Selecciona el mes y el a&ntilde;o';
        $data['mesx']=$this->Catalogos_model->busca_mes();
        $data['aaax']=$this->Catalogos_model->busca_anio();
        $data['js'] = 'reportes/ventas_imp_js';
        $this->load->view('main', $data);
    }
    
    public function ventas_imp_gen()
    {
        $mes= $this->input->post('mes');
        $aaa= $this->input->post('aaa');
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['tit']='Reporte de ventas Imperial';
        $data['titulo']= 'Reporte de ventas del mes '.$mesx;
        $data['a'] = $this->reportes_model->reporte_imperial($mes, $aaa);
        $data['js'] = 'reportes/ventas_imp_gen_js';
        $this->load->view('main', $data);
    }
    
     public function reporte_imp_suc($mes, $aaa, $sucursal, $nombre)
    {
      
        
        $data['tit']= 'SUCURSAL: '.$sucursal.' - '.str_replace('%20',' ',$nombre);
        $data['titulo']= 'Reporte de ventas del mes '.$mes;
        $data['a'] = $this->reportes_model->reporte_imperial_suc($mes, $aaa, $sucursal);
        $data['js'] = 'reportes/reporte_imp_suc_js';
        $this->load->view('main', $data);
    }
    
    function ventas_gon()
    {
       
        $data['titulo'] = "Reporte de Venatas Gontor";
        $data['mesx']=$this->Catalogos_model->busca_mes();
        $data['aaax']=$this->Catalogos_model->busca_anio();
        $data['tit']='Selecciona el mes y el a&ntilde;o';
        $data['js'] = 'reportes/ventas_gon_js';
        $this->load->view('main', $data);
    }
    
    public function ventas_gon_gen()
    {
        $mes= $this->input->post('mes');
        $aaa= $this->input->post('aaa');
        
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['tit']='Reporte de ventas Gontor';
        $data['titulo']= 'Reporte de ventas del mes '.$mesx;
        $data['a'] = $this->reportes_model->reporte_gontor($mes, $aaa);
        $data['js'] = 'reportes/ventas_gon_gen_js';
        $this->load->view('main', $data);
    }
    
    public function reporte_gon_suc($mes, $aaa, $sucursal, $nombre)
    {
      
        
        $data['tit']= 'SUCURSAL: '.$sucursal.' - '.str_replace('%20',' ',$nombre);
        $data['titulo']= 'Reporte de ventas del mes '.$mes;
        $data['a'] = $this->reportes_model->reporte_gontor_suc($mes, $aaa, $sucursal);
        $data['js'] = 'reportes/reporte_gon_suc_js';
        $this->load->view('main', $data);
    }
    
    public function mer_reporte_prom()
    {
       
        $data['titulo']= 'Claves en promoci&oacute;n ';
        $data['a'] = $this->reportes_model->claves_promocion();
        $data['js'] = 'reportes/mer_reporte_prom_js';
        $this->load->view('main', $data);
    }
    
    public function mer_reporte_prom_cod($codigo)
    {
        
       
        $data['codigo']= $codigo;
        $data['titulo']= 'Piezas x codigo x sucursal ';
        $data['a'] = $this->reportes_model->claves_promocion_x_sucursal($codigo);
        $data['js'] = 'reportes/mer_reporte_prom_cod_js';
        $this->load->view('main', $data);
    }
    
//////////////////////////////////////////////////////supervisor/////////////////////////////////////////////////////    
    
    public function mer_reporte_prom_sup()
    {
       
        $id_plaza=$this->session->userdata('id_plaza');
        $supx=$this->Catalogos_model->busca_sup_uno($id_plaza);
        $data['titulo']= 'Empleados que vendieron productos en promoci&oacute;n';
        $data['a'] = $this->reportes_model->claves_promocion_sup($this->session->userdata('id_plaza'));
        $data['b'] = $this->reportes_model->claves_promocion_general();
        $data['tit']='PRODUCTOS EN PROMOCI&Oacute;N, '. 'PLAZA '.$id_plaza.', '.trim($supx);
        $data['js'] = 'reportes/mer_reporte_prom_sup_js';
        $this->load->view('main', $data);
    }
    
    public function mer_reporte_prom_cod_sup($codigo)
    {
        
        $id_plaza=$this->session->userdata('id_plaza');
        $data['codigo']= $codigo;
        $data['titulo']= 'Piezas x codigo x sucursal ';
        $data['a'] = $this->reportes_model->claves_promocion_x_sucursal_sup($codigo,$this->session->userdata('id_plaza'));
        $data['js'] = 'reportes/mer_reporte_prom_cod_sup_js';
        $this->load->view('main', $data);
    }
    
///////////////////////////////////////////////////////gerente/////////////////////////////////////////////////////////////

    public function mer_reporte_prom_ger()
    {
       
        $id_plaza=$this->session->userdata('id_plaza');
        $gerx=$this->Catalogos_model->busca_ger_uno($id_plaza);
        $data['titulo']= 'Empleados que vendieron productos en promoci&oacute;n';
        $data['a'] = $this->reportes_model->claves_promocion_ger($this->session->userdata('id_plaza'));
        $data['b'] = $this->reportes_model->claves_promocion_general();
        $data['tit']='PRODUCTOS EN PROMOCI&Oacute;N, '. 'PLAZA '.$id_plaza.', '.trim($gerx);
        $data['js'] = 'reportes/mer_reporte_prom_ger_js';
        $this->load->view('main', $data);
    }
    
    public function mer_reporte_prom_cod_ger($codigo)
    {
        
        $id_plaza=$this->session->userdata('id_plaza');
        $data['codigo']= $codigo;
        $data['titulo']= 'Piezas x codigo x sucursal ';
        $data['a'] = $this->reportes_model->claves_promocion_x_sucursal_ger($codigo,$this->session->userdata('id_plaza'));
        $data['js'] = 'reportes/mer_reporte_prom_cod_ger_js';
        $this->load->view('main', $data);
    }
    
////////////////////////////////////////////////////////////////xochitl/////////////////////////////////////////////////////    

    function ventas_iva()
    {
       
        $data['titulo'] = "Reporte de Venatas sin iva";
        $data['mesx']=$this->Catalogos_model->busca_mes();
        $data['aaax']=$this->Catalogos_model->busca_anio();
        $data['tit']='Selecciona el mes y el a&ntilde;o';
        $data['js'] = 'reportes/ventas_gon_js';
        $this->load->view('main', $data);
    }
    
    public function ventas_iva_xmes()
    {
        $mes= $this->input->post('mes');
        $aaa= $this->input->post('aaa');
        
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['tit']='Reporte de ventas x mes';
        $data['titulo']= 'Reporte de ventas del mes '.$mesx;
        $data['a'] = $this->reportes_model->reporte_siniva($mes, $aaa);
        $data['js'] = 'reportes/ventas_iva_xmes_js';
        $this->load->view('main', $data);
    }

}
