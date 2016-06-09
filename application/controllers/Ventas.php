<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ventas extends CI_Controller
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
        $this->load->model('desplazamientos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////GERENTE NACIONAL   
   function s_ventas_aaa_mes()
    {
        $aaa=date('Y');
        //$aaa=2015;
        $data['tit1'] = "VENTAS DE DOCTOR AHORRO";
        $data['tit2'] = "VENTAS DE FENIX";
        $data['tit3'] = "VENTAS DE FARMABODEGA";
        $data['aaa'] = $aaa;
        $data['tipo3_1'] ='DA';
        $data['tipo3_2'] ='FE';
        $data['nivel'] =$this->session->userdata('nivel');
        $data['q'] = $this->Ventas_model->ventas_aaa_mes('DA',$aaa);
        $data['q1'] = $this->Ventas_model->ventas_aaa_mes('FE',$aaa);
        $data['q2'] = $this->Ventas_model->ventas_aaa_mes('FA',$aaa);
        $data['js'] = 'ventas/s_ventas_aaa_mes_js';
        $data['json'] = $this->Ventas_model->graficaAnio('DA','chart',$aaa);
        $data['json1'] = $this->Ventas_model->graficaAnio('FE','chart1',$aaa);
        //$data['json2'] = $this->Ventas_model->graficaAnio('FA','chart2',$aaa);
        $this->load->view('main', $data);
    }
    function s_ventas_aaa_mes_gra()
    {
        $aaa=date('Y');
        $data['tit1'] = "VENTAS DE DOCTOR AHORRO";
        $data['tit2'] = "VENTAS DE FENIX";
        $data['tit3'] = "VENTAS DE FARMABODEGA";
        $data['aaa'] = $aaa;
        $data['tipo3_1'] ='DA';
        $data['tipo3_2'] ='FE';
        $data['nivel'] =$this->session->userdata('nivel');
        $data['q'] = $this->Ventas_model->ventas_aaa_mes('DA',$aaa);
        $data['q1'] = $this->Ventas_model->ventas_aaa_mes('FE',$aaa);
        $data['q2'] = $this->Ventas_model->ventas_aaa_mes('FA',$aaa);
        $data['js'] = 'ventas/s_ventas_aaa_mes_js';
        $data['json'] = $this->Ventas_model->graficaAnio('DA','chart',$aaa);
        $data['json1'] = $this->Ventas_model->graficaAnio('FE','chart1',$aaa);
        //$data['json2'] = $this->Ventas_model->graficaAnio('FA','chart2',$aaa);
        $this->load->view('main', $data);
    }
    function s_ventas_aaa_mes_det($aaa,$mes,$tipo3)
    {
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $aaa_ant=$aaa-1;
        if($mes==1){$mes_ant=12;}else{
        $mes_ant=$mes-1;    
        }
        $monto= $this->Ventas_model->suc_evaluadas($aaa,$mes);
        if($tipo3=='DA'){
            $data['tit1'] = "VENTAS DE DOCTOR AHORRO DEL MES DE ".$mesx;
        }elseif($tipo3=='FE'){
            $data['tit1'] = "VENTAS DE FENIX AHORRO DEL MES DE ".$mesx;
        }elseif($tipo3=='FA'){
            $data['tit1'] = "VENTAS DE FARMABODEGA AHORRO DEL MES DE ".$mesx;
            }
        $data['aaa']=$aaa;
        $data['mes']=$mes;
        $data['tipo3']=$tipo3;
        
        $data['mesx'] = $mesx;
        $data['mesxa'] = $this->Catalogos_model->busca_mes_uno(($mes_ant));
        $data['q'] = $this->Ventas_model->ventas_aaa_mes_det($aaa,$mes,$tipo3,$monto);
        $data['js'] = 'ventas/s_ventas_aaa_mes_det_js';
        $this->load->view('main', $data);
    }
    function s_evaluacion_nac_suc($aaa,$mes)
   {
    $var1="'DA'";$var2="'FE'";$var3="'FA'";$var4="'AN','CE',' '";$var5="'OF'";
    $var6="'FR'";$var7="'SE'";$var8="'MO'";
    $data['aaa']=$aaa;
    $data['mesx']=$this->Catalogos_model->busca_mes_uno($mes);
    $q= $this->Ventas_model->suc_evaluadas_datos($aaa,$mes);
    $r=$q->row();
    $data['num']=$r->num;
    $data['gasto']=$r->gasto;
    $data['gasto_40']=$r->gasto_40;
    $data['monto']=$r->monto;
    $monto=$r->monto;
    $nom_archivo='venta_'.date('YmdHsi').'.xlsx';
    $data['nombre']=$nom_archivo;
    $data['q0'] = $this->Ventas_model->evaluacion_porce_det0($aaa,$mes);
    $data['q1'] = $this->Ventas_model->evaluacion_porce_det1($var1,$monto,$aaa,$mes);
    $data['q2'] = $this->Ventas_model->evaluacion_porce_det1($var2,$monto,$aaa,$mes);
    $data['q3'] = $this->Ventas_model->evaluacion_porce_det1($var3,$monto,$aaa,$mes);
    $data['q4'] = $this->Ventas_model->evaluacion_porce_det1($var4,$monto,$aaa,$mes);
    $data['q5'] = $this->Ventas_model->evaluacion_porce_det1($var5,$monto,$aaa,$mes);
    $data['q6'] = $this->Ventas_model->evaluacion_porce_det1($var6,$monto,$aaa,$mes);
    $data['q7'] = $this->Ventas_model->evaluacion_porce_det1($var7,$monto,$aaa,$mes);
    $data['q8'] = $this->Ventas_model->evaluacion_porce_det1($var8,$monto,$aaa,$mes);
    $this->load->view('excel/s_evaluacion_nac_suc', $data);
    }
   
    function s_estadistica_ventas_nac($aaa,$mes,$tipo3)
    {
    $data['vta']=40;
    $data['gas']=20;
    $data['inv']=10;
    $data['util']=10;
    $data['mer']=20;
    $vta=40;$gas=20;$inv=10;$util=10;$mer=20;
    $aaa=date('Y');
    $q= $this->Ventas_model->suc_evaluadas_datos($aaa,$mes);
    $r=$q->row();
    if($q->num_rows()>0){
        $monto=$r->monto;    
    }else{
        $monto=0;
    }
    $data['monto']=$monto;
    $data['nivel_sur']=$this->Ventas_model->nivel_surtido_far($aaa,$mes);
    $nivel_sur=$this->Ventas_model->nivel_surtido_far($aaa,$mes);
    $data['mesx']=$this->Catalogos_model->busca_mes_uno($mes);
    $data['a'] = $this->Ventas_model->estadistica_ventas_nac($mes,$aaa,$vta,$gas,$inv,$util,$mer,$nivel_sur,$monto,$tipo3);
    $this->load->view('excel/s_estadistica_ventas_nac', $data);
    }
   
   function  s_ventas_captura_nac()
    {
        $fecha = date('Y-m-d');
        $dia = strtotime ( '-1 day' , strtotime ( $fecha ) );$dia = date ( 'Y-m-d' , $dia );
        $data['titulo'] = "Venta de capturadas";
        $data['tit0']='SUCURSALES QUE NO CAPTURARON VENTAS DEL DIA '.$dia;
        $data['tit1']='CONCENTRADO DE VENTAS CAPTURADAS DE LA SEMANA';
        $data['a'] = $this->Ventas_model->s_ventas_captura_diaria_nac();
        $data['q'] = $this->Ventas_model->s_no_captura();
        $this->load->view('main', $data);
    }
   
 /////////////////////////////////////////////////////////////////////////////////////////////////GERENTE NACIONAL
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////   
 /////////////////////////////////////////////////////////////////////////////////////////////////REGIONAL
 function s_ventas_diarias_bor()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        
        $data['suc']=$this->Catalogos_model->busca_sucursal_ger($id_plaza);
        $data['tit']='BORRAR DE VENTAS';
        $this->load->view('main', $data);
    }
 function s_ventas_diarias_bor_det()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['tit']='BORRAR DE VENTAS';
        $data['q'] = $this->Ventas_model->ventas_suc_captura($this->input->post('suc'));
        $data['js'] = 'ventas/s_ventas_diarias_bor_det_id_js';
        $this->load->view('main', $data);
    }
    function s_ventas_diarias_bor_det_id($suc)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['tit']='BORRAR DE VENTAS';
        $data['q'] = $this->Ventas_model->ventas_suc_captura($suc);
        $data['js'] = 'ventas/s_ventas_diarias_bor_det_id_js';
        $this->load->view('main', $data);
    }
    function s_ventas_diarias_bor_sumit($id,$suc)
    {
    $a=array('activo'=>5,'fecha_bor'=>date('Y-m-d H:i:s'));
    $this->db->where('id',$id);
    $this->db->update('vtadc.vta_captura_diaria',$a);
    redirect('ventas/s_ventas_diarias_bor_det_id/'.$suc);
    
    }
    
    function s_depositos_diarios_bor()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        
        $data['suc']=$this->Catalogos_model->busca_sucursal_ger($id_plaza);
        $data['tit']='BORRAR DE DEPOSITOS';
        $this->load->view('main', $data);
    }
    function s_depositos_diarios_bor_det()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['tit']='BORRAR DE DEPOSITOS';
        $data['q'] = $this->Ventas_model->depositos_suc_captura($this->input->post('suc'));
        $data['js'] = 'ventas/s_depositos_diarios_bor_det_id_js';
        $this->load->view('main', $data);
    }
    function s_depositos_diarios_bor_det_id($suc)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['tit']='BORRAR DE DEPOSITOS';
        $data['q'] = $this->Ventas_model->depositos_suc_captura($suc);
        $data['js'] = 'ventas/s_depositos_diarios_bor_det_id_js';
        $this->load->view('main', $data);
    }
    function s_depositos_diarios_bor_sumit($id,$suc)
    {
    $a=array('activo'=>5,'fecha_bor'=>date('Y-m-d H:i:s'));
    $this->db->where('id',$id);
    $this->db->update('vtadc.vta_captura_diaria_deposito',$a);
    redirect('ventas/s_depositos_diarios_bor_det_id/'.$suc);
    }
    
    function s_estadistica_ventas_sup($aaa,$mes,$superv)
    {
    $data['superv']=$superv;
    $data['mesx']=$this->Catalogos_model->busca_mes_uno($mes);
    $data['q'] = $this->Ventas_model->venta_ctl_sup($aaa,$mes,$superv);
    $data['q1'] = $this->Ventas_model->venta_ctl_det($aaa,$mes,$superv);
    $this->load->view('excel/s_estadistica_ventas', $data);
    }
    
    function s_ventas_aaa_mes_ger()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $aaa=date('Y');
        $data['tit1'] = "VENTAS DE DOCTOR AHORRO";
        $data['aaa'] = $aaa;
        $data['tipo3_1'] ='DA';
        $data['q'] = $this->Ventas_model->ventas_aaa_mes_ger('DA',$id_plaza);
        $data['js'] = 'ventas/s_ventas_aaa_mes_js';
        $this->load->view('main', $data);
    }
    function s_ventas_aaa_mes_det_ger($aaa,$mes,$tipo3)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $monto= $this->Ventas_model->suc_evaluadas($aaa,$mes);
        if($tipo3=='DA'){
            $data['tit1'] = "VENTAS DE DOCTOR AHORRO";
        }elseif($tipo3=='FE'){
            $data['tit1'] = "VENTAS DE FENIX";
        }elseif($tipo3=='FA'){
            $data['tit1'] = "VENTAS DE FARMABODEGA";
            }
        $data['aaa']=$aaa;
        $data['mes']=$mes;
        $data['tipo3']=$tipo3;
        $data['mesx'] = $this->Catalogos_model->busca_mes_uno($mes);
        $data['mesxa'] = $this->Catalogos_model->busca_mes_uno(($mes-1));
        $data['q'] = $this->Ventas_model->ventas_aaa_mes_det_ger($mes,$tipo3,$monto,$id_plaza);
        $data['js'] = 'ventas/s_ventas_aaa_mes_det_js';
        $this->load->view('main', $data);
    }
    function s_estadistica_ventas_reg($aaa,$mes,$tipo3)
    {
    $data['vta']=40;
    $data['gas']=20;
    $data['inv']=10;
    $data['util']=10;
    $data['mer']=20;
    $vta=40;$gas=20;$inv=10;$util=10;$mer=20;
    $id_plaza=$this->session->userdata('id_plaza');
    //$aaa=date('Y');$mes=(date('m')-1);
    $data['gerx']=$this->session->userdata('nombre');
    $data['nivel_sur']=$this->Ventas_model->nivel_surtido_far($aaa,$mes);
    $nivel_sur=$this->Ventas_model->nivel_surtido_far($aaa,$mes);
    $data['regional']=$id_plaza;
    $q= $this->Ventas_model->suc_evaluadas_datos($aaa,$mes);
    if($q->num_rows()>0){
        $r=$q->row();
        $monto=$r->monto;
    }else{
        $monto=0;
    }
    $data['monto']=$monto;
    $data['mesx']=$this->Catalogos_model->busca_mes_uno($mes);
    $data['a'] = $this->Ventas_model->estadistica_ventas_reg($id_plaza,$mes,$aaa,$vta,$gas,$inv,$util,$mer,$nivel_sur,$monto,$tipo3);
    $this->load->view('excel/s_estadistica_ventas_reg', $data);
    
    
    }
  function s_descuentos_mes()
  {
        $data['tit'] = "Descuentos aplicados por Zona";
        $data['q'] = $this->Ventas_model->descuentos_mes();
        $data['js'] = 'ventas/s_diarias_js';
        $this->load->view('main', $data);
  }
  function s_descuentos_mes_sup($aaa,$mes)
  {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $id_plaza=$this->session->userdata('id_plaza');
        $data['tit'] = "Descuentos aplicados por Zona del Mes de ".$mesx;
        $data['aaa']=$aaa;
        $data['mes']=$mes;
        $data['q'] = $this->Ventas_model->descuentos_mes_sup($id_plaza);
        $data['js'] = 'ventas/s_diarias_js';
        $this->load->view('main', $data);
  }
  function s_descuentos_mes_sup_excel($aaa,$mes,$id_plaza)
  {
        $this->load->dbutil();
        $this->load->helper('download');
        $a = $this->Ventas_model->descuentos_mes_sup_excel($aaa,$id_plaza,$mes);
        $csv = $this->dbutil->csv_from_result($a);
        $name = 'DESCUENTOS_'.date('Ymd_His').'.csv';
        force_download($name, $csv);     
  }
 function s_optimo_excel_ger($aaa,$superv)
    {
        set_time_limit(0);
        ini_set("memory_limit","2048M");
        $this->load->helper('download');
        $id_plaza=$this->session->userdata('id_plaza');
        $data['ger']=$id_plaza;
        $data['query'] = $this->desplazamientos_model->archivo_exel_optimo_ger($aaa,$superv);
        $this->load->view('excel/s_optimo_excel',$data);
        }    
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 /////////////////////////////////////////////////////////////////////////////////////////////////REGIONAL
 
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////asistentes
function s_ventas_comparativas_historicas_nac()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $aaa=date('Y');
        $data['tit1']='PROMEDIO DE VENTAS DE LA ZONA  SUCURSALES DOCTOR AHORRO';
        $data['tit2']='PROMEDIO DE VENTAS DE LA ZONA  SUCURSALES FENIX';
        $data['tit3']='PROMEDIO DE VENTAS DE LA ZONA  SUCURSALES FARMABODEGA';
        $data['q'] = $this->Ventas_model->ventas_comparativas_his_nac('DA');
        $data['q2'] = $this->Ventas_model->ventas_comparativas_his_nac('FE');
        $data['q3'] = $this->Ventas_model->ventas_comparativas_his_nac('FA');
        $data['js'] = 'ventas/s_ventas_comparativas_historicas_js';
        $this->load->view('main', $data);
    }   
   
   function s_ventas_comparativas_historicas_det_nac($mes,$tipo3)
    {
        $id_plaza=$this->session->userdata('id_plaza');$aaa=date('Y');
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['mes']=$mes;
        $data['tit1']='PROMEDIO DE VENTAS DE  SUCURSALES DEL MES DE '.$mesx;
        $data['q'] = $this->Ventas_model->ventas_comparativas_his_det_nac($mes,$tipo3);
        $data['js'] = 'ventas/s_ventas_comparativas_historicas_js';
        $this->load->view('main', $data);
    }
   
   function ventas_clientes()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA';
        $data['a'] = $this->Ventas_model->clientes_mes();
        $this->load->view('main', $data);
    }
     function ventas_clientes_det($mes)
    {
        $data['dia']=$this->Ventas_model->topedia($mes);
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['tit']='VENTAS CREDITO DEL MES DE '.$mesx.' DEL'.date('Y');
        $data['a'] = $this->Ventas_model->clientes_mes_det($mes);
        $this->load->view('impresion/ventas_credito', $data);
    }
    function a_venta_tic()
    {
        $data['titulo']='Tickets por sucursal';
        $this->load->view('main', $data);   
    }
    function a_venta_tic_det()
    {
        $data['titulo']='Tickets por sucursal';
        $data['q'] = $this->Ventas_model->venta_tic_det($this->input->post('aaa'),$this->input->post('mes'));
        $data['js'] = 'ventas/a_venta_tic_det_js';
        $this->load->view('main', $data);   
    }
    
    
    
    
    
    
    
    
    
    
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   //////////////////////////////////////////////////////////////////////////////filtro nacional; directivos 
    function s_ventas_cortes()//borrame ya no la usan
    {
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR IMAGEN SIN IVA';
        $data['a'] = $this->ventas_model->s_ventas_cortes('','');
        $data['js'] = 'ventas/s_ventas_cortes_js';
        $this->load->view('main', $data);
    }
    function s_ventas_comparadas_mes_aaa()
    {
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR IMAGEN SIN IVA';
        $data['a'] = $this->ventas_model->s_ventas_cortes('','');
        $data['js'] = 'ventas/s_ventas_cortes_js';
        $this->load->view('main', $data);
    }
    function s_ventas_cortes_suc($mes,$tipo2)
    {
        $imagen=$this->Catalogos_model->busca_imagen_uno($tipo2);
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR IMAGEN SIN IVA DE '.trim($imagen).' DEL MES DE '.trim($mesx);
        $data['a'] = $this->ventas_model->s_ventas_cortes($mes,$tipo2);
        $data['js'] = 'ventas/s_ventas_cortes_suc_js';
        $this->load->view('main', $data);
    }
    function  s_ventas_compara_mes_nac()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $aaa=date('Y');
        $data['f'] = $this->Catalogos_model->busca_sucursal_imagen('F');
        $data['g'] = $this->Catalogos_model->busca_sucursal_imagen('G');
        $data['d'] = $this->Catalogos_model->busca_sucursal_imagen('D');
        $data['titulo'] = "Venta de cortes";
        $data['tit1']='CONCENTRADO DE VENTAS POR IMAGEN SIN IVA CONTADO DE SUCURSALES ABIERTAS ACTUALMENTE';
        $data['tit2']='CONCENTRADO DE VENTAS POR IMAGEN CREDITO DE SUCURSALES ABIERTAS ACTUALMENTE';
        $data['tit3']='CONCENTRADO DE VENTAS POR IMAGEN SIN IVA RECARGAS DE SUCURSALES ABIERTAS ACTUALMENTE';
        $data['q'] = $this->ventas_model->s_ventas_compra_mes_nac($aaa);
        $data['js'] = 'ventas/s_ventas_compara_mes_nac_js';
        $this->load->view('main', $data);
    }
    function  s_ventas_compara_mes_nac_det()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $aaa=date('Y');
        $data['titulo'] = "Venta de cortes";
        $data['tit1']='CONCENTRADO DE VENTAS SIN IVA CONTADO DE SUCURSALES ABIERTAS ACTUALMENTE';
        $data['q'] = $this->ventas_model->s_ventas_compra_mes_nac_det($aaa);
        $data['js'] = 'ventas/s_ventas_compara_mes_nac_det_js';
        $this->load->view('main', $data);
    }
    
    
    
    
    
    //////////////////////////////////////////////////////////////////////////////filtro nacional; directivos
