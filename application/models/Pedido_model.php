<?php
class Pedido_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function generar_sumit($por1, $por2, $por3, $por4, $por5, $alm)
    {
        $aa = date('m');
        if ($aa < 10) {
            $m = 'm' . substr($aa, 1, 1);
            $mm = 'm' . (substr(($aa), 1, 1) - 1);
        } else {
            $m = 'm' . $aa;
            $m = 'm' . (($aa) - 1);
        }
        if ($alm == 'alm') {
            $this->__cedis($por1, $por2, $por3, $por4, $por5, $m, 'sec');
        } elseif ($alm == 'fbo') {
            $this->__farmabodega('sec');
        } elseif ($alm == 'met') {
            $this->__metro($mm, 'sec');
        } elseif ($alm == 'ban') {
            $this->__bansefi($mm, 'sec');
        } elseif ($alm == 'sec') {
            $this->__cedis($por1, $por2, $por3, $por4, $por5, $m, 'sec');
            $this->__farmabodega('sec');
            $this->__metro($mm, 'sec');
            $this->__bansefi($mm, 'sec');
        }

    }

    private function __cedis($por1, $por2, $por3, $por4, $por5, $m, $xtipo)
    {
        /////////////////////////////////////////////////////////////////////////almacen cedis
        $s = " insert ignore into pedido_for(almacen, sec, clagob, codigo, susa, maxi, inv, ped, fechag, prv, costo, clasi,xtipo)
(select 'alm',a.sec,ifnull(b.clagob,''),ifnull(b.codigo,0),a.susa,

ifnull(case when a.clasi='A' then c.$m*$por1 when a.clasi='B' then c.$m*$por2 when a.clasi='C' then c.$m*$por3 
when a.clasi='D' then c.$m*$por4 when a.clasi='E' then c.$m*$por5 else 0 end,0), 

ifnull(d.inv1,0),
ifnull(case when case when a.clasi='A' then c.$m*$por1 when a.clasi='B' then c.$m*$por2 when a.clasi='C' then c.$m*$por3
when a.clasi='D' then c.$m*$por4 when a.clasi='E' then c.$m*$por5 else 0 end>inv1 
then 
case when a.clasi='A' then c.$m*$por1 when a.clasi='B' then c.$m*$por2 when a.clasi='C' then c.$m*$por3
when a.clasi='D' then c.$m*$por4 when a.clasi='E' then c.$m*$por5 else 0 end-d.inv1 else 0 end,0),
date(now()),

a.prv,a.cos,a.clasi,'$xtipo'
from catalogo.cat_nuevo_general_sec a
left join catalogo.cat_nuevo_general_prv b on a.sec=b.sec and b.tipo='A'  and preg ='G'
left join almacen.max_cedis c on c.sec=a.sec
left join desarrollo.inv_cedis_sec1 d on d.sec=a.sec and d.inv1>0
where a.tipo='A'
group by a.sec
order by a.sec)";
        $this->db->query($s);
    }


    private function __farmabodega($xtipo)
    {
        /////////////////////////////////////////////////////////////////////////almacen farmabodega
        $sf = "insert ignore into pedido_for(almacen, sec, clagob, codigo, susa, maxi, inv, ped, fechag, prv, 
        costo, clasi,xtipo,farmabodega)
