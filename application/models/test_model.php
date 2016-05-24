<?php
class Test_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }
    
    function getPreguntaBySerie($serie)
    {
        $this->db->where('serie', $serie);
        $query = $this->db->get('test.tm_pregunta');
        //echo $this->db->last_query();
        //die();
        return $query;
    }
    
    function getSerieBySerie($serie)
    {
        $sql = "SELECT t.*, case when u.serie is null then 'NO' else 'SI' end as contestado 
        FROM test.tm_serie t
        left join test.tm_serie_usuario u on t.serie = u.serie and u.id = ?
        where t.serie = ?;";
        $query = $this->db->query($sql, array($this->session->userdata('id_desarro'), $serie));
        //echo $this->db->last_query();
        //die();
        return $query->row();
    }
    
    function getPreguntaByOpcion($opcion)
    {
        $this->db->select('pregunta');
        $this->db->where('opcion', $opcion);
        $query = $this->db->get('test.tm_opcion')->row();
        
        return $query->pregunta;
    }
    
    function getSerieByPregunta($pregunta)
    {
        $this->db->select('serie');
        $this->db->where('pregunta', $pregunta);
        $query = $this->db->get('test.tm_pregunta')->row();
        
        return $query->serie;
    }

    function insertRespuesta($opcion)
    {
        $pregunta = $this->getPreguntaByOpcion($opcion);
        $serie = $this->getSerieByPregunta($pregunta);
        $id = $this->session->userdata('id_desarro');
        
        if($serie == 4)
        {
            $this->db->where('pregunta', $pregunta);
            $this->db->where('opcion', $opcion);
            $this->db->where('id', $id);
            $query = $this->db->get('test.tm_respuesta2');
            
            if($query->num_rows() == 1)
            {
                $this->db->where('pregunta', $pregunta);
                $this->db->where('opcion', $opcion);
                $this->db->where('id', $id);
                $this->db->delete('test.tm_respuesta2');
            }else
            {
                $sql = "insert into test.tm_respuesta2 (pregunta, opcion, fecha, id) values ($pregunta, $opcion, now(), $id) on duplicate key update fecha = values(fecha);";
                $this->db->query($sql);
            }
            
        }else
        {
        
            $sql = "insert into test.tm_respuesta (pregunta, opcion, fecha, id) values ($pregunta, $opcion, now(), $id) on duplicate key update opcion = values(opcion), fecha = values(fecha);";
            $this->db->query($sql);
            
        }
        //respuesta, pregunta, opcion, fecha, id
    }
    
    function insertRespuestaValor($pregunta, $valor, $opcion)
    {
        $id = $this->session->userdata('id_desarro');

        //respuesta, pregunta, opcion, fecha, id
        
        $sql = "insert into test.tm_respuesta (pregunta, opcion, fecha, id, valor) values ($pregunta, $opcion, now(), $id, '$valor') on duplicate key update opcion = values(opcion), fecha = values(fecha), valor = values(valor);";
        $this->db->query($sql);
    }

    function insertRespuestaValor2($pregunta, $valor, $opcion)
    {
        $id = $this->session->userdata('id_desarro');

        //respuesta, pregunta, opcion, fecha, id
        
        $sql = "insert into test.tm_respuesta (pregunta, opcion, fecha, id, valor2) values ($pregunta, $opcion, now(), $id, '$valor') on duplicate key update opcion = values(opcion), fecha = values(fecha), valor2 = values(valor2);";
        $this->db->query($sql);
    }

   function insertTiempoRestante($tiempoRestanteActual, $serie)
    {
        //serie, id, tiempoTranscurrido, fecha
        $id = $this->session->userdata('id_desarro');
        $sql = "insert into test.tm_serie_usuario (serie, id, tiempoRestante, fecha) values ($serie, $id, $tiempoRestanteActual, now()) on duplicate key update tiempoRestante = values(tiempoRestante), fecha = values(fecha);";
        $this->db->query($sql);
    }
    
    
    function termanComienza($serie)
    {
        //tm_serie_usuario, serie, id, fechaComienzo, fechaCambio, fechaFin
        $id = $this->session->userdata('id_desarro');
        $sql = "insert into test.tm_serie_usuario (serie, id, fechaComienzo, fechaCambio) values ($serie, $id, NOW(), NOW()) on duplicate key update fechaCambio = values(fechaCambio);";
        $this->db->query($sql);
    }
    
    
    function getresultado()
    {
        $sql="SELECT sum(c.resultado) as resultado, c.id, trim(c.completo) as completo, c.puestox, SUBSTRING(curp, 11,1) as sexo, concat('19', SUBSTRING(rfc, 5,2),'-',SUBSTRING(rfc, 7,2),'-',SUBSTRING(rfc, 9,2)) as fecha_nacimiento, FLOOR(DATEDIFF(DATE(NOW()), concat('19', SUBSTRING(rfc, 5,2),'-',SUBSTRING(rfc, 7,2),'-',SUBSTRING(rfc, 9,2)))/365) AS edad 
                FROM test.tm_resultado_final c
                group by c.id order by resultado desc;";
        //$sql = "SELECT *, sum(resultado) as result FROM test.tm_resultado_final t 
        //group by id order by result desc;";
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $q;
    }
    
    function getresultado1($id)
    {
        $sql = "SELECT * FROM test.tm_resultado_final t where id=$id;";
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $q;
    }
    
    function getresultado_x_serie($id, $serie)
    {
        if($serie==1 || $serie==2 || $serie==6 || $serie==7 || $serie==8 || $serie==9){
            
        $sql = "select texto, textoOpcion, `t`.`id` AS `id`,`p`.`serie` AS `serie`, `p`.`respuestaCorrecta` , `test`.`tm_opcion`.`letra` as respuestaDada, case when respuestaCorrecta = letra then 'Bien' else 'Mal' end as resultado from ((`test`.`tm_respuesta` `t` join `test`.`tm_pregunta` `p` on((`t`.`pregunta` = `p`.`pregunta`))) join `test`.`tm_opcion` on((`t`.`opcion` = `test`.`tm_opcion`.`opcion`))) where ((`p`.`serie` in (1,2,6,7,8,9)))  and id=$id and serie=$serie order by `t`.`id`,`p`.`serie`, p.pregunta";
        
        }elseif($serie==3 || $serie==5){
            
        $sql= "select texto, textoOpcion, `t`.`id` AS `id`,`p`.`serie` AS `serie`, `p`.`respuestaCorrecta` , `t`.`valor` as respuestaDada, case when `p`.`respuestaCorrecta` = `t`.`valor` then 'Bien' else 'Mal' end as resultado from ((`test`.`tm_respuesta` `t` join `test`.`tm_pregunta` `p` on((`t`.`pregunta` = `p`.`pregunta`))) join `test`.`tm_opcion` on((`t`.`opcion` = `test`.`tm_opcion`.`opcion`))) where ((`p`.`serie` in (3,5))) and id=$id and serie=$serie order by `t`.`id`,`p`.`serie`, p.pregunta;";    
            
        }elseif($serie==10){
            
        $sql= "select texto, textoOpcion, `t`.`id` AS `id`,`p`.`serie` AS `serie`, `p`.`respuestaCorrecta` , `t`.`valor`, t.valor2, case when `p`.`respuestaCorrecta` = concat(`t`.`valor`, ',', t.valor2) then 'Bien' else 'Mal' end as resultado from ((`test`.`tm_respuesta` `t` join `test`.`tm_pregunta` `p` on((`t`.`pregunta` = `p`.`pregunta`))) join `test`.`tm_opcion` on((`t`.`opcion` = `test`.`tm_opcion`.`opcion`))) where ((`p`.`serie` = 10) and (`p`.`respuestaCorrecta` = concat(`t`.`valor`,_utf8',',`t`.`valor2`))) and id=$id and serie=$serie group by `p`.`serie`,`t`.`id` order by `t`.`id`,`p`.`serie`, p.pregunta;";    
            
        }elseif($serie==4){
            
        $sql= "select texto, group_concat(`o`.`textoOpcion` separator ' , ') as textoOpcion, serie, `t`.`id` AS `id`,`p`.`pregunta` AS `pregunta`,`p`.`respuestaCorrecta` AS `respuestaCorrecta`, group_concat(`o`.`letra` separator ',') AS `respuestaDada`, case when `p`.`respuestaCorrecta` = group_concat(`o`.`letra` separator ',') then 'Bien' else 'Mal' end as resultado from ((`test`.`tm_respuesta2` `t` join `test`.`tm_pregunta` `p` on((`t`.`pregunta` = `p`.`pregunta`))) join `test`.`tm_opcion` `o` on((`t`.`opcion` = `o`.`opcion`))) where id=$id and serie=$serie group by `t`.`id`,`p`.`pregunta`;";    
            
        }
        
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $q;
    }
    
    
