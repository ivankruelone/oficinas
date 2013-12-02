<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Procesos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('procesos_model');
        $this->load->model('enlaces_model');
        $this->load->model('Catalogos_model');
        $this->load->model('archivos_externos_model');
        $this->load->model('Envio_model_as400_fin');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    function ims()
    {
    $data['titulo'] = "Informacion de IMS";    
    $this->load->view('main', $data);
    }
    function genera_ims()
    {
    ini_set('memory_limit','2000M');
    set_time_limit(0);
    $this->archivos_externos_model->genera_ims_e($this->input->post('fec1'),$this->input->post('fec2'));
    }
    
    
    function facturas_oficinas()
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit']='Reporte de inventario';
        $data['a'] = $this->procesos_model->facturas_oficinas();
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    function facturas_pdv()
    {
    $this->procesos_model->facturas_pdv();
        
    }
    function pro_inv()
    {
    $data['titulo'] = "Genera inventario";
    $data['q'] = $this->procesos_model->ver_inv();
    $data['a'] = $this->procesos_model->ver_inv_suc();
    $data['b'] = $this->procesos_model->ver_inv_suc_his();
    $data['js'] = 'procesos/pro_inv_js';
    $this->load->view('main', $data);
    }
    function genera_inv()
    {
        $this->enlaces_model->getInventarioAguascalientes();
        $this->enlaces_model->getInventarioFresnillo();
        $this->enlaces_model->getInventarioSucursalesZacatecas();
        $this->enlaces_model->getInventarioSucursalesAguascalientes();
        $this->enlaces_model->getCostos();
    die();
    $aaa=substr($this->input->post('fecha'),0,4);
    $mes=substr($this->input->post('fecha'),5,2);
    $dia=substr($this->input->post('fecha'),8,2);
    $sem=$this->input->post('sem');
    $this->procesos_model->genera_inv($aaa,$mes,$dia,$sem);
     redirect('procesos/pro_inv');
    }
    function respalda_inv($aaa,$mes,$dia)
    {
    $this->procesos_model->respalda_inv($aaa,$mes,$dia);
    redirect('procesos/pro_inv');   
    }
    function maximo_por_igual()
    {
    $clave=908;
    $this->procesos_model->max_por($clave);
    }
    
    function pro_ent_sal()
    {
    $data['titulo'] = "Entradas y salidas";
    $data['q'] = $this->procesos_model->ver_ent_sal();
    $data['js'] = 'procesos/pro_inv_js';
    $this->load->view('main', $data);
    }
    function ent_sal()
    {
    $fec1=$this->input->post('fec1');
    $fec2=$this->input->post('fec2');
    $sem=$this->input->post('sem');
    $this->procesos_model->ent_sal($fec1,$fec2,$sem);
    redirect('procesos/pro_ent_sal');
    }
    function borrar_ent_sal($sem,$fec1)
    {
    $this->db->delete('oficinas.sem_ent_sal', array('sem' => $sem,'fec1'=>$fec1));
    redirect('procesos/pro_ent_sal');
    }
    function p_ent_sal($sem,$fec1)
    {
    $data['titulo'] = "Entradas y salidas";
    $data['q'] = $this->procesos_model->p_ent_sal($sem,$fec1);
    $data['js'] = 'procesos/pro_inv_js';
    $this->load->view('main', $data);
    }
    
    function desplaza_segpop()
    {
    $this->procesos_model->desplazamientos();
        
    }
    
}
