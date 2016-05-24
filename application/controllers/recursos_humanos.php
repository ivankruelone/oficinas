<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recursos_humanos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('recursos_humanos_model');
        $this->load->model('Catalogos_model');
        

    }
    
    function s_cap_mov()
    {
        $data['titulo'] = "Captura de Movimientos";
        $data['mov']=$this->Catalogos_model->busca_mov_captura();
        //$data['q']=$this->backoffice_model->fac_central();
        $this->load->view('main', $data);
    }
    function s_cap_mov_id()
    {
        $id_plaza=$this->session->userdata('id_plaza');    
        $data['mov']=$this->input->post('mov');
        $data['fec']=date('Y-m-d');
        $movx=$this->Catalogos_model->busca_mov_captura_uno($this->input->post('mov'));
        $data['nomina']=$this->Catalogos_model->busca_empleado_zona($id_plaza);
         /* if($this->input->post('mov')==3){
           echo "<p><font color=blue size=+5>Primero tienes que validar tu plantilla<br />Empleado; validar plantilla
           <br />Tienes hasta el 10 de febrero del 2016 a las 12 del dia<br />
           Horario local</font></p>";
           die();
         */
        $data['suc']=$this->Catalogos_model->busca_sucursal_zona($id_plaza);
          // }else{
          // $data['suc']=0;    
          //}
        $data['mot']=$this->Catalogos_model->busca_motivo($this->input->post('mov'));
        $data['titulo'] = "Captura de Movimientos";
        $data['tit'] = $movx;
        $data['titulo_tabla'] = "MOVIMIENTOS SIN VALIDAR";
        $data['q']=$this->recursos_humanos_model->mov_captura($this->input->post('mov'));
        $this->load->view('main', $data);
    }
    function s_cap_mov_id_par($mov)
    {
        $id_plaza=$this->session->userdata('id_plaza');    
        $data['mov']=$mov;
        $data['fec']=date('Y-m-d');
        $movx=$this->Catalogos_model->busca_mov_captura_uno($mov);
        $data['nomina']=$this->Catalogos_model->busca_empleado_zona($id_plaza);
        if($mov==3){
        $data['suc']=$this->Catalogos_model->busca_sucursal_zona($id_plaza);
        }else{
        $data['suc']=0;    
        }
        $data['mot']=$this->Catalogos_model->busca_motivo($mov);
        $data['titulo'] = "Captura de Movimientos";
        $data['tit'] = $movx;
        $data['titulo_tabla'] = "MOVIMIENTOS SIN VALIDAR";
        $data['q']=$this->recursos_humanos_model->mov_captura($mov);
        $this->load->view('main', $data);
    }
    function sumit_agrega_movimientos()
    {
        if($this->input->post('suc')==null){$suc=0;}else{$suc=$this->input->post('suc');}
        $this->recursos_humanos_model->agrega_movimiento(
        $this->input->post('mov'),
        $this->input->post('nomina'),
        $suc,
        $this->input->post('fec'),
        $this->input->post('mot'));    
        redirect('recursos_humanos/s_cap_mov_id_par/'.$this->input->post('mov'));
    }
     function borrar_mov($id,$mov)
    {
        $this->db->delete('desarrollo.mov_supervisor', array('id' => $id,'tipo'=>1));   
        redirect('recursos_humanos/s_cap_mov_id_par/'.$mov);
    }
    function valida_movimiento($id,$mov)
    {
        $aplica=$this->Catalogos_model->busca_fecha_aplica($mov);
        if($mov==1){
        $clave=613;
        $this->recursos_humanos_model->valida_movimiento_faltante($id,$clave);
        }else{
        $a=array('tipo'=>2,'aplica'=>$aplica);
        $this->db->where('id',$id);
        $this->db->update('desarrollo.mov_supervisor',$a);   
        }
        redirect('recursos_humanos/s_cap_mov_id_par/'.$mov);
    }  
    function s_cap_mov_his()
    {
        $data['titulo'] = "Captura de Movimientos";
        
        $data['q']=$this->recursos_humanos_model->mov_captura_his();
        $this->load->view('main', $data);
    }
 ///////////////////////////////////////////////////////////////////////////////////////////lic Marysol   
     function s_horas_depto()
    {
        $data['titulo'] = "Insidencias Constantes";
        
        $data['q']=$this->recursos_humanos_model->horas_depto();
        $this->load->view('main', $data);
    }
    function s_horas_trabajadas($suc)
    {
        $data['titulo'] = "Insidencias Constantes";
        
        $data['q']=$this->recursos_humanos_model->horas_trabajadas($suc);
        $data['js'] = 'recursos_humanos/s_horas_trabajadas_js';
        $this->load->view('main', $data);
    }
    
 
 
}
