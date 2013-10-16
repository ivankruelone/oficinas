<?php
class Pedido_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function generar_sumit($por1, $por2, $por3, $por4, $por5, $alm)
    {
       $aa=date('m');
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
                $a[$r->fechag]['segundo'][$r->almacen]['tercero'][$r->clasi]['clasi'] = $r->clasi;
                $a[$r->fechag]['segundo'][$r->almacen]['tercero'][$r->clasi]['clasi'] = $r->clasi;
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
                $a[$r->id_ped]['segundo'][$r->prv]['tercero'] [$r->almacen]['almacen']= $r->almacen;
                $a[$r->id_ped]['segundo'][$r->prv]['tercero'] [$r->almacen]['impo']= $r->impo;
            }
        } else {
            $a = 0;
        }
        return $a;
    }
  public function pedido_compra_detalle($prv,$id_ped)
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
                $a[$r->prv]['uno'][$r->sec]['segundo'][$r->almacen]['costobase'] = $r->costobase;
                $a[$r->prv]['uno'][$r->sec]['segundo'][$r->almacen]['impo'] = $r->impo;
            }
        } else {
            $a = 0;
        }
        return $a;
    }   
    
 



















}
