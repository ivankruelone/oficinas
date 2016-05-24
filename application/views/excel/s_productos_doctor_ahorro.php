<?php
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("LIDIA VELAZQUEZ ALVAREZ")
							 ->setLastModifiedBy("LIDIA VELAZQUEZ ALVAREZ")
							 ->setTitle("Consentrado de productos")
							 ->setSubject("Consentrado de productos")
							 ->setDescription("Consentrado de productos")
							 ->setKeywords("Consentrado de productos")
							 ->setCategory("Consentrado de productos");

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
	die($cacheMethod . " caching method is not available" . EOL);
}


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', 'CONCENTRADO DE PRODUCTOS DOCTOR AHORRO')
            ;



$ini=2;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'CLASIF')
            ->setCellValue('B'.$ini, 'SEC')
            ->setCellValue('C'.$ini, 'SUSTANCIA ACTIVA')
            ->setCellValue('D'.$ini, 'NECESIDAD DEL ALMACEN EN PIEZAS')
            ->setCellValue('E'.$ini, 'INV ALMACEN ')
            ->setCellValue('F'.$ini, 'DEMANDA DIARIA DEL PRODUCTO EN CEDIS')
            ->setCellValue('G'.$ini, 'ENTRADAS ALMACEN ')
            ->setCellValue('H'.$ini, 'DIAS DE INVENTARIO ALMACEN')
            ->setCellValue('I'.$ini, 'TRANSITO POR COMPRA')
            ->setCellValue('J'.$ini, 'NECESIDAD DE FARMACIAS EN PIEZAS')
            ->setCellValue('K'.$ini, 'INV. EN FARMACIAS')
            ->setCellValue('L'.$ini, 'DEMANDA DIARIA DEL PRODUCTO EN FARMACIA')
            ->setCellValue('M'.$ini, 'DIAS DE INV EN FARMACIA')
            ->setCellValue('N'.$ini, 'TRANSITO DE ALMACEN A FARMACIA')
            ->setCellValue('O'.$ini, 'VENTA EN PIEZAS POR PRODUCTO')
            ->setCellValue('P'.$ini, 'FALTANTE DE ALMACEN')
            ->setCellValue('Q'.$ini, 'FALTANTE EN FARMACIA')
            ->setCellValue('R'.$ini, 'SUCURSALES SIN INVENTARIO NO TOMADOS COMO CEROS')
            ;

$num = 3;
$t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$t13=0;

foreach ($query->result() as $row)
{
		
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->tipo)
            ->setCellValue('B'.$num, $row->sec)
            ->setCellValue('C'.$num, $row->susa)
            ->setCellValue('D'.$num, $row->necesidad_cedis)
            ->setCellValue('E'.$num, $row->inv_cedis)
            ->setCellValue('F'.$num, $row->demanda_diaria_cedis)
            ->setCellValue('G'.$num, $row->entrada_cedis)
            ->setCellValue('H'.$num, $row->dias_inv_cedis)
            ->setCellValue('I'.$num, $row->transito_compra)
            ->setCellValue('J'.$num, $row->demanda_farmacias)
            ->setCellValue('K'.$num, $row->inv_farmacia)
            ->setCellValue('L'.$num, $row->demanda_diaria_farma)
            ->setCellValue('M'.$num, $row->dias_inv_farma)
            ->setCellValue('N'.$num, $row->transito_cedis_suc)
            ->setCellValue('O'.$num, $row->venta_diaria)
            ->setCellValue('P'.$num, $row->ceros_cedis)
            ->setCellValue('Q'.$num, $row->ceros_farma)
            ->setCellValue('R'.$num, $row->sin_inv)
;

            $num++;
$t1=$t1+$row->necesidad_cedis;
$t2=$t2+$row->inv_cedis;
$t3=$t3+$row->demanda_diaria_cedis;
$t4=$t4+$row->entrada_cedis;
$t5=$t5+$row->dias_inv_cedis;
$t6=$t6+$row->transito_compra;
$t7=$t7+$row->demanda_farmacias;
$t8=$t8+$row->inv_farmacia;
$t9=$t9+$row->demanda_diaria_farma;
$t10=$t10+$row->dias_inv_farma;
$t11=$t11+$row->transito_cedis_suc;
$t12=$t12+$row->venta_diaria;
$t13=$t13+$row->ceros_cedis;

}
        $num2 = $num - 1;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, '')
            ->setCellValue('B'.$num, '')
            ->setCellValue('C'.$num, 'TOTAL DE PRODUCTOS '.($num2-2))
            ->setCellValue('D'.$num, $t1)
            ->setCellValue('E'.$num, $t2)
            ->setCellValue('F'.$num, $t3)
            ->setCellValue('G'.$num, $t4)
            ->setCellValue('H'.$num, $t5)
            ->setCellValue('I'.$num, $t6)
            ->setCellValue('J'.$num, $t7)
            ->setCellValue('K'.$num, $t8)
            ->setCellValue('L'.$num, $t9)
            ->setCellValue('M'.$num, $t10)
            ->setCellValue('N'.$num, $t11)
            ->setCellValue('O'.$num, $t12)
            ->setCellValue('P'.$num, $t13)
            ->setCellValue('Q'.$num, '')
            ->setCellValue('R'.$num, '')
            ;



$objPHPExcel->getActiveSheet()->getStyle('A1:R2')->getFont()->setBold(true); //renegridas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
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



// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('CONCENTRADO DE PRODUCTOS');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);



 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
 $objWriter->save($_SERVER['DOCUMENT_ROOT']."/oficinas/correos/".$nom);
//exit;