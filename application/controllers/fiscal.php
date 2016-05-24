<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fiscal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!Current_User::user()) {
            redirect('landing');
        }

        $this->load->model('fiscal_model');
        $this->load->model('Catalogos_model');

    }


    public function s_compra_cheque()
    {
        $data['titulo'] = "Actualiza Archivos del as400";
        $data['a'] = $this->fiscal_model->cheques_pagados();
        $data['js'] = 'fiscal/s_compra_cheque_js';
        $this->load->view('main', $data);
    }

    public function s_carga_datos()
    {
        $this->fiscal_model->recibe_cheque();
        redirect('fiscal/s_compra_cheque');
    }
    public function s_compra_cheque_det($fec1,$fec2)
    {
        $data['titulo'] = "Reporte de cheques";
        $data['a'] = $this->fiscal_model->cheques_pagados_det($fec1,$fec2);
        $data['js'] = 'fiscal/s_compra_cheque_det_js';
        $this->load->view('main', $data);
    }
    public function s_cheque_banco()
    {
        $data['titulo1'] = "ESTADO DE CUENTA DE CHEQUES CONCILIADOS";
        $data['titulo2'] = "ESTADO DE CUENTA DE CHEQUES SIN CONCILIAR";
        $data['titulo3'] = "ESTADO DE CUENTA DE CHEQUES CON VARIAS PARTIDAS";
        $data['a'] = $this->fiscal_model->cheques_banco();
        $data['b'] = $this->fiscal_model->cheques_banco_falta();
        $data['c'] = $this->fiscal_model->cheques_banco_partidos();
        //$data['js'] = 'empleados/plantilla_js';
        $this->load->view('main', $data);
    }
    
    public function s_cheque_banco_cia($aaa,$mes)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "ESTADO BANCARIO DEL MES DE ".$mesx." DEL ".$aaa;
        $data['a'] = $this->fiscal_model->cheques_banco_cia($aaa,$mes);
        $data['js'] = 'fiscal/s_cheque_banco_det_partida_js';
        $this->load->view('main', $data);
    }
    public function s_cheque_banco_det_cia($fil,$aaa,$mes,$cia)
    {
        $data['titulo'] = "ESTADO BANCARIO";
        $data['a'] = $this->fiscal_model->cheques_banco_det_cia($fil,$aaa,$mes,$cia);
        $data['js'] = 'fiscal/s_cheque_banco_det_js';
        $this->load->view('main', $data);
    }
     function plano_submit_det_cia($aaa,$mes,$cia)
    {
        set_time_limit(0);
        ini_set("memory_limit","2048M");
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $ciax=$this->Catalogos_model->busca_cia_una($cia);
        $titulo = "ESTADO BANCARIO DEL MES DE ".$mesx." DEL ".$aaa." DE LA RAZON SOCIAL ".$ciax;
        $archivo='detalle_'.date('Ymd_H_i_s');
        

        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$archivo.'.csv');
        
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        
        fputcsv($output, array("$titulo"));
        
        // output the column headings
        fputcsv($output, array('POLIZA','PRV', 'MES', 'CIA', 'CHEQUE CONTABLE', 'CHEQUE REAL', 'RECIBO', 'F.ENTRADA', 'F.VENCIMIENTO'
        , 'NID', 'SUCURSAL', 'FACTURA', 'SUBTOTAL', 'TASA 11%', 'TASA 16%', 'TASA 0%', 'TOTAL', '# DE FACTURAS'));
        
            $sql = "SELECT h.poliza, b.prv as prv,case when a.var='VR' then e.corto else d.corto end as prvx,
year(x.fecha)as aaa,month(x.fecha)as mes,
a.cia as cia,c.razon as ciax,a.cheque,a.cheque_real,b.contra,
b.fec_entrada,b.fec_ven,
b.suc,f.nombre as sucx,b.fac, b.sub as sub_fac,
case when g.suc = b.suc and year(fec_entrada)<2014 then b.iva else 0 end as iva_11,
case when g.suc is null or
g.suc = b.suc and year(fec_entrada)>=2014  then b.iva else 0 end as iva_16,

b.tot as tot_fac

