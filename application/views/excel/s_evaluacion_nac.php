<?php

error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
$nombre='ventas.xlsx';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("Lidia Velazquez Alvarez")
							 ->setLastModifiedBy("Lidia Velazquez Alvarez")
							 ->setTitle("Estadistica")
							 ->setSubject("Estadistica")
							 ->setDescription("Estadistica")
							 ->setKeywords("Estadistica")
							 ->setCategory("Estadistica");   

$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
	die($cacheMethod . " caching method is not available" . EOL);
}
$objPHPExcel->createSheet();


//*********************************************************************************************************titulo global
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'EVALUACION POR SUCURSAL')->mergeCells('A1:AC1')->getStyle()->getFont()->setBold(true);
            ;
 $objPHPExcel->getActiveSheet(0)->getStyle('A1:AC1')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'NID');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', 'VENTA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', 'COSTO VENTA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', '% COSTO VENTA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', 'RENTA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H3', 'IMPUESTO RENTA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I3', '% RENTA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J3', 'PERSEPCIONES NOMINA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K3', 'DEDUCCIONES NOMINA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L3', '% NOMINA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M3', 'INSUMOS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N3', 'DEVOLUCION');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O3', 'AGUA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P3', 'LUZ');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q3', 'TEL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R3', 'OTROS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S3', '% GASTOS');
//*********************************************************************************************************titulo global
//*********************************************************************************************************titulo rentas
$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A1', 'RENTAS DE LAS SUCURSALES')
            ->mergeCells('A1:J1')->getStyle()->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A3', 'NID');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B3', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C3', 'ARRENDADOR');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D3', 'FORMA DE PAGO');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E3', 'RENTA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F3', 'IVA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G3', 'RETENCION');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H3', 'RETENCION DE IVA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I3', 'TOTAL');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J3', 'TOTAL MN');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K3', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L3', 'OFICINAS');
$objPHPExcel->getActiveSheet(1)->getStyle('A1:J3')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
$ini=4;
$tot=0; 
//*********************************************************************************************************titulo rentas
//*********************************************************************************************************titulo ventas costo
$sheetId = 2;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2);

$objPHPExcel->setActiveSheetIndex(2)
            ->setCellValue('A1', 'VENTAS Y COSTO DE LA VENTA')
            ->mergeCells('A1:F1')->getStyle()->getFont()->setBold(true);
            
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A3', 'NID');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('B3', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('C3', 'VENTA SIN IVA');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('D3', 'COSTO DE LA VENTA');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('E3', 'UTILIDAD');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('F3', '% UTILIDAD');
$objPHPExcel->getActiveSheet(2)->getStyle('A1:F3')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);            
//*********************************************************************************************************titulo ventas costo
//*********************************************************************************************************titulo NOMINAS
$sheetId = 3;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(3);

$objPHPExcel->setActiveSheetIndex(3)
            ->setCellValue('A1', 'NOMINA POR SUCURSAL')
            ->mergeCells('A1:F1')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A3', 'NID');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('B3', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('C3', 'PERSEPCIONES GRAVADOS');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('D3', 'PERSEPCIONES EXCENTOS');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('E3', 'TOTAL DEDUCCIONES GRAVADOS');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('F3', 'DEPOSITO');
