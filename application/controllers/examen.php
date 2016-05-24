<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('examen_model');
    }
    
    function index()
    {
        $data['titulo'] = "Examenes";
        $data['query'] = $this->examen_model->getExamen();
        $data['js'] = 'examen/index_js';
        $this->load->view('main', $data);
    }
    
    function resultado()
    {
        $data['titulo'] = "Examenes: Resultado";
        $data['query'] = $this->examen_model->getMaster();
        $data['js'] = 'examen/index_js';
        $this->load->view('main', $data);
    }
    
    function resultado_concentrado($x)
    {
        $data['titulo'] = "Examenes: Resultado";
        $data['query'] = $this->examen_model->getExamenByX($x);
        $data['x'] = $x;
        $data['js'] = 'examen/index_js';
        $this->load->view('main', $data);
    }
    
    function resultado_pregunta($examenID, $pregunta, $tipoID, $correcta)
    {
        $data['titulo'] = "Examenes: Resultado";
        $data['query'] = $this->examen_model->getEmpleadoPreguntas($examenID, $pregunta, $correcta);
        $data['correcta'] = $correcta;
        $data['js'] = 'examen/index_js';
        $data['preguntaTxt'] = $this->examen_model->getPreguntaByExamenIDPregunta($examenID, $pregunta, $tipoID);
        $this->load->view('main', $data);
    }

    function resultado_master($x)
    {
        $this->load->library('data');
        $this->load->model('grafica');
        $data['titulo'] = "Examenes: Resultado";
        $data['query'] = $this->examen_model->getResultadoByMaster($x);
        $data['maximo'] = $this->examen_model->getMaximo($x);
        $query2 = $this->examen_model->getGraficaMaster($x);
        $a = new Data();
        foreach($query2->result() as $row2)
        {
            $a->agregaData($row2->clasificacion, $row2->empleados);
        }
        
        $fuente = $this->grafica->fuente('Clasificacion de resultados', 'Examen ' . $x, 'Meses', '$ Pesos', 2, 1, $a->retornaData());
        $data['json'] = $this->grafica->chart('pie3d', 'chart', '500', '300', $fuente);
        
        $data['js'] = 'examen/resultado_master_js';
        $this->load->view('main', $data);
    }
    
    function resultado_detalle($x, $id)
    {
        $data['titulo'] = "Examenes: Resultado detalle";
        $data['query'] = $this->examen_model->getExamenByX($x);
        $data['id'] = $id;
        $this->load->view('main', $data);
    }

    function master()
    {
        $data['titulo'] = "Examenes: Master";
        $data['query'] = $this->examen_model->getMaster();
        $data['js'] = 'examen/index_js';
        $this->load->view('main', $data);
    }
    
    function nuevoMaster()
    {
        $this->examen_model->insertMaster();
        redirect('examen/master');
    }
    
    function editarMaster($x)
    {
        $data['titulo'] = "Editar Master";
        $data['liberar'] = $this->examen_model->getLiberarCombo();
        $data['query'] = $this->examen_model->getMasterByX($x);
        $this->load->view('main', $data);
    }
    
    function editarMaster_submit()
    {
        $x = $this->input->post('x');
        $liberar = $this->input->post('liberar');
        $this->examen_model->updateMaster($x, $liberar);
        
        redirect('examen/master');
    }

    function nuevo()
    {
        $data['titulo'] = "Nuevo examen";
        $data['x'] = $this->examen_model->getMasterCombo();
        $data['tipo'] = $this->examen_model->getTipoCombo();
        $data['js'] = 'examen/editarExamen_js';
        $this->load->view('main', $data);
    }
    
    function nuevo_submit()
    {
        $x = $this->input->post('x');
        $examen = $this->input->post('examen');
        $tiempo = $this->input->post('tiempo');
        $tipoID = $this->input->post('tipoID');
        $instrucciones = $this->input->post('instrucciones');
        $ejemplo = $this->input->post('ejemplo');
        $ponderacion = $this->input->post('ponderacion');
        
        $this->examen_model->insertExamen($examen, $tipoID, $tiempo, $instrucciones, $ejemplo, $ponderacion, $x);
        redirect('examen/index');
    }
    
    function editarExamen($examenID)
    {
        $data['titulo'] = "Editar examen";
        $data['x'] = $this->examen_model->getMasterCombo();
        $data['tipo'] = $this->examen_model->getTipoCombo();
        $data['liberar'] = $this->examen_model->getLiberarCombo();
        $data['query'] = $this->examen_model->getExamenByExamenID($examenID);
        $data['js'] = 'examen/editarExamen_js';
        $this->load->view('main', $data);
    }
    
    function editarExamen_submit()
    {
        $x = $this->input->post('x');
        $examen = $this->input->post('examen');
        $tiempo = $this->input->post('tiempo');
        $tipoID = $this->input->post('tipoID');
        $examenID = $this->input->post('examenID');
        $instrucciones = $this->input->post('instrucciones');
        $ejemplo = $this->input->post('ejemplo');
        $ponderacion = $this->input->post('ponderacion');
        
        $this->examen_model->updateExamen($examen, $tipoID, $tiempo, $examenID, $instrucciones, $ejemplo, $ponderacion, $x);
        redirect('examen/index');
    }
    
    function reactivos($examenID)
    {
        $data['titulo'] = "Reactivos";
        $data['query'] = $this->examen_model->getReactivoByExamenID($examenID);
        $data['examenID'] = $examenID;
        $data['js'] = 'examen/reactivos_js';
        $this->load->view('main', $data);
    }
    
    function reactivoEliminar($examenID, $reactivoID)
    {
        $this->examen_model->eliminarReactivo($reactivoID);
        redirect('examen/reactivos/'.$examenID);
    }
    
    function nuevoReactivo($examenID)
    {
        $data['titulo'] = "Nuevo reactivo";
        $data['examenID'] = $examenID;
        //$data['js'] = 'maestro/captura_producto_js';
        $this->load->view('main', $data);
    }
    
    function nuevoReactivo_submit()
    {
        $examenID = $this->input->post('examenID');
        $reactivo = $this->input->post('reactivo');
        
        $this->examen_model->insertReactivo($examenID, $reactivo);
        redirect('examen/reactivos/'.$examenID);
    }
    
    function editarReactivo($examenID, $reactivoID)
    {
        $data['titulo'] = "Edita reactivo";
        $data['examenID'] = $examenID;
        $data['reactivoID'] = $reactivoID;
        $data['query'] = $this->examen_model->getReactivoByReactivoID($reactivoID);
        //$data['js'] = 'maestro/captura_producto_js';
        $this->load->view('main', $data);
    }

    function editarReactivo_submit()
    {
        $examenID = $this->input->post('examenID');
        $reactivoID = $this->input->post('reactivoID');
        $reactivo = $this->input->post('reactivo');
        
        $this->examen_model->updateReactivo($examenID, $reactivo, $reactivoID);
        redirect('examen/reactivos/'.$examenID);
    }

    function opciones($examenID, $reactivoID)
    {
        $data['titulo'] = "Opciones del reactivo";
        $data['examenID'] = $examenID;
        $data['reactivoID'] = $reactivoID;
        $data['query'] = $this->examen_model->getOpcionByReactivoID($reactivoID);
        $data['query2'] = $this->examen_model->getReactivoByReactivoID($reactivoID);
        $data['js'] = 'examen/opciones_js';
        $this->load->view('main', $data);
    }

    function nuevaOpcion($examenID, $reactivoID)
    {
        $data['titulo'] = "Nuevo reactivo";
        $data['examenID'] = $examenID;
        $data['reactivoID'] = $reactivoID;
        $data['query2'] = $this->examen_model->getReactivoByReactivoID($reactivoID);
        //$data['js'] = 'maestro/captura_producto_js';
        $this->load->view('main', $data);
    }
    
    function nuevaOpcion_submit()
    {
        $examenID = $this->input->post('examenID');
        $reactivoID = $this->input->post('reactivoID');
        $opcion = $this->input->post('opcion');
        
        $this->examen_model->insertOpcion($reactivoID, $opcion);
        redirect('examen/opciones/'.$examenID.'/'.$reactivoID);
    }
    
    function editarOpcion($examenID, $reactivoID, $opcionID)
    {
        $data['titulo'] = "Nuevo reactivo";
        $data['examenID'] = $examenID;
        $data['reactivoID'] = $reactivoID;
        $data['opcionID'] = $opcionID;
        $data['query'] = $this->examen_model->getOpcionByOpcionID($opcionID);
        $data['query2'] = $this->examen_model->getReactivoByReactivoID($reactivoID);
        //$data['js'] = 'maestro/captura_producto_js';
        $this->load->view('main', $data);
    }
    
    function editarOpcion_submit()
    {
        $examenID = $this->input->post('examenID');
        $reactivoID = $this->input->post('reactivoID');
        $opcionID = $this->input->post('opcionID');
        $opcion = $this->input->post('opcion');
        
        $this->examen_model->updateOpcion($reactivoID, $opcion, $opcionID);
        redirect('examen/opciones/'.$examenID.'/'.$reactivoID);
    }
    
    function eliminarOpcion($examenID, $reactivoID, $opcionID)
    {
        $this->examen_model->deleteOpcion($opcionID);
        redirect('examen/opciones/'.$examenID.'/'.$reactivoID);
    }
    
    function saveCorrecta()
    {
        $reactivoID = $this->input->post('reactivoID');
        $opcionID = $this->input->post('opcionID');
        
        $this->examen_model->asignaRespuestaCorrecta($reactivoID, $opcionID);
        echo $this->examen_model->getMensajeCorrecto($reactivoID);
    }

    function enunciados($examenID)
    {
        $data['titulo'] = "Enunciados";
        $data['query'] = $this->examen_model->getEnunciadoByExamenID($examenID);
        $data['query2'] = $this->examen_model->getDistractorByExamenID($examenID);
        $data['examenID'] = $examenID;
        $data['js'] = 'examen/enunciados_js';
        $this->load->view('main', $data);
    }
    
    function enunciadoEliminar($examenID, $enunciadoID)
    {
        $this->examen_model->eliminarEnunciado($enunciadoID);
        redirect('examen/enunciados/'.$examenID);
    }

    function nuevoEnunciado($examenID)
    {
        $data['titulo'] = "Nuevo enunciado";
        $data['examenID'] = $examenID;
        //$data['js'] = 'maestro/captura_producto_js';
        $this->load->view('main', $data);
    }

    function nuevoEnunciado_submit()
    {
        $examenID = $this->input->post('examenID');
        $enunciado = $this->input->post('enunciado');
        
        $this->examen_model->insertEnunciado($examenID, $enunciado);
        redirect('examen/enunciados/'.$examenID);
    }

    function editarEnunciado($examenID, $enunciadoID)
    {
        $data['titulo'] = "Edita enunciado";
        $data['examenID'] = $examenID;
        $data['enunciadoID'] = $enunciadoID;
        $data['query'] = $this->examen_model->getEnunciadoByEnunciadoID($enunciadoID);
        //$data['js'] = 'maestro/captura_producto_js';
        $this->load->view('main', $data);
    }

    function editarEnunciado_submit()
    {
        $examenID = $this->input->post('examenID');
        $enunciadoID = $this->input->post('enunciadoID');
        $enunciado = $this->input->post('enunciado');
        
        $this->examen_model->updateEnunciado($examenID, $enunciado, $enunciadoID);
        redirect('examen/enunciados/'.$examenID);
    }


    function distractor($distractorID,$distractor,$examenID)
    {
        $data['titulo'] = "Distractor";
        $data['query'] = $this->examen_model->DistractorByExamenID($examenID);
        $data['distractorID'] = $distractorID;
        $data['distractor'] = $distractor;
        $data['examenID'] = $examenID;
        //$data['js'] = 'examen/enunciados_js';
        $this->load->view('main', $data);
    }

    function nuevoDistractor($examenID)
    {
        $data['titulo'] = "Agrega Distractor";
        $data['examenID'] = $examenID;
        $this->load->view('main', $data);
    }
    
     function nuevoDistractor_submit()
    {
        $examenID = $this->input->post('examenID');
        $distractor = $this->input->post('distractor');
        
        $this->examen_model->insertDistractor($examenID,$distractor);
        redirect('examen/enunciados/'.$examenID);
    }
    

    function distractorEliminar($examenID, $distractorID)
    {
        $this->examen_model->eliminarDistractor($distractorID);
        redirect('examen/enunciados/'.$examenID);
    }



    function palabras($examenID, $enunciadoID)
    {
        $data['titulo'] = "Edita palabras del enunciado";
        $data['examenID'] = $examenID;
        $data['enunciadoID'] = $enunciadoID;
        $data['query'] = $this->examen_model->getEnunciadoByEnunciadoID($enunciadoID);
        $data['js'] = 'examen/palabras_js';
        $this->load->view('main', $data);
    }
    
    function savePalabra()
    {
        $enunciadoID = $this->input->post('enunciadoID');
        $palabra = $this->input->post('palabra');
        
        $this->examen_model->guardaPalabra($enunciadoID, $palabra);
    }

    function relaciones($examenID)
    {
        $data['titulo'] = "Relaciones";
        $data['query'] = $this->examen_model->getRelacionByExamenID($examenID);
        $data['examenID'] = $examenID;
        $data['js'] = 'examen/relaciones_js';
        $this->load->view('main', $data);
    }
    
    function eliminarRelacion($examenID, $relacionID)
    {
        $this->examen_model->eliminarRelacion($relacionID);
        redirect('examen/relaciones/'.$examenID);
    }

    function nuevaRelacion($examenID)
    {
        $data['titulo'] = "Nueva relacion";
        $data['examenID'] = $examenID;
        $data['js'] = 'examen/nuevaRelacion_js';
        $this->load->view('main', $data);
    }
    
    function nuevaRelacion_submit()
    {
        $examenID = $this->input->post('examenID');
        $concepto = $this->input->post('concepto');
        $imagen = $this->input->post('imagen');
        
        $this->examen_model->insertRelacion($examenID, $concepto, $imagen);
        redirect('examen/relaciones/'.$examenID);
    }

    function editarRelacion($examenID, $relacionID)
    {
        $data['titulo'] = "Editar relacion";
        $data['examenID'] = $examenID;
        $data['query'] = $this->examen_model->getRelacionByRelacionID($relacionID);
        $data['js'] = 'examen/editarRelacion_js';
        $this->load->view('main', $data);
    }
    
    function editarRelacion_submit()
    {
        $relacionID = $this->input->post('relacionID');
        $examenID = $this->input->post('examenID');
        $concepto = $this->input->post('concepto');
        $imagen = $this->input->post('imagen');
        
        $this->examen_model->updateRelacion($examenID, $concepto, $imagen, $relacionID);
        redirect('examen/relaciones/'.$examenID);
    }

    function upload_imagen()
    {
        $this->load->helper('file');
        $uploaddir = './examen/';
        $file = basename($_FILES['userfile']['name']);
        $uploadfile = $uploaddir . $file;

        $config['image_library'] = 'gd2';
        $config['source_image'] = $uploadfile;
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = true;
        $config['width'] = 400;
        $config['height'] = 400;
        $config['master_dim'] = 'auto';

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            echo $file;
        } else {
            echo "error";
        }
    
    }

    function relaciones2($examenID)
    {
        $data['titulo'] = "Relaciones";
        $data['query'] = $this->examen_model->getRelacion2ByExamenID($examenID);
        $data['examenID'] = $examenID;
        $data['js'] = 'examen/relaciones_js';
        $this->load->view('main', $data);
    }

    function nuevaRelacion2($examenID)
    {
        $data['titulo'] = "Nueva relacion";
        $data['examenID'] = $examenID;
        $this->load->view('main', $data);
    }
    
    function nuevaRelacion2_submit()
    {
        $examenID = $this->input->post('examenID');
        $conceptoA = $this->input->post('conceptoA');
        $conceptoB = $this->input->post('conceptoB');
        
        $this->examen_model->insertRelacion2($examenID, $conceptoA, $conceptoB);
        redirect('examen/relaciones2/'.$examenID);
    }

    function editarRelacion2($examenID, $relacionID)
    {
        $data['titulo'] = "Editar relacion";
        $data['examenID'] = $examenID;
        $data['query'] = $this->examen_model->getRelacion2ByRelacionID($relacionID);
        $this->load->view('main', $data);
    }
    
    function editarRelacion2_submit()
    {
        $relacionID = $this->input->post('relacionID');
        $examenID = $this->input->post('examenID');
        $conceptoA = $this->input->post('conceptoA');
        $conceptoB = $this->input->post('conceptoB');
        
        $this->examen_model->updateRelacion2($examenID, $conceptoA, $conceptoB, $relacionID);
        redirect('examen/relaciones2/'.$examenID);
    }

    function eliminarRelacion2($examenID, $relacionID)
    {
        $this->examen_model->eliminarRelacion2($relacionID);
        redirect('examen/relaciones2/'.$examenID);
    }

    function imagen($examenID)
    {
        $data['titulo'] = "Agregar una imagen";
        $data['examenID'] = $examenID;
        $data['js'] = 'examen/imagen_js';
        $this->load->view('main', $data);
    }
    
    function imagen_submit()
    {
        $examenID = $this->input->post('examenID');
        $texto = $this->input->post('texto');
        $imagen = $this->input->post('imagen');
        
        $this->examen_model->insertImagen($examenID, $texto, $imagen);
        redirect('examen/index');
    }

    function upload_imagen2()
    {
        $this->load->helper('file');
        $uploaddir = './examen/';
        $file = basename($_FILES['userfile']['name']);
        $uploadfile = $uploaddir . $file;

        $config['image_library'] = 'gd2';
        $config['source_image'] = $uploadfile;
        $config['create_thumb'] = false;
        $config['maintain_ratio'] = true;
        $config['width'] = 800;
        $config['height'] = 600;
        $config['master_dim'] = 'auto';

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            echo $file;
        } else {
            echo "error";
        }
    
    }
    
    function eliminaImagen($imagenID)
    {
        $this->examen_model->imagenElimina($imagenID);
        redirect('examen/index');
    }
    
    
    function empleado_alta()
    {
     $data['titulo'] = 'Nuevos Empleados';
     $data['query'] = $this->examen_model->getMesAltas();
     $this->load->view('main', $data);
    }
    
    function empleado_alta_detalle($aaa, $mes)
    {
     $data['titulo'] = "Empleados Nuevos Sucursales";  
     $data['q']=$this->examen_model->empleado_alta_detalle($aaa,$mes);
     $data['js'] = 'examen/empleado_alta_js';
     $this->load->view('main', $data);
    }
    
    function empleado_alta_detalle_c($aaa, $mes,$suc)
    {
     $data['titulo'] = "Empleados de la sucursal: ".$suc; 
     $data['q']=$this->examen_model->empleado_alta_detalle_c($aaa,$mes,$suc);
     $data['js'] = 'examen/empleado_alta_detalle_js';
     $this->load->view('main', $data);   
    }

}