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
        $this->load->model('Catalogos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
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
    function inventario()
    {
    $aaa=2013; $mes=10;
    $this->procesos_model->inventario($aaa,$mes);
        
    }
    function maximo_por_igual()
    {
    $clave=908;
    $this->procesos_model->max_por($clave);
    }
       
    
}
