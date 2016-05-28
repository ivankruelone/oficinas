<?php
class Catalogos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    public function orden_hiss()
    {
        $s = "SELECT * FROM borrar.orden ";
        $q = $this->db->query($s);
        return $q;
    }
    public function orden_hiss1()
    {
        $s = "SELECT * FROM borrar.orden where cia=1 ";
        $q = $this->db->query($s);
        return $q;
    }
    public function cedis()
    {
        $s = "select a.sec,tsec,b.tipo,descon,codigo,susa1,susa2,prv,prvx,costo,publico,sim,vtagen,vtaddr,a.lin,sublin,clabo,maxbo,vtabo,corrugado
from catalogo.almacen a
left join catalogo.cat_almacen_clasifica b on a.sec=b.sec
where 
a.sec>0 and a.sec<=2000 and tsec <>'M' or
a.sec>=3000 and a.sec<=3999 and tsec <>'M' and  b.tipo<>' '
";
        $q = $this->db->query($s);
        return $q;
    }
public function cedis_sec($sec)
    {
        $s = "select *from catalogo.cat_almacen_clasifica
where sec=$sec
";
        $q = $this->db->query($s);
        $r = $q->row();
        return $r->susa;
    }
    public function oferta_genericas()
    {
        $s = "SELECT b.vtagen,a.*
FROM compras.ofertas_genericos a
join catalogo.almacen b on b.codigo=a.codigo
and a.sec=b.sec
where b.vtagen<>a.precio_oferta
";
        $q = $this->db->query($s);
        return $q;
    }
