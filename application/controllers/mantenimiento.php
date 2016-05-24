<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class mantenimiento extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('mantenimiento_model');
    }
    
    function ordenes_pendientes()
    {
        $data['titulo'] = "Ordenes de Mantenimiento";
        $data['query'] = $this->mantenimiento_model->getorden();
        $this->load->view('main', $data);
    }
    
    function detalle_orden($orden)
    {
        $data['titulo'] = "Ordenes de Mantenimiento";
        $data['query'] = $this->mantenimiento_model->getorden_detalle($orden);
        $this->load->view('main', $data);
    }
    
    function asigna_orden($orden)
    {
        $data['titulo'] = "Asigna Personal Para Orden";
        $data['orden'] = $orden;
        $data['id'] = $this->mantenimiento_model->muestra_personal();
        $data['tiempo_id'] = $this->mantenimiento_model->muestra_tiempo();
        $data['query'] = $this->mantenimiento_model->orden_asigadatraba($orden);
        $data['query2'] = $this->mantenimiento_model->getorden_detalle($orden);
        $data['query3'] = $this->mantenimiento_model->getorden_observaciones_detalle($orden);
        $data['presupuesto_id'] = $this->mantenimiento_model->muestra_presupuesto();
        $this->load->view('main', $data); 
    }
    
    function asigna_orden_submit()
    {
        $orden = $this->input->post('orden');
        $id = $this->input->post('id');
        $id1 = $this->input->post('id1');
        //$id2 = $this->input->post('id2');
        /*
        echo $orden .'orden <br />';
        echo $id .'id <br />';
        echo $id1 .'id1 <br />';
        //echo $id2 .'id2 <br />';
        die();*/
        if($id == 0 and $id1 <> 0){
           $this->mantenimiento_model->insertPersonal($orden,$id1); 
        }elseif($id1 == 0 and $id <> 0){
        $this->mantenimiento_model->insertPersonal($orden,$id);
        }elseif($id <> 0 and $id1 <> 0){
        $this->mantenimiento_model->insertPersonal($orden,$id);
        $this->mantenimiento_model->insertPersonal($orden,$id1);    
        }
        redirect('mantenimiento/asigna_orden/'.$orden);
    }
    
    function eliminarEmpleado($orden,$id)
    {
        $this->mantenimiento_model->deletePersonal($orden,$id);
        redirect('mantenimiento/asigna_orden/'.$orden);
    }
    
    function cerrar_orden_submit()
    {
        $orden = $this->input->post('orden');
        $tiempo_id = $this->input->post('tiempo_id');
        $presupuesto_id = $this->input->post('presupuesto_id');
        //echo $orden .'orden <br />';
        //echo $tiempo_id .'tiempo <br />';
        //echo $presupuesto_id .'presupuesto <br />';
        //die();
        $this->mantenimiento_model->cerrar_orden($orden,$tiempo_id,$presupuesto_id);
        $this->mantenimiento_model->cerrar_orden_status($orden);
        $this->mantenimiento_model->fecha_asig_orden_status($orden);
        $this->mantenimiento_model->inserta_encuesta($orden);
        redirect('mantenimiento/ordenes_pendientes/'.$orden);
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
   function imp_orden($orden)
    {
      set_time_limit(0);
        ini_set('memory_limit','-1');
        $var1 = 'ORIGINAL';
        //$var2 = 'COPIA';
       // $data['div']=' -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  - -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  - -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  -  ';
        //$data['cabeza'] = $this->mantenimiento_model->getCabezaOrden($orden,$var1);
        $data['cabeza'] = $this->mantenimiento_model->getCabezaOrden2($orden,$var1);
        $data['query'] = $this->mantenimiento_model->getDetalleOrden($orden);
        $data['final'] = $this->mantenimiento_model->imprime_orden_final($orden);
        $this->load->view('impresion/imp_orden', $data);    
    }

 function ordenes_atendidas()
    {
        $data['titulo'] = "Ordenes de Mantenimiento Atendidas";
        $data['query'] = $this->mantenimiento_model->getorden_atendida();
        $this->load->view('main', $data);
    }
    
    
    function observaciones($orden)
    {
        $data['titulo'] = "Observaciones";
        $data['orden'] = $orden;
        $this->load->view('main', $data);
    }
    
    function observaciones_submit()
    {

        $orden = $this->input->post('orden');
        $observacion_personal = $this->input->post('observacion_personal'); 
        //echo $orden .'orden <br />';
        //echo $observacion_personal .'espe<br />';
        //die();

        $data = array('observacion_personal' => $observacion_personal);
        $this->db->where('orden',$orden);
        $this->db->update('mantenimiento.orden',$data,null);

        redirect('mantenimiento/ordenes_atendidas/'.$orden);
    }
    
    function evaluacion_encuesta($orden)
    {
        $data['titulo'] = "Ordenes de Mantenimiento";
        $data['orden'] = $orden;
        $data['query'] = $this->mantenimiento_model->getorden_evaluada($orden);
        $data['query2'] = $this->mantenimiento_model->getorden_evaluada_empleado($orden);
        $data['query3'] = $this->mantenimiento_model->getorden_evaluada_calific($orden);
        $data['query4'] = $this->mantenimiento_model->getorden_evaluada_sugerencia($orden);
        $this->load->view('main', $data);
    }
    
    function reporte_ordenes()
    {
        $data['titulo'] = "Reporte De Ordenes Por Empleado";
        $data['query'] = $this->mantenimiento_model->getreporte_orden_emple();
        $this->load->view('main', $data);
    }
    
    function reporte_ordenes_detalle()
    {
        $data['titulo'] = "Reporte De Ordenes Por Empleado Detalle";
        //$data['query'] = $this->mantenimiento_model->getreporte_orden_emple_detalle($id);
        $data['q1'] = $this->mantenimiento_model->muestra_total();
        //$data['q2'] = $this->mantenimiento_model->muestra_pretuntas();
        $this->load->view('main', $data);
    }
    
    
     function detalle_evaluac($id)
    {
        $data['titulo'] = "Reporte De Evaluacion Detalle";
        $data['id'] = $id;
        $data['q1'] = $this->mantenimiento_model->muestra_eval_det($id);
        $this->load->view('main', $data);
    }
    
    
     function consulta_mensual()
    {
       
        $data['titulo'] = "";
        $data['tit']='Selecciona fecha inicial, fecha final';
        $data['js'] = 'mantenimiento/consulta_mensual_js';
        $this->load->view('main', $data);
    }
    
    public function consultas_mensual_submit()
    {
        $inicio= $this->input->post('dpYears');
        $fin= $this->input->post('dpYears1');
        $data['feha1']= $inicio;
        $data['fecha2']= $fin;
        $data['tit']='Reporte Mensual'.$inicio.' al '.$fin;
        $data['q1'] = $this->mantenimiento_model->consulta_mensual_emple($inicio,$fin);
        $data['js'] = 'mantenimiento/consultas_mensual_submit_js';
        $this->load->view('main', $data);
    }
    
}