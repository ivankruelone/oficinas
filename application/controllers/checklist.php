<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class checklist extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('checklist_model');
    }
    
    function index_evaluacion()
    {
        $data['titulo'] = "Evaluacion";
        $data['query'] = $this->checklist_model->getEvaluacion();
        $data['query2'] = $this->checklist_model->getponderacion();
        $this->load->view('main', $data);
    }
    
    function editarchecklist($id)
    {
        $data['titulo'] = "Editar Evaluacion";
        $data['tipo'] = $this->checklist_model->getTipoCombo();
        $data['query'] = $this->checklist_model->getValoracionByValoracion($id);
        $data['js'] = 'checklist/editarchecklist_js';
        $this->load->view('main', $data);
    }

    function editarchecklist_submit()
    {
        $id = $this->input->post('id');
        $valoracion = $this->input->post('valoracion');
        $descripcion = $this->input->post('descripcion');
        $instrucciones = $this->input->post('instrucciones');
        $objetivo = $this->input->post('objetivo');
 
        $this->checklist_model->updatevaloracion($id, $valoracion, $descripcion,$instrucciones,$objetivo);
        redirect('checklist/index_evaluacion');
    }
        
    function updateChecklist()
    {
        $data = array('id' => $id, 'valoracion' => $valoracion,'tipo' => $tipo, 'instrucciones' => $instrucciones);
        $this->db->update('checklist.valoracion', $data, array('id' => $id));
    }
    
    function preguntas_checklist($id)
    {
        $data['titulo'] = "Preguntas";
        $data['query'] = $this->checklist_model->getpregunta($id);
        $data['id'] = $id;
        $this->load->view('main', $data);
    }
    
    function edita_pregunta($id,$idpregunta)
    {
        
        $data['titulo'] = "Editar Pregunta";
        $data['query'] = $this->checklist_model->getPreguntas_edita($id,$idpregunta);
        $data['tipos'] = $this->checklist_model->muestra_tipo();
        $data['vale'] = $this->checklist_model->muestra_vale();
        $data['tipo3'] = $this->checklist_model->muestra_tipofarmacia();
        $this->load->view('main', $data);
    }
    
    function edita_pregunta_submit()
    {
        $id = $this->input->post('id');
        $idpregunta = $this->input->post('idpregunta');
        $pregunta = $this->input->post('pregunta');
        $tipo = $this->input->post('tipo');
        $vale = $this->input->post('vale');
        $tipo3 = $this->input->post('tipo3');
        $observaciones = $this->input->post('observaciones');
        $data = array('pregunta' => $pregunta,'tipo' => $tipo,'vale' => $vale,'tipo3' => $tipo3,'observaciones' => $observaciones);
        $this->db->update('checklist.preguntas', $data, array('id' => $id,'idpregunta' => $idpregunta));
        //$this->db->set('observaciones',$observaciones);//,'observaciones' => $observaciones);
        //$this->db->update('checklist.preguntas', null, array('id' => $id, 'idpregunta' => $idpregunta));
        redirect('checklist/preguntas_checklist/'.$id);
    }

    
    function nueva_pregunta($id)
    {
        $data['titulo'] = "Nueva Pregunta";
        $data['tipos'] = $this->checklist_model->muestra_tipo();
        $data['id'] = $id;
        $data['tipo3'] = $this->checklist_model->muestra_tipofarmacia();
        $this->load->view('main', $data);
    }
    
    function nueva_pregunta_submit()
    {
        $id = $this->input->post('id');
        $idpregunta = $this->input->post('idpregunta');
        $pregunta = $this->input->post('pregunta');
        $tipo = $this->input->post('tipo');
        $tipo3 = $this->input->post('tipo3');
        
        $this->checklist_model->insertPregunta($id,$pregunta,$tipo, $tipo3);
        redirect('checklist/preguntas_checklist/'.$id);
    }
    
    function eliminarPregunta($id, $idpregunta)
    {
        $this->checklist_model->deletePregunta($id,$idpregunta);
        redirect('checklist/preguntas_checklist/'.$id);
    }
    

    function editar_ponderacion($id)
    {  
        $data['titulo'] = "Editar Pregunta";
        $data['query'] = $this->checklist_model->getponderacion($id);
        $this->load->view('main', $data);
    }
      
    function editar_ponderacion_submit()
    {
        $id = $this->input->post('id');
        $tipoFarmacia = $this->input->post('tipoFarmacia');
        $valor = $this->input->post('valor');
        $calificacion = $this->input->post('calificacion');
    
        $this->checklist_model->updateponderacion($id,$tipoFarmacia,$valor,$calificacion);
        redirect('checklist/index_evaluacion');
    }
    
    function updateponderacion()
    {
        $data = array('id' => $id, '$tipoFarmacia' => $$tipoFarmacia,'valor' => $valor, 'calificacion' => $calificacion);
        $this->db->update('checklist.ponderaciones', $data, array('id' => $id));
    }

    function periodos()
    {
        $data['titulo'] = "Periodos";
        $data['query'] = $this->checklist_model->getperiodos(0);
        $this->load->view('main', $data);
    }
    
    function periodos_evaluados()
    {
        $data['titulo'] = "Periodos";
        $data['query'] = $this->checklist_model->getperiodos(1);
        $this->load->view('main', $data);
    }
    
    function periodos_evaluados_reg()
    {
        $data['titulo'] = "Periodos";
        $data['query'] = $this->checklist_model->getperiodos_reg(1);
        $this->load->view('main', $data);
    }

    function evaluar($periodoID,$periodo_sucursalID,$suc)
    {
        $data['periodoID'] = $periodoID;
        $data['periodo_sucursalID'] = $periodo_sucursalID;
        $data['suc'] = $suc;
        $data['titulo'] = "Periodos";
        $data['query'] = $this->checklist_model->getclasificacion();
        $data['js'] = 'checklist/evaluar_js';
        $this->load->view('main', $data);
        
    }

    function guardarResultado()
    {
        $periodo_sucursalID = $this->input->post('periodo_sucursalID');
        $idpregunta = $this->input->post('idpregunta');
        $valor = $this->input->post('valor');

        $this->checklist_model->replacesavePalabra($periodo_sucursalID,$idpregunta,$valor);
                
    }

    function index_resultado()
    {
        $data['titulo'] = "Resultados";
        $data['query'] = $this->checklist_model->getPeriodo();
        $this->load->view('main', $data);
    }
    
    function resultados($periodoID)
    {
        $data['titulo'] = "Resultados";
        $data['periodoID'] = $periodoID;
        $data['query'] = $this->checklist_model->getResultados($periodoID);
        $data['query2'] = $this->checklist_model->getResultados2($periodoID);
        $this->load->view('main', $data);
    }
    
    function guardaTexto()
    {
        $periodo_sucursalID = $this->input->post('periodo_sucursalID');
        $idpregunta = $this->input->post('idpregunta');
        $valor = $this->input->post('valor');

        $this->checklist_model->replacesaveObservacion($periodo_sucursalID,$idpregunta,$valor);
        
    }

    
    function secciones($suc, $periodoID)
    {
        $data['titulo'] = "Resultados por Sucursal";
        $data['periodoID'] = $periodoID;
        $data['query'] = $this->checklist_model->getSecciones($suc, $periodoID);
        $data['query2'] = $this->checklist_model->getSec_Observaciones($suc, $periodoID);
        $this->load->view('main', $data);
    }
    
    function Resultados_Sucursal($suc,$id, $periodoID)
    {
        $data['titulo'] = "Resultados por Sucursal";
        $data ['suc'] = $suc;
        $data ['id'] = $id;
        $data ['periodoID'] = $periodoID;
        $data['query'] = $this->checklist_model->getResultados_Sucursal($suc,$id, $periodoID);
        $data['total'] = $this->checklist_model->getTotal_Resultado($suc,$id);
        $data['query2'] = $this->checklist_model->getResultados_Sucursal2($suc,$id);
        $this->load->view('main', $data);
    }
    
    
    function comentarios_observaciones($periodoID,$periodo_sucursalID,$suc)
    {
        $data['titulo'] = "Observaciones & Comentarios";
        $data['query'] = $this->checklist_model->getObservaciones_comentarios($periodoID,$periodo_sucursalID,$suc);
        $this->load->view('main', $data);
    }
    
    function comentarios_observaciones_submit()
    {
        $periodoID = $this->input->post('periodoID');
        $suc = $this->input->post('suc');
        $realizado = $this->input->post('realizado');
        $periodo_sucursalID = $this->input->post('periodo_sucursalID');
        $observaciones = $this->input->post('observaciones');
        $comentarios = $this->input->post('comentarios');
        $seguimiento = $this->input->post('seguimiento');
        
        $data = array('observaciones' => $observaciones, 'comentarios' => $comentarios,'seguimiento' => $seguimiento);
        $this->db->where('periodoID',$periodoID);
        $this->db->where('suc',$suc);
        $this->db->where('realizado',$realizado);
        $this->db->where('periodo_sucursalID',$periodo_sucursalID);
        $this->db->update('checklist.periodo_sucursal',$data,null);
        
        redirect('checklist/periodos');
    }
    
 
    
    function Terminar_submit()
    {
        
        $periodoID = $this->input->post('periodoID');
        $suc = $this->input->post('suc');
        $periodo_sucursalID = $this->input->post('periodo_sucursalID');
        $valor = 1;
  
        $this->db->set('realizado',$valor,false);
        $this->db->where('periodoID',$periodoID);
        $this->db->where('suc',$suc);
        $this->db->where('periodo_sucursalID',$periodo_sucursalID);
        $this->db->update('checklist.periodo_sucursal',null);
        
    
        redirect('checklist/periodos');
    }
    
    function resultados_globales($periodoID)
    {
        $data['titulo'] = "Resultados Gobal ";
        $data['periodoID'] = $periodoID;
        $data['query'] = $this->checklist_model->getSecciones_global($periodoID);
        $data['query2'] = $this->checklist_model->getSecciones_global2($periodoID);
        $this->load->view('main', $data);
    }


    function resultados_globales_detalle($periodoID,$id)
    {
        $data['titulo'] = "Resultado Global Detalle";
        $data['periodoID'] = $periodoID;
        $data['id'] = $id;
        $data['query'] = $this->checklist_model->getResultados_global_detalle($periodoID,$id);
        $data['query2'] = $this->checklist_model->getResultados_global_detalle2($periodoID,$id);
        $this->load->view('main', $data);
    }
    
}