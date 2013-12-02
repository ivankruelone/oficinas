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
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); 

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
$pdf->SetMargins(PDF_MARGIN_LEFT, 50, PDF_MARGIN_RIGHT); 
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
NINGUN PEDIDO VENCIADO.';
// ---------------------------------------------------------
$e='';
$f='';
$totfal=0;
     $e.="<table cellpadding=\"2\">
                             <thead>
                                 <tr>
                                     <th width=\"30\">Sec</th>
                                     <th width=\"85\">Codigo</th>
                                     <th width=\"85\">clagob</th>
                                     <th width=\"250\">Sustancia Activa</th>
                                     <th width=\"70\" align=\"right\">Cedis</th>
                                     <th width=\"70\" align=\"right\">Farmabod.</th>
                                     <th width=\"70\" align=\"right\">Metro</th>
                                     <th width=\"70\" align=\"right\">Bansefi</th>
                                     <th width=\"70\" align=\"right\">Piezas</th>
                                     <th width=\"70\" align=\"right\">Costo</th>
                                     <th width=\"70\" align=\"right\">Importe</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>";
                             
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=0;$final=0;$final1=0;$timpo=0;
                                foreach ($a as $r) {
                                $num=$num+1;$tot=0; $n=0;
                                $nombre=$r['nombre'];
                                $imagen=$r['imagen'];
                             $e.="     
                                        <tr>
                                        <td width=\"30\">".$r['sec']."</td>
                                        <td width=\"85\">".$r['codigo']."</td>
                                        <td width=\"85\">".$r['clagob']."</td>
                                        <td width=\"250\">".$r['susa']."</td>";
                                        $tot=0; $n=0; 
                                        if($r['costobase']<$r['cos']){$color='red';}else{$color='blue';}
                                        foreach($r['segundo'] as $seg){
                                        
                                        if($seg['almacen']=='alm'){$u1=$seg['cans'];}
                                        if($seg['almacen']=='fbo'){$u2=$seg['cans'];}
                                        if($seg['almacen']=='met'){$u3=$seg['cans'];}
                                        if($seg['almacen']=='ban'){$u4=$seg['cans'];}
                                        
                                        }
                                        $e.="
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($u1,0)."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($u2,0)."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($u3,0)."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($u4,0)."</td>
                                        ";
                                        $tu1=$tu1+$u1;
                                        $tu2=$tu2+$u2;
                                        $tu3=$tu3+$u3;
                                        $tu4=$tu4+$u4; 
                                          $u5=$u1+$u2+$u3+$u4;
                                          $impo=$seg['costo']*$u5;
                                          $u1=0;$u2=0;$u3=0;$u4=0;
                                          $e.="
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($u5,0)."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($seg['costo'],2)."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($impo,2)."</td>
                                        </tr>";
                                        $final1=$final1+$u5;$timpo=$timpo+$impo;
                                        }
                                        $l1='<img src="'.base_url().'img/firma/'.$imagen.'" border="0" width="90px" />';
                              $e.="  
                             </tbody>
                             <tfoot>
                             <tr>
                             <td style=\"text-align: left;color: royalblue;\" colspan=\"4\"  width=\"450\">TOTAL DE PRODUCTOS $num</td>
                             <td style=\"text-align: right;color: royalblue;\" width=\"70\">".number_format($tu1,0)."</td>
                             <td style=\"text-align: right;color: royalblue;\" width=\"70\">".number_format($tu2,0)."</td>
                             <td style=\"text-align: right;color: royalblue;\" width=\"70\">".number_format($tu3,0)."</td>
                             <td style=\"text-align: right;color: royalblue;\" width=\"70\">".number_format($tu4,0)."</td>
                             <td style=\"text-align: right;color: royalblue;\" width=\"70\">".number_format($final1,0)."</td>
                             <td></td>
                             <td style=\"text-align: right;color: royalblue;\" width=\"70\">".number_format($timpo,2)."</td>
                             </tr>
                             <table cellpadding=\"11\">
                             <tr>
                             <td colspan=\"11\" style=\"text-align:center;\">ATENTAMENTE</td>
                             </tr>
                             <tr>
                             <td colspan=\"11\" style=\"text-align:center;\">".$l1."</td>
                             </tr> 
                             <tr>
                             <td colspan=\"11\" style=\"text-align:center;\">".$nombre."</td>
                             </tr>
                             <tr>
                             <td colspan=\"11\" style=\"text-align:left;\">".$texto1."</td>
                             </tr> 
                             </table>
                               
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
$pdf->Output('orden_compra.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+