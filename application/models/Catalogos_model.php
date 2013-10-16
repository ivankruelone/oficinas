<?php
class Catalogos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
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
    function busca_prv()
    {
        
        $sql = "SELECT *from catalogo.provedor";
        $query = $this->db->query($sql);
        
        $prv = array();
        $prv[0] = "Seleccione Provedor";
        
        foreach($query->result() as $row){
            $prv[$row->prov] = $row->corto;
        }
        
        return $prv;  
    }
     function busca_prv_uno($prv)
    {
        
        $sql = "SELECT corto,prov FROM  catalogo.provedor where prov=$prv";
        $query = $this->db->query($sql);
        if($query->num_rows()>0){
        $row= $query->row();
        $prvv=$row->corto;    
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
        
        $sql = "SELECT *from catalogo.cat_saba_temp";
        $query = $this->db->query($sql);
        
        $codigo = array();
        $codigo[0] = "Seleccione Producto";
        
        foreach($query->result() as $row){
            $codigo[$row->ean] = $row->descripcion;
        }
        
        return $codigo;  
    }         

}