$objPHPExcel->getActiveSheet(3)->getStyle('A1:F3')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);            
//*********************************************************************************************************titulo NOMINAS
//*********************************************************************************************************titulo global
$sheetId = 4;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(4)
            ->setCellValue('A1', 'EVALUACION POR SUCURSAL')->mergeCells('A1:AC1')->getStyle()->getFont()->setBold(true);
            ;
 $objPHPExcel->getActiveSheet(4)->getStyle('A1:AC1')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('A3', 'NID');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('B3', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('C3', 'VENTA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('D3', 'COSTO VENTA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('E3', '% COSTO VENTA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('F3', 'RENTA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('G3', 'IMPUESTO RENTA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('H3', '% RENTA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('I3', 'PERSEPCIONES NOMINA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('J3', 'DEDUCCIONES NOMINA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('K3', '% NOMINA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('L3', 'INSUMOS');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('M3', 'DEVOLUCION');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('N3', 'AGUA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('O3', 'LUZ');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('P3', 'TEL');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('Q3', 'OTROS');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('R3', '% GASTOS');
//*********************************************************************************************************titulo global
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle rentas
foreach($q1->result()as $r1)
{
if($r1->tipo3==' '){
$objPHPExcel->getActiveSheet(1)->getStyle('A'.$ini.':J'.$ini)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
}else{
$objPHPExcel->getActiveSheet(1)->getStyle('A'.$ini.':J'.$ini)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);    
}
    //mes, mesx, suc, sucx, imp, ivaf, isrf, iva_isrf, total, total_mn
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$ini, $r1->suc);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$ini, $r1->sucx);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$ini, $r1->nom);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D'.$ini, $r1->pago);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('E'.$ini, $r1->imp);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$ini, $r1->ivaf);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.$ini, $r1->isrf);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('H'.$ini, $r1->iva_isrf);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('I'.$ini, $r1->total);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('J'.$ini, $r1->total_mn);
            $objPHPExcel->getActiveSheet()->getStyle('E5:'.'J'.$ini)->getNumberFormat()->setFormatCode('#,#00.00');
$ini=$ini+1;
$tot=$tot+$r1->total_mn;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle rentas
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle ventas costo
$ini2=4;
$por_util=0;
foreach($q2->result()as $r2)
{
if($r2->cos_venta>0){$por_util=(($r2->venta_siniva-$r2->cos_venta)/($r2->venta_siniva))*100;}else{$por_util=0;}
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A'.$ini2, $r2->suc);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('B'.$ini2, $r2->sucx);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('C'.$ini2, $r2->venta_siniva);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('D'.$ini2, $r2->cos_venta);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('E'.$ini2, ($r2->venta_siniva-$r2->cos_venta));
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('F'.$ini2, $por_util);
            
            $objPHPExcel->getActiveSheet()->getStyle('C5:'.'F'.$ini2)->getNumberFormat()->setFormatCode('#,#00.00');
$ini2=$ini2+1;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle ventas costo
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle NOMINAS
$ini3=4;
foreach($q3->result()as $r3)
{//fecha, suc, nombre, percepcionesTotalGravado, percepcionesTotalExento, deduccionesTotalGravado, deposito
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('A'.$ini3, $r3->suc);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('B'.$ini3, $r3->nombre);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('C'.$ini3, $r3->percepcionesTotalGravado);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('D'.$ini3, $r3->percepcionesTotalExento);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('E'.$ini3, $r3->deduccionesTotalGravado);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('F'.$ini3, $r3->deposito);
            
            $objPHPExcel->getActiveSheet()->getStyle('C5:'.'F'.$ini3)->getNumberFormat()->setFormatCode('#,#00.00');
$ini3=$ini3+1;
}

foreach($q4->result()as $r4)
{//fecha, suc, nombre, percepcionesTotalGravado, percepcionesTotalExento, deduccionesTotalGravado, deposito
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('A'.$ini3, $r4->cia);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('B'.$ini3, $r4->ciax);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('C'.$ini3, $r4->percepcionesTotalGravado);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('D'.$ini3, $r4->percepcionesTotalExento);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('E'.$ini3, $r4->deduccionesTotalGravado);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('F'.$ini3, $r4->deposito);
            
            $objPHPExcel->getActiveSheet()->getStyle('C5:'.'F'.$ini3)->getNumberFormat()->setFormatCode('#,#00.00');
$ini3=$ini3+1;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle NOMINAS
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
$ini4=4;
foreach($q5->result()as $r5)
{//por_costo_venta, por_renta, por_nomina, por_gastos, sucx, 
//venta, costo_venta, renta, isr_renta, nomina, isr_nomina, insumos, dev, agua, luz, tel, otros
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('A'.$ini4, $r5->suc);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('B'.$ini4, $r5->sucx);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('C'.$ini4, $r5->venta);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('D'.$ini4, $r5->costo_venta);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('E'.$ini4, $r5->por_costo_venta);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('F'.$ini4, $r5->renta);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('G'.$ini4, $r5->isr_renta);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('H'.$ini4, $r5->por_renta);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('I'.$ini4, $r5->nomina);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('J'.$ini4, $r5->isr_nomina);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('K'.$ini4, $r5->por_nomina);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('L'.$ini4, $r5->insumos);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('M'.$ini4, $r5->dev);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('N'.$ini4, $r5->agua);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('O'.$ini4, $r5->luz);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('P'.$ini4, $r5->tel);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('Q'.$ini4, $r5->otros);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('R'.$ini4, $r5->por_gastos);
            $objPHPExcel->getActiveSheet()->getStyle('C5:'.'R'.$ini4)->getNumberFormat()->setFormatCode('#,#00.00');
$ini4=$ini4+1;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
//die();
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I'.$ini, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J'.$ini, $tot);


//////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('J')->setAutoSize(true);

$objPHPExcel->getActiveSheet(1)->getStyle('A2:'.'J'.$ini)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
//////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getStyle('A2:'.'F'.$ini2)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
//////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getStyle('A2:'.'F'.$ini3)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
/////marca las celdas de impresion
//$objPHPExcel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_BREAK_PREVIEW);



// Rename sheet
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet(1)->freezePaneByColumnAndRow(0,4);
$objPHPExcel->getActiveSheet(1)->setTitle('Rentas');

$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet(2)->freezePaneByColumnAndRow(0,4);
$objPHPExcel->getActiveSheet(2)->setTitle('Ventas');

$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet(3)->freezePaneByColumnAndRow(0,4);
$objPHPExcel->getActiveSheet(3)->setTitle('Nominas');



//die();
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->setActiveSheetIndex(3);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename='.$nombre);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