////////////////////////////////////////////////////////////////////////cleaver///////////////////////////////////////

    function getPreguntaBySerie_cleaver()
    {
        $query = $this->db->get('test.cleaver_pregunta');
        //echo $this->db->last_query();
        //echo die;
        return $query;
    }

    function getSerieCleaver()
    {
        $sql = "SELECT serie FROM test.cleaver_pregunta c group by serie;";
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $query;
    }
    
    function insertCleaver($valor, $tipo)
    {
        //pregunta, tipo, id
        $id = $this->session->userdata('id_desarro');
        $serie = $this->getSeriebyPreguntaCleaver($valor);
        $sql = "insert into test.cleaver_respuesta (serie, tipo, pregunta, id, fecha) values($serie, '$tipo', $valor, $id, now()) on duplicate key update fecha = values(fecha), pregunta = values(pregunta);";
        
        $this->db->query($sql);
    }
    
    function getSeriebyPreguntaCleaver($pregunta)
    {
        $this->db->select('serie');
        $this->db->where('pregunta', $pregunta);
        $query = $this->db->get('test.cleaver_pregunta')->row();
        
        return $query->serie;
    }
    
    function getresultado_cleaver()
    {
        $sql = "SELECT c.id, c.fecha, trim(b.completo) as completo, b.puestox, SUBSTRING(curp, 11,1) as sexo, concat('19', SUBSTRING(curp, 5,2),'-',SUBSTRING(curp, 7,2),'-',SUBSTRING(curp, 9,2)) as fecha_nacimiento, FLOOR(DATEDIFF(DATE(NOW()), concat('19', SUBSTRING(curp, 5,2),'-',SUBSTRING(curp, 7,2),'-',SUBSTRING(curp, 9,2)))/365) AS edad FROM test.cleaver_respuesta c
                left join catalogo.cat_empleado b on c.id=b.id
                group by c.id;";
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $q;
    }
    
    function getresultado_cleaver1($id)
    {
        $sql="SELECT c.*, p.*, b.completo FROM test.cleaver_respuesta c
                join test.cleaver_pregunta p using(pregunta)
                left join catalogo.cat_empleado b on c.id=b.id
                where c.id=$id;";
            
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $query;
        
    }
    
   
    function comienzaCleaver()
    {
        $id = $this->session->userdata('id_desarro');
        
        $data = array('id' => $id);
        
        $this->db->insert('test.cleaver_control', $data);
    }
    
    function getCleaverTest()
    {
        $id = $this->session->userdata('id_desarro');
        $this->db->where('id', $id);
        $query = $this->db->get('test.cleaver_control')->num_rows();
        return $query;
    }
    
