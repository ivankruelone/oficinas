<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proveedor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('maestro_model');
        $this->load->model('proveedor_model');
        $this->load->model('Catalogos_model');
        

    }

    function muestra_proveedor()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "PROVEEDOR";
        $data['s'] = $this->maestro_model->consulta_proveedor();
        $data['js'] = 'proveedor/muestra_proveedor_js';
        $this->load->view('main', $data);
    }

    function captura_proveedor()
    {
        $data['titulo'] = "";
        $this->load->view('main', $data);
    }

    function submit_proveedor()
    {
        $this->load->model('maestro_model');
        $id = $this->maestro_model->captura_proveedor();
        redirect('proveedor/muestra_proveedor/' . $idProveedor);
    }

    public function editar_proveedor($idProveedor)
    {
        $data['titulo'] = 'Editar Proveedor';
        $data['idProveedor'] = $idProveedor;
        $data['row'] = $this->maestro_model->getProveedor($idProveedor);

        $this->load->view('main', $data);
    }

    public function actualiza_proveedor()
    {
        $idProveedor = $this->input->post('idProveedor');
        $rfc = $this->input->post('rfc');
        $razonSocial = $this->input->post('razonSocial');
        $limiteCredito = $this->input->post('limiteCredito');
        $this->load->model('maestro_model');
        $this->maestro_model->actualiza_model_proveedor($idProveedor, $rfc, $razonSocial,
            $limiteCredito);
        redirect('proveedor/muestra_proveedor');
    }
   
   
    function a_eval_prv()
   {
        $data['titulo'] = "Evaluacion de provedor por orden";
        $data['js'] = 'proveedor/a_eval_prv_js';
        $this->load->view('main', $data);
    }
    function a_evaluacion_prv()
   {
        $fec1=$this->input->post('fec1');
        $fec2=$this->input->post('fec2');
        $data['fec1'] = $fec1;
        $data['fec2'] = $fec2;
        $data['titulo'] = "Evaluacion de provedor por orden del $fec1 al $fec2";
        $data['q'] = $this->proveedor_model->evaluacion_proveedor($fec1,$fec2);
        $data['js'] = 'proveedor/a_evaluacion_prv_js';
        $this->load->view('main', $data);
    }
    function a_evaluacion_prv_det($prv,$fec1,$fec2)
   {
        $data['titulo'] = "Evaluacion de provedor por orden del $fec1 al $fec2";
        $data['titulo1'] = "EVALUACI&Oacute;N A PROVEEDORES";
        $data['fec1'] = $fec1;
        $data['fec2'] = $fec2;
        $data['prv'] = $prv;
        $data['q1'] = $this->Catalogos_model->busca_eval_prv();
        $data['q'] = $this->proveedor_model->evaluacion_proveedor_det($prv,$fec1,$fec2);
        $data['js'] = 'proveedor/a_evaluacion_prv_det_js';
        $this->load->view('main', $data);
    }
    function a_evaluacion_prv_aplicar($prv,$fec1,$fec2)
   {
        $data['fec1'] = $fec1;
        $data['fec2'] = $fec2;
        $data['prv'] = $prv;
        $data['uno'] = $this->Catalogos_model->busca_eval_prv_valor();
        $data['tres'] = $this->Catalogos_model->busca_eval_prv_valor();
        $data['seis'] = $this->Catalogos_model->busca_eval_prv_valor();
        $data['titulo'] = "Evaluacion de provedor por orden del $fec1 al $fec2";
        $data['titulo1'] = "EVALUACI&Oacute;N A PROVEEDORES";
        $data['q1'] = $this->Catalogos_model->busca_eval_prv();
        $data['q'] = $this->proveedor_model->evaluacion_proveedor_det($prv,$fec1,$fec2);
        $data['js'] = 'proveedor/a_evaluacion_prv_det_js';
        $this->load->view('main', $data);
    }
    
    function sumit_evaluacion_prv()
    {
     $prv = $this->input->post('prv');
     $fec1 = $this->input->post('fec1');
     $fec2 = $this->input->post('fec2');
     $uno = $this->input->post('uno');
     $dos = $this->input->post('dos');
     $tres = $this->input->post('tres');
     $cuatro = $this->input->post('cuatro');
     $cinco = $this->input->post('cinco');
     $seis = $this->input->post('seis');
     $siete = $this->input->post('siete');
     $siete_p = $this->input->post('siete_p');
     $ocho = $this->input->post('ocho');
     $ocho_p = $this->input->post('ocho_p');
     $nueve_p = $this->input->post('nueve_p');
     if($siete =null){$siete=0;}if($ocho =null){$ocho=0;}//id_evalua, fec1, fec2, prv, id_user
     $this->proveedor_model->graba_evaluacion($fec1,$fec2,$prv,$uno,$dos,$tres,$cuatro,$cinco,$seis,$siete,$siete_p,$ocho,$ocho_p,$nueve_p);
     
     die();   
    }

}
