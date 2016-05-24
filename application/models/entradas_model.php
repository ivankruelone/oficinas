<?php
class Entradas_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function facturas($f1, $f2)
    {
        $aaa = date('Y');
        $s = "SELECT b.tipo2,a.mes as mm,a.suc, d.nombre as tipox, a.mes,c.mes as mesx, b.regional, b.superv,
sum(importe_prvo)as importe_prvo, sum(importe_suco)as importe_suco, sum(importe_prvs)as importe_prvs, sum(importe_sucs)as importe_sucs
FROM vtadc.gc_factura_suc a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.mes c on c.num=a.mes
left join catalogo.cat_imagen d on d.tipo=b.tipo2
where b.regional>0 and aaa=$aaa and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>187
group by a.mes,b.tipo2 ";
        $q = $this->db->query($s);


        return $q;
    }
    public function facturas_suc($f1, $f2)
    {
        $aaa = date('Y');
        $s = "SELECT b.nombre as sucx,b.tipo2,a.mes as mm,a.suc, d.nombre as tipox, a.mes,c.mes as mesx, b.regional, b.superv,
sum(importe_prvo)as importe_prvo, sum(importe_suco)as importe_suco, sum(importe_prvs)as importe_prvs, sum(importe_sucs)as importe_sucs
FROM vtadc.gc_factura_suc a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.mes c on c.num=a.mes
left join catalogo.cat_imagen d on d.tipo=b.tipo2
where b.regional>0 and aaa=$aaa and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>187
and a.mes=$f1 and b.tipo2='$f2'
group by a.suc ";
        $q = $this->db->query($s);


        return $q;
    }
 

    
    public function facturas_g($fa,$f1,$f2)
    {
        $aaa = date('Y');
        $s = "SELECT b.dia, b.nombre as sucx,e.nombre as supervx, b.tipo2,a.mes as mm,a.suc, d.nombre_e as regionalx, a.mes,c.mes as mesx, b.regional, b.superv,
case when $fa=0 then sum(importe_prvo) else sum(importe_prvs) end importe_prvo, 
case when $fa=0 then sum(importe_suco) else sum(importe_sucs) end importe_suco
FROM vtadc.gc_factura_suc a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.mes c on c.num=a.mes
left join catalogo.gerente d on d.ger=b.regional
left join catalogo.supervisor e on e.zona=b.superv
where b.regional>0 and aaa=$aaa and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>187
group by a.mes,b.regional,b.superv,a.suc";
        $q = $this->db->query($s);
        foreach ($q->result() as $r) {
            $a[$r->mes]['fa'] = $fa;
            $a[$r->mes]['f1'] = $f1;
            $a[$r->mes]['f2'] = $f2;
            $a[$r->mes]['mesx'] = $r->mesx;
            $a[$r->mes]['mes'] = $r->mm;
            $a[$r->mes]['m'][$r->regional]['regional'] = $r->regional;
            $a[$r->mes]['m'][$r->regional]['regionalx'] = $r->regionalx;
            $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['superv'] = $r->superv;
            $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['supervx'] = $r->supervx;
            $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->suc]['suc'] = $r->suc;
            $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->suc]['sucx'] = $r->sucx;
            $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->suc]['dia'] = $r->dia;
            $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->suc]['importe_prvo'] = $r->importe_prvo;
            $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->suc]['importe_suco'] = $r->importe_suco;
        }
        return $a;
    }
   public function facturas_suc_fac($fa,$f1,$f2)
    {
        if($fa==1){$var='=';}else{$var='>';}
        $aaa = date('Y');
        $s = "SELECT b.nombre as sucx,b.tipo2,a.mes as mm,a.suc, d.nombre as tipox, a.mes,c.mes as mesx, b.regional, b.superv,
a.*,case when prv=100 then 'ALMACEN CEDIS' else e.corto end as corto
FROM vtadc.gc_factura a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.mes c on c.num=a.mes
left join catalogo.cat_imagen d on d.tipo=b.tipo2
left join catalogo.provedor e on e.prov=a.prv
where b.regional>0 and aaa=$aaa and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>187
and a.importe_prv".$var."0 and a.mes=$f1 and b.suc=$f2";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //die();

        return $q;
        
    }
    
    function entradas_cedis($perini, $perfin, $prove, $clave, $lot)
    {
        $provee =$this->input->post('prove');
        $a= explode("-",$provee);
        $proveedor=trim($a[0]);
        
        $clave1 =$this->input->post('clave');
        $a= explode("-", $clave1);
        $clave=trim($a[0]);
        
        $this->db->select('c.fechai, c.orden, c.prv, p.razo, c.fac, a.sec, g.susa1, g.tsec, a.lote, a.cadu, a.can, a.codigo, a.costo');
        $this->db->from('desarrollo.compra_c c');
        $this->db->join('desarrollo.compra_d a', 'c.id=a.id_cc');
        $this->db->join('catalogo.provedor p', 'p.prov=c.prv');
        $this->db->join("catalogo.almacen g", "g.sec=a.sec and g.tsec='G'");
        $this->db->where('c.tipo', 'C');
        
        if(isset($clave) && strlen(trim($clave)) > 0){
            $this->db->where('a.sec', $clave);
        }
        
        if(isset($proveedor) && strlen(trim($proveedor)) > 0){
            $this->db->where('c.prv', $proveedor);
        }
        
        if(isset($lot) && strlen(trim($lot)) > 0){
            $this->db->where('a.lote', $lot);
        }

        if(isset($perini) && isset($perfin)){
            $this->db->where("date(c.fechai) between '$perini' and '$perfin'", null, false);
        }

        $query = $this->db->get();
        //echo $this->db->last_query();
        //echo die();
        
        return $query;
    }
    
    function entradas_metro($perini, $perfin, $prove, $clave, $lot)
    {
        $provee =$this->input->post('prove');
        $a= explode("-",$provee);
        $proveedor=trim($a[0]);
        
        $clave1 =$this->input->post('clave');
        $a= explode("-", $clave1);
        $clave=trim($a[0]);
        
        $this->db->select('c.fecha, c.orden, c.prv, c.prvx, c.factura, a.clave, g.susa1, g.tsec, a.lote, a.caducidad, a.can, a.codigo, a.costo');
        $this->db->from('metro.compra_c c');
        $this->db->join('metro.compra_d a', 'c.id=a.id_cc');
        $this->db->join("catalogo.almacen g", "g.sec=a.clave and g.tsec='M'");
        $this->db->where('c.tipo', 1);
        
        if(isset($clave) && strlen(trim($clave)) > 0){
            $this->db->where('a.clave', $clave);
        }
        
        if(isset($proveedor) && strlen(trim($proveedor)) > 0){
            $this->db->where('c.prv', $proveedor);
        }
        
        if(isset($lot) && strlen(trim($lot)) > 0){
            $this->db->where('a.lote', $lot);
        }

        if(isset($perini) && isset($perfin)){
            $this->db->where("date(c.fecha) between '$perini' and '$perfin'", null, false);
        }

        $q = $this->db->get();
        //echo $this->db->last_query();
        //echo die();
        
        return $q;
    }
    
    function entradas_farma($perini, $perfin, $prove, $clave, $lot)
    {
        $provee =$this->input->post('prove');
        $a= explode("-",$provee);
        $proveedor=trim($a[0]);
        
        $clave1 =$this->input->post('clave');
        $a= explode("-", $clave1);
        $clave=trim($a[0]);
        
        $this->db->select('c.fecha, c.orden, c.prv, c.prvx, c.factura, a.clave, g.susa1, g.tsec, a.lote, a.caducidad, a.can, a.codigo, a.costo');
        $this->db->from('farmabodega.compra_c c');
        $this->db->join('farmabodega.compra_d a', 'c.id=a.id_cc');
        $this->db->join("catalogo.almacen g", "g.sec=a.sec and g.tsec='G'");
        $this->db->where('c.tipo', 1);
        
        if(isset($clave) && strlen(trim($clave)) > 0){
            $this->db->where('a.clave', $clave);
        }
        
        if(isset($proveedor) && strlen(trim($proveedor)) > 0){
            $this->db->where('c.prv', $proveedor);
        }
        
        if(isset($lot) && strlen(trim($lot)) > 0){
            $this->db->where('a.lote', $lot);
        }

        if(isset($perini) && isset($perfin)){
            $this->db->where("date(c.fecha) between '$perini' and '$perfin'", null, false);
        }

        $q1 = $this->db->get();
        //echo $this->db->last_query();
        //echo die();
        
        return $q1;
    }
    
     function entradas_segpop($perini, $perfin, $prove, $clave, $lot, $tipo)
    {
        $provee =$this->input->post('prove');
        $a= explode("-",$provee);
        $proveedor=trim($a[0]);
        
        $clave1 =$this->input->post('clave');
        $a= explode("-", $clave1);
        $clave=trim($a[0]);
        
        $perini1 =$this->input->post('perini');
        $a= explode("-", $perini1);
        $aaai=trim($a[0]);
        $mesi=trim($a[1]);
        $diai=trim($a[2]);
        
        $perfin1 =$this->input->post('perfin');
        $a= explode("-", $perfin1);
        $aaaf=trim($a[0]);
        $mesf=trim($a[1]);
        $diaf=trim($a[2]);
        
        if($aaai == 2014){
            
        
        
        $this->db->select('a.tipo, a.nped, a.susa, a.costo, a.prv, a.prvx, a.folprv, a.cans, a.aaae, a.mese, a.diae, a.pedidor, u.respon, a.claves, a.tipo3, a.codigo, a.lote, a.caducidad, a.factura, a.nuevof');
        $this->db->from('almacen.compraped_l a');
        $this->db->join("almacen.users u", "a.pedidor=u.userID");
        $this->db->where('a.tipo3', 'C');
        
        if(isset($clave) && strlen(trim($clave)) > 0){
            $this->db->where('a.clave', $clave);
        }
        
        if(isset($proveedor) && strlen(trim($proveedor)) > 0){
            $this->db->where('a.prv', $proveedor);
        }
        
        if(isset($lot) && strlen(trim($lot)) > 0){
            $this->db->where('a.lote', $lot);
        }
        
        if(isset($tipo) && strlen(trim($tipo)) > 0){
            $this->db->where('a.tipo', $tipo);
        }

        if(isset($perini) && isset($perfin)){
            $this->db->where("a.aaae between '$aaai' and '$aaaf' and a.mese between '$mesi' and '$mesf' and a.diae between '$diai' and '$diaf'", null, false);
        }
        }elseif($aaai == 2013){
            
        $this->db->select('a.tipo, a.nped, a.susa, a.costo, a.prv, a.prvx, a.folprv, a.cans, a.aaae, a.mese, a.diae, a.pedidor, u.respon, a.claves, a.tipo3, a.codigo, a.lote, a.caducidad, a.factura, a.nuevof');
        $this->db->from('almacen.compraped_l13 a');
        $this->db->join("almacen.users u", "a.pedidor=u.userID");
        $this->db->where('a.tipo3', 'C');
        
        if(isset($clave) && strlen(trim($clave)) > 0){
            $this->db->where('a.clave', $clave);
        }
        
        if(isset($proveedor) && strlen(trim($proveedor)) > 0){
            $this->db->where('a.prv', $proveedor);
        }
        
        if(isset($lot) && strlen(trim($lot)) > 0){
            $this->db->where('a.lote', $lot);
        }
        
        if(isset($tipo) && strlen(trim($tipo)) > 0){
            $this->db->where('a.tipo', $tipo);
        }

        if(isset($perini) && isset($perfin)){
            $this->db->where("a.aaae between '$aaai' and '$aaaf' and a.mese between '$mesi' and '$mesf' and a.diae between '$diai' and '$diaf'", null, false);    
       }     
            
            
        }elseif($aaai == 2012){
            
        $this->db->select('a.tipo, a.nped, a.susa, a.costo, a.prv, a.prvx, a.folprv, a.cans, a.aaae, a.mese, a.diae, a.pedidor, u.respon, a.claves, a.tipo3, a.codigo, a.lote, a.caducidad, a.factura, a.nuevof');
        $this->db->from('almacen.compraped12 a');
        $this->db->join("almacen.users u", "a.pedidor=u.userID");
        $this->db->where('a.tipo3', 'C');
        
        if(isset($clave) && strlen(trim($clave)) > 0){
            $this->db->where('a.clave', $clave);
        }
        
        if(isset($proveedor) && strlen(trim($proveedor)) > 0){
            $this->db->where('a.prv', $proveedor);
        }
        
        if(isset($lot) && strlen(trim($lot)) > 0){
            $this->db->where('a.lote', $lot);
        }
        
        if(isset($tipo) && strlen(trim($tipo)) > 0){
            $this->db->where('a.tipo', $tipo);
        }

        if(isset($perini) && isset($perfin)){
            $this->db->where("a.aaae between '$aaai' and '$aaaf' and a.mese between '$mesi' and '$mesf' and a.diae between '$diai' and '$diaf'", null, false);    
       }     
            
        }else{
            
        }
        $q1 = $this->db->get();
        //echo $this->db->last_query();
        //echo die();
        
        return $q1;
    }
    
