<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Retail extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('retail_model');
    }
    
    function catalogoEdomex2014()
    {
        $edomex = $this->load->database('edomex', TRUE);
        $query = $this->db->get('retail.cat_edomex_2013');
        
        foreach($query->result() as $row)
        {
            $data = array(
                'renglon'       => $row->renglon,
                'clave'         => $row->clave,
                'descripcion'   => $row->descripcion,
                'presentacion'  => $row->presentacion,
                'precio2013'    => $row->precio,
                'precio2014'    => $row->precio2014
                );
            
            $edomex->insert('catalogo', $data);
        }
        
        
        
    }
    
    
    public function import_edomex($suc = 3265, $perini = '2014-02-16', $perfin = '2014-02-28')
    {
        
       $this->retail_model->cargar_datos_receta($suc, $perini, $perfin);
       
       
    }
       
       
    public function import_michoacan($perini = '2014-01-01', $perfin = '2014-08-15')
    {
        
       $this->retail_model->cargar_datos_receta_michoacan($perini, $perfin);
       
       
    }

    public function import_michoacan_json($perini = '2014-01-01', $perfin = '2014-08-15', $suc = 12125, $programa = 0, $suministro = 0, $control = 0, $requerimiento = 1)
    {
        
       $this->retail_model->cargar_datos_receta_michoacan_json($perini, $perfin, $suc, $programa, $suministro, $control, $requerimiento);
       
       
    }

    public function import_michoacan_remision_json($remision, $control)
    {
        
       $this->retail_model->cargar_datos_receta_michoacan_remision_json($remision, $control);
       
       
    }

    public function import_edomex_remision_json($remision, $control, $tipo)
    {
        
       $this->retail_model->cargar_datos_receta_edomex_remision_json($remision, $control, $tipo);
       
       
    }

    public function get_michoacan_json($perini = '2014-01-01', $perfin = '2014-08-15', $suc = 12125)
    {
        
       $this->retail_model->getDatosFromMichoacanJson($perini, $perfin, $suc);
       
       
    }
    
    public function get_michoacan_remision($remision)
    {
        
       $this->retail_model->getDatosFromMichoacanRemisionJson($remision);
       
       
    }

    public function get_edomex_remision($remision)
    {
        
       $this->retail_model->getDatosFromEdomexRemisionJson($remision);
       
       
    }

    function prueba1()
    {
        $sql = "select * from receta limit 100";
        $base = $this->load->database('bansefi', TRUE);
       
       $query = $base->query($sql)->result();
       
       echo "<pre>";
       
       print_r($query);
       
       echo "</pre>";

    }

}