(SELECT 'fbo',a.sec,' ',a.codigo,b.susa,a.maxi,ifnull(c.cantidad,0),
case when c.cantidad<maxi then maxi-cantidad when cantidad is null then maxi else 0 end,
date(now()),a.prv,a.cos,'','$xtipo',right(a.clave, 1)
FROM almacen.max_farmabodega a
left join catalogo.cat_nuevo_general_sec b on b.sec=a.sec
left join farmabodega.inventario_d_clave c on c.clave=a.clave
where cantidad<maxi)";
        $this->db->query($sf);
    }
    private function __bansefi($mm, $xtipo)
    {
        /////////////////////////////////////////////////////////////////////////almacen bansefi
        $sf = "insert ignore into pedido_for(almacen, sec, clagob, codigo, susa, maxi, inv, ped, fechag, prv, costo, clasi,xtipo)
(SELECT 'ban',a.sec,' ',a.codigo,a.susa,a.$mm,0,a.$mm,date(now()),a.prv,a.cos,'','$xtipo' FROM almacen.max_bansefi a where $mm>0)";
        $this->db->query($sf);
    }
    private function __metro($mm, $xtipo)
    {
        /////////////////////////////////////////////////////////////////////////almacen metro
        $sf = "insert ignore into pedido_for(almacen, sec, clagob, codigo, susa, maxi, inv, ped, fechag, prv, costo, clasi,xtipo)
(SELECT 'met',a.sec,' ',a.codigo,a.susa,a.$mm,0,a.$mm,date(now()),a.prv,a.cos,'','$xtipo' FROM almacen.max_metro a where $mm>0)";
        $this->db->query($sf);
    }


    public function pedidos()
    {
        $s = "SELECT a.xtipo,fechag,a.clasi,a.almacen,b.nombre as almacenx,sum(a.ped*a.costo)as impo
FROM pedido_for a
left join catalogo.cat_almacenes b on b.tipo=a.almacen
where ped>0 and a.tipo='A' group by a.fechag, a.almacen,a.clasi";
        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $b = 0;
            foreach ($q->result() as $r) {
                //fechag, clasi, almacen, almacenx, impo
                $a[$r->fechag]['fechag'] = $r->fechag;
                $a[$r->fechag]['xtipo'] = $r->xtipo;
                $a[$r->fechag]['segundo'][$r->almacen]['almacen'] = $r->almacen;
                $a[$r->fechag]['segundo'][$r->almacen]['almacenx'] = $r->almacenx;
                $a[$r->fechag]['segundo'][$r->almacen]['tercero'][$r->clasi]['clasi'] = $r->
                    clasi;
                $a[$r->fechag]['segundo'][$r->almacen]['tercero'][$r->clasi]['clasi'] = $r->
                    clasi;
                $a[$r->fechag]['segundo'][$r->almacen]['tercero'][$r->clasi]['impo'] = $r->impo;
            }
        } else {
            $a = 0;
        }
        return $a;
    }
    public function sumit_valida_ped($fec, $xtipo)
    {

        $id_user = $this->session->userdata('id');
        $sql = "SELECT a.*,ifnull(b.corto,' ')as prvx FROM pedido_for a 
    left join catalogo.provedor b on b.prov=a.prv 
    where fechag = '$fec' and xtipo = '$xtipo' and ped>0 and a.tipo='A' group by a.almacen,a.prv";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $n0 = array( // almacen, prv, prvx, fechag, tipo, fechae, id_userg, ud_usere, cia
                    'xtipo' => $xtipo, 'fechag' => $fec);
            $this->db->insert('compras.orden_g', $n0);
            $id_ped = $this->db->insert_id();
            foreach ($query->result() as $row) {

                $n1 = array( // almacen, prv, prvx, fechag, tipo, fechae, id_userg, ud_usere, cia
                    'almacen' => $row->almacen,
                    'prv' => $row->prv,
                    'prvx' => $row->prvx,
                    'fecha_ped' => $fec,
                    'tipo' => 'A',
                    'fechae' => '0000-00-00',
                    'fechag' => '0000-00-00',
                    'id_userg' => $id_user,
                    'id_usere' => 0,
                    'id_ped' => $id_ped,
                    'cia' => 0);
                $this->db->insert('compras.orden_c', $n1);
                $id_cc = $this->db->insert_id();
                $s = "insert into compras.orden_d (id_cc, almacen, sec, clagob, codigo, susa, canp, cans, aplica, fechae, fechal, id_ped,prv, costo,xtipo,costobase,prvbase)
    (select $id_cc,almacen,sec,clagob,codigo,susa,ped,ped,0,'0000-00-00','0000-00-00',$id_ped,prv,costo,'$xtipo',costo,prv 
    from compras.pedido_for where fechag='$fec' and prv=$row->prv and almacen='$row->almacen' and xtipo='$xtipo' and ped>0)";
                $this->db->query($s);
                $g = "update pedido_for set tipo='B' where fechag='$fec' and almacen='$row->almacen' and xtipo='$xtipo' and tipo='A' and prv=$row->prv";
                $this->db->query($g);
            }
        }
    }
    ///////////////////////////////////////////////////////////////orden de compra
    public function pedido_compra()
    {
        $s = "select a.*, sum(b.cans*b.costo)as impo from orden_c a
left join orden_d b on b.id_cc=a.id
where a.tipo='A'
group by a.id_ped,a.prv,a.almacen";
        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $b = 0;
            foreach ($q->result() as $r) {
                //fechag, clasi, almacen, almacenx, impo
                $a[$r->id_ped]['segundo'][$r->prv]['id_ped'] = $r->id_ped;
                $a[$r->id_ped]['segundo'][$r->prv]['fecha_ped'] = $r->fecha_ped;

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
    public function pedido_compra_detalle($prv, $id_ped)
    {
        $s = "select a.*, b.sec,b.clagob,b.cans,b.susa,(b.cans*b.costo)as impo,b.costo from orden_c a
left join orden_d b on b.id_cc=a.id
where a.tipo='A' and a.id_ped=$id_ped and a.prv=$prv
";
        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $b = 0;
            foreach ($q->result() as $r) {
                //fechag, clasi, almacen, almacenx, impo
                $a[$r->sec]['sec'] = $r->sec;
                $a[$r->sec]['clagob'] = $r->clagob;
                $a[$r->sec]['susa'] = $r->susa;
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
    public function precios()
    {
        $s = "select b.prvbase, b.costobase,a.*, b.sec,b.clagob,b.cans,b.susa,(b.cans*b.costo)as impo,b.costo,
        c.corto, d.corto as prvbasex 
        from orden_c a
left join orden_d b on b.id_ped=a.id_ped and b.prv=a.prv and a.almacen=b.almacen
left join catalogo.provedor c on c.prov=a.prv
left join catalogo.provedor d on d.prov=b.prvbase
where a.tipo='A' and (costobase*1.05)<costo and autoriza='0000-00-00'
";
        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $b = 0;
            foreach ($q->result() as $r) {
                //fechag, clasi, almacen, almacenx, impo
                $a[$r->prv]['uno'][$r->sec]['fecha_ped'] = $r->fecha_ped;
                $a[$r->prv]['uno'][$r->sec]['prv'] = $r->prv;
                $a[$r->prv]['uno'][$r->sec]['id_ped'] = $r->id_ped;
                $a[$r->prv]['uno'][$r->sec]['corto'] = $r->corto;
                $a[$r->prv]['uno'][$r->sec]['sec'] = $r->sec;
                $a[$r->prv]['uno'][$r->sec]['clagob'] = $r->clagob;
                $a[$r->prv]['uno'][$r->sec]['susa'] = $r->susa;
                $a[$r->prv]['uno'][$r->sec]['segundo'][$r->almacen]['almacen'] = $r->almacen;
                $a[$r->prv]['uno'][$r->sec]['segundo'][$r->almacen]['prvbasex'] = $r->prvbasex;
                $a[$r->prv]['uno'][$r->sec]['segundo'][$r->almacen]['cans'] = $r->cans;
                $a[$r->prv]['uno'][$r->sec]['segundo'][$r->almacen]['costo'] = $r->costo;
                $a[$r->prv]['uno'][$r->sec]['segundo'][$r->almacen]['costobase'] = $r->
                    costobase;
                $a[$r->prv]['uno'][$r->sec]['segundo'][$r->almacen]['impo'] = $r->impo;
            }
        } else {
            $a = 0;
        }
        return $a;
    }

    ////////////////////////////////////////////////////compra_pedidos
    public function com_pedido()
    {
        $id_user = $this->session->userdata('id');
        $s = "select a.*, b.nombre as almacenx,c.razo as prvx,
    (select sum(ped*costo) from compras.pedido_d where id_cc=a.id)as importe,
    ifnull((SELECT count(*) FROM compras.pedido_d x where id_cc=a.id and ped>0 and costo>(costobase*1.07) and val=0 group by id_cc),0)as valida 
    From compras.pedido_c a 
    left join catalogo.cat_almacenes b on b.tipo=a.almacen
    left join catalogo.provedor c on c.prov=a.prv
    where a.tipo='A' and id_user=$id_user order by id desc ";
        $q = $this->db->query($s);
        return $q;
    }
    public function com_pedido_det($id)
    {
        $id_user = $this->session->userdata('id');
        $s = "select a.*,b.razo as prvx,c.corto as prvbasex From compras.pedido_d a
    left join catalogo.provedor b on b.prov=a.prv
    left join catalogo.provedor c on c.prov=a.prvbase
    where id_cc=$id order by fecha desc";
        $q = $this->db->query($s);
        return $q;
    }
       public function com_pedido_det_clave($id)
    {
        $id_user = $this->session->userdata('id');
        $s = "select a.*,b.razo as prvx,c.corto as prvbasex From compras.pedido_d a
    left join catalogo.provedor b on b.prov=a.prv
    left join catalogo.provedor c on c.prov=a.prvbase
    where id_cc=$id order by fecha desc";
        $q = $this->db->query($s);
        return $q;
    }

    public function agrega_pedido_det($id_cc, $sec, $can, $regalo, $descu)
    {
        $s = "select a.*,b.almacen from catalogo.cat_nuevo_general_sec a,compras.pedido_c b where sec=$sec and b.id=$id_cc ";
        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $ss = "select *from compras.pedido_d where id_cc=$id_cc and sec=$sec";
            $qq = $this->db->query($ss);
            if ($qq->num_rows() == 0) {
                $r = $q->row();
                $data = array( //id, id_cc, almacen, sec, clagob, codigo, susa, inv, ped, prv, costo
                    'id_cc' => $id_cc,
                    'almacen' => $r->almacen,
                    'sec' => $sec,
                    'clagob' => $r->clave,
                    'codigo' => 0,
                    'susa' => $r->susa,
                    'inv' => 0,
                    'ped' => $can,
                    'prv' => $r->prv,
                    'regalo' => $regalo,
                    'descu' => $descu,
                    'costo' => $r->cos);
                $this->db->insert('compras.pedido_d', $data);
            }
        }
    }
public function agrega_pedido_det_cla($id_cc, $codigo, $can, $regalo, $costo)
    {
        $s = "select a.*,b.almacen,b.prv from catalogo.cat_nuevo_general a,compras.pedido_c b where codigo=$codigo and b.id=$id_cc ";
        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $ss = "select *from compras.pedido_d where id_cc=$id_cc and codigo=$codigo";
            $qq = $this->db->query($ss);
            if ($qq->num_rows() == 0) {
                $r = $q->row();
            $ff="select *From catalogo.cat_nuevo_general_prv where clagob='$r->clagob' and preferencia='S'";
            $fq=$this->db->query($ff);
            if ($fq->num_rows() > 0){$fr=$fq->row();$cosb=$fr->costo;$prvb=$fr->prv;}else{$cosb=0;$prvb=0;}
                
                $data = array( //id, id_cc, almacen, sec, clagob, codigo, susa, inv, ped, prv, costo
                    'id_cc' => $id_cc,
                    'folprv' => 0,
                    'almacen' => $r->almacen,
                    'sec' => $r->sec_cedis,
                    'clagob' => $r->clagob,
                    'codigo' => $codigo,
                    'susa' => trim($r->susa).' '.trim($r->gramaje).' '.trim($r->contenido).' '.trim($r->presenta),
                    'descri' => trim($r->marca_comercial).' '.trim($r->gramaje).' '.trim($r->contenido).' '.trim($r->presenta),
                    'inv' => 0,
                    'ped' => $can,
                    'prv' => $r->prv,
                    'regalo' => $regalo,
                    'descu' => 0,
                    'costo' => $costo,
                    'costobase' => $cosb,
                    'prvbase' => $prvb,
                    'fecha'=>date('Y-m-d H:i:s'));
                $this->db->insert('compras.pedido_d', $data);
            }
        }
    }
    public function agrega_pedido_det_prv_sec($alm, $prv, $cia,$lic)
    {

        $data = array(
            'fecha' => date('Y-m-d'),
            'id_user' => $this->session->userdata('id'),
            'almacen' => $alm,
            'licita' => $lic,
            'prv' => $prv,
            'cia' => $cia);
        $this->db->insert('compras.pedido_c', $data);
        $id_cc = $this->db->insert_id();
        $s = "insert ignore into compras.pedido_d(id_cc, almacen, sec, clagob, codigo, susa, descri,inv, ped, prv,
      costo,costobase,prvbase)
     (select $id_cc,'$alm',a.sec,a.clagob,a.codigo,concat(trim(b.susa),' ',trim(b.gramaje),' ',trim(b.contenido),' ',trim(b.presenta)),
     concat(trim(b.marca_comercial),' ',trim(b.gramaje),' ',trim(b.contenido),' ',trim(b.presenta)),
     0,0,a.prv,a.costo,c.cos,c.prv from catalogo.cat_nuevo_general_prv a
     left join catalogo.cat_nuevo_general b on a.codigo=b.codigo
     left join catalogo.cat_nuevo_general_sec c on c.sec=a.sec 
     where a.prv=$prv and a.sec>0 and b.susa is not null group by a.clagob,a.sec,a.codigo)";
        $this->db->query($s);
    }

    public function agrega_pedido_det_prv_cla($alm, $prv, $cia,$lic)
    {

    

        $data = array(
            'fecha' => date('Y-m-d'),
            'id_user' => $this->session->userdata('id'),
            'almacen' => $alm,
            'prv' => $prv,
            'licita' => $lic,
            'cia' => $cia);
        $this->db->insert('compras.pedido_c', $data);
        $id_cc = $this->db->insert_id();
if($prv<>9998){
        $s = "insert ignore into compras.pedido_d(id_cc, almacen, sec, clagob, codigo, susa,descri, inv, ped, prv, costo,costobase,prvbase)
     (select $id_cc,'$alm',a.sec,a.clagob,a.codigo,concat(trim(b.susa),' ',trim(b.gramaje),' ',trim(b.contenido),' ',trim(b.presenta)),
     concat(trim(b.marca_comercial),' ',trim(b.gramaje),' ',trim(b.contenido),' ',trim(b.presenta)),
     0,0,a.prv,a.costo,c.cos,c.prv from catalogo.cat_nuevo_general_prv a
     left join catalogo.cat_nuevo_general b on a.codigo=b.codigo
     left join catalogo.cat_nuevo_general_cla c on c.clagob=a.clagob 
     where a.prv=$prv and a.clagob>' ' and b.susa is not null group by a.clagob,a.sec,a.codigo)";
        $this->db->query($s);
}
    }
    public function com_cerrar_pedido($id)
    {
        $s = "delete from compras.pedido_d where ped=0 and id_cc=$id";
        $this->db->query($s);
        $s1 = "select a.*from catalogo.foliador1 a,compras.pedido_c b where a.clav='osi' and b.tipo='A' and b.folprv=0";
        $q1 = $this->db->query($s1);
        if ($q1->num_rows() > 0) {
            $r1 = $q1->row();
            $ac0 = array('folprv' => $r1->num, 'fecha' => date('Y-m-d H:i:s'));
            $this->db->where('id_cc', $id);
            $this->db->update('compras.pedido_d', $ac0);
            $ac1 = array(
                'tipo' => 'C',
                'folprv' => $r1->num,
                'fecha' => date('Y-m-d'));
            $this->db->where('id', $id);
            $this->db->update('compras.pedido_c', $ac1);
            $ac2 = array('num' => $r1->num + 1);
            $this->db->where('clav', 'osi');
            $this->db->update('catalogo.foliador1', $ac2);
            $folprv=$r1->num;
        }
        $sq = "select * from compras.orden_c where folprv=$folprv";
        $qm= $this->db->query($sq);
        if ($qm->num_rows() == 0) {
      $gra1="insert into compras.orden_c
(id_estado, prv, fecha_captura, fecha_envio, fecha_limite, tipo, id_responsable, id_captura, folprv, cia,base)
(SELECT b.id, a.prv, a.fecha,a.fecha, date_add(a.fecha,interval 10 day), 1,
ifnull(c.responsable,0), a.id_user, a.folprv, a.cia,2
FROM compras.pedido_c a
left join compras.numero_de_licitaciones b on b.edo=a.almacen
left join compras.usuarios c on c.id=a.id_user
where a.tipo='C' and a.folprv=$folprv)";
$this->db->query($gra1);
      $gra2="insert ignore into orden_d(id_orden, codigo, sec, clagob, susa1, susa2, costo, iva, descuento, canp, cans, canr)
(SELECT b.id_orden,codigo, sec, clagob, susa, descri, costo, 0, descu, ped, ped, 0 FROM pedido_d a
left join compras.orden_c b on b.folprv=a.folprv
where b.id_orden is not null and a.folprv=$folprv and b.base=2)
";
$this->db->query($gra2);
            
    }
    }

    public function com_pedido_his()
    {
        $id_user = $this->session->userdata('id');
        $s = "select a.*, b.nombre as almacenx,c.razo as prvx,
    (select sum(ped*costo) from compras.pedido_d where id_cc=a.id)as importe,
    ifnull((SELECT count(*) FROM compras.pedido_d x where id_cc=a.id and ped>0 and costo>(costobase*1.07) and val=0 group by id_cc),0)as valida 
    From compras.pedido_c a 
    left join catalogo.cat_almacenes b on b.tipo=a.almacen
    left join catalogo.provedor c on c.prov=a.prv
    where a.tipo='C'  order by id desc ";
        $q = $this->db->query($s);
        return $q;
        //echo $this->db->last_query();
        //die();
    }
    public function com_pedido_det_his($id)
    {
        $id_user = $this->session->userdata('id');
        $s = "select a.*,b.razo as prvx,c.corto as prvbasex, 0 as iva From compras.pedido_d a
    left join catalogo.provedor b on b.prov=a.prv
    left join catalogo.provedor c on c.prov=a.prvbase
    where id_cc=$id and (ped+regalo)>0 order by fecha desc";
        $q = $this->db->query($s);
        return $q;
        //echo $this->db->last_query();
        //die();
    }
    public function pedido_far_pend()
    {
        $id_user = $this->session->userdata('id');
        $s = "SELECT folio,a.*,
ifnull((select sum(invf) from almacen.control_invd x where invf>0 and x.clave=a.clave group by x.clave),0)as exis
 FROM almacen.salidas_ped_det a
left join almacen.salidas_ped b on b.id=a.id_cc
where a.tipo='C' and a.sur<a.ped order by fecha desc,folio desc";
        $q = $this->db->query($s);
        return $q;
    }
    public function precios_mal()
    {
        $id_user = $this->session->userdata('id');
        $s = "SELECT d.fecha as fecc,ifnull(f.codigo,0),f.costo as costo_alterno,f.prv as prv_alterno,
concat(trim(marca_comercial),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta))as descri,
e.nombre as id_userx,a.*,ifnull(b.razo,' ') as prvbasex,c.razo as prvx,
h.razo as prvx_alterno,f.prv as prv_alterno
FROM compras.pedido_d a
left join catalogo.provedor b on b.prov=a.prvbase
left join catalogo.provedor c on c.prov=a.prv
left join compras.pedido_c d on d.id=a.id_cc
left join compras.usuarios e on e.id=d.id_user
left join catalogo.cat_nuevo_general_prv f on f.clagob=a.clagob and f.prv<>a.prv
left join catalogo.cat_nuevo_general g on g.codigo=f.codigo
left join catalogo.provedor h on h.prov=f.prv
where a.ped>0 and a.val=0 and d.fecha>=subdate(date(now()),interval 90 day) 
";
        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $b = 0;
            foreach ($q->result() as $r) {
                //fechag, clasi, almacen, almacenx, impo
                $a[$r->clagob]['id'] = $r->id;
                $a[$r->clagob]['id_cc'] = $r->id_cc;
                $a[$r->clagob]['id_userx'] = $r->id_userx;
                $a[$r->clagob]['fecc'] = $r->fecc;
                $a[$r->clagob]['sec'] = $r->sec;
                $a[$r->clagob]['clagob'] = $r->clagob;
                $a[$r->clagob]['susa'] = $r->susa;
                $a[$r->clagob]['costobase'] = $r->costobase;
                $a[$r->clagob]['prvbasex'] = $r->prvbasex;
                $a[$r->clagob]['ped'] = $r->ped;
                $a[$r->clagob]['costo'] = $r->costo;
                $a[$r->clagob]['regalo'] = $r->regalo;
                $a[$r->clagob]['descu'] = $r->descu;
                $a[$r->clagob]['prv'] = $r->prv;
                $a[$r->clagob]['prvx'] = $r->prvx;
                
                $a[$r->clagob]['uno'][$r->prv_alterno]['prv_alterno'] = $r->prv_alterno;
                $a[$r->clagob]['uno'][$r->prv_alterno]['prvx_alterno'] = $r->prvx_alterno;
                $a[$r->clagob]['uno'][$r->prv_alterno]['costo_alterno'] = $r->costo_alterno;

            }
        } else {
            $a = 0;
        }
        return $a;

    }
    public function precios_mal_r($fec1, $fec2)
    {
        $fec1 = $fec1 . ' 00:00:00';
        $fec2 = $fec2 . ' 23:59:59';
        $id_user = $this->session->userdata('id');
        $s = "SELECT f.codigo,f.costo as costo_alterno,f.prv as prv_alterno,
concat(trim(marca_comercial),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta))as descri,
e.nombre as id_userx,a.*,b.razo as prvbasex,c.razo as prvx,
h.razo as prvx_alterno,f.prv as prv_alterno
FROM compras.pedido_d a
left join catalogo.provedor b on b.prov=a.prvbase
left join catalogo.provedor c on c.prov=a.prv
left join compras.pedido_c d on d.id=a.id_cc
left join compras.usuarios e on e.id=d.id_user
left join catalogo.cat_nuevo_general_prv f on f.clagob=a.clagob and f.prv<>a.prv
left join catalogo.cat_nuevo_general g on g.codigo=f.codigo
left join catalogo.provedor h on h.prov=f.prv
where a.costo>a.costobase and a.ped>0 and a.val=1 and a.fecha_val between '$fec1' and '$fec2'";

        $q = $this->db->query($s);
        if ($q->num_rows() > 0) {
            $b = 0;
            foreach ($q->result() as $r) {
                //fechag, clasi, almacen, almacenx, impo
                $a[$r->clagob]['id'] = $r->id;
                $a[$r->clagob]['id_cc'] = $r->id_cc;
                $a[$r->clagob]['id_userx'] = $r->id_userx;
                $a[$r->clagob]['sec'] = $r->sec;
                $a[$r->clagob]['codigo'] = $r->codigo;
                $a[$r->clagob]['clagob'] = $r->clagob;
                $a[$r->clagob]['susa'] = $r->susa;
                $a[$r->clagob]['costobase'] = $r->costobase;
                $a[$r->clagob]['prvbasex'] = $r->prvbasex;
                $a[$r->clagob]['ped'] = $r->ped;
                $a[$r->clagob]['costo'] = $r->costo;
                $a[$r->clagob]['regalo'] = $r->regalo;
                $a[$r->clagob]['descu'] = $r->descu;
                $a[$r->clagob]['prv'] = $r->prv;
                $a[$r->clagob]['prvx'] = $r->prvx;
                $a[$r->clagob]['uno'][$r->prv_alterno]['prv_alterno'] = $r->prv_alterno;
                $a[$r->clagob]['uno'][$r->prv_alterno]['prvx_alterno'] = $r->prvx_alterno;
                $a[$r->clagob]['uno'][$r->prv_alterno]['costo_alterno'] = $r->costo_alterno;

            }
        } else {
            $a = 0;
        }
        return $a;
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function far_pedido()
    {
        $id_user = $this->session->userdata('id');
        $s = "select a.*,b.nombre as sucx From almacen.salidas_ped a
    left join catalogo.sucursal b on b.suc=a.suc
    where a.tipo='A'";
        $q = $this->db->query($s);
        return $q;
    }
    public function far_pedido_det($id)
    {
        $id_user = $this->session->userdata('id');
        $s = "select a.* From almacen.salidas_ped_det a
    where a.tipo='A' and id_cc=$id";
        $q = $this->db->query($s);
        return $q;
    }
    public function graba_far_pedido_det($id_cc, $codigo, $can,$receta)
    {
        $s = "insert into almacen.salidas_ped_det(id_cc, fecha, clave, codigo, susa, descri, ped, costo, tipo, sec,receta)
(select $id_cc,date(now()),clagob,$codigo,concat(trim(b.susa),' ',trim(b.gramaje),' ',trim(b.contenido),' ',trim(b.presenta)),
concat(trim(b.marca_comercial),' ',trim(b.gramaje),' ',trim(b.contenido),' ',trim(b.presenta)),$can,0,'A',0,'$receta' from catalogo.cat_nuevo_general b
where codigo=$codigo)";
        $this->db->query($s);
    }


    public function far_pedido_det_cer($id_cc)
    {
        $id_user = $this->session->userdata('id');
        $s = "select a.num from  catalogo.foliador a,almacen.salidas_ped b  where clav='ccc' and b.id=$id_cc and folio=0";
        $q = $this->db->query($s);
        if ($q->num_rows() == 1) {
            $r = $q->row();
            $s1 = "insert into almacen.salidas_c
(folio, stat, sucursal, aaap, mesp, diap, aaas, mess, dias, clavep, claves,
cantidadp, cantidads, edo,  sec, folret, codigo)
(select $r->num,'A',suc,year(now()),month(now()),day(now()),0,0,0,clave,clave,sum(ped),sum(ped),'con',sec,id_cc,codigo
 from almacen.salidas_ped_det a left join almacen.salidas_ped b on b.id=a.id_cc where id_cc=$id_cc group by a.clave)";
            $this->db->query($s1);
            $s2 = "insert into almacen.salidas_cc (folio, stat, sucursal, aaap, mesp, diap, aaas, mess, dias, userid)
(select $r->num,'A',suc,year(now()),month(now()),day(now()),0,0,0,$id_user from almacen.salidas_ped where id=$id_cc and folio=0)";
            $this->db->query($s2);
            $a = array('tipo' => 'C');
            $this->db->where('id_cc', $id_cc);
            $this->db->update('almacen.salidas_ped_det', $a);

            $b = array('tipo' => 'C', 'folio' => $r->num);
            $this->db->where('id', $id_cc);
            $this->db->update('almacen.salidas_ped', $b);

            $c = array('num' => $r->num + 1);
            $this->db->where('clav', 'ccc');
            $this->db->update('catalogo.foliador', $c);
        }
    }

    public function far_pedido_his()
    {
        $id_user = $this->session->userdata('id');
        $s = "select a.*,b.nombre as sucx From almacen.salidas_ped a
    left join catalogo.sucursal b on b.suc=a.suc
    where a.tipo='C' order by folio desc";
        $q = $this->db->query($s);
        return $q;
    }
    public function far_pedido_det_his($id)
    {
        $id_user = $this->session->userdata('id');
        $s = "select b.folio, a.id_cc, a.fecha, a.clave, a.codigo, a.susa, a.descri, sum(ped) as ped, a.costo, a.id, a.tipo, a.sec, a.receta, a.sur,
ifnull((select sum(cantidads) from almacen.salidas_c x where x.folio=b.folio and x.claves=a.clave),0)as surti
From almacen.salidas_ped_det a
left join almacen.salidas_ped b on b.id=a.id_cc
where a.tipo='C' and a.id_cc=$id
group by clave
order by clave";
        $q = $this->db->query($s);
        return $q;
    }
     public function far_pedido_rec()
    {$aaa=date('Y');
        $id_user = $this->session->userdata('id');
        $s = "select b.folio,b.suc,sum(ped)as ped,c.nombre,a.receta,a.fecha,
ifnull((select (cantidads) from almacen.salidas_c x where x.folio=b.folio and x.claves=a.clave 
group by x.folio,x.claves),0)as surti
From almacen.salidas_ped_det a
left join almacen.salidas_ped b on b.id=a.id_cc
left join catalogo.sucursal c on c.suc=b.suc
where a.tipo='C' and receta<>' '  and date_format(a.fecha,'%Y')=$aaa group by receta";
        $q = $this->db->query($s);
        return $q;
    }
