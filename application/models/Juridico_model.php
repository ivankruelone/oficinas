<?php
class Juridico_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
  public function un_arrendador($id)
    {
    $aaa=date('Y');
        $s = "select * from catalogo.cat_beneficiario where id=$id";
        $q = $this->db->query($s);
     return $q;  
    }  
  public function rentas()
    {
    $aaa=date('Y');
        $s = "SELECT a.grupo,a.id,case when tipo_local=1 then 'PROPIO' else 'RENTADO' end as tipo_localx,
        contrato,observacion,nom,tlid,b.suc,b.nombre as sucx,  ifnull(a.imp,0)as imp,ifnull(a.rfc,' ')as rfc,
     ifnull((imp*a.iva),0)as ivaf,ifnull((imp*(isr/100)),0)as isrf,ifnull((imp*(iva_isr/100)),0)as iva_isrf,
   (agua)as agua,

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

FROM  catalogo.sucursal b
left join catalogo.cat_beneficiario a on a.suc=b.suc
where a.fecha>=subdate(date(now()),5) and a.activo=1
order by a.suc";
        $q = $this->db->query($s);
     return $q;  
    }
public function rentas_farmacia($local)
    {
    $aaa=date('Y');
        $s = "SELECT tipo_local,c.*,sum(imp)as imp,count(*)as num,
     ifnull(sum(imp*a.iva),0)as ivaf,ifnull(sum(imp*(isr/100)),0)as isrf,ifnull(sum(imp*(iva_isr/100)),0)as iva_isrf,
    sum(agua)as agua,

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




FROM  catalogo.sucursal b
left join catalogo.cat_beneficiario a on a.suc=b.suc
left join catalogo.cat_beneficiario_grupo c on c.id=a.grupo
where  a.activo=1 and tipo_local=$local
group by a.grupo";
        $q = $this->db->query($s);
     return $q;  
    }
public function rentas_farmacia_det($grupo,$local)
    {
    $aaa=date('Y');
        $s = "SELECT a.grupo,a.id,case when tipo_local=1 then 'PROPIO' else 'RENTADO' end as tipo_localx,
        contrato,observacion,nom,tlid,b.suc,b.nombre as sucx,  ifnull(a.imp,0)as imp,ifnull(a.rfc,' ')as rfc,
     ifnull((imp*a.iva),0)as ivaf,ifnull((imp*(isr/100)),0)as isrf,ifnull((imp*(iva_isr/100)),0)as iva_isrf,(agua)as agua,


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

FROM  catalogo.sucursal b
left join catalogo.cat_beneficiario a on a.suc=b.suc
where  a.activo=1 and a.grupo=$grupo and tipo_local=$local
";
$q = $this->db->query($s);

     return $q;  
    }
