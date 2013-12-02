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

}
