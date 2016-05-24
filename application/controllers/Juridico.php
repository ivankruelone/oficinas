<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Juridico extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('juridico_model');
        $this->load->model('Catalogos_model');

    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    
    
  function rentas()
    {
        $data['sucx'] = $this->Catalogos_model->Busca_sucursal_todas();
        $data['grupo'] = $this->Catalogos_model->Busca_grupo_beneficiario();
        $data['auxi'] = 7003;
        $data['pago']  = 'MN';
        $data['redon']  = '0.00';
        $data['local']  = 2;
        $data['titulo'] = "Rentas Actuales de sucursales activas";
        $data['titulo1'] = "Rentas Actuales de sucursales activas con mas de un arrendador";
        $data['q'] = $this->juridico_model->rentas();
        //$data['q1'] = $this->juridico_model->rentas_mas2(" in('DA','FE','FA')");
        $data['js'] = 'juridico/rentas_js';
        $this->load->view('main', $data);
    }  
    public function agrega_rentas()
    {
        $grupo= $this->input->post('grupo');
        $suc= $this->input->post('suc');
        $rfc= $this->input->post('rfc');
        $nom= $this->input->post('nom');
        $imp= $this->input->post('imp');
        $auxi=$this->input->post('auxi');
        $icedular= $this->input->post('icedular');
        $pago= $this->input->post('pago');
        $redon= $this->input->post('redon');
        $contrato= $this->input->post('contrato');
        $incremento= $this->input->post('incremento');
        $termino= $this->input->post('termino');
        $local= $this->input->post('local');
        $agua= $this->input->post('agua');
	    $query =$this->Catalogos_model->busca_suc_una_todos_datos($suc);
        if($query->num_rows() >0){
		$row=$query->row();
        $tsuc=$row->tipo3;
        $iva=$row->iva;
        }
        if($iva==0){$iva=.16;}
        if($auxi==7003 and $iva==.16){$isr=10;$ivar=10.666666;}
        if($auxi==7003 and $iva==.11){$isr=10;$ivar=7.3333332;}
        if($auxi==7004){$isr=0;$ivar=0;}
        //echo $agua;
        //die();
        $this->juridico_model->agrega_member_renta($suc,$rfc,$nom,$imp,$isr,$ivar,$icedular,$pago,$tsuc,$iva,$auxi,$redon,
        $contrato,$incremento,$termino,$local,$grupo,$agua);
 
    redirect('juridico/rentas');
    }
    
    function borrar_arrendador($id)
    {
        $a=array('activo'=>0);
        $this->db->where('id',$id);
        $this->db->update('catalogo.cat_beneficiario',$a);
        redirect('juridico/rentas');
    }
    
    
    function rentas_farmacia()
    {
        
        $data['titulo'] = "Locales rentados";
        $data['titulo2'] = "Locales Propios";
        $data['q'] = $this->juridico_model->rentas_farmacia('2');
        $data['q2'] = $this->juridico_model->rentas_farmacia('1');
        $data['js'] = 'juridico/rentas_js';
        $this->load->view('main', $data);
    }
    function rentas_farmacia_det($grupo,$local)
    {
        
        $data['titulo'] = "Detalle de locales";
        $data['q'] = $this->juridico_model->rentas_farmacia_det($grupo,$local);
        $data['js'] = 'juridico/rentas_cambios_js';
        $this->load->view('main', $data);
    }
    function rentas_cambios($id)
    {
        $q=$this->juridico_model->un_arrendador($id);
        $r=$q->row();
        $data['id'] = $id;
        $data['sucx'] = $this->Catalogos_model->Busca_sucursal_todas_una($r->suc);
        $data['suc'] = $r->suc;
        $data['rfc'] = $r->rfc;
        $data['nom'] = $r->nom;
        $data['imp'] = $r->imp;
        $data['auxi'] = $this->Catalogos_model->Busca_auxiliar_uno($r->auxi);
        $data['icedular'] = $r->imp_cedular;
        $data['pago'] = $r->pago;
        $data['redon'] = $r->redondeo;
        $data['contrato'] = $r->contrato;
        $data['incremento'] = $r->incremento;
        $data['termino'] = $r->fecha_termino;
        $data['local'] = $r->tipo_local;
        $data['obser'] = $r->observacion;
        $data['grupo'] = $this->Catalogos_model->Busca_grupo_beneficiario_uno($r->grupo);
        $data['titulo'] = "Rentas Actuales de sucursales activas";
        $data['titulo1'] = "Rentas Actuales de sucursales activas con mas de un arrendador";
        $data['q'] = $this->juridico_model->rentas();
        $data['q1'] = $this->juridico_model->rentas_mas2(" in('DA','FE','FA')");
        $data['js'] = 'juridico/rentas_cambios_js';
        $this->load->view('main', $data);
    }
    public function sumit_cambios_rentas()
    {
        $id = $this->input->post('id');
        $suc= $this->input->post('suc');
        $rfc= $this->input->post('rfc');
        $nom= $this->input->post('nom');
        $imp= $this->input->post('imp');
        $auxi=$this->input->post('auxi');
        $icedular= $this->input->post('icedular');
        $pago= $this->input->post('pago');
        $redon= $this->input->post('redon');
        $contrato= $this->input->post('contrato');
        $incremento= $this->input->post('incremento');
        $termino= $this->input->post('termino');
        $local= $this->input->post('local');
        $obser= $this->input->post('obser');
        $grupo= $this->input->post('grupo');
        
	    $query =$this->Catalogos_model->busca_suc_una_todos_datos($suc);
        if($query->num_rows() >0){
		$row=$query->row();
        $tsuc=$row->tipo3;
        $iva=$row->iva;
        }
        if($iva==0){$iva=.16;}
        if($auxi==7003 and $iva==.16){$isr=10;$ivar=10.666666;}
        if($auxi==7003 and $iva==.11){$isr=10;$ivar=7.3333332;} 
        if($auxi==7004){$isr=0;$ivar=0;}
        $this->juridico_model->cambio_member_renta($id,$suc,$rfc,$nom,$imp,$isr,$ivar,$icedular,$pago,$tsuc,$iva,$auxi,$redon,
        $contrato,$incremento,$termino,$local,$obser,$grupo);
 
    redirect('juridico/rentas_farmacia_det/'.$grupo.'/'.$local);
    }
   function rentas_cerradas()
    {
        $data['titulo'] = "Rentas Activas de sucursales Cerradas o locales que no pertenecen a farmacia";
        $data['titulo1'] = "Rentas Activas de sucursales Cerradas con mas de un arrendador";
        $data['q'] = $this->juridico_model->rentas_suc_cerradas();
        $this->load->view('main', $data);
    } 
    function rentas_mes_genera()
    {
        $data['mesx'] = $this->Catalogos_model->busca_mes();
        $data['titulo'] = "RENTA DE LOCALES ACTIVOS";
        $data['q'] = $this->juridico_model->rentas_mes_previo();
        $data['js'] = 'juridico/rentas_mes_genera_js';
        $this->load->view('main', $data);
    }
    function agrega_rentas_mes()
    {
        $aaa=$this->input->post('aaa');
        $mes=$this->input->post('mes');
        $tcambio=$this->input->post('tcambio');
        $this->juridico_model->agrega_renta_mes_det($aaa,$mes,$tcambio);
        redirect('juridico/rentas_mes_genera');
    }
    function rentas_mes_del($id_renta)
    {
        $this->db->delete('juridico.rentas_c', array('id_renta' => $id_renta));
        $this->db->delete('juridico.rentas_d', array('id_renta' => $id_renta));
        redirect('juridico/rentas_mes_genera');

    }
    function rentas_mes_val($id_renta)
    {
        $a=array('validar' => 1);
        $this->db->where('id_renta',$id_renta);
        $this->db->update('juridico.rentas_c',$a); 
        redirect('juridico/rentas_mes_genera');

    }
    function rentas_mes_genera_det($aaa,$mes,$id_renta)
    {
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "RENTA DE LOCALES ACTIVOS DEL ".$mesx." DEL ".$aaa;
        $data['q'] = $this->juridico_model->rentas_mes_previo_det($aaa,$mes,$id_renta);
        $data['q1'] = $this->juridico_model->rentas_mes_previo_det_arrendador($aaa,$mes,$id_renta);
        //$data['js'] = 'juridico/rentas_js';
        $this->load->view('main', $data);
    }
    
    function rentas_mes_historico_propios()
    {
        $data['mesx'] = $this->Catalogos_model->busca_mes();
        $data['titulo'] = "RENTA DE LOCALES PROPIOS";
        $data['q'] = $this->juridico_model->rentas_mes_historico(1,'NORMAL');
        $data['js'] = 'juridico/rentas_mes_historico_propios_js';
        $this->load->view('main', $data);
    }
    function rentas_mes_historico_rentadas()
    {
        $data['mesx'] = $this->Catalogos_model->busca_mes();
        $data['titulo'] = "RENTA DE LOCALES RENTADOS";
        $data['q'] = $this->juridico_model->rentas_mes_historico(2,'NORMAL');
        $data['js'] = 'juridico/rentas_mes_historico_rentadas_js';
        $this->load->view('main', $data);
    }
    function rentas_mes_historico_det($aaa,$mes,$local)
    {
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "RENTA DE LOCALES ACTIVOS DEL ".$mesx." DEL ".$aaa;
        $data['aaa'] = $aaa;
        $data['mes'] = $mes;
        $data['local'] =$local;
        $data['q'] = $this->juridico_model->rentas_mes_historico_det($aaa,$mes,$local);
        $data['js'] = 'juridico/rentas_mes_historico_det_js';
        $this->load->view('main', $data);
    }
    function rentas_mes_historico_det_incre($id_cat,$aaa,$mes,$local)
    {
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['id_cat']=$id_cat;
        $data['aaa']=$aaa;
        $data['mes']=$mes;
        $data['local']=$local;
        $data['titulo'] = "RENTA DE LOCALES ACTIVOS DEL ".$mesx." DEL ".$aaa;
        $data['q'] = $this->juridico_model->rentas_mes_historico_det_incr($id_cat);
        $data['q1'] = $this->juridico_model->rentas_mes_historico_det_aplicado($aaa,$mes,$id_cat);
        $data['js'] = 'juridico/rentas_mes_historico_det_js';
        $this->load->view('main', $data);
    }
    function rentas_mes_historico_det_incre_add()
    {
        $id_cat=$this->input->post('id_cat');
        $aaa=$this->input->post('aaa');
        $mes=$this->input->post('mes');
        $local=$this->input->post('local');
        $monto=$this->input->post('monto');
        $this->juridico_model->add_incremento($id_cat,$aaa,$mes,$local,$monto);
        redirect('juridico/rentas_mes_historico_det/'.$aaa.'/'.$mes.'/'.$local);
        
    }
    function rentas_mes_historico_impresion($aaa,$mes)
    {
        $mesx = $this->Catalogos_model->busca_mes_uno($mes);
        $data['cabeza'] = "CONCENTRADO DE RENTAS DEL MES DE $mesx DEL $aaa";
        $data['q'] = $this->juridico_model->rentas_mes_historico_imp($aaa,$mes);
        
       $this->load->view('impresion/juridico_impresion_mensual',$data);
       }
   ///////////////////////////////////////////////////////////////////////////////////////////////////////
   ///////////////////////////////////////////////////////////////////////////////////////////////////////
   function rentas_deuda($local)
    {
        $data['titulo'] = "Adeudo de rentas de sucursales abiertas";
        $data['local'] = $local;
        $data['a']=$this->juridico_model->calcula_prepago('0');
        $data['q'] = $this->juridico_model->rentas_deuda_ctl($local);
        $data['js'] = 'juridico/rentas_deuda_js';
        $this->load->view('main', $data);
    }
   function rentas_deuda_rfc($suc,$rfc,$local)
    {
        $data['titulo'] = "Adeudo de rentas de sucursales abiertas";
        $data['a']=$this->juridico_model->calcula_prepago('0');
        $data['q'] = $this->juridico_model->rentas_deuda_det($suc,$rfc,$local);
        $data['js'] = 'juridico/rentas_deuda_rfc_js';
        $this->load->view('main', $data);
    }
    
    function actualiza_prepago()
	{
        $id = $this->input->post('id');
        $aplica = $this->input->post('aplica');
        echo $this->juridico_model->actualiza_prepago_m($id,$aplica);
        
    }
    function rentas_deuda_gerpago($suc,$rfc,$local)
	{
        
        $a=array('pagado'=>1);
        $this->db->where('suc',$suc);
        $this->db->where('rfc',$rfc);
        $this->db->update('juridico.rentas_d',$a);
        redirect('juridico/rentas_deuda/'.$local);
    }
    
    function rentas_deuda_preimpresion($local)
    {
        $data['titulo'] = "Adeudo de rentas de sucursales abiertas";
        $data['q'] = $this->juridico_model->rentas_deuda_preimp($local);
        $this->load->view('juridico/rentas_deuda_preimpresion', $data);
    }
    function rentas_golbal()
    {
        $data['titulo'] = "Concentrado de tentas totales";
        $data['q'] = $this->juridico_model->rentas_global();
        $this->load->view('main', $data);
    }
   ///////////////////////////////////////////////////////////////////////////////////////////////////////
   /////////////////////////////////////////////////////////////////////////////////////////////////////// 
   ///////////////////////////////////////////////////////////////////////////////////////////////////////DIRECTOR DE JURIDICO
   function rentas_deuda_d($local)
    {
        if($local==1){$localx=' de locales propios';}else{$localx=' de locales rentados';}
        $data['titulo'] = "Adeudo de rentas de sucursales abiertas $localx";
        $data['local'] = $local;
        $data['a']=$this->juridico_model->calcula_prepago('0');
        $data['q'] = $this->juridico_model->rentas_deuda_ctl($local);
        $data['js'] = 'juridico/rentas_deuda_d_js';
        $this->load->view('main', $data);   
    }
    function rentas_deuda_d_rfc($suc,$rfc,$local,$criterio)
    {
        $sucx=$this->Catalogos_model->busca_suc_una($suc);
        $data['suc']=$suc;
        $data['rfc']=$rfc;
        $data['local']=$local;
        $data['crit']=$criterio;
        $data['criterio'] =$this->Catalogos_model->cat_beneficiario_nivel($criterio);
        $data['titulo'] = "ADEUDO DE RENTAS DE LA SUCURSAL".$sucx;
        $data['q0'] = $this->juridico_model->rentas_deuda_d_observacion($suc);
        $data['q'] = $this->juridico_model->rentas_deuda_det($suc,$rfc,$local);
        $data['js'] = 'juridico/rentas_deuda_d_rfc_js';
        $this->load->view('main', $data);
    }
    function rentas_observa_del($suc,$rfc,$local,$criterio,$id)
    {
        $a=array('activo'=>0);
        $this->db->where('id',$id);
        $this->db->update('juridico.rentas_observacion',$a);
        redirect('juridico/rentas_deuda_d_rfc/'.$suc.'/'.$rfc.'/'.$local.'/'.$criterio);
        
    }
     function rentas_deuda_observa()
    {
        
        $suc = $this->input->post('suc');
        $local = $this->input->post('local');
        $rfc = $this->input->post('rfc');
        $criterio = $this->input->post('criterio');
        $a=array(
        'suc' =>$this->input->post('suc'),
        'fecha_cap' =>date('Y-m-d H:i:s'),
        'id_user' =>$this->session->userdata('id'),
        'comentario' =>$this->input->post('observa'),
        'fecha_deshalojo' =>$this->input->post('fecha')
        );
        $this->db->insert('juridico.rentas_observacion',$a);
        $s="update catalogo.cat_beneficiario set criterio=$criterio where suc=$suc and activo=1";
        $this->db->query($s);
        redirect('Juridico/rentas_deuda_d_rfc/'.$suc.'/'.$rfc.'/'.$local.'/'.$criterio);
    }
   ///////////////////////////////////////////////////////////////////////////////////////////////////////
   ///////////////////////////////////////////////////////////////////////////////////////////////////////
   /////////////////////////////////////////////////////////////////////////////////////////////////////// 
        
    
}
