<?php
class Ventas_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    public function s_ventas_cortes($f1,$f2)
    {
    $aaa=date('Y');
    //$aaa=('2014');
        $s = "SELECT b.tipo3,a.num_dias,a.mes as mm,a.suc, a.tipo2,d.nombre as tipox, a.mes,c.mes as mesx, b.regional, b.superv,b.nombre as sucx,
        a.credito,a.contado,a.recarga
FROM vtadc.gc_venta_mes a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.mes c on c.num=a.mes
left join catalogo.cat_imagen d on d.tipo=B.tipo3  
where b.regional>0 and aaa=$aaa and a.suc not in(176,177,178,179,180,181,187)
order by a.mes,tipo3,b.regional,b.superv,a.suc
";
        $q = $this->db->query($s);
        $b=0;
        foreach ($q->result()as $r)
        {
        $a[$r->mes]['f1'] = $f1;
        $a[$r->mes]['f2'] = $f2;
        $a[$r->mes]['mesx'] = $r->mesx;
        $a[$r->mes]['mes'] = $r->mm;
        $a[$r->mes]['m'][$r->tipo3]['imagen'] = $r->tipox;
        $a[$r->mes]['m'][$r->tipo3]['tipo2'] = $r->tipo3;
        $a[$r->mes]['m'][$r->tipo3]['segundo'][$r->regional]['regional'] = $r->regional;
        $a[$r->mes]['m'][$r->tipo3]['segundo'][$r->regional]['tercero'][$r->superv]['superv'] = $r->superv;
        $a[$r->mes]['m'][$r->tipo3]['segundo'][$r->regional]['tercero'][$r->superv]['cuarto'][$r->suc]['suc']= $r->suc;
        $a[$r->mes]['m'][$r->tipo3]['segundo'][$r->regional]['tercero'][$r->superv]['cuarto'][$r->suc]['sucx'] = $r->sucx;
        $a[$r->mes]['m'][$r->tipo3]['segundo'][$r->regional]['tercero'][$r->superv]['cuarto'][$r->suc]['num_dias'] = $r->num_dias;
        $a[$r->mes]['m'][$r->tipo3]['segundo'][$r->regional]['tercero'][$r->superv]['cuarto'][$r->suc]['credito'] = $r->credito;
        $a[$r->mes]['m'][$r->tipo3]['segundo'][$r->regional]['tercero'][$r->superv]['cuarto'][$r->suc]['recarga'] = $r->recarga;
        $a[$r->mes]['m'][$r->tipo3]['segundo'][$r->regional]['tercero'][$r->superv]['cuarto'][$r->suc]['contado'] = $r->contado;
        }

     return $a;  
    }
public function s_ventas_compra_mes_nac($aaa)
    {
        $s = "select c.tipo3,c.tipo2, f.nombre as imagen,a.suc,c.nombre as sucx,year(a.fechacorte)as aaa,month(a.fechacorte)as mes,e.mes as mesx, month(a.fechacorte)as mm,c.tipo2,

sum(case when month(a.fechacorte)=1 and clave1=20 then (siniva) else 0 end)as rec01,
sum(case when month(a.fechacorte)=1 and clave1 in(30,40) then (corregido) else 0 end)as cre01,
sum(case when month(a.fechacorte)=1 and clave1 not in(20,30,40) then (siniva) else 0 end)as con01,

sum(case when month(a.fechacorte)=2 and clave1=20 then (siniva) else 0 end)as rec02,
sum(case when month(a.fechacorte)=2 and clave1 in(30,40) then (corregido) else 0 end)as cre02,
sum(case when month(a.fechacorte)=2 and clave1 not in(20,30,40) then (siniva) else 0 end)as con02,

sum(case when month(a.fechacorte)=3 and clave1=20 then (siniva) else 0 end)as rec03,
sum(case when month(a.fechacorte)=3 and clave1 in(30,40) then (corregido) else 0 end)as cre03,
sum(case when month(a.fechacorte)=3 and clave1 not in(20,30,40) then (siniva) else 0 end)as con03,

sum(case when month(a.fechacorte)=4 and clave1=20 then (siniva) else 0 end)as rec04,
sum(case when month(a.fechacorte)=4 and clave1 in(30,40) then (corregido) else 0 end)as cre04,
sum(case when month(a.fechacorte)=4 and clave1 not in(20,30,40) then (siniva) else 0 end)as con04,

sum(case when month(a.fechacorte)=5 and clave1=20 then (siniva) else 0 end)as rec05,
sum(case when month(a.fechacorte)=5 and clave1 in(30,40) then (corregido) else 0 end)as cre05,
sum(case when month(a.fechacorte)=5 and clave1 not in(20,30,40) then (siniva) else 0 end)as con05,

sum(case when month(a.fechacorte)=6 and clave1=20 then (siniva) else 0 end)as rec06,
sum(case when month(a.fechacorte)=6 and clave1 in(30,40) then (corregido) else 0 end)as cre06,
sum(case when month(a.fechacorte)=6 and clave1 not in(20,30,40) then (siniva) else 0 end)as con06,

sum(case when month(a.fechacorte)=7 and clave1=20 then (siniva) else 0 end)as rec07,
sum(case when month(a.fechacorte)=7 and clave1 in(30,40) then (corregido) else 0 end)as cre07,
sum(case when month(a.fechacorte)=7 and clave1 not in(20,30,40) then (siniva) else 0 end)as con07,

sum(case when month(a.fechacorte)=8 and clave1=20 then (siniva) else 0 end)as rec08,
sum(case when month(a.fechacorte)=8 and clave1 in(30,40) then (corregido) else 0 end)as cre08,
sum(case when month(a.fechacorte)=8 and clave1 not in(20,30,40) then (siniva) else 0 end)as con08,

sum(case when month(a.fechacorte)=9 and clave1=20 then (siniva) else 0 end)as rec09,
sum(case when month(a.fechacorte)=9 and clave1 in(30,40) then (corregido) else 0 end)as cre09,
sum(case when month(a.fechacorte)=9 and clave1 not in(20,30,40) then (siniva) else 0 end)as con09,

sum(case when month(a.fechacorte)=10 and clave1=20 then (siniva) else 0 end)as rec10,
sum(case when month(a.fechacorte)=10 and clave1 in(30,40) then (corregido) else 0 end)as cre10,
sum(case when month(a.fechacorte)=10 and clave1 not in(20,30,40) then (siniva) else 0 end)as con10,

sum(case when month(a.fechacorte)=11 and clave1=20 then (siniva) else 0 end)as rec11,
sum(case when month(a.fechacorte)=11 and clave1 in(30,40) then (corregido) else 0 end)as cre11,
sum(case when month(a.fechacorte)=11 and clave1 not in(20,30,40) then (siniva) else 0 end)as con11,

sum(case when month(a.fechacorte)=12 and clave1=20 then (siniva) else 0 end)as rec12,
sum(case when month(a.fechacorte)=12 and clave1 in(30,40) then (corregido) else 0 end)as cre12,
sum(case when month(a.fechacorte)=12 and clave1 not in(20,30,40) then (siniva) else 0 end)as con12

from desarrollo.cortes_c a
left join desarrollo.cortes_d b on b.id_cc=a.id and clave1 not in(0,49)
left join catalogo.sucursal c on c.suc=a.suc 
left join catalogo.mes e on e.num=month(a.fechacorte)
left join catalogo.cat_imagen f on f.tipo=c.tipo3
where month(fechacorte)>0 and  year(a.fechacorte)=$aaa and 
c.tlid=1 and fecha_act='0000-00-00' and a.suc not in(176,177,178,178,180,181,187) 
group by c.tipo3
";
$q = $this->db->query($s);
return $q;  
    }
public function s_ventas_compra_mes_nac_det($aaa)
    {
        $s = "select c.tipo2,a.suc,c.nombre as sucx,year(a.fechacorte)as aaa,month(a.fechacorte)as mes,e.mes as mesx, month(a.fechacorte)as mm,c.tipo2,

sum(case when month(a.fechacorte)=1 and clave1=20 then (siniva) else 0 end)as rec01,
sum(case when month(a.fechacorte)=1 and clave1 in(30,40) then (corregido) else 0 end)as cre01,
sum(case when month(a.fechacorte)=1 and clave1 not in(20,30,40) then (siniva) else 0 end)as con01,

sum(case when month(a.fechacorte)=2 and clave1=20 then (siniva) else 0 end)as rec02,
sum(case when month(a.fechacorte)=2 and clave1 in(30,40) then (corregido) else 0 end)as cre02,
sum(case when month(a.fechacorte)=2 and clave1 not in(20,30,40) then (siniva) else 0 end)as con02,

sum(case when month(a.fechacorte)=3 and clave1=20 then (siniva) else 0 end)as rec03,
sum(case when month(a.fechacorte)=3 and clave1 in(30,40) then (corregido) else 0 end)as cre03,
sum(case when month(a.fechacorte)=3 and clave1 not in(20,30,40) then (siniva) else 0 end)as con03,

sum(case when month(a.fechacorte)=4 and clave1=20 then (siniva) else 0 end)as rec04,
sum(case when month(a.fechacorte)=4 and clave1 in(30,40) then (corregido) else 0 end)as cre04,
sum(case when month(a.fechacorte)=4 and clave1 not in(20,30,40) then (siniva) else 0 end)as con04,

sum(case when month(a.fechacorte)=5 and clave1=20 then (siniva) else 0 end)as rec05,
sum(case when month(a.fechacorte)=5 and clave1 in(30,40) then (corregido) else 0 end)as cre05,
sum(case when month(a.fechacorte)=5 and clave1 not in(20,30,40) then (siniva) else 0 end)as con05,

sum(case when month(a.fechacorte)=6 and clave1=20 then (siniva) else 0 end)as rec06,
sum(case when month(a.fechacorte)=6 and clave1 in(30,40) then (corregido) else 0 end)as cre06,
sum(case when month(a.fechacorte)=6 and clave1 not in(20,30,40) then (siniva) else 0 end)as con06,

sum(case when month(a.fechacorte)=7 and clave1=20 then (siniva) else 0 end)as rec07,
sum(case when month(a.fechacorte)=7 and clave1 in(30,40) then (corregido) else 0 end)as cre07,
sum(case when month(a.fechacorte)=7 and clave1 not in(20,30,40) then (siniva) else 0 end)as con07,

sum(case when month(a.fechacorte)=8 and clave1=20 then (siniva) else 0 end)as rec08,
sum(case when month(a.fechacorte)=8 and clave1 in(30,40) then (corregido) else 0 end)as cre08,
sum(case when month(a.fechacorte)=8 and clave1 not in(20,30,40) then (siniva) else 0 end)as con08,

sum(case when month(a.fechacorte)=9 and clave1=20 then (siniva) else 0 end)as rec09,
sum(case when month(a.fechacorte)=9 and clave1 in(30,40) then (corregido) else 0 end)as cre09,
sum(case when month(a.fechacorte)=9 and clave1 not in(20,30,40) then (siniva) else 0 end)as con09,

sum(case when month(a.fechacorte)=10 and clave1=20 then (siniva) else 0 end)as rec10,
sum(case when month(a.fechacorte)=10 and clave1 in(30,40) then (corregido) else 0 end)as cre10,
sum(case when month(a.fechacorte)=10 and clave1 not in(20,30,40) then (siniva) else 0 end)as con10,

sum(case when month(a.fechacorte)=11 and clave1=20 then (siniva) else 0 end)as rec11,
sum(case when month(a.fechacorte)=11 and clave1 in(30,40) then (corregido) else 0 end)as cre11,
sum(case when month(a.fechacorte)=11 and clave1 not in(20,30,40) then (siniva) else 0 end)as con11,

sum(case when month(a.fechacorte)=12 and clave1=20 then (siniva) else 0 end)as rec12,
sum(case when month(a.fechacorte)=12 and clave1 in(30,40) then (corregido) else 0 end)as cre12,
sum(case when month(a.fechacorte)=12 and clave1 not in(20,30,40) then (siniva) else 0 end)as con12

from desarrollo.cortes_c a
left join desarrollo.cortes_d b on b.id_cc=a.id and clave1 not in(0,49)
left join catalogo.sucursal c on c.suc=a.suc 
left join catalogo.mes e on e.num=month(a.fechacorte)
where month(fechacorte)>0 and  year(a.fechacorte)=$aaa and 
c.tlid=1 and fecha_act='0000-00-00' and a.suc not in(176,177,178,178,180,181,187) 
group by a.suc
";
$q = $this->db->query($s);
return $q;  
    }    
 public function s_ventas_captura_diaria_nac()
    {
 $s="SELECT fecha_vta,b.tipo3,c.nombre as imagen,DAYOFWEEK(fecha_vta),
sum(ticket)as tic, sum(vta_servicio)as vta_servicio,sum(vta_contado)as vta_contado, sum(vta_credito)as vta_credito,sum(vta_contado+vta_credito+vta_servicio)as vta_total,
sum(vta_contado+vta_credito+vta_servicio)/sum(ticket)as prome,
case
when DAYOFWEEK(fecha_vta)=1 then 'DOMINGO'
when DAYOFWEEK(fecha_vta)=2 then 'LUNES'
when DAYOFWEEK(fecha_vta)=3 then 'MARTES'
when DAYOFWEEK(fecha_vta)=4 then 'MIERCOLES'
when DAYOFWEEK(fecha_vta)=5 then 'JUEVES'
when DAYOFWEEK(fecha_vta)=6 then 'VIERNES'
when DAYOFWEEK(fecha_vta)=7 then 'SABADO'
else ' ' end as nom_dia
FROM vtadc.vta_captura_diaria a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_imagen c on c.tipo=b.tipo3
where fecha_vta>=subdate(date(now()),7) and fecha_vta<=date(now()) and a.activo=1
group by DAYOFWEEK(fecha_vta),b.tipo3
order by fecha_vta desc,b.tipo3
";
 $q=$this->db->query($s);   
 foreach ($q->result()as $r)
        {
        $a[$r->fecha_vta]['fecha_vta'] = $r->fecha_vta;
        $a[$r->fecha_vta]['nom_dia'] = $r->nom_dia;
        $a[$r->fecha_vta]['d'][$r->tipo3]['tipo2'] = $r->tipo3;
        $a[$r->fecha_vta]['d'][$r->tipo3]['imagen'] = $r->imagen;
        $a[$r->fecha_vta]['d'][$r->tipo3]['tic'] = $r->tic;
        $a[$r->fecha_vta]['d'][$r->tipo3]['vta_credito'] = $r->vta_credito;
        $a[$r->fecha_vta]['d'][$r->tipo3]['vta_contado'] = $r->vta_contado;
        $a[$r->fecha_vta]['d'][$r->tipo3]['vta_servicio'] = $r->vta_servicio;
        $a[$r->fecha_vta]['d'][$r->tipo3]['vta_total'] = $r->vta_total;
        $a[$r->fecha_vta]['d'][$r->tipo3]['prome'] = $r->prome;
        }

     return $a;
 
    }
