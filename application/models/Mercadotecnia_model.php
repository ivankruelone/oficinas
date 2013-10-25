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
        left join catalogo.cat_mer_prv b on a.prv=b.prov
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
        (select $id,$codigo,descripcion,$cantidad,'$costo',iva from catalogo.cat_mercadotecnia where codigo=$codigo )";
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
        left join catalogo.cat_mer_prv b on a.prv=b.prov
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
        left join catalogo.cat_mer_prv b on a.prv=b.prov
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
    ////////////////////////////////////////////////////////////////////////////////////////////////////surtido de p

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
        
        $sql = "SELECT a.*,b.descripcion from compras.mer_inventario a left join catalogo.cat_mercadotecnia b on a.codigo=b.ean
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
        (select $id,$codigo,a.descripcion,$cantidad,'$costo','N','$publico' from catalogo.cat_mercadotecnia a
        left join compras.mer_inventario b on b.codigo=a.codigo where a.codigo=$codigo and b.codigo=$codigo)";
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

  public function imprime_ped_cabeza($id_cc)
    {
        $fec=date('Y-m-d H:i:s');
    $s="select a.*,b.nombre as sucx from compras.mer_surtido a 
        left join catalogo.sucursal b on a.suc=b.suc
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
        <th colspan=\"11\" align=\"center\"><font size=\"+3\"><strong>REMISION</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"11\" align=\"left\"><font size=\"+1\"><strong>folio  $id_cc</strong></font></th>
        </tr> 
        <tr>
        <th colspan=\"11\" align=\"left\"><font size=\"+1\"><strong> $r->sucx </strong></font></th>
        </tr>
        
        </table>";
        
    }else{$a='';}
    return $a;
    
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////inventario
     public function mer_inv()
    {
        
        $s = "SELECT a.*,b.descripcion FROM compras.mer_inventario a
left join catalogo.cat_mercadotecnia b on b.codigo=a.codigo";
        $q = $this->db->query($s);
        return $q;
    } 
 /////////////////////////////////////////////////////
 public function agrega_inv($codigo,$can,$costo)
    {
        
        $s = "SELECT *from catalogo.cat_mercadotecnia where codigo=$codigo";
        $q = $this->db->query($s);
        if($q->num_rows()>0){
        $s1="insert ignore into compras.mer_inventario(codigo,can,costo)
        values($codigo,$can,'$costo')";
        $this->db->query($s1);
        }
       
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////inventario
     public function cat_productos()
    {
        
        $s = "select substring(descripcion,1,1)as letra,count(descripcion)as pro from catalogo.cat_mercadotecnia group by substring(descripcion,1,1)";
        $q = $this->db->query($s);
        foreach($q->result() as $r){
            $a[$r->letra]['letra'] = $r->letra;
        }
        return $a;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////inventario
     public function cat_productos_lab()
    {
        
        $s = "select a.lab,b.labor from catalogo.cat_mercadotecnia a left join catalogo.laboratorios b on b.num=a.lab group by a.lab order by labor";
        $q = $this->db->query($s);
        foreach($q->result() as $r){
            $a[$r->lab]['lab'] = $r->lab;
            $a[$r->lab]['labor'] = $r->labor;
        }
        return $a;
    }
      ////////////////////////////////////////////////////////////////////////////////////////////////////////inventario
     public function cat_productos_letra($letra)
    {
        
        $s = "select a.*,b.labor,case when iva=0 then 'Sin Iva' else 'Con Iva' end as ivax from catalogo.cat_mercadotecnia a
        left join catalogo.laboratorios b on b.num=a.lab
        where substring(descripcion,1,1)='$letra'
        order by descripcion";
        $q = $this->db->query($s);
        foreach($q->result() as $r){
            $a[$r->codigo]['codigo'] = $r->codigo;
            $a[$r->codigo]['descripcion'] = $r->descripcion;
            $a[$r->codigo]['labor'] = $r->labor;
            $a[$r->codigo]['pub'] = $r->pub;
            $a[$r->codigo]['farmacia'] = $r->farmacia;
            $a[$r->codigo]['venta'] = $r->venta;
            $a[$r->codigo]['registro'] = $r->registro;
            $a[$r->codigo]['fecha_registro'] = $r->fecha_registro;
            $a[$r->codigo]['producto'] = $r->producto;
            $a[$r->codigo]['clave'] = $r->clave;
            $a[$r->codigo]['ivax'] = $r->ivax;
            $a[$r->codigo]['producto'] = $r->producto;
            $a[$r->codigo]['susa'] = $r->susa;
            $a[$r->codigo]['id'] = $r->id;
            
        }
        return $a;
    }
     ////////////////////////////////////////////////////////////////////////////////////////////////////////inventario
     public function cat_productos_labor($lab)
    {
        
        $s = "select a.*,b.labor,case when iva=0 then 'Sin Iva' else 'Con Iva' end as ivax from catalogo.cat_mercadotecnia a
        left join catalogo.laboratorios b on b.num=a.lab
        where lab=$lab order by descripcion";
        $q = $this->db->query($s);
        foreach($q->result() as $r){
            $a[$r->codigo]['codigo'] = $r->codigo;
            $a[$r->codigo]['descripcion'] = $r->descripcion;
            $a[$r->codigo]['labor'] = $r->labor;
            $a[$r->codigo]['pub'] = $r->pub;
            $a[$r->codigo]['farmacia'] = $r->farmacia;
            $a[$r->codigo]['venta'] = $r->venta;
            $a[$r->codigo]['registro'] = $r->registro;
            $a[$r->codigo]['fecha_registro'] = $r->fecha_registro;
            $a[$r->codigo]['producto'] = $r->producto;
            $a[$r->codigo]['clave'] = $r->clave;
            $a[$r->codigo]['ivax'] = $r->ivax;
            $a[$r->codigo]['producto'] = $r->producto;
            $a[$r->codigo]['susa'] = $r->susa;
            $a[$r->codigo]['lin'] = $r->lin;
            $a[$r->codigo]['sublin'] = $r->sublin;
            $a[$r->codigo]['id'] = $r->id;
            $a[$r->codigo]['tipo'] = $r->tipo;
            
        }
        return $a;
    }  
  public function agrega_producto($codigo,$descri,$registro,$registro_fec,$clave,$susa,$tipo_p,$iva,$lab,$far,
  $venta,$pub,$lin,$sublin)
    {
    $s="select *from catalogo.cat_mercadotecnia where codigo=$codigo";
    $q=$this->db->query($s);
    if($q->num_rows()==0){    
    $a=array(
    'codigo'=>$codigo,
    'descripcion'=>strtoupper(trim($descri)),
    'lab'=>$lab,
    'iva'=>$iva,
    'farmacia'=>$far,
    'pub'=>$pub,
    'venta'=>$venta,
    'tipo'=>'A',
    'registro'=>strtoupper(trim($registro)),
    'id_user'=>$this->session->userdata('id'),
    'fecha_registro'=>$registro_fec,
    'fecha_archivo'=>date('Y-m-d H:i:s'),
    'producto'=>$tipo_p,
    'clave'=>$clave,
    'susa'=>strtoupper(trim($susa)),
    'lin'=>$lin,
    'sublin'=>$sublin
    );
    $this->db->insert('catalogo.cat_mercadotecnia',$a);
    }
    
     }
     public function cambia_producto($id,$descri,$registro,$registro_fec,$clave,$susa,$tipo_p,$iva,
     $lab,$far,$venta,$pub,$tipo,$lin,$sublin)
    {
    $a=array(
    'descripcion'=>strtoupper(trim($descri)),
    'lab'=>$lab,
    'iva'=>$iva,
    'farmacia'=>$far,
    'pub'=>$pub,
    'venta'=>$venta,
    'tipo'=>$tipo,
    'registro'=>strtoupper(trim($registro)),
    'id_user'=>$this->session->userdata('id'),
    'fecha_registro'=>$registro_fec,
    'fecha_archivo'=>date('Y-m-d H:i:s'),
    'producto'=>$tipo_p,
    'clave'=>$clave,
    'susa'=>strtoupper(trim($susa)),
    'lin'=>$lin,
    'sublin'=>$sublin
    );
    $this->db->where('id',$id);
    $this->db->update('catalogo.cat_mercadotecnia',$a);
     }
     /////////////////////////////////////////////////////
  public function provedor()
    {
    $s="select *from catalogo.cat_mer_prv where tipo='A'";
        $q=$this->db->query($s);
        return $q;
    }
     public function graba_prv($prv,$razo,$dire,$cp,$pobla,$rfc,$corto,$tel)
    {
    $a=array(
    //prov, razo, dire, cp, pobla, rfc, tipo, corto, tel, id, control
    'prov'=>$prv,
    'razo'=>strtoupper(trim($razo)),
    'dire'=>strtoupper(trim($dire)),
    'cp'  =>$cp,
    'pobla'=>strtoupper(trim($pobla)),
    'rfc'  =>strtoupper(trim($rfc)),
    'tipo' =>'A',
    'corto'=>strtoupper(trim($corto)),
    'tel'=>$tel
    );
    $this->db->insert('catalogo.cat_mer_prv',$a);
    }
    
    
      public function cambiar_prv($prv,$razo,$dire,$cp,$pobla,$rfc,$corto,$tel)
    {
    $a=array(
    //prov, razo, dire, cp, pobla, rfc, tipo, corto, tel, id, control
    'razo'=>strtoupper(trim($razo)),
    'dire'=>strtoupper(trim($dire)),
    'cp'  =>$cp,
    'pobla'=>strtoupper(trim($pobla)),
    'rfc'  =>strtoupper(trim($rfc)),
    'tipo' =>'A',
    'corto'=>strtoupper(trim($corto)),
    'tel'=>$tel
    );
    $this->db->where('prov',$prv);
    $this->db->update('catalogo.cat_mer_prv',$a);
    }
/////////////////////////////////////////////////////
 /////////////////////////////////////////////////////
  public function laboratorios()
    {
    $s="select *from catalogo.laboratorios ";
        $q=$this->db->query($s);
        return $q;
    }
/////////////////////////////////////////////////////
   public function orden()
    {
        
        $s = "select * FROM compras.orden_c  where producto='patente'";
        $q = $this->db->query($s);
        return $q;
    }

   public function orden_det($id)
    {
        
        $s = "select * FROM compras.orden_d  where id_cc=$id";
        $q = $this->db->query($s);
        return $q;
    }

 public function agrega_orden_det($codigo,$costo,$cantidad,$id,$prv)
    {   
    $a=array(//id_cc, almacen, sec, clagob, codigo, susa, canp, cans, aplica, fechae, fechal, id, 
    //prv, costo, id_ped, xtipo, costobase, prvbase, tipo, autoriza
    'id_cc'=>$id,
    'almacen'=>'alm',
    'sec'=>0,
    'clagob'=>$r->clave,
    'codigo'=>$codigo,
    'susa'=>$r->descri,
    'canp'=>$cantidad,
    'cans'=>$cantidad,
    'aplica'=>0,
    'fechae'=>date('Y-m-d'),
    'fechal'=>'0000-00-00',
    'prv'=>$prv,
    'costo'=>$costo,
    'id_ped'=>0,
    'xtipo'=>' ',
    'costobase'=>$r->costo,
    'prvbase'=>0,
    'tipo'=>'A',
    'autoriza'=>0
    );
    $this->db->insert('compras.ordenn_d',$a);
    
        
    }







   function busca_lab()
    {
        
        $sql = "SELECT *from catalogo.laboratorios";
        $query = $this->db->query($sql);
        
        $lab = array();
        $lab[0] = "Seleccione Laboratorio";
        
        foreach($query->result() as $row){
            $lab[$row->num] = $row->labor;
        }
        
        return $lab;  
    }
   
   function busca_pro()
    {
        
        $sql = "SELECT *from catalogo.cat_mer_pro";
        $query = $this->db->query($sql);
        
        $pro = array();
        $pro[0] = "Seleccione tipo de producto";
        
        foreach($query->result() as $row){
            $pro[$row->var] = $row->nombre;
        }
        
        return $pro;  
    }
    function busca_pro_uno($p)
    {
        
        $sql = "SELECT *from catalogo.cat_mer_pro ";
        $query = $this->db->query($sql);
        $pro = array();
        $pro[$p]='';
        foreach($query->result() as $row){
            $pro[$row->var] = $row->nombre;
        }
        
        return $pro;  
    }
    function busca_activo()
    {
        
        $sql = "SELECT *from catalogo.cat_mer_activo";
        $query = $this->db->query($sql);
        
        $pro = array();
        $pro[0] = "Seleccione status del producto";
        
        foreach($query->result() as $row){
            $pro[$row->var] = $row->nombre;
        }
        
        return $pro;  
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
        
        return $pro;  
    }
    function busca_lin()
    {
        
        $sql = "SELECT *from catalogo.lineas_cosvta
        ";
        $query = $this->db->query($sql);
        
        $lin = array();
        $lin[0] = "Seleccione Linea";
        
        foreach($query->result() as $row){
            $lin[$row->lin] = $row->linx;
        }
        
        return $lin;  
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
    
    function busca_sublin($l)
    {
        
        $sql = "SELECT *from catalogo.sublinea where lin=$l
        ";
        $query = $this->db->query($sql);
        
        $slin = array();
        $slin[0] = "Seleccione Linea";
        
        foreach($query->result() as $row){
            $slin[$row->slin] = $row->descripcion;
        }
        
        return $slin;  
    }
    function busca_sublin_uno($l,$sub)
    {
        
        $sql = "SELECT *from catalogo.sublinea where lin=$l
        ";
        $query = $this->db->query($sql);
        
        $slin = array();
        $slin[$sub] = "Seleccione Linea";
        
        foreach($query->result() as $row){
            $slin[$row->slin] = $row->descripcion;
        }
        
        return $slin;  
    } 
    function busca_lab_uno($l)
    {
        
        $sql = "SELECT *from catalogo.laboratorios
        ";
        $query = $this->db->query($sql);
        
        $lab = array();
        $lab[$l] = '';
        
        foreach($query->result() as $row){
            $lab[$row->num] = $row->labor;
        }
        
        return $lab;  
    } 
 /////////////////////////////////////////////////////
  public function busca_producto($id)
    {
    $s="select a.*,b.labor,case when iva=0 then 'Sin Iva' else 'Con Iva' end as ivax from catalogo.cat_mercadotecnia a
        left join catalogo.laboratorios b on b.num=a.lab
        where id=$id ";
        $q=$this->db->query($s);
        return $q;
    }
    /////////////////////////////////////////////////////
  public function busca_prv_unico($prv)
    {
    $s="select *from catalogo.cat_mer_prv 
        where prov=$prv ";
        $q=$this->db->query($s);
        return $q;
    }



















}
