<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comision extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('comision_model');
        $this->load->model('catalogos_model');
        
    }

    function index()
    {
        $data['titulo'] = "Indice";
        $this->load->view('main', $data);
    }
    function s_calculo_comisiones($aaa,$mes,$dias)
    {
        $var=$aaa.'-'.str_pad($mes,2,"0",STR_PAD_LEFT).'-01';
        $s="select 
        year(subdate(date('$var'),interval 1 month)) as aaa_a, 
        month(subdate(date('$var'),interval 1 month))as mes_a,
        year(subdate(date('$var'),interval 2 month)) as aaa_a2, 
        month(subdate(date('$var'),interval 2 month))as mes_a2,
        subdate('$var',interval 1 month)as fec_alta
        ";
        $q=$this->db->query($s);
        $r=$q->row();
        $this->comision_model->calculo_comisiones_20150901('DA',$aaa,$mes,$r->aaa_a,$r->mes_a,$r->aaa_a2,$r->mes_a2,$r->fec_alta,$dias);
        
    }
    function eval_cedis_cla($var)
    {
        $data['titulo'] = "NIVEL DE SURTIDO POR CLASIFICACION ".$var ;
        $data['var'] = $var;
        $data['q'] = $this->Evaluacion_model->eval_cedis_cla($var);
        $data['js'] = 'catalogos/descontin_js';
        $this->load->view('main', $data);
    }
   function inserta_comision_desem($aaa,$mes,$dias)
    {   
    if($mes==12){$mespago=1;$aaapago=$aaa+1;}else{$aaapago=$aaa;$mespago=$mes+1;}
    if($mespago==1 ||$mespago==3||$mespago==5||$mespago==7||$mespago==8||$mespago==10||$mespago==12){$diapago=31;}
elseif($mespago==4 ||$mespago==6||$mespago==9||$mespago==11){$diapago=30;}else{$diapago=28;}
    $fecpre=$aaapago.'-'.str_pad($mespago,2,"0",STR_PAD_LEFT).'-'.str_pad($diapago,2,"0",STR_PAD_LEFT);
    $fec=$aaa.'-'.str_pad($mes,2,"0",STR_PAD_LEFT).'-'.str_pad($dias,2,"0",STR_PAD_LEFT);
    $s1="insert ignore into desarrollo.faltante
(fecha, corte, nomina, turno, fal, id_cor, id_user, suc, plaza, cia, cianom, plazanom,  tipo, clave, observacion,
succ, fecpre, fechai, folioi, tipo2, fechacaptura, id_plaza, documento, varios)
(SELECT '$fec',0,b.nomina,0,sum(importe),0,939,a.suc,0,0,b.cia,0,2,b.clave,'COMISION POR DESEMPEÑO',a.suc,
'$fecpre','0000-00-00','','',now(),0,0,1
 FROM prenomina.comision_c a
join prenomina.comision_d b on b.id_comision=a.id_comision
 where a.activo=0 and b.activo=0 and a.aaa=$aaa and mes=$mes and comision='DESEMPENO'  
 group by b.cia,b.nomina)";
 $this->db->query($s1);
 $s2="update prenomina.comision_c a,prenomina.comision_d b
 set a.fecpre='$fecpre', a.activo=1, b.activo=1
 where b.id_comision=a.id_comision and a.activo=0 and b.activo=0 and a.aaa=$aaa and mes=$mes and comision='DESEMPENO'
 ";
 $this->db->query($s2);
 echo "listo";
}

function comision_insentivo()
{
$aaa=2016;
$mes=4;
$comision='INCENTIVO';
$comision1='INCENTIVO1'; 
$this->comision_model->ins_insentivo_ctl($aaa,$mes,$comision,$comision1);
    
}
function inserta_comision_insentivo()
    {
        
  $aaa=2016;
  $mes=4;
  $dias=30;
  $comision='INCENTIVO';
  $comision1='INCENTIVO1';
        
    if($mes==12){$mespago=1;$aaapago=$aaa+1;}else{$aaapago=$aaa;$mespago=$mes+1;}
    $diapago=15;
    $fecpre=$aaapago.'-'.str_pad($mespago,2,"0",STR_PAD_LEFT).'-'.str_pad($diapago,2,"0",STR_PAD_LEFT);
    $fec=$aaa.'-'.str_pad($mes,2,"0",STR_PAD_LEFT).'-'.str_pad($dias,2,"0",STR_PAD_LEFT);
    
    $s1="insert ignore into desarrollo.faltante
(fecha, corte, nomina, turno, fal, id_cor, id_user, suc, plaza, cia, cianom, plazanom,  tipo, clave, observacion,
succ, fecpre, fechai, folioi, tipo2, fechacaptura, id_plaza, documento, varios)
(SELECT '$fec',0,b.nomina,0,sum(importe),0,939,a.suc,0,0,b.cia,0,2,b.clave,concat('COMISION POR ',a.comision),a.suc,
'$fecpre','0000-00-00','','',now(),0,0,0
 FROM prenomina.comision_c a
join prenomina.comision_d b on b.id_comision=a.id_comision
 where a.activo=0 and b.activo=0 and a.aaa=$aaa and mes=$mes and comision in('$comision','$comision1')  
 group by b.cia,b.nomina,b.clave)";
 $this->db->query($s1);
 $s2="update prenomina.comision_c a,prenomina.comision_d b
 set a.fecpre='$fecpre', a.activo=1, b.activo=1
 where b.id_comision=a.id_comision and a.activo=0 and b.activo=0 and a.aaa=$aaa and mes=$mes and comision in('$comision','$comision1')
 ";
 $this->db->query($s2);
 echo "listo";
}
      //////////////////////////////////////////////////////////////////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////////////////////
   

}
