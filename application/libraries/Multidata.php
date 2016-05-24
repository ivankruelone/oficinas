<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Multidata
{
    private $arr;
    private $categoriasMain;
    
    public function __construct()
    {
        $this->arr = array();
    }
    
    public function agrega($categorias, $nombreSerie1 = null, $serie1 = null, $nombreSerie2 = null, $serie2 = null, $nombreSerie3 = null, $serie3 = null)
    {
        $a = array();
        
        $i = 0;
        foreach($categorias as $categoria)
        {
            $a['categories'][0]['category'][$i]['label'] = $categoria;
            $i++;
        }
        
        $this->arr = $a;
        
        if(is_array($serie1) && $serie1 != null)
        {
            $b = array();
            $i = 0;
            foreach($serie1 as $s1)
            {
                $b['dataset'][0]['seriesname'] = $nombreSerie1;
                $b['dataset'][0]['data'][$i]['value'] = $s1;
                $i++;
            }
        }
        
        if(is_array($serie2) && $serie2 != null)
        {
            $i = 0;
            foreach($serie2 as $s2)
            {
                $b['dataset'][1]['seriesname'] = $nombreSerie2;
                $b['dataset'][1]['data'][$i]['value'] = $s2;
                $i++;
            }
            
        }
        
        if(is_array($serie3) && $serie3 != null)
        {
            $i = 0;
            foreach($serie3 as $s3)
            {
                $b['dataset'][2]['seriesname'] = $nombreSerie3;
                $b['dataset'][2]['data'][$i]['value'] = $s3;
                $i++;
            }
            
        }

        $this->arr = array_merge($this->arr, $b);
        
    }
    
    function retorno()
    {
        return $this->arr;
    }
}