<?php
class Grafica extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function fuente($titulo, $subtitulo, $ejex, $ejey, $colores, $muestraValores, $datos)
    {
        $a = array();
        $a['chart']['caption'] = $titulo;
        $a['chart']['subcaption'] = $subtitulo;
        $a['chart']['xaxisname'] = $ejex;
        $a['chart']['yaxisname'] = $ejey;
        $a['chart']['palette'] = $colores;
        $a['chart']['animation'] = 1;
        $a['chart']['formatnumberscale'] = 0;
        $a['chart']['showvalues'] = $muestraValores;
        $a['chart']['plotspacepercent'] = 0;
        $a['chart']['showBorder'] = 0;
        $a['data'] = $datos;
        
        return $a;
    }
    
    function multi($titulo, $subtitulo, $ejex, $ejey, $colores, $muestraValores, $datos)
    {
        $a = array();
        $a['chart']['caption'] = $titulo;
        $a['chart']['subcaption'] = $subtitulo;
        $a['chart']['xaxisname'] = $ejex;
        $a['chart']['yaxisname'] = $ejey;
        $a['chart']['palette'] = $colores;
        $a['chart']['animation'] = 1;
        $a['chart']['formatnumberscale'] = 0;
        $a['chart']['showvalues'] = $muestraValores;
        $a['chart']['plotspacepercent'] = 0;
        $a['chart']['showBorder'] = 0;
        
        return array_merge($a, $datos);
    }

    function chart($tipo, $destino, $ancho, $alto, $fuente)
    {
        $arr = array('type' => $tipo, 'renderAt' => $destino, 'width' => $ancho, 'height' => $alto, 'dataFormat' => 'json', 'dataSource' => $fuente);
        return json_encode($arr);
    }
    
}