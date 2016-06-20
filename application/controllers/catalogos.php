<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Catalogos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        if (!Current_User::user()) {
            redirect('landing');
        }
       
        $this->load->model('catalogos_model');

    }


//////////////////////////////////////////////////////////////////////////////////////////////////////////
    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    
    }
    function s_oferta_genericos()
    {
        $data['titulo'] = "Ofertas para sucursales Doctor Ahorro";
        $data['q']=$this->catalogos_model->oferta_genericas();
        $data['js'] = 'catalogos/s_oferta_genericos_js';
        $this->load->view('main', $data);
    }
    function s_cat_genericos_fenix()
    {
        $data['titulo'] = "Catalogo de Genericos para Fenix";
        $data['q']=$this->catalogos_model->genericos_fenix();
        $data['js'] = 'catalogos/s_cat_genericos_fenix_js';
        $this->load->view('main', $data);
    }
    function s_cat_naturistas()
    {
        $data['titulo'] = "Catalogo de naturistas";
        $data['q']=$this->catalogos_model->naturistas_genericas();
        $data['js'] = 'catalogos/s_oferta_genericos_js';
        $this->load->view('main', $data);
    }
    function orden_his()
    {
        $var='susa';
        $data['titulo'] = "Historico de orden de compras";
        $data['q'] = $this->catalogos_model->orden_hiss();
        //$data['js'] = 'catalogos/generico_js';
        $this->load->view('main', $data);
    }
    function orden_his1()
    {
        $var='susa';
        $data['titulo'] = "Historico de orden de compras cia 1";
        $data['q'] = $this->catalogos_model->orden_hiss1();
        $data['js'] = 'catalogos/genericos_js';
        $this->load->view('main', $data);
    }
    
    function s_cedis()
    {
        $this->load->dbutil();
        $this->load->helper('download');
        $a = $this->catalogos_model->cedis();
        $csv = $this->dbutil->csv_from_result($a);
        $name = 'catalogo_genericos_'.date('Ymd_His').'.csv';
        force_download($name, $csv);
    }
    function a_cat_fanasa_activos()
    {
        $this->load->dbutil();
        $this->load->helper('download');
        $a = $this->catalogos_model->cat_fanasa_activos();
        $csv = $this->dbutil->csv_from_result($a);
        $name = 'catalogo_fanasa_'.date('Ymd_His').'.csv';
        force_download($name, $csv);
    }
    function s_metro1()
    {
        $this->load->dbutil();
        $this->load->helper('download');
        $a = $this->catalogos_model->metro1();
        $csv = $this->dbutil->csv_from_result($a);
        $name = 'catalogo_metro1_'.date('Ymd_His').'.csv';
        force_download($name, $csv);
    }
    
    function s_metro2()
    {
        $this->load->dbutil();
        $this->load->helper('download');
        $a = $this->catalogos_model->metro2();
        $csv = $this->dbutil->csv_from_result($a);
        $name = 'catalogo_metro2_'.date('Ymd_His').'.csv';
        force_download($name, $csv);
    }
    
    function clasificacion()
    {
        $data['titulo'] = "Catalogo de clasificaciones y descontinuados";
        $data['q'] = $this->catalogos_model->clasificacion();
        $data['js'] = 'catalogos/clasificacion_js';
        $this->load->view('main', $data);
    }
    
    function descontin()
    {
        $data['titulo'] = "Descontinuados";
        $data['q'] = $this->catalogos_model->descontin();
        $data['js'] = 'catalogos/descontin_js';
        $this->load->view('main', $data);
    }
    
    function clasifica($id)
    {
        $data['titulo'] = "Catalogo de clasificaciones y descontinuados";
        $q = $this->catalogos_model->clasifica($id);
        $r=$q->row();
        $data['tipo']=$r->tipo;
        $data['id']=$id;
        $data['susa']=$r->susa;
        $data['sec']=$r->sec;
        $data['obser']=$r->obser;
        $data['clas'] = $this->catalogos_model->busca_clas($r->tipo);
        $data['js'] = 'catalogos/clasificacion_js';
        $this->load->view('main', $data);
    }
    function s_clasifica_masiva()
    {
     $data['titulo'] = "Cambio de Clasificacion de catalogos";
     $data['q'] = $this->catalogos_model->clasifica_masiva(); 
     $this->load->view('main', $data);   
    }
    function sumit_clasifica_masiva()
    {
     $sec =$this->input->post('sec');
     $tipo=$this->input->post('cla');
        
     $s="update catalogo.cat_almacen_clasifica set tipo='$tipo' where sec in($sec)";
     $this->db->query($s); 
     redirect('catalogos/s_clasifica_masiva'); 
    }
    
    function sumit_clasifica()
    {
        $a=array('tipo'=>$this->input->post('clas'));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('catalogo.cat_almacen_clasifica',$a);
        redirect('catalogos/clasificacion');
    }
    function descontinuado($id,$var)
    {
        $a=array('descon'=>$var);
        $this->db->where('id', $id);
        $this->db->update('catalogo.cat_almacen_clasifica',$a);
        redirect('catalogos/clasificacion');
    }
    
    function mante_susa()
    {
        $var='susa';
        $data['titulo'] = "Catalogo por Sustancia";
        $data['q'] = $this->catalogos_model->mante_susa($var);
        $data['js'] = 'catalogos/genericos_js';
        $this->load->view('main', $data);
    }
    
     function mante_susa_una($id)
    {
        $data['titulo'] = "Catalogo por Sustancia";
        $data['q'] = $this->catalogos_model->mante_susa_una($id);
        $data['js'] = 'catalogos/genericos_js';
        $this->load->view('main', $data);
    }
    
     function mante_codigo()
    {
        $data['titulo'] = "Catalogo por Codigo de Barras";
        $data['q'] = $this->catalogos_model->mante_codigo();
        $data['js'] = 'catalogos/genericos_js';
        $this->load->view('main', $data);
    }
    
    function mod_generico()
    {
        $var='susa';
        $data['titulo'] = "Catalogo por secuencia interna ";
        $data['q'] = $this->catalogos_model->mod_generico();
        $data['js'] = 'catalogos/mod_generico_js';
        $this->load->view('main', $data);
    }
    
    
    function mod_generico_sec($tipo,$sec)
    {
        $data['titulo'] = "Catalogo por secuencia interna ";
        $data['tipo'] = $this->catalogos_model->tipo_producto_uno($tipo);
        $data['q'] = $this->catalogos_model->busca_sec($sec);
        $this->load->view('main', $data);
    }
    
    function sumit_cambia_sec()
    {
    $a=array(
    'ddr'=>$this->input->post('ddr'),
    'gen'=>$this->input->post('gen'),
    'natur'=>$this->input->post('natur'),
    'clasi'=>$this->input->post('clasi'),
    'tipo'=>$this->input->post('tipo')
    );
    $this->db->where('sec',$this->input->post('sec'));
    $this->db->update('catalogo.cat_nuevo_general_sec',$a);
    redirect('catalogos/mod_generico');    
    }
        
    function mante_susa_completa_una($clagob,$sec)
    {
        $data['titulo'] = "Catalogo por Sustancia";
        $data['a'] = $this->catalogos_model->busca_producto_nu($clagob,$sec);
        $data['q'] = $this->catalogos_model->mante_susa_completa_una($clagob,$sec);
        $data['js'] = 'catalogos/mod_generico_js';
        $this->load->view('main', $data);
    }
    
    function genericos()
    {
        $data['titulo'] = "Catalogo de Genericos";
        $data['a'] = $this->catalogos_model->genericos();
        $data['js'] = 'catalogos/genericos_js';
        $this->load->view('main', $data);
    }
    
    function seguro_popular()
    {
        $data['titulo'] = "Catalogo de Seguro Popular";
        $data['a'] = $this->catalogos_model->seguro_popular();
        $data['js'] = 'catalogos/seguro_popular_js';
        $this->load->view('main', $data);
    }

    function especialidad()
    {
        $data['titulo'] = "Catalogo de Especialidades";
        $data['a'] = $this->catalogos_model->especialidad();
        $data['js'] = 'catalogos/especialidad_js';
        $this->load->view('main', $data);

    }
    
     function control_especial()
    {
        $data['titulo'] = "Catalogo de Controlados y especialidad";
        $data['q'] = $this->catalogos_model->especial_control();
        $data['js'] = 'catalogos/control_especial_js';
        $this->load->view('main', $data);
    }
    
     function genericos_venta()
    {
        $data['titulo'] = "Catalogo de Genericos";
        $data['a'] = $this->catalogos_model->genericos_clasifica();
        $data['js'] = 'catalogos/genericos_venta_js';
        $this->load->view('main', $data);
    }
    
    
     
     function causes()
    {
        $data['titulo'] = "Catalogo de causes";
        $data['q'] = $this->catalogos_model->causes();
        $data['js'] = 'catalogos/genericos_venta_js';
        $this->load->view('main', $data);
    }
    
       function costos_mayoristas()
    {
        $data['titulo'] = "Comparativo de costos Mayoristas";
        $data['q'] = $this->catalogos_model->mayoristas();
        $data['js'] = 'catalogos/costos_mayoristas_js';
        $this->load->view('main', $data);
    }
    
    function busca_proveedores_autocomplete()
    {
        $query = $this->catalogos_model->autocomplete_proveedores($this->input->get_post('term'));
        $json = '[';
        
        foreach($query as $row)
        {
            $json.= '{"id":"'.$row->prov.'","value":"'.$row->prov.' - '.$row->razo.' - '.$row->rfc.'"},';
        }
        if(count($query) >= 1){
            $json = substr($json, 0, -1); 
        }else{
            $json.= '{"id":"0","value":"No hay coincidencias."}';
        }
        $json .= ']';
        echo $json;
    }
    
    function busca_productos_autocomplete()
    {
		$this->load->helper('text');
        $query = $this->catalogos_model->autocomplete_claves($this->input->get_post('term'));
        $json = '[';
        
        foreach($query as $row)
        {
            $json.= '{"idProducto":"'.$row->id.'","id":"'.$row->sec.'","value":"'.$row->sec.' - '.ascii_to_entities(str_replace(array('"'), array(''), $row->susa1)).'","lc":""},';
        }
        
        if(count($query) >= 1){
            $json = substr($json, 0, -1); 
        }else{
            $json.= '{"id":"0","value":"No hay coincidencias."}';
        }
        $json .= ']';
        echo $json;
    }
    
    function s_empleados_correo()
    {
        $data['titulo'] = "Catalogo de empleados de oficinas";
        $data['q'] = $this->catalogos_model->empleados_correo();
        $data['js'] = 'catalogos/s_empleados_correo_js';
        $this->load->view('main', $data);
    }
    
    function s_empleados_correo_actualiza($id)
    {
        $data['titulo'] = "Catalogo de empleados de oficinas";
        $q = $this->catalogos_model->busca_empleados_id($id);
        $r=$q->row();
        $data['suc']=$r->suc;
        $data['sucx']=$r->sucx;
        $data['nomina']=$r->nomina;
        $data['nombre']=$r->nombre;
        $data['correo']=$r->correo;
        $data['id']=$id;
        $data['js'] = 'catalogos/s_empleados_correo_js';
        $this->load->view('main', $data);
    }
    
    function sumit_cambia_correo()
    {
        $a=array('correo'=>$this->input->post('correo'));
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('catalogo.cat_empleado',$a);
        redirect('catalogos/s_empleados_correo');
    }
    function s_sucursal()
    {
        $var='susa';
        $data['titulo'] = "Catalogo de sucursales ";
        $data['q'] = $this->catalogos_model->sucursal_activa();
        $data['js'] = 'catalogos/s_sucursal_js';
        $this->load->view('main', $data);
    }
    
    function s_cat_insumos()
    {
        $data['titulo'] = "CATALOGO DE INSUMOS ";
        $data['q'] = $this->catalogos_model->cat_insumos();
        $data['js'] = 'catalogos/s_cat_insumos_js';
        $this->load->view('main', $data);
    }
    
    
    function savePermiso()
    {
        $usuario = $this->input->post('usuario');
        $submenu = $this->input->post('submenu');
        
        $this->admin_model->savePermiso($usuario, $submenu);
    }
    
    
    function savePermisoInsumo()
    {
        $suc = $this->input->post('suc');
        $id_insumos = $this->input->post('id_insumos');
        $this->catalogos_model->savePermisoInsumo($suc, $id_insumos);   
    }
    
       function saveMaximoInsumoDepto()
    {
         
        $a=array('maximo'=>$this->input->post('maximo'), 'usuario' => $this->session->userdata('id'));
        $this->db->where('id_insumos',$this->input->post('id_insumos'));
        $this->db->where('suc',$this->input->post('suc'));
        $this->db->update('catalogo.cat_insumos_depto',$a);
        //redirect('catalogos/s_cat_insumos_menu/'.$this->input->post('suc'));
    }
    
    function SavePermisoEspecial()
    {
        $suc = $this->input->post('suc');
        $this->catalogos_model->SavePermisoEspecial($suc);
    }
    
    
    //////////////////////////////////////////////////////////////
    function s_cat_permisos_insumos()
    {
        $data['subtitulo'] = "Permisos de insumos";
        $data['query'] = $this->catalogos_model->departamentoInsumo();
        $data['js'] = 'catalogos/s_cat_permisos_insumos_js';
        $this->load->view('main', $data);
    }
  
    
    
    function s_cat_insumos_menu($suc)
    {
        $this->catalogos_model->actInsumosDepto($suc);
        $data['subtitulo'] = "Permisos de insumos";
        $data['query'] = $this->catalogos_model->s_cat_insumos_menu($suc);
        $data['query1'] = $this->catalogos_model->s_cat_insumos_menu_si($suc);
        $data['suc'] = $suc;
        $data['js'] = 'catalogos/s_cat_insumos_menu_js';
        $this->load->view('main', $data);

    }
    
    function imp_max_ins($suc)
    {
     $data['cabeza'] = $this->catalogos_model->imprime_max_cabeza($suc);
     $data['detalle'] = $this->catalogos_model->imprime_max_detalle($suc);
     $this->load->view('impresion/maximos_imprime', $data);    
    }

    
   /************** nuevos insumos *********************/
     
   function s_cat_insumos_nuevo()
   {
    $data['subtitulo'] = "Nuevos insumos";
    $data['js'] = 'catalogos/s_cat_insumos_nuevo_js';
    $this->load->view('main', $data);
    }
   
   function s_cat_insumos_nuevo_submit()
   {
               
        $id_insumos = $this->input->post('id_insumos');
        $descripcion = trim($this->input->post('descripcion'));
        $empaque = trim($this->input->post('empaque'));
        $costo = trim($this->input->post('costo'));
        $multiplo = 1;
        $maxi = trim($this->input->post('maxi'));
        $observa = trim($this->input->post('observa'));
        $suc = $this->input->post('suc');
        $depto = $this->input->post('depto');
        $medico = $this->input->post('medico');
        $this->catalogos_model->insertInsumos($id_insumos, $descripcion, $empaque, $costo, $multiplo ,$maxi, $observa, $suc, $depto, $medico);
        redirect('catalogos/s_cat_insumos/'.$this->input->post('id_insumos'));
    
   }
   /**************************************edita insumos**********************************************/
   
   function s_cat_insumos_edita($id_insumos)
   {
     
     $data['id_insumos'] = $id_insumos;
     $data['subtitulo'] = "Modificar Insumos";
     $data['query'] = $this->catalogos_model->getInsumoByID($id_insumos);
     $this->load->view('main', $data);
   }
    
       
    function s_cat_insumos_edita_submit()
     {
        $suc = $this->input->post('suc');
        if($suc == null){
            $suc = 0;
        }
                
         $depto = $this->input->post('depto');
        if($depto == null){
            $depto = 0;
        }
        $activo = $this->input->post('activo');
        if($activo == null){
            $activo = 0;
        }
                
        $medico = $this->input->post('medico');
        if($medico == null){
            $medico = 0;
        }
        $ped_especial = $this->input->post('ped_especial');
        if($ped_especial == null){
           $ped_especial = 0;
        }
        $id_insumos = $this->input->post('id_insumos');
                       
        $data=array(      
        'descripcion' => $this->input->post('descripcion'),
        'empaque'     => $this->input->post('empaque'),
        'costo'       => $this->input->post('costo'), 
        'maxi'        => $this->input->post('maxi'),
        'observa'     => $this->input->post('observa'),
        'suc'         => $suc,
        'depto'       => $depto,
        'activo'      => $activo,
        'ped_especial'=> $ped_especial,
        'medico'      => $medico
         );
        $this->catalogos_model->actualizaInsumos($data, $id_insumos);
        redirect('catalogos/s_cat_insumos/');
     }
    /**********************************************************************************/
   /* mostrar catalogos a los empleados principales*/
   
    function s_cat_insumos_dep()
   {
        $data['subtitulo'] = "Insumos Totales";
        $data['query'] = $this->catalogos_model->s_cat_insumos_dep();
        $data['js'] = 'catalogos/s_cat_insumos_js';
        $this->load->view('main', $data);
    }
 /*************************************************************************************/
 function s_cat_insumos_delete($id_insumos)
    {
       $this->db->delete('papeleria.insumos_d', array('id' => $id));
       redirect('insumos/s_ped_insumos_det/'.$id_insumos);
    }
    /************************** Seccion de busqueda *********************************/
     function s_cat_insumos_his()
    {
        $data['titulo'] = "Insumos Historial";
        $this->load->view('main', $data);
    }
    
    function s_cat_insumos_his_bus()
    {
        $var=$this->input->post('bus1');
        $data['titulo'] = "Insumo";
        $data['q'] = $this->catalogos_model->s_cat_insumos_his_bus($var);
        $data['js'] = 'catalogos/s_cat_insumos_his_bus_js';
        $this->load->view('main', $data);
    }
    
    function s_cat_insumos_his_detalle($id,$suc)
    {
        $suc = $this->input->post('suc'); 
        $data['titulo'] = "PEDIDO DE INSUMOS";
        $data['query']=$this->catalogos_model->s_cat_insumos_his_detalle($id,$suc);
        $data['query2']=$this->catalogos_model->pedidoSurtidoTitulo($id); /*para colocar otro query en nuestra vista, se coloca asi*/
        $data['js'] = 'catalogos/s_cat_insumos_his_detalle_js';
        $this->load->view('main', $data);
    }

      function genericos_fenix()
    {
        $data['titulo'] = "Catalogo de Genericos para fenix";
        $data['a'] = $this->catalogos_model->cata_gen_fenix();
        $data['js'] = 'catalogos/genericos_fenix_js';
        $this->load->view('main', $data);
    }
    
     function cat_cambio_precio()
    {
        $data['titulo'] = "Catalogo cambio de precios";
        $data['q'] = $this->catalogos_model->cata_cambio_precio();
        $data['js'] = 'catalogos/cat_cambio_precio_js';
        $this->load->view('main', $data);
    }


       /******************Bloquear codigos de Pharmacos************************/


     function cat_bloq_codigo()
        {

         $id_plaza=$this->session->userdata('id_plaza');
         $data['titulo'] = "Cancelar codigos pharmacos";
         $data['suc'] = $this->catalogos_model->busca_suc_bloq($id_plaza);
         $data['q'] = $this->catalogos_model->desc_bloq_cod($id_plaza);
         $data['q1'] = $this->catalogos_model->desc_bloq_cod_tab2($id_plaza);
         $data['js'] = 'catalogos/cat_bloq_codigo_js';
                 
         $this->load->view('main', $data);
        }

        function ins_bloq_codigo()
        {

         $data = array (
        'suc' => $this->input->post('suc'),
        'codigo' => $this->input->post('codigo'),
        'activo' => 0
         );
        $code= $this->input->post('codigo');
        $this->catalogos_model->cat_bloq_cod($data,$code);
        $id_plaza=$this->session->userdata('id_plaza');
        redirect('catalogos/cat_bloq_codigo/');

        }

        function aplic_bloq_codigo($id){
        $this->catalogos_model->upd_bloq_cod($id);
         redirect('catalogos/cat_bloq_codigo/');

        }

        function del_bloq_codigo($id){
            $this->catalogos_model->del_bloq_cod($id);
            redirect('catalogos/cat_bloq_codigo/');

        }
        function busca_bloq_codigo()
        {
      //   $codigo = $this->input->post('codigo');
         
      //   echo $this->ofertas_model->busca_pro_gen($sec);         
        }
               


        /************************ Maximo sucursal DA********************************/

        function max_sucursal(){
           $this->load->view('main');
        
        }
        
        function sumit_max_sucursal(){
            
            $sec= $this->input->post('sec');
            $can =$this->input->post('cant');
            $can_cedis =$this->input->post('cant_cedis');
            $this->catalogos_model->ins_max_suc($sec,$can,$can_cedis);
            redirect('catalogos/inser_max_sucursal/'.$sec);
            
        }
        function inser_max_sucursal($sec){
            
            $data['op_cedis']= $this->catalogos_model->ver_max_cedis($sec);
            $data['q']=$this->catalogos_model->ver_max_suc($sec);
            $data['js'] = 'catalogos/inser_max_sucursal_js';
            $this->load->view('main',$data);
        }




























    
    }
?>