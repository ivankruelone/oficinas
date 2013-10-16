<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entradas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('entradas_model');
        $this->load->model('Catalogos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
    function facturas()
    {
        $data['titulo'] = "Facturas";
        $data['tit']='CONCENTRADO DE COMPRA POR IMAGEN SIN IVA';
        $data['a'] = $this->entradas_model->facturas('','');
        $data['js'] = 'entradas/facturas_js';
        $this->load->view('main', $data);
    }
    function facturas_suc($mes,$tipo2)
    {
        $imagen=$this->Catalogos_model->busca_imagen_uno($tipo2);
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "Facturas";
        $data['tit']='CONCENTRADO DE VENTAS POR IMAGEN SIN IVA DE '.trim($imagen).' DEL MES DE '.trim($mesx);
        $data['a'] = $this->entradas_model->facturas_suc($mes,$tipo2);
        $data['js'] = 'entradas/facturas_suc_js';
        $this->load->view('main', $data);
    }
    
 
   
function facturas_g($fa)
    {
        $data['titulo'] = "Facturas por Gerente Regional";
        $data['tit']='CONCENTRADO DE COMPRA POR IMAGEN SIN IVA';
        $data['a'] = $this->entradas_model->facturas_g($fa,'','');
        $data['js'] = 'entradas/facturas_g_js';
        $this->load->view('main', $data);
    }

function facturas_gs($fa,$mes,$ger)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $gerx=$this->Catalogos_model->busca_ger_uno($ger);
        $data['titulo'] = "Facturas";
        $data['tit']='CONCENTRADO DE COMPRA SIN IVA DE LA REGION '.$ger.' '.trim($gerx).' DEL MES DE '.trim($mesx);;
        
        $data['a'] = $this->entradas_model->facturas_g($fa,$mes,$ger);
        $data['js'] = 'entradas/facturas_g_js';
        $this->load->view('main', $data);
    }
    function facturas_gss($fa,$mes,$superv)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $supx=$this->Catalogos_model->busca_sup_uno($superv);
        $data['titulo'] = "Facturas";
        $data['tit']='CONCENTRADO DE COMPRA SIN IVA DE LA ZONA '.$superv.' '.trim($supx).' DEL MES DE '.trim($mesx);;
        $data['a'] = $this->entradas_model->facturas_g($fa,$mes,$superv);
        $data['js'] = 'entradas/facturas_gss_js';
        $this->load->view('main', $data);
    }
       function facturas_suc_fac($fa,$mes,$suc)
    {
        $data['titulo'] = "Facturas";
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['tit']='CONCENTRADO DE VENTAS SIN IVA DE '.$suc.' '.trim($sucx).' DEL MES DE '.trim($mesx);
        $data['a'] = $this->entradas_model->facturas_suc_fac($fa,$mes,$suc);
        $data['js'] = 'entradas/facturas_suc_fac_js';
        $this->load->view('main', $data);
    }
    function facturas_gg($fa)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        
        $data['titulo'] = "Facturas por Gerente Regional";
        $data['tit']='CONCENTRADO DE COMPRA SIN IVA';
        $data['a'] = $this->entradas_model->facturas_g($fa,'',$id_plaza);
        $data['js'] = 'entradas/facturas_g_js';
        $this->load->view('main', $data);
    }
    function facturas_ss($fa)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $supx=$this->Catalogos_model->busca_sup_uno($id_plaza);
        $data['titulo'] = "Facturas por Gerente Regional";
        $data['tit']='CONCENTRADO DE COMPRA SIN IVA DE LA ZONA '.$id_plaza.' '.trim($supx);
        $data['a'] = $this->entradas_model->facturas_g($fa,'',$id_plaza);
        $data['js'] = 'entradas/facturas_g_js';
        $this->load->view('main', $data);
    }
    
  
    
}
