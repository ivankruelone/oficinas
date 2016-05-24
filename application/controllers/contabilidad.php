<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contabilidad extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('contabilidad_model');
        $this->load->model('Catalogos_model');
        
    }
    
    function s_depositos()
    {
        $data['tit1'] = "REPORTE DE DEPOSITOS DE FARMACIAS DOCTOR AHORRO";
        $data['tit2'] = "REPORTE DE DEPOSITOS DE FARMACIAS FENIX";
        $data['tit3'] = "REPORTE DE DEPOSITOS DE FARMACIAS FARMABODEGA";
        $data['q']=$this->contabilidad_model->depositos(date('Y'),'DA');
        $data['q1']=$this->contabilidad_model->depositos(date('Y'),'FE');
        $data['q2']=$this->contabilidad_model->depositos(date('Y'),'FA');
        $data['js'] = 'contabilidad/s_depositos_js';
        $data['json'] = $this->contabilidad_model->graficaAnio_deposito(date('Y'),'DA','chart');
        $data['json1'] = $this->contabilidad_model->graficaAnio_deposito(date('Y'),'FE','chart1');
        $data['json2'] = $this->contabilidad_model->graficaAnio_deposito(date('Y'),'FA','chart2');
        $this->load->view('main', $data);
    }
    function s_depositos_tipo($aaa,$mes,$tipo)
    {
        $data['titulo'] = "REPORTE DE DEPOSITOS POR SUCURSAL";
        $data['q']=$this->contabilidad_model->depositos_tipo($aaa,$mes,$tipo);
        $data['js'] = 'contabilidad/s_depositos_tipo_js';
        $this->load->view('main', $data);
    }
    function s_depositos_tipo_suc($aaa,$mes,$tipo)
    {
        $data['aaa'] = $aaa;
        $data['mes'] = $mes;
        $data['tipo'] = $tipo;
        $data['titulo'] = "REPORTE DE DEPOSITOS";
        $data['q']=$this->contabilidad_model->depositos_tipo_suc($aaa,$mes,$tipo);
        $data['js'] = 'contabilidad/s_depositos_tipo_suc_js';
        $this->load->view('main', $data);
    }
     function s_depositos_tipo_suc_dia($aaa,$mes,$suc)
    {
        $data['aaa'] = $aaa;
        $data['mes'] = $mes;
        $data['titulo'] = "REPORTE DE DEPOSITOS";
        $data['q']=$this->contabilidad_model->depositos_tipo_suc_dia($aaa,$mes,$suc);
        $data['js'] = 'contabilidad/s_depositos_tipo_suc_dia_js';
        $this->load->view('main', $data);
    }
    
    
    
    
    
    
}