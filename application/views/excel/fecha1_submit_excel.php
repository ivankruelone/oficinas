<?php
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("IVAN ZUÑIGA PEREZ")
							 ->setLastModifiedBy("IVAN ZUÑIGA PEREZ")
							 ->setTitle("Inventario")
							 ->setSubject("Inventario")
							 ->setDescription("Inventario")
							 ->setKeywords("Inventario")
							 ->setCategory("Inventario");

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
	die($cacheMethod . " caching method is not available" . EOL);
}


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', 'Ventas Sucursal: ' . $suc . ' de fecha: ' .$fecha1 . ' al ' . $fecha2)
            ;



$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Sucursal')
            ->setCellValue('B'.$ini, 'Fecha')
            ->setCellValue('C'.$ini, 'Ticket')
            ->setCellValue('D'.$ini, 'Secuencia')
            ->setCellValue('E'.$ini, 'EAN')
            ->setCellValue('F'.$ini, 'Descripcion')
            ->setCellValue('G'.$ini, 'Cantidad')
            ->setCellValue('H'.$ini, 'Linea')
            ->setCellValue('I'.$ini, 'Importe')
            ->setCellValue('J'.$ini, 'Iva')
;            

$num = 5;
foreach ($query->result() as $row)
{
			

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->suc)
            ->setCellValue('B'.$num, $row->fecha)
            ->setCellValue('C'.$num, $row->tiket)
            ->setCellValue('D'.$num, $row->sec)
            ->setCellValue('E'.$num, $row->codigo)
            ->setCellValue('F'.$num, $row->descri)
            ->setCellValue('G'.$num, $row->can)
            ->setCellValue('H'.$num, $row->lin.'-'.$row->sublin.' '.$row->descrip)
            ->setCellValue('I'.$num, $row->importe)
            ->setCellValue('J'.$num, $row->iva)
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
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Ventas');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ventas_por_cliente_'.$fecha1.'_'.$fecha2.'_'.$suc.'_'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;