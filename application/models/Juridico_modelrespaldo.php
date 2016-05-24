<?php
class Juridico_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
 
    function genera_renta($aaa,$mes,$t_cambio)
    {
    $s0="select *frm juridico.rentas_c where aaa=$aaa and mes=$mes";
    $q0=$this->db->query($s0);
    if($q0->num_rows()==0)
    {
    $a=array('aaa'=>$aaa, 'mes'=>$mes, 'tipo_cambio'=>$t_cambio,'id_user'=>$id_user);
    $this->db->insert('juridico.rentas_c',$a);
    $id_renta=$this->db->insert_id();  
    $s1="insert into rentas_d
        (id_renta, pago, tipo_pago, tipo_local, cia, farmacia, suc, auxi, rfc, nom, imp, iva, isr, iva_isr, imp_cedular, incremento, redondeo, diferencia,  observacion,contrato)
        (
        select $id_renta,a.pago,a.tipo_pago,tipo_local,b.cia,b.tipo3,a.suc, a.auxi, a.rfc, a.nom, a.imp, a.iva, a.isr, a.iva_isr, a.imp_cedular,a.incremento,a.redondeo,diferencia,a.observacion,a.contrato
        from catalogo.cat_beneficiario a
        join catalogo.sucursal b on a.suc=b.suc
        where a.activo=1)";
    $this->db->query($s1);
    }
    }
 
 function delete_member($id_renta)
{
        $this->db->delete('juridico_rentas_c', array('id_renta' => $id_renta));
        $this->db->delete('juridico_rentas_d', array('id_renta' => $id_renta));

} 



    public function rentas()
    {
    $aaa=date('Y');
        $s = "SELECT tlid,a.*,b.nombre as sucx, c.nombre as contador, a.imp,
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
left join desarrollo.usuarios c on b.user_id=c.id
where a.activo=1
order by a.suc";
        $q = $this->db->query($s);
     return $q;  
    }
public function rentas_suc_cerradas()
    {
    $aaa=date('Y');
        $s = "SELECT tlid,a.*,concat(trim(b.nombre),fecha_act) as sucx, c.nombre as contador, a.imp,
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
left join desarrollo.usuarios c on b.user_id=c.id
where a.activo=1 and tlid=4 or  a.activo=1 and fecha_act<>'0000-00-00'
order by a.suc";
        $q = $this->db->query($s);
     return $q;  
    }




























