<?php
class medicos_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function getMedicos()
    {
        $sql = "SELECT * FROM medicos.medicos where est = 1;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
     function muestra_especialidad(){
       $s = "select * from medicos.especialidad where tipo = 1";
       $q = $this->db->query($s);
       $especialidad = array();
       $especialidad[0] = "Selecciona especialidad";
        foreach ($q->result() as $r) {
            $especialidad[$r->id_esp] = $r->especialidad;
        }
        return $especialidad;  
     }
     
     
     function checaCedula($cedula)
     {
        $s = "select count(*) as cuenta FROM medicos.medicos where cedula = ?";
        return $this->db->query($s, array($cedula));     
     }
     
     function traeEspecialidad($esp){
        $s = "select especialidad FROM medicos.especialidad where id_esp = ?";        
        $q = $this->db->query($s, array($esp)); 
        if($q->num_rows() == 0){
           return null;
        }else{
           $row = $q->row();
           return json_encode($q->result_array());
        } 
     }
     
     
     function Busca_cp($codp){
        $s ="SELECT d_asenta, d_mnpio, d_estado, d_ciudad FROM medicos.codigos_cp where d_codigos = ? order by d_asenta;";
        $q = $this->db->query($s,array($codp));
        if($q->num_rows() == 0){
           return null;
        }else{
           $row = $q->row();
           return json_encode($q->result_array());
        }
     }
     
     function Busca_colonia($codp){
        $sql = "SELECT id,d_asenta FROM medicos.codigos_cp where d_codigos = $codp order by d_asenta;";
        $query = $this->db->query($sql);        
         if($query->num_rows() == 0){
            $tabla = 0;
         }else{
        $tabla = "<option value=\"-\">Seleccione una Colonia</option>";
        foreach($query->result() as $row){            
             $tabla.="<option value =\"".$row->id."\">".$row->d_asenta."</option>
            ";
         } 
        }  
        return $tabla;  
     }
     
     function colonias($codp){
       $s = "SELECT id,d_asenta FROM medicos.codigos_cp where d_codigos = $codp order by d_asenta";
       $q = $this->db->query($s);
       $colonias = array();
       $colonias[0] = "Selecciona una Colonia";
        foreach ($q->result() as $r) {
            $colonias[$r->id] = $r->d_asenta;
        }
        return $colonias;  
     }
     
     function obten_Colonia($colonia){
        $sql = "SELECT id,d_asenta FROM medicos.codigos_cp where id = $colonia order by d_asenta;";
        $query = $this->db->query($sql); 
         if($query->num_rows() == 0){
           return null;
        }else{
           $row = $query->row();
           return json_encode($query->result_array());
        }
     }
     
     function ve_colonia($col){
        $sql = "SELECT id FROM medicos.codigos_cp where d_asenta = '$col'";
        $query = $this->db->query($sql);
         if($query->num_rows() == 0){
           return null;
        }else{
           $row = $query->row();
           return $row->id;
        }
     }
    
    function insertMedico($cedula,$apaterno,$amaterno,$nombre,$esp,$especialidad,$codp,$col,$mnpio,$estado,$ciudad,$dire,$telefono,$tipo_com,$tipo_cuenta,$cuenta,$tipo,$est)
    {
        $data = array('cedula' => $cedula,'apaterno' => $apaterno,'amaterno' => $amaterno,'nombre' => $nombre, 'id_esp' => $esp,'especialidad' => $especialidad,'codp' => $codp, 'col' => $col,'mnpio' => $mnpio,'estado' => $estado,'ciudad' => $ciudad,'dire' => $dire,
                      'telefono' => $telefono, 'id_comision' => $tipo_com, 'comision'=>0, 'id_cuenta' => $tipo_cuenta,'numero_cuenta' => $cuenta,'tipo' => $tipo, 'est' => $est);
        $this->db->insert('medicos.medicos', $data);
    }
    
    function busca_med($id_med)
    {
      $s="select * from medicos.medicos where id_med = $id_med";
      $q = $this->db->query($s);
      return $q;
    }
    
     function getMedicosIn()
    {
        $sql = "SELECT * FROM medicos.medicos where est = 2;";
        
        $query = $this->db->query($sql);
        
        return $query;
    }
    
    function busca_dato(){
     $sql = "select * from medicos.busqueda";
     $query = $this->db->query($sql);
     $dato = array();
     $dato[0] = "Selecciona tipo de busqueda";
        foreach ($query->result() as $row) {
            $dato[$row->var] = $row->tipo_busqueda;
        }
        return $dato;
        
    }
    
    
    function busca_medico($c) //$bus,$condicion
    {
      $s = "select * from medicos.medicos where est = 1 and $c";
      $q = $this->db->query($s);
      return $q;
    }
    
    function busca_medico_in($c){
      $s = "select * from medicos.medicos where est = 2 and $c";
      $q = $this->db->query($s);
      return $q;
    }
    
    function tipo_tarjeta(){
      $s = "select * from medicos.cuentas";
      $q = $this->db->query($s);
      $tipo_cuenta = array();
      $tipo_cuenta[0] = "Selecciona tipo de cuenta";
      foreach ($q->result() as $r) {
        $tipo_cuenta[$r->id_cuenta] = $r->cuenta;
      }
    return $tipo_cuenta;   
  }

    
   
    
}  
    