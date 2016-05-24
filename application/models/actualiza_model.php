<?php
$ee="SELECT concat(8,'||',rel1,'||',0,'||',1,'||',
case when lin in(5,2,9,10) then round((a.venta/1.16),2) else a.venta end,'||',
case when lin in(5,2,9,10) then round((a.venta/1.16),2) else a.venta end)
FROM cliente_banxico a, catalogo.cat_mercadotecnia b
where a.codigo=b.codigo and fecha_activo='2014-09-08' and rel1>0
group by rel1
order by rel1";






$s1="insert into vtadc.producto_mes_suc_gen(
aaa, sec, suc, descripcion,
venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12,
importe1, importe2, importe3, importe4, importe5, importe6, importe7, importe8, importe9, importe10, importe11, importe12,
costo, m2011, m2012, m2013, final)
(select year(now()),a.sec,a.suc,a.susa,
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0,
costo,m2011, m2012, m2013, final from almacen.max_sucursal a)
on duplicate key update
costo=values(costo),
m2011=values(m2011),
m2012=values(m2012),
m2013=values(m2013),
final=values(final)";



$s2="insert into vtadc.producto_sec(
aaa, sec, descripcion,
venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12,
a1, a2, a3, a4, a5, a6, a7, a8, a9, a10, a11, a12,
aa1, aa2, aa3, aa4, aa5, aa6, aa7, aa8, aa9, aa10, aa11, aa12)
(select aaa, sec, descripcion,
sum(venta1), sum(venta2), sum(venta3), sum(venta4), sum(venta5), sum(venta6),
sum(venta7),sum(venta8), sum(venta9), sum(venta10), sum(venta11), sum(venta12),
0,0,0,0,0,0,0,0,0,0,0,0,
0,0,0,0,0,0,0,0,0,0,0,0
from vtadc.producto_mes_suc_gen a where suc>100 and suc<1600 and a.aaa=date(now())
 and a.suc<>170 and a.suc<>171 and a.suc<>172 and a.suc<>173 and a.suc<>174
 and a.suc<>175 and a.suc<>176 and a.suc<>177 and a.suc<>178 and a.suc<>179
 and a.suc<>180 and a.suc<>181 and a.suc<>182 and a.suc<>183 and a.suc<>184
 and a.suc<>185 and a.suc<>186 and a.suc<>187
 group by sec)
on duplicate key update
venta1=values(venta1),
venta2=values(venta2),
venta3=values(venta3),
venta4=values(venta4),
venta5=values(venta5),
venta6=values(venta6),
venta7=values(venta7),
venta8=values(venta8),
venta9=values(venta9),
venta10=values(venta10),
venta11=values(venta11),
venta12=values(venta12)";


$ss="select b.tipo,b.succ,c.nombre,a.nomina,b.completo,sum(fal)as dias from faltante a
left join catalogo.cat_empleado b on b.nomina=a.nomina
left join catalogo.sucursal c on c.suc=b.succ
where  a.clave=613 and a.id_user=939 and a.tipo=1
group by nomina order by dias desc";


$s="update oficinas.inv_mes_suc_det set piezas=case 
when piezas in(5,7,9,16,34,28) then piezas-1 when piezas in(6,10,13,20,22) then piezas+1 else piezas end 
where suc in(593,602,857,1086,1126,1393,1415)";

$s="delete FROM oficinas.inv_mes_suc  where suc in(593,602,857,1086,1126,1393,1415)";
    


$ssx="insert ignore into oficinas.inv_mes_suc_det(aaa, mes, cia, suc, sec, clave, codigo, descri, piezas, costo, lin,tipo,dia)
(SELECT 2014,08, a.cia,a.suc,a.sec,' ',a.codigo,b.susa1,a.cantidad,
case when a.cia=13 then round((b.costo*1.20),2)else round((b.costo*1.20),2) end,b.lin,'FARMACIA',22
FROM desarrollo.inv a
left join catalogo.sucursal x on x.suc=a.suc
left join catalogo.almacen b on b.sec=a.sec
where tsuc<>'F' and a.mov=07 and a.cantidad>0 and a.suc<1600  and x.tlid=1 and a.suc=1086 and fecha_act='0000-00-00')";


$ssx="insert into oficinas.inv_mes_suc(aaa, mes, cia, suc, piezas, importe,dia,sem,tsuc)
(select a.aaa,a.mes,a.cia,a.suc,sum(a.piezas),sum(a.piezas*a.costo),a.dia,33,b.tipo2
from oficinas.inv_mes_suc_det a
left join catalogo.sucursal b on b.suc=a.suc
where  aaa=2014 and mes=08 and a.suc=1086 group by a.aaa,a.mes,a.suc)";

?>