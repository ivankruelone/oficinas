<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Devolucion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('devolucion_model');
        $this->load->model('Catalogos_model');
        
    }
    
    
    
    function s_devolucion_ctl()
    {
        $data['titulo'] = "Devolucion de mercancia";
        $data['q'] = $this->devolucion_model->devolucion_ctl();
        $this->load->view('main', $data);
    }
    function s_devolucion_pro($aaa,$mes)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "DEVOLUCION DE MERCANCIA DEL MES DE ".$mesx." DEL ".$aaa;
        $data['q'] = $this->devolucion_model->devolucion_pro($aaa,$mes);
        $data['js'] = 'devolucion/s_devolucion_pro_js';
        $this->load->view('main', $data);
    }
    function s_devolucion_pro_suc($aaa,$mes,$sec)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $secx=$this->Catalogos_model->cedis_sec($sec);
        $data['titulo'] = "DEVOLUCION DE MERCANCIA DEL MES DE ".$mesx." DEL ".$aaa." ".$secx;
        $data['q'] = $this->devolucion_model->devolucion_pro_suc($aaa,$mes,$sec);
        $data['js'] = 'devolucion/s_devolucion_pro_js';
        $this->load->view('main', $data);
    }
    function s_devolucion_suc($aaa,$mes)
    {
        $data['titulo'] = "Devolucion de mercancia";
        $data['q'] = $this->devolucion_model->devolucion_suc($aaa,$mes);
        $data['js'] = 'devolucion/s_devolucion_suc_js';
        $this->load->view('main', $data);
    }
    function s_devolucion_suc_rrm($aaa,$mes,$suc)
    {
        $data['titulo'] = "Devolucion de mercancia";
        $data['q'] = $this->devolucion_model->devolucion_suc_rrm($aaa,$mes,$suc);
        $data['js'] = 'devolucion/s_devolucion_suc_rrm_js';
        $this->load->view('main', $data);
    }
    function s_devolucion_causa($aaa,$mes)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "DEVOLUCION DE MERCANCIA DEL MES DE ".$mesx." DEL ".$aaa;
        $data['q'] = $this->devolucion_model->devolucion_causa($aaa,$mes);
        $data['js'] = 'devolucion/s_devolucion_causa_js';
        $this->load->view('main', $data);
    }
    function s_devolucion_causa_det($aaa,$mes,$id_devolucion)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "DEVOLUCION DE MERCANCIA DEL MES DE ".$mesx." DEL ".$aaa;
        $data['q'] = $this->devolucion_model->devolucion_causa_det($aaa,$mes,$id_devolucion);
        $data['js'] = 'devolucion/s_devolucion_causa_det_js';
        $this->load->view('main', $data);
    }
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    
    
    
    
   }