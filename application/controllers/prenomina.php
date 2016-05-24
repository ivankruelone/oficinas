<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prenomina extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('prenomina_model');
        $this->load->model('Catalogos_model');
        

    }
    
    function a_prenomina_captura()
    {
        $data['titulo'] = "Captura de Movimientos";
        $data['clave']=$this->prenomina_model->busca_mov_prenomina();
        //$data['q']=$this->backoffice_model->fac_central();
        $this->load->view('main', $data);
    }
    function busca_empleado_sucursal()
    {
         $suc = $this->input->post('suc');
         echo $this->prenomina_model->busca_empleado_succ($suc);        
    } 
    function a_prenomina_captura_clave()
    {
        $clave=$this->input->post('clave');
        $q=$this->prenomina_model->busca_mov_prenomina_una($clave);
        $r=$q->row();
        $nombre=$r->nombre;
        $data['titulo'] = $nombre;
        $data['clave'] = $clave;
        $data['suc'] = $this->prenomina_model->busca_suc_prenom();
        if($clave==333){
            $data['fec'] = $this->prenomina_model->busca_fec_prima_dominical();
        }elseif($clave==331){
            $data['fec'] = $this->prenomina_model->busca_festivo();
        }else{
            $date['fec']=date('Y-m-d');
        }
        $data['js'] = 'prenomina/a_prenomina_captura_clave_js';
        $this->load->view('main', $data);
        
    }
    function sumit_prenomina_mov()
    {
        $fec=$this->input->post('fec');
        $clave=$this->input->post('clave');
        $id_cat=$this->input->post('id_cat');
        $dias=$this->input->post('dias');
        $monto=$this->input->post('monto');
        $fecpre=$this->input->post('fecpre');
        $fol=$this->input->post('fol');
        $this->prenomina_model->agrega_mov_prenomina($fec,$clave,$id_cat,$dias,$monto,$fecpre,$fol);
        
        
    }
        
 
 
}
