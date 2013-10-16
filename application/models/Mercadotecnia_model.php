<?php
class Mercadotecnia_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

       
    public function factura()
    {
        
        $s = "select a.*,b.corto,sum(can*costo)as importe from compras.mer_factura a 
        left join catalogo.provedor b on a.prv=b.prov
        left join compras.mer_factura_det c on a.id=c.id_cc
        where a.tipo='A'
        group by a.id";
        $q = $this->db->query($s);
        return $q;
    }
 public function agrega_factura($prv,$fac)
    {   
        $id_user=$this->session->userdata('id');
        $fec=date('Y-m-d H:i:s');
        $s = "insert ignore into compras.mer_factura(prv, fecha, factura, id_user)
        values($prv,'$fec','$fac',$id_user)";
        $q = $this->db->query($s);
    }
/////////////////////////////////////////////////////
  public function factura_det($id)
    {
        
        $s = "select a.* from compras.mer_factura_det a where a.id_cc=$id";
        $q = $this->db->query($s);
        return $q;
    }
 /////////////////////////////////////////////////////
 public function agrega_factura_det($codigo,$costo,$cantidad,$id)
    {   
        $id_user=$this->session->userdata('id');
        $fec=date('Y-m-d H:i:s');
        $s = "insert ignore into compras.mer_factura_det(id_cc, codigo, descri, can, costo, iva)
        (select $id,$codigo,descripcion,$cantidad,'$costo',iva from catalogo.cat_saba_temp where ean=$codigo )";
        $q = $this->db->query($s);
    }
/////////////////////////////////////////////////////
public function cerrar_factura($id)
    {   
        $id_user=$this->session->userdata('id');
        $fec=date('Y-m-d H:i:s');
        $s = "select *from compras.mer_factura_det where id_cc=$id and inv='N'";
        $q = $this->db->query($s);
        $tot=0;
        
        if($q->num_rows()>0){
        foreach($q->result() as $r){
        $this->__agrega_inventario($r->codigo,$r->can,$r->costo);
        echo $r->id;
        $a = array('inv' => 'S');
        $this->db->where('id', $r->id);
        $this->db->update('compras.mer_factura_det', $a);
       
       }}
        $b = array('tipo' => 'C');
        $this->db->where('id', $id);
        $this->db->where('tipo', 'A');
        $this->db->update('compras.mer_factura', $b);
       
    }
/////////////////////////////////////////////////////
    function __agrega_inventario($codigo,$can,$costo)
    {   
        
        $m="select *from compras.mer_inventario where codigo=$codigo";
        $q1=$this->db->query($m);
        if($q1->num_rows()>0){
        $r1=$q1->row();
        $inv=$r1->can;
        $a = array(
        'codigo'=> $codigo,
        'costo' => $costo,
        'can' => $inv+$can
        );
        $this->db->where('codigo', $codigo);
        $this->db->update('compras.mer_inventario', $a);
        }else{
        $s="insert into compras.mer_inventario(codigo,can,costo)values($codigo,$can,$costo)";
        $this->db->query($s);
        }    
        
         
    }
    /////////////////////////////////////////////////////
 public function his_fac()
    {
        
        $s = "select a.*,b.corto,sum(can*costo)as importe from compras.mer_factura a 
        left join catalogo.provedor b on a.prv=b.prov
        left join compras.mer_factura_det c on a.id=c.id_cc
        where a.tipo='C'
        group by a.id
        order by fecha desc";
        $q = $this->db->query($s);
        return $q;
    }

  public function imprime_cabeza($id_cc)
    {
        $fec=date('Y-m-d H:i:s');
    $s="select a.*,b.corto from compras.mer_factura a 
        left join catalogo.provedor b on a.prv=b.prov
        where a.tipo='C' and a.id=$id_cc
        group by a.id";
        
    $q=$this->db->query($s);
    if($q->num_rows()>0){
        $r=$q->row();
        
        $l0='<img src="'.base_url().'img/logo.png" border="0" width="200px" />';
        $a="<table>
        <tr>
        <th colspan=\"11\" align=\"left\"><font size=\"+3\"><strong>$l0</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"11\" align=\"center\"><font size=\"+3\"><strong>Captura de factura</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"11\" align=\"left\"><font size=\"+1\"><strong>folio  $id_cc</strong></font></th>
        </tr> 
        <tr>
        <th colspan=\"11\" align=\"left\"><font size=\"+1\"><strong> $r->corto </strong></font></th>
        </tr>
        
        </table>";
        
    }else{$a='';}
    return $a;
    
    }
   




















}
