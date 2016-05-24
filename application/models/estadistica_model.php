<?php
class Estadistica_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    //////////////////////////////////////////////////////////llenado tabla vtadc.producto_sec_farmabodega1 2012, 2013, 2014////////////////////////////////////////////////////////////////////
    function llenado_farmabodega12()
    {

        set_time_limit(0);

        $i = "insert ignore vtadc.producto_sec_farmabodega1 (aaa, clabo, descripcion, venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12, a1, a2, a3, a4, a5, a6, a7, a8, a9, a10, a11, a12, aa1, aa2, aa3, aa4, aa5, aa6, aa7, aa8, aa9, aa10, aa11, aa12)
            (SELECT 2014, clabo, susa1, 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0 FROM catalogo.almacen where clabo>0 group by clabo);";
        $this->db->query($i);

        $s = "select b.clabo, a.descripcion, sum(a.venta1) as a1, sum(a.venta2) as a2, sum(a.venta3) as a3, sum(a.venta4) as a4, sum(a.venta5) as a5, sum(a.venta6) as a6, sum(a.venta7) as a7, sum(a.venta8) as a8, sum(a.venta9) as a9, sum(a.venta10) as a10, sum(a.venta11) as a11, sum(a.venta12) as a12
            FROM vtadc.producto_mes_suc12 a
            left join catalogo.almacen b on a.codigo=b.codigo
            where suc in (1601,1602,1603)
            and clabo>0
            group by clabo";
        $q = $this->db->query($s);

        foreach ($q->result() as $r) {
            $f = "update vtadc.producto_sec_farmabodega1 set a1=$r->a1, a2=$r->a2, a3=$r->a3, a4=$r->a4, a5=$r->a5, a6=$r->a6, a7=$r->a7, a8=$r->a8, a9=$r->a9, a10=$r->a10, a11=$r->a11, a12=$r->a12
            where clabo=$r->clabo";
            $q = $this->db->query($f);
            //echo $this->db->last_query();
            //die();
        }

        $s1 = "select b.clabo, a.descripcion, sum(a.venta1) as aa1, sum(a.venta2) as aa2, sum(a.venta3) as aa3, sum(a.venta4) as aa4, sum(a.venta5) as aa5, sum(a.venta6) as aa6, sum(a.venta7) as aa7, sum(a.venta8) as aa8, sum(a.venta9) as aa9, sum(a.venta10) as aa10, sum(a.venta11) as aa11, sum(a.venta12) as aa12
            FROM vtadc.producto_mes_suc13 a
            left join catalogo.almacen b on a.codigo=b.codigo
            where suc in (1601,1602,1603)
            and clabo>0
            group by clabo";
        $q = $this->db->query($s1);

        foreach ($q->result() as $r1) {
            $f1 = "update vtadc.producto_sec_farmabodega1 set aa1=$r1->aa1, aa2=$r1->aa2, aa3=$r1->aa3, aa4=$r1->aa4, aa5=$r1->aa5, aa6=$r1->aa6, aa7=$r1->aa7, aa8=$r1->aa8, aa9=$r1->aa9, aa10=$r1->aa10, aa11=$r1->aa11, aa12=$r1->aa12
            where clabo=$r1->clabo";
            $q = $this->db->query($f1);
            //echo $this->db->last_query();
            //die();
        }

        $s2 = "select b.clabo, a.descripcion, sum(a.venta1) as aaa1, sum(a.venta2) as aaa2, sum(a.venta3) as aaa3, sum(a.venta4) as aaa4, sum(a.venta5) as aaa5, sum(a.venta6) as aaa6, sum(a.venta7) as aaa7, sum(a.venta8) as aaa8, sum(a.venta9) as aaa9, sum(a.venta10) as aaa10, sum(a.venta11) as aaa11, sum(a.venta12) as aaa12
            FROM vtadc.producto_mes_suc a
            left join catalogo.almacen b on a.codigo=b.codigo
            where suc in (1601,1602,1603)
            and clabo>0
            group by clabo";

        $q = $this->db->query($s2);

        foreach ($q->result() as $r2) {
            $f2 = "update vtadc.producto_sec_farmabodega1 set venta1=$r2->aaa1, venta2=$r2->aaa2, venta3=$r2->aaa3, venta4=$r2->aaa4, venta5=$r2->aaa5, venta6=$r2->aaa6, venta7=$r2->aaa7, venta8=$r2->aaa8, venta9=$r2->aaa9, venta10=$r2->aaa10, venta11=$r2->aaa11, venta12=$r2->aaa12
            where clabo=$r2->clabo";
            $q = $this->db->query($f2);
            //echo $this->db->last_query();
            //die();
        }

    }
    //////////////////////////////////////////////////////////llenado tabla farmabodega.farmabodega_salidas_entradas14////////////////////////////////////////////////////////////////////
    function apoyo($fecha)
    {
        $sql = "SELECT concat(DATE_FORMAT(?, '%Y-%m'), '-01') as inicio, LAST_DAY(?) as fin;";
        $query = $this->db->query($sql, array($fecha, $fecha));
        return $query->row();
    }


    function llenado_farmabodega_ent_sal()
    {

        $fecha = date('Y-m-d');
        set_time_limit(0);
        $anio = substr($fecha, 0, 4);
        $mes = substr($fecha, 5, 2);


        $campo_canp = "canp" . $mes . $anio;
        $campo_cans = "cans" . $mes . $anio;
        $campo_cane = "cane" . $mes . $anio;

        $fecha = $this->apoyo($fecha);

        //echo $fecha->inicio ."<br />";
        //echo $fecha->fin;
        //echo $campo_canp ."<br />";
        //echo $campo_cans ."<br />";
        //echo $campo_cane ."<br />";
        //die();

        $i = "insert ignore farmabodega.farmabodega_salidas_entradas14 (clabo, susa1, canp012014, cans012014, cane012014, canp022014, cans022014, cane022014, canp032014, cans032014, cane032014, canp042014, cans042014, cane042014, canp052014, cans052014, cane052014, canp062014, cans062014, cane062014, canp072014, cans072014, cane072014, canp082014, cans082014, cane082014, canp092014, cans092014, cane092014, canp102014, cans102014, cane102014, canp112014, cans112014, cane112014, canp122014, cans122014, cane122014)
            (SELECT clabo, susa1, 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0 FROM catalogo.almacen where clabo>0 group by clabo);";
        $this->db->query($i);
        //echo $this->db->last_query();
        //die();

        $i1 = "update farmabodega.farmabodega_salidas_entradas14 set $campo_canp=0, $campo_cans=0, $campo_cane=0";
        $this->db->query($i1);
        //echo $this->db->last_query();
        //die();


        $p = "SELECT b.clave, sum(b.canp) as can_pedida
            FROM farmabodega.pedido_c a
            left join farmabodega.pedido_d b on a.id=b.id_cc
            where date(a.fechasur) between '$fecha->inicio' and '$fecha->fin' and a.tipo=3 and b.canp>0
            group by b.clave";
        $q7 = $this->db->query($p);
        //echo $this->db->last_query();
        //die();

        if ($q7->num_rows() > 0) {
            foreach ($q7->result() as $r7) {
                $f7 = "update farmabodega.farmabodega_salidas_entradas14 set $campo_canp=$r7->can_pedida
            where clabo=$r7->clave";
                $this->db->query($f7);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s = "SELECT b.clave, sum(b.cans) as can_surtida
            FROM farmabodega.pedido_c a
            left join farmabodega.surtido_d b on a.id=b.id_ped
            where date(a.fechasur) between '$fecha->inicio' and '$fecha->fin' and a.tipo=3 and b.cans>0
            group by b.clave";
        $q8 = $this->db->query($s);
        //echo $this->db->last_query();
        //die();

        if ($q8->num_rows() > 0) {
            foreach ($q8->result() as $r8) {
                $f8 = "update farmabodega.farmabodega_salidas_entradas14 set $campo_cans=$r8->can_surtida
            where clabo=$r8->clave";
                $this->db->query($f8);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s1 = "SELECT b.clave, sum(b.cans) as can_sale
            FROM farmabodega.traspaso_c a
            left join farmabodega.traspaso_d b on a.id=b.id_cc
            where date(b.fecha) between '$fecha->inicio' and '$fecha->fin' and b.activo=1 and sale=1600
            group by b.clave;";
        $q1 = $this->db->query($s1);
        //echo $this->db->last_query();
        //die();


        if ($q1->num_rows() > 0) {
            foreach ($q1->result() as $r1) {
                $f = "update farmabodega.farmabodega_salidas_entradas14 set $campo_cans=$campo_cans+$r1->can_sale
            where clabo=$r1->clave";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s4 = "SELECT b.clave, sum(b.cane) as can_entrada
            FROM farmabodega.traspaso_c a
            left join farmabodega.traspaso_d b on a.id=b.id_cc
            where date(b.fecha) between '$fecha->inicio' and '$fecha->fin' and b.activo=1 and entra=1600
            group by b.clave;";
        $q4 = $this->db->query($s4);
        //echo $this->db->last_query();
        //die();


        if ($q4->num_rows() > 0) {
            foreach ($q4->result() as $r4) {
                $f = "update farmabodega.farmabodega_salidas_entradas14 set $campo_cane=$campo_cane+$r4->can_entrada
            where clabo=$r4->clave";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s2 = "SELECT b.clave, case when sale=1600 then sum(b.cans) else 0 end as can_sale, case when entra=1600 then sum(b.cans) else 0 end as can_entra
            FROM farmabodega.devolucion_c a
            left join farmabodega.devolucion_d b on a.id=b.id_cc
            where concepto in (1,2) and date(a.fecha) between '$fecha->inicio' and '$fecha->fin'
            group by b.clave;";
        $q2 = $this->db->query($s2);
        //echo $this->db->last_query();
        //die();

        if ($q2->num_rows() > 0) {
            foreach ($q2->result() as $r2) {
                $f = "update farmabodega.farmabodega_salidas_entradas14 set $campo_cans=$campo_cans+$r2->can_sale, $campo_cane=$campo_cane+$r2->can_entra
            where clabo=$r2->clave";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s3 = "SELECT b.clave, sum(can) as can_entrada  
            FROM farmabodega.compra_c a
            left join farmabodega.compra_d b on a.id=b.id_cc
            where date(a.fecha) between '$fecha->inicio' and '$fecha->fin'
            group by b.clave;";
        $q3 = $this->db->query($s3);
        //echo $this->db->last_query();
        //die();

        if ($q3->num_rows() > 0) {
            foreach ($q3->result() as $r3) {
                $f = "update farmabodega.farmabodega_salidas_entradas14 set $campo_cane=$campo_cane+$r3->can_entrada
            where clabo=$r3->clave";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

    }

    //////////////////////////////////////////////////////////llenado tabla almacen.control_salidas_entradas14////////////////////////////////////////////////////////////////////
    function apoyo1($fecha1)
    {
        $sql = "SELECT concat(DATE_FORMAT(?, '%Y-%c'), '-1') as inicio, date_format(LAST_DAY(?), '%Y-%c-%e') as fin;";
        $query = $this->db->query($sql, array($fecha1, $fecha1));
        return $query->row();
    }


    function llenado_controlados_ent_sal()
    {

        $fecha1 = date('Y-m-d');
        set_time_limit(0);
        $anio = substr($fecha1, 0, 4);
        $mes = substr($fecha1, 5, 2);

        $campo_canp = "canp" . $mes . $anio;
        $campo_cans = "cans" . $mes . $anio;
        $campo_cane = "cane" . $mes . $anio;

        $fecha1 = $this->apoyo1($fecha1);

        //echo $fecha1->inicio ."<br />";
        //echo $fecha1->fin ."<br />";
        //echo $campo_canp ."<br />";
        //echo $campo_cans ."<br />";
        //echo $campo_cane ."<br />";
        //die();


        $i = "insert ignore almacen.control_salidas_entradas14 (clave, susa1, canp012014, cans012014, cane012014, canp022014, cans022014, cane022014, canp032014, cans032014, cane032014, canp042014, cans042014, cane042014, canp052014, cans052014, cane052014, canp062014, cans062014, cane062014, canp072014, cans072014, cane072014, canp082014, cans082014, cane082014, canp092014, cans092014, cane092014, canp102014, cans102014, cane102014, canp112014, cans112014, cane112014, canp122014, cans122014, cane122014)
            (SELECT trim(clave), trim(susa), 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0 FROM catalogo.cat_con);";
        $this->db->query($i);
        //echo $this->db->last_query();
        //die();

        $i1 = "update almacen.control_salidas_entradas14 set $campo_canp=0, $campo_cans=0, $campo_cane=0";
        $this->db->query($i1);
        //echo $this->db->last_query();
        //die();


        $s = "SELECT clave, sum(can) as can_entra
            FROM almacen.control_audito
            where CONCAT(aaa,'-',mes,'-',dia) between '$fecha1->inicio' and '$fecha1->fin' and mov='E' 
            group by clave";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //die();

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $r) {
                $f = "update almacen.control_salidas_entradas14 set $campo_cane=$r->can_entra
            where clave='$r->clave'";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s1 = "SELECT clave, sum(can) as can_sale
            FROM almacen.control_audito
            where CONCAT(aaa,'-',mes,'-',dia) between '$fecha1->inicio' and '$fecha1->fin' and mov='S' 
            group by clave";
        $q1 = $this->db->query($s1);
        //echo $this->db->last_query();
        //die();


        if ($q1->num_rows() > 0) {
            foreach ($q1->result() as $r1) {
                $f1 = "update almacen.control_salidas_entradas14 set $campo_cans=$r1->can_sale
            where clave='$r1->clave'";
                $this->db->query($f1);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        ////////////////////////////////////////////////////////////////////llenada tabla aguascalientes.aguas_entradas_salidas14///////////////////////////////////////////////////////

    }


    function llenado_aguas_ent_sal()
    {

        $fecha = date('Y-m-d');
        set_time_limit(0);
        $anio = substr($fecha, 0, 4);
        $mes = substr($fecha, 5, 2);

        $campo_canp = "canp" . $mes . $anio;
        $campo_cans = "cans" . $mes . $anio;
        $campo_cane = "cane" . $mes . $anio;

        $fecha = $this->apoyo($fecha);

        //echo $fecha->inicio ."<br />";
        //echo $fecha->fin ."<br />";
        //echo $campo_canp ."<br />";
        //echo $campo_cans ."<br />";
        //echo $campo_cane ."<br />";
        //die();


        $i = "insert ignore aguascalientes.aguas_salidas_entradas14 (clave, susa1, canp012014, cans012014, cane012014, canp022014, cans022014, cane022014, canp032014, cans032014, cane032014, canp042014, cans042014, cane042014, canp052014, cans052014, cane052014, canp062014, cans062014, cane062014, canp072014, cans072014, cane072014, canp082014, cans082014, cane082014, canp092014, cans092014, cane092014, canp102014, cans102014, cane102014, canp112014, cans112014, cane112014, canp122014, cans122014, cane122014)
            (SELECT trim(clave), trim(susa), 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0 FROM aguascalientes.productos);";
        $this->db->query($i);
        //echo $this->db->last_query();
        //die();

        $i1 = "update aguascalientes.aguas_salidas_entradas14 set $campo_canp=0, $campo_cans=0, $campo_cane=0";
        $this->db->query($i1);
        //echo $this->db->last_query();
        //die();


        $s = "SELECT d.clave, sum(canreq) as can_pedida, sum(cansur) as can_sale
            FROM aguascalientes.pedidos a
            left join aguascalientes.detalle d on a.id=d.p_id
            where estatus=3 and date(a.f_embarque) between '$fecha->inicio' and '$fecha->fin'
            group by clave";
        $q = $this->db->query($s);
        //echo $this->db->last_query();
        //die();

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $r) {
                $f = "update aguascalientes.aguas_salidas_entradas14 set $campo_canp=$r->can_pedida, $campo_cans=$r->can_sale
            where clave='$r->clave'";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s1 = "SELECT p.clave, sum(e.piezas) as can_entra FROM aguascalientes.entradas_c c
            left join aguascalientes.entradas e on c.id=e.e_id
            left join aguascalientes.productos p on p.id=e.p_id
            where estatus=1 and tipo=1 and date(cerrado) between '$fecha->inicio' and '$fecha->fin'
            group by clave having clave is not null";
        $q1 = $this->db->query($s1);
        //echo $this->db->last_query();
        //die();


        if ($q1->num_rows() > 0) {
            foreach ($q1->result() as $r1) {
                $f1 = "update aguascalientes.aguas_salidas_entradas14 set $campo_cane=$r1->can_entra
            where clave='$r1->clave'";
                $this->db->query($f1);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s2 = "SELECT p.clave, sum(e.piezas) as can_sale FROM aguascalientes.entradas_c c
            left join aguascalientes.entradas e on c.id=e.e_id
            left join aguascalientes.productos p on p.id=e.p_id
            where estatus=1 and tipo=2 and date(cerrado) between '$fecha->inicio' and '$fecha->fin'
            group by clave having clave is not null";
        $q2 = $this->db->query($s2);
        //echo $this->db->last_query();
        //die();


        if ($q2->num_rows() > 0) {
            foreach ($q2->result() as $r2) {
                $f2 = "update aguascalientes.aguas_salidas_entradas14 set $campo_cans=$campo_cans+$r2->can_sale
            where clave='$r2->clave'";
                $this->db->query($f2);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

    }


    function llenado_trasimeno140_ent_sal()
    {

        $fecha = date('Y-m-d');
        set_time_limit(0);
        $anio = substr($fecha, 0, 4);
        $mes = substr($fecha, 5, 2);


        $campo_canp = "canp" . $mes . $anio;
        $campo_cans = "cans" . $mes . $anio;
        $campo_cane = "cane" . $mes . $anio;

        $fecha = $this->apoyo($fecha);

        //echo $fecha->inicio ."<br />";
        //echo $fecha->fin;
        //echo $campo_canp ."<br />";
        //echo $campo_cans ."<br />";
        //echo $campo_cane ."<br />";
        //die();

        $i = "insert ignore trasimeno140.trasimeno140_salidas_entradas14 (clave, susa1, canp012014, cans012014, cane012014, canp022014, cans022014, cane022014, canp032014, cans032014, cane032014, canp042014, cans042014, cane042014, canp052014, cans052014, cane052014, canp062014, cans062014, cane062014, canp072014, cans072014, cane072014, canp082014, cans082014, cane082014, canp092014, cans092014, cane092014, canp102014, cans102014, cane102014, canp112014, cans112014, cane112014, canp122014, cans122014, cane122014)
            (SELECT clave, descri, 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0 FROM trasimeno140.inventario_d group by clave);";
        $this->db->query($i);
        //echo $this->db->last_query();
        //die();

        $i1 = "update trasimeno140.trasimeno140_salidas_entradas14 set $campo_canp=0, $campo_cans=0, $campo_cane=0";
        $this->db->query($i1);
        //echo $this->db->last_query();
        //die();


        $p = "SELECT b.clave, sum(b.canp) as can_pedida
            FROM trasimeno140.pedido_c a
            left join trasimeno140.pedido_d b on a.id=b.id_cc
            where date(a.fecha) between '$fecha->inicio' and '$fecha->fin' and a.tipo=1 and b.canp>0
            group by b.clave";
        $q7 = $this->db->query($p);
        //echo $this->db->last_query();
        //die();

        if ($q7->num_rows() > 0) {
            foreach ($q7->result() as $r7) {
                $f7 = "update trasimeno140.trasimeno140_salidas_entradas14 set $campo_canp=$r7->can_pedida
            where clave='$r7->clave'";
                $this->db->query($f7);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s = "SELECT b.clave, sum(b.cans) as can_surtida
            FROM trasimeno140.pedido_c a
            left join trasimeno140.surtido_d b on a.id=b.id_ped
            where date(a.fechasur) between '$fecha->inicio' and '$fecha->fin' and a.tipo=3 and b.cans>0
            group by b.clave";
        $q8 = $this->db->query($s);
        //echo $this->db->last_query();
        //die();

        if ($q8->num_rows() > 0) {
            foreach ($q8->result() as $r8) {
                $f8 = "update trasimeno140.trasimeno140_salidas_entradas14 set $campo_cans=$r8->can_surtida
            where clave='$r8->clave'";
                $this->db->query($f8);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s1 = "SELECT b.clave, sum(b.cans) as can_sale
            FROM trasimeno140.traspaso_c a
            left join trasimeno140.traspaso_d b on a.id=b.id_cc
            where date(b.fecha) between '$fecha->inicio' and '$fecha->fin' and b.activo=1 and sale=6050
            group by b.clave";
        $q1 = $this->db->query($s1);
        //echo $this->db->last_query();
        //die();


        if ($q1->num_rows() > 0) {
            foreach ($q1->result() as $r1) {
                $f = "update trasimeno140.trasimeno140_salidas_entradas14 set $campo_cans=$campo_cans+$r1->can_sale
            where clave='$r1->clave'";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s4 = "SELECT b.clave, sum(b.cane) as can_entrada
            FROM trasimeno140.traspaso_c a
            left join trasimeno140.traspaso_d b on a.id=b.id_cc
            where date(b.fecha) between '$fecha->inicio' and '$fecha->fin' and b.activo=1 and entra=6050
            group by b.clave;";
        $q4 = $this->db->query($s4);
        //echo $this->db->last_query();
        //die();


        if ($q4->num_rows() > 0) {
            foreach ($q4->result() as $r4) {
                $f = "update trasimeno140.trasimeno140_salidas_entradas14 set $campo_cane=$campo_cane+$r4->can_entrada
            where clave='$r4->clave'";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s2 = "SELECT b.clave, case when sale=6050 then sum(b.cans) else 0 end as can_sale, case when entra=6050 then sum(b.cans) else 0 end as can_entra
            FROM trasimeno140.devolucion_c a
            left join trasimeno140.devolucion_d b on a.id=b.id_cc
            where concepto in (1,2) and date(a.fecha) between '$fecha->inicio' and '$fecha->fin' and clave>0
            group by b.clave;";
        $q2 = $this->db->query($s2);
        //echo $this->db->last_query();
        //die();

        if ($q2->num_rows() > 0) {
            foreach ($q2->result() as $r2) {
                $f = "update trasimeno140.trasimeno140_salidas_entradas14 set $campo_cans=$campo_cans+$r2->can_sale, $campo_cane=$campo_cane+$r2->can_entra
            where clave='$r2->clave'";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s3 = "SELECT b.clave, sum(can) as can_entrada  
            FROM trasimeno140.compra_c a
            left join trasimeno140.compra_d b on a.id=b.id_cc
            where date(a.fecha) between '$fecha->inicio' and '$fecha->fin'
            group by b.clave;";
        $q3 = $this->db->query($s3);
        //echo $this->db->last_query();
        //die();

        if ($q3->num_rows() > 0) {
            foreach ($q3->result() as $r3) {
                $f = "update trasimeno140.trasimeno140_salidas_entradas14 set $campo_cane=$campo_cane+$r3->can_entrada
            where clave='$r3->clave'";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }


    }

    function llenado_cedis_ent_sal()
    {

        $fecha = date('Y-m-d');
        set_time_limit(0);
        $anio = substr($fecha, 0, 4);
        $mes = substr($fecha, 5, 2);


        $campo_canp = "canp" . $mes . $anio;
        $campo_cans = "cans" . $mes . $anio;
        $campo_cane = "cane" . $mes . $anio;

        $fecha = $this->apoyo($fecha);

        //echo $fecha->inicio ."<br />";
        //echo $fecha->fin;
        //echo $campo_canp ."<br />";
        //echo $campo_cans ."<br />";
        //echo $campo_cane ."<br />";
        //die();

        $i = "insert ignore desarrollo.cedis_salidas_entradas14 (clave, susa1, canp012014, cans012014, cane012014, canp022014, cans022014, cane022014, canp032014, cans032014, cane032014, canp042014, cans042014, cane042014, canp052014, cans052014, cane052014, canp062014, cans062014, cane062014, canp072014, cans072014, cane072014, canp082014, cans082014, cane082014, canp092014, cans092014, cane092014, canp102014, cans102014, cane102014, canp112014, cans112014, cane112014, canp122014, cans122014, cane122014)
            (SELECT sec, susa1, 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0 FROM catalogo.almacen where tsec='G' and metro<>'s');";
        $this->db->query($i);
        //echo $this->db->last_query();
        //die();

        $i1 = "update desarrollo.cedis_salidas_entradas14 set $campo_canp=0, $campo_cans=0, $campo_cane=0";
        $this->db->query($i1);
        //echo $this->db->last_query();
        //die();


        $p = "SELECT sec, sum(can) as can_pedida
            FROM desarrollo.pedidos
            where tipo=1 and fecha between '$fecha->inicio' and '$fecha->fin'
            group by sec";
        $q7 = $this->db->query($p);
        //echo $this->db->last_query();
        //die();

        if ($q7->num_rows() > 0) {
            foreach ($q7->result() as $r7) {
                $f7 = "update desarrollo.cedis_salidas_entradas14 set $campo_canp=$r7->can_pedida
            where clave=$r7->sec";
                $this->db->query($f7);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s = "SELECT sec, sum(can) as can_surtida
            FROM desarrollo.surtido s
            where fecha between '$fecha->inicio' and '$fecha->fin'
            group by sec";
        $q8 = $this->db->query($s);
        //echo $this->db->last_query();
        //die();

        if ($q8->num_rows() > 0) {
            foreach ($q8->result() as $r8) {
                $f8 = "update desarrollo.cedis_salidas_entradas14 set $campo_cans=$r8->can_surtida
            where clave=$r8->sec";
                $this->db->query($f8);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s1 = "SELECT sec, sum(can) as can_entra 
            FROM desarrollo.compra_c c
            LEFT JOIN desarrollo.compra_d d on c.id=d.id_cc
            where tipo='C' and date(c.fechai) between '$fecha->inicio' and '$fecha->fin'
            group by sec";
        $q1 = $this->db->query($s1);
        //echo $this->db->last_query();
        //die();


        if ($q1->num_rows() > 0) {
            foreach ($q1->result() as $r1) {
                $f = "update desarrollo.cedis_salidas_entradas14 set $campo_cane=$r1->can_entra
            where clave=$r1->sec";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s4 = "SELECT sec, sum(can) as can_entra FROM desarrollo.traspaso_c a
            left join desarrollo.traspaso_d b on a.id=b.id_cc
            where a.tipo='E' and date(a.fechai) between '$fecha->inicio' and '$fecha->fin'
            group by sec having sec is not null";
        $q4 = $this->db->query($s4);
        //echo $this->db->last_query();
        //die();


        if ($q4->num_rows() > 0) {
            foreach ($q4->result() as $r4) {
                $f = "update desarrollo.cedis_salidas_entradas14 set $campo_cane=$campo_cane+$r4->can_entra
            where clave=$r4->sec";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s2 = "SELECT sec, sum(can) as can_surtida FROM desarrollo.traspaso_c a
            left join desarrollo.traspaso_d b on a.id=b.id_cc
            where a.tipo='S' and date(a.fechai) between '$fecha->inicio' and '$fecha->fin'
            group by sec";
        $q2 = $this->db->query($s2);
        //echo $this->db->last_query();
        //die();

        if ($q2->num_rows() > 0) {
            foreach ($q2->result() as $r2) {
                $f = "update desarrollo.cedis_salidas_entradas14 set $campo_cans=$campo_cans+$r2->can_surtida
            where clave=$r2->sec";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s3 = "SELECT sec, sum(can) as can_entra FROM desarrollo.devolucion_c d
            LEFT JOIN desarrollo.devolucion_d a on d.id=a.id_cc
            where tipo2='C' and mov in (4,6) and tipo='E' and date(d.fechai) between '$fecha->inicio' and '$fecha->fin'
            group by sec having sec is not null";
        $q3 = $this->db->query($s3);
        //echo $this->db->last_query();
        //die();

        if ($q3->num_rows() > 0) {
            foreach ($q3->result() as $r3) {
                $f = "update desarrollo.cedis_salidas_entradas14 set $campo_cane=$campo_cane+$r3->can_entra
            where clave=$r3->sec";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s5 = "SELECT sec, sum(can) as can_surtida FROM desarrollo.devolucion_c d
                LEFT JOIN desarrollo.devolucion_d a on d.id=a.id_cc
                where tipo2='C' and mov in (4,6) and tipo='S'
                and date(d.fechai) between '$fecha->inicio' and '$fecha->fin'
                group by sec";
        $q5 = $this->db->query($s5);
        //echo $this->db->last_query();
        //die();

        if ($q5->num_rows() > 0) {
            foreach ($q5->result() as $r5) {
                $f = "update desarrollo.cedis_salidas_entradas14 set $campo_cans=$campo_cans+$r5->can_surtida
            where clave=$r5->sec";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }


    }

    function llenado_quintana_ent_sal()
    {

        $fa = $this->load->database('facturacion', true);


        $s = "SELECT * FROM facturacion.quintana_datos q;";
        $q = $fa->query($s);
        echo $fa->last_query();
        die();


    }


    function llenado_pl1()
    {

        $fecha = date('Y-m-d');
        set_time_limit(0);
        $anio = substr($fecha, 0, 4);
        $mes = substr($fecha, 5, 2);


        $campo_canp = "canp" . $mes . $anio;
        $campo_cans = "cans" . $mes . $anio;
        $campo_cane = "cane" . $mes . $anio;

        $fecha = $this->apoyo($fecha);

        //echo $fecha->inicio ."<br />";
        //echo $fecha->fin;
        //echo $campo_canp ."<br />";
        //echo $campo_cans ."<br />";
        //echo $campo_cane ."<br />";
        //die();

        $i = "insert ignore desarrollo.cedis_salidas_entradas14 (clave, susa1, canp012014, cans012014, cane012014, canp022014, cans022014, cane022014, canp032014, cans032014, cane032014, canp042014, cans042014, cane042014, canp052014, cans052014, cane052014, canp062014, cans062014, cane062014, canp072014, cans072014, cane072014, canp082014, cans082014, cane082014, canp092014, cans092014, cane092014, canp102014, cans102014, cane102014, canp112014, cans112014, cane112014, canp122014, cans122014, cane122014)
            (SELECT sec, susa1, 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0 FROM catalogo.almacen where tsec='G' and metro<>'s');";
        $this->db->query($i);
        //echo $this->db->last_query();
        //die();

        $i1 = "update desarrollo.cedis_salidas_entradas14 set $campo_canp=0, $campo_cans=0, $campo_cane=0";
        $this->db->query($i1);
        //echo $this->db->last_query();
        //die();


        $p = "SELECT sec, sum(can) as can_pedida
            FROM desarrollo.pedidos
            where tipo=1 and fecha between '$fecha->inicio' and '$fecha->fin'
            group by sec";
        $q7 = $this->db->query($p);
        //echo $this->db->last_query();
        //die();

        if ($q7->num_rows() > 0) {
            foreach ($q7->result() as $r7) {
                $f7 = "update desarrollo.cedis_salidas_entradas14 set $campo_canp=$r7->can_pedida
            where clave=$r7->sec";
                $this->db->query($f7);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s = "SELECT sec, sum(can) as can_surtida
            FROM desarrollo.surtido s
            where fecha between '$fecha->inicio' and '$fecha->fin'
            group by sec";
        $q8 = $this->db->query($s);
        //echo $this->db->last_query();
        //die();

        if ($q8->num_rows() > 0) {
            foreach ($q8->result() as $r8) {
                $f8 = "update desarrollo.cedis_salidas_entradas14 set $campo_cans=$r8->can_surtida
            where clave=$r8->sec";
                $this->db->query($f8);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s1 = "SELECT sec, sum(can) as can_entra 
            FROM desarrollo.compra_c c
            LEFT JOIN desarrollo.compra_d d on c.id=d.id_cc
            where tipo='C' and date(c.fechai) between '$fecha->inicio' and '$fecha->fin'
            group by sec";
        $q1 = $this->db->query($s1);
        //echo $this->db->last_query();
        //die();


        if ($q1->num_rows() > 0) {
            foreach ($q1->result() as $r1) {
                $f = "update desarrollo.cedis_salidas_entradas14 set $campo_cane=$r1->can_entra
            where clave=$r1->sec";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s4 = "SELECT sec, sum(can) as can_entra FROM desarrollo.traspaso_c a
            left join desarrollo.traspaso_d b on a.id=b.id_cc
            where a.tipo='E' and date(a.fechai) between '$fecha->inicio' and '$fecha->fin'
            group by sec having sec is not null";
        $q4 = $this->db->query($s4);
        //echo $this->db->last_query();
        //die();


        if ($q4->num_rows() > 0) {
            foreach ($q4->result() as $r4) {
                $f = "update desarrollo.cedis_salidas_entradas14 set $campo_cane=$campo_cane+$r4->can_entra
            where clave=$r4->sec";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s2 = "SELECT sec, sum(can) as can_surtida FROM desarrollo.traspaso_c a
            left join desarrollo.traspaso_d b on a.id=b.id_cc
            where a.tipo='S' and date(a.fechai) between '$fecha->inicio' and '$fecha->fin'
            group by sec";
        $q2 = $this->db->query($s2);
        //echo $this->db->last_query();
        //die();

        if ($q2->num_rows() > 0) {
            foreach ($q2->result() as $r2) {
                $f = "update desarrollo.cedis_salidas_entradas14 set $campo_cans=$campo_cans+$r2->can_surtida
            where clave=$r2->sec";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s3 = "SELECT sec, sum(can) as can_entra FROM desarrollo.devolucion_c d
            LEFT JOIN desarrollo.devolucion_d a on d.id=a.id_cc
            where tipo2='C' and mov in (4,6) and tipo='E' and date(d.fechai) between '$fecha->inicio' and '$fecha->fin'
            group by sec having sec is not null";
        $q3 = $this->db->query($s3);
        //echo $this->db->last_query();
        //die();

        if ($q3->num_rows() > 0) {
            foreach ($q3->result() as $r3) {
                $f = "update desarrollo.cedis_salidas_entradas14 set $campo_cane=$campo_cane+$r3->can_entra
            where clave=$r3->sec";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }

        $s5 = "SELECT sec, sum(can) as can_surtida FROM desarrollo.devolucion_c d
                LEFT JOIN desarrollo.devolucion_d a on d.id=a.id_cc
                where tipo2='C' and mov in (4,6) and tipo='S'
                and date(d.fechai) between '$fecha->inicio' and '$fecha->fin'
                group by sec";
        $q5 = $this->db->query($s5);
        //echo $this->db->last_query();
        //die();

        if ($q5->num_rows() > 0) {
            foreach ($q5->result() as $r5) {
                $f = "update desarrollo.cedis_salidas_entradas14 set $campo_cans=$campo_cans+$r5->can_surtida
            where clave=$r5->sec";
                $this->db->query($f);
                //echo $this->db->last_query();
                //die();
            }
        } else {

        }


    }

}
