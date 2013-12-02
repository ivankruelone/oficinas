<?php
global $cabezota;
$l0='<img src="'.base_url().'img/logo.png" border="0" width="200px" />';
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
LA VIGENCIA DE ES TE PEDIDOS ES DE 10 DIAS NATURALES; APARTIR DE LA FECHA GENERADA. NO SE RECIBIRA
NINGUN PEDIDO VENCIADO.';
// ---------------------------------------------------------// ---------------------------------------------------------
$e='';
$f='';
     $fec=date('Y-m-d H:i:s');
    $s="select ADDDATE(a.fecha,10)as fechaee, a.*,b.*,c.razon as razonx, c.razon as razonx, 
    c.dire as direx, c.col,c.pobla as poblax,c.cp as cpx,c.rfc as rfcx,
    d.id_firma,e.completo
    from compras.pedido_c a 
    left join catalogo.provedor b on b.prov=a.prv
    left join catalogo.compa c on c.cia=a.cia
    left join compras.usuarios d on d.id=a.id_user
    left join catalogo.cat_empleado e on e.nomina=d.responsable
    where a.id=$id";
    $q=$this->db->query($s);
    if($q->num_rows()>0){
        $r=$q->row();
        $nombre=$r->completo;
        $imagen=$r->id_firma;
        $l1='<img src="'.base_url().'img/firma/'.$imagen.'.png" border="0" width="90px" />';
        
        $e.="<table  cellpadding=\"2\">
        <thead>
        
        <tr>
        <th colspan=\"14\" align=\"center\"><font size=\"+3\"><strong>ORDEN DE COMPRA PARA ALMACEN CENTRAL</strong></font></th>
        </tr>
         <tr>
        <th colspan=\"7\" align=\"left\"><font size=\"+3\"><strong>ENTREGAR ANTES DE $r->fechaee</strong></font></th>
        <th colspan=\"7\" align=\"right\"><font size=\"-2\"><strong>Fecha de impresion $fec</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"3\" align=\"left\"></th>
        <th colspan=\"3\" align=\"left\"></th>
        <th colspan=\"5\" align=\"left\"><font size=\"+1\"><strong>CONSIGNAR PEDIDO A</strong></font></th>
        <th colspan=\"3\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>Orden.: $r->folprv</strong></font></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>$r->razo</strong></font></th>
        <th colspan=\"5\" align=\"left\"><font size=\"+1\"><strong>$r->razonx</strong></font></th>
        <th colspan=\"3\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"3\" align=\"left\"></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>$r->dire</strong></font></th>
        <th colspan=\"5\" align=\"left\"><font size=\"+1\"><strong>$r->direx</strong></font></th>
        <th colspan=\"3\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"3\" align=\"left\"></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>C.P $r->cp</strong></font></th>
        <th colspan=\"5\" align=\"left\"><font size=\"+1\"><strong>$r->cpx</strong></font></th>
        <th colspan=\"3\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"3\" align=\"left\"></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>$r->pobla</strong></font></th>
        <th colspan=\"5\" align=\"left\"><font size=\"+1\"><strong>$r->poblax</strong></font></th>
        <th colspan=\"3\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"3\" align=\"left\"></th>
        <th colspan=\"3\" align=\"left\"><font size=\"+1\"><strong>$r->rfc</strong></font></th>
        <th colspan=\"5\" align=\"left\"><font size=\"+1\"><strong>$r->rfcx</strong></font></th>
        <th colspan=\"3\" align=\"left\"></th>
        </tr>
        <tr>
        <th colspan=\"1\" align=\"left\"><strong>SEC</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>CLAGOB</strong></th>
        <th colspan=\"2\" align=\"left\"><strong>CODIGO</strong></th>
        <th colspan=\"4\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>PIEZAS</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>REGALO</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>COSTO</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>IMPORTE</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>DESCU.</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>TOTAL</strong></th>
        </tr>
        </thead>
       <tbody>";
       }
       
                            
                                 $color='gray'; $color1='black'; $color2='blue'; $color3='green'; 
                                $num=0;$t1=0;$t2=0;$t11=0;$t3=0;
                                
                                foreach ($a->result() as $r) {
                                 if($r->descu>0){
                                    $descu=($r->costo*$r->ped)-(($r->costo*$r->ped)*($r->descu/100));
                                    }else{
                                    $descu=($r->costo*$r->ped);}
                             $e.="     
                                        <tr>
                                        <td>".$r->sec."</td>
                                        <td colspan=\"1\">".$r->clagob."</td>
                                        <td colspan=\"2\">".$r->codigo."</td>
                                        <td style=\"text-align: left;\" colspan=\"4\">".$r->susa."<br />".$r->descri."</td>
                                        <td style=\"text-align: right;\">".number_format($r->ped,0)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->regalo,0)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->costo,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->costo*$r->ped,2)."</td>
                                        <td style=\"text-align: right;\">".number_format(($r->costo*$r->ped)-$descu,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($descu,2)."</td>
                                        
                                        </tr>";
                               $t1=$t1+$r->ped;
                                $t11=$t11+$r->regalo;
                               $t2=$t2+($r->costo*$r->ped);
                               $t3=$t3+($descu);
                               $num=$num+1;
                                        }
                              $e.="  
                             </tbody>
                             <tfoot>
                             <tr>
                             <td style=\"text-align: left;color: royalblue;\" colspan=\"8\">Productos $num</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($t1,0)."</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($t11,0)."</td>
                             <td style=\"text-align: right;color: royalblue;\"></td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($t2,2)."</td>
                             <td style=\"text-align: right;color: royalblue;\"></td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($t3,2)."</td>
                             </tr>
                             <tr>
                             <td colspan=\"14\" style=\"text-align:center;\">ATENTAMENTE</td>
                             </tr>
                             <tr>
                             <td colspan=\"14\" style=\"text-align:center;\">".$l1."</td>
                             </tr> 
                             <tr>
                             <td colspan=\"14\" style=\"text-align:center;\">".$nombre."</td>
                             </tr>
                             <tr>
                             <td colspan=\"14\" style=\"text-align:left;\">".$texto1."</td>
                             </tr> 
                             </tfoot>
        </table>";
// ---------------------------------------------------------
// ---------------------------------------------------------  

// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font
$pdf->SetFont('helvetica', '', 9	);

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