/////////////////////////////////////////////////////////////moss////////////////////////////////////////////////////////    
    
    function getMossTest()
    {
        $id = $this->session->userdata('id_desarro');
        $this->db->where('id', $id);
        $query = $this->db->get('test.moss_control')->num_rows();
        return $query;
    }
    
    function getSerieMoss()
    {
        
        $query = $this->db->get('test.moss_pregunta');
        //echo $this->db->last_query($query);
        //echo die;
        return $query;
    }
    
    function getPreguntaByOpcion1($opcion)
    {
        $this->db->select('pregunta');
        $this->db->where('opcion', $opcion);
        $query = $this->db->get('test.moss_opcion')->row();
        
        return $query->pregunta;
    }
    
    function insertMoss($opcion)
    {
        //respuesta, pregunta, opcion, fecha, id
        $pregunta = $this->getPreguntaByOpcion1($opcion);
        $id = $this->session->userdata('id_desarro');
        $sql = "insert into test.moss_respuesta (opcion, pregunta, id, fecha ) values( $opcion, $pregunta, $id, now()) on duplicate key update fecha = values(fecha), opcion=values(opcion);";
        $this->db->query($sql);
        
    }
    
    function comienzaMoss()
    {
        $id = $this->session->userdata('id_desarro');
        
        $data = array('id' => $id);
        
        $this->db->insert('test.moss_control', $data);
    }
    
    function getresultado_moss()
    {
        $sql = "SELECT c.id, c.fecha, c.buenas as resultado, trim(b.completo) as completo, b.puestox, SUBSTRING(curp, 11,1) as sexo, concat('19', SUBSTRING(curp, 5,2),'-',SUBSTRING(curp, 7,2),'-',SUBSTRING(curp, 9,2)) as fecha_nacimiento, FLOOR(DATEDIFF(DATE(NOW()), concat('19', SUBSTRING(curp, 5,2),'-',SUBSTRING(curp, 7,2),'-',SUBSTRING(curp, 9,2)))/365) AS edad FROM test.moss_resultado01 c
                left join catalogo.cat_empleado b on c.id=b.id
                order by resultado desc;";
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $q;
    }
    
    function getresultado_moss1($id)
    {
        $sql="SELECT c.pregunta, p.texto, respuestaCorrecta, o.letra as respuestaDada, o.textoOpcion, c.fecha, case when respuestaCorrecta=letra then 'Bien' else 'Mal' end as resultado
            FROM test.moss_respuesta c
            join test.moss_pregunta p using(pregunta)
            left join test.moss_opcion o using(opcion)
            where c.id=$id;";
            
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $query;
        
    }
    
