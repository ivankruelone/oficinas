<?php
class Inv_control_espe_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

  public function inv_control_e()
    {
    $id_user=$this->session->userdata('id');
    $s="SELECT a.*,b.susa FROM almacen.control_invd a
left join catalogo.cat_con b on b.clave=a.clave
where invf<>0 group by clave,codigo";
    $q=$this->db->query($s);
    return $q;
    }
public function far_pedido_det_his($id)
    {
    $id_user=$this->session->userdata('id');
    $s="select a.* From almacen.salidas_ped_det a
    where a.tipo='C'";
    $q=$this->db->query($s);
    return $q;
    }









}
