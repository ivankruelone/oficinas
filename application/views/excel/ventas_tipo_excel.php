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
							 ->setTitle("Ventas")
							 ->setSubject("Ventas")
							 ->setDescription("Ventas")
							 ->setKeywords("Ventas")
							 ->setCategory("Ventas");

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
	die($cacheMethod . " caching method is not available" . EOL);
}


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E1', 'Ventas por Imagen del dia: ' .$fecha. ' al dia '.$fecha2)
            ;



$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Sucursal')
            ->setCellValue('B'.$ini, 'Nombre')
            ->setCellValue('C'.$ini, 'Secuencia')
            ->setCellValue('D'.$ini, 'EAN')
            ->setCellValue('E'.$ini, 'Descripcion')
            ->setCellValue('F'.$ini, 'Sustancia')
            ->setCellValue('G'.$ini, 'Proveedor')
            ->setCellValue('H'.$ini, 'Cantidad')
            ->setCellValue('I'.$ini, 'Costo')
            ->setCellValue('J'.$ini, 'Venta')
            ->setCellValue('K'.$ini, 'Importe')
;            

$num = 5;
foreach ($query->result() as $row)
{
			
//suc, nombre, sec, codigo, descri, susa1, prvx, can, costo, vta, importe
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->suc)
            ->setCellValue('B'.$num, $row->nombre)
            ->setCellValue('C'.$num, $row->sec)
            ->setCellValue('D'.$num, $row->codigo)
            ->setCellValue('E'.$num, $row->descri)
            ->setCellValue('F'.$num, $row->susa1)
            ->setCellValue('G'.$num, $row->prvx)
            ->setCellValue('H'.$num, $row->can)
            ->setCellValue('I'.$num, $row->costo)
            ->setCellValue('J'.$num, $row->vta)
            ->setCellValue('K'.$num, $row->importe)
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
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Ventas');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ventas_por_imagen_'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;