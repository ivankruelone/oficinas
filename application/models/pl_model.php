<?php
class Pl_model extends CI_Model
{
    var $nomina = null;
    var $idEmpleado = null;

    function __construct()
    {
        parent::__construct();
        $this->nomina = $this->session->userdata('nomina');
        $this->idEmpleado = $this->getIDEmpleado();
    }
    
    function getIDEmpleado()
    {
        $this->db->select('id');
        $this->db->where('nomina', $this->nomina);
        $query = $this->db->get('catalogo.cat_empleado');
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            return $row->id;
        }
        else{
            return 0;
        }
    }
  
    public function ventas_pl($mes, $aaa)
    {
        $s="SELECT *
FROM pl.utilidadbruta u
join pl.gastoscontrolables c using(anio, mes, suc)
join pl.gastosnocontrolables n using(anio, mes, suc)
join pl.gastofinanciero f using(anio, mes, suc)
join pl.otrosingresos o using(anio, mes, suc)
join pl.ventatotal v using(anio, mes, suc)
join pl.sucursal using(suc)
where anio = ? and mes = ? and suc not in(103, 105, 107, 108, 127, 176, 177, 178, 179, 180, 187, 192)
;";
        $q=$this->db->query($s, array($aaa, $mes));
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    public function ventas_pl_suc($aaa, $mes, $suc)
    {
        $s="SELECT *
FROM pl.utilidadbruta u
join pl.gastoscontrolables c using(anio, mes, suc)
join pl.gastosnocontrolables n using(anio, mes, suc)
join pl.gastofinanciero f using(anio, mes, suc)
join pl.otrosingresos o using(anio, mes, suc)
join pl.ventatotal v using(anio, mes, suc)
join pl.sucursal using(suc)
where anio = ? and mes = ? and suc = ?
;";
        $q = $this->db->query($s, array($aaa, $mes, $suc))->row();
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
       public function ventas_pl_suc_t($aaa, $mes)
    {
        $s="SELECT anio, mes, sum(utilidadBruta) as utilidadBruta, sum(inputUtilidad) as inputUtilidad, sum(gastosControlables) as gastosControlables, sum(gastosNoControlables) as gastosNoControlables, sum(cuotaFenix) as cuotaFenix, sum(gastoFinanciero) as gastoFinanciero, sum(otrosIngresos) as otrosIngresos, sum(ventaTotal) as ventaTotal
            FROM pl.utilidadbruta u
            join pl.gastoscontrolables c using(anio, mes, suc)
            join pl.gastosnocontrolables n using(anio, mes, suc)
            join pl.gastofinanciero f using(anio, mes, suc)
            join pl.otrosingresos o using(anio, mes, suc)
            join pl.ventatotal v using(anio, mes, suc)
            join pl.sucursal using(suc)
            where anio = ? and mes = ? and suc not in(103, 105, 107, 108, 127, 176, 177, 178, 179, 180, 187, 192)
            group by mes;";
        $q = $this->db->query($s, array($aaa, $mes))->row();
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    public function consulta_suc_pl($suc, $mes, $aaa, $categoria)
    {
        $s="SELECT c.idCategoria, p.suc, p.idConcepto, c.concepto, p.observaciones, p.importe, p.input, colorDepartamento, departamento
FROM pl.pl p
left join pl.concepto c on p.idConcepto=c.idConcepto
left join pl.categoria a on c.idCategoria = a.idCategoria
left join pl.departamento d on c.idDepartamento = d.idDepartamento
where p.suc= ? and anio= ? and mes= ? and c.idCategoria = ?;";
        $q=$this->db->query($s, array($suc, $aaa, $mes, $categoria));
        //echo $this->db->last_query();
        return $q;
    }
    
    public function consulta_suc_pl_t($mes, $aaa, $categoria)
    {
        $s="SELECT c.idCategoria, p.suc, p.idConcepto, c.concepto, p.observaciones, sum(p.importe) as importe, sum(p.input) as input, colorDepartamento, departamento
FROM pl.pl p
left join pl.concepto c on p.idConcepto=c.idConcepto
left join pl.categoria a on c.idCategoria = a.idCategoria
left join pl.departamento d on c.idDepartamento = d.idDepartamento
where anio= ? and mes= ? and c.idCategoria = ? and p.suc not in(103, 105, 107, 108, 127, 176, 177, 178, 179, 180, 187, 192)
group by c.idConcepto;";
        $q=$this->db->query($s, array($aaa, $mes, $categoria));
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    public function consulta_utilidad_t($mes, $aaa)
    {
        $s="SELECT anio, mes, sum(utilidadbruta) as utilidadbruta, sum(inpututilidad) as input FROM pl.utilidadbruta where mes=$mes  and anio=$aaa and suc not in(103, 105, 107, 108, 127, 176, 177, 178, 179, 180, 187, 192) group by mes;";
        $q=$this->db->query($s, array($aaa, $mes));
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    
    public function sucursal_ventas_pl($mes, $aaa)
    {
        $s="SELECT p.suc as suc, a.nombre as nombre, observaciones, importe, input FROM pl.pl p
            left join catalogo.sucursal a on a.suc=p.suc
            where idConcepto=1 and anio=$aaa and mes=$mes";
        $q=$this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    
    public function captura_ventas_pl($suc, $mes, $aaa)
    {
        $s="SELECT idPl, c.idCategoria, p.suc, b.nombre, p.idConcepto, c.concepto, p.observaciones, p.importe, p.input
FROM pl.pl p
left join pl.concepto c on p.idConcepto=c.idConcepto
left join pl.categoria a on c.idCategoria = a.idCategoria
left join catalogo.sucursal b on b.suc=p.suc
left join pl.departamento d on c.idDepartamento = d.idDepartamento
where p.suc=$suc and anio=$aaa and mes=$mes and d.idEmpleado = $this->idEmpleado";
        $q=$this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    function getMes($idMes)
    {
        //idMes, anio, mes, fecini, fecfin
        $this->db->where('idMes', $idMes);
        $query = $this->db->get('pl.mes');
        
        return $query->row();
    }
    
    function calculaDatos($idMes)
    {
        $mes = $this->getMes($idMes);
        //idMes, anio, mes, fecini, fecfin
        $this->updateVentas($mes->anio, $mes->mes, $mes->fecini, $mes->fecfin);
        
        
    }
    
    function updateVentas($anio, $mes, $fecini, $fecfin)
    {
        

        $fa = $this->load->database('facturacion', true);
        
        $sql1="insert ignore into pl.pl (anio, mes, suc, idConcepto) (SELECT $anio, $mes, suc, idConcepto FROM catalogo.sucursales_activas s
                join pl.concepto c)";
        $this->db->query($sql1);


        $sql = "select a.suc,d.nombre, sum(corregido) as total,sum(siniva) as totalsiniva,sum(corregido)-sum(siniva) as iva
from desarrollo.cortes_c a
left join desarrollo.cortes_d b on b.id_cc=a.id
left join catalogo.lineas_cortes c on c.lin=b.clave1
left join catalogo.sucursal d on d.suc=a.suc
where fechacorte between ? and ?
and clave1 > 0 and clave1 < 49 and a.tipo > 2
group by a.suc;";

        $query = $this->db->query($sql, array($fecini, $fecfin));
        
        foreach($query->result() as $row)
        {
            $data = array('importe' => $row->total);
            $where = array(
                'anio'  => $anio,
                'mes'   => $mes,
                'suc'   => $row->suc,
                'idConcepto'  => 1
                );
            
            $this->db->update('pl.pl', $data, $where);
            echo $this->db->last_query() . "<br />";
        }
    
        $sql2 = "SELECT idConcepto, aaa, mes, suc, sum(importe) as total FROM vtadc.gasto g
                left join catalogo.cat_gastos c on c.num=g.auxi
                where aaa=$anio and mes=$mes
                group by suc, idConcepto
                order by mes, suc;"; 
                
        $query2 = $this->db->query($sql2);
        
        foreach($query2->result() as $r2)
        {
            $data = array('importe' => $r2->total);
            $where = array(
                'anio'  => $anio,
                'mes'   => $mes,
                'suc'   => $r2->suc,
                'idConcepto'  => $r2->idConcepto
                );
            
            $this->db->update('pl.pl', $data, $where);
            echo $this->db->last_query() . "<br />";
        }
    
    
        $sql3 = "SELECT idConcepto, aaa, mes, suc, imp as total FROM desarrollo.rentas r
                left join catalogo.cat_gastos c on r.auxi=c.num
                where aaa=$anio and mes=$mes;";
    
        $query3 = $this->db->query($sql3);
        
        //echo $this->db->last_query();
        
        
        foreach($query3->result() as $r3)
        {
            $data = array('importe' => $r3->total);
            $where = array(
                'anio'  => $anio,
                'mes'   => $mes,
                'suc'   => $r3->suc,
                'idConcepto'  => $r3->idConcepto
                );
            
            $this->db->update('pl.pl', $data, $where);
            echo $this->db->last_query() . "<br />";
        
        }
        
        $mesa = str_pad($mes, 2, "0", STR_PAD_LEFT);

        
        /**
 * $sql4 = "SELECT substring(n.id, 1, 4) as anio, substring(n.id, 5, 2) as mes, suc, sum(percepcionesTotalGravado + percepcionesTotalExento - deduccionesTotalGravado - deduccionesTotalExento) as nomina FROM
 *                 nomina_complemento n
 *                 join catalogo.sucursal s using(suc)
 *                 where n.id like '$anio$mesa%' and suc between 101 and 2000
 *                 group by suc
 *                 order by suc;";
 *                 
 *                 
 *                 
 *         $query4 = $fa->query($sql4);
 *         
 *         //echo $fa->last_query();
 *         
 *         foreach($query4->result() as $r4)
 *         {
 *             $data = array('importe' => $r4->nomina);
 *             $where = array(
 *                 'anio'  => $anio,
 *                 'mes'   => $mes,
 *                 'suc'   => $r4->suc,
 *                 'idConcepto'  => 9
 *                 );
 *             
 *             $this->db->update('pl.pl', $data, $where);
 *             echo $this->db->last_query() . "<br />";
 *         }
 */
        
        $sql5 = "SELECT * FROM pl.utilidad where anio=$anio and mes=$mes;";
        $query5 = $this->db->query($sql5);
        foreach($query5->result() as $r5)
        {
            $data = array('input' => $r5->utilidad);
            $where = array(
                'anio'  => $anio,
                'mes'   => $mes,
                'suc'   => $r5->suc,
                'idConcepto'  => 2
                );
            
            $this->db->update('pl.pl', $data, $where);
            echo $this->db->last_query() . "<br />";
        
        }
        //"update pl.utilidad u, pl.pl p set input = utilidad where u.anio = p.anio and u.mes = p.mes 
                //and u.suc = p.suc and p.idConcepto = 2 and p.mes = $mes and p.anio = $anio";
        
        
        $sql6 = "SELECT * FROM percepcion p where idConcepto<>9 and anio=$anio and mes=$mes";
        $query6 = $fa->query($sql6);
        echo $fa->last_query();
        foreach($query6->result() as $r6)
        {
            $data = array('importe' => $r6->percepcion);
            $where = array(
                'anio'  => $anio,
                'mes'   => $mes,
                'suc'   => $r6->suc,
                'idConcepto'  => $r6->idConcepto
                );
            
            $this->db->update('pl.pl', $data, $where);
            echo $this->db->last_query() . "<br />";
        }
        
        $sql7 = "SELECT * FROM deduccion p where idConcepto<>9 and anio=$anio and mes=$mes";
        $query7 = $fa->query($sql7);
        foreach($query7->result() as $r7)
        {
            $data = array('importe' => $r7->deduccion);
            $where = array(
                'anio'  => $anio,
                'mes'   => $mes,
                'suc'   => $r7->suc,
                'idConcepto'  => $r7->idConcepto
                );
            
            $this->db->update('pl.pl', $data, $where);
            echo $this->db->last_query() . "<br />";
        
        }
        $sql8 = "SELECT * FROM nominaFinal p where anio=$anio and mes=$mes";
        $query8 = $fa->query($sql8);
        foreach($query8->result() as $r8)
        {
            $data = array('importe' => $r8->nomina);
            $where = array(
                'anio'  => $anio,
                'mes'   => $mes,
                'suc'   => $r8->suc,
                'idConcepto'  => 9
                );
            
            $this->db->update('pl.pl', $data, $where);
            echo $this->db->last_query() . "<br />";
        }
        
        
        $sql9= "SELECT suc FROM pl.pl where anio=$anio and mes=$mes group by suc;";
        $row9= $this->db->query($sql9)->num_rows();
        
        $sql10= "SELECT total FROM cuota where anio=$anio and mes=$mes;";
        $row10= $fa->query($sql10)->row();
        
        $sql11= "update pl.pl set importe=$row10->total / $row9 where anio=$anio and mes=$mes and idConcepto=72;";
        $this->db->query($sql11);
        
        $sql12="SELECT mantenimiento+software as total FROM pl.gastos_sistemas where anio=$anio and mes=$mes;";
        $row12= $this->db->query($sql12)->row();
        
        $sql13= "update pl.pl set importe=$row12->total / $row9 where anio=$anio and mes=$mes and idConcepto=59;";
        $this->db->query($sql13);
        
        $sql14 = "SELECT * FROM pl.gastos_papeleria_compras where anio=$anio and mes=$mes;";
        $query14 = $this->db->query($sql14);
        foreach($query14->result() as $r14)
        {
            $data = array('importe' => $r14->monto);
            $where = array(
                'anio'  => $anio,
                'mes'   => $mes,
                'suc'   => $r14->suc,
                'idConcepto'  => $r14->idConcepto
                );
            
            $this->db->update('pl.pl', $data, $where);
            echo $this->db->last_query() . "<br />";
        
        }
        
        $sql15 = "SELECT anio, mes, suc, internet+internet2 as monto FROM pl.gastos_comunicaciones where anio=$anio and mes=$mes;";
        $query15 = $this->db->query($sql15);
        foreach($query15->result() as $r15)
        {
            $data = array('importe' => $r15->monto);
            $where = array(
                'anio'  => $anio,
                'mes'   => $mes,
                'suc'   => $r15->suc,
                'idConcepto'  => 28
                );
            
            $this->db->update('pl.pl', $data, $where);
            echo $this->db->last_query() . "<br />";
        
        }
        
        $sql16 = "SELECT anio, mes, suc, telefono+telefono2 as monto FROM pl.gastos_comunicaciones where anio=$anio and mes=$mes;";
        $query16 = $this->db->query($sql16);
        foreach($query16->result() as $r16)
        {
            $data = array('importe' => $r16->monto);
            $where = array(
                'anio'  => $anio,
                'mes'   => $mes,
                'suc'   => $r16->suc,
                'idConcepto'  => 27
                );
            
            $this->db->update('pl.pl', $data, $where);
            echo $this->db->last_query() . "<br />";
        
        }
        
        $sql17 = "SELECT id, suc, nomina, sum(mensual+bimestral) as monto, $anio, $mes FROM pl.sua s group by suc;";
        $query17 = $this->db->query($sql17);
        foreach($query17->result() as $r17)
        {
            $data = array('importe' => $r17->monto);
            $where = array(
                'anio'  => $anio,
                'mes'   => $mes,
                'suc'   => $r17->suc,
                'idConcepto'  => 54
                );
            
            $this->db->update('pl.pl', $data, $where);
            echo $this->db->last_query() . "<br />";
        
        }
        
    }
    
    function getNombreSucursal($suc)
    {
        $this->db->select('nombre');
        $this->db->where('suc', $suc);
        $query = $this->db->get('catalogo.sucursal');
        
        $row = $query->row();
        return $row->nombre;
    }
    




















}