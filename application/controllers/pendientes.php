<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pendientes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('pendientes_model');
        $this->load->model('Catalogos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
   
    function activo_r()
    {
       
        $data['titulo'] = "Concentrado de Pendientes";
        $data['tit']='Pendientes';
        $data['a'] = $this->pendientes_model->activo_r();
        //$data['js'] = 'pendientes/listado_js';
        $this->load->view('main', $data);
    }
    
    function listado($id_res)
    {
        $data['nivel'] = $nivel=$this->session->userdata('nivel');
        $data['titulo'] = "Concentrado de Pendientes";
        $data['res'] = $this->Catalogos_model->busca_responsable_uno($id_res);
        $data['tit']='Pendientes';
        $data['a'] = $this->pendientes_model->concentrado($id_res);
        $data['js'] = 'pendientes/listado_js';
        $this->load->view('main', $data);
        
    }
      function subir_pendientes()
    {
        $res=$this->input->post('res');
        $pendiente=$this->input->post('pen');
        $fecha=$this->input->post('fec1');
        $data['titulo'] = "Resultado";
        $this->pendientes_model->sube_pen($res,$pendiente,$fecha);
        redirect('Pendientes/listado/'.$res);
    }
    function cambia_pendiente($id)
    {
        $q= $this->pendientes_model->busca_pendiente($id);
        $r=$q->row();
        $id_resp=$r->id_resp;
        $data['fecha_comp']=$r->fecha_comp;
        $data['pendientes']=$r->pendientes;
        $data['id_cc']=$id;
        $data['titulo'] = "Concentrado de Pendientes";
        $data['res'] = $this->Catalogos_model->busca_responsable_uno($id_resp);
        
        $data['tit']='Pendientes';
        $data['js'] = 'pendientes/listado_js';
        $this->load->view('main', $data);
    }
    function actualiza_p()
    {
        $res=$this->input->post('res');
        $s="SELECT id, nomina, completo, succ, subarea, tipo
                FROM catalogo.cat_empleado
                where id=$res";
        $q=$this->db->query($s);$r=$q->row();
        $data = array(
        'fecha_comp' => $this->input->post('fec1'), 
        'id_resp'=>$this->input->post('res'),
        'area'=>$r->subarea,
        'pendientes'=>$this->input->post('pen'),
        'responsable'=>$r->completo
        );
        $this->db->where('id', $this->input->post('id_cc'));
        $this->db->update('compras.pendientes', $data);
        redirect('Pendientes/listado/'.$this->input->post('res'));
    }
    function validar_pendiente($id)
    {
        $q= $this->pendientes_model->busca_pendiente($id);
        $r=$q->row();
        $id_resp=$r->id_resp;
        
        $data['titulo'] = "Resultado";
        $this->pendientes_model->valida_pen($id);
        $data['js'] = 'pendientes/validar_pendiente_js';
        redirect('Pendientes/listado/'.$id_resp);
    }
 ///////////////////////////////////////////////////////////////////////lo validado   
 function activo_r_val()
    {
       
        $data['titulo'] = "Concentrado de Pendientes Validados";
        $data['tit']='Pendientes';
        $data['a'] = $this->pendientes_model->activo_r_val();
        //$data['js'] = 'pendientes/listado_js';
        $this->load->view('main', $data);
    }
    function listado_validados($id_res)
    {
       
        $data['titulo'] = "Concentrado de Pendientes Validados";
        $data['tit']='Pendientes Validados';
        $data['a'] = $this->pendientes_model->concentrado_val($id_res);
        $data['js'] = 'pendientes/listado_validados_js';
        $this->load->view('main', $data);
    }
    
    function listado_personal()
    {
        $nomina=$this->session->userdata('nomina');
        $data['titulo'] = "Concentrado de Pendientes";
        $data['tit']='Pendientes';
        $data['a'] = $this->pendientes_model->concentrado_personal($nomina);
        $data['js'] = 'pendientes/listado_personal_js';
        $this->load->view('main', $data);
    }
     function modificar_observacion($id)
    {
        
        $q= $this->pendientes_model->busca_pendiente($id);
        $r=$q->row();
        $id_resp=$r->id_resp;
        $data['fecha_comp']=$r->fecha_comp;
        $data['pendientes']=$r->pendientes;
        $data['id_cc']=$id;
        $data['libera']= 0;
        $data['titulo'] = "Concentrado de Pendientes";
        $data['a']=$this->pendientes_model->pendiente_d($id);
        $data['tit']='Pendientes';
        $data['js'] = 'pendientes/listado_js';
        $this->load->view('main', $data);
    }



    
    function guardar_obser()
    {
        $obser=$this->input->post('observa');
        $id_cc=$this->input->post('id_cc');
        $libera=$this->input->post('libera');
        $data['titulo'] = "Resultado";
        $this->pendientes_model->mod($id_cc,$obser,$libera);
        redirect('pendientes/listado_personal');
    }
    
    function listado_validados_per()
    {
        $id_res=$this->session->userdata('id_firma');
        $data['titulo'] = "Concentrado de Pendientes Validados";
        $data['tit']='Pendientes Validados';
        $data['a'] = $this->pendientes_model->concentrado_val($id_res);
        $data['js'] = 'pendientes/listado_validados_per_js';
        $this->load->view('main', $data);
    }
   
}