public function rentas_mas2($var)
    {
    $aaa=date('Y');
        $s = "SELECT b.suc,b.nombre as sucx,
        (select count(*) from catalogo.cat_beneficiario a where activo=1 and a.suc=b.suc group by a.suc)as cuantos
FROM  catalogo.sucursal b
where (select count(*) from catalogo.cat_beneficiario a where activo=1 and a.suc=b.suc group by a.suc)>1
and tipo3 $var
";
        $q = $this->db->query($s);
     return $q;  
    }
 
 public function rentas_suc_cerradas()
    {
    $aaa=date('Y');
        $s = "SELECT grupo, case when tipo_local=1 then 'PROPIO' else 'RENTADO' end as tipo_localx,
        tlid,a.*,trim(b.nombre)as sucx,fecha_act, c.nombre as contador, a.imp,(agua)as agua,
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
where 
a.activo=1 and tlid=4 or  
a.activo=1 and fecha_act<>'0000-00-00' or 
a.activo=1 and tipo3 not in('DA','FE','FA')
order by a.id";
        $q = $this->db->query($s);
     return $q;  
    }
 /////////////////////////////////////////////////////
 function agrega_member_renta($suc,$rfc,$nom,$imp,$isr,$ivar,$icedular,$pago,$tsuc,$iva,$auxi,$redon,$contrato,
                              $incremento,$termino,$local,$grupo,$agua)
    {
        
        $id_user= $this->session->userdata('id');    
        $sql = "SELECT * FROM catalogo.cat_beneficiario where suc = $suc and auxi= $auxi and rfc='$rfc'";
        $query = $this->db->query($sql);
        if($query->num_rows() == 0){
     
   			//suc, auxi, rfc, nom, imp, iva, isr, iva_isr, imp_cedular, tipo, id_con, id_user, id, activo
            $new_member_insert_data = array(
            'suc'=>$suc,
            'auxi'=>$auxi,
            'rfc'=>strtoupper(trim($rfc)),
            'nom'=>strtoupper(trim($nom)),
            'imp'=>$imp,
            'iva'=>$iva,
            'isr'=>$isr,
            'iva_isr'=>$ivar,
            'imp_cedular'=>$icedular,
            'tipo'=>$tsuc,
            'id_user'=>$id_user,
            'pago'  =>$pago,
            'activo'=>1,
            'redondeo'=>$redon,
            'contrato'=> $contrato,
            'incremento'=> $incremento,
            'fecha_termino'=> $termino,
            'tipo_local'=>$local,
            'grupo'=>$grupo,
            'agua'=>$agua,
            'fecha'=> date('Y-m-d H:i:s')
            
            
            
		);
		
		
		$insert = $this->db->insert('catalogo.cat_beneficiario', $new_member_insert_data);
        $id_cc= $this->db->insert_id();
        return $id_cc;
        }
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 function cambio_member_renta($id,$suc,$rfc,$nom,$imp,$isr,$ivar,$icedular,$pago,$tsuc,$iva,$auxi,$redon,$contrato,$incremento,$termino,$local,$obser,$grupo,$agua)
    {
       $id_user=$this->session->userdata('id_user'); 
        $a = array(
            'suc'=>$suc,
            'auxi'=>$auxi,
            'rfc'=>strtoupper(trim($rfc)),
            'nom'=>strtoupper(trim($nom)),
            'imp'=>$imp,
            'iva'=>$iva,
            'isr'=>$isr,
            'iva_isr'=>$ivar,
            'imp_cedular'=>$icedular,
            'tipo'=>$tsuc,
            'id_user'=>$id_user,
            'pago'  =>$pago,
            'activo'=>1,
            'redondeo'=>$redon,
            'contrato'=> $contrato,
            'incremento'=> $incremento,
            'fecha_termino'=> $termino,
            'tipo_local'=>$local,
            'observacion'=>$obser,
            'grupo'=>$grupo,
            'agua'=>$agua,
            'fecha'=> date('Y-m-d H:i:s'));
		
		$this->db->where('id',$id);
		$this->db->update('catalogo.cat_beneficiario', $a);
        
    }
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
/////////////////////////////////////////////////////
 function agrega_renta_mes_det($aaa,$mes,$tcambio)
 {
       if($mes==1){$mes_ant=12;}else{$mes_ant=($mes-1);};
       $id_user=$this->session->userdata('id_user');
       $s="select *from juridico.rentas_c where aaa=$aaa and mes=$mes and activo=1 and tipo='NORMAL'";
       $q=$this->db->query($s);
       if($q->num_rows()==0)
       {
        $a = array(
            'aaa'=>$aaa,
            'mes'=>$mes,
            'tipo_cambio'=>$tcambio,
            'tipo'=>'NORMAL',
            'id_user'=>$id_user,
            'fecha_g'=> date('Y-m-d H:i:s'));
		$insert = $this->db->insert('juridico.rentas_c', $a);
        $id_renta= $this->db->insert_id();
        $s1="insert ignore into juridico.rentas_d
        (id_renta, pago, tipo_pago, tipo_local, cia, farmacia, suc, auxi, rfc, nom, imp, iva, isr, iva_isr,
        imp_cedular, incremento, redondeo, diferencia, pagado, observacion, activo, contrato,grupo,id_cat,agua)
        (select $id_renta , pago, tipo_pago, tipo_local, b.cia, b.tipo3, a.suc, a.auxi, a.rfc, nom, imp, a.iva, isr, iva_isr,
        imp_cedular, incremento, redondeo, diferencia, 0, observacion, activo, contrato,grupo,a.id,agua
        from catalogo.cat_beneficiario a
        join catalogo.sucursal b on b.suc=a.suc
        where a.activo=1 order by a.id)";
        $this->db->query($s1);
        $s="select *from juridico.rentas_c where aaa=$aaa and mes=$mes and activo=1 and tipo='INCREMENTO'";
       $q=$this->db->query($s);
       if($q->num_rows()==0)
       {
        $a = array(
            'aaa'=>$aaa,
            'mes'=>$mes,
            'tipo_cambio'=>$tcambio,
            'tipo'=>'INCREMENTO',
            'id_user'=>$id_user,
            'validar'=>1,
            'fecha_g'=> date('Y-m-d H:i:s'));
		$insert = $this->db->insert('juridico.rentas_c', $a);
        }
        
    }
  }
///////////////////////////////////////////////////// 
public function rentas_mes_previo()
    {
        $s = "SELECT a.tipo,c.mes as mesx,a.*,count(*)as arrendador,

sum(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
sum(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd

FROM juridico.rentas_c a
join juridico.rentas_d b on b.id_renta=a.id_renta
join catalogo.mes c on c.num=a.mes
where a.activo=1 and validar=0 and a.aaa>0 and a.mes>0 and tipo='NORMAL'
group by aaa,mes,tipo ";
        $q = $this->db->query($s);

return $q;
}
 ///////////////////////////////////////////////////// 
public function rentas_mes_previo_det($aaa,$mes,$id_renta)
    {
    
        $s = "SELECT  b.grupo,d.nombre as grupox,a.*,count(*)as arrendador,

sum(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
sum(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd



FROM juridico.rentas_c a
join juridico.rentas_d b on b.id_renta=a.id_renta
left join catalogo.compa c on c.cia=b.cia
join catalogo.cat_beneficiario_grupo d on d.id=b.grupo
where a.activo=1 and aaa=$aaa and mes=$mes  and tipo='NORMAL'
group by b.grupo";
        $q = $this->db->query($s);
     return $q;  
    }
public function rentas_mes_previo_det_arrendador($aaa,$mes,$id_renta)
    {
    
        $s = "SELECT b.contrato,b.cia,c.razon as ciax,a.*,b.suc,d.nombre as sucx,nom as arrendador,

(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)+agua
 as totalmn,
(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd



FROM juridico.rentas_c a
join juridico.rentas_d b on b.id_renta=a.id_renta
left join catalogo.compa c on c.cia=b.cia
left join catalogo.sucursal d on d.suc=b.suc
where a.activo=1 and aaa=$aaa and mes=$mes and a.id_renta=$id_renta and tipo_local=2
order by b.id_cat
";
        $q = $this->db->query($s);
     return $q;  
    }

  
public function rentas_mes_historico($local,$tipo)
    {
        $s = "SELECT tipo_local,c.mes as mesx,a.*,count(*)as arrendador,

sum(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
sum(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd

FROM juridico.rentas_c a
join juridico.rentas_d b on b.id_renta=a.id_renta
join catalogo.mes c on c.num=a.mes
where a.activo=1 and validar=1 and a.aaa>0 and a.mes>0 and tipo_local=$local and tipo='$tipo'
group by a.aaa,a.mes

";
        $q = $this->db->query($s);

return $q;
}
public function rentas_mes_historico_det_incr($id_cat)
    {
        $s = "SELECT a.id as id_cat,case when tipo_local=1 then 'PROPIO' else 'RENTADO' end as tipo_localx,
        contrato,observacion,nom,tlid,b.suc,b.nombre as sucx,  ifnull(a.imp,0)as imp,ifnull(a.rfc,' ')as rfc,
     ifnull((imp*a.iva),0)as ivaf,ifnull((imp*(isr/100)),0)as isrf,ifnull((imp*(iva_isr/100)),0)as iva_isrf,
   (agua)as agua,

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

FROM  catalogo.sucursal b
left join catalogo.cat_beneficiario a on a.suc=b.suc
where a.id=$id_cat
order by a.suc

";
        $q = $this->db->query($s);

return $q;
}
public function rentas_mes_historico_det_aplicado($aaa,$mes,$id_cat)
    {
        $s = "SELECT b.nom,a.tipo,case when tipo_local=1 then 'PROPIO' else 'RENTADO' end as tipo_localx,c.mes as mesx,a.*,
 ifnull(b.imp,0)as imp,ifnull(b.rfc,' ')as rfc,
 ifnull((imp*b.iva),0)as ivaf,ifnull((imp*(isr/100)),0)as isrf,ifnull((imp*(iva_isr/100)),0)as iva_isrf,
   (agua)as agua,
(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd

FROM juridico.rentas_c a
join juridico.rentas_d b on b.id_renta=a.id_renta
join catalogo.mes c on c.num=a.mes
where a.aaa=$aaa and a.mes=$mes and id_cat=$id_cat
";
$q = $this->db->query($s);

return $q;
}
public function rentas_mes_historico_Det($aaa,$mes,$local)
    {
    
        $s = "SELECT tipo_local,b.grupo,d.nombre as grupox, b.id_cat,b.suc,c.nombre as sucx,a.*,nom as arrendador,

(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd,

(SELECT
(case when pago='MN'
then
case
when bb.auxi=7004  then imp+(imp*bb.iva)
when bb.auxi=7003  then imp+(imp*bb.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn



FROM juridico.rentas_c aa
join juridico.rentas_d bb on bb.id_renta=aa.id_renta
join catalogo.sucursal cc on cc.suc=bb.suc
where a.activo=1 and aaa=$aaa and mes=$mes and tipo_local=$local and tipo='INCREMENTO' and bb.suc=b.suc)as dif


FROM juridico.rentas_c a
join juridico.rentas_d b on b.id_renta=a.id_renta
join catalogo.sucursal c on c.suc=b.suc
join catalogo.cat_beneficiario_grupo d on d.id=b.grupo
where a.activo=1 and aaa=$aaa and mes=$mes and tipo_local=$local and tipo='NORMAL'
order by b.grupo,id_cat asc";
        $q = $this->db->query($s);
     return $q;  
    }
 function add_incremento($id_cat,$aaa,$mes,$local,$monto)
 {
    $s="insert ignore into juridico.rentas_d
        (id_renta, pago, tipo_pago, tipo_local, cia, farmacia, suc, auxi, rfc, nom, imp, iva, isr, iva_isr,
        imp_cedular, incremento, redondeo, diferencia, pagado, observacion, activo, contrato,grupo,id_cat,agua)
        select c.id_renta,
 pago, tipo_pago, tipo_local, b.cia, b.tipo3, a.suc, a.auxi, a.rfc, nom, '$monto', a.iva, isr, iva_isr,
 imp_cedular, incremento, redondeo, diferencia, 0, observacion, 1, contrato,grupo,a.id,0
 from catalogo.cat_beneficiario a, catalogo.sucursal b,juridico.rentas_c c
 where
 b.suc=a.suc and c.aaa=$aaa and c.mes=$mes and c.tipo='INCREMENTO' and a.id=$id_cat";
$this->db->query($s);    
 }
 function rentas_mes_historico_imp($aaa,$mes)
 {
    $s="SELECT aaa, mes,tipo,grupo,c.nombre, case when tipo ='INCREMENTO' then 'DIFERENCIAS POR INCREMENTO DE UN MES ANTERIOR' else '' end as titulo2
FROM  juridico.rentas_c a
join juridico.rentas_d b on b.id_renta=a.id_renta
join catalogo.cat_beneficiario_grupo c on c.id=b.grupo
where aaa=$aaa and mes=$mes
group by a.id_renta,grupo";
$q=$this->db->query($s);    
 return $q;
 }
 
 
function rentas_deuda_ctl($local)
{
$s="SELECT 
(select criterio from catalogo.cat_beneficiario x where x.id= b.id_cat)as criterio,
(select y.nombre from catalogo.cat_beneficiario x join catalogo.cat_beneficiario_nivel y  on y.id=x.criterio where x.id= b.id_cat)as criteriox,
tipo_local,fecha_act,b.suc,c.nombre as sucx,b.rfc,nom, sum(case when tipo='NORMAL' then +1 else 0 end) as meses,sum(case when tipo='INCREMENTO' then +1 else 0 end) as meses1,
sum(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
sum(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd,



sum(case when pagado=2 then
(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end) else 0 end)
 as totalmn_pre,

sum(case when pagado=2 then
(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)else 0 end)
 as totalusd_pre,
(SELECT (sum(venta)-sum(costo_venta+renta+nomina+isr_nomina+insumos+dev+agua+luz+tel+otros))/count(*)
FROM oficinas.pianel_sucursal x where x.suc=b.suc group by suc)as utilidad


FROM juridico.rentas_c a
join juridico.rentas_d b on b.id_renta=a.id_renta
join catalogo.sucursal c on c.suc=b.suc
where b.pagado in(0,2) and tlid=1  and tipo_local=$local
group by b.rfc,suc
order by grupo,id_cat
";
$q=$this->db->query($s);
return $q;
}
function rentas_deuda_det($suc,$rfc,$local)
{
$s="SELECT fecha_pago,a.tipo,pagado,b.id,a.aaa,a.mes,tipo_local,fecha_act,b.suc,c.nombre as sucx,b.rfc,nom,d.mes as mesx,
(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd,



(case when pagado=2 then
(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end) else 0 end)
 as totalmn_pre,

(case when pagado=2 then
(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)else 0 end)
 as totalusd_pre

FROM juridico.rentas_c a
join juridico.rentas_d b on b.id_renta=a.id_renta
join catalogo.sucursal c on c.suc=b.suc
join catalogo.mes d on d.num=a.mes
where b.pagado in(0,2) and b.suc=$suc and b.rfc='$rfc' and tipo_local=$local
order by pagado desc,a.aaa,a.mes,tipo
";
$q=$this->db->query($s);
return $q;
}   
 function actualiza_prepago_m($id,$aplica)
    {
        
        if($aplica=='0000-00-00'){$val=0;}else{$val=2;}
        $u="update juridico.rentas_d set fecha_pago='$aplica', 
        pagado=$val where id=$id";
        $this->db->query($u);    
        return $this->calcula_prepago($id);
    }   
    
    function calcula_prepago($id)
    {
    $s="select 
    sum(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
sum(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd
    from juridico.rentas_d b
    where pagado=2";
    $q=$this->db->query($s);
    $r=$q->row();
    $todo=number_format($r->totalmn,2).'|'.number_format($r->totalusd);
    return $todo;
    }

function rentas_deuda_preimp($local)
{
$s="select observacion,tipo_local,fecha_act,b.suc,c.nombre as sucx,b.rfc,nom,
sum(case when tipo='NORMAL' then +1 else 0 end) as meses,sum(case when tipo='INCREMENTO' then +1 else 0 end) as meses1,
sum(imp)as imp,
min(a.aaa)as aaai,(select mes from catalogo.mes x where x.num=min(a.mes))as mesi,
max(a.aaa)as aaaf,(select mes from catalogo.mes x where x.num=max(a.mes))as mesf,

sum(imp*b.iva)as ivaf,sum(imp*(isr/100))as isrf,sum(imp*(iva_isr/100))as iva_isrf,
sum(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
sum(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd

FROM juridico.rentas_c a
join juridico.rentas_d b on b.id_renta=a.id_renta
join catalogo.sucursal c on c.suc=b.suc
where b.pagado in(2)  and tipo_local=$local
group by b.suc,b.rfc
order by grupo,id_cat
";
$q=$this->db->query($s);
return $q;
}

function rentas_deuda_d_observacion($suc)
{
    $s="SELECT a.*,b.nombre FROM juridico.rentas_observacion a join compras.usuarios b on b.id=a.id_user
where a.suc=$suc and a.activo=1 order by id desc";
$q=$this->db->query($s);
return $q;
}

function rentas_global()
{
    $s="select tlid,tipo3,fecha_act, b.suc,c.nombre as sucx,b.rfc,nom,max(aaa),
sum(case when tipo='NORMAL' and pagado=0 then 1 else 0 end)as deuda,
sum(case when tipo='INCREMENTO' and pagado=0 then 1 else 0 end)as deuda_incre,
sum(case when tipo='NORMAL' and pagado=1 then 1 else 0 end)as pagos,
sum(case when tipo='INCREMENTO' and pagado=1 then 1 else 0 end)as pagos_incre,
sum(case when tipo='NORMAL' and pagado=2 then 1 else 0 end)as pre_pagos,
sum(case when tipo='INCREMENTO' and pagado=2 then 1 else 0 end)as pre_pagos_incre,
sum(case when tipo='NORMAL'  then 1 else 0 end)as total_meses,
sum(case when tipo='INCREMENTO'  then 1 else 0 end)as total_incremento
FROM rentas_c a
join rentas_d b on a.id_renta=b.id_renta
left join catalogo.sucursal c on c.suc=b.suc
group by  b.suc,rfc
order by b.rfc,b.suc";
$q=$this->db->query($s);
return $q;
}










 
 
         

}
