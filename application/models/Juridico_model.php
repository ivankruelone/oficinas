<?php
class Juridico_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    public function rentas()
    {
    $aaa=date('Y');
        $s = "SELECT a.*,b.nombre as sucx,a.imp,
     (imp*a.iva)as ivaf,(imp*(isr/100))as isrf,(imp*(iva_isr/100))as iva_isrf,


     case when pago='MN'
then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end
 as totalmn,
case when pago='USD'
then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end
 as totalusd,



 case when a.auxi=7004 then 'MORAL' else 'FISICA' end as auxix

FROM catalogo.cat_beneficiario a
left join catalogo.sucursal b on b.suc=a.suc
where activo=1
order by a.suc";
        $q = $this->db->query($s);
     return $q;  
    }





public function ventas_cortes_ger($f1,$f2)
    {
    $aaa=date('Y');
        $s = "SELECT  a.num_dias, f.nombre as supervx,e.nombre_e as regionalx, a.mes as mm,a.suc, a.tipo2,d.nombre as tipox, a.mes,c.mes as mesx, b.regional, b.superv,b.nombre as sucx,
        a.credito,a.contado,a.recarga
FROM vtadc.gc_venta_mes a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.gerente e on e.ger=b.regional
left join catalogo.mes c on c.num=a.mes
left join catalogo.cat_imagen d on d.tipo=a.tipo2  
left join catalogo.supervisor f on f.zona=b.superv
where b.regional>0 and aaa=$aaa and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>187
order by a.mes,tipo2,b.regional,b.superv,a.suc";
        $q = $this->db->query($s);
        $b=0;
        foreach ($q->result()as $r)
        {
        $a[$r->mes]['f1'] = $f1;
        $a[$r->mes]['f2'] = $f2;
        $a[$r->mes]['mesx'] = $r->mesx;
        $a[$r->mes]['mes'] = $r->mm;
        $a[$r->mes]['m'][$r->regional]['regional'] = $r->regional;
        $a[$r->mes]['m'][$r->regional]['regionalx'] = $r->regionalx;
        $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['superv'] = $r->superv;
        $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['supervx'] = $r->supervx;
        $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->tipo2]['tipo2'] = $r->tipo2;
        $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->tipo2]['imagen'] = $r->tipox;
        $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->tipo2]['cuarto'][$r->suc]['suc']= $r->suc;
        $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->tipo2]['cuarto'][$r->suc]['sucx'] = $r->sucx;
        $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->tipo2]['cuarto'][$r->suc]['num_dias'] = $r->num_dias;
        $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->tipo2]['cuarto'][$r->suc]['credito'] = $r->credito;
        $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->tipo2]['cuarto'][$r->suc]['recarga'] = $r->recarga;
        $a[$r->mes]['m'][$r->regional]['segundo'][$r->superv]['tercero'][$r->tipo2]['cuarto'][$r->suc]['contado'] = $r->contado;
        }

     return $a;  
    }
 public function ventas_succ($f1,$f2)
    {
    $aaa=date('Y');
        $s = "SELECT  a.num_dias, f.nombre as supervx,e.nombre_e as regionalx, a.mes as mm,a.suc, a.tipo2,d.nombre as tipox, a.mes,c.mes as mesx, b.regional, b.superv,b.nombre as sucx,
        a.credito,a.contado,a.recarga
FROM vtadc.gc_venta_mes a
left join catalogo.sucursal b on a.suc=b.suc
left join catalogo.gerente e on e.ger=b.regional
left join catalogo.mes c on c.num=a.mes
left join catalogo.cat_imagen d on d.tipo=a.tipo2  
left join catalogo.supervisor f on f.zona=b.superv
where b.regional>0 and aaa=$aaa and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>187 
and b.superv=$f2
";
        $q = $this->db->query($s);
        $b=0;
        foreach ($q->result()as $r)
        {
        $a[$r->mes]['f1'] = $f1;
        $a[$r->mes]['f2'] = $f2;
        $a[$r->mes]['mesx'] = $r->mesx;
        $a[$r->mes]['mes'] = $r->mm;
        $a[$r->mes]['m'][$r->suc]['regional'] = $r->regional;
        $a[$r->mes]['m'][$r->suc]['regionalx'] = $r->regionalx;
        $a[$r->mes]['m'][$r->suc]['superv'] = $r->superv;
        $a[$r->mes]['m'][$r->suc]['supervx'] = $r->supervx;
        $a[$r->mes]['m'][$r->suc]['tipo2'] = $r->tipo2;
        $a[$r->mes]['m'][$r->suc]['imagen'] = $r->tipox;
        $a[$r->mes]['m'][$r->suc]['suc']= $r->suc;
        $a[$r->mes]['m'][$r->suc]['sucx'] = $r->sucx;
        $a[$r->mes]['m'][$r->suc]['num_dias'] = $r->num_dias;
        $a[$r->mes]['m'][$r->suc]['credito'] = $r->credito;
        $a[$r->mes]['m'][$r->suc]['recarga'] = $r->recarga;
        $a[$r->mes]['m'][$r->suc]['contado'] = $r->contado;
        }

     return $a;  
    }
 
 
         

}
