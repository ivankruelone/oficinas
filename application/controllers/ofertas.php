<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ofertas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('catalogos_model');
        $this->load->model('ofertas_model');

    }
     function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
    function busqueda1()
    {
       
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
    
    
    function s_cap_ofe_lab()
    {
        //$data['codigo'] =$this->catalogos_model->busca_codigo_solo_activos_back();
        $data['titulo'] = "Ofertas aplicadas por laboratorios";
        $data['q'] = $this->ofertas_model->cap_ofe_lab();
        $data['js'] = 'ofertas/s_cap_ofe_lab_js';
        $this->load->view('main', $data);    
    }
    function sumit_aferta()
    {
    $this->ofertas_model->graba_producto_ofe(
    $this->input->post('codigo'),
    $this->input->post('fec1'),
    $this->input->post('fec2'),
    $this->input->post('ofe_lab'),
    $this->input->post('ofe_far'));
    redirect('ofertas/s_cap_ofe_lab');
    }
    function s_mod_aferta($id)
    {
        //$data['codigo'] =$this->catalogos_model->busca_codigo_solo_activos_back();
        $data['titulo'] = "Ofertas aplicadas por laboratorios";
        $q = $this->ofertas_model->busca_id_ofe($id);
        $r=$q->row();
        $data['codigo']=$r->codigo;
        $data['fecha1']=$r->fecha1;
        $data['fecha2']=$r->fecha2;
        $data['ofe_lab']=$r->ofe_lab;
        $data['ofe_far']=$r->ofe_far;
        $data['id']=$id;
        
        $data['js'] = 'ofertas/s_cap_ofe_lab_js';
        $this->load->view('main', $data);    
    }
    function sumit_aferta_act()
    {
    $a=array(
    'fecha2'=>$this->input->post('fecha2'),
    'ofe_lab'=>$this->input->post('ofe_lab'),
    'ofe_far'=>$this->input->post('ofe_far')
    );
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('compras.ofertas_lab_far',$a);
    redirect('ofertas/s_cap_ofe_lab');
    }
    function borra_aferta($id)
    {
    $this->ofertas_model->borra_producto_ofe($id);
    redirect('ofertas/s_cap_ofe_lab');
    }
    function val_aferta($id)
    {
    $this->ofertas_model->val_producto_ofe($id);
    redirect('ofertas/s_cap_ofe_lab');
    }
    function s_ofe_val()
    {
        $data['titulo'] = "Ofertas Aplicadas para farmacia";
        $data['q'] = $this->ofertas_model->ofe_val();
        $data['js'] = 'ofertas/s_ofe_val_js';
        $this->load->view('main', $data);    
    }
    function s_ofertas_periodo()
    {
        $data['titulo'] = "Ofertas aplicadas por laboratorios";
        $data['q'] = $this->ofertas_model->ofertas_periodo();
        $data['js'] = 'ofertas/s_ofertas_periodo_js';
        $this->load->view('main', $data);
    }
    function s_ofertas_periodo_det($inicio,$final,$lab,$prv)
    {
        $data['titulo'] = "Ofertas aplicadas por laboratorios del $inicio al $final de $lab";
        $data['q'] = $this->ofertas_model->ofertas_periodo_det($inicio,$final,$lab,$prv);
        $data['js'] = 'ofertas/s_ofertas_periodo_det_js';
        $this->load->view('main', $data);
    }
    function s_ofertas_periodo_det_ven($inicio,$final,$lab)
    {
        $data['titulo'] = "Ofertas aplicadas por laboratorios del $inicio al $final de $lab";
        $data['q'] = $this->ofertas_model->ofertas_periodo_det_ven($inicio,$final);
        $data['js'] = 'ofertas/s_ofertas_periodo_det_ven_js';
        $this->load->view('main', $data);
    }
    function s_ofertas_corta_caducidad()
    {
        $data['titulo'] = "Ofertas Corta caducidad";
        $data['q'] = $this->ofertas_model->ofertas_corta_caducidad();
        $data['js'] = 'ofertas/s_ofertas_periodo_js';
        $this->load->view('main', $data);   
    }
    function s_ofertas_corta_caducidad_det($id_cc)
    {
        $data['titulo'] = "Ofertas Corta caducidad";
        $data['id_cc'] = $id_cc;
        $data['tipo'] = '';
        $data['q'] = $this->ofertas_model->ofertas_corta_caducidad_det($id_cc);
        $data['q1'] = $this->ofertas_model->ofertas_corta_caducidad_det_cer($id_cc);
        $data['js'] = 'ofertas/s_ofertas_corta_caducidad_det_js';
        $this->load->view('main', $data);   
    }     
    function s_ofertas_corta_caducidad_det_cos($id_cc,$id)
    {
        $data['titulo'] = "Ofertas Corta caducidad";
        $data['id'] = $id;
        $data['id_cc'] = $id_cc;
        $q = $this->ofertas_model->ofertas_corta_caducidad_det_cos($id);
        $r=$q->row();
        $data['costo_catalogo'] = $r->costo_catalogo;
        $data['costo_pdv'] = $r->costo_pdv;
        $data['pub_pdv'] = $r->pub_pdv;
        $data['descripcion'] = $r->descripcion;
        $data['codigo'] = $r->codigo;
        $data['js'] = 'ofertas/s_ofertas_periodo_js';
        $this->load->view('main', $data);   
    }
    function sumit_ofertas_corta_caducidad()
    {
        if($this->input->post('costo_catalogo')>=$this->input->post('costo_pdv')){$costo=$this->input->post('costo_catalogo');}else{$costo=$this->input->post('costo_pdv');}
        $a=array('fecha_compra'=>date('Y-m-d H:i:s'),'costo'=>$costo,'pub'=>$this->input->post('pub_pdv'),'oferta'=>$this->input->post('venta'));
        $this->db->where('id',$this->input->post('id'));
        $this->db->update('compras.corta_caducidad_det',$a);
        redirect('ofertas/s_ofertas_corta_caducidad_det/'.$this->input->post('id_cc'));
    }
    function sumit_ofertas_corta_caducidad_gral()
    {
        $this->ofertas_model->valida_corta_caducidad_det_gral(
        $this->input->post('tipo'),
        $this->input->post('mas'),
        $this->input->post('id_cc'));
        $this->ofertas_model->valida_corta_caducidad_det(
        $this->input->post('id_cc'),$this->input->post('fec1'),$this->input->post('fec2'));
        redirect('ofertas/s_ofertas_corta_caducidad');
    }
    function s_ofertas_corta_caducidad_his()
    {
        $data['titulo'] = "Ofertas Corta caducidad";
        $data['q'] = $this->ofertas_model->ofertas_corta_caducidad_his();
        $data['js'] = 'ofertas/s_ofertas_corta_caducidad_his_js';
        $this->load->view('main', $data);   
    }

    function s_ofertas_corta_caducidad_det_his($id_cc)
    {
        $data['titulo'] = "Ofertas Corta caducidad";
        $data['id_cc'] = $id_cc;
        $data['tipo'] = '';
        $data['q1'] = $this->ofertas_model->ofertas_corta_caducidad_det_cer($id_cc);
        $data['js'] = 'ofertas/s_ofertas_corta_caducidad_det_his_js';
        $this->load->view('main', $data);   
    }
    function s_ofertas_corta_caducidad_bor_ctl($id_cc)
    {
        $a=array('activo'=>0,'fecha_compra'=>date('Y-m-d H:i:s'));
        $this->db->where('id',$id_cc);
        $this->db->where('activo',1);
        $this->db->update('compras.corta_caducidad_ctl',$a);
        $b=array('activo'=>0,'fecha_compra'=>date('Y-m-d H:i:s'));
        $this->db->where('id_cc',$id_cc);
        $this->db->where('fecha_compra','0000-00-00 00:00:00');
        $this->db->update('compras.corta_caducidad_det',$b);
        redirect('ofertas/s_ofertas_corta_caducidad');
    }
    function s_ofertas_corta_caducidad_bor_det($id_cc,$id)
    {
        $b=array('activo'=>0);
        $this->db->where('id',$id);
        $this->db->where('activo',1);
        $this->db->update('compras.corta_caducidad_det',$b);
        redirect('ofertas/s_ofertas_corta_caducidad_det/'.$id_cc);
    }
    function a_ofertas_gen()
    {
        $data['titulo'] = "aplicar ofertas";
        $data['tipo']='NOMINA';
        $data['q'] = $this->ofertas_model->ofertas_activas_gen();
        $data['js'] = 'ofertas/a_ofertas_gen_js';
        $this->load->view('main', $data);    
    }
    function a_ofertas_gen_cad()
    {
        $data['titulo'] = "OFERTAS CADUCADAS";
        $data['q'] = $this->ofertas_model->ofertas_activas_gen_cad();
        $data['js'] = 'ofertas/a_ofertas_gen_js';
        $this->load->view('main', $data);    
    }
    function busca_producto_gen()
    {
     $sec = $this->input->post('sec');
     //$sec=118;
     echo $this->ofertas_model->busca_pro_gen($sec);         
    }
    function sumit_aferta_gen()
    {
    $this->ofertas_model->graba_producto_ofe_gen(
    $this->input->post('sec'),
    $this->input->post('codigo'),
    $this->input->post('fec1'),
    $this->input->post('fec2'),
    $this->input->post('incentivo'),
    $this->input->post('pre_ofe'),
    $this->input->post('tipo'));
    redirect('ofertas/a_ofertas_gen');
    }
    function borrar_oferta_gen($id)
    {
    $this->ofertas_model->borra_producto_ofe_gen($id);
    redirect('ofertas/a_ofertas_gen');
    }
    function a_bloqueo_t()
    {
        $data['titulo'] = "BLOQUEOS POR TRASNSFER";
        $data['fec1']=date('Y-m-d');
        $data['fec2']=date('Y-m-d');
        $data['q'] = $this->ofertas_model->bloqueo_transfer();
        $data['js'] = 'ofertas/a_bloqueo_t_js';
        $this->load->view('main', $data);           
    }
    function a_busco_cod()
    {
        $cod=$this->input->post('cod');
        echo $this->catalogos_model->busco_cod_mercadotecnia($cod);
    }
    function borrar_bloqueo_t($id)
    {
    $this->ofertas_model->bor_bloqueo_t($id);
    redirect('ofertas/a_bloqueo_t');
    }
    function sumit_bloqueo_transfer()
    {
        $codigo=$this->input->post('codigo');
        $fec1=$this->input->post('fec1');
        $fec2=$this->input->post('fec2');
        $this->ofertas_model->graba_bloqueo($codigo,$fec1,$fec2);
        redirect('ofertas/a_bloqueo_t');
    }
    function a_bloqueos_codigos_excel()
    {
        $this->load->dbutil();
        $this->load->helper('download');
        $a = $this->ofertas_model->excel_bloqueo();
        $csv = $this->dbutil->csv_from_result($a);
        $name = 'desplazamiento_codigos_bloqueados_'.date('Ymd_His').'.csv';
        force_download($name, $csv);
    }
}
