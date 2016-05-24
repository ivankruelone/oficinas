<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entradas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('entradas_model');
        $this->load->model('Catalogos_model');
      
        

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
    function facturas()
    {
        $data['titulo'] = "Facturas";
        $data['tit']='CONCENTRADO DE COMPRA POR IMAGEN SIN IVA';
        $data['a'] = $this->entradas_model->facturas('','');
        $data['js'] = 'entradas/facturas_js';
        $this->load->view('main', $data);
    }
    function facturas_suc($mes,$tipo2)
    {
        $imagen=$this->Catalogos_model->busca_imagen_uno($tipo2);
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "Facturas";
        $data['tit']='CONCENTRADO DE VENTAS POR IMAGEN SIN IVA DE '.trim($imagen).' DEL MES DE '.trim($mesx);
        $data['a'] = $this->entradas_model->facturas_suc($mes,$tipo2);
        $data['js'] = 'entradas/facturas_suc_js';
        $this->load->view('main', $data);
    }
    
 
   
function facturas_g($fa)
    {
        $data['titulo'] = "Facturas por Gerente Regional";
        $data['tit']='CONCENTRADO DE COMPRA POR IMAGEN SIN IVA';
        $data['a'] = $this->entradas_model->facturas_g($fa,'','');
        $data['js'] = 'entradas/facturas_g_js';
        $this->load->view('main', $data);
    }

function facturas_gs($fa,$mes,$ger)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $gerx=$this->Catalogos_model->busca_ger_uno($ger);
        $data['titulo'] = "Facturas";
        $data['tit']='CONCENTRADO DE COMPRA SIN IVA DE LA REGION '.$ger.' '.trim($gerx).' DEL MES DE '.trim($mesx);;
        
        $data['a'] = $this->entradas_model->facturas_g($fa,$mes,$ger);
        $data['js'] = 'entradas/facturas_g_js';
        $this->load->view('main', $data);
    }
    function facturas_gss($fa,$mes,$superv)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $supx=$this->Catalogos_model->busca_sup_uno($superv);
        $data['titulo'] = "Facturas";
        $data['tit']='CONCENTRADO DE COMPRA SIN IVA DE LA ZONA '.$superv.' '.trim($supx).' DEL MES DE '.trim($mesx);;
        $data['a'] = $this->entradas_model->facturas_g($fa,$mes,$superv);
        $data['js'] = 'entradas/facturas_gss_js';
        $this->load->view('main', $data);
    }
       function facturas_suc_fac($fa,$mes,$suc)
    {
        $data['titulo'] = "Facturas";
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['tit']='CONCENTRADO DE VENTAS SIN IVA DE '.$suc.' '.trim($sucx).' DEL MES DE '.trim($mesx);
        $data['a'] = $this->entradas_model->facturas_suc_fac($fa,$mes,$suc);
        $data['js'] = 'entradas/facturas_suc_fac_js';
        $this->load->view('main', $data);
    }
    function facturas_gg($fa)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        
        $data['titulo'] = "Facturas por Gerente Regional";
        $data['tit']='CONCENTRADO DE COMPRA SIN IVA';
        $data['a'] = $this->entradas_model->facturas_g($fa,'',$id_plaza);
        $data['js'] = 'entradas/facturas_g_js';
        $this->load->view('main', $data);
    }
    function facturas_ss($fa)
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $supx=$this->Catalogos_model->busca_sup_uno($id_plaza);
        $data['titulo'] = "Facturas por Gerente Regional";
        $data['tit']='CONCENTRADO DE COMPRA SIN IVA DE LA ZONA '.$id_plaza.' '.trim($supx);
        $data['a'] = $this->entradas_model->facturas_g($fa,'',$id_plaza);
        $data['js'] = 'entradas/facturas_g_js';
        $this->load->view('main', $data);
    }
    
