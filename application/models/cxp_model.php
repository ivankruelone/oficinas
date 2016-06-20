<?php
class Cxp_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function sanitize($dato)
    {
        $in = array('Á', 'É', 'Í', 'Ó', 'Ú', 'Ó', 'Ã“', 'Ã', 'Ñ');
        $out = array('A', 'E', 'I', 'O', 'U', 'O', 'O', 'A', 'N');
        
        $dato = str_replace($in, $out, $dato);
        
        return $dato;
    }
    
    function __normalizaCedis()
    {
        $sql = "insert ignore into catalogo.cat_almacen_clasifica (sec, tipo, susa, descon, lin) (SELECT sec, '' as tipo, susa1 as susa, 'S' as descon, lin FROM catalogo.almacen a where tsec <> 'X' and sec in(SELECT sec FROM desarrollo.compra_c c, desarrollo.compra_d d where c.id = d.id_cc and c.fechai >= now() - interval 1 month and tipo = 'C' group by sec) group by sec);";
        $this->db->query($sql);
    }
    
    function __normalizaSeguroPopular()
    {
        $sql = "select *from chetumal2015.entradas_c a, catalogo.foliador1 b
where a.tipo=1 and a.subtipo=4  and a.estatus=1 and b.clav='fto' and nuevof=0;";
        
        $query = $this->db->query($sql);
        
        foreach($query->result() as $row)
        {
            $sql1 = "update chetumal2015.entradas_c a, catalogo.foliador1 b
set a.nuevof=b.num, b.num=b.num+1
where a.tipo=1 and a.subtipo=4 and a.estatus=1 and b.clav='fto' and a.id = ? and nuevof=0;";
            $this->db->query($sql1, $row->id);
        }


        $sql = "select *from patente.entradas_c a, catalogo.foliador1 b
where a.tipo=1 and a.subtipo=4  and a.estatus=1 and b.clav='fto' and nuevof=0;";
        
        $query = $this->db->query($sql);
        
        foreach($query->result() as $row)
        {
            $sql1 = "update patente.entradas_c a, catalogo.foliador1 b
set a.nuevof=b.num, b.num=b.num+1
where a.tipo=1 and a.subtipo=4 and a.estatus=1 and b.clav='fto' and a.id = ? and nuevof=0;";
            $this->db->query($sql1, $row->id);
        }
        
        $sql = "SELECT * FROM controlado.movimiento m, catalogo.foliador1 b where subtipoMovimiento = 1 and statusMovimiento = 1 and nuevo_folio = 0 and b.clav='fto';";
        
        $query = $this->db->query($sql);
        
        foreach($query->result() as $row)
        {
            $sql1 = "update
controlado.movimiento m, catalogo.foliador1 b
set m.nuevo_folio = b.num, b.num = b.num + 1
where subtipoMovimiento = 1 and statusMovimiento = 1 and b.clav='fto' and m.movimientoID = ?;";
            $this->db->query($sql1, $row->movimientoID);
        }
        
        $sql = "SELECT * FROM controlado.movimiento m, catalogo.foliador1 b where subtipoMovimiento = 3 and asignaFactura = 1 and statusMovimiento = 1 and nuevo_folio = 0 and b.clav='fto' group by referencia;";
        
        $query = $this->db->query($sql);
        
        foreach($query->result() as $row)
        {
            $sql1 = "update controlado.movimiento m, catalogo.foliador1 b
set m.nuevo_folio = b.num, b.num = b.num + 1
where subtipoMovimiento = 3 and asignaFactura = 1 and statusMovimiento = 1 and nuevo_folio = 0 and b.clav='fto' and referencia = ?;";

            $this->db->query($sql1, (string)$row->referencia);
        }

    }
    
    function writeCedis()
    {
        set_time_limit(0);
        ini_set('memory_limit','-1');
        
        $this->load->helper('file');
        
        $this->__normalizaCedis();
        
        $data = $this->__getDataCedis();
        
        if ( ! write_file('./txt/cedis.txt', $data))
        {
             return '<p>Error al generar archivo Cedis.</p>';
        }
        else
        {
             return '<p>Archivo Cedis generado correctamente.</p>';
        }
    }
    
    function writeSeguroPopular()
    {
        set_time_limit(0);
        ini_set('memory_limit','-1');
        
        $this->load->helper('file');
        
        $this->__normalizaSeguroPopular();
        
        $data = $this->__getDataSeguroPopular();
        
        if ( ! write_file('./txt/seguro_popular.txt', $data))
        {
             return '<p>Error al generar archivo Seguro Popular.</p>';
        }
        else
        {
             return '<p>Archivo Seguro Popular generado correctamente.</p>';
        }
    }

    function uploadCedis($archivo)
    {
        $this->load->library('ftp');
        
        $config['hostname'] = '192.168.1.3';
        $config['username'] = 'lidia';
        $config['password'] = 'puepue19';
        $config['debug'] = TRUE;
        
        $this->ftp->connect($config);
        
        $this->ftp->upload('./txt/'.$archivo.'.txt', 'awsdata012/xlicxp', 'ascii');
        
        $this->ftp->close(); 
    }
    
    function uploadSeguroPopular($archivo)
    {
        $this->load->library('ftp');
        
        $config['hostname'] = '192.168.1.3';
        $config['username'] = 'lidia';
        $config['password'] = 'puepue19';
        $config['debug'] = TRUE;
        
        $this->ftp->connect($config);
        
        $this->ftp->upload('./txt/'.$archivo.'.txt', 'awsdata012/xlscxp', 'ascii');
        
        $this->ftp->close(); 
    }

    function __getDataCedis()
    {
        $data = null;
        $data .= $this->__getCompraCedis();
        $data .= $this->__getComprasMetro();
        return $data;
    }
    
    function __getCompraCedis()
    {
        $sql = "SELECT fechai, a.cxp,a.prv,a.fac,date_format(a.fechai,'%Y')as aaa, date_format(a.fechai,'%m')as mes , u.nombre,
date_format(a.fechai,'%d')as dia,a.orden,
b.codigo,b.sec,b.can,

ifnull((SELECT costo
FROM compras.orden_c x
join compras.orden_d  y on x.id_orden=y.id_orden and id_estado=7
where folprv=a.orden and y.sec=b.sec
group by sec),0)as costo, b.costo as costo2
,a.id_user,

m.lin,m.susa,
ifnull((SELECT susa2
FROM compras.orden_c x
join compras.orden_d  y on x.id_orden=y.id_orden and id_estado=7
where folprv=a.orden and y.sec=b.sec
group by sec),'')as descri,b.canr
from desarrollo.compra_c a
join desarrollo.compra_d_fac_sec b on a.id=b.id_cc
join catalogo.cat_almacen_clasifica m on m.sec=b.sec
left join desarrollo.usuarios u on id_user = u.id
where a.tipo='C'  and fechai >= now() - interval 1 month;";
        
        $query = $this->db->query($sql);
        
        $data = null;
        
        foreach($query->result() as $row)
        {
            $data .= str_pad('NO',2)
.str_pad($row->cxp,9,"0",STR_PAD_LEFT)
.str_pad('00000900',8,"0",STR_PAD_LEFT)
.str_pad($row->prv,4,"0",STR_PAD_LEFT)
.str_pad(substr($row->fac,0,10),10," ",STR_PAD_RIGHT)
.str_pad($row->aaa,4,"0",STR_PAD_LEFT)
.str_pad($row->mes,2,"0",STR_PAD_LEFT)
.str_pad($row->dia,2,"0",STR_PAD_LEFT)
.str_pad('13',2,"0",STR_PAD_LEFT)
.str_pad($row->orden,9,"0",STR_PAD_LEFT)
.str_pad(substr($row->codigo, 0, 13),13,"0",STR_PAD_LEFT)
.str_pad($row->sec,4,"0",STR_PAD_LEFT)
.str_pad($row->can,7,"0",STR_PAD_LEFT)
.str_pad(round($row->costo2*100),11,"0",STR_PAD_LEFT)
.str_pad($row->lin,2,"0",STR_PAD_LEFT)
.str_pad($row->id_user,6,"0",STR_PAD_LEFT)
.str_pad(substr($row->nombre,0,30),30," ",STR_PAD_RIGHT)
.str_pad($row->orden,9,"0",STR_PAD_LEFT)
.str_pad(substr($row->susa,0,40),40," ",STR_PAD_RIGHT)
.str_pad(substr($row->descri,0,40),40," ",STR_PAD_RIGHT)
.str_pad($row->canr,7,"0",STR_PAD_LEFT)
."\r\n";
        }
        
        return $data;
    }
    
    function __getComprasMetro()
    {
        $sql = "SELECT b.foliocxp,'NO' as var1,b.id,100 as suc,b.prv,b.prv, trim(left(b.factura,10)) as factura,
extract(year from b.fecha)as aaas,
extract(month from b.fecha)as mess,
extract(day from b.fecha)as dias,
b.cia,b.orden,c.codigo,trim(a.clave)as clave,
sum(a.can)as can,a.costo,
c.lin,c.sublin,
1 as per,'METRO'as perx,b.orden,c.susa1,
sum(a.canr) as canr

FROM metro.compra_d a
left join metro.compra_c b on a.id_cc=b.id
left join catalogo.sec_generica_t c on c.sec=a.clave
where b.tipo=1 and b.fecha >= now() - interval 1 month and foliocxp>0 and b.prv<>400 and b.prv<>221 and b.prv<>825 and c.sec<9999
group by a.id_cc, a.clave;";

        $query = $this->db->query($sql);
        
        $data = null;
        
        foreach($query->result() as $row)
        {
            if($row->foliocxp == 0)
            {
                $folcxp = $row->id;
            }else{
                $folcxp = $row->foliocxp;
            }
            	
    $data .= str_pad('NO',2)
        .str_pad($folcxp,9,"0",STR_PAD_LEFT)
        .str_pad($row->suc,8,"0",STR_PAD_LEFT)
        .str_pad($row->prv,4,"0",STR_PAD_LEFT)
        .str_pad(substr($row->factura,0,10),10," ",STR_PAD_RIGHT)
        .str_pad($row->aaas,4,"0",STR_PAD_LEFT)
        .str_pad($row->mess,2,"0",STR_PAD_LEFT)
        .str_pad($row->dias,2,"0",STR_PAD_LEFT)
        .str_pad($row->cia,2,"0",STR_PAD_LEFT)
        .str_pad($row->orden,9,"0",STR_PAD_LEFT)
        .str_pad(substr($row->codigo, 0, 13),13,"0",STR_PAD_LEFT)
        .str_pad($row->clave,4,"0",STR_PAD_LEFT)
        .str_pad($row->can,7,"0",STR_PAD_LEFT)
        .str_pad(round($row->costo*100),11,"0",STR_PAD_LEFT)
        .str_pad($row->lin,2,"0",STR_PAD_LEFT)
        .str_pad($row->per,6,"0",STR_PAD_LEFT)
        .str_pad(substr($row->perx, 0, 30),30)
        .str_pad($row->orden,9,"0",STR_PAD_LEFT)
        .str_pad(substr($row->susa1,0,40),40)
        .str_pad(substr($row->susa1,0,40),40)
        .str_pad($row->canr,7,"0",STR_PAD_LEFT)
        ."\r\n";        
        }
        
        return $data;
    }
    
    function __getDataSeguroPopular()
    {
        $data = null;
        $data .= $this->__getCompraChetumal();
        $data .= $this->__getCompraPatente();
        $data .= $this->__getCompraControlado();
        $data .= $this->__getCompraSPCentral();
        $data .= $this->__getCompraPatente2();
        $data .= $this->__getCompraped_l();
        $data .= $this->__getCompraMichoacan2016();
        return $data;
    }

    function __getCompraChetumal()
    {
        $sql = utf8_encode("SELECT 'CHT' as tipo, 0 as sec, a.orden as nped, year(a.fec_doc) as aaap, month(a.fec_doc) as mesp, day(a.fec_doc) as diap, LEFT(replace(c.susa, 'Ñ', 'N'), 100)as susa, left(trim(c.descripcion),100) as descri, round(precio, 2) as costo, case when d.npro>9999 then 9998 else d.npro end as prv, d.razon as prvx, '' as persona, substr(a.orden,1,9) as folprv,
case when c.iva=0 then 1 when c.iva=1 then 5 end as lin, case when c.iva=0 then 1 when c.iva=1 then 5 end as subli, sum(b.piezas) as cans, 0 as canres,
year(a.fec_doc) as aaae, month(a.fec_doc) as mese, day(a.fec_doc) as diae, year(a.cerrado) as aaas, month(a.cerrado) as mess, day(a.cerrado) as dias, user_id as pedidor, user_id as surtidor,
case when c.tipo_producto = 2 then trim(replace(c.clave, '.', '')) * 1 else trim(c.clave) end as claves, 
case when c.tipo_producto = 2 then trim(replace(c.clave, '.', '')) * 1 else trim(c.clave) end as clavep, estatus as tipo3, b.ean as codigo, '1' as cia, 0 as cansc,
a.referencia as factura, a.nuevof
FROM chetumal2015.entradas_c a
left join chetumal2015.entradas b on a.id=b.e_id
left join chetumal2015.productos c on b.p_id=c.id
left join chetumal2015.proveedores d on a.proveedor_id=d.id
where subtipo=4 and estatus=1 and cerrado >= now() - interval 3 month and nuevof>0 and a.referencia not like '%RECIBA%'
group by c.clave, nuevof
order by factura, clave;");
        
        $query = $this->db->query($sql);
        
        $data = null;
        
        foreach($query->result() as $row)
        {
            $data .= str_pad($row->tipo,3)
.str_pad($row->nuevof,9,"0",STR_PAD_LEFT)
.str_pad($row->prv,4,"0",STR_PAD_LEFT)
.str_pad(substr($row->factura,0,10),10," ",STR_PAD_RIGHT)
.str_pad($row->aaae,4,"0",STR_PAD_LEFT)
.str_pad($row->mese,2,"0",STR_PAD_LEFT)
.str_pad($row->diae,2,"0",STR_PAD_LEFT)
.str_pad($row->aaas,4,"0",STR_PAD_LEFT)
.str_pad($row->mess,2,"0",STR_PAD_LEFT)
.str_pad($row->dias,2,"0",STR_PAD_LEFT)
.str_pad($row->cia,2,"0",STR_PAD_LEFT)
.str_pad($row->folprv,9,"0",STR_PAD_LEFT)
.str_pad($row->claves,15," ",STR_PAD_RIGHT)
.str_pad($row->clavep,15," ",STR_PAD_RIGHT)
.str_pad($row->cans,7,"0",STR_PAD_LEFT)
.str_pad(($row->costo*100),11,"0",STR_PAD_LEFT)
.str_pad($row->lin,2,"0",STR_PAD_LEFT)
.str_pad($row->pedidor,3,"0",STR_PAD_LEFT)
.str_pad('',20).str_pad($row->nped,9,"0",STR_PAD_LEFT)
.str_pad($this->sanitize(TRIM($row->susa)),100, " ", STR_PAD_RIGHT)
.str_pad($row->cansc,4,"0",STR_PAD_LEFT)
."\r\n";
        }
        
        return $data;
    }
    
    function __getCompraPatente()
    {
        $sql = utf8_encode("SELECT 'PAT' as tipo, 0 as sec, a.orden as nped, year(a.fec_doc) as aaap, month(a.fec_doc) as mesp, day(a.fec_doc) as diap, convert(LEFT(replace(c.susa, 'Ñ', 'N'), 100) using ascii) as susa, left(trim(c.descripcion),100) as descri, round(precio, 2) as costo, case when d.npro>9999 then 9998 else d.npro end as prv, d.razon as prvx, '' as persona, substr(a.orden,1,9) as folprv,
case when c.iva=0 then 1 when c.iva=1 then 5 end as lin, case when c.iva=0 then 1 when c.iva=1 then 5 end as subli, sum(b.piezas) as cans, 0 as canres,
year(a.fec_doc) as aaae, month(a.fec_doc) as mese, day(a.fec_doc) as diae, year(a.cerrado) as aaas, month(a.cerrado) as mess, day(a.cerrado) as dias, user_id as pedidor, user_id as surtidor,
case when c.tipo_producto = 2 then trim(replace(c.clave, '.', '')) * 1 else trim(c.clave) end as claves,
case when c.tipo_producto = 2 then trim(replace(c.clave, '.', '')) * 1 else trim(c.clave) end as clavep, estatus as tipo3, b.ean as codigo, '1' as cia, 0 as cansc,
a.referencia as factura, a.nuevof
FROM patente.entradas_c a
left join patente.entradas b on a.id=b.e_id
left join patente.productos c on b.p_id=c.id
left join patente.proveedores d on a.proveedor_id=d.id
where subtipo=4 and estatus=1 and cerrado >= now() - interval 3 month and nuevof>0
group by c.clave, nuevof;");

        $query = $this->db->query($sql);
        
        $data = null;
        
        foreach($query->result() as $row)
        {
            $data .= str_pad($row->tipo,3)
.str_pad($row->nuevof,9,"0",STR_PAD_LEFT)
.str_pad($row->prv,4,"0",STR_PAD_LEFT)
.str_pad(substr($row->factura,0,10),10," ",STR_PAD_RIGHT)
.str_pad($row->aaae,4,"0",STR_PAD_LEFT)
.str_pad($row->mese,2,"0",STR_PAD_LEFT)
.str_pad($row->diae,2,"0",STR_PAD_LEFT)
.str_pad($row->aaas,4,"0",STR_PAD_LEFT)
.str_pad($row->mess,2,"0",STR_PAD_LEFT)
.str_pad($row->dias,2,"0",STR_PAD_LEFT)
.str_pad($row->cia,2,"0",STR_PAD_LEFT)
.str_pad($row->folprv,9,"0",STR_PAD_LEFT)
.str_pad($row->claves,15," ",STR_PAD_RIGHT)
.str_pad($row->clavep,15," ",STR_PAD_RIGHT)
.str_pad($row->cans,7,"0",STR_PAD_LEFT)
.str_pad(($row->costo*100),11,"0",STR_PAD_LEFT)
.str_pad($row->lin,2,"0",STR_PAD_LEFT)
.str_pad(substr($row->pedidor, -1, 3),3,"0",STR_PAD_LEFT)
.str_pad('',20).str_pad($row->nped,9,"0",STR_PAD_LEFT)
.str_pad(substr(utf8_decode($row->susa),0,100),100," ",STR_PAD_RIGHT)
.str_pad($row->cansc,4,"0",STR_PAD_LEFT)
."\r\n";

        }
        
        return $data;
    }
    
    function __getCompraControlado()
    {
        $sql = "SELECT *, year(m.fecha) as aaae, month(m.fecha) as mese, day(m.fecha) as diae, year(fechaCierre) as aaas, month(fechaCierre) as mess, day(fechaCierre) as dias, case when tipoprod = 0 then 1 else 5 end as lin, cast(round(costo * 100) as char(11)) as costof, sum(piezas) as piezasF
FROM controlado.movimiento m
join controlado.movimiento_detalle d using(movimientoID)
join controlado.articulos a using(id)
where ((subtipoMovimiento = 1) or (subtipoMovimiento = 3 and asignaFactura = 1 and nuevo_folio > 0)) and statusMovimiento = 1 and nuevo_folio > 0 and fechaCierre >= now() - interval 3 month
group by nuevo_folio, cvearticulo;";
        
        $query = $this->db->query($sql);

        $data = null;
        
        foreach($query->result() as $row)
        {
            
            if(strlen((string)$row->proveedorID) > 4)
            {
                $proveedor = 9998;
            }else{
                $proveedor = $row->proveedorID;
            }


$data .= str_pad('ESP',3)//Tipo
.str_pad($row->nuevo_folio,9,"0",STR_PAD_LEFT)
.str_pad($proveedor,4,"0",STR_PAD_LEFT)
.str_pad(substr($row->referencia,0,10),10," ",STR_PAD_RIGHT)
.str_pad($row->aaae,4,"0",STR_PAD_LEFT)
.str_pad($row->mese,2,"0",STR_PAD_LEFT)
.str_pad($row->diae,2,"0",STR_PAD_LEFT)
.str_pad($row->aaas,4,"0",STR_PAD_LEFT)
.str_pad($row->mess,2,"0",STR_PAD_LEFT)
.str_pad($row->dias,2,"0",STR_PAD_LEFT)
.str_pad(1,2,"0",STR_PAD_LEFT)//cia
.str_pad($row->orden,9,"0",STR_PAD_LEFT)
.str_pad($row->cvearticulo,15," ",STR_PAD_RIGHT)
.str_pad($row->cvearticulo,15," ",STR_PAD_RIGHT)
.str_pad((double)$row->piezasF,7,"0",STR_PAD_LEFT)
.str_pad($row->costof,11,"0",STR_PAD_LEFT)
.str_pad($row->lin,2,"0",STR_PAD_LEFT)
.str_pad(substr($row->usuario, -1, 3),3,"0",STR_PAD_LEFT)
.str_pad('',20).str_pad($row->orden,9,"0",STR_PAD_LEFT)
.str_pad(substr($this->sanitize($row->susa . ' ' . $row->descripcion . ' ' . $row->pres),0,100),100," ",STR_PAD_RIGHT)
.str_pad(0,4,"0",STR_PAD_LEFT)//cantidad de regalo
."\r\n";
            
        }
        
        return $data;
    }
    
    function __getCompraSPCentral()
    {
        $sql = "SELECT *, year(m.fecha) as aaae, month(m.fecha) as mese, day(m.fecha) as diae, year(fechaCierre) as aaas, month(fechaCierre) as mess, day(fechaCierre) as dias, case when tipoprod = 0 then 1 else 5 end as lin, cast(round(costo * 100) as char(11)) as costof, sum(piezas) as piezasF
FROM spcentral.movimiento m
join spcentral.movimiento_detalle d using(movimientoID)
join spcentral.articulos a using(id)
where ((subtipoMovimiento = 1) or (subtipoMovimiento = 3 and asignaFactura = 1 and nuevo_folio > 0)) and statusMovimiento = 1 and nuevo_folio > 0 and fechaCierre >= now() - interval 3 month
group by nuevo_folio, cvearticulo;";
        
        $query = $this->db->query($sql);

        $data = null;
        
        foreach($query->result() as $row)
        {
            
            if(strlen((string)$row->proveedorID) > 4)
            {
                $proveedor = 9998;
            }else{
                $proveedor = $row->proveedorID;
            }


$data .= str_pad('ESP',3)//Tipo
.str_pad($row->nuevo_folio,9,"0",STR_PAD_LEFT)
.str_pad($proveedor,4,"0",STR_PAD_LEFT)
.str_pad(substr($row->referencia,0,10),10," ",STR_PAD_RIGHT)
.str_pad($row->aaae,4,"0",STR_PAD_LEFT)
.str_pad($row->mese,2,"0",STR_PAD_LEFT)
.str_pad($row->diae,2,"0",STR_PAD_LEFT)
.str_pad($row->aaas,4,"0",STR_PAD_LEFT)
.str_pad($row->mess,2,"0",STR_PAD_LEFT)
.str_pad($row->dias,2,"0",STR_PAD_LEFT)
.str_pad(1,2,"0",STR_PAD_LEFT)//cia
.str_pad($row->orden,9,"0",STR_PAD_LEFT)
.str_pad($row->cvearticulo,15," ",STR_PAD_RIGHT)
.str_pad($row->cvearticulo,15," ",STR_PAD_RIGHT)
.str_pad((double)$row->piezasF,7,"0",STR_PAD_LEFT)
.str_pad($row->costof,11,"0",STR_PAD_LEFT)
.str_pad($row->lin,2,"0",STR_PAD_LEFT)
.str_pad(substr($row->usuario, -1, 3),3,"0",STR_PAD_LEFT)
.str_pad('',20).str_pad($row->orden,9,"0",STR_PAD_LEFT)
.str_pad(substr($this->sanitize($row->susa . ' ' . $row->descripcion . ' ' . $row->pres),0,100),100," ",STR_PAD_RIGHT)
.str_pad(0,4,"0",STR_PAD_LEFT)//cantidad de regalo
."\r\n";
            
        }
        
        return $data;
    }

    function remplaza($in)
    {
        $out = preg_replace('/[^A-Z0-9 \/-]/', '', $in);
        return $out;
    }

    function __getCompraMichoacan2016()
    {

        $mich = $this->load->database('michoacan2016', TRUE);

        $sql = "SELECT *, year(m.fecha) as aaae, month(m.fecha) as mese, day(m.fecha) as diae, year(fechaCierre) as aaas, month(fechaCierre) as mess, day(fechaCierre) as dias, case when tipoprod = 0 then 1 else 5 end as lin, cast(round(costo * 100) as char(11)) as costof, sum(piezas) as piezasF
FROM fenixtch_michoacan.movimiento m
join fenixtch_michoacan.movimiento_detalle d using(movimientoID)
join fenixtch_michoacan.articulos a using(id)
where ((subtipoMovimiento = 1) or (subtipoMovimiento = 3 and asignaFactura = 1 and nuevo_folio > 0)) and statusMovimiento = 1 and nuevo_folio > 0 and fechaCierre >= now() - interval 3 month
group by nuevo_folio, cvearticulo;";
        
        $query = $mich->query($sql);

        $data = null;
        
        foreach($query->result() as $row)
        {
            
            if(strlen((string)$row->proveedorID) > 4)
            {
                $proveedor = 9998;
            }else{
                $proveedor = $row->proveedorID;
            }


$data .= str_pad('MIC',3)//Tipo
.str_pad($row->nuevo_folio,9,"0",STR_PAD_LEFT)
.str_pad($proveedor,4,"0",STR_PAD_LEFT)
.str_pad(substr($row->referencia,0,10),10," ",STR_PAD_RIGHT)
.str_pad($row->aaae,4,"0",STR_PAD_LEFT)
.str_pad($row->mese,2,"0",STR_PAD_LEFT)
.str_pad($row->diae,2,"0",STR_PAD_LEFT)
.str_pad($row->aaas,4,"0",STR_PAD_LEFT)
.str_pad($row->mess,2,"0",STR_PAD_LEFT)
.str_pad($row->dias,2,"0",STR_PAD_LEFT)
.str_pad(1,2,"0",STR_PAD_LEFT)//cia
.str_pad($row->orden,9,"0",STR_PAD_LEFT)
.str_pad($row->cvearticulo,15," ",STR_PAD_RIGHT)
.str_pad($row->cvearticulo,15," ",STR_PAD_RIGHT)
.str_pad((double)$row->piezasF,7,"0",STR_PAD_LEFT)
.str_pad($row->costof,11,"0",STR_PAD_LEFT)
.str_pad($row->lin,2,"0",STR_PAD_LEFT)
.str_pad(substr($row->usuario, -1, 3),3,"0",STR_PAD_LEFT)
.str_pad('',20).str_pad($row->orden,9,"0",STR_PAD_LEFT)
.str_pad(substr($this->remplaza($this->sanitize($row->susa . ' ' . $row->descripcion . ' ' . $row->pres)),0,100),100," ",STR_PAD_RIGHT)
.str_pad(0,4,"0",STR_PAD_LEFT)//cantidad de regalo
."\r\n";
            
        }
        
        return $data;
    }

    function __getCompraPatente2()
    {
        $sql = "SELECT *, year(m.fecha) as aaae, month(m.fecha) as mese, day(m.fecha) as diae, year(fechaCierre) as aaas, month(fechaCierre) as mess, day(fechaCierre) as dias, case when tipoprod = 0 then 1 else 5 end as lin, cast(round(costo * 100) as char(11)) as costof, CONVERT(trim(concat(ifnull(a.susa, ' '), ' ', ifnull(a.descripcion, ' '), ' ', ifnull(a.pres, ' '))) using ascii) as descripcionLarga, sum(piezas) as piezasF
FROM patente2.movimiento m
join patente2.movimiento_detalle d using(movimientoID)
join patente2.articulos a using(id)
where ((subtipoMovimiento = 1) or (subtipoMovimiento = 3 and asignaFactura = 1 and nuevo_folio > 0)) and statusMovimiento = 1 and nuevo_folio > 0 and fechaCierre >= now() - interval 3 month
group by nuevo_folio, cvearticulo;";
        
        $query = $this->db->query($sql);

        $data = null;
        
        foreach($query->result() as $row)
        {
            
            if(strlen((string)$row->proveedorID) > 4)
            {
                $proveedor = 9998;
            }else{
                $proveedor = $row->proveedorID;
            }


$data .= str_pad('ESP',3)//Tipo
.str_pad($row->nuevo_folio,9,"0",STR_PAD_LEFT)
.str_pad($proveedor,4,"0",STR_PAD_LEFT)
.str_pad(substr($row->referencia,0,10),10," ",STR_PAD_RIGHT)
.str_pad($row->aaae,4,"0",STR_PAD_LEFT)
.str_pad($row->mese,2,"0",STR_PAD_LEFT)
.str_pad($row->diae,2,"0",STR_PAD_LEFT)
.str_pad($row->aaas,4,"0",STR_PAD_LEFT)
.str_pad($row->mess,2,"0",STR_PAD_LEFT)
.str_pad($row->dias,2,"0",STR_PAD_LEFT)
.str_pad(1,2,"0",STR_PAD_LEFT)//cia
.str_pad($row->orden,9,"0",STR_PAD_LEFT)
.str_pad($row->cvearticulo,15," ",STR_PAD_RIGHT)
.str_pad($row->cvearticulo,15," ",STR_PAD_RIGHT)
.str_pad((double)$row->piezasF,7,"0",STR_PAD_LEFT)
.str_pad($row->costof,11,"0",STR_PAD_LEFT)
.str_pad($row->lin,2,"0",STR_PAD_LEFT)
.str_pad(substr($row->usuario, -1, 3),3,"0",STR_PAD_LEFT)
.str_pad('',20).str_pad($row->orden,9,"0",STR_PAD_LEFT)
.str_pad(substr($this->sanitize($row->descripcionLarga),0,100),100," ",STR_PAD_RIGHT)
.str_pad(0,4,"0",STR_PAD_LEFT)//cantidad de regalo
."\r\n";
            
        }
        
        return $data;
    }

    function __getCompraped_l()
    {
       $aaa=date('Y');
       $mes=date('m')-1;
        $sql = "SELECT UPPER(tipo)as var, sec, nped, aaap, mesp, diap,
    convert(trim(LEFT(susa, 100)) using ascii) as susa, descri, round(costo*100)as costo, prv, prvx, persona, folprv, lin, sublin,
     sum(cans)as cans, canres, aaae, mese, diae, aaas, mess, dias,
     pedidor, surtidor, id, trim(claves)as claves, trim(clavep)as clavep, tipo3, codigo, cia, sum(canss)as canss, factura, nuevof

from almacen.compraped_l  a where stat1='C' and aaas=$aaa and mess>=$mes
 group by a.claves, a.nuevof";
        
        $query = $this->db->query($sql);

        $data = null;
        
        foreach($query->result() as $row)
        {
            

$data .= str_pad($row->var,3)//Tipo
.str_pad($row->nuevof,9,"0",STR_PAD_LEFT)
.str_pad($row->prv,4,"0",STR_PAD_LEFT)
.str_pad(substr($row->factura,0,10),10," ",STR_PAD_RIGHT)
.str_pad($row->aaae,4,"0",STR_PAD_LEFT)
.str_pad($row->mese,2,"0",STR_PAD_LEFT)
.str_pad($row->diae,2,"0",STR_PAD_LEFT)
.str_pad($row->aaas,4,"0",STR_PAD_LEFT)
.str_pad($row->mess,2,"0",STR_PAD_LEFT)
.str_pad($row->dias,2,"0",STR_PAD_LEFT)
.str_pad($row->cia,2,"0",STR_PAD_LEFT)//cia
.str_pad($row->folprv,9,"0",STR_PAD_LEFT)
.str_pad($row->claves,15," ",STR_PAD_RIGHT)
.str_pad($row->claves,15," ",STR_PAD_RIGHT)
.str_pad((double)$row->cans,7,"0",STR_PAD_LEFT)
.str_pad($row->costo,11,"0",STR_PAD_LEFT)
.str_pad($row->lin,2,"0",STR_PAD_LEFT)
.str_pad(substr($row->pedidor, -1, 3),3,"0",STR_PAD_LEFT)
.str_pad('',20).str_pad($row->nped,9,"0",STR_PAD_LEFT)
.str_pad(substr($this->sanitize($row->susa),0,100),100," ",STR_PAD_RIGHT)
.str_pad($row->canss,4,"0",STR_PAD_LEFT)//cantidad de regalo
."\r\n";
            
        }
        
        return $data;
    }
    
}