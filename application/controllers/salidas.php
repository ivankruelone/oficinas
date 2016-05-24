<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Salidas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('catalogos_model');
        $this->load->model('salidas_model');

    }
     function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    function s_salidas_esp()
    {
        $data['titulo'] = "Salida de productos por pedidos especiales y traspasos";
        $data['q'] = $this->salidas_model->salidas_esp();
        $data['js'] = 'salidas/s_salidas_esp_js';
        $this->load->view('main', $data);
    }
    
    function s_salidas_esp_cli($mes,$uno)
    {
    $mesx=$this->catalogos_model->busca_mes_uno($mes);
    $data['mes']=$mes;
    $data['uno']=$uno;
    $data['titulo']='Detalle del mes de '.$mesx;
    $data['luna'] = $this->salidas_model->salidas_esp_cli($mes,$uno);    
    $this->load->view('main', $data);    
    }
    
    function s_salidas_esp_cli_fol($mes,$uno,$suc)
    {
    $mesx=$this->catalogos_model->busca_mes_uno($mes);
    $sucx=$this->catalogos_model->busca_suc_una($suc);
    $data['mes']=$mes;
    $data['uno']=$uno;
    $data['titulo']='Detalle del mes de '.$mesx.' De la sucursal '.$sucx;
    $data['luna'] = $this->salidas_model->salidas_esp_cli_fol($mes,$uno,$suc);    
    $this->load->view('main', $data);   
    }
    function s_salidas_esp_cli_sec($mes,$uno,$suc)
    {
    $mesx=$this->catalogos_model->busca_mes_uno($mes);
    $sucx=$this->catalogos_model->busca_suc_una($suc);
    $data['mes']=$mes;
    $data['uno']=$uno;
    $data['titulo']='Detalle del mes de '.$mesx.' De la sucursal '.$sucx;
    $data['luna'] = $this->salidas_model->salidas_esp_cli_sec($mes,$uno,$suc);    
    $this->load->view('main', $data);   
    }
    ///////////////////////////////////////////////////////////
    function a_salida_segpop()
    {
        $data['titulo'] = 'Embarque de productos de Almacenes a Seguros Populares';
        $data['q'] = $this->salidas_model->salidas_segpop();
        $data['js'] = 'salidas/a_salida_segpop_js';
        $this->load->view('main', $data);
    }
    ///////////////////////////////////////////////////////////
    function a_salida_segpop_pro($aaa,$mes,$suc)
    {
        $data['titulo'] = 'Embarque de productos de Almacenes a Seguros Populares';
        $data['q'] = $this->salidas_model->salidas_segpop_pro($aaa,$mes,$suc);
        $data['js'] = 'salidas/a_salida_segpop_js';
        $this->load->view('main', $data);
    }
    
    
    
    }
 