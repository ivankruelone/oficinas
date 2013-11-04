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
        
        $data['tit']= $this->session->userdata('nombre');
        $data['titulo']= 'Maximo generado por producto '.$varx;
        $data['a'] = $this->desplazamientos_model->control_desplaza_suc_una($var,$suc);
        $data['js'] = 'desplazamientos/clasificacion_nid_suc_js';
        $this->load->view('main', $data);
    }    
  
    
}
