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

// ---------------------------------------------------------
$texto1='Le pedimos la caducidad minima de los productos a 12 meses.
Favor de incluir el numero de pedido en la factura.<br />
LA VIGENCIA DE ES TE PEDIDOS ES DE 10 DIAS NATURALES; APARTIR DE LA FECHA GENERADA. NO SE RECIBIRA
NINGUN PEDIDO VENCIADO.';
// ---------------------------------------------------------// ---------------------------------------------------------
$e='';
$f='';
     $fec=date('Y-m-d H:i:s');
    $s="select a.*,b.nombre as sucx,    
    d.id_firma,e.completo
    from almacen.salidas_ped a 
    left join catalogo.sucursal b on b.suc=a.suc
    left join compras.usuarios d on d.id=a.id_user
    left join catalogo.cat_empleado e on e.nomina=d.responsable
    where a.id=$id";
    $q=$this->db->query($s);
    if($q->num_rows()>0){
        $r=$q->row();
        $nombre=$r->completo;
        $imagen=$r->id_firma;
        $l1='<img src="'.base_url().'img/firma/'.$imagen.'.png" border="0" width="90px" />';
        
        $e.="<table  cellpadding=\"2\" border=\"1\">
        <thead>
        
        <tr>
        <th colspan=\"11\" align=\"center\"><font size=\"+3\"><strong>PEDIDO DE MERCANCIA NO VALIDO PARA FARMACIA</strong></font></th>
        </tr>
         <tr>
        <th colspan=\"11\" align=\"left\"><font size=\"+1\"><strong>FOLIO PARA EL ALMACEN $r->folio</strong></font></th>
        </tr>
       
        <tr>
        <th colspan=\"11\" align=\"left\"><font size=\"+1\"><strong>$r->suc $r->sucx</strong></font></th>
        </tr>
        <tr>
        <th colspan=\"1\" align=\"left\"><strong>CLAGOB</strong></th>
        <th colspan=\"1\" align=\"left\"><strong>CODIGO</strong></th>
        <th colspan=\"4\" align=\"left\"><strong>SUSTANCIA ACTIVA</strong></th>
        <th colspan=\"4\" align=\"left\"><strong>DESCRIPCION</strong></th>
        <th colspan=\"1\" align=\"right\"><strong>PIEZAS</strong></th>
        </tr>
        </thead>
       <tbody>";
       }
       
                            
                                 $color='gray'; $color1='black'; $color2='blue'; $color3='green'; 
                                $num=0;$t1=0;$t2=0;
                                
                                foreach ($a->result() as $r) {
                                
                             $e.="     
                                        <tr>
                                        <td>".$r->clave."</td>
                                        <td>".$r->codigo."</td>
                                        <td style=\"text-align: left;\" colspan=\"4\">".$r->susa."</td>
                                        <td style=\"text-align: left;\" colspan=\"4\">".$r->descri."</td>
                                        <td style=\"text-align: right;\">".number_format($r->ped,0)."</td>
                                        </tr>";
                               $t1=$t1+$r->ped;
                               $t2=$t2+($r->costo*$r->ped);
                               $num=$num+1;
                                        }
                              $e.="  
                             </tbody>
                             <tfoot>
                             <tr>
                             <td style=\"text-align: left;color: royalblue;\" colspan=\"10\">Productos $num</td>
                             <td style=\"text-align: right;color: royalblue;\">".number_format($t1,0)."</td>
                             </tr>
                             <tr>
                             <td colspan=\"11\" style=\"text-align:center;\">ATENTAMENTE</td>
                             </tr>
                             <tr>
                             <td colspan=\"11\" style=\"text-align:center;\">".$l1."</td>
                             </tr> 
                             <tr>
                             <td colspan=\"11\" style=\"text-align:center;\">".$nombre."</td>
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