<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('test_model');

    }
    
//////////////////////////////////////////////////////////////////////terman merril/////////////////////////////////////    
    
    function terman_merril()
    {
        $data['titulo'] = "Prueba Terman Merril";
        $this->load->view('main', $data);
    }
    
    function terman_merril_serie_1()
    {
        $url_segmento = $this->uri->segment(2);
        $serie = str_replace('terman_merril_serie_', '', $url_segmento);
        $data['serie'] = $serie;
        $data['info'] = $this->test_model->getSerieBySerie($serie);
        $data['preguntas'] = $this->test_model->getPreguntaBySerie($serie);
        $data['titulo'] = "Prueba Terman Merril Serie " . $serie;
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function terman_merril_serie_2()
    {
        $url_segmento = $this->uri->segment(2);
        $serie = str_replace('terman_merril_serie_', '', $url_segmento);
        $data['serie'] = $serie;
        $data['info'] = $this->test_model->getSerieBySerie($serie);
        $data['preguntas'] = $this->test_model->getPreguntaBySerie($serie);
        $data['titulo'] = "Prueba Terman Merril Serie " . $serie;
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function terman_merril_serie_3()
    {
        $url_segmento = $this->uri->segment(2);
        $serie = str_replace('terman_merril_serie_', '', $url_segmento);
        $data['serie'] = $serie;
        $data['info'] = $this->test_model->getSerieBySerie($serie);
        $data['preguntas'] = $this->test_model->getPreguntaBySerie($serie);
        $data['titulo'] = "Prueba Terman Merril Serie " . $serie;
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function terman_merril_serie_4()
    {
        $url_segmento = $this->uri->segment(2);
        $serie = str_replace('terman_merril_serie_', '', $url_segmento);
        $data['serie'] = $serie;
        $data['info'] = $this->test_model->getSerieBySerie($serie);
        $data['preguntas'] = $this->test_model->getPreguntaBySerie($serie);
        $data['titulo'] = "Prueba Terman Merril Serie " . $serie;
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function terman_merril_serie_5()
    {
        $url_segmento = $this->uri->segment(2);
        $serie = str_replace('terman_merril_serie_', '', $url_segmento);
        $data['serie'] = $serie;
        $data['info'] = $this->test_model->getSerieBySerie($serie);
        $data['preguntas'] = $this->test_model->getPreguntaBySerie($serie);
        $data['titulo'] = "Prueba Terman Merril Serie " . $serie;
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function terman_merril_serie_6()
    {
        $url_segmento = $this->uri->segment(2);
        $serie = str_replace('terman_merril_serie_', '', $url_segmento);
        $data['serie'] = $serie;
        $data['info'] = $this->test_model->getSerieBySerie($serie);
        $data['preguntas'] = $this->test_model->getPreguntaBySerie($serie);
        $data['titulo'] = "Prueba Terman Merril Serie " . $serie;
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function terman_merril_serie_7()
    {
        $url_segmento = $this->uri->segment(2);
        $serie = str_replace('terman_merril_serie_', '', $url_segmento);
        $data['serie'] = $serie;
        $data['info'] = $this->test_model->getSerieBySerie($serie);
        $data['preguntas'] = $this->test_model->getPreguntaBySerie($serie);
        $data['titulo'] = "Prueba Terman Merril Serie " . $serie;
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function terman_merril_serie_8()
    {
        $url_segmento = $this->uri->segment(2);
        $serie = str_replace('terman_merril_serie_', '', $url_segmento);
        $data['serie'] = $serie;
        $data['info'] = $this->test_model->getSerieBySerie($serie);
        $data['preguntas'] = $this->test_model->getPreguntaBySerie($serie);
        $data['titulo'] = "Prueba Terman Merril Serie " . $serie;
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function terman_merril_serie_9()
    {
        $url_segmento = $this->uri->segment(2);
        $serie = str_replace('terman_merril_serie_', '', $url_segmento);
        $data['serie'] = $serie;
        $data['info'] = $this->test_model->getSerieBySerie($serie);
        $data['preguntas'] = $this->test_model->getPreguntaBySerie($serie);
        $data['titulo'] = "Prueba Terman Merril Serie " . $serie;
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function terman_merril_serie_10()
    {
        $url_segmento = $this->uri->segment(2);
        $serie = str_replace('terman_merril_serie_', '', $url_segmento);
        $data['serie'] = $serie;
        $data['info'] = $this->test_model->getSerieBySerie($serie);
        $data['preguntas'] = $this->test_model->getPreguntaBySerie($serie);
        $data['titulo'] = "Prueba Terman Merril Serie " . $serie;
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function terman_merril_serie_11()
    {
        $url_segmento = $this->uri->segment(2);
        $serie = str_replace('terman_merril_serie_', '', $url_segmento);
        $data['serie'] = $serie;
        $data['titulo'] = "Prueba Terman Merril Serie " . $serie;
        $this->load->view('main', $data);
    }

    function actualiza_terman()
    {
        $valor = $this->input->post('valor');
        $this->test_model->insertRespuesta($valor);
    }
    
    function actualizaPreguntaValor()
    {
        $pregunta = $this->input->post('pregunta');
        $valor = $this->input->post('valor');
        $opcion = $this->input->post('opcion');
        $this->test_model->insertRespuestaValor($pregunta, $valor, $opcion);
    }
    
    function actualizaPreguntaValor2()
    {
        $pregunta = $this->input->post('pregunta');
        $valor = $this->input->post('valor');
        $opcion = $this->input->post('opcion');
        $this->test_model->insertRespuestaValor2($pregunta, $valor, $opcion);
    }

    function actualizaTiempoRestanteActual()
    {
        $tiempoRestanteActual = $this->input->post('tiempoRestanteActual');
        $serie = $this->input->post('serie');
        $this->test_model->insertTiempoRestante($tiempoRestanteActual, $serie);
    }
    
    function termanComienza()
    {
        $serie = $this->input->post('serie');
        $this->test_model->termanComienza($serie);
    }
    
    function termanFinaliza()
    {
        $serie = $this->input->post('serie');
        $this->test_model->termanComienza($serie);
    }
    
    function terman_merril_res()
    {
        
        $data['q'] = $this->test_model->getresultado();
        $data['titulo'] = "Resultado Prueba Terman Merril";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function test_detalle($id)
    {
        
        $data['q'] = $this->test_model->getresultado1($id);
        $data['titulo'] = "Resultado Prueba Terman Merril";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function test_detalle_detalle($id, $serie)
    {
        
        $data['q'] = $this->test_model->getresultado_x_serie($id, $serie);
        $data['titulo'] = "Resultado Prueba Terman Merril X Serie";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
//////////////////////////////////////////////////////////////////////cleaver/////////////////////////////////////

    function cleaver()
    {
        $data['titulo'] = "Cleaver";
        $data['control'] = $this->test_model->getCleaverTest();
        $this->load->view('main', $data);
        
    }
    
    function cleaver_serie()
    {
        $data['series'] = $this->test_model->getSerieCleaver();
        $data['control'] = $this->test_model->getCleaverTest();
        $data['titulo'] = "Prueba Cleaver";
        $data['js'] = 'test/cleaver_js';
        $this->load->view('main', $data);
    }
    
    function actualiza_cleaver()
    {
        $valor = $this->input->post('valor');
        $tipo = $this->input->post('tipo');
        
        $this->test_model->insertCleaver($valor, $tipo);
    }
    
    function cleaver_res()
    {
        
        $data['q'] = $this->test_model->getresultado_cleaver();
        $data['titulo'] = "Resultado Prueba Cleaver";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function test_detalle1($id)
    {
        
        $data['q'] = $this->test_model->getresultado_cleaver1($id);
        $data['titulo'] = "Resultado Prueba Cleaver";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function cleaverComienza()
    {
        $this->test_model->comienzaCleaver();
    }
    
    function cleaver_tiempo_terminado()
    {
        $data['titulo'] = "Cleaver";
        $this->load->view('main', $data);
        
    }
    
///////////////////////////////////////////////////////////////////////moss//////////////////////////////////////////////////////    
    
    function moss()
    {
        $data['titulo'] = "Moss";
        $data['control'] = $this->test_model->getMossTest();
        $this->load->view('main', $data);
        
    }
    
    function moss_serie()
    {
        $data['preguntas'] = $this->test_model->getSerieMoss();
        $data['control'] = $this->test_model->getMossTest();
        $data['titulo'] = "Prueba Moss";
        $data['js'] = 'test/moss_js';
        $this->load->view('main', $data);
    }
    
    function actualiza_moss()
    {
        $valor = $this->input->post('valor');
        
        $this->test_model->insertMoss($valor);
    }
    
    function mossComienza()
    {
        $this->test_model->comienzaMoss();
    }
    
    function moss_tiempo_terminado()
    {
        $data['titulo'] = "Moss";
        $this->load->view('main', $data);
        
    }
    
    function moss_res()
    {
        
        $data['q'] = $this->test_model->getresultado_moss();
        $data['titulo'] = "Resultado Prueba Moss";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function test_detalle_moss($id)
    {
        
        $data['q'] = $this->test_model->getresultado_moss1($id);
        $data['titulo'] = "Resultado Prueba Moss";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
/////////////////////////////////////////////////////////////////////////////////IPV/////////////////////////////////////////////////////

    function ipv()
    {
        $data['titulo'] = "IPV";
        $data['control'] = $this->test_model->getIpvTest();
        $this->load->view('main', $data);
        
    }
    
    function ipv_serie()
    {
        $data['preguntas'] = $this->test_model->getSerieIpv();
        $data['control'] = $this->test_model->getIpvTest();
        $data['titulo'] = "Prueba IPV";
        $data['js'] = 'test/ipv_js';
        $this->load->view('main', $data);
    }
    
    function actualiza_ipv()
    {
        $valor = $this->input->post('valor');
        
        $this->test_model->insertIpv($valor);
    }
    
    function ipvComienza()
    {
        $this->test_model->comienzaIpv();
    }
    
    function ipv_tiempo_terminado()
    {
        $data['titulo'] = "IPV";
        $this->load->view('main', $data);
        
    }
    
    function ipv_res()
    {
        
        $data['q'] = $this->test_model->getresultado_ipv();
        $data['titulo'] = "Resultado Prueba Ipv";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function test_detalle_ipv($id)
    {
        
        $data['q'] = $this->test_model->getresultado_ipv1($id);
        $data['titulo'] = "Resultado Prueba Ipv";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    /////////////////////////////////////////////////////////////////////////////////REDDIN/////////////////////////////////////////////////////

    function reddin()
    {
        $data['titulo'] = "REDDIN";
        $data['control'] = $this->test_model->getReddinTest();
        $this->load->view('main', $data);
        
    }
    
    function reddin_serie()
    {
        $data['preguntas'] = $this->test_model->getSerieReddin();
        $data['control'] = $this->test_model->getReddinTest();
        $data['titulo'] = "Prueba REDDIN";
        $data['js'] = 'test/reddin_js';
        $this->load->view('main', $data);
    }
    
    function actualiza_reddin()
    {
        $valor = $this->input->post('valor');
        
        $this->test_model->insertreddin($valor);
    }
    
    function reddinComienza()
    {
        $this->test_model->comienzaReddin();
    }
    
    function reddin_tiempo_terminado()
    {
        $data['titulo'] = "Reddin";
        $this->load->view('main', $data);
        
    }
    
    function reddin_res()
    {
        
        $data['q'] = $this->test_model->getresultado_reddin();
        $data['titulo'] = "Resultado Prueba Reddin";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function test_detalle_reddin($id)
    {
        
        $data['q'] = $this->test_model->getresultado_reddin1($id);
        $data['titulo'] = "Resultado Prueba Reddin";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
        /////////////////////////////////////////////////////////////////////////////////Zavic/////////////////////////////////////////////////////

    function zavic()
    {
        $data['preguntas'] = $this->test_model->getSerieZavic1();
        $data['titulo'] = "Zavic";
        $data['control'] = $this->test_model->getZavicTest();
        $data['js'] = 'test/zavic1_js';
        $this->load->view('main', $data);
        
    }
    
    function Zavic_serie()
    {
        $data['preguntas'] = $this->test_model->getSerieZavic();
        $data['control'] = $this->test_model->getZavicTest();
        $data['titulo'] = "Prueba Zavic";
        $data['js'] = 'test/zavic_js';
        $this->load->view('main', $data);
    }
    
    function actualiza_Zavic()
    {
        $valor = $this->input->post('valor');
    
        $this->test_model->insertZavic($valor);
    }
    
    function zavicComienza()
    {
        $this->test_model->comienzaZavic();
    }
    
    function zavic_tiempo_terminado()
    {
        $data['titulo'] = "Zavic";
        $this->load->view('main', $data);
        
    }
    
    function zavic_res()
    {
        
        $data['q'] = $this->test_model->getresultado_zavic();
        $data['titulo'] = "Resultado Prueba Zavic";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function test_detalle_zavic($id)
    {
        
        $data['q'] = $this->test_model->getresultado_zavic1($id);
        $data['titulo'] = "Resultado Prueba Zavic";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
            /////////////////////////////////////////////////////////////////////////////////Beta/////////////////////////////////////////////////////

    function bet()
    {
        
        $data['titulo'] = "Beta III";
        $this->load->helper('html');
        $this->load->view('main', $data);
        
    }
    
    
    function beta()
    {
        $serie=1;
        $data['titulo'] = "Beta III";
        $data['control'] = $this->test_model->getBetaTest($serie);
        $this->load->helper('html');
        $this->load->view('main', $data);
        
    }
    
    function beta_serie1()
    {
        $serie=1;
        $data['serie'] = $serie;
        $data['preguntas'] = $this->test_model->getSerieBeta($serie);
        $data['titulo'] = "Prueba Beta" . $serie;
        $data['control'] = $this->test_model->getBetaTest($serie);
        $this->load->helper('html');
        $data['js'] = 'test/beta_serie_js';
        $this->load->view('main', $data);
    }
    
    function betaComienza()
    {
        $serie = $this->input->post('serie');
        $this->test_model->comienzaBeta($serie);
    }
    
    function actualizaPreguntaValor1()
    {
        $pregunta = $this->input->post('pregunta');
        $valor = $this->input->post('valor');
        $opcion = $this->input->post('opcion');
        $this->test_model->insertRespuestaValor1($pregunta, $valor, $opcion);
    }
    
    function beta_tiempo_terminado($test)
    {
        $data['serie'] = $this->input->post('serie');
        $data['test'] = $test;
        $data['titulo'] = "Beta";
        $this->load->view('main', $data);
        
    }
    
    function beta_terminado()
    {
      
        $data['titulo'] = "Beta";
        $this->load->view('main', $data);
        
    }
    
    function beta2()
    {
        $serie=2;
        $data['titulo'] = "Beta III";
        $data['control'] = $this->test_model->getBetaTest($serie);
        $this->load->helper('html');
        $this->load->view('main', $data);
        
    }
    
    function beta_serie2()
    {
        $serie=2;
        $data['serie'] = $serie;
        $data['preguntas'] = $this->test_model->getSerieBeta($serie);
        $data['titulo'] = "Prueba Beta" . $serie;
        $data['control'] = $this->test_model->getBetaTest($serie);
        $this->load->helper('html');
        $data['js'] = 'test/beta_serie_js';
        $this->load->view('main', $data);
    }
    
    function beta3()
    {
        $serie=3;
        $data['titulo'] = "Beta III";
        $data['control'] = $this->test_model->getBetaTest($serie);
        $this->load->helper('html');
        $this->load->view('main', $data);
        
    }
    
    function beta_serie3()
    {
        $serie=3;
        $data['serie'] = $serie;
        $data['preguntas'] = $this->test_model->getSerieBeta($serie);
        $data['titulo'] = "Prueba Beta" . $serie;
        $data['control'] = $this->test_model->getBetaTest($serie);
        $this->load->helper('html');
        $data['js'] = 'test/beta_serie_js';
        $this->load->view('main', $data);
    }
    
    function beta4()
    {
        $serie=4;
        $data['titulo'] = "Beta III";
        $data['control'] = $this->test_model->getBetaTest($serie);
        $this->load->helper('html');
        $this->load->view('main', $data);
        
    }
    
    function beta_serie4()
    {
        $serie=4;
        $data['serie'] = $serie;
        $data['preguntas'] = $this->test_model->getSerieBeta($serie);
        $data['titulo'] = "Prueba Beta" . $serie;
        $data['control'] = $this->test_model->getBetaTest($serie);
        $this->load->helper('html');
        $data['js'] = 'test/beta_serie_js';
        $this->load->view('main', $data);
    }
    
    function beta5()
    {
        $serie=5;
        $data['titulo'] = "Beta III";
        $data['control'] = $this->test_model->getBetaTest($serie);
        $this->load->helper('html');
        $this->load->view('main', $data);
        
    }
    
    function beta_serie5()
    {
        $serie=5;
        $data['serie'] = $serie;
        $data['preguntas'] = $this->test_model->getSerieBeta($serie);
        $data['titulo'] = "Prueba Beta" . $serie;
        $data['control'] = $this->test_model->getBetaTest($serie);
        $this->load->helper('html');
        $data['js'] = 'test/beta_serie_js';
        $this->load->view('main', $data);
    }
    
    function beta_res()
    {
        
        $data['q'] = $this->test_model->getresultado_beta();
        $data['titulo'] = "Resultado Prueba Beta III";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function test_detalle_beta($id)
    {
        
        $data['q'] = $this->test_model->getresultado_beta1($id);
        $data['q1'] = $this->test_model->getresultado_beta1_1($id);
        $data['titulo'] = "Resultado Prueba Beta";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
    
    function test_detalle_beta1($id, $serie)
    {
        
        $data['q'] = $this->test_model->getresultado_detalle($id, $serie);
        $data['titulo'] = "Resultado Prueba Beta";
        $data['js'] = 'test/terman_merril_serie_js';
        $this->load->view('main', $data);
    }
}
