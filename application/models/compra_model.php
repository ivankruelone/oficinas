<?php
class Compra_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////pago mayoristas
function pago_mayoristas()
{
$s="SELECT year(fecven)as aaa,ifnull(b.num,0)as mes,ifnull(b.mes,' ')as mesx,sum(imp_prv)as imp_prv,sum(imp_cxp)as imp_cxp
FROM compras.pre_factura_fenix_ctl a
left join catalogo.mes b on b.num=month(fecven)
group by month(fecven)
order by num";
$q=$this->db->query($s);
return $q;    
}
function pago_mayoristas_prv($aaa,$mes)
{
$s="SELECT year(fecven)as aaa,month(fecven)as mes,fecven,a.prv,b.razo,sum(imp_prv)as imp_prv,sum(imp_cxp)as imp_cxp
FROM compras.pre_factura_fenix_ctl a
left join catalogo.provedor b on b.prov=a.prv
where year(fecven)=$aaa and month(fecven)=$mes
group by fecven,prv
";
$q=$this->db->query($s);
        foreach($q->result() as $r){
            $a[$r->fecven]['aaa'] = $r->aaa;
            $a[$r->fecven]['mes'] = $r->mes;
            $a[$r->fecven]['fecven'] = $r->fecven;
            $a[$r->fecven]['segundo'][$r->prv]['prv'] = $r->prv;
            $a[$r->fecven]['segundo'][$r->prv]['razo'] = $r->prv;
            $a[$r->fecven]['segundo'][$r->prv]['imp_prv'] = $r->imp_prv;
            $a[$r->fecven]['segundo'][$r->prv]['imp_cxp'] = $r->imp_cxp;
            
        }
//'<pre>'.print_r($a).'</pre>';           
//die();
        return $a;
}
function pago_mayoristas_prv_ven($fecven)
{
$s="SELECT a.suc,b.nombre as sucx,contra,fac,year(fecven)as aaa,month(fecven)as mes,fecven,a.prv,sum(imp_prv)as imp_prv,sum(imp_cxp)as imp_cxp
FROM compras.pre_factura_fenix_ctl a
left join catalogo.sucursal b on b.suc=a.suc
where fecven='$fecven'
group by suc,prv
";
$q = $this->db->query($s);
        foreach($q->result() as $r){
            $a[$r->suc]['suc'] = $r->suc;
            $a[$r->suc]['sucx'] = $r->sucx;
            $a[$r->suc]['fecven'] = $r->fecven;
            $a[$r->suc]['segundo'][$r->prv]['prv'] = $r->prv;
            $a[$r->suc]['segundo'][$r->prv]['razo'] = $r->prv;
            $a[$r->suc]['segundo'][$r->prv]['imp_prv'] = $r->imp_prv;
            $a[$r->suc]['segundo'][$r->prv]['imp_cxp'] = $r->imp_cxp;
            
        }
        return $a;
}
function pago_mayoristas_prv_ven_suc($fecven,$suc)
{
$s="SELECT a.fecha, a.suc,b.nombre as sucx,contra,fac,year(fecven)as aaa,month(fecven)as mes,fecven,a.prv,sum(imp_prv)as imp_prv,sum(imp_cxp)as imp_cxp
FROM compras.pre_factura_fenix_ctl a
left join catalogo.sucursal b on b.suc=a.suc
where fecven='$fecven' and a.suc=$suc
group by fac,prv
";
$q = $this->db->query($s);
        foreach($q->result() as $r){
            $a[$r->fac]['suc'] = $r->suc;
            $a[$r->fac]['sucx'] = $r->sucx;
            $a[$r->fac]['fecha'] = $r->fecha;
            $a[$r->fac]['fac'] = $r->fac;
            $a[$r->fac]['fecven'] = $r->fecven;
            $a[$r->fac]['segundo'][$r->prv]['prv'] = $r->prv;
            $a[$r->fac]['segundo'][$r->prv]['razo'] = $r->prv;
            $a[$r->fac]['segundo'][$r->prv]['imp_prv'] = $r->imp_prv;
            $a[$r->fac]['segundo'][$r->prv]['imp_cxp'] = $r->imp_cxp;
            
        }
        return $a;
}