/////////////////////////////////////////////////////////////////reportes de entradas maricruz/////////////////////////////////////////  
    
    function busca_entrada_cedis()
    {
        
        $data['titulo'] = 'Busqueda X';
        $data['js'] = 'entradas/busca_entradas_cedis_js';
        $this->load->view('main', $data);
        
    }
    
    function busca_entrada_cedis_submit()
    {
        $data['titulo'] = '';
        $data['tit']='ENTRADAS DEL '.$this->input->post('perini').' AL '.$this->input->post('perfin');
        $data['perini'] = $this->input->post('perini');
        $data['perfin'] = $this->input->post('perfin');
        $data['prove'] = $this->input->post('prove');
        $data['clave'] = $this->input->post('clave');
        $data['lot'] = $this->input->post('lot');
        $data['query'] = $this->entradas_model->entradas_cedis($this->input->post('perini'), $this->input->post('perfin'), $this->input->post('prove'), $this->input->post('clave'), $this->input->post('lot'));
        $data['q'] = $this->entradas_model->entradas_metro($this->input->post('perini'), $this->input->post('perfin'), $this->input->post('prove'), $this->input->post('clave'), $this->input->post('lot'));
        $data['q1'] = $this->entradas_model->entradas_metro($this->input->post('perini'), $this->input->post('perfin'), $this->input->post('prove'), $this->input->post('clave'), $this->input->post('lot'));
        $data['js'] = 'entradas/busca_entrada_cedis_submit_js';
        $this->load->view('main', $data);
    }
    
    function busca_entrada_segpop()
    {
        
        $data['titulo'] = ' ';
        $data['js'] = 'entradas/busca_entradas_segpop_js';
        $this->load->view('main', $data);
        
    }
    
    function busca_entrada_segpop_submit()
    {
        
        $data['titulo'] = '';
        $data['tit']='ENTRADAS DEL '.$this->input->post('perini').' AL '.$this->input->post('perfin');
        $data['perini'] = $this->input->post('perini');
        $data['perfin'] = $this->input->post('perfin');
        $data['prove'] = $this->input->post('prove');
        $data['clave'] = $this->input->post('clave');
        $data['lot'] = $this->input->post('lot');
        $data['tipo'] = $this->input->post('tipo');
        $data['q'] = $this->entradas_model->entradas_segpop($this->input->post('perini'), $this->input->post('perfin'), $this->input->post('prove'), $this->input->post('clave'), $this->input->post('lot'), $this->input->post('tipo'));
        $data['js'] = 'entradas/busca_entrada_segpop_submit_js';
        $this->load->view('main', $data);
    }
    
//////////////////////////////////////////////////////////////reporte entradas Lic. Adriana ///////////////////////////////////////////////////////

    function alma()
    {
        
        $data['titulo'] = 'Entradas al Almacen "TODOS LOS PROVEEDORES" ';
        $data['titulo1'] = 'Entradas al Almacen "PROVEEDOR IQFA" ';
        //$data['js'] = 'entradas/busca_entradas_cedis_js';
        $this->load->view('main', $data);
        
    }
    
