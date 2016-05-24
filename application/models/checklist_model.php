<?php
class checklist_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function getEvaluacion()
    {
        $sql = "SELECT v.id, v.valoracion,v.descripcion,v.instrucciones, v.objetivo
                FROM checklist.valoracion v
                join checklist.clasificacion c on c.id = v.id;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function getTipoCombo()
    {
        $query = $this->db->get('checklist.tipo');
        
        $a = array();
        
        foreach($query->result() as $row)
        {
            $a[$row->tipo] = $row->descripcion;
        }
        
        return $a;
    }
    
    
    function getValoracionByValoracion($id)
    {
        $sql = "SELECT *
                FROM checklist.valoracion v
                join checklist.tipo t using(descripcion)
                where id = $id;";
        
        $query = $this->db->query($sql, $id);
        
        return $query;
    }
    
   
    
    function updatevaloracion($id, $valoracion, $descripcion,$instrucciones,$objetivo)
    {
        $data = array('id' => $id, 'valoracion' => $valoracion, 'descripcion' => $descripcion, 'instrucciones' => $instrucciones,'objetivo' => $objetivo);
        $this->db->update('checklist.valoracion', $data, array('id' => $id));
    }
    
    function getTipo3BySuc($suc)
    {
        $sql = "SELECT tipo3 FROM catalogo.sucursal s where suc = ?;";
        $query = $this->db->query($sql, $suc);
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            return $row->tipo3;
        }else{
            return 'X';
        }
    }

    function getPreguntas($id, $suc)
    {
        $tipo3 = $this->getTipo3BySuc($suc);
        
        $sql = "SELECT id, idpregunta,pregunta,vale,tipo3,observaciones FROM checklist.preguntas p
                where id = ? and tipo3 in('X', ?);";
                
        $query = $this->db->query($sql, array($id, $tipo3));
        
        return $query;
    }
    
    
     function getpregunta($id)
    {
       
        $sql = "SELECT *
                FROM checklist.preguntas p
                where id= $id"; //and idpregunta = $idpregunta;";
        
        $query = $this->db->query($sql); //$idpregunta);
        
        return $query;
    }
    
    function getPreguntas_edita($id, $idpregunta)
    {
        
        
        $sql = "SELECT id,idpregunta,pregunta,vale,tipo3,observaciones, tipo FROM checklist.preguntas p
                where id = ? and idpregunta = ?;";
                
        $query = $this->db->query($sql,array($id, $idpregunta));
        
        return $query;
    }
    
    
    function updatepreguntas($data,$idpregunta)
    {

        $this->db->where('idpregunta', $idpregunta);
        $query = $this->db->get('checklist.preguntas');
        if($query->num_rows() > 0){
        $this->db->update('checklist.preguntas', $data, array('idpregunta' => $idpregunta));  //, 'pregunta' => $pregunta));
        }else{
            
        }
    }

    function muestra_tipo()
    {
      $s = "SELECT * FROM checklist.tipo t";
      
      $q = $this->db->query($s); 
      $tipos = array();
      foreach($q->result() as $r)
      {
        $tipos[$r->tipo] = $r->descripcion;
      } 
      return $tipos;
    }


    function muestra_vale()
    {
      $s = "SELECT vale FROM checklist.preguntas";
      
      $q = $this->db->query($s); 
      $vale = array();
      foreach($q->result() as $r)
      {
             $vale[$r->vale == 1] = 'Activo';
             $vale[$r->vale == 0] = 'No Activo';
        
 
      } 
      return $vale;
    }
    
    function muestra_tipofarmacia()
    {
      $s = "SELECT * FROM checklist.tipo_farmacia";
      
      $q = $this->db->query($s); 
      $tipo3 = array();
      foreach($q->result() as $r)
      {
             $tipo3[$r->tipo3] = $r->tipo3Descripcion;
        
 
      } 
      return $tipo3;
    }


    
    function insertPregunta($id,$pregunta,$tipo, $tipo3)
    {
        $data = array('id' => $id, 'pregunta' => $pregunta,'tipo' => $tipo, 'tipo3' => $tipo3);
        $this->db->insert('checklist.preguntas', $data);
    }
    
    function deletePregunta($id,$idpregunta)
    {
        $data = array('id' => $id, 'idpregunta' => $idpregunta);
        $this->db->delete('checklist.preguntas', $data);
        
    }
    
    function getponderacion()
    {
        $sql = "SELECT * FROM checklist.ponderaciones p;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function updateponderacion($id,$tipoFarmacia,$valor,$calificacion)
    {
        $data = array('id' => $id, 'tipoFarmacia' => $tipoFarmacia, 'valor' => $valor, 'calificacion' => $calificacion);
        $this->db->update('checklist.ponderaciones', $data, array('id' => $id));
    }
    
    function getperiodos($realizado)
    {
        $sql = "SELECT periodo_sucursalID,periodoID,o.ano,o.mes,suc,nombre,realizado, valor, maximo, porcentaje, ponderacion
        FROM checklist.periodo_sucursal p
        join catalogo.sucursal s using(suc)
        join checklist.periodo o using(periodoID)
        left join checklist.ponderacion n using(periodoID, suc)
        where superv = ? and realizado = ?
        order by periodoID, suc * 1;";
        
        $query = $this->db->query($sql, array($this->session->userdata('id_plaza'), $realizado));
        
        return $query;
    }    
    
    
    function getperiodos_reg($realizado)
    {
        $sql = "SELECT periodo_sucursalID,periodoID,o.ano,o.mes,suc,nombre,realizado, valor, maximo, porcentaje, ponderacion
        FROM checklist.periodo_sucursal p
        join catalogo.sucursal s using(suc)
        join checklist.periodo o using(periodoID)
        left join checklist.ponderacion n using(periodoID, suc)
        where regional = ? and realizado = ?
        order by periodoID,suc;";
        
        $query = $this->db->query($sql, array($this->session->userdata('id_plaza'), $realizado));
        
        return $query;
    }    
    
    function getclasificacion()
    {
        $sql = "select id,titulo,objetivo,nota from checklist.clasificacion c";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function getValor($periodo_sucursalID, $idpregunta)
    {
        
        $sql = "SELECT c.valor, c.tipo, case when r.valor is null then null else 'checked' end as checado FROM checklist.calificacion c
                left join checklist.resultado r on c.valor = r.valor and r.periodo_sucursalID = ? and idpregunta = ?;";
        
        $query = $this->db->query($sql, array($periodo_sucursalID, $idpregunta));
        
        return $query;
    }
    
    
    function replacesavePalabra($periodo_sucursalID,$idpregunta,$valor)
    {
        $data = array('periodo_sucursalID' => $periodo_sucursalID, 'idpregunta' => $idpregunta,'valor' => $valor);
        $this->db->replace('checklist.resultado', $data);
    }
    
    
    function replacesaveObservacion($periodo_sucursalID,$idpregunta,$valor)
    {
        $data = array('observaciones_texto' => $valor);
        $this->db->update('checklist.resultado', $data, array('periodo_sucursalID' => $periodo_sucursalID, 'idpregunta' => $idpregunta));
    }

////////////////////////////////////////////////////////////////////////////////////


    function getPeriodo()
    {
        $sql = "SELECT periodoID,mes,ano FROM checklist.periodo;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    
    function getResultados($periodoID)
    {
        
        $sql = "SELECT periodoID,p.suc,s.nombre,p.tipo3,valor,maximo,porcentaje,ponderacion FROM checklist.ponderacion p
                join catalogo.sucursal s on p.suc = s.suc
                where p.tipo3 = 'FE'
                and periodoID = ? 
                order by porcentaje desc;";
                
        $query = $this->db->query($sql,$periodoID);
        
        return $query;
    }
    
    
    function getResultados2($periodoID)
    {
        
        $sql = "SELECT periodoID,p.suc,s.nombre,p.tipo3,valor,maximo,porcentaje,ponderacion FROM checklist.ponderacion p
                join catalogo.sucursal s on p.suc = s.suc
                where p.tipo3 = 'DA' 
                and periodoID = ?
                order by porcentaje desc;";
                
        $query = $this->db->query($sql,$periodoID);
        
        return $query;
    }

    function getSecciones($suc, $periodoID)
    {
        
        $sql = "SELECT s.id, u.suc, valoracion FROM checklist.resultado r
                join checklist.periodo_sucursal p using(periodo_sucursalID)
                join checklist.preguntas s using(idpregunta)
                join checklist.calificacion c using(valor)
                join catalogo.sucursal u using(suc)
                join checklist.valoracion v on v.id = s.id
                where (s.tipo3 = 'X' or s.tipo3 = u.tipo3) and suc = ? and periodoID = ?
                group by s.id;";
                
        $query = $this->db->query($sql,array($suc, $periodoID));
        
        return $query;
    }
    
    
    function getSec_Observaciones($suc, $periodoID)
    {
        
        $sql = "SELECT observaciones,comentarios,seguimiento FROM checklist.periodo_sucursal
        where suc = ? and periodoID = ?;";
                
        $query = $this->db->query($sql,array($suc, $periodoID));
        
        return $query;
    }
     function getResultados_Sucursal($suc,$id, $periodoID)
    {
        
        $sql = "SELECT u.suc,u.nombre,s.id,s.idpregunta,s.pregunta,c.tipo,r.valor,r.observaciones_texto FROM checklist.resultado r
                join checklist.periodo_sucursal p using(periodo_sucursalID)
                join checklist.preguntas s using(idpregunta)
                join checklist.calificacion c using(valor)
                join catalogo.sucursal u using(suc)
                where (s.tipo3 = 'X' or s.tipo3 = u.tipo3) and s.id = ? and u.suc = ? and periodoID = ?
                order by idpregunta;";
                
        $query = $this->db->query($sql, array($id, $suc, $periodoID));
        
        return $query;
    }
    
    function getTotal_Resultado($suc,$id)
    {
     $sql = "SELECT sum(r.valor) as total FROM checklist.resultado r
              join checklist.periodo_sucursal p using(periodo_sucursalID)
              join checklist.preguntas s using(idpregunta)
                join checklist.calificacion c using(valor)
                join catalogo.sucursal u using(suc)
                where (s.tipo3 = 'X' or s.tipo3 = u.tipo3) and s.id = ? and u.suc = ?
                order by idpregunta";
     $query = $this->db->query($sql, array($id,$suc));
        
        return $query;
    }
    
   function getResultados_Sucursal2($suc,$id)
    {
        
        $sql = "SELECT u.suc,u.nombre,s.id,s.idpregunta,s.pregunta,c.tipo,r.valor,r.observaciones_texto,s.vale FROM checklist.resultado r
                join checklist.periodo_sucursal p using(periodo_sucursalID)
                join checklist.preguntas s using(idpregunta)
                join checklist.calificacion c using(valor)
                join catalogo.sucursal u using(suc)
                where (s.tipo3 = 'X' or s.tipo3 = u.tipo3) and s.id = $id and u.suc = $suc
                order by idpregunta;";
                
        $query = $this->db->query($sql, array($id,$suc));
        
        return $query;
    }
    
    /*
    
      function getObservacionescom($periodo_sucursalID)
    {
       
        $sql = "SELECT observaciones, comentarios FROM checklist.periodo_sucursal p
                where periodo_sucursalID = ?;";
        
        $query = $this->db->query($sql); 
        
        return $query;
    }
    
    */
    
    function updateObservacion_comentario($observaciones,$comentarios,$seguimiento,$periodoID,$suc,$realizado,$periodo_sucursalID)
    {
        $data = array('observaciones' => $observaciones, 'comentarios' => $comentarios,'seguimiento' => $seguimiento);
        $this->db->update('checklist.periodo_sucursal', $data,array('periodoID' => $periodoID,'suc' =>$suc,'realizado' =>$realizado,'periodo_sucursalID' =>$periodo_sucursalID));
    }
    
    
    function getObservaciones_comentarios($periodoID,$periodo_sucursalID,$suc)
    {
        
        $sql = "SELECT * FROM checklist.periodo_sucursal 
                where periodoID = ?  and periodo_sucursalID = ? and suc = ?;";
                
        $query = $this->db->query($sql, array($periodoID,$periodo_sucursalID,$suc));
        
        return $query;
    }
    
    function getSecciones_global($periodoID)
    {
        
        $sql = "SELECT v.periodoID,b.id,b.valoracion 
                FROM checklist.valuacionDetalleFinal v
                join checklist.valoracion b using(id)
                where periodoID = $periodoID
                group by id;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function getSecciones_global2($periodoID)
    {
        
        $sql = "SELECT c.id,v.valoracion,c.periodoID,c.ano,c.mes,c.valor,c.tipo3,c.maximo,c.porcentaje
                FROM checklist.calificacionGlobal c
                join checklist.valoracion v using (id)
                where periodoID = $periodoID;";
        
        $query = $this->db->query($sql,$periodoID);
        
        return $query;
    }
    
    function getResultados_global_detalle($periodoID,$id)
    {
        
        $sql = "select v.id,v.periodoID AS periodoID,v.suc AS suc,v.ano AS ano,v.mes AS mes,
                v.valor AS valor,v.tipo3 AS tipo3,m.maximo AS maximo,((v.valor / m.maximo) * 100) AS porcentaje
                from checklist.valuacionDetalleFinal v
                join checklist.maximoDetalle m on v.tipo3 = m.tipo3 and v.id = m.id
                where  periodoID = ?  and v.tipo3 = 'FE' and v.id = ? order by porcentaje desc;";
                
        $query = $this->db->query($sql, array($periodoID,$id));
        
        return $query;
    }


 function getResultados_global_detalle2($periodoID,$id)
    {
        
        $sql = "select v.id,v.periodoID AS periodoID,v.suc AS suc,v.ano AS ano,v.mes AS mes,
                v.valor AS valor,v.tipo3 AS tipo3,m.maximo AS maximo,((v.valor / m.maximo) * 100) AS porcentaje
                from checklist.valuacionDetalleFinal v
                join checklist.maximoDetalle m on v.tipo3 = m.tipo3 and v.id = m.id
                where  periodoID = ?  and v.tipo3 = 'DA' and v.id = ? order by porcentaje desc;";
                
        $query = $this->db->query($sql, array($periodoID,$id));
        
        return $query;
    }
}