/////////////////////////////////////////////////////cedis/////////////////////////////////////////////////    
    
    function getDiasEntradas()
    {
        $sql = "SELECT
extract(year from fechai) as anio, extract(month from fechai) -1 as mes, extract(day from fechai) as dia
FROM desarrollo.compra_c c
where tipo = 'C'
group by anio, mes, dia
order by anio, mes, dia;";

        $q = $this->db->query($sql);
        
        $link_base = site_url('entradas/alma_cedis_detalle/');
        $a = null;
        
        if($q->num_rows() > 0)
        {
            
            
            foreach($q->result() as $r){
                
                $mes = $r->mes + 1;
                
                $link = $link_base . '/' .$r->anio . '-' . $mes  . '-' . $r->dia;
                
            $a .="{
                title: 'Entradas',
                start: new Date($r->anio, $r->mes, $r->dia),
                url: '$link'
            },
        ";
   
                
                
            }

        }
        
        return $a;
        

    }
    
    function getDiasEntradas3()
    {
        $sql = "SELECT
extract(year from fechai) as anio, extract(month from fechai) -1 as mes, extract(day from fechai) as dia
FROM desarrollo.compra_c c
where tipo = 'C' and prv=392
group by anio, mes, dia
order by anio, mes, dia;";

        $q = $this->db->query($sql);
        
        $link_base = site_url('entradas/alma_cedis_detalle1/');
        $a = null;
        
        if($q->num_rows() > 0)
        {
            
            
            foreach($q->result() as $r){
                
                $mes = $r->mes + 1;
                
                $link = $link_base . '/' .$r->anio . '-' . $mes  . '-' . $r->dia;
                
            $a .="{
                title: 'Entradas',
                start: new Date($r->anio, $r->mes, $r->dia),
                url: '$link'
            },
        ";
   
                
                
            }

        }
        
        return $a;
        

    }
    
    function entradas_almacedis($fec)
     {
        $sql = "SELECT c.id, c.orden, c.prv, p.razo, c.fac FROM desarrollo.compra_c c
                left join catalogo.provedor p on c.prv=p.prov
                where c.tipo = 'C' and date(c.fechai)='$fec'";
                
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        return $q;
     }
     
     function entradas_almacedis1($fec)
     {
        $sql = "SELECT c.id, c.orden, c.prv, p.razo, c.fac FROM desarrollo.compra_c c
                left join catalogo.provedor p on c.prv=p.prov
                where c.tipo = 'C' and c.prv=392 and date(c.fechai)='$fec'";
                
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        return $q;
     }
    
    function entradas_almacedis_det($id)
    {
        $sql= "SELECT a.sec, a.codigo, c.susa1, a.lote, a.cadu, a.can, a.orden FROM desarrollo.compra_d a
                left join catalogo.sec_generica c on c.sec=a.sec
                where id_cc=$id ";
                
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        return $q;
        
    }
    
    