/////////////////////////////////////////////////////////////cedis////////////////////////////////////////    
    
    function alma_cedis()
    {
        $datos = $this->entradas_model->getDiasEntradas();
        $data['titulo'] = 'Entradas al Almacen del CEDIS "TODOS LOS PROVEEDORES" ';
        $data['js'] = 'entradas/alma_cedis_js';
        $data['vistaJS'] = $datos;
        $this->load->view('main', $data);
    }
    
    function alma_cedis1()
    {
        $datos = $this->entradas_model->getDiasEntradas3();
        $data['titulo'] = 'Entradas al Almacen del CEDIS "TODOS LOS PROVEEDORES" ';
        $data['js'] = 'entradas/alma_cedis_js';
        $data['vistaJS'] = $datos;
        $this->load->view('main', $data);
    }
    
    
    
    function alma_cedis_detalle($fec)
    {
        
        $data['fec'] = $fec;
        $data['titulo'] = 'Entradas al Almacen del CEDIS del '.$fec.' "TODOS LOS PROVEEDORES" ';
        $data['q'] = $this->entradas_model->entradas_almacedis($fec);
        $data['js'] = 'entradas/alma_cedis_detalle_js';
        $this->load->view('main', $data);
        
    }
    
    function alma_cedis_detalle1($fec)
    {
        
        $data['fec'] = $fec;
        $data['titulo'] = 'Entradas al Almacen del CEDIS del '.$fec.' "TODOS LOS PROVEEDORES" ';
        $data['q'] = $this->entradas_model->entradas_almacedis1($fec);
        $data['js'] = 'entradas/alma_cedis_detalle_js';
        $this->load->view('main', $data);
        
    }
    
    function detalle_en($id)
    {
        
        $data['titulo'] = 'Entradas al Almacen del CEDIS "TODOS LOS PROVEEDORES" ';
        $data['q'] = $this->entradas_model->entradas_almacedis_det($id);
        $data['js'] = 'entradas/alma_cedis_detalle_js';
        $this->load->view('main', $data);
        
    }

////////////////////////////////////////////////////////////segpop/////////////////////////////////////////

    function alma_segpop()
    {
        $datos = $this->entradas_model->getDiasEntradas1();
        $data['titulo'] = 'Entradas al Almacen del SEGPOP "TODOS LOS PROVEEDORES" ';
        $data['js'] = 'entradas/alma_cedis_js';
        $data['vistaJS'] = $datos;
        $this->load->view('main', $data);
    }
    
    function alma_segpop1()
    {
        $datos = $this->entradas_model->getDiasEntradas4();
        $data['titulo'] = 'Entradas al Almacen del SEGPOP "TODOS LOS PROVEEDORES" ';
        $data['js'] = 'entradas/alma_cedis_js';
        $data['vistaJS'] = $datos;
        $this->load->view('main', $data);
    }
    
    
    
    function alma_segpop_detalle($fec)
    {
        
        $data['fec'] = $fec;
        $data['titulo'] = 'Entradas al Almacen del SEGPOP del '.$fec.' "TODOS LOS PROVEEDORES" ';
        $data['q'] = $this->entradas_model->entradas_almasegpop($fec);
        $data['js'] = 'entradas/alma_cedis_detalle_js';
        $this->load->view('main', $data);
        
    }
    
    function alma_segpop_detalle1($fec)
    {
        
        $data['fec'] = $fec;
        $data['titulo'] = 'Entradas al Almacen del SEGPOP del '.$fec.' "TODOS LOS PROVEEDORES" ';
        $data['q'] = $this->entradas_model->entradas_almasegpop1($fec);
        $data['js'] = 'entradas/alma_cedis_detalle_js';
        $this->load->view('main', $data);
        
    }
    
    function detalle_en1($nped)
    {
        
        $data['titulo'] = 'Entradas al Almacen del SEGPOP "TODOS LOS PROVEEDORES" ';
        $data['q'] = $this->entradas_model->entradas_almasegpop_det($nped);
        $data['js'] = 'entradas/alma_cedis_detalle_js';
        $this->load->view('main', $data);
        
    }
    
////////////////////////////////////////////////////////////AGUASCALIENTES/////////////////////////////////////////

    function alma_agu()
    {
        $datos = $this->entradas_model->getDiasEntradas2();
        $data['titulo'] = 'Entradas al Almacen de AGUASCALIENTES "TODOS LOS PROVEEDORES" ';
        $data['js'] = 'entradas/alma_cedis_js';
        $data['vistaJS'] = $datos;
        $this->load->view('main', $data);
    }
    
    
    function alma_agu_detalle($fec)
    {
        
        $data['fec'] = $fec;
        $data['titulo'] = 'Entradas al Almacen de AGUASCALIENTES del '.$fec.' "TODOS LOS PROVEEDORES" ';
        $data['q'] = $this->entradas_model->entradas_almaaguas($fec);
        $data['js'] = 'entradas/alma_cedis_detalle_js';
        $this->load->view('main', $data);
        
    }
    
    function detalle_en2($id)
    {
        
        $data['titulo'] = 'Entradas al Almacen de AGUASCALIENTES "TODOS LOS PROVEEDORES" ';
        $data['q'] = $this->entradas_model->entradas_almaaguas_det($id);
        $data['js'] = 'entradas/alma_cedis_detalle_js';
        $this->load->view('main', $data);
        
    }
    
    