public function s_no_captura()
    {
 $s="SELECT ifnull(d.nombre,' ') as regionalx,ifnull(c.nombre,' ') as supervisorx,tipo2,a.suc,a.nombre,a.obser 
 from  catalogo.sucursal a
left join vtadc.vta_captura_diaria b on b.suc=a.suc and b.fecha_vta= (date(now())-1) and b.activo=1 and ticket>0
left join compras.usuarios c on c.id_plaza=a.superv and c.tipo=1 and c.nivel=13
left join compras.usuarios d on d.id_plaza=a.regional and c.tipo=1 and d.nivel=12
where  a.tlid=1 and  a.suc>100 and a.suc<=1999 and b.suc is null and a.suc not in(176,177,178,179,180,181,187)
and fecha_act='0000-00-00'
group by fecha_vta,a.suc";
$q = $this->db->query($s);
return $q; 
    }

    public function ventas_comparativas_his_det_nac($id_plaza,$aaa,$mes)
    {
 $s="SELECT a.suc,a.nombre,sum(a2012)as a2012,sum(a2013)as a2013,sum(a2014)as a2014,sum(prome)as prome,sum(a2015)as a2015,

ifnull((select sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)
from  vtadc.vta_captura_diaria aa
join catalogo.sucursal bb on bb.suc=aa.suc and tlid=1
where  activo=1 and year(fecha_vta)=$aaa and month(fecha_vta)=s.num and aa.suc=a.suc
group by year(fecha_vta),month(fecha_vta)),0) as venta_mes,


round(((ifnull((select sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)
from  vtadc.vta_captura_diaria aa
join catalogo.sucursal bb on bb.suc=aa.suc and tlid=1
where  activo=1 and year(fecha_vta)=$aaa and month(fecha_vta)=s.num  and aa.suc=a.suc
group by year(fecha_vta),month(fecha_vta)),0))/sum(prome)*100),2)as porce,
round(((sum(a2015)/sum(prome))*100),2)as porce_real

from catalogo.mes s
join catalogo.sucursal a on  a.tlid=1  and a.dia<>'CER'
left join cortes_resp.cortes_venta_diaria b on b.suc=a.suc and b.mes=s.num
where b.mes=$mes
group by a.suc";
 $a=$this->db->query($s);
 return $a;   
    }
///////////////////////////////////////////////////////////////////////////////////////gerente regional
public function s_ventas_cortes_ger($f1,$f2)
    {
    $aaa=date('Y');
        $s = "select c.tipo3,year(a.fechacorte)as aaa,month(a.fechacorte)as mes,e.mes as mesx, d.nombre as imagen,month(a.fechacorte)as mm,c.tipo2,
sum(case when clave1=20 then (siniva) else 0 end)as recarga,
sum(case when clave1 in(30,40) then (corregido) else 0 end)as credito,
sum(case when clave1 not in(20,30,40) then (siniva) else 0 end)as contado
from desarrollo.cortes_c a
left join desarrollo.cortes_d b on b.id_cc=a.id and clave1 not in(0,49)
left join catalogo.sucursal c on c.suc=a.suc
left join catalogo.cat_imagen d on d.tipo=c.tipo3
left join catalogo.mes e on e.num=month(a.fechacorte)
where month(fechacorte)>0 and  year(a.fechacorte)=$aaa and regional=$f2 and regional>0
group by date_format(fechacorte,'%Y-%m'),tipo3";
        $q = $this->db->query($s);
        $b=0;
        foreach ($q->result()as $r)
        {
        $a[$r->mes]['f2'] = $f2;
        $a[$r->mes]['mesx'] = $r->mesx;
        $a[$r->mes]['mes'] = $r->mm;
        $a[$r->mes]['aaa'] = $r->aaa;
        $a[$r->mes]['m'][$r->tipo3]['tipo2'] = $r->tipo3;
        $a[$r->mes]['m'][$r->tipo3]['imagen'] = $r->imagen;
        $a[$r->mes]['m'][$r->tipo3]['credito'] = $r->credito;
        $a[$r->mes]['m'][$r->tipo3]['recarga'] = $r->recarga;
        $a[$r->mes]['m'][$r->tipo3]['contado'] = $r->contado;
        }

     return $a;  
    }
public function s_ventas_ger_imagen($aaa,$mes,$tipo3,$f2)
    {
        $s = "select c.tipo3,a.suc,year(a.fechacorte)as aaa,month(a.fechacorte)as mes,e.mes as mesx, d.nombre as imagen,month(a.fechacorte)as mm,c.tipo2,
sum(case when clave1=20 then (siniva) else 0 end)as recarga,
sum(case when clave1 in(30,40) then (corregido) else 0 end)as credito,
sum(case when clave1 not in(20,30,40) then (siniva) else 0 end)as contado,
c.nombre as sucx
from desarrollo.cortes_c a
left join desarrollo.cortes_d b on b.id_cc=a.id and clave1 not in(0,49)
left join catalogo.sucursal c on c.suc=a.suc
left join catalogo.cat_imagen d on d.tipo=c.tipo3
left join catalogo.mes e on e.num=month(a.fechacorte)
where month(fechacorte)=$mes and  year(a.fechacorte)=$aaa and regional=$f2 and tipo3='$tipo3'  and regional>0
group by a.suc";
$q = $this->db->query($s);
return $q;  
    }
public function s_ventas_compra_mes_ger($aaa,$f2)
    {
        $s = "select a.suc,c.nombre as sucx,year(a.fechacorte)as aaa,month(a.fechacorte)as mes,e.mes as mesx, month(a.fechacorte)as mm,c.tipo2,

sum(case when month(a.fechacorte)=1 and clave1=20 then (siniva) else 0 end)as rec01,
sum(case when month(a.fechacorte)=1 and clave1 in(30,40) then (corregido) else 0 end)as cre01,
sum(case when month(a.fechacorte)=1 and clave1 not in(20,30,40) then (siniva) else 0 end)as con01,

sum(case when month(a.fechacorte)=2 and clave1=20 then (siniva) else 0 end)as rec02,
sum(case when month(a.fechacorte)=2 and clave1 in(30,40) then (corregido) else 0 end)as cre02,
sum(case when month(a.fechacorte)=2 and clave1 not in(20,30,40) then (siniva) else 0 end)as con02,

sum(case when month(a.fechacorte)=3 and clave1=20 then (siniva) else 0 end)as rec03,
sum(case when month(a.fechacorte)=3 and clave1 in(30,40) then (corregido) else 0 end)as cre03,
sum(case when month(a.fechacorte)=3 and clave1 not in(20,30,40) then (siniva) else 0 end)as con03,

sum(case when month(a.fechacorte)=4 and clave1=20 then (siniva) else 0 end)as rec04,
sum(case when month(a.fechacorte)=4 and clave1 in(30,40) then (corregido) else 0 end)as cre04,
sum(case when month(a.fechacorte)=4 and clave1 not in(20,30,40) then (siniva) else 0 end)as con04,

sum(case when month(a.fechacorte)=5 and clave1=20 then (siniva) else 0 end)as rec05,
sum(case when month(a.fechacorte)=5 and clave1 in(30,40) then (corregido) else 0 end)as cre05,
sum(case when month(a.fechacorte)=5 and clave1 not in(20,30,40) then (siniva) else 0 end)as con05,

sum(case when month(a.fechacorte)=6 and clave1=20 then (siniva) else 0 end)as rec06,
sum(case when month(a.fechacorte)=6 and clave1 in(30,40) then (corregido) else 0 end)as cre06,
sum(case when month(a.fechacorte)=6 and clave1 not in(20,30,40) then (siniva) else 0 end)as con06,

sum(case when month(a.fechacorte)=7 and clave1=20 then (siniva) else 0 end)as rec07,
sum(case when month(a.fechacorte)=7 and clave1 in(30,40) then (corregido) else 0 end)as cre07,
sum(case when month(a.fechacorte)=7 and clave1 not in(20,30,40) then (siniva) else 0 end)as con07,

sum(case when month(a.fechacorte)=8 and clave1=20 then (siniva) else 0 end)as rec08,
sum(case when month(a.fechacorte)=8 and clave1 in(30,40) then (corregido) else 0 end)as cre08,
sum(case when month(a.fechacorte)=8 and clave1 not in(20,30,40) then (siniva) else 0 end)as con08,

sum(case when month(a.fechacorte)=9 and clave1=20 then (siniva) else 0 end)as rec09,
sum(case when month(a.fechacorte)=9 and clave1 in(30,40) then (corregido) else 0 end)as cre09,
sum(case when month(a.fechacorte)=9 and clave1 not in(20,30,40) then (siniva) else 0 end)as con09,

sum(case when month(a.fechacorte)=10 and clave1=20 then (siniva) else 0 end)as rec10,
sum(case when month(a.fechacorte)=10 and clave1 in(30,40) then (corregido) else 0 end)as cre10,
sum(case when month(a.fechacorte)=10 and clave1 not in(20,30,40) then (siniva) else 0 end)as con10,

sum(case when month(a.fechacorte)=11 and clave1=20 then (siniva) else 0 end)as rec11,
sum(case when month(a.fechacorte)=11 and clave1 in(30,40) then (corregido) else 0 end)as cre11,
sum(case when month(a.fechacorte)=11 and clave1 not in(20,30,40) then (siniva) else 0 end)as con11,

sum(case when month(a.fechacorte)=12 and clave1=20 then (siniva) else 0 end)as rec12,
sum(case when month(a.fechacorte)=12 and clave1 in(30,40) then (corregido) else 0 end)as cre12,
sum(case when month(a.fechacorte)=12 and clave1 not in(20,30,40) then (siniva) else 0 end)as con12

from desarrollo.cortes_c a
left join desarrollo.cortes_d b on b.id_cc=a.id and clave1 not in(0,49)
left join catalogo.sucursal c on c.suc=a.suc
left join catalogo.mes e on e.num=month(a.fechacorte)
where month(fechacorte)>0 and  year(a.fechacorte)=$aaa and regional=$f2 and 
c.tlid=1 and fecha_act='0000-00-00' and a.suc not in(176,177,178,178,180,181,187)
group by a.suc
";
$q = $this->db->query($s);
return $q;  
    }
