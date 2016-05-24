<?php
class mantenimiento_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function getorden()
    {
        $sql = "SELECT o.orden,o.suc,a.nombre,o.fecha,o.fecha_cierre,b.observaciones_detalle,o.id_orden_status
                FROM mantenimiento.orden o
                join catalogo.sucursal a on a.suc = o.suc
                join mantenimiento.orden_detalle b on b.orden = o.orden
                where id_orden_status in (1,2)
                group by o.orden;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    function getorden_detalle($orden)
    {
        $sql = "SELECT a.orden,d.tipo_mantenimiento,c.tipo_operacion,e.operacion,f.servicios,b.detalle,a.especifique,a.observaciones_detalle
            FROM mantenimiento.orden_detalle a
            join mantenimiento.detalle_servicio b on b.id_detalle_servicio = a.id_detalle_servicio
            join mantenimiento.tipo_operacion c on c.tipo_id = a.tipo_id
            join mantenimiento.tipo_mantenimiento d on d.tipo_mantenimiento_id = a.tipo_mantenimiento_id
            join mantenimiento.operacion e on e.operacion_id = a.operacion_id
            join mantenimiento.servicios f on f.servicios_id = b.servicios_id
            join mantenimiento.orden g on g.orden = a.orden
            where a.orden = $orden;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    
    
    function getorden_observaciones_detalle($orden)
    {
        $sql = "SELECT a.observaciones_detalle
            FROM mantenimiento.orden_detalle a
            where a.orden = $orden
            group by orden;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }

    function muestra_personal()
    {
      $s = "SELECT * FROM mantenimiento.trabajador t";
      
      $q = $this->db->query($s); 
      $id = array();
      
      $id[0] = 'Selecciona Uno';
      foreach($q->result() as $r)
      {
        $id[$r->id] = $r->id.'-'.$r->nombre;
      } 
      return $id;
    }
    
    function muestra_tiempo()
    {
      $s = "SELECT * FROM mantenimiento.tiempo t;";
      
      $q = $this->db->query($s); 
      $tiempo_id = array();
      
      $tiempo_id[0] = 'Selecciona Uno';
      foreach($q->result() as $r)
      {
        $tiempo_id[$r->tiempo_id] = $r->tiempo;
      } 
      return $tiempo_id;
    }
    
    function insertPersonal($orden,$id)
    {
        $data = array( 'orden' => $orden,'id' => $id);
        $this->db->insert('mantenimiento.orden_trabajador', $data);
    }
    
    function deletePersonal($orden,$id)
    {
        $data = array('orden' => $orden, 'id' => $id);
        $this->db->delete('mantenimiento.orden_trabajador', $data);
        
    }
    
    function orden_asigadatraba($orden)
    {
        $sql = "SELECT o.orden,o.id,a.nombre,a.nomina
                FROM mantenimiento.orden_trabajador o
                join mantenimiento.trabajador a on a.id = o.id where orden = $orden;";
        
        $query = $this->db->query($sql);
     
        
        return $query;
    }
    
    function muestra_presupuesto()
    {
      $s = "SELECT * FROM mantenimiento.presupuesto o;";
      
      $q = $this->db->query($s); 
      $presupuesto_id = array();
      
      $presupuesto_id[0] = 'Selecciona Uno';
      foreach($q->result() as $r)
      {
        $presupuesto_id[$r->presupuesto_id] = $r->presupuesto;
      } 
      return $presupuesto_id;
    }
    
    function cerrar_orden($orden,$tiempo_id,$presupuesto_id)
    {
        
        $data = array( 'tiempo_id' => $tiempo_id,'presupuesto_id' => $presupuesto_id);
        $this->db->update('mantenimiento.orden_detalle', $data, array('orden' => $orden));
    }
    
    function cerrar_orden_status($orden)
    {
        $data = array( 'id_orden_status' => '2');
        $this->db->update('mantenimiento.orden', $data, array('orden' => $orden));
    }
    
    function fecha_asig_orden_status($orden)
    {
        $data = array('fecha_asig' => date('Y-m-d H:i:s'));
        $this->db->update('mantenimiento.orden', $data, array('orden' => $orden));
    }
    
    function inserta_encuesta($orden){
       $s = "select orden,suc,idpregunta from mantenimiento.orden
             join mantenimiento.preguntas where orden = $orden";
       $q = $this->db->query($s); 
       if($q->num_rows()){
         $r = $q->row();
         $a = array('orden'=>$r->orden,'suc'=>$r->suc,'idpregunta'=>1);
         $b = array('orden'=>$r->orden,'suc'=>$r->suc,'idpregunta'=>2);
         $c = array('orden'=>$r->orden,'suc'=>$r->suc,'idpregunta'=>3);
         $d = array('orden'=>$r->orden,'suc'=>$r->suc,'idpregunta'=>4);
         $e = array('orden'=>$r->orden,'suc'=>$r->suc,'idpregunta'=>5);
         $f = array('orden'=>$r->orden,'suc'=>$r->suc,'idpregunta'=>6);
         $g = array('orden'=>$r->orden,'suc'=>$r->suc,'idpregunta'=>7);
         $this->db->insert('mantenimiento.preguntas_encuensta',$a);
         $this->db->insert('mantenimiento.preguntas_encuensta',$b);
         $this->db->insert('mantenimiento.preguntas_encuensta',$c);
         $this->db->insert('mantenimiento.preguntas_encuensta',$d);
         $this->db->insert('mantenimiento.preguntas_encuensta',$e);
         $this->db->insert('mantenimiento.preguntas_encuensta',$f);
         $this->db->insert('mantenimiento.preguntas_encuensta',$g);
         
       }
    }
    
  //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
    
  function getCabezaOrden($orden,$var1){
        $fec=date('Y-m-d H:i:s');
        $s="SELECT * FROM mantenimiento.orden o where orden = $orden;";
        $q = $this->db->query($s);
        if($q->num_rows() > 0)
        {
         $row = $q->row();
         //$l0='<img src="'.base_url().'imagenes/logos.png" border="0" width="100px" />';
         $tabla .= "<table>
            <tr>
                <th align=\"left\"><font size=\"+2\"></font></th>
                <th align=\"right\"><font size=\"+2\"><strong></strong></font></th>
                <th align=\"center\"><font size=\"+2\"><strong>ORDEN DE MANTENIMIENTO</strong></font></th>
                <th align=\"right\"><font size=\"+3\"><strong>$var1</strong></font></th>
            </tr>
            <tr>
                <th align=\"right\"><font size=\"+2\"><strong></strong></font></th>
                 <th align=\"right\"><font size=\"+2\"><strong>Fecha De Asignacion $row->fecha_asig</strong></font></th>
                <th align=\"right\"><font size=\"+2\"><strong></strong></font></th>
                <th align=\"right\"><font size=\"+2\"><strong>NO.$row->orden</strong></font></th>
            </tr>
        </table>";
        
         $tabla = "
        <table border=\"1\">
            <thead>
                <tr>
                    <th align=\"center\"; style=\"width: 10%;\"><b>Operacion</b></th>
                    <th align=\"center\"; style=\"width: 20%;\"><b>Servicios</b></th>
                    <th align=\"center\"; style=\"width: 30%;\"><b>Detalle</b></th>
                    <th align=\"center\"; style=\"width: 40%;\"><b>Especifique</b></th>
                </tr>
            </thead>
            </table>";
        } //cellpadding=\"1\"
        return $tabla; 
    }
    
///////////////////////////////////////////////////////////////////////////////////////
  
    function getCabezaOrden2($orden,$var1){
        $fec=date('Y-m-d H:i:s');
        $s="SELECT a.orden,a.suc,b.nombre,a.fecha,a.observaciones,year(a.fecha)as anio,month(a.fecha) as mes,day(a.fecha)as dia,a.fecha_asig,
            d.nomina,d.nombre as Empleado
            FROM mantenimiento.orden a
            join catalogo.sucursal b on b.suc = a.suc
            join mantenimiento.orden_trabajador c on c.orden = a.orden
            join mantenimiento.trabajador d on d.id = c.id
            where a.orden = $orden;";
         $s2 = "SELECT b.nomina,b.nombre as empleado,d.tiempo as tiempo_asignado FROM mantenimiento.orden_trabajador a
                join mantenimiento.trabajador b on b.id = a.id
                join mantenimiento.orden_detalle c on c.orden = a.orden
                join mantenimiento.tiempo d on d.tiempo_id = c.tiempo_id
                where c.orden = $orden
                group by b.nomina";
      $q2 = $this->db->query($s2);
            
 /*s="SELECT a.orden,a.suc,b.nombre,a.fecha,a.observaciones,year(a.fecha)as anio,month(a.fecha) as mes,day(a.fecha)as dia,a.fecha_asig 
            FROM mantenimiento.orden a
            join catalogo.sucursal b on b.suc = a.suc
            where orden = $orden;";*/
                       
        $q = $this->db->query($s);
        if($q->num_rows() > 0)
        {
         $row = $q->row();
         $l0='<img src="'.base_url().'/img/logo.png" border="0" width="150px" />';
         $l1='<img src="'.base_url().'/img/logo fenix nuevo y pepe-03.jpg" border="0" width="40px" />';
      $tabla .= "<table>
            <tr>
                <th align=\"left\"><font size=\"+2\"></font>$l0</th>
                <th align=\"right\"><font size=\"+3\"><strong>ORDEN DE </strong></font></th>
                <th align=\"left\"><font size=\"+2\"><strong> MANTENIMIENTO</strong></font></th>
                <th align=\"right\"><font size=\"+3\"><strong>$l1</strong></font></th>
            </tr>
            <tr>
                <th align=\"left\"><font size=\"+2\"></font></th>
                <th align=\"right\"><font size=\"+2\"><strong>Fecha de Asignaci&oacute;n:</strong></font></th>
                <th align=\"left\"><font size=\"+3\"><strong> $row->fecha_asig</strong></font></th>
                <th align=\"right\"><font size=\"+3\"><strong></strong></font></th>
            </tr>
            <tr>
                <td align=\"center\"><font size=\"+2\"><strong></strong></font></td>
                <td align=\"right\"><font size=\"+3\"><strong></strong></font></td>
                <td align=\"right\"><font size=\"+2\"><strong></strong></font></td>
                <td align=\"right\"><font size=\"+3\"><strong>$var1</strong></font></td>
            </tr>
            <tr>
                <td align=\"right\"><font size=\"+2\"><strong></strong></font></td>
                <td align=\"right\"><font size=\"+2\"><strong></strong></font></td>
                <td align=\"right\"><font size=\"+2\"><strong></strong></font></td>
                <td align=\"right\"><font size=\"+4\"><strong>FOLIO:$row->orden</strong></font></td>
            </tr>
        </table>
        ";

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////        
        
        $tabla .= "
        <br />
        <table  border=\"1\">
                <tr>
                    <th align=\"center\"; style=\"width: 45%;\"><font size=\"-0.5\"><b>Num. Sucursal </br><br />$row->suc</font></th>
                    <th align=\"center\"; style=\"width: 40%;\"><font size=\"-0.5\"><b>Sucursal </b><br /> $row->nombre</font></th>
                    <th align=\"center\"; style=\"width: 5%;\"><font size=\"-0.5\"><b>Dia</b> <br />$row->dia</font></th>
                    <th align=\"center\"; style=\"width: 5%;\"><font size=\"-0.5\"><b>Mes</b> <br />$row->mes</font></th>
                    <th align=\"center\"; style=\"width: 5%;\"><font size=\"-0.5\"><b>A&ntilde;o</b><br />$row->anio</font></th>
                </tr>
            </table>
            <br />
            ";
            
        $tabla .= "<table border=\"1\">
             <tr>
                    <th align=\"center\"; style=\"width: 30%;\"><font size=\"+1\"><b>N&oacute;mina</b></font></th>
                    <th align=\"center\"; style=\"width: 40%;\"><font size=\"+1\"><b>Nombre</b></font></th>
                    <th align=\"center\"; style=\"width: 30%;\"><font size=\"+1\"><b>Tiempo Asigando</b></font></th>
                </tr> 
           </table>";       
       foreach($q2->result() as $r){
         $tabla .= "<table border=\"1\">
             <tr>
                    <td align=\"center\"; style=\"width: 30%;\"><b>$r->nomina</b></td>
                    <td align=\"center\"; style=\"width: 40%;\"><b>$r->empleado</b></td>
                    <td align=\"center\"; style=\"width: 30%;\"><b>$r->tiempo_asignado</b></td>
                </tr> 
           </table>
           ";  
          }
        } //cellpadding=\"1\"
        return $tabla; 
    }
    
  
    
//////////////////////////////////////////////////////////////////////    
    function getDetalleOrden($orden){
     $s = "SELECT d.tipo_mantenimiento,c.tipo_operacion,e.operacion,f.servicios,b.detalle,a.especifique,a.observaciones_detalle
            FROM mantenimiento.orden_detalle a
            join mantenimiento.detalle_servicio b on b.id_detalle_servicio = a.id_detalle_servicio
            join mantenimiento.tipo_operacion c on c.tipo_id = a.tipo_id
            join mantenimiento.tipo_mantenimiento d on d.tipo_mantenimiento_id = a.tipo_mantenimiento_id
            join mantenimiento.operacion e on e.operacion_id = a.operacion_id
            join mantenimiento.servicios f on f.servicios_id = b.servicios_id
            join mantenimiento.orden g on g.orden = a.orden
            where a.orden = $orden";
     $q = $this->db->query($s);
     
     $tabla .="
             <br />
             <table border=\"1\">
            <thead>
                <tr>
                    <th align=\"center\"; style=\"width: 14.3%;\"><font size=\"+1\"><b>Tipo Mantenimiento</b></font></th>
                    <th align=\"center\"; style=\"width: 14.3%;\"><font size=\"+1\"><b>Tipo Operaci&oacute;n</b></font></th>
                    <th align=\"center\"; style=\"width: 14.3%;\"><font size=\"+1\"><b>Operaci&oacute;n</b></font></th>
                    <th align=\"center\"; style=\"width: 14.3%;\"><font size=\"+1\"><b>Servicios</b></font></th>
                    <th align=\"center\"; style=\"width: 14.3%;\"><font size=\"+1\"><b>Servicios Detalle</b></font></th>
                    <th align=\"center\"; style=\"width: 14.3%;\"><font size=\"+1\"><b>Especifique Detalle</b></font></th>
                    <th align=\"center\"; style=\"width: 14.3%;\"><font size=\"+1\"><b>Observaciones</b></font></th>
                </tr>
            </thead>
            <tbody>";
            
      foreach($q->result() as $row)
     {      
     $tabla .="
            <tr>
            <td align=\"center\"; style=\"width: 14.3%;\">".$row->tipo_mantenimiento."</td>
            <td align=\"center\"; style=\"width: 14.3%;\">".$row->tipo_operacion."</td>
            <td align=\"center\"; style=\"width: 14.3%;\">".$row->operacion."</td>
            <td align=\"center\"; style=\"width: 14.3%;\">".$row->servicios."</td>
            <td align=\"center\"; style=\"width: 14.3%;\">".$row->detalle."</td>
            <td align=\"center\"; style=\"width: 14.3%;\">".$row->especifique."</td>
            <td align=\"center\"; style=\"width: 14.3%;\">".$row->observaciones_detalle."</td>
            </tr>";
     }
      $tabla .="
            </tbody>
            </table>
            ";    
     return $tabla;
    }
    
    ////////////////////////////////////////////////////////////////////
    
    function imprime_orden_final($orden){
        
        $s = "SELECT d.operacion,c.servicios,b.detalle,a.especifique,a.presupuesto_id FROM mantenimiento.orden_detalle a
            join mantenimiento.detalle_servicio b on b.id_detalle_servicio = a.id_detalle_servicio
            join mantenimiento.servicios c on c.servicios_id = b.servicios_id
            join mantenimiento.operacion d on d.operacion_id = a.operacion_id
            where orden = $orden";
     $q = $this->db->query($s);
        
        if ($q->num_rows() >0)
        {
            $row = $q->row();
        $s = "SELECT b.presupuesto_id FROM mantenimiento.orden_detalle a
                join presupuesto b on b.presupuesto_id = a.presupuesto_id 
                where orden = $orden and b.presupuesto_id = $row->presupuesto_id";    
        
        if ($row->presupuesto_id== 1 || $row->presupuesto_id== 2 || $row->presupuesto_id== 3 || $row->presupuesto_id== 4){
            $s1="select * from mantenimiento.autorizado where autorizado_id = 1";
            $q2=$this->db->query($s1);
            $r1 = $q2->row();
            $autoriza = $r1->autorizo;
        }elseif($row->presupuesto_id== 5 || $row->presupuesto_id== 6){
            $s1="select * from mantenimiento.autorizado where autorizado_id = 2";
            $q2=$this->db->query($s1);
            $r1 = $q2->row();
            $autoriza = $r1->autorizo;
        }
        $tabla ="<table>
        <tr>
        <td align=\"center\"></td>
        <td align=\"center\">________________________________________</td>
        <td align=\"center\"></td>
        </tr>
        <tr>
        <td align=\"center\"></td>
        <td align=\"center\">FIRMA DE AUTORIZACION: $autoriza</td>
        <td align=\"center\"></td>
        </tr>
        </table>
        ";
        
        }
        return $tabla;
    }
  
  ////////////////////////////////////////////////////////////////////////////////////////////////
  
   function getorden_atendida()
    {
        $sql = "SELECT o.orden,o.suc,a.nombre,o.fecha,o.fecha_cierre,o.id_orden_status
                FROM mantenimiento.orden o
                join catalogo.sucursal a on a.suc = o.suc and o.id_orden_status = 3
                order by o.orden,o.suc";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function getorden_evaluada($orden)
    {
        $sql = "SELECT a.orden,b.suc,b.nombre,a.fecha,a.fecha_asig,a.fecha_cierre FROM mantenimiento.orden a
                join catalogo.sucursal b on b.suc = a.suc
                where orden = $orden and id_orden_status = 3";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function getorden_evaluada_empleado($orden)
    {
        $sql = "SELECT a.orden,b.nomina,b.nombre,c.hora_entrada,c.hora_salida,d.observacion_personal FROM mantenimiento.orden_trabajador a
                join mantenimiento.trabajador b on b.id = a.id
                join mantenimiento.preguntas_encuensta c on c.orden = a.orden
                join mantenimiento.orden d on d.orden = a.orden
                where a.orden = $orden group by b.nomina;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function getorden_evaluada_calific($orden)
    {
        $sql = "SELECT a.idpregunta,b.pregunta,a.calificacion FROM mantenimiento.preguntas_encuensta a
                join mantenimiento.preguntas b on b.idpregunta = a.idpregunta
                where a.orden = $orden;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function getorden_evaluada_sugerencia($orden)
    {
        $sql = "SELECT sugerencias FROM mantenimiento.preguntas_encuensta where orden = $orden
                group by orden;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function getreporte_orden_emple()
    {
        $sql = "SELECT a.id,b.nombre
                FROM mantenimiento.orden_trabajador a
                join mantenimiento.trabajador b on b.id = a.id
                group by id order by id;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
     function getreporte_orden_emple_detalle($id)
    {
       $sql = "SELECT a.orden,d.suc,e.nombre as sucursal,
                ifnull((select sum(x.calificacion) from mantenimiento.preguntas_encuensta x where a.orden = x.orden),0) as calificacion
                FROM mantenimiento.preguntas_encuensta a
                join mantenimiento.orden_trabajador b on b.orden = a.orden
                join mantenimiento.trabajador c on b.id = c.id
                join mantenimiento.orden d on d.orden = a.orden
                join catalogo.sucursal e on e.suc = d.suc
                where b.id = $id
                group by b.id;"; //a.orden
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function muestra_total()
    {
        
        $s= "SELECT b.id,c.nombre,ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)as total_o,
ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id ),0) as calificacion,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id ),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as cal_t,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 1),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p1,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 2),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p2,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 3),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p3,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 4),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p4,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 5),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p5,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 6),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p6,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 7),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p7,
((ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)))/(7) as tt
FROM mantenimiento.preguntas_encuensta a
join mantenimiento.orden_trabajador b on b.orden = a.orden
join mantenimiento.trabajador c on b.id = c.id
join mantenimiento.orden d on d.orden = a.orden
join catalogo.sucursal e on e.suc = d.suc
group by b.id";
        
       /* $s= "SELECT b.id,c.nombre,ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)as total_o,
            ifnull((select sum(x.calificacion) from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
            where y.id = b.id ),0) as calificacion
            FROM mantenimiento.preguntas_encuensta a
            join mantenimiento.orden_trabajador b on b.orden = a.orden
            join mantenimiento.trabajador c on b.id = c.id
            join mantenimiento.orden d on d.orden = a.orden
            join catalogo.sucursal e on e.suc = d.suc
            where b.id = $id
            group by b.id";

        /*$s = "SELECT a.id,b.nombre, ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = a.id group by x.id),0) as total_o
              FROM mantenimiento.orden_trabajador a
              join mantenimiento.trabajador b on a.id = b.id
              where a.id = $id
              group by a.id";
              
              */
        $query = $this->db->query($s);
        return $query;      
    }
    
    /*function muestra_pretuntas(){
         $s= "SELECT a.idpregunta,(SELECT sum(x.calificacion) FROM mantenimiento.preguntas_encuensta x
            join mantenimiento.orden_trabajador y on y.orden = x.orden
            where x.idpregunta = a.idpregunta and y.id = b.id) as total_p
            FROM mantenimiento.preguntas_encuensta a
            join mantenimiento.orden_trabajador b on b.orden = a.orden
            join mantenimiento.trabajador c on b.id = c.id
            join mantenimiento.orden d on d.orden = a.orden
            where b.id = $id
            group by a.idpregunta";
        $query = $this->db->query($s);
        return $query;    
    }*/
    
    
    function muestra_eval_det($id)
    {
        $s = "SELECT a.orden,d.suc,c.nombre,e.nombre as sucursal,
ifnull((select sum(x.calificacion) from mantenimiento.preguntas_encuensta x where a.orden = x.orden),0) as calificacionb,idpregunta,
ifnull((select x.calificacion from mantenimiento.preguntas_encuensta x where x.orden = a.orden and idpregunta = 1),0) as c1,
ifnull((select x.calificacion from mantenimiento.preguntas_encuensta x where x.orden = a.orden and idpregunta = 2),0) as c2,
ifnull((select x.calificacion from mantenimiento.preguntas_encuensta x where x.orden = a.orden and idpregunta = 3),0) as c3,
ifnull((select x.calificacion from mantenimiento.preguntas_encuensta x where x.orden = a.orden and idpregunta = 4),0) as c4,
ifnull((select x.calificacion from mantenimiento.preguntas_encuensta x where x.orden = a.orden and idpregunta = 5),0) as c5,
ifnull((select x.calificacion from mantenimiento.preguntas_encuensta x where x.orden = a.orden and idpregunta = 6),0) as c6,
ifnull((select x.calificacion from mantenimiento.preguntas_encuensta x where x.orden = a.orden and idpregunta = 7),0) as c7,
ifnull((((select sum(x.calificacion) from mantenimiento.preguntas_encuensta x where a.orden = x.orden)/7)),0) as prom,
ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0) ordenes
FROM mantenimiento.preguntas_encuensta a
join mantenimiento.orden_trabajador b on b.orden = a.orden
join mantenimiento.trabajador c on b.id = c.id
join mantenimiento.orden d on d.orden = a.orden
join catalogo.sucursal e on e.suc = d.suc
where b.id = $id
group by orden";
        /*$s= "SELECT a.orden,d.suc,c.nombre,e.nombre as sucursal,
            ifnull((select sum(x.calificacion) from mantenimiento.preguntas_encuensta x where a.orden = x.orden),0) as calificacionb,idpregunta,calificacion
            FROM mantenimiento.preguntas_encuensta a
            join mantenimiento.orden_trabajador b on b.orden = a.orden
            join mantenimiento.trabajador c on b.id = c.id
            join mantenimiento.orden d on d.orden = a.orden
            join catalogo.sucursal e on e.suc = d.suc
            where b.id = 1481;";*/

        $query = $this->db->query($s);
        return $query;      
    }
    
    
    function consulta_mensual_emple($inicio, $fin)
    {
        
        $s= "SELECT b.id,c.nombre,ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)as total_o,
ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id ),0) as calificacion,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id ),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as cal_t,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 1),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p1,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 2),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p2,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 3),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p3,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 4),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p4,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 5),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p5,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 6),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p6,
(ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id  and x.idpregunta = 7),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)) as p7,
((ifnull((select sum(x.calificacion)
from mantenimiento.preguntas_encuensta x join mantenimiento.orden_trabajador y on x.orden = y.orden
where y.id = b.id),0))/(ifnull((select count(x.orden) from mantenimiento.orden_trabajador x where x.id = b.id),0)))/(7) as tt
FROM mantenimiento.preguntas_encuensta a
join mantenimiento.orden_trabajador b on b.orden = a.orden
join mantenimiento.trabajador c on b.id = c.id
join mantenimiento.orden d on d.orden = a.orden
join catalogo.sucursal e on e.suc = d.suc
where d.fecha between $inicio and $fin
group by b.id";

        $query = $this->db->query($s);
        return $query;      
    }
    

    
}


