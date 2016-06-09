<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Finanzas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('finanzas_model');
        $this->load->model('Catalogos_model');
        
    }
    
    
    
    function s_rentabilidad_farmacia()
    {
        $aaa=2015;
        $data['titulo1'] = "REPORTE DE RENTABILIDAD DE FARMACIAS  DOCTOR AHORRO SIN CREDITO, SIN RECARGAS Y SIN IVA";
        $data['titulo2'] = "REPORTE DE RENTABILIDAD DE FARMACIAS  FENIX SIN CREDITO, SIN RECARGAS Y SIN IVA";
        $data['titulo3'] = "REPORTE DE RENTABILIDAD DE FARMACIAS  FARMABODEGA SIN CREDITO, SIN RECARGAS Y SIN IVA";
        $data['q1'] = $this->finanzas_model->rentabilidad_farmacia($aaa,'DA');
        $data['q2'] = $this->finanzas_model->rentabilidad_farmacia($aaa,'FE');
        $data['q3'] = $this->finanzas_model->rentabilidad_farmacia($aaa,'Fa');
        $data['js'] = 'finanzas/s_rentabilidad_farmacia_js';
        $data['json1'] = $this->finanzas_model->rentabilidad_farmacia_grafica1($aaa,'DA','chart1');
        $data['json2'] = $this->finanzas_model->rentabilidad_farmacia_grafica2($aaa,'DA','chart2');
        $data['json3'] = $this->finanzas_model->rentabilidad_farmacia_grafica1($aaa,'FE','chart3');
        $data['json4'] = $this->finanzas_model->rentabilidad_farmacia_grafica2($aaa,'FE','chart4');
        $data['json5'] = $this->finanzas_model->rentabilidad_farmacia_grafica1($aaa,'FA','chart5');
        $data['json6'] = $this->finanzas_model->rentabilidad_farmacia_grafica2($aaa,'FA','chart6');
        $this->load->view('main', $data);
    }
    function s_rentabilidad_farmacia_det($aaa,$mes,$tipo)
    {
        $data['titulo1'] = "REPORTE DE RENTABILIDAD DE FARMACIAS ";
        $data['q1'] = $this->finanzas_model->rentabilidad_farmacia_det($aaa,$mes,$tipo);
        $data['js'] = 'finanzas/s_rentabilidad_farmacia_det_js';
        //$data['json1'] = $this->finanzas_model->rentabilidad_farmacia_grafica_det1($aaa,$mes,$tipo,'chart1');
        $this->load->view('main', $data);
    }
    function s_ventas_aaa6()
    {
        $data['v1']=date('Y')-5;
        $data['v2']=date('Y')-4;
        $data['v3']=date('Y')-3;
        $data['v4']=date('Y')-2;
        $data['v5']=date('Y')-1;
        $data['v6']=date('Y'); 
        $data['titulo1'] = "REPORTE DE VENTAS  DOCTOR AHORRO SIN CREDITO, SIN RECARGAS Y SIN IVA";
        $data['titulo2'] = "REPORTE DE VENTAS  FENIX SIN CREDITO, SIN RECARGAS Y SIN IVA";
        $data['titulo3'] = "REPORTE DE VENTAS  FARMABODEGA SIN CREDITO, SIN RECARGAS Y SIN IVA";
        $data['tit']='Reporte de compras';
        $data['q1'] = $this->finanzas_model->ventas_aaa6('DA');
        $data['q2'] = $this->finanzas_model->ventas_aaa6('FE');
        $data['q3'] = $this->finanzas_model->ventas_aaa6('FA');
        $data['js'] = 'finanzas/s_ventas_aaa6_js';
        $data['json1'] = $this->finanzas_model->grafica_venta_aaa6('DA','chart1');
        $data['json2'] = $this->finanzas_model->grafica_venta_aaa6_por('DA','chart2');
        $data['json3'] = $this->finanzas_model->grafica_venta_aaa6('FE','chart3');
        $data['json4'] = $this->finanzas_model->grafica_venta_aaa6_por('FE','chart4');
        $data['json5'] = $this->finanzas_model->grafica_venta_aaa6('FA','chart5');
        $data['json6'] = $this->finanzas_model->grafica_venta_aaa6_por('FA','chart6');
        $this->load->view('main', $data);
    }
    function s_rentabilidad_imp($tipo)
    {
        $aaa=2015;
        $data['titulo1'] = "REPORTE DE RENTABILIDAD DE FARMACIAS  DOCTOR AHORRO SIN CREDITO, SIN RECARGAS Y SIN IVA";
        $data['titulo2'] = "REPORTE DE RENTABILIDAD DE FARMACIAS  FENIX SIN CREDITO, SIN RECARGAS Y SIN IVA";
        $data['titulo3'] = "REPORTE DE RENTABILIDAD DE FARMACIAS  FARMABODEGA SIN CREDITO, SIN RECARGAS Y SIN IVA";
        $data['q1'] = $this->finanzas_model->rentabilidad_farmacia($aaa,$tipo);
        $data['json'] = $this->finanzas_model->rentabilidad_farmacia_grafica1($aaa,$tipo,'chart');       
        $this->load->view('finanzas/s_rentabilidad_imp', $data);
        
    }
    function s_rentabilidad_farmacia_por()
    {
        $aaa=2015;
        $data['titulo1'] = "REPORTE DE VENTA DE FARMACIAS,COSTO DEL PRODUCTO Y GASTOS";
        $data['q1'] = $this->finanzas_model->rentabilidad_farmacia($aaa,'DA');
        $data['json'] = $this->finanzas_model->rentabilidad_farmacia_grafica1($aaa,'DA','chart');       
        $this->load->view('finanzas/s_rentabilidad_farmacia_por', $data);
        
    }
    
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   ////////////////////////////////////////////////////////////////////////////////////////////////////////// 
    
    function s_proyeccion_v()
    {
        $aaa=date('Y');
        $data['titulo1'] = 'PROYECCION DE VENTAS SUCURSALES DOCTOR AHORRO';
        $data['titulo2'] = 'PROYECCION DE VENTAS SUCURSALES FENIX';
        $data['aaa'] = $aaa;
        $data['q'] = $this->finanzas_model->proyeccion_v($aaa);
        $data['q1'] = $this->finanzas_model->proyeccion_v($aaa);
        $this->load->view('main', $data);
    }
    
     
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
    function s_proyeccion_venta($tipo,$aaa,$mes)
    {
        $var=$aaa.'-'.str_pad($mes,2,"0",STR_PAD_LEFT).'-01';
        $s="select 
        year(subdate(date('$var'),interval 1 month)) as aaa_a, 
        month(subdate(date('$var'),interval 1 month))as mes_a,
        year(subdate(date('$var'),interval 2 month)) as aaa_a2, 
        month(subdate(date('$var'),interval 2 month))as mes_a2";
        $q=$this->db->query($s);
        $r=$q->row();
        $data['aaa']=$aaa;
        $data['aaa_a']=$r->aaa_a;
        $data['tipo']=$tipo;
        $data['mesx']=$this->Catalogos_model->busca_mes_uno($mes);
        $mes_ax=$this->Catalogos_model->busca_mes_uno($r->mes_a);
        $data['mes_ax']=$mes_ax;
        $data['titulo'] = "PROYECCION DE VENTA MES ACTUAL ".$this->Catalogos_model->busca_mes_uno($mes);
        $data['q1'] = $this->finanzas_model->proyeccion_venta($tipo,$aaa,$mes);
        $data['q2'] = $this->finanzas_model->proyeccion_venta_dia($tipo,$aaa,$mes);
        $data['q3'] = $this->finanzas_model->proyeccion_venta_dif($tipo,$aaa,$mes,$r->aaa_a,$r->mes_a,$r->aaa_a2,$r->mes_a2);
        $data['q4'] = $this->finanzas_model->proyeccion_venta_dia_mes($tipo,$aaa,$mes,$r->aaa_a,$r->mes_a);
        $data['js'] = 'finanzas/s_proyeccion_venta_js';
        $data['json'] = $this->finanzas_model->grafica_proyeccion($tipo,$aaa,$mes,$r->aaa_a,$r->mes_a,$mes_ax,'chart');
        
    
        $this->load->view('main', $data);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    function s_proyeccion_venta_detalle($tipo,$fecha)
    {
        $data['mesx']=$this->Catalogos_model->busca_mes_uno(substr($fecha,7,2));
        $data['titulo'] = "PROYECCION DE VENTA MES ACTUAL ".$this->Catalogos_model->busca_mes_uno(substr($fecha,7,2));
         $data['q1'] = $this->finanzas_model->proyeccion_venta_dia_mes_detalle($tipo,$fecha);
        $data['js'] = 'finanzas/s_proyeccion_venta_js';
        $data['json'] = $this->finanzas_model->grafica_proyeccion_detalle($tipo,$fecha,'chart');
        
    
        $this->load->view('main', $data);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    function s_proyeccion_venta_suc($tipo,$aaa,$mes)
    {
        $var=$aaa.'-'.str_pad($mes,2,"0",STR_PAD_LEFT).'-01';
        $s="select 
        year(subdate(date('$var'),interval 1 month)) as aaa_a, 
        month(subdate(date('$var'),interval 1 month))as mes_a,
        year(subdate(date('$var'),interval 2 month)) as aaa_a2, 
        month(subdate(date('$var'),interval 2 month))as mes_a2";
        $q=$this->db->query($s);
        $r=$q->row();
        $data['aaa']=$aaa;
        $data['mes']=$mes;
        $data['aaa_a']=$r->aaa_a;
        $data['mesx']=$this->Catalogos_model->busca_mes_uno($mes);
        $mes_ax=$this->Catalogos_model->busca_mes_uno($r->mes_a);
        $data['mes_ax']=$mes_ax;
        $data['titulo'] = "PROYECCION DE VENTA MES  ".$this->Catalogos_model->busca_mes_uno($mes);
        $data['q1'] = $this->finanzas_model->proyeccion_venta($tipo,$aaa,$mes);
        $data['q2'] = $this->finanzas_model->proyeccion_venta_dia($tipo,$aaa,$mes);
        $data['q3'] = $this->finanzas_model->proyeccion_venta_dif($tipo,$aaa,$mes,$r->aaa_a,$r->mes_a,$r->aaa_a2,$r->mes_a2);
        $data['q4'] = $this->finanzas_model->proyeccion_venta_dif_suc($tipo,$aaa,$mes,$r->aaa_a,$r->mes_a,$r->aaa_a2,$r->mes_a2);
        $data['js'] = 'finanzas/s_proyeccion_venta_suc_js';
    
        $this->load->view('main', $data);
    }
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   function s_proyeccion_venta_detalle_suc($suc,$aaa,$mes)
    {
        $var=$aaa.'-'.str_pad($mes,2,"0",STR_PAD_LEFT).'-01';
        $s="select 
        year(subdate(date('$var'),interval 1 month)) as aaa_a, 
        month(subdate(date('$var'),interval 1 month))as mes_a,
        year(subdate(date('$var'),interval 2 month)) as aaa_a2, 
        month(subdate(date('$var'),interval 2 month))as mes_a2";
        $q=$this->db->query($s);
        $r=$q->row();
        $objetivo=$this->finanzas_model->objetivo_mes_suc('DA',$aaa,$mes,$r->aaa_a,$r->mes_a,$r->aaa_a2,$r->mes_a2,$suc);
        $data['mesx']=$this->Catalogos_model->busca_mes_uno($mes);
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['objetivo']=$objetivo;
        $data['titulo'] = "PROYECCION DE VENTA MES ".$this->Catalogos_model->busca_mes_uno($mes).'DE LA SUCURSAL '.$sucx;
        $data['q1'] = $this->finanzas_model->proyeccion_venta_detalle_suc($suc,$aaa,$mes);
        $data['js'] = 'finanzas/s_proyeccion_venta_js';
        $this->load->view('main', $data);
    }
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   function a_venta_90_dias()
   {
    $data['titulo1'] = "VENTA 90 DIAS DOCTOR AHORRO" ;
    $data['titulo2'] = "VENTA 90 DIAS FENIX" ;
    $data['titulo3'] = "VENTA 90 FARMABODEGA" ;
    $data['nom'] = $this->finanzas_model->consulta_venta_90_dias_nombre();
    $data['q1'] = $this->finanzas_model->consulta_venta_90_dias('DA');
    $data['q2'] = $this->finanzas_model->consulta_venta_90_dias('FE');
    $data['q3'] = $this->finanzas_model->consulta_venta_90_dias('FA');
    $data['js'] = 'finanzas/a_venta_90_dias_js';
    $this->load->view('main', $data);
   }
   function a_venta_90_dias_excel()
   {
    $data['nom'] = $this->finanzas_model->consulta_venta_90_dias_nombre();
    $data['q1'] = $this->finanzas_model->consulta_venta_90_dias_todo();
    $this->load->view('excel/a_venta_90_dias_excel_todo', $data);
   }
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    
    
    
    
    
   }