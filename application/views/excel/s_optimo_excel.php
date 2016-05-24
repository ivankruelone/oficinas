<?php
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Create new PHPExcel object
$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
	die($cacheMethod . " caching method is not available" . EOL);
}
// Set document properties
$objPHPExcel->getProperties()->setCreator("LIDIA VELAZQUEZ")
							 ->setLastModifiedBy("LIDIA VELAZQUEZ")
							 ->setTitle("OPTIMOS DE SUCURSAL")
							 ->setSubject("OPTIMOS DE SUCURSAL")
							 ->setDescription("OPTIMOS DE SUCURSAL")
							 ->setKeywords("OPTIMOS DE SUCURSAL")
							 ->setCategory("OPTIMOS DE SUCURSAL");

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'OPTIMOS DE SUCURSAL')->mergeCells('A1:V1')->getStyle()->getFont()->setBold(true);
            ;
$objPHPExcel->getActiveSheet(0)->getStyle('A1:U2')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
// Add some data
$ini=2;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Año')
            ->setCellValue('B'.$ini, 'Nid')
            ->setCellValue('C'.$ini, 'Sucursal')
            ->setCellValue('D'.$ini, 'Sec')
            ->setCellValue('E'.$ini, 'Sustancia Activa')
            ->setCellValue('F'.$ini, 'Optimo')
            ->setCellValue('G'.$ini, 'Calculado')
            ->setCellValue('H'.$ini, 'Ene')
            ->setCellValue('I'.$ini, 'Feb')
            ->setCellValue('J'.$ini, 'Mar')
            ->setCellValue('K'.$ini, 'Abr')
            ->setCellValue('L'.$ini, 'May')
            ->setCellValue('M'.$ini, 'Jun')
            ->setCellValue('N'.$ini, 'Jul')
            ->setCellValue('O'.$ini, 'Ago')
            ->setCellValue('P'.$ini, 'Sep')
            ->setCellValue('Q'.$ini, 'Oct')
            ->setCellValue('R'.$ini, 'Nov')
            ->setCellValue('S'.$ini, 'Dic')
            ->setCellValue('T'.$ini, 'Inv')
            ->setCellValue('U'.$ini, '$ Venta')
            ->setCellValue('V'.$ini, 'Clasificacion')
            ;

$num = 3;
$t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$t13=0;
foreach ($query->result() as $row)
{
//aaa, suc, nombre, codigo, descripcion, 
//venta1, venta2, venta3, venta4, venta5, venta6, venta7, venta8, venta9, venta10, venta11, venta12		
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->aaa)
            ->setCellValue('B'.$num, $row->suc)
            ->setCellValue('C'.$num, $row->sucx)
            ->setCellValue('D'.$num, $row->sec)
            ->setCellValue('E'.$num, $row->susa)
            ->setCellValue('F'.$num, $row->final)
            ->setCellValue('G'.$num, $row->correcto)
            ->setCellValue('H'.$num, $row->venta1)
            ->setCellValue('I'.$num, $row->venta2)
            ->setCellValue('J'.$num, $row->venta3)
            ->setCellValue('K'.$num, $row->venta4)
            ->setCellValue('L'.$num, $row->venta5)
            ->setCellValue('M'.$num, $row->venta6)
            ->setCellValue('N'.$num, $row->venta7)
            ->setCellValue('O'.$num, $row->venta8)
            ->setCellValue('P'.$num, $row->venta9)
            ->setCellValue('Q'.$num, $row->venta10)
            ->setCellValue('R'.$num, $row->venta11)
            ->setCellValue('S'.$num, $row->venta12)
            ->setCellValue('T'.$num, $row->inv)
            ->setCellValue('U'.$num, $row->venta)
            ->setCellValue('V'.$num, $row->tipo)
;
            $num++;


}


        $num2 = $num - 1;


$objPHPExcel->getActiveSheet()->getStyle('E3:T'.$num)->getNumberFormat()->setFormatCode('##0');//formato de numero
$objPHPExcel->getActiveSheet()->getStyle('U3:U'.$num)->getNumberFormat()->setFormatCode('##0.00');


$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('Q')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('R')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('S')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('T')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('V')->setAutoSize(true);
// Rename sheet
$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(0,3);
$objPHPExcel->getActiveSheet()->setTitle('OPTIMO DE SUCURSALES');

$nom = "optimo_$ger.xls";
// Echo memory peak usage


//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
//$objWriter->save($_SERVER['DOCUMENT_ROOT']."/oficinas/correos/".$nom);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=".$nom);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
