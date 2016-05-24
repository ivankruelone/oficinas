<?php
class Ivan_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function insertaComprasBackOffice($file)
    {
        $sql = "LOAD DATA INFILE ? IGNORE INTO TABLE vtadc.gc_compra_det_back FIELDS TERMINATED by '||' LINES TERMINATED BY '\r\n' (suc, prv, fecha, @factura, importe) SET factura = CONVERT(replace(trim(@factura), '\t', '') USING Latin1);";
        $this->db->query($sql, $file);
    }

    function insertaDevolucionesBackOffice($file)
    {
        $sql = "LOAD DATA INFILE ? IGNORE INTO TABLE vtadc.gc_compra_dev_back FIELDS TERMINATED by '||' LINES TERMINATED BY '\r\n' (suc, prv, fecha, @factura, importe) SET factura = CONVERT(replace(trim(@factura), '\t', '') USING Latin1);";
        $this->db->query($sql, $file);
    }

    function countDB($database)
    {
        $LI = $this->load->database('li', TRUE);
        $sql_borra = "delete from oficinas.registros_reales where base = ?";
        $LI->query($sql_borra, $database);
        
        $sql = "CALL oficinas.all_tables_rowcount(?);";
        $LI->query($sql, $database, FALSE);
        
        $sql2 = "insert into oficinas.registros_reales (SELECT ?, TableName, RowCount FROM oficinas.tablecounts t);";
        $this->db->query($sql2, $database);
    }
    
    function getAllDB()
    {
        $this->load->dbutil();
        $dbs = $this->dbutil->list_databases();

        foreach ($dbs as $db)
        {
            $this->countDB($db);
        }
    }

}
