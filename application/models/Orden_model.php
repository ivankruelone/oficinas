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
            $cia = $this->__busca_cia();
            foreach ($q->result() as $r) {
                //fechag, clasi, almacen, almacenx, impo
                $a[$r->id_ped]['segundo'][$r->prv]['cia'] = $cia;
                $a[$r->id_ped]['segundo'][$r->prv]['id_ped'] = $r->id_ped;
                $a[$r->id_ped]['segundo'][$r->prv]['fecha_ped'] = $r->fecha_ped;
                $a[$r->id_ped]['segundo'][$r->prv]['var'] = $r->var;
                $a[$r->id_ped]['segundo'][$r->prv]['prv'] = $r->prv;
                $a[$r->id_ped]['segundo'][$r->prv]['prvx'] = $r->prvx;
                $a[$r->id_ped]['segundo'][$r->prv]['tercero'][$r->almacen]['almacen'] = $r->
                    almacen;
                $a[$r->id_ped]['segundo'][$r->prv]['tercero'][$r->almacen]['impo'] = $r->impo;
            }
        } else {
            $a = 0;
        }
        return $a;
    }
    public function orden_compra_detalle($prv, $id_ped)
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
                $res = $this->__busca_prv_clave($r->clagob, $r->sec);
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
    function __busca_prv_clave($cla, $sec)
    {
        $sql = "SELECT a.*,b.corto FROM catalogo.cat_nuevo_general_prv a
        left join catalogo.provedor b on b.prov=a.prv 
        where a.tipo='A' and a.clagob='$cla' and a.sec=$sec";

        $query = $this->db->query($sql);
        $res = array();
        $res[0] = "Selecciona un Provedor";

        foreach ($query->result() as $row) {
            $res[$row->id] = $row->costo . ' ' . $row->corto;
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

        foreach ($query->result() as $row) {
            $res[$row->cia] = $row->razon;
        }

        return $res;
    }
    public function cambia($id_catalogo, $prv, $id_ped, $sec, $clagob)
    {
        $userid = $this->session->userdata('id');
        $m = "select a.*,b.corto from catalogo.cat_nuevo_general_prv a 
        left join catalogo.provedor b on b.prov=a.prv where a.id=$id_catalogo";
        $q = $this->db->query($m);
        if ($q->num_rows() > 0) {
            $r = $q->row();


            $data = array(
                'prv' => $r->prv,
                'codigo' => $r->codigo,
                'costo' => $r->costo);
            $this->db->where('id_ped', $id_ped);
            $this->db->where('prv', $prv);
            $this->db->where('tipo', 'A');
            $this->db->where('clagob', $clagob);
            $this->db->where('sec', $sec);
            $this->db->update('compras.orden_d', $data);

            $m1 = "insert ignore into orden_c(almacen, prv, prvx, fechag, tipo, fechae, id_userg, id_usere, cia, id_ped, fecha_ped,  folprv)
        (select almacen, $r->prv, '$r->corto', fechag, tipo, fechae, id_userg, id_usere, cia, id_ped, fecha_ped,  folprv 
        from orden_c where id_ped=$id_ped and prv=$prv and tipo='A')";
            $this->db->query($m1);

        }
    }
    public function cerrar($prv, $id_ped, $cia, $tipo)
    {
        $userid = $this->session->userdata('id');
        $m = "select adddate(date(now()),20)as limite a.*from catalogo.fol_nuevo a where tipo='$tipo'";
        $q = $this->db->query($m);
        if ($q->num_rows() > 0) {
            $r = $q->row();

            
            $data = array(
                'tipo' => 'C',
                'fecha_envio' => date('Y-m-d'),
                'folprv' => $r->num,
                'cia' => $cia,
                'fecha_limite' => $r->limite,
                'id_usere' => $this->session->userdata('id'));
            $this->db->where('id_ped', $id_ped);
            $this->db->where('prv', $prv);
            $this->db->where('tipo', 'A');
            $this->db->update('compras.orden_c', $data);

            $data = array(
                'tipo' => 'C',
                'fecha_envio' => date('Y-m-d'),
                'fecha_limite' => $r->limite);
            $this->db->where('id_ped', $id_ped);
            $this->db->where('prv', $prv);
            $this->db->where('tipo', 'A');
            $this->db->update('compras.orden_d', $data);
            $m1 = "update catalogo.fol_nuevo set num=$r->num+1 where tipo='$tipo'";
            $this->db->query($m1);
        }
    }
    public function historico()
    {
        $s = "select a.*, sum(b.cans*b.costo)as impo from orden_c a
left join orden_d b on b.id_ped=a.id_ped and b.prv=a.prv and a.almacen=b.almacen
where a.tipo='C'
group by a.id_ped,a.prv,a.almacen
order by fechag desc limit 200";
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
                $a[$r->folprv]['segundo'][$r->almacen]['almacen'] = $r->almacen;
                $a[$r->folprv]['segundo'][$r->almacen]['impo'] = $r->impo;
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
        $fec = date('Y-m-d H:i:s');
        $s = "select a.fecha_envio as fechaee, a.*,b.*,c.razon as razonx, c.razon as razonx, 
    c.dire as direx, c.col,c.pobla as poblax,c.cp as cpx,
    c.rfc as rfcx
    from orden_c a 
    left join catalogo.provedor b on b.prov=a.prv
    left join catalogo.compa c on c.cia=a.cia
    where folprv=$folprv";
        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $r = $q->row();
            $l0 = '<img src="' . base_url() . 'img/logo.png" border="0" width="200px" />';
            $a = "<table>
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

        } else {
            $a = '';
        }
        return $a;

    }
    public function imprime($folprv, $imagen, $nombre)
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
                $a[$r->sec]['segundo'][$r->almacen]['iva'] = $r->iva;
                $a[$r->sec]['segundo'][$r->almacen]['costo'] = $r->costo;
                $a[$r->sec]['segundo'][$r->almacen]['impo'] = $r->impo;
            }
        } else {
            $a = 0;
        }
        return $a;
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////cambios despues de cerrar folio
    function order_mes()
    {
        $s = "SELECT year(fecha_envio)as aaa,month(fecha_envio)as mes, count(*) as ordenes 
FROM orden_c a group by year(fecha_envio),month(fecha_envio) 
order by year(fecha_envio) desc,month(fecha_envio) desc";
        $q = $this->db->query($s);
        return $q;
    }
    function order_cambia($aaa, $mes)
    {
        $s = "SELECT a.id_orden,a.*,b.razo as prvx,c.razon as ciax,d.estado,
(select sum(aplica) from compras.orden_d x where x.id_orden=a.id_orden)as aplica
FROM compras.orden_c a
left join catalogo.provedor b on b.prov=a.prv
left join catalogo.compa c on c.cia=a.cia
left join compras.numero_de_licitaciones d on d.id=a.id_estado
where a.tipo=1 and year(fecha_envio)=$aaa and month(fecha_envio)=$mes 
order by fecha_modi desc,year(fecha_envio) desc, year(fecha_envio) desc 
";
        $q = $this->db->query($s);
        return $q;
    }
    function order_ctl($id_orden)
    {
        $s = "SELECT a.estatus,year(fecha_envio)as aaa,month(fecha_envio)as mes,a.id_orden,a.*,b.corto as prvx,c.razon as ciax,a.id_estado,d.estado,d.edo,d.licitacion,
        a.consigna
FROM orden_c a
left join catalogo.provedor b on b.prov=a.prv
left join catalogo.compa c on c.cia=a.cia
left join compras.numero_de_licitaciones d on d.id=a.id_estado

where a.id_orden=$id_orden and a.tipo=1
";
        $q = $this->db->query($s);
        return $q;
    }

    function orden_det($id_orden)
    {

        $s = "SELECT *from compras.orden_d a
where a.id_orden=$id_orden 
";

        $q = $this->db->query($s);
        return $q;
    }
    function update_orden_cambia_ctl($id_orden, $prv, $cia, $id_estado, $fecha, $folprv,
        $edo, $base, $licitacion,$consigna)
    {

        $usuario = $this->session->userdata('id');
        if ($base == 1) {
            $an1 = " update almacen.compraped a,compras.numero_de_licitaciones c 
set prv=$prv,tipo=c.edo,a.consigna=$consigna,
aaae=substr('$fecha',1,4),mese=substr('$fecha',6,2),diae=substr('$fecha',9,2),
aaap=substr('$fecha',1,4),mesp=substr('$fecha',6,2),diap=substr('$fecha',9,2)
where c.id=$id_estado and  folprv=$folprv and tipo='$edo'";
            $this->db->query($an1);
        } else {
            $an2 = " update compras.pedido_c a,compras.pedido_d b,compras.numero_de_licitaciones c 
set a.prv=$prv,a.almacen=c.edo, b.almacen=c.edo,
a.fecha='$fecha',a.licita='$licitacion'
where c.id=$id_estado and a.id=b.id_cc and a.folprv=$folprv";
            $this->db->query($an2);
        }

        $s1 = "insert into orden_modi.orden_c( id_orden, id_estado, prv, fecha_captura, fecha_envio, fecha_limite, tipo, id_responsable, id_captura, folprv, cia, modifica, fecha_modifica,base,licita)
(select id_orden, id_estado, prv, fecha_captura, fecha_envio, fecha_limite, tipo, id_responsable, id_captura, folprv, cia, $usuario, CURRENT_TIMESTAMP(),base,'$licitacion'
from compras.orden_c where id_orden=$id_orden)";
        $this->db->query($s1);
        $s2 = "update compras.orden_c set consigna=$consigna,
prv=$prv,cia=$cia,id_estado=$id_estado,fecha_envio='$fecha',fecha_limite=date_add('$fecha',interval 20 day),fecha_modi=CURRENT_TIMESTAMP(),licita='$licitacion'
where id_orden=$id_orden ";
        $this->db->query($s2);
        $s3 = "insert into orden_modi.orden_c( id_orden, id_estado, prv, fecha_captura, fecha_envio, fecha_limite, tipo, id_responsable, id_captura, folprv, cia, modifica, fecha_modifica,base,licita)
(select id_orden, id_estado, prv, fecha_captura, fecha_envio, fecha_limite, tipo, id_responsable, id_captura, folprv, cia, $usuario, CURRENT_TIMESTAMP(),base,'$licitacion'
from compras.orden_c where id_orden=$id_orden)";
        $q = $this->db->query($s3);
        return $q;
    }

    function orden_det_id($id_detalle)
    {
        $s = "SELECT a.*,b.folprv,c.edo,b.id_estado,b.base,b.prv,b.fecha_envio,b.id_responsable,
        ifnull((select id from almacen.compraped x where x.folprv=b.folprv and claves=a.clagob and x.sec=a.sec),0)as id_compraped
FROM compras.orden_d a
left join compras.orden_c b on b.id_orden=a.id_orden
left join compras.numero_de_licitaciones c on c.id=b.id_estado
where id_detalle=$id_detalle
order by fecha_modi desc";
        $q = $this->db->query($s);
        return $q;
    }

    function update_order_cambia_det($id_orden, $id_estado, $folprv, $estado, $id_detalle,
        $sec, $clagob, $canp, $costo, $descu, $base, $codigo = 0, $id_responsable)
    {
        
        $codigoBarras = $codigo;
        $usuario = $this->session->userdata('id');
        if ($id_estado == 6 || $id_estado == 7) {
            
            $cat = "Select *from catalogo.almacen where sec=$sec and codigo = $codigo and tsec<>'X' group by sec";
            $q = $this->db->query($cat);
            $r = $q->row();
            $codigo = $r->codigo;
            $susa1 = $r->susa1;
            $susa2 = $r->susa2;
            $lin = $r->lin;
            if ($r->lin == 2 || $r->lin == 5 || $r->lin == 9 || $r->lin == 10) {
                $iva = 1;
            } else {
                $iva = 0;
            }
        } else {
            
            $cat = "Select *from catalogo.segpop where claves='$clagob' and tip<>'X' group by sec";
            $q = $this->db->query($cat);
            $r = $q->row();
            $codigo = $r->codigo;
            $susa1 = $r->susa1;
            $susa2 = $r->susa2;
            $lin = $r->lin;
            
            if ($r->lin == 2 || $r->lin == 5 || $r->lin == 9 || $r->lin == 10) {
                $iva = 1;
            } else {
                $iva = 0;
            }
        }
        if ($base == 2 and $id_estado <> 7 and $id_responsable<>38603 and $id_responsable<>0 and $id_responsable<>79592) {
            $cat = "SELECT a.*,concat(trim(susa),' ',trim(gramaje),' ',trim(contenido),trim(presenta))as susa1,
concat(trim(marca_comercial),' ',trim(gramaje),' ',trim(contenido),trim(presenta))as susa2 FROM catalogo.cat_nuevo_general a where esp='E' and clagob='$clagob' and codigo = $codigoBarras group by clagob";
            $q = $this->db->query($cat);
            $r = $q->row();
            $codigo = $r->codigo;
            $susa1 = $r->susa1;
            $susa2 = $r->susa2;
            $lin = $r->lin;
            if ($r->lin == 2 || $r->lin == 5 || $r->lin == 9 || $r->lin == 10) {
                $iva = 1;
            } else {
                $iva = 0;
            }
            
   
            $an = " update compras.pedido_d a, compras.orden_d b 
set 
a.sec=$sec, a.clagob='$clagob',a.costo='$costo',a.descu='$descu',a.ped=$canp,
a.codigo=$codigo, a.susa='$susa1', a.descri='$susa2'
where  a.clagob=b.clagob and a.sec=b.sec and a.codigo=b.codigo 
and  a.folprv=$folprv and a.almacen='$estado' and b.id_detalle=$id_detalle ";
            $this->db->query($an);
echo " update compras.pedido_d a, compras.orden_d b 
set 
a.sec=$sec, a.clagob='$clagob',a.costo='$costo',a.descu='$descu',a.ped=$canp,
a.codigo=$codigo, a.susa='$susa1', a.descri='$susa2'
where  a.clagob=b.clagob and a.sec=b.sec and a.codigo=b.codigo 
and  a.folprv=$folprv and a.almacen='$estado' and b.id_detalle=$id_detalle ";


        } elseif ($base == 2 and $id_estado == 7 || $base == 2 and $id_estado == 6) {
            $an = "update compras.orden_d b 
set 
b.costo='$costo',b.descuento='$descu',b.canp=$canp,b.cans=$canp,
b.codigo=$codigo, b.susa1='$susa1', b.susa2='$susa2'
where   b.id_detalle=$id_detalle ";
            $this->db->query($an);

        } else {

if($base==1){
            $an = " update almacen.compraped a, compras.orden_d b 
set 
a.sec=$sec, a.claves='$clagob',a.costo='$costo',a.porcen='$descu',a.canp=$canp,a.cans=$canp,a.canm=$canp,
a.codigo=$codigo, a.susa='$susa1', a.descri='$susa2', a.lin=$lin
where  a.claves=b.clagob and a.sec=b.sec and a.codigo=b.codigo 
and  a.folprv=$folprv and a.tipo='$estado' and b.id_detalle=$id_detalle ";
            $this->db->query($an);
}
        }
        $gra = "insert into orden_modi.orden_d
(id_orden, id_detalle, codigo, sec, clagob, susa1, susa2, costo, iva, descuento, canp, cans, canr, fecha_modi, id_modifica)
(select 
id_orden, id_detalle, codigo, sec, clagob, susa1, susa2, costo, iva, descuento, canp, cans, canr, CURRENT_TIMESTAMP(), $usuario
from compras.orden_d where id_detalle=$id_detalle)";
        $this->db->query($gra);

        $s = "update compras.orden_d
set sec=$sec, clagob='$clagob',costo='$costo',descuento=$descu,canp=$canp,cans=$canp,fecha_modi=CURRENT_TIMESTAMP(),
codigo=$codigo, susa1='$susa1', susa2='$susa2',iva=$iva
where id_detalle=$id_detalle";
        $this->db->query($s);

        $fin = "insert into orden_modi.orden_d
(id_orden, id_detalle, codigo, sec, clagob, susa1, susa2, costo, iva, descuento, canp, cans, canr, fecha_modi, id_modifica)
(select 
id_orden, id_detalle, codigo, sec, clagob, susa1, susa2, costo, iva, descuento, canp, cans, canr, CURRENT_TIMESTAMP(), $usuario
from compras.orden_d where id_detalle=$id_detalle)";
        $this->db->query($fin);
    }


    function insert_order_det($id_orden, $id_estado, $folprv, $estado, $sec, $clagob,
        $canp, $costo, $descu, $base, $prv, $fecha_envio, $codigo)
    {

        $lin=0;
        $usuario = $this->session->userdata('id');
        if ($id_estado == 6 || $id_estado == 7) {
            $cat = "Select *from catalogo.almacen where sec = ? and codigo = ? and tsec<>'X' group by sec";
            $q = $this->db->query($cat, array($sec, $codigo));
            $r = $q->row();
            $codigo = $r->codigo;
            $susa1 = $r->susa1;
            $susa2 = $r->susa2;
            $lin = $r->lin;
            $ieps = $r->ieps;
            $persona = $r->persona;
            if ($r->lin == 2 || $r->lin == 5 || $r->lin == 9 || $r->lin == 10) {
                $iva = 1;
            } else {
                $iva = 0;
            }
        } else {
            $cat = "Select *from catalogo.segpop where claves='$clagob' and codigo = $codigo group by sec";
            $q = $this->db->query($cat);
            $r = $q->row();
            $codigo = $r->codigo;
            $susa1 = $r->susa1;
            $susa2 = $r->susa2;
            $lin = $r->lin;
            $ieps = 0;
            $persona = $r->persona;
            if ($r->lin == 2 || $r->lin == 5 || $r->lin == 9 || $r->lin == 10) {
                $iva = 1;
            } else {
                $iva = 0;
            }
        }
        if ($base == 2 and $estado <> 'alm' and $estado<>'seg') {
            $cat = "SELECT a.*,concat(trim(susa),' ',trim(gramaje),' ',trim(contenido),trim(presenta))as susa1,
concat(trim(marca_comercial),' ',trim(gramaje),' ',trim(contenido),trim(presenta))as susa2 FROM catalogo.cat_nuevo_general a where esp='E' and clagob='$clagob' group by clagob";
            $q = $this->db->query($cat);
            $r = $q->row();
            $codigo = $r->codigo;
            $susa1 = $r->susa1;
            $susa2 = $r->susa2;
            $persona = $r->persona;
            $lin = $r->lin;
            if ($r->lin == 2 || $r->lin == 5 || $r->lin == 9 || $r->lin == 10) {
                $iva = 1;
            } else {
                $iva = 0;
            }
            

//$an = "
//insert ignore into compras.pedido_d(id_cc, almacen, sec, clagob, codigo, susa, inv, ped, prv, regalo, descu, costo, val, descri, 
//fecha, folprv)
//(select id,'$estado',$sec,'$clagob',$codigo,'$susa1',0,$canp,$prv,0,'$descu','$costo',0,'$susa2','$fecha_envio',$folprv
//from compras.pedido_c where folprv=$folprv and almacen='$estado')";
//            $this->db->query($an);
        } else {
        
            if ($estado <> 'alm' and $estado <> 'seg') {
                $l = "select nped from almacen.compraped where tipo='$estado' and folprv=$folprv";
                $qq = $this->db->query($l);
                $rr = $qq->row();
                $an = "
insert ignore into almacen.compraped(tipo, sec, nped, aaap, mesp, diap, susa, descri,costo,
prv, prvx, persona, folprv, lin, sublin, canp, canm, cans, canres, aaae, mese,diae,
aaas, mess, dias, pedidor, surtidor, claves, clavep, tipo3, codigo, cia, nuevof,quien)

(select '$estado', $sec, $rr->nped,year('$fecha_envio'),month('$fecha_envio'),day('$fecha_envio'),'$susa1','$susa2',
'$costo',$prv,' ','$persona',$folprv,$lin,0,$canp,$canp,$canp,0,year('$fecha_envio'),month('$fecha_envio'),
day('$fecha_envio'),0,0,0,$usuario,0, '$clagob', '$clagob','C',$codigo,0,0,'nop')";
                $this->db->query($an);
            }
        }


        $insert1 = array(
            'id_orden' => $id_orden,
            'codigo' => $codigo,
            'sec' => $sec,
            'clagob' => $clagob,
            'susa1' => $susa1,
            'susa2' => $susa2,
            'costo' => $costo,
            'iva' => $iva,
            'descuento' => $descu,
            'canp' => $canp,
            'cans' => $canp,
            'ieps' => $ieps,
            'canr' => 0,
            'fecha_modi' => date('Y-m-d H:i:s'));
        $this->db->insert('compras.orden_d', $insert1);
        $id_detalle = $this->db->insert_id();
        $insert2 = array(
            'id_orden' => $id_orden,
            'codigo' => $codigo,
            'id_detalle' => $id_detalle,
            'sec' => $sec,
            'clagob' => $clagob,
            'susa1' => $susa1,
            'susa2' => $susa2,
            'costo' => $costo,
            'iva' => $iva,
            'descuento' => $descu,
            'canp' => $canp,
            'cans' => $canp,
            'canr' => 0,
            'id_modifica' => $usuario,
            'fecha_modi' => date('Y-m-d H:i:s'),

            );
        $this->db->insert('orden_modi.orden_d', $insert2);
    }

    public function com_orden_det_his($id)
    {
        $s = "select a.* From compras.orden_d a
    where id_orden=$id and cans>0 ";
        $q = $this->db->query($s);
        return $q;
    }


    /////////////////////////////////////////////////////////////////////lo nuevo de compras
    function pre_orden()
    {
        $s = "select 'PRE ORDEN GENERADA'as var,id_pre_orden,sum(compra)as compra,sum(compra*costo)as importe, fecha_ger
from compras.orden_a where folprv=0  and id_orden=0
group by id_pre_orden";
        $q = $this->db->query($s);
        return $q;
    }

    function pre_orden_borrar_ceros($id_pre_orden)
    {
        $s = "delete from compras.orden_a where id_pre_orden=$id_pre_orden and folprv=0";
        $this->db->query($s);
    }
    function pre_orden_modi($id_pre_orden)
    {

        $s = "select a.*,b.corto,
case when descu>0 then ((compra*costo)-((descu/100))) else (compra*costo) end as importe, 

case when a.iva=0 then 0
else 
((case when descu>0 then ((compra*costo)-((descu/100))) else (compra*costo) end)*(select c.iva from catalogo.iva c where depto='compras')) 
end as iva

from compras.orden_a  a
join catalogo.provedor b on b.prov=a.prv

where id_pre_orden=$id_pre_orden  and a.folprv=0  and a.id_orden=0
order by fecha_cambio desc, prv";
        $q = $this->db->query($s);
        return $q;
    }
    function pre_orden_cerrar($id_pre_orden)
    {

        $s = "select a.prv,b.corto,sum(compra)as compra,id_pre_orden,
sum(case when descu>0 then ((compra*costo)*((descu/100))) else 0 end) as descu,

sum(case when descu>0 then ((compra*costo)-((descu/100))) else (compra*costo) end) as importe,
sum(case when a.iva=0 then 0
else
((case when descu>0 then ((compra*costo)-((descu/100))) else (compra*costo) end)*(select c.iva from catalogo.iva c where depto='compras'))
end) as iva

from compras.orden_a  a
join catalogo.provedor b on b.prov=a.prv


where id_pre_orden=$id_pre_orden  and a.folprv=0  and a.id_orden=0
group by prv";
        $q = $this->db->query($s);
        return $q;
    }
    function busca_sec_preorden($id)
    {

        $s = "select a.*,b.corto,case when descu>0 then ((compra*costo)-((descu/100))) else (compra*costo) end as importe 
from compras.orden_a  a
join catalogo.provedor b on b.prov=a.prv
where a.id=$id and a.folprv=0  and a.id_orden=0
";
        $q = $this->db->query($s);
        return $q;
    }
    function busca_prv_preorden($id)
    {

        $s = "select a.*,b.corto,case when descu>0 then ((compra*costo)-((descu/100))) else (compra*costo) end as importe 
from compras.orden_a  a
join catalogo.provedor b on b.prov=a.prv
where a.id=$id and a.folprv=0  and a.id_orden=0
";
        $q = $this->db->query($s);
        return $q;
    }
    function busca_otro_prv_preorden($id_pre_orden, $prov)
    {

        $s = "select a.prv,b.corto,sum(compra)as compra,id_pre_orden,
sum(case when descu>0 then ((compra*costo)*((descu/100))) else 0 end) as descu,

sum(case when descu>0 then ((compra*costo)-((descu/100))) else (compra*costo) end) as importe,
sum(case when a.iva=0 then 0
else
((case when descu>0 then ((compra*costo)-((descu/100))) else (compra*costo) end)*(select c.iva from catalogo.iva c where depto='compras'))
end) as iva

from compras.orden_a  a
join catalogo.provedor b on b.prov=a.prv


where id_pre_orden=$id_pre_orden and a.prv=$prov and a.folprv=0  and a.id_orden=0
group by prv ";
        $q = $this->db->query($s);
        return $q;

    }

    function pre_orden_cerrar_detalle($id_pre_orden, $prv)
    {

        $s = "select a.*,b.corto,
case when descu>0 then ((compra*costo)-((descu/100))) else (compra*costo) end as importe, 

case when a.iva=0 then 0
else 
((case when descu>0 then ((compra*costo)-((descu/100))) else (compra*costo) end)*(select c.iva from catalogo.iva c where depto='compras')) 
end as iva

from compras.orden_a  a
join catalogo.provedor b on b.prov=a.prv

where id_pre_orden=$id_pre_orden  and prv=$prv and a.folprv=0  and a.id_orden=0
";
        $q = $this->db->query($s);
        return $q;
    }

    function write_preorden($id_pre_orden, $prv, $cia)
    {
        $id_user = $this->session->userdata('id');
        $id_respon = $this->session->userdata('responsable');

        ////////////////////////////////orden_c
        $val = "select a.*from orden_a  a where id_pre_orden=$id_pre_orden and  a.prv=$prv and id_orden=0 and folprv=0
group by prv";
        $qv = $this->db->query($val);
        if ($qv->num_rows() == 1) {


            $s1 = "update compras.orden_a a
set
a.id_orden=(SELECT (max(id_orden)+1) FROM compras.orden_c),
a.folprv=(SELECT num FROM catalogo.foliador1 where clav='osi')
where id_pre_orden=$id_pre_orden and  a.prv=$prv and id_orden=0 and folprv=0
";
            $this->db->query($s1);
            $s2 = "update catalogo.foliador1 set num=num+1 where clav='osi'";
            $this->db->query($s2);
            $s3 = "insert ignore into compras.orden_c 
(id_orden, id_estado, prv, fecha_captura, fecha_envio, fecha_limite, tipo, id_responsable, id_captura, folprv, cia, 
fecha_modi, base, licita, pre_orden)
(SELECT a.id_orden,7,a.prv,a.fecha,date(now()),adddate(date(now()),20),1,
$id_respon,$id_user,
folprv,
$cia,0,2,b.licitacion,id_pre_orden
 FROM compras.orden_a  a,compras.numero_de_licitaciones b
 where a.prv=$prv and id_pre_orden=$id_pre_orden and folprv>0 and b.id=7
group by a.prv)";
            $this->db->query($s3);

            $s4 = "insert ignore into compras.orden_d 
(id_orden, codigo, sec, clagob, susa1, susa2, costo, iva, descuento, canp, cans, canr, fecha_modi)
(SELECT a.id_orden,codigo,sec,'',susa,susa,costo,iva,descu,compra,compra,0,date(now())
FROM compras.orden_a  a
 where a.prv=$prv and id_pre_orden=$id_pre_orden and folprv>0
)";
            $this->db->query($s4);

            $del = "delete from compras.orden_a where id_pre_orden=$id_pre_orden and prv=$prv and folprv>0";
            $this->db->query($del);
        }
    }

    function orden_historico()
    {
    $responsable=$this->session->userdata('responsable');    
        $s = "select b.corto,a.*,sum(cans)as can,sum(aplica)as llego from compras.orden_c a
join catalogo.provedor b on b.prov=a.prv
join compras.orden_d c on c.id_orden=a.id_orden
where a.tipo=1 and id_responsable=$responsable
group by a.id_orden
order by a.fecha_envio desc";
        $q = $this->db->query($s);
        return $q;
    }

    function busca_orden_almacen($folprv)
    {
        $s = "select cc.fechai,cc.fac,a.folprv,a.prv,d.corto,b.sec,b.susa1,b.susa2, b.cans,c.fechai,c.lote,c.cadu,c.can,ifnull(inv1,0)as inv1
from compras.orden_c a
join compras.orden_d b on b.id_orden=a.id_orden
join desarrollo.compra_d c on c.orden=a.folprv and c.sec=b.sec
join desarrollo.compra_c cc on cc.id=c.id_cc
join catalogo.provedor d on d.prov=a.prv
left join desarrollo.inv_cedis e on e.sec=c.sec and e.lote=c.lote
where folprv=$folprv";
        $q = $this->db->query($s);
        $a = '';
        foreach ($q->result() as $r) {
            $a[$r->sec]['folprv'] = $r->folprv;
            $a[$r->sec]['prv'] = $r->prv;
            $a[$r->sec]['corto'] = $r->corto;
            $a[$r->sec]['sec'] = $r->sec;
            $a[$r->sec]['susa1'] = $r->susa1;
            $a[$r->sec]['susa2'] = $r->susa2;
            $a[$r->sec]['cans'] = $r->cans;
            $a[$r->sec]['segundo'][$r->lote]['fac'] = $r->fac;
            $a[$r->sec]['segundo'][$r->lote]['fechai'] = $r->fechai;
            $a[$r->sec]['segundo'][$r->lote]['lote'] = $r->lote;
            $a[$r->sec]['segundo'][$r->lote]['cadu'] = $r->cadu;
            $a[$r->sec]['segundo'][$r->lote]['can'] = $r->can;
            $a[$r->sec]['segundo'][$r->lote]['inv1'] = $r->inv1;
        }
        return $a;
    }
    function busca_orden_almacen_sin($folprv)
    {
        $s = "select a.folprv,a.prv,d.corto,b.sec,b.susa1,b.susa2, b.cans,b.costo
from compras.orden_c a
join compras.orden_d b on b.id_orden=a.id_orden
left join desarrollo.compra_d c on c.orden=a.folprv and c.sec=b.sec
join catalogo.provedor d on d.prov=a.prv
where folprv=$folprv and c.sec is null
order by sec";
        $q = $this->db->query($s);
        return $q;
    }

    function busca_orden_prv($folprv)
    {
        $s = "select a.folprv,a.prv,d.corto
from compras.orden_c a
join catalogo.provedor d on d.prov=a.prv
where folprv=$folprv ";
        $q = $this->db->query($s);
        $corto = '';
        $r = $q->row();
        $corto = $r->corto;
        return $corto;
    }

    function busca_sec_orden_almacen($sec)
    {
        $s = "SELECT a.folprv,a.fecha_limite as fecha_l,a.id_orden,a.prv,c.corto,a.fecha_envio,b.sec,b.susa1,b.cans,b.costo,b.descuento,
(b.cans*b.costo) as importe, b.aplica
FROM compras.orden_c  a
left join compras.orden_d b on a.id_orden=b.id_orden
left join catalogo.provedor c on a.prv=c.prov
where 
sec>0 and date(now()) between a.fecha_envio and fecha_limite and sec=$sec
order by a.fecha_envio

";
        $q = $this->db->query($s);
        return $q;
    }
    
    function busca_id_pedido_d($id_detalle)
    {
        $s="SELECT d.id FROM compras.orden_d a, compras.orden_c b, compras.pedido_c c, compras.pedido_d d
        where a.id_orden=b.id_orden and b.folprv=c.folprv and c.id=d.id_cc and a.clagob=d.clagob 
        and a.id_detalle=$id_detalle";
        
        $q=$this->db->query($s);
        if($q->num_rows()>0){
            $r=$q->row();
            $id_pedido_d=$r->id;
        }else{
            $id_pedido_d=0;
        }
        return $id_pedido_d;
    }
    function actualizaDataOrden_d($set, $id_detalle,$id_base,$id_compraped,$arr2,$arr3,$id_pedido_d)
    {
        $this->db->update('compras.orden_d', $set, array('id_detalle' => $id_detalle));
        $this->db->update('compras.pedido_d', $arr3, array('id' => $id_pedido_d));
        if($id_base==1){
            $this->db->update('almacen.compraped', $arr2, array('id' => $id_compraped));
        }
    }


  function orden_captura_especial()
  {
    $id_user=$this->session->userdata('id');
    $s="SELECT c.razo as prvx,b.estado as almacenx,a.*,
(select sum(((canp*costo)-
case when x.descuento>0 then (canp*costo)*(x.descuento/100) else 0 end+
case when x.ieps>0 then ((canp*costo)-((canp*costo)*(x.descuento/100)))*(ieps/100) else 0 end+
case when x.iva>0 then ((canp*costo)-((canp*costo)*(x.descuento/100)))*.16 else 0 end)) from compras.orden_d x where x.id_orden=a.id_orden group by x.id_orden)as imp
 FROM compras.orden_c a
join compras.numero_de_licitaciones b on b.id=a.id_estado
join catalogo.provedor c on c.prov=a.prv
where a.tipo=0 and a.id_captura=$id_user order by id_orden desc";
    $q=$this->db->query($s);
    return $q;
  }
  function orden_captura_especial_det($id_orden)
  {
    $id_user=$this->session->userdata('id');
    $s="select b.prv,a.id_orden,(canp*costo)as imp,
case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end as imp_descu,
case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end as imp_ieps,
case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end as imp_iva,
((canp*costo)-
case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end+
case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end+
case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end) as total,

c.iva as iva_suc,a.*

from compras.orden_d a
join compras.orden_c b on b.id_orden=a.id_orden
join catalogo.sucursal c on c.suc=b.embarca
where a.id_orden=$id_orden order by id_detalle desc";
    $q=$this->db->query($s);
    return $q;
  }  
 function sumit_detalle_pat($cod,$can,$des,$cos,$id_orden,$prv)
 {
        if($prv==825){
        $s = "SELECT codigo,descripcion as susa1,descripcion as susa2,farmacia,iva,
        ifnull((select clave from catalogo.cat_mercadotecnia x where x.codigo=$cod),' ')as clagob
        fROM catalogo.cat_fanasa where codigo = $cod";
        $q = $this->db->query($s);
        
        $sec=0;
            
    }
    if($prv==221){
        $s = "SELECT codigo,descripcion as susa1,descripcion as susa2,costo as farmacia,
        ifnull((select iva from catalogo.cat_mercadotecnia x where x.codigo=$cod),0)as iva,
        ifnull((select clave from catalogo.cat_mercadotecnia x where x.codigo=$cod),' ')as clagob 
        fROM catalogo.cat_nadro where codigo = $cod";
        $q = $this->db->query($s);
        
        $sec=0;
            
    }
    if($prv==23){
        $s = "SELECT codigo,descripcion as susa1,descripcion as susa2,costo as farmacia,
        ifnull((select iva from catalogo.cat_mercadotecnia x where x.codigo=$cod),0)as iva,
        ifnull((select clave from catalogo.cat_mercadotecnia x where x.codigo=$cod),' ')as clagob 
        fROM catalogo.cat_drogas where codigo = $cod";
        $q = $this->db->query($s);
        
        $sec=0;
            
    }
    $r=$q->row();
    $graba="insert ignore into compras.orden_d
    (id_orden, codigo, sec, clagob, susa1, susa2, costo, iva, descuento, canp, cans, canr, fecha_modi, aplica)
    values
    ($id_orden,$cod,$sec,'$r->clagob','$r->susa1','$r->susa2','$cos',$r->iva,'$des',$can,$can,0,date(now()),0)";
    $this->db->query($graba);
    }
    function sumit_detalle_pat_fac($fac,$id_orden)
    {
    $graba="insert ignore into compras.orden_d
    (id_orden, codigo, sec, clagob, susa1, susa2, costo, iva, descuento, canp, cans, canr, fecha_modi, aplica,ieps)
    
    (SELECT $id_orden,a.cod,b.sec,b.clave,b.susa,b.descripcion,far,

case when a.iva>0 then 1 else 0 end,
round((100-((((importe)-(a.ieps+a.iva))/(far*can))*100)),4),can,can,0,'0000-00-00',0,0
 FROM compras.pre_factura_fenix a
join catalogo.cat_mercadotecnia b on b.codigo=a.cod
where fac in($fac))";
    $this->db->query($graba);
    }  
    
    
