<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nomina extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            //redirect('landing');
        }

    }

    function index()
    {
        $file_handle = fopen("./nomina/EJEMPLOMANEJOQUINCENA23.TXT", "r");
        while (!feof($file_handle)) {
            $line = fgets($file_handle);
            
            if(substr($line, 0, 13) == "]Comprobante]")
            {
                //echo $line."<br /><br />";
                
                $comprobante = explode("]", $line);
                
                echo "<pre>";
                print_r($comprobante);
                echo "</pre>";
                
            }
            
            if(substr($line, 0, 8) == "]Nomina]")
            {
                //echo $line."<br /><br />";
                
                $nomina = explode("]", $line);
                
                echo "<pre>";
                print_r($nomina);
                echo "</pre>";
                
            }
            
            
        }
        fclose($file_handle);
    }

}
