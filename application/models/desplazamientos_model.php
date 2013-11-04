<?php
class Desplazamientos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
  
    
function control_desplaza_suc($var,$reg)
    {
        $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
        if($var==4){$varx='A,B,C,D y E';$var0="'a','b','c','d','e'";}
$uno=date('m')-3;

$dos=date('m')-2;
$tres=date('m')-1;
$fec=date('Y-m-d');
if($uno=='01'){$uno='venta1';}
elseif($uno=='02'){$uno='venta2';}
elseif($uno=='03'){$uno='venta3';}
elseif($uno=='04'){$uno='venta4';}
elseif($uno=='05'){$uno='venta5';}
elseif($uno=='06'){$uno='venta6';}
elseif($uno=='07'){$uno='venta7';}
elseif($uno=='08'){$uno='venta8';}
elseif($uno=='09'){$uno='venta9';}
elseif($uno=='10'){$uno='venta10';}
elseif($uno=='11'){$uno='venta11';}
elseif($uno=='12'){$uno='venta12';}

if($dos=='01'){$dos='venta1';}
elseif($dos=='02'){$dos='venta2';}
elseif($dos=='03'){$dos='venta3';}
elseif($dos=='04'){$dos='venta4';}
elseif($dos=='05'){$dos='venta5';}
elseif($dos=='06'){$dos='venta6';}
elseif($dos=='07'){$dos='venta7';}
elseif($dos=='08'){$dos='venta8';}
elseif($dos=='09'){$dos='venta9';}
elseif($dos=='10'){$dos='venta10';}
elseif($dos=='11'){$dos='venta11';}
elseif($dos=='12'){$dos='venta12';}

if($tres=='01'){$tres='venta2';}
elseif($tres=='02'){$tres='venta2';}
elseif($tres=='03'){$tres='venta3';}
elseif($tres=='04'){$tres='venta4';}
elseif($tres=='05'){$tres='venta5';}
elseif($tres=='06'){$tres='venta6';}
elseif($tres=='07'){$tres='venta7';}
elseif($tres=='08'){$tres='venta8';}
elseif($tres=='09'){$tres='venta9';}
elseif($tres=='10'){$tres='venta10';}
elseif($tres=='11'){$tres='venta11';}
elseif($tres=='12'){$tres='venta12';}
         $s="select b.tipo2, a.suc,c.tipo,a.sec,c.susa,b.nombre as sucx,b.regional,
sum($uno+$dos+$tres)/(case
when sum($uno)>0 and sum($dos)>0 and sum($tres)>0 then 3
when sum($uno)=0 and sum($dos)>0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)=0 and sum($tres)>0 then 2
when sum($uno)>0 and sum($dos)>0 and sum($tres)=0 then 2
when sum($uno)=0 and sum($dos)=0 and sum($tres)>0 then 1
when sum($uno)>0 and sum($dos)=0 and sum($tres)=0 then 1
when sum($uno)=0 and sum($dos)>0 and sum($tres)=0 then 1
end)as prome,
sum(venta1)as venta1,
sum(venta2)as venta2,
sum(venta3)as venta3,
sum(venta4)as venta4,
sum(venta5)as venta5,
sum(venta6)as venta6,
sum(venta7)as venta7,
sum(venta8)as venta8,
sum(venta9)as venta9,
sum(venta10)as venta10,
sum(venta11)as venta11,
sum(venta12)as venta12
from vtadc.producto_mes_suc a
left join catalogo.sucursal b on b.suc=a.suc
left join catalogo.cat_almacen_clasifica c on c.sec=a.sec
where  
b.regional=$reg and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0) or
b.superv=$reg and a.sec>0 and a.sec<=2000 and b.tipo2<>'F' and c.tipo in($var0)
group by regional,a.suc
order by prome desc
"; 
        $q = $this->db->query($s);

return $q;        
}
function control_desplaza_suc_una($var,$suc)
    {
        if($var==1){$varx='A y B';$var0="'a','b'";}
        if($var==2){$varx='A,B y C';$var0="'a','b','c'";}
        if($var==3){$varx='A,B,C y D';$var0="'a','b','c','d'";}
        if($var==4){$varx='A,B,C,D y E';$var0="'a','b','c','d','e'";}
         $s="select a.*,
ifnull(m2013,0)as m2013,
ifnull(m2012,0)as m2012,
ifnull(m2011,0)as m2011,
ifnull(final,2)as final,
ifnull(venta1,0)as venta1,
ifnull(venta2,0)as venta2,
ifnull(venta3,0)as venta3,
ifnull(venta4,0)as venta4,
ifnull(venta5,0)as venta5,
ifnull(venta6,0)as venta6,
ifnull(venta7,0)as venta7,
ifnull(venta8,0)as venta8,
ifnull(venta9,0)as venta9,
ifnull(venta10,0)as venta10,
ifnull(venta11,0)as venta11,
ifnull(venta12,0)as venta12
from catalogo.cat_almacen_clasifica a
left join vtadc.producto_mes_suc_gen b on a.sec=b.sec  and  b.suc=$suc
where  a.tipo in($var0) 
order by final desc
"; 
        $q = $this->db->query($s);   
 return $q;   
    }




}