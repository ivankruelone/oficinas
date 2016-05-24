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

    function plantilla()
    {
        $data['titulo'] = "PLANTILLAS";
        $data['tit'] = 'PLANTILLA DE PERSONAL EN FARMACIA';
        $data['a'] = $this->empleados_model->plantilla('');
        //$data['js'] = 'empleados/plantilla_js';
        $this->load->view('main', $data);
    }
    
    function plantilla_s($ger)
    {
        $gerx = $this->Catalogos_model->busca_ger_uno($ger);
        $data['titulo'] = "PLANTILLAS";
        $data['ger'] = $ger;
        $data['tit'] = 'PLANTILLA DE PERSONAL EN FARMACIA DE ' . trim($gerx);
        $data['aviso'] = "Empleados asignados a sucursales cerradas o numero de sucursal anterior";
        $data['a'] = $this->empleados_model->plantilla($ger);
        $data['q'] = $this->empleados_model->personal_cerradas();
        $data['js'] = 'empleados/plantilla_s_js';
        $this->load->view('main', $data);
    }
    function plantilla_todos($ger)
    {
        $gerx = $this->Catalogos_model->busca_ger_uno($ger);
        $data['titulo'] = "PLANTILLAS";
        $data['ger'] = $ger;
        $data['tit'] = 'PLANTILLA DE PERSONAL EN FARMACIA DE ' . trim($gerx);
        $data['aviso'] = "Empleados asignados a sucursales cerradas o numero de sucursal anterior";
        $data['query'] = $this->empleados_model->plantilla_tod($ger);
        $data['js'] = 'empleados/plantilla_todos_js';
        $this->load->view('main', $data);
    }
    
    function plantilla_ss($sup)
    {
        //$id_plaza=$this->session->userdata('id_plaza');
        $supx = $this->Catalogos_model->busca_sup_uno($sup);
        $data['titulo'] = "PLANTILLAS";
        $data['tit'] = 'PLANTILLA DE PERSONAL EN FARMACIA DE ' . trim($supx);
        $data['a'] = $this->empleados_model->plantilla($sup);
        //$data['js'] = 'entradas/facturas_suc_js';
        $this->load->view('main', $data);
    }
    
    function plantilla_sse($suc)
    {
        $sucx = $this->Catalogos_model->busca_suc_una($suc);
        $data['titulo'] = "PLANTILLAS";
        $data['tit'] = 'PLANTILLA DE PERSONAL EN FARMACIA DE ' . trim($sucx);
        $data['a'] = $this->empleados_model->plantilla($suc);
        //$data['js'] = 'entradas/facturas_suc_js';
        $this->load->view('main', $data);
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
