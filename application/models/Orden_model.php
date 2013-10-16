<?php
class Orden_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

       
    public function orden_compra()
    {
        
        $s = "select a.*, sum(b.cans*b.costo)as impo,
case when (SELECT costobase FROM orden_d x 
where x.prv=a.prv and x.id_ped=a.id_ped and (x.costobase*1.05)<x.costo  
group by id_ped, prv) is null or autoriza > '0000-00-00'
then 'SI'
else 'NO'
end as var
from orden_c a
left join orden_d b on b.id_ped=a.id_ped and b.prv=a.prv and a.almacen=b.almacen
where a.tipo='A' and b.costo is not null
group by a.id_ped,a.prv,a.almacen";
        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $b = 0;
             $cia=$this->__busca_cia();
            foreach ($q->result() as $r) {
                //fechag, clasi, almacen, almacenx, impo
                $a[$r->id_ped]['segundo'][$r->prv]['cia'] = $cia;
                $a[$r->id_ped]['segundo'][$r->prv]['id_ped'] = $r->id_ped;
                $a[$r->id_ped]['segundo'][$r->prv]['fecha_ped'] = $r->fecha_ped;
                $a[$r->id_ped]['segundo'][$r->prv]['var'] = $r->var;
                $a[$r->id_ped]['segundo'][$r->prv]['prv'] = $r->prv;
                $a[$r->id_ped]['segundo'][$r->prv]['prvx'] = $r->prvx;
                $a[$r->id_ped]['segundo'][$r->prv]['tercero'] [$r->almacen]['almacen']= $r->almacen;
                $a[$r->id_ped]['segundo'][$r->prv]['tercero'] [$r->almacen]['impo']= $r->impo;
            }
        } else {
            $a = 0;
        }
        return $a;
    }
 public function orden_compra_detalle($prv,$id_ped)
    {
        $s = "select a.*, ifnull(b.sec,0)as sec,ifnull(b.clagob,' ')as clagob,ifnull(b.cans,0)as cans,ifnull(b.susa,' ')as susa,
ifnull((b.cans*b.costo),0)as impo,ifnull(b.costo,0)as costo,ifnull(b.costobase,0)as costobase
        from orden_c a
left join orden_d b on b.id_ped=a.id_ped and a.prv=b.prv and a.almacen=b.almacen
where a.tipo='A' and a.id_ped=$id_ped and a.prv=$prv
";
        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $b = 0;
            foreach ($q->result() as $r) {
                $res=$this->__busca_prv_clave($r->clagob,$r->sec);
                //fechag, clasi, almacen, almacenx, impo
                $a[$r->sec]['ca'] = $res;
                $a[$r->sec]['id_ped'] = $id_ped;
                $a[$r->sec]['prv'] = $prv;
                
                $a[$r->sec]['sec'] = $r->sec;
                $a[$r->sec]['clagob'] = $r->clagob;
                $a[$r->sec]['susa'] = $r->susa;
                $a[$r->sec]['costobase'] = $r->costobase;
                $a[$r->sec]['cos'] = $r->costo;
                $a[$r->sec]['segundo'][$r->almacen]['almacen'] = $r->almacen;
                $a[$r->sec]['segundo'][$r->almacen]['cans'] = $r->cans;
                $a[$r->sec]['segundo'][$r->almacen]['costo'] = $r->costo;
                $a[$r->sec]['segundo'][$r->almacen]['impo'] = $r->impo;
                
            }
        } else {
            $a = 0;
        }
        return $a;
    }
/////////////////////////////////////////////////////
    function __busca_prv_clave($cla,$sec)
    {
        $sql = "SELECT a.*,b.corto FROM catalogo.cat_nuevo_general_prv a
        left join catalogo.provedor b on b.prov=a.prv 
        where a.tipo='A' and a.clagob='$cla' and a.sec=$sec";
       
        $query = $this->db->query($sql);
       $res = array();
        $res[0] = "Selecciona un Provedor";
        
        foreach($query->result() as $row){
            $res[$row->id] = $row->costo.' '.$row->corto;
        }
       
        return $res;  
    }
/////////////////////////////////////////////////////
    function __busca_cia()
    {
        $sql = "select *from catalogo.compa where cia=1 or cia=13 ";
       
        $query = $this->db->query($sql);
       $res = array();
        $res[0] = "Selecciona un Compa&ntilde;ia";
        
        foreach($query->result() as $row){
            $res[$row->cia] = $row->razon;
        }
       
        return $res;  
    }
