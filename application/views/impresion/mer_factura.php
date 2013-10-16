<?php
global $cabezota;

$cabezota=$cabeza;

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
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

// set document information 
$pdf->SetCreator(PDF_CREATOR); 
$pdf->SetAuthor('Lidia Velazquez'); 
$pdf->SetTitle('Factura'); 
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT); 
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
$e='';
$f='';
$totfal=0;
     $e.="<table cellpadding=\"2\">
                             <thead>
                             <tr>
                             <td width=\"545\">________________________________________________________________________________________________</td>
                             </tr>
                                 <tr>
                                     <th width=\"85\">Codigo</th>
                                     <th width=\"250\">Descriocion</th>
                                     <th width=\"70\" align=\"right\">Cantidad</th>
                                     <th width=\"70\" align=\"right\">Costo</th>
                                     <th width=\"70\" align=\"right\">Importe</th>
                                     
                                 </tr>
                                 <tr>
                             <td width=\"545\">________________________________________________________________________________________________</td>
                             </tr>
                             </thead>
                             <tbody>";
                             
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;$timpo=0;
                                foreach ($a->result() as $r) {
                                
                             $e.="     
                                        <tr>
                                        <td width=\"85\">".$r->codigo."</td>
                                        <td width=\"250\">".$r->descri."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($r->can,0)."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($r->costo,2)."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($r->can*$r->costo,2)."</td>
                                        </tr>";
                                        $tu1=$tu1+$r->can;
                                        $tu2=$tu2+($r->can*$r->costo);
                                        $num=$num+1;
                                        }
                              $e.="  
                             </tbody>
                             <tfoot>
                             <tr>
                             <td style=\"text-align: left;color: royalblue;\" colspan=\"2\"  width=\"335\">TOTAL DE PRODUCTOS $num</td>
                             <td style=\"text-align: right;color: royalblue;\" width=\"70\">".number_format($tu1,0)."</td>
                             <td></td>
                             <td style=\"text-align: right;color: royalblue;\" width=\"70\">".number_format($tu2,2)."</td>
                             </tr>
                             </tfoot>
                         </table>";
// ---------------------------------------------------------
// ---------------------------------------------------------  
//echo $e;
//die();
// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font
$pdf->SetFont('helvetica', '', 8	);

$pdf->AddPage();
$tbl = <<<EOD
$e
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output('factura.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+