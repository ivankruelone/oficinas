<?php
class Inventario_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    

  public function inventario()
    { $aaa=date('Y'); 
    $s="SELECT aa.*,bb.num,bb.mes,

case
when tipo='alm'
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a left join catalogo.sucursal b on b.suc=a.suc
where a.mes=bb.num  and a.suc in(100,900) and a.aaa=$aaa group by b.tipo2 )

when tipo='far'
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a left join catalogo.sucursal b on b.suc=a.suc
where a.mes=bb.num  and a.suc =1600 and a.aaa=$aaa group by b.tipo2 )

when tipo='D' or aa.tipo='G' or aa.tipo='F'
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a left join catalogo.sucursal b on b.suc=a.suc
where a.mes=bb.num  and aa.tipo=b.tipo2 and a.suc>100 and a.suc<1600 and a.aaa=$aaa 
and a.suc>100 and a.suc<1600 and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>181
and a.suc<>186 group by b.tipo2 )

when tipo='met' 
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a left join catalogo.sucursal b on b.suc=a.suc
where a.mes=bb.num  and a.aaa=$aaa and
a.suc in(100,170,171,172,173,174,175,176,177,178,179,180,181) group by b.tipo2 )

when tipo='ban' 
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a left join catalogo.sucursal b on b.suc=a.suc
where a.mes=bb.num  and a.aaa=$aaa and
a.suc =187 group by b.tipo2 )

when tipo='cht'
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a
where a.mes=bb.num  and a.suc in(16000,16900) and a.aaa=$aaa)

when tipo='agu'
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a
where a.mes=bb.num  and a.suc in(14000,14900) and a.aaa=$aaa)

when tipo='zac'
then
(select sum(importe_prvocosto) from vtadc.gc_factura_suc a
where a.mes=bb.num  and a.suc in(17000,17900) and a.aaa=$aaa)

else
0
end
as entrada,

case
when aa.tipo='D' or aa.tipo='G' or aa.tipo='F'
then (select sum(credito) from vtadc.gc_venta_mes a where aaa=$aaa and a.mes=bb.num and a.tipo2=aa.tipo 
and a.suc>100 and a.suc<1600 and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>181
and a.suc<>186
group by tipo2)
when aa.tipo='agu' or aa.tipo='ban' or aa.tipo='cht' or aa.tipo='zac' or aa.tipo='met' or aa.tipo='edo'
then (select sum(importe) from vtadc.gc_venta_clientes a where a.tipo=aa.tipo and aaa=$aaa and a.mes=bb.num
group by a.tipo)
else
0
end as credito,

case
when aa.tipo='D' or aa.tipo='G' or aa.tipo='F'
then (select sum(contado) from vtadc.gc_venta_mes a where aaa=$aaa and a.mes=bb.num and a.tipo2=aa.tipo 
and a.suc>100 and a.suc<1600 and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179 and a.suc<>180 and a.suc<>181
and a.suc<>186
group by tipo2)
else
0
end as contado


FROM catalogo.cat_inv_divicion aa,catalogo.mes bb
";
    $q=$this->db->query($s);
   
     return $q;  
    }
 
 public function entrada($tipo,$mes)
    {
 $aaa=date('Y');
$b="select *from catalogo.cat_inv_divicion where tipo='$tipo' ";
$b1=$this->db->query($b);
if($b1->num_rows()>0)
{$b2=$b1->row();
$condicion=$b2->condicion;
}
$aaa=date('Y');
    $s="select b.tipo2,b.nombre as sucx,a.*from vtadc.gc_factura_suc a 
    left join catalogo.sucursal b on a.suc=b.suc where mes=$mes and aaa=$aaa
and $condicion";

    $q=$this->db->query($s);
    return $q;
    }   

 public function entrada_suc($suc,$mes)
    {
 $aaa=date('Y');
    $s="select b.tipo2,b.nombre as sucx,a.*,c.corto as prvx from vtadc.gc_factura a 
    left join catalogo.sucursal b on a.suc=b.suc 
    left join catalogo.provedor c on c.prov=a.prv
    where mes=$mes and aaa=$aaa and a.suc=$suc";

    $q=$this->db->query($s);
    return $q;
    }


    
   
 
 
         

}
