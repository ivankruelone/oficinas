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
            ->setCellValue('C1', 'Reporte de Entradas')
            ->setCellValue('D1', 'De:')
            ->setCellValue('E1', $perini)
            ->setCellValue('F1', 'AL:')
            ->setCellValue('G1', $perfin)
            ;

$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Clave')
            ->setCellValue('B'.$ini, 'Descripcion')
            ->setCellValue('C'.$ini, 'Lote')
            ->setCellValue('D'.$ini, 'Caducidad')
            ->setCellValue('E'.$ini, 'Proveedor')
            ->setCellValue('F'.$ini, 'Fecha Factura')
            ->setCellValue('G'.$ini, 'Ingreso al sistema')
            ->setCellValue('H'.$ini, 'Piezas')
            ->setCellValue('I'.$ini, 'Costo unitario')
            ->setCellValue('J'.$ini, 'Costo')
;            

$num = 5;
//serie, folio, rec_rfc, rec_razon, subtotal, estatus
foreach($query->result() as $row)
{

$imp=$row->piezas*$row->precio;
        			

$objPHPExcel->setActiveSheetIndex(0)
            //->setCellValue('A'.$num, 'prueba')
            ->setCellValue('A'.$num, $row->clave)
            ->setCellValue('B'.$num, $row->descripcion)
            //->setCellValue('B'.$num, 'prueba')
            ->setCellValue('C'.$num, $row->lote)
            //->setCellValue('C'.$num, 'prueba')
            ->setCellValue('D'.$num, $row->caducidad)
            //->setCellValue('D'.$num, 'prueba')
            ->setCellValue('E'.$num, $row->razon)
            //->setCellValue('E'.$num, 'prueba')
            ->setCellValue('F'.$num, $row->fec_doc)
            // ->setCellValue('F'.$num, 'prueba')
            ->setCellValue('G'.$num, $row->cerrado)
            // ->setCellValue('G'.$num, 'prueba')
            ->setCellValue('H'.$num, $row->piezas)
            ->setCellValue('I'.$num, $row->precio)
            ->setCellValue('J'.$num, number_format($imp,2))

;

            $num++;

}
        $num2 = $num - 1;
$objPHPExcel->getActiveSheet()->setCellValue('H'.$num,'=SUM(H5:H'.$num2.')');
$objPHPExcel->getActiveSheet()->setCellValue('I'.$num,'=SUM(I5:I'.$num2.')');
$objPHPExcel->getActiveSheet()->setCellValue('J'.$num,'=SUM(J5:J'.$num2.')');

$objPHPExcel->getActiveSheet()->getStyle('H'.$num,'H5:H'.$num2)->getNumberFormat()
->setFormatCode("[RED]###############");
$objPHPExcel->getActiveSheet()->getStyle('I'.$num,'I5:I'.$num2)->getNumberFormat()
->setFormatCode("[RED]###############");
$objPHPExcel->getActiveSheet()->getStyle('J'.$num,'J5:J'.$num2)->getNumberFormat()
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
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Entradas');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte_de_Entradas_'.date('Ymd').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;