/////////////////////////////////////////////////////////////////////////////filtro gerentes
    function s_ventas_cortes_ger()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA';
        $data['a'] = $this->ventas_model->s_ventas_cortes_ger('',$id_plaza);
        $data['js'] = 'ventas/s_ventas_cortes_js';
        $this->load->view('main', $data);
    }
    function s_ventas_cortes_ger_imagen($aaa,$mes,$tipo2)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA';
        $data['q'] = $this->ventas_model->s_ventas_ger_imagen($aaa,$mes,$tipo2,$id_plaza);
        $data['js'] = 'ventas/ventas_cortes_succ_js';
        $this->load->view('main', $data);
    }
    function  s_ventas_compara_mes_ger()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $aaa=date('Y');
        $data['titulo'] = "Venta de cortes";
        $data['tit1']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA CONTADO';
        $data['tit2']='CONCENTRADO DE VENTAS POR ZONAS CREDITO';
        $data['tit3']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA RECARGAS';
        $data['q'] = $this->ventas_model->s_ventas_compra_mes_ger($aaa,$id_plaza);
        $data['js'] = 'ventas/s_ventas_compara_mes_js';
        $this->load->view('main', $data);
    }
    function  s_ventas_capturadas_ger()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $dia=jddayofweek( cal_to_jd(CAL_GREGORIAN, date("m"),date("d"), date("Y")) , 0);
        $var=$this->Catalogos_model->busca_que_dia($dia);
        $data['dom']= substr($var,0,10);
        $data['lun']= substr($var,10,10);
        $data['mar']= substr($var,20,10);
        $data['mie']= substr($var,30,10);
        $data['jue']= substr($var,40,10);
        $data['vie']= substr($var,50,10);
        $data['sab']= substr($var,60,10);
        $data['titulo'] = "Venta de capturadas";
        $data['tit1']='CONCENTRADO DE VENTAS POR ZONAS CON IVA CONTADO';
        $data['tit2']='CONCENTRADO DE VENTAS POR ZONAS CREDITO';
        $data['tit3']='CONCENTRADO DE VENTAS POR ZONAS CON IVA RECARGAS';
        $data['q'] = $this->ventas_model->s_ventas_capturada_ger($id_plaza);
        $data['js'] = 'ventas/s_ventas_capturadas_js';
        $this->load->view('main', $data);
    }
    function  s_ventas_capturadas_dia_ger($fec)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de capturadas";
        $data['tit1']='CONCENTRADO DE VENTAS POR ZONAS CON IVA CONTADO DEL DIA '.$fec;
        $data['q'] = $this->ventas_model->s_ventas_capturada_dia_ger($id_plaza,$fec);
        $data['js'] = 'ventas/s_ventas_capturadas_dia_js';
        $this->load->view('main', $data);
    }
    
    
    
    
    
    
    function s_estadistica_ventas_regs()
    {
    $id_plaza=$this->session->userdata('id_plaza');
    $aaa=date('Y');$mes=(date('m')-1);
    $data['nivel_sur']=$this->ventas_model->nivel_surtido_far($aaa,$mes);
    
    $this->load->view('excel/eje', $data);
    }
    
    
    
    
        
    /////////////////////////////////////////////////////////////////////////filtro supervisor
    function s_ventas_cortes_succ()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA';
        $data['a'] = $this->ventas_model->s_ventas_succ($id_plaza);
        $data['js'] = 'ventas/ventas_cortes_succ_js';
        $this->load->view('main', $data);
    }
    function s_ventas_cortes_succ_imagen($aaa,$mes,$tipo2)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA';
        $data['q'] = $this->ventas_model->s_ventas_succ_imagen($aaa,$mes,$tipo2,$id_plaza);
        $data['js'] = 'ventas/ventas_cortes_succ_js';
        $this->load->view('main', $data);
    }
    function  s_ventas_cortes_succ_dia($aaa,$mes,$suc)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA';
        $data['q'] = $this->ventas_model->s_ventas_succ_dia($aaa,$mes,$suc,$id_plaza);
        $data['js'] = 'ventas/ventas_cortes_succ_js';
        $this->load->view('main', $data);
    }
    function  s_ventas_compara_mes()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $aaa=date('Y');
        $data['titulo'] = "Venta de cortes";
        $data['tit1']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA CONTADO';
        $data['tit2']='CONCENTRADO DE VENTAS POR ZONAS CREDITO';
        $data['tit3']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA RECARGAS';
        $data['q'] = $this->ventas_model->s_ventas_compra_mes($aaa,$id_plaza);
        $data['js'] = 'ventas/s_ventas_compara_mes_js';
        $this->load->view('main', $data);
    }
    function  s_ventas_capturadas()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $dia=jddayofweek( cal_to_jd(CAL_GREGORIAN, date("m"),date("d"), date("Y")) , 0);
        $var=$this->Catalogos_model->busca_que_dia($dia);
        $data['dom']= substr($var,0,10);
        $data['lun']= substr($var,10,10);
        $data['mar']= substr($var,20,10);
        $data['mie']= substr($var,30,10);
        $data['jue']= substr($var,40,10);
        $data['vie']= substr($var,50,10);
        $data['sab']= substr($var,60,10);
        $data['titulo'] = "Venta de capturadas";
        $data['tit1']='CONCENTRADO DE VENTAS POR ZONAS CON IVA CONTADO';
        $data['tit2']='CONCENTRADO DE VENTAS POR ZONAS CREDITO';
        $data['tit3']='CONCENTRADO DE VENTAS POR ZONAS CON IVA RECARGAS';
        $data['q'] = $this->ventas_model->s_ventas_capturada($id_plaza);
        $data['js'] = 'ventas/s_ventas_capturadas_js';
        $this->load->view('main', $data);
    }
    function  s_ventas_capturadas_dia($fec)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de capturadas";
        $data['tit1']='CONCENTRADO DE VENTAS POR ZONAS CON IVA CONTADO DEL DIA '.$fec;
        $data['q'] = $this->ventas_model->s_ventas_capturada_dia($id_plaza,$fec);
        $data['js'] = 'ventas/s_ventas_capturadas_dia_js';
        $this->load->view('main', $data);
    }
    function s_ventas_comparativas_historicas()
    {
        $id_plaza=$this->session->userdata('id_plaza');$aaa=date('Y');
        $data['tit']='PROMEDIO DE VENTAS DE LA ZONA '.$id_plaza;
        $data['q'] = $this->ventas_model->ventas_comparativas_his($id_plaza,$aaa);
        $data['js'] = 'ventas/s_ventas_comparativas_historicas_js';
        $this->load->view('main', $data);
    }
    function s_ventas_comparativas_historicas_det($mes)
    {
        $id_plaza=$this->session->userdata('id_plaza');$aaa=date('Y');
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['mes']=$mes;
        $data['tit']='PROMEDIO DE VENTAS DE LA ZONA '.$id_plaza.' DEL MES DE '.$mesx;
        $data['q'] = $this->ventas_model->ventas_comparativas_his_det($id_plaza,$aaa,$mes);
        $data['js'] = 'ventas/s_ventas_comparativas_historicas_js';
        $this->load->view('main', $data);
    }
    function s_ventas_comparativas_historicas_det_suc($mes,$suc)
    {
        set_time_limit(0);
        ini_set("memory_limit","2048M");
        $id_plaza=$this->session->userdata('id_plaza');$aaa=date('Y');
        
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        
        $data['tit']='PROMEDIO DE VENTAS DE LA ZONA '.$id_plaza.' DEL MES DE '.$mesx.' DE LA SUCURSAL '.$sucx;
        $data['q'] = $this->ventas_model->ventas_comparativas_his_det_suc($id_plaza,$aaa,$mes,$suc);
        $data['js'] = 'ventas/s_ventas_comparativas_historicas_js';
        $this->load->view('main', $data);
    }
    /////////////////////////////////////////////////////////////////////////filtro supervisor
    
    
    function ventas_clientes_gral()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de cortes";
        $data['tit']='CONCENTRADO DE VENTAS POR ZONAS SIN IVA';
        $data['a'] = $this->ventas_model->clientes_mes_gral();
        $this->load->view('main', $data);
    }
     function ventas_clientes_gral_det($mes)
    {
        
        $data['dia']=$this->ventas_model->topedia($mes);
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['tit']='VENTAS CREDITO DEL MES DE '.$mesx.' DEL'.date('Y');
        $data['a'] = $this->ventas_model->clientes_mes_det_gral($mes);
        $this->load->view('impresion/ventas_credito_gral', $data);
    }
  
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////secretaria Gerencia Comercial
 function s_ventas_capturadas_sec()
 {
        $data['titulo'] = "Venta capturada";
        $data['q'] = $this->ventas_model->venta_capturada_secretaria();
        $this->load->view('main', $data);   
 }
 function s_ventas_capturadas_sec_det($aaa,$mes)
 {
        $data['titulo'] = "Venta capturada";
        $data['q'] = $this->ventas_model->venta_capturada_secretaria_det($aaa,$mes);
        $this->load->view('main', $data);   
 }
 function s_ventas_capturadas_sec_dia($fecha)
 {
        $data['titulo'] = "Venta capturada ".$fecha;
        $data['q'] = $this->ventas_model->venta_capturada_secretaria_dia($fecha);
        $this->load->view('main', $data);   
 }


  
    
 
 
 
 
 
 function s_ven_mensual_resp()
    {
        set_time_limit(0);
        ini_set("memory_limit","2048M");
        
        $titulo = "VENTAS DIARIAS";
        $archivo='detalle_'.date('Ymd_H_i_s');
        // output headers so that the file is downloaded rather than displayed
         header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$archivo.'.csv');
        
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        
        fputcsv($output, array("$titulo"));
        fputcsv($output, array('',''));
        
