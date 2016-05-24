<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class requisiciones extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }
        
        $this->load->model('requisiciones_model');
    }
    
    function pendientes()
    {
        $data['titulo'] = "Requisiciones";
        $data['tit']='Pendientes';
        $data['requisicion'] = $this->requisiciones_model->getRequisicionByEstatus(1);
        $data['js'] = 'requisiciones/pendientes_js';
        $this->load->view('main', $data);
    }
    
    function detalle_requisicion($requisicion)
    {
        $data['titulo'] = "Requisiciones";
        $data['tit']='Pendientes > Detalle requisicion ' . $requisicion;
        $data['query'] = $this->requisiciones_model->getDetallebyRequisicion($requisicion);
        //$data['js'] = 'backoffice/precios_js';
        $this->load->view('main', $data);
    }
    
    function aprobar_requisicion($requisicion)
    {
        $this->requisiciones_model->generaPedidoFromRequisicion($requisicion);
        redirect('requisiciones/pendientes');
    }
    
    function requisiciones_aprobadas()
    {
        $data['titulo'] = "Requisiciones";
        $data['tit']='Pendientes';
        $data['requisicion'] = $this->requisiciones_model->getRequisiciones();
        //$data['js'] = 'requisiciones/pendientes_js';
        $this->load->view('main', $data);
    }
    
    function aplicar_pago_requisicion($requisicion)
    {
        $data['titulo'] = "Requisiciones";
        $data['tit']='Aplicar pago en requisicion: ' . $requisicion;
        $data['requisicion'] = $this->requisiciones_model->getRequisicionByRequisicion($requisicion)->row();
        //$data['js'] = 'requisiciones/pendientes_js';
        $this->load->view('main', $data);
    }
    
    function submit_aplicar_pago_requisicion()
    {
        $requisicion = $this->input->post('requisicion');
        $observaciones_pago = $this->input->post('observaciones_pago');
        
        $data2 = array(
            'estatus' => 4,
            'observaciones_pago' => $observaciones_pago,
            'registro_pago' => date('Y-m-d H:i:s')
            );
        
        $where = array('requisicion' => $requisicion);
        
        $this->db->update('desarrollo.requisicion_control', $data2, $where);

        redirect('requisiciones/requisiciones_aprobadas');
    }

}
