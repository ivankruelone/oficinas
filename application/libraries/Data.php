<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data
{
    private $arr;
    
    public function __construct()
    {
        $this->arr = array();
    }
    
    public function agregaData($etiqueta, $valor)
    {
        $b = array('label' => $etiqueta, 'value' => $valor);
        array_push($this->arr, $b);
    }
    
    public function retornaData()
    {
        return $this->arr;
    }

}