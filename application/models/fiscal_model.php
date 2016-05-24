<?php
class fiscal_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }


function recibe_cheque()
{
 $this->__archivo('au');
 $this->__archivo('cp');
 $this->__archivo('fn');
 $this->__archivo('ma');
 $this->__archivo('mz');
 $this->__archivo('vr');
 $this->__archivo('pm');
 $this->__archivo('pn');
 $this->__archivo('se');

}

function __archivo($var)
{
if(file_exists("c:/wamp/www/subir10/paf".$var."415.txt")){
$s="delete from subir10.p_fiscal_".$var."_c";
$this->db->query($s);    
$s1="LOAD DATA INFILE 'c:/wamp/www/subir10/paf".$var."415.txt' INTO TABLE subir10.p_fiscal_".$var."_c FIELDS TERMINATED BY ';' LINES TERMINATED BY '\r\n'
(fec1, fec2, cia, ciax, cheque, @cheque_real, sub, iva, tot)set cheque_real=replace(@cheque_real,' ',0)";
$this->db->query($s1);
$s3="insert into oficinas.concilia_cheques_c(fec1, fec2, cia, ciax, cheque, cheque_real, sub, iva, tot, var)
(select fec1, fec2, cia, ciax, cheque, cheque_real, sub, iva, tot, var from subir10.p_fiscal_".$var."_c)
on duplicate key update cheque_real=values(cheque_real)";
$this->db->query($s3);

}
if(file_exists("c:/wamp/www/subir10/paf".$var."412.txt")){
$s="delete from subir10.p_fiscal_".$var."_d";
$this->db->query($s);   
$s2="LOAD DATA INFILE 'c:/wamp/www/subir10/paf".$var."412.txt' INTO TABLE subir10.p_fiscal_".$var."_d FIELDS TERMINATED BY ';' LINES TERMINATED BY '\r\n'
(fec1, fec2, cia, ciax, prv, @prvx, cheque, @cheque_real, contra, fec_entrada, fec_ven, suc, @sucx, fac, @nota, sub, iva, tot) 
set cheque_real=replace(@cheque_real,' ',0),nota=convert(cast(@nota as binary) using latin1),prvx=convert(cast(@prvx as binary) using latin1),sucx=convert(cast(@sucx as binary) using latin1)";
$this->db->query($s2);
$s3="insert into oficinas.concilia_cheques_d(fec1, fec2, cia, ciax, prv, prvx, cheque, cheque_real, contra, fec_entrada, fec_ven, suc, sucx, fac, nota, sub, iva, tot, var)
(select fec1, fec2, cia, ciax, prv, prvx, cheque, cheque_real, contra, fec_entrada, fec_ven, suc, sucx, fac, nota, sub, iva, tot, var from subir10.p_fiscal_".$var."_d)
on duplicate key update cheque_real=values(cheque_real)";
$this->db->query($s3);
}
if(file_exists("c:/wamp/www/subir10/paf".$var."41x.txt")){
$s="delete from subir10.p_fiscal_".$var."_p";
$this->db->query($s);    
$s1="LOAD DATA INFILE 'c:/wamp/www/subir10/paf".$var."41x.txt' INTO TABLE subir10.p_fiscal_".$var."_p FIELDS TERMINATED BY ';' LINES TERMINATED BY '\r\n'
(cia, suc, prv,cheque, fec_ven, cheque_real, tot, iva)";
$this->db->query($s1);
$s2="insert ignore into oficinas.concilia_cheques_partidos(cia, suc, cheque, fec_ven, cheque_real, tot, iva, var)
(select cia, suc, cheque, fec_ven, cheque_real, tot, iva, var from subir10.p_fiscal_".$var."_p)";
$this->db->query($s2);
$s3="update oficinas.concilia_cheques_c a, oficinas.concilia_cheques_partidos b
set a.partida=1
where a.cheque=b.cheque and a.var=b.var and a.partida=0";
$this->db->query($s3);
}
}



function cheques_pagados()
{
 $s = "SELECT  sum(iva)as iva, sum(tot)as total, sum(imp_cheque)as total_con
 FROM oficinas.concilia_cheques_c
";
 $q = $this->db->query($s);
 return $q;   
}
function cheques_pagados_det($fec1,$fec2)
{
 $s = "SELECT a.*,b.nombre as varx,
case when fecha_banco<>'0000-00-00' then (imp_cheque) else 0 end as total_con
 FROM oficinas.concilia_cheques_c a
 left join catalogo.cat_archivo_cxp b on b.var=a.var
where fec1='$fec1' and fec2='$fec2'
";
 $q = $this->db->query($s);
 return $q;   
}

