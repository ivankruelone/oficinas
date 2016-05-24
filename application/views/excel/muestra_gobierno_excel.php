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
            ->setCellValue('A'.$ini, 'Clave')
            ->setCellValue('B'.$ini, 'Nombre generico')
            ->setCellValue('C'.$ini, 'Forma farmaceutica')
            ->setCellValue('D'.$ini, 'Concentracion')
            ->setCellValue('E'.$ini, 'Presentacion')
            ->setCellValue('F'.$ini, 'Unidad de medida')
            ->setCellValue('G'.$ini, 'Envase')
            ->setCellValue('H'.$ini, 'Tipo')
            ->setCellValue('I'.$ini, 'Status')
            ->setCellValue('J'.$ini, 'Alta')
            ->setCellValue('K'.$ini, 'Baja')
            ->setCellValue('L'.$ini, 'Cambio')
;            

$num = 5;
foreach ($query->result() as $row)
{
			
//gobiernoStatus, gobiernoTipo, clave, nombreGenerico, formaFarmaceutica, concentracion, 
//presentacion, unidadMedida, envase, id, gobiernoAlta, gobiernoBaja, gobiernoCambio, 
//gobiernoTipoDerscripcion, gobiernoStatusDescripcion
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->clave)
            ->setCellValue('B'.$num, $row->nombreGenerico)
            ->setCellValue('C'.$num, $row->formaFarmaceutica)
            ->setCellValue('D'.$num, $row->concentracion)
            ->setCellValue('E'.$num, $row->presentacion)
            ->setCellValue('F'.$num, $row->unidadMedida)
            ->setCellValue('G'.$num, $row->envase)
            ->setCellValue('H'.$num, $row->gobiernoTipoDescripcion)
            ->setCellValue('I'.$num, $row->gobiernoStatusDescripcion)
            ->setCellValue('J'.$num, $row->gobiernoAlta)
            ->setCellValue('K'.$num, $row->gobiernoBaja)
            ->setCellValue('L'.$num, $row->gobiernoCambio)
;

            $num++;

}
        $num2 = $num - 1;



$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

$objPHPExcel->getActiveSheet()->getStyle('B5:F'.$num2)->getAlignment()->setWrapText(true);


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Catalogo de Gobierno');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="catalogo_gobierno_'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;