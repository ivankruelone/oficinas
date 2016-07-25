<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Empleados extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('empleados_model');
        $this->load->model('Catalogos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }

    function a_plantilla()
    {
        $data['titulo'] = "PLANTILLAS";
        $data['tit'] = 'PLANTILLA DE PERSONAL';
        $data['q'] = $this->empleados_model->plantilla();
        $data['js'] = 'empleados/a_plantilla_js';
        $this->load->view('main', $data);
    }
    function a_plantilla_sup($ger)
    {
        $gerx = $this->Catalogos_model->busca_ger_uno($ger);
        $data['titulo'] = "PLANTILLAS";
        $data['tit'] = 'PLANTILLA DE PERSONAL DE '.$gerx;
        $data['q'] = $this->empleados_model->plantilla_sup($ger);
        $data['js'] = 'empleados/a_plantilla_sup_js';
        $this->load->view('main', $data);
    }
    function a_plantilla_suc($sup)
    {
        $supx = $this->Catalogos_model->busca_sup_uno($sup);
        $data['titulo'] = "PLANTILLAS";
        $data['tit'] = 'PLANTILLA DE PERSONAL DE '.$supx;
        $data['q'] = $this->empleados_model->plantilla_suc($sup);
        $data['js'] = 'empleados/a_plantilla_suc_js';
        $this->load->view('main', $data);
    }
    function a_plantilla_det($suc)
    {
        $sucx = $this->Catalogos_model->busca_suc_una($suc);
        $plantilla= $this->Catalogos_model->busca_suc_plantilla($suc);
        $plantilla_med = $this->Catalogos_model->busca_suc_plantilla_med($suc);
        $turno = $this->Catalogos_model->busca_suc_turno_med($suc);
        $data['tit'] = 'PLANTILLA DE PERSONAL DE FARMACIAS '.$sucx.' PARA FARMACIA '.$plantilla;
        $data['tit1'] = 'PLANTILLA DE PERSONAL DE MEDICOS '.$sucx.' PARA MEDICOS '.$plantilla_med;
        $data['q'] = $this->empleados_model->plantilla_detfar($suc);
        $data['q1'] = $this->empleados_model->plantilla_detmed($suc);
        $data['js'] = 'empleados/a_plantilla_det_js';
        $this->load->view('main', $data);
    }
    function a_plantilla_cambia($suc)
    {
        $sucx = $this->Catalogos_model->busca_suc_una($suc);
        $data['plantilla']= $this->Catalogos_model->busca_suc_plantilla($suc);
        $data['plantilla_med']= $this->Catalogos_model->busca_suc_plantilla_med($suc);
        $data['turno'] = $this->Catalogos_model->busca_suc_turno_med($suc);
        $data['titulo'] = 'PLANTILLA DE PERSONAL DE FARMACIAS '.$sucx;
        $data['suc'] = $suc;
        $data['js'] = 'empleados/a_plantilla_det_js';
        $this->load->view('main', $data);
    }
    
    function sumit_cambia_plantilla()
    {
        $id_user =$this->session->userdata('id');
        if($id_user>0)
        {
        $a=array(
        'plantilla'=>$this->input->post('plantilla'),
        'plantilla_medico'=>$this->input->post('plantilla_med'),
        'turno'=>$this->input->post('turno')
        );
        $this->db->where('suc',$this->input->post('suc'));
        $this->db->update('catalogo.sucursal',$a);
        //id, id_user, plantilla, plantilla_med, fecha, suc
        $b=array(
        'id_user' => $id_user,
        'plantilla' => $this->input->post('plantilla'),
        'plantilla_med' => $this->input->post('plantilla_med'),
        'fecha' => date('Y-m-d H:i:s'),
        'suc' => $this->input->post('suc'),
        'turno' => $this->input->post('turno') 
        );
        $this->db->insert('sucursal.cambios_plantilla',$b);
        }
        redirect('empleados/a_plantilla_det/'.$this->input->post('suc'));
    }

    function evaluacion($suc, $id)
    {
        $sucx = $this->Catalogos_model->busca_suc_una($suc);
        $data['titulo'] = "EVALUACI&Oacute;N DE PERSONAL";
        $data['tit'] = '';
        $data['areas'] = $this->empleados_model->getEvaluacionAreas();
        $data['respuestas'] = $this->empleados_model->getRespuestas();
        $data['motivos'] = $this->empleados_model->getMotivosDisposicionCombo();
        $data['suc'] = $suc;
        $data['id'] = $id;
        //$data['js'] = 'entradas/facturas_suc_js';
        $this->load->view('main', $data);
    }
    
    function submit_evaluacion()
    {
        //empleado_id, evaluador, observaciones_colaborador, observaciones_evaluador, motivo, fecha
        $id = $this->input->post('id');
        $suc = $this->input->post('suc');
        $observaciones_colaborador = $this->input->post('observaciones_colaborador');
        $observaciones_evaluador = $this->input->post('observaciones_evaluador');
        $motivo = $this->input->post('motivo');
        $evaluador = $this->session->userdata('id');
        
        $numeroDePreguntas = $this->empleados_model->getNumeroDePreguntas();
        
        $cuestionario = array();
        
        for($i = 1; $i<= $numeroDePreguntas; $i++)
        {
            $cuestionario[$i]['pregunta'] = $i;
            $cuestionario[$i]['respuesta'] = $this->input->post('pregunta'.$i);
        }
        
        
        $this->empleados_model->insertEvaluacion($id, $evaluador, $observaciones_colaborador, $observaciones_evaluador, $motivo, $cuestionario);
        redirect('empleados/plantilla_sse/'.$suc);
    }
    
    function evaluacion_impresion()
    {
        $data['header'] = $this->empleados_model->evaluacion_reporte_header();
        $data['detalle'] = $this->empleados_model->evaluacion_reporte_detalle();
        $this->load->view('impresion/evaluacion_personal_farmacias', $data);
    }
    
    function estatus()
    {
        $data['titulo'] = "BUSQUEDA DE PERSONAL";
        $this->load->view('main', $data);
    }
    
    function estatus_resultado()
    {
        
        $data['titulo'] = "RESULTADO DE LA BUSQUEDA";
        $data['nomina'] = $this->input->post('nomina');
        $data['emple'] = $this->input->post('emple');
        $data['query'] = $this->Catalogos_model->busca_empleado($this->input->post('nomina'), $this->input->post('emple'));
        $data['js'] = 'empleados/estatus_resultado_js';
        $this->load->view('main', $data);
        
    }
    
    function estatus_detalle($nomina)
    {
        
        $data['titulo'] = "RESULTADO DE LA BUSQUEDA";
        $data['tit']='Selecciona el mes y el a&ntilde;o';
        $data['nomina']=$nomina;
        $data['query'] = $this->Catalogos_model->busca_empleado1($nomina);
        $data['js'] = 'empleados/estatus_detalle_js';
        $this->load->view('main', $data);
        
    }
    
    function estatus_dias()
    {
        $aaa = $this->input->post('aaa');
        $mes = $this->input->post('mes');
        $nomina = $this->input->post('nomina');
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "RESULTADO DE LA BUSQUEDA DEL MES DE ".$mesx." DEL ".$aaa;
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['nomina']= $nomina;
        $data['query'] = $this->empleados_model->busca_empleado_dias($nomina, $mes, $aaa);
        $data['js'] = 'empleados/estatus_dias_js';
        $this->load->view('main', $data);
        
    }

     function c_valida_plantilla($id_plaza)
    {
        $data['Titulo']="VALIDACION DE PLANTILLA";
        $data['query']=$this->empleados_model->valida_plantilla($id_plaza);
        $data['js'] = 'empleados/c_valida_plantilla_js';
        $this->load->view('main', $data);
        } 
   
    function c_observ_empleado($suc)
    {
      
        $data['titulo'] = "OBSERVACION DE PERSONAL";
        $data['completo']=$this->empleados_model->observ_empleado($suc);
        $data['nomina']=$this->empleados_model->observ_empleado($suc);
        $data['mov']=$this->Catalogos_model->busca_mov_captura();
     
        
        $this->load->view('main', $data);

     }

     function c_actualizar_observ()
    {
        
        $data = array (
        'observ' => $this->input->post('observ'),
        'nomina' => $this->input->post('nomina'),
        'suc' => $this->input->post('suc')
         );
         $this->empleados_model->guardar_observ($data);
            
        $id_plaza=$this->session->userdata('id_plaza');
        redirect('empleados/c_valida_plantilla/'.$id_plaza);
        
    }

}