function cheques_banco_falta()
{
 $s = "SELECT year(fecha)as aaa,month(fecha)as mes, sum(monto) as monto,
sum(imp_cxp)as imp_cxp
 FROM oficinas.concilia_cheques_banco a
where imp_cxp=0  and partido=0
and a.observa not like '%TRASPASO%' and a.rfc not like '%SCOTIAENLINEA%' and motivo='CARGO' and a.cheque not in(400,100)
and a.observa not like '%SERVICIOS%' and a.observa not like '%IMPUESTO%'
group by year(fecha),month(fecha)";
 $q = $this->db->query($s);
 return $q;   
}
function cheques_banco_partidos()
{
 $s = "SELECT a.cheque,a.tot,a.iva,
(select sum(x.monto) from oficinas.concilia_cheques_banco x where x.cheque_con=a.cheque group by x.cheque_con)estado_cuenta
FROM oficinas.concilia_cheques_c a
where a.encontrado=1 and a.partida=1
group by a.cheque";
 $q = $this->db->query($s);
 return $q;   
}

function cheques_banco_det_partida()
{
 $s="SELECT a.var,c.razon as ciax,a.cheque,a.tot as global,
 case when a.var='VR' then e.corto else d.corto end as razo,
y.cheque_real,y.iva as iva_partida,y.tot as monto_partida,
ifnull(x.cheque,0) as cheque_r,ifnull(fecha,' ') as fecha_che,ifnull(x.monto,0)as monto_banco,
b.prv,b.fec_entrada,b.fec_ven,fac,b.iva as iva_fac,b.tot as tot_fac, b.sub as sub_fac

FROM oficinas.concilia_cheques_c a
left join oficinas.concilia_cheques_partidos y on y.cheque=a.cheque
left join oficinas.concilia_cheques_banco x on x.cheque=y.cheque_real
left join oficinas.concilia_cheques_d b on b.cheque=a.cheque
left join catalogo.compa c on c.cia=a.cia
left join catalogo.provedor d on d.prov=b.prv
left join catalogo.provedorv e on e.prov=b.prv
where a.encontrado=1 and a.partida=1";
$q = $this->db->query($s);
 foreach ($q->result()as $r)
        {
        $a[$r->cheque]['cheque_con'] = $r->cheque;
        $a[$r->cheque]['var'] = $r->var;
        $a[$r->cheque]['prv'] = $r->razo;
        $a[$r->cheque]['cia_cxp'] = $r->ciax;
        $a[$r->cheque]['global'] = $r->global;
        $a[$r->cheque]['segundo'][$r->cheque_real]['cheque_real'] = $r->cheque_real;
        $a[$r->cheque]['segundo'][$r->cheque_real]['fecha_che'] = $r->fecha_che;
        $a[$r->cheque]['segundo'][$r->cheque_real]['monto_partida'] = $r->monto_partida;
        $a[$r->cheque]['segundo'][$r->cheque_real]['iva_partida'] = $r->iva_partida;
        $a[$r->cheque]['segundo'][$r->cheque_real]['monto_banco'] = $r->monto_banco;
        $a[$r->cheque]['segundo'][$r->cheque_real]['tercero'][$r->fac]['fec_entrada'] = $r->fec_entrada;
        $a[$r->cheque]['segundo'][$r->cheque_real]['tercero'][$r->fac]['fec_ven'] = $r->fec_ven;
        $a[$r->cheque]['segundo'][$r->cheque_real]['tercero'][$r->fac]['fac'] = $r->fac;
        $a[$r->cheque]['segundo'][$r->cheque_real]['tercero'][$r->fac]['sub_fac'] = $r->sub_fac;
        $a[$r->cheque]['segundo'][$r->cheque_real]['tercero'][$r->fac]['iva_fac'] = $r->iva_fac;
        $a[$r->cheque]['segundo'][$r->cheque_real]['tercero'][$r->fac]['tot_fac'] = $r->tot_fac;
        }
 return $a;  
}
function cheques_banco()
{
 $s = "SELECT year(fecha)as aaa,month(fecha)as mes, sum(monto) as monto,
sum(imp_cxp)as imp_cxp
 FROM oficinas.concilia_cheques_banco
where imp_cxp>0 and partido=0  group by year(fecha),month(fecha)";
 $q = $this->db->query($s);
 return $q;   
}
function cheques_banco_cia($aaa,$mes)
{
 $s="SELECT a.cia,year(x.fecha)as aaa,month(x.fecha)as mes, a.cia,c.razon as ciax,sum(sub)as sub,sum(iva)as iva,sum(tot)as tot
FROM oficinas.concilia_cheques_c a
join oficinas.concilia_cheques_banco x on x.cheque=a.cheque_real
join catalogo.compa c on c.cia=a.cia
where  prv_cxp>0 and a.encontrado=1 and a.partida=0 and year(x.fecha)=$aaa and month(x.fecha)=$mes
group by a.cia";
$q = $this->db->query($s);
return $q; 
}
function cheques_banco_det_cia($fil,$aaa,$mes,$cia)
{
if($fil=='n'){$f='=';}else{$f='>';}
 $s = "SELECT ifnull(e.razon,' ')as ciax,a.observa,a.fecha,a.cheque,year(a.fecha)as aaa,month(a.fecha)as mes, (a.monto) as monto,
a.imp_cxp,substr(a.rfc,4,12)as rfc,prv_cxp,a.var,iva_cxp,
case when a.var='VR' then c.razo else ifnull(b.razo,' ') end as razo,
ifnull(d.nombre,' ')as varx
FROM oficinas.concilia_cheques_banco a
left join catalogo.provedor b on b.prov=prv_cxp and a.prv_cxp>0
left join catalogo.provedorv c on c.prov=prv_cxp and a.prv_cxp>0
LEFT JOIN catalogo.cat_archivo_cxp d on d.var=a.var
left join catalogo.compa e on e.cia=a.cia_cxp 
where year(fecha)=$aaa and month(fecha)=$mes and imp_cxp".$f."0 and a.partido=0 and a.cia_cxp=$cia
and a.observa not like '%TRASPASO%' and a.rfc not like '%SCOTIAENLINEA%' and motivo='CARGO' and a.cheque not in(400,100)
and a.observa not like '%SERVICIOS%' and a.observa not like '%IMPUESTO%'
order by a.var desc,prv_cxp";
 $q = $this->db->query($s);
 return $q;   
}
function cheques_banco_prv($aaa,$mes)
{
 $s="SELECT a.var,prv_cxp,year(x.fecha)as aaa,month(x.fecha)as mes, a.cia,c.razon as ciax,sum(sub)as sub,sum(iva)as iva,sum(tot)as tot,
ifnull(case when a.var='VR' then e.corto else d.corto end,' ')as razo
FROM oficinas.concilia_cheques_c a
join oficinas.concilia_cheques_banco x on x.cheque=a.cheque_real
join catalogo.compa c on c.cia=a.cia
left join catalogo.provedor d on d.prov=x.prv_cxp
left join catalogo.provedorv e on e.prov=x.prv_cxp
where  prv_cxp>0 and a.encontrado=1 and a.partida=0 and year(x.fecha)=$aaa and month(x.fecha)=$mes
group by prv_cxp";
$q = $this->db->query($s);
return $q; 
}
function cheques_banco_det_prv($fil,$aaa,$mes,$prv,$var)
{
if($fil=='n'){$f='=';}else{$f='>';}
 $s = "SELECT ifnull(e.razon,' ')as ciax,a.observa,a.fecha,a.cheque,year(a.fecha)as aaa,month(a.fecha)as mes, (a.monto) as monto,
a.imp_cxp,substr(a.rfc,4,12)as rfc,prv_cxp,a.var,iva_cxp,
case when a.var='VR' then c.razo else ifnull(b.razo,' ') end as razo,
ifnull(d.nombre,' ')as varx
FROM oficinas.concilia_cheques_banco a
left join catalogo.provedor b on b.prov=prv_cxp and a.prv_cxp>0
left join catalogo.provedorv c on c.prov=prv_cxp and a.prv_cxp>0
LEFT JOIN catalogo.cat_archivo_cxp d on d.var=a.var
left join catalogo.compa e on e.cia=a.cia_cxp 
where year(fecha)=$aaa and month(fecha)=$mes and imp_cxp".$f."0 and a.partido=0 and a.prv_cxp=$prv and a.var='$var'
and a.observa not like '%TRASPASO%' and a.rfc not like '%SCOTIAENLINEA%' and motivo='CARGO' and a.cheque not in(400,100)
and a.observa not like '%SERVICIOS%' and a.observa not like '%IMPUESTO%'
order by a.var desc, a.cia_cxp";
 $q = $this->db->query($s);
 return $q;   
}
function cheques_banco_det_coincide($aaa,$mes)
{
 $s = "select *from oficinas.concilia_cheques_banco a
left join oficinas.concilia_cheques_c b on b.tot=a.monto
where imp_cxp=0 and rfc<>' '
and b.cheque is not null and year(fecha)=$aaa and month(fecha)=$mes
order by a.var desc,prv_cxp";
 $q = $this->db->query($s);
 return $q;   
}


