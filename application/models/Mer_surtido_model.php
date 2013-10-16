<?php
class Mer_surtido_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 public function mer_surtido()
    {
        
        $s = "select a.*,b.nombre as sucx,sum(can*costo)as importe from compras.mer_surtido a 
        left join catalogo.sucursal b on a.suc=b.suc
        left join compras.mer_surtido_det c on a.id=c.id_cc
        where a.tipo='A'
        group by a.id";
        $q = $this->db->query($s);
        return $q;
    } 
 /////////////////////////////////////////////////////
  public function surtido_det($id)
    {
        
        $s = "select a.* from compras.mer_surtido_det a where a.id_cc=$id";
        $q = $this->db->query($s);
        return $q;
    }   
  function busca_inv()
    {
        
        $sql = "SELECT a.*,b.descripcion from compras.mer_inventario a left join catalogo.cat_saba_temp b on a.codigo=b.ean
        where a.can>0";
        $query = $this->db->query($sql);
        
        $codigo = array();
        $codigo[0] = "Seleccione Producto";
        
        foreach($query->result() as $row){
            $codigo[$row->codigo] = $row->descripcion."______<font color=\"blue\">".$row->can.' piezas</font>';
        }
        
        return $codigo;  
    } 
   
   /////////////////////////////////////////////////////
 public function agrega_surtido_det($codigo,$costo,$cantidad,$publico,$id)
    {   
        $id_user=$this->session->userdata('id');
        $fec=date('Y-m-d H:i:s');//id, id_cc, codigo, can, inv, costo, publico
        $s = "insert ignore into compras.mer_surtido_det(id_cc, codigo, descri, can, costo, inv,publico)
        (select $id,$codigo,descripcion,$cantidad,'$costo','N','$publico' from catalogo.cat_saba_temp where ean=$codigo )";
        $q = $this->db->query($s);
    }
   
public function cerrar_surtido($id)
    {   
        $id_user=$this->session->userdata('id');
        $fec=date('Y-m-d H:i:s');
        $s = "select *from compras.mer_surtido_det where id_cc=$id and inv='N'";
        $q = $this->db->query($s);
        $tot=0;
        
        if($q->num_rows()>0){
        foreach($q->result() as $r){
        $this->__resta_inventario($r->codigo,$r->can);
        echo $r->id;
        $a = array('inv' => 'S');
        $this->db->where('id', $r->id);
        $this->db->update('compras.mer_surtido_det', $a);
       
       }}
        $b = array('tipo' => 'C');
        $this->db->where('id', $id);
        $this->db->where('tipo', 'A');
        $this->db->update('compras.mer_surtido', $b);
       
    }
/////////////////////////////////////////////////////
    function __resta_inventario($codigo,$can)
    {   
        
        $m="select *from compras.mer_inventario where codigo=$codigo";
        $q1=$this->db->query($m);
        if($q1->num_rows()>0){
        $r1=$q1->row();
        $inv=$r1->can;
        $a = array(
        'codigo'     => $codigo,
        'can' => $inv-$can
        );
        $this->db->where('codigo', $codigo);
        $this->db->update('compras.mer_inventario', $a);
        }else{
        $s="insert into compras.mer_inventario(codigo,can)values($codigo,(0-$can))";
        $this->db->query($s);
        }    
        
         
    }   

   /////////////////////////////////////////////////////
 public function his_sur()
    {
        
        $s = "select a.*,b.nombre as sucx,sum(can*costo)as importe from compras.mer_surtido a 
        left join catalogo.sucursal b on a.suc=b.suc
        left join compras.mer_surtido_det c on a.id=c.id_cc
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