<?php
class Licita_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////pago mayoristas
function licita_ctl()
{
 $s="select a.fecha,a.contrato,count(*)as productos,
(select count(*) from compras.licita_p x where x.contrato=a.contrato and x.fecha=a.fecha and status<>'a' )as encontrado
from compras.licita_p a
where status<>'C'
group by a.fecha,a.contrato";
 $q=$this->db->query($s);
 return $q;      
}
function licita_inserta($fecha,$archivo)
{
 $s="delete from compras.licita_pd  where aplica=0 and fecha='$fecha' and contrato='$archivo'";
 $this->db->query($s);
 $ss="insert ignore into compras.licita_pd(fecha, contrato, archivo, codigo, sec, clave, susa1, susa2, prv, prvx, costo, tsec, id_licita, aplica,lab)
 (SELECT a.fecha,a.contrato,'PATENTE',b.codigo,b.sec,b.clave,b.susa,b.descripcion,0,'mayorista',cos,'P',a.id,0,labprv
 FROM compras.licita_p a
 left join catalogo.cat_mercadotecnia b on b.susa=a.susa
 where
  a.status='A' and b.codigo is not null and a.fecha='$fecha' and contrato='$archivo' and b.cos_marzam>0 or
  a.status='A' and b.codigo is not null and a.fecha='$fecha' and contrato='$archivo' and b.cos_fanasa>0 or
  a.status='A' and b.codigo is not null and a.fecha='$fecha' and contrato='$archivo' and b.cos_nadro>0 or
  a.status='A' and b.codigo is not null and a.fecha='$fecha' and contrato='$archivo' and b.cos_saba>0
  )";
 $this->db->query($ss);
       
}
function licita_inserta_coinsidencia($fecha,$archivo)
{
 $s="delete from compras.licita_pd  where aplica=0 and fecha='$fecha' and contrato='$archivo'";
 $this->db->query($s);
 $ss="insert ignore into compras.licita_pd(fecha, contrato, archivo, codigo, sec, clave, susa1, susa2, prv, prvx, costo, tsec, id_licita, aplica,lab)
 (SELECT a.fecha,a.contrato,'PATENTE',b.codigo,b.sec,b.clave,b.susa,b.descripcion,0,'mayorista',cos,'P',a.id,0,labprv
 FROM compras.licita_p a
 left join catalogo.cat_mercadotecnia b on b.susa like concat('%',trim(a.susa),'%')
 where
  a.status='A' and b.codigo is not null and a.fecha='$fecha' and contrato='$archivo' and b.cos_marzam>0 or
  a.status='A' and b.codigo is not null and a.fecha='$fecha' and contrato='$archivo' and b.cos_fanasa>0 or
  a.status='A' and b.codigo is not null and a.fecha='$fecha' and contrato='$archivo' and b.cos_nadro>0 or
  a.status='A' and b.codigo is not null and a.fecha='$fecha' and contrato='$archivo' and b.cos_saba>0
  )";
 $this->db->query($ss);
}

function licita_borrar($fecha,$archivo)
{
$s="delete from compras.licita_p where fecha='$fecha' and contrato='$archivo'";
$this->db->query($s);
$ss="delete from compras.licita_pd where fecha='$fecha' and contrato='$archivo'";
$this->db->query($ss);

}

function licita_ctl_grupo($fecha,$archivo)
{
 $s="select  a.fecha,a.contrato,substr(susa,1,1)as letra,count(a.id)as numero,
(select  count(aa.id) from compras.licita_p aa
left join compras.licita_pd x on x.id_licita=aa.id
where aa.fecha=a.fecha and aa.contrato=a.contrato and x.aplica>0 and substr(aa.susa,1,1)=substr(a.susa,1,1))as num_encontra
 from compras.licita_p a
 where a.fecha='$fecha' and a.contrato='$archivo' group by substr(susa,1,1)";
 $q=$this->db->query($s);
 return $q;      
}
function licita_det($fecha,$archivo,$letra)
{
 $s="SELECT a.clave as clave_p,a.id,a.susa,a.presenta, b.id as id_det,b.*
FROM compras.licita_p a
left join compras.licita_pd b on b.id_licita=a.id 
where a.fecha='$fecha' and a.contrato='$archivo' and substr(susa,1,1)='$letra' and
(select count(*) from compras.licita_pd x where x.id_licita=a.id and x.aplica>0 group by x.id_licita) is null";
 $q=$this->db->query($s);
 return $q;      
}


function actualiza_aplicar($id, $valor)
    {
        $s="select id_licita from compras.licita_pd a 
        where a.id_licita=(select id_licita from compras.licita_pd x where x.id=$id) and a.aplica>0";
        $q=$this->db->query($s);
        $r=$q->row();
        if($valor==0 and $r->id_licita>0){
        }else{
        $ac="update compras.licita_p a, compras.licita_pd b
        set status='B' 
        where a.id=b.id_licita and b.id=$id";
        $this->db->query($ac);    
        }
        $this->db->where('id', $id);
        $this->db->set('aplica', $valor);
        $this->db->update('compras.licita_pd');
        return $this->calcula_importe($id);
        
    }
function licita_aplicada($fecha,$archivo)
{
 $s="SELECT a.clave as clave_p,a.id,a.susa,a.presenta, b.id as id_det,b.*
FROM compras.licita_p a
left join compras.licita_pd b on b.id_licita=a.id 
where a.fecha='$fecha' and a.contrato='$archivo'  and b.aplica>0 and a.status<>'C'
order by a.id 
";
 $q=$this->db->query($s);
 return $q;      
}
function licita_faltante($fecha,$archivo)
{
 $s="SELECT a.clave as clave_p,a.id,a.susa,a.presenta
FROM compras.licita_p a
where a.fecha='$fecha' and a.contrato='$archivo'  and a.status='A' 
order by a.id 
";
 $q=$this->db->query($s);
 return $q;      
}


function licita_validacion($fecha,$archivo)
{
$s1="update compras.licita_p set status='C' where fecha='$fecha' and contrato='$archivo'";
$this->db->query($s1);
$s3="delete from compras.licita_pd where fecha='$fecha' and contrato='$archivo'  and aplica=0";    
$this->db->query($s3);
}

function licita_historico()
{
 $s="select a.fecha,a.contrato,count(*)as productos,
(SELECT count(*)
FROM compras.licita_p aa left join compras.licita_pd b on b.id_licita=aa.id
where aa.fecha=a.fecha and aa.contrato=a.contrato and b.aplica is null and aa.status='C')as encontrado
from compras.licita_p a
where status='C'
group by a.fecha,a.contrato
";
 $q=$this->db->query($s);
 return $q;      
}

function licita_historico_det($fecha,$archivo)
{
 $s="SELECT a.clave as clave_p,a.id,a.susa,a.presenta, b.id as id_det,b.codigo,b.susa1,b.susa2,b.costo,b.lab
FROM compras.licita_p a
left join compras.licita_pd b on b.id_licita=a.id 
where a.fecha='$fecha' and a.contrato='$archivo'  and b.aplica>=1 and a.status='C'
union all
SELECT a.clave as clave_p,a.id,a.susa,a.presenta, b.id as id_det,' 'as codigo,' 'as susa2,' 'as susa2,' 'as costo,' 'as lab
FROM compras.licita_p a
left join compras.licita_pd b on b.id_licita=a.id 
where a.fecha='$fecha' and a.contrato='$archivo'  and b.aplica is null and a.status='C'
";
 $q=$this->db->query($s);
 return $q;      
}


}