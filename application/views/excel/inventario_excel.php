<?php
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set properties
$output = fopen('php://output', 'w');
        
        fputcsv($output, array("lidia"));
        fputcsv($output, array('',''));
$objPHPExcel->getProperties()->setCreator("IVAN ZUÑIGA PEREZ")
							 ->setLastModifiedBy("IVAN ZUÑIGA PEREZ")
							 ->setTitle("Inventario")
							 ->setSubject("Inventario")
							 ->setDescription("Inventario")
							 ->setKeywords("Inventario")
							 ->setCategory("Inventario");

$this->db->where('tipo', $tipo);
$q1 = $this->db->get('inventarios.origen o')->row();

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', 'Inventario' .' '.$q1->almacen)
            ;



$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Secuencia')
            ->setCellValue('B'.$ini, 'Sustancia Activa')
            ->setCellValue('C'.$ini, 'Lote')
            ->setCellValue('D'.$ini, 'Caducidad')
            ->setCellValue('E'.$ini, 'Piezas')
            
;            

$num = 5;
$sql = "SELECT tipo, almacen, clave, descripcion, lote, caducidad, inventario FROM inventarios.inventario i
        left join inventarios.origen o on i.origen=o.origen
        where tipo=?;";
$query = $this->db->query($sql, $tipo);
//serie, folio, rec_rfc, rec_razon, subtotal, estatus
foreach ($query->result() as $row)
{
			

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->clave)
            ->setCellValue('B'.$num, $row->descripcion)
            ->setCellValue('C'.$num, $row->lote)
            ->setCellValue('D'.$num, $row->caducidad)
            ->setCellValue('E'.$num, $row->inventario)
;

            $num++;

}
        $num2 = $num - 1;
$objPHPExcel->getActiveSheet()->setCellValue('E'.$num,'=SUM(E5:E'.$num2.')');

        $num3 = $num + 2;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C'.$num3, date('Y-m-d H:s:i'))
            ;


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
//$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Inventario');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="lidia'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;