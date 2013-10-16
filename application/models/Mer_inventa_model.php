<?php
class Mer_inventa_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
 public function mer_inv()
    {
        
        $s = "SELECT a.*,b.descripcion FROM compras.mer_inventario a
left join catalogo.cat_saba_temp b on b.ean=a.codigo";
        $q = $this->db->query($s);
        return $q;
    } 
 /////////////////////////////////////////////////////

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