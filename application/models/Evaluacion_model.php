<?php
class Evaluacion_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    public function eval_cedis()
    {
    $aaa=date('Y');
        $s = "select tipo,x.obser,count(*)as productos,
sum(case when inv1>=(final/4) then 1 else 0 end)as abasto,
round(((sum(case when inv1>=(final/4) then 1 else 0 end)/count(*))*100),2) p_abasto,
sum(case when inv1<(final/4) then 1 else 0 end)as faltantes,
(100-round(((sum(case when inv1>=(final/4) then 1 else 0 end)/count(*))*100),2))as p_faltante
from almacen.max_cedis aa
join catalogo.cat_almacen_clasifica bb on bb.sec=aa.sec
join catalogo.cat_clasifica x on x.var=bb.tipo and x.descontinua=bb.descon
left join desarrollo.inv_cedis_sec1 cc on cc.sec=aa.sec
where bb.descon='N'
group by bb.tipo
";
        $q = $this->db->query($s);
        
     return $q;  
    }
 public function eval_cedis_cla($var)
    {
if($var=='_'){$var=' ';}
        $s = "select bb.tipo,x.obser,count(*)as productos,
sum(case when inv1>=(final/4) then 1 else 0 end)as abasto,
round(((sum(case when inv1>=(final/4) then 1 else 0 end)/count(*))*100),2) p_abasto,
sum(case when inv1<(final/4) then 1 else 0 end)as faltantes,
(100-round(((sum(case when inv1>=(final/4) then 1 else 0 end)/count(*))*100),2))as p_faltante,
(select prv from catalogo.almacen m where m.sec=aa.sec and tsec='G')as prv,dd.corto as prvx
from almacen.max_cedis aa
join catalogo.cat_almacen_clasifica bb on bb.sec=aa.sec
join catalogo.cat_clasifica x on x.var=bb.tipo and x.descontinua=bb.descon
left join desarrollo.inv_cedis_sec1 cc on cc.sec=aa.sec
left join catalogo.provedor dd on dd.prov=(select prv from catalogo.almacen m where m.sec=aa.sec and tsec='G')
where bb.descon='N'  and bb.tipo='$var'
group by bb.tipo,(select prv from catalogo.almacen m where m.sec=aa.sec and tsec='G')";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //die();
     return $q;  
    }
 public function eval_cedis_cla_sec($var,$prv)
    {
if($var=='_'){$var=' ';}
        $s = "SELECT prv,prvx,a.sec,susa,
ifnull((SELECT inv1
FROM 
catalogo.cat_almacen_clasifica aa
left join desarrollo.inv_cedis_sec1 bb on bb.sec=aa.sec
left join catalogo.almacen cc on cc.sec=aa.sec and cc.tsec='G'
where aa.descon='N' and aa.tipo='$var'  and bb.inv1>0 and bb.sec is not null and cc.prv=b.prv and bb.sec=a.sec
group by prv
),0)as exis,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=1 and c.sec=a.sec and b.prv=$prv),0)ene,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=2 and c.sec=a.sec and b.prv=$prv),0)feb,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=3 and c.sec=a.sec and b.prv=$prv),0)mar,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=4 and c.sec=a.sec and b.prv=$prv),0)abr,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=5 and c.sec=a.sec and b.prv=$prv),0)may,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=6 and c.sec=a.sec and b.prv=$prv),0)jun,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=7 and c.sec=a.sec and b.prv=$prv),0)jul,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=8 and c.sec=a.sec and b.prv=$prv),0)ago,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=9 and c.sec=a.sec and b.prv=$prv),0)sep,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=10 and c.sec=a.sec and b.prv=$prv),0)oct,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=11 and c.sec=a.sec and b.prv=$prv),0)nov,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=12 and c.sec=a.sec and b.prv=$prv),0)dic,

ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=1 and c.sec=a.sec and b.prv<>$prv),0)enen,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=2 and c.sec=a.sec and b.prv<>$prv),0)febn,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=3 and c.sec=a.sec and b.prv<>$prv),0)marn,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=4 and c.sec=a.sec and b.prv<>$prv),0)abrn,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=5 and c.sec=a.sec and b.prv<>$prv),0)mayn,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=6 and c.sec=a.sec and b.prv<>$prv),0)junn,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=7 and c.sec=a.sec and b.prv<>$prv),0)juln,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=8 and c.sec=a.sec and b.prv<>$prv),0)agon,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=9 and c.sec=a.sec and b.prv<>$prv),0)sepn,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=10 and c.sec=a.sec and b.prv<>$prv),0)octn,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=11 and c.sec=a.sec and b.prv<>$prv),0)novn,
ifnull((select sum(can) from desarrollo.compra_c b
left join desarrollo.compra_d c on c.id_cc=b.id
where b.tipo='C' and year(b.fecha)=year(now()) and month(b.fecha)=12 and c.sec=a.sec and b.prv<>$prv),0)dicn
FROM catalogo.cat_almacen_clasifica a
left join catalogo.almacen b on b.sec=a.sec and tsec='G'
where descon='N' and a.tipo='$var' and b.prv=$prv and b.sec is not null
order by exis";
        $q = $this->db->query($s);
     return $q;  
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function eval_cedis_compra_par($por1,$por2,$por3,$por4,$por5,$var,$prv,$sec)
    {
    if($var=='C'){$filtro=" and d.inv1 is null";}
    if($var=='T'){$filtro=" ";}
    if($var=='P'){$filtro=" and b.prv=$prv";}
    if($var=='S'){$filtro=" and b.sec in($sec)";}
    $aaa=date('Y');
        $s = "select a.sec,a.susa,a.tipo,b.prv,b.prvx,b.costo,c.final as max_cedis,corrugado,
round(c.final/30)as demanda_diaria, ifnull(d.inv1,0)as inv_cedis,
round(((ifnull(d.inv1,0))/(c.final/30)))as dias,
case
when ((round((c.final/30)*$por1,0))-ifnull(inv1,0))>0 and a.tipo='a' then ((round((c.final/30)*$por1,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por2,0))-ifnull(inv1,0))>0 and a.tipo='b' then ((round((c.final/30)*$por2,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por3,0))-ifnull(inv1,0))>0 and a.tipo='c' then ((round((c.final/30)*$por3,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por4,0))-ifnull(inv1,0))>0 and a.tipo='d' then ((round((c.final/30)*$por4,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por5,0))-ifnull(inv1,0))>0 and a.tipo='e' then ((round((c.final/30)*$por5,0))-ifnull(inv1,0))
else 0 end as comprar,
((round(((case
when ((round((c.final/30)*$por1,0))-ifnull(inv1,0))>0 and a.tipo='a' then ((round((c.final/30)*$por1,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por2,0))-ifnull(inv1,0))>0 and a.tipo='b' then ((round((c.final/30)*$por2,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por3,0))-ifnull(inv1,0))>0 and a.tipo='c' then ((round((c.final/30)*$por3,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por4,0))-ifnull(inv1,0))>0 and a.tipo='d' then ((round((c.final/30)*$por4,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por5,0))-ifnull(inv1,0))>0 and a.tipo='e' then ((round((c.final/30)*$por5,0))-ifnull(inv1,0))
else 0 end)/corrugado),0))*corrugado) as comprar_corr,

(((round(((case
when ((round((c.final/30)*$por1,0))-ifnull(inv1,0))>0 and a.tipo='a' then ((round((c.final/30)*$por1,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por2,0))-ifnull(inv1,0))>0 and a.tipo='b' then ((round((c.final/30)*$por2,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por3,0))-ifnull(inv1,0))>0 and a.tipo='c' then ((round((c.final/30)*$por3,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por4,0))-ifnull(inv1,0))>0 and a.tipo='d' then ((round((c.final/30)*$por4,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por5,0))-ifnull(inv1,0))>0 and a.tipo='e' then ((round((c.final/30)*$por5,0))-ifnull(inv1,0))
else 0 end)/corrugado),0))*corrugado)*costo) as importe,
a.tipo,corrugado
from catalogo.cat_almacen_clasifica a
join catalogo.almacen_gs_compra b on b.sec=a.sec
left join almacen.max_cedis c on c.sec=a.sec
left join desarrollo.inv_cedis_sec1 d on d.sec=a.sec and inv1>0
where descon='N' $filtro and round(((ifnull(d.inv1,0))/(c.final/30)))<=15
";
        $q = $this->db->query($s);
     return $q;  
    }
