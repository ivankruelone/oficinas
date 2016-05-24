<?php
class Spt_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
  
    
    public function consulta_recetas($perini, $perfin, $tipo)
    {
        $s="SELECT  sum(t.consultas) as consultas, sum(t.consultasImp) as consultasImp, sum(t.consultasTicket) as consultasTicket,
        sum(t.cermedgen) as cermedgen, sum(t.cermedgenImp) as cermedgenImp, sum(t.cermedesc) as cermedesc, sum(t.cermedescImp) as cermedescImp,
        sum(t.inyeccion) as inyeccion, sum(t.inyeccionImp) as inyeccionImp, sum(t.glucosa) as glucosa, sum(t.glucosaImp) as glucosaImp,
        sum(t.lavadoOti) as lavadoOti, sum(t.lavadoOtiImp) as lavadoOtiImp, sum(t.lavadoOcu) as lavadoOcu, sum(t.lavadoOcuImp) as lavadoOcuImp, sum(t.tomapresion) as tomapresion, sum(t.tomapresionImp) as tomapresionImp,
        avg(t.promedioTicket) as promedioTicket, avg (t.rate) as comision_promedio, sum(t.doctorConsultas) as doctorConsultas, sum(t.fundacionConsultas) as fundacionConsultas,
        avg(t.rateServicios) as Comision_Servicios, sum(t.doctorServicios) as doctorServicios, sum(t.fundacionServicios) as fundacionServicios,
        a.nombre as nombre, a.tipo as tipo
        FROM vtadc.ticket_concentrado t
        LEFT JOIN catalogo.sucursal c on t.sucursal=c.suc
        LEFT JOIN catalogo.cat_imagen a on c.tipo2= a.tipo
        where t.dia between ? and ?
        group by a.tipo";
        
        $q=$this->db->query($s,array($perini, $perfin));
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    public function consultorios($perini, $perfin)
    {
        $s="SELECT sucursal FROM vtadc.ticket_concentrado t where t.dia between ? and ? group by sucursal";
        
        $q=$this->db->query($s,array($perini, $perfin));
        //echo $this->db->last_query();
        //die();
        return $q->num_rows();
    }
    
    public function consulta_recetas_cia($perini, $perfin, $tipo)
    {
        $s="SELECT  c.suc, c.nombre as farmacia, t.nomina, t.medico, turno, sum(t.consultas) as consultas, sum(t.consultasImp) as consultasImp, sum(t.consultasTicket) as consultasTicket,
        sum(t.cermedgen) as cermedgen, sum(t.cermedgenImp) as cermedgenImp, sum(t.cermedesc) as cermedesc, sum(t.cermedescImp) as cermedescImp,
        sum(t.inyeccion) as inyeccion, sum(t.inyeccionImp) as inyeccionImp, sum(t.glucosa) as glucosa, sum(t.glucosaImp) as glucosaImp,
        sum(t.lavadoOti) as lavadoOti, sum(t.lavadoOtiImp) as lavadoOtiImp, sum(t.lavadoOcu) as lavadoOcu, sum(t.lavadoOcuImp) as lavadoOcuImp, sum(t.tomapresion) as tomapresion, sum(t.tomapresionImp) as tomapresionImp,
        avg(t.promedioTicket) as promedioTicket, avg (t.rate) as comision_promedio, sum(t.doctorConsultas) as doctorConsultas, sum(t.fundacionConsultas) as fundacionConsultas,
        avg(t.rateServicios) as Comision_Servicios, sum(t.doctorServicios) as doctorServicios, sum(t.fundacionServicios) as fundacionServicios,
        a.nombre, a.tipo, t.nomina
        FROM vtadc.ticket_concentrado t
        LEFT JOIN catalogo.sucursal c on t.sucursal=c.suc
        LEFT JOIN catalogo.cat_imagen a on c.tipo2= a.tipo
        where t.dia between ? and ? and a.tipo='$tipo'
        group by t.medico order by c.suc";
        $q=$this->db->query($s,array($perini, $perfin));
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    public function consulta_recetas_suc($perini, $perfin, $suc, $nomina)
    {
        $s="SELECT t.dia, c.suc, c.nombre as farmacia, t.medico, t.nomina, turno, t.consultas as consultas, t.consultasImp as consultasImp, t.consultasTicket as consultasTicket,
        t.cermedgen as cermedgen, t.cermedgenImp as cermedgenImp, t.cermedesc as cermedesc, t.cermedescImp as cermedescImp,
        t.inyeccion as inyeccion, t.inyeccionImp as inyeccionImp, t.glucosa as glucosa, t.glucosaImp as glucosaImp,
        t.lavadoOti as lavadoOti, t.lavadoOtiImp as lavadoOtiImp, t.lavadoOcu as lavadoOcu, t.lavadoOcuImp as lavadoOcuImp, t.tomapresion as tomapresion, t.tomapresionImp as tomapresionImp,
        t.promedioTicket as promedioTicket, t.rate as comision_promedio, t.doctorConsultas as doctorConsultas, t.fundacionConsultas as fundacionConsultas,
        t.rateServicios as Comision_Servicios, t.doctorServicios as doctorServicios, t.fundacionServicios as fundacionServicios 
        FROM vtadc.ticket_concentrado t
        LEFT JOIN catalogo.sucursal c on t.sucursal=c.suc
        LEFT JOIN catalogo.cat_imagen a on c.tipo2= a.tipo
        where t.dia between ? and ? and suc= ? and t.nomina = ?";
        $q=$this->db->query($s,array($perini, $perfin, $suc, $nomina));
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    public function consulta_recetas_dia($suc, $nomina, $dia)
    {
        $s="SELECT b.nomina, b.nombre, ticket, ticket1, ticket2, fecha, fechaticket, receta, importe, rate, importe1, importe2, concepto, descripcion, a.costo, impDoctor, impFundacion
        FROM vtadc.ticket_med t
        left join catalogo.cat_concepto_medicos a on a.codigo=t.concepto
        left join catalogo.cat_medicos b on t.nomina=b.nomina
        where t.suc='$suc' and t.nomina='$nomina' and fecha between  ?  and  ?  and t.concepto=26678582 order by concepto;";
        $q=$this->db->query($s,array($dia. ' 00:00:00',$dia. ' 23:59:59'));
        //echo $this->db->last_query();
        //die();
                        
        return $q;
    }
    
    public function consulta_servicios_dia($suc, $nomina, $dia)
    {
        $s="SELECT b.nomina, b.nombre, ticket, ticket1, ticket2, fecha, fechaticket, receta, importe, rate, importe1, importe2, concepto, descripcion, a.costo
        FROM vtadc.ticket_med t
        left join catalogo.cat_concepto_medicos a on a.codigo=t.concepto
        left join catalogo.cat_medicos b on t.nomina=b.nomina
        where t.suc='$suc' and t.nomina='$nomina' and fecha between  ?  and  ?  and t.concepto<>26678582 order by concepto;";
        $q=$this->db->query($s,array($dia. ' 00:00:00',$dia. ' 23:59:59'));
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    public function com($suc)
    {
        $y="SELECT t.* FROM vtadc.ticket_prorateo t
        left join catalogo.sucursal a on a.tipo2=t.tipo
        where suc=$suc;";
        $q=$this->db->query($y);
        //echo $this->db->last_query();
        //die();
        return $q;
    }

    function busca_tipo()
    {
        
        $sql = "SELECT * FROM catalogo.cat_imagen c";
        $query = $this->db->query($sql);
        
        $tipo = array();
        $tipo[0] = "Selecciona tipo de farmacia";
        
        foreach($query->result() as $row){
            $tipo[$row->tipo] = $row->nombre;
        }
        
        return $tipo;  
    }
    
    function busca_quincena()
    {
        
        $sql = "SELECT * FROM vtadc.ticket_quincena t order by quincena desc";
        $query = $this->db->query($sql);
        
        $tipo = array();
        $tipo[0] = "Selecciona Quincena";
        
        foreach($query->result() as $row){
            $quincena[$row->quincena] = $row->perini ." al ".$row->perfin;
        }
        
        return $quincena;  
    }
    
    public function comparativo_consultas()
    {
        $s="SELECT s.suc, s.nombre
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a1 where s.suc = a1.sucursal and a1.dia between '2015-01-01' and '2015-01-15'), 0) as consultas0101
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a2 where s.suc = a2.sucursal and a2.dia between '2015-01-16' and '2015-01-31'), 0) as consultas0102
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a3 where s.suc = a3.sucursal and a3.dia between '2015-02-01' and '2015-02-15'), 0) as consultas0201
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a4 where s.suc = a4.sucursal and a4.dia between '2015-02-16' and '2015-02-28'), 0) as consultas0202
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a5 where s.suc = a5.sucursal and a5.dia between '2015-03-01' and '2015-03-15'), 0) as consultas0301
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a6 where s.suc = a6.sucursal and a6.dia between '2015-03-16' and '2015-03-31'), 0) as consultas0302
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a7 where s.suc = a7.sucursal and a7.dia between '2015-04-01' and '2015-04-15'), 0) as consultas0401
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a8 where s.suc = a8.sucursal and a8.dia between '2015-04-16' and '2015-04-30'), 0) as consultas0402
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a9 where s.suc = a9.sucursal and a9.dia between '2015-05-01' and '2015-05-15'), 0) as consultas0501
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a10 where s.suc = a10.sucursal and a10.dia between '2015-05-16' and '2015-05-31'), 0) as consultas0502
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a11 where s.suc = a11.sucursal and a11.dia between '2015-06-01' and '2015-06-15'), 0) as consultas0601
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a12 where s.suc = a12.sucursal and a12.dia between '2015-06-16' and '2015-06-30'), 0) as consultas0602
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a13 where s.suc = a13.sucursal and a13.dia between '2015-07-01' and '2015-07-15'), 0) as consultas0701
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a14 where s.suc = a14.sucursal and a14.dia between '2015-07-16' and '2015-07-31'), 0) as consultas0702
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a15 where s.suc = a15.sucursal and a15.dia between '2015-08-01' and '2015-08-15'), 0) as consultas0801
,ifnull((select sum(consultas) from vtadc.ticket_concentrado a16 where s.suc = a16.sucursal and a16.dia between '2015-08-16' and '2015-08-31'), 0) as consultas0802
FROM catalogo.sucursal s
where suc between 101 and 2200 and tlid = 1 and suc not in(127, 176, 177, 178, 179, 180, 187)";
        $q=$this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
    }

