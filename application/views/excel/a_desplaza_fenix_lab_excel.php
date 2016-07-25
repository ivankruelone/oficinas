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

$objPHPExcel->createSheet();

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('E1', 'DESPLAZAMIENTO DE PRODUCTOS CONTROL')
            ;
// Add some data
$ini=2;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$ini, 'Año');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$ini, 'Pharmacy1');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$ini, 'Pharmacy2');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$ini, 'Codigo');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$ini, 'Descripcion');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$ini, 'Inv');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$ini, 'Ene');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$ini, 'Feb');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$ini, 'Mar');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$ini, 'Abr');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$ini, 'May');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$ini, 'Jun');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$ini, 'Jul');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$ini, 'Ago');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$ini, 'Sep');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$ini, 'Oct');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$ini, 'Nov');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$ini, 'Dic');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$ini, 'Total');
            
$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('E1', 'DESPLAZAMIENTO DE PRODUCTOS DETALLE')
            ;
// Add some data
$ini=2;
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$ini, 'Año');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$ini, 'Nid');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$ini, 'Sucursal');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D'.$ini, 'Codigo');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('E'.$ini, 'Descripcion');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$ini, 'Inv');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.$ini, 'Ene');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('H'.$ini, 'Feb');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('I'.$ini, 'Mar');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('J'.$ini, 'Abr');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('K'.$ini, 'May');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('L'.$ini, 'Jun');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('M'.$ini, 'Jul');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('N'.$ini, 'Ago');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('O'.$ini, 'Sep');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('P'.$ini, 'Oct');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('Q'.$ini, 'Nov');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('R'.$ini, 'Dic');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('S'.$ini, 'Total');
            
/////////////////////////////////////////////////////////////////////////////////////////detalle
$num = 3;

$t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$t13=0;$t0=0;
foreach ($query->result() as $row)
{
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->aaa)
            ->setCellValue('B'.$num, $row->rel1)
            ->setCellValue('C'.$num, $row->rel2)
            ->setCellValue('D'.$num, $row->codigo)
            ->setCellValue('E'.$num, $row->descri)
            ->setCellValue('F'.$num, $row->inv)
            ->setCellValue('G'.$num, $row->venta1)
            ->setCellValue('H'.$num, $row->venta2)
            ->setCellValue('I'.$num, $row->venta3)
            ->setCellValue('J'.$num, $row->venta4)
            ->setCellValue('K'.$num, $row->venta5)
            ->setCellValue('L'.$num, $row->venta6)
            ->setCellValue('M'.$num, $row->venta7)
            ->setCellValue('N'.$num, $row->venta8)
            ->setCellValue('O'.$num, $row->venta9)
            ->setCellValue('P'.$num, $row->venta10)
            ->setCellValue('Q'.$num, $row->venta11)
            ->setCellValue('R'.$num, $row->venta12)
            ->setCellValue('S'.$num, ($row->venta1+$row->venta2+$row->venta3+$row->venta4+$row->venta5+
            $row->venta6+$row->venta7+$row->venta8+$row->venta9+$row->venta10+$row->venta11+$row->venta12))
;

            $num++;
$t0=$t0+$row->inv;
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
$num1 = 3;

$tt1=0;$tt2=0;$tt3=0;$tt4=0;$tt5=0;$tt6=0;$tt7=0;$tt8=0;$tt9=0;$tt10=0;$tt11=0;$tt12=0;$tt13=0;$tt0=0;
foreach ($query1->result() as $row1)
{
$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A'.$num1, $row1->aaa)
            ->setCellValue('B'.$num1, $row1->suc)
            ->setCellValue('C'.$num1, $row1->nombre)
            ->setCellValue('D'.$num1, $row1->codigo)
            ->setCellValue('E'.$num1, $row1->descri)
            ->setCellValue('F'.$num1, $row1->inv)
            ->setCellValue('G'.$num1, $row1->venta1)
            ->setCellValue('H'.$num1, $row1->venta2)
            ->setCellValue('I'.$num1, $row1->venta3)
            ->setCellValue('J'.$num1, $row1->venta4)
            ->setCellValue('K'.$num1, $row1->venta5)
            ->setCellValue('L'.$num1, $row1->venta6)
            ->setCellValue('M'.$num1, $row1->venta7)
            ->setCellValue('N'.$num1, $row1->venta8)
            ->setCellValue('O'.$num1, $row1->venta9)
            ->setCellValue('P'.$num1, $row1->venta10)
            ->setCellValue('Q'.$num1, $row1->venta11)
            ->setCellValue('R'.$num1, $row1->venta12)
            ->setCellValue('S'.$num1, ($row1->venta1+$row1->venta2+$row1->venta3+$row1->venta4+$row1->venta5+
            $row1->venta6+$row1->venta7+$row1->venta8+$row1->venta9+$row1->venta10+$row1->venta11+$row1->venta12))
;

            $num1++;
$t0=$t0+$row1->inv;
$t1=$t1+$row1->venta1;
$t2=$t2+$row1->venta2;
$t3=$t3+$row1->venta3;
$t4=$t4+$row1->venta4;
$t5=$t5+$row1->venta5;
$t6=$t6+$row1->venta6;
$t7=$t7+$row1->venta7;
$t8=$t8+$row1->venta8;
$t9=$t9+$row1->venta9;
$t10=$t10+$row1->venta10;
$t11=$t11+$row1->venta11;
$t12=$t12+$row1->venta12;
$t13=$t13+($row1->venta1+$row1->venta2+$row1->venta3+$row1->venta4+$row1->venta5+
            $row1->venta6+$row1->venta7+$row1->venta8+$row1->venta9+$row1->venta10+$row1->venta11+$row1->venta12);
}