function s_ventas_capturada_ger($id_plaza)
{
 $s="select a.regional,a.tipo2,a.suc,a.nombre as sucx,
sum(case when DAYOFWEEK(fecha_vta)='1' then (vta_contado) else 0 end)as dom_con,
sum(case when DAYOFWEEK(fecha_vta)='2' then (vta_contado) else 0 end)as lun_con,
sum(case when DAYOFWEEK(fecha_vta)='3' then (vta_contado) else 0 end)as mar_con,
sum(case when DAYOFWEEK(fecha_vta)='4' then (vta_contado) else 0 end)as mie_con,
sum(case when DAYOFWEEK(fecha_vta)='5' then (vta_contado) else 0 end)as jue_con,
sum(case when DAYOFWEEK(fecha_vta)='6' then (vta_contado) else 0 end)as vie_con,
sum(case when DAYOFWEEK(fecha_vta)='7' then (vta_contado) else 0 end)as sab_con,

sum(case when DAYOFWEEK(fecha_vta)='1' then (vta_credito) else 0 end)as dom_cre,
sum(case when DAYOFWEEK(fecha_vta)='2' then (vta_credito) else 0 end)as lun_cre,
sum(case when DAYOFWEEK(fecha_vta)='3' then (vta_credito) else 0 end)as mar_cre,
sum(case when DAYOFWEEK(fecha_vta)='4' then (vta_credito) else 0 end)as mie_cre,
sum(case when DAYOFWEEK(fecha_vta)='5' then (vta_credito) else 0 end)as jue_cre,
sum(case when DAYOFWEEK(fecha_vta)='6' then (vta_credito) else 0 end)as vie_cre,
sum(case when DAYOFWEEK(fecha_vta)='7' then (vta_credito) else 0 end)as sab_cre,

sum(case when DAYOFWEEK(fecha_vta)='1' then (ticket) else 0 end)as dom_tic,
sum(case when DAYOFWEEK(fecha_vta)='2' then (ticket) else 0 end)as lun_tic,
sum(case when DAYOFWEEK(fecha_vta)='3' then (ticket) else 0 end)as mar_tic,
sum(case when DAYOFWEEK(fecha_vta)='4' then (ticket) else 0 end)as mie_tic,
sum(case when DAYOFWEEK(fecha_vta)='5' then (ticket) else 0 end)as jue_tic,
sum(case when DAYOFWEEK(fecha_vta)='6' then (ticket) else 0 end)as vie_tic,
sum(case when DAYOFWEEK(fecha_vta)='7' then (ticket) else 0 end)as sab_tic,

sum(case when DAYOFWEEK(fecha_vta)='1' then (vta_servicio) else 0 end)as dom_ser,
sum(case when DAYOFWEEK(fecha_vta)='2' then (vta_servicio) else 0 end)as lun_ser,
sum(case when DAYOFWEEK(fecha_vta)='3' then (vta_servicio) else 0 end)as mar_ser,
sum(case when DAYOFWEEK(fecha_vta)='4' then (vta_servicio) else 0 end)as mie_ser,
sum(case when DAYOFWEEK(fecha_vta)='5' then (vta_servicio) else 0 end)as jue_ser,
sum(case when DAYOFWEEK(fecha_vta)='6' then (vta_servicio) else 0 end)as vie_ser,
sum(case when DAYOFWEEK(fecha_vta)='7' then (vta_servicio) else 0 end)as sab_ser
from catalogo.sucursal a
left join vtadc.vta_captura_diaria b on b.suc=a.suc and WEEK(fecha_vta)=week(date(now()))  and b.activo=1
where a.tlid=1 and  a.suc>100 and a.suc<=2899 and fecha_act='0000-00-00'
and a.suc not in(176,177,178,179,180,187,127) and regional=$id_plaza
group by a.suc";
$q=$this->db->query($s);
return $q;   
}
function s_ventas_capturada_dia_ger($id_plaza,$fec)
{
 $s="select a.tipo2,a.suc,a.nombre as sucx,
min(fecha_cap)as inicio,sum(ticket)as tic,sum(vta_contado)as con,sum(vta_credito)as cre,sum(vta_servicio)as ser,max(fecha_cap)as fin,
(sum(vta_contado+vta_credito+vta_servicio)/sum(ticket))as prome,

(select sum(corregido) from desarrollo.cortes_c c
left join desarrollo.cortes_d d on d.id_cc=c.id
where  clave1 not in(0,49,30,40) and c.suc=a.suc and c.fechacorte='$fec'
group by a.suc) as con_corte,
(select sum(corregido) from desarrollo.cortes_c c
left join desarrollo.cortes_d d on d.id_cc=c.id
where  clave1 in(30,40) and c.suc=a.suc and c.fechacorte='$fec'
group by a.suc)as cre_corte

from catalogo.sucursal a
left join vtadc.vta_captura_diaria b on b.suc=a.suc and fecha_vta='$fec' and b.activo=1

where a.tlid=1 and  a.suc>100 and a.suc<=1999 and fecha_act='0000-00-00'
and a.suc not in(176,177,178,179,180,187,127) and regional=$id_plaza
group by a.suc
order by tipo2,suc";
$q=$this->db->query($s);
return $q;   
}
public function ventas_comparativas_his_ger($id_plaza,$aaa)
    {
 $s="SELECT 
 s.num as mes,s.mes as mesx,sum(a2012)as a2012,sum(a2013)as a2013,sum(a2014)as a2014,sum(prome)as prome,sum(a2015)as a2015,
 sum(a2015)as a2015,

ifnull((select sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)
from  vtadc.vta_captura_diaria a
join catalogo.sucursal b on b.suc=a.suc and tlid=1  and b.tlid=1  and b.dia<>'CER'
where b.regional=$id_plaza and activo=1 and year(fecha_vta)=$aaa and month(fecha_vta)=s.num
group by year(fecha_vta),month(fecha_vta)),0) as venta_mes,


round(((ifnull((select sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)
from  vtadc.vta_captura_diaria a
join catalogo.sucursal b on b.suc=a.suc and tlid=1  and b.tlid=1  and b.dia<>'CER'
where b.regional=$id_plaza and activo=1 and year(fecha_vta)=$aaa and month(fecha_vta)=s.num
group by year(fecha_vta),month(fecha_vta)),0))/sum(prome)*100),2)as porce,

round(((sum(a2015)/sum(prome))*100),2)as porce_real

from catalogo.mes s
join catalogo.sucursal a on a.regional=$id_plaza and a.tlid=1  and a.dia<>'CER'
left join cortes_resp.cortes_venta_diaria b on b.suc=a.suc and b.mes=s.num
group by s.num";
 $a=$this->db->query($s);
 return $a;   
    }
    public function ventas_comparativas_his_det_ger($id_plaza,$aaa,$mes)
    {
 $s="SELECT a.suc,a.nombre,sum(a2012)as a2012,sum(a2013)as a2013,sum(a2014)as a2014,sum(prome)as prome,sum(a2015)as a2015,

ifnull((select sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)
from  vtadc.vta_captura_diaria aa
join catalogo.sucursal bb on bb.suc=aa.suc and tlid=1
where bb.regional=$id_plaza and activo=1 and year(fecha_vta)=$aaa and month(fecha_vta)=s.num and aa.suc=a.suc
group by year(fecha_vta),month(fecha_vta)),0) as venta_mes,


round(((ifnull((select sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)
from  vtadc.vta_captura_diaria aa
join catalogo.sucursal bb on bb.suc=aa.suc and tlid=1
where bb.regional=$id_plaza and activo=1 and year(fecha_vta)=$aaa and month(fecha_vta)=s.num  and aa.suc=a.suc
group by year(fecha_vta),month(fecha_vta)),0))/sum(prome)*100),2)as porce,
round(((sum(a2015)/sum(prome))*100),2)as porce_real

from catalogo.mes s
join catalogo.sucursal a on a.regional=$id_plaza and a.tlid=1  and a.dia<>'CER'
left join cortes_resp.cortes_venta_diaria b on b.suc=a.suc and b.mes=s.num
where b.mes=$mes
group by a.suc";
 $a=$this->db->query($s);
 return $a;   
    }
  function ventas_suc_captura($suc)
 {
    $s="SELECT a.*,b.nombre as sucx FROM vtadc.vta_captura_diaria a 
        join catalogo.sucursal b on b.suc=a.suc 
        where a.suc=$suc and a.fecha_vta between subdate(date(now()),7) and subdate(date(now()),1)
        and activo in(1,5)
        order by a.fecha_vta desc";
    $q=$this->db->query($s);
    return $q;
 }
 function depositos_suc_captura($suc)
 {
    $s="SELECT a.*,b.nombre as sucx FROM vtadc.vta_captura_diaria_deposito a
        join catalogo.sucursal b on b.suc=a.suc
        where a.suc=$suc and a.fecha_ficha between subdate(date(now()),7) and subdate(date(now()),1)
        and activo in(1,5)
        order by a.fecha_ficha desc,a.fecha_venta desc";
    $q=$this->db->query($s);
    return $q;
 }
 
/////////////////////////////////////////////////////////////////////////////supervisor
 public function s_ventas_succ($f2)
    {
    $aaa=date('Y');
        $s = "select tipo3,year(a.fechacorte)as aaa,month(a.fechacorte)as mes,e.mes as mesx, d.nombre as imagen,month(a.fechacorte)as mm,c.tipo2,
sum(case when clave1=20 then (siniva) else 0 end)as recarga,
sum(case when clave1 in(30,40) then (corregido) else 0 end)as credito,
sum(case when clave1 not in(20,30,40) then (siniva) else 0 end)as contado
from desarrollo.cortes_c a
left join desarrollo.cortes_d b on b.id_cc=a.id and clave1 not in(0,49)
left join catalogo.sucursal c on c.suc=a.suc
left join catalogo.cat_imagen d on d.tipo=c.tipo3
left join catalogo.mes e on e.num=month(a.fechacorte)
where month(fechacorte)>0 and  year(a.fechacorte)=$aaa and superv=$f2  and superv>0
group by date_format(fechacorte,'%Y-%m'),tipo3

";

        $q = $this->db->query($s);
        $b=0;
        foreach ($q->result()as $r)
        {
        $a[$r->mes]['f2'] = $f2;
        $a[$r->mes]['mesx'] = $r->mesx;
        $a[$r->mes]['mes'] = $r->mm;
        $a[$r->mes]['aaa'] = $r->aaa;
        $a[$r->mes]['m'][$r->tipo3]['tipo2'] = $r->tipo3;
        $a[$r->mes]['m'][$r->tipo3]['imagen'] = $r->imagen;
        $a[$r->mes]['m'][$r->tipo3]['credito'] = $r->credito;
        $a[$r->mes]['m'][$r->tipo3]['recarga'] = $r->recarga;
        $a[$r->mes]['m'][$r->tipo3]['contado'] = $r->contado;
        }

     return $a;  
    }
    
