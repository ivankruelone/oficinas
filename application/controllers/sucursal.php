<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sucursal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('maestro_model');
        $this->load->model('Catalogos_model');

    }
    
     function muestra_sucursal()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "SUCURSAL";
        $data['s'] = $this->maestro_model->consulta_sucursal();
        $this->load->view('main', $data);
    }
    
    function muestra_sucursal_excel()
    {
        $data['query'] = $this->maestro_model->getSucursalAll();
        $this->load->view('excel/muestra_sucursal_excel', $data);
    }
    
    function farmacia_tipo($tipo)
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "SUCURSAL";
        $data['tipo']= $tipo;
        $data['nombre']= $this->maestro_model->getNombreImagen($tipo);
        $data['s1'] = $this->maestro_model->farmacia_tipo_clasificacion($tipo, 1);
        $data['s2'] = $this->maestro_model->farmacia_tipo_clasificacion($tipo, 2);
        $data['js'] = 'sucursal/farmacia_tipo_js';
        $this->load->view('main', $data);
    }
    
    public function edita_brick($suc)
    {
        $data['suc']= $suc;
        $data['nombre']= $this->maestro_model->getNombreSucursal($suc);
        $data['titulo'] = 'Editar Brick';
        $data['contenido'] = 'sucursal/edita_brick';
        $data['suc'] = $suc;
        //$data['brick1300'] = $brick1300;

        $this->load->view('main', $data);
    }

    public function actualiza_brick()
    {
        $suc = $this->input->post('suc');
        $brick1300 = $this->input->post('brick1300');
        $this->load->model('maestro_model');
        $this->maestro_model->actualiza_model_brick1300($suc, $brick1300);
        redirect('sucursal/muestra_sucursal'); 
    }
    
    function clasificacion()
    {
        $data['tipo']=$this->Catalogos_model->busca_imagen();
        $data['mes']=$this->Catalogos_model->busca_mes();
        $data['tit']='Selecciona farmacia y mes';
        $this->load->view('main', $data);
    }

    
    function generaClasificacion()
    {
        $mes = $this->input->post('mes');
        $tipo = $this->input->post('tipo');
        $data['res'] = $this->maestro_model->get8020($mes, $tipo);
        $data['tit']='Resultado de la clasificacion';
        //$this->load->view('main', $data);
        redirect('sucursal/muestra_sucursal');
    }
    
    function clasificacion_suc()
    {
        $data['suc']=$this->Catalogos_model->busca_suc_clasifica();
        $data['mes']=$this->Catalogos_model->busca_mes();
        $data['tit']='Selecciona Sucursal y mes';
        $this->load->view('main', $data);
        echo $this->db->last_query();
        die ();
    }
    
   
    function mas_vendidos_precio($suc)
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "1000 MAS VENDIDOS POR PRECIO";
        $data['suc']= $suc;
        $data['nombre']= $this->maestro_model->getNombreSucursal($suc);
        $data['s'] = $this->maestro_model->mas_vendidos_precio($suc);
        $data['js'] = 'sucursal/mas_vendidos_precio_js';
        $this->load->view('main', $data);
    }
    
    function mas_vendidos_pieza($suc)
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "1000 MAS VENDIDOS POR PIEZA";
        $data['suc']= $suc;
        $data['nombre']= $this->maestro_model->getNombreSucursal($suc);
        $data['s'] = $this->maestro_model->mas_vendidos_pieza($suc);
        $data['js'] = 'sucursal/mas_vendidos_pieza_js';
        $this->load->view('main', $data);
    }

}