<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Licita extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('inventario_model');
        $this->load->model('Catalogos_model');
        $this->load->model('Procesos_model');
        $this->load->model('backoffice_model');
        $this->load->model('lidia_model');
        $this->load->model('licita_model');

    }
    
function subida_submit_licita()
    {
        $target_dir = "uploads/";
        $target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
        $uploadOk = 1;
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            //echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) {
                //echo "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
                $this->getFileContent($target_dir);
                
                
            } else {
                echo "No se subio el archivo";
            }
        }
        
        redirect('licita/s_licita_p');

    }


  function getFileContent($file)
    {
       

        $handle = fopen($file, "r");
        echo $file;
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                
                $row1 = explode(',', $line);
                $row1[1] = trim(str_replace(array('"', ','), array('', ''), $row1[1]));
                $row1[3] = trim(substr(str_replace(
                array('"', ',','Ü','ü','Ó','Á','É','Í','Ú','í','á','é','ó','ú',', ',',"','–','ñ','µ',';','“Y”','Ò','Ñ'),
                array( '',  '','U','u','O','A','E','I','U','i','a','e','o','u','','','','','Y','O','N'), 
                $row1[3]),0,50));
                
                $row1[4] = trim(substr(str_replace(
                array('"', ',','Ü','ü','Ó','Á','É','Í','Ú','í','á','é','ó','ú',', ',',"','–','ñ','µ',';','“Y”','Ò','Ñ'),
                array( '',  '','U','u','O','A','E','I','U','i','a','e','o','u','','','','','Y','O','N'), 
                
                $row1[4]),0,250));
                $row1[6] = trim(str_replace(array('"', ','), array('', ''), $row1[6]));
                $row1[8] = trim(str_replace(array('"', ','), array('', ''), $row1[8]));
                $row1[9] = trim(str_replace(array('"', ','), array('', ''), $row1[9]));
                
                print_r($row1[5]/1);
                $indica=trim(substr($row1[0],0,3));
                
                $min=$row1[5]/1;
                if($indica=='201' and ($row1[5]*1)==$min and $row1[5]<>null){
                
                $data = array(
                    'fecha' => $row1[0], 'contrato' => $row1[1], 'clave' => $row1[2], 'susa' => $row1[3], 'presenta' => $row1[4], 'completa' => $row1[4], 'maxi' =>$row1[5],'mini'=> $row1[6],'clagob'=> $row1[7]
                    );
                    
                  $this->db->insert('compras.licita_p', $data);
                  echo $this->db->last_query();
                }
              }
            
            ///Escribir codigo siguiente aqui
        } else {
            echo 'error opening the file.';
        } 
        fclose($handle);    
    //die();
    }


    function s_licita_p()
    {
        $data['titulo'] = "LICITACION";
        $data['q']=$this->licita_model->licita_ctl();
        $this->load->view('main', $data);
    }
    function s_licita_inserta($fecha,$contrato)
	{
        $this->licita_model->licita_inserta($fecha,$contrato);
        redirect('licita/s_licita_p');
    }
    function s_licita_inserta_coinsidencia($fecha,$contrato)
	{
        $this->licita_model->licita_inserta_coinsidencia($fecha,$contrato);
        redirect('licita/s_licita_p');
    }
    function s_licita_borrar($fecha,$contrato)
	{
        $this->licita_model->licita_borrar($fecha,$contrato);
        redirect('licita/s_licita_p');
    }  
    function s_licita_grupo($fecha,$contrato)
    {
        $data['titulo'] = "LICITACION ".$contrato." FECHA ".$fecha;
        $data['q']=$this->licita_model->licita_ctl_grupo($fecha,$contrato);
        $data['js'] = 'licita/s_licita_grupo_js';
        
        $this->load->view('main', $data);
    }
    
    function s_licita_det($fecha,$contrato,$letra)
    {
        $data['titulo'] = "Detalle de la licitacion";
        $data['q']=$this->licita_model->licita_det($fecha,$contrato,$letra);
        $data['js'] = 'licita/s_licita_det_js';
        
        $this->load->view('main', $data);
    }
    
    function actualiza_partida_d()
	{
        $id = $this->input->post('id');
        $aplica = $this->input->post('aplica');
        echo $this->licita_model->actualiza_aplicar($id, $aplica);
    }  
    
    function s_licita_aplicada($fecha,$contrato)
    {
        $data['titulo']  = "PRODUCTOS ENCONTRADOS DE LA LICITACION ".$contrato." FECHA ".$fecha;
        $data['titulo1']  = "PRODUCTOS FALTANTES DE LA LICITACION ".$contrato." FECHA ".$fecha;
        $data['fecha']   =$fecha;
        $data['contrato']=$contrato;
        $data['q']=$this->licita_model->licita_aplicada($fecha,$contrato);
        $data['q2']=$this->licita_model->licita_faltante($fecha,$contrato);
        $data['js'] = 'licita/s_licita_aplicada_js';
        
        $this->load->view('main', $data);
    }
    function s_licita_quitar($fecha,$contrato,$id_licita)
	{
        $a=array('status'=>'A');
        $this->db->where('id',$id_licita);
        $this->db->where('status','B');
        $this->db->update('compras.licita_p',$a);
        $b=array('aplica'=>0);
        $this->db->where('id_licita',$id_licita);
        $this->db->update('compras.licita_pd',$b);
        redirect('licita/s_licita_aplicada/'.$fecha.'/'.$contrato);
    }
    
    function s_licita_validacion($fecha,$contrato)
    {
    $this->licita_model->licita_validacion($fecha,$contrato);
    redirect('licita/s_licita_aplicada/'.$fecha.'/'.$contrato);    
    }
    
    function s_licita_historico()
    {
        $data['titulo'] = "LICITACIONES";
        $data['q']=$this->licita_model->licita_historico();
        $this->load->view('main', $data);
    }
    function s_licita_historico_det($fecha,$contrato)
    {
        $data['titulo'] = "LICITACION  ".$contrato." FECHA ".$fecha;
        $data['q']=$this->licita_model->licita_historico_det($fecha,$contrato);
        $data['js'] = 'licita/s_licita_historico_det_js';
        $this->load->view('main', $data);
    }
    
    
 
 
}
