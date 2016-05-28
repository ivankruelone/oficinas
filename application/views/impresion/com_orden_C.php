<?php
global $cabezota;
$l0="<img style=\"position:relative; width:150px;\", src=\"'.base_url().'../../img/logo.png\" />";
$cabezota=$l0;

require_once('tcpdf/config/tcpdf_config.php');
require_once('tcpdf/tcpdf.php');



// Extend the TCPDF class to create custom Header and Footer 
class MYPDF extends TCPDF { 
   	
    
    public function Header() { 

/////////////////////////////////////////////////////////////////
global $cabezota;

$this->SetFont('helvetica', '', 8	);
$tbl = <<<EOD
$cabezota
EOD;
$this->writeHTML($tbl, true, false, false, false, '');
    } 
     
    // Page footer 
    public function Footer() { 
        // Position at 1.5 cm from bottom 
        $this->SetY(-15); 
        // Set font 
        $this->SetFont('helvetica', 'I', 9); 
        // Page number 
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'C'); 
    } 
} 

// create new PDF document 
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// set document information 
$pdf->SetCreator(PDF_CREATOR); 
$pdf->SetAuthor('Lidia Velazquez'); 
$pdf->SetTitle('Orden'); 
$pdf->SetSubject('TCPDF Tutorial'); 
$pdf->SetKeywords('TCPDF, PDF, example, test, guide'); 

// set default header data 
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING); 

// set header and footer fonts 
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN)); 
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins 
$pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT); 
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER); 
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 

//set image scale factor 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

//set some language-dependent strings 

// ---------------------------------------------------------
// ---------------------------------------------------------

