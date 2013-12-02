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
 $fec=date('Y-m-d H:i:s');
    $ss="select a.*,b.mes as mesx,c.razon as ciax from oficinas.inv_mes_suc a
    left join catalogo.mes b on b.num=a.mes
    left join catalogo.compa c on c.cia=a.cia
    where a.aaa=$aaa and a.mes=$mes and a.cia=$cia group by aaa,mes,cia";
    $qq=$this->db->query($ss);
    if($qq->num_rows()>0){
        $rr=$qq->row();
        $dia=$rr->dia;
        $mesx=$rr->mesx;
        $ciax=$rr->ciax;
        
        }
        
        $e="<table border=\"1\" cellpeading=\"3\">
                    <thead>
                                 <tr>
                                 <th colspan=\"11\">$ciax</th>
                                 </tr>
                                 
                                 <tr>
                                 <th colspan=\"2\"></th>
                                 <th colspan=\"2\" style=\"color:black;text-align: center\">INVENTARIO INICIAL</th>
                                 <th colspan=\"1\" style=\"color:black; text-align: center\">ENTRADAS</th>
                                 <th colspan=\"4\" style=\"color:black; text-align: center\">VENTA</th>
                                 <th colspan=\"2\" style=\"color:black; text-align: center\">INVENTARIO FINAL $dia DE $mesx DEL $aaa</th>
                                </tr>
                                
                            <tr>
                                     <th style=\"text-align: left\">Nid</th> 
                                     <th style=\"text-align: left\">Sucursal</th>
                                     <th style=\"color:black; text-align: right\">Piezas</th>
                                     <th style=\"color:black; text-align: right\">Importe</th>
                                     <th style=\"color:black; text-align: right\">Compras</th>
                                     <th style=\"color:black; text-align: right\">Recargas</th>
                                     <th style=\"color:black; text-align: right\">Credito</th>
                                     <th style=\"color:black; text-align: right\">contado</th>
                                     <th style=\"color:black; text-align: right\">Dias_vta</th>
                                     <th style=\"color:black; text-align: right\">Piezas</th>
                                     <th style=\"color:black; text-align: right\">Importe</th>
                             </tr>
                            </thead>
                            <tbody>";
                            
                                 $color='gray'; $color1='black'; $color2='blue'; $color3='green'; 
                                $num=0;$tinv=0;$tinv_impo=0;$tinvf=0;$tinvf_impo=0;$tfac_impo=0;$trec_impo=0;$tcon_impo=0;$tcre_impo=0;
                                
                                foreach ($a->result() as $r) {
                                
                             $e.="     
                                        <tr>
                                        <td>".$r->suc."</td>
                                        <td>".$r->nombre."</td>
                                        <td style=\"text-align: right;\">".number_format($r->ini_piezas,0)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->ini_importe,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->facturas,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->recarga,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->credito,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->contado,2)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->num_dias,0)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->fin_piezas,0)."</td>
                                        <td style=\"text-align: right;\">".number_format($r->fin_importe,2)."</td>
                                        </tr>";
                                        $tinv=$tinv+$r->ini_piezas;
                               $tinv_impo=$tinv_impo+$r->ini_importe;
                               $tfac_impo=$tfac_impo+$r->facturas;
                               $trec_impo=$trec_impo+$r->recarga;
                               $tcre_impo=$tcre_impo+$r->credito;
                               $tcon_impo=$tcon_impo+$r->contado;
                               $tinvf=$tinvf+$r->fin_piezas;
                               $tinvf_impo=$tinvf_impo+$r->fin_importe;
                                        $num=$num+1;
                                        }
                              $e.="  
                             </tbody>
                             <tfoot>
                             <tr>
                             <td style=\"text-align: left;color: royalblue;\" colspan=\"2\">Sucursales $num</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($tinv,0)."</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($tinv_impo,2)."</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($tfac_impo,2)."</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($trec_impo,2)."</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($tcre_impo,2)."</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($tcon_impo,2)."</td>
                             <td style=\"text-align: right;color: royalblue;\"></td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($tinvf,0)."</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($tinvf_impo,2)."</td>
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
$pdf->Output('Inventario.pdf', 'I');

//============================================================+
// END OF FILE                                                 
//============================================================+