/////////////////////////////////////////////////////////////IPV////////////////////////////////////////////////////////    
    
    function getIpvTest()
    {
        $id = $this->session->userdata('id_desarro');
        $this->db->where('id', $id);
        $query = $this->db->get('test.ipv_control')->num_rows();
        return $query;
    }
    
    function getSerieIpv()
    {
        
        $query = $this->db->get('test.ipv_pregunta');
        //echo $this->db->last_query($query);
        //echo die;
        return $query;
    }
    
    function getPreguntaByOpcion2($opcion)
    {
        $this->db->select('pregunta');
        $this->db->where('opcion', $opcion);
        $query = $this->db->get('test.ipv_opcion')->row();
        
        return $query->pregunta;
    }
    
    function insertIpv($opcion)
    {
        //respuesta, pregunta, opcion, fecha, id
        $pregunta = $this->getPreguntaByOpcion2($opcion);
        $id = $this->session->userdata('id_desarro');
        $sql = "insert into test.ipv_respuesta (opcion, pregunta, id, fecha ) values( $opcion, $pregunta, $id, now()) on duplicate key update fecha = values(fecha), opcion=values(opcion);";
        $this->db->query($sql);
        
    }
    
    function comienzaIpv()
    {
        $id = $this->session->userdata('id_desarro');
        
        $data = array('id' => $id);
        
        $this->db->insert('test.ipv_control', $data);
    }
    
    function getresultado_ipv()
    {
        $sql = "SELECT c.id, c.fecha, trim(b.completo) as completo, b.puestox, SUBSTRING(curp, 11,1) as sexo, concat('19', SUBSTRING(curp, 5,2),'-',SUBSTRING(curp, 7,2),'-',SUBSTRING(curp, 9,2)) as fecha_nacimiento, FLOOR(DATEDIFF(DATE(NOW()), concat('19', SUBSTRING(curp, 5,2),'-',SUBSTRING(curp, 7,2),'-',SUBSTRING(curp, 9,2)))/365) AS edad FROM test.ipv_respuesta c
                left join catalogo.cat_empleado b on c.id=b.id
                group by id;";
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $q;
    }
    
    function getresultado_ipv1($id)
    {
        $sql="SELECT c.pregunta, p.texto, o.letra as respuestaDada, o.textoOpcion, c.fecha
            FROM test.ipv_respuesta c
            join test.ipv_pregunta p using(pregunta)
            left join test.ipv_opcion o using(opcion)
            where c.id=$id;";
            
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $query;
        
    }
    
