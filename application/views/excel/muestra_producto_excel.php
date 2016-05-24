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

//idProducto, ean, descripcion, sustancia, linea, sublinea, productoStatusDescripcion, secuencia, 
//clave, laboratorioProvisional, registro, precioMaximoPublico, precioFarmacia, iva, servicio, 
//antibiotico, descontinuado, productoAlta, productoBaja, productoCambio

$ini=4;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'ID Producto')
            ->setCellValue('B'.$ini, 'EAN')
            ->setCellValue('C'.$ini, 'Descripcion')
            ->setCellValue('D'.$ini, 'Sustancia activa')
            ->setCellValue('E'.$ini, 'Linea')
            ->setCellValue('F'.$ini, 'Sublinea')
            ->setCellValue('G'.$ini, 'Status')
            ->setCellValue('H'.$ini, 'Secuencia')
            ->setCellValue('I'.$ini, 'Clave')
            ->setCellValue('J'.$ini, 'Laboratorio')
            ->setCellValue('K'.$ini, 'registro')
            ->setCellValue('L'.$ini, 'Precio Maximo Publico')
            ->setCellValue('M'.$ini, 'Precio Farmacia')
            ->setCellValue('N'.$ini, 'IVA')
            ->setCellValue('O'.$ini, 'Servicio')
            ->setCellValue('P'.$ini, 'Antibiotico')
            ->setCellValue('Q'.$ini, 'Descontinuado')
            ->setCellValue('R'.$ini, 'Alta')
            ->setCellValue('S'.$ini, 'Baja')
            ->setCellValue('T'.$ini, 'Cambio')
;            

$num = 5;
foreach ($query->result() as $row)
{
			
//idProducto, ean, descripcion, sustancia, linea, sublinea, productoStatusDescripcion, secuencia, 
//clave, laboratorioProvisional, registro, precioMaximoPublico, precioFarmacia, iva, servicio, 
//antibiotico, descontinuado, productoAlta, productoBaja, productoCambio
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->idProducto)
            ->setCellValue('B'.$num, $row->ean)
            ->setCellValue('C'.$num, $row->descripcion)
            ->setCellValue('D'.$num, $row->sustancia)
            ->setCellValue('E'.$num, $row->linea)
            ->setCellValue('F'.$num, $row->sublinea)
            ->setCellValue('G'.$num, $row->productoStatusDescripcion)
            ->setCellValue('H'.$num, $row->secuencia)
            ->setCellValue('I'.$num, $row->clave)
            ->setCellValue('J'.$num, $row->laboratorioProvisional)
            ->setCellValue('K'.$num, $row->registro)
            ->setCellValue('L'.$num, $row->precioMaximoPublico)
            ->setCellValue('M'.$num, $row->precioFarmacia)
            ->setCellValue('N'.$num, $row->iva)
            ->setCellValue('O'.$num, $row->servicio)
            ->setCellValue('P'.$num, $row->antibiotico)
            ->setCellValue('Q'.$num, $row->descontinuado)
            ->setCellValue('R'.$num, $row->productoAlta)
            ->setCellValue('S'.$num, $row->productoBaja)
            ->setCellValue('T'.$num, $row->productoCambio)
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
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->getStyle('L5:M'.$num2)->getNumberFormat()
    ->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$objPHPExcel->getActiveSheet()->getStyle('B5:B'.$num2)->getNumberFormat()
    ->setFormatCode('#0');

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Catalogo de Productos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="catalogo_producto_'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;