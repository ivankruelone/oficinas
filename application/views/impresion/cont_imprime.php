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

$this->SetFont('helvetica', '', 7	);
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
$pdf->SetTitle(''); 
$pdf->SetSubject('TCPDF Tutorial'); 
$pdf->SetKeywords('TCPDF, PDF, example, test, guide'); 

// set default header data 
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING); 

// set header and footer fonts 
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN)); 
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins y separacion
$pdf->SetMargins(PDF_MARGIN_LEFT, 38, PDF_MARGIN_RIGHT); 
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER); 
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 

//set image scale factor 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

//set some language-dependent strings 

// ---------------------------------------------------------
// ---------------------------------------------------------
$texto1='Le pedimos la cantidad minima de los productos a 12 meses.
Favor de incluir el numero de pedido en la factura.<br />
LA VIGENCIA DE ES TE PEDIDOS ES DE 7 DIAS NATURALES; APARTIR DE LA FECHA GENERADA. NO SE RECIBIRA
NINGUN PEDIDO VENCIDO.';
// ---------------------------------------------------------
$e='';
$f='';
$totfal=0;
                        $e.="</ br>
                             </ br>
                             <table border=\"1\">
                             <thead>
                                 <tr>
                                 <td width=\"170\"><strong>Art&iacute;culo</strong></td>
                                 <td width=\"50\"><strong>Cant</strong></td>
                                 <td width=\"170\"><strong>Art&iacute;culo</strong></td>
                                 <td width=\"50\"><strong>Cant</strong></td>
                                 <td width=\"170\"><strong>Art&iacute;culo</strong></td>
                                 <td width=\"50\"><strong>Cant</strong></td>
                                 </tr>
                             </thead>
                             <tbody>";
                                  $d1='';$d2='';$d3='';$ya=0;
                                $num=1;$c1=0;$c2=0;$c3=0;
                                foreach ($a as $r) {
                                if($num==1){$d1=$r['descripcion']." ".$r['empaque'];$c1=$r['cans'];$ya=0;}
                                elseif($num==2){$d2=$r['descripcion']." ".$r['empaque'];$c2=$r['cans'];$ya=0;}
                                elseif($num==3){$d3=$r['descripcion']." ".$r['empaque'];$c3=$r['cans'];$ya=1;}
                             
                             if($ya==1)
                             {
                             $e.="     
                                      <tr>  
                                        <td width=\"170\">".$d1."</td>
                                        <td width=\"50\">".$c1."</td>
                                        <td width=\"170\">".$d2."</td>
                                        <td width=\"50\">".$c2."</td>
                                        <td width=\"170\">".$d3."</td>
                                        <td width=\"50\">".$c3."</td>
                                      </tr>";
                                     
                             $d1='';$d2='';$d3='';$c1='';$c2='';$c3='';
                             }
                             $num=$num+1;
                             if($num==4){$num=1;} 
                             }
                             if($d1<>''){
                             $e.="     
                                      <tr>  
                                        <td width=\"170\">".$d1."</td>
                                        <td width=\"50\">".$c1."</td>
                                        <td width=\"170\">".$d2."</td>
                                        <td width=\"50\">".$c2."</td>
                                        <td width=\"170\">".$d3."</td>
                                        <td width=\"50\">".$c3."</td>
                                      </tr>";   
                             $d1='';$d2='';$d3='';$c1='';$c2='';$c3='';
                             }
                              $e.="  
                             </tbody>
                         </table>";
// ---------------------------------------------------------
// ---------------------------------------------------------  

// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font
$pdf->SetFont('helvetica', '', 8);

$pdf->AddPage();
$tbl = <<<EOD
$e
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
$pdf->SetFont('helvetica', '', 7	);
$pdf->Ln(8);
$tbl = <<<EOD
$finalc
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------
$pdf->SetFont('helvetica', '', 7	);

$tbl = <<<EOD
$div
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
$pdf->SetFont('helvetica', '', 8	);
$pdf->Ln(2);
$tbl = <<<EOD
$cabeza2
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
   
$pdf->SetFont('helvetica', '', 8	);
$tbl = <<<EOD
$e
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$pdf->SetFont('helvetica', '', 7	);
$pdf->Ln(8);
$tbl = <<<EOD
$finalc
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->SetFont('helvetica', '', 7	);

$tbl = <<<EOD
$div
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// -----------------------------------------------------------------------------
$pdf->SetFont('helvetica', '', 8	);
$pdf->Ln(2); 
$tbl = <<<EOD
$cabeza2
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
   
$pdf->SetFont('helvetica', '', 8	);
$tbl = <<<EOD
$e
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
$pdf->SetFont('helvetica', '', 7	);
$pdf->Ln(8);  
$tbl = <<<EOD
$finalc
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
ob_clean();
//Close and output PDF document
$pdf->Output('insumos.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+