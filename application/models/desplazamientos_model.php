<?php
class Desplazamientos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
  
    
function control_desplaza_ab_ger_nid($var,$reg,$tit)
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
        
$num=0;
        $tabla= "
        <table cellpadding=\"3\" border=\"2\">
        <thead>
        <tr>
        <th colspan=\"19\">$tit <br />Clasificacion $varx</th>
        </tr>
        <tr>
        <th>#</th>
        <th>Farmacia</th>
        <th>Nid</th>
        <th>Sucursal</th>
        <th>Promedio de 3 meses</th>
        <th>Enero</th>
        <th>Febrero</th>
        <th>Marzo</th>
        <th>Abril</th>
        <th>Mayo</th>
        <th>Junio</th>
        <th>Julio</th>
        <th>Agosto</th>
        <th>Septiembre</th>
        <th>Octubre</th>
        <th>Noviembre</th>
        <th>Diciembre</th>
        </tr>

        </thead>
        <tbody>
        ";
        
  $pedtot=0;
        foreach($q->result() as $r)
        {
            
		$num=$num+1;
       $l1 = anchor('nacional/tabla_desplaza_t_ger_suc_nid/'.$var.'/'.$reg.'/'.$r->suc,$r->suc.'</a>', array('title' => 'Haz Click aqui para ver el detalle!', 'class' => 'encabezado'));  
            
            $tabla.="
            <tr>
            <td align=\"left\"><font color=\"orange\">".$num."</font></td>
            <td align=\"left\">".$l1."</td>
            <td align=\"left\">".$r->tipo2."</td>
             <td align=\"left\">".$r->sucx."</td>
            <td align=\"right\"><font color=\"green\">".number_format($r->prome,0)."</font></td>
            <td align=\"right\">".number_format($r->venta1,0)."</td>
            <td align=\"right\">".number_format($r->venta2,0)."</td>
            <td align=\"right\">".number_format($r->venta3,0)."</td>
            <td align=\"right\">".number_format($r->venta4,0)."</td>
            <td align=\"right\">".number_format($r->venta5,0)."</td>
            <td align=\"right\">".number_format($r->venta6,0)."</td>
            <td align=\"right\">".number_format($r->venta7,0)."</td>
            <td align=\"right\">".number_format($r->venta8,0)."</td>
            <td align=\"right\">".number_format($r->venta9,0)."</td>
            <td align=\"right\">".number_format($r->venta10,0)."</td>
            <td align=\"right\">".number_format($r->venta11,0)."</td>
            <td align=\"right\">".number_format($r->venta12,0)."</td>
            </tr>
            ";
$t1=$t1+($r->venta1);
$t2=$t2+($r->venta2);
$t3=$t3+($r->venta3);
$t4=$t4+($r->venta4);
$t5=$t5+($r->venta5);
$t6=$t6+($r->venta6);
$t7=$t7+($r->venta7);
$t8=$t8+($r->venta8);
$t9=$t9+($r->venta9);
$t10=$t10+($r->venta10);
$t11=$t11+($r->venta11);
$t12=$t12+($r->venta12);      
        }
         $tabla.="
        <tr>   
            <td align=\"right\" colspan=\"5\">TOTAL</td>
            <td align=\"right\">".number_format($t1,0)."</td>
            <td align=\"right\">".number_format($t2,0)."</td>
            <td align=\"right\">".number_format($t3,0)."</td>
            <td align=\"right\">".number_format($t4,0)."</td>
            <td align=\"right\">".number_format($t5,0)."</td>
            <td align=\"right\">".number_format($t6,0)."</td>
            <td align=\"right\">".number_format($t7,0)."</td>
            <td align=\"right\">".number_format($t8,0)."</td>
            <td align=\"right\">".number_format($t9,0)."</td>
            <td align=\"right\">".number_format($t10,0)."</td>
            <td align=\"right\">".number_format($t11,0)."</td>
            <td align=\"right\">".number_format($t12,0)."</td>
         </tr>   
        </tbody>
        </table>";
        
        echo $tabla;
    
    }
}
