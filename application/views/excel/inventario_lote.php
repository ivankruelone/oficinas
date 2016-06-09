<?php
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("IVAN ZU�IGA PEREZ")
							 ->setLastModifiedBy("IVAN ZU�IGA PEREZ")
							 ->setTitle("Inventario")
							 ->setSubject("Inventario")
							 ->setDescription("Inventario")
							 ->setKeywords("Inventario")
							 ->setCategory("Inventario");



$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', 'Inventario')
            ;



$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Tipo')
            ->setCellValue('B'.$ini, 'Area')
            ->setCellValue('C'.$ini, 'Clave')
            ->setCellValue('D'.$ini, 'Descripcion')
            ->setCellValue('E'.$ini, 'Unidad')
            ->setCellValue('F'.$ini, 'P. Reorden')
            ->setCellValue('G'.$ini, 'Min')
            ->setCellValue('H'.$ini, 'Max')
            ->setCellValue('I'.$ini, 'Inventario')
            ->setCellValue('J'.$ini, 'Lote')
            ->setCellValue('K'.$ini, 'Caducidad')
;            

$num = 5;
$sql = "SELECT t.tipo_producto, s.subtipo_producto, p.clave, p.descripcion, p.unidad, lote, caducidad, sum(i.inv) as inv, preorden, min, max, i.lote, i.caducidad
FROM inventario i
left join productos p on i.p_id = p.id
left join tipo_producto t on p.tipo_producto = t.id
left join subtipo_producto s on p.subtipo_producto = s.id
where activo=1 and inv <> 0
group by p.id, lote
order by p.tipo_producto, s.subtipo_producto, p.clave + 0, lote;";
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
            ->setCellValue('F'.$num, $row->preorden)
            ->setCellValue('G'.$num, $row->min)
            ->setCellValue('H'.$num, $row->max)
            ->setCellValue('I'.$num, $row->inv)
            ->setCellValue('J'.$num, $row->lote)
            ->setCellValue('K'.$num, $row->caducidad)
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
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Inventario');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client�s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="inventario'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;