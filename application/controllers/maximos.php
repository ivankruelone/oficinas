<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Maximos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('maximos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
    function genericos()
    {
        $data['titulo'] = "Catalogo de Genericos";
        $data['a'] = $this->catalogos_model->genericos();
        $data['js'] = 'catalogos/genericos_js';
        $this->load->view('main', $data);
    }
    
    function genera_maximo_sucursales()
    {
        set_time_limit(0);
        $sucursales = $this->maximos_model->getSucursales();
        
        foreach($sucursales->result() as $s)
        {
            $this->genera_maximo_sucursal($s->suc);
        }
    }
    
    private function genera_maximo_sucursal($sucursal = 958)
    {
        
        $datos = $this->maximos_model->getDatos($sucursal);
        
        $sql = "INSERT INTO vtadc.temp_maximo (suc, secuencia, maximo) VALUES ";
        
        
        $a = null;
        
        foreach($datos->result() as $d)
        {
            $a .= "($d->suc, $d->secuencia, $d->maximo),";
        }
        
        $a = substr($a, 0, -1);
        
        $sql = $sql . $a ." ON DUPLICATE KEY UPDATE maximo = VALUES(maximo);";
        
        $this->db->query($sql);
        
    }
    
    function generar_tablas($perini = '2013-07-01', $perfin = '2013-09-30')
    {
        $this->maximos_model->generarTablas($perini, $perfin);
        $this->genera_index();
    }
    
    function genera_index()
    {
        $this->maximos_model->generaIndice();
    }
    
    
    
}
