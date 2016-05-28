<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventario extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('inventario_model');
        $this->load->model('Catalogos_model');
        $this->load->model('Procesos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    function calcula_ent_sal()
    {
        $fec1 = '2014-03-15';
        $fec2 = '2014-03-21';
        $sem = 11;
        $data['titulo'] = "Reporte de inventario";
        $data['tit'] = 'Reporte de inventario';
        $data['a'] = $this->Procesos_model->llena_mov_inv($fec1, $fec2, $sem);
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }

    function inv_farmacias()
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit'] = 'Reporte de inventario';
        $data['a'] = $this->inventario_model->inv_sem();
        $this->load->view('main', $data);
    }
    
    function inv_farmacias_imagen($sem)
    {
        $data['titulo'] = "Reporte de inventario de la semana " . $sem;
        $data['tit'] = 'Reporte de inventario';
        $data['sem'] = $sem;
        $data['a'] = $this->inventario_model->inv_imagen($sem);
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    function inv_farmacias_imagen_suc($sem, $tsuc)
    {
        $data['titulo'] = "Reporte de inventario de la semana " . $sem;
        $data['tit'] = 'Reporte de inventario';
        $data['a'] = $this->inventario_model->inv_imagen_tsuc($sem, $tsuc);
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }


    function mes()
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit'] = 'Reporte de inventario';
        $data['a'] = $this->inventario_model->mes();
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    function compa($aaa, $mes)
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit'] = 'Reporte de inventario';

        $data['a'] = $this->inventario_model->compa($aaa, $mes);
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }

    function compa_cia($aaa, $mes, $cia)
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit'] = 'Reporte de inventario';
        $data['aaa'] = $aaa;
        $data['mesx'] = $this->Catalogos_model->busca_mes_uno($mes);
        $data['dia'] = $this->inventario_model->busca_inv();
        $data['a'] = $this->inventario_model->compa_cia($aaa, $mes, $cia);
        $data['js'] = 'inventario/compa_cia_js';
        $this->load->view('main', $data);
    }
    function sumit_imprimir($aaa, $mes, $cia)
    {
        $data['a'] = $this->inventario_model->compa_cia($aaa, $mes, $cia);
        $data['aaa'] = $aaa;
        $data['mes'] = $mes;
        $data['cia'] = $cia;
        //$data['js'] = 'orden/imprime_js';
        $this->load->view('impresion/inv_cia', $data);
    }
    function mes_tod()
    {
        $data['titulo'] = "Reporte de inventario General";
        $data['tit1'] = 'Reporte de inventario Sucursales';
        $data['tit2'] = 'Reporte de inventario Almacenes';
        $data['a'] = $this->inventario_model->mes();
        $data['b'] = $this->inventario_model->mes_alm();
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    function mes_alm()
    {
        $data['titulo'] = "Reporte de inventario General";
        $data['tit1'] = 'Reporte de inventario Sucursales';
        $data['tit2'] = 'Reporte de inventario Almacenes';
        $data['b'] = $this->inventario_model->mes_alm();
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    function div_alm($aaa, $mes)
    {
        $data['titulo'] = "Reporte de inventario General";
        $data['tit'] = 'Reporte de inventario Almacenes';
        $data['a'] = $this->inventario_model->div_alm($aaa, $mes);
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    function div_alm_uno($aaa, $mes, $tipo)
    {
        $data['titulo'] = "Reporte de inventario General";
        $data['tit'] = 'Reporte de inventario Almacenes';
        $data['a'] = $this->inventario_model->div_alm_uno($aaa, $mes, $tipo);
        $data['js'] = 'inventario/div_alm_uno_js';
        $this->load->view('main', $data);
    }


    function entrada($tipo, $mes)
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit'] = 'Reporte de inventario';
        $data['a'] = $this->inventario_model->entrada($tipo, $mes);
        $data['js'] = 'inventario/entrada_js';
        $this->load->view('main', $data);
    }
    function entrada_suc($suc, $mes)
    {
        $data['titulo'] = "Reporte de inventario";
        $data['tit'] = 'Reporte de inventario';
        $data['a'] = $this->inventario_model->entrada_suc($suc, $mes);
        $data['js'] = 'inventario/entrada_suc_js';
        $this->load->view('main', $data);
    }

    function cargaInvChetumal($a)
    {
        $this->db->insert_batch('oficinas.inv_seguros_lote', $a);
        $sql = 'update oficinas.inv_seguros_lote i, catalogo.costos_gobierno c
        set i.costo=c.cos_che
        where suc=16000 and i.clave*1=c.clave*1;';
        $this->db->query($sql);
    }

    function invChetumal()
    {
        $this->almacen();
    }

    function invChetumal2()
    {
        $this->db->delete('oficinas.inv_seguros_lote', array('suc' => 16000));
        $QUINTANA = $this->load->database('quintana', true);

        $sql = "select 16000 as sucursal, trim(codbarras) as clave, trim(descripcion) as descripcion, a.cantidad, trim(lote) as lote, fechacaducidad, fechainv from almacen a
        join lotes l on a.idlote = l.id
        join articulos s on a.articulo = s.cvearticulo
        where idalmacen = 350;";
        $query = $QUINTANA->query($sql);

        $a = array();
        foreach ($query->result() as $row) {
            $b = array(
                'suc' => $row->sucursal,
                'clave' => str_replace('.', '', $row->clave),
                'lote' => $row->lote,
                'caducidad' => $row->fechacaducidad,
                'cantidad' => $row->cantidad,
                'codigo' => 0,
                'descri' => utf8_encode($row->descripcion),
                'costo' => 0);

            array_push($a, $b);
        }

        $this->cargaInvChetumal($a);
        $this->almacen();
    }


    function almacen()
    {
        $data['titulo'] = "Reporte de inventario de almacen";
        $data['tit'] = 'Reporte de inventario';
        $data['a'] = $this->inventario_model->almacen();
        //$data['js'] = 'inventario/entrada_suc_js';
        $this->load->view('main', $data);
    }

    function inv_excel($tipo)
    {
        $data['tipo'] = $tipo;
        $this->load->view('excel/inventario_excel', $data);
    }

    function inv_excel_caducado($id)
    {
        $data['id'] = $id;
        $this->load->view('excel/inventario_excel_caducado', $data);
    }

    function almacen_lot($tipo)
    {
        $data['titulo'] = "Reporte de inventario de almacen";
        $data['tit'] = 'Reporte de inventario';
        $data['a'] = $this->inventario_model->almacen_lot($tipo);
        $data['js'] = 'inventario/almacen_lot_js';
        $this->load->view('main', $data);
    }
    function almacen_lot_s($tipo)
    {
        $data['titulo'] = "Reporte de inventario de almacen";
        $data['tit'] = 'Reporte de inventario';
        $data['q'] = $this->inventario_model->almacen_lot_s($tipo);
        $data['tipo'] = $tipo;
        $data['js'] = 'inventario/almacen_lot_s_js';
        $this->load->view('main', $data);
    }
    function almacen_det($tipo)
    {
        $data['titulo'] = "Reporte de inventario de almacen";
        $data['tit'] = 'Reporte de inventario';
        $data['tipo'] = $tipo;
        $data['a'] = $this->inventario_model->almacen_det($tipo);
        
        $data['js'] = 'inventario/almacen_det_js';
        $this->load->view('main', $data);
    }
    function almacen_det1($tipo)
    {
        $data['titulo'] = "Reporte de inventario de almacen";
        $data['tit'] = 'Reporte de desplazamientos';
        $data['tipo'] = $tipo;
        $data['a'] = $this->inventario_model->almacen_det1($tipo);
        $data['js'] = 'inventario/almacen_det1_js';
        $this->load->view('main', $data);
    }
    function almacen_det_seg($tipo)
    {
        $data['titulo'] = "Reporte de inventario de almacen";
        $data['tit'] = 'Reporte de inventario';
        $data['a'] = $this->inventario_model->almacen_det_seg($tipo);
        $data['js'] = 'inventario/almacen_det_seg_js';
        $this->load->view('main', $data);
    }
    function inv_sucursal()
    {
        $data['titulo'] = "Reporte de inventario de almacen y farmacias";
        $data['tit'] = 'Reporte de inventario de almacen y farmacias Doctor Ahorro';
        $data['a'] = $this->inventario_model->inv_sucursal();
        $data['js'] = 'inventario/inv_sucursal_js';
        $this->load->view('main', $data);
    }
    function inv_sucursal_espe($sec)
    {
        $data['titulo'] = "Reporte de inventario de farmacias ";
        $data['tit'] = 'Reporte de inventario de almacen y farmacias Doctor Ahorro';
        $data['a'] = $this->inventario_model->inv_sucursal_espe($sec);
        $data['js'] = 'inventario/inv_sucursal_espe_js';
        $this->load->view('main', $data);
    }
    function inv_gral()
    {
        $data['titulo'] = "Reporte de inventario de farmacias";
        $data['tit'] = 'Reporte de inventario';
        $data['a'] = $this->inventario_model->inv_gral();
        $data['js'] = 'inventario/inv_gral_js';
        $this->load->view('main', $data);
    }
    function inv_sucursal_descon()
    {
        $data['titulo'] = "Reporte de inventario de almacen y farmacias ";
        $data['tit'] = 'Reporte de inventario de almacen y farmacias Doctor Ahorro descontinuados';
        $data['a'] = $this->inventario_model->inv_sucursal_descon();
        $data['js'] = 'inventario/inv_sucursal_js';
        $this->load->view('main', $data);
    }
    function inv_sucursal_descon_suc($sec)
    {
        $data['titulo'] = "Reporte de inventario de almacen y farmacias ";
        $data['tit'] = 'Reporte de inventario de almacen y farmacias Doctor Ahorro descontinuados';
        $data['a'] = $this->inventario_model->inv_sucursal_espe($sec);
        $data['js'] = 'inventario/inv_sucursal_espe_js';
        $this->load->view('main', $data);
    }
    //function busqueda()
    //{
    //  $data['titulo'] = "B&uacute;squeda por Clave, Descripci&oacute;n o Lote";
    //$data['tabla']= 'Escribe la b&uacute;squeda deseada y presiona buscar.';

    //  $data['js'] = 'inventario/busqueda1_js';
    // $this->load->view('main', $data);
    //}

    function busqueda()
    {

        $data['titulo'] = 'B&uacute;squeda por Clave, Descripci&oacute;n o Lote';
        //$data['js'] = 'inventario/busqueda1_js';
        $this->load->view('main', $data);

    }


    function busqueda_submit()
    {
        $data['titulo'] = '';
        $data['tit'] = 'INVENTARIO ';
        $data['descri'] = $this->input->post('descri');
        $data['clave'] = $this->input->post('clave');
        $data['lot'] = $this->input->post('lot');
        $data['query'] = $this->inventario_model->busca_inventario_clave($data['descri'] =
            $this->input->post('descri'), $this->input->post('clave'), $this->input->post('lot'));
        $data['js'] = 'inventario/busqueda_submit_js';
        $this->load->view('main', $data);
    }


    function busca_inventario()
    {

        $data['query'] = $this->inventario_model->busca_inventario_clave();
        $this->load->view('main', $data);
    }

    function caducidad()
    {
        $data['titulo'] = "Consulta";
        $data['caducidad'] = $this->inventario_model->busca_caducidad();
        $this->load->view('main', $data);
    }

    function caducidad_submit()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "Reporte de Inventarios Proximos a Caducar";
        $id = $this->input->post('id');
        $data['s'] = $this->inventario_model->consulta_caducidad($id);
        $data['id'] = $id;
        $data['js'] = 'inventario/caducidad_submit_js';
        $this->load->view('main', $data);

    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function ventas_cortes()
    {
        $data['titulo'] = "Venta de cortes";
        $data['tit'] = 'CONCENTRADO DE VENTAS POR IMAGEN SIN IVA';
        $data['a'] = $this->ventas_model->ventas_cortes('', '');
        $data['js'] = 'ventas/ventas_cortes_js';
        $this->load->view('main', $data);
    }
    function ventas_cortes_suc($mes, $tipo2)
    {
        $imagen = $this->Catalogos_model->busca_imagen_uno($tipo2);
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "Venta de cortes";
        $data['tit'] = 'CONCENTRADO DE VENTAS POR IMAGEN SIN IVA DE ' . trim($imagen) .
            ' DEL MES DE ' . trim($mesx);
        $data['a'] = $this->ventas_model->ventas_cortes($mes, $tipo2);
        $data['js'] = 'ventas/ventas_cortes_suc_js';
        $this->load->view('main', $data);
    }
    function ventas_cortes_ger()
    {
        $data['titulo'] = "Venta de cortes";
        $data['tit'] = 'CONCENTRADO DE VENTAS POR GERENTE SIN IVA';
        $data['a'] = $this->ventas_model->ventas_cortes_ger('', '');
        $data['js'] = 'ventas/ventas_cortes_ger_js';
        $this->load->view('main', $data);
    }
    function ventas_cortes_ger_mes($mes, $ger)
    {
        $data['titulo'] = "Venta de cortes";
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $gerx = $this->Catalogos_model->busca_ger_uno($ger);
        $data['tit'] = 'CONCENTRADO DE VENTAS POR GERENTE SIN IVA DE ' . trim($gerx) .
            ' DEL MES DE ' . trim($mesx);
        $data['a'] = $this->ventas_model->ventas_cortes_ger($mes, $ger);
        $data['js'] = 'ventas/ventas_cortes_ger_js';
        $this->load->view('main', $data);
    }
    function ventas_cortes_ger_mes_sup($mes, $sup)
    {
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $supx = $this->Catalogos_model->busca_sup_uno($sup);
        $data['titulo'] = "Venta de cortes";
        $data['tit'] = 'CONCENTRADO DE VENTAS POR GERENTE SIN IVA DE ' . trim($supx) .
            ' DEL MES DE ' . trim($mesx);
        $data['a'] = $this->ventas_model->ventas_cortes_ger($mes, $sup);
        $data['js'] = 'ventas/ventas_cortes_suc_js';
        $this->load->view('main', $data);
    }
    function ventas_cortes_sup()
    {
        $id_plaza = $this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de cortes";
        $data['tit'] = 'CONCENTRADO DE VENTAS POR ZONAS SIN IVA';
        $data['a'] = $this->ventas_model->ventas_cortes_ger('', $id_plaza);
        $data['js'] = 'ventas/ventas_cortes_sup_js';
        $this->load->view('main', $data);
    }
    function ventas_cortes_succ()
    {
        $id_plaza = $this->session->userdata('id_plaza');
        $data['titulo'] = "Venta de cortes";
        $data['tit'] = 'CONCENTRADO DE VENTAS POR ZONAS SIN IVA';
        $data['a'] = $this->ventas_model->ventas_succ('', $id_plaza);
        $data['js'] = 'ventas/ventas_cortes_succ_js';
        $this->load->view('main', $data);
    }

    //////////////////////////////////////////////////////////inventarios moronatti/////////////////////////////////////////////////
    function s_inv_metro()
    {
        $data['titulo'] = "Reporte de inventario de la semana ";
        $data['tit'] = 'Reporte de inventario';
        $data['a'] = $this->inventario_model->inv_metro_model();
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    function s_inv_metro_det($suc)
    {
        $data['titulo'] = "Reporte de inventario de la semana ";
        $data['tit'] = 'Reporte de inventario';
        if ($suc == 179 || $suc == 178 || $suc == 176 || $suc == 180 || $suc=177) {
            $data['a'] = $this->inventario_model->inv_metro_model_det_back($suc);
        } else {
            $data['a'] = $this->inventario_model->inv_metro_model_det($suc);
        }

        $data['js'] = 'inventario/s_inv_metro_det_js';
        $this->load->view('main', $data);
    }
    
    function devolucion_sucursales()
    {
        $data['titulo'] = "Claves permitidas para devoluci&oacute;n de sucursales.";
        $data['tit'] = 'Busqueda de claves permitidas para devoluci&oacute;n de sucursales';
        $data['js'] = 'inventario/devolucion_sucursales_js';
        //$data['js'] = 'inventario/inventario_js';
        $this->load->view('main', $data);
    }
    
    function buscaClavesDevolucion()
    {
        $sec = $this->input->post('sec');
        $data['query'] = $this->inventario_model->getBusquedaSecForDevolucion($sec);
        $data['query2'] = $this->inventario_model->getBusquedaSecForDevolucionInv($sec);
        $this->load->view('inventario/buscaClavesDevolucion', $data);
    }
    
    function permitirDevolucion($id)
    {
        $this->inventario_model->permitirSecuencia($id);
    }
    
    function permitirDevolucion2($id)
    {
        $this->inventario_model->permitirSecuencia2($id);
    }
    
    function permitidos()
    {
        $data['query'] = $this->inventario_model->getPermitidosDevolucionSucursal();
        $this->load->view('inventario/permitidosDevolucion', $data);
    }
    
    function eliminarDevolucion($devolverID)
    {
        $this->inventario_model->eliminarSecuencia($devolverID);
    }
    
    function s_devolucion_autorizada()
    {
            $data['titulo'] = "Devoluciones Autorizadas";
            $data['a'] = $this->inventario_model->devolucion_compras_autiruzada();
            $data['js'] = 'inventario/s_devolucion_autorizada_js';
            $this->load->view('main', $data);
    }
    function s_devolucion_autorizada_det($sec,$lote)
    {
            $data['titulo'] = "Devoluciones Autorizadas";
            $data['a'] = $this->inventario_model->devolucion_compras_autiruzada_det($sec,$lote);
            $data['js'] = 'inventario/s_devolucion_autorizada_det_js';
            $this->load->view('main', $data);
    }
    
    function a_inv_segpop_mat()
    
    {
            $data['titulo'] = "Inventario de Material de curacion";
            $data['a'] = $this->inventario_model->inv_segpop_almacenes(1);
            $data['js'] = 'inventario/a_inv_segpop_mat_js';
            $this->load->view('main', $data);  
    }

}
