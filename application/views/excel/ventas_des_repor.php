<?php
error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("FENIX")
                             ->setLastModifiedBy("FENIX")
                             ->setTitle("FENIX")
                             ->setSubject("FENIX")
                             ->setDescription("FENIX")
                             ->setKeywords("FENIX")
                             ->setCategory("FENIX");

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
    die($cacheMethod . " caching method is not available" . EOL);
}

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'DETALLE DESCUENTOS APLICADOS EN SUCURSAL')->mergeCells('A1:F1')->getStyle()->getFont()->setBold(true);
            ;
 $objPHPExcel->getActiveSheet(0)->getStyle('A1:F1')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);









$ini=3;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'NID')
            ->setCellValue('B'.$ini, 'SUCURSAL')
            ->setCellValue('C'.$ini, 'AÑO')
            ->setCellValue('D'.$ini, 'MES')
            ->setCellValue('E'.$ini, 'TARJETA')
            ->setCellValue('F'.$ini, 'DESCUENTO')

            ;            

$num = 4;
foreach ($q->result() as $row)
{
            

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->suc)
            ->setCellValue('B'.$num, $row->nomb)
            ->setCellValue('C'.$num, $row->ano)
            ->setCellValue('D'.$num, $row->mes)
            ->setCellValue('E'.$num, $row->nombre)
            ->setCellValue('F'.$num, $row->des)
            ;

            $num++;

}
        $num2 = $num - 1;


$objPHPExcel->getActiveSheet()->getStyle('D5:D'.$num2)->getNumberFormat()
    ->setFormatCode('#0');

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('DESCUENTOS_'.$row->nomb);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="DETALLE DE DESCUENTOS APLICADOS EN SUCURSAL'.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;