public function cerrar_especial_f($id_ped, $cia, $tipo)
    {
        $userid = $this->session->userdata('id');
        $m = "select adddate(date(now()),20)as limite, a.*from catalogo.foliador1 a where clav='$tipo'";
        $q = $this->db->query($m);
        if ($q->num_rows() > 0) {
            $r = $q->row();

            $data = array(
                'tipo' => 1,
                'fecha_envio' => date('Y-m-d H:i:s'),
                'folprv' => $r->num,
                'cia' => $cia,
                'fecha_limite' => $r->limite,
                'id_captura' => $this->session->userdata('id'));
            $this->db->where('id_orden', $id_ped);
            $this->db->where('tipo', '0');
            $this->db->update('compras.orden_c', $data);

            
            $m1 = "update catalogo.foliador1 set num=$r->num+1 where clav='$tipo'";
            $this->db->query($m1);
        }
    }
    
    function orden_captura_especial_his()
  {
    $id_user=$this->session->userdata('id');
    $id_responsable=$this->session->userdata('responsable');
    $s="SELECT a.fecha_envio,c.razo as prvx,b.estado as almacenx,a.*,
(select sum(canp*costo) from compras.orden_d x where x.id_orden=a.id_orden group by x.id_orden)as imp
 FROM compras.orden_c a
join compras.numero_de_licitaciones b on b.id=a.id_estado
join catalogo.provedor c on c.prov=a.prv
where a.tipo=1 and a.id_captura=$id_user or a.tipo=1 and a.id_responsable=$id_responsable
order by a.fecha_envio desc";
    $q=$this->db->query($s);
    return $q;
  }
  function sumit_detalle_sec($sec,$can,$canr,$des,$id_orden,$prv)
 {
        $s = "SELECT sec,codigo,susa1 as susa1,susa2 as susa2,costo,case when lin in(2,5,9,10)then 1 else 0 end iva 
        fROM catalogo.almacen where sec = $sec and prv=$prv and tsec<>'X'";
        $q = $this->db->query($s);
        $clagob=''; 
     if($q->num_rows()>0){   
       $r=$q->row();
       $graba="insert ignore into compras.orden_d
    (id_orden, codigo, sec, clagob, susa1, susa2, costo, iva, descuento, canp, cans, canr, fecha_modi, aplica)
    values
    ($id_orden,$r->codigo,$sec,'$clagob','$r->susa1','$r->susa2','$r->costo',$r->iva,'$des',$can,$can,$canr,date(now()),0)";
    $this->db->query($graba);
    }
 }
 function orden_captura_his_global()
  {
    
    $s="SELECT year(fecha_envio)as aaa,month(fecha_envio)as mes, mes as mesx,count(*)as ordenes
 FROM compras.orden_c a
join catalogo.mes b on b.num=month(fecha_envio)
where a.tipo=1 and id_captura>0 and id_responsable>0
group by year(fecha_envio),month(fecha_envio)
order by year(fecha_envio) desc ,month(fecha_envio) desc";
    $q=$this->db->query($s);
    return $q;
  }
