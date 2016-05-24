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
							 ->setTitle("Inventario Caducado y/o Proximo a Caducar")
							 ->setSubject("Inventario")
							 ->setDescription("Inventario y/o Proximo a Caducar")
							 ->setKeywords("Inventario")
							 ->setCategory("Inventario");

$this->db->where('id', $id);
$q1 = $this->db->get('inventarios.caducidad')->row();

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', 'Inventario')
            ;



$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Clave')
            ->setCellValue('B'.$ini, 'Descripcion')
            ->setCellValue('C'.$ini, 'Lote')
            ->setCellValue('D'.$ini, 'Caducidad')
            ->setCellValue('E'.$ini, 'Inventario')
            ->setCellValue('F'.$ini, 'Caducidad (Dias)')
            ->setCellValue('G'.$ini, 'Almacen')
            
;            

$num = 5;
$sql = "SELECT *, almacen, DATEDIFF(caducidad, now()) as diferencia FROM inventarios.inventario i
            left join inventarios.origen o on i.origen=o.origen
            where caducidad <> '0000-00-00' and DATEDIFF(caducidad, now()) between $q1->de and $q1->hasta order by diferencia;";
$query = $this->db->query($sql, $id);
//serie, folio, rec_rfc, rec_razon, subtotal, estatus
foreach ($query->result() as $row)
{
			

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->clave)
            ->setCellValue('B'.$num, $row->descripcion)
            ->setCellValue('C'.$num, $row->lote)
            ->setCellValue('D'.$num, $row->caducidad)
            ->setCellValue('E'.$num, $row->inventario)
            ->setCellValue('F'.$num, $row->diferencia)
            ->setCellValue('G'.$num, $row->almacen)
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
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('InventarioCaducado');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="inventario'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;