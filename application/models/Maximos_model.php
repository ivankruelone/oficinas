<?php
class Maximos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function getPeriodos()
    {
        $query = $this->db->get('vtadc.temp_maximos_periodo');
        return $query;
    }
    
    function getDatos($suc)
    {
        $sql = "SELECT suc, secuencia, ceil(sum(cantidad)/3) as maximo
FROM vtadc.temp_desplazamiento t
where suc = ?
group by suc, secuencia
order by suc, secuencia;";

        $query = $this->db->query($sql, $suc);
        
        return $query;
    }
    
    function getSucursales()
    {
        $sql = "SELECT suc FROM vtadc.temp_desplazamiento where suc >= 813 group by suc;";
        $query = $this->db->query($sql);
        return $query;
    }

    function generarTablas($perini, $perfin)
    {
        $this->load->dbforge();
        
        
        $sql_dias = "select datediff('$perfin', '$perini') + 1 as dias";
        $query_dias = $this->db->query($sql_dias);
        $row_dias = $query_dias->row();
        
        $this->dbforge->drop_table('catalogo.temp_productos');
        $this->db->query('create table catalogo.temp_productos as SELECT codigo, sec as secuencia , susa1 as sustancia FROM catalogo.almacen a where sec > 0 and sec <= 2000  and codigo > 0 group by codigo;');
        
        $this->db->query("ALTER TABLE `catalogo`.`temp_productos` ADD PRIMARY KEY (`codigo`),
 ADD INDEX `index_2`(`secuencia`);");
        
        $this->dbforge->drop_table('vtadc.temp_desplazamiento');
        
        $sql_create_desplazamiento = "create table vtadc.temp_desplazamiento as SELECT suc, fecha, secuencia, sum(can) as cantidad, sustancia
FROM vtadc.venta_detalle v, catalogo.temp_productos p
where v.codigo = p.codigo and fecha between '$perini' and '$perfin'
group by suc, fecha, secuencia;
";
        $this->db->query($sql_create_desplazamiento);
        
        $this->db->query("ALTER TABLE `vtadc`.`temp_desplazamiento` ADD PRIMARY KEY (`suc`, `fecha`, `secuencia`);
");
        
        $this->dbforge->drop_table('vtadc.temp_maximo');
        
        $sql_create_maximos = "create table vtadc.temp_maximo as SELECT suc, secuencia, (count(*)/$row_dias->dias) * 100 as porcentaje_venta, 0 as maximo FROM vtadc.temp_desplazamiento t group by suc, secuencia;";
        $this->db->query($sql_create_maximos);
        
        
        $this->db->query("ALTER TABLE `vtadc`.`temp_maximo` ADD PRIMARY KEY (`suc`, `secuencia`);");
        
    }
    
    function generaIndice()
    {
        $this->db->query("ALTER TABLE `vtadc`.`temp_maximo` ADD PRIMARY KEY (`suc`, `secuencia`);");
    } 

}