FROM oficinas.concilia_cheques_c a
left join oficinas.concilia_cheques_banco x on x.cheque=a.cheque_real
left join oficinas.concilia_cheques_d b on b.cheque=a.cheque
left join catalogo.compa c on c.cia=a.cia
left join catalogo.provedor d on d.prov=b.prv
left join catalogo.provedorv e on e.prov=b.prv
left join catalogo.sucursal f on f.suc=b.suc
left join catalogo.suc_tasa_dif g on g.suc=b.suc
left join catalogo.cat_archivo_cxp h on h.var=a.var
where a.encontrado=1 and a.partida=0 and year(x.fecha)=? and month(x.fecha)=? and a.cia=?;";
            $query = $this->db->query($sql, array($aaa, $mes,$cia));
        // fetch the data
        $n=0;
        $var=0;
        
        foreach($query->result() as $row)
        {
            $n = $n + 1;
            if($var <> (int)$row->cheque_real)
            {
                $n = 1;
                
            }
            
            fputcsv($output, array($row->poliza,$row->prvx, $row->mes, $row->ciax, $row->cheque, $row->cheque_real, $row->contra,
            $row->fec_entrada, $row->fec_ven, $row->suc, $row->sucx, $row->fac, $row->sub_fac, $row->iva_11, 
            $row->iva_16, 0,$row->tot_fac,$n));
            
            
            
            $var=$row->cheque_real;
        }

    }

function plano_submit_ctl_cia($aaa,$mes,$cia)
    {
        set_time_limit(0);
        ini_set("memory_limit","2048M");
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $ciax=$this->Catalogos_model->busca_cia_una($cia);
        $titulo = "ESTADO BANCARIO DEL MES DE ".$mesx." DEL ".$aaa." DE LA RAZON SOCIAL ".$ciax;
        $archivo='Control_'.date('Ymd_H_i_s');
        

        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$archivo.'.csv');
        
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        
        fputcsv($output, array("$titulo"));
        
        // output the column headings
        fputcsv($output, array('POLIZA','PRV', 'MES', 'CIA', 'CHEQUE CONTABLE', 'CHEQUE REAL', 'SUBTOTAL', 
        'TASA 11%', 'TASA 16%', 'TASA 0%', 'TOTAL', '# DE FACTURAS'));
        
            $sql = "SELECT h.poliza,
case when a.var='VR' then c.razo else ifnull(b.corto,' ') end as prvx,
month(a.fecha)as mes,ifnull(e.corto,' ')as ciax,a.cheque_con,a.cheque,
(a.imp_cxp-iva_cxp)as sub,a.iva_cxp,
a.imp_cxp,
(select count(*) from oficinas.concilia_cheques_d x where x.cheque=a.cheque_con and x.cia=a.cia_cxp)as n,

ifnull((select sum(iva) from oficinas.concilia_cheques_d x join catalogo.suc_tasa_dif g where year(x.fec_entrada)<2014 and g.suc=x.suc and x.cheque=a.cheque_con and x.cheque_real=a.cheque and x.cia=a.cia_cxp),0)as iva_11,

ifnull((select sum(iva)from oficinas.concilia_cheques_d x
left join catalogo.suc_tasa_dif g on g.suc=x.suc
where
x.cheque=a.cheque_con and x.cheque_real=a.cheque and x.cia=a.cia_cxp and g.suc is null  and  fec_entrada>=2014
),0)as iva_16

