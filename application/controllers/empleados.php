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
        $data['tit'] = 'PLANTILLA DE PERSONAL EN FARMACIA DE ' . trim($gerx);
        $data['a'] = $this->empleados_model->plantilla($ger);
        //$data['js'] = 'entradas/facturas_suc_js';
        $this->load->view('main', $data);
    }
    
    function plantilla_ss($sup)
    {
        $supx = $this->Catalogos_model->busca_ger_uno($sup);
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


}