/////////////////////////////////////////////////////////////REDDIN////////////////////////////////////////////////////////    
    
    function getReddinTest()
    {
        $id = $this->session->userdata('id_desarro');
        $this->db->where('id', $id);
        $query = $this->db->get('test.reddin_control')->num_rows();
        return $query;
    }
    
    function getSerieReddin()
    {
        
        $query = $this->db->get('test.reddin_pregunta');
        //echo $this->db->last_query($query);
        //echo die;
        return $query;
    }
    
    function getPreguntaByOpcion3($opcion)
    {
        $this->db->select('pregunta');
        $this->db->where('opcion', $opcion);
        $query = $this->db->get('test.reddin_opcion')->row();
        
        return $query->pregunta;
    }
    
    function insertReddin($opcion)
    {
        //respuesta, pregunta, opcion, fecha, id
        $pregunta = $this->getPreguntaByOpcion3($opcion);
        $id = $this->session->userdata('id_desarro');
        $sql = "insert into test.reddin_respuesta (opcion, pregunta, id, fecha ) values( $opcion, $pregunta, $id, now()) on duplicate key update fecha = values(fecha), opcion=values(opcion);";
        $this->db->query($sql);
        
    }
    
    function comienzaReddin()
    {
        $id = $this->session->userdata('id_desarro');
        
        $data = array('id' => $id);
        
        $this->db->insert('test.reddin_control', $data);
    }
    
    function getresultado_reddin()
    {
        $sql = "SELECT c.id, c.fecha, trim(b.completo) as completo, b.puestox, SUBSTRING(curp, 11,1) as sexo, concat('19', SUBSTRING(curp, 5,2),'-',SUBSTRING(curp, 7,2),'-',SUBSTRING(curp, 9,2)) as fecha_nacimiento, FLOOR(DATEDIFF(DATE(NOW()), concat('19', SUBSTRING(curp, 5,2),'-',SUBSTRING(curp, 7,2),'-',SUBSTRING(curp, 9,2)))/365) AS edad 
                FROM test.reddin_respuesta c
                left join catalogo.cat_empleado b on c.id=b.id
                group by id;";
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $q;
    }
    
    function getresultado_reddin1($id)
    {
        $sql="SELECT c.pregunta, p.texto, o.letra as respuestaDada, o.textoOpcion, c.fecha
            FROM test.reddin_respuesta c
            join test.reddin_pregunta p using(pregunta)
            left join test.reddin_opcion o using(opcion)
            where c.id=$id;";
            
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $query;
        
    }
    
