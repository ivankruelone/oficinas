<?php
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
            ->setCellValue('A'.$ini, 'IDProducto')
            ->setCellValue('B'.$ini, 'EAN')
            ->setCellValue('C'.$ini, 'Descripcion')
            ->setCellValue('D'.$ini, 'Sustancia')
            ->setCellValue('E'.$ini, 'Laboratorio')
            ->setCellValue('F'.$ini, 'Secuencia')
            ->setCellValue('G'.$ini, 'Clave')
            ->setCellValue('H'.$ini, 'Linea')
            ->setCellValue('I'.$ini, 'Sublinea')
            ->setCellValue('J'.$ini, 'Max. Publico')
            ->setCellValue('K'.$ini, 'Proveedor')
            ->setCellValue('L'.$ini, 'Max. Publico Prv')
            ->setCellValue('M'.$ini, 'Precio Farmacia')
            ->setCellValue('N'.$ini, 'Costo Privado')
            ->setCellValue('O'.$ini, 'Costo Gobierno')
;            

$num = 5;
foreach ($query->result() as $row)
{
			

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->idProducto)
            ->setCellValue('B'.$num, $row->ean)
            ->setCellValue('C'.$num, $row->descripcion)
            ->setCellValue('D'.$num, $row->sustancia)
            ->setCellValue('E'.$num, $row->laboratorioProvisional)
            ->setCellValue('F'.$num, $row->secuencia)
            ->setCellValue('G'.$num, $row->clave)
            ->setCellValue('H'.$num, $row->linea)
            ->setCellValue('I'.$num, $row->sublinea)
            ->setCellValue('J'.$num, $row->precioMaximoPublico)
            ->setCellValue('K'.$num, $row->razonSocial)
            ->setCellValue('L'.$num, $row->precioMaximoPublicoProveedor)
            ->setCellValue('M'.$num, $row->precioFarmacia)
            ->setCellValue('N'.$num, $row->costoPrivado)
            ->setCellValue('O'.$num, $row->costoGobierno)
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
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Producto - Proveedor');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="catalogo_producto_proveedor_'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;