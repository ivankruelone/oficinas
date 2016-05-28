<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Desplazamientos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('desplazamientos_model');
        $this->load->model('Catalogos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
    function clasificacion()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $supx=$this->Catalogos_model->busca_sup_uno($id_plaza);
        $data['titulo'] = "Clasificaci&oacute;n por Gerente Regional";
        $data['var']='0';
        $data['tit']='CLASIFICACION DE PRODUCTOS, '. 'PLAZA '.$id_plaza.', '.trim($supx);
        $data['js'] = 'desplazamientos/clasificacion_js';
        $this->load->view('main', $data);
    }
    
    public function clasificacion_nid()
    {
        $var= $this->input->post('var');
        
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
        if($var==4){$varx='A,B,C,D y E';$var0="'a','b','c','d','e'";}
        $data['var']= $var;
        $data['tit']= $this->session->userdata('nombre');
        $data['titulo']= 'Maximo generado por producto '.$varx;
        $data['a'] = $this->desplazamientos_model->control_desplaza_suc($var,$this->session->userdata('id_plaza'));
        $data['js'] = 'desplazamientos/clasificacion_nid_js';
        $this->load->view('main', $data);
    }
    
    public function clasificacion_nid_una($var,$suc)
    {
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
        if($var==4){$varx='A,B,C,D y E';$var0="'a','b','c','d','e'";}
        
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['tit']= $this->session->userdata('nombre').'___SUCURSAL '.$sucx;
        $data['titulo']= 'Maximo generado por producto '.$varx;
        $data['a'] = $this->desplazamientos_model->control_desplaza_suc_una($var,$suc);
        $data['js'] = 'desplazamientos/clasificacion_nid_una_js';
        $this->load->view('main', $data);
    }    
  public function s_nivel_surtido()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $supx=$this->Catalogos_model->busca_sup_uno($id_plaza);
        $data['titulo'] = "Gerente Regional";
        $data['tit']='PLAZA '.$id_plaza.', '.trim($supx);
        
        $data['a'] = $this->desplazamientos_model->nivel_surtido($id_plaza);
        $data['js'] = 'desplazamientos/s_nivel_surtido_js';
        $this->load->view('main', $data);
    }
  public function s_desplaza_fenix()
    {
        set_time_limit(0);
        ini_set("memory_limit","2048M");
        $data['titulo'] = "Gerente Regional";
        $data['aaa']=$this->Catalogos_model->busca_anio();
        $this->load->view('main', $data);
    }
    function s_desplaza_excel_ger()
    {
        set_time_limit(0);
        ini_set("memory_limit","2048M");
        $this->load->helper('download');
        $id_plaza=$this->session->userdata('id_plaza');
        $aaa=$this->input->post('aaa');
        $data['ger']=$id_plaza;
        $data['query'] = $this->desplazamientos_model->archivo_exel_gerente($id_plaza,$aaa);
        $this->load->view('excel/s_desplaza_excel',$data);
        }
    function a_desplaza_paquetes()
        {
        set_time_limit(0);
        ini_set("memory_limit","2048M");
        $data['titulo1'] = "Desplazamientos de paquetes";
        $data['q'] = $this->desplazamientos_model->desplaza_paquetes();
        $data['js'] = 'desplazamientos/a_desplaza_paquetes_js';
        $this->load->view('main', $data);
        }
    
        
        function s_desplaza_ofertas_gen()
        {
        $aaa=date('Y');
        $data['titulo1'] = "Desplazamientos de ofertas Catalogo Doctor Ahorro";
        $data['aaa'] =$aaa;
        $data['q'] = $this->desplazamientos_model->desplaza_ofertas_gen($aaa);
        $data['js'] = 'desplazamientos/s_desplaza_ofertas_gen_js';
        $this->load->view('main', $data);
        }
        function s_desplaza_ofertas_gen_det($aaa,$cod)
        {
        $data['titulo1'] = "Desplazamientos de ofertas Catalogo Doctor Ahorro";
        $data['aaa'] =$aaa;
        $data['q'] = $this->desplazamientos_model->desplaza_ofertas_gen_det($aaa,$cod);
        $data['js'] = 'desplazamientos/s_desplaza_ofertas_gen_js';
        $this->load->view('main', $data);
        }
        function s_desplaza_ofertas_gen_in()
        {
        $aaa=date('Y');
        $data['titulo1'] = "Desplazamientos de ofertas Catalogo Doctor Ahorro";
        $data['aaa'] =$aaa;
        $data['q'] = $this->desplazamientos_model->desplaza_ofertas_gen_in($aaa);
        $data['js'] = 'desplazamientos/s_desplaza_ofertas_gen_js';
        $this->load->view('main', $data);
        }
        function s_desplaza_ofertas_gen_in_det($aaa,$cod)
        {
        $data['titulo1'] = "Desplazamientos de ofertas Catalogo Doctor Ahorro";
        $data['aaa'] =$aaa;
        $data['q'] = $this->desplazamientos_model->desplaza_ofertas_gen_in_det($aaa,$cod);
        $data['js'] = 'desplazamientos/s_desplaza_ofertas_gen_js';
        $this->load->view('main', $data);
        }
    ////////////////////////////////////////////////////////////////////////////////////////////////////compras    
         public function s_diarias()
    {
        $data['titulo'] = "Desplazamiento diario Doctor Ahorro";
        $data['a'] = $this->desplazamientos_model->des_diario();
        $data['js'] = 'ventas/s_diarias_js';
        $this->load->view('main', $data);
    }  
   
  public function s_diarias_sem()
    {
        $data['titulo'] = "Desplazamiento diario Doctor Ahorro";
         
        $data['fecha'] = $this->Catalogos_model->busca_semana_venta();
        $data['js'] = 'desplazamientos/s_diarias_js';
        $this->load->view('main', $data);
    }
    public function s_diarias_sem_det()
    {
        $fec1=substr($this->input->post('fecha'),0,10);
        $fec2=substr($this->input->post('fecha'),11,10);
        $data['titulo'] = "Desplazamiento diario Doctor Ahorro del ".$fec1." al ".$fec2;
        $data['a'] = $this->desplazamientos_model->des_diario_sem($fec1,$fec2);
        $data['js'] = 'desplazamientos/s_diarias_js';
        $this->load->view('main', $data);
    }
    public function s_desplaza_metro()
    {
        
        $data['titulo'] = "Desplazamiento Cliente Metro";
        $data['a'] = $this->desplazamientos_model->des_metro();
        $data['js'] = 'desplazamientos/s_desplaza_metro_js';
        $this->load->view('main', $data);
    }
    public function s_desplaza_metro_suc($aaa,$mes)
    {
        
        $data['titulo'] = "Desplazamiento Cliente Metro del mes de ".$mes;
        $data['a'] = $this->desplazamientos_model->des_metro_suc($aaa,$mes);
        $data['js'] = 'desplazamientos/s_desplaza_metro_suc_js';
        $this->load->view('main', $data);
    }
    public function s_desplaza_metro_suc_det($aaa,$mes,$suc)
    {
        
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['titulo'] = "Desplazamiento Cliente Metro del mes de ".$mes." de la sucursal ".$sucx; 
        $data['a'] = $this->desplazamientos_model->des_metro_suc_det($aaa,$mes,$suc);
        $data['js'] = 'desplazamientos/s_desplaza_metro_suc_det_js';
        $this->load->view('main', $data);
    }
    public function s_desplaza_metro_pro($aaa,$mes)
    {
        $data['titulo'] = "Desplazamiento Cliente Metro del mes de ".$mes; 
        $data['a'] = $this->desplazamientos_model->des_metro_pro($aaa,$mes);
        $data['js'] = 'desplazamientos/s_desplaza_metro_pro_js';
        $this->load->view('main', $data);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////compras  
    function a_desplaza_fenix_contado_pat()
    {
        $aaa=date('Y');
        $data['titulo'] = "Desplazamiento de productos";
        $data['q'] = $this->desplazamientos_model->desplaza_fenix_contado_pat($aaa);
        $data['js'] = 'desplazamientos/a_desplaza_fenix_contado_pat_js';
        $this->load->view('main', $data);
    }
    function a_desplaza_fenix_contado_pat_excel()
    {
        $this->load->dbutil();
        $this->load->helper('download');
       $aaa=date('Y');
        $data['titulo'] = "Desplazamiento de productos";
        $a = $this->desplazamientos_model->desplaza_fenix_contado_pat($aaa);
        
        $csv = $this->dbutil->csv_from_result($a);
        $name = 'desplazamiento_contado_'.$aaa.date('His').'.csv';
        force_download($name, $csv);
        redirect('desplazamientos/a_desplaza_fenix_contado_pat');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////compras  
    function a_desplaza_optimo_venta()
    {
        $aaa=date('Y');
        $data['titulo'] = "Desplazamiento de productos";
        $data['act']=$this->Catalogos_model->busca_mes_uno(3);
        $data['ant']=$this->Catalogos_model->busca_mes_uno(2);
        $data['q'] = $this->desplazamientos_model->desplaza_optimo_venta($aaa);
        $data['js'] = 'desplazamientos/a_desplaza_optimo_venta_js';
        
        $this->load->view('main', $data);
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////compras  
    function a_desplaza_mes_contado_fanasa()
    {
        $data['titulo'] = "Desplazamiento de productos";
        $data['mes'] = $this->Catalogos_model->busca_mes();
        $this->load->view('main', $data);
    }
    function a_desplaza_mes_contado_fanasa_excel()
    {
        $this->load->dbutil();
        $this->load->helper('download');
        $aaa=date('Y');
        $mes=$this->input->post('mes');
        $a = $this->desplazamientos_model->fanasa_excel($mes);
        $csv = $this->dbutil->csv_from_result($a);
        $name = 'desplazamiento_fanasa_'.$mes.date('His').'.csv';
        force_download($name, $csv);
        
    }
    
    
    
    
}
