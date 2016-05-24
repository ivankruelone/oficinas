<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pl extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('pl_model');
        $this->load->model('Catalogos_model');
    }
    
    function reporte_pl()
    {
        $data['mesx']=$this->Catalogos_model->busca_mes();
        $data['aaax']=$this->Catalogos_model->busca_anio_pl();
        $data['tit']='Selecciona el mes y el a&ntilde;o';
        $data['js'] = 'pl/reporte_pl_js';
        $this->load->view('main', $data);
    }
    

    function ventas_pl()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $mes= $this->input->post('mes');
        $aaa= $this->input->post('aaa');
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['s'] = $this->pl_model->ventas_pl($mes, $aaa);
        $data['venta'] = $this->pl_model->consulta_suc_pl_t($mes, $aaa, 1);
        //$data['utilidad'] = $this->pl_model->consulta_suc_pl_t($mes, $aaa, 2);
        $data['utilidad'] = $this->pl_model->consulta_utilidad_t($mes, $aaa);
        $data['financiamiento'] = $this->pl_model->consulta_suc_pl_t($mes, $aaa, 3);
        $data['otros_ingresos'] = $this->pl_model->consulta_suc_pl_t($mes, $aaa, 4);
        $data['gastos_controlables'] = $this->pl_model->consulta_suc_pl_t($mes, $aaa, 5);
        $data['gastos_no_controlables'] = $this->pl_model->consulta_suc_pl_t($mes, $aaa, 6);
        $data['vistaJS'] = $this->pl_model->ventas_pl_suc_t($aaa, $mes);
        $data['js'] = 'pl/ventas_pl_js';
        $this->load->view('main', $data);
    }
    
    function consulta_suc_pl($suc, $mes, $aaa)
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['js'] = 'pl/consulta_suc_pl_js';
        $data['suc'] = $suc;
        $data['mes'] = $mes;
        $data['aaa'] = $aaa;
        $data['sucursal'] = $this->pl_model->getNombreSucursal($suc);
        $data['venta'] = $this->pl_model->consulta_suc_pl($suc, $mes, $aaa, 1);
        $data['utilidad'] = $this->pl_model->consulta_suc_pl($suc, $mes, $aaa, 2);
        $data['financiamiento'] = $this->pl_model->consulta_suc_pl($suc, $mes, $aaa, 3);
        $data['otros_ingresos'] = $this->pl_model->consulta_suc_pl($suc, $mes, $aaa, 4);
        $data['gastos_controlables'] = $this->pl_model->consulta_suc_pl($suc, $mes, $aaa, 5);
        $data['gastos_no_controlables'] = $this->pl_model->consulta_suc_pl($suc, $mes, $aaa, 6);
        $data['vistaJS'] = $this->pl_model->ventas_pl_suc($aaa, $mes, $suc);
        $this->load->view('main', $data);
    }

    
    function captura_reporte_pl()
    {
        $data['mesx']=$this->Catalogos_model->busca_mes();
        $data['aaax']=$this->Catalogos_model->busca_anio_pl();
        $data['tit']='Selecciona el mes y el a&ntilde;o';
        $data['js'] = 'pl/captura_reporte_pl_js';
        $this->load->view('main', $data);
    }
    
    function sucursal_ventas_pl()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $mes= $this->input->post('mes');
        $aaa= $this->input->post('aaa');
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['s'] = $this->pl_model->sucursal_ventas_pl($mes, $aaa);
        $data['js'] = 'pl/ventas_pl_js';
        $this->load->view('main', $data);
    }
    
    function captura_ventas_pl($suc, $mes, $aaa)
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['suc'] = $suc;
        $data['sucursal'] = $this->pl_model->getNombreSucursal($suc);
        $data['s'] = $this->pl_model->captura_ventas_pl($suc, $mes, $aaa);
        $data['js'] = 'pl/captura_ventas_pl_js';
        $this->load->view('main', $data);
    }
    
    public function actualiza_importe()
     {
        $data = array('importe' => $this->input->post('valor'));
        $this->db->where('idPl', $this->input->post('id'));
        $update = $this->db->update('pl.pl', $data);
        echo $update;
        
     }
     
     
    
    function fill($idMes)
    {
        $this->pl_model->calculaDatos($idMes);
    }
    
    
    

}
