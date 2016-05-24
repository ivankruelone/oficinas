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

$this->SetFont('helvetica', '', 7);
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
        //
        // $pdf->Image('imagenes/metro2.jpg', 15, 140, 75, 113, 'JPG', '', '', true, 150, '', false, false, 1, false, false, false);
        // Page number 
        $this->Cell(0, 9, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'C'); 
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
//// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins 
$pdf->SetMargins(4, 62.1, 5); 
//$pdf->SetMargins(PDF_MARGIN_LEFT, 61.4, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER); 
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER); 

//set auto page breaks 
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
//set image scale factor 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  

$pdf->SetFont('helvetica', '', 6);
$pdf->AddPage(); 
//-----------------------------------------------------------------------------
$tabla = '';
$num = 0;
foreach($query->result() as $row)
{
$num = $num+1;
$tabla .= "<table border=\"1\">
    <tbody>
        <tr>
            <td style=\"width: 10%;\">".$operacion."</td>
            <td style=\"width: 20%;\">".$row->servicios."</td>
            <td style=\"width: 30%;\">".$row->detalle."</td>
            <td style=\"width: 10%;\">".$row->especifique."</td>
        </tr>
    </tbody>
    </table>
    "; 
}
//$pdf->SetFont('helvetica', '', 6);
//$pdf->AddPage(); 
$tbl= <<<EOD
$tabla
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
//*-------------------------------------------------------------------------------

$pdf->SetFont('helvetica', '', 7	);
$pdf->Ln(8);
$tbl = <<<EOD
$final
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
// set font
// -----------------------------------------------------------------------------
$pdf->SetFont('helvetica', '', 7);
$pdf->Ln(8);
$tbl = <<<EOD
$div
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
//----------------------------------------------------------------------------
$pdf->SetFont('helvetica', '', 6);
$pdf->Ln(2);
$tbl = <<<EOD
$cabeza2
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
 
$pdf->SetFont('helvetica', '', 6);
$tbl = <<<EOD
$tabla
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
//-----------------------------------------------------------------------------
$pdf->SetFont('helvetica', '', 7	);
$pdf->Ln(8);
$tbl = <<<EOD
$final
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
// ----------------------------------------------------------------------------

//Close and output PDF document
$pdf->Output('Orden_Mantenimiento.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+