<?php
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("Lidia Velazquez Alvarez")
							 ->setLastModifiedBy("Lidia Velazquez Alvarez")
							 ->setTitle("Ventas")
							 ->setSubject("Ventas")
							 ->setDescription("Ventas")
							 ->setKeywords("Ventas")
							 ->setCategory("Ventas");

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
	die($cacheMethod . " caching method is not available" . EOL);
}


$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'VENTAS ACUMULADAS SUCURSAL');
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A1:A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR);
            



$ini=4;

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', ' ');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Sucursales');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'Ticket');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', 'Vta.Contado');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', 'Vta.Credito');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A7', 'Vta.Servicio');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A8', 'Vta TOTAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A9', 'Venta SIN SERVICIO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A10', 'Prom. por Ticket');
            

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A13', 'VENTAS ACUMULADAS CORTES')
            ;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A14', '');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A15', 'Sucursales');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A16', 'Vta.Contado');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A17', 'Vta.Credito');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A18', 'Vta.Servicio');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A19', 'Vta TOTAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A20', 'Venta SIN SERVICIO');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A23', 'VENTAS ACUMULADAS FORMAS DE PAGO')
            ;
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A24', '');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A25', 'Sucursales');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A26', 'Pago con Moneda Nacional');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A27', 'Pago con Tarjeta');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A28', 'pago con vales');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A29', 'pago credito');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A30', 'Faltantes');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A31', 'Sobrante');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A32', 'DEPOSITO=Moneda Nacional - Faltantes + Sobrantes ');


$num = 3; 
foreach ($query->result() as $row)
{
 $num++;
 $dd=$row->d_num;			
if($dd==1){$var='b';}
if($dd==2){$var='c';}
if($dd==3){$var='d';}
if($dd==4){$var='e';}
if($dd==5){$var='f';}
if($dd==6){$var='g';}
if($dd==7){$var='h';}
if($dd==8){$var='i';}
if($dd==9){$var='j';}
if($dd==10){$var='k';}
if($dd==11){$var='l';}
if($dd==12){$var='m';}
if($dd==13){$var='n';}
if($dd==14){$var='o';}
if($dd==15){$var='p';}
if($dd==16){$var='q';}
if($dd==17){$var='r';}
if($dd==18){$var='s';}
if($dd==19){$var='t';}
if($dd==20){$var='u';}
if($dd==21){$var='v';}
if($dd==22){$var='w';}
if($dd==23){$var='x';}
if($dd==24){$var='y';}
if($dd==25){$var='z';}
if($dd==26){$var='aa';}
if($dd==27){$var='ab';}
if($dd==28){$var='ac';}
if($dd==29){$var='ad';}
if($dd==30){$var='ae';}
if($dd==31){$var='af';}

$x2=$row->fecha;
$x3=($row->num_suc);
$x4=($row->tic);
$x5=($row->con);
$x6=($row->cre);
$x7=($row->ser);
$x8=(($row->con+$row->cre+$row->ser));
$x9=($row->con+$row->cre);
$x10=((($row->con+$row->cre+$row->ser)/$row->tic));

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue($var.'2', $x2)
->setCellValue($var.'3', $x3)
->setCellValue($var.'4', $x4)
->setCellValue($var.'5', $x5)
->setCellValue($var.'6', $x6)
->setCellValue($var.'7', $x7)
->setCellValue($var.'8', $x8)
->setCellValue($var.'9', $x9)
->setCellValue($var.'10', $x10)


;
$conteo=$row->d_num;
}

            $num++;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$num = 13;
