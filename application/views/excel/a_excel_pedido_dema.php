<?php
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Create new PHPExcel object
$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
	die($cacheMethod . " caching method is not available" . EOL);
}
// Set document properties
$objPHPExcel->getProperties()->setCreator("LIDIA VELAZQUEZ")
							 ->setLastModifiedBy("LIDIA VELAZQUEZ")
							 ->setTitle("DESPLAZAMIENTO DE PRODUCTOS")
							 ->setSubject("DESPLAZAMIENTO DE PRODUCTOS")
							 ->setDescription("DESPLAZAMIENTO DE PRODUCTOS")
							 ->setKeywords("Pedido")
							 ->setCategory("Pedido");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('a1', date('Y-m-d H:s:i'));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'PEDIDO DE MERCANCIA');
            
// Add some data
$ini=2;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Codigo')
            ->setCellValue('B'.$ini, 'Descripcion')
            ->setCellValue('C'.$ini, 'Pedido')
            ->setCellValue('D'.$ini, 'Costo')
            ->setCellValue('E'.$ini, 'Importe')
            ->setCellValue('F'.$ini, 'Iva')
            ->setCellValue('G'.$ini, 'Total')
            ;

$num = 3;
$t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$t13=0;
foreach ($query->result() as $row)
{
    if($row->ped>0)
    {
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->codigo)
            ->setCellValue('B'.$num, $row->descri)
            ->setCellValue('C'.$num, $row->ped)
            ->setCellValue('D'.$num, $row->cos)
            ->setCellValue('E'.$num, $row->imp)
            ->setCellValue('F'.$num, $row->iva)
            ->setCellValue('G'.$num, $row->total)
            
;

            $num++;
$t1=$t1+$row->ped;
$t2=$t2+$row->imp;
$t3=$t3+$row->iva;
$t4=$t4+$row->total;
}}


        $num2 = $num - 1;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, '')
            ->setCellValue('B'.$num, '')
            ->setCellValue('C'.$num, $t1)
            ->setCellValue('D'.$num, '')
            ->setCellValue('E'.$num, $t2)
            ->setCellValue('F'.$num, $t3)
            ->setCellValue('G'.$num, $t4)
            ;

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('b')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('c')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('d')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('e')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('f')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('g')->setWidth(15);

$objPHPExcel->getActiveSheet()->getStyle('A1:g1')->getFont()->setBold(true)->setSize(2); //renegridas
$objPHPExcel->getActiveSheet()->getStyle('a2:g2')->getAlignment()->setIndent(0)
->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS)->setWrapText(true);//alinear justificado y centrado

$objPHPExcel->getActiveSheet()->getStyle('A2:g2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);//sombreda la celda 2 colores
$objPHPExcel->getActiveSheet()->getStyle('A2:g2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('a2:g'.$num)->getBorders()->setDiagonalDirection(PHPExcel_Style_Border::BORDER_DASHDOT);//tipo de boder y color de borde

$objPHPExcel->getActiveSheet()->getStyle('a3:a'.$num)->getNumberFormat()->setFormatCode('##0');//formato de numero

$objPHPExcel->getActiveSheet()->getStyle('d3:g'.$num)->getAlignment()->setIndent(0)//alinear datos 
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('c3:c'.$num)->getNumberFormat()->setFormatCode('#,#0');//formato de numero
$objPHPExcel->getActiveSheet()->getStyle('d3:g'.$num)->getNumberFormat()->setFormatCode('#,#0.00');//formato de numero


$objPHPExcel->getActiveSheet()->getStyle('a'.$num.':g'.$num)->getFont()->setBold(true);//renegridas



// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('DEMA');

$nom = "Pedido.xls";
// Echo memory peak usage


//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
//$objWriter->save($_SERVER['DOCUMENT_ROOT']."/oficinas/correos/".$nom);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=".$nom);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
