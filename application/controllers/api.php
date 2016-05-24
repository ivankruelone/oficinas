<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api_model');
    }
    
    function proveedor($rfc = null)
    {
        header('Content-Type: application/json');
        echo $this->api_model->getProveedor($rfc);
    }
    
    
    function prueba()
    {
        $this->load->library('sftp');

        $config['hostname'] = 'namft.nielsen.com';
        $config['username'] = 'mft@farfenix.com';
        $config['password'] = 'iKk1Ni54';
        
        $this->sftp->connect($config);
        
        if($this->sftp->upload('./txt/pedido.txt', '/FFenix/pedido.txt', 'auto'))
        {
            
        }
        
        $this->sftp->close();
    }
}
