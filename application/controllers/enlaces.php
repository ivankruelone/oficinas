<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Enlaces extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('enlaces_model');

    }

    function index()
    {
        $this->enlaces_model->getInventarioAguascalientes();
        //$this->enlaces_model->getInventarioFresnillo();
        //$this->enlaces_model->getInventarioSucursalesZacatecas();
        $this->enlaces_model->getInventarioSucursalesAguascalientes();
        $this->enlaces_model->getCostos();
    }
    
    function fresnillo()
    {
        $this->enlaces_model->getInventarioFresnillo();
    }

    function zacatecas()
    {
        $this->enlaces_model->getInventarioSucursalesZacatecas();
    }
    
    function aguascalientes()
    {
        $this->enlaces_model->getInventarioSucursalesAguascalientes();
    }
    
    function agsretail()
    {
        $this->enlaces_model->getInventarioSucursalesAguascalientes();
    }
}