public function s_ventas_succ_imagen($aaa,$mes,$tipo2,$f2)
    {
        $s = "select c.tipo3,a.suc,year(a.fechacorte)as aaa,month(a.fechacorte)as mes,e.mes as mesx, d.nombre as imagen,month(a.fechacorte)as mm,c.tipo2,
sum(case when clave1=20 then (siniva) else 0 end)as recarga,
sum(case when clave1 in(30,40) then (corregido) else 0 end)as credito,
sum(case when clave1 not in(20,30,40) then (siniva) else 0 end)as contado,
c.nombre as sucx
from desarrollo.cortes_c a
left join desarrollo.cortes_d b on b.id_cc=a.id and clave1 not in(0,49)
left join catalogo.sucursal c on c.suc=a.suc
left join catalogo.cat_imagen d on d.tipo=c.tipo3
left join catalogo.mes e on e.num=month(a.fechacorte)
where month(fechacorte)=$mes and  year(a.fechacorte)=$aaa and superv=$f2 and tipo3='$tipo2'  and superv>0
group by a.suc";
$q = $this->db->query($s);
return $q;  
    }
public function s_ventas_succ_dia($aaa,$mes,$suc,$f2)
    {
        $s = "select c.tipo3,a.fechacorte,a.suc,year(a.fechacorte)as aaa,month(a.fechacorte)as mes,e.mes as mesx, d.nombre as imagen,month(a.fechacorte)as mm,c.tipo2,
sum(case when clave1=20 then (siniva) else 0 end)as recarga,
sum(case when clave1 in(30,40) then (corregido) else 0 end)as credito,
sum(case when clave1 not in(20,30,40) then (siniva) else 0 end)as contado,
c.nombre as sucx
from desarrollo.cortes_c a
left join desarrollo.cortes_d b on b.id_cc=a.id and clave1 not in(0,49)
left join catalogo.sucursal c on c.suc=a.suc
left join catalogo.cat_imagen d on d.tipo=c.tipo3
left join catalogo.mes e on e.num=month(a.fechacorte)
where month(fechacorte)=$mes and  year(a.fechacorte)=$aaa  and a.suc=$suc 
group by a.fechacorte
";
$q = $this->db->query($s);
return $q;  
    }
    
public function s_ventas_compra_mes($aaa,$f2)
    {
        $s = "select a.suc,c.nombre as sucx,year(a.fechacorte)as aaa,month(a.fechacorte)as mes,e.mes as mesx, month(a.fechacorte)as mm,c.tipo2,

sum(case when month(a.fechacorte)=1 and clave1=20 then (siniva) else 0 end)as rec01,
sum(case when month(a.fechacorte)=1 and clave1 in(30,40) then (corregido) else 0 end)as cre01,
sum(case when month(a.fechacorte)=1 and clave1 not in(20,30,40) then (siniva) else 0 end)as con01,

sum(case when month(a.fechacorte)=2 and clave1=20 then (siniva) else 0 end)as rec02,
sum(case when month(a.fechacorte)=2 and clave1 in(30,40) then (corregido) else 0 end)as cre02,
sum(case when month(a.fechacorte)=2 and clave1 not in(20,30,40) then (siniva) else 0 end)as con02,

sum(case when month(a.fechacorte)=3 and clave1=20 then (siniva) else 0 end)as rec03,
sum(case when month(a.fechacorte)=3 and clave1 in(30,40) then (corregido) else 0 end)as cre03,
sum(case when month(a.fechacorte)=3 and clave1 not in(20,30,40) then (siniva) else 0 end)as con03,

sum(case when month(a.fechacorte)=4 and clave1=20 then (siniva) else 0 end)as rec04,
sum(case when month(a.fechacorte)=4 and clave1 in(30,40) then (corregido) else 0 end)as cre04,
sum(case when month(a.fechacorte)=4 and clave1 not in(20,30,40) then (siniva) else 0 end)as con04,

sum(case when month(a.fechacorte)=5 and clave1=20 then (siniva) else 0 end)as rec05,
sum(case when month(a.fechacorte)=5 and clave1 in(30,40) then (corregido) else 0 end)as cre05,
sum(case when month(a.fechacorte)=5 and clave1 not in(20,30,40) then (siniva) else 0 end)as con05,

sum(case when month(a.fechacorte)=6 and clave1=20 then (siniva) else 0 end)as rec06,
sum(case when month(a.fechacorte)=6 and clave1 in(30,40) then (corregido) else 0 end)as cre06,
sum(case when month(a.fechacorte)=6 and clave1 not in(20,30,40) then (siniva) else 0 end)as con06,

sum(case when month(a.fechacorte)=7 and clave1=20 then (siniva) else 0 end)as rec07,
sum(case when month(a.fechacorte)=7 and clave1 in(30,40) then (corregido) else 0 end)as cre07,
sum(case when month(a.fechacorte)=7 and clave1 not in(20,30,40) then (siniva) else 0 end)as con07,

sum(case when month(a.fechacorte)=8 and clave1=20 then (siniva) else 0 end)as rec08,
sum(case when month(a.fechacorte)=8 and clave1 in(30,40) then (corregido) else 0 end)as cre08,
sum(case when month(a.fechacorte)=8 and clave1 not in(20,30,40) then (siniva) else 0 end)as con08,

sum(case when month(a.fechacorte)=9 and clave1=20 then (siniva) else 0 end)as rec09,
sum(case when month(a.fechacorte)=9 and clave1 in(30,40) then (corregido) else 0 end)as cre09,
sum(case when month(a.fechacorte)=9 and clave1 not in(20,30,40) then (siniva) else 0 end)as con09,

sum(case when month(a.fechacorte)=10 and clave1=20 then (siniva) else 0 end)as rec10,
sum(case when month(a.fechacorte)=10 and clave1 in(30,40) then (corregido) else 0 end)as cre10,
sum(case when month(a.fechacorte)=10 and clave1 not in(20,30,40) then (siniva) else 0 end)as con10,

sum(case when month(a.fechacorte)=11 and clave1=20 then (siniva) else 0 end)as rec11,
sum(case when month(a.fechacorte)=11 and clave1 in(30,40) then (corregido) else 0 end)as cre11,
sum(case when month(a.fechacorte)=11 and clave1 not in(20,30,40) then (siniva) else 0 end)as con11,

sum(case when month(a.fechacorte)=12 and clave1=20 then (siniva) else 0 end)as rec12,
sum(case when month(a.fechacorte)=12 and clave1 in(30,40) then (corregido) else 0 end)as cre12,
sum(case when month(a.fechacorte)=12 and clave1 not in(20,30,40) then (siniva) else 0 end)as con12

from desarrollo.cortes_c a
left join desarrollo.cortes_d b on b.id_cc=a.id and clave1 not in(0,49)
left join catalogo.sucursal c on c.suc=a.suc
left join catalogo.mes e on e.num=month(a.fechacorte)
where month(fechacorte)>0 and  year(a.fechacorte)=$aaa and superv=$f2 
and 
c.tlid=1 and fecha_act='0000-00-00' and a.suc not in(176,177,178,178,180,181,187)
group by a.suc
";
$q = $this->db->query($s);
return $q;  
    }    
    
function s_ventas_capturada($id_plaza)
{
 $s="select a.tipo2,a.suc,a.nombre as sucx,
sum(case when DAYOFWEEK(fecha_vta)='1' then (vta_contado) else 0 end)as dom_con,
sum(case when DAYOFWEEK(fecha_vta)='2' then (vta_contado) else 0 end)as lun_con,
sum(case when DAYOFWEEK(fecha_vta)='3' then (vta_contado) else 0 end)as mar_con,
sum(case when DAYOFWEEK(fecha_vta)='4' then (vta_contado) else 0 end)as mie_con,
sum(case when DAYOFWEEK(fecha_vta)='5' then (vta_contado) else 0 end)as jue_con,
sum(case when DAYOFWEEK(fecha_vta)='6' then (vta_contado) else 0 end)as vie_con,
sum(case when DAYOFWEEK(fecha_vta)='7' then (vta_contado) else 0 end)as sab_con,

sum(case when DAYOFWEEK(fecha_vta)='1' then (vta_credito) else 0 end)as dom_cre,
sum(case when DAYOFWEEK(fecha_vta)='2' then (vta_credito) else 0 end)as lun_cre,
sum(case when DAYOFWEEK(fecha_vta)='3' then (vta_credito) else 0 end)as mar_cre,
sum(case when DAYOFWEEK(fecha_vta)='4' then (vta_credito) else 0 end)as mie_cre,
sum(case when DAYOFWEEK(fecha_vta)='5' then (vta_credito) else 0 end)as jue_cre,
sum(case when DAYOFWEEK(fecha_vta)='6' then (vta_credito) else 0 end)as vie_cre,
sum(case when DAYOFWEEK(fecha_vta)='7' then (vta_credito) else 0 end)as sab_cre,

sum(case when DAYOFWEEK(fecha_vta)='1' then (ticket) else 0 end)as dom_tic,
sum(case when DAYOFWEEK(fecha_vta)='2' then (ticket) else 0 end)as lun_tic,
sum(case when DAYOFWEEK(fecha_vta)='3' then (ticket) else 0 end)as mar_tic,
sum(case when DAYOFWEEK(fecha_vta)='4' then (ticket) else 0 end)as mie_tic,
sum(case when DAYOFWEEK(fecha_vta)='5' then (ticket) else 0 end)as jue_tic,
sum(case when DAYOFWEEK(fecha_vta)='6' then (ticket) else 0 end)as vie_tic,
sum(case when DAYOFWEEK(fecha_vta)='7' then (ticket) else 0 end)as sab_tic,

sum(case when DAYOFWEEK(fecha_vta)='1' then (vta_servicio) else 0 end)as dom_ser,
sum(case when DAYOFWEEK(fecha_vta)='2' then (vta_servicio) else 0 end)as lun_ser,
sum(case when DAYOFWEEK(fecha_vta)='3' then (vta_servicio) else 0 end)as mar_ser,
sum(case when DAYOFWEEK(fecha_vta)='4' then (vta_servicio) else 0 end)as mie_ser,
sum(case when DAYOFWEEK(fecha_vta)='5' then (vta_servicio) else 0 end)as jue_ser,
sum(case when DAYOFWEEK(fecha_vta)='6' then (vta_servicio) else 0 end)as vie_ser,
sum(case when DAYOFWEEK(fecha_vta)='7' then (vta_servicio) else 0 end)as sab_ser
from catalogo.sucursal a
left join vtadc.vta_captura_diaria b on b.suc=a.suc and WEEK(fecha_vta)=week(date(now()))  and b.activo=1
where a.tlid=1 and  a.suc>100 and a.suc<=2899 and fecha_act='0000-00-00'
and a.suc not in(176,177,178,179,180,187,127) and superv=$id_plaza
group by a.suc";
$q=$this->db->query($s);
return $q;   
}
function s_ventas_capturada_dia($id_plaza,$fec)
{
 $s="select a.tipo2,a.suc,a.nombre as sucx,
min(fecha_cap)as inicio,sum(ticket)as tic,sum(vta_contado)as con,sum(vta_credito)as cre,sum(vta_servicio)as ser,max(fecha_cap)as fin,
(sum(vta_contado+vta_credito+vta_servicio)/sum(ticket))as prome,

(select sum(corregido) from desarrollo.cortes_c c
left join desarrollo.cortes_d d on d.id_cc=c.id
where  clave1 not in(0,49,30,40) and c.suc=a.suc and c.fechacorte='$fec'
group by a.suc) as con_corte,
(select sum(corregido) from desarrollo.cortes_c c
left join desarrollo.cortes_d d on d.id_cc=c.id
where  clave1 in(30,40) and c.suc=a.suc and c.fechacorte='$fec'
group by a.suc)as cre_corte

from catalogo.sucursal a
left join vtadc.vta_captura_diaria b on b.suc=a.suc and fecha_vta='$fec' and b.activo=1

where a.tlid=1 and  a.suc>100 and a.suc<=1999 and fecha_act='0000-00-00'
and a.suc not in(176,177,178,179,180,187,127) and superv=$id_plaza
group by a.suc
order by tipo2,suc";
$q=$this->db->query($s);
return $q;   
}
public function ventas_comparativas_his($id_plaza,$aaa)
    {
 $s="SELECT s.num as mes,s.mes as mesx,sum(a2012)as a2012,sum(a2013)as a2013,sum(a2014)as a2014,sum(prome)as prome,sum(a2015)as a2015,

ifnull((select sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)
from  vtadc.vta_captura_diaria a
join catalogo.sucursal b on b.suc=a.suc and tlid=1  and b.tlid=1  and b.dia<>'CER'
where b.superv=$id_plaza and activo=1 and year(fecha_vta)=$aaa and month(fecha_vta)=s.num
group by year(fecha_vta),month(fecha_vta)),0) as venta_mes,