public function genericos_fenix()
    {
        $s = "select* FROM catalogo.cat_almacen_clasifica b where val=1";
        $q = $this->db->query($s);
        return $q;
    }
    public function naturistas_genericas()
    {
        $s = "SELECT * FROM catalogo.cat_naturistas a
";
        $q = $this->db->query($s);
        return $q;
    }
    public function metro1()
    {
        $s = "SELECT SEC,CLAVES,TSEC,CODIGO,SUSA1,SUSA2,PRV,PRVX,COSTO,PUBLICO,SIM,VTAGEN,VTADDR,LIN,SUBLIN,PERSONA
FROM catalogo.almacen WHERE SEC>0 AND SEC<=2000 AND TSEC='M'";
        $q = $this->db->query($s);
        return $q;
    }
    public function metro2()
    {
        $s = "SELECT SEC,CLAVES,TSEC,CODIGO,SUSA1,SUSA2,PRV,PRVX,COSTO,PUBLICO,SIM,VTAGEN,VTADDR,LIN,SUBLIN,PERSONA
FROM catalogo.almacen WHERE SEC>5999 AND SEC<=7999 AND SUSA1<>' '";
        $q = $this->db->query($s);
        return $q;
    }


   /************************** mercadotecnia *****************************/
    public function busqueda1_encontro($var)
    {
        $s = "select labprv,rel1,rel2,codigo,descripcion,lin,sublin,producto,cos,farmacia,pub,
case when pub<case
when fin_fanasa<=2 and ofe_fanasa=0 then round((cos/.9)+.5)
when fin_fanasa=0 and ofe_fanasa>0 and ofe_fanasa<=10 then round((cos/.87)+.5)
when fin_fanasa=0 and ofe_fanasa>10 then round((cos/.87)+.5)
when fin_fanasa>0 and ofe_fanasa>10 then round((cos/.75)+.5)
when fin_fanasa>2 and ofe_fanasa=0 then round((cos/.85)+.5)
when fin_fanasa>0 and ofe_fanasa>0 then round((cos/.85)+.5)
end then round(pub) else
case
when fin_fanasa<=2 and ofe_fanasa=0 then round((cos/.9)+.5)
when fin_fanasa=0 and ofe_fanasa>0 and ofe_fanasa<=10 then round((cos/.87)+.5)
when fin_fanasa=0 and ofe_fanasa>10 then round((cos/.87)+.5)
when fin_fanasa>0 and ofe_fanasa>10 then round((cos/.75)+.5)
when fin_fanasa>2 and ofe_fanasa=0 then round((cos/.85)+.5)
when fin_fanasa>0 and ofe_fanasa>0 then round((cos/.85)+.5)
end
end as venta,
100-((cos/(case when pub<case
when fin_fanasa<=2 and ofe_fanasa=0 then round((cos/.9)+.5)
when fin_fanasa=0 and ofe_fanasa>0 and ofe_fanasa<=10 then round((cos/.87)+.5)
when fin_fanasa=0 and ofe_fanasa>10 then round((cos/.87)+.5)
when fin_fanasa>0 and ofe_fanasa>10 then round((cos/.75)+.5)
when fin_fanasa>2 and ofe_fanasa=0 then round((cos/.85)+.5)
when fin_fanasa>0 and ofe_fanasa>0 then round((cos/.85)+.5)
end then round(pub) else
case
when fin_fanasa<=2 and ofe_fanasa=0 then round((cos/.9)+.5)
when fin_fanasa=0 and ofe_fanasa>0 and ofe_fanasa<=10 then round((cos/.87)+.5)
when fin_fanasa=0 and ofe_fanasa>10 then round((cos/.87)+.5)
when fin_fanasa>0 and ofe_fanasa>10 then round((cos/.75)+.5)
when fin_fanasa>2 and ofe_fanasa=0 then round((cos/.85)+.5)
when fin_fanasa>0 and ofe_fanasa>0 then round((cos/.85)+.5)
end
end))*100) as util
 from  catalogo.cat_mercadotecnia a 
 where 
 cos>0 and codigo like '%$var%' and tipo='F' or
 cos>0 and descripcion like '%$var%' and tipo='F'";
        $q = $this->db->query($s);
        return $q;
    }

    public function oferta_candado()
    {
        $s = "select farmacia,fecha, cod_barras, descripcion,
b.tipo,producto,
fin_fanasa,ofe_fanasa,cos_fanasa,
(farmacos*100)as fanasa_candado,
((case when farmacos>0 then cos_fanasa-(cos_fanasa*farmacos) else cos_fanasa end)-((case when farmacos>0 then cos_fanasa-(cos_fanasa*farmacos) else cos_fanasa end)*.03)) as cosf_final,
fin_saba,ofe_saba,

cos_saba,(saba*100)as saba_candado,
((case when saba>0 then cos_saba-(cos_saba*saba) else cos_saba end)-(case when saba>0 then cos_saba-(cos_saba*saba) else cos_saba end*.04)) as coss_final,

cos_nadro,
cos,ult_costo,
case
when surte='F'
then ((case when farmacos>0 then cos_fanasa-(cos_fanasa*farmacos) else cos_fanasa end)-
     ((case when farmacos>0 then cos_fanasa-(cos_fanasa*farmacos) else cos_fanasa end)*.03))
when surte='S'
then ((case when saba>0 then cos_saba-(cos_saba*saba) else cos_saba end)-
     (case when saba>0 then cos_saba-(cos_saba*saba) else cos_saba end*.04))
when surte=' '
then
(((case when farmacos>0 then cos_fanasa-(cos_fanasa*farmacos) else cos_fanasa end)-((case when farmacos>0 then cos_fanasa-(cos_fanasa*farmacos) else cos_fanasa end)*.03))+
((case when saba>0 then cos_saba-(cos_saba*saba) else cos_saba end)-(case when saba>0 then cos_saba-(cos_saba*saba) else cos_saba end*.04)))/2
else 0 end as cos_oferta,
case when surte='F' then 'FARMACOS' when surte='S' then 'SABA' else 'PROMEDIO' end as surte,
pub,

case
when	producto='NET' and (100-((ult_costo/pub)*100))	between	0.00	and 	17.00	then	0
when	producto='NET' and (100-((ult_costo/pub)*100))	between	17.01	and 	20.00	then	5
when	producto='NET' and (100-((ult_costo/pub)*100))	between	20.01	and 	25.00	then	8
when	producto='NET' and (100-((ult_costo/pub)*100))	between	25.01	and 	30.00	then	10
when	producto='NET' and (100-((ult_costo/pub)*100))	between	30.01	and 	35.00	then	15
when	producto='NET' and (100-((ult_costo/pub)*100))	between	35.01	and 	45.00	then	20
when	producto='NET' and (100-((ult_costo/pub)*100))	between	45.01	and 	55.00	then	25
when	producto='NET' and (100-((ult_costo/pub)*100))	between	55.01	and 	70.00	then	30
when	producto='NET' and (100-((ult_costo/pub)*100))	between	70.01	and 	85.00	then	35
when	producto='NET' and (100-((ult_costo/pub)*100))	between	85.01	and 	100.00	then	40
when	producto='NET' and (100-((ult_costo/pub)*100))	>	100.01			then	45
when	producto='LIM' and (100-((ult_costo/pub)*100))	between	0.00	and 	12.00	then	0
when	producto='LIM' and (100-((ult_costo/pub)*100))	between	12.01	and 	30.00	then	10
when	producto='LIM' and (100-((ult_costo/pub)*100))	between	30.01	and 	40.00	then	15
when	producto='LIM' and (100-((ult_costo/pub)*100))	between	40.01	and 	45.00	then	20
when	producto='LIM' and (100-((ult_costo/pub)*100))	>	45.01			then	25
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	0.00	and 	25.00	then	0
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	25.01	and 	30.00	then	10
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	30.01	and 	40.00	then	15
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	40.01	and 	45.00	then	20
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	45.01	and 	58.00	then	25
when	producto='NOR' and (100-((ult_costo/pub)*100))	>	58.01			then	30
else 0 end descu,
(oferta*100)as descu_candado,

pub-(((case
when	producto='NET' and (100-((ult_costo/pub)*100))	between	0.00	and 	17.00	then	0
when	producto='NET' and (100-((ult_costo/pub)*100))	between	17.01	and 	20.00	then	5
when	producto='NET' and (100-((ult_costo/pub)*100))	between	20.01	and 	25.00	then	8
when	producto='NET' and (100-((ult_costo/pub)*100))	between	25.01	and 	30.00	then	10
when	producto='NET' and (100-((ult_costo/pub)*100))	between	30.01	and 	35.00	then	15
when	producto='NET' and (100-((ult_costo/pub)*100))	between	35.01	and 	45.00	then	20
when	producto='NET' and (100-((ult_costo/pub)*100))	between	45.01	and 	55.00	then	25
when	producto='NET' and (100-((ult_costo/pub)*100))	between	55.01	and 	70.00	then	30
when	producto='NET' and (100-((ult_costo/pub)*100))	between	70.01	and 	85.00	then	35
when	producto='NET' and (100-((ult_costo/pub)*100))	between	85.01	and 	100.00	then	40
when	producto='NET' and (100-((ult_costo/pub)*100))	>	100.01			then	45
when	producto='LIM' and (100-((ult_costo/pub)*100))	between	0.00	and 	12.00	then	0
when	producto='LIM' and (100-((ult_costo/pub)*100))	between	12.01	and 	30.00	then	10
when	producto='LIM' and (100-((ult_costo/pub)*100))	between	30.01	and 	40.00	then	15
when	producto='LIM' and (100-((ult_costo/pub)*100))	between	40.01	and 	45.00	then	20
when	producto='LIM' and (100-((ult_costo/pub)*100))	>	45.01			then	25
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	0.00	and 	25.00	then	0
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	25.01	and 	30.00	then	10
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	30.01	and 	40.00	then	15
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	40.01	and 	45.00	then	20
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	45.01	and 	58.00	then	25
when	producto='NOR' and (100-((ult_costo/pub)*100))	>	58.01			then	30
else 0 end)/100)*pub) as venta,

100-((ult_costo/(pub-(((case
when	producto='NET' and (100-((ult_costo/pub)*100))	between	0.00	and 	17.00	then	0
when	producto='NET' and (100-((ult_costo/pub)*100))	between	17.01	and 	20.00	then	5
when	producto='NET' and (100-((ult_costo/pub)*100))	between	20.01	and 	25.00	then	8
when	producto='NET' and (100-((ult_costo/pub)*100))	between	25.01	and 	30.00	then	10
when	producto='NET' and (100-((ult_costo/pub)*100))	between	30.01	and 	35.00	then	15
when	producto='NET' and (100-((ult_costo/pub)*100))	between	35.01	and 	45.00	then	20
when	producto='NET' and (100-((ult_costo/pub)*100))	between	45.01	and 	55.00	then	25
when	producto='NET' and (100-((ult_costo/pub)*100))	between	55.01	and 	70.00	then	30
when	producto='NET' and (100-((ult_costo/pub)*100))	between	70.01	and 	85.00	then	35
when	producto='NET' and (100-((ult_costo/pub)*100))	between	85.01	and 	100.00	then	40
when	producto='NET' and (100-((ult_costo/pub)*100))	>	100.01			then	45
when	producto='LIM' and (100-((ult_costo/pub)*100))	between	0.00	and 	12.00	then	0
when	producto='LIM' and (100-((ult_costo/pub)*100))	between	12.01	and 	30.00	then	10
when	producto='LIM' and (100-((ult_costo/pub)*100))	between	30.01	and 	40.00	then	15
when	producto='LIM' and (100-((ult_costo/pub)*100))	between	40.01	and 	45.00	then	20
when	producto='LIM' and (100-((ult_costo/pub)*100))	>	45.01			then	25
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	0.00	and 	25.00	then	0
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	25.01	and 	30.00	then	10
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	30.01	and 	40.00	then	15
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	40.01	and 	45.00	then	20
when	producto='NOR' and (100-((ult_costo/pub)*100))	between	45.01	and 	58.00	then	25
when	producto='NOR' and (100-((ult_costo/pub)*100))	>	58.01			then	30
else 0 end)/100)*pub)))*100)as util_real,

pub-(pub*oferta)venta_candado,

100-((case
when surte='F'
then ((case when farmacos>0 then cos_fanasa-(cos_fanasa*farmacos) else cos_fanasa end)-
     ((case when farmacos>0 then cos_fanasa-(cos_fanasa*farmacos) else cos_fanasa end)*.03))
when surte='S'
then ((case when saba>0 then cos_saba-(cos_saba*saba) else cos_saba end)-
     (case when saba>0 then cos_saba-(cos_saba*saba) else cos_saba end*.04))
when surte=' '
then
(((case when farmacos>0 then cos_fanasa-(cos_fanasa*farmacos) else cos_fanasa end)-((case when farmacos>0 then cos_fanasa-(cos_fanasa*farmacos) else cos_fanasa end)*.03))+
((case when saba>0 then cos_saba-(cos_saba*saba) else cos_saba end)-(case when saba>0 then cos_saba-(cos_saba*saba) else cos_saba end*.04)))/2
else 0 end)
/
(pub-(pub*oferta))*100) as por_utilidad_oferta

from catalogo.cat_mercadotecnia a
left join vtadc.ofertas_candado b on b.cod_barras=a.codigo
where
a.lin=1 and a.sublin not in(3,4,5) and pub>0 and cos>0 and b.cod_barras is not null and b.fecha=date_format(date(now()),'%Y-%m') or
a.lin>1 and pub>0 and cos>0  and b.cod_barras is not null and b.fecha=date_format(date(now()),'%Y-%m')
order by por_utilidad_oferta";
        $q = $this->db->query($s);
        return $q;
    }


    public function mante_susa($var)
    {
        $s = "select *from catalogo.cat_nuevo_general group by $var";
        $q = $this->db->query($s);
        return $q;
    }

    public function clasificacion()
    {
        $s = "select a.*,b.obser
from catalogo.cat_almacen_clasifica a
left join catalogo.cat_clasifica b on b.var=a.tipo and b.descontinua=a.descon
where sec>0 and sec<=1999  
order by a.tipo, a.sec ";
        $q = $this->db->query($s);
        return $q;
    }
    public function clasifica_masiva()
    {
        $s = "select a.*,b.obser
from catalogo.cat_almacen_clasifica a
left join catalogo.cat_clasifica b on b.var=a.tipo and b.descontinua=a.descon
where  ultimo_cambio>=date(now()) 
order by a.tipo, a.sec ";
        $q = $this->db->query($s);
        return $q;
    }
    public function descontin()
    {
        $s = "SELECT b.tsec,b.prv,b.prvx,a.* FROM catalogo.cat_almacen_clasifica a
left join catalogo.almacen b on b.sec=a.sec and tsec='G'
where descon='S' and b.sec is not null and a.sec>0 and a.sec<=1999 ";
        $q = $this->db->query($s);
        return $q;
    }
    public function clasifica($id)
    {
        $s = "select a.*,b.obser
from catalogo.cat_almacen_clasifica a
left join catalogo.cat_clasifica b on b.var=a.tipo and b.descontinua=a.descon
 where id=$id";
        $q = $this->db->query($s);
        return $q;
    }
    public function mante_susa_una($id)
    {
        $l = "select  *from catalogo.cat_nuevo_general where id=$id";
        $qq = $this->db->query($l);
        if ($qq->num_rows() > 0) {
            $rr = $qq->row();
            $susa = $rr->susa;
        } else {
            $susa = '';
        }
        $s = "select *from catalogo.cat_nuevo_general where susa='$susa' order by clagob,sec_cedis";
        $q = $this->db->query($s);
        return $q;
    }
    public function mod_generico()
    {
        $s = "select a.*,b.corto,c.linx, d.descripcion as sublinx from catalogo.cat_nuevo_general_sec a 
    left join catalogo.provedor b on a.prv=b.prov
    left join catalogo.lineas_cosvta c on c.lin=a.lin
    left join catalogo.sublinea d on d.lin=a.lin and d.slin=a.sublin
    ";
        $q = $this->db->query($s);
        return $q;
    }
    public function mante_susa_completa_una($clagob, $sec_cedis)
    {
        $l = "select  *from catalogo.cat_nuevo_general where clagob='$clagob' and sec_cedis=$sec_cedis";
        $qq = $this->db->query($l);
        if ($qq->num_rows() > 0) {
            $rr = $qq->row();
            $susa = $rr->susa;
        } else {
            $susa = '';
        }
        $s = "select *from catalogo.cat_nuevo_general_prv where sec='$sec_cedis' and clagob='$clagob'";
        $q = $this->db->query($s);
        return $q;
    }
    function busca_empleado_succ($succ)
    {
        $s = "select id,trim(completo)as nombre from catalogo.cat_empleado b 
        where tipo=1 and succ=$succ";
        $q = $this->db->query($s);
         $a[0]='Selecciona Empleado';
        foreach ($q->result() as $r) 
        {
            $a[$r->id] = $r->nombre;
        }

        return $a;
    }
    public function mante_codigo()
    {
        $s = "select *from catalogo.cat_nuevo_general where tipo='A'";
        $q = $this->db->query($s);
        return $q;
    }
    public function genericos()
    {
        $s = "select b.clagob,a.*, b.codigo,b.costo,b.prv,b.preferencia,b.prvxx,b.marca,
        case when ddr>0 then 100-((b.costo/a.ddr)*100) else 0 end as uddr,
        case when gen>0 then 100-((b.costo/a.gen)*100) else 0 end as ugen,
        case when a.cos>0 and b.costo>a.cos then 100-((a.cos/b.costo)*100) else 0 end as por
        
from catalogo.cat_nuevo_general_sec a
left join catalogo.cat_nuevo_general_prv b on a.sec=b.sec and b.tipo='A'
where a.tipo='A' 
order by a.sec asc ";
        $q = $this->db->query($s);
        $b = 0;
        foreach ($q->result() as $r) {
            
            $a[$r->sec]['sec'] = $r->sec;
            $a[$r->sec]['susa'] = $r->susa;
            $a[$r->sec]['cos'] = $r->cos;
            $a[$r->sec]['clasi'] = $r->clasi;
            $a[$r->sec]['natur'] = $r->natur;
            $a[$r->sec]['ddr'] = $r->ddr;
            $a[$r->sec]['gen'] = $r->gen;
            $a[$r->sec]['clagob'] = $r->clagob;
            $a[$r->sec]['productos'][$r->codigo]['codigo'] = $r->codigo;
            $a[$r->sec]['productos'][$r->codigo]['prv'] = $r->prv;
            $a[$r->sec]['productos'][$r->codigo]['costo'] = $r->costo;
            $a[$r->sec]['productos'][$r->codigo]['pref'] = $r->preferencia;
            $a[$r->sec]['productos'][$r->codigo]['prvxx'] = $r->prvxx;
            $a[$r->sec]['productos'][$r->codigo]['marca'] = $r->marca;
            $a[$r->sec]['productos'][$r->codigo]['por'] = $r->por;


        }

        return $a;
    }
    
    public function genericos_clasifica()
    {
        $s = "select a.sec,a.susa,a.tipo as clasi,
        vtagen as ddr, vtagen as gen from catalogo.cat_almacen_clasifica a
        join catalogo.sec_unica b on a.sec=b.sec
        where descon='N'";
        $q = $this->db->query($s);
        $b = 0;
        foreach ($q->result() as $r) {

            $a[$r->sec]['sec'] = $r->sec;
            $a[$r->sec]['susa'] = $r->susa;
            $a[$r->sec]['clasi'] = $r->clasi;
            $a[$r->sec]['ddr'] = $r->ddr;
            $a[$r->sec]['gen'] = $r->gen;
        }
        return $a;
    }


    

    public function seguro_popular()
    {
        $s = "select b.sec, a.*, b.codigo,b.costo,b.prv,b.preferencia,b.prvxx,b.marca,
        case when a.cos>0 and b.costo>a.cos then 100-((a.cos/b.costo)*100) else 0 end as por
from catalogo.cat_nuevo_general_cla a
left join catalogo.cat_nuevo_general_prv b on a.clagob=b.clagob and b.tipo='A'
where a.tipo='A'
order by b.clagob asc,b.costo";
        $q = $this->db->query($s);
        $b = 0;
        foreach ($q->result() as $r) {
            $a[$r->clagob]['susa'] = $r->susa;
            $a[$r->clagob]['sec'] = $r->sec;
            $a[$r->clagob]['cos'] = $r->cos;
            $a[$r->clagob]['clagob'] = $r->clagob;
            $a[$r->clagob]['productos'][$r->codigo]['codigo'] = $r->codigo;
            $a[$r->clagob]['productos'][$r->codigo]['prv'] = $r->prv;
            $a[$r->clagob]['productos'][$r->codigo]['costo'] = $r->costo;
            $a[$r->clagob]['productos'][$r->codigo]['pref'] = $r->preferencia;
            $a[$r->clagob]['productos'][$r->codigo]['prvxx'] = $r->prvxx;
            $a[$r->clagob]['productos'][$r->codigo]['marca'] = $r->marca;
            $a[$r->clagob]['productos'][$r->codigo]['por'] = $r->por;
        }

        return $a;
    }

    public function especial_control()
    {
        $id_user = $this->session->userdata('id');
        $s = "select a.*,case when persona='ES' then 'E' else 'C' end as tipox,
    ifnull((select sum(invf) from almacen.control_invd b where b.clave=a.clave),0)as inv,
    ifnull((select (costo) from almacen.control_invd b where b.clave=a.clave and b.costo>0 group by b.clave),0)as costo 
    From catalogo.cat_con a";
        $q = $this->db->query($s);
        return $q;
    }


    public function especialidad()
    {
        $s = "select b.sec, a.*, b.codigo,b.costo,b.prv,b.preferencia,b.prvxx,b.marca,
case when a.cos>0 and b.costo>a.cos then 100-((a.cos/b.costo)*100) else 0 end as por
from catalogo.cat_nuevo_general a
left join catalogo.cat_nuevo_general_prv b on a.clagob=b.clagob and b.tipo='A'
where a.tipo='A' and esp='E' and a.clagob<>' '>0
order by b.clagob asc,b.costo";
        $q = $this->db->query($s);
        $b = 0;
        foreach ($q->result() as $r) {
            $a[$r->clagob]['susa'] = $r->susa;
            $a[$r->clagob]['sec'] = $r->sec;
            $a[$r->clagob]['cos'] = $r->cos;
            $a[$r->clagob]['clagob'] = $r->clagob;
            $a[$r->clagob]['productos'][$r->codigo]['codigo'] = $r->codigo;
            $a[$r->clagob]['productos'][$r->codigo]['prv'] = $r->prv;
            $a[$r->clagob]['productos'][$r->codigo]['costo'] = $r->costo;
            $a[$r->clagob]['productos'][$r->codigo]['pref'] = $r->preferencia;
            $a[$r->clagob]['productos'][$r->codigo]['prvxx'] = $r->prvxx;
            $a[$r->clagob]['productos'][$r->codigo]['marca'] = $r->marca;
            $a[$r->clagob]['productos'][$r->codigo]['por'] = $r->por;
        }
        return $a;
    }

    function causes()
    {
        $s = "SELECT a.*,b.razo as prvx from catalogo.cat_nuevo_general_cla a
        left join catalogo.provedor b on b.prov=a.prv  where a.cause>0";
        $q = $this->db->query($s);
        return $q;
    }

    function mayoristas()
    {
        $s = "select codigo,descripcion,farmacia,pub,
cos_saba,cos_nadro,cos_fanasa,cos_marzam,
ofe_nadro,ofe_saba,ofe_fanasa,ofe_marzam,
fin_saba,fin_nadro,fin_fanasa,fin_marzam
from catalogo.cat_mercadotecnia
where
cos_fanasa<>cos_nadro and cos_fanasa<>cos_saba and cos_saba<>cos_nadro>0 and cos_marzam<>cos_fanasa and cos_fanasa>0 or
cos_fanasa<>cos_nadro and cos_fanasa<>cos_saba and cos_saba<>cos_nadro>0 and cos_marzam<>cos_fanasa and cos_nadro>0 or
cos_fanasa<>cos_nadro and cos_fanasa<>cos_saba and cos_saba<>cos_nadro>0 and cos_marzam<>cos_fanasa and cos_marzam>0 or
cos_fanasa<>cos_nadro and cos_fanasa<>cos_saba and cos_saba<>cos_nadro>0 and cos_marzam<>cos_fanasa and cos_saba>0";
        $q = $this->db->query($s);
        return $q;
    }

    function busca_empleado_($id_plaza)
    {
    $nivel=$this->session->userdata('nivel');
    $depto=$this->session->userdata('depto');
    
    if($nivel==15){$var='a.succ='.$depto.' and';}
    if($nivel==13){$var='b.superv='.$id_plaza.' and';}   
    if($nivel==12){$var='b.regional='.$id_plaza.' and';} 
    
    
        $sql = "select a.succ,a.nomina, concat(trim(pat),' ',trim(mat),' ',trim(nom))as nombre
from catalogo.cat_empleado a
join catalogo.sucursal b on b.suc=a.succ 
where $var a.tipo=1";
        $query = $this->db->query($sql);
        $nom[0] = "Seleccione el Empleado";

        foreach ($query->result() as $row) {
            $nom[$row->nomina] = $row->nombre . ' ' . $row->succ;
        }

        return $nom;
    }
    function busca_empleado_zona($id_plaza)
    {
    $nivel=$this->session->userdata('nivel');
    $depto=$this->session->userdata('depto');
    
    if($nivel==15){$var='a.succ='.$depto.' and';}
    if($nivel==13){$var='b.superv='.$id_plaza.' and';}   
    if($nivel==12){$var='b.regional='.$id_plaza.' and';} 
    
    
        $sql = "select a.succ,a.nomina, concat(trim(pat),' ',trim(mat),' ',trim(nom))as nombre
from catalogo.cat_empleado a
join catalogo.sucursal b on b.suc=a.succ 
where $var a.tipo=1";
        $query = $this->db->query($sql);
        $nom[0] = "Seleccione el Empleado";

        foreach ($query->result() as $row) {
            $nom[$row->nomina] = $row->nombre . ' ' . $row->succ;
        }

        return $nom;
    }

    function empleados_correo()
    {

        $sql = "select a.id,a.correo,b.suc,b.nombre as sucx,a.nomina, concat(trim(pat),' ',trim(mat),' ',trim(nom))as nombre
from catalogo.cat_empleado a
left join catalogo.sucursal b on b.suc=a.succ
where a.succ>=90002 and a.tipo=1
or a.suc in(100,900,6050) and a.tipo=1
order by b.nombre";
        $query = $this->db->query($sql);

        return $query;
    }

    function busca_empleados_id($id)
    {

        $sql = "select a.id,a.correo,b.suc,b.nombre as sucx,a.nomina, concat(trim(pat),' ',trim(mat),' ',trim(nom))as nombre
from catalogo.cat_empleado a
left join catalogo.sucursal b on b.suc=a.succ
where  a.id=$id
order by b.nombre";
        $query = $this->db->query($sql);

        return $query;
    }

    function busca_ord_dias()
    {

        $sql = "SELECT *from catalogo.compras_ord_dias";
        $query = $this->db->query($sql);

        $por = array();
        $por[0] = "Selecciona los dias";

        foreach ($query->result() as $row) {
            $por[$row->porcen] = $row->dia . ' DIAS';
        }

        return $por;
    }
    
    function busca_sucursales_pedido_especial()
    {

        $sql = "select ger,suc,nombre,pobla from catalogo.sucursal where dia in('LUN','MAR','MIE','JUE') AND tlid=1 and ger=1";
        $query = $this->db->query($sql);

        $in_suc="";
        $ss=0;
        foreach ($query->result() as $row) {
            $in_suc.= $row->suc.',';
            $ss=$row->suc;
        }
            

        $in_suc.=$ss;

        return $in_suc;
    }
    
    function busca_ord_dias_1()
    {

        $sql = "SELECT *from catalogo.compras_ord_dias";
        $query = $this->db->query($sql);

        $por = array();
        $por[0] = "Selecciona los dias";

        foreach ($query->result() as $row) {
            $por[$row->dia] = $row->dia . ' DIAS';
        }

        return $por;
    }
    
    function busca_fec1_ims($nombre)
    {

        $sql = "select a.*,b.mes as mesx from catalogo.calendario_externos a
left join catalogo.mes b on b.num=a.mes
where  fec_entrega between subdate(date(now()),60) and adddate(date(now()),64)
and nombre='$nombre'";
        $query = $this->db->query($sql);

        $alm = array();
        $alm[0] = "Seleccione La fecha";

        foreach ($query->result() as $row) {
            $alm[$row->fec_entrega] = $row->fec1 . ' AL ' . $row->fec2;
        }

        return $alm;
    }

    function busca_fec1_ims_sem($fec_e, $nombre)
    {
        $sql = "select a.*,b.mes as mesx from catalogo.calendario_externos a
left join catalogo.mes b on b.num=a.mes
where  fec_entrega='$fec_e' and nombre='$nombre'";
        $query = $this->db->query($sql);
        return $query;
    }


    function busca_almacen()
    {

        $sql = "SELECT *from catalogo.cat_almacenes where activo=1";
        $query = $this->db->query($sql);

        $alm = array();
        $alm[0] = "Seleccione Almacen";

        foreach ($query->result() as $row) {
            $alm[$row->tipo] = $row->nombre;
        }

        return $alm;
    }
    
    function busca_almacen_uno($alm)
    {

        $sql = "SELECT a.*from catalogo.cat_almacenes a and tipo='$alm'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $alm = $row->nombre;
        } else {
            $alm = '';
        }
        return $alm;
    }
    
    function busca_almacen_por($alm)
    {

        $sql = "SELECT a.*from catalogo.cat_almacenes a where tipo='$alm'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $alm = $row->por;
        } else {
            $alm = '';
        }
        return $alm;
    }
    
    function busca_almacen_ped($id)
    {

        $sql = "SELECT a.* from catalogo.cat_almacenes a, compras.pedido_c b where b.almacen=a.tipo and b.id=$id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $alm = $row->nombre;
        } else {
            $alm = '';
        }
        return $alm;
    }
    function Busca_grupo_beneficiario()
    {

        $sql = "SELECT * FROM catalogo.cat_beneficiario_grupo";
        $query = $this->db->query($sql);
        $id = array();
        $id[0] = "Seleccione grupo";

        foreach ($query->result() as $row) {
            $id[$row->id] = $row->nombre;
        }

        return $id;
    }
    function Busca_grupo_beneficiario_uno($gru)
    {

        $sql = "select * from catalogo.cat_beneficiario_grupo";
        $query = $this->db->query($sql);
        $grupo = array();
        $grupo[$gru] = "Seleccione grupo";

        foreach ($query->result() as $row) {
            $grupo[$row->id] = $row->nombre.' - '.$row->id;
        }

        return $grupo;
    }
    function Busca_sucursal_todas()
    {

        $sql = "select  * from catalogo.sucursal where tipo3 in('DA','FA','FE','OF','SE') order by nombre";
        $query = $this->db->query($sql);
        $suc = array();
        $suc[0] = "Seleccione sucursal";

        foreach ($query->result() as $row) {
            $suc[$row->suc] = $row->nombre.' - '.$row->suc;
        }

        return $suc;
    }
     function Busca_auxiliar_uno($auxi)
    {

        $sql = "SELECT * FROM catalogo.cat_auxiliar_renta";
        $query = $this->db->query($sql);
        $id = array();
        $id[$auxi] = "Seleccione Auxiliar";

        foreach ($query->result() as $row) {
            $id[$row->id] = $row->nombre;
        }

        return $id;
    }
    function Busca_sucursal_todas_una($su)
    {

        $sql = "select  * from catalogo.sucursal where tipo3 in('DA','FA','FE','OF','SE') order by nombre";
        $query = $this->db->query($sql);
        $suc = array();
        $suc[$su] = "Seleccione sucursal";

        foreach ($query->result() as $row) {
            $suc[$row->suc] = $row->nombre.' - '.$row->suc;
        }

        return $suc;
    }
    
    function Busca_sucursal_replicas()
    {

        $sql = "select interno,svr, destino,base_suc,a.nombre,a.suc from catalogo.sucursal a
left join catalogo.cat_replicas b on b.suc=a.suc
where a.back>0 and tlid=1
and b.suc is not null";
        $query = $this->db->query($sql);
        $suc = array();
        $suc[0] = "Seleccione sucursal";

        foreach ($query->result() as $row) {
            $suc[$row->suc] = $row->nombre;
        }

        return $suc;
    }
    
    function Busca_tipo_replicas()
    {

        $sql = "select *from catalogo.cat_replicas_tipo";
        $query = $this->db->query($sql);
        $tipo = array();
        $tipo[0] = "Seleccione tipo de replica";

        foreach ($query->result() as $row) {
            $tipo[$row->id] = $row->servidor . '-' . $row->nom_replica;
        }

        return $tipo;
    }
    
    function busca_almacen_ped_prv($id)
    {

        $sql = "SELECT*from compras.pedido_c b where b.id=$id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $prv = $row->prv;
        } else {
            $prv = 0;
        }
        return $prv;
    }
    
    function busca_almacen_pedidos()
    {

        $sql = "SELECT *from catalogo.cat_almacenes where pedido=1 ";
        $query = $this->db->query($sql);

        $alm = array();
        $alm[0] = "Seleccione Almacen";

        foreach ($query->result() as $row) {
            $alm[$row->tipo] = $row->nombre;
        }

        return $alm;
    }
    
    function busca_licitacion()
    {

        $sql = "select *from compras.numero_de_licitaciones";
        $query = $this->db->query($sql);

        $lic = array();
        $lic[0] = "Seleccione Numero de Licitacion";

        foreach ($query->result() as $row) {
            $lic[$row->licitacion] = $row->estado;
        }

        return $lic;
    }
    function busca_licitacion_una($licita)
    {

        $sql = "select *from compras.numero_de_licitaciones where licitacion='$licita'";
        $query = $this->db->query($sql);
        $row=$query->row();
            $lic = $row->num_licitacion;

        return $lic;
    }
    function busca_alma_uno($alm)
    {

        $sql = "select *from compras.numero_de_licitaciones where id=$alm";
        $query = $this->db->query($sql);
        $row=$query->row();
            $lic = $row->num_edo;

        return $lic;
    }
    function busca_clas($var)
    {

        $sql = "SELECT *from catalogo.cat_clasifica";
        $query = $this->db->query($sql);

        $clas = array();
        $clas[$var] = "Seleccione Almacen";

        foreach ($query->result() as $row) {
            $clas[$row->var] = $row->var;
        }

        return $clas;
    }
    
    function tipo_producto()
    {

        $sql = "SELECT * FROM catalogo.cat_estatus_producto";
        $query = $this->db->query($sql);

        $tipo = array();
        $tipo[0] = "Seleccione Tipo producto";

        foreach ($query->result() as $row) {
            $tipo[$row->tipo] = $row->nombre;
        }

        return $tipo;
    }
    
    function tipo_producto_uno($t)
    {

        $sql = "SELECT * FROM catalogo.cat_estatus_producto";
        $query = $this->db->query($sql);

        $tipo = array();
        $tipo[$t] = '';

        foreach ($query->result() as $row) {
            $tipo[$row->tipo] = $row->nombre;
        }

        return $tipo;
    }
    function busca_prv()
    {

        $sql = "SELECT *from catalogo.provedor";
        $query = $this->db->query($sql);

        $prv = array();
        $prv[0] = "Seleccione Provedor";

        foreach ($query->result() as $row) {
            $prv[$row->prov] = $row->prov . ' - ' . $row->razo;
        }

        return $prv;
    }
    function busca_prv_indicado($prov, $prvx)
    {

        $sql = "SELECT *from catalogo.provedor where tipo<>'B'";
        $query = $this->db->query($sql);
        $prv = array();
        $prv[$prov] = $prvx;

        foreach ($query->result() as $row) {
            $prv[$row->prov] = $row->prov . ' - ' . $row->corto;
        }

        return $prv;
    }
    
    function busca_licita($licita)
    {

        $sql = "SELECT *from compras.numero_de_licitaciones";
        $query = $this->db->query($sql);
        $prv = array();
        $prv[$licita] = '';

        foreach ($query->result() as $row) {
            $prv[$row->licitacion] = $row->licitacion . ' - ' . $row->estado;
        }

        return $prv;
    }
    
    function busca_prv_indicado_cedis($prov, $sec)
    {

        $sql = "SELECT *from catalogo.provedor a
join catalogo.almacen b on b.prv=a.prov and sec=$sec
where tipo<>'B' and tsec <> 'X'
group by prv, tsec";
        $query = $this->db->query($sql);
        $prv = array();
        $prv[$prov] = '';

        foreach ($query->result() as $row) {
            $prv[$row->prov] = $row->prov . ' - ' . $row->corto . ' - $' . $row->costo .
                '( ' . $row->tsec . ' )';
        }

        return $prv;
    }
    
    function busca_prv_indicado_cedis_t()
    {

        $sql = "SELECT *from catalogo.provedor a
join catalogo.almacen b on b.prv=a.prov and tsec<>'X' and sec>0 and sec<=3999
where tipo<>'B'
group by prv";
        $query = $this->db->query($sql);
        $prv = array();
        $prv['0'] = 'SELECCIONA PROVEEDOR';

        foreach ($query->result() as $row) {
            $prv[$row->prov] = $row->prov . ' - ' . $row->corto;
        }

        return $prv;
    }

    function busca_prv_indicado_cedis_costo($prov, $sec)
    {

        $sql = "SELECT * from catalogo.almacen b  
where prv=$prov and  sec=$sec";
        $query = $this->db->query($sql);
        $row = $query->row();
        $costo = $row->costo;
        return $costo;

    }

    function busca_prv_uno($prv)
    {

        $sql = "SELECT razo,prov FROM  catalogo.provedor where prov=$prv";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $prvv = trim($row->razo) . ' - ' . $row->prov;
        } else {
            $prvv = '';
        }
        return $prvv;
    }
    function busca_prv_uno_dr($prv)
    {

        $sql = "SELECT razo,prov FROM  catalogo.provedorV where prov=$prv";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $prvv = trim($row->razo) . ' - ' . $row->prov;
        } else {
            $prvv = '';
        }
        return $prvv;
    }
    
    function busca_prv_mer()
    {

        $sql = "SELECT *from catalogo.cat_mer_prv order by razo";
        $query = $this->db->query($sql);

        $prv = array();
        $prv[0] = "Seleccione Provedor";

        foreach ($query->result() as $row) {
            $prv[$row->prov] = $row->razo . ' ' . $row->prov;
        }

        return $prv;
    }
    
    function busca_prv_uno_mer($prv)
    {

        $sql = "SELECT corto,prov,razo FROM  catalogo.cat_mer_prv where prov=$prv";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $prvv = $row->razo;
        } else {
            $prvv = '';
        }
        return $prvv;
    }
    
    function firma()
    {
        $firma = $this->session->userdata('id_firma');
        $sql = "select *from catalogo.cat_firmas where id=$firma";
        $query = $this->db->query($sql);
        return $query;
    }
    
    function busca_imagen_uno($tipo)
    {

        $sql = "SELECT * FROM  catalogo.cat_imagen where tipo='$tipo'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $tipox = $row->nombre;
        } else {
            $tipox = '';
        }
        return $tipox;
    }
    
    function busca_mes_uno($mes)
    {

        $sql = "SELECT * FROM  catalogo.mes where num=$mes";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $mesx = $row->mes;
        } else {
            $mesx = '';
        }
        return $mesx;
    }
    
    function busca_ger_uno($ger)
    {

        $sql = "SELECT * FROM  catalogo.gerente where ger=$ger";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $gerx = $row->nombre_e;
        } else {
            $gerx = '';
        }
        return $gerx;
    }
    
    function busca_sup_uno($sup)
    {

        $sql = "SELECT * FROM  catalogo.supervisor where zona=$sup";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $supx = $row->nombre;
        } else {
            $supx = '';
        }
        return $supx;
    }
    
    function busca_suc_una($suc)
    {

        $sql = "SELECT * FROM  catalogo.sucursal where suc=$suc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $sucx = $row->nombre;
        } else {
            $sucx = '';
        }
        return $sucx;
    }
    function busca_suc_una_todos_datos($suc)
    {

        $sql = "SELECT * FROM  catalogo.sucursal where suc=$suc";
        $query = $this->db->query($sql);
        
        return $query;
    }
    function busca_suc()
    {

        $sql = "SELECT *from catalogo.sucursal 
        where suc>=100 and suc<=2000 and tlid=1 or suc=17000 or suc=14000 or suc=16000 or suc=90 
        or suc=78 or suc=3268 or suc=3267 or suc=3266";
        $query = $this->db->query($sql);

        $suc = array();
        $suc[0] = "Seleccione una Sucursal";

        foreach ($query->result() as $row) {
            $suc[$row->suc] = $row->suc . ' - ' . $row->nombre;
        }

        return $suc;
    }
    
    function busca_suc_activas()
    {

        $sql = "SELECT *from catalogo.sucursal 
        where suc>100 and suc<2200 and tlid=1 and dia<>'CER'";
        $query = $this->db->query($sql);

        $suc = array();
        $suc[0] = "Seleccione una Sucursal";

        foreach ($query->result() as $row) {
            $suc[$row->suc] = $row->suc . ' - ' . $row->nombre;
        }

        return $suc;
    }
    
    function busca_sucursal_zona($id_plaza)
    {

        $sql = "select * from catalogo.sucursal  
where 
superv=$id_plaza and tlid=1 or
regional=$id_plaza and tlid=1  
";
        $query = $this->db->query($sql);
        $suc[0] = "Seleccione el Sucursal";

        foreach ($query->result() as $row) {
            $suc[$row->suc] = $row->nombre . ' ' . $row->suc;
        }

        return $suc;
    }
    
    function busca_sucursal_ger($id_plaza)
    {
        $sql = "select * from catalogo.sucursal  
where regional=$id_plaza and tlid=1  and fecha_act='0000-00-00'
";
        $query = $this->db->query($sql);
        $suc[0] = "Seleccione el Sucursal";

        foreach ($query->result() as $row) {
            $suc[$row->suc] = $row->nombre . ' ' . $row->suc;
        }

        return $suc;
    }

    function busca_codigo()
    {

        $sql = "SELECT *from catalogo.cat_mercadotecnia";
        $query = $this->db->query($sql);

        $codigo = array();
        $codigo[0] = "Seleccione Producto";

        foreach ($query->result() as $row) {
            $codigo[$row->codigo] = $row->descripcion;
        }
        return $codigo;
    }
    
    function busca_codigo_solo_activos_back()
    {

        $sql = "SELECT *from catalogo.cat_mercadotecnia where rel1>0 and codigo>0 or rel2>0 and codigo>0";
        $query = $this->db->query($sql);

        $codigo = array();
        $codigo[0] = "Seleccione Producto";

        foreach ($query->result() as $row) {
            $codigo[$row->codigo] = $row->descripcion;
        }

        return $codigo;
    }

    function busca_codigo_especialidad()
    {

        $sql = "SELECT codigo,concat(trim(marca_comercial),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta))as descri from catalogo.cat_nuevo_general a where esp='E'";
        $query = $this->db->query($sql);

        $codigo = array();
        $codigo[0] = "Seleccione Producto";

        foreach ($query->result() as $row) {
            $codigo[$row->codigo] = $row->descri;
        }

        return $codigo;
    }
    public function busca_producto_nu($clagob, $sec)
    {
        $l = "select  *from catalogo.cat_nuevo_general where clagob=$clagob and sec_cedis=$sec";
        $qq = $this->db->query($l);

        return $qq;
    }
    public function busca_sec($sec)
    {
        $l = "select a.*,b.corto,c.linx, d.descripcion as sublinx from catalogo.cat_nuevo_general_sec a 
    left join catalogo.provedor b on a.prv=b.prov
    left join catalogo.lineas_cosvta c on c.lin=a.lin
    left join catalogo.sublinea d on d.lin=a.lin and d.slin=a.sublin
     where sec=$sec";
        $qq = $this->db->query($l);

        return $qq;
    }
    
    function busca_lin_uno($l)
    {

        $sql = "SELECT *from catalogo.lineas_cosvta
        ";
        $query = $this->db->query($sql);

        $lin = array();
        $lin[$l] = "Seleccione Linea";

        foreach ($query->result() as $row) {
            $lin[$row->lin] = $row->linx;
        }

        return $lin;
    }
    
    function busca_activo_uno($p)
    {

        $sql = "SELECT *from catalogo.cat_mer_activo";
        $query = $this->db->query($sql);
        $pro = array();
        $pro[$p] = '';
        foreach ($query->result() as $row) {
            $pro[$row->var] = $row->nombre;
        }
    }

    function busca_imagen()
    {
        $sql = "SELECT *from catalogo.cat_imagen";
        $query = $this->db->query($sql);
        $nombre = array();
        $nombre[0] = 'Seleccione tipo de Farmacia';
        foreach ($query->result() as $row) {
            $nombre[$row->tipo] = $row->nombre;
        }
        return $nombre;
    }

    function busca_mes()
    {
        $sql = "SELECT *from catalogo.mes";
        $query = $this->db->query($sql);
        $mes = array();
        $mes[0] = 'Seleccione el Mes';
        foreach ($query->result() as $row) {
            $mes[$row->num] = $row->mes;
        }
        return $mes;
    }

    function busca_suc_clasifica()
    {

        $sql = "SELECT *from catalogo.sucursal 
        where suc>=101 and suc<=2000 and tlid=1 and dia<>'cer'";
        $query = $this->db->query($sql);

        $suc = array();
        $suc[0] = "Seleccione una Sucursal";

        foreach ($query->result() as $row) {
            $suc[$row->suc] = $row->suc . ' - ' . $row->nombre;
        }

        return $suc;
    }

    function busca_anio()
    {
        $sql = "SELECT *from catalogo.anio where tipo=1";
        $query = $this->db->query($sql);
        $aaa = array();
        $aaa[0] = 'Seleccione el A&ntilde;o';
        foreach ($query->result() as $row) {
            $aaa[$row->aaa] = $row->aaa;
        }
        return $aaa;
    }

    function busca_tecnico()
    {
        $sql = "SELECT * FROM sistema01.`user` where activo=1 and nivel<>4";
        $query = $this->db->query($sql);
        $tecx = array();
        $tecx[0] = 'Seleccione un Tecnico';
        foreach ($query->result() as $row) {
            $tecx[$row->id] = $row->nombre;
        }
        return $tecx;
    }

    function busca_anio_pl()
    {
        $sql = "SELECT *from catalogo.anio where tipo=1 and aaa>=2014";
        $query = $this->db->query($sql);
        $aaa = array();
        $aaa[0] = 'Seleccione el A&ntilde;o';
        foreach ($query->result() as $row) {
            $aaa[$row->aaa] = $row->aaa;
        }
        return $aaa;
    }

    /////////////////////////////////////////////////////
    function busca_responsable()
    {
        $sql = "SELECT id, completo
                FROM catalogo.cat_empleado
                where depto=90006 and tipo=1 and responsable='J'";
        $query = $this->db->query($sql);
        $res = array();
        $res[0] = 'Seleccione el Responsable';
        foreach ($query->result() as $row) {
            $res[$row->id] = $row->completo;
        }
        return $res;
    }
    /////////////////////////////////////////////////////
    function busca_responsable_uno($id_resp)
    {
        $sql = "SELECT id, completo
                FROM catalogo.cat_empleado
                where depto=90006 and tipo=1 and responsable='J';";
        $query = $this->db->query($sql);
        //$res = array();
        $res[$id_resp] = 'Seleccione el Responsable';
        //echo $id_resp;
        foreach ($query->result() as $row) {
            $res[$row->id] = $row->completo;
        }
        return $res;
    }

    function busca_empleado($nomina, $emple)
    {
        $this->db->select('*');
        $this->db->from('catalogo.cat_empleado');
        $this->db->where('tipo', 1);
        $this->db->where('succ<1604', null, false);

        if (isset($nomina) && strlen(trim($nomina)) > 0) {
            $this->db->where('nomina', $nomina);
        }

        if (isset($emple) && strlen(trim($emple)) > 0) {
            $this->db->where("completo like '%$emple%'", null, false);
        }


        $query = $this->db->get();
        //echo $this->db->last_query();
        //echo die();


        return $query;

    }

    function busca_empleado1($nomina)
    {
        $this->db->select('*');
        $this->db->from('catalogo.cat_empleado');
        $this->db->where('tipo', 1);
        $this->db->where('nomina', $nomina);


        $query = $this->db->get();
        //echo $this->db->last_query();
        //echo die();


        return $query;

    }

    function autocomplete_proveedores($term)
    {
        $this->db->select('prov, razo, rfc ');
        $this->db->or_like('rfc', $term);
        $this->db->or_like('razo', $term);

        $query = $this->db->get('catalogo.provedor');
        //echo $this->db->last_query();
        //die ();

        return $query->result();
    }
    
    function autocomplete_claves($term)
    {
        $this->db->select('id, sec, SUBSTRING(susa1, 1, 255) as susa1', false);
        $this->db->or_like('susa1', $term);
        $this->db->or_like('sec', $term);
        $query = $this->db->get('catalogo.almacen');

        return $query->result();
    }
    
    function busca_sucursal_ruta($suc, $fol)
    {

        $sql = "select a.*, sum(a.ped)as ped, b.nombre as sucx,c.nom as ruta,c.suc as succ
       from desarrollo.pedidos a
       left join catalogo.sucursal b on b.suc=a.suc
       left join catalogo.almacen_rutas c on c.suc=a.suc and c.ruta=a.bloque
       where date(a.fechas)=date(now()) and tipo=1 and ped>0  and fol<=$fol and a.suc=$suc group by suc ";
        $query = $this->db->query($sql);
        $row = $query->row();
        $rutax = $row->ruta;
        return $rutax;
    }
    
    function busca_sucursal_imagen($tipo2)
    {

        $sql = "select count(*)as num_suc from catalogo.sucursal 
        where suc>100 and suc<1999 and tlid=1 and fecha_act='0000-00-00' and tipo2='$tipo2'
        and suc not in(176,177,178,179,180,181,187)";
        $query = $this->db->query($sql);
        $row = $query->row();
        $num_suc = $row->num_suc;
        return $num_suc;
    }

    function fecha_lim_vta()
    {
        $xx = "select subdate(date(now()),(1+WEEKDAY(date(now())))) as fec";
        $q = $this->db->query($xx);
        $r = $q->row();
        return $r->fec;
    }


    function domingos_del_mes($anho, $mes, $date_now)
    {
        $fecha1 = strtotime($anho . '-' . $mes . '-01');
        $fecha2 = strtotime($anho . '-' . $mes . '-' . date("t", mktime(0, 0, 0, $mes, 1,
            $anho)));

        for ($fecha1; $fecha1 <= $fecha2; $fecha1 = strtotime('+1 day ' . date('Y-m-d',
            $fecha1))) {
            if ((strcmp(date('D', $fecha1), 'Sun') == 0)) {
                $do[] = date('Y-m-d', $fecha1);
            }
        }
        $num = 0;
        foreach ($do as $r) {
            if ($fecha1 >= $r and $r < $date_now)
                $num = $num + 1;
        }
        $num = $num + 1;
        return $num;
    }

    function busca_empleado_tickets()
    {

        $sql = "SELECT * from catalogo.cat_empleado where tipo=1 and nomina > 0 order by pat, mat";
        $query = $this->db->query($sql);

        $empleado = array();
        $empleado['0'] = "Selecciona un empleado";

        foreach ($query->result() as $row) {
            $empleado[$row->nomina] = $row->completo;
        }

        return $empleado;
    }

    function busca_area_tickets()
    {

        $sql = "SELECT * FROM tickets.area a;";
        $query = $this->db->query($sql);

        $areaDescripcion = array();
        $areaDescripcion['0'] = "Selecciona un area";

        foreach ($query->result() as $row) {
            $areaDescripcion[$row->area] = $row->areaDescripcion;
        }

        return $areaDescripcion;
    }


    function busca_indicador_tickets()
    {

        $sql = "SELECT * FROM tickets.indicador i;";
        $query = $this->db->query($sql);

        $indicadorDescripcion = array();
        $indicadorDescripcion['0'] = "Selecciona un problema";

        foreach ($query->result() as $row) {
            $indicadorDescripcion[$row->indicador] = $row->indicadorDescripcion;
        }

        return $indicadorDescripcion;
    }

    function busca_mes_renta_calendario()
    {

        $sql = "SELECT
concat(aaa,'-',case when mes<=9 then concat('0',mes) else mes end,'-01')as fec,mesx,aaa
FROM catalogo.cat_calendario_nom group by mes";
        $query = $this->db->query($sql);

        $fec = array();
        $fec['0'] = "Seleccione mes para generar";

        foreach ($query->result() as $row) {
            $fec[$row->fec] = $row->mesx . ' DEL ' . $row->aaa;
        }

        return $fec;
    }


    function busca_que_dia($dia)
    {

        $fecha = date('Y-m-d');
        if ($dia == 1) {
            $dom = strtotime('-1 day', strtotime($fecha));
            $dom = date('Y-m-d', $dom);
            $lun = strtotime('-0 day', strtotime($fecha));
            $lun = date('Y-m-d', $lun);
            $mar = strtotime('+1 day', strtotime($fecha));
            $mar = date('Y-m-d', $mar);
            $mie = strtotime('+2 day', strtotime($fecha));
            $mie = date('Y-m-d', $mie);
            $jue = strtotime('+3 day', strtotime($fecha));
            $jue = date('Y-m-d', $jue);
            $vie = strtotime('+4 day', strtotime($fecha));
            $vie = date('Y-m-d', $vie);
            $sab = strtotime('+5 day', strtotime($fecha));
            $sab = date('Y-m-d', $sab);
        }
        if ($dia == 2) {
            $dom = strtotime('-2 day', strtotime($fecha));
            $dom = date('Y-m-d', $dom);
            $lun = strtotime('-1 day', strtotime($fecha));
            $lun = date('Y-m-d', $lun);
            $mar = strtotime('-0 day', strtotime($fecha));
            $mar = date('Y-m-d', $mar);
            $mie = strtotime('+1 day', strtotime($fecha));
            $mie = date('Y-m-d', $mie);
            $jue = strtotime('+2 day', strtotime($fecha));
            $jue = date('Y-m-d', $jue);
            $vie = strtotime('+3 day', strtotime($fecha));
            $vie = date('Y-m-d', $vie);
            $sab = strtotime('+4 day', strtotime($fecha));
            $sab = date('Y-m-d', $sab);
        }
        if ($dia == 3) {
            $dom = strtotime('-3 day', strtotime($fecha));
            $dom = date('Y-m-d', $dom);
            $lun = strtotime('-2 day', strtotime($fecha));
            $lun = date('Y-m-d', $lun);
            $mar = strtotime('-1 day', strtotime($fecha));
            $mar = date('Y-m-d', $mar);
            $mie = strtotime('-0 day', strtotime($fecha));
            $mie = date('Y-m-d', $mie);
            $jue = strtotime('+1 day', strtotime($fecha));
            $jue = date('Y-m-d', $jue);
            $vie = strtotime('+2 day', strtotime($fecha));
            $vie = date('Y-m-d', $vie);
            $sab = strtotime('+3 day', strtotime($fecha));
            $sab = date('Y-m-d', $sab);
        }
        if ($dia == 4) {
            $dom = strtotime('-4 day', strtotime($fecha));
            $dom = date('Y-m-d', $dom);
            $lun = strtotime('-3 day', strtotime($fecha));
            $lun = date('Y-m-d', $lun);
            $mar = strtotime('-2 day', strtotime($fecha));
            $mar = date('Y-m-d', $mar);
            $mie = strtotime('-1 day', strtotime($fecha));
            $mie = date('Y-m-d', $mie);
            $jue = strtotime('-0 day', strtotime($fecha));
            $jue = date('Y-m-d', $jue);
            $vie = strtotime('+1 day', strtotime($fecha));
            $vie = date('Y-m-d', $vie);
            $sab = strtotime('+2 day', strtotime($fecha));
            $sab = date('Y-m-d', $sab);
        }
        if ($dia == 5) {
            $dom = strtotime('-5 day', strtotime($fecha));
            $dom = date('Y-m-d', $dom);
            $lun = strtotime('-4 day', strtotime($fecha));
            $lun = date('Y-m-d', $lun);
            $mar = strtotime('-3 day', strtotime($fecha));
            $mar = date('Y-m-d', $mar);
            $mie = strtotime('-2 day', strtotime($fecha));
            $mie = date('Y-m-d', $mie);
            $jue = strtotime('-1 day', strtotime($fecha));
            $jue = date('Y-m-d', $jue);
            $vie = strtotime('-0 day', strtotime($fecha));
            $vie = date('Y-m-d', $vie);
            $sab = strtotime('+1 day', strtotime($fecha));
            $sab = date('Y-m-d', $sab);
        }
        if ($dia == 6) {
            $dom = strtotime('-6 day', strtotime($fecha));
            $dom = date('Y-m-d', $dom);
            $lun = strtotime('-5 day', strtotime($fecha));
            $lun = date('Y-m-d', $lun);
            $mar = strtotime('-4 day', strtotime($fecha));
            $mar = date('Y-m-d', $mar);
            $mie = strtotime('-3 day', strtotime($fecha));
            $mie = date('Y-m-d', $mie);
            $jue = strtotime('-2 day', strtotime($fecha));
            $jue = date('Y-m-d', $jue);
            $vie = strtotime('-1 day', strtotime($fecha));
            $vie = date('Y-m-d', $vie);
            $sab = strtotime('-0 day', strtotime($fecha));
            $sab = date('Y-m-d', $sab);
        }

        return $dom . $lun . $mar . $mie . $jue . $vie . $sab;
    }

    function busca_almacen_licitado($id_es, $estado)
    {

        $sql = "SELECT *from compras.numero_de_licitaciones";
        $query = $this->db->query($sql);
        $id_estado = array();
        $id_estado[$id_es] = $estado;

        foreach ($query->result() as $row) {
            $id_estado[$row->id] = $row->estado;
        }

        return $id_estado;
    }
    function busca_consigna($consigna)
    {

        $sql = "SELECT *from almacen.consigna";
        $query = $this->db->query($sql);
        $id_consigna = array();
        $id_consigna[$consigna] = '';

        foreach ($query->result() as $row) {
            $id_consigna[$row->consigna] = $row->domicilio;
        }

        return $id_consigna;
    }
    function busca_almacen_id()
    {

        $sql = "SELECT *from compras.numero_de_licitaciones";
        $query = $this->db->query($sql);
        $id_estado = array();
        $id_estado[0] = 'Selecciona almacen';

        foreach ($query->result() as $row) {
            $id_estado[$row->id] = $row->estado;
        }

        return $id_estado;
    }
    
    function busca_cia_filtro($id_cia, $ciax)
    {

        $sql = "SELECT *from catalogo.compa where cia in(1,13)";
        $query = $this->db->query($sql);
        $cia = array();
        $cia[$id_cia] = $ciax;

        foreach ($query->result() as $row) {
            $cia[$row->cia] = $row->razon;
        }

        return $cia;
    }
    
    function busca_cia_filtro_pre()
    {

        $sql = "SELECT *from catalogo.compa where cia in(1,13)";
        $query = $this->db->query($sql);
        $cia = array();
        $cia[13] = '';

        foreach ($query->result() as $row) {
            $cia[$row->cia] = $row->razon;
        }

        return $cia;
    }

    function busca_cia_una($cia)
    {

        $sql = "SELECT * FROM  catalogo.compa where cia=$cia";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $ciax = $row->razon;
        } else {
            $ciax = '';
        }
        return $ciax;
    }
    
    function busca_sec_filtro($sec_cedis, $susa, $prv = 0)
    {
        
        if($prv == 0)
        {
            $sql = "SELECT *from catalogo.almacen where ((sec>0 and sec<=1999) or (sec>=6000 and sec<=7999)) and tsec <> 'X' group by sec,codigo";
            $query = $this->db->query($sql);
        }else{
            $sql = "SELECT *from catalogo.almacen where prv = ? and ((sec>0 and sec<=1999) or (sec>=6000 and sec<=7999)) and tsec <> 'X' group by sec,codigo";
            $query = $this->db->query($sql, $prv);
        }

        
        $sec = array();
        $sec[$sec_cedis] = $sec_cedis.' - '.$susa;
        
        foreach ($query->result() as $row) {
            $sec[$row->sec.'|'.$row->codigo] = $row->sec . ' ('.$row->codigo.') - ' . $row->susa2 . '('.$row->prvx.')';
        }
        
        return $sec;
    }
    
    function busca_clagob_filtro($clagob, $susa)
    {

        $sql = "SELECT *from catalogo.segpop  where claves<>' '  and tip<>'X' group by claves";
        $query = $this->db->query($sql);
        $clave = array();
        $clave[$clagob] = $clagob.' '.$susa;

        foreach ($query->result() as $row) {
            $clave[$row->claves.'|'.$row->codigo] = $row->claves . ' - ' . $row->susa2;
        }

        return $clave;
    }
    
    
    
    function busca_clagob_filtro_gral($clagob, $susa, $prv,$codigo)
    {

        $sql = "SELECT a.clagob,codigo, lab,concat(trim(susa),' ',trim(gramaje),' ',trim(contenido),trim(presenta))as susa2
        from catalogo.cat_nuevo_general a
        join catalogo.cat_nuevo_general_prv p using(codigo)

        where a.clagob<>' ' and esp='E'  and prv = ? order by a.clagob * 1";
        $query = $this->db->query($sql, $prv);
         $clave[$clagob. '|' . $codigo] = $clagob.' '.$susa;

        foreach ($query->result() as $row) {
            $clave[$row->clagob . '|' . $row->codigo] = $row->clagob . ' ('.$row->codigo.') - ' . $row->susa2;
        }

        return $clave;
    }

    function busca_mov_captura()
    {

        $sql = "SELECT a.*,b.nombre FROM catalogo.cat_nominas_calendario a
join catalogo.cat_mov_super b on b.id=a.movimiento 
where date(now()) between inicio and fin and movimiento in(1,2,3,8)";
        $query = $this->db->query($sql);
        $mov = array();
        $mov[0] = 'Seleccione Movimiento';

        foreach ($query->result() as $row) {
            $mov[$row->movimiento] = $row->movimiento . ' - ' . $row->nombre;
        }

        return $mov;
    }


    function busca_mov_captura_uno($mov)
    {

        $sql = "SELECT *from catalogo.cat_mov_super a where a.id=$mov";
        $query = $this->db->query($sql);
        $r = $query->row();

        return $r->nombre;
    }

    function busca_motivo($mov)
    {

        $sql = "select * from catalogo.cat_mov_super_det  
where movimiento=$mov
";
        $query = $this->db->query($sql);
        $mot[0] = "Seleccione el Motivo";

        foreach ($query->result() as $row) {
            $mot[$row->id_motivo] = $row->nombre;
        }

        return $mot;
    }
    
    function busca_fecha_aplica($mov)
    {

        $s = "select aplica from catalogo.cat_nominas_calendario d
where  date(now()) between d.inicio and d.fin and movimiento=$mov
";
        $q = $this->db->query($s);
        $r = $q->row();
        return $r->aplica;
    }


    function sucursal_activa()
    {

        $s = "select a.cia,a.suc,a.nombre,a.dire, a.col,a.pobla,estado,b.edo,tel,tel1,tel_actual,a.lat,a.lon
From catalogo.sucursal a
left join desarrollo.sucursales b on b.suc=a.suc
where a.tlid=1 and a.dia<>'CER' and a.suc>100 and a.suc<=2899
";
        $q = $this->db->query($s);

        return $q;
    }

    function enviar_correo($id_pro)
    {
        $s = "select a.nomina,correo
from catalogo.cat_pro_correo a
join catalogo.cat_empleado b on b.nomina=a.nomina and b.tipo=1 
where id_proceso=$id_pro";
        $q = $this->db->query($s);
        $correo = "";
        $num = 0;
        foreach ($q->result() as $r) {
            if ($num > 0) {
                $correo .= ",";
            }
            $correo .= $r->correo;
            $num = $num + 1;
        }
        //$correo.=',lidia.-23@hotmail.com';
        return $correo;
    }
    function enviar_correo_suc_sin_inv()
    {
        $s = "select c.correo from desarrollo.sin_inv_dia_anterior a
join compras.usuarios b on b.id_plaza=a.regional and b.tipo=1
join catalogo.cat_empleado c on c.nomina=b.nomina and c.tipo=1
group by regional
union all
select c.correo from desarrollo.sin_inv_dia_anterior a
join compras.usuarios b on b.id_plaza=a.superv and b.tipo=1
join catalogo.cat_empleado c on c.nomina=b.nomina and c.tipo=1
group by superv
union all
select correo from desarrollo.sin_inv_dia_anterior
where correo<>' '";
        $q = $this->db->query($s);
        $correo = "";
        $num = 0;
        foreach ($q->result() as $r) {
            if ($num > 0) {
                $correo .= ",";
            }
            $correo .= $r->correo;
            $num = $num + 1;
        }
        //$correo.=',lidia.-23@hotmail.com';
        return $correo;
    }
