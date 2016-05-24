<?php
ini_set('memory_limit', '-1');
error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("IVAN ZUÑIGA PEREZ")
							 ->setLastModifiedBy("IVAN ZUÑIGA PEREZ")
							 ->setTitle("Ultimos Costos")
							 ->setSubject("Ultimos Costos")
							 ->setDescription("Ultimos Costos")
							 ->setKeywords("Ultimos Costos")
							 ->setCategory("Ultimos Costos");

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
	die($cacheMethod . " caching method is not available" . EOL);
}


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', 'Catalogo Ultimos Costos')
            ;

//idProducto, ean, descripcion, sustancia, linea, sublinea, productoStatusDescripcion, secuencia, 
//clave, laboratorioProvisional, registro, precioMaximoPublico, precioFarmacia, iva, servicio, 
//antibiotico, descontinuado, productoAlta, productoBaja, productoCambio

$ini=4;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Secuencia')
            ->setCellValue('B'.$ini, 'N Prov')
            ->setCellValue('C'.$ini, 'Razon Social')
            ->setCellValue('D'.$ini, 'Codigo')
            ->setCellValue('E'.$ini, 'Sustancia Activa')
            ->setCellValue('F'.$ini, 'Clave')
            ->setCellValue('G'.$ini, 'Costos')
            ->setCellValue('H'.$ini, 'Fecha')
;            

$num = 5;
foreach ($query->result() as $row)
{
			
//idProducto, ean, descripcion, sustancia, linea, sublinea, productoStatusDescripcion, secuencia, 
//clave, laboratorioProvisional, registro, precioMaximoPublico, precioFarmacia, iva, servicio, 
//antibiotico, descontinuado, productoAlta, productoBaja, productoCambio
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->sec)
            ->setCellValue('B'.$num, $row->prv)
            ->setCellValue('C'.$num, $row->razo)
            ->setCellValue('D'.$num, $row->codigo)
            ->setCellValue('E'.$num, $row->sustanciaActiva)
            ->setCellValue('F'.$num, $row->clave)
            ->setCellValue('G'.$num, $row->costo)
            ->setCellValue('H'.$num, $row->fechai)
            
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

$objPHPExcel->getActiveSheet()->getStyle('G5:M'.$num2)->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$objPHPExcel->getActiveSheet()->getStyle('D5:D'.$num)->getNumberFormat()
    ->setFormatCode('#0');

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Catalogo de Ultimos Costos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="catalogo_ultimosCostos_'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;