function rentas_propias_mn($nu)
{
if($nu==1){$agrupa='b.cia,a.rfc';}else{$agrupa='a.rfc';}    
$s="SELECT $nu as nu,
case when a.suc=0 and a.num=1 then 0 when a.num=2 then 0 else b.cia end as cia,

case when a.suc=0 and a.num=1 then a.nom when a.num=2 then a.nom else c.razon end as razon,

a.*,b.nombre as sucx, sum(a.imp)as imp, count(a.suc)as num,
     sum(imp*a.iva)as ivaf,sum(imp*(isr/100))as isrf,sum(imp*(iva_isr/100))as iva_isrf,
     sum(case when pago='MN'
then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
sum(case when pago='USD'
then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd
FROM catalogo.cat_beneficiario_dueno a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.compa c on c.cia=b.cia
where
a.num=$nu and pago='MN'
group by $agrupa;
";
$q=$this->db->query($s);
return $q;    
}
function rentas_propias_usd($nu)
{
$s="SELECT $nu as nu,case when a.suc=0 then 0 else b.cia end as cia,
case when a.suc=0 then a.nom else c.razon end as razon,a.*,b.nombre as sucx, sum(a.imp)as imp, count(a.suc)as num,
     sum(imp*a.iva)as ivaf,sum(imp*(isr/100))as isrf,sum(imp*(iva_isr/100))as iva_isrf,
     sum(case when pago='MN'
then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
sum(case when pago='USD'
then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd
FROM catalogo.cat_beneficiario_dueno a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.compa c on c.cia=b.cia
where
a.num=$nu and pago='USD'
group by b.cia,a.rfc
";
$q=$this->db->query($s);
return $q;    
}

function rentas_propias_cia($cia,$rfc,$nu)
{
if($cia>0){$where="b.cia=$cia and num=$nu";}else{$where="a.rfc='$rfc' and num=$nu";;}
$s="SELECT case when tipo2='F' then 'FENIX' when tipo2='G' then 'GENERICOS' when tipo2='D' then 'DDR' else ' ' end as tipo2x,
a.*,b.nombre as sucx, c.nombre as contador, a.imp,
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

FROM catalogo.cat_beneficiario_dueno a
left join catalogo.sucursal b on b.suc=a.suc
left join desarrollo.usuarios c on b.user_id=c.id
where
$where
order by a.suc";


$q=$this->db->query($s);

return $q;    
}
//////////////////////////////////////////////////////////////////////////////////////lic_marysol gonzalez
function genera_rentas_dueno_sumit($fec)
{
$s="insert into oficinas.rentas_dueno(suc, auxi, rfc, nom, imp, iva, isr, iva_isr, imp_cedular, tipo, id_con, id_user,  activo, pago, fecha, contrato, redondeo, incremento, aplico_incr, fecha_incre, fecha_termino, tipo_pago, diferencia, cierre, entrega_local, expediente, motivo_cierre, observacion, num, fecha_m, fecha_g)
(select suc, auxi, rfc, nom, imp, iva, isr, iva_isr, imp_cedular, tipo, id_con, id_user,  activo, pago, fecha, contrato, redondeo, incremento, aplico_incr, fecha_incre, fecha_termino, tipo_pago, diferencia, cierre, entrega_local, expediente, motivo_cierre, observacion, num, '$fec', date(now()) from catalogo.cat_beneficiario_dueno)";
$this->db->query($s);    
}



function rentas_propias_grupo($fecha,$nu,$pago)
{
if($nu==1){$agrupa='b.cia,a.rfc';}else{$agrupa='a.rfc';}    
$s="SELECT a.num as nu,
case when a.suc=0 and a.num=1 then 0 when a.num=2 then 0 else b.cia end as cia,
case when a.suc=0 and a.num=1 then a.nom when a.num=2 then a.nom else c.razon end as razon,

sum(case when pago='MN' and ref_bancaria<>' '
then case when a.auxi=7004  then imp+(imp*a.iva) when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo end else 0 end) as mnpago,
sum(case when pago='MN' and ref_bancaria=' '
then case when a.auxi=7004  then imp+(imp*a.iva) when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo end else 0 end) as mndeuda,

sum(case when pago='USD'  and ref_bancaria<>' '
then case when a.auxi=7004  then imp+(imp*a.iva) when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo end else 0 end) as usdpago,
sum(case when pago='USD'  and ref_bancaria=' '
then case when a.auxi=7004  then imp+(imp*a.iva) when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo end else 0 end) as usddeuda,

a.*,b.nombre as sucx, sum(a.imp)as imp, count(a.suc)as num,
     sum(imp*a.iva)as ivaf,sum(imp*(isr/100))as isrf,sum(imp*(iva_isr/100))as iva_isrf,
     sum(case when pago='MN'
then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
sum(case when pago='USD'
then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd
FROM oficinas.rentas_dueno a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.compa c on c.cia=b.cia
where
a.num=$nu and pago='$pago' and fecha_m='$fecha'
group by $agrupa;
";
$q=$this->db->query($s);
return $q;    
}
function rentas_propias_grupo_cia($cia,$rfc,$nu,$fecha,$pago)
{
if($cia>0){$where="b.cia=$cia and num=$nu and a.fecha_m='$fecha' and a.pago='$pago'";}else
{$where=" a.rfc='$rfc' and num=$nu and a.fecha_m='$fecha' and a.pago='$pago'";}
$s="SELECT ref_bancaria, a.contrato,a.fecha_termino,a.pago,a.fecha_m,case when tipo2='F' then 'FENIX' when tipo2='G' then 'GENERICOS' when tipo2='D' then 'DDR' else ' ' end as tipo2x,

(case when pago='MN' and ref_bancaria<>' '
then case when a.auxi=7004  then imp+(imp*a.iva) when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo end else 0 end) as mnpago,
(case when pago='MN' and ref_bancaria=' '
then case when a.auxi=7004  then imp+(imp*a.iva) when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo end else 0 end) as mndeuda,

(case when pago='USD'  and ref_bancaria<>' '
then case when a.auxi=7004  then imp+(imp*a.iva) when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo end else 0 end) as usdpago,
(case when pago='USD'  and ref_bancaria=' '
then case when a.auxi=7004  then imp+(imp*a.iva) when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo end else 0 end) as usddeuda,

a.*,b.nombre as sucx, c.nombre as contador, a.imp,
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

FROM oficinas.rentas_dueno a
left join catalogo.sucursal b on b.suc=a.suc
left join desarrollo.usuarios c on b.user_id=c.id
where
$where
order by a.suc";


$q=$this->db->query($s);

return $q;    
}

function rentas_propias_grupo_cia_pago($id)
{

$s="SELECT a.contrato,a.fecha_termino,a.pago,a.fecha_m,case when tipo2='F' then 'FENIX' when tipo2='G' then 'GENERICOS' when tipo2='D' then 'DDR' else ' ' end as tipo2x,
a.*,b.nombre as sucx, c.nombre as contador, a.imp,
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

FROM oficinas.rentas_dueno a
left join catalogo.sucursal b on b.suc=a.suc
left join desarrollo.usuarios c on b.user_id=c.id
where a.id=$id
order by a.suc";


$q=$this->db->query($s);

return $q;    
}
//////////////////////////////////////////////////////////////////////////////////////////Lic. Marysol
function rentas_dueno_his_aaa()
{
$s="SELECT year(a.fecha_m)as aaa,
sum(case when pago='MN'
then
case when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end else 0 end) as totalmn,
sum(case when pago='USD'
then
case when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end else 0 end) as totalusd
FROM oficinas.rentas_dueno a
group by year(a.fecha_m)";
$q=$this->db->query($s);
return $q;    
}
function rentas_dueno_his_mes($aaa)
{
$s="SELECT year(a.fecha_m)as aaa,month(a.fecha_m)as mes,b.mes as mesx,
sum(case when pago='MN'
then
case when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end else 0 end) as totalmn,
sum(case when pago='USD'
then
case when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end else 0 end) as totalusd
FROM oficinas.rentas_dueno a
join catalogo.mes b on b.num=month(a.fecha_m)
where year(fecha_m)=$aaa
group by year(a.fecha_m),month(a.fecha_m)";
$q=$this->db->query($s);
return $q;    
}
function rentas_dueno_his_det($aaa,$mes)
{
$s="SELECT c.nombre as sucx, a.*,year(a.fecha_m)as aaa,month(a.fecha_m)as mes,b.mes as mesx,
(case when pago='MN'
then
case when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end else 0 end) as totalmn,
(case when pago='USD'
then
case when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end else 0 end) as totalusd
FROM oficinas.rentas_dueno a
join catalogo.mes b on b.num=month(a.fecha_m)
join catalogo.sucursal c on c.suc=a.suc
where year(fecha_m)=$aaa and month(a.fecha_m)=$mes and 
";
$q=$this->db->query($s);
return $q;    
}
//////////////////////////////////////////////////////////////////////////////////////////Contadores
function rentas_dueno_his_f()
{
$id_f=$this->session->userdata('id_plaza');
$s="SELECT year(a.fecha_m)as aaa,
sum(case when pago='MN'
then
case when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end else 0 end) as totalmn,
sum(case when pago='USD'
then
case when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end else 0 end) as totalusd
FROM oficinas.rentas_dueno a where a.num=$id_f
group by year(a.fecha_m)";
$q=$this->db->query($s);
return $q;    
}
function rentas_propias_mes($aaa)
{
$id_f=$this->session->userdata('id_plaza');
$s="SELECT d.mes as mesx, a.num ,case when a.num=1 then concat('LOCALES PROPIOS EN ',a.pago) else concat('INMOBILIARIAS EN ',a.pago) end as razon,a.*,b.nombre as sucx, sum(a.imp)as imp, count(a.suc)as local,
sum(case when pago='MN' and ref_bancaria<>' '
then case when a.auxi=7004  then imp+(imp*a.iva) when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo end else 0 end) as mnpago,
sum(case when pago='MN' and ref_bancaria=' '
then case when a.auxi=7004  then imp+(imp*a.iva) when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo end else 0 end) as mndeuda,
sum(case when pago='USD'  and ref_bancaria<>' '
then case when a.auxi=7004  then imp+(imp*a.iva) when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo end else 0 end) as usdpago,
sum(case when pago='USD'  and ref_bancaria=' '
then case when a.auxi=7004  then imp+(imp*a.iva) when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo end else 0 end) as usddeuda,

sum(imp*a.iva)as ivaf,sum(imp*(isr/100))as isrf,sum(imp*(iva_isr/100))as iva_isrf,
sum(case when pago='MN'
then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
sum(case when pago='USD'
then
case
when a.auxi=7004  then imp+(imp*a.iva)
when a.auxi=7003  then imp+(imp*a.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd
FROM oficinas.rentas_dueno a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.compa c on c.cia=b.cia
left join catalogo.mes d on d.num=month(a.fecha_m)
where year(fecha_m)=$aaa and a.num=$id_f
group by a.fecha_m,a.num,a.pago
";
$q=$this->db->query($s);
return $q;    
}





















 
 
         

}
