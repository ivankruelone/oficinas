<?php
class Retail_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function cargar_datos_receta($suc, $perini, $perfin)
    {
        $sql_delete = "delete from retail.receta where suc = ? and fecha between ? and ?;";
        
        $this->db->query($sql_delete, array($suc, $perini, $perfin));
        
        $sql = "select consecutivo, cvecentrosalud, cvesuministro, cvearticulo, presentacion, costounitario, 
       cantidadrequerida, cantidadsurtida, saldo, fecha, descripcion, idsurtido, 
       tiporequerimiento, folioreceta, idprograma, status from receta 
       where cvecentrosalud = ? and fecha between ? and ?;";
       
       $edomex = $this->load->database('edomex', TRUE);
       
       $query = $edomex->query($sql, array($suc, $perini, $perfin));
       
       $a = array();
       
       foreach($query->result() as $row)
       {
        
        $b = array('suc' => $row->cvecentrosalud,
                'consecutivo' => $row->consecutivo,
                'suministro' => $row->cvesuministro,
                'clave' => trim($row->cvearticulo),
                'descripcion' => trim($row->descripcion),
                'presentacion' => trim($row->presentacion),
                'precio' => $row->costounitario,
                'canreq' => $row->cantidadrequerida,
                'cansur' => $row->cantidadsurtida,
                'saldo' => $row->saldo,
                'fecha' => $row->fecha,
                'surtido' => $row->idsurtido,
                'requerimiento' => $row->tiporequerimiento,
                'folio' => trim($row->folioreceta),
                'programa' => $row->idprograma,
                'estatus' => trim($row->status)
                );
        
        array_push($a, $b);
        
       }
       
       $this->db->insert_batch('retail.receta', $a);
    }

    function cargar_datos_receta_michoacan($perini, $perfin)
    {
        $sql_delete = "delete from retail.receta_michoacan where fecha between ? and ?;";
        
        $this->db->query($sql_delete, array($perini, $perfin));
        
        $sql = "select consecutivo, cvecentrosalud, cvesuministro, cvearticulo, presentacion, costounitario, 
       cantidadrequerida, cantidadsurtida, saldo, fecha, descripcion, idsurtido, 
       tiporequerimiento, folioreceta, idprograma, status, 
       cvepaciente, nombre, apaterno, amaterno, cvemedico, nombremedico 
       from receta 
       where fecha between ? and ?;";
       
       $externa = $this->load->database('michoacan', TRUE);
       
       $query = $externa->query($sql, array($perini, $perfin));
       
       $a = array();
       
       foreach($query->result() as $row)
       {
        
        $b = array('suc' => $row->cvecentrosalud,
                'consecutivo' => $row->consecutivo,
                'suministro' => $row->cvesuministro,
                'clave' => trim($row->cvearticulo),
                'descripcion' => trim($row->descripcion),
                'presentacion' => trim($row->presentacion),
                'precio' => $row->costounitario,
                'canreq' => $row->cantidadrequerida,
                'cansur' => $row->cantidadsurtida,
                'saldo' => $row->saldo,
                'fecha' => $row->fecha,
                'surtido' => $row->idsurtido,
                'requerimiento' => $row->tiporequerimiento,
                'folio' => trim($row->folioreceta),
                'programa' => $row->idprograma,
                'estatus' => trim($row->status),
                'cvePaciente' => trim($row->cvepaciente),
                'nombre' => trim($row->nombre),
                'aPaterno' => trim($row->apaterno),
                'aMaterno' => trim($row->amaterno),
                'cveMedico' => trim($row->cvemedico),
                'nombreMedico' => trim($row->nombremedico)
                );
        
        array_push($a, $b);
        
       }
       
       $this->db->insert_batch('retail.receta_michoacan', $a);
    }

    function cargar_datos_receta_michoacan_json($perini, $perfin, $suc, $programa, $suministro, $control, $requerimiento)
    {
        //$sql_delete = "delete from retail.receta_michoacan where fecha between ? and ?;";
        
        //$this->db->query($sql_delete, array($perini, $perfin));
		
        
        $sql = "select consecutivo, cvecentrosalud, cvesuministro, cvearticulo, presentacion, costounitario, 
       cantidadrequerida, cantidadsurtida, saldo, fecha, descripcion, idsurtido, 
       tiporequerimiento, folioreceta, idprograma, status, 
       cvepaciente, nombre, apaterno, amaterno, cvemedico, nombremedico, remision
       from receta 
       where fecha between ? and ? and cvecentrosalud = ? and idprograma = ? and cvesuministro = ? and tiporequerimiento = ?;";
       
       $externa = $this->load->database('michoacan', TRUE);
       
       $query = $externa->query($sql, array($perini, $perfin, $suc, $programa, $suministro, $requerimiento));
       
       $a = array();
       
       foreach($query->result() as $row)
       {
        
        $b = array('suc' => $row->cvecentrosalud,
                'consecutivo' => $row->consecutivo,
                'suministro' => $row->cvesuministro,
                'clave' => trim($row->cvearticulo),
                'descripcion' => trim($row->descripcion),
                'presentacion' => trim($row->presentacion),
                'precio' => $row->costounitario,
                'canreq' => $row->cantidadrequerida,
                'cansur' => $row->cantidadsurtida,
                'saldo' => $row->saldo,
                'fecha' => $row->fecha,
                'surtido' => $row->idsurtido,
                'requerimiento' => $row->tiporequerimiento,
                'folio' => trim($row->folioreceta),
                'programa' => $row->idprograma,
                'estatus' => trim($row->status),
                'cvePaciente' => trim($row->cvepaciente),
                'nombre' => trim($row->nombre),
                'aPaterno' => trim($row->apaterno),
                'aMaterno' => trim($row->amaterno),
                'cveMedico' => trim($row->cvemedico),
                'nombreMedico' => trim($row->nombremedico),
                'control' => $control
                );
        
        array_push($a, $b);
        
       }
       
       echo json_encode($a);
       
       //$this->db->insert_batch('retail.receta_michoacan', $a);
    }
	
	
    function cargar_datos_receta_michoacan_remision_json($remision, $control)
    {
        //$sql_delete = "delete from retail.receta_michoacan where fecha between ? and ?;";
        
        //$this->db->query($sql_delete, array($perini, $perfin));
        
		
        
        $sql = "select r.consecutivo, r.cvecentrosalud, r.cvesuministro, r.cvearticulo, r.presentacion, r.costounitario, 
       r.cantidadrequerida, r.cantidadsurtida, r.saldo, r.fecha, r.descripcion, r.idsurtido, 
       r.tiporequerimiento, r.folioreceta, r.idprograma, r.status, 
       r.cvepaciente, r.nombre, r.apaterno, r.amaterno, r.cvemedico, r.nombremedico, r.remision, trim(r.completo) as completo, r.nivelatencion
       from receta r
       where remision = ?;";
       
       $externa = $this->load->database('michoacan', TRUE);
       
        if($remision < 1925)
        {
                $sql_des1 = "update receta 
set completo = receta.completo
from articulos
where receta.cvearticulo = articulos.cvearticulo and remision = ?;";
                
                $sql_des2 = "update receta
set completo = descri
from temporal_cuadro_mich
where receta.cvearticulo = temporal_cuadro_mich.clave and receta.nivelatencion = temporal_cuadro_mich.nivel and temporal_cuadro_mich.programa = receta.idprograma and remision = ?;";
            
                $externa->query($sql_des1, $remision);
                $externa->query($sql_des2, $remision);

        }

       $query = $externa->query($sql, array($remision));
       
       $a = array();
       
       foreach($query->result() as $row)
       {
        
        $b = array('suc' => $row->cvecentrosalud,
                'consecutivo' => $row->consecutivo,
                'suministro' => $row->cvesuministro,
                'clave' => trim($row->cvearticulo),
                'descripcion' => ($row->completo),
                'presentacion' => trim($row->presentacion),
                'precio' => $row->costounitario,
                'canreq' => $row->cantidadrequerida,
                'cansur' => $row->cantidadsurtida,
                'saldo' => $row->saldo,
                'fecha' => $row->fecha,
                'surtido' => $row->idsurtido,
                'requerimiento' => $row->tiporequerimiento,
                'folio' => trim($row->folioreceta),
                'programa' => $row->idprograma,
                'estatus' => trim($row->status),
                'cvePaciente' => trim($row->cvepaciente),
                'nombre' => trim($row->nombre),
                'aPaterno' => trim($row->apaterno),
                'aMaterno' => trim($row->amaterno),
                'cveMedico' => trim($row->cvemedico),
                'nombreMedico' => trim($row->nombremedico),
                'control' => $control,
                'remision' => $row->remision,
                'nivelatencion' => $row->nivelatencion
                );
        
        array_push($a, $b);
        
       }
       
       //echo "<pre>";
       //print_r($a);
       //echo "</pre>";
       
       echo json_encode($a);
       
       //$this->db->insert_batch('retail.receta_michoacan', $a);
    }
    
    function normalizaEdomex($remision)
    {
       $externa = $this->load->database('edomex', TRUE);
       
       $sql_cuadro = "update receta set cuadro = 0 where remision = ?;";
       
       $externa->query($sql_cuadro, array($remision));
       
       $sql_precios = "update receta
set cvesuministro = catalogo.cvesuministro, descripcion = catalogo.descripcion, presentacion = catalogo.presentacion, costounitario = case when fecha >= '2014-01-01' then precio2014 else precio2013 end, cuadro = case when fecha >= '2014-01-01' and precio2014 > 0 then 1 when fecha < '2014-01-01' and precio2013 > 0 then 1 else 0 end
from catalogo
where receta.cvearticulo = catalogo.clave and remision = ?;";

       $externa->query($sql_precios, array($remision));
       
       $sql_normalizar_saldo = "update receta set saldo = costounitario * cantidadsurtida where remision = ?;";
       
       $externa->query($sql_normalizar_saldo, array($remision));
       
       $sql1 = "update receta set cvearticulo2 = cvearticulo, descripcion2 = descripcion, presentacion2 = presentacion, cvesuministro2 = cvesuministro,  costounitario2 = costounitario, saldo2 = saldo where remision = ? and cuadro = 1;";
       
       $externa->query($sql1, array($remision));
       
       $sql2 = "update 
receta 
set cvearticulo2 = catalogo_fc.clave2, descripcion2 = catalogo_fc.des2, presentacion2 = catalogo_fc.pres2, cvesuministro2 = catalogo_fc.cvesuministro2,  costounitario2 = precio2, saldo2 = precio2 * cantidadsurtida
from catalogo_fc
where catalogo_fc.clave = receta.cvearticulo and remision = ? and cuadro = 0;";

       $externa->query($sql2, array($remision));
       
       $sql3 = "update receta set costounitario2 = costounitario2 / 1.16 where cvesuministro2 = 1;";
       $externa->query($sql3, array($remision));

       $sql4 = "update receta set saldo2 = costounitario2 * cantidadsurtida where remision = ?;";
       $externa->query($sql4, array($remision));
        
    }
	
    function cargar_datos_receta_edomex_remision_json($remision, $control, $tipo)
    {
        $this->normalizaEdomex($remision);
        //$sql_delete = "delete from retail.receta_michoacan where fecha between ? and ?;";
        
        //$this->db->query($sql_delete, array($perini, $perfin));
		
        
        $sql = "select consecutivo, cvecentrosalud, cvesuministro2, cvearticulo2, presentacion2, costounitario2, 
       cantidadrequerida, cantidadsurtida, saldo2, fecha, descripcion2, idsurtido, 
       tiporequerimiento, folioreceta, idprograma, status, 
       cvepaciente, nombre, apaterno, amaterno, cvemedico, nombremedico, remision, cuadro
       from receta 
       where remision = ? and cvesuministro2 = ? and status = 't' and costounitario2 > 0;";
       
       $externa = $this->load->database('edomex', TRUE);
       

       $query = $externa->query($sql, array($remision, $tipo));
       
       //echo $externa->last_query();
       
       $a = array();
       
       foreach($query->result() as $row)
       {
        
        $b = array('suc' => $row->cvecentrosalud,
                'consecutivo' => $row->consecutivo,
                'suministro' => $row->cvesuministro2,
                'clave' => trim($row->cvearticulo2),
                'descripcion' => trim($row->descripcion2),
                'presentacion' => trim($row->presentacion2),
                'precio' => $row->costounitario2,
                'canreq' => $row->cantidadrequerida,
                'cansur' => $row->cantidadsurtida,
                'saldo' => $row->saldo2,
                'fecha' => $row->fecha,
                'surtido' => $row->idsurtido,
                'requerimiento' => $row->tiporequerimiento,
                'folio' => trim($row->folioreceta),
                'programa' => $row->idprograma,
                'estatus' => trim($row->status),
                'cvePaciente' => trim($row->cvepaciente),
                'nombre' => trim($row->nombre),
                'aPaterno' => trim($row->apaterno),
                'aMaterno' => trim($row->amaterno),
                'cveMedico' => trim($row->cvemedico),
                'nombreMedico' => trim($row->nombremedico),
                'control' => $control,
                'remision' => $row->remision,
                'cuadro' => $row->cuadro
                );
        
        array_push($a, $b);
        
       }
       
       echo json_encode($a);
       
       //$this->db->insert_batch('retail.receta_michoacan', $a);
    }

	function getDatosFromMichoacanJson($perini, $perfin, $suc)
	{
	
		$sql = "select cvecentrosalud, cvesuministro, tiporequerimiento, idprograma, status, sum(cantidadrequerida) as cantidadrequerida, sum(cantidadsurtida) as cantidadsurtida, sum(saldo) as saldo
from receta 
where fecha between ? and ? and cvecentrosalud = ?
group by cvecentrosalud, cvesuministro, tiporequerimiento, idprograma, status;";

		$externa = $this->load->database('michoacan', TRUE);

		$query = $externa->query($sql, array($perini, $perfin, $suc));
		
		$a = array();

       foreach($query->result() as $row)
       {
        
        $b = array('suc' => $row->cvecentrosalud,
                'suministro' => $row->cvesuministro,
                'requerimiento' => $row->tiporequerimiento,
                'programa' => $row->idprograma,
                'estatus' => trim($row->status),
                'canreq' => $row->cantidadrequerida,
                'cansur' => $row->cantidadsurtida,
                'saldo' => $row->saldo
                );
        
        array_push($a, $b);
        
       }
       
       echo json_encode($a);
	
	}
		
	function getDatosFromMichoacanRemisionJson($remision)
	{
	
		$sql = "select * from remision where remision = ?;";

		$externa = $this->load->database('michoacan', TRUE);

		$query = $externa->query($sql, array($remision));
        
        $a = array();
        
        if($query->num_rows() > 0)
        {
            $a['existe'] = 1;
            $row = $query->row();
            $a['arreglo'] = $row;
        }else{
            $a['existe'] = 0;
        }
		
		
       
       echo json_encode($a);
	
	}
		
	function getDatosFromEdomexRemisionJson($remision)
	{
	   
		$sql = "select * from remision where remision = ?;";

		$externa = $this->load->database('edomex', TRUE);
        
        $externa->query("update receta set cuadro = 0 where remision = ?;", $remision);
        
        $externa->where('remision', $remision);
        $rem = $externa->get('remision');
        $ro = $rem->row();
        
        if($ro->perini >= '2014-01-01'){

            $externa->query("update receta set cuadro = 1 from catalogo where  receta.cvearticulo = catalogo.clave and remision = ? and precio2014 > 0;", $remision);
            
        }else{

            $externa->query("update receta set cuadro = 1 from catalogo where  receta.cvearticulo = catalogo.clave and remision = ? and precio2013 > 0;", $remision);
            
        }

		$query = $externa->query($sql, array($remision));
        
        $a = array();
        
        if($query->num_rows() > 0)
        {
            $a['existe'] = 1;
            $row = $query->row();
            $a['arreglo'] = $row;
        }else{
            $a['existe'] = 0;
        }
		
		
       
       echo json_encode($a);
	
	}

}