/////////////////////////////////////////////////////////////////////////////////////////detalle
        $num2 = $num - 1;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, '')
            ->setCellValue('B'.$num, '')
            ->setCellValue('C'.$num, '')
            ->setCellValue('D'.$num, '')
            ->setCellValue('E'.$num, '')
            ->setCellValue('F'.$num, $t0)
            ->setCellValue('G'.$num, $t1)
            ->setCellValue('H'.$num, $t2)
            ->setCellValue('I'.$num, $t3)
            ->setCellValue('J'.$num, $t4)
            ->setCellValue('K'.$num, $t5)
            ->setCellValue('L'.$num, $t6)
            ->setCellValue('M'.$num, $t7)
            ->setCellValue('N'.$num, $t8)
            ->setCellValue('O'.$num, $t9)
            ->setCellValue('P'.$num, $t10)
            ->setCellValue('Q'.$num, $t11)
            ->setCellValue('R'.$num, $t12)
            ->setCellValue('S'.$num, $t13);
            $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(-1);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('b')->setWidth('-1');
$objPHPExcel->getActiveSheet(0)->getColumnDimension('c')->setWidth(30);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('d')->setWidth(15);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('e')->setWidth(60);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('f')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('g')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('h')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('i')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('j')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('k')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('l')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('m')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('n')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('o')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('p')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('r')->setWidth(10);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('s')->setWidth(10);

$objPHPExcel->getActiveSheet(0)->getStyle('A1:S1')->getFont()->setBold(true); //renegridas
$objPHPExcel->getActiveSheet(0)->getStyle('a2:S2')->getAlignment()->setIndent(0)
->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS)->setWrapText(true);//alinear justificado y centrado

$objPHPExcel->getActiveSheet(0)->getStyle('A2:S2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);//sombreda la celda 2 colores
$objPHPExcel->getActiveSheet(0)->getStyle('A2:S2')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet(0)->getStyle('b3:d'.$num)->getNumberFormat()->setFormatCode('##0');//formato de numero

$objPHPExcel->getActiveSheet(0)->getStyle('f3:S'.$num)->getAlignment()->setIndent(0)//alinear datos 
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet(0)->getStyle('f3:S'.$num)->getNumberFormat()->setFormatCode('#,#0');//formato de numero

$objPHPExcel->getActiveSheet(0)->getStyle('a'.$num.':s'.$num)->getFont()->setBold(true);//renegridas
$objPHPExcel->getActiveSheet(0)->setTitle('Control');

$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A'.$num1, '')
            ->setCellValue('B'.$num1, '')
            ->setCellValue('C'.$num1, '')
            ->setCellValue('D'.$num1, '')
            ->setCellValue('E'.$num1, '')
            ->setCellValue('F'.$num1, $t0)
            ->setCellValue('G'.$num1, $t1)
            ->setCellValue('H'.$num1, $t2)
            ->setCellValue('I'.$num1, $t3)
            ->setCellValue('J'.$num1, $t4)
            ->setCellValue('K'.$num1, $t5)
            ->setCellValue('L'.$num1, $t6)
            ->setCellValue('M'.$num1, $t7)
            ->setCellValue('N'.$num1, $t8)
            ->setCellValue('O'.$num1, $t9)
            ->setCellValue('P'.$num1, $t10)
            ->setCellValue('Q'.$num1, $t11)
            ->setCellValue('R'.$num1, $t12)
            ->setCellValue('S'.$num1, $t13)
            ;

$objPHPExcel->getActiveSheet(1)->getColumnDimension('A')->setWidth(-1);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('b')->setWidth('-1');
$objPHPExcel->getActiveSheet(1)->getColumnDimension('c')->setWidth(30);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('d')->setWidth(15);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('e')->setWidth(60);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('f')->setWidth(10);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('g')->setWidth(10);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('h')->setWidth(10);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('i')->setWidth(10);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('j')->setWidth(10);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('k')->setWidth(10);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('l')->setWidth(10);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('m')->setWidth(10);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('n')->setWidth(10);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('o')->setWidth(10);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('p')->setWidth(10);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('r')->setWidth(10);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('s')->setWidth(10);

$objPHPExcel->getActiveSheet(1)->getStyle('A1:S1')->getFont()->setBold(true); //renegridas
$objPHPExcel->getActiveSheet(1)->getStyle('a2:S2')->getAlignment()->setIndent(0)
->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS)->setWrapText(true);//alinear justificado y centrado

$objPHPExcel->getActiveSheet(1)->getStyle('A2:S2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);//sombreda la celda 2 colores
$objPHPExcel->getActiveSheet(1)->getStyle('A2:S2')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet(1)->getStyle('d3:d'.$num)->getNumberFormat()->setFormatCode('##0');//formato de numero

$objPHPExcel->getActiveSheet(1)->getStyle('f3:S'.$num)->getAlignment()->setIndent(0)//alinear datos 
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet(1)->getStyle('f3:S'.$num)->getNumberFormat()->setFormatCode('#,#0');//formato de numero


$objPHPExcel->getActiveSheet(1)->getStyle('a'.$num.':s'.$num)->getFont()->setBold(true);//renegridas



// Rename sheet
$objPHPExcel->getActiveSheet(1)->setTitle('Detalle');
$objPHPExcel->setActiveSheetIndex(0);

$nom = "desplaza.xls";
// Echo memory peak usage


//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
//$objWriter->save($_SERVER['DOCUMENT_ROOT']."/oficinas/correos/".$nom);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=".$nom);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
