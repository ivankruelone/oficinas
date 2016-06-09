<?php
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
/** PHPExcel */
require_once 'Classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("IVAN ZUÑIGA PEREZ")
							 ->setLastModifiedBy("IVAN ZUÑIGA PEREZ")
							 ->setTitle("Insumos")
							 ->setSubject("Insumos")
							 ->setDescription("Insumos")
							 ->setKeywords("Insumos")
							 ->setCategory("Insumos");

$s2 = "SELECT  a.id,a.suc, x.nombre
FROM papeleria.insumos_c a
join papeleria.insumos_s b on b.id_cc = a.id
join catalogo.cat_insumos c on c.id_insumos = b.id_insumos
join catalogo.sucursal x on x.suc=a.suc
where a.id_comprar in(1,3)
and a.tipo in(1,2,3)
and a.suc = $suc and a.id = $id
group by x.nombre";
$q2=$this->db->query($s2);

foreach ($q2->result() as $r2) {
$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'INSUMOS SOLICITADOS DEL FOLIO: '.$id.' SUCURSAL: '.$suc.' - '.$r2->nombre);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
//$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}

$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'ID')
            ->setCellValue('B'.$ini, 'CODIGO')
            ->setCellValue('C'.$ini, 'DESCRIPCION')
            ->setCellValue('D'.$ini, 'PRESENTACION')
            ->setCellValue('E'.$ini, 'PEDIDO')
            ->setCellValue('F'.$ini, 'CALCULADA')
            ->setCellValue('G'.$ini, 'CANT. SUPERVISOR')
            ->setCellValue('H'.$ini, 'SURTIDO')
            ->setCellValue('I'.$ini, 'IMP. PED')
            ->setCellValue('J'.$ini, 'IMP. SUR');

$objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':J'.$ini)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':J'.$ini)->getFont()->setSize(10);
$objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':J'.$ini)->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('A' . $ini . ':J' . $ini)->getFill()->applyFromArray(array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'startcolor' => array(
                             'rgb' => 'FBAD89'
                        )

                    ));                    

$num = 5;
$i = 1;
$s="SELECT
a.id_cc, a.id_insumos, a.canp, a.canp_suc, a.canp_sup, a.costo, b.descripcion, b.empaque,
ifnull((select sum(cans) from papeleria.insumos_s x where x.id_cc=a.id_cc and x.id_dd=a.id and x.fecha_sur>'0000-00-00'),0) as sur
FROM papeleria.insumos_d a
join catalogo.cat_insumos b on b.id_insumos=a.id_insumos
where a.tipo in (1,2,3) and a.id_cc not in(select x.id_cc from papeleria.pedido_extra x where x.id_cc = a.id_cc) and a.id_cc=$id";
$q=$this->db->query($s);
$coscanp = 0;$coscans = 0;
foreach ($q->result() as $row)
{
			
 $coscanp = $row->canp_sup*$row->costo;
 $coscans = $row->sur*$row->costo;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $i)
            ->setCellValue('B'.$num, $row->id_insumos)
            ->setCellValue('C'.$num, $row->descripcion)
            ->setCellValue('D'.$num, $row->empaque)
            ->setCellValue('E'.$num, $row->canp_suc)
            ->setCellValue('F'.$num, $row->canp)
            ->setCellValue('G'.$num, $row->canp_sup)
            ->setCellValue('H'.$num, $row->sur)
            ->setCellValue('I'.$num, $coscanp)
            ->setCellValue('J'.$num, $coscans)
;

$i++;

$num++;

}
        $num2 = $num - 1;
$objPHPExcel->getActiveSheet()->setCellValue('E'.$num,'=SUM(E5:E'.$num2.')');
$objPHPExcel->getActiveSheet()->getStyle('E5:E'.$num2)->getNumberFormat()
    ->setFormatCode('#0');
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$num,'=SUM(F5:F'.$num2.')');
$objPHPExcel->getActiveSheet()->getStyle('F5:F'.$num2)->getNumberFormat()
    ->setFormatCode('#0');
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$num,'=SUM(G5:G'.$num2.')');
$objPHPExcel->getActiveSheet()->getStyle('G5:G'.$num2)->getNumberFormat()
    ->setFormatCode('#0');
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$num,'=SUM(H5:H'.$num2.')');
$objPHPExcel->getActiveSheet()->getStyle('H5:H'.$num2)->getNumberFormat()
    ->setFormatCode('#0');
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$num,'=SUM(I5:I'.$num2.')');
$objPHPExcel->getActiveSheet()->getStyle('I5:I'.$num2)->getNumberFormat()
    ->setFormatCode('#,##0.00');
    $objPHPExcel->getActiveSheet()->setCellValue('J'.$num,'=SUM(J5:J'.$num2.')');
$objPHPExcel->getActiveSheet()->getStyle('J5:J'.$num2)->getNumberFormat()
    ->setFormatCode('#,##0.00');
        $num3 = $num + 2;



$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

$styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN,
                        'color' => array('argb' => 'FFFF0000'),
                    ),
                ),
            );

$objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':J'.$ini)->applyFromArray($styleArray);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Insumos Pendientes');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="InsumosPendientes'.date('Y-m-s').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;