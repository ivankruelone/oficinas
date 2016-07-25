<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Evaluacion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('Evaluacion_model');
        $this->load->model('catalogos_model');
        
    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    function eval_cedis()
    {
        $data['titulo'] = "NIVEL DE SURTIDO EN CEDIS";
        $data['titulo1'] = "NIVEL DE SURTIDO EN CEDIS";
        $data['q'] = $this->Evaluacion_model->eval_cedis();
        $this->load->view('main', $data);
    }
    function eval_cedis_cla($var)
    {
        
        $data['titulo'] = "NIVEL DE SURTIDO POR CLASIFICACION ".$var ;
        $data['var'] = $var;
        $data['q'] = $this->Evaluacion_model->eval_cedis_cla($var);
        $data['js'] = 'catalogos/descontin_js';
        $this->load->view('main', $data);
    }
   
   function eval_cedis_cla_sec($var,$prv)
    {
        $data['titulo'] = "NIVEL DE SURTIDO POR CLASIFICACION ".$var." EXISTENCIA CONTRA COMPRA" ;
        $data['var'] = $var;
        $data['q'] = $this->Evaluacion_model->eval_cedis_cla_sec($var,$prv);
        $data['js'] = 'evaluacion/eval_cedis_cla_sec_js';
        $this->load->view('main', $data);
    }
    function eval_cedis_producto($var)
    {
        
        $data['titulo'] = "NIVEL DE SURTIDO POR CLASIFICACION ".$var ;
        $data['var'] = $var;
        $data['q'] = $this->Evaluacion_model->eval_cedis_producto($var);
        $data['js'] = 'catalogos/descontin_js';
        $this->load->view('main', $data);
    } 
    function eval_cedis_compra()
    {
        
        ini_set('memory_limit', '5000M');
        set_time_limit(0);
        $data['titulo1'] = "PRE-ORDEN TODOS LOS PRODUCTOS ACTIVOS";
        $data['titulo2'] = "PRE-ORDEN SOLO CEROS EN ALMACEN";
        $data['titulo3'] = "PRE-ORDEN POR PROVEDOR";
        $data['titulo4'] = "PRE-ORDEN SOLO SECUENCIAS";
        $data['prv']=$this->catalogos_model->busca_prv_indicado_cedis_t();
        
        $data['por1'] = $this->catalogos_model->busca_ord_dias_1();
        $data['por2'] = $this->catalogos_model->busca_ord_dias_1();
        $data['por3'] = $this->catalogos_model->busca_ord_dias_1();
        $data['por4'] = $this->catalogos_model->busca_ord_dias_1();
        $data['por5'] = $this->catalogos_model->busca_ord_dias_1();
        $this->load->view('main', $data);
        
    }
    function eval_cedis_compra_dias()
    {
        $por1=$this->input->post('por1');
        $por2=$this->input->post('por2');
        $por3=$this->input->post('por3');
        $por4=$this->input->post('por4');
        $por5=$this->input->post('por5');
        $var=$this->input->post('var');
        $prv=$this->input->post('prv');
        $sec=$this->input->post('sec');
        if($sec==null){$sec=0;}
        if($prv=='Array'){$prv=0;}
        
        $data['por1']=$por1;
        $data['por2']=$por2;
        $data['por3']=$por3;
        $data['por4']=$por4;
        $data['por5']=$por5;
        $data['var']=$var;
        $data['sec']=$sec;
        $data['prv']=$prv;
        $data['a'] ='CLASIFICACION "A" <br />'.$por1.' DIAS';
        $data['b'] ='CLASIFICACION "B" <br />'.$por2.' DIAS';
        $data['c'] ='CLASIFICACION "C" <br />'.$por3.' DIAS';
        $data['d'] ='CLASIFICACION "D" <br />'.$por4.' DIAS';
        $data['e'] ='CLASIFICACION "E" <br />'.$por5.' DIAS';
        $data['titulo2'] = 'Evaluacion a compra por clasificacion global';
        $data['titulo1'] = 'Evaluacion a compra por clasificacion por proveedor';
        $data['titulo'] = 'Evaluacion a compra por clasificacion a detalle';
        $data['q2'] = $this->Evaluacion_model->eval_cedis_compra_par_glo($por1,$por2,$por3,$por4,$por5,$var,$prv,$sec);
        $data['q1'] = $this->Evaluacion_model->eval_cedis_compra_par_prv($por1,$por2,$por3,$por4,$por5,$var,$prv,$sec);
        $data['q'] = $this->Evaluacion_model->eval_cedis_compra_par($por1,$por2,$por3,$por4,$por5,$var,$prv,$sec);
        
        $data['js'] = 'evaluacion/eval_cedis_compra_dias_js';
        $this->load->view('main', $data);
    }
    function eval_cedis_graba($por1,$por2,$por3,$por4,$por5,$var,$prv,$sec)
    {   
        $replaced = str_replace("-",",",$sec);
        $this->Evaluacion_model->eval_cedis_compra_par_genera($por1,$por2,$por3,$por4,$por5,$var,$prv,$replaced);
        redirect('Evaluacion/eval_cedis');
        
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////
    function eval_cedis_pro()
    {
        $data['titulo'] = "NIVEL DE SURTIDO EN CEDIS";
        $data['q'] = $this->Evaluacion_model->eval_cedis_pro();
        $data['js'] = 'evaluacion/eval_cedis_pro_js';
        $this->load->view('main', $data);
    }
    
    function s_productos_eval()
    {
        
        $data['query'] = $this->Evaluacion_model->eval_cedis_pro_excel();
        $this->load->view('excel/s_productos_doctor_ahorro', $data);
    }
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
    function s_evaluacion_nac()
   {
    
        $data['q1'] = $this->Evaluacion_model->evaluacion_rentas();
        $data['q2'] = $this->Evaluacion_model->evaluacion_ventas_costo();
        $data['q3'] = $this->Evaluacion_model->evaluacion_nominas();
        $data['q4'] = $this->Evaluacion_model->evaluacion_nominas_det();
        $data['q5'] = $this->Evaluacion_model->evaluacion_porce();
        $this->load->view('excel/s_evaluacion_nac', $data);
   }
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
  
}
