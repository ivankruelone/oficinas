<?php
global $cabezota;
$l0='<img src="'.base_url().'img/logo.png" border="0" width="200px" /><br /> Del '.$fec1.' al '.$fec2;
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT); 
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
// ---------------------------------------------------------// ---------------------------------------------------------
$e='';
$f='';
     $fec=date('Y-m-d H:i:s');
$nombre=$this->session->userdata('nombre');
$imagen=$this->session->userdata('id_firma');
       
        $l1='<img src="'.base_url().'img/firma/'.$imagen.'.png" border="0" width="90px" />';
        
        $e.="<table  cellpadding=\"2\" border=\"1\">
        <thead>
        
        <tr>
        <th colspan=\"15\" align=\"center\"><font size=\"+3\"><strong>PRECIOS VALIDADOS ARRIBA DEL COSTO BASE</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"1\" align=\"left\"><strong>Capturo</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Sec</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Clave</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Sustancia Activa</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Costo Base</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Prv Base</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Imp.Base</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Piezas</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Regalo</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Costo</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Importe</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Desc.</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Total</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Prv</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>Provedor</strong></th>
        </tr>
        </thead>
       <tbody>";
        
                            
                                
                                   $tcan=0;$timp=0;
                                $num=0;$tbase=0;$ttot=0;
                                $color1='blue';$color='black';
                                foreach ($a as $r) {
                                if($r['descu']>0){
                                    $descu=($r['costo']*$r['ped'])-(($r['costo']*$r['ped'])*($r['descu']/100));
                                    }else{
                                    $descu=($r['costo']*$r['ped']);}
                             $e.="     
                                        <tr>
                                        <td>".$r['id_userx']."</td>
                                        <td>".$r['sec']."</td>
                                        <td>".$r['clagob']."</td>
                                        <td>".$r['susa']."</td>
                                        <td>".number_format($r['costobase'],2)."</td>
                                        <td>".$r['prvbasex']."</td>
                                        <td style=\"text-align: right;\">".number_format($r['costobase']*$r['ped'],2)."</td>
                                        <td>".$r['ped']."</td>
                                        <td>".$r['regalo']."</td>
                                        <td>".number_format($r['costo'],2)."</td>
                                        <td>".number_format($r['costo']*$r['ped'],2)."</td>
                                        <td>".number_format(($r['costo']*$r['ped'])-$descu,2)."</td>
                                        <td>".number_format($descu,2)."</td>
                                        <td>".$r['prv']."</td>
                                        <td>".$r['prvx']."</td>
                                        </tr>";
                                        $tcan=$tcan+$r['ped'];
                                        $timp=$timp+$r['ped']*$r['costo'];
                                        $tbase=$tbase+$r['ped']*$r['costobase'];
                                        $ttot=$ttot+$descu;
                               $num=$num+1;
                                        }//$r['']
                              $e.="  
                             </tbody>
                             <tfoot>
                             <tr>
                             <td style=\"text-align: left;color: royalblue;\" colspan=\"14\">Productos $num</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($tcan,0)."</td>
                             </tr>
                             <tr>
                             <td colspan=\"15\" style=\"text-align:center;\">ATENTAMENTE</td>
                             </tr>
                             <tr>
                             <td colspan=\"15\" style=\"text-align:center;\">".$l1."</td>
                             </tr> 
                             <tr>
                             <td colspan=\"15\" style=\"text-align:center;\">".$nombre."</td>
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
$pdf->Output('pedido.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+