<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pruebas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        $pol = $this->load->database('polanco', TRUE);
        $query = $pol->get('ProductoFarma')->result();
        echo "<pre>";
        print_r($query);
        echo "</pre>";
    }
    
    function ags()
    {
        $ags = $this->load->database('aguascalientes', TRUE);
        
        $query = $ags->get('articulos');
        
        foreach($query->result() as $row)
        {
            echo $row->cvearticulo .  "<br />";
        }
    }

	public function act()
	{
	   echo "Hola";
       //$Ags = $this->load->database('aguascalientes', TRUE);
       //$bansefi = $this->load->database('bansefi', TRUE);
       
       //$query = $bansefi->get('articulos');
       $sql = "SELECT extract(year from f.created_at) as anio, extract(month from f.created_at) as mes, 90 as suc, cast(ean as signed) as ean_nuevo, descripcion, sum(piezas) as piezas FROM f
join d on f.id = d.f_id
join c on f.id = c.f_id
where c.rec_rfc = 'BNE820901682' and f.estatus = 'G' and f.sucur_id = 80001
group by anio, mes, ean_nuevo;";
       
       $f = $this->load->database('facturacion', TRUE);
       
       $query = $f->query($sql);
       
       $a = array();
       foreach($query->result() as $row)
       {
        $b = array(
            'aaa' => $row->anio,
            'mes' => $row->mes,
            'suc' => $row->suc,
            'codigo' => $row->ean_nuevo,
            'descri' => $row->descripcion,
            'piezas' => $row->piezas
            );
        array_push($a, $b);
       }
       
       $this->db->insert_batch('compras.clientes', $a);
       
       
       $this->db->limit('10');
       $query2 = $this->db->get('catalogo.sucursal');
       
       foreach($query2->result() as $row2)
       {
        echo $row2->suc . "<br />";
       }
	}
}