public function far_pedido_rec_una($receta)
    {$aaa=date('Y');
        $id_user = $this->session->userdata('id');
        $s = "select a.clave,a.descri,a.susa,b.folio,b.suc,(ped)as ped,c.nombre,a.receta,a.fecha,
x.cantidads as surti
From almacen.salidas_ped_det a
left join almacen.salidas_ped b on b.id=a.id_cc
left join catalogo.sucursal c on c.suc=b.suc
left join almacen.salidas_c x on x.folio=b.folio and x.claves=a.clave
where a.tipo='C' and receta like '%$receta%'  and date_format(a.fecha,'%Y')=$aaa";
        $q = $this->db->query($s);
        return $q;
    }    
    public function actualiza_detalle_pedido($id, $pedido)
    {
        $this->db->where('id', $id);
        $this->db->set('ped', $pedido);
        $this->db->update('compras.pedido_d');
        return $this->calcula_importe($id);
    }
    
    public function actualiza_detalle_descuento($id, $descuento)
    {
        $this->db->where('id', $id);
        $this->db->set('descu', $descuento);
        $this->db->update('compras.pedido_d');
        return $this->calcula_importe($id);
    }

    public function actualiza_detalle_regalo($id, $regalo)
    {
        $this->db->where('id', $id);
        $this->db->set('regalo', $regalo);
        $this->db->update('compras.pedido_d');
        return $this->calcula_importe($id);
    }
    public function actualiza_detalle_costo($id, $costo)
    {
        $this->db->where('id', $id);
        $this->db->set('costo', $costo);
        $this->db->update('compras.pedido_d');
        return $this->calcula_importe($id);
    }

    function calcula_importe($id)
    {
        $this->db->select('ped, (ped*costo) as importe, (ped * (costo * (descu/100))) as descuento, (ped*costo) - (ped * (costo * (descu/100))) as total', FALSE);
        $this->db->where('id', $id);
        $query = $this->db->get('compras.pedido_d');
        
        $row = $query->row();
        
        return number_format($row->ped, 2)."|".number_format($row->importe, 2)."|".number_format($row->descuento, 2)."|".number_format($row->total, 2);
        
    }

