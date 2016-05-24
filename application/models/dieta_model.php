<?php
class Dieta_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

///////////////////////////////////////////////////////////////////////////////////
function dieta_cat()
{
$s="SELECT year(fecven)as aaa,ifnull(b.num,0)as mes,ifnull(b.mes,' ')as mesx,sum(imp_prv)as imp_prv,sum(imp_cxp)as imp_cxp
FROM compras.pre_factura_fenix_ctl a
left join catalogo.mes b on b.num=month(fecven)
group by month(fecven)
order by num";
$q=$this->db->query($s);
return $q;    
}

}