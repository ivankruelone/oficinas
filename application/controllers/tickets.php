<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tickets extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('catalogos_model');

    }
    
        function captura_tickets()
    {
        $data['titulo'] = "";
        $data['empleado'] = $this->catalogos_model->busca_empleado_tickets();
        $data['areaDescripcion'] = $this->catalogos_model->busca_area_tickets();
        $data['indicadorDescripcion'] = $this->catalogos_model->busca_indicador_tickets();
        $this->load->view('main', $data);
    }
    
    function saveProducto()
    {
        $empleado = $this->input->post('empleado');
        $areaDescripcion = $this->input->post('areaDescripcion');
        $indicadorDescripcion = $this->input->post('indicadorDescripcion');
        $solicitud = $this->input->post('solicitud');
        
        echo $this->maestro_model->addTickets($empleado, $areaDescripcion, $indicadorDescripcion, $solicitud);
    }


    
}