round(((ifnull((select sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)
from  vtadc.vta_captura_diaria a
join catalogo.sucursal b on b.suc=a.suc and tlid=1  and b.tlid=1  and b.dia<>'CER'
where b.superv=$id_plaza and activo=1 and year(fecha_vta)=$aaa and month(fecha_vta)=s.num
group by year(fecha_vta),month(fecha_vta)),0))/sum(prome)*100),2)as porce,

round(((sum(a2015)/sum(prome))*100),2)as porce_real
from catalogo.mes s
join catalogo.sucursal a on a.superv=$id_plaza and a.tlid=1  and a.dia<>'CER'
left join cortes_resp.cortes_venta_diaria b on b.suc=a.suc and b.mes=s.num
group by s.num";
 $a=$this->db->query($s);
 return $a;   
    }
 public function ventas_comparativas_his_det($id_plaza,$aaa,$mes)
    {
 $s="SELECT a.suc,a.nombre,sum(a2012)as a2012,sum(a2013)as a2013,sum(a2014)as a2014,sum(prome)as prome,sum(a2015)as a2015,

ifnull((select sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)
from  vtadc.vta_captura_diaria aa
join catalogo.sucursal bb on bb.suc=aa.suc and tlid=1
where bb.superv=$id_plaza and activo=1 and year(fecha_vta)=$aaa and month(fecha_vta)=s.num and aa.suc=a.suc
group by year(fecha_vta),month(fecha_vta)),0) as venta_mes,


round(((ifnull((select sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)
from  vtadc.vta_captura_diaria aa
join catalogo.sucursal bb on bb.suc=aa.suc and tlid=1
where bb.superv=$id_plaza and activo=1 and year(fecha_vta)=$aaa and month(fecha_vta)=s.num  and aa.suc=a.suc
group by year(fecha_vta),month(fecha_vta)),0))/sum(prome)*100),2)as porce,

round(((sum(a2015)/sum(prome))*100),2)as porce_real

from catalogo.mes s
join catalogo.sucursal a on a.superv=$id_plaza and a.tlid=1  and a.dia<>'CER'
left join cortes_resp.cortes_venta_diaria b on b.suc=a.suc and b.mes=s.num
where b.mes=$mes
group by a.suc";
 $a=$this->db->query($s);
 return $a;   
    }
 
 public function ventas_comparativas_his_det_suc($id_plaza,$aaa,$mes,$suc)
    {
echo $suc;
 $s="SELECT b.dia,a.suc,a.nombre,sum(a2012)as a2012,sum(a2013)as a2013,sum(a2014)as a2014,sum(prome)as prome,sum(a2015)as a2015,
ifnull((select sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)
from  vtadc.vta_captura_diaria aa
join catalogo.sucursal bb on bb.suc=aa.suc and tlid=1
where  activo=1 and year(fecha_vta)=$aaa and month(fecha_vta)=s.num  and day(fecha_vta)=b.dia and aa.suc=a.suc
group by year(fecha_vta),month(fecha_vta)),0) as venta_mes,


round(((ifnull((select sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)
from  vtadc.vta_captura_diaria aa
join catalogo.sucursal bb on bb.suc=aa.suc and tlid=1
where  activo=1 and year(fecha_vta)=$aaa and month(fecha_vta)=s.num   and day(fecha_vta)=b.dia and aa.suc=a.suc
group by year(fecha_vta),month(fecha_vta)),0))/sum(prome)*100),2)as porce,

round(((sum(a2015)/sum(prome))*100),2)as porce_real

from catalogo.mes s
join catalogo.sucursal a on  a.tlid=1  and a.dia<>'CER'
left join cortes_resp.cortes_venta_diaria b on b.suc=a.suc and b.mes=s.num
where b.mes=$mes and a.suc=$suc
group by b.dia,a.suc";
$a=$this->db->query($s);
 return $a;   
    }
 public function venta_zona_dia($id_plaza)
    {

 $s="select regional,superv,concat('ZONA ',superv)as zona,count(suc)as tot_suc
from catalogo.sucursal
where tlid=1 and fecha_act='0000-00-00'
and superv>0 and superv<80 and regional=$id_plaza
group by regional,superv";
$a=$this->db->query($s);
 return $a;   
    }
 public function venta_ctl_sup($id_plaza,$mes)
 {
 $sf="select a.superv,b.mes,b.dia,a.suc,a.nombre,max(b.dia)as max_dia,

sum(ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn),0))as pesos,

sum(ifnull((turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv),0))as tar,

sum(ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn+turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv),0))as total,

(sum(ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn),0))-
sum(ifnull(corregido,0)))as tot_sin_recarga,

sum(ifnull(corregido,0))as recarga
from catalogo.sucursal a
left join catalogo.dia_mes b on b.mes=$mes
left join desarrollo.cortes_c c on c.suc=a.suc and month(fechacorte)=b.mes and day(fechacorte)=b.dia
left join desarrollo.cortes_d d on d.id_cc=c.id and clave1=20
where  
tlid=1 and tipo3<>' ' and b.mes=$mes and a.regional=$id_plaza or
tlid=1 and tipo3<>' ' and b.mes=$mes and a.superv=$id_plaza
group by suc
order by a.superv,a.tipo3,a.suc,b.dia
";
$qf=$this->db->query($sf);
return $qf;
 }
 
  public function venta_ctl_det($id_plaza,$mes)
 {
$s="select a.superv,b.mes,b.dia,a.suc,a.nombre,

ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn),0)as pesos,

ifnull((turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv),0)as tar,

ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn+turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv),0)as total,

(ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn+turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv),0)-
ifnull(corregido,0))as tot_sin_recarga,

ifnull(corregido,0)as recarga

from catalogo.sucursal a
left join catalogo.dia_mes b on b.mes=$mes
left join desarrollo.cortes_c c on c.suc=a.suc and month(fechacorte)=b.mes and day(fechacorte)=b.dia
left join desarrollo.cortes_d d on d.id_cc=c.id and clave1=20
where  
tlid=1 and tipo3<>' ' and b.mes=$mes and a.regional=$id_plaza or
tlid=1 and tipo3<>' ' and b.mes=$mes and a.superv=$id_plaza
order by a.superv,a.tipo3,a.suc,b.dia
";
 $q=$this->db->query($s);
 
 foreach ($q->result()as $r)
        {
        $a[$r->dia]['su'] = $r->suc;
        $a[$r->dia]['d'][$r->suc]['suc'] = $r->suc;
        $a[$r->dia]['d'][$r->suc]['dia'] = $r->dia;
        $a[$r->dia]['d'][$r->suc]['pesos'] = $r->pesos;
        $a[$r->dia]['d'][$r->suc]['tar'] = $r->tar;
        $a[$r->dia]['d'][$r->suc]['total'] = $r->total;
        $a[$r->dia]['d'][$r->suc]['tot_sin_recarga'] = $r->tot_sin_recarga;
        $a[$r->dia]['d'][$r->suc]['recarga'] = $r->recarga;
        } 
return $a;
 }
 
 public function venta_ctl_reg($id_plaza,$mes,$aaa)
 {
 $sf="select a.superv,b.mes,b.dia,a.suc,a.nombre,max(b.dia)as max_dia,

sum(ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn),0))as pesos,

sum(ifnull((turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv),0))as tar,

sum(ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn+turno1_san+turno1_bbv+turno2_san+turno2_bbv+turno3_san+turno3_bbv+turno4_san+turno4_bbv),0))as total,

(sum(ifnull((turno1_pesos+turno1_vale+turno1_mn+turno2_pesos+turno2_vale+turno2_mn+turno3_pesos+turno3_vale+turno3_mn+turno4_pesos+
turno4_vale+turno4_mn),0))-
sum(ifnull(corregido,0)))as tot_sin_recarga,

sum(ifnull(corregido,0))as recarga,

e.prome,

ifnull((SELECT sum(x.importe)
FROM vtadc.gasto x where x.aaa=$aaa and x.mes=b.mes and x.auxi =4004 and x.suc=a.suc
group by aaa,mes,suc),0)as luz,
ifnull((SELECT sum(x.importe)
FROM vtadc.gasto x where x.aaa=$aaa and x.mes=b.mes and x.auxi =4005 and x.suc=a.suc
group by aaa,mes,suc),0)as agua,
ifnull((SELECT sum(x.importe)
FROM vtadc.gasto x where x.aaa=$aaa and x.mes=b.mes and x.auxi =4008 and x.suc=a.suc
group by aaa,mes,suc),0)as tel,
ifnull((SELECT sum(x.importe)
FROM vtadc.gasto x where x.aaa=$aaa and x.mes=b.mes and x.auxi not in(1,4004,4005,4008) and x.suc=a.suc
group by aaa,mes,suc),0)as varios,

ifnull((SELECT trim(bb.completo)
FROM compras.usuarios aa
join catalogo.cat_empleado bb on bb.nomina=aa.nomina
where aa.nivel=13 and bb.tipo=1 and aa.id_plaza=a.superv group by aa.id_plaza),'SIN SUPERVISOR')as supervx

from catalogo.sucursal a
left join catalogo.dia_mes b on b.mes=$mes
left join desarrollo.cortes_c c on c.suc=a.suc and month(fechacorte)=b.mes and day(fechacorte)=b.dia
left join desarrollo.cortes_d d on d.id_cc=c.id and clave1=20
join cortes_resp.cortes_venta_diaria_mes e on e.suc=a.suc and e.mes=$mes
where
tlid=1 and tipo3<>' ' and b.mes=$mes and a.regional=$id_plaza
group by suc
order by a.superv,a.tipo3,a.suc,b.dia
";
$qf=$this->db->query($sf);
foreach($qf->result() as $r)
{
    $a[$r->superv]['superv']=$r->superv;
    $a[$r->superv]['supervx']=$r->supervx;
    $a[$r->superv]['mes']=$r->mes;
    $a[$r->superv]['d'][$r->suc]['suc']=$r->suc;
    $a[$r->superv]['d'][$r->suc]['nombre']=$r->nombre;
    $a[$r->superv]['d'][$r->suc]['tot_sin_recarga']=$r->tot_sin_recarga;
    $a[$r->superv]['d'][$r->suc]['prome']=$r->prome;
    $a[$r->superv]['d'][$r->suc]['agua']=$r->agua;
    $a[$r->superv]['d'][$r->suc]['luz']=$r->luz;
    $a[$r->superv]['d'][$r->suc]['tel']=$r->tel;
    $a[$r->superv]['d'][$r->suc]['varios']=$r->varios;
}
return $a;
 }
 
 function nivel_surtido_far($aaa,$mes)
 {
    $s="SELECT round((sum(farmacia))/count(*),2)as nivel  
    FROM oficinas.nivel_surtido  where year(fecha)=$aaa and month(fecha)=$mes";
    $q=$this->db->query($s);
    $r=$q->row();
    $nivel=$r->nivel;
    return $nivel;
 }
