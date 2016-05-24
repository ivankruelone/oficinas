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
            ->setCellValue('C1', 'Catalogo Sucursal - Sucursal')
            ;



$ini=4;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Nid')
            ->setCellValue('B'.$ini, 'Farmacia')
            ->setCellValue('C'.$ini, 'Nombre')
            ->setCellValue('D'.$ini, 'Domicilio')
            ->setCellValue('E'.$ini, 'Colonia')
            ->setCellValue('F'.$ini, 'Cp')
            ->setCellValue('G'.$ini, 'Poblacion')
            ->setCellValue('H'.$ini, 'Estado')
            ->setCellValue('I'.$ini, 'Brick')
            ->setCellValue('J'.$ini, 'Clasifica')
;            

$num = 5;
foreach ($query->result() as $row)
{
			
//secuencia, sustanciaActiva, ventaDrd, ventaGen, ventaFen, ventaFbo, secuenciaStatus, id, 
//secuenciaAlta, secuenciaBaja, secuenciaCambio
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->suc)
            ->setCellValue('B'.$num, $row->farmacia)
            ->setCellValue('C'.$num, $row->nombre)
            ->setCellValue('D'.$num, $row->dire)
            ->setCellValue('E'.$num, $row->col)
            ->setCellValue('F'.$num, $row->cp)
            ->setCellValue('G'.$num, $row->pobla)
            ->setCellValue('H'.$num, $row->estado)
            ->setCellValue('I'.$num, $row->brick1300)
            ->setCellValue('J'.$num, $row->clasificacion)
           
;

            $num++;

}
        $num2 = $num - 1;




    

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
$objPHPExcel->getActiveSheet()->setTitle('Sucursal');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="catalogo_sucursal_'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;