/////////////////////////////////////////////////segpop////////////////////////////////////////////////

    function getDiasEntradas1()
    {
        $sql = "SELECT
aaas as anio, mess -1 as mes, dias as dia
FROM almacen.compraped_l c
where tipo3 = 'C'
group by anio, mes, dia
order by anio, mes, dia;";

        $q = $this->db->query($sql);
        
        $link_base = site_url('entradas/alma_segpop_detalle/');
        $a = null;
        
        if($q->num_rows() > 0)
        {
            
            
            foreach($q->result() as $r){
                
                $mes = $r->mes + 1;
                
                $link = $link_base . '/' .$r->anio . '-' . $mes  . '-' . $r->dia;
                
            $a .="{
                title: 'Entradas',
                start: new Date($r->anio, $r->mes, $r->dia),
                url: '$link'
            },
        ";
   
                
                
            }

        }
        
        return $a;
        

    }
    
    function getDiasEntradas4()
    {
        $sql = "SELECT
aaas as anio, mess -1 as mes, dias as dia
FROM almacen.compraped_l c
where tipo3 = 'C' and prv=392
group by anio, mes, dia
order by anio, mes, dia;";

        $q = $this->db->query($sql);
        
        $link_base = site_url('entradas/alma_segpop_detalle1/');
        $a = null;
        
        if($q->num_rows() > 0)
        {
            
            
            foreach($q->result() as $r){
                
                $mes = $r->mes + 1;
                
                $link = $link_base . '/' .$r->anio . '-' . $mes  . '-' . $r->dia;
                
            $a .="{
                title: 'Entradas',
                start: new Date($r->anio, $r->mes, $r->dia),
                url: '$link'
            },
        ";
   
                
                
            }

        }
        
        return $a;
        

    }
    
    function entradas_almasegpop($fec)
     {
        $sql = "SELECT c.tipo, c.nped, c.folprv, c.prv, c.prvx, c.factura, concat(aaae,'-', mese,'-', diae) as fecha FROM almacen.compraped_l c
                where c.tipo3 = 'C' and concat(aaas,'-', mess,'-', dias)='$fec' group by folprv";
                
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        return $q;
     }
     
     function entradas_almasegpop1($fec)
     {
        $sql = "SELECT c.tipo, c.nped, c.folprv, c.prv, c.prvx, c.factura, concat(aaae,'-', mese,'-', diae) as fecha FROM almacen.compraped_l c
                where c.tipo3 = 'C' and concat(aaas,'-', mess,'-', dias)='$fec' and prv=392 group by folprv";
                
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        return $q;
     }
    
    function entradas_almasegpop_det($nped)
    {
        $sql= "SELECT a.claves, a.codigo, a.susa, a.lote, a.caducidad, a.cans, a.folprv FROM almacen.compraped_l a
                where nped=$nped ";
                
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        return $q;
        
    }
    
