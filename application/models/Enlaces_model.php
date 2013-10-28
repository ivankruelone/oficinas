<?php
class Enlaces_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function getInventarioAguascalientes()
    {
        $url = "http://fenixags.redirectme.net/fenixsp/nusoap/servicios/prueba_enlace.php";
        $file_headers = @get_headers($url);
        $str = file_get_contents($url);
        $xml =  simplexml_load_string(utf8_decode($str));
        
        
        $a = array();
        
        foreach($xml as $r)
        {
            $b = array(
                    'aaa' => (integer)$xml->attributes()->anio,
                    'mes' => (integer)$xml->attributes()->mes,
                    'suc' => (integer)$xml->attributes()->sucursal,
                    'clave' => (string)$r->attributes()->clave,
                    'descripcion' => (string)$r->attributes()->descripcion,
                    'piezas' => (integer)$r->attributes()->inv,
                    'costo' => 0,
                    'lin' => (integer)$r->attributes()->tipo
                
                );
                
            array_push($a, $b);
        }
        
        $this->db->insert_batch('oficinas.inv_seguros', $a);
        
    }

}
