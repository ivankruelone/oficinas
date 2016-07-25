<?php
class Proveedor_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function evaluacion_proveedor($fec1,$fec2)
    {
        $responsable=$this->session->userdata('responsable');
        $responsable=38603;    
        $s = "select b.razo,a.*,
            sum(cans+canr)as can,sum(aplica)as llego,
            ((sum(aplica)/sum(cans+canr))*100)as abasto_can,

            count(*)as prod, sum(case when aplica>0 then +1 else +0 end)as prod_sur,
            ((sum(case when aplica>0 then +1 else +0 end)/count(*))*100) as abasto_prod

            from compras.orden_c a
            join catalogo.provedor b on b.prov=a.prv
            join compras.orden_d c on c.id_orden=a.id_orden
            where (canp+canr)>0 and a.tipo=1 and id_responsable=$responsable  and a.fecha_envio between '$fec1' and '$fec2'
            group by a.prv
            order by a.prv desc";
        $q = $this->db->query($s);
        return $q;
    }
    function evaluacion_proveedor_det($prv,$fec1,$fec2)
    {
        $responsable=$this->session->userdata('responsable');
        $responsable=38603;    
        $s = "select fecha_limite,folprv,sec,codigo,susa1,
            sum(cans+canr)as can,sum(aplica)as llego,
            ((sum(aplica)/sum(cans+canr))*100)as abasto_can,

            count(*)as prod, sum(case when aplica>0 then +1 else +0 end)as prod_sur,
            ((sum(case when aplica>0 then +1 else +0 end)/count(*))*100) as abasto_prod

            from compras.orden_c a
            join compras.orden_d c on c.id_orden=a.id_orden
            where (canp+canr)>0 and a.tipo=1 and id_responsable=$responsable and prv=$prv and a.fecha_envio between '$fec1' and '$fec2'
            group by a.prv,a.folprv,codigo
            order by a.prv desc";
        $q = $this->db->query($s);
        return $q;
    }

    function graba_evaluacion($fec1,$fec2,$prv,$uno,$dos,$tres,$cuatro,$cinco,$seis,$siete,$siete_p,$ocho,$ocho_p,$nueve_p)
    {
      $id_user=$this->session->userdata('id');
      $a=array(
      'fec1' => $fec1,
      'fec2' => $fec2,
      'prv' => $prv,
      'id_user' => $id_user
      );
      $this->db->insert('compras.evalua_prv_c',$a);  
      $id_cc = $this->db->insert_id(); 
      $b=array(
      'fec1' => $fec1,
      'fec2' => $fec2,
      'prv' => $prv,
      'id_user' => $id_user
      );
      $this->db->insert('compras.evalua_prv_d');  
       
    }


}