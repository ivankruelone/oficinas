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
        $c = array();
        
        foreach($xml as $r)
        {
            $b = array(
                    'aaa' => date('Y'),
                    'mes' => date('m'),
                    'dia' => date('d'),
                    'suc' => (integer)$xml->attributes()->sucursal,
                    'clave' => (string)$r->attributes()->clave,
                    'descripcion' => (string)$r->attributes()->descripcion,
                    'piezas' => (integer)$r->attributes()->inv,
                    'costo' => 0,
                    'lin' => (integer)$r->attributes()->tipo,
                    'clave_sin_punto' => (string)(float)str_replace('.', '',(string)$r->attributes()->clave)
                
                );
                
            array_push($a, $b);
            $c[(integer)$xml->attributes()->sucursal] = (integer)$xml->attributes()->sucursal;
        }
        
        foreach($c as $d)
        {
            $this->db->delete('oficinas.inv_seguros', array('suc' => $d)); 
        }
        
        $this->db->insert_batch('oficinas.inv_seguros', $a);
        
    }

    function getInventarioFresnillo()
    {
        $url = "http://fenixzac.redirectme.net/fresnillo/nusoap/servicios/prueba_enlace.php";
        $file_headers = @get_headers($url);
        $str = file_get_contents($url);
        $xml =  simplexml_load_string(utf8_decode($str));
        
        
        $a = array();
        $c = array();
        
        foreach($xml as $r)
        {
            $b = array(
                    'aaa' => date('Y'),
                    'mes' => date('m'),
                    'dia' => date('d'),
                    'suc' => (integer)$xml->attributes()->sucursal,
                    'clave' => (string)$r->attributes()->clave,
                    'descripcion' => (string)$r->attributes()->descripcion,
                    'piezas' => (integer)$r->attributes()->inv,
                    'costo' => 0,
                    'lin' => (integer)$r->attributes()->tipo,
                    'clave_sin_punto' => (string)(float)str_replace('.', '',(string)$r->attributes()->clave)
                
                );
                
            array_push($a, $b);
            $c[(integer)$xml->attributes()->sucursal] = (integer)$xml->attributes()->sucursal;
        }
        
        foreach($c as $d)
        {
            $this->db->delete('oficinas.inv_seguros', array('suc' => $d)); 
        }
        
        $this->db->insert_batch('oficinas.inv_seguros', $a);
        
    }

    function getInventarioSucursalesZacatecas()
    {
        $url = "http://189.203.201.180/zacatecas/nusoap/servicios/inventario.php";
        $file_headers = @get_headers($url);
        $str = file_get_contents($url);
        $xml =  simplexml_load_string(utf8_encode($str));
        
        $a = array();
        $c = array();
        
        foreach($xml->producto as $r)
        {
            
            $b = array(
                    'aaa' => date('Y'),
                    'mes' => date('m'),
                    'dia' => date('d'),
                    'suc' => (integer)$r->suc,
                    'clave' => (string)$r->clave,
                    'descripcion' => (string)$r->descripcion,
                    'piezas' => (integer)$r->inv,
                    'costo' => 0,
                    'lin' => (integer)$r->tipo,
                    'piezas_paquete' => (integer)$r->inv,
                    'clave_sin_punto' => (string)$r->clave
                
                );
                
            array_push($a, $b);
            
            $c[(integer)$r->suc] = (integer)$r->suc;
        }
        
        
        foreach($c as $d)
        {
            $this->db->delete('oficinas.inv_seguros', array('suc' => $d)); 
        }
        
        $this->db->insert_batch('oficinas.inv_seguros', $a);
        
    }

    function getInventarioSucursalesAguascalientes()
    {
        $url = "http://189.203.201.185/aguascalientes/nusoap/servicios/inventario.php";
        $file_headers = @get_headers($url);
        $str = file_get_contents($url);
        $xml =  simplexml_load_string(utf8_encode(str_replace('&', '', $str)));
        
        $a = array();
        $c = array();
        
        foreach($xml->producto as $r)
        {
            
            $b = array(
                    'aaa' => date('Y'),
                    'mes' => date('m'),
                    'suc' => (integer)$r->suc,
                    'clave' => (string)$r->clave,
                    'descripcion' => (string)$r->descripcion,
                    'piezas' => (integer)$r->inv,
                    'costo' => 0,
                    'lin' => (integer)$r->tipo,
                    'piezas_paquete' => (integer)$r->inv,
                    'clave_sin_punto' => (string)$r->clave
                
                );
                
            array_push($a, $b);
            
            $c[(integer)$r->suc] = (integer)$r->suc;
        }
        
        
        foreach($c as $d)
        {
            $this->db->delete('oficinas.inv_seguros', array('suc' => $d)); 
        }
        
        $this->db->insert_batch('oficinas.inv_seguros', $a);
        
    }
    
    function getCostos()
    {
        $s = "update oficinas.inv_seguros a, catalogo.costos_gobierno b
set a.costo=b.costo,piezas_paquete= case when paquete>0 then paquete else a.piezas end
where a.clave_sin_punto=b.clave and a.aaa = " .date('Y'). " and a.mes = " .date('m'). " and a.dia = " .date('d'). ";";
        $this->db->query($s);
    }

}
