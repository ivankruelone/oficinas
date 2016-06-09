<?php
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("IVAN ZUÑIGA PEREZ")
							 ->setLastModifiedBy("IVAN ZUÑIGA PEREZ")
							 ->setTitle("Insumos")
							 ->setSubject("Insumos")
							 ->setDescription("Insumos")
							 ->setKeywords("Insumos")
							 ->setCategory("Insumos");


$objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'INSUMOS SOLICITADOS DEL FOLIO: '.$id_cc.' SUBFOLIO: '.$fol);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);




$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'ID')
            ->setCellValue('B'.$ini, 'CODIGO')
            ->setCellValue('C'.$ini, 'DESCRIPCION')
            ->setCellValue('D'.$ini, 'PRESENTACION')
            ->setCellValue('E'.$ini, 'PEDIDO')
            
;    


$objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':E'.$ini)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':E'.$ini)->getFont()->setSize(10);
$objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':E'.$ini)->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A' . $ini . ':E' . $ini)->getFill()->applyFromArray(array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'startcolor' => array(
                             'rgb' => 'FBAD89'
                        )
                    ));               

$num = 5;
$i = 1;
$s="SELECT c.descripcion,c.empaque,b.*
FROM papeleria.insumos_s b
join catalogo.cat_insumos c on c.id_insumos=b.id_insumos
where b.tipo=1 and b.fol = '$fol' and b.id_cc=$id_cc";
$query=$this->db->query($s);
foreach ($query->result() as $row)
{
			

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $i)
            ->setCellValue('B'.$num, $row->id_insumos)
            ->setCellValue('C'.$num, $row->descripcion)
            ->setCellValue('D'.$num, $row->empaque)
            ->setCellValue('E'.$num, $row->canp)
;

$i++;

$num++;

}
        $num2 = $num - 1;
$objPHPExcel->getActiveSheet()->setCellValue('E'.$num,'=SUM(E5:E'.$num2.')');
$objPHPExcel->getActiveSheet()->getStyle('E5:E'.$num2)->getNumberFormat()
    ->setFormatCode('#0');
        $num3 = $num + 2;



$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);

$styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => 'FFFF0000'),
                    ),
                ),
            );

$objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':E'.$ini)->applyFromArray($styleArray);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Insumos');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel2007)
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="InsumosPendientes'.date('Yms').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;