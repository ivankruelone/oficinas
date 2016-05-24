<?php
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("IVAN ZUÑIGA PEREZ")
							 ->setLastModifiedBy("IVAN ZUÑIGA PEREZ")
							 ->setTitle("Pedido Embarcado")
							 ->setSubject("Pedido Embarcado")
							 ->setDescription("Pedido Embarcado")
							 ->setKeywords("Pedido Embarcado")
							 ->setCategory("Pedido Embarcado");



$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', 'Reporte de Embarque')
            ->setCellValue('D1', 'De:')
            ->setCellValue('E1', $perini)
            ->setCellValue('F1', 'AL:')
            ->setCellValue('G1', $perfin)
            ;

$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Clave')
            ->setCellValue('B'.$ini, 'Descripcion')
            ->setCellValue('C'.$ini, 'Fecha de Embarque')
            ->setCellValue('D'.$ini, 'Folio')
            ->setCellValue('E'.$ini, 'Sucursal')
            ->setCellValue('F'.$ini, 'Requeridas')
            ->setCellValue('G'.$ini, 'Surtidas')
;            

$num = 5;
//serie, folio, rec_rfc, rec_razon, subtotal, estatus
foreach ($query as $row1)
{
			

$objPHPExcel->setActiveSheetIndex(0)
            //->setCellValue('A'.$num, 'prueba')
            ->setCellValue('A'.$num, $row1->clave)
            ->setCellValue('B'.$num, $row1->descripcion)
            //->setCellValue('B'.$num, 'prueba')
            ->setCellValue('C'.$num, $row1->f_embarque)
            //->setCellValue('C'.$num, 'prueba')
            ->setCellValue('D'.$num, $row1->id)
            //->setCellValue('D'.$num, 'prueba')
            ->setCellValue('E'.$num, $row1->sucursal)
            //->setCellValue('E'.$num, 'prueba')
            ->setCellValue('F'.$num, $row1->canreq)
            // ->setCellValue('F'.$num, 'prueba')
            ->setCellValue('G'.$num, $row1->cansur)
            // ->setCellValue('G'.$num, 'prueba')

;

            $num++;

}
        $num2 = $num - 1;
$objPHPExcel->getActiveSheet()->setCellValue('F'.$num,'=SUM(F5:F'.$num2.')');
$objPHPExcel->getActiveSheet()->setCellValue('G'.$num,'=SUM(G5:G'.$num2.')');

$objPHPExcel->getActiveSheet()->getStyle('F'.$num,'F5:F'.$num2)->getNumberFormat()
->setFormatCode("[RED]###############");
$objPHPExcel->getActiveSheet()->getStyle('G'.$num,'G5:G'.$num2)->getNumberFormat()
->setFormatCode("[RED]###############");



        $num3 = $num + 2;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C'.$num3, date('Y-m-d H:s:i'))
            ;


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Embarque');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte_de_Embarque_'.date('Ymd').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;