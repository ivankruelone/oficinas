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
							 ->setTitle("CATALOGO")
							 ->setSubject("CATALOGO")
							 ->setDescription("CATALOGO")
							 ->setKeywords("CATALOGO")
							 ->setCategory("CATALOGO");



$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', 'Catalogo de productos')
            ;



$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Tipo')
            ->setCellValue('B'.$ini, 'Area')
            ->setCellValue('C'.$ini, 'Clave')
            ->setCellValue('D'.$ini, 'Descripcion')
            ->setCellValue('E'.$ini, 'Unidad')
;            

$num = 5;
$sql = "SELECT t.tipo_producto, s.subtipo_producto, clave, descripcion, unidad FROM productos p
left join tipo_producto t on p.tipo_producto = t.id
left join subtipo_producto s on p.subtipo_producto = s.id
order by p.tipo_producto, p.subtipo_producto, clave + 0;";
$query = $this->db->query($sql);
//serie, folio, rec_rfc, rec_razon, subtotal, estatus
foreach ($query->result() as $row)
{
			

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->tipo_producto)
            ->setCellValue('B'.$num, $row->subtipo_producto)
            ->setCellValue('C'.$num, $row->clave)
            ->setCellValue('D'.$num, $row->descripcion)
            ->setCellValue('E'.$num, $row->unidad)
;

            $num++;

}
        $num2 = $num - 1;
$objPHPExcel->getActiveSheet()->setCellValue('I'.$num,'=SUM(I5:I'.$num2.')');

        $num3 = $num + 2;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C'.$num3, date('Y-m-d H:s:i'))
            ;


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Catalogo de productos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="inventario'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;