foreach ($q->result() as $r)
{
$num++;
$dd=$r->d_num;
if($dd==1){$var='b';}
if($dd==2){$var='c';}
if($dd==3){$var='d';}
if($dd==4){$var='e';}
if($dd==5){$var='f';}
if($dd==6){$var='g';}
if($dd==7){$var='h';}
if($dd==8){$var='i';}
if($dd==9){$var='j';}
if($dd==10){$var='k';}
if($dd==11){$var='l';}
if($dd==12){$var='m';}
if($dd==13){$var='n';}
if($dd==14){$var='o';}
if($dd==15){$var='p';}
if($dd==16){$var='q';}
if($dd==17){$var='r';}
if($dd==18){$var='s';}
if($dd==19){$var='t';}
if($dd==20){$var='u';}
if($dd==21){$var='v';}
if($dd==22){$var='w';}
if($dd==23){$var='x';}
if($dd==24){$var='y';}
if($dd==25){$var='z';}
if($dd==26){$var='aa';}
if($dd==27){$var='ab';}
if($dd==28){$var='ac';}
if($dd==29){$var='ad';}
if($dd==30){$var='ae';}
if($dd==31){$var='af';}

$x14=$r->fechacorte;
$x15=($r->num_suc);
$x16=(($r->pesos+$r->tar+$r->val+$r->fal)-$r->recarga);
$x17=($r->credito);
$x18=($r->recarga);
$x19=($r->pesos+$r->tar+$r->val+$r->fal+$r->credito);
$x20=($r->pesos+$r->tar+$r->val+$r->fal+$r->credito-$r->recarga);


$x24=$r->fechacorte;
$x25=($r->num_suc);
$x26=($r->pesos);
$x27=($r->tar);
$x28=($r->val);
$x29=($r->credito);
$x30=($r->fal);
$x31=($r->sob);
$x32=($r->pesos-$r->fal+$r->sob);

$objPHPExcel->setActiveSheetIndex(0)
->setCellValue($var.'14', $x14)
->setCellValue($var.'15', $x15)
->setCellValue($var.'16', $x16)
->setCellValue($var.'17', $x17)
->setCellValue($var.'18', $x18)
->setCellValue($var.'19', $x19)
->setCellValue($var.'20', $x20)



->setCellValue($var.'24', $x24)
->setCellValue($var.'25', $x25)
->setCellValue($var.'26', $x26)
->setCellValue($var.'27', $x27)
->setCellValue($var.'28', $x28)
->setCellValue($var.'29', $x29)
->setCellValue($var.'30', $x30)
->setCellValue($var.'31', $x31)
->setCellValue($var.'32', $x32)
;

}

            $num++;



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->getActiveSheet()->getStyle('A1:A35')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A2:'.$var.'2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
$objPHPExcel->getActiveSheet()->getStyle('A14:'.$var.'14')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
$objPHPExcel->getActiveSheet()->getStyle('A24:'.$var.'24')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);

$objPHPExcel->getActiveSheet()->getStyle('A1:'.$var.'2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A13:'.$var.'14')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A24:'.$var.'25')->getFont()->setBold(true);


$objPHPExcel->getActiveSheet()->getStyle('B3:'.$var.'10')->getAlignment()->setIndent(0)
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('B15:'.$var.'20')->getAlignment()->setIndent(0)
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('B24:'.$var.'32')->getAlignment()->setIndent(0)
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


$objPHPExcel->getActiveSheet()->getStyle('B3:'.$var.'4')->getNumberFormat()->setFormatCode('#,#0');
$objPHPExcel->getActiveSheet()->getStyle('B15:'.$var.'15')->getNumberFormat()->setFormatCode('#,#0');
$objPHPExcel->getActiveSheet()->getStyle('B25:'.$var.'25')->getNumberFormat()->setFormatCode('#,#0');

$objPHPExcel->getActiveSheet()->getStyle('B5:'.$var.'10')->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet()->getStyle('B16:'.$var.'20')->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet()->getStyle('B26:'.$var.'32')->getNumberFormat()->setFormatCode('#,#00.00');

$objPHPExcel->getActiveSheet()->getStyle('a2:'.$var.'10')->getBorders()->setDiagonalDirection(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('a14:'.$var.'20')->getBorders()->setDiagonalDirection(PHPExcel_Style_Border::BORDER_THIN);
$objPHPExcel->getActiveSheet()->getStyle('a24:'.$var.'32')->getBorders()->setDiagonalDirection(PHPExcel_Style_Border::BORDER_THIN);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);





for($i=0; $i<$conteo; $i++)
   {
$dd=$i;
if($dd==1){$var='b';}
if($dd==2){$var='c';}
if($dd==3){$var='d';}
if($dd==4){$var='e';}
if($dd==5){$var='f';}
if($dd==6){$var='g';}
if($dd==7){$var='h';}
if($dd==8){$var='i';}
if($dd==9){$var='j';}
if($dd==10){$var='k';}
if($dd==11){$var='l';}
if($dd==12){$var='m';}
if($dd==13){$var='n';}
if($dd==14){$var='o';}
if($dd==15){$var='p';}
if($dd==16){$var='q';}
if($dd==17){$var='r';}
if($dd==18){$var='s';}
if($dd==19){$var='t';}
if($dd==20){$var='u';}
if($dd==21){$var='v';}
if($dd==22){$var='w';}
if($dd==23){$var='x';}
if($dd==24){$var='y';}
if($dd==25){$var='z';}
if($dd==26){$var='aa';}
if($dd==27){$var='ab';}
if($dd==28){$var='ac';}
if($dd==29){$var='ad';}
if($dd==30){$var='ae';}
if($dd==31){$var='af';} 
$objPHPExcel->getActiveSheet()->getColumnDimension($var)->setAutoSize(true);
    
   }
    

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Ventas');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
   

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
$objWriter->save($_SERVER['DOCUMENT_ROOT']."/oficinas/correos/".$nom);
//exit;



