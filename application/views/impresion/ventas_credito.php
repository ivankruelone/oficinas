<?php
global $cabezota;
$cabezota=' ';

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
$texto1="select max(date_format(b.fecha,'%d'))as ultimo
from catalogo.mes a,vtadc.vta_backoffice_credito b
where date_format(b.fecha,'%Y')=year(now()) and date_format(b.fecha,'%m')=3 and vtatip=71
group by date_format(b.fecha,'%m')";
// ---------------------------------------------------------// ---------------------------------------------------------

$tf=0;$tfin=0;                        
                                
                             $columna=$dia+2;
                             $e="<table border=\"1\">
                             <thead>
                             <tr>
                             <th colspan=\"$columna\">".$tit."</th>
                             </tr>
                             </thead>
                             <tbody>
                             ";   
                                foreach ($a as $r) {
                             $e.="
                             
                             <tr bgcolor=\"gray\">
                             <td  width=\"250\"><strong>".$r['suc']." ".$r['sucx']."</strong></td>";
                            for($kd = 1; $kd <= $dia; $kd++)
                            {
                            $e.="
                            <td  width=\"100\"><strong>".$kd."</strong></td>";
                            }
                             $e.="
                             <td>TOTAL</td>
                             </tr>
                            
                             
                            ";
                            
                                    foreach ($r['segundo'] as $r1) {
                             $e.="
                             <tr>
                             <td  width=\"250\">".$r1['lin']."</td>
                            ";
                           
                            for($kd = 1; $kd <= $dia; $kd++)
                            {   
                                
                                if(isset($r1['tercero'][str_pad($kd,2,"0",STR_PAD_LEFT)]['imp']))
                                {
                                $paso = $r1['tercero'][str_pad($kd,2,"0",STR_PAD_LEFT)]['imp'];
                                }else{
                                    $paso = 0;
                                }
                                
                             
                                //echo $r1['dia'];
                            $e.="
                            <td align=\"right\" width=\"100\">".number_format($paso,2)."</td>
                            ";
                            $tf=$tf+$paso;
                            }
                            //echo $to;
                            $e.="
                            <td align=\"right\" width=\"100\"><strong>".number_format($tf,2)."</strong></td>
                              </tr>";
                              $tfin=$tfin+$tf;
                              $tf=0;

                            $e.="";  
                             
                            }
                            $tot=$kd+1;
                            $e.="
                            <tr bgcolor=\"orange\">
                            <td align=\"right\" colspan=\"$columna\"><strong>".number_format($tfin,2)."</strong></td>
                            </tr>
                             ";
                            $tfin=0;
                              
                            }
                              
                              
                              $e.="  
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
        </table>";
// ---------------------------------------------------------
// ---------------------------------------------------------  
echo $e;
die();
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
$pdf->Output('metro.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+