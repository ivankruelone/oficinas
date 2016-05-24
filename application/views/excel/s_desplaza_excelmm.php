<?php
ini_set('memory_limit', '-1');
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

            ;

$ini=2;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Año')
            ->setCellValue('B'.$ini, 'Nid')
            ->setCellValue('C'.$ini, 'Sucursal')
            ->setCellValue('D'.$ini, 'Codigo')
            ->setCellValue('E'.$ini, 'Descripcion')
            ->setCellValue('F'.$ini, 'Enero')
            ->setCellValue('G'.$ini, 'Febrero')
            ->setCellValue('H'.$ini, 'Marzo')
            ->setCellValue('I'.$ini, 'Abril')
            ->setCellValue('J'.$ini, 'Mayo')
            ->setCellValue('K'.$ini, 'Junio')
            ->setCellValue('L'.$ini, 'Julio')
            ->setCellValue('M'.$ini, 'Agosto')
            ->setCellValue('N'.$ini, 'Septiembre')
            ->setCellValue('O'.$ini, 'Octubre')
            ->setCellValue('P'.$ini, 'Noviembre')
            ->setCellValue('Q'.$ini, 'Diciembre')
            ->setCellValue('R'.$ini, 'Total')
            
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
            ->setCellValue('C'.$num, $row->nombre)
            ->setCellValue('D'.$num, $row->codigo)
            ->setCellValue('E'.$num, $row->descripcion)
            ->setCellValue('F'.$num, $row->venta1)
            ->setCellValue('G'.$num, $row->venta2)
            ->setCellValue('H'.$num, $row->venta3)
            ->setCellValue('I'.$num, $row->venta4)
            ->setCellValue('J'.$num, $row->venta5)
            ->setCellValue('K'.$num, $row->venta6)
            ->setCellValue('L'.$num, $row->venta7)
            ->setCellValue('M'.$num, $row->venta8)
            ->setCellValue('N'.$num, $row->venta9)
            ->setCellValue('O'.$num, $row->venta10)
            ->setCellValue('P'.$num, $row->venta11)
            ->setCellValue('Q'.$num, $row->venta12)
            ->setCellValue('R'.$num, ($row->venta1+$row->venta2+$row->venta3+$row->venta4+$row->venta5+
            $row->venta6+$row->venta7+$row->venta8+$row->venta9+$row->venta10+$row->venta11+$row->venta12))
;

            $num++;
$t1=$t1+$row->venta1;
$t2=$t2+$row->venta2;
$t3=$t3+$row->venta3;
$t4=$t4+$row->venta4;
$t5=$t5+$row->venta5;
$t6=$t6+$row->venta6;
$t7=$t7+$row->venta7;
$t8=$t8+$row->venta8;
$t9=$t9+$row->venta9;
$t10=$t10+$row->venta10;
$t11=$t11+$row->venta11;
$t12=$t12+$row->venta12;
$t13=$t13+($row->venta1+$row->venta2+$row->venta3+$row->venta4+$row->venta5+
            $row->venta6+$row->venta7+$row->venta8+$row->venta9+$row->venta10+$row->venta11+$row->venta12);

}



        $num2 = $num - 1;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, '')
            ->setCellValue('B'.$num, '')
            ->setCellValue('C'.$num, '')
            ->setCellValue('D'.$num, '')
            ->setCellValue('E'.$num, '')
            ->setCellValue('F'.$num, $t1)
            ->setCellValue('G'.$num, $t2)
            ->setCellValue('H'.$num, $t3)
            ->setCellValue('I'.$num, $t4)
            ->setCellValue('J'.$num, $t5)
            ->setCellValue('K'.$num, $t6)
            ->setCellValue('L'.$num, $t7)
            ->setCellValue('M'.$num, $t8)
            ->setCellValue('N'.$num, $t9)
            ->setCellValue('O'.$num, $t10)
            ->setCellValue('P'.$num, $t11)
            ->setCellValue('Q'.$num, $t12)
            ->setCellValue('R'.$num, $t13)
            ;



// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('sd');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ssss'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=1');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;