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
            ->setCellValue('C1', 'Catalogo Producto - Proveedor')
            ;



$ini=4;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Secuencia')
            ->setCellValue('B'.$ini, 'Sustancia Activa')
            ->setCellValue('C'.$ini, 'Venta DRD')
            ->setCellValue('D'.$ini, 'Venta GEN')
            ->setCellValue('E'.$ini, 'Venta FEN')
            ->setCellValue('F'.$ini, 'Venta FBO')
            ->setCellValue('G'.$ini, 'Status')
            ->setCellValue('H'.$ini, 'Alta')
            ->setCellValue('I'.$ini, 'Baja')
            ->setCellValue('J'.$ini, 'Cambio')
;            

$num = 5;
foreach ($query->result() as $row)
{
			
//secuencia, sustanciaActiva, ventaDrd, ventaGen, ventaFen, ventaFbo, secuenciaStatus, id, 
//secuenciaAlta, secuenciaBaja, secuenciaCambio
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->secuencia)
            ->setCellValue('B'.$num, $row->sustanciaActiva)
            ->setCellValue('C'.$num, $row->ventaDrd)
            ->setCellValue('D'.$num, $row->ventaGen)
            ->setCellValue('E'.$num, $row->ventaFen)
            ->setCellValue('F'.$num, $row->ventaFbo)
            ->setCellValue('G'.$num, $row->secuenciaStatusDescripcion)
            ->setCellValue('H'.$num, $row->secuenciaAlta)
            ->setCellValue('I'.$num, $row->secuenciaBaja)
            ->setCellValue('J'.$num, $row->secuenciaCambio)
;

            $num++;

}
        $num2 = $num - 1;


$objPHPExcel->getActiveSheet()->getStyle('C5:F'.$num2)->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Secuencia');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="catalogo_secuencia_'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;