//////////////////////////////////////////////////////////////////////////////Mover a insumos
//////////////////////////////////////////////////////////////////////////////Mover a insumos
//////////////////////////////////////////////////////////////////////////////Mover a insumos
function val_pedido_ins($id_plaza)
{
    $s="SELECT a.suc,c.nombre as sucx, b.descri, a.id, fecha_cap,
(select sum(canp_sup*costo) from papeleria.insumos_d x where x.id_cc=a.id)as imp
FROM papeleria.insumos_c a
join catalogo.cat_insumos_compra b on b.id_insumo=a.id_comprar
join catalogo.sucursal c on c.suc=a.suc  and superv=$id_plaza
where tipo=0 and stat_sup='B'";
$q=$this->db->query($s);
return $q;
}
function val_pedido_no_terminados($id_plaza)
{
    $s="SELECT a.suc,c.nombre as sucx, b.descri, a.id, fecha_cap,
(select sum(canp_sup*costo) from papeleria.insumos_d x where x.id_cc=a.id)as imp
FROM papeleria.insumos_c a
join catalogo.cat_insumos_compra b on b.id_insumo=a.id_comprar
join catalogo.sucursal c on c.suc=a.suc  and superv=$id_plaza
where tipo=0";
$q=$this->db->query($s);
return $q;
}
function val_pedido_ins_det($id_cc)
{
    $s="SELECT b.descripcion,a.* FROM papeleria.insumos_d a
join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
where id_cc=$id_cc";
$q=$this->db->query($s);
return $q;
}