/////////////////////////////////////////////////AGUASCALIENTES////////////////////////////////////////////////

    function getDiasEntradas2()
    {
        $sql = "SELECT extract(year from cerrado) as anio, extract(month from cerrado) -1 as mes, extract(day from cerrado) as dia 
        FROM aguascalientes.entradas_c e
        where estatus = 1
        group by anio, mes, dia
        order by anio, mes, dia;";

        $q = $this->db->query($sql);
        
        $link_base = site_url('entradas/alma_agu_detalle/');
        $a = null;
        
        if($q->num_rows() > 0)
        {
            
            
            foreach($q->result() as $r){
                
                $mes = $r->mes + 1;
                
                $link = $link_base . '/' .$r->anio . '-' . $mes  . '-' . $r->dia;
                
            $a .="{
                title: 'Entradas',
                start: new Date($r->anio, $r->mes, $r->dia),
                url: '$link'
            },
        ";
   
                
                
            }

        }
        
        return $a;
        

    }
    
    
    function entradas_almaaguas($fec)
     {
        $sql = "SELECT c.id, c.orden, p.razon, c.referencia FROM aguascalientes.entradas_c c
                left join aguascalientes.proveedores p on c.proveedor_id=p.id
                where c.estatus = 1 and date(c.cerrado)='$fec'";
                
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        return $q;
     }
    
    function entradas_almaaguas_det($id)
    {
        $sql= "SELECT p.clave, p.ean, p.susa, a.lote, a.caducidad, a.piezas, e.orden
                FROM aguascalientes.entradas a
                left join aguascalientes.productos p on p.id=a.p_id
                left join aguascalientes.entradas_c e on e.id=a.e_id
                where e_id=$id";
                
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        return $q;
        
    }
    
    
