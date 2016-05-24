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
							 ->setTitle("Inventario")
							 ->setSubject("Inventario")
							 ->setDescription("Inventario")
							 ->setKeywords("Inventario")
							 ->setCategory("Inventario");

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
	die($cacheMethod . " caching method is not available" . EOL);
}


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C1', 'Insumos Solicitados del folio: '.$id_cc.' Subfolio: '.$fol)
            ;



$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'ID')
            ->setCellValue('B'.$ini, 'CODIGO')
            ->setCellValue('C'.$ini, 'DESCRIPCION')
            ->setCellValue('D'.$ini, 'PRESENTACION')
            ->setCellValue('E'.$ini, 'PEDIDO')
            
;            

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
            ->setCellValue('A'.$num, $num)
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

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Insumos');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="InsumosPendientes'.date('Yms').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;