FROM oficinas.concilia_cheques_banco a
left join catalogo.provedor b on b.prov=prv_cxp and a.prv_cxp>0
left join catalogo.provedorv c on c.prov=prv_cxp and a.prv_cxp>0
left join catalogo.compa e on e.cia=a.cia_cxp
left join catalogo.cat_archivo_cxp h on h.var=a.var
where year(fecha)=? and month(fecha)=?  and a.cia_cxp=? and imp_cxp>0 and a.partido=0
and a.observa not like '%TRASPASO%' and a.rfc not like '%SCOTIAENLINEA%' and motivo='CARGO' and a.cheque not in(400,100)
and a.observa not like '%SERVICIOS%' and a.observa not like '%IMPUESTO%'
order by a.var desc,prv_cxp";
            $query = $this->db->query($sql, array($aaa, $mes,$cia));
        // fetch the data
        $n=0;
        $var=0;
        
        foreach($query->result() as $row)
        {
            
            
            fputcsv($output, array($row->poliza,$row->prvx, $row->mes, $row->ciax, $row->cheque_con, $row->cheque, 
            $row->sub, $row->iva_11,$row->iva_16,0,$row->imp_cxp,$row->n));
            
            
            
            
        }

    }
    
    
    
 public function s_cheque_banco_prv($aaa,$mes)
    {
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        $data['titulo'] = "ESTADO BANCARIO DEL MES DE ".$mesx." DEL ".$aaa;
        $data['a'] = $this->fiscal_model->cheques_banco_prv($aaa,$mes);
        $data['js'] = 'fiscal/s_cheque_banco_det_partida_js';
        $this->load->view('main', $data);
    }
    
   public function s_cheque_banco_det_prv($fil,$aaa,$mes,$prv,$var)
    {
        $data['titulo'] = "ESTADO BANCARIO";
        $data['a'] = $this->fiscal_model->cheques_banco_det_prv($fil,$aaa,$mes,$prv,$var);
        $data['js'] = 'fiscal/s_cheque_banco_det_js';
        $this->load->view('main', $data);
    } 

    function plano_submit_det_prv($aaa,$mes,$prv,$var)
    {
        set_time_limit(0);
        ini_set("memory_limit","2048M");
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        if($var<>'VR'){
            $prvx=$this->Catalogos_model->busca_prv_uno($prv);    
        }else{
            $prvx=$this->Catalogos_model->busca_prv_uno_dr($prv);
        }
        
        $titulo = "ESTADO BANCARIO DEL MES DE ".$mesx." DEL ".$aaa." DEL PROVEDOR ".$prvx;
        $archivo='detalle_'.date('Ymd_H_i_s');
        

        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$archivo.'.csv');
        
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        
        fputcsv($output, array("$titulo"));
        
        // output the column headings
        fputcsv($output, array('POLIZA','PRV', 'MES', 'CIA', 'CHEQUE CONTABLE', 'CHEQUE REAL', 'RECIBO', 'F.ENTRADA', 'F.VENCIMIENTO'
        , 'NID', 'SUCURSAL', 'FACTURA', 'SUBTOTAL', 'TASA 11%', 'TASA 16%', 'TASA 0%', 'TOTAL', '# DE FACTURAS'));
        
            $sql = "SELECT h.poliza,b.prv as prv,case when a.var='VR' then e.corto else d.corto end as prvx, 
year(x.fecha)as aaa,month(x.fecha)as mes,
a.cia as cia,c.razon as ciax,a.cheque,a.cheque_real,b.contra,
b.fec_entrada,b.fec_ven,
b.suc,f.nombre as sucx,b.fac, b.sub as sub_fac,
case when g.suc = b.suc and year(fec_entrada)<2014 then b.iva else 0 end as iva_11,
case when g.suc is null or
g.suc = b.suc and year(fec_entrada)>=2014  then b.iva else 0 end as iva_16,

b.tot as tot_fac

FROM oficinas.concilia_cheques_c a
left join oficinas.concilia_cheques_banco x on x.cheque=a.cheque_real
left join oficinas.concilia_cheques_d b on b.cheque=a.cheque
left join catalogo.compa c on c.cia=a.cia
left join catalogo.provedor d on d.prov=b.prv
left join catalogo.provedorv e on e.prov=b.prv
left join catalogo.sucursal f on f.suc=b.suc
left join catalogo.suc_tasa_dif g on g.suc=b.suc
left join catalogo.cat_archivo_cxp h on h.var=a.var
where a.encontrado=1 and a.partida=0 and year(x.fecha)=? and month(x.fecha)=? and b.prv=?;";
            $query = $this->db->query($sql, array($aaa, $mes,$prv));
        // fetch the data
        $n=0;
        $var=0;
        
        foreach($query->result() as $row)
        {
            $n = $n + 1;
            if($var <> (int)$row->cheque_real)
            {
                $n = 1;
                
            }
            
            fputcsv($output, array($row->poliza,$row->prvx, $row->mes, $row->ciax, $row->cheque, $row->cheque_real, $row->contra,
            $row->fec_entrada, $row->fec_ven, $row->suc, $row->sucx, $row->fac, $row->sub_fac, $row->iva_11, 
            $row->iva_16, 0,$row->tot_fac,$n));
            
            
            
            $var=$row->cheque_real;
        }

    }