// ---------------------------------------------------------
$texto1='Le pedimos la caducidad minima de los productos a 12 meses.
Favor de incluir el numero de pedido en la factura.<br />
LA VIGENCIA DE ES TE PEDIDOS ES DE 20 DIAS NATURALES; APARTIR DE LA FECHA GENERADA. NO SE RECIBIRA
NINGUN PEDIDO VENCIADO.';
// ---------------------------------------------------------// ---------------------------------------------------------
$e='';
$f='';
     $fec=date('Y-m-d H:i:s');
    $s="select ifnull(h.estado,' ') as edoxx,gm.domicilio,a.estatus,f.id as alma,f.estado as destino, fecha_limite as fechaee, a.*,b.*,c.razon as razonx,
    c.dire as direx, c.col,c.pobla as poblax,c.cp as cpx,c.rfc as rfcx,case when a.licita <>' ' then a.licita else f.licitacion end as licita,
    ifnull(f.estado,' ')as estado,
    ifnull(d.id_firma,'0')as id_firma,ifnull(e.completo,' ')as completo,ifnull(g.completo,' ')as capturax
    from compras.orden_c a
    left join catalogo.provedor b on b.prov=a.prv
    left join catalogo.compa c on c.cia=a.cia
    left join compras.usuarios d on d.id=a.id_captura
    left join catalogo.cat_empleado e on e.nomina=a.id_responsable and e.tipo=1
    left join catalogo.cat_empleado g on g.nomina=d.nomina and g.tipo=1
    left join compras.numero_de_licitaciones f on f.id=a.id_estado
    left join compras.numero_de_licitaciones h on h.licitacion=a.licita and  h.licitacion<>''
    left join compras.consigna gm on gm.suc=a.recibe
    where a.id_orden=$id";
    $q=$this->db->query($s);
    if($q->num_rows()>0){
        $r=$q->row();
        $nombre=$r->completo;
        $imagen=$r->id_responsable;
        $captura=$r->capturax;
        if($r->alma<>7){$lic='No. Licitacion:'.$r->licita.' '.$r->edoxx;}else{$lic='';}
        $l1= "<img style=\"position:relative; width:90px;\", src=\"'.base_url().'../../img/firma/$imagen.png\" />"; //'<img src="'.base_url().'img/firma/'.$imagen.'.png" border="0" width="90px" />';
        if($r->estatus==0){$cancela='CANCELADA';}else{$cancela='';}
        $e.="<table  cellpadding=\"2\">
        <thead>
        
        <tr>
        <th colspan=\"16\" align=\"center\"><font size=\"+3\"><strong>ORDEN DE COMPRA PARA $r->destino <font color=\"red\"size=\"+20\">$cancela</font><br />$lic</strong></font></th>
        </tr>
         <tr>
        <th colspan=\"8\" align=\"left\"><font size=\"+3\"><strong>ENTREGAR ANTES DE $r->fechaee</strong></font></th>
        <th colspan=\"8\" align=\"right\"><font size=\"-2\"><strong>Fecha de impresion $fec</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"6\" align=\"left\">FECHA DE ELABORACION $r->fecha_envio $captura</th>
        
        <th colspan=\"5\" align=\"left\"><font size=\"+1\"><strong>FACTURAR A</strong></font></th>
        <th colspan=\"5\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>Orden.: $r->folprv</strong></font></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>$r->prv $r->razo</strong></font></th>
        <th colspan=\"5\" align=\"left\"><font size=\"+1\"><strong>$r->razonx</strong></font></th>
        <th colspan=\"5\" align=\"left\">ENTREGAR PEDIDO EN</th>
        </tr>
        <tr>
        <th colspan=\"3\" align=\"left\"></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>$r->dire<br />C.P $r->cp<br />$r->pobla</strong></font></th>
        <th colspan=\"5\" align=\"left\"><font size=\"+1\"><strong>$r->direx<br />C.P $r->cpx<br />$r->col<br />$r->poblax</strong></font></th>
        <th colspan=\"5\" align=\"left\"><font size=\"+1\"><strong>$r->domicilio</strong></font></th>
        </tr>
        
       
        <tr>
        <th colspan=\"3\" align=\"left\"></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>$r->rfc</strong></font></th>
        <th colspan=\"5\" align=\"left\"><font size=\"+1\"><strong>$r->rfcx</strong></font></th>
        <th colspan=\"5\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"1\" align=\"left\"><strong>SEC</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>CLAGOB</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>CODIGO</strong></th>
        <th colspan=\"4\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>PIEZAS</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>REGALO</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>COSTO</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>DESCU.</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>SUBTOTAL</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>$ DESCU.</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>$ IEPS</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>$ IVA</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>TOTAL</strong></th>
        </tr>
        </thead>
       <tbody>";
       }
       
                            
                                 $color='gray'; $color1='black'; $color2='blue'; $color3='green'; 
                                $num=0;$t1=0;$t2=0;$t11=0;$t3=0;$t4=0;$t5=0;$t6=0;
                                
                                foreach ($a->result() as $r) {
                                 if($r->descuento>0)
                                 {$descu=($r->costo*$r->cans)-(($r->costo*$r->cans)*($r->descuento/100));}else{
                                 $descu=($r->costo*$r->cans);}
                                 if($r->ieps>0)
                                 {$ieps=(($r->costo*$r->cans)-(($r->costo*$r->cans)*($r->descuento/100)))*($r->ieps/100);}else{
                                 $ieps=0;}
                                 
                                 if($r->iva==0){$iva=0;}else{$iva=($descu+$ieps)*.16;}
                                 
                                 
                                 
                             $e.="     
                                        <tr>
                                        <td>".$r->sec."</td>
                                        <td colspan=\"1\">".$r->clagob."</td>
                                        <td colspan=\"1\">".$r->codigo."</td>
                                        <td style=\"text-align: left;\" colspan=\"4\">".$r->susa1."<br />".$r->susa2."</td>
                                        <td style=\"text-align: right;\">".number_format($r->cans,0)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->canr,0)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->costo,2)."</td>
                                        <td style=\"text-align: right;\">% ".number_format($r->descuento,4)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->costo*$r->cans,2)."</td>
                                        <td style=\"text-align: right;\">".number_format(($r->costo*$r->cans)-$descu,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($ieps,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($iva,2)."</td>
                                        <td style=\"text-align: right;\">".number_format(($descu+$iva+$ieps),2)."</td>
                                        
                                        </tr>";
                               $t1=$t1+$r->cans;
                                $t11=$t11+$r->canr;
                               $t2=$t2+($r->costo*$r->cans);
                               $t3=$t3+($descu);
                               $t4=$t4+($iva);
                               $t5=$t5+($descu+$iva+$ieps);
                               $t6=$t6+($ieps);
                               $num=$num+1;
                                        }
                              $e.="  
                             </tbody>
                             <tfoot>
                             <tr>
                             <td style=\"text-align: left;color: royalblue;\" colspan=\"7\">Productos $num</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($t1,0)."</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($t11,0)."</td>
                             <td style=\"text-align: right;color: royalblue;\"></td>
                             <td style=\"text-align: right;color: royalblue;\"></td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($t2,2)."</td>
                             
                             <td style=\"text-align: right;color: royalblue;\"></td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($t6,2)."</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($t4,2)."</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($t5,2)."</td>
                             </tr>
                             <tr>
                             <td colspan=\"16\" style=\"text-align:center;\">ATENTAMENTE</td>
                             </tr>
                             <tr>
                             <td colspan=\"16\" style=\"text-align:center;\">".$l1."</td>
                             </tr> 
                             <tr>
                             <td colspan=\"16\" style=\"text-align:center;\">".$nombre."</td>
                             </tr>
                             <tr>
                             <td colspan=\"16\" style=\"text-align:left;\">".$texto1."</td>
                             </tr> 
                             </tfoot>
        </table>";
// ---------------------------------------------------------
//echo $e;
// ---------------------------------------------------------  
//die();
// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font
$pdf->SetFont('helvetica', '', 7	);

$pdf->AddPage();
$tbl = <<<EOD
$e
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output('Orden.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+