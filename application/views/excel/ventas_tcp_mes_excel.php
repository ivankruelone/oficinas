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
							 ->setTitle("Tarjetas Cliente Preferente")
							 ->setSubject("Tarjetas Cliente Preferente")
							 ->setDescription("Tarjetas Cliente Preferente")
							 ->setKeywords("Tarjetas Cliente Preferente")
							 ->setCategory("Tarjetas Cliente Preferente");



$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1', 'Tarjetas Cliente Preferente')
            ->setCellValue('D1', 'Del mes:')
            ->setCellValue('E1', $mesx)
            ->setCellValue('F1', 'del a#o:')
            ->setCellValue('G1', $aaax)
            ;

$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Nid')
            ->setCellValue('B'.$ini, 'Sucursal')
            ->setCellValue('C'.$ini, 'Nomina')
            ->setCellValue('D'.$ini, 'Nombre')
            ->setCellValue('E'.$ini, 'Status')
            ->setCellValue('F'.$ini, 'Cantidad')
            ->setCellValue('G'.$ini, 'Comision')
            ->setCellValue('H'.$ini, 'Puesto')
;            

$num = 5;
//serie, folio, rec_rfc, rec_razon, subtotal, estatus
foreach($query->result() as $row)
{

//$monto=$row->monto;
//sucursal_id, sucursal, fecha, id, clave, descripcion, unidad, canreq, cansur, negados, inv
        			

$objPHPExcel->setActiveSheetIndex(0)
            
            ->setCellValue('A'.$num, $row->suc)
            ->setCellValue('B'.$num, $row->nombre)
            ->setCellValue('C'.$num, $row->nomina)
            ->setCellValue('D'.$num, $row->completo)
            ->setCellValue('E'.$num, $row->estatus)
            ->setCellValue('F'.$num, $row->cantidad)
            ->setCellValue('G'.$num, $row->comision)
            ->setCellValue('H'.$num, $row->puestox)

;

            $num++;

}
        $num2 = $num - 1;
$objPHPExcel->getActiveSheet()->setCellValue('G'.$num,'=SUM(G5:G'.$num2.')');
//$objPHPExcel->getActiveSheet()->setCellValue('I'.$num,'=SUM(I5:I'.$num2.')');
//$objPHPExcel->getActiveSheet()->setCellValue('J'.$num,'=SUM(J5:J'.$num2.')');

$objPHPExcel->getActiveSheet()->getStyle('G'.$num,'G5:G'.$num2)->getNumberFormat()
->setFormatCode("[RED]###############");
//$objPHPExcel->getActiveSheet()->getStyle('I'.$num,'I5:I'.$num2)->getNumberFormat()
//->setFormatCode("[RED]###############");
//$objPHPExcel->getActiveSheet()->getStyle('J'.$num,'J5:J'.$num2)->getNumberFormat()
//->setFormatCode("[RED]###############");



        $num3 = $num + 2;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C'.$num3, date('Y-m-d H:s:i'))
            ;


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(false);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('TARJETAS CLIENTE PREFERENTE');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="catalogo_ultimosCostos_'.date('YmsHsi').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;