////////////////////////////////////////////////////////////MICHOACAN/////////////////////////////////////////

    function alma_mic()
    {
        $datos = $this->entradas_model->getDiasEntradas5();
        $data['titulo'] = 'Entradas al Almacen de MICHOACAN "TODOS LOS PROVEEDORES" ';
        $data['js'] = 'entradas/alma_cedis_js';
        $data['vistaJS'] = $datos;
        $this->load->view('main', $data);
    }
    
    
    function alma_mic_detalle($fec)
    {
        
        $data['fec'] = $fec;
        $data['titulo'] = 'Entradas al Almacen de MICHOACAN del '.$fec.' "TODOS LOS PROVEEDORES" ';
        $data['q'] = $this->entradas_model->entradas_almamic($fec);
        $data['js'] = 'entradas/alma_cedis_detalle_js';
        $this->load->view('main', $data);
        
    }
    
    function detalle_en3($id)
    {
        
        $data['titulo'] = 'Entradas al Almacen de MICHOACAN "TODOS LOS PROVEEDORES" ';
        $data['q'] = $this->entradas_model->entradas_almamic_det($id);
        $data['js'] = 'entradas/alma_cedis_detalle_js';
        $this->load->view('main', $data);
        
    }
    
    function gastos()
    {
        $id_plaza=$this->session->userdata('id_plaza');
        $supx=$this->Catalogos_model->busca_sup_uno($id_plaza);
        $data['titulo'] = "Gastos x Supervisor";
        $data['tit']='CONCENTRADO DE GASTOS x SUCURSAL DE LA ZONA '.$id_plaza.' '.trim($supx);
        $data['q'] = $this->entradas_model->gastos_suc($id_plaza);
        //$data['js'] = 'entradas/facturas_g_js';
        $this->load->view('main', $data);
    }
    
    function gastos_suc($suc)
    {
        $data['suc'] = $this->input->post('suc');
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['titulo'] = "Gastos x Supervisor";
        $data['tit']='CONCENTRADO DE GASTOS DE LA SUCURSAL '.trim($sucx);
        $data['q'] = $this->entradas_model->gastos_x_suc($suc);
        $data['q2'] = $this->entradas_model->gastos_x_suc1($suc);
        $data['js'] = 'entradas/gastos_js';
        $this->load->view('main', $data);
    }
    
    function muestra_detalle($suc, $id)
    {
       
        $data['suc'] = $this->input->post('suc');
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['titulo'] = "Gastos x Supervisor";
        $data['tit']='CONCENTRADO DE GASTOS DE LA SUCURSAL '.trim($sucx);
        $data['q'] = $this->entradas_model->reporte_conceptos($id);
        $data['js'] = 'entradas/gastos1_js';
        $this->load->view('main', $data);
    }
    
    function descarga_gasto($id)
    {
       $this->load->helper('download');
       $fa = $this->load->database('facturacion', true);
       
       $sql="select ruta from facturacion.gastos_c where id=$id";
       $q = $fa->query($sql);
       $row=$q->row();
       $descarga=$row->ruta;
       
       $data = file_get_contents($row->ruta); // Read the file's contents
       force_download($descarga, $data); 
        
    }
    
    function valida_gasto($id, $suc)
    {
        $q=$this->entradas_model->validaGasto($id);
        redirect('entradas/gastos_suc/'.$suc);
    }

    function valida_gasto1($id, $suc)
    {
        $q=$this->entradas_model->validaGasto($id);
        redirect('entradas/gastos_suc/'.$suc);
    }
    
    
}
