<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Juridico extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('juridico_model');
        $this->load->model('Catalogos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
    
  function rentas()
    {
        $data['titulo'] = "Rentas Actuales";
        $data['tit']='Concentrado de rentas';
        $data['q'] = $this->juridico_model->rentas();
        $data['js'] = 'juridico/rentas_js';
        $this->load->view('main', $data);
    }  
    
   function rentas_cerradas()
    {
        $data['titulo'] = "Rentas Actuales";
        $data['tit']='Concentrado de rentas';
        $data['q'] = $this->juridico_model->rentas_suc_cerradas();
        $data['js'] = 'juridico/rentas_js';
        $this->load->view('main', $data);
    } 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function s_rentas_propias()
    {
        $data['titulo1'] = "RELACION DE RENTAS DEL SR.JAVIER GONZALEZ TORRES EN MN";
        $data['titulo2'] = "RELACION DE RENTAS DEL SR.JAVIER GONZALEZ TORRES EN USD";
        $data['titulo3'] = "RELACION DE RENTAS DE INMOBILIARIAS";
        $data['tit']='Concentrado de rentas';
        $data['q'] = $this->juridico_model->rentas_propias_mn(1);
        $data['qq'] = $this->juridico_model->rentas_propias_usd(1);
        $data['qqq'] = $this->juridico_model->rentas_propias_mn(2);
        $data['js'] = 'juridico/s_rentas_propias_js';
        $this->load->view('main', $data);    
    }
    function s_rentas_propias_cia($cia,$rfc,$num)
    {
        $data['titulo'] = "RELACION DE RENTAS DEL SR.JAVIER GONZALEZ TORRES";
        $data['tit']='Concentrado de rentas';
        $data['q'] = $this->juridico_model->rentas_propias_cia($cia,$rfc,$num);
        $data['js'] = 'juridico/s_rentas_propias_js';
        $this->load->view('main', $data);    
    }
    
    
    
    
    function s_rentas_propias_grupo_cia($cia,$rfc,$num,$fecha_m,$pago)
    {
        $data['titulo'] = "RELACION DE RENTAS DEL SR.JAVIER GONZALEZ TORRES";
        $data['tit']='Concentrado de rentas';
        $data['q'] = $this->juridico_model->rentas_propias_grupo_cia($cia,$rfc,$num,$fecha_m,$pago);
        $data['js'] = 'juridico/s_rentas_propias_grupo_cia_js';
        $this->load->view('main', $data);    
    }
    function s_rentas_propias_grupo_cia_pago($id,$pago)
    {
        $data['titulo'] = "RELACION DE RENTAS DEL SR.JAVIER GONZALEZ TORRES";
        $data['tit']='Concentrado de rentas';
        $data['id'] = $id;
        $data['pago'] = $pago;
        $data['q'] = $this->juridico_model->rentas_propias_grupo_cia_pago($id);
        $data['js'] = 'juridico/s_rentas_propias_js';
        $this->load->view('main', $data);    
    }
    function s_rentas_propias_grupo_cia_pago_graba()
    {
        $a=array('ref_bancaria'=>$this->input->post('ref'),'cuenta'=>$this->input->post('cuenta'),'tipo_cambio'=>$this->input->post('dolar'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('oficinas.rentas_dueno',$a);
        redirect('juridico/s_rentas_propias_grupo_cia_pago/'.$this->input->post('id').'/'.$this->input->post('pago'));
            
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////Lic. Marysol Gonzalez
 function s_genera_rentas_dueno_his_aaa()
    {
        $data['titulo'] = "HISTORICO DE RENTAS";
        $data['tit']='Concentrado de rentas';
        $data['q'] = $this->juridico_model->rentas_dueno_his_aaa();
        $data['js'] = 'juridico/s_genera_rentas_dueno_js';
        $this->load->view('main', $data);    
    }
 
 function s_genera_rentas_dueno_his_mes($aaa)
    {
        $data['titulo'] = "HISTORICO DE RENTAS DEL ".$aaa;
        $data['tit']='Concentrado de rentas';
        $data['q'] = $this->juridico_model->rentas_dueno_his_mes($aaa);
        $data['js'] = 'juridico/s_genera_rentas_dueno_js';
        $this->load->view('main', $data);    
    }
  function s_genera_rentas_dueno_his_det($aaa,$mes)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "HISTORICO DE RENTAS DEL MES DE ".$mesx." DEL ".$aaa;
        $data['tit']='Concentrado de rentas';
        $data['q'] = $this->juridico_model->rentas_dueno_his_det($aaa,$mes);
        $data['js'] = 'juridico/s_genera_rentas_dueno_js';
        $this->load->view('main', $data);    
    } 
  
     ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////Contadores
 function s_genera_rentas_dueno_f()
    {
        $data['titulo'] = "HISTORICO DE RENTAS";
        $data['tit']='Concentrado de rentas';
        $data['q'] = $this->juridico_model->rentas_dueno_his_f();
        $data['js'] = 'juridico/s_genera_rentas_dueno_js';
        $this->load->view('main', $data);    
    }
  function s_genera_rentas_dueno($aaa)
    {
        $data['titulo'] = "Rentas Mensuale del ".$aaa;
        $data['tit']='Concentrado de rentas';
        $data['fec']=$this->Catalogos_model->busca_mes_renta_calendario();
        $data['q'] = $this->juridico_model->rentas_propias_mes($aaa);
        $data['js'] = 'juridico/s_genera_rentas_dueno_js';
        $this->load->view('main', $data);    
    }
  function s_genera_rentas_dueno_sumit()
    {
    $this->juridico_model->genera_rentas_dueno_sumit($this->input->post('fec'));
    redirect('juridico/s_genera_rentas_dueno');
    }
    
    function s_rentas_propias_grupo($fecha_m,$num,$pago)
    {
        $data['titulo'] = "Rentas propias del mes de ";
        $data['q'] = $this->juridico_model->rentas_propias_grupo($fecha_m,$num,$pago);
        $data['js'] = 'juridico/s_rentas_propias_grupo_js';
        $this->load->view('main', $data);    
    }
  
  
  
  
  
  
  
   
    
    
}
