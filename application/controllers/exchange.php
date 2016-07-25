<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Exchange extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        $this->load->model('exchange_model');
        
        // Configure limits on our controller methods. Ensure
        // you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }

    function user_get()
    {
        if(!$this->get('id'))
        {
        	$this->response(NULL, 400);
        }

        // $user = $this->some_model->getSomething( $this->get('id') );
    	$users = array(
			1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
			2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!', array('hobbies' => array('fartings', 'bikes'))),
		);
		
    	$user = @$users[$this->get('id')];
    	
        if($user)
        {
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function orden_get()
    {
        if(!$this->get('folprv'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getOrdenByOrden_id( $this->get('folprv') );
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function ordenDetalle_get()
    {
        if(!$this->get('folprv'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getOrdenDetalleByOrden_id( $this->get('folprv') );
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function ordenDetalleCodigo_get()
    {
        if(!$this->get('folprv'))
        {
        	$this->response(NULL, 400);
        }

        if(!$this->get('codigo'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getOrdenDetalleByCodigo( $this->get('folprv'), $this->get('codigo') );
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function ordenDetalleSec_get()
    {
        if(!$this->get('folprv'))
        {
        	$this->response(NULL, 400);
        }

        if(!$this->get('sec'))
        {
        	//$this->response(NULL, 400);
            $sec = 0;
        }else{
            $sec = $this->get('sec');
        }

        $data = $this->exchange_model->getOrdenDetalleBySec( $this->get('folprv'), $sec );
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function ordenDetalleClave_get()
    {
        if(!$this->get('folprv'))
        {
        	$this->response(NULL, 400);
        }

        if(!$this->get('clave'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getOrdenDetalleByClave( $this->get('folprv'), $this->get('clave') );
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function proveedor_get()
    {
        $data = $this->exchange_model->getProveedor();
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function sucursal_get()
    {
        $data = $this->exchange_model->getSucursal();
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function articulo_get()
    {
        $data = $this->exchange_model->getArticulo();
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function articuloPatente_get()
    {
        $data = $this->exchange_model->getArticuloPatente();
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function articuloClave_get()
    {
        if(!$this->get('clave'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getArticuloByClave($this->get('clave'));
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function patente_get()
    {
        if(!$this->get('ean'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getPatenteByEAN($this->get('ean'));
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function patenteOrigen_get()
    {
        if(!$this->get('ean'))
        {
        	$this->response(NULL, 400);
        }

        if(!$this->get('origen'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getPatenteByEANOrigen($this->get('ean'), $this->get('origen'));
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function patenteSinOrigen_get()
    {
        if(!$this->get('ean'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getPatenteByEANSinOrigen($this->get('ean'));
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function patenteDescripcion_get()
    {
        if(!$this->get('descripcion'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getPatenteByDescripcion($this->get('descripcion'));
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function articuloSusa_get()
    {
        if(!$this->get('susa'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getArticuloBySusa($this->get('susa'));
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function laboratorio_get()
    {
        $data = $this->exchange_model->getLaboratorio();
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function folio_get()
    {
        if(!$this->get('foliador'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getFolio($this->get('foliador'));
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function cliente_get()
    {
        if(!$this->get('rfc'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getCliente($this->get('rfc'));
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function clienteBusca_get()
    {
        if(!$this->get('busca'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getClienteBusqueda($this->get('busca'));
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
    function ticket_get()
    {
        if(!$this->get('suc'))
        {
        	$this->response(NULL, 400);
        }

        if(!$this->get('ticket'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getTicketBySucTicket( $this->get('suc'), $this->get('ticket') );
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Not found'), 404);
        }
    } 

    function orden_post()
    {
        $json = $this->post('json');
        $arr = json_decode($json);
        
        $res = $this->exchange_model->actualizaAplicadas($arr);
        
        $this->response(array('status' => 'ok'));
    }

    function traspaso_post()
    {
        $json = $this->post('json');
        $arr = json_decode($json);
        
        $this->exchange_model->actualizaAplicadasTraspaso($arr);
        
        $this->response(array('status' => 'ok'));
    }

    function catAhorro_get()
    {

        $data = $this->exchange_model->getCatAhorro();
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Not found'), 404);
        }
    } 

    function catEmpleado_get()
    {

        $data = $this->exchange_model->getCatEmpleado();
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Not found'), 404);
        }
    } 

    function catSucursal_get()
    {

        $data = $this->exchange_model->getCatSucursal();
        
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Not found'), 404);
        }
    } 

    function catCia_get()
    {

        $data = $this->exchange_model->getCatCia();
        
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Not found'), 404);
        }
    } 

    function tarjeta_get()
    {
        if(!$this->get('codigo'))
        {
        	$this->response(NULL, 400);
        }

        $data = $this->exchange_model->getTarjetaByCodigo( (double)$this->get('codigo') );
    	
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    } 

    function transito_get()
    {
        if(!$this->get('clvsucursal'))
        {
            $this->response(NULL, 400);
        }

        $data = $this->exchange_model->getTransitoByClvsucursal( $this->get('clvsucursal') );
        
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No data'), 404);
        }
    } 

    function traspasos_validados_get()
    {
        if(!$this->get('clvsucursal'))
        {
            $this->response(NULL, 400);
        }

        $data = $this->exchange_model->getTraspasosValidadosByClvsucursal( $this->get('clvsucursal') );
        
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No data'), 404);
        }
    } 

    function transitoDetalle_get()
    {
        if(!$this->get('referencia'))
        {
            $this->response(NULL, 400);
        }

        $data = $this->exchange_model->getTransitoDetalleByReferencia( $this->get('referencia') );
        
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No data'), 404);
        }
    } 

    function transitoControl_get()
    {
        if(!$this->get('referencia'))
        {
            $this->response(NULL, 400);
        }

        $data = $this->exchange_model->getTransitoControlByReferencia( $this->get('referencia') );
        
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No data'), 404);
        }
    } 

    function getLastOrdenes_get()
    {

        $data = $this->exchange_model->getLastOrdenes();
        
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Not found'), 404);
        }
    }

    function ordenes_get()
    {
        if(!$this->get('clvsucursal'))
        {
            $this->response(NULL, 400);
        }

        $data = $this->exchange_model->getOrdenesExtendido( $this->get('clvsucursal') );
        
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No data'), 404);
        }
    }

    function getDetalleOrdenByIDOrden_get()
    {
        if(!$this->get('id_orden'))
        {
            $this->response(NULL, 400);
        }

        $data = $this->exchange_model->getDetalleOrdenByIDOrden( $this->get('id_orden') );
        
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No data'), 404);
        }
    }

    function cambiaOrdenVigencia_get()
    {
        if(!$this->get('id_orden'))
        {
            $this->response(NULL, 400);
        }

        if(!$this->get('fecha'))
        {
            $this->response(NULL, 400);
        }

        $data = $this->exchange_model->cambiaOrdenVigencia( $this->get('id_orden'), $this->get('fecha') );
        
        if($data)
        {
            $this->response($data, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'No data'), 404);
        }
    }

}