function pago_mayoristas_cal()
{
$s="SELECT year(fec_calculada)as aaa,ifnull(b.num,0)as mes,ifnull(b.mes,' ')as mesx,sum(imp_prv)as imp_prv,sum(imp_cxp)as imp_cxp
FROM compras.pre_factura_fenix_ctl a
left join catalogo.mes b on b.num=month(fec_calculada)
where year(fec_calculada)=year(date(now()))
group by month(fec_calculada)
order by num";
$q=$this->db->query($s);
return $q;    
}
function pago_mayoristas_prv_cal($aaa,$mes)
{
$s="SELECT year(fec_calculada)as aaa,month(fec_calculada)as mes,fec_calculada,a.prv,b.razo,sum(imp_prv)as imp_prv,sum(imp_cxp)as imp_cxp
FROM compras.pre_factura_fenix_ctl a
left join catalogo.provedor b on b.prov=a.prv
where year(fec_calculada)=$aaa and month(fec_calculada)=$mes
group by fec_calculada,prv
";
$q=$this->db->query($s);
        foreach($q->result() as $r){
            $a[$r->fec_calculada]['aaa'] = $r->aaa;
            $a[$r->fec_calculada]['mes'] = $r->mes;
            $a[$r->fec_calculada]['fecven'] = $r->fec_calculada;
            $a[$r->fec_calculada]['segundo'][$r->prv]['prv'] = $r->prv;
            $a[$r->fec_calculada]['segundo'][$r->prv]['razo'] = $r->prv;
            $a[$r->fec_calculada]['segundo'][$r->prv]['imp_prv'] = $r->imp_prv;
            $a[$r->fec_calculada]['segundo'][$r->prv]['imp_cxp'] = $r->imp_cxp;
            
        }
//'<pre>'.print_r($a).'</pre>';           
//die();
        return $a;
}
function pago_mayoristas_prv_ven_cal($fecven)
{
$s="SELECT a.suc,b.nombre as sucx,contra,fac,year(fec_calculada)as aaa,month(fec_calculada)as mes,fec_calculada,a.prv,sum(imp_prv)as imp_prv,sum(imp_cxp)as imp_cxp
FROM compras.pre_factura_fenix_ctl a
left join catalogo.sucursal b on b.suc=a.suc
where fec_calculada='$fecven'
group by suc,prv
";
$q = $this->db->query($s);
        foreach($q->result() as $r){
            $a[$r->suc]['suc'] = $r->suc;
            $a[$r->suc]['sucx'] = $r->sucx;
            $a[$r->suc]['fecven'] = $r->fec_calculada;
            $a[$r->suc]['segundo'][$r->prv]['prv'] = $r->prv;
            $a[$r->suc]['segundo'][$r->prv]['razo'] = $r->prv;
            $a[$r->suc]['segundo'][$r->prv]['imp_prv'] = $r->imp_prv;
            $a[$r->suc]['segundo'][$r->prv]['imp_cxp'] = $r->imp_cxp;
            
        }
        return $a;
}
function pago_mayoristas_prv_ven_suc_cal($fecven,$suc)
{
$s="SELECT a.fecha, a.suc,b.nombre as sucx,contra,fac,year(fec_calculada)as aaa,month(fec_calculada)as mes,fec_calculada,a.prv,sum(imp_prv)as imp_prv,sum(imp_cxp)as imp_cxp
FROM compras.pre_factura_fenix_ctl a
left join catalogo.sucursal b on b.suc=a.suc
where fec_calculada='$fecven' and a.suc=$suc
group by fac,prv
";
$q = $this->db->query($s);
        foreach($q->result() as $r){
            $a[$r->fac]['suc'] = $r->suc;
            $a[$r->fac]['sucx'] = $r->sucx;
            $a[$r->fac]['fecha'] = $r->fecha;
            $a[$r->fac]['fac'] = $r->fac;
            $a[$r->fac]['fecven'] = $r->fec_calculada;
            $a[$r->fac]['segundo'][$r->prv]['prv'] = $r->prv;
            $a[$r->fac]['segundo'][$r->prv]['razo'] = $r->prv;
            $a[$r->fac]['segundo'][$r->prv]['imp_prv'] = $r->imp_prv;
            $a[$r->fac]['segundo'][$r->prv]['imp_cxp'] = $r->imp_cxp;
            
        }
        return $a;
}

