<?php
class Catalogos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function mante_susa($var)
    {
    $s="select *from catalogo.cat_nuevo_general group by $var";
    $q=$this->db->query($s);
    return $q;      
    }
    
    public function mante_susa_una($id)
    {
    $l="select  *from catalogo.cat_nuevo_general where id=$id";
    $qq=$this->db->query($l);
    if($qq->num_rows()>0){$rr=$qq->row();$susa=$rr->susa;}else{$susa='';}
    $s="select *from catalogo.cat_nuevo_general where susa='$susa' order by clagob,sec_cedis";
    $q=$this->db->query($s);
    return $q;      
    }
    public function mod_generico()
    {
    $s="select a.*,b.corto,c.linx, d.descripcion as sublinx from catalogo.cat_nuevo_general_sec a 
    left join catalogo.provedor b on a.prv=b.prov
    left join catalogo.lineas_cosvta c on c.lin=a.lin
    left join catalogo.sublinea d on d.lin=a.lin and d.slin=a.sublin
    ";
    $q=$this->db->query($s);
    return $q;      
    }
    public function mante_susa_completa_una($clagob,$sec_cedis)
    {
    $l="select  *from catalogo.cat_nuevo_general where clagob='$clagob' and sec_cedis=$sec_cedis";
    $qq=$this->db->query($l);
    if($qq->num_rows()>0){$rr=$qq->row();$susa=$rr->susa;}else{$susa='';}
    $s="select *from catalogo.cat_nuevo_general_prv where sec='$sec_cedis' and clagob='$clagob'";
    $q=$this->db->query($s);
    return $q;      
    }
    public function mante_codigo()
    {
    $s="select *from catalogo.cat_nuevo_general where tipo='A'";
    $q=$this->db->query($s);
    return $q;      
    }
    public function genericos()
    {
        $s = "select b.clagob,a.*, b.codigo,b.costo,b.prv,b.preferencia,b.prvxx,b.marca,
        case when ddr>0 then 100-((b.costo/a.ddr)*100) else 0 end as uddr,
        case when gen>0 then 100-((b.costo/a.gen)*100) else 0 end as ugen,
        case when a.cos>0 and b.costo>a.cos then 100-((a.cos/b.costo)*100) else 0 end as por
        
from catalogo.cat_nuevo_general_sec a
left join catalogo.cat_nuevo_general_prv b on a.sec=b.sec and b.tipo='A'
where a.tipo='A' 
order by b.sec asc,b.costo ";
        $q = $this->db->query($s);
        $b=0;
        foreach ($q->result()as $r)
        {
        
        $a[$r->sec]['sec'] = $r->sec;
        $a[$r->sec]['susa'] = $r->susa;
        $a[$r->sec]['cos'] = $r->cos;
        $a[$r->sec]['clasi'] = $r->clasi;
        $a[$r->sec]['natur'] = $r->natur;
        $a[$r->sec]['ddr'] = $r->ddr;
        $a[$r->sec]['gen'] = $r->gen;
        $a[$r->sec]['clagob'] = $r->clagob;
        $a[$r->sec]['productos'][$r->codigo]['codigo'] = $r->codigo;
        $a[$r->sec]['productos'][$r->codigo]['prv'] = $r->prv;
        $a[$r->sec]['productos'][$r->codigo]['costo'] = $r->costo;
        $a[$r->sec]['productos'][$r->codigo]['pref'] = $r->preferencia;
        $a[$r->sec]['productos'][$r->codigo]['prvxx'] = $r->prvxx;
        $a[$r->sec]['productos'][$r->codigo]['marca'] = $r->marca;
        $a[$r->sec]['productos'][$r->codigo]['por'] = $r->por;
        
       
        }

     return $a;  
    }
 public function seguro_popular()
    {
        $s = "select b.sec, a.*, b.codigo,b.costo,b.prv,b.preferencia,b.prvxx,b.marca,
        case when a.cos>0 and b.costo>a.cos then 100-((a.cos/b.costo)*100) else 0 end as por
from catalogo.cat_nuevo_general_cla a
left join catalogo.cat_nuevo_general_prv b on a.clagob=b.clagob and b.tipo='A'
where a.tipo='A'
order by b.clagob asc,b.costo";
        $q = $this->db->query($s);
        $b=0;
        foreach ($q->result()as $r)
        {
        $a[$r->clagob]['susa'] = $r->susa;
        $a[$r->clagob]['sec'] = $r->sec;
        $a[$r->clagob]['cos'] = $r->cos;
        $a[$r->clagob]['clagob'] = $r->clagob;
        $a[$r->clagob]['productos'][$r->codigo]['codigo'] = $r->codigo;
        $a[$r->clagob]['productos'][$r->codigo]['prv'] = $r->prv;
        $a[$r->clagob]['productos'][$r->codigo]['costo'] = $r->costo;
        $a[$r->clagob]['productos'][$r->codigo]['pref'] = $r->preferencia;
        $a[$r->clagob]['productos'][$r->codigo]['prvxx'] = $r->prvxx;
        $a[$r->clagob]['productos'][$r->codigo]['marca'] = $r->marca;
        $a[$r->clagob]['productos'][$r->codigo]['por'] = $r->por;
        }

     return $a;  
    }   
    
   public function especialidad()
    {
        $s = "select b.sec, a.*, b.codigo,b.costo,b.prv,b.preferencia,b.prvxx,b.marca,
case when a.cos>0 and b.costo>a.cos then 100-((a.cos/b.costo)*100) else 0 end as por
from catalogo.cat_nuevo_general a
left join catalogo.cat_nuevo_general_prv b on a.clagob=b.clagob and b.tipo='A'
where a.tipo='A' and esp='E' and a.clagob<>' '>0
order by b.clagob asc,b.costo";
        $q = $this->db->query($s);
        $b=0;
        foreach ($q->result()as $r)
        {
        $a[$r->clagob]['susa'] = $r->susa;
        $a[$r->clagob]['sec'] = $r->sec;
        $a[$r->clagob]['cos'] = $r->cos;
        $a[$r->clagob]['clagob'] = $r->clagob;
        $a[$r->clagob]['productos'][$r->codigo]['codigo'] = $r->codigo;
        $a[$r->clagob]['productos'][$r->codigo]['prv'] = $r->prv;
        $a[$r->clagob]['productos'][$r->codigo]['costo'] = $r->costo;
        $a[$r->clagob]['productos'][$r->codigo]['pref'] = $r->preferencia;
        $a[$r->clagob]['productos'][$r->codigo]['prvxx'] = $r->prvxx;
        $a[$r->clagob]['productos'][$r->codigo]['marca'] = $r->marca;
        $a[$r->clagob]['productos'][$r->codigo]['por'] = $r->por;
        }

     return $a;  
    }   
    
    function busca_ord_dias()
    {
        
        $sql = "SELECT *from catalogo.compras_ord_dias";
        $query = $this->db->query($sql);
        
        $por = array();
        $por[0] = "Selecciona los dias";
        
        foreach($query->result() as $row){
            $por[$row->porcen] = $row->dia.' DIAS';
        }
        
        return $por;  
    }
    
    function busca_almacen()
    {
        
        $sql = "SELECT *from catalogo.cat_almacenes where activo=1";
        $query = $this->db->query($sql);
        
        $alm = array();
        $alm[0] = "Seleccione Almacen";
        
        foreach($query->result() as $row){
            $alm[$row->tipo] = $row->nombre;
        }
        
        return $alm;  
    }
    function busca_almacen_uno($alm)
    {
        
        $sql = "SELECT a.*from catalogo.cat_almacenes a and tipo='$alm'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
        $row= $query->row();
        $alm=$row->nombre;    
        }else{
            $alm='';
        }
        return $alm;
    }
    function busca_almacen_por($alm)
    {
        
        $sql = "SELECT a.*from catalogo.cat_almacenes a where tipo='$alm'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
        $row= $query->row();
        $alm=$row->por;    
        }else{
            $alm='';
        }
        return $alm;
    }
    function busca_almacen_ped($id)
    {
        
        $sql = "SELECT a.* from catalogo.cat_almacenes a, compras.pedido_c b where b.almacen=a.tipo and b.id=$id";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
        $row= $query->row();
        $alm=$row->nombre;    
        }else{
            $alm='';
        }
        return $alm;
    }
     function busca_almacen_pedidos()
    {
        
        $sql = "SELECT *from catalogo.cat_almacenes where pedido=1 ";
        $query = $this->db->query($sql);
        
        $alm = array();
        $alm[0] = "Seleccione Almacen";
        
        foreach($query->result() as $row){
            $alm[$row->tipo] = $row->nombre;
        }
        
        return $alm;  
    }
    function tipo_producto()
    {
        
        $sql = "SELECT * FROM catalogo.cat_estatus_producto";
        $query = $this->db->query($sql);
        
        $tipo = array();
        $tipo[0] = "Seleccione Tipo producto";
        
        foreach($query->result() as $row){
            $tipo[$row->tipo] = $row->nombre;
        }
        
        return $tipo;  
    }
    function tipo_producto_uno($t)
    {
        
        $sql = "SELECT * FROM catalogo.cat_estatus_producto";
        $query = $this->db->query($sql);
        
        $tipo = array();
        $tipo[$t] = '';
        
        foreach($query->result() as $row){
            $tipo[$row->tipo] = $row->nombre;
        }
        
        return $tipo;  
    }
    function busca_prv()
    {
        
        $sql = "SELECT *from catalogo.provedor";
        $query = $this->db->query($sql);
        
        $prv = array();
        $prv[0] = "Seleccione Provedor";
        
        foreach($query->result() as $row){
            $prv[$row->prov] = $row->prov.' - '.$row->razo;
        }
        
        return $prv;  
    }
     function busca_prv_uno($prv)
    {
        
        $sql = "SELECT corto,prov FROM  catalogo.provedor where prov=$prv";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
        $row= $query->row();
        $prvv=$row->razo.' - '.$row->prv;    
        }else{
            $prvv='';
        }
        return $prvv;  
    }
    function busca_prv_mer()
    {
        
        $sql = "SELECT *from catalogo.cat_mer_prv order by razo";
        $query = $this->db->query($sql);
        
        $prv = array();
        $prv[0] = "Seleccione Provedor";
        
        foreach($query->result() as $row){
            $prv[$row->prov] = $row->razo.' '.$row->prov;
        }
        
        return $prv;  
    }
     function busca_prv_uno_mer($prv)
    {
        
        $sql = "SELECT corto,prov,razo FROM  catalogo.cat_mer_prv where prov=$prv";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
        $row= $query->row();
        $prvv=$row->razo;    
        }else{
            $prvv='';
        }
        return $prvv;  
    }
   function firma()
    {
        $firma=$this->session->userdata('id_firma');
        $sql = "select *from cat_firmas where id=$firma";
        $query = $this->db->query($sql);
        return $query;  
    }
      function busca_imagen_uno($tipo)
    {
        
        $sql = "SELECT * FROM  catalogo.cat_imagen where tipo='$tipo'";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
        $row= $query->row();
        $tipox=$row->nombre;    
        }else{
            $tipox='';
        }
        return $tipox;  
    }
       function busca_mes_uno($mes)
    {
        
        $sql = "SELECT * FROM  catalogo.mes where num=$mes";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
        $row= $query->row();
        $mesx=$row->mes;    
        }else{
            $mesx='';
        }
        return $mesx;  
    }
        function busca_ger_uno($ger)
    {
        
        $sql = "SELECT * FROM  catalogo.gerente where ger=$ger";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
        $row= $query->row();
        $gerx=$row->nombre_e;    
        }else{
            $gerx='';
        }
        return $gerx;  
    }
        function busca_sup_uno($sup)
    {
        
        $sql = "SELECT * FROM  catalogo.supervisor where zona=$sup";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
        $row= $query->row();
        $supx=$row->nombre;    
        }else{
            $supx='';
        }
        return $supx;  
    } 
          function busca_suc_una($suc)
    {
        
        $sql = "SELECT * FROM  catalogo.sucursal where suc=$suc";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
        $row= $query->row();
        $sucx=$row->nombre;    
        }else{
            $sucx='';
        }
        return $sucx;  
    }
     function busca_suc()
    {
        
        $sql = "SELECT *from catalogo.sucursal where suc>100 and suc<=2000 and tlid=1";
        $query = $this->db->query($sql);
        
        $suc = array();
        $suc[0] = "Seleccione Sucursal";
        
        foreach($query->result() as $row){
            $suc[$row->suc] = $row->nombre;
        }
        
        return $suc;  
    }
    function busca_codigo()
    {
        
        $sql = "SELECT *from catalogo.cat_mercadotecnia";
        $query = $this->db->query($sql);
        
        $codigo = array();
        $codigo[0] = "Seleccione Producto";
        
        foreach($query->result() as $row){
            $codigo[$row->codigo] = $row->descripcion;
        }
        
        return $codigo;  
    }
    public function busca_producto_nu($clagob,$sec)
    {
    $l="select  *from catalogo.cat_nuevo_general where clagob=$clagob and sec_cedis=$sec";
    $qq=$this->db->query($l);
    
    return $qq;      
    }
    public function busca_sec($sec)
    {
    $l="select a.*,b.corto,c.linx, d.descripcion as sublinx from catalogo.cat_nuevo_general_sec a 
    left join catalogo.provedor b on a.prv=b.prov
    left join catalogo.lineas_cosvta c on c.lin=a.lin
    left join catalogo.sublinea d on d.lin=a.lin and d.slin=a.sublin
     where sec=$sec";
    $qq=$this->db->query($l);
    
    return $qq;      
    }
    function busca_lin_uno($l)
    {
        
        $sql = "SELECT *from catalogo.lineas_cosvta
        ";
        $query = $this->db->query($sql);
        
        $lin = array();
        $lin[$l] = "Seleccione Linea";
        
        foreach($query->result() as $row){
            $lin[$row->lin] = $row->linx;
        }
        
        return $lin;  
    }
    function busca_activo_uno($p)
    {
        
        $sql = "SELECT *from catalogo.cat_mer_activo";
        $query = $this->db->query($sql);
        $pro = array();
        $pro[$p]='';
        foreach($query->result() as $row){
            $pro[$row->var] = $row->nombre;
        }
        }          

}
