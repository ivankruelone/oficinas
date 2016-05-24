<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Element
 *
 * Lets you determine whether an array index is set and whether it has a value.
 * If the element is empty it returns FALSE (or whatever you specify as the default value.)
 *
 * @access	public
 * @param	string
 * @param	array
 * @param	mixed
 * @return	mixed	depends on what the array contains
 */
if ( ! function_exists('getMesNombre'))
{
	function getMesNombre($mes)
	{
		$mes = $mes * 1;
        
        $a = array(
            '1' => "ENERO",
            '2' => "FEBRERO",
            '3' => "MARZO",
            '4' => "ABRIL",
            '5' => "MAYO",
            '6' => "JUNIO",
            '7' => "JULIO",
            '8' => "AGOSTO",
            '9' => "SEPTIEMBRE",
            '10' => "OCTUBRE",
            '11' => "NOVIEMBRE",
            '12' => "DICIEMBRE"
        );
        
        return $a[$mes];
	}
}
