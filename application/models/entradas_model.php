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
        return $q;
    }
    

}