function compras_ventas_mes($fec)
{
$s="SELECT fechacorte,

(SELECT sum(siniva) FROM desarrollo.cortes_c x left join desarrollo.cortes_d_c01_c40 y on y.id_cc=x.id left join catalogo.sucursal c on c.suc=x.suc
 where
x.fechacorte=m.fechacorte and x.tipo>=2 and y.clave1>0 and x.suc>100 and x.suc<=899 and tipo2='F' and clave1 in(40,30) or
x.fechacorte=m.fechacorte and x.tipo>=2 and y.clave1>0 and x.suc in(176,177,178,179,180,181) and clave1 in(40,30)
group by fechacorte)as credito,

(SELECT sum(siniva) FROM desarrollo.cortes_c x left join desarrollo.cortes_d_c01_c40 y on y.id_cc=x.id left join catalogo.sucursal c on c.suc=x.suc
 where
x.fechacorte=m.fechacorte and x.tipo>=2 and y.clave1>0 and x.suc>100 and x.suc<=899 and tipo2='F' and clave1 not in(40,30) or
x.fechacorte=m.fechacorte and x.tipo>=2 and y.clave1>0 and x.suc in(176,177,178,179,180,181) and clave1 not in(40,30)
group by fechacorte)as contado,

ifnull((select sum(imp_prv) from compras.pre_factura_fenix_ctl d where d.fecha=m.fechacorte),0)as compras

 FROM desarrollo.cortes_c m where
date_format(m.fechacorte,'%Y-%m')='$fec'
group by m.fechacorte";
$q=$this->db->query($s);

return $q;
}

function pedido_fanasa()
{
$s="SELECT
year(fecha) as aaa,month(fecha)as mes,b.mes as mesx,
sum(pro_ped)as pro_ped,sum(pro_fac)as pro_fac,round(((sum(pro_fac)/sum(pro_ped))*100),4)as nivel_sur_pro,
sum(canp)as pza_ped,sum(cans)as pza_sur,round(((sum(cans)/sum(canp))*100),4)as nivel_sur_pza,
sum(importe)as imp_ped,sum(imp_facturado)as imp_fac
FROM compras.pre_pedido_fenix_ctl a
join catalogo.mes b on b.num=month(a.fecha)
where fol>=109 and a.suc<>'193'
group by month(fecha)
";
$q=$this->db->query($s);

return $q;
}


function pedido_fanasa_suc($mes){
$s="SELECT
a.suc,c.nombre,
year(fecha) as aaa,month(fecha)as mes,b.mes as mesx,
sum(pro_ped)as pro_ped,sum(pro_fac)as pro_fac,round(((sum(pro_fac)/sum(pro_ped))*100),4)as nivel_sur_pro,
sum(canp)as pza_ped,sum(cans)as pza_sur,round(((sum(cans)/sum(canp))*100),4)as nivel_sur_pza,
sum(importe)as imp_ped,sum(imp_facturado)as imp_fac
FROM compras.pre_pedido_fenix_ctl a
join catalogo.mes b on b.num=month(a.fecha)
join catalogo.sucursal c on a.suc=c.suc
where fol>=109 and a.suc<>'193'  and  month(fecha)=$mes
group by suc, mes
";
$q=$this->db->query($s);

return $q;

}

function pedido_fanasa_suc_day($suc,$mes){
$s="SELECT
a.suc,c.nombre,
fecha,
pro_ped, pro_fac,
canp as pza_ped,cans as pza_sur,
importe as imp_ped,imp_facturado as imp_fac
FROM compras.pre_pedido_fenix_ctl a
join catalogo.mes b on b.num=month(a.fecha)
join catalogo.sucursal c on a.suc=c.suc
where fol>=109 and a.suc<>'193' and a.suc=$suc and month(fecha)=$mes
";
$q=$this->db->query($s);

return $q;

}


}