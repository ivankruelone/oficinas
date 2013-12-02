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


}
