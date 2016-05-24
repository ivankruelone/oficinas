<?php
global $cabezota;

$cabezota='<p><strong>'.$cabeza.'</strong></p>';;

require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');


// Extend the TCPDF class to create custom Header and Footer 
class MYPDF extends TCPDF { 
   	
    
    public function Header() { 


/////////////////////////////////////////////////////////////////

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

$detalle='';
// ---------------------------------------------------------// ---------------------------------------------------------
foreach($q->result()as $r)
{
    $detalle.="<table border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
    <thead>
       <tr bgcolor=\"#C2C1C1\">
       <th colspan=\"8\" align=\"center\" width=\"920\"><strong><font size=\"+2\">$r->nombre $r->titulo2</font></strong></th>
       </tr>
       <tr bgcolor=\"#C2C1C1\">
        <th colspan=\"1\" align=\"center\" width=\"250\"><strong>ARRENDADOR</strong></th>
        <th colspan=\"1\" align=\"center\" width=\"70\"><strong>RENTA</strong></th>
        <th colspan=\"1\" align=\"center\" width=\"70\"><strong>IVA</strong></th>
        <th colspan=\"1\" align=\"center\" width=\"70\"><strong>RETENCION</strong></th>
        <th colspan=\"1\" align=\"center\" width=\"70\"><strong>IVA RETENIDO</strong></th>
        <th colspan=\"1\" align=\"center\" width=\"70\"><strong>TOTAL MN</strong></th>
        <th colspan=\"1\" align=\"center\" width=\"70\"><strong>TOTAL USD</strong></th>
        <th colspan=\"1\" align=\"center\" width=\"250\"><strong>OBSERVACION</strong></th>
        </tr>
        </thead>
        <tboddy>";
    
$s1="select b.suc,c.nombre as sucx,b.nom,
(imp)as imp,

(imp*b.iva)as ivaf,(imp*(isr/100))as isrf,(imp*(iva_isr/100))as iva_isrf,
(case when pago='MN'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalmn,
(case when pago='USD'
then
case
when b.auxi=7004  then imp+(imp*b.iva)
when b.auxi=7003  then imp+(imp*b.iva)-(imp*(isr/100))-(imp*(iva_isr/100))-(imp*(imp_cedular/100))+redondeo
end
else
0
end)
 as totalusd,observacion
from juridico.rentas_c a 
join juridico.rentas_d b on b.id_renta=a.id_renta 
join catalogo.sucursal c on c.suc=b.suc
where aaa=$r->aaa and mes=$r->mes and grupo=$r->grupo and a.tipo='$r->tipo'";
$q1=$this->db->query($s1);
$tmn=0;$tusd=0;
foreach($q1->result()as $r1)
    {     
     $detalle.="
                                        <tr>
                                        <td style=\"text-align: left;\" width=\"250\">".$r1->nom."<br />".$r1->suc."-".$r1->sucx."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($r1->imp,2)."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($r1->ivaf,2)."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($r1->isrf,2)."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($r1->iva_isrf,2)."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($r1->totalmn,2)."</td>
                                        <td style=\"text-align: right;\" width=\"70\">".number_format($r1->totalusd,2)."</td>
                                        <td style=\"text-align: left;\" width=\"250\">".$r1->observacion."</td>
                                        </tr>
     ";
     $tmn=$tmn+$r1->totalmn;
     $tusd=$tusd+$r1->totalusd;
    }
    $detalle.="</tboddy>
    <tfoot>
    <tr bgcolor=\"#E8E7E7\">
    <td colspan=\"5\" style=\"text-align: right;\" width=\"530\">TOTAL</td>
    <td style=\"text-align: right;\" width=\"70\">".number_format($tmn,2)."</td>
    <td style=\"text-align: right;\" width=\"70\">".number_format($tusd,2)."</td>
    <td style=\"text-align: right;\" width=\"250\"></td>
    </tr>
    </tfoot>
    </table>";

$pdf->SetFont('helvetica', '', 8	);
//die();
$pdf->AddPage();
$tbl = <<<EOD
$detalle
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
$detalle='';
}
// ---------------------------------------------------------// ---------------------------------------------------------

                            
// ---------------------------------------------------------
// ---------------------------------------------------------  

// ---------------------------------------------------------
// ---------------------------------------------------------  
// set font


// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------



//Close and output PDF document
$pdf->Output('Rentas.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+