/////////////////////////////////////////////////////////////Zavic////////////////////////////////////////////////////////    
    
    function getZavicTest()
    {
        $id = $this->session->userdata('id_desarro');
        $this->db->where('id', $id);
        $query = $this->db->get('test.zavic_control')->num_rows();
        return $query;
    }
    
    function getSerieZavic1()
    {
        
        $this->db->where('pregunta', 21);
        $query = $this->db->get('test.zavic_pregunta');
        //echo $this->db->last_query($query);
        //echo die;
        return $query;
    }
    
    function getSerieZavic()
    {
        
        $this->db->where("pregunta < 21", null, false);
        $query = $this->db->get('test.zavic_pregunta');
        //echo $this->db->last_query($query);
        //echo die;
        return $query;
    }
    
    
    function getPreguntaByOpcion4($opcion)
    {
        $this->db->select('pregunta');
        $this->db->where('opcion', $opcion);
        $query = $this->db->get('test.zavic_opcion')->row();
        
        return $query->pregunta;
    }
    
    
    function insertZavic($valor)
    {
        $opciones = explode (',',$valor);
        
        $orden = 1;
        
        foreach($opciones as $opcion)
        {
            
            $pregunta = $this->getPreguntaByOpcion4($opcion);
            $id = $this->session->userdata('id_desarro');
            
            $sql = "insert into test.zavic_respuesta (opcion, pregunta, id, fecha, orden ) values( $opcion, $pregunta, $id, now(), $orden) on duplicate key update fecha = values(fecha), opcion=values(opcion);";
            $this->db->query($sql);
            
            $orden++;

        }
    
       
        //respuesta, pregunta, opcion, fecha, id
        
    }
    
    function comienzaZavic()
    {
        $id = $this->session->userdata('id_desarro');
        
        $data = array('id' => $id);
        
        $this->db->insert('test.zavic_control', $data);
    }
    
    function getresultado_zavic()
    {
        $sql = "SELECT c.id, c.fecha, trim(b.completo) as completo, b.puestox, SUBSTRING(curp, 11,1) as sexo, concat('19', SUBSTRING(curp, 5,2),'-',SUBSTRING(curp, 7,2),'-',SUBSTRING(curp, 9,2)) as fecha_nacimiento, FLOOR(DATEDIFF(DATE(NOW()), concat('19', SUBSTRING(curp, 5,2),'-',SUBSTRING(curp, 7,2),'-',SUBSTRING(curp, 9,2)))/365) AS edad 
                FROM test.zavic_respuesta c
                left join catalogo.cat_empleado b on c.id=b.id
                group by id;";
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $q;
    }
    
    function getresultado_zavic1($id)
    {
        $sql="SELECT c.pregunta, p.texto, c.orden, o.letra as respuestaDada, o.textoOpcion, c.fecha
            FROM test.zavic_respuesta c
            join test.zavic_pregunta p using(pregunta)
            left join test.zavic_opcion o using(opcion)
            where c.id=$id;";
            
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $query;
        
    }

    /////////////////////////////////////////////////////////////Beta////////////////////////////////////////////////////////    
    
    function getBetaTest($serie)
    {
        $id = $this->session->userdata('id_desarro');
        $this->db->where('serie', $serie);
        $this->db->where('id', $id);
        $query = $this->db->get('test.beta_control')->num_rows();
        //echo $this->db->last_query();
        //die();
        return $query;
    }

    function getSerieBeta($serie)
    {
        
        $this->db->where("serie", $serie);
        $query = $this->db->get('test.beta_pregunta');
        //echo $this->db->last_query($query);
        //die();
        return $query;
    }
    
    function comienzaBeta($serie)
    {
        $id = $this->session->userdata('id_desarro');
        
        $data = array(  'id' => $id,
                        'serie' => $serie,
                        );
        
        $this->db->insert('test.beta_control', $data);
    }
    
    function insertRespuestaValor1($pregunta, $valor)
    {
        $id = $this->session->userdata('id_desarro');

        //respuesta, pregunta, opcion, fecha, id
        
        $sql = "insert into test.beta_respuesta (pregunta, fecha, id, valor) values ($pregunta, now(), $id, '$valor') on duplicate key update fecha = values(fecha), valor = values(valor);";
        $this->db->query($sql);
    }
    
    function getresultado_beta()
    {
        $sql = "SELECT c.id, c.fecha, trim(b.completo) as completo, b.puestox, SUBSTRING(curp, 11,1) as sexo, concat('19', SUBSTRING(curp, 5,2),'-',SUBSTRING(curp, 7,2),'-',SUBSTRING(curp, 9,2)) as fecha_nacimiento, FLOOR(DATEDIFF(DATE(NOW()), concat('19', SUBSTRING(curp, 5,2),'-',SUBSTRING(curp, 7,2),'-',SUBSTRING(curp, 9,2)))/365) AS edad 
                FROM test.beta_respuesta c
                left join catalogo.cat_empleado b on c.id=b.id
                group by id;";
        $q = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $q;
    }
    
    
    function getresultado_beta1($id)
    {
        $sql="SELECT serie, id, trim(completo) as nombre, count(*) as correctas 
        FROM test.beta_resultado_final b where id=$id and resultado='Bien' 
        group by serie;";
            
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $query;
        
    }
    
    function getresultado_beta1_1($id)
    {
        $sql="SELECT a.id, serie, trim(completo) as nombre, ' ' as correctas 
                FROM test.beta_respuesta a
                left join test.beta_pregunta using(pregunta)
                left join catalogo.cat_empleado using(id)
                where id=$id and serie=2
                group by id;";
            
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $query;
        
    }
    
    function getresultado_detalle($id, $serie)
    {
        if($serie ==2){
            $sql="SELECT c.pregunta, p.serie, p.respuestaCorrecta, c.valor as respuestaDada, c.fecha, ' ' as resultado
            FROM test.beta_respuesta c
            join test.beta_pregunta p using(pregunta)
            where c.id=$id and serie=$serie;";
            
        }else{
            $sql="SELECT c.pregunta, p.serie, p.respuestaCorrecta, c.valor as respuestaDada, c.fecha, case when respuestaCorrecta = valor then 'Bien' else 'Mal' end as resultado
            FROM test.beta_respuesta c
            join test.beta_pregunta p using(pregunta)
            where c.id=$id and serie=$serie;";
            
            }
            
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        //echo die;
        return $query;
        
    }
    
}
