<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tarjetas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('tarjetas_model');
        $this->load->model('catalogos_model');
        
    }
    
    function agrega_tarjetas()
    {
        $data['titulo'] = "Tarjetas Clientes Preferentes";
        $data['suc']=$this->catalogos_model->busca_suc_activas();
        $data['q']=$this->tarjetas_model->control_tarjetas();
        $this->load->view('main', $data);
    }
    function tarjetas_sumit()
    {
        $a=array(//suc, fol1, fol2, tipo, id, activo
        'suc' => $this->input->post('suc'),
        'fol1'=> $this->input->post('fol1'),
        'fol2'=> $this->input->post('fol2'),
        'tipo'=>0);
        $this->db->insert('vtadc.tarjetas_suc',$a);
        redirect('tarjetas/agrega_tarjetas'); 
    }
    function tarjetas_borrar($id)
    {
        $a=array('activo'=>0);
        $this->db->where('id',$id);
        $this->db->update('vtadc.tarjetas_suc',$a);
        redirect('tarjetas/agrega_tarjetas'); 
    }   
    function tarjetas_validar($id,$suc)
    {
        $a=array('tipo'=>1);
        $this->db->where('id',$id);
        $this->db->update('vtadc.tarjetas_suc',$a);
        $this->tarjetas_model->archivo_para_suc($suc);
        redirect('tarjetas/agrega_tarjetas'); 
    }
    function tarjetas_historicas()
    {
        $data['titulo'] = "REPORTE DE COMPRA A MAYORISTAS";
        $data['suc']=$this->catalogos_model->busca_suc_activas();
        $this->load->view('main', $data);
    }
    function tarjetas_historicas_filtro()
    {
        $sucx=$this->catalogos_model->busca_suc_una($this->input->post('suc'));
        $data['titulo'] = "REPORTE DE COMPRA A MAYORISTAS DE LA SUCURSAL ".$sucx;
        $data['q']=$this->tarjetas_model->control_tarjetas_historicas($this->input->post('suc'));
        $this->load->view('main', $data);
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function consultas_tarjetas_pref()
    {
       
        $data['titulo'] = "";
        $data['tit']='Selecciona fecha inicial, fecha final';
        //$data['suc']=$this->Catalogos_model->busca_suc_activas();
        $data['js'] = 'tarjetas/consultas_tarjetas_pref_js';
        $this->load->view('main', $data);
        
    }

   function tarjetas_cliente_preferente()
    {
        
        $inicio= $this->input->post('perini');
        $fin= $this->input->post('perfin');
        $data['perini']= $inicio;
        $data['perfin']= $fin;
        //echo $inicio;
        //echo $fin;
        //die();
        $data['tit']='Reporte Tarjetas Cliente Preferente'.$inicio.' al '.$fin;
        $data['query'] = $this->tarjetas_model->control_tar($inicio,$fin);
        $data['js'] = 'tarjetas/consultas_tarjetas_pref_submit_js';
        $this->load->view('main', $data);
    }
    
    function detalle_tar_pref($suc,$fol1,$fol2,$perini,$perfin)
    {
        $inicio= $perini;
        $fin= $perfin;
        $data['perini']= $inicio;
        $data['perfin']= $fin;
        $data['titulo'] = 'Detalle Tarjetas Cliente Preferente';
        $data['query'] = $this->tarjetas_model->detalle_tar_med($suc,$fol1,$fol2,$inicio,$fin);
        $this->load->view('main', $data);
    }


 
}
