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

//set margins 
$pdf->SetMargins(PDF_MARGIN_LEFT, 10, PDF_MARGIN_RIGHT); 
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
$f='';$s='';$conteo=0;
$totfal=0;
                        
                                 
                                $num=1;$c1=0;$c2=0;$c3=0;
if($a<>'')
{
                                foreach ($a as $r0)
                                {
                        $e.="<table celpadding=3>
                             
                        <tbody>";
                                    $conteo=$conteo+1;
                                $e.="
                                <tr>
                                <td width=\"660\">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </td>
                                </tr>
                                <tr>
                                <td width=\"60\"><strong>Folio ".$r0['id_cc']." ".$r0['fol']."</strong></td>
                                <td width=\"600\"><strong>".$r0['suc']." - ".$r0['nombre']." - ".$r0['sucx']."</strong></td>
                                </tr>
                                <tr>
                                <td width=\"660\">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - </td>
                                </tr>
                                
                                ";
                                 $d1='';$d2='';$d3='';$ya=0;
                                foreach ($r0['d'] as $r) {
                                
                                    if($num==1){$d1=$r['descripcion']." ".$r['empaque'];$c1=$r['cans'];$ya=0;$p1=$r['canp'];}
                                elseif($num==2){$d2=$r['descripcion']." ".$r['empaque'];$c2=$r['cans'];$ya=0;$p2=$r['canp'];}
                                elseif($num==3){$d3=$r['descripcion']." ".$r['empaque'];$c3=$r['cans'];$ya=1;$p3=$r['canp'];}
                             
                             if($ya==1)
                             {
                             $e.="     
                                      <tr>  
                                        <td width=\"170\">".$d1."</td>
                                        <td width=\"30\">".$p1."</td>
                                        <td width=\"170\">".$d2."</td>
                                        <td width=\"30\">".$p2."</td>
                                        <td width=\"170\">".$d3."</td>
                                        <td width=\"30\">".$p3."</td>
                                      </tr>";
                                     
                             $d1='';$d2='';$d3='';$c1='';$c2='';$c3='';
                             }
                             $num=$num+1;
                             if($num==4){$num=1;}
                             $e.=""; 
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
                             $num=1;
                             }

if($conteo==3)
{
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 8	);
$tbl = <<<EOD
$e
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

                        $e.="  
                        </tbody>
                        </table>";
                        $e="";
$conteo=0;
}
                             }

if($conteo>0)
{
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 8	);
$tbl = <<<EOD
$e
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
    
}
}                            
                              
// ---------------------------------------------------------
// ---------------------------------------------------------  

// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font

// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------
//Close and output PDF document
$pdf->Output('insumos.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+