public function cambia($id_catalogo,$prv,$id_ped,$sec,$clagob)
{
        $userid=$this->session->userdata('id');
        $m="select a.*,b.corto from catalogo.cat_nuevo_general_prv a 
        left join catalogo.provedor b on b.prov=a.prv where a.id=$id_catalogo";
         $q=$this->db->query($m);
        if($q->num_rows()>0){
        $r=$q->row();
        
               
        $data = array('prv' => $r->prv,
        'codigo'=>$r->codigo,
        'costo'=>$r->costo);
        $this->db->where('id_ped', $id_ped);
        $this->db->where('prv', $prv);
        $this->db->where('tipo', 'A');
        $this->db->where('clagob', $clagob);
        $this->db->where('sec', $sec);
        $this->db->update('compras.orden_d', $data);
        
        $m1="insert ignore into orden_c(almacen, prv, prvx, fechag, tipo, fechae, id_userg, id_usere, cia, id_ped, fecha_ped,  folprv)
        (select almacen, $r->prv, '$r->corto', fechag, tipo, fechae, id_userg, id_usere, cia, id_ped, fecha_ped,  folprv 
        from orden_c where id_ped=$id_ped and prv=$prv and tipo='A')";
        $this->db->query($m1);
        
        }
     }
public function cerrar($prv,$id_ped,$cia,$tipo)
{
        $userid=$this->session->userdata('id');
        $m="select *from catalogo.fol_nuevo a where tipo='$tipo'";
        $q=$this->db->query($m);
        if($q->num_rows()>0){
        $r=$q->row();
         
        $dt_10= date('Y-m-d', strtotime('+10 day')); 
        $data = array('tipo' => 'C',
        'fechag'=>date('Y-m-d'),
        'folprv'=>$r->num,
        'cia'   =>$cia,
        'fechae'=>$dt_10,
        'id_usere'=>$this->session->userdata('id'));
        $this->db->where('id_ped', $id_ped);
        $this->db->where('prv', $prv);
        $this->db->where('tipo', 'A');
        $this->db->update('compras.orden_c', $data);
        
        $data = array('tipo' => 'C','fechae'=>date('Y-m-d'),'fechal'=>$dt_10);
        $this->db->where('id_ped', $id_ped);
        $this->db->where('prv', $prv);
        $this->db->where('tipo', 'A');
        $this->db->update('compras.orden_d', $data);
        $m1="update catalogo.fol_nuevo set num=$r->num+1 where tipo='$tipo'";
        $this->db->query($m1);
        }
     }
    public function historico()
    {
        $s = "select a.*, sum(b.cans*b.costo)as impo from orden_c a
left join orden_d b on b.id_ped=a.id_ped and b.prv=a.prv and a.almacen=b.almacen
where a.tipo='C'
group by a.id_ped,a.prv,a.almacen
order by folprv desc";
        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $b = 0;
            foreach ($q->result() as $r) {
                //fechag, clasi, almacen, almacenx, impo
                $a[$r->folprv]['id_ped'] = $r->id_ped;
                $a[$r->folprv]['fechae'] = $r->fechae;
                $a[$r->folprv]['folprv'] = $r->folprv;
                $a[$r->folprv]['fechag'] = $r->fechag;
                $a[$r->folprv]['fecha_ped'] = $r->fecha_ped;
                $a[$r->folprv]['prv'] = $r->prv;
                $a[$r->folprv]['prvx'] = $r->prvx;
                $a[$r->folprv]['segundo'][$r->almacen]['almacen']= $r->almacen;
                $a[$r->folprv]['segundo'][$r->almacen]['impo']= $r->impo;
            }
        } else {
            $a = 0;
        }
       
        return $a;
    }

 public function historico_detalle($folprv)
    {
         $s = "select b.codigo,a.*, b.sec,b.clagob,b.cans,b.susa,(b.cans*b.costo)as impo,b.costo,b.costobase from orden_c a
left join orden_d b on b.id_ped=a.id_ped and a.prv=b.prv 
where a.tipo='C' and a.folprv=$folprv
";
        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $b = 0;
            foreach ($q->result() as $r) {
                //fechag, clasi, almacen, almacenx, impo
                $a[$r->sec]['sec'] = $r->sec;
                $a[$r->sec]['clagob'] = $r->clagob;
                $a[$r->sec]['susa'] = $r->susa;
                $a[$r->sec]['codigo'] = $r->codigo;
                $a[$r->sec]['costobase'] = $r->costobase;
                $a[$r->sec]['cos'] = $r->costo;
                $a[$r->sec]['segundo'][$r->almacen]['almacen'] = $r->almacen;
                $a[$r->sec]['segundo'][$r->almacen]['cans'] = $r->cans;
                $a[$r->sec]['segundo'][$r->almacen]['costo'] = $r->costo;
                $a[$r->sec]['segundo'][$r->almacen]['impo'] = $r->impo;
            }
        } else {
            $a = 0;
        }
        return $a;
    }
  public function imprime_cabeza($folprv)
    {
        $fec=date('Y-m-d H:i:s');
    $s="select a.fechae as fechaee, a.*,b.*,c.razon as razonx, c.razon as razonx, 
    c.dire as direx, c.col,c.pobla as poblax,c.cp as cpx,
    c.rfc as rfcx
    from orden_c a 
    left join catalogo.provedor b on b.prov=a.prv
    left join catalogo.compa c on c.cia=a.cia
    where folprv=$folprv";
    $q=$this->db->query($s);
    if($q->num_rows()>0){
        $r=$q->row();
        $l0='<img src="'.base_url().'img/logo.png" border="0" width="200px" />';
        $a="<table>
        <tr>
        <th colspan=\"11\" align=\"left\"><font size=\"+3\"><strong>$l0</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"11\" align=\"center\"><font size=\"+3\"><strong>ORDEN DE COMPRA</strong></font></th>
        </tr>
         <tr>
        <th colspan=\"5\" align=\"left\"><font size=\"+3\"><strong>ENTREGAR ANTES DE $r->fechaee</strong></font></th>
        <th colspan=\"6\" align=\"right\"><font size=\"-2\"><strong>Fecha de impresion $fec</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"2\" align=\"left\"></th>
        <th colspan=\"3\" align=\"left\"></th>
        <th colspan=\"4\" align=\"left\"><font size=\"+1\"><strong>CONSIGNAR PEDIDO A</strong></font></th>
        <th colspan=\"2\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"2\" align=\"left\"><font size=\"+1\"><strong>Orden.: $folprv</strong></font></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>$r->razo</strong></font></th>
        <th colspan=\"4\" align=\"left\"><font size=\"+1\"><strong>$r->razonx</strong></font></th>
        <th colspan=\"2\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"2\" align=\"left\"></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>$r->dire</strong></font></th>
        <th colspan=\"4\" align=\"left\"><font size=\"+1\"><strong>$r->direx</strong></font></th>
        <th colspan=\"2\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"2\" align=\"left\"></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>C.P $r->cp</strong></font></th>
        <th colspan=\"4\" align=\"left\"><font size=\"+1\"><strong>$r->cpx</strong></font></th>
        <th colspan=\"2\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"2\" align=\"left\"></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>$r->pobla</strong></font></th>
        <th colspan=\"4\" align=\"left\"><font size=\"+1\"><strong>$r->poblax</strong></font></th>
        <th colspan=\"2\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"2\" align=\"left\"></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>$r->rfc</strong></font></th>
        <th colspan=\"4\" align=\"left\"><font size=\"+1\"><strong>$r->rfcx</strong></font></th>
        <th colspan=\"2\" align=\"left\"></th>
        </tr>
        </table>";
        
    }else{$a='';}
    return $a;
    
    }
   public function imprime($folprv,$imagen,$nombre)
    {
         $s = "select b.codigo,a.*, b.sec,b.clagob,b.cans,b.susa,(b.cans*b.costo)as impo,b.costo,b.costobase 
         from orden_c a
left join orden_d b on b.id_ped=a.id_ped and a.prv=b.prv and a.almacen=b.almacen
where a.tipo='C' and a.folprv=$folprv
";

        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $b = 0;
            foreach ($q->result() as $r) {
                //fechag, clasi, almacen, almacenx, impo
                $a[$r->sec]['imagen'] = $imagen;
                $a[$r->sec]['nombre'] = $nombre;
                $a[$r->sec]['sec'] = $r->sec;
                $a[$r->sec]['clagob'] = $r->clagob;
                $a[$r->sec]['susa'] = $r->susa;
                $a[$r->sec]['codigo'] = $r->codigo;
                $a[$r->sec]['costobase'] = $r->costobase;
                $a[$r->sec]['cos'] = $r->costo;
                $a[$r->sec]['segundo'][$r->almacen]['almacen'] = $r->almacen;
                $a[$r->sec]['segundo'][$r->almacen]['cans'] = $r->cans;
                $a[$r->sec]['segundo'][$r->almacen]['costo'] = $r->costo;
                $a[$r->sec]['segundo'][$r->almacen]['impo'] = $r->impo;
            }
        } else {
            $a = 0;
        }
        return $a;
    }  




















}