/////////////////////////////////////////////////////////////////////////////supervisor    
    
    
    

 public function clientes_mes()
    {
 $s="select a.num,a.mes as mesx,sum(imp)as imp
from catalogo.mes a,vtadc.vta_backoffice_credito b
where date_format(b.fecha,'%Y')=year(now()) and date_format(b.fecha,'%m')=a.num and num<=month(now()) and vtatip=71
group by date_format(b.fecha,'%Y'),date_format(b.fecha,'%m')";
 $a=$this->db->query($s);
 return $a;   
    }
  public function clientes_mes_det($num)
    {
 $s="select date_format(b.fecha,'%d')as dia,b.suc,c.nombre as sucx,fecha,lin,sum(imp)as imp
from vtadc.vta_backoffice_credito b
left join catalogo.sucursal c on c.suc=b.suc
where date_format(b.fecha,'%Y')=year(now()) and date_format(b.fecha,'%m')=$num and vtatip=71
group by b.suc,lin,fecha";
    $q=$this->db->query($s);
foreach ($q->result()as $r)
        {
        $a[$r->suc]['suc'] = $r->suc;
        $a[$r->suc]['sucx'] = $r->sucx;
        $a[$r->suc]['segundo'][$r->lin]['fecha'] = $r->fecha;
        $a[$r->suc]['segundo'][$r->lin]['lin'] = $r->lin;
        $a[$r->suc]['segundo'][$r->lin]['tercero'][$r->dia]['dia'] = $r->dia;
        $a[$r->suc]['segundo'][$r->lin]['tercero'][$r->dia]['imp'] = $r->imp;
        }
 return $a;   
    }
 
 public function clientes_mes_gral()
    {
        
 $s="select a.num,a.mes as mesx,sum(imp)as imp
from catalogo.mes a,vtadc.vta_backoffice_credito b
where date_format(b.fecha,'%Y')=year(now()) and date_format(b.fecha,'%m')=a.num and num<=month(now()) and suc=103
group by date_format(b.fecha,'%Y'),date_format(b.fecha,'%m')";
 $a=$this->db->query($s);
 return $a;   
    }
  public function clientes_mes_det_gral($num)
    {
    $suc=103;
 $s="select vtatip,d.nombre as clientex, date_format(b.fecha,'%d')as dia,b.suc,c.nombre as sucx,fecha,lin,sum(imp)as imp
from vtadc.vta_backoffice_credito b
left join catalogo.sucursal c on c.suc=b.suc
left join catalogo.cat_clientes_credito d on d.codigo=b.vtatip
where date_format(b.fecha,'%Y')=year(now()) and date_format(b.fecha,'%m')=$num and b.suc=103
group by b.suc,vtatip,fecha";
    $q=$this->db->query($s);
foreach ($q->result()as $r)
        {
        $a[$r->suc]['suc'] = $r->suc;
        $a[$r->suc]['sucx'] = $r->sucx;
        $a[$r->suc]['segundo'][$r->vtatip]['fecha'] = $r->fecha;
        $a[$r->suc]['segundo'][$r->vtatip]['vtatip'] = $r->vtatip;
        $a[$r->suc]['segundo'][$r->vtatip]['clientex'] = $r->clientex;
        $a[$r->suc]['segundo'][$r->vtatip]['tercero'][$r->dia]['dia'] = $r->dia;
        $a[$r->suc]['segundo'][$r->vtatip]['tercero'][$r->dia]['imp'] = $r->imp;
        }
 return $a;   
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function ventas_acumuladas_excel($mes, $aaa)
    {
        $sql = "SELECT DAY(FECHA_VTA)as d_num, CONCAT(DAY(FECHA_VTA),'-',substr(mes,1,10))as fecha,day(fecha_vta)as dia,
sum(case when fecha_vta>'2015-03-10' then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)as con,
sum(vta_credito)as cre,sum(vta_servicio)as ser,sum(ticket)as tic,
(select count(*) from vtadc.vta_captura_diaria_suc x where x.fecha_vta=a.fecha_vta and x.tipo3=c.tipo3)as num_suc
FROM vtadc.vta_captura_diaria a
join catalogo.mes b on b.num=month(fecha_vta)
join catalogo.sucursal c on c.suc=a.suc and tipo3='DA'
where
year(fecha_vta)=$aaa and month(fecha_vta)=$mes and day(fecha_vta)>0 and 
  fecha_vta<=subdate(date(now()),1) and activo=1
GROUP BY fecha_vta
order by fecha_vta";

        return $this->db->query($sql);
    }
function ventas_acumuladas_excel_cortes($mes, $aaa)
    {
    $fec1=$aaa.'-'.str_pad($mes,'0',STR_PAD_RIGHT).'-01';


        $sql = "select DAY(fechacorte)as d_num,b.tipo3,CONCAT(DAY(fechacorte),'-',substr(c.mes,1,10))as fechacorte,count(a.suc)as num_suc,
(select count(*) from catalogo.sucursal x where x.tlid=1 and dia<>'cer'and x.tipo3=b.tipo3)as hab,
sum(turno1_pesos+turno2_pesos+turno3_pesos+turno4_pesos+turno1_mn+turno2_mn+turno3_mn+turno4_mn)as pesos,
sum(turno1_san+turno2_san+turno3_san+turno4_san+turno1_bbv+turno2_bbv+turno3_bbv+turno4_bbv)as tar,
sum(turno1_vale+turno2_vale+turno3_vale+turno4_vale)as val,
sum(turno1_fal+turno2_fal+turno3_fal+turno4_fal)as fal,
sum(turno1_sob+turno2_sob+turno3_sob+turno4_sob)as sob,
(select sum(corregido) from
desarrollo.cortes_c x
join desarrollo.cortes_d y on y.id_cc=x.id  and y.clave1 in(40,30)
join catalogo.sucursal z on z.suc=x.suc
where tlid=1 and fecha_act='0000-00-00' and z.tipo3=b.tipo3 and fechacorte=a.fechacorte)as credito,

(select sum(corregido) from
desarrollo.cortes_c x
join desarrollo.cortes_d y on y.id_cc=x.id  and y.clave1 in(20)
join catalogo.sucursal z on z.suc=x.suc
where tlid=1 and fecha_act='0000-00-00' and z.tipo3=b.tipo3 and fechacorte=a.fechacorte)as recarga


from desarrollo.cortes_c a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=month(fechacorte)
where fechacorte between '$fec1' and subdate(date(now()),1)and tipo3='DA'
group by tipo3,a.fechacorte
order by a.fechacorte";

        return $this->db->query($sql);
    }
    
    
    function ventas_correo($qq)
{
$up="update cortes_resp.cortes_venta_diaria a, desarrollo.cortes_c b
set cortes_banco15=(turno1_pesos+turno2_pesos+turno1_mn+turno1_sob-turno1_fal)
 where a.suc=b.suc and a.dia=day(fechacorte) and a.mes=month(fechacorte) and  year(b.fechacorte)=year((now()))";
 $this->db->query($up);
$sa="SELECT a.fecha_vta,b.tipo2,b.tipo3,case when b.tipo3='FE'then 'FENIX' when b.tipo3='DA'then 'DOCTOR.AHORRO' when b.tipo3='FA'then 'FARMABODEGA' else '' end as imagen,DAYOFWEEK(a.fecha_vta),
sum(ticket)as tic, 
sum(vta_servicio)as vta_servicio,
sum(case when fecha_vta>'2015-03-10' 
then (vta_contado+val+tar+con_usd+fal-vta_servicio) else vta_contado end)as vta_contado,
sum(vta_credito)as vta_credito,

sum(vta_credito+vta_contado+val+tar+con_usd+fal-sob)as vta_total,
sum(vta_credito+vta_contado+val+tar+con_usd+fal-sob)/sum(ticket)as prome,


case
when DAYOFWEEK(a.fecha_vta)=1 then 'DOMINGO'
when DAYOFWEEK(a.fecha_vta)=2 then 'LUNES'
when DAYOFWEEK(a.fecha_vta)=3 then 'MARTES'
when DAYOFWEEK(a.fecha_vta)=4 then 'MIERCOLES'
when DAYOFWEEK(a.fecha_vta)=5 then 'JUEVES'
when DAYOFWEEK(a.fecha_vta)=6 then 'VIERNES'
when DAYOFWEEK(a.fecha_vta)=7 then 'SABADO'
else ' ' end as nom_dia,
(select count(*) from vtadc.vta_captura_diaria_suc c
where c.fecha_vta=a.fecha_vta and c.tipo3=b.tipo3 group by c.fecha_vta, c.tipo3) as suc_cap,

(select count(*) from catalogo.sucursal m where m.tipo3=b.tipo3 and dia<>'CER' and tlid=1)as num_suc,
(select count(*) from catalogo.sucursal where tipo3 in ('FA','DA','FE') and dia<>'CER' and tlid=1)as num_suc_total
FROM vtadc.vta_captura_diaria a
left join catalogo.sucursal b on b.suc=a.suc

where a.fecha_vta>=subdate(date(now()),3) and a.fecha_vta < date(now()) and a.activo=1 and b.tipo3 in('FA','FE','DA')
group by DAYOFWEEK(a.fecha_vta),b.tipo3
order by a.fecha_vta desc,b.tipo3

";
$q=$this->db->query($sa);
$lidia='';
   
 foreach ($q->result()as $r)
        {
        $a[$r->fecha_vta]['fecha_vta'] = $r->fecha_vta;
        $a[$r->fecha_vta]['nom_dia'] = $r->nom_dia;
        $a[$r->fecha_vta]['num_suc_total'] = $r->num_suc_total;
        $a[$r->fecha_vta]['d'][$r->imagen]['imagen'] = $r->imagen;
        $a[$r->fecha_vta]['d'][$r->imagen]['tipo3'] = $r->tipo3;
        $a[$r->fecha_vta]['d'][$r->imagen]['tic'] = $r->tic;
        $a[$r->fecha_vta]['d'][$r->imagen]['vta_credito'] = $r->vta_credito;
        $a[$r->fecha_vta]['d'][$r->imagen]['vta_contado'] = $r->vta_contado;
        $a[$r->fecha_vta]['d'][$r->imagen]['vta_servicio'] = $r->vta_servicio;
        $a[$r->fecha_vta]['d'][$r->imagen]['vta_total'] = $r->vta_total;
        $a[$r->fecha_vta]['d'][$r->imagen]['prome'] = $r->prome;
        $a[$r->fecha_vta]['d'][$r->imagen]['suc_cap'] = $r->suc_cap;
        $a[$r->fecha_vta]['d'][$r->imagen]['num_suc'] = $r->num_suc;
        }
 $tic=0;$contado=0;$vta_total=0;$credito=0;$servicio=0;$suc_cap=0;
 $ttic=0;$tcontado=0;$tvta_total=0;$tcredito=0;$tservicio=0;$tsuc_cap=0;
 $num=0;
 $lidia.="<table border='1' celpadding='2'>
 <thead>
 <title>Prueba de correo</title> 
 </thead>
 <tbody>
 ";
 foreach ($a as $r0) {
$lidia.="
<tr>
<td colspan=\"8\" style=\"color: red; text-align: left\">SUC.ACTIVAS ".$r0['num_suc_total']."</td>

</tr>
<tr>
<th style=\"color: blue; text-align: center\">".$r0['fecha_vta']."</th>
<th style=\"color: blue; text-align: right\">Sucursal</th>
<th style=\"color: blue; text-align: right\">Ticket</th>
<th style=\"color: blue; text-align: right\">Vta Contado</th>
<th style=\"color: blue; text-align: right\">Vta Credito</th>
<th style=\"color: blue; text-align: right\">Vta Servicio</th>
<th style=\"color: blue; text-align: right\">Vta Total</th>
<th style=\"color: blue; text-align: right\">Prom.por Ticket</th>
</tr>";
foreach ($r0['d'] as $r) {

$lidia.="
<tr>
                                
<td style=\"color: blue; text-align: left\">".$r['imagen']."</td>
<td style=\"color: gray;text-align: right;\">".$r['num_suc']."/".number_format($r['suc_cap'],0)."</td>
<td style=\"color: gray;text-align: right;\">".number_format($r['tic'],0)."</td>
<td style=\"color: gray;text-align: right;\">".number_format($r['vta_contado'],2)."</td>
<td style=\"color: gray;text-align: right;\">".number_format($r['vta_credito'],2)."</td>
<td style=\"color: gray;text-align: right;\">".number_format($r['vta_servicio'],2)."</td>
<td style=\"color: gray;text-align: right;\">".number_format($r['vta_total'],2)."</td>
<td style=\"color: gray;text-align: right;\">".number_format($r['prome'],4)."</td>
</tr>";
$tic=$tic+$r['tic']; 
$contado=$contado+$r['vta_contado'];
$credito=$credito+$r['vta_credito'];
$vta_total=$vta_total+$r['vta_total'];
$servicio=$servicio+$r['vta_servicio'];
$suc_cap=$suc_cap+$r['suc_cap'];
$ttic=$ttic+$r['tic']; 
$tcontado=$tcontado+$r['vta_contado'];
$tcredito=$tcredito+$r['vta_credito'];
$tvta_total=$tvta_total+$r['vta_total'];
$tservicio=$tservicio+$r['vta_servicio'];
$tsuc_cap=$tsuc_cap+$r['suc_cap'];
}
$lidia.="
<tr>
<td style=\"text-align: left\"><strong> TOTAL ".$r0['nom_dia']."</strong></td>
<td style=\"text-align: right;\"><strong>".number_format($suc_cap,0)."</strong></td>
<td style=\"text-align: right;\"><strong>".number_format($tic,0)."</strong></td>                                  
<td style=\"text-align: right;\"><strong>".number_format($contado,2)."</strong></td>
<td style=\"text-align: right;\"><strong>".number_format($credito,2)."</strong></td>
<td style=\"text-align: right;\"><strong>".number_format($servicio,2)."</strong></td>
<td style=\"text-align: right;\"><strong>".number_format($vta_total,2)."</strong></td>
<td></td>
</tr>";
$tic=0;$contado=0;$vta_total=0;$credito=0;$servicio=0;$suc_cap=0;}
$lidia.="
</tbody>
</table>";
return $lidia;   
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function venta_capturada_secretaria()
{
$s="SELECT year(fecha_vta)as aaa,month(fecha_vta)as mes,c.mes as mesx,sum(vta_contado+vta_credito)as venta
FROM vtadc.vta_captura_diaria a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=month(fecha_vta)
where activo=1 and year(fecha_vta)=year(now())
group by date_format(fecha_vta,'%Y-%m')";
$q=$this->db->query($s);
return $q;    
}
function venta_capturada_secretaria_det($aaa,$mes)
{
$s="SELECT fecha_vta, year(fecha_vta)as aaa,month(fecha_vta)as mes,c.mes as mesx,sum(vta_contado+vta_credito)as venta
FROM vtadc.vta_captura_diaria a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=month(fecha_vta)
where activo=1 and year(fecha_vta)=$aaa and  month(fecha_vta)=$mes and (vta_contado+vta_credito)>0 
group by fecha_vta";
$q=$this->db->query($s);
return $q;    
}
function venta_capturada_secretaria_dia($fecha)
{
$s="SELECT a.suc,a.nombre, 0 as venta
FROM catalogo.sucursal a
left join vtadc.vta_captura_diaria b on a.suc=b.suc and activo=1 and fecha_vta='$fecha' and (vta_contado+vta_credito)>0
where dia<>'CER' and tlid=1 and tipo3 in('DA','FE','FA','MO')
and b.suc is null
group by suc

union all
SELECT a.suc,b.nombre,sum(vta_contado+vta_credito)as venta
FROM vtadc.vta_captura_diaria a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=month(fecha_vta)
where activo=1 and fecha_vta='$fecha' and (vta_contado+vta_credito)>0
group by a.suc";
$q=$this->db->query($s);
return $q;    
}
function depositos()
{
$s="select year(date(now()))as aaa, mm.num as mes,mm.mes as mesx,

(select sum(vta_contado+vta_servicio) from vtadc.vta_captura_diaria a
join catalogo.sucursal b on b.suc=a.suc and tipo3='DA'
where year(fecha_vta)=year(date(now())) and month(fecha_vta)=mm.num and day(fecha_vta)>0
and a.activo=1
group by year(fecha_vta) and month(fecha_vta)) as vta_suc,


(select sum(importe) from vtadc.vta_captura_diaria_deposito_suc a
join catalogo.sucursal b on b.suc=a.suc and tipo3='DA'
where year(fecha_ficha)=year(date(now())) and month(fecha_ficha)=mm.num and day(fecha_ficha)>0
group by year(fecha_ficha) and month(fecha_ficha)) as depo_suc,

(select sum(reembolso) from vtadc.vta_captura_diaria_deposito_suc a
join catalogo.sucursal b on b.suc=a.suc and tipo3='DA'
where year(fecha_ficha)=year(date(now())) and month(fecha_ficha)=mm.num and day(fecha_ficha)>0
group by year(fecha_ficha) and month(fecha_ficha)) as reem,

(select sum(importe) from vtadc.banco_deposito_venta_suc a
join catalogo.sucursal b on b.suc=a.suc and tipo3='DA'
where year(fecha)=year(date(now())) and month(fecha)=mm.num and day(fecha)>0
group by year(fecha) and month(fecha)) as depo_banco

From catalogo.mes mm";
$q=$this->db->query($s);
return $q;    
}
function depositos_det($aaa,$mes)
{
$s="SELECT a.fecha_vta, year(fecha_vta)as aaa, month(a.fecha_vta)as mes,
sum(vta_contado+vta_servicio)as vta_suc,
sum(c.importe)as depo_suc,
sum(c.reembolso)as reem,
ifnull(sum(d.importe),0)as depo_banco

FROM vtadc.vta_captura_diaria_venta a
join catalogo.sucursal b on b.suc=a.suc
left join vtadc.vta_captura_diaria_deposito_suc c on c.suc=a.suc and c.fecha_ficha=a.fecha_vta
left join vtadc.banco_deposito_venta_suc d on d.suc=a.suc and d.fecha=a.fecha_vta
where year(fecha_vta)=$aaa and month(a.fecha_vta)=$mes and day(a.fecha_vta)>0 and b.tipo3='DA'
group  by fecha_vta";
$q=$this->db->query($s);
return $q;    
}
function depositos_dia($fecha)
{
$s="SELECT b.suc,b.nombre,a.fecha_vta, year(fecha_vta)as aaa, month(a.fecha_vta)as mes,
(vta_contado+vta_servicio)as vta_suc,
(c.importe)as depo_suc,
(c.reembolso)as reem,
ifnull((d.importe),0)as depo_banco

FROM vtadc.vta_captura_diaria_venta a
join catalogo.sucursal b on b.suc=a.suc
left join vtadc.vta_captura_diaria_deposito_suc c on c.suc=a.suc and c.fecha_ficha=a.fecha_vta
left join vtadc.banco_deposito_venta_suc d on d.suc=a.suc and d.fecha=a.fecha_vta
where fecha_vta='$fecha' and b.tipo3='DA'
";
$q=$this->db->query($s);
return $q;    
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
 function topedia($mes)
 {
 if($mes==date('m')){$tope=date('d')-1;}else{
$s="select *from catalogo.mes where num=$mes";
$q=$this->db->query($s);
$r=$q->row();    
 $tope=$r->dos;
 }
 return $tope;   
 }
 
 function reporte_tickets($mes, $aaa)
    {

        $s="SELECT t.*, b.nombre FROM vtadc.tickets t 
        left join catalogo.sucursal b on t.suc=b.suc
        where t.anio=$aaa and t.mes=$mes";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
        return $q;        
        }

    function reporte_tickets1($mes, $aaa)
    {

        $s="SELECT t.suc, estado_int, e.estado, sum(tickets) as tickets, sum(importeTotal) as total
            FROM vtadc.tickets t
            left join catalogo.sucursal s using(suc)
            left join aguascalientes.estados e on s.estado = e.estado_int
            where anio = $aaa and mes = $mes
            group by estado";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
        return $q;        
        }
        
    function reporte_tickets2($suc, $mes, $aaa)
    {

        $s="SELECT a.fecha, a.suc, b.nombre, count(*) as tickets, sum(a.importe) as importe
            FROM vtadc.venta_detalle a
            left join catalogo.sucursal b using(suc)
            WHERE year(a.fecha)=$aaa and month(a.fecha)=$mes and a.suc=$suc
            group by a.fecha;";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
        return $q;        
        }
     
     function reporte_tarjetas($mes, $aaa)
    {

        $s="SELECT a.suc, b.nombre, sum(can) as cantidad
            FROM vtadc.venta_detalle a
            left join catalogo.sucursal b on a.suc=b.suc
            where codigo=4423174088000 and month(fecha)=$mes and year(fecha)=$aaa 
            group by suc";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
        return $q;        
}    

    function reporte_tarjetas_empleado($suc, $mes, $aaa)
    {

        $s="SELECT a.suc, c.nombre, a.nomina, b.completo, b.puestox, sum(can) as cantidad
            FROM vtadc.venta_detalle a
            left join catalogo.cat_empleado b on a.nomina=b.nomina
            left join catalogo.sucursal c on a.suc=c.suc
            where codigo=4423174088000 and month(fecha)=$mes and year(fecha)=$aaa and a.suc=$suc and b.tipo=1 and b.puestox <> 'MEDICO'
            group by nomina";
        $q = $this->db->query($s);
        echo $this->db->last_query();
        echo die;
        return $q;        
    }   
    
    function reporte_tarjetas_empleado1($nomina, $suc, $mes, $aaa)
    {
        $s="SELECT a.suc, c.nombre, a.nomina, b.completo, a.fecha, a.tiket, can as cantidad
            FROM vtadc.venta_detalle a
            left join catalogo.cat_empleado b on a.nomina=b.nomina
            left join catalogo.sucursal c on a.suc=c.suc
            where codigo=4423174088000 and month(fecha)=$mes and year(fecha)=$aaa and a.suc=$suc and b.tipo=1 and a.nomina=$nomina"; 
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //echo die;
        return $q;        
    }
    
    function venta_detalle($fecha1, $fecha2, $suc)
    {
        $sql = "SELECT v.*, b.*, a.sec FROM vtadc.vta_backoffice v 
                left join vtadc.back_cli_cre b using(vtatip)
                left join catalogo.almacen a on v.cod=a.codigo 
                where suc = ? and fecha between ? and ?;";
        $query = $this->db->query($sql, array($suc, $fecha1, $fecha2));
        //echo $this->db->last_query();
        //echo die;
        
        return $query;
    }
    
    function venta_backoffice_sucursales()
    {
        $sql = "SELECT suc, nombre FROM catalogo.sucursal s where back = 1 and tlid=1;";
        $query = $this->db->query($sql);
        
        $a = array();
        foreach($query->result() as $row)
        {
            $a[$row->suc] = $row->suc .  ' - ' . $row->nombre;
        }
        
        return $a;
    }
    
    
////////////////////////////////////////////////////////////yucif//////////////////////////////////////////////////////////////////    
    
    function venta_detalle1($fecha1, $fecha2, $suc)
    {
        $sql = "SELECT suc, fecha, tiket, sec, codigo, descri, can, importe, iva, lin, sublin, c.descrip
                FROM vtadc.venta_detalle b
                left join catalogo.almacen a using(codigo)
                left join catalogo.cat_sublin c on a.lin=c.codlin and a.sublin=c.codslin
                where suc = ? and fecha between ? and ?";
        $query = $this->db->query($sql, array($suc, $fecha1, $fecha2));
        //echo $this->db->last_query();
        //die();
        
        return $query;
    }
    
    function venta_yucif_sucursales()
    {
        $sql = "SELECT suc, nombre FROM catalogo.sucursal s where back <> 1 and suc>100 and suc<2200 and tlid=1;";
        $query = $this->db->query($sql);
        
        $a = array();
        foreach($query->result() as $row)
        {
            $a[$row->suc] = $row->suc .  ' - ' . $row->nombre;
        }
        
        return $a;
    }
    
//////////////////////////////////////////////////////////////////////////////todas//////////////////////////////////////////////////////
    
    function venta_detalle_2011($mes, $suc)
    {
        $sql = "SELECT suc, aaa, case when a.sec is null then 0 else a.sec end as sec, codigo, descripcion, venta$mes as can, p.lin, p.sublin, b.descrip, importe$mes as importe
                FROM vtadc.producto_mes_suc11 p
                LEFT JOIN catalogo.almacen a using(codigo)
                left join catalogo.cat_sublin b on p.lin=b.codlin and p.sublin=b.codslin
                WHERE suc=$suc and venta$mes>0";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        
        return $query;
    }
    
    function venta_detalle_2012($mes, $suc)
    {
        $sql = "SELECT suc, aaa, case when a.sec is null then 0 else a.sec end as sec, codigo, descripcion, venta$mes as can, p.lin, p.sublin, b.descrip, importe$mes as importe
                FROM vtadc.producto_mes_suc12 p
                LEFT JOIN catalogo.almacen a using(codigo)
                left join catalogo.cat_sublin b on p.lin=b.codlin and p.sublin=b.codslin
                WHERE suc=$suc and venta$mes>0";
        $query = $this->db->query($sql);
        echo $this->db->last_query();
        die();
        
        return $query;
    }
    
    function venta_detalle_2013($mes, $suc)
    {
        $sql = "SELECT suc, aaa, case when a.sec is null then 0 else a.sec end as sec, codigo, descripcion, venta$mes as can, p.lin, p.sublin, b.descrip, importe$mes as importe
                FROM vtadc.producto_mes_suc13 p
                LEFT JOIN catalogo.almacen a using(codigo)
                left join catalogo.cat_sublin b on p.lin=b.codlin and p.sublin=b.codslin
                WHERE suc=$suc and venta$mes>0";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //die();
        
        return $query;
    }
    
    function ventas_tcp_mes_excel($mesx, $aaax)
    {
        $sql = "SELECT a.suc, c.nombre, a.nomina, b.completo, case b.tipo when 1 then ' ' when 2 then 'BAJA' end as estatus,
sum(can) as cantidad, sum(can) * 10 as comision, b.puestox
FROM vtadc.venta_detalle a
left join catalogo.cat_empleado b on a.nomina=b.nomina
left join catalogo.sucursal c on a.suc=c.suc
where codigo=4423174088000 and month(fecha)=? and year(fecha)=? and b.puestox <> 'MEDICO' 
group by nomina order by suc, cantidad, b.tipo";

        return $this->db->query($sql, array($mesx, $aaax));
        //echo $this->db->last_query();
        //die();
    }
    
    
  function des_diario()
 {
 $s="select fecha,sec,susa1,sum(can)as venta, weekday(fecha)as dia  From vtadc.venta_detalle a
join catalogo.almacen b on
b.codigo=a.codigo and sec>0 and sec<=1999 or
b.codigo=a.codigo and sec in(3102,3074,3071)
join catalogo.sucursal c on c.suc=a.suc and tipo3='DA'
where fecha>=case
when weekday(date(now()))=0 then subdate(date(now()),7)
when weekday(date(now()))=1 then subdate(date(now()),1)
when weekday(date(now()))=2 then subdate(date(now()),2)
when weekday(date(now()))=3 then subdate(date(now()),3)
when weekday(date(now()))=4 then subdate(date(now()),4)
when weekday(date(now()))=5 then subdate(date(now()),5)
when weekday(date(now()))=6 then subdate(date(now()),6) end
group by fecha,sec";
 $q=$this->db->query($s);
 foreach ($q->result()as $r)
        {
        $a[$r->sec]['sec'] = $r->sec;
        $a[$r->sec]['susa1'] = $r->susa1;
        $a[$r->sec]['m'][$r->dia]['dia'] = $r->dia;
        $a[$r->sec]['m'][$r->dia]['fecha'] = $r->fecha;
        $a[$r->sec]['m'][$r->dia]['dia'] = $r->dia;
        $a[$r->sec]['m'][$r->dia]['venta'] = $r->venta;
        }
        
     return $a;  
 }  
function des_diario_sem($fec1,$fec2)
 {
 $s="select fecha,sec,susa1,sum(can)as venta, weekday(fecha)as dia  From vtadc.venta_detalle a
join catalogo.almacen b on
b.codigo=a.codigo and sec>0 and sec<=1999 or
b.codigo=a.codigo and sec in(3102,3074,3071)
join catalogo.sucursal c on c.suc=a.suc and tipo3='DA'
where fecha between '$fec1' and '$fec2'
group by fecha,sec";
 $q=$this->db->query($s);
 foreach ($q->result()as $r)
        {
        $a[$r->sec]['sec'] = $r->sec;
        $a[$r->sec]['susa1'] = $r->susa1;
        $a[$r->sec]['m'][$r->dia]['dia'] = $r->dia;
        $a[$r->sec]['m'][$r->dia]['fecha'] = $r->fecha;
        $a[$r->sec]['m'][$r->dia]['dia'] = $r->dia;
        $a[$r->sec]['m'][$r->dia]['venta'] = $r->venta;
        }
        
     return $a;  
 }    
  function ven_mensual_x()
 {
 $s="SELECT  CONCAT(DAY(FECHA_VTA),' ',substr(mes,1,3))as fecha,
sum(vta_contado)as contado,sum(vta_credito)as credito,sum(vta_servicio)as servicio,sum(ticket)as tiket
FROM vtadc.vta_captura_diaria a
join catalogo.mes b on b.num=month(fecha_vta)
where
year(fecha_vta)=year(date(now())) and month(fecha_vta)=2 and day(fecha_vta)>0 and activo=1
GROUP BY fecha_vta
order by sec";
 $q=$this->db->query($s);
 foreach ($q->result()as $r)
        {
        $a[$r->sec]['sec'] = $r->sec;
        $a[$r->sec]['susa1'] = $r->susa1;
        $a[$r->sec]['m'][$r->fecha]['fecha'] = $r->fecha;
        $a[$r->sec]['m'][$r->fecha]['dia'] = $r->dia;
        $a[$r->sec]['m'][$r->fecha]['venta'] = $r->venta;
        }
        
     return $a;  
 }   
 
 function consilia_ficha()
 {
 $s1="update cortes_resp.cortes_venta_diaria a, desarrollo.cortes_c b
set cortes_banco15=(turno1_pesos+turno2_pesos+turno1_mn+turno1_sob-turno1_fal)
 where a.suc=b.suc and a.dia=day(fechacorte) and a.mes=month(fechacorte) and   year(b.fechacorte)=year((now()))
";
 $this->db->query($s1);   
 $s2="update
vtadc.banco_deposito_venta a,  vtadc.vta_captura_diaria_deposito b, cortes_resp.cortes_venta_diaria c
set
c.banco_cuenta15=a.importe,fecha15=a.fecha,ref15=a.ref2,
a.fecha_venta=concat('2015-',c.mes,'-',c.dia),a.esta='S'
where
a.suc=b.suc and ref2=referencia and a.importe=b.importe and b.activo=1 and fecha=b.fecha_ficha and
a.suc=c.suc and day(b.fecha_venta)=c.dia  and month(b.fecha_venta)=c.mes
and b.fecha_venta<>'0000-00-00'  and year(fecha)=2015 and esta='N'";
 $this->db->query($s2);   
 $s3="update
cortes_resp.cortes_venta_diaria a, vtadc.banco_deposito_venta b
set
a.banco_cuenta15=b.importe,a.fecha15=b.fecha,ref15=b.ref2,b.esta='S',
b.fecha_venta=concat('2015-',a.mes,'-',a.dia)
where a.mes=3  and  a.suc=b.suc and cortes_banco15=b.importe and esta='N'
";
 $this->db->query($s3);   
 $s4="update
cortes_resp.cortes_venta_diaria a,vtadc.banco_deposito_venta b
set
a.banco_cuenta15=b.importe, b.esta='S',b.fecha_venta=concat('2015-',a.mes,'-',a.dia),
a.ref15=b.ref2, a.fecha15=b.fecha

where a.mes=3 and b.suc=a.suc
and esta='N' and ref15=' ' and a.dia<30 and a.dia=day(subdate(b.fecha,1)) and (importe-cortes_banco15)>-1
 and (importe-cortes_banco15)<2";
 $this->db->query($s4);   
 $s5="update
cortes_resp.cortes_venta_diaria a,vtadc.banco_deposito_venta b
set
a.banco_cuenta15=b.importe, b.esta='S',b.fecha_venta=concat('2015-',a.mes,'-',a.dia),
a.ref15=b.ref2, a.fecha15=b.fecha,obs=concat('DEPOSITO A',b.suc,'ref ',ref2)

where a.mes=3
and esta='N' and ref15=' ' and a.dia<30 and (importe-cortes_banco15)>-2
and day(b.fecha)>a.dia
and cortes_banco15 > 0 and (importe-cortes_banco15)<1 and a.suc>=2000";
 $this->db->query($s5);   
    
$s="update vtadc.banco_deposito_venta a,
 cortes_resp.cortes_venta_diaria b,
vtadc.vta_captura_diaria_deposito_suc c
set
b.banco_cuenta15=a.importe, a.esta='S',a.fecha_venta=concat('2015-',b.mes,'-',b.dia),
b.ref15=a.ref2, b.fecha15=a.fecha,obs=concat('DEPOSITO A',a.suc,'ref ',ref2)
 where
a.suc=b.suc and
ref15=' ' and
esta='N' and
cortes_banco15>0 and
a.suc=c.suc and a.ref2=c.referencia and a.fecha=c.fecha_ficha and
a.fecha>='2015-03-01' and b.mes=3 and  day(a.fecha)>b.dia and
(cortes_banco15-a.importe)>=-30 and (cortes_banco15-a.importe)<=30
";
$this->db->query($s);
$s="update  vtadc.banco_deposito_venta a,
 cortes_resp.cortes_venta_diaria b,
vtadc.vta_captura_diaria_deposito_suc c
set
b.banco_cuenta15=a.importe, a.esta='S',a.fecha_venta=concat('2015-',b.mes,'-',b.dia),
b.ref15=a.ref2, b.fecha15=a.fecha,obs=concat('DEPOSITO A',a.suc,'ref ',ref2)
 where
a.suc=b.suc and
ref15=' ' and
esta='N' and
cortes_banco15>0 and
a.suc=c.suc and a.ref2=c.referencia and a.fecha=c.fecha_ficha and
a.fecha>='2015-03-01' and b.mes=3 and  day(a.fecha)>b.dia and day(subdate(a.fecha,3))<b.dia";
 $this->db->query($s);
//$s="";
// $this->db->query($s);
//$s="";
// $this->db->query($s);   
 }
 
 function ventas_tipo()
    {
        $sql = "SELECT * FROM catalogo.cat_imagen c where id between 4 and 7;";
        $query = $this->db->query($sql);
        
        $a = array();
        foreach($query->result() as $row)
        {
            $a[$row->tipo] = $row->nombre;
        }
        
        return $a;
    }
    
 function ventas_tipo_excel($fecha, $fecha2, $tipo)
    {
        $sql = "SELECT v.suc, s.nombre, a.sec, v.codigo, v.descri, a.susa1, prvx, sum(v.can) as can, a.costo, v.vta, sum(v.importe) as importe
        FROM vtadc.venta_detalle v
        join catalogo.sucursal s using(suc)
        join catalogo.almacen a using(codigo)
        where fecha between ? and ? and tipo3 = ?
        group by suc, codigo
        order by suc, sec;";
        $query = $this->db->query($sql, array($fecha, $fecha2, $tipo));
        //echo $this->db->last_query();
        //die();
        
        return $query;
    }   

    
    
    
    
    
}
