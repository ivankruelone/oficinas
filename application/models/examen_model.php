<?php
class Examen_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function getMaster()
    {
        $sql = "SELECT * FROM examen.x
join examen.examen_liberar l using(liberar)
order by x.x;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }

    function getMasterByX($x)
    {
        $sql = "SELECT * FROM examen.x
join examen.examen_liberar l using(liberar)
where x = ?;";
        
        $query = $this->db->query($sql, $x);
        
        return $query;
    }

    function getExamen()
    {
        $sql = "SELECT * FROM examen.examen e
join examen.tipo t using(tipoID)
join examen.examen_liberar l using(liberar)
order by x, e.examenID;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function getExamenByExamenID($examenID)
    {
        $sql = "SELECT * 
        FROM examen.examen e
join examen.tipo t using(tipoID)
join examen.examen_liberar l using(liberar)
where examenID = ?;";
        
        $query = $this->db->query($sql, $examenID);
        
        return $query;
    }
    
    function getReactivoByExamenID($examenID)
    {
        $sql = "SELECT * 
FROM examen.reactivo r
join examen.examen e using(examenID)
where examenID = ?;";
        
        $query = $this->db->query($sql, $examenID);
        
        return $query;
    }
    
    function getReactivoByReactivoID($reactivoID)
    {
        $sql = "SELECT * 
FROM examen.reactivo r
join examen.examen e using(examenID)
where reactivoID = ?;";
        
        $query = $this->db->query($sql, $reactivoID);
        
        return $query;
    }
    
    function getOpcionByReactivoID($reactivoID)
    {
        $this->db->where('reactivoID', $reactivoID);
        $query = $this->db->get('examen.opcion');
        
        return $query;
    }
    
    function getOpcionByOpcionID($opcionID)
    {
        $this->db->where('opcionID', $opcionID);
        $query = $this->db->get('examen.opcion');
        
        return $query;
    }
    
    function getTipoCombo()
    {
        $query = $this->db->get('examen.tipo');
        
        $a = array();
        
        foreach($query->result() as $row)
        {
            $a[$row->tipoID] = $row->tipoDescripcion;
        }
        
        return $a;
    }
    
    function getMasterCombo()
    {
        $query = $this->db->get('examen.x');
        
        $a = array();
        
        foreach($query->result() as $row)
        {
            $a[$row->x] = $row->x;
        }
        
        return $a;
    }

    function getLiberarCombo()
    {
        $query = $this->db->get('examen.examen_liberar');
        
        $a = array();
        
        foreach($query->result() as $row)
        {
            $a[$row->liberar] = $row->liberarDescripcion;
        }
        
        return $a;
    }

    function insertExamen($examen, $tipoID, $tiempo, $instrucciones, $ejemplo, $ponderacion, $x)
    {
        $data = array('examen' => $examen, 'tipoID' => $tipoID, 'tiempo' => $tiempo, 'instrucciones' => $instrucciones, 'ejemplo' => $ejemplo, 'ponderacion' => $ponderacion, 'x' => $x);
        $this->db->insert('examen.examen', $data);
    }
    
    function updateExamen($examen, $tipoID, $tiempo, $examenID, $instrucciones, $ejemplo, $ponderacion, $x)
    {
        $data = array('examen' => $examen, 'tipoID' => $tipoID, 'tiempo' => $tiempo, 'instrucciones' => $instrucciones, 'ejemplo' => $ejemplo, 'ponderacion' => $ponderacion, 'x' => $x);
        $this->db->update('examen.examen', $data, array('examenID' => $examenID));
    }
    
    function insertReactivo($examenID, $reactivo)
    {
        $data = array('examenID' => $examenID, 'reactivo' => $reactivo);
        $this->db->insert('examen.reactivo', $data);
    }
    
    function updateReactivo($examenID, $reactivo, $reactivoID)
    {
        $data = array('reactivo' => $reactivo);
        $this->db->update('examen.reactivo', $data, array('reactivoID' => $reactivoID));
    }
    
    function eliminarReactivo($reactivoID)
    {
        $this->db->delete('examen.reactivo', array('reactivoID' => $reactivoID));
    }
    
    function insertOpcion($reactivoID, $opcion)
    {
        $data = array('reactivoID' => $reactivoID, 'opcion' => $opcion);
        $this->db->insert('examen.opcion', $data);
    }
    
    function updateOpcion($reactivoID, $opcion, $opcionID)
    {
        $data = array('opcion' => $opcion);
        $this->db->update('examen.opcion', $data, array('opcionID' => $opcionID));
    }
    
    function deleteOpcion($opcionID)
    {
        $this->db->delete('examen.opcion', array('opcionID' => $opcionID));
    }
    
    function asignaRespuestaCorrecta($reactivoID, $opcionID)
    {
        $this->db->update('examen.opcion', array('correcta' => 0), array('reactivoID' => $reactivoID));
        $this->db->update('examen.opcion', array('correcta' => 1), array('opcionID' => $opcionID));
    }
    
    function getMensajeCorrecto($reactivoID)
    {
        $this->db->where('reactivoID', $reactivoID);
        $this->db->where('correcta', 1);
        
        $query = $this->db->get('examen.opcion');
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            return '<div class="alert alert-block alert-success fade in">
                              <h4 class="alert-heading">Respuesta Correcta Seleccionada!</h4>
                              <p>
                                  '.$row->opcion.'
                              </p>
                          </div>';
            
        }else{
            return null;
        }
    }
    
    function getEnunciadoByExamenID($examenID)
    {
        $sql = "SELECT * 
FROM examen.enunciado o
join examen.examen e using(examenID)
where examenID = ?;";
        
        $query = $this->db->query($sql, $examenID);
        
        return $query;
    }

    function getEnunciadoByEnunciadoID($enunciadoID)
    {
        $sql = "SELECT * 
FROM examen.enunciado o
join examen.examen e using(examenID)
where enunciadoID = ?;";
        
        $query = $this->db->query($sql, $enunciadoID);
        
        return $query;
    }

    function insertEnunciado($examenID, $enunciado)
    {
        $data = array('examenID' => $examenID, 'enunciado' => $enunciado);
        $this->db->insert('examen.enunciado', $data);
    }
    
    
    
     function getDistractorByExamenID($examenID)
    {
        $sql = "SELECT *
        FROM examen.examen_distractor 
        where examenID = ?;";
        
        $query = $this->db->query($sql, $examenID);
        
        return $query;
    }
    
    function insertDistractor($examenID,$distractor)
    {
        $data = array('examenID' => $examenID, 'distractor' => $distractor);
        $this->db->insert('examen.examen_distractor', $data);
    }
    
    
    function eliminarDistractor($distractorID)
    {
        $this->db->delete('examen.examen_distractor', array('distractorID' => $distractorID));
    }



    function updateEnunciado($examenID, $enunciado, $enunciadoID)
    {
        $data = array('enunciado' => $enunciado);
        $this->db->update('examen.enunciado', $data, array('enunciadoID' => $enunciadoID));
    }
    
    function eliminarEnunciado($enunciadoID)
    {
        $this->db->delete('examen.enunciado', array('enunciadoID' => $enunciadoID));
    }
    
    function guardaPalabra($enunciadoID, $palabra)
    {
        $this->db->where('enunciadoID', $enunciadoID);
        $this->db->where('palabra', $palabra);
        $query = $this->db->get('examen.palabra');
        
        if($query->num_rows() == 0)
        {
            $data = array('enunciadoID' => $enunciadoID, 'palabra' => $palabra);
            $this->db->insert('examen.palabra', $data);
        }else{
            $this->db->delete('examen.palabra', array('enunciadoID' => $enunciadoID, 'palabra' => $palabra));
        }
    }
    
    function getPalabraExist($enunciadoID, $palabra)
    {
        $this->db->where('enunciadoID', $enunciadoID);
        $this->db->where('palabra', $palabra);
        $query = $this->db->get('examen.palabra');
        
        if($query->num_rows() == 0)
        {
            return false;
        }else{
            return true;
        }
    }


    function getRelacionByExamenID($examenID)
    {
        $sql = "SELECT * 
FROM examen.relacion r
join examen.examen e using(examenID)
where examenID = ? order by r.relacionID;";
        
        $query = $this->db->query($sql, $examenID);
        
        return $query;
    }
    
    function getRelacion2ByExamenID($examenID)
    {
        $sql = "SELECT * 
FROM examen.relacion2 r
join examen.examen e using(examenID)
where examenID = ? order by r.relacionID;";
        
        $query = $this->db->query($sql, $examenID);
        
        return $query;
    }

    function getRelacionByRelacionID($relacionID)
    {
        $sql = "SELECT * 
FROM examen.relacion r
join examen.examen e using(examenID)
where relacionID = ?;";
        
        $query = $this->db->query($sql, $relacionID);
        
        return $query;
    }

    function getRelacion2ByRelacionID($relacionID)
    {
        $sql = "SELECT * 
FROM examen.relacion2 r
join examen.examen e using(examenID)
where relacionID = ?;";
        
        $query = $this->db->query($sql, $relacionID);
        
        return $query;
    }

    function insertRelacion($examenID, $concepto, $imagen)
    {
        $data = array('examenID' => $examenID, 'concepto' => $concepto, 'imagen' => $imagen);
        $this->db->insert('examen.relacion', $data);
    }
    
    function updateRelacion($examenID, $concepto, $imagen, $relacionID)
    {
        $data = array('concepto' => $concepto, 'imagen' => $imagen);
        $this->db->update('examen.relacion', $data, array('relacionID' => $relacionID));
    }
    
    function eliminarRelacion($relacionID)
    {
        $this->db->delete('examen.relacion', array('relacionID' => $relacionID));
    }
    
    function insertRelacion2($examenID, $conceptoA, $conceptoB)
    {
        $data = array('examenID' => $examenID, 'conceptoA' => $conceptoA, 'conceptoB' => $conceptoB);
        $this->db->insert('examen.relacion2', $data);
    }

    function updateRelacion2($examenID, $conceptoA, $conceptoB, $relacionID)
    {
        $data = array('conceptoA' => $conceptoA, 'conceptoB' => $conceptoB);
        $this->db->update('examen.relacion2', $data, array('relacionID' => $relacionID));
    }

    function eliminarRelacion2($relacionID)
    {
        $this->db->delete('examen.relacion2', array('relacionID' => $relacionID));
    }

    function insertImagen($examenID, $textoImagen, $imagen)
    {
        $data = array('examenID' => $examenID, 'textoImagen' => $textoImagen, 'imagen' => $imagen);
        $this->db->insert('examen.examen_imagen', $data);
    }
    
    function getImagenByExamenID($examenID)
    {
        $this->db->where('examenID', $examenID);
        $query = $this->db->get('examen.examen_imagen');
        
        return $query;
    }
    
    function imagenElimina($imagenID)
    {
        $this->db->delete('examen.examen_imagen', array('imagenID' => $imagenID));
    }
    
    function insertMaster()
    {
        $this->db->insert('examen.x', array('liberar' => 0));
    }
    
    function updateMaster($x, $liberar)
    {
        $this->db->update('examen.x', array('liberar' => $liberar), array('x' => $x));
        $this->db->update('examen.examen', array('liberar' => $liberar), array('x' => $x));
    }
    
    function getResultadoByMaster($x)
    {
        $sql = "SELECT x, c.id, succ, nombre, e.nomina, pat, mat, nom, calificacion, x
FROM examen.calificacionexamen c
join catalogo.cat_empleado e using(id)
left join catalogo.sucursal s on e.succ = s.suc
where x = ?
order by calificacion desc, pat asc, mat asc, nom asc;";
        
        $query = $this->db->query($sql, $x);
        
        return $query;
    }
    
    function getMaximo($x)
    {
        $sql = "SELECT sum(ponderacion*reactivos) as maximo 
        FROM examen.preguntas p
join examen.examen e using(examenID)
where x = ?;";
        
        $query = $this->db->query($sql, $x);
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            return $row->maximo;
        }else{
            return 0;
            
        }
        
    }
    
    function getGraficaMaster($x)
    {
        $sql = "SELECT
case when calificacion > 0 and calificacion <= (select cuarto from examen.maximo where x = ?) then 'D'
when calificacion > (select cuarto from examen.maximo where x = ?) and calificacion <= (select cuarto * 2 from examen.maximo where x = ?) then 'C'
when calificacion > (select cuarto * 2 from examen.maximo where x = ?) and calificacion <= (select cuarto * 3 from examen.maximo where x = ?) then 'B'
when calificacion > (select cuarto * 3 from examen.maximo where x = ?) and calificacion <= (select cuarto * 4 from examen.maximo where x = ?) then 'A'
end as clasificacion,
count(*) as empleados
FROM examen.calificacionexamen c
where x= ?
group by clasificacion;";
        
        $query = $this->db->query($sql, array($x, $x, $x, $x, $x, $x, $x, $x));
        
        return $query;
    }
    
    function getExamenByX($x)
    {
        $sql = "SELECT examenID, examen, tipoID FROM examen.examen e where x = ?;";
        $query = $this->db->query($sql, $x);
        return $query;
    }
    
    function getPreguntaByExamenIDPregunta($examenID, $pregunta, $tipoID)
    {
        switch ($tipoID) {
            case 1:
                $sql = "SELECT reactivo as pregunta FROM examen.reactivo r where reactivoID = ?;";
                $query = $this->db->query($sql, $pregunta);
                break;
            case 2:
                $sql = "SELECT enunciado as pregunta FROM examen.enunciado where enunciadoID = ?;";
                $query = $this->db->query($sql, $pregunta);
                break;
            case 3:
                $sql = "SELECT concepto as pregunta FROM examen.relacion r where relacionID = ?;";
                $query = $this->db->query($sql, $pregunta);
                break;
            case 4:
                $sql = "SELECT concat(conceptoA, ' - ', conceptoB) as pregunta FROM examen.relacion2 r where relacionID = ?;";
                $query = $this->db->query($sql, $pregunta);
                break;
        }
        
        $row = $query->row();
        return $row->pregunta;
    }
    
    function getEmpleadoPreguntas($examenID, $pregunta, $correcta)
    {
        $sql = "SELECT succ, pat, mat, nom, e.nomina, s.nombre
FROM examen.resultados_detalle r
left join catalogo.cat_empleado e using(id)
left join catalogo.sucursal s on e.succ = s.suc
where examenID = ? and succ <= 3000 and correcta = ? and pregunta = ? order by succ, nomina;";
        
        $query = $this->db->query($sql, array($examenID, $correcta, $pregunta));
        
        return $query;

    }
    
    function getPorcentajeCorrectas($examenID)
    {
        $sql = "SELECT pregunta, count(*) as total, sum(case when correcta = 1 then 1 else 0 end) as correctas, sum(case when correcta = 0 then 1 else 0 end) as incorrectas 
        FROM examen.resultados_detalle r
join catalogo.cat_empleado e using(id)
where examenID = ? and succ <= 3000 group by pregunta order by pregunta;";

        $query = $this->db->query($sql, $examenID);
        
        return $query;
    }
    
    function getOpcionByIDByReacivoID($id, $reactivoID)
    {
        $sql = "SELECT opcionID FROM examen.reactivo_respuesta r where reactivoID = ? and id = ?;";
        $query = $this->db->query($sql, array($reactivoID, $id));
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            return $row->opcionID;
        }else{
            return 0;
        }
    }
    
    function getMesAltas()
    {
     $s="select a.*, year(fecha_i) as aaa, month(fecha_i) as mes, c.mes as mesx from catalogo.cat_alta_empleado a
         join catalogo.sucursal b on a.suc = b.suc
         join catalogo.mes c on c.num=month(fecha_i)
         where b.tlid = 1 and a.motivo = 'ALTA' and tipo3 in('FA','MO','DA','FE')
         and fecha_i >= '2016-01-01'
         group by year(fecha_i),month(fecha_i)
         order by year(fecha_i) desc ,month(fecha_i) desc";
     $q=$this->db->query($s);
     return $q;
    }
    
    function empleado_alta_detalle($aaa,$mes)
    {
      $s="select a.*, year(fecha_i) as aaa, month(fecha_i) as mes, c.mes as mesx,b.nombre as sucx from catalogo.cat_alta_empleado a
         join catalogo.sucursal b on a.suc = b.suc
         join catalogo.mes c on c.num=month(fecha_i)
         where b.tlid = 1 and a.motivo = 'ALTA' and tipo3 in('FA','MO','DA','FE')
         and year(fecha_i) = $aaa and month(fecha_i) = $mes
         group by b.suc
         order by b.suc desc";
     $q=$this->db->query($s);
     return $q;   
    }
    
    
    function empleado_alta_detalle_c($aaa,$mes,$suc)
    {
     $s="select a.*, year(fecha_i) as aaa, month(fecha_i) as mes, c.mes as mesx,b.nombre as sucx,concat(a.pat,' ', a.mat,' ', a.nom) as nom_e from catalogo.cat_alta_empleado a
         join catalogo.sucursal b on a.suc = b.suc
         join catalogo.mes c on c.num=month(fecha_i)
         where b.tlid = 1 and a.motivo = 'ALTA' and tipo3 in('FA','MO','DA','FE')
         and year(fecha_i) = $aaa and month(fecha_i) = $mes and a.suc = $suc
         order by a.empleado desc";
     $q=$this->db->query($s);
     return $q;
    }
}