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

// ---------------------------------------------------------// ---------------------------------------------------------
$e='';
$f='';
     $fec=date('Y-m-d H:i:s');
    
        $e.="<table  cellpadding=\"2\" border=\"-1\">
                <thead>
                                <tr bgcolor=\"#D1EAF2\">
                                <th colspan=\"10\" align=\"center\">RENTABILIDAD DE FARMACIAS</th>
                                </tr>
                                <tr bgcolor=\"#D1EAF2\"> 
                                     <th align =\"center\">A&ntilde;o</th>
                                     <th align =\"center\">Mes</th>
                                     <th align =\"right\">Venta</th>
                                     <th align =\"right\">Costo de la Venta</th>
                                     <th align =\"right\">Gastos</th>
                                     <th align =\"right\">Utilidad</th>
                                     <th align =\"right\">% Utilidad</th>
                                     <th align =\"right\">Monto por Cada sucursal</th>
                                     <th align =\"right\">Utilidad con 40%<br />Gastos de oficina</th>
                                     <th align =\"right\">% Utilidad con 40%<br />Gastos de oficina</th>
                                  </tr>
             </thead>
            <tbody>";
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;                        
                                foreach ($q1->result() as $r1) {
                                    $mas_gasto=(($r1->gas_x_suc)*($r1->num_suc))+$r1->gastos;
                                    $utilidad_40=$r1->venta-(+$r1->costo_venta+$mas_gasto);
                                       
                             $e.="     
                                        <tr>
                                        <td colspan=\"1\">".$r1->aaa."</td>
                                        <td colspan=\"1\">".$r1->mes." ".$r1->mesx."</td>
                                        <td style=\"text-align: right;\">".number_format($r1->venta,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($r1->costo_venta,2)."</td>
                                        <td style=\"text-align: right;\">% ".number_format($r1->gastos,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($r1->utilidad,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($r1->p_utilidad,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($r1->gas_x_suc,2)."</td>
                                        <td style=\"text-align: right;\">".number_format(($utilidad_40),2)."</td>
                                        <td style=\"text-align: right;\">".number_format((($utilidad_40/$r1->venta)*100),2)."</td>
                                        </tr>";
                               $t1=$t1+$r1->venta;
                               $t2=$t2+$r1->costo_venta;
                               $t3=$t3+($r1->gastos);
                               $t4=$t4+($r1->utilidad);
                               $t5=$t5+($utilidad_40);
                               }
                              $e.="  
                             </tbody>
                             <tfoot>
                             <tr>
                             <td style=\"text-align: left;color: royalblue;\" colspan=\"10\">TOTAL</td>
                             
                             </tr> 
                             </tfoot>
        </table>";
// ---------------------------------------------------------
// ---------------------------------------------------------  

// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font
$pdf->SetFont('helvetica', '', 6	);

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