/////////////////////////////////////////////////AGUASCALIENTES////////////////////////////////////////////////

    function getDiasEntradas5()
    {
        $sql = "SELECT extract(year from cerrado) as anio, extract(month from cerrado) -1 as mes, extract(day from cerrado) as dia 
        FROM michoacan.entradas_c e
        where estatus = 1
        group by anio, mes, dia
        order by anio, mes, dia;";

        $q = $this->db->query($sql);
        
        $link_base = site_url('entradas/alma_mic_detalle/');
        $a = null;
        
        if($q->num_rows() > 0)
        {
            
            
            foreach($q->result() as $r){
                
                $mes = $r->mes + 1;
                
                $link = $link_base . '/' .$r->anio . '-' . $mes  . '-' . $r->dia;
                
            $a .="{
                title: 'Entradas',
                start: new Date($r->anio, $r->mes, $r->dia),
                url: '$link'
            },
        ";
   
                
                
            }

        }
        
        return $a;
        

    }
    
    
    function entradas_almamic($fec)
     {
        $sql = "SELECT c.id, c.orden, p.razon, c.referencia FROM michoacan.entradas_c c
                left join michoacan.proveedores p on c.proveedor_id=p.id
                where c.estatus = 1 and date(c.cerrado)='$fec'";
                
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        return $q;
     }
    
    function entradas_almamic_det($id)
    {
        $sql= "SELECT p.clave, p.ean, p.susa, a.lote, a.caducidad, a.piezas, e.orden
                FROM michoacan.entradas a
                left join michoacan.productos p on p.id=a.p_id
                left join michoacan.entradas_c e on e.id=a.e_id
                where e_id=$id";
                
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        return $q;
        
    }
    
    function gastos_suc ($id_plaza)
    {
        $sql="SELECT suc, nombre FROM catalogo.sucursal WHERE superv=$id_plaza";
        
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        return $q;
        
        
    }
    
    function gastos_x_suc ($suc)
    {
        $fa = $this->load->database('facturacion', true);
        
        $sql="SELECT g.*, c.descri, u.suc_id FROM facturacion.gastos_c g
            left join facturacion.`user` u on g.id_user=u.id
            left join catalogo.cuentas c on c.cuenta=g.gasto
            where suc_id=$suc and valida=1";
        
        $q = $fa->query($sql);
        //echo $fa->last_query();
        //die();
        return $q;
        
        
    }
    
    function gastos_x_suc1 ($suc)
    {
        $fa = $this->load->database('facturacion', true);
        
        $sql="SELECT g.id, suc, importe, id_concepto, concepto, fecha_gasto, valida
            FROM gastos_nodeducibles g
            left join catalogo.conceptos c on c.id=g.id_concepto
            where suc=$suc and valida=1";
        
        $q2 = $fa->query($sql);
        //echo $fa->last_query();
        //die();
        return $q2;
        
        
    }
    
    function reporte_conceptos($id)
    {
        $fa = $this->load->database('facturacion', true);
        
        $sql="SELECT * FROM facturacion.gastos_d where id_cc=$id";
        
        $q = $fa->query($sql);
        //echo $fa->last_query();
        //die();
        return $q;
        
    }
    
    function validaGasto($id)
    {
         $fa = $this->load->database('facturacion', true);
         
         $sql="update gastos_c set valida=2 where id=$id";
     
        $q = $fa->query($sql);
        //echo $fa->last_query();
        //die();
     
     return $q; 	 
     }

}
