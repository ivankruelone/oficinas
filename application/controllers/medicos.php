<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class medicos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('medicos_model');
    }
    
    function muestra_medicos()
    {
        $data['titulo'] = "Medicos";
        $data['busca']=$this->medicos_model->busca_dato();
        $data['query'] = $this->medicos_model->getMedicos();
        $this->load->view('main', $data);
    }
    
    function muestra_medicos2()
    {
        $data['titulo'] = "Medicos";        
        $var=$this->input->post('bus');
        $busca1 = $this->input->post('busca1');
        $busca2 = $this->input->post('busca2');
        $busca3 = $this->input->post('busca3');
        
        if($busca1<>'0' && $busca2=='0' && $busca3=='0'){
          $c = $busca1." "."like"." "."'%".$var."%'";
        }elseif($busca1<>'0' && $busca2<>'0' && $busca3=='0'){
          $c = $busca1." "."like"." "."'%".$var."%'  or ".$busca2." "."like"." "."'%".$var."%'";
        }elseif($busca1<>'0' && $busca2=='0' && $busca3<>'0'){
          $c = $busca1." "."like"." "."'%".$var."%'  or ".$busca3." "."like"." "."'%".$var."%'";
        }elseif($busca1=='0' && $busca2<>'0' && $busca3=='0'){
          $c = $busca2." "."like"." "."'%".$var."%'"; 
        }elseif($busca1=='0' && $busca2<>'0' && $busca3<>'0'){
          $c = $busca2." "."like"." "."'%".$var."%'  or ".$busca3." "."like"." "."'%".$var."%'"; 
        }elseif($busca1=='0' && $busca2=='0' && $busca3<>'0'){
          $c = $busca3." "."like"." "."'%".$var."%'";
        }elseif($busca1<>'0' && $busca2<>'0' && $busca3<>'0'){
          $c = $busca1." "."like"." "."'%".$var."%'  or ".$busca2." "."like"." "."'%".$var."%'  or ".$busca3." "."like"." "."'%".$var."%'";
        }else{
          $c = '';
        }
        $data['busca']=$this->medicos_model->busca_dato();
        $data['query'] = $this->medicos_model->busca_medico($c);
        $this->load->view('main', $data);
    }
    
       
    function medico_nuevo()
    {
        $data['titulo'] = "Nuevo Medico";
        $data['js'] = 'medicos/medico_nuevo_js';
        $data['especialidad'] = $this->medicos_model->muestra_especialidad();
        $data['tipo_cuenta'] = $this->medicos_model->tipo_tarjeta();
        $this->load->view('main', $data);
    }
    
    function checaCedula()
    {
      $cedula = $this->input->post('cedula');
      $query = $this->medicos_model->checaCedula($cedula);
      $row = $query->row();
      $numrows = $row->cuenta;
      if($numrows > 0){
     	  echo "0";
        }else{
       	echo "1";
      }
    }
    
    function traeEspecialidad(){
     $esp = $this->input->post('esp');
     echo $this->medicos_model->traeEspecialidad($esp);
    }
    
    function checaCp(){
     $codp = $this->input->post('codp');
     echo $this->medicos_model->Busca_cp($codp);
    }
    
    function checaColonia(){
      $codp = $this->input->post('codp');
      echo $this->medicos_model->Busca_colonia($codp);  
    }
    
    function obtenColonia(){
        $colonia = $this->input->post('colonia');
        echo $this->medicos_model->obten_Colonia($colonia);
    }
    
    function nuevo_medico_submit()
    {
        $cedula = $this->input->post('cedula');
        $apaterno = $this->input->post('apaterno');
        $amaterno = $this->input->post('amaterno');
        $nombre = $this->input->post('nombre');
        $esp = $this->input->post('esp');
        $especialidad = $this->input->post('especial');  
        $codp = $this->input->post('codp');
        $dire = $this->input->post('dire');
        $col = $this->input->post('col');
        $mnpio = $this->input->post('mnpio');
        $ciudad = $this->input->post('ciudad');
        $estado = $this->input->post('estado');
        $telefono = $this->input->post('telefono');
        $tipo_com = $this->input->post('tipo_com');
        //$comision = $this->input->post('comision');
        $tipo_cuenta = $this->input->post('tipo_cuenta');
        $cuenta = $this->input->post('tarjeta');
        $est = 1;
        $tipo = 2;
        $this->medicos_model->insertMedico($cedula,$apaterno,$amaterno,$nombre,$esp,$especialidad,$codp,$col,$mnpio,$estado,$ciudad,$dire,$telefono,$tipo_com,$tipo_cuenta,$cuenta,$tipo,$est);
        redirect('medicos/muestra_medicos/');
    }
    /****checasss 
        echo $id_med .' id_medico<br />';
        echo $cedula .' cedula<br />';
        echo $apaterno .' apaterno<br />';
        echo $amaterno .' amaterno<br />';
        echo $nombre .' nombre<br />';
        echo $esp .' esp<br />';
        echo $especialidad .' especialidad<br />';
        echo $codp .' codp<br />';
        echo $colonias .' colonias<br />';
        echo $dire .' dire<br />';
        echo $col .' mnpio<br />';
        echo $mnpio .' mnpio<br />';
        echo $ciudad .' ciudad<br />';
        echo $estado .' estado<br />';
        echo $telefono .' telefono<br />';
        echo $tipo_com .' tipo_com<br />';
        echo $tipo_cuenta .' tipo_cuenta<br />';
        echo $numero_cuenta .' numero_cuenta<br />';
        die();
    */
    
     function edita_medico($id_med)
    {
        
        $data['titulo'] = "Edita Medico";
        $data['id_med'] = $id_med;
        $q = $this->medicos_model->busca_med($id_med);
        $r = $q->row();
        $data['cedula'] = $r->cedula;
        $data['apaterno'] = $r->apaterno;
        $data['amaterno'] = $r->amaterno;
        $data['nombre'] = $r->nombre;
        $data['espe'] = $r->id_esp;
        $data['especialidad'] = $r->especialidad;
        $data['codp'] = $r->codp;
        $data['dire'] = $r->dire;
        $data['col'] = $r->col;
        $data['mnpio'] = $r->mnpio;
        $data['ciudad'] = $r->ciudad;
        $data['estado'] = $r->estado;
        $data['telefono'] = $r->telefono;
        $data['id_cuenta'] = $r->id_cuenta;
        $data['cuenta'] = $r->numero_cuenta;
        $data['id_comision'] = $r->id_comision;
        $data['esp'] = $this->medicos_model->muestra_especialidad();
        $data['tipo_cuenta'] = $this->medicos_model->tipo_tarjeta();
        $data['id_col'] = $this->medicos_model->ve_colonia($r->col);
        $data['colonias'] = $this->medicos_model->colonias($r->codp);
        $data['js'] = 'medicos/edita_medico_js';
        $this->load->view('main', $data);
    }
    
    function edita_medico_submit()
    {
        $id_med = $this->input->post('id_med');
        $cedula = $this->input->post('cedula');
        $apaterno = $this->input->post('apaterno');
        $amaterno = $this->input->post('amaterno');
        $nombre = $this->input->post('nombre');
        $esp = $this->input->post('esp');
        $especialidad = $this->input->post('especial');
        $codp = $this->input->post('codp');
        $colonias = $this->input->post('colonias');
        $dire = $this->input->post('dire');
        $col = $this->input->post('col');
        $mnpio = $this->input->post('mnpio');
        $ciudad = $this->input->post('ciudad');
        $estado = $this->input->post('estado');
        $telefono = $this->input->post('telefono');
        $tipo_com = $this->input->post('tipo_com');
        $tipo_cuenta = $this->input->post('tipo_cuenta');
        $numero_cuenta = $this->input->post('cuenta');
        /*
        echo $tipo_cuenta .' tipo_cuenta<br />';
        echo $numero_cuenta .' numero_cuenta<br />';
        die();
        */
        $data = array('cedula' => $cedula,'apaterno' => $apaterno,'amaterno' => $amaterno,'nombre' => $nombre,'id_esp' => $esp,'especialidad' => $especialidad,'codp' => $codp,'dire' => $dire,'col' => $col,'mnpio' => $mnpio,
        'ciudad' => $ciudad,'estado' => $estado,'telefono' => $telefono,'id_comision' => $tipo_com,'id_cuenta' => $tipo_cuenta,'numero_cuenta' => $numero_cuenta);
        $this->db->update('medicos.medicos', $data, array('id_med' => $id_med));
        redirect('medicos/muestra_medicos/');
    }
    
    function borra_medico($id_med){
        $a = array('est' => 2);
        $this->db->update('medicos.medicos',$a,array('id_med' => $id_med));
        redirect('medicos/muestra_medicos/');
    }
    
    function cedulas(){
       $data['titulo'] = "Medicos";
       $this->load->view('main', $data);
    }
    
    function muestra_medicos_in(){
        $data['titulo'] = "Medicos Inactivos";
        $data['busca']=$this->medicos_model->busca_dato();
        $data['query'] = $this->medicos_model->getMedicosIn();
        $this->load->view('main', $data);  
    }
    
    function muestra_medicos_in2(){
      $data['titulo'] = "Medicos Inactivos";        
      $var=$this->input->post('bus');
      $busca1 = $this->input->post('busca1');
      $busca2 = $this->input->post('busca2');
      $busca3 = $this->input->post('busca3');
        
        if($busca1<>'0' && $busca2=='0' && $busca3=='0'){
          $c = $busca1." "."like"." "."'%".$var."%'";
        }elseif($busca1<>'0' && $busca2<>'0' && $busca3=='0'){
          $c = $busca1." "."like"." "."'%".$var."%'  or ".$busca2." "."like"." "."'%".$var."%'";
        }elseif($busca1<>'0' && $busca2=='0' && $busca3<>'0'){
          $c = $busca1." "."like"." "."'%".$var."%'  or ".$busca3." "."like"." "."'%".$var."%'";
        }elseif($busca1=='0' && $busca2<>'0' && $busca3=='0'){
          $c = $busca2." "."like"." "."'%".$var."%'"; 
        }elseif($busca1=='0' && $busca2<>'0' && $busca3<>'0'){
          $c = $busca2." "."like"." "."'%".$var."%'  or ".$busca3." "."like"." "."'%".$var."%'"; 
        }elseif($busca1=='0' && $busca2=='0' && $busca3<>'0'){
          $c = $busca3." "."like"." "."'%".$var."%'";
        }elseif($busca1<>'0' && $busca2<>'0' && $busca3<>'0'){
          $c = $busca1." "."like"." "."'%".$var."%'  or ".$busca2." "."like"." "."'%".$var."%'  or ".$busca3." "."like"." "."'%".$var."%'";
        }else{
          $c = '';
        }
      $data['busca']=$this->medicos_model->busca_dato();
      $data['query'] = $this->medicos_model->busca_medico_in($c);
      $this->load->view('main', $data);;  
    }
    
    function activa_medico($id_med){
        $a = array('est' => 1);
        $this->db->update('medicos.medicos',$a,array('id_med' => $id_med));
        redirect('medicos/muestra_medicos/');  
    }
}