$s="SELECT  CONCAT(DAY(FECHA_VTA),' ',substr(mes,1,3))as fecha,day(fecha_vta)as dia,
sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)as con,
sum(vta_credito)as cre,sum(vta_servicio)as ser,sum(ticket)as tic,
(select count(*) from vtadc.vta_captura_diaria_suc x where x.fecha_vta=a.fecha_vta and x.tipo3=c.tipo3)as num_suc
FROM vtadc.vta_captura_diaria a
join catalogo.mes b on b.num=month(fecha_vta)
join catalogo.sucursal c on c.suc=a.suc and tipo3='DA'
where
year(fecha_vta)=year(date(now())) and month(fecha_vta)=month(date(now())) and day(fecha_vta)>0 and 
  fecha_vta<=subdate(date(now()),1) and activo=1
GROUP BY fecha_vta"; 
$q=$this->db->query($s);

$a1="<strong>SUCURSALES</strong>";

            $a = array(' ');
            $b = array('Sucursales');
            $c = array('Ticket');
            $d = array('Vta.Contado');
            $e = array('Vta.Crédito');
            $f = array('Vta.Servicio');
            $g = array('Vta TOTAL');
            $h = array('Venta SIN SERVICIO');
            $i = array('Prom. por Ticket');
            
        foreach ($q->result()as $r)
        {

            array_push($a, $r->fecha);
            array_push($b, $r->num_suc);
            array_push($c, number_format($r->tic,0));
            array_push($d, number_format($r->con,2));
            array_push($e, number_format($r->cre,2));
            array_push($f, number_format($r->ser,2));
            array_push($g, number_format(($r->con+$r->cre+$r->ser),2));
            array_push($h, number_format(($r->con+$r->cre),2));
            array_push($i, number_format((($r->con+$r->cre+$r->ser)/$r->tic),2));
       
        }
 
     fputcsv($output, $a);   
     fputcsv($output, $b);   
     fputcsv($output, $c);   
     fputcsv($output, $d);
     fputcsv($output, $e);
     fputcsv($output, $f); 
     fputcsv($output, $g);  
     fputcsv($output, $h);  
     fputcsv($output, $i);     
     

           
            
            
            
            
        

    
    }   
    
 function s_depositos()
 {
        $data['titulo'] = "Depositos capturados";
        $data['q'] = $this->ventas_model->depositos();
        $data['js'] = 'ventas/s_depositos_js';
        $this->load->view('main', $data);  
 }
 function s_depositos_det($aaa,$mes)
 {
        $data['titulo'] = "Depositos capturados";
        $data['q'] = $this->ventas_model->depositos_det($aaa,$mes);
        $data['js'] = 'ventas/s_depositos_det_js';
        $this->load->view('main', $data);   
 }
 function s_depositos_dia($fecha)
 {
        $data['titulo'] = "Depositos capturados";
        $data['q'] = $this->ventas_model->depositos_dia($fecha);
        $data['js'] = 'ventas/s_depositos_dia_js';
        $this->load->view('main', $data);   
 }  
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function ventas_tickets()
    {
       
        $data['titulo'] = "Reporte de Tickets";
        $data['tit']='Selecciona el mes y el a&ntilde;o';
        $data['mesx']=$this->Catalogos_model->busca_mes();
        $data['aaax']=$this->Catalogos_model->busca_anio();
        $data['js'] = 'ventas/ventas_tickets_js';
        $this->load->view('main', $data);
    }
    
    public function ventas_tickets_submit()
    {
        $mes= $this->input->post('mes');
        $aaa= $this->input->post('aaa');
        $data['mes']=$mes;
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['tit']='Reporte de Tickets del mes de'.$mesx;
        $data['a'] = $this->ventas_model->reporte_tickets($mes, $aaa);
        $data['b'] = $this->ventas_model->reporte_tickets1($mes, $aaa);
        $data['js'] = 'ventas/ventas_tickets_submit_js';
        $this->load->view('main', $data);
    }
    
    public function tickets_detalle($suc, $mes, $aaa)
    {
        
        
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['tit']='Reporte de Tickets del mes de'.$mesx;
        $data['a'] = $this->ventas_model->reporte_tickets2($suc, $mes, $aaa);
        $data['js'] = 'ventas/tickets_detalle_js';
        $this->load->view('main', $data);
    }
    
    function ventas_tcp_mes()
    {
       
        $data['titulo'] = "Reporte de Tickets";
        $data['tit']='Selecciona el mes y el a&ntilde;o';
        $data['mesx']=$this->Catalogos_model->busca_mes();
        $data['aaax']=$this->Catalogos_model->busca_anio();
        $data['js'] = 'ventas/ventas_tcp_mes_js';
        $this->load->view('main', $data);
    }
    
     function ventas_tcp_mes_excel()
    {
        $this->load->model('Ventas_model');
        $data['mesx'] = $this->input->post('mes');
        $data['aaax'] = $this->input->post('aaa');
        $data['query'] = $this->Ventas_model->ventas_tcp_mes_excel($this->input->post('mes'), $this->input->post('aaa'));
        $this->load->view('excel/ventas_tcp_mes_excel', $data);
    }
    
    function ventas_tarjetas_mes()
    {
       
        $data['titulo'] = "Reporte de Tickets";
        $data['tit']='Selecciona el mes y el a&ntilde;o';
        $data['mesx']=$this->Catalogos_model->busca_mes();
        $data['aaax']=$this->Catalogos_model->busca_anio();
        $data['js'] = 'ventas/ventas_tickets_js';
        $this->load->view('main', $data);
    }
    
    public function ventas_tarjetas_submit()
    {
        $mes= $this->input->post('mes');
        $aaa= $this->input->post('aaa');
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['tit']='Total de tarjetas vendidas x sucursal del mes de'.$mesx;
        $data['a'] = $this->ventas_model->reporte_tarjetas($mes, $aaa);
        $data['js'] = 'ventas/ventas_tarjetas_submit_js';
        $this->load->view('main', $data);
    }
    
    public function tarjetas_detalle($suc, $mes, $aaa)
    {
       
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['suc']= $suc;
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['tit']='Total de tarjetas de la sucursal '.$suc.' del mes de '.$mesx;
        $data['a'] = $this->ventas_model->reporte_tarjetas_empleado($suc, $mes, $aaa);
        $data['js'] = 'ventas/ventas_tarjetas_submit_js';
        $this->load->view('main', $data);
    }
    
    public function tarjetas_detalle1($nomina, $suc, $mes, $aaa)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['suc']= $suc;
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['tit']='Total de tarjetas a detalle por empleado del mes de '.$mesx;
        $data['a'] = $this->ventas_model->reporte_tarjetas_empleado1($nomina, $suc, $mes, $aaa);
        $data['js'] = 'ventas/ventas_tarjetas_submit_js';
        $this->load->view('main', $data);
    }
    
    function fecha()
    {
        $data['titulo'] = "Ventas Backoffice 2014";
        $data['js'] = 'ventas/fecha_js';
        $data['suc'] = $this->ventas_model->venta_backoffice_sucursales();
        $this->load->view('main', $data);
    }
    
    function fecha_submit()
    {
        ini_set("memory_limit","512M");
        $fecha_venta1 = $this->input->post('fecha_venta1');
        $fecha_venta2 = $this->input->post('fecha_venta2');
        $suc = $this->input->post('suc');
        $data['titulo'] = "Ventas de la". $suc ."de fecha: " . $fecha_venta1 . " al " . $fecha_venta2;
        $data['fecha_venta1'] = $fecha_venta1;
        $data['fecha_venta2'] = $fecha_venta2;
        $data['suc'] = $suc;
        $data['query'] = $this->ventas_model->venta_detalle($fecha_venta1, $fecha_venta2, $suc);
        $this->load->view('main', $data);
        
    }
    
    function fecha_submit_excel($fecha1, $fecha2, $suc)
    {
        $data['fecha1'] = $fecha1;
        $data['fecha2'] = $fecha2;
        $data['suc'] = $suc;
        $data['query'] = $this->ventas_model->venta_detalle($fecha1, $fecha2, $suc);
        $this->load->view('excel/fecha_submit_excel', $data);
    }
    
    function fecha1()
    {
        $data['titulo'] = "Ventas Yucif 2014";
        $data['js'] = 'ventas/fecha_js';
        $data['suc'] = $this->ventas_model->venta_yucif_sucursales();
        $this->load->view('main', $data);
    }
    
    function fecha1_submit()
    {
        $fecha_venta1 = $this->input->post('fecha_venta1');
        $fecha_venta2 = $this->input->post('fecha_venta2');
        $suc = $this->input->post('suc');
        $data['titulo'] = " Ventas " . $suc ." de fecha: " . $fecha_venta1 . " al " . $fecha_venta2;
        $data['fecha_venta1'] = $fecha_venta1;
        $data['fecha_venta2'] = $fecha_venta2;
        $data['suc'] = $suc;
        $data['query'] = $this->ventas_model->venta_detalle1($fecha_venta1, $fecha_venta2, $suc);
        $this->load->view('main', $data);
        
    }
    
    function fecha1_submit_excel($fecha1, $fecha2, $suc)
    {
        $data['fecha1'] = $fecha1;
        $data['fecha2'] = $fecha2;
        $data['suc'] = $suc;
        $data['query'] = $this->ventas_model->venta_detalle1($fecha1, $fecha2, $suc);
        $this->load->view('excel/fecha1_submit_excel', $data);
    }
    