public function consulta_depositos($quincena)
    {
        $s="SELECT t.quincena, t.sucursal, s.nombre, t.fundacion, d.deposito
            FROM vtadc.ticket_quincena_total t
            left join vtadc.ticket_quincena_deposito d on t.quincena=d.quincena and t.sucursal=d.sucursal
            left join catalogo.sucursal s on t.sucursal=s.suc
            where t.quincena=$quincena";
        $q=$this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
    }

public function ventas_sucursal($mes)
{
    $s="SELECT suc, nombre
        , ifnull((select sum(importe$mes) from vtadc.producto_mes_suc10 a where a.suc =s.suc), 0) as a2010
        , ifnull((select sum(importe$mes) from vtadc.producto_mes_suc11 b where b.suc =s.suc), 0) as a2011
        , ifnull((select sum(importe$mes) from vtadc.producto_mes_suc12 c where c.suc =s.suc), 0) as a2012
        , ifnull((select sum(importe$mes) from vtadc.producto_mes_suc13 d where d.suc =s.suc), 0) as a2013
        , ifnull((select sum(importe$mes) from vtadc.producto_mes_suc14 e where e.suc =s.suc), 0) as a2014
        , ifnull((select sum(importe$mes) from vtadc.producto_mes_suc f where f.suc =s.suc), 0) as a2015
        FROM catalogo.sucursal s
        where suc between 101 and 2200 and tlid = 1 and suc not in(127, 176, 177, 178, 179, 180, 187, 192)";
    $q=$this->db->query($s);
    return $q;
}

    public function ejercicio_medicos($mes, $aaa)
    {
        $s="SELECT e.sucursal as suc, e.nombre as nomsuc, e.nomina, c.nombre as medico, e.consultasPagadas, e.importeConsultas, e.recetasSurtidas, e.conversion,
        e.ImprecetasSurtidas, e.PromedioReceta, e.servicios,
        sum(indicador1+indicador2+indicador3+indicador4+indicador5+indicador6) as cumplimiento
        FROM vtadc.ejercicio_medico e
        left join catalogo.cat_medicos c using (nomina)
        where anio = ? and mes = ? group by anio, mes, nomina, e.sucursal order by cumplimiento desc;";
        $q=$this->db->query($s, array($aaa, $mes));
        //echo $this->db->last_query();
        //die();
        return $q;
    }
    
    public function consulta_codigo_medicos($perini, $perfin)
    {
        $s="SELECT c.nomina, a.nombre as medico, c.suc, s.nombre as farmacia, sum(c.falta) as falta, sum(c.retardo) as retardo, sum(c.bata) as bata, sum(c.pantalon) as pantalon,
        sum(c.camisa) as camisa, sum(c.cabello) as cabello, sum(c.barba) as barba, sum(c.maquillaje) as maquillaje,
        sum(c.accesorios) as accesorios, sum(c.zapatos) as zapatos, sum(c.tatuajes) as tatuajes, capturado
        FROM vtadc.codigo_vestir c
        left join catalogo.sucursal s on s.suc=c.suc
        left join catalogo.cat_medicos a on a.nomina=c.nomina
        where c.fecha between ? and ? and capturado = 1
        group by medico";
        $q=$this->db->query($s,array($perini, $perfin));
        //echo $this->db->last_query();
        //die();
        return $q;
        
    }
    
    public function consultas_dia_submit($inicio, $fin, $suc)
    {
        $s="SELECT t.suc, s.nombre, t.nomina, m.nombre as empleado, case when concepto = 26678582 then 'CONSULTAS' else 'SERVICIOS' end as tipoEvento,
            weekday(fecha) as diaSemana, d.nombre as dianombre, date(fecha) as fecha, COUNT(concepto) as eventos  FROM vtadc.ticket_med t
            left join catalogo.cat_medicos m on t.nomina = m.nomina
            left join catalogo.sucursal s on t.suc = s.suc
            left join catalogo.cat_concepto_medicos c on t.concepto= c.codigo
            left join catalogo.cat_dias d on weekday(fecha)=d.dia
            where date_format(fecha,'%Y-%m-%d')>= ? and date_format(fecha,'%Y-%m-%d')<= ? and t.suc = ?
            group by t.suc, nomina, diaSemana, date(t.fecha), tipoEvento
            order by fecha, tipoEvento";     
        $q=$this->db->query($s,array($inicio, $fin, $suc));
        //echo $this->db->last_query();
        //die();
        return $q;
        
    }
    
    
    public function consulta_meta()
    {
        $s="select * from catalogo.sucursal where suc between 101 and 2200 and dia<>'Cer' and tlid=1";     
        $q=$this->db->query($s);
        //echo $this->db->last_query();
        //die();
        return $q;
        
    }
    
 
    function generaReporteMensual($anio, $mes)
    {
        $sql = "delete from vtadc.ticket_reporte where anio = ? and mes = ?;";
        $this->db->query($sql, array((int)$anio, (int)$mes));
        
        $sql1 = "SELECT anio, mes, sucursal, nomina, sum(consultasPagadas) as consultasPagadas, sum(importeConsultas) as importeConsultas, sum(servicios) as servicios, sum(recetasSurtidas) as recetasSurtidas, sum(ImprecetasSurtidas) as ImprecetasSurtidas FROM vtadc.ejercicio_medico e where anio = ? and mes = ? group by nomina;";
        $query1 = $this->db->query($sql1, array((int)$anio, (int)$mes));
        
        $a = array();
        
        foreach($query1->result() as $row1)
        {
            $b = array(
                'suc'   => $row1->sucursal, 
                'nomina'    => $row1->nomina, 
                'consultas' => $row1->consultasPagadas, 
                'consultasIngreso'  => $row1->importeConsultas, 
                'recetasSurtidas' => $row1->recetasSurtidas, 
                'recetasSurtidasImporte' => $row1->ImprecetasSurtidas, 
                'servicios' => $row1->servicios, 
                'anio'  => $row1->anio, 
                'mes'   => $row1->mes
            );
            
            array_push($a, $b);
        }
        
        $this->db->insert_batch('vtadc.ticket_reporte', $a);
        
        
        $F = $this->load->database('facturacion', TRUE);
        
        $sql2 = "SELECT * FROM nominas n where anio = ? and mes = ? and clave in(110);";
        $query2 = $F->query($sql2, array((int)$anio, (int)$mes));
        
        foreach($query2->result() as $row2)
        {
            $this->db->update('vtadc.ticket_reporte', array('sueldo' => $row2->importe), array('anio' => $row2->anio, 'mes' => $row2->mes, 'nomina' => $row2->numEmpleado));
        }

        $sql2 = "SELECT * FROM nominas n where anio = ? and mes = ? and clave in(150);";
        $query2 = $F->query($sql2, array((int)$anio, (int)$mes));
        
        foreach($query2->result() as $row2)
        {
            $this->db->update('vtadc.ticket_reporte', array('premio' => $row2->importe), array('anio' => $row2->anio, 'mes' => $row2->mes, 'nomina' => $row2->numEmpleado));
        }
        
        $sql3 = "SELECT suc, sum(prome) * 0.23 as meta
FROM cortes_resp.cortes_venta_diaria  where mes = ? group by suc;";
        
        $query3 = $this->db->query($sql3, (int)$mes);
        
        foreach($query3->result() as $row3)
        {
            $this->db->update('vtadc.ticket_reporte', array('metaSucursal' => $row3->meta), array('suc' => $row3->suc, 'anio' => $anio, 'mes' => $mes));
        }
        
        $sql4 = "update vtadc.ticket_reporte set alcance = round((recetasSurtidasImporte / metaSucursal) * 100, 4);";
        $this->db->query($sql4);
        
        $sql5 = "SELECT nomina, sum(t.doctorConsultas + t.doctorServicios) as doctor FROM vtadc.ticket_concentrado t where extract(year from dia) = ? and extract(month from dia) = ? group by nomina;";
        
        $query5 = $this->db->query($sql5, array((int)$anio, (int)$mes));
        
        foreach($query5->result() as $row5)
        {
            $this->db->update('vtadc.ticket_reporte', array('doctor' => $row5->doctor), array('nomina' => $row5->nomina, 'anio' => $anio, 'mes' => $mes));
        }

    }
    
    function getReporteMensual($anio, $mes)
    {
        $sql = "SELECT DISTINCT t.*, nombre, completo, puestox
FROM vtadc.ticket_reporte t
join catalogo.sucursal s using(suc)
join catalogo.cat_empleado e on t.nomina = e.nomina
where anio = ? and mes = ?
having puestox = 'MEDICO'
order by suc, nomina
;";

        $query = $this->db->query($sql, array((int)$anio, (int)$mes));
        
        return $query;
    }
    
    function getExcelReporteMensual($anio, $mes)
    {

        $this->load->library('excel');
        $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
        if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
        	die($cacheMethod . " caching method is not available" . EOL);
        }
        
        $hoja = 0;
        
        $this->excel->createSheet($hoja);
        $this->excel->setActiveSheetIndex($hoja);
        $this->excel->getActiveSheet()->getTabColor()->setRGB('FFFF00');

        $this->excel->getActiveSheet()->setTitle('REPORTE MENSUAL');
            
            $this->excel->getActiveSheet()->mergeCells('A1:N1');
            $this->excel->getActiveSheet()->mergeCells('A2:K2');
            
            $this->excel->getActiveSheet()->mergeCells('L2:N2');

            $this->excel->getActiveSheet()->setCellValue('A1', 'FARMACIAS EL FENIX DEL CENTRO SA DE CV');
            $this->excel->getActiveSheet()->setCellValue('A2', 'REPORTE DE PRODUCTIVIDAD DE MEDICOS DEL MES: ' . $mes . ', A&Ntilde;O: ' . $anio);
            $this->excel->getActiveSheet()->setCellValue('L2', date('d/M/Y H:i:s'));
            
            
            $query2 = $this->getReporteMensual($anio, $mes);
            
            $num = 3;
            
            $data_empieza = $num + 1;
            
            $this->excel->getActiveSheet()->setCellValue('A'.$num, '#');
            $this->excel->getActiveSheet()->setCellValue('B'.$num, '# SUC');
            $this->excel->getActiveSheet()->setCellValue('C'.$num, 'SUCURSAl');
            $this->excel->getActiveSheet()->setCellValue('D'.$num, '# NOMINA');
            $this->excel->getActiveSheet()->setCellValue('E'.$num, 'NOMBRE MEDICO');
            $this->excel->getActiveSheet()->setCellValue('F'.$num, 'CONSULTAS TOTALES');
            $this->excel->getActiveSheet()->setCellValue('G'.$num, 'INGRESOS TOTALES CONSULTAS');
            $this->excel->getActiveSheet()->setCellValue('H'.$num, 'RECETAS SURTIDAS');
            $this->excel->getActiveSheet()->setCellValue('I'.$num, 'INGRESOS RECETAS SURTIDAS');
            $this->excel->getActiveSheet()->setCellValue('J'.$num, 'SERVICIOS');
            $this->excel->getActiveSheet()->setCellValue('K'.$num, 'SUELDO');
            $this->excel->getActiveSheet()->setCellValue('L'.$num, 'PREMIO');
            $this->excel->getActiveSheet()->setCellValue('M'.$num, 'DIRECTO GANADO EN SUCURSAL(Consultas + Servicios)');
            $this->excel->getActiveSheet()->setCellValue('N'.$num, 'OBJETIVO MEDICO');
            $this->excel->getActiveSheet()->setCellValue('O'.$num, '% ALCANCE');
            
            $i = 1;

            foreach($query2->result()  as $row2)
            {
                $num++;
                
                $this->excel->getActiveSheet()->setCellValue('A'.$num, $i);
                $this->excel->getActiveSheet()->setCellValue('B'.$num, $row2->suc);
                $this->excel->getActiveSheet()->setCellValue('C'.$num, $row2->nombre);
                $this->excel->getActiveSheet()->setCellValue('D'.$num, $row2->nomina);
                $this->excel->getActiveSheet()->setCellValue('E'.$num, $row2->completo);
                $this->excel->getActiveSheet()->setCellValue('F'.$num, $row2->consultas);
                $this->excel->getActiveSheet()->setCellValue('G'.$num, $row2->consultasIngreso);
                $this->excel->getActiveSheet()->setCellValue('H'.$num, $row2->recetasSurtidas);
                $this->excel->getActiveSheet()->setCellValue('I'.$num, $row2->recetasSurtidasImporte);
                $this->excel->getActiveSheet()->setCellValue('J'.$num, $row2->servicios);
                $this->excel->getActiveSheet()->setCellValue('K'.$num, $row2->sueldo);
                $this->excel->getActiveSheet()->setCellValue('L'.$num, $row2->premio);
                $this->excel->getActiveSheet()->setCellValue('M'.$num, $row2->doctor);
                $this->excel->getActiveSheet()->setCellValue('N'.$num, $row2->metaSucursal);
                $this->excel->getActiveSheet()->setCellValue('O'.$num, $row2->alcance);
                $i++;
                
            }
            
            $data_termina = $num;
            
            $this->excel->getActiveSheet()->setCellValue('F'.($data_termina + 1), '=sum(F'.$data_empieza.':F'.$data_termina.')');
            $this->excel->getActiveSheet()->setCellValue('G'.($data_termina + 1), '=sum(G'.$data_empieza.':G'.$data_termina.')');
            $this->excel->getActiveSheet()->setCellValue('H'.($data_termina + 1), '=sum(H'.$data_empieza.':H'.$data_termina.')');
            $this->excel->getActiveSheet()->setCellValue('I'.($data_termina + 1), '=sum(I'.$data_empieza.':I'.$data_termina.')');
            $this->excel->getActiveSheet()->setCellValue('J'.($data_termina + 1), '=sum(J'.$data_empieza.':J'.$data_termina.')');
            $this->excel->getActiveSheet()->setCellValue('K'.($data_termina + 1), '=sum(K'.$data_empieza.':K'.$data_termina.')');
            $this->excel->getActiveSheet()->setCellValue('L'.($data_termina + 1), '=sum(L'.$data_empieza.':L'.$data_termina.')');
            $this->excel->getActiveSheet()->setCellValue('M'.($data_termina + 1), '=sum(M'.$data_empieza.':M'.$data_termina.')');
            $this->excel->getActiveSheet()->setCellValue('O'.($data_termina + 1), '=AVERAGE(O'.$data_empieza.':O'.$data_termina.')');
            
            
            $this->excel->getActiveSheet()->getStyle('F'.$data_empieza.':F'.($data_termina + 1))->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle('H'.$data_empieza.':H'.($data_termina + 1))->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle('J'.$data_empieza.':J'.($data_termina + 1))->getNumberFormat()->setFormatCode('#,##0');
            $this->excel->getActiveSheet()->getStyle('G'.$data_empieza.':G'.($data_termina + 1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $this->excel->getActiveSheet()->getStyle('I'.$data_empieza.':I'.($data_termina + 1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $this->excel->getActiveSheet()->getStyle('K'.$data_empieza.':K'.($data_termina + 1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $this->excel->getActiveSheet()->getStyle('L'.$data_empieza.':L'.($data_termina + 1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $this->excel->getActiveSheet()->getStyle('M'.$data_empieza.':M'.($data_termina + 1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $this->excel->getActiveSheet()->getStyle('N'.$data_empieza.':N'.($data_termina + 1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $this->excel->getActiveSheet()->getStyle('O'.$data_empieza.':O'.($data_termina + 1))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            
            $this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
            $this->excel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
            
            //$this->excel->getActiveSheet()->getStyle('E'.$data_empieza.':G'.$data_termina)->getAlignment()->setWrapText(true);
            
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => 'FFFF0000'),
                    ),
                ),
            );
            
            $this->excel->getActiveSheet()->getStyle('A'.($data_empieza - 1).':O'.($data_termina + 1))->applyFromArray($styleArray);
            
            $this->excel->getActiveSheet()->freezePaneByColumnAndRow(0, $data_empieza);
            $this->excel->getActiveSheet()->setAutoFilter('A'.($data_empieza - 1).':O'.($data_termina));        

    }
    


    function medicos_nov15()
    {
        $sql = "select * from vtadc.venta_medico_global;";

        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function detalle_medicos_nov15($periodo)
    {
        $sql = "select * from vtadc.venta_medico_final v where periodo = $periodo;";

        $query = $this->db->query($sql);
        
        return $query;
    }



}