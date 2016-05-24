<?php
class Contabilidad_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }



function depositos($aaa,$tipo)
{
    $s="SELECT tipo3,
a.aaa, a.mes,c.mes as mesx, count(*)as num_suc, sum(pesos)as pesos, sum(mn)as mn, sum(vales)as vales, sum(bbv)as bbv, sum(san)as san, sum(exp)as exp, sum(total)as total, sum(faltante)as faltante, sum(sobrante)as sobrante
FROM desarrollo.cortes_c_deposito a
join catalogo.sucursal b on b.suc=a.suc
join catalogo.mes c on c.num=a.mes
where a.aaa=$aaa and a.mes>0 and tipo3='$tipo'
group by a.aaa,a.mes
";
    $q=$this->db->query($s);
    return $q;
    }
 function graficaAnio_deposito($aaa,$tipo,$nombre)
    {
        $this->load->model('grafica');
        $this->load->library('data');
        
        $a = new Data();
        
        $query = $this->depositos($aaa,$tipo);
        
        foreach($query->result() as $row)
        {
            $a->agregaData($row->mesx, $row->total);
        }
        
        
        $fuente = $this->grafica->fuente('DEPOSITOS ', utf8_encode('Año 2015'), 'Meses', '$ Pesos', 1, 1, $a->retornaData());
        $json = $this->grafica->chart('line', $nombre, '1100', '300', $fuente);
        
        return $json;
    }   

function depositos_tipo($aaa,$mes,$tipo)
    {
    $s="SELECT tipo3,
a.suc, b.nombre, sum(dias)as dias_suc, sum(pesos)as pesos, sum(mn)as mn, sum(vales)as vales, sum(bbv)as bbv, sum(san)as san, sum(exp)as exp, sum(total)as total, sum(faltante)as faltante, sum(sobrante)as sobrante
FROM desarrollo.cortes_c_deposito a
join catalogo.sucursal b on b.suc=a.suc
where a.aaa=$aaa and a.mes=$mes and tipo3='$tipo'
group by a.suc";
    $q=$this->db->query($s);
    return $q;
    }

function depositos_tipo_suc($aaa,$mes,$tipo)
    {
    $s="SELECT a.suc,a.cia,b.nombre as sucx,date_format(fechacorte,'%m')as mes,date_format(fechacorte,'%Y')as aaa,
sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos)as pesos,
sum(a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn)as mn,
sum(a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale)as vales,
sum(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv)as bbv,
sum(a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san)as san,
sum(a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as exp,

sum(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos+a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn+
a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale+a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv+
a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san+a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as total,

sum(a.turno1_fal+a.turno2_fal+a.turno3_fal+a.turno4_fal)as faltante,
sum(a.turno1_sob+a.turno2_sob+a.turno3_sob+a.turno4_sob)as sobrante,

(select sum(corregido) from desarrollo.cortes_c m
left join desarrollo.cortes_d mm on mm.id_cc=m.id

where mm.clave1 in(30,40) and date_format(m.fechacorte,'%Y-%m')=date_format(a.fechacorte,'%Y-%m') and m.tsuc=a.tsuc and m.suc=a.suc
group by date_format(m.fechacorte,'%Y-%m'),m.tsuc,m.suc)as credito 

fROM desarrollo.cortes_c a
left join catalogo.sucursal b on b.suc=a.suc
where date_format(fechacorte,'%Y')>='$aaa' and date_format(fechacorte,'%m')=$mes and a.tsuc='$tipo' and a.suc>100
group by a.suc
order by a.suc";
    $q=$this->db->query($s);
    return $q;
    }
function depositos_tipo_suc_dia($aaa,$mes,$suc)
    {
    $s="SELECT a.tsuc,a.fechacorte,a.cia,a.suc,a.cia,b.nombre as sucx,date_format(fechacorte,'%m')as mes,date_format(fechacorte,'%Y')as aaa,
(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos)as pesos,
(a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn)as mn,
(a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale)as vales,
(a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv)as bbv,
(a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san)as san,
(a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as exp,

(a.turno1_pesos+a.turno2_pesos+a.turno3_pesos+a.turno4_pesos+a.turno1_mn+a.turno2_mn+a.turno3_mn+a.turno4_mn+
a.turno1_vale+a.turno2_vale+a.turno3_vale+a.turno4_vale+a.turno1_bbv+a.turno2_bbv+a.turno3_bbv+a.turno4_bbv+
a.turno1_san+a.turno2_san+a.turno3_san+a.turno4_san+a.turno1_exp+a.turno2_exp+a.turno3_exp+a.turno4_exp)as total,

(a.turno1_fal+a.turno2_fal+a.turno3_fal+a.turno4_fal)as faltante,
(a.turno1_sob+a.turno2_sob+a.turno3_sob+a.turno4_sob)as sobrante,

(select sum(corregido) from desarrollo.cortes_c m
left join desarrollo.cortes_d mm on mm.id_cc=m.id

where mm.clave1 in(30,40) and m.fechacorte=a.fechacorte and m.suc=a.suc
group by m.fechacorte)as credito 


fROM desarrollo.cortes_c a
left join catalogo.sucursal b on b.suc=a.suc
where date_format(fechacorte,'%Y')>='$aaa' and date_format(fechacorte,'%m')=$mes  and a.suc=$suc
order by a.fechacorte";
    $q=$this->db->query($s);
    return $q;
    }




}