///////////////////////////////////////////////////////////////////todas///////////////////////////////////////////////////////////////////////
    
    function fecha_2011()
    {
        $data['suc'] = $this->Catalogos_model->busca_suc_activas();
        $data['mes']=$this->Catalogos_model->busca_mes();
        $data['tit']='Selecciona sucursal y mes';
        $this->load->view('main', $data);
    }
    
    function fecha_2011_submit()
    {
        $mes = $this->input->post('mes');
        $suc = $this->input->post('suc');
        $data['titulo'] = " Ventas de la sucursal " . $suc ." del mes: " . $mes;
        $data['mes'] = $mes;
        $data['suc'] = $suc;
        $data['query'] = $this->ventas_model->venta_detalle_2011($mes, $suc);
        $this->load->view('main', $data);
        
    }
    
    function fecha2011_submit_excel($mes, $suc)
    {
        $data['mes'] = $mes;
        $data['suc'] = $suc;
        $data['query'] = $this->ventas_model->venta_detalle_2011($mes, $suc);
        $this->load->view('excel/fecha2011_submit_excel', $data);
    }
    
    function fecha_2012()
    {
        $data['suc'] = $this->Catalogos_model->busca_suc_activas();
        $data['mes']=$this->Catalogos_model->busca_mes();
        $data['tit']='Selecciona sucursal y mes';
        $this->load->view('main', $data);
    }
    
    function fecha_2012_submit()
    {
        $mes = $this->input->post('mes');
        $suc = $this->input->post('suc');
        $data['titulo'] = " Ventas de la sucursal " . $suc ." del mes: " . $mes;
        $data['mes'] = $mes;
        $data['suc'] = $suc;
        $data['query'] = $this->ventas_model->venta_detalle_2012($mes, $suc);
        $this->load->view('main', $data);
        
    }
    
    function fecha2012_submit_excel($mes, $suc)
    {
        $data['mes'] = $mes;
        $data['suc'] = $suc;
        $data['query'] = $this->ventas_model->venta_detalle_2012($mes, $suc);
        $this->load->view('excel/fecha2011_submit_excel', $data);
    }
    
    function fecha_2013()
    {
        $data['suc'] = $this->Catalogos_model->busca_suc_activas();
        $data['mes']=$this->Catalogos_model->busca_mes();
        $data['tit']='Selecciona sucursal y mes';
        $this->load->view('main', $data);
    }
    
    function fecha_2013_submit()
    {
        $mes = $this->input->post('mes');
        $suc = $this->input->post('suc');
        $data['titulo'] = " Ventas de la sucursal " . $suc ." del mes: " . $mes;
        $data['mes'] = $mes;
        $data['suc'] = $suc;
        $data['query'] = $this->ventas_model->venta_detalle_2013($mes, $suc);
        $this->load->view('main', $data);
        
    }
    
    function fecha2013_submit_excel($mes, $suc)
    {
        $data['mes'] = $mes;
        $data['suc'] = $suc;
        $data['query'] = $this->ventas_model->venta_detalle_2013($mes, $suc);
        $this->load->view('excel/fecha2011_submit_excel', $data);
    }
    
    function ventas_tipo()
    {
        $data['titulo'] = "Ventas Por Tipo de Sucursal";
        $data['js'] = 'ventas/ventas_tipo_js';
        $data['tipo'] = $this->ventas_model->ventas_tipo();
        $this->load->view('main', $data);
    }
    
    function ventas_tipo_excel()
    {
        $fecha = $this->input->post('fecha');
        $fecha2 = $this->input->post('fecha2');
        $tipo = $this->input->post('tipo');
        $data['fecha'] = $fecha;
        $data['fecha2'] = $fecha2;
        $data['query'] = $this->ventas_model->ventas_tipo_excel($fecha, $fecha2, $tipo);
        $this->load->view('excel/ventas_tipo_excel', $data);
    }
    
    function ticket_por_mes()
    {
        $this->load->dbutil();
        $this->load->helper('download');
        $a = $this->Ventas_model->ticket_mes_suc();
        $csv = $this->dbutil->csv_from_result($a);
        $name = 'Tickets_'.date('Ymd_His').'.csv';
        force_download($name, $csv);
    }
//////VER Y BORRAR
//////VER Y BORRAR
//////VER Y BORRAR
//////VER Y BORRAR
function s_ventas_comparativas_historicas_ger()
    {
        $id_plaza=$this->session->userdata('id_plaza');$aaa=date('Y');
        $data['tit']='PROMEDIO DE VENTAS DE LA ZONA '.$id_plaza;
        $data['q'] = $this->Ventas_model->ventas_comparativas_his_ger($id_plaza,$aaa);
        $data['js'] = 'ventas/s_ventas_comparativas_historicas_ger_js';
        $this->load->view('main', $data);
    }
    function s_ventas_comparativas_historicas_det_ger($mes)
    {
        $id_plaza=$this->session->userdata('id_plaza');$aaa=date('Y');
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['mes']=$mes;
        $data['tit']='PROMEDIO DE VENTAS DE LA ZONA '.$id_plaza.' DEL MES DE '.$mesx;
        $data['q'] = $this->Ventas_model->ventas_comparativas_his_det_ger($id_plaza,$aaa,$mes);
        $data['js'] = 'ventas/s_ventas_comparativas_historicas_js';
        $this->load->view('main', $data);
    }

}