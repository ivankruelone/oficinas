<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Spt extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('spt_model');
        $this->load->model('Catalogos_model');

    }

    function reporte()
    {
        $data['titulo'] = "Consulta de Medicos";
        $data['quincena'] = $this->spt_model->busca_quincena();
        $this->load->view('main', $data);
    }

    function reporte_submit()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $this->db->where('quincena', $this->input->post('quincena'));
        $query=$this->db->get('vtadc.ticket_quincena');
        $row=$query->row();
        $tipo = $this->input->post('tipo');
        $data['titulo'] = "Reporte de Consulta";
        $data['perini'] = $row->perini;
        $data['perfin'] = $row->perfin;
        $data['consultorios'] = $this->spt_model->consultorios($row->perini, $row->perfin);
        $data['s'] = $this->spt_model->consulta_recetas($row->perini, $row->perfin, $tipo);
        $data['js'] = 'spt/reporte_submit_js';
        $this->load->view('main', $data);

    }
    
    function consulta_cia($perini, $perfin, $tipo)
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['perini'] = $perini;
        $data['perfin'] = $perfin;
        $data['titulo'] = "Reporte de Consulta por Tipo de Sucursal";
        $data['s'] = $this->spt_model->consulta_recetas_cia($perini, $perfin, $tipo);
        $data['js'] = 'spt/consulta_cia_js';
        $this->load->view('main', $data);

    }
    
    function consulta_suc($perini, $perfin, $suc, $nomina)
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['perini'] = $perini;
        $data['perfin'] = $perfin;
        $data['titulo'] = "Reporte de Consulta por Sucursal";
        $data['s'] = $this->spt_model->consulta_recetas_suc($perini, $perfin, $suc, $nomina);
        $data['js'] = 'spt/consulta_suc_js';
        $this->load->view('main', $data);

    }
    
    function consulta_dia($suc, $nomina, $dia)
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        //$data['perini'] = $perini;
        $data['suc'] = $suc;
        $data['titulo'] = "Reporte de Consulta por D&iacute;a";
        $data['s'] = $this->spt_model->consulta_recetas_dia($suc, $nomina, $dia);
        $data['a'] = $this->spt_model->consulta_servicios_dia($suc, $nomina, $dia);
        $data['js'] = 'spt/consulta_dia_js';
        $this->load->view('main', $data);

    }
    
    function consulta_comparativo()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "Reporte de Consultas Comparativo";
        $data['s'] = $this->spt_model->comparativo_consultas();
        $data['js'] = 'spt/consulta_comparativo_js';
        $this->load->view('main', $data);

    }
    
    function depositos()
    {
        $data['titulo'] = "Consulta Depositos Medicos";
        $data['quincena'] = $this->spt_model->busca_quincena();
        $this->load->view('main', $data);
    }
    
    function depositos_submit()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "Depositos de Salud para Todos";
        $quincena= $this->input->post('quincena');
        $data['s'] = $this->spt_model->consulta_depositos($quincena);
        $data['js'] = 'spt/depositos_submit_js';
        $this->load->view('main', $data);

    }
    
    function ventas_reporte()
    {
        $data['mesx']=$this->Catalogos_model->busca_mes();
        $data['tit']='Comparativo de venta mensual con a&ntilde;os anteriores';
        $this->load->view('main', $data);
    }
    
    function ventas_submit()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "";
        $data['mes'] =$this->input->post('mes');
        $data['s'] = $this->spt_model->ventas_sucursal($data['mes']);
        $data['js'] = 'spt/ventas_submit_js';
        $this->load->view('main', $data);

    }
    
    function ejercicio()
    {
        $data['mesx']=$this->Catalogos_model->busca_mes();
        $data['aaax']=$this->Catalogos_model->busca_anio_pl();
        $data['tit']='Ejercicio Medico';
        $this->load->view('main', $data);
    }
    
    function ejercicio_medicos()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $mes= $this->input->post('mes');
        $aaa= $this->input->post('aaa');
        $data['mes']= $mes;
        $data['aaa']= $aaa;
        $data['s'] = $this->spt_model->ejercicio_medicos($mes, $aaa);
        $this->load->view('main', $data);
    }
    
    function reporte_mensual()
    {
        $data['mes']=$this->Catalogos_model->busca_mes();
        $data['anio']=$this->Catalogos_model->busca_anio_pl();
        $data['tit']='Reporte Mensual';
        $this->load->view('main', $data);
    }
    
    function reporte_mensual_submit()
    {
        set_time_limit(0);
        ini_set("memory_limit","-1");
        
        $anio = $this->input->post('anio');
        $mes = $this->input->post('mes');
        
        $this->spt_model->generaReporteMensual($anio, $mes);
        $this->spt_model->getExcelReporteMensual($anio, $mes);
        
        $filename = $this->uri->segment(2).'_'.date('Ymd_his').'.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                     
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
        
    }

    function codigo()
    {
        $data['titulo'] = "Consulta Seguimiento de Codigo de Vestir Medicos";
        $data['quincena'] = $this->spt_model->busca_quincena();
        $this->load->view('main', $data);
    }
    
    function codigo_medicos()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $this->db->where('quincena', $this->input->post('quincena'));
        $query=$this->db->get('vtadc.ticket_quincena');
        $row=$query->row();
        $data['perini'] = $row->perini;
        $data['perfin'] = $row->perfin;
        $data['titulo'] = "Incidencia de Medicos en Codigo de Vestir";
        $data['s'] = $this->spt_model->consulta_codigo_medicos($row->perini, $row->perfin);
        $this->load->view('main', $data);

    }
    
    function cierreQuincena($perini = "2015-11-01", $perfin = "2015-11-15")
    {
        $perini2 = $perini . " 00:00:00";
        $perfin2 = $perfin . " 23:59:59";
        
        $sql = "delete FROM vtadc.ticket_med where nomina = 0;";
        $this->db->query($sql);
        
        $sql = "update vtadc.ticket_med t, catalogo.sucursal s, vtadc.ticket_prorateo p
set t.rate = p.porcentaje
where t.suc = s.suc and s.tipo2 = p.tipo and (importe + importe1 + importe2) between monto1 and monto2 and fecha between ? and ? and concepto = 26678582";

        $query = $this->db->query($sql, array($perini2, $perfin2));
        
        $sql = "update vtadc.ticket_med t, catalogo.cat_concepto_medicos c
set impDoctor = costo * (rate / 100), impFundacion = costo - (costo * (rate / 100))
where t.concepto = c.codigo and fecha between ? and ? and concepto = 26678582;";

        $query = $this->db->query($sql, array($perini2, $perfin2));
        
        $this->creaArregloDiario($perini, $perfin);
    }
    
    function creaArregloDiario($perini = "2015-09-01", $perfin = "2015-09-15")
    {
        $perini2 = $perini . " 00:00:00";
        $perfin2 = $perfin . " 23:59:59";
        
        $sql = "SELECT date(fecha) as fechaReporte, t.nomina, c.nombre as medico, t.suc, case when matutino > 0 and vespertino = 0 then 'M' when matutino = 0 and vespertino > 0 then 'V' when matutino > 0 and vespertino > 0 then 'A' else 'I' end as turno, t.concepto, o.descripcion, count(*) as servicios, count(*) * costo as importeServicios, sum(importe+importe1+importe2) as importeTicket, avg(rate) as rate, sum(impDoctor) as impDoctor, sum(impFundacion) as impFundacion
FROM vtadc.ticket_med t
left join catalogo.cat_medicos c on t.nomina = c.nomina
left join catalogo.sucursal s on t.suc = s.suc
left join catalogo.cat_concepto_medicos o on t.concepto = o.codigo
where fecha between ? and ?
group by fechaReporte, t.nomina, t.suc, turno, t.concepto;";
        
        $query = $this->db->query($sql, array($perini2, $perfin2));
        
        $a = array();
        
        $i = 0;

        foreach($query->result() as $row)
        {
            //$indice = $i;
            $indice = $row->fechaReporte . $row->nomina . $row->suc . $row->turno;
            $indice2 = $row->fechaReporte . $row->nomina . $row->suc . $row->turno . $row->concepto;
            $a[$indice]['fecha'] = $row->fechaReporte;
            $a[$indice]['nomina'] = $row->nomina;
            $a[$indice]['medico'] = $row->medico;
            $a[$indice]['suc'] = $row->suc;
            $a[$indice]['turno'] = $row->turno;
            $a[$indice]['detalle'][$indice2]['concepto'] = $row->concepto;
            $a[$indice]['detalle'][$indice2]['descripcion'] = $row->descripcion;
            $a[$indice]['detalle'][$indice2]['servicios'] = $row->servicios;
            $a[$indice]['detalle'][$indice2]['importeServicios'] = $row->importeServicios;
            $a[$indice]['detalle'][$indice2]['importeTicket'] = $row->importeTicket;

            $a[$indice]['detalle'][$indice2]['rate'] = $row->rate;
            $a[$indice]['detalle'][$indice2]['impDoctor'] = $row->impDoctor;
            $a[$indice]['detalle'][$indice2]['impFundacion'] = $row->impFundacion;
//            $a[$indice]['detalle'][$indice2]['impDoctorGlu'] = $row->impDoctorGlu;
//            $a[$indice]['detalle'][$indice2]['impFundacionGlu'] = $row->impFundacionGlu;
            
            $i++;
        }
        
        //echo "<pre>";
        //print_r($a);
        //echo "</pre>";
        //die();
        foreach($a as $b)
        {
            
            $consultas = 0;
            $consultasImp = 0;
            $consultasTicket = 0;
            $cermedgen = 0;
            $cermedgenImp = 0;
            $cermedesc = 0;
            $cermedescImp = 0;
            $inyeccion = 0;
            $inyeccionImp = 0;
            $glucosa = 0;
            $glucosaImp = 0;
            $lavadoOti = 0;
            $lavadoOtiImp = 0;
            $lavadoOcu = 0;
            $lavadoOcuImp = 0;
            $tomapresion = 0;
            $tomapresionImp = 0;
            
            $rate = 0;
            $impDoctor = 0;
            $impFundacion = 0;
            $impDoctorGlu = 0;
            $impFundacionGlu = 0;
            
            foreach($b['detalle'] as $c){
                
                if($c['concepto'] == 26678582)
                {
                    $consultas = $c['servicios'];
                    $consultasImp = $c['importeServicios'];
                    $consultasTicket = $c['importeTicket'];
                    
                    $rate = $rate + $c['rate'];
                    $impDoctor =$impDoctor + $c['impDoctor'];
                    $impFundacion = $impFundacion + $c['impFundacion'];
                    //$impDoctorGlu = $impDoctorGlu + $c['impDoctorGlu'];
                    //$impFundacionGlu = $impFundacionGlu + $c['impFundacionGlu'];
                }

                if($c['concepto'] == 26678583)
                {
                    $cermedgen = $c['servicios'];
                    $cermedgenImp = $c['importeServicios'];
                }
                
                if($c['concepto'] == 26678584)
                {
                    $cermedesc = $c['servicios'];
                    $cermedescImp = $c['importeServicios'];
                }
                
                if($c['concepto'] == 26678585)
                {
                    $inyeccion = $c['servicios'];
                    $inyeccionImp = $c['importeServicios'];
                }
                
                if($c['concepto'] == 26678586)
                {
                    $glucosa = $c['servicios'];
                    $glucosaImp = $c['importeServicios'];
                }
                
                if($c['concepto'] == 26678587)
                {
                    $lavadoOti = $c['servicios'];
                    $lavadoOtiImp = $c['importeServicios'];
                }
                
                if($c['concepto'] == 26678588)
                {
                    $lavadoOcu = $c['servicios'];
                    $lavadoOcuImp = $c['importeServicios'];
                }
                
                if($c['concepto'] == 26678589)
                {
                    $tomapresion = $c['servicios'];
                    $tomapresionImp = $c['importeServicios'];
                }
            }
            
            
            $insert_data = array (
                'dia'=>$b['fecha'],
                'nomina'=>$b['nomina'],
                'medico'=>$b['medico'],
                'sucursal'=>$b['suc'],
                'turno'=>$b['turno'],
                'consultas'=>$consultas,
                'consultasImp'=>$consultasImp,
                'consultasTicket'=>$consultasTicket,
                'cermedgen'=>$cermedgen,
                'cermedgenImp'=>$cermedgenImp,
                'cermedesc'=>$cermedesc,
                'cermedescImp'=>$cermedescImp,
                'inyeccion'=>$inyeccion,
                'inyeccionImp'=>$inyeccionImp,
                'glucosa'=>$glucosa,
                'glucosaImp'=>$glucosaImp,
                'lavadoOti'=>$lavadoOti,
                'lavadoOtiImp'=>$lavadoOtiImp,
                'lavadoOcu'=>$lavadoOcu,
                'lavadoOcuImp'=>$lavadoOcuImp,
                'tomapresion' =>$tomapresion,
                'tomapresionImp' =>$tomapresionImp,
                
                'rate'=>$rate,
                'doctorConsultas'=>$impDoctor,
                'fundacionConsultas'=>$impFundacion,
                'doctorGlucosa'=>$impDoctorGlu,
                'fundacionGlucosa'=>$impFundacionGlu
                );
            

			$this->db->where('dia', $b['fecha']);
			$this->db->where('nomina', $b['nomina']);
			$this->db->where('medico', $b['medico']);
			$this->db->where('sucursal', $b['suc']);
			$this->db->where('turno', $b['turno']);
			
			$checkThis = $this->db->get('vtadc.ticket_concentrado');
			//echo $this->db->last_query();
			if($checkThis->num_rows() == 0){
				$this->db->insert('vtadc.ticket_concentrado', $insert_data);
            }
            //echo $this->db->last_query();
        }
        
        
        $sql = "update vtadc.ticket_concentrado set promedioTicket = ifnull(round(consultasTicket/consultas,4),0) where dia between ? and ?;";
        $this->db->query($sql, array($perini, $perfin));
        
        //$sql = "update vtadc.ticket_concentrado t, catalogo.sucursal s, vtadc.ticket_prorateo p set rate = porcentaje where t.sucursal = s.suc and t.dia between ? and ? and s.tipo2 = p.tipo and promedioTicket between monto1 and monto2;";
        //$this->db->query($sql, array($perini, $perfin));
        
        //$sql = "update vtadc.ticket_concentrado t set doctorConsultas = ifnull(consultasImp * (rate / 100), 0) where dia between ? and ?;";
        //$this->db->query($sql, array($perini, $perfin));
        
        //$sql = "update vtadc.ticket_concentrado set fundacionConsultas = ifnull(consultasImp - doctorConsultas, 0) where dia between ? and ?;";
        //$this->db->query($sql, array($perini, $perfin));
        
        $sql = "update vtadc.ticket_concentrado t set rateServicios = 50 where dia between ? and ? ;";
        $this->db->query($sql, array($perini, $perfin));
        
        $sql = "update vtadc.ticket_concentrado t set doctorServicios = ifnull((cermedgenImp + cermedescImp + inyeccionImp + tomapresionImp + lavadoOtiImp + lavadoOcuImp) * (rateServicios / 100), 0) where dia between ? and ? and rateServicios > 0"; 
        $this->db->query($sql, array($perini, $perfin));
        
        $sql = "update vtadc.ticket_concentrado t set fundacionServicios = ifnull((cermedgenImp + cermedescImp + inyeccionImp + tomapresionImp + lavadoOtiImp + lavadoOcuImp) - (doctorServicios), 0) where dia between ? and ? and rateServicios > 0";
        $this->db->query($sql, array($perini, $perfin));
        
        $sql = "update vtadc.ticket_concentrado t set fundacionServicios = ifnull((cermedgenImp + cermedescImp + inyeccionImp + tomapresionImp + lavadoOtiImp + lavadoOcuImp), 0) where rateServicios = 0 and (cermedgen + cermedesc + inyeccion + tomapresion + lavadoOti + lavadoOcu) >= 1 and dia between ? and ?";
        $this->db->query($sql, array($perini, $perfin));
        
    }
    
    function fechas()
    {
        $data['titulo'] = "Fechas";
        $data['js'] = 'spt/fechas_js';
        $this->load->view('main', $data);
    }
    
    function consultas_dia()
    {
       
        $data['titulo'] = "";
        $data['tit']='Selecciona fecha inicial, fecha final y sucursal';
        $data['suc']=$this->Catalogos_model->busca_suc_activas();
        $data['js'] = 'spt/consultas_dia_js';
        $this->load->view('main', $data);
    }
    
    public function consultas_dia_submit()
    {
        $inicio= $this->input->post('perini');
        $fin= $this->input->post('perfin');
        $suc= $this->input->post('suc');
        $data['perini']= $inicio;
        $data['perfin']= $fin;
        $data['tit']='Reporte de consultas y servicios'.$inicio.' al '.$fin;
        $data['q'] = $this->spt_model->consultas_dia_submit($inicio, $fin, $suc);
        $data['js'] = 'spt/consultas_dia_submit_js';
        $this->load->view('main', $data);
    }
    
    function consulta_meta()
    {
        ini_set('memory_limit', '2000M');
        set_time_limit(0);
        $data['titulo'] = "Meta por Sucursal";
        $data['s'] = $this->spt_model->consulta_meta();
        $data['js'] = 'spt/consulta_meta_js';
        $this->load->view('main', $data);

    }

function reporte_med_nov15()
    {
        $data['titulo'] = "Reporte Medicos Noviembre 2015";
        $data['query'] = $this->spt_model->medicos_nov15();
        $this->load->view('main', $data);
    }

function detalle_medicos_nov15($periodo)
    {
        $data['titulo'] = "Detalle Medicos Noviembre 2015";
        $data['query'] = $this->spt_model->detalle_medicos_nov15($periodo);
        $this->load->view('main', $data);
    }

}
