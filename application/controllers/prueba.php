<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prueba extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('Ventas_model');
        $this->load->model('Catalogos_model');
        $this->load->model('Evaluacion_model');
        $this->load->model('grafica');

    }

    function generaExcel()
    {
        set_time_limit(0);
        ini_set("memory_limit", "-1");
        $this->load->library('excel');
        $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
        if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
            die($cacheMethod . " caching method is not available" . EOL);
        }

        $this->excel->createSheet(0);
        $this->excel->setActiveSheetIndex(0);

        $filename = $this->uri->segment(2) . '_' . date('Ymd_his') . '.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache

        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }

    function chart()
    {
        $this->load->library('data');
        
        $a = new Data();
        $a->agregaData('uno', 100);
        $a->agregaData('dos', 120);
        $a->agregaData('tres', 100);
        $a->agregaData('cuatro', 180);
        $a->agregaData('cinco', 130);
        $a->agregaData('seis', 105);
        $a->agregaData('siete', 160);
        
        $fuente = $this->grafica->fuente('Ventas comparativas', utf8_encode('Año 2015'), 'Meses', '$ Pesos', 2, 1, $a->retornaData());
        $data['json'] = $this->grafica->chart('column3d', 'chart', '500', '300', $fuente);
        

        $data['tit']='Chart';
        $data['js'] = 'prueba/chart_js';
        $this->load->view('main', $data);
    }
    
    function chart2()
    {
        $this->load->library('Multidata');
        
        $cat = array('Enero', 'Febrero');
        $arregloA = array('100', '200');
        $arregloB = array('1000', '2000');
        $arregloC = array('10000', '20000');
        
        
        $a = new Multidata();
        $a->agrega($cat, '2014', $arregloA, '2015', $arregloB, '2016', $arregloC);
        
        $fuente = $this->grafica->multi('Ventas comparativas', utf8_encode('Año 2015'), 'Meses', '$ Pesos', 2, 1, $a->retorno());
        $data['json'] = $this->grafica->chart('msline', 'chart', '800', '600', $fuente);
        

        $data['tit']='Chart';
        $data['js'] = 'prueba/chart_js';
        $this->load->view('main', $data);

    }
    
    function data()
    {
        $json = '{
        "type": "column3d",
        "renderAt": "chart",
        "width": "500",
        "height": "300",
        "dataFormat": "json",
        "dataSource": {
    "chart": {
        "caption": "Number of participants",
        "subcaption": "By age",
        "xaxisname": "Age group",
        "yaxisname": "# Participants",
        "palette": "2",
        "animation": "1",
        "formatnumberscale": "0",
        "showvalues": "0",
        "plotspacepercent": "0",
        "showBorder": "0"
    },
    "data": [
        {
            "label": "25-30",
            "value": "45"
        },
        {
            "label": "30-35",
            "value": "34"
        },
        {
            "label": "35-40",
            "value": "39"
        },
        {
            "label": "40-45",
            "value": "21"
        },
        {
            "label": "45-50",
            "value": "17"
        },
        {
            "label": "50-55",
            "value": "14"
        },
        {
            "label": "55-60",
            "value": "11"
        },
        {
            "label": "60+",
            "value": "9"
        }
    ]
}
    }';
    
        $arr = json_decode($json, true);
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        
        $this->load->library('data');
        
        $a = new Data();
        $a->agregaData('uno', 100);
        $a->agregaData('dos', 120);
        
        $fuente = $this->grafica->fuente('Ventas comparativas', 'Año 2015', 'Meses', '$ Pesos', 1, 1, $a->retornaData());
        $json = $this->grafica->chart('column3d', 'chart', '500', '300', $fuente);
        echo $json;
    }
    
    function dos()
    {
        $json = '{
    "chart": {
        "caption": "Sales - 2012 v 2013",
        "numberprefix": "$",
        "plotgradientcolor": "",
        "bgcolor": "FFFFFF",
        "showalternatehgridcolor": "0",
        "divlinecolor": "CCCCCC",
        "showvalues": "0",
        "showcanvasborder": "0",
        "canvasborderalpha": "0",
        "canvasbordercolor": "CCCCCC",
        "canvasborderthickness": "1",
        "yaxismaxvalue": "30000",
        "captionpadding": "30",
        "linethickness": "3",
        "yaxisvaluespadding": "15",
        "legendshadow": "0",
        "legendborderalpha": "0",
        "palettecolors": "#f8bd19,#008ee4,#33bdda,#e44a00,#6baa01,#583e78",
        "showborder": "0"
    },
    "categories": [
        {
            "category": [
                {
                    "label": "Jan"
                },
                {
                    "label": "Feb"
                },
                {
                    "label": "Mar"
                },
                {
                    "label": "Apr"
                },
                {
                    "label": "May"
                },
                {
                    "label": "Jun"
                },
                {
                    "label": "Jul"
                },
                {
                    "label": "Aug"
                },
                {
                    "label": "Sep"
                },
                {
                    "label": "Oct"
                },
                {
                    "label": "Nov"
                },
                {
                    "label": "Dec"
                }
            ]
        }
    ],
    "dataset": [
        {
            "seriesname": "2013",
            "data": [
                {
                    "value": "22400"
                },
                {
                    "value": "24800"
                },
                {
                    "value": "21800"
                },
                {
                    "value": "21800"
                },
                {
                    "value": "24600"
                },
                {
                    "value": "27600"
                },
                {
                    "value": "26800"
                },
                {
                    "value": "27700"
                },
                {
                    "value": "23700"
                },
                {
                    "value": "25900"
                },
                {
                    "value": "26800"
                },
                {
                    "value": "24800"
                }
            ]
        },
        {
            "seriesname": "2012",
            "data": [
                {
                    "value": "10000"
                },
                {
                    "value": "11500"
                },
                {
                    "value": "12500"
                },
                {
                    "value": "15000"
                },
                {
                    "value": "16000"
                },
                {
                    "value": "17600"
                },
                {
                    "value": "18800"
                },
                {
                    "value": "19700"
                },
                {
                    "value": "21700"
                },
                {
                    "value": "21900"
                },
                {
                    "value": "22900"
                },
                {
                    "value": "20800"
                }
            ]
        }
    ]
}';
        
        $arr = json_decode($json);
        
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        
        
        $this->load->library('Multidata');
        
        $cat = array('Enero', 'Febrero');
        $arregloA = array('100', '200');
        $arregloB = array('1000', '2000');
        $arregloC = array('10000', '20000');
        
        $a = new Multidata();
        $a->agrega($cat, '2014', $arregloA, '2015', $arregloB, '2016', $arregloC);
        
        echo "<pre>";
        print_r($a->retorno());
        echo "</pre>";
        
        echo json_encode($a->retorno());

    }
    
    function redondeo ()
    {
    //$num = 2364893.6316589;
    //echo substr($num,5,2); 
    $number = 2364893.6316589;
    $digitos = 3; 
    $raiz = 10;
    $multiplicador = pow ($raiz,$digitos);
    $resultado = ((int)($number * $multiplicador)) / $multiplicador;
    echo number_format($resultado, $digitos); 
        
    }
    
    
    function trun($numero, $decimales)
    {
    $numero = 2364893.631658923;
    $decimales = 3;
    $exp=pow(10, $decimales);
    $n=floor($numero*$exp);
    //echo $n/$exp;
    echo number_format($n/$exp,3);
    } 


}