function mes_act_ant()
    {
        $s = "select year(date(now()))as aaa_act, month(date(now()))as mes_act,
                (select mes from catalogo.mes x where num=month(date(now())))as mes_actx,
                year(subdate(date(now()), interval 1 month)) as aaa_ant, month(subdate(date(now()), interval 1 month)) as mes_ant,
                (select mes from catalogo.mes x where num=month(subdate(date(now()), interval 1 month)))as mes_antx";
        $q = $this->db->query($s);
        return $q;
    }    
    function busca_semana_venta()
    {

        $sql = "SELECT fec1,fec2 FROM catalogo.calendario_externos where nombre ='ventas'
and fec1<=date(now())";
        $query = $this->db->query($sql);
        $fecha[0] = "Seleccione semana";

        foreach ($query->result() as $row) {
            $fecha[$row->fec1 . '-' . $row->fec2] = $row->fec1 . ' al ' . $row->fec2;
        }

        return $fecha;
    }


    function cat_insumos()
    {
        $s = "select *from catalogo.cat_insumos where id_insumos<>351";
        $q = $this->db->query($s);
        return $q;
    }

    function cat_insumos_dep()
    {
        $s = "SELECT *  FROM catalogo.cat_insumos where depto>0";
        $q = $this->db->query($s);
        return $q;
    }


    // modificado para ver restringido
    function busca_insumo_gral()
    {
        $sql = "SELECT id_insumos, descripcion FROM catalogo.cat_insumos where activo=1 and suc=0 and medico=0
        and id_insumos not in(32,33,36,388,295,232,233,234,412,413,201,269) order by descripcion";
        $query = $this->db->query($sql);
        $id_insumos['0']='Seleccione insumos';
        foreach ($query->result() as $row) {
            $id_insumos[$row->id_insumos] = $row->descripcion.' - '.$row->id_insumos;
        }
        return $id_insumos;


    }
    function busca_insumo_ped_especial()
    {
        $sql = "SELECT id_insumos, descripcion FROM catalogo.cat_insumos where ped_especial=1 and activo=1 order by descripcion";
        $query = $this->db->query($sql);
        $id_insumos['0']='Seleccione insumos';
        foreach ($query->result() as $row) {
            $id_insumos[$row->id_insumos] = $row->descripcion.' - '.$row->id_insumos;
        }
        return $id_insumos;


    }
    function busca_insumo($suc)
    {
        $sql = "SELECT i.id_insumos, descripcion FROM catalogo.cat_insumos i
        join catalogo.cat_insumos_depto d on i.id_insumos = d.id_insumos and d.suc = ?";
        $query = $this->db->query($sql, array($suc));
        foreach ($query->result() as $row) {
            $suc[$row->id_insumos] = $row->descripcion;
        }
        return $query;


    }
    function busca_id_insumo($id_cc)
    {

        $sql = "SELECT x.* from catalogo.cat_insumos x
left join papeleria.insumos_d y on y.id_insumos=x.id_insumos and id_cc = $id_cc
where depto>0 and y.id_insumos is null";
        $query = $this->db->query($sql);
        $fecha[0] = "";

        foreach ($query->result() as $row) {
            $fecha[$row->id_insumos] = $row->descripcion . ' ' . $row->empaque;
        }

        return $fecha;
    }

    /* ****************************************************************************** */
    /*form_dropdown. Se obtiene dando referencia al post de id_insumos*/
    function getInsumoByID($id_insumos)
    {
        $this->db->where('id_insumos', $id_insumos);
         /* Lo llama referenciando ala base catalogo tabla cat_insumos*/
        $query = $this->db->get('catalogo.cat_insumos');
        return $query;
    }
    /**********************************************************************************/

    function busca_insumo_uno($cod)
    {
        $s = "SELECT *  FROM catalogo.cat_insumos_depto where depto>0 and id_insumos=$cod";
        $q = $this->db->query($s);
        return $q;

    }

     /**********************************************************************************/
    function departamentoInsumo()
    {
        $sql = "SELECT ifnull(x.especial,0) as especial,s.nombre, s.suc FROM catalogo.sucursal s
               join desarrollo.usuarios u on s.suc = u.suc
               left join catalogo.cat_especialinsu_depto x on x.suc = s.suc
               where u.nivel in(54) and u.activo = 1
               group by suc";

        $query = $this->db->query($sql);

        return $query;
    }
    

    function savePermisoInsumo($suc, $id_insumos)
    {
        $data = array(
            'suc' => $suc,
            'id_insumos' => $id_insumos
            );
        $s = "select * from catalogo.cat_insumos_depto where suc = ? and id_insumos = ?;";
        $query = $this->db->query($s, array($suc, $id_insumos));
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            
            if($row->activo == 0)
            {
                $data = array('activo' => 1, 'usuario' => $this->session->userdata('id'));
                $this->db->update('catalogo.cat_insumos_depto', $data, array('suc' => $suc, 'id_insumos' => $id_insumos));
            }else{
                $data = array('activo' => 0, 'usuario' => $this->session->userdata('id'));
                $this->db->update('catalogo.cat_insumos_depto', $data, array('suc' => $suc, 'id_insumos' => $id_insumos));
            }
        }
    }
     
       
    function SavePermisoEspecial($suc)
    {                
       $data = array(
            'suc' => $suc,
            );

        $this->db->where('suc', $suc);
        $query = $this->db->get('catalogo.cat_especialinsu_depto');

        if ($query->num_rows() == 0) {
            $data = array(
                'suc'        => $suc,
                'especial'   => 1
                );
            $this->db->set('fecha', 'now() + interval 2 day', false);
            $this->db->insert('catalogo.cat_especialinsu_depto', $data);
        }else{
            $row = $query->row();
            if($row->fecha == date("Y-m-d H:i:s")){
            $this->db->delete('catalogo.cat_especialinsu_depto', $data);
           }
          }
      }

    function s_cat_insumos_menu_si($suc)
    {
        $sql = "select i.id_insumos,d.suc, descripcion,empaque,ifnull(d.activo,0) as activo, ifnull(d.maximo,0) as maximo from catalogo.cat_insumos i
                left join catalogo.cat_insumos_depto d on i.id_insumos = d.id_insumos
                where i.activo = 1 and i.depto = 1 and d.suc = $suc and maximo > 0";
        $query = $this->db->query($sql);
        return $query;
   }
   
   function s_cat_insumos_menu($suc)
    {
        $sql = "select i.id_insumos,d.suc, descripcion,empaque,ifnull(d.activo,0) as activo, ifnull(d.maximo,0) as maximo from catalogo.cat_insumos i
                left join catalogo.cat_insumos_depto d on i.id_insumos = d.id_insumos and d.suc = $suc
                where i.activo =1 and i.depto = 1";
        $query = $this->db->query($sql);
        return $query;
   }
   
   function imprime_max_cabeza($suc)
   {
    $fec=date('Y-m-d H:i:s');
     $sql = "select i.id_insumos,d.suc,e.nombre as sucx, descripcion,empaque,ifnull(d.activo,0) as activo, ifnull(d.maximo,0) as maximo from catalogo.cat_insumos i
            left join catalogo.cat_insumos_depto d on i.id_insumos = d.id_insumos
            join catalogo.sucursal e on e.suc = d.suc
            where i.activo = 1 and i.depto = 1 and d.suc = $suc and maximo > 0";
    $query = $this->db->query($sql);
    if($query->num_rows()>0){
       foreach($query->result() as $row) {
    $l0='<img src="'.base_url().'img/logos.png" border="0" width="100px" />';
    $tabla ="<table>
             <tr>
             <th>$l0</th>
             <th align=\"center\"> <font size=\"+3\"><strong>CONTROL DE MAXIMOS DE PAPELERIA</strong></font></th>
             <th align=\"center\"> <font size=\"+3\"><strong>$row->suc - $row->sucx</strong></font></th>
             </tr>
             <tr>
             <th colspan=\"1\" align=\"right\"><font size=\"-2\"><strong>Fecha de impresion $fec</strong></font></th>
             </tr>
             </table>";
       }
      }
    return $tabla;
   }
   
   function imprime_max_detalle($suc)
   {
    $s = "select i.id_insumos,d.suc, descripcion,empaque,ifnull(d.activo,0) as activo, ifnull(d.maximo,0) as maximo from catalogo.cat_insumos i
         left join catalogo.cat_insumos_depto d on i.id_insumos = d.id_insumos and d.suc = $suc
         where i.activo =1 and i.depto = 1 and maximo > 0";
    $q = $this->db->query($s);
     if($q->num_rows()>0){     
        $tabla .= '
            <table style="font-size: 18px;" border="1" cellpadding="3">
            <thead>
            <tr> 
            <th width="6%" style="font-size: 25px;"><strong>C&oacute;digo</strong></th>
            <th width="40%" style="font-size: 25px;"><strong>Descripci&oacute;n</strong></th>
            <th width="20%" style="font-size: 25px;"><strong>Empaque</strong></th>
            <th width="10%" style="font-size: 25px;"><strong>Activo</strong></th>
            <th width="15%" style="font-size: 25px;"><strong>M&aacute;ximo</strong></th>                      
            </tr>
            </thead>
            <tbody>';
        foreach($q->result() as $row) {
            if($row->activo == 1){
               $f1 = 'si';
            }else{
               $f1 = 'no'; 
            }
            $tabla .= '
            <tr>
            <td width="6%" style="font-size: 18px;">'.$row->id_insumos.'</td>
            <td width="40%" style="font-size: 18px;">'.$row->descripcion.'</td>
            <td width="20%" style="font-size: 18px;">'.$row->empaque.'</td>
            <td width="10%" style="font-size: 18px;">'.$f1.'</td>
            <td width="15%" style="font-size: 18px;">'.$row->maximo.'</td>
            </tr>
            ';
            }
        $tabla .= '
    </tbody>
    </table>'; 
    } 
    return $tabla; 
   }
   
    /*Esto es lo nuevo*form_dropdown*/
    function saca_menu_desplegable()
    {
        $sql = "SELECT  i.id_insumos, i.descripcion
                FROM catalogo.cat_insumos i
                LEFT JOIN catalogo.cat_insumos_depto d
                ON i.id_insumos = d.id_insumos
                WHERE d.suc = ?;";
        $query = $this->db->query($sql, array($this->session->userdata('depto')));
        $consul = array(); 
        foreach ($query->result() as $row) {
            $consul[$row->id_insumos] = $row->descripcion;
        }
        return $consul;
    }

    /* ***********************  nuevos insumos ************************************ */
    function insertInsumos($id_insumos, $descripcion, $empaque, $costo, $multiplo, $maxi,
        $observa, $suc, $depto, $medico)
    {
        $this->db->where('id_insumos', $id_insumos);
        $query = $this->db->get('catalogo.cat_insumos');

        if ($query->num_rows() == 0) {
            $data = array(
                'id_insumos' => $id_insumos,
                'descripcion' => $descripcion,
                'empaque' => $empaque,
                'costo' => $costo,
                'multiplo' => $multiplo,
                'maxi' => $maxi,
                'observa' => $observa,
                'suc' => $suc,
                'depto' => $depto,
                'medico' => $medico);
            $this->db->insert('catalogo.cat_insumos', $data);
        } else {

        }
    }
    /******************************************************************************************************************/

    function actualizaInsumos($data, $id_insumos)
    {
        $this->db->where('id_insumos', $id_insumos);
        $query = $this->db->get('catalogo.cat_insumos');
        if ($query->num_rows() > 0) {
            
            $this->db->update('catalogo.cat_insumos', $data, array('id_insumos' => $id_insumos));
          /*  echo $this->db->last_query();
            die();*/
        } else {

        }
    }

    /*********************************************************************/
    /*ver el contenido de insumos por medio de la sesion del departamento o sucursal*/
      function s_cat_insumos_dep()
    {
        $sql = "SELECT  i.id_insumos, i.descripcion, i.empaque, i.maxi, i.observa
from catalogo.cat_insumos i
LEFT JOIN catalogo.cat_insumos_depto d
ON i.id_insumos = d.id_insumos
WHERE d.suc = ?;";
        $query = $this->db->query($sql, array($this->session->userdata('depto')));
         return $query;

    }
    /*********************************** para la seccion de los medicos insumos ********************************** */
        
        function s_cat_insumos_his_bus($var)
    {
       $s = "SELECT a.id,a.suc,b.nombre,a.fecha_cap,
ifnull((select sum(canp) from papeleria.insumos_d x where x.id_cc=a.id and x.tipo in(1,2,3) group by x.id_cc),0)as can_ped,
ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id and x.tipo in(2,3) group by x.id_cc),0)as can_sur,

