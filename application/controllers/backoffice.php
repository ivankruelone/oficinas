<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class backoffice extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('backoffice_model_proceso');
        $this->load->model('backoffice_model_central');
        $this->load->model('backoffice_model_ventas');
        $this->load->model('Catalogos_model');
        $this->load->model('procesos_model');
        $this->load->model('Envio_model_as400_fin');
        $this->load->model('Procesos_model_pedido_f');
        $this->load->model('Pedido_model_fenix');
        $this->load->model('backoffice_model_replicas');
        $this->load->model('backoffice_model');
        
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    function a_general($id)
    {

        $data['titulo'] = "PROCESOS";
        $data['q'] = $this->backoffice_model_central->back_controlador($id);
        $this->load->view('main', $data);

    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function a_solo_catalogos()
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $this->backoffice_model_central->sol_catalogos();
        
        $q = $this->backoffice_model_central->enlazar_var(9);
        $r = $q->row();
        $this->backoffice_model_central->envio_archivos($r->ftp, $r->usuario, $r->
            contra, $r->archivo);
        $q = $this->backoffice_model_central->enlazar_var(10);
        $r = $q->row();
        $this->backoffice_model_central->envio_archivos($r->ftp, $r->usuario, $r->
            contra, $r->archivo);
        $a = array('fecha_gen' => date('Y-m-d H:i:s'));
        $this->db->where('id', 1);
        $this->db->update('back.controlodar_nuevo', $a);
        redirect('backoffice/a_general/1');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    function a_solo_ventas_inv()
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $dia=date('d');
        $mes=date('m');
        $aaa=date('Y');
        $mes=($mes*1);
        $this->backoffice_model_central->sol_inventarios();
        $this->backoffice_model_ventas->proceso_ventas_llegan_archivos($aaa,$mes);
        if($dia<=7){$mesa=date('m')-1;$mesa=$mesa*1;
        $this->backoffice_model_ventas->venta_mes($aaa,$mesa);
        }
        $this->backoffice_model_ventas->venta_mes($aaa,$mes);
        $this->backoffice_model_ventas->inserta_cortes_caja($aaa);
        $this->backoffice_model_ventas->cortes_ctl_fin($aaa,$mes);
        $this->backoffice_model_ventas->venta_90_dias();
        $a = array('fecha_gen' => date('Y-m-d H:i:s'));
        $this->db->where('id', 2);
        $this->db->update('back.controlodar_nuevo', $a);
        redirect('backoffice/a_general/2');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    function a_solo_movimientos()
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $this->backoffice_model_central->sol_movimientos();
        $a = array('fecha_gen' => date('Y-m-d H:i:s'));
        $this->db->where('id', 3);
        $this->db->update('back.controlodar_nuevo', $a);
        redirect('backoffice/a_general/3');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////

    function a_solo_facturas()
    {
        $data['titulo'] = "FACTURAS RECIBIDAS";
        $data['titulo2'] = "NIVEL DE SURTIDO DE PEDIDOS PROCESADOS";
        $data['q'] = $this->backoffice_model->ver_facturas();
        $data['q1'] = $this->backoffice_model->ver_pedidos_nivel();
        $this->load->view('main', $data);
    }
     function a_fac_producto($aaa,$mes,$prv)
    {
        $prvx = $this->Catalogos_model->busca_prv_uno($prv);
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "DETALLE DEL PROVEEDOR ".$prvx." DEL MES ".$mesx." DEL ".$aaa;
        $data['q'] = $this->backoffice_model->ver_facturas_producto($aaa,$mes,$prv);
        $data['js'] = 'backoffice/a_fac_producto_js';
        $this->load->view('main', $data);
    }
    function a_fac_factura($aaa,$mes,$prv)
    {
        $prvx = $this->Catalogos_model->busca_prv_uno($prv);
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "DETALLE DEL PROVEEDOR ".$prvx." DEL MES ".$mesx." DEL ".$aaa;
        $data['q'] = $this->backoffice_model->ver_facturas_factura($aaa,$mes,$prv);
        $data['js'] = 'backoffice/a_fac_factura_js';
        $this->load->view('main', $data);
    }
    function a_fac_sucursal($aaa,$mes,$prv)
    {
        $prvx = $this->Catalogos_model->busca_prv_uno($prv);
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "DETALLE DEL PROVEEDOR ".$prvx." DEL MES ".$mesx." DEL ".$aaa;
        $data['q'] = $this->backoffice_model->ver_facturas_sucursal($aaa,$mes,$prv);
        $data['js'] = 'backoffice/a_fac_sucursal_js';
        $this->load->view('main', $data);
    }
    function a_fac_dia($aaa,$mes,$prv)
    {
        $prvx = $this->Catalogos_model->busca_prv_uno($prv);
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "DETALLE DEL PROVEEDOR ".$prvx." DEL MES ".$mesx." DEL ".$aaa;
        $data['q'] = $this->backoffice_model->ver_facturas_dia($aaa,$mes,$prv);
        $data['js'] = 'backoffice/a_fac_dia_js';
        $this->load->view('main', $data);
    }
    function a_ped_sucursal($aaa,$mes,$prv)
    {
        $prvx = $this->Catalogos_model->busca_prv_uno($prv);
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "DETALLE DEL PROVEEDOR ".$prvx." DEL MES ".$mesx." DEL ".$aaa;
        $data['q'] = $this->backoffice_model->ver_ped_suc($aaa,$mes,$prv);
        $data['js'] = 'backoffice/a_ped_sucursal_js';
        $this->load->view('main', $data);
    }
    function a_ped_producto($aaa,$mes,$prv)
    {
        $prvx = $this->Catalogos_model->busca_prv_uno($prv);
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "DETALLE DEL PROVEEDOR ".$prvx." DEL MES ".$mesx." DEL ".$aaa;
        $data['q'] = $this->backoffice_model->ver_ped_pro($aaa,$mes,$prv);
        $data['js'] = 'backoffice/a_ped_sucursal_js';
        $this->load->view('main', $data);
    }
    function a_ped_dia($aaa,$mes,$prv)
    {
        $prvx = $this->Catalogos_model->busca_prv_uno($prv);
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "DETALLE DEL PROVEEDOR ".$prvx." DEL MES ".$mesx." DEL ".$aaa;
        $data['q'] = $this->backoffice_model->ver_ped_dia($aaa,$mes,$prv);
        $data['js'] = 'backoffice/a_ped_sucursal_js';
        $this->load->view('main', $data);
    }
    ////////////////////////////////////////////////////////////////////////////////
    function a_solo_facturas_aplica()
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $this->backoffice_model_central->sol_facturas();
        $a = array('fecha_gen' => date('Y-m-d H:i:s'));
        $this->db->where('id', 4);
        $this->db->update('back.controlodar_nuevo', $a);
        redirect('backoffice/a_solo_facturas');
    }
    ////////////////////////////////////////////////////////////////////////////////
    function a_pedidos_mayorista()
    {
     $data['titulo']='GENERAR PEDIDOS A MAYORISTAS';
     $data['titulox']='GENERAR PEDIDOS A MAYORISTAS POR DIAS OFERTAS ESPECIALES';
     $data['titulo1']='SUCURSALES GENERADAS';
     $data['q'] = $this->Pedido_model_fenix->pre_pedido_fanasa();
     $this->load->view('main', $data);   
    }
    ///////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////
    function a_pedidos_fenix_a_cedis()
    {
     $data['titulo']='Generar Pedido a Sucursales Fenix de Genericos';
     $data['titulo1']='SUCURSALES GENERADAS';
     $data['q'] = $this->Pedido_model_fenix->pedidos_genericos_sec();
     redirect('backoffice/a_pedidos_mayorista');   
    }
    ///////////////////////////////////////////////////////////////////////////////
    function a_pedidos_farmacos($var)
    {        
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
            if($var==1){$sucursales="(103,105,106,107,108,109,112,114,116,129,193,201,202,501,504,511,552)";}
        elseif($var==2){$sucursales="(103,105,106,107,108,109,112,114,116,129,193,201,202,501,504,511,552,806,812)";}
        elseif($var==3){$sucursales="(806,812)";}
        $this->backoffice_model_central->__solo_fanasa();
        $this->Pedido_model_fenix->formula_fanasa($sucursales);
     redirect('backoffice/a_pedidos_mayorista');   
    }
    
    function a_formula_fanasa_dias($var)
    {        
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
            if($var==1){$sucursales="(103,105,106,107,108,109,112,114,116,129,193,201,202,501,504,511,552)";}
        elseif($var==2){$sucursales="(103,105,106,107,108,109,112,114,116,129,193,201,202,501,504,511,552,806,812)";}
        elseif($var==3){$sucursales="(806,812)";}
        $this->backoffice_model_central->__solo_fanasa();
        $this->Pedido_model_fenix->formula_fanasa_dias($sucursales);
     redirect('backoffice/a_pedidos_mayorista');   
    }
    function a_pedidos_envio_mayorista($fol)
    {        
        $nom=$this->Pedido_model_fenix->graba_archivo($fol);
        $q = $this->backoffice_model_central->enlazar_var(9);
        $r = $q->row();
        $this->backoffice_model_central->envio_pedido_fanasa($r->ftp, $r->usuario, $r->contra, $r->archivo,$nom);
        $q = $this->backoffice_model_central->enlazar_var(10);
        $r = $q->row();
        $this->backoffice_model_central->envio_pedido_fanasa($r->ftp, $r->usuario, $r->contra, $r->archivo,$nom);
        $a = array('fecha_gen' => date('Y-m-d H:i:s'));
        $this->db->where('id', 6);
        $this->db->update('back.controlodar_nuevo', $a);
        die();
        redirect('backoffice/a_general/6');
    }
    
    function addiciona_pedido_esp_for()
    {
    $this->Pedido_model_fenix->pre_pedido_fanasa_adisiona_especial();
    redirect('backoffice/a_pedidos_mayorista');
    }
    
    function a_pedidos_envio_mayorista_bor($suc)
    {
    $this->Pedido_model_fenix->pre_pedido_fanasa_borra_suc($suc);
    redirect('backoffice/a_pedidos_mayorista');
    }
    
    ////////////////////////////////////////////////////////////////////////////////

    function a_poliza_inv()
    {
        $data['titulo'] = 'GENERA POLIZA DE INVENTARIO';
        $data['sem_corrida'] = $this->backoffice_model_central->semana_corrida();
        $data['sem_respal'] = $this->backoffice_model_central->semana_respaldada();
        $data['q'] = $this->backoffice_model_central->poliza_inv();
        $this->load->view('main', $data);
    }
    function a_poliza_inv_det()
    {
        $this->backoffice_model_central->poliza_inv_detalle($this->input->post('aaa'), $this->
            input->post('mes'), $this->input->post('dia'), $this->input->post('sem'));
        redirect('backoffice/a_poliza_inv');
    }
    function respalda_sem_inv($sem)
    {
        $aaa = date('Y');
        $this->backoffice_model_central->respaldo_poliza_inv($sem, $aaa);
        redirect('backoffice/a_poliza_inv');
    }
    function envia_inv_as400_archivo($aaa, $sem)
    {
        $this->Envio_model_as400_fin->envia_inv_as400($aaa, $sem);
        redirect('backoffice/s_inventario_semanal/7');
    }
    function envia_inv_as400_archivo_sol()
    {
        $aaa=2016;$sem=13;
        $this->Envio_model_as400_fin->envia_inv_as400($aaa, $sem);
        //redirect('backoffice/s_inventario_semanal/7');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////

    function a_poliza_almacen()
    {
        $data['titulo'] = 'GENERA POLIZA DE INVENTARIO';
        $data['q'] = '';
        $this->load->view('main', $data);
    }
    function a_poliza_almacen_generar()
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $this->backoffice_model_central->poliza_34_almacen($this->input->post('aaa'), $this->
            input->post('mes'));
        $this->backoffice_model_central->poliza_34_almacen_excel($this->input->post('aaa'),
            $this->input->post('mes'));
        $this->load->dbutil();
        $this->load->helper('download');
        $a = $this->backoffice_model_central->poliza_34_almacen_excel($this->input->
            post('aaa'), $this->input->post('mes'));
        $csv = $this->dbutil->csv_from_result($a);
        $name = 'Pol.34_' . date('Ymd_His') . '.csv';
        force_download($name, $csv);
        redirect('backoffice/a_poliza_inv');
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////////tabla
    function s_menus()
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $data['titulo'] = "PROCESOS GENERALES DIARIOS";
        $data['q'] = $this->backoffice_model_proceso->enlazar(1);
        $data['a'] = $this->backoffice_model_proceso->enlazar(2);
        //$data['js'] = 'backoffice/rev_ven_back_js';
        $this->load->view('main', $data);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////ventas
    function extrae_venta($id)
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $q = $this->backoffice_model_proceso->enlazar_var($id);
        $r = $q->row();
        $this->backoffice_model_proceso->enlace_venta($r->ftp, $r->usuario, $r->contra,
            $r->archivo);
    }
    function procesa_ventas($id)
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        if ($id == 1) {
            ;
            $mon = date('m');
        } else {
            $mon = date('m') - 1;
        }
        if (date('m') == 1) {
            $aaa = (date('Y') - 1);
        } else {
            $aaa = date('Y');
        }
        $this->backoffice_model_proceso->ventas_proceso($aaa, $mon);
    }

    function s_rev_ven_back($id)
    {
        $data['titulo'] = "INVENTARIOS SOLO BACK";
        $data['q'] = $this->backoffice_model->diario_ven_back($id);
        $data['js'] = 'backoffice/s_rev_ven_back_js';
        $this->load->view('main', $data);
    }
    function s_falta_datos()
    {
        $data['titulo'] = "Informacion de sucursales con problemas de replicas";
        $this->backoffice_model->guarda_ventas_f();
        $data['q'] = $this->backoffice_model->vista_todo();
        $data['js'] = 'backoffice/s_rev_ven_back_js';
        $this->load->view('main', $data);
    }
    function s_falta_datos_observacion($id)
    {
        $data['titulo'] = "Informacion de sucursales con problemas de replicas";
        $data['id'] = $id;
        $data['q'] = $this->backoffice_model->vista_todo_una($id);
        $data['js'] = 'backoffice/s_rev_ven_back_js';
        $this->load->view('main', $data);
    }
    function s_falta_datos_observacion_sumit()
    {
        $a = array('observacion' => $this->input->post('obs'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('oficinas.problemas_conexion', $a);
        redirect('backoffice/s_falta_datos');
    }

    function s_ventas_detalle($id)
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $data['titulo'] = "VENTAS";
        $data['q'] = $this->backoffice_model->ventas_mensuales($id);
        $data['js'] = 'backoffice/s_ventas_detalle_js';
        $this->load->view('main', $data);
    }
    function s_ventas_detalle_suc($suc, $mes)
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $data['titulo'] = "VENTAS";
        $data['q'] = $this->backoffice_model->ventas_mensuales_suc($suc, $mes);
        $data['js'] = 'backoffice/s_ventas_detalle_js';
        $this->load->view('main', $data);
    }
    function s_ventas_mensuales_general($id)
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $data['titulo'] = "VENTAS";
        if ($id == 1) {
            $mes = date('m');
            $aaa = date('Y');
        } else {
            if (date('m') == 1) {
                $aaa = date('Y') - 1;
                $mes = 12;
            }
        }
        $fec_limite = $this->Catalogos_model->fecha_lim_vta();
        $n = $this->Catalogos_model->domingos_del_mes($aaa, $mes, $fec_limite);

        $data['fec_limite'] = $fec_limite;
        $data['n'] = $n;
        $data['q'] = $this->backoffice_model->ventas_mensuales_general($aaa, $mes);
        $data['js'] = 'backoffice/s_ventas_mensuales_general_js';
        $this->load->view('main', $data);
    }
    function s_gontor_imperial()
    {
        $data['titulo'] = "VENTAS DE GONTOR E IMP";
        $data['tit'] = 'Reporte de ventas gontor e imperiales';
        $data['q'] = $this->backoffice_model->gon_imp();
        $this->load->view('main', $data);
    }
    function s_gontor_imperial_mes($fec)
    {
        $data['titulo'] = "VENTAS DE GONTOR E IMP";
        $data['fec'] = $fec;
        $mes = substr($fec, 5, 2);

        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['tit'] = 'VENTAS DEL MES DE ' . $mesx . ' DEL ' . substr($fec, 0, 4);
        $data['q'] = $this->backoffice_model->gon_imp_mes($fec);
        $data['js'] = 'backoffice/s_gontor_imperial_mes_js';
        $this->load->view('main', $data);
    }
    function genera_gontor_imperial($fec)
    {
        $this->backoffice_model_proceso->genera_gon_imp($fec);
        redirect('backoffice/s_gontor_imperial_mes/' . $fec);
    }
    function envia_gontor_imperial($fec)
    {
        $this->backoffice_model_proceso->envia_gontor_imp($fec);
        redirect('backoffice/s_gontor_imperial_mes/' . $fec);
    }
    function s_comision_x_venta()
    {
        $data['titulo'] = "VENTAS DE GONTOR E IMP";
        $data['tit'] = 'Reporte de ventas gontor e imperiales';
        $data['q'] = $this->backoffice_model->gon_imp();
        $this->load->view('main', $data);
    }
    function s_comision_x_insentivo()
    {
        $data['titulo'] = "VENTAS DE GONTOR E IMP";
        $data['tit'] = 'Reporte de ventas gontor e imperiales';
        $data['q'] = $this->backoffice_model->gon_imp();
        $this->load->view('main', $data);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////catalogos
    function extrae_catalogo($id)
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $q = $this->backoffice_model_proceso->enlazar_var($id);
        $r = $q->row();
        $this->backoffice_model_proceso->enlace_catalogos($r->ftp, $r->usuario, $r->
            contra, $r->archivo);
    }
    function procesa_catalogos()
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $this->backoffice_model_proceso->procesar_cat();
    }
    function envio_archivos($id)
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $q = $this->backoffice_model_proceso->enlazar_var($id);
        $r = $q->row();
        $this->backoffice_model_proceso->envio_archivos($r->ftp, $r->usuario, $r->
            contra, $r->archivo);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////inventarios
    function extrae_inventario($id)
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $q = $this->backoffice_model_proceso->enlazar_var($id);
        $r = $q->row();
        $this->backoffice_model_proceso->enlace_inventario($r->ftp, $r->usuario, $r->
            contra, $r->archivo);
    }

    function s_inventario_semanal($id)
    {
        ini_set('memory_limit', '20000M');
        set_time_limit(0);
        $data['titulo'] = "Genera inventario";
        $data['q'] = $this->backoffice_model->ver_inv();
        $data['a'] = $this->backoffice_model->ver_inv_suc();
        $data['b'] = $this->backoffice_model->ver_inv_suc_his();
        $data['js'] = 'backoffice/s_inventario_semanal_js';
        $this->load->view('main', $data);
    }
    function genera_inv()
    {
        $aaa = substr($this->input->post('fecha'), 0, 4);
        $mes = substr($this->input->post('fecha'), 5, 2);
        $dia = substr($this->input->post('fecha'), 8, 2);
        $sem = $this->input->post('sem');
        $this->backoffice_model_proceso->genera_inv($aaa, $mes, $dia, $sem);
        redirect('backoffice/s_inventario_semanal/7');
    }
    function respalda_inv($aaa, $mes, $dia, $sem)
    {
        $this->backoffice_model_proceso->respalda_inv($aaa, $mes, $dia, $sem);
        redirect('backoffice/s_inventario_semanal/7');
    }
    function s_vista_inv_datos()
    {
        $data['titulo'] = "Genera inventario";
        $data['q'] = $this->backoffice_model->verifica_inv_mov();
        $data['js'] = 'backoffice/s_vista_inv_datos_js';
        $this->load->view('main', $data);
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////inventario
    function s_inventario_detalle()
    {
        $data['titulo'] = "INVENTARIOS SOLO BACK";
        $data['q'] = $this->backoffice_model->diario_inv_back();
        $data['js'] = 'backoffice/s_inventario_detalle_js';
        $this->load->view('main', $data);
    }
    function pro_inv()
    {
        $data['titulo'] = "Genera inventario";
        $data['q'] = $this->procesos_model->ver_inv();
        $data['a'] = $this->procesos_model->ver_inv_suc();
        $data['b'] = $this->procesos_model->ver_inv_suc_his();
        $data['js'] = 'backoffice/pro_inv_js';
        $this->load->view('main', $data);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////optimo
    function s_optimo_fenix()
    {
        $data['mes'] = $this->Catalogos_model->busca_mes();
        $this->load->view('main', $data);
    }
    function s_optimo_fenix_mes()
    {
        $mat = 30;
        $pat = 35;
        $not_in = $this->input->post('not_in');
        $this->backoffice_model->genera_optimo($this->input->post('mes'), $pat, $mat, $not_in);
    }
    function s_optimo_fenix_mes_MAT()
    {
        $mat = 30;
        $pat = 35;
        $not_in = $this->input->post('not_in');
        $this->backoffice_model->genera_optimo($this->input->post('mes'), $pat, $mat, $not_in);
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////replicas
    function s_replicas_suc()
    {
        $data['suc'] = $this->Catalogos_model->Busca_sucursal_replicas();
        $data['tipo'] = $this->Catalogos_model->Busca_tipo_replicas();
        $this->load->view('main', $data);
    }
    function replicas_sucursal()
    {
        $suc = $this->input->post('suc');
        $tipo = $this->input->post('tipo');
        $this->backoffice_model_replicas->rep_sucursal($suc, $tipo);
    }
    function s_control_cortes_back()
    {
        $data['suc'] = $this->Catalogos_model->Busca_sucursal_replicas();
        $this->load->view('main', $data);
    }
    function sumit_control_cortes_back()
    {
        $this->backoffice_model_proceso->cortes_control($this->input->post('suc'));
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////pedido especial marzam
    function s_pedido_marzam()
    {
        $this->Procesos_model_pedido_f->pedido_esp_marzam();
        $data['titulo'] = 'PEDIDO ESPECIAL DE MARZAM';
        $data['q'] = $this->backoffice_model->Pedido_especial();
        $data['qq'] = $this->backoffice_model->Pedido_especial_final();
        $data['js'] = 'backoffice/s_pedido_marzam_js';
        $this->load->view('main', $data);
    }
    function graba_pedido()
    {
        $this->Procesos_model_pedido_f->pedido_esp_marzam_graba(500);
        redirect('backoffice/s_pedido_marzam');
    }
    function s_pedido_for_marzam()
    {
        $this->Procesos_model_pedido_f->pedido_for_marzam();
        $data['titulo'] = 'PEDIDO FORMULADO DE MARZAM';
        $data['q'] = $this->backoffice_model->pedido_for_especial();
        $data['qq'] = $this->backoffice_model->pedido_for_final();
        $data['js'] = 'backoffice/s_pedido_marzam_js';
        $this->load->view('main', $data);
    }
    function graba_for_pedido()
    {
        $this->Procesos_model_pedido_f->pedido_for_marzam_graba(500);
        redirect('backoffice/s_pedido_marzam');
    }

    function envia_pedido($prv, $fol)
    {
        if ($prv == 500) {
            $this->Procesos_model_pedido_f->envia_ped_marzam($fol);
        }
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////facturas de mayoristas.
    
    
    function s_genera_banxico()
    {
        $data['titulo'] = "Genera archivo catalogo para banxico";
        $data['q'] = $this->backoffice_model->detalle_banxico();
        $data['js'] = 'backoffice/s_factura_central_suc_js';
        $this->load->view('main', $data);
    }
    function sumit_banxico()
    {
        $this->backoffice_model_proceso->envio_banxico($this->input->post('fec'), $this->
            input->post('lis'), '1');
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
    function genera_archivos_back()
    {
        $this->backoffice_model_proceso->genera_archivos();
        redirect('backoffice/enlace_gral');
    }
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////


}