public function eval_cedis_compra_par_prv($por1,$por2,$por3,$por4,$por5,$var,$prv,$sec)
    {
    if($var=='C'){$filtro=' and d.inv1 is null';}
    if($var=='T'){$filtro='';}
    if($var=='P'){$filtro=" and b.prv=$prv";}
    if($var=='S'){$filtro=" and b.sec in($sec)";}
    $aaa=date('Y');
        $s = "select b.prv,b.prvx,

sum(((round(((case when ((round((c.final/30)*$por1,0))-ifnull(inv1,0))>0 and a.tipo='a' then ((round((c.final/30)*$por1,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado)) as compra_a,
sum(((round(((case when ((round((c.final/30)*$por2,0))-ifnull(inv1,0))>0 and a.tipo='b' then ((round((c.final/30)*$por2,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado)) as compra_b,
sum(((round(((case when ((round((c.final/30)*$por3,0))-ifnull(inv1,0))>0 and a.tipo='c' then ((round((c.final/30)*$por3,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado)) as compra_c,
sum(((round(((case when ((round((c.final/30)*$por4,0))-ifnull(inv1,0))>0 and a.tipo='d' then ((round((c.final/30)*$por4,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado)) as compra_d,
sum(((round(((case when ((round((c.final/30)*$por5,0))-ifnull(inv1,0))>0 and a.tipo='e' then ((round((c.final/30)*$por5,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado)) as compra_e,


sum((((round(((((round(((case when ((round((c.final/30)*$por1,0))-ifnull(inv1,0))>0 and a.tipo='a' then ((round((c.final/30)*$por1,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado))/corrugado),0))*corrugado)*costo)) as importe_a,
sum((((round(((((round(((case when ((round((c.final/30)*$por2,0))-ifnull(inv1,0))>0 and a.tipo='b' then ((round((c.final/30)*$por2,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado))/corrugado),0))*corrugado)*costo)) as importe_b,
sum((((round(((((round(((case when ((round((c.final/30)*$por3,0))-ifnull(inv1,0))>0 and a.tipo='c' then ((round((c.final/30)*$por3,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado))/corrugado),0))*corrugado)*costo)) as importe_c,
sum((((round(((((round(((case when ((round((c.final/30)*$por4,0))-ifnull(inv1,0))>0 and a.tipo='d' then ((round((c.final/30)*$por4,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado))/corrugado),0))*corrugado)*costo)) as importe_d,
sum((((round(((((round(((case when ((round((c.final/30)*$por5,0))-ifnull(inv1,0))>0 and a.tipo='e' then ((round((c.final/30)*$por5,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado))/corrugado),0))*corrugado)*costo)) as importe_e


from catalogo.cat_almacen_clasifica a
join catalogo.almacen_gs_compra b on b.sec=a.sec
left join almacen.max_cedis c on c.sec=a.sec
left join desarrollo.inv_cedis_sec1 d on d.sec=a.sec and inv1>0
where descon='N' $filtro and round(((ifnull(d.inv1,0))/(c.final/30)))<=15
group by prv
";

        $q = $this->db->query($s);
     return $q;  
    }
    public function eval_cedis_compra_par_glo($por1,$por2,$por3,$por4,$por5,$var,$prv,$sec)
    {
    if($var=='C'){$filtro=' and d.inv1 is null';}
    if($var=='T'){$filtro='';}  
    if($var=='P'){$filtro=" and b.prv=$prv";}
    if($var=='S'){$filtro=" and b.sec in($sec)";}   
    $aaa=date('Y');
        $s = "select 
sum(((round(((case when ((round((c.final/30)*$por1,0))-ifnull(inv1,0))>0 and a.tipo='a' then ((round((c.final/30)*$por1,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado)) as compra_a,
sum(((round(((case when ((round((c.final/30)*$por2,0))-ifnull(inv1,0))>0 and a.tipo='b' then ((round((c.final/30)*$por2,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado)) as compra_b,
sum(((round(((case when ((round((c.final/30)*$por3,0))-ifnull(inv1,0))>0 and a.tipo='c' then ((round((c.final/30)*$por3,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado)) as compra_c,
sum(((round(((case when ((round((c.final/30)*$por4,0))-ifnull(inv1,0))>0 and a.tipo='d' then ((round((c.final/30)*$por4,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado)) as compra_d,
sum(((round(((case when ((round((c.final/30)*$por5,0))-ifnull(inv1,0))>0 and a.tipo='e' then ((round((c.final/30)*$por5,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado)) as compra_e,


sum((((round(((((round(((case when ((round((c.final/30)*$por1,0))-ifnull(inv1,0))>0 and a.tipo='a' then ((round((c.final/30)*$por1,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado))/corrugado),0))*corrugado)*costo)) as importe_a,
sum((((round(((((round(((case when ((round((c.final/30)*$por2,0))-ifnull(inv1,0))>0 and a.tipo='b' then ((round((c.final/30)*$por2,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado))/corrugado),0))*corrugado)*costo)) as importe_b,
sum((((round(((((round(((case when ((round((c.final/30)*$por3,0))-ifnull(inv1,0))>0 and a.tipo='c' then ((round((c.final/30)*$por3,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado))/corrugado),0))*corrugado)*costo)) as importe_c,
sum((((round(((((round(((case when ((round((c.final/30)*$por4,0))-ifnull(inv1,0))>0 and a.tipo='d' then ((round((c.final/30)*$por4,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado))/corrugado),0))*corrugado)*costo)) as importe_d,
sum((((round(((((round(((case when ((round((c.final/30)*$por5,0))-ifnull(inv1,0))>0 and a.tipo='e' then ((round((c.final/30)*$por5,0))-ifnull(inv1,0)) else 0 end)/corrugado),0))*corrugado))/corrugado),0))*corrugado)*costo)) as importe_e

from catalogo.cat_almacen_clasifica a
join catalogo.almacen_gs_compra b on b.sec=a.sec
left join almacen.max_cedis c on c.sec=a.sec
left join desarrollo.inv_cedis_sec1 d on d.sec=a.sec and inv1>0
where descon='N' $filtro and round(((ifnull(d.inv1,0))/(c.final/30)))<=15
group by descon
";
$q = $this->db->query($s);
     return $q;  
    }

public function eval_cedis_compra_par_genera($por1,$por2,$por3,$por4,$por5,$var,$prv,$sec)
    {
    $aaa=date('Y');
    if($var=='C'){$filtro=' and d.inv1 is null';}
    if($var=='T'){$filtro='';}  
    if($var=='P'){$filtro=" and b.prv=$prv";}
    if($var=='S'){$filtro=" and b.sec in($sec)";}        
$f="select *from catalogo.foliador1 where clav='por'";
$g=$this->db->query($f);
if($g->num_rows()>0){
$h=$g->row();


$insert="insert ignore into compras.orden_a(id_pre_orden, sec, susa, prv, costo, compra,fecha,fecha_ger,iva,compra_generada,codigo)
(select $h->num,a.sec,a.susa,b.prv,b.costo,

((round(((case
when ((round((c.final/30)*$por1,0))-ifnull(inv1,0))>0 and a.tipo='a' then ((round((c.final/30)*$por1,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por2,0))-ifnull(inv1,0))>0 and a.tipo='b' then ((round((c.final/30)*$por2,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por3,0))-ifnull(inv1,0))>0 and a.tipo='c' then ((round((c.final/30)*$por3,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por4,0))-ifnull(inv1,0))>0 and a.tipo='d' then ((round((c.final/30)*$por4,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por5,0))-ifnull(inv1,0))>0 and a.tipo='e' then ((round((c.final/30)*$por5,0))-ifnull(inv1,0))
else 0 end)/corrugado),0))*corrugado) as comprar,

date(now()),LOCALTIMESTAMP(),
ifnull((select '1' from catalogo.sec_generica mm where mm.sec=a.sec and mm.lin in(2,5,9,10)),0),

((round(((case
when ((round((c.final/30)*$por1,0))-ifnull(inv1,0))>0 and a.tipo='a' then ((round((c.final/30)*$por1,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por2,0))-ifnull(inv1,0))>0 and a.tipo='b' then ((round((c.final/30)*$por2,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por3,0))-ifnull(inv1,0))>0 and a.tipo='c' then ((round((c.final/30)*$por3,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por4,0))-ifnull(inv1,0))>0 and a.tipo='d' then ((round((c.final/30)*$por4,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por5,0))-ifnull(inv1,0))>0 and a.tipo='e' then ((round((c.final/30)*$por5,0))-ifnull(inv1,0))
else 0 end)/corrugado),0))*corrugado),

ifnull((select codigo from catalogo.sec_unica mm where mm.sec=a.sec),0)

from catalogo.cat_almacen_clasifica a
join catalogo.almacen_gs_compra b on b.sec=a.sec
left join almacen.max_cedis c on c.sec=a.sec
left join desarrollo.inv_cedis_sec1 d on d.sec=a.sec and inv1>0
where descon='N' $filtro and round(((ifnull(d.inv1,0))/(c.final/30)))<=15 and
(((round(((case
when ((round((c.final/30)*$por1,0))-ifnull(inv1,0))>0 and a.tipo='a' then ((round((c.final/30)*$por1,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por2,0))-ifnull(inv1,0))>0 and a.tipo='b' then ((round((c.final/30)*$por2,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por3,0))-ifnull(inv1,0))>0 and a.tipo='c' then ((round((c.final/30)*$por3,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por4,0))-ifnull(inv1,0))>0 and a.tipo='d' then ((round((c.final/30)*$por4,0))-ifnull(inv1,0))
when ((round((c.final/30)*$por5,0))-ifnull(inv1,0))>0 and a.tipo='e' then ((round((c.final/30)*$por5,0))-ifnull(inv1,0))
else 0 end)/corrugado),0))*corrugado))>0) 
"; 
$this->db->query($insert);
$up="update catalogo.foliador1 set num=($h->num+1) where clav='por'";
$this->db->query($up);
}
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
public function eval_cedis_pro()
    {
    
        $s = "select a.tipo,a.sec,a.susa,g.final as necesidad_cedis,
ifnull(b.inv1,0)as inv_cedis,
ifnull(round((g.final/30)),0)as demanda_diaria_cedis,
ifnull(f.compra,0)as entrada_cedis,
ifnull(round(((ifnull(b.inv1,0))/round((g.final/30))),0),0)as dias_inv_cedis,
ifnull(e.transito,0)as transito_compra,
ifnull(d.final,0) as demanda_farmacias,
ifnull(c.cantidad,0)as inv_farmacia,
ifnull(round((d.final/30)),0) as demanda_diaria_farma,
ifnull(round((ifnull(c.cantidad,0)/round((d.final/30)))),0)as dias_inv_farma,

ifnull((ifnull((SELECT sum(can)
FROM catalogo.folio_pedidos_cedis aa
join desarrollo.surtido bb on bb.fol=aa.id
join catalogo.sucursal cc on cc.suc=aa.suc
WHERE TID='C' and aa.fechas between subdate(date(now()),7) and date(now()) and val_llego=0
and tlid=1 and dia<>'cer' and aa.suc>100 and aa.suc<=2899 and tlid=1 and bb.sec=a.sec
),0)+
ifnull((SELECT sum(can)
FROM catalogo.folio_pedidos_cedis_especial aa
join desarrollo.surtido bb on bb.fol=aa.id
join catalogo.sucursal cc on cc.suc=aa.suc
WHERE TID='C' and aa.fechas between subdate(date(now()),7) and date(now()) and val_llego=0
and tlid=1 and dia<>'cer' and aa.suc>100 and aa.suc<=2899 and tlid=1 and bb.sec=a.sec
),0)),0)as transito_cedis_suc,

ifnull(i.venta,0)venta_diaria,
case when b.sec is null then 1 else 0 end as ceros_cedis,
ifnull(h.ceros_farma,0)as ceros_farma

from catalogo.cat_almacen_clasifica a
left join desarrollo.inv_cedis_sec1 b on b.sec=a.sec and inv1>0
left join desarrollo.inv_sec c on c.sec=a.sec
left join almacen.max_sucursal_sec d on d.sec=a.sec
left join compras.orden_d_transito e on e.sec=a.sec
left join desarrollo.compra_cedis_sec_dia f on f.sec=a.sec and f.fecha=subdate(date(now()),1)
left join almacen.max_cedis g on g.sec=a.sec
left join desarrollo.inv_farma_ceros_sec h on h.sec=a.sec
left join vtadc.venta_detalle_dia_sec i on i.sec=a.sec
where a.descon='N'

";
        $q = $this->db->query($s);
        
     return $q;  
    }
    

function sin_inv()
{
$id_plaza=$this->session->userdata('id_plaza');
$s="SELECT a.* FROM desarrollo.sin_inv_dia_anterior a
where 
a.superv=$id_plaza  and a.superv>0 or
a.regional=$id_plaza  and a.regional>0";    
$q=$this->db->query($s);

$tabla="<table>
<tr>
<th colspan=\"2\"><font color =#0D1CF2>SUCURSALES QUE NECESITAMOS SU INVENTARIO HOY ".date('Y-m-d')."</th>
</tr>
";
foreach($q->result()as $r)
{
$tabla.="
<tr>
<td>".$r->suc."</td>
<td>".$r->nombre."</td>
</tr>
";
    
}
$tabla.="</table>";
return $tabla;
}
function sin_venta()
{
$id_plaza=$this->session->userdata('id_plaza');
$s="select subdate(date(now()),1)as fecha,a.suc,a.nombre
From catalogo.sucursal a
left join vtadc.venta_ctl b on b.suc=a.suc and fecha=subdate(date(now()),1)
where 
tlid=1 and fecha_act='0000-00-00' and superv=$id_plaza and b.suc is null or
tlid=1 and fecha_act='0000-00-00' and regional=$id_plaza and b.suc is null
union all
select subdate(date(now()),2)as fecha,a.suc,a.nombre
From catalogo.sucursal a
left join vtadc.venta_ctl b on b.suc=a.suc and fecha=subdate(date(now()),2)
where tlid=1 and fecha_act='0000-00-00' and superv=$id_plaza and b.suc is null or
tlid=1 and fecha_act='0000-00-00' and regional=$id_plaza and b.suc is null
union all
select subdate(date(now()),3)as fecha,a.suc,a.nombre
From catalogo.sucursal a
left join vtadc.venta_ctl b on b.suc=a.suc and fecha=subdate(date(now()),3)
where tlid=1 and fecha_act='0000-00-00' and superv=$id_plaza and b.suc is null or
tlid=1 and fecha_act='0000-00-00' and regional=$id_plaza and b.suc is null
union all
select subdate(date(now()),4)as fecha,a.suc,a.nombre
From catalogo.sucursal a
left join vtadc.venta_ctl b on b.suc=a.suc and fecha=subdate(date(now()),4)
where tlid=1 and fecha_act='0000-00-00' and superv=$id_plaza and b.suc is null or
tlid=1 and fecha_act='0000-00-00' and regional=$id_plaza and b.suc is null
union all
select subdate(date(now()),5)as fecha,a.suc,a.nombre
From catalogo.sucursal a
left join vtadc.venta_ctl b on b.suc=a.suc and fecha=subdate(date(now()),5)
where tlid=1 and fecha_act='0000-00-00' and superv=$id_plaza and b.suc is null or
tlid=1 and fecha_act='0000-00-00' and regional=$id_plaza and b.suc is null
union all
select subdate(date(now()),6)as fecha,a.suc,a.nombre
From catalogo.sucursal a
left join vtadc.venta_ctl b on b.suc=a.suc and fecha=subdate(date(now()),6)
where tlid=1 and fecha_act='0000-00-00' and superv=$id_plaza and b.suc is null or
tlid=1 and fecha_act='0000-00-00' and regional=$id_plaza and b.suc is null
union all
select subdate(date(now()),7)as fecha,a.suc,a.nombre
From catalogo.sucursal a
left join vtadc.venta_ctl b on b.suc=a.suc and fecha=subdate(date(now()),7)
where tlid=1 and fecha_act='0000-00-00' and superv=$id_plaza and b.suc is null or
tlid=1 and fecha_act='0000-00-00' and regional=$id_plaza and b.suc is null";    
$q=$this->db->query($s);

$tabla="<table>
<tr>
<th colspan=\"3\"><font color =#0D1CF2>SUCURSALES QUE NECESITAMOS SU REPORTE DE VENTAS</th>
</tr>
";
foreach($q->result()as $r)
{
$tabla.="
<tr>
<td>".$r->fecha."</td>
<td>".$r->suc."</td>
<td>".$r->nombre."</td>
</tr>
";
    
}
$tabla.="</table>";
return $tabla;
}

function eval_cedis_pro_excel()
{
$s="select a.tipo,a.sec,a.susa,g.final as necesidad_cedis,
ifnull(b.inv1,0)as inv_cedis,
ifnull(round((g.final/30)),0)as demanda_diaria_cedis,
ifnull(f.compra,0)as entrada_cedis,
ifnull(round(((ifnull(b.inv1,0))/round((g.final/30))),0),0)as dias_inv_cedis,
ifnull(e.transito,0)as transito_compra,

ifnull(d.final,0) as demanda_farmacias,
ifnull(c.cantidad,0)as inv_farmacia,
ifnull(round((d.final/30)),0) as demanda_diaria_farma,
ifnull(round((ifnull(c.cantidad,0)/round((d.final/30)))),0)as dias_inv_farma,

ifnull((ifnull((SELECT sum(can)
FROM catalogo.folio_pedidos_cedis aa
join desarrollo.surtido bb on bb.fol=aa.id
join catalogo.sucursal cc on cc.suc=aa.suc
WHERE TID='C' and aa.fechas between subdate(date(now()),7) and date(now()) and val_llego=0
and tlid=1 and dia<>'cer' and aa.suc>100 and aa.suc<=2899 and tlid=1 and bb.sec=a.sec
),0)+
ifnull((SELECT sum(can)
FROM catalogo.folio_pedidos_cedis_especial aa
join desarrollo.surtido bb on bb.fol=aa.id
join catalogo.sucursal cc on cc.suc=aa.suc
WHERE TID='C' and aa.fechas between subdate(date(now()),7) and date(now()) and val_llego=0
and tlid=1 and dia<>'cer' and tipo3='DA' and bb.sec=a.sec
),0)),0)as transito_cedis_suc,

ifnull(i.venta,0)venta_diaria,
case when b.sec is null then 1 else 0 end as ceros_cedis,
ifnull(h.ceros_farma,0)as ceros_farma,
ifnull(h.sin_inv,0)as sin_inv

from catalogo.cat_almacen_clasifica a
left join desarrollo.inv_cedis_sec1 b on b.sec=a.sec and inv1>0
left join desarrollo.inv_sec c on c.sec=a.sec
left join almacen.max_sucursal_sec d on d.sec=a.sec
left join compras.orden_d_transito e on e.sec=a.sec
left join desarrollo.compra_cedis_sec_dia f on f.sec=a.sec and f.fecha=subdate(date(now()),1)
left join almacen.max_cedis g on g.sec=a.sec
left join desarrollo.inv_farma_ceros_sec h on h.sec=a.sec
left join vtadc.venta_detalle_dia_sec i on i.sec=a.sec
where a.descon='N' and a.tipo<>' '";
$q=$this->db->query($s);
return $q;    
}



function nivel_de_faltante_correo()
{


$por_suc1="insert ignore into oficinas.nivel_surtido_suc_cla(fecha, suc, tipo, productos, existen, abasto)
(select date(now()), y.suc,x.tipo,count(*)as optimo,
ifnull((SELECT sum(case when ((c.final)/4)<=cantidad then 1 else 0 end) from desarrollo.inv a
join catalogo.cat_almacen_clasifica b on b.sec=a.sec
join almacen.max_sucursal c on c.sec=a.sec and c.suc=a.suc
where a.suc=y.suc and b.tipo=x.tipo and a.mov=7 and fechai>=subdate(date(now()),2) and b.descon='N' and cantidad>0),0)as existen,


round(((ifnull((SELECT sum(case when ((c.final)/4)<=cantidad then 1 else 0 end) from desarrollo.inv a
join catalogo.cat_almacen_clasifica b on b.sec=a.sec
join almacen.max_sucursal c on c.sec=a.sec and c.suc=a.suc
where a.suc=y.suc and b.tipo=x.tipo and a.mov=7 and fechai>=subdate(date(now()),2) and b.descon='N' and cantidad>0),0))/(count(*))*100),4)

from catalogo.cat_almacen_clasifica x,catalogo.sucursal y
where x.descon='N' and x.tipo<>'' and tlid=1 and y.tipo3 in('DA') and
(select fechai from desarrollo.inv xx where xx.fechai>=subdate(date(now()),2) and xx.suc=y.suc group by suc)>0

group by y.suc,x.tipo)";
$this->db->query($por_suc1);

$por_suc="insert ignore into oficinas.nivel_surtido_suc(fecha, suc, abasto, productos, existen)
(SELECT fecha, suc, round(((sum(existen)/sum(productos))*100),2), sum(productos), sum(existen)   
FROM oficinas.nivel_surtido_suc_cla where fecha=date(now()) group by fecha,suc)";
$this->db->query($por_suc);





$final=$this->__suc_faltantes();
$final.="<br />";
$final.=$this->__solo_farmacia();
$final.="<br />";
$final.=$this->__solo_cedis();



//$up="insert into oficinas.nivel_surtido (fecha, cedis,farmacia)values
//(date(now()),'$por2','$por3')
//on duplicate key update farmacia=values(farmacia),cedis=values(cedis)";
//$this->db->query($up);


$final.='<table>
<tr>
<td colspan=\"8\"><img src="http://189.203.201.166/oficinas/img/firma/9469.png" /></td>
</tr>
</table>';
return $final;
}
function __solo_farmacia()
{
$s="SELECT a.tipo,b.obser,
(select count(*) from catalogo.cat_almacen_clasifica xx where xx.tipo=a.tipo and descon='N' group by xx.tipo)as productos,
sum(productos)as existen,sum(existen)as abasto
FROM oficinas.nivel_surtido_suc_cla a
join catalogo.cat_clasifica b on b.var=a.tipo and descontinua='N'
where a.fecha=date(now())
group by a.tipo
union all
SELECT 'TOTAL 'as tipo,concat( count(*),' SUCURSALES')as obser ,
(select count(*) from catalogo.cat_almacen_clasifica xx where descon='N' and xx.tipo<>' ' group by xx.descon)productos,
sum(productos)existen,sum(existen)abasto
FROM oficinas.nivel_surtido_suc a
where a.fecha=date(now());";
$q=$this->db->query($s);
$final="<table border=\"1\">
<tr>
<th colspan=\"8\"><font size=\"-1\">CONCENTRADO DE PRODUCTOS</font></th>
</tr>
<tr>
<th colspan=\"8\"><font size=\"-1\">FARMACIA</font></th>
</tr>
<th><font size=\"-1\">Tipo</font></th>
<th align=\"center\"><font size=\"-1\">CLASIFICACI&Oacute;N</font></th>
<th align=\"center\"><font size=\"-1\">PRODUCTOS DEL<br />CATALOGO</font></th>
<th align=\"center\"><font size=\"-1\">PRODUCTOS EN<br />SUCURSAL</font></th>
<th align=\"center\"><font size=\"-1\">FALTANTES</font></th>
<th align=\"center\"><font size=\"-1\">ABASTO</font></th>
<th align=\"center\"><font size=\"-1\">% DE<BR />FALTANTES</font></th>
<th align=\"center\"><font size=\"-1\">% DE<BR />ABASTO</font></th>
</tr>";
$t1=0;$t2=0;$t3=0;$num=0;$t4=0;$t5=0;$t6=0;$por1=0;$por2=0;$por3=0;$por_far=0;
$por_fal=0;$por_aba=0;
$color='blue';
foreach ($q->result()as $r)
        {
        $por_fal=((($r->existen-$r->abasto)/$r->existen)*100);
        $por_aba=((($r->abasto)/$r->existen)*100);
        $num=$num+1;    
        $final.="
        <tr>
        <td><font size=\"-1\">".$r->tipo."</font></td>
        <td><font size=\"-1\">".$r->obser."</font></td>
        <td align=\"right\"><font color=\"$color\" size=\"-1\">".number_format($r->productos,0)."</font></td>
        <td align=\"right\"><font color=\"$color\" size=\"-1\">".number_format($r->existen,0)."</font></td>
        <td align=\"right\"><font color=\"$color\" size=\"-1\">".number_format(($r->existen-$r->abasto),0)."</font></td>
        <td align=\"right\"><font color=\"$color\" size=\"-1\">".number_format(($r->abasto),0)."</font></td>
        <td align=\"right\"><font color=\"$color\" size=\"-1\">% ".number_format($por_fal,2)."</font></td>
        <td align=\"right\"><font color=\"$color\" size=\"-1\">% ".number_format($por_aba,2)."</font></td>
        </tr>
        ";
        }
        
        
        
$final.="
</table>";  
return $final; 

}
function __suc_faltantes()
{
$s="select a.suc,nombre as sucx,
case
when dia in('LUN','TLU') then 'LUNES'
when dia in('MAR','TMA') then 'MARTES'
when dia in('MIE','TMI') then 'MIERCOLES'
when dia in('JUE','TJU') then 'JUEVES'
when dia in('VIE','TVI') then 'VIERNES'
when dia in('CER','PED',' ') then 'PROXIMO CIERRE'
end as diax

From catalogo.sucursal a
left join oficinas.nivel_surtido_suc b on b.suc=a.suc and fecha=date(now())
where a.tipo3='DA' and tlid=1 and b.suc is null and fecha_act='0000-00-00'";
$q=$this->db->query($s);
$final="<table border=\"1\">
<tr>
<th colspan=\"3\"><font size=\"-1\">SUCURSALES SIN INVENTARIO</font></th>
</tr>
<th><font size=\"-1\">Nid</font></th>
<th align=\"center\"><font size=\"-1\">SUCURSAL</font></th>
<th align=\"center\"><font size=\"-1\">DIA DE <br />PEDIDO</font></th>
</tr>";

foreach ($q->result()as $r)
        {
        $final.="
        <tr>
        <td><font size=\"-1\">".$r->suc."</font></td>
        <td><font size=\"-1\">".$r->sucx."</font></td>
        <td><font size=\"-1\">".$r->diax."</font></td>
        </tr>
        ";
        }
        $final.="
</table>"; 
return $final;


}

function __solo_cedis()
{
$s="select a.tipo,x.obser,count(*)as productos,

count(*)-(select count(*)
from desarrollo.inv_cedis_sec1 m
join catalogo.cat_almacen_clasifica n on n.sec=m.sec
where n.descon='N' and inv1>0 and n.tipo=a.tipo
group by n.tipo)as faltantes,
(select count(*)
from desarrollo.inv_cedis_sec1 m
join catalogo.cat_almacen_clasifica n on n.sec=m.sec
where a.descon='N' and inv1>0 and n.tipo=a.tipo
group by n.tipo)as abasto,

(SELECT sum(
case when (select inv1 from desarrollo.inv_cedis_sec1 xx where xx.sec=n.sec)>=round(m.final*.5) then 0 else 1 end)
FROM almacen.max_cedis m
join catalogo.cat_almacen_clasifica n on n.sec=m.sec
where n.descon='N' and n.tipo<>' ' and n.tipo=a.tipo
group by n.tipo)as faltante_10_por

From catalogo.cat_almacen_clasifica a
join catalogo.cat_clasifica  x on x.var=a.tipo and x.descontinua=a.descon
where a.descon='N' and a.tipo<>' '
group by a.tipo";
$q=$this->db->query($s);

$final="<table border=\"1\">
<tr>
<th colspan=\"11\"><font size=\"-1\">CONCENTRADO DE PRODUCTOS</font></th>
</tr>
<tr>
<th colspan=\"11\"><font size=\"-1\">ALMACEN CENTRAL</font></th>
</tr>
<th><font size=\"-1\">Tipo</font></th>
<th align=\"center\"><font size=\"-1\">CLASIFICACI&Oacute;N</font></th>
<th align=\"center\"><font size=\"-1\">PRODUCTOS</font></th>
<th align=\"center\"><font color=\"gray\" size=\"-1\">FALTANTES</font></th>
<th align=\"center\"><font color=\"gray\" size=\"-1\">ABASTO</font></th>
<th align=\"center\"><font color=\"gray\" size=\"-1\">% DE<BR />FALTANTES</font></th>
<th align=\"center\"><font color=\"gray\" size=\"-1\">% DE<BR />ABASTO</font></th>

<th align=\"center\"><font color=\"green\" size=\"-1\">FALTANTE <BR />MENOR A <BR />15 DIAS DE<BR />INVENTARIO</font></th>
<th align=\"center\"><font color=\"green\" size=\"-1\">ABASTO</font></th>
<th align=\"center\"><font color=\"green\" size=\"-1\">% DE<BR />FALTANTE</font></th>
<th align=\"center\"><font color=\"green\" size=\"-1\">% DE<BR />ABASTO</font></th>
</tr>";
$t1=0;$t2=0;$t3=0;$num=0;$t4=0;$t5=0;$t6=0;$por1=0;$por2=0;$por3=0;$por_far=0;
$por_fal_almacen=0;$por_aba_almacen=0;$por_fal_almacen10=0;$por_aba_almacen10=0;
foreach ($q->result()as $r)
        {
        $por_fal_almacen=(($r->faltantes/$r->productos)*100);
        $por_aba_almacen=((($r->productos-$r->faltantes)/$r->productos)*100);
        $por_fal_almacen10=(($r->faltante_10_por/$r->productos)*100);
        $por_aba_almacen10=((($r->productos-$r->faltante_10_por)/$r->productos)*100);
           
        $num=$num+1;    
        $final.="
        <tr>
        <td><font size=\"-1\">".$r->tipo."</font></td>
        <td><font size=\"-1\">".$r->obser."</font></td>
        <td align=\"right\"><font size=\"-1\">".number_format($r->productos,0)."</font></td>
        <td align=\"right\"><font color=\"gray\" size=\"-1\">".number_format($r->faltantes,0)."</font></td>
        <td align=\"right\"><font color=\"gray\" size=\"-1\">".number_format(($r->productos-$r->faltantes),0)."</font></td>
        <td align=\"right\"><font color=\"gray\" size=\"-1\">".number_format($por_fal_almacen,2)."</font></td>
        <td align=\"right\"><font color=\"gray\" size=\"-1\">".number_format($por_aba_almacen,2)."</font></td>
        <td align=\"right\"><font color=\"green\" size=\"-1\">".number_format($r->faltante_10_por,0)."</font></td>
        <td align=\"right\"><font color=\"green\" size=\"-1\">".number_format(($r->productos-$r->faltante_10_por),0)."</font></td>
        <td align=\"right\"><font color=\"green\" size=\"-1\">".number_format($por_fal_almacen10,2)."</font></td>
        <td align=\"right\"><font color=\"green\" size=\"-1\">".number_format($por_aba_almacen10,2)."</font></td>
        
        
        
        
        </tr>
        ";
        $t1=$t1+$r->productos;
        $t2=$t2+$r->faltantes;
        $t3=$t3+($r->productos-$r->faltantes);
        $t4=$t4+$r->faltante_10_por;
        $t5=$t5+($r->productos-$r->faltante_10_por);
        //$t4=$t4+$r->p_faltante;
        //$t5=$t5+$r->p_abasto;
        //$t6=$t6+$r->piezas_abasto;
        }
        $por1=round((($t2/$t1)*100),2);
        $por2=round((($t3/$t1)*100),2);
        $por3=round((($t4/$t1)*100),2);
        $por4=round((($t5/$t1)*100),2);
        
        
$final.="
<tr>
<td colspan=\"2\"><font size=\"-1\"><strong>TOTAL</strong></font></td>
<td align=\"right\"><font size=\"-1\"><strong>".number_format($t1,0)."</strong></font></td>
<td align=\"right\"><font size=\"-1\"><strong>".number_format($t2,0)."</strong></font></td>
<td align=\"right\"><font size=\"-1\"><strong>".number_format($t3,0)."</strong></font></td>
<td align=\"right\"><font size=\"-1\"><strong>% ".number_format($por1,2)."</strong></font></td>
<td align=\"right\"><font size=\"-1\"><strong>% ".number_format($por2,2)."</strong></font></td>
<td align=\"right\"><font size=\"-1\"><strong>".number_format($t4,0)."</strong></font></td>
<td align=\"right\"><font size=\"-1\"><strong>".number_format($t5,0)."</strong></font></td>
<td align=\"right\"><font size=\"-1\"><strong>% ".number_format($por3,2)."</strong></font></td>
<td align=\"right\"><font size=\"-1\"><strong>% ".number_format($por4,2)."</strong></font></td>
</tr>
</table>";  
return $final;  
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function evaluacion_principal($aaa)
{
$s="SELECT a.aaa,a.mes,'DOCTOR AHORRO' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa
and a.tipo3 in('DA')
group by a.aaa,a.mes
union all
SELECT a.aaa,a.mes,'FENIX' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa
and a.tipo3 in('FE')
group by a.aaa,a.mes
union all
SELECT a.aaa,a.mes,'FARMABODEGA' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa
and a.tipo3 in('FA')
group by a.aaa,a.mes

union all
SELECT a.aaa,a.mes,'SUC CERRADAS O MAL APLICADAS' as motivo,count(a.suc)as num,
sum(a.venta)as venta,sum(a.costo_venta)as costo_venta,sum(a.renta)as renta,sum(a.nomina+a.isr_nomina)as nomina,
sum(a.insumos)as insumos,sum(a.dev)as dev,sum(a.agua)as agua,sum(a.luz)as luz,sum(a.tel)as tel,sum(a.otros)as otros
FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=$aaa
and a.tipo3 in('CE','AN',' ')
group by a.aaa,a.mes";
$q=$this->db->query($s);
return $q;    
}



function evaluacion_porce_det2($var)
{
 $s="SELECT
ifnull(((costo_venta/venta)*100),0)por_costo_venta,
ifnull((((a.renta)/venta)*100),0)por_renta,
ifnull((((a.nomina+isr_nomina)/venta)*100),0)por_nomina,
ifnull((((a.insumos+dev+agua+luz+tel+otros)/venta)*100),0)por_gastos,
case when fecha_act<>'0000-00-00' then concat(trim(b.nombre),' ',trim(fecha_act)) else trim(b.nombre) end as sucx,
a.suc,
a.tipo3,
(a.venta)as venta,
(a.costo_venta)as costo_venta,
(a.renta)as renta,

(a.nomina)as nomina,
(a.isr_nomina)as isr_nomina,
(a.insumos)as insumos,
(a.dev)as dev,
(a.agua)as agua,
(a.luz)as luz,
(a.tel)as tel,
(a.otros)as otros

FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=year(subdate(date(now()),interval 1 month)) and a.mes=month(subdate(date(now()),interval 1 month))
and a.tipo3 in($var)
order by a.tipo3,a.suc";
 $q=$this->db->query($s);
 return $q;   
}
function evaluacion_porce()
{
 $s="SELECT
ifnull(((costo_venta/venta)*100),0)por_costo_venta,
ifnull((((a.renta)/venta)*100),0)por_renta,
ifnull((((a.nomina+isr_nomina)/venta)*100),0)por_nomina,
ifnull((((a.insumos+dev+agua+luz+tel+otros)/venta)*100),0)por_gastos,

case when fecha_act<>'0000-00-00' then concat(trim(b.nombre),' ',trim(fecha_act)) else trim(b.nombre) end as sucx,a.*

FROM oficinas.pianel_sucursal a
left join catalogo.sucursal b  on b.suc=a.suc
where aaa=year(subdate(date(now()),interval 1 month)) and a.mes=month(subdate(date(now()),interval 1 month))
order by a.tipo3,a.suc";
 $q=$this->db->query($s);
 return $q;   
}































function evaluacion_rentas()
{
 $s="SELECT b.tipo3,a.nom,a.mes,c.mes as mesx,a.suc,concat(trim(b.nombre),' ',trim(mod_suc)) as sucx,a.imp,a.pago,
     (imp*a.iva)as ivaf,(imp*(isr/100))as isrf,(imp*(iva_isr/100))as iva_isrf,

case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
 as total,

case
when pago='MN' then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
((case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
)*tipo_cambio)
end  as total_mn,

((imp*(isr/100))*tipo_cambio)as isr_mn


FROM desarrollo.rentas a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.mes c on c.num=a.mes
where activo=1 and a.aaa=year(date(now())) and a.mes=month(subdate(date(now()),30))
order by b.tipo3,pago, a.suc
";
 $q=$this->db->query($s); 
 return $q;  
}
function evaluacion_ventas_costo()
{
 $s="select a.suc,a.nombre as sucx,ifnull(sum(siniva),0) as venta_siniva,
ifnull((select sum(x.venta*x.cos) from vtadc.venta x where x.sucursal=a.suc and  x.aaa=year(date(now())) and x.mes=month(subdate(date(now()),30))),0)as cos_venta
from catalogo.sucursal a
left join desarrollo.cortes_c b on a.suc=b.suc and  year(fechacorte)=year(date(now())) and month(fechacorte)=month(subdate(date(now()),30))
left join desarrollo.cortes_d c on c.id_cc=b.id and clave1 not in(0,20,30,40,49)
where a.tipo3 IN('DA','FE','FA') AND a.TLID=1
group by a.suc
";
 $q=$this->db->query($s); 
 return $q;  
}
function evaluacion_nominas()
{
 $s="select
a.fecha, a.suc,b.nombre,
sum(percepcionesTotalGravado)as percepcionesTotalGravado,
sum(percepcionesTotalExento)as percepcionesTotalExento,
sum(deduccionesTotalGravado)as deduccionesTotalGravado,
sum(deposito)as deposito
from oficinas.nomina_suc a
left join catalogo.sucursal b on b.suc=a.suc
where a.cia<>30 and year(a.fecha)=year(date(now())) and month(a.fecha)=month(subdate(date(now()),interval 1 month))
group by a.suc
";
 $q=$this->db->query($s); 
 return $q;  
}
function evaluacion_nominas_det()
{
 $s="select
a.fecha, a.cia,b.ciax as ciax,
sum(percepcionesTotalGravado)as percepcionesTotalGravado,
sum(percepcionesTotalExento)as percepcionesTotalExento,
sum(deduccionesTotalGravado)as deduccionesTotalGravado,
sum(deposito)as deposito
from oficinas.nomina_suc a
left join catalogo.cat_compa_nomina b on b.cia=a.cia
where a.cia<>30 and year(a.fecha)=year(date(now())) and month(a.fecha)=month(subdate(date(now()),interval 1 month))
group by a.cia
";
 $q=$this->db->query($s); 
 return $q;  
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function eval_nomina()
{
$s="SELECT      a.cia,b.ciax,aaa, mes, sum(percepcion), sum(ims_mensual),sum(ims), sum(resto_bimestral),sum(infonavit),sum(sua_final),sum(vales),sum(percepcion)+sum(sua_final)+sum(vales)
FROM nomina_suc_sua a
join catalogo.cat_compa_nomina b on b.cia=a.cia where a.aaa=2015 and a.mes=5
group by cia
union all
SELECT '','TOTAL',aaa, mes, sum(percepcion), sum(ims_mensual),sum(ims), sum(resto_bimestral),sum(infonavit),sum(sua_final),sum(vales),sum(percepcion)+sum(sua_final)+sum(vales) 
FROM nomina_suc_sua a where a.aaa=2015 and a.mes=5
group by mes";
$q=$this->db->query($s);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function eval_rentas()
{
$s="SELECT 'LOCALES PROPIOS'as var, sum(a.imp),

sum(imp*a.iva)as ivaf,
sum((imp*(isr/100)))as isrf,
sum((imp*(iva_isr/100)))as iva_isrf,

sum(case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end)
 as total,

sum(case
when pago='MN' then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
((case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
)*tipo_cambio)
end) as total_mn,
sum(case when pago='MN' then (imp*(isr/100)) else ((imp*(isr/100)*tipo_cambio)) end) as isr_mn


FROM desarrollo.rentas a
where activo=1 and a.aaa=year(date(now())) and a.mes=month(subdate(date(now()),30)) and a.num=0
group by a.aaa,a.mes

union all

SELECT 'RENTAS MONEDA NACIONAL'as var, sum(a.imp),

sum(imp*a.iva)as ivaf,
sum((imp*(isr/100)))as isrf,
sum((imp*(iva_isr/100)))as iva_isrf,

sum(case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end)
 as total,

sum(case
when pago='MN' then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
((case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
)*tipo_cambio)
end) as total_mn,
sum(case when pago='MN' then (imp*(isr/100)) else ((imp*(isr/100)*tipo_cambio)) end) as isr_mn


FROM desarrollo.rentas a
where activo=1 and a.aaa=year(date(now())) and a.mes=month(subdate(date(now()),30)) and a.num>0 and a.num<=1000
group by a.aaa,a.mes
union all

SELECT 'RENTAS EN DOLAES'as var, sum(a.imp),

sum(imp*a.iva)as ivaf,
sum((imp*(isr/100)))as isrf,
sum((imp*(iva_isr/100)))as iva_isrf,

sum(case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end)
 as total,

sum(case
when pago='MN' then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
((case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
)*tipo_cambio)
end) as total_mn,
sum(case when pago='MN' then (imp*(isr/100)) else ((imp*(isr/100)*tipo_cambio)) end) as isr_mn


FROM desarrollo.rentas a
where activo=1 and a.aaa=year(date(now())) and a.mes=month(subdate(date(now()),30)) and a.num>1000
group by a.aaa,a.mes

union all

SELECT 'TOTAL'as var, sum(a.imp),

sum(imp*a.iva)as ivaf,
sum((imp*(isr/100)))as isrf,
sum((imp*(iva_isr/100)))as iva_isrf,

sum(case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end)
 as total,

sum(case
when pago='MN' then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
((case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
)*tipo_cambio)
end) as total_mn,
sum(case when pago='MN' then (imp*(isr/100)) else ((imp*(isr/100)*tipo_cambio)) end) as isr_mn


FROM desarrollo.rentas a
where activo=1 and a.aaa=year(date(now())) and a.mes=month(subdate(date(now()),30))
group by a.aaa,a.mes
";
$q=$this->db->query($s);
}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









}