function plano_submit_ctl_prv($aaa,$mes,$prv,$var)
    {
        set_time_limit(0);
        ini_set("memory_limit","2048M");
        $mesx=$this->Catalogos_model->busca_mes_uno($mes);
        if($var<>'VR'){
            $prvx=$this->Catalogos_model->busca_prv_uno($prv);    
        }else{
            $prvx=$this->Catalogos_model->busca_prv_uno_dr($prv);
        }
        
        $titulo = "ESTADO BANCARIO DEL MES DE ".$mesx." DEL ".$aaa." DEL PROVEDOR ".$prvx;
        $archivo='Control_'.date('Ymd_H_i_s');
        

        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename='.$archivo.'.csv');
        
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');
        
        fputcsv($output, array("$titulo"));
        
        // output the column headings
        fputcsv($output, array('POLIZA','PRV', 'MES', 'CIA', 'CHEQUE CONTABLE', 'CHEQUE REAL', 'SUBTOTAL', 
        'TASA 11%', 'TASA 16%', 'TASA 0%', 'TOTAL', '# DE FACTURAS'));
        
            $sql = "SELECT h.poliza,
case when a.var='VR' then c.razo else ifnull(b.corto,' ') end as prvx,a.cia_cxp,
month(a.fecha)as mes,ifnull(e.corto,' ')as ciax,a.cheque_con,a.cheque,
(a.imp_cxp-iva_cxp)as sub,a.iva_cxp,
a.imp_cxp,
(select count(*) from oficinas.concilia_cheques_d x where x.cheque=a.cheque_con and x.cia=a.cia_cxp)as n,
ifnull((select sum(iva) from oficinas.concilia_cheques_d x join catalogo.suc_tasa_dif g where year(x.fec_entrada)<2014 and g.suc=x.suc and x.cheque=a.cheque_con and x.cheque_real=a.cheque and x.cia=a.cia_cxp),0)as iva_11,

ifnull((select sum(iva)from oficinas.concilia_cheques_d x
left join catalogo.suc_tasa_dif g on g.suc=x.suc
where
x.cheque=a.cheque_con and x.cheque_real=a.cheque and x.cia=a.cia_cxp and g.suc is null  and  fec_entrada>=2014
),0)as iva_16

FROM oficinas.concilia_cheques_banco a
left join catalogo.provedor b on b.prov=prv_cxp and a.prv_cxp>0
left join catalogo.provedorv c on c.prov=prv_cxp and a.prv_cxp>0
left join catalogo.compa e on e.cia=a.cia_cxp
left join catalogo.cat_archivo_cxp h on h.var=a.var
where year(fecha)=? and month(fecha)=?  and a.prv_cxp=? and imp_cxp>0 and a.partido=0 and a.var='$var'
and a.observa not like '%TRASPASO%' and a.rfc not like '%SCOTIAENLINEA%' and motivo='CARGO' and a.cheque not in(400,100)
and a.observa not like '%SERVICIOS%' and a.observa not like '%IMPUESTO%'
order by a.var desc,prv_cxp";
            $query = $this->db->query($sql, array($aaa, $mes,$prv));
        // fetch the data
        $n=0;
        $var=0;
        
        foreach($query->result() as $row)
        {
            
            
            fputcsv($output, array($row->poliza,$row->prvx, $row->mes, $row->ciax, $row->cheque_con, $row->cheque, 
            $row->sub, $row->iva_11,$row->iva_16,0,$row->imp_cxp,$row->n));
            
            
            
            
        }

    }
 
    
   
   
   
   
   
   
   
   
   public function s_cheque_banco_det($fil,$aaa,$mes)
    {
        $data['titulo'] = "ESTADO BANCARIO";
        $data['a'] = $this->fiscal_model->cheques_banco_det($fil,$aaa,$mes);
        $data['js'] = 'fiscal/s_cheque_banco_det_js';
        $this->load->view('main', $data);
    }
    
    public function s_cheque_banco_det_partida()
    {
        $data['titulo'] = "Estado de cuenta bancario";
        $data['a'] = $this->fiscal_model->cheques_banco_det_partida();
        $data['js'] = 'fiscal/s_cheque_banco_det_partida_js';
        $this->load->view('main', $data);
    }
    






}