function val_pedido_ins_det_uno($id_cc,$id)
{
    $s="SELECT b.descripcion,a.* FROM papeleria.insumos_d a
join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
where id_cc=$id_cc and a.id=$id";
$q=$this->db->query($s);
return $q;
}


function inserta_insumos_s($id_cc)
{

$s="insert ignore into papeleria.insumos_s
(id_cc, id_dd, fol, id_insumos, canp, cans,fecha_cap, tipo, costo, costo_cat, canr, fecha_sur, fecha_val)

(SELECT
b.id_cc, b.id,'A',b.id_insumos, canp_sup,canp_sup, b.fecha_cap, 1, b.costo, b.costo_cat, canp_sup,date(now()),'0000-00-00'
FROM papeleria.insumos_c a, papeleria.insumos_d b
where a.tipo=0 and canp_sup>0 and a.id=b.id_cc and a.id=$id_cc and a.stat_sup='B')";
$this->db->query($s);

$a=array('tipo'=>1,'fecha_cierre'=>date('Y-m-d H:i:s'),'stat_sup'=>'C');
$this->db->where('id',$id_cc);
$this->db->update('papeleria.insumos_c',$a);
        
}

function val_pedido_ins_his($id_plaza)
{
    $s="SELECT
b.suc,c.nombre as sucx,a.fecha_sur,a.fecha_cap,descri as comprax,
case
when a.tipo=1 then 'PENDIENTE POR SURTIR'
when a.tipo=2 then 'SURTIDO'
when a.tipo=3 then 'VALIDADO POR FARMACIA'
when a.tipo=4 then 'CANCELADO'
end as pedido,
b.fecha as fecha_suc,a.fecha_val,a.id_cc,a.fol,sum(cans*costo)as imp
FROM papeleria.insumos_s a
join papeleria.insumos_c b on b.id=a.id_cc
join catalogo.sucursal c on c.suc=b.suc
join catalogo.cat_insumos_compra d on d.id_insumo=b.id_comprar
where a.tipo in(1,2,3,4) and superv=$id_plaza
group by a.id_cc,a.fol
order by fecha_cap desc,fecha_sur,fecha_val";
$q=$this->db->query($s);
return $q;
}
function val_pedido_ins_his_det($id_plaza,$id_cc,$fol)
{
    $s="SELECT

a.fecha_val,
a.id_cc,a.fol,a.id_insumos,d.descripcion,canr,(cans*a.costo)as imp
FROM papeleria.insumos_s a
join papeleria.insumos_c b on b.id=a.id_cc
join catalogo.sucursal c on c.suc=b.suc
join catalogo.cat_insumos d on d.id_insumos=a.id_insumos
where a.tipo in(1,2,3) and superv=$id_plaza and a.id_cc=$id_cc and a.fol='$fol'";
$q=$this->db->query($s);
return $q;
}
function val_pedido_ins_his_glo($id_plaza)
{
    $s="select 0 as id_cc,a.suc, a.nombre,'PEDIDO A OFICINAS MEDICOS'as comprarx,'0000-00-00' as fecha_cap,'NO GENERO PEDIDO A OFICINAS DE MEDICOS' as obs
from catalogo.sucursal a
left join papeleria.insumos_c b on b.id_comprar=3 and a.suc=b.suc and b.tipo<>4 and fecha_cap>=subdate(date(now()),31)
join catalogo.cat_medicos c on c.matutino=a.suc or c.vespertino=a.suc
where
tlid=1 and dia<>'CER' and a.regional=$id_plaza and b.id is null or
tlid=1 and dia<>'CER' and a.superv=$id_plaza and b.id is null
union all
select 0 as id_cc,a.suc, a.nombre,'PEDIDO A OFICINAS FARMACIAS'as comprarx,'0000-00-00' as fecha_cap,'NO GENERO PEDIDO A OFICINAS FARMACIAS' as obs
from catalogo.sucursal a
left join papeleria.insumos_c b on b.id_comprar=1 and a.suc=b.suc and b.tipo<>4 and fecha_cap>=subdate(date(now()),31)
where
tlid=1 and dia<>'CER' and a.regional=$id_plaza and b.id is null or
tlid=1 and dia<>'CER' and a.superv=$id_plaza and b.id is null
union all
select a.id as id_cc,a.suc,c.nombre,b.descri as comprarx,a.fecha_cap,
case
when tipo in(1,2,3) and stat_sup='C' then 'VALIDADO POR SUPERVISOR'
when tipo=4 then 'CANCELADO'
when tipo=0 then 'SUCURSAL NO VALIDO SU CAPTURA'
end as obs
from papeleria.insumos_c a
join catalogo.cat_insumos_compra b on b.id_insumo=a.id_comprar
join catalogo.sucursal c on c.suc=a.suc
where
fecha_cap>=subdate(date(now()),31) and regional=$id_plaza or
fecha_cap>=subdate(date(now()),31) and superv=$id_plaza
";
$q=$this->db->query($s);
return $q;
}
//////////////////////////////////////////////////////////////////////////////Mover a insumos
//////////////////////////////////////////////////////////////////////////////Mover a insumos
//////////////////////////////////////////////////////////////////////////////Mover a insumos