ifnull(round((((ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id and x.tipo in(2,3) group by x.id_cc),0))/
((select sum(canp) from papeleria.insumos_d x where x.id_cc=a.id and x.tipo in(1,2,3) group by x.id_cc)))*100),2),0)as nivel_surtido

FROM papeleria.insumos_c a
join catalogo.sucursal b on b.suc=a.suc
where a.id_comprar in(1,3) and a.tipo in(1,2,3)
and b.nombre like '%$var%'";
        $q = $this->db->query($s);
        return $q;
    }
    
    function s_cat_insumos_his_detalle($id,$suc)
    {
        
        $s = "SELECT  a.id,a.suc, x.nombre,c.id_insumos,c.descripcion,
(select canp from papeleria.insumos_d x where x.id_cc=a.id and x.id_insumos = b.id_insumos and x.tipo in (1,2,3) group by x.id_cc)as canp,
ifnull((select cans from papeleria.insumos_s x where x.id_cc=a.id and x.id_insumos = b.id_insumos and x.tipo in(2,3)group by x.id_cc),0) as cans,
ifnull(round((((SELECT x.cans FROM papeleria.insumos_s x where x.id_cc = a.id and x.id_insumos = b.id_insumos and x.tipo in(2,3) group by b.id_cc)/
(select x.canp from papeleria.insumos_d x where x.id_cc=a.id and x.id_insumos = b.id_insumos and x.tipo in (1,2,3) group by x.id_cc))*100),2),0) as porcentaje
FROM papeleria.insumos_c a
join papeleria.insumos_s b on b.id_cc = a.id
join catalogo.cat_insumos c on c.id_insumos = b.id_insumos
join catalogo.sucursal x on x.suc=a.suc

where a.id_comprar in(1,3)
and a.tipo in(1,2,3)
and a.id = $id
group by b.id_insumos";
              $q= $this->db->query($s);
              return $q;
    }
    
    function pedidoSurtidoTitulo($id)
    {
        $sql = "SELECT i.id, suc, nombre FROM papeleria.insumos_c i
join catalogo.sucursal s using(suc)
where i.id = ?;";

        $query = $this->db->query($sql,$id);
        
        return $query;
    }
    
    function actInsumosDepto($suc)
    {
        $sql = "insert ignore into catalogo.cat_insumos_depto(id_insumos, suc, activo, maximo) (SELECT id_insumos, ?, 0, 0 FROM catalogo.cat_insumos c);";
        $this->db->query($sql, $suc);
        
    }
    function cat_beneficiario_nivel($criterio)
    {

        $sql = "select *from catalogo.cat_beneficiario_nivel";
        $query = $this->db->query($sql);

        $id = array();
        $id[$criterio] = "";

        foreach ($query->result() as $row) {
            $id[$row->id] = $row->nombre;
        }

        return $id;
    }
    
    
    public function cata_gen_fenix()
    {
        $s = "SELECT sec,susa,venta_pub FROM catalogo.cat_almacen_clasifica where val=1 and descon= 'N'";
        $q = $this->db->query($s);
        $b = 0;
        foreach ($q->result() as $r) {

            $a[$r->sec]['sec'] = $r->sec;
            $a[$r->sec]['susa'] = $r->susa;
            $a[$r->sec]['venta_pub'] = $r->venta_pub;
           
        }
        return $a;
    }

   public function cata_cambio_precio()
    {
        $s = "select a.fecha, a.codigo, a.descripcion, a.pub_ant, a.pub_act from sucursal.cambio_precios a

                order by fecha desc";

        $q = $this->db->query($s);

        return $q;
    }


    /*******************Bloquear codigo de Pharmacos************************/

    public function cat_bloq_cod($data,$code){

   $s = "select rel1,rel2 from catalogo.cat_fanasa where codigo= $code";
        $q = $this->db->query($s);
        
        foreach ($q->result() as $r) {
           $a['rel1'] = $r->rel1;
           $a['rel2'] = $r->rel2;                 
        }
       
        $datos =array(
        'suc'=>$data['suc'],
        'codigo'=>$data['codigo'],
        'activo'=>$data['activo'],
        'fecha_mov'=>date('Y-m-d H:i:s'),
         'rel1'=>$a['rel1'],
         'rel2'=>$a['rel2']
        );
                      
        $this->db->insert('sucursal.codigos_bloqueados_pedido',$datos);
   
     }

    public function desc_bloq_cod($id_plaza){

        $s = "select a.id_cod, a.suc, c.nombre, a.codigo, b.descripcion, b.rel1, b.rel2
               from sucursal.codigos_bloqueados_pedido a join catalogo.cat_fanasa b
                   on a.codigo = b.codigo
                   join catalogo.sucursal c on a.suc = c.suc
                    where activo = 0 and tipo2='F' and superv=$id_plaza";

        $q = $this->db->query($s);
        return $q;

        }

    public function desc_bloq_cod_tab2($id_plaza){
        $s1 = "select a.id_cod, a.suc, c.nombre, a.codigo, b.descripcion,a.fecha_mov
               from sucursal.codigos_bloqueados_pedido a join catalogo.cat_fanasa b
                    on a.codigo = b.codigo
                      join catalogo.sucursal c on a.suc = c.suc
                         where activo = 1 and tipo2='F' and c.superv=$id_plaza order by a.fecha_mov desc";

        $q1 = $this->db->query($s1);
        return $q1;
        }
    
    public function upd_bloq_cod($id){

        $data = array(
        'activo' => 1,
        'fecha_mov'=>date('Y-m-d H:i:s')
         );

        $this->db->where('id_cod', $id);
        $this->db->update('sucursal.codigos_bloqueados_pedido', $data);
        }

    public function  del_bloq_cod($id){
        $this->db->where('id_cod', $id);
        $this->db->delete('sucursal.codigos_bloqueados_pedido');

      }

      public function busca_suc_bloq($id_plaza)
      {
        $sql = "select suc,nombre from catalogo.sucursal where tipo3='FE' and tlid=1 and superv=$id_plaza";
        $query = $this->db->query($sql);
        $suc = array();
        $suc[0] = 'Seleccione Sucursal';

        foreach ($query->result() as $row) {
            $suc[$row->suc] = $row->suc. ' - ' . $row->nombre;
        }

        return $suc;
        
      }


    function busca_bloq_cod($codigo){
        $sql = " SELECT codigo,descripcion FROM catalogo.cat_fanasa where codigo = $codigo order by codigo; ";
        $query2 = $this->db->query($sql);        
         if($query2->num_rows() == 0){
            $tabla = 0;
         }else{
        $tabla = "<option value=\"-\">Seleccione un producto</option>";
        foreach($query2->result() as $row){
             $tabla.="<option value =\"".$row->codigo."\">".$row->codigo." - ".$row->descripcion."</option>
            ";
         } 
        }  
        return $tabla;  
     }
     
     function busca_bloq_cla($cla,$prv){
        $sql = " SELECT id as id_cat,claves,codigo,susa1,susa2,costo,prv 
        FROM catalogo.segpop where 
        claves = '$cla' and prv=$prv and tip<>'X' or
        susa1 like '%$cla%' and prv=$prv and tip<>'X'
        ";
        $query = $this->db->query($sql); 
         if($query->num_rows() == 0){
            $tabla = 0;
         }else{
        $tabla = "<option value=\" \">Seleccione una producto</option>";
        foreach($query->result() as $row){
             $tabla.="<option value =\"".$row->id_cat."\">".$row->claves."-".$row->codigo."-".$row->susa1."-".$row->susa2."-".$row->costo."</option>
            ";
         } 
        }  
        return $tabla;  
     }
    
     function busca_id_cat($id_cat,$id_orden)
     {
        $sql = "select claves, susa1, susa2, a.prv,  costo,  codigo,
case
when embarca=12000 and cos1>0 then cos1
when embarca=19000 and cos2>0 then cos2
when embarca=12000 and cos1=0 then costo
when embarca=19000 and cos2=0 then costo
else costo end
 from catalogo.segpop a,compras.orden_c b where b.id_orden=? and a.id = ?;";

        $query = $this->db->query($sql, array($id_orden,$id_cat));

        $json = json_encode($query->row());

        return $json;
     }
    function busca_bloq_cla_esp($cla,$prv){
        $sql = " 
        select b.id as id_cat,b.clagob as claves,b.codigo,
        concat(trim(susa),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta))as susa1,
        concat(trim(marca_comercial),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta))as susa2,
        concat (cos1,'--',cos2)as costo,prv
        FROM catalogo.cat_nuevo_general a
        join catalogo.cat_nuevo_general_prv b on a.codigo=b.codigo and a.clagob=b.clagob
        where
        b.clagob = '$cla' and prv=$prv and esp='E' or
        susa like '%$cla%' and prv=$prv and esp='E'
        ";
        $query = $this->db->query($sql); 
         if($query->num_rows() == 0){
            $tabla = 0;
         }else{
        $tabla = "<option value=\" \">Seleccione una producto</option>";
        foreach($query->result() as $row){
             $tabla.="<option value =\"".$row->id_cat."\">".$row->claves."-".$row->codigo."-".$row->susa1."-".$row->susa2."-".$row->costo."</option>
            ";
         } 
        }  
        return $tabla;  
     }
     function busca_id_cat_especialidad($id_cat,$id_orden)
     {
        $sql = "select b.id as id_cat,b.clagob as claves,b.codigo,
concat(trim(susa),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta))as susa1,
concat(trim(marca_comercial),' ',trim(gramaje),' ',trim(contenido),' ',trim(presenta))as susa2,
case
when embarca=12000 and cos1>0 then cos1
when embarca=19000 and cos2>0 then cos2
when embarca=12000 and cos1=0 then costo
when embarca=19000 and cos2=0 then costo
else costo end as costo,b.prv
        FROM catalogo.cat_nuevo_general a
        join catalogo.cat_nuevo_general_prv b on a.codigo=b.codigo and a.clagob=b.clagob
        join compras.orden_c c on c.id_orden=$id_orden
     where
        b.id = $id_cat;";

        $query = $this->db->query($sql);

        $json = json_encode($query->row());

        return $json;
     }

function busco_cod_fanasa($cod){
        $sql = " SELECT a.* FROM catalogo.cat_fanasa a where codigo like '$cod%' or descripcion like '%$cod%'
        ";
        $query = $this->db->query($sql); 
         if($query->num_rows() == 0){
            $tabla = 0;
         }else{
        $tabla = "<option value=\" \">Seleccione una producto</option>";
        foreach($query->result() as $row){
             $tabla.="<option value =\"".$row->codigo."\">".$row->codigo."-".$row->descripcion."</option>
            ";
         } 
        }  
        return $tabla;  
     }
     
     ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
     
     ////////////////// Catalogo_modelo////////////////
function busca_mes_unico($mes)
    {
     $sql = "SELECT  mes FROM  catalogo.mes where num = ?";
    $query = $this->db->query($sql,array($mes));
    $row= $query->row();
    $mesx=$row->mes;
     return $mesx; 
}
   

















    }   
?>