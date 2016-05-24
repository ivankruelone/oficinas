<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ivan extends CI_Controller
{
    var $directorioCompras;
    var $directorioComprasBackup;
    var $directorioBackOffice;

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('ivan_model');

        $this->directorioCompras = "e:/compras/";
        $this->directorioComprasBackup = "e:/comprasbackup/";
        $this->directorioBackOffice = "e:/backofficeresp/";
        $this->load->helper('directory');
        $this->load->helper('file');
        $this->load->model('ivan_model');
    }

    function index()
    {
        $map = directory_map($this->directorioCompras);

        foreach ($map as $file) {
            $rutaIn = $this->directorioCompras . $file;
            $rutaOut = $this->directorioComprasBackup . $file;

            $a = get_file_info($rutaIn);

            if ($a['size'] == 0) {

                unlink($rutaIn);

            } else {

                $pos = strpos($file, 'DEV');

                if ($pos > 0) {

                    $this->ivan_model->insertaDevolucionesBackOffice($rutaIn);

                } else {
                    $this->ivan_model->insertaComprasBackOffice($rutaIn);
                }

                copy($rutaIn, $rutaOut);
                unlink($rutaIn);

            }

        }


    }

    function getFilesComprasFilesFromBackOfficeResp()
    {
        set_time_limit(0);
        
        $map = directory_map($this->directorioBackOffice);
        
        foreach ($map as $file) {
            
            $longitud1 = strlen($file);
            $longitud2 = strlen(str_replace('COMPRA', '', $file));
            
            
            //echo $file."<br />";
            //echo $pos."<br />";


            if ($longitud1 <> $longitud2) {
                

                $rutaIn = $this->directorioBackOffice . $file;
                $rutaOut = $this->directorioCompras . $file;

                copy($rutaIn, $rutaOut);
                unlink($rutaIn);

            }
        }
    }
    
    function cuenta()
    {
        $this->ivan_model->getAllDB();
    }
    
    function generaDB($base)
    {
        $this->ivan_model->countDB($base);
    }
    
    function checaSitio()
    {
        error_reporting(0);
        ini_set('display_errors', '0');
        echo $this->pingDomain('189.203.201.167');
    }
    
    
    private function pingDomain($domain){
        $starttime = microtime(true);
        $file      = fsockopen ($domain, 80, $errno, $errstr, 10);
        $stoptime  = microtime(true);
        $status    = 0;
    
        if (!$file) $status = -1;  // Site is down
        else {
            fclose($file);
            $status = ($stoptime - $starttime) * 1000;
            $status = floor($status);
        }
        return $status;
    }
    
    function correo()
    {
        
    }
    
    function agregaFolioNuevoAgs()
    {
        $clave = 'fto';
        
        $sql = "SELECT id FROM aguascalientes.entradas_c e where subtipo = 4 and monto > 0 and estatus = 1 and nuevof = 0 order by cerrado;";
        
        $query = $this->db->query($sql);
        
        foreach($query->result() as $row)
        {
            $this->db->where('clav', $clave);
            $query2 = $this->db->get('catalogo.foliador1');
            $row2 = $query2->row();
            
            $data = array('nuevof' => $row2->num);
            $this->db->update('aguascalientes.entradas_c', $data, array('id' => $row->id));
            
            $sql5 = "insert into catalogo.foliador1 (clav, num, obser) values ('$clave', 1, now()) on duplicate key update num=num+1;";
            $this->db->query($sql5);


        }
        
    }
    
    function agregaFolioNuevoMic()
    {
        $clave = 'fto';
        
        $sql = "SELECT id FROM michoacan.entradas_c e where subtipo = 4 and monto > 0 and estatus = 1 and nuevof = 0 order by cerrado;";
        
        $query = $this->db->query($sql);
        
        foreach($query->result() as $row)
        {
            $this->db->where('clav', $clave);
            $query2 = $this->db->get('catalogo.foliador1');
            $row2 = $query2->row();
            
            $data = array('nuevof' => $row2->num);
            $this->db->update('michoacan.entradas_c', $data, array('id' => $row->id));
            
            $sql5 = "insert into catalogo.foliador1 (clav, num, obser) values ('$clave', 1, now()) on duplicate key update num=num+1;";
            $this->db->query($sql5);


        }
        
    }
    
    function agregaFolioNuevoOax()
    {
        $clave = 'fto';
        
        $sql = "SELECT id FROM oaxaca.entradas_c e where subtipo = 4 and monto > 0 and estatus = 1 and nuevof = 0 order by cerrado;";
        
        $query = $this->db->query($sql);
        
        foreach($query->result() as $row)
        {
            $this->db->where('clav', $clave);
            $query2 = $this->db->get('catalogo.foliador1');
            $row2 = $query2->row();
            
            $data = array('nuevof' => $row2->num);
            $this->db->update('oaxaca.entradas_c', $data, array('id' => $row->id));
            
            $sql5 = "insert into catalogo.foliador1 (clav, num, obser) values ('$clave', 1, now()) on duplicate key update num=num+1;";
            $this->db->query($sql5);


        }
        
    }
    
    function agregaFolioNuevoCht()
    {
        $clave = 'fto';
        
        $sql = "SELECT id FROM chetumal.entradas_c e where subtipo = 4 and monto > 0 and estatus = 1 and nuevof = 0 order by cerrado;";
        
        $query = $this->db->query($sql);
        
        foreach($query->result() as $row)
        {
            $this->db->where('clav', $clave);
            $query2 = $this->db->get('catalogo.foliador1');
            $row2 = $query2->row();
            
            $data = array('nuevof' => $row2->num);
            $this->db->update('chetumal.entradas_c', $data, array('id' => $row->id));
            
            $sql5 = "insert into catalogo.foliador1 (clav, num, obser) values ('$clave', 1, now()) on duplicate key update num=num+1;";
            $this->db->query($sql5);


        }
        
    }

}