/*****************************Pedidos especial FANASA**************************************/

   function busca_sucursal_feni($id_plaza)
    {

        $sql = "select suc,nombre from catalogo.sucursal where tipo2='F' and tlid=1 and superv=$id_plaza";
        $query = $this->db->query($sql);
        $suc = array();
        $suc[0] = 'Seleccione Sucursal';

        foreach ($query->result() as $row) {
            $suc[$row->suc] = $row->suc. ' - ' . $row->nombre;
        }

        return $suc;
            }

   function ins_pre_pedido($data,$code){

        $s = "SELECT * FROM catalogo.cat_fanasa 
             WHERE Date_format(fecha_modificado,'%Y-%m-%d')=curdate() and codigo=$code";

        $q = $this->db->query($s);

        if ($q->num_rows() > 0)
            {
        
                foreach ($q->result() as $r) {
                   $a['codigo'] = $r->codigo;    
                   $a['descripcion'] = $r->descripcion;                
                }
               
                  $datos =array(
                  'suc'=>$data['suc'],
                  'activo'=>$data['activo'],
                  'piezas'=>$data['piezas'],
                  'fecha'=>date('Y-m-d'),
                  'cod'=>$a['codigo'],
                  'descri'=>$a['descripcion'],
                  'prv'=>825
                   );
                              
                $this->db->insert('compras.pre_pedido_fenix ',$datos);
            } else {
                                            
                    return $success=0;

              }
   
     }


    function desc_pend_pre_pedido($id_plaza){

            $s = "select a.*,b.nombre, b.superv from compras.pre_pedido_fenix a,catalogo.sucursal b
                    where a.activo=0 and a.fecha=curdate() and a.suc=b.suc and b.superv=$id_plaza";
            $q = $this->db->query($s);
        return $q;
        }

    function upd_pre_pedido($suc,$cod){

        $data = array(
        'activo' => 1,
        'fecha'=>date('Y-m-d')
         );

        $this->db->where('suc', $suc);
        $this->db->where('cod', $cod);
        $this->db->where('fecha',$data['fecha']);
        $this->db->update('compras.pre_pedido_fenix', $data);
        }

    function del_cod_pre_pedido($suc,$cod){
        $data = array(
        'fecha'=>date('Y-m-d')
         );

        $this->db->where('suc', $suc);
        $this->db->where('cod', $cod);
        $this->db->where('fecha',$data['fecha']);
       

        $this->db->delete('compras.pre_pedido_fenix');
     }

     function desc_pre_pedido_fen($id_plaza){

            $s = "select a.*,b.nombre, b.superv from compras.pre_pedido_fenix a,catalogo.sucursal b
                    where a.activo in(1,3) and a.fecha=curdate() and a.suc=b.suc and b.superv=$id_plaza";
            $q = $this->db->query($s);
        return $q;
        }


    function bus_cod_fanasa($descripcion){

            $s = "SELECT * FROM catalogo.cat_fanasa where  Date_format(fecha_modificado,'%Y-%m-%d')=curdate() and descripcion like'%$descripcion%' order by descripcion";
            $q2 = $this->db->query($s);
        return $q2;

        }

     function bus_cod_fanas($codigo){

        $sql = " SELECT codigo,descripcion FROM catalogo.cat_fanasa where codigo = $codigo order by codigo; ";
        $query2 = $this->db->query($sql);        
         if($query2->num_rows() == 0){
            $des_resp = "<font color='orange'>El codigo que usted ingreso no esta disponible </font>";

         }else{
       
        foreach($query2->result() as $row){
             $des_resp=$row->descripcion;
            
         } 
        }  
        return $des_resp;  

     }


     function buscar_suc_fen_act(){
        $sql = "select suc, nombre from catalogo.sucursal where tipo2='F' and tlid=1 and superv>0 or suc in(515,831) order by nombre";
        $query = $this->db->query($sql);
        $suc = array();
        $suc[0] = 'Seleccione Sucursal';

        foreach ($query->result() as $row) {
            $suc[$row->suc] = $row->suc. ' - ' . $row->nombre;
        }

        return $suc;
            }



    function sol_pedido_sup(){

         $s = "select a.fecha,a.suc,b.nombre,b.superv,c.nombre as nom_sup, a.activo,sum(case when d.iva>0 then ((piezas*costo)*(b.iva+1)) else (piezas*costo) end)as imp,
                sum(piezas)as piezas, count(*) as registros
                 from compras.pre_pedido_fenix a,catalogo.sucursal b , compras.usuarios c,catalogo.cat_fanasa d
                    where a.cod=d.codigo and a.suc=b.suc and b.superv=c.id_plaza and a.activo =1 and a.fecha=curdate()
                      group by fecha,suc";
            $q = $this->db->query($s);
        return $q;
    }


    function ver_pedido_suc_f($suc){
        $s = "select a.*, b.costo,case when b.iva>0 then ((a.piezas*b.costo)*(b.iva+1)) else (a.piezas*b.costo) end as imp
                 FROM compras.pre_pedido_fenix a, catalogo.cat_fanasa b
                     where  a.cod=b.codigo and fecha=curdate() and suc=$suc and activo=1";
            $q = $this->db->query($s);
        
        if($q->num_rows() <= 0){
     redirect('pedido/ped_esp_sucur_fen');
        }else {
        return $q;
        }

    }

    function upd_pre_pedido_c($suc,$cod){

        $data = array(
        'activo' => 4,
        'fecha'=>date('Y-m-d')
         );

        $this->db->where('suc', $suc);
        $this->db->where('cod', $cod);
        $this->db->where('fecha',$data['fecha']);
        $this->db->update('compras.pre_pedido_fenix', $data);

        }

    function actualiza_ped_com($suc){

        $data = array(
        'activo' => 3,
        'fecha'=>date('Y-m-d')
         );

        $this->db->where('activo', 1);
        $this->db->where('suc', $suc);
        $this->db->where('fecha',$data['fecha']);
        $this->db->update('compras.pre_pedido_fenix', $data);
        }


    function ped_autoriza_compr(){
         $s = "select a.fecha,a.suc,b.nombre,b.superv,c.nombre as nom_sup, a.activo
                 from compras.pre_pedido_fenix a,catalogo.sucursal b , compras.usuarios c
                    where a.suc=b.suc and b.superv=c.id_plaza and a.activo =3 and a.fecha=curdate()
                      group by fecha,suc";
            $q1 = $this->db->query($s);
        return $q1;        

        }

    function ver_pedido_a_com($suc){
         $s = "select * FROM compras.pre_pedido_fenix  where suc=$suc and fecha=curdate() and activo=3";
            $q = $this->db->query($s);
        return $q;

    }

    function desc_ppedido_f_com(){
            $s = "select a.*,b.nombre, b.superv from compras.pre_pedido_fenix a,catalogo.sucursal b
                    where a.activo=2 and a.fecha=curdate() and a.suc=b.suc ";
            $q = $this->db->query($s);
        return $q;
        }

  function actualiza_pp_com($suc,$codigo){

        $data = array(
        'activo' => 3,
        'fecha'=>date('Y-m-d')
         );

        $this->db->where('activo', 2);
        $this->db->where('suc', $suc);
        $this->db->where('fecha',$data['fecha']);
        $this->db->update('compras.pre_pedido_fenix', $data);

        }


    function pp_act_compras(){
        $s = "select a.*,b.nombre, b.superv from compras.pre_pedido_fenix a,catalogo.sucursal b
                    where a.activo=3 and a.fecha=curdate() and a.suc=b.suc ";
            $q1 = $this->db->query($s);
        return $q1;


    }









}
