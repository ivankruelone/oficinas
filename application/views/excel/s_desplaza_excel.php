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
							 ->setTitle("DESPLAZAMIENTO DE PRODUCTOS")
							 ->setSubject("DESPLAZAMIENTO DE PRODUCTOS")
							 ->setDescription("DESPLAZAMIENTO DE PRODUCTOS")
							 ->setKeywords("DESPLAZAMIENTO DE PRODUCTOS")
							 ->setCategory("DESPLAZAMIENTO DE PRODUCTOS");

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E1', 'DESPLAZAMIENTO DE PRODUCTOS')
            ;
// Add some data
$ini=2;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Año')
            ->setCellValue('B'.$ini, 'Nid')
            ->setCellValue('C'.$ini, 'Sucursal')
            ->setCellValue('D'.$ini, 'Codigo')
            ->setCellValue('E'.$ini, 'Descripcion')
            ->setCellValue('F'.$ini, 'Ene')
            ->setCellValue('G'.$ini, 'Feb')
            ->setCellValue('H'.$ini, 'Mar')
            ->setCellValue('I'.$ini, 'Abr')
            ->setCellValue('J'.$ini, 'May')
            ->setCellValue('K'.$ini, 'Jun')
            ->setCellValue('L'.$ini, 'Jul')
            ->setCellValue('M'.$ini, 'Ago')
            ->setCellValue('N'.$ini, 'Sep')
            ->setCellValue('O'.$ini, 'Oct')
            ->setCellValue('P'.$ini, 'Nov')
            ->setCellValue('Q'.$ini, 'Dic')
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

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(-1);
$objPHPExcel->getActiveSheet()->getColumnDimension('b')->setWidth('-1');
$objPHPExcel->getActiveSheet()->getColumnDimension('c')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('d')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('e')->setWidth(60);
$objPHPExcel->getActiveSheet()->getColumnDimension('f')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('g')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('h')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('i')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('j')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('k')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('l')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('m')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('n')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('o')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('p')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('r')->setWidth(10);

$objPHPExcel->getActiveSheet()->getStyle('A1:R1')->getFont()->setBold(true); //renegridas
$objPHPExcel->getActiveSheet()->getStyle('a2:r2')->getAlignment()->setIndent(0)
->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS)->setWrapText(true);//alinear justificado y centrado

$objPHPExcel->getActiveSheet()->getStyle('A2:R2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);//sombreda la celda 2 colores
$objPHPExcel->getActiveSheet()->getStyle('A2:R2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('a2:r'.$num)->getBorders()->setDiagonalDirection(PHPExcel_Style_Border::BORDER_THIN);//tipo de boder y color de borde

$objPHPExcel->getActiveSheet()->getStyle('d3:d'.$num)->getNumberFormat()->setFormatCode('##0');//formato de numero

$objPHPExcel->getActiveSheet()->getStyle('f3:R'.$num)->getAlignment()->setIndent(0)//alinear datos 
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('f3:R'.$num)->getNumberFormat()->setFormatCode('#,#0');//formato de numero


$objPHPExcel->getActiveSheet()->getStyle('a'.$num.':r'.$num)->getFont()->setBold(true);//renegridas



// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('DESPLAZAMIENTO DE PRODUCTOS');

$nom = "desplaza$ger.xls";
// Echo memory peak usage


//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
//$objWriter->save($_SERVER['DOCUMENT_ROOT']."/oficinas/correos/".$nom);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=".$nom);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