function cheques_banco_det($fil,$aaa,$mes)
{
if($fil=='n'){$f='=';}else{$f='>';}
 $s = "SELECT ifnull(e.razon,' ')as ciax,a.observa,a.fecha,a.cheque,year(a.fecha)as aaa,month(a.fecha)as mes, (a.monto) as monto,
a.imp_cxp,substr(a.rfc,4,12)as rfc,prv_cxp,a.var,iva_cxp,
case when a.var='VR' then c.razo else ifnull(b.razo,' ') end as razo,
ifnull(d.nombre,' ')as varx
FROM oficinas.concilia_cheques_banco a
left join catalogo.provedor b on b.prov=prv_cxp and a.prv_cxp>0
left join catalogo.provedorv c on c.prov=prv_cxp and a.prv_cxp>0
LEFT JOIN catalogo.cat_archivo_cxp d on d.var=a.var
left join catalogo.compa e on e.cia=a.cia_cxp 
where year(fecha)=$aaa and month(fecha)=$mes and imp_cxp".$f."0 and a.partido=0
and a.observa not like '%TRASPASO%' and a.rfc not like '%SCOTIAENLINEA%' and motivo='CARGO' and a.cheque not in(400,100)
and a.observa not like '%SERVICIOS%' and a.observa not like '%IMPUESTO%'
order by a.var desc,prv_cxp";
 $q = $this->db->query($s);
 return $q;   
}












}