function orden_captura_his_global_mes($aaa,$mes)
  {
    
    $s="SELECT a.id_orden,a.fecha_envio,c.razo as prvx,b.estado as almacenx,folprv,
(select sum(canp*costo) from compras.orden_d x where x.id_orden=a.id_orden group by x.id_orden)as imp,
d.nombre as capturax,prv,
(select completo from catalogo.cat_empleado e where e.nomina=a.id_responsable and e.tipo=1)as comprador

 FROM compras.orden_c a
join compras.numero_de_licitaciones b on b.id=a.id_estado
join catalogo.provedor c on c.prov=a.prv
join compras.usuarios d on d.id=a.id_captura

where a.tipo=1 and id_captura>0 and year(fecha_envio)=$aaa and month(fecha_envio)=$mes
order by fecha_envio
";
    $q=$this->db->query($s);
    return $q;
  }
  function sumit_segpop_det($id_orden,$prv,$id_cat,$can,$canr,$des)
  {
  $s=" insert into compras.orden_d
    (id_orden, codigo, sec, clagob, susa1, susa2, costo, iva, descuento, canp, cans, canr, fecha_modi, aplica, ieps)
    (select id_orden,codigo,sec,claves, susa1, susa2,
    case
    when embarca=12000 and cos1>0 then cos1
    when embarca=19000 and cos2>0 then cos2
    when embarca=12000 and cos1=0 then costo
    when embarca=19000 and cos2=0 then costo
    else costo end,case when lin in(2,5,9,10) then 1 else 0 end,'$des',$can,$can,$canr,'0000-00-00',0,0
    from catalogo.segpop a,compras.orden_c b where b.id_orden=$id_orden and a.id=$id_cat)";
    $q=$this->db->query($s);
    return $q;
  }
function sumit_segpop_det_esp($id_orden,$prv,$id_cat,$can,$canr,$des)
  {
  $s=" insert into compras.orden_d
    (id_orden, codigo, sec, clagob, susa1, susa2, costo, iva, descuento, canp, cans, canr, fecha_modi, aplica, ieps)
    (select $id_orden,b.codigo,0,b.clagob as claves,
concat(trim(susa),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta))as susa1,
concat(trim(marca_comercial),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta))as susa2,
case
when embarca=12000 and cos1>0 then cos1
when embarca=19000 and cos2>0 then cos2
when embarca=12000 and cos1=0 then costo
when embarca=19000 and cos2=0 then costo
else costo end as costo,
case when lin in(2,5,9,10) then 1 else 0 end,'$des','$can','$can','$canr','0000-00-00',0,0

        FROM catalogo.cat_nuevo_general a
        join catalogo.cat_nuevo_general_prv b on a.clagob=b.clagob and a.codigo=b.codigo
        join compras.orden_c c on c.id_orden=$id_orden
     where
        b.id =$id_cat)";
    $q=$this->db->query($s);
    return $q;
  }
  
function orden_segpop_his_esp()
  {
    $id_user=$this->session->userdata('id');
    $id_responsable=$this->session->userdata('responsable');
    $s="select
e.estado as recibex,licita,f.estado as embarcax,folprv,estatus,
fecha_envio,fecha_limite,
b.prv,d.razo,a.id_orden,sum(canp*costo)as imp,
sum(case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end) as imp_descu,
sum(case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end) as imp_ieps,
sum(case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end) as imp_iva,
(sum(canp*costo)-
sum(case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end)+
sum(case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end)+
sum(case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end)) as total,
c.iva as iva_suc,
sum(cans)as pedido,sum(aplica)as aplicado,
((sum(aplica)/sum(cans))*100)as nuvel_surtido

from compras.orden_d a
join compras.orden_c b on b.id_orden=a.id_orden
join catalogo.sucursal c on c.suc=b.embarca
join catalogo.provedor d on d.prov=b.prv
join compras.numero_de_licitaciones e on e.id=b.id_estado
join compras.numero_de_licitaciones f on f.num_licitacion=b.embarca
where 
date(now()) between fecha_envio and fecha_limite and id_estado<>7 and b.tipo=1 and id_captura=$id_user or
date(now()) between fecha_envio and fecha_limite and id_estado<>7 and b.tipo=1 and id_responsable=$id_responsable
group by b.id_orden desc";
    $q=$this->db->query($s);
    return $q;
  }
  function orden_segpop_his_global()
  {
    $id_user=$this->session->userdata('id');
    $id_responsable=$this->session->userdata('responsable');
    $s="select
e.estado as recibex,licita,f.estado as embarcax,folprv,estatus,
fecha_envio,fecha_limite,
b.prv,d.razo,a.id_orden,sum(canp*costo)as imp,
sum(case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end) as imp_descu,
sum(case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end) as imp_ieps,
sum(case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end) as imp_iva,
(sum(canp*costo)-
sum(case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end)+
sum(case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end)+
sum(case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end)) as total,
c.iva as iva_suc,
sum(cans)as pedido,sum(aplica)as aplicado,
((sum(aplica)/sum(cans))*100)as nuvel_surtido

from compras.orden_d a
join compras.orden_c b on b.id_orden=a.id_orden
join catalogo.sucursal c on c.suc=b.embarca
join catalogo.provedor d on d.prov=b.prv
join compras.numero_de_licitaciones e on e.id=b.id_estado
join compras.numero_de_licitaciones f on f.num_licitacion=b.embarca
where 
date(now()) between fecha_envio and fecha_limite and id_estado<>7 and b.tipo=1 
group by b.id_orden desc";
    $q=$this->db->query($s);
    return $q;
  }
   function nivel_surtido_prv()
  {
    $id_user=$this->session->userdata('id');
    $id_responsable=$this->session->userdata('responsable');
    $s="select
estatus,
fecha_envio,fecha_limite,
b.prv,d.razo,a.id_orden,sum(canp*costo)as imp,
sum(case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end) as imp_descu,
sum(case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end) as imp_ieps,
sum(case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end) as imp_iva,
(sum(canp*costo)-
sum(case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end)+
sum(case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end)+
sum(case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end)) as total,
c.iva as iva_suc,
sum(cans)as pedido,sum(aplica)as aplicado,
((sum(aplica)/sum(cans))*100)as nuvel_surtido

from compras.orden_d a
join compras.orden_c b on b.id_orden=a.id_orden
join catalogo.sucursal c on c.suc=b.embarca
join catalogo.provedor d on d.prov=b.prv


where
date(now()) between fecha_envio and fecha_limite and id_estado<>7 and b.tipo=1 and estatus=1 and cans>0
group by b.prv desc";
    $q=$this->db->query($s);
    return $q;
  }
  
  function nivel_surtido_prv_det($prv)
  {
    $id_user=$this->session->userdata('id');
    $id_responsable=$this->session->userdata('responsable');
    $s="select folprv,fecha_envio,fecha_limite,
a.id_orden,codigo,clagob,susa1,(canp*costo)as imp,
(case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end) as imp_descu,
(case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end) as imp_ieps,
(case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end) as imp_iva,
((canp*costo)-
(case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end)+
(case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end)+
(case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end)) as total,
c.iva as iva_suc,
(cans)as pedido,(aplica)as aplicado,
(((aplica)/(cans))*100)as nuvel_surtido

from compras.orden_d a
join compras.orden_c b on b.id_orden=a.id_orden
join catalogo.sucursal c on c.suc=b.embarca
join catalogo.provedor d on d.prov=b.prv


where
date(now()) between fecha_envio and fecha_limite and id_estado<>7 and b.tipo=1 and estatus=1 and prv=$prv and cans>0
";
    $q=$this->db->query($s);
    return $q;
  }
  function nivel_surtido_prv_rango($fec1,$fec2)
  {
    $id_user=$this->session->userdata('id');
    $id_responsable=$this->session->userdata('responsable');
    $s="select
estatus,
fecha_envio,fecha_limite,
b.prv,d.razo,a.id_orden,sum(canp*costo)as imp,
sum(case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end) as imp_descu,
sum(case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end) as imp_ieps,
sum(case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end) as imp_iva,
(sum(canp*costo)-
sum(case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end)+
sum(case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end)+
sum(case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end)) as total,
c.iva as iva_suc,
sum(cans)as pedido,sum(aplica)as aplicado,
((sum(aplica)/sum(cans))*100)as nuvel_surtido

from compras.orden_d a
join compras.orden_c b on b.id_orden=a.id_orden
join catalogo.sucursal c on c.suc=b.embarca
join catalogo.provedor d on d.prov=b.prv


where
fecha_envio between '$fec1' and '$fec2' and id_estado<>7 and b.tipo=1 and estatus=1 and cans>0
group by b.prv desc";
    $q=$this->db->query($s);
    return $q;
  }
  function nivel_surtido_prv_det_rango($prv,$fec1,$fec2)
  {
    $id_user=$this->session->userdata('id');
    $id_responsable=$this->session->userdata('responsable');
    $s="select folprv,fecha_envio,fecha_limite,
a.id_orden,codigo,clagob,susa1,(canp*costo)as imp,
(case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end) as imp_descu,
(case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end) as imp_ieps,
(case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end) as imp_iva,
((canp*costo)-
(case when a.descuento>0 then (canp*costo)*(a.descuento/100) else 0 end)+
(case when a.ieps>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*(ieps/100) else 0 end)+
(case when a.iva>0 then ((canp*costo)-((canp*costo)*(a.descuento/100)))*c.iva else 0 end)) as total,
c.iva as iva_suc,
(cans)as pedido,(aplica)as aplicado,
(((aplica)/(cans))*100)as nuvel_surtido

from compras.orden_d a
join compras.orden_c b on b.id_orden=a.id_orden
join catalogo.sucursal c on c.suc=b.embarca
join catalogo.provedor d on d.prov=b.prv


where
fecha_envio between '$fec1' and '$fec2' and id_estado<>7 and b.tipo=1 and estatus=1 and prv=$prv and cans>0";
    $q=$this->db->query($s);
    return $q;
  }
}