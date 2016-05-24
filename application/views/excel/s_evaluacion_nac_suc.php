<?php

error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
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
//*********************************************************************************************************titulo global


$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'EVALUACION DE SUCURSALES DEL MES DE '.$mesx.' DEL '.$aaa)
->mergeCells('A1:C1')->getStyle()->getFont()->setBold(true);
 $objPHPExcel->getActiveSheet(0)->getStyle('A1:M6')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'TOTAL DE GASTOS DE OFICINAS Y SUCURSALES CERRADAS')->mergeCells('A2:B2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'SOLO 40 %')->mergeCells('A3:B3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'NUMERO DE SUCURSALES')->mergeCells('A4:B4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A5', 'MONTO POR SUCURSAL')->mergeCells('A5:B5')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', $gasto);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', $gasto_40);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', $num);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C5', $monto);
$objPHPExcel->getActiveSheet(0)->getStyle('C2:C3')->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet(0)->getStyle('C5')->getNumberFormat()->setFormatCode('#,#00.00');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6', ' ');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B6', 'VENTA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6', 'COSTO VENTA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D6', 'RENTA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E6', 'NOMINA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F6', 'INSUMOS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G6', 'MERMA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H6', 'AGUA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I6', 'LUZ');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J6', 'TELEFONO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K6', 'OTROS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L6', '% UTILIDAD NETA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M6', '% UTIL. CON 40% GASTOS DE OFICINA');
$ini0=7;
$tventa0=0;$tcosto_venta0=0;$tutilidad0=0;$trenta0=0;$tnomina0=0;
$tinsumos0=0;$tdev0=0;$tagua0=0;$tluz0=0;$ttel0=0;$totros0=0;$trenta0=0;
$utilidad=0;$utilidad_40=0;
foreach($q0->result()as $r0)
{
if($r0->venta>0)
{
$utilidad=((($r0->venta-($r0->costo_venta+$r0->renta+$r0->nomina+$r0->insumos+$r0->dev+$r0->agua+$r0->luz+$r0->tel+$r0->otros))/$r0->venta)*100);
$utilidad_40=((($r0->venta-($r0->costo_venta+$r0->renta+$r0->nomina+$r0->insumos+$r0->dev+$r0->agua+$r0->luz+$r0->tel+$r0->otros+($monto*$r0->num)))/$r0->venta)*100);
}else{$utilidad=' ';}
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$ini0, $r0->motivo);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$ini0, $r0->venta);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$ini0, $r0->costo_venta);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$ini0, $r0->renta);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$ini0, $r0->nomina);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$ini0, $r0->insumos);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$ini0, $r0->dev);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$ini0, $r0->agua);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$ini0, $r0->luz);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$ini0, $r0->tel);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$ini0, $r0->otros);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$ini0, $utilidad);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$ini0, $utilidad_40);
$ini0=$ini0+1;
$utilidad=0;
$utilidad_40=0;
$tventa0=$tventa0+$r0->venta;
$tcosto_venta0=$tcosto_venta0+$r0->costo_venta;
$trenta0=$trenta0+$r0->renta;
$tnomina0=$tnomina0+$r0->nomina;
$tinsumos0=$tinsumos0+$r0->insumos;
$tdev0=$tdev0+$r0->dev;
$tagua0=$tagua0+$r0->agua;
$tluz0=$tluz0+$r0->luz;
$ttel0=$ttel0+$r0->tel;
$totros0=$totros0+$r0->otros;
}

$objPHPExcel->setActiveSheetIndex()->setCellValue('A'.$ini0, 'TOTAL');
$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$ini0, $tventa0);
$objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$ini0, $tcosto_venta0);
$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$ini0, $trenta0);
$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$ini0, $tnomina0);
$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$ini0, $tinsumos0);
$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$ini0, $tdev0);
$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$ini0, $tagua0);
$objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$ini0, $tluz0);
$objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$ini0, $ttel0);
$objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$ini0, $totros0);
$objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$ini0, ' ');
$objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$ini0, ' ');

$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setAutoSize(true);

$objPHPExcel->getActiveSheet(0)->getStyle('A1:'.'M'.$ini0)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);

$objPHPExcel->getActiveSheet(0)->getStyle('B7:'.'M'.$ini0)->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet(0)->getStyle('A'.$ini0.':Z'.$ini0)->getFill()->getStartColor()->setARGB('646363');

//*********************************************************************************************************titulo global
//*********************************************************************************************************titulo global
//*********************************************************************************************************titulo global
$sheetId = 1;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A1', 'EVALUACION POR SUCURSAL DOCTOR AHORRO DEL MES DE '.$mesx.' DEL '.$aaa)
            ->mergeCells('A1:G1')->getStyle()->getFont()->setBold(true);
 $objPHPExcel->getActiveSheet(1)->getStyle('A1:Y1')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
 
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A2', 'SUCURSALES CON MARGEN ARRIBA DEL 10%')->mergeCells('A2:C2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A3', 'SUCURSALES CON MARGEN DEL 0 AL 9.99 %')->mergeCells('A3:C3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A4', 'SUCURSALES CON MARGEN MENOR A 0%')->mergeCells('A4:C4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L2', 'GASTOS DE RENTA')->mergeCells('L2:M2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L3', 'GASTOS DE NOMINA')->mergeCells('L3:M3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L4', 'GASTOS DE INSUMOS')->mergeCells('L4:M4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('P2', 'GASTOS DE MERMA')->mergeCells('P2:R2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('P3', 'GASTOS DE AGUA')->mergeCells('P3:R3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('P4', 'GASTOS DE LUZ')->mergeCells('P2:R2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('U2', 'GASTOS DE TEL')->mergeCells('U2:V2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('U3', 'GASTOS DE OTROS')->mergeCells('U3:V3')->getStyle()->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A5', 'NID');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C5', 'VENTA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D5', 'COSTO VENTA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E5', '% COSTO VENTA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F5', 'GASTOS');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G5', '% GASTOS');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H5', '$ UTILIDAD');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I5', '% UTILIDAD');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J5', '$UTILIDAD CON 40% DE GASTOS DE OFICINAS');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K5', '% UTIL. CON 40% GASTOS DE OFICINA');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L5', 'NID');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('M5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('N5', 'RENTA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('o5', '% RENTA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('P5', 'NOMINA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Q5', 'IMPUESTOS NOMINA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('R5', '% NOMINA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('S5', 'INSUMOS');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('T5', 'DEVOLUCION');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('U5', 'AGUA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('V5', 'LUZ');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('W5', 'TEL');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('X5', 'OTROS');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Y5', '% GASTOS');

//*********************************************************************************************************titulo global
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
$objPHPExcel->setActiveSheetIndex(1);
$ini1=6;$bien1=0;$mal1=0;$grave1=0;$bienp1=0;$malp1=0;$gravep1=0;
$nom1=0;$ren1=0;$dev1=0;$ins1=0;$agu1=0;$luz1=0;$tel1=0;$otr1=0;
$tventa1=0;$tcosto_venta1=0;$tgastos1=0;$tutilidad1=0;$tnomina1=0;$tisr_nomina1=0;$tutilidado_1=0;
$tinsumos1=0;$tdev1=0;$tagua1=0;$tluz1=0;$ttel1=0;$totros1=0;$trenta1=0;
$tpor_costo_venta1=0;$tpor_gastos1=0;
$tpor_renta1=0;$tpor_nomina1=0;$tpor_gastoscon1=0;
$num_sucursal=0;$tpor_utilidad_por1=0;
foreach($q1->result()as $r1)
{
$num_sucursal=$num_sucursal+1;
if($r1->renta>0){$ren1=$ren1+1;}
if($r1->nomina>0){$nom1=$nom1+1;}
if($r1->insumos>0){$ins1=$ins1+1;}
if($r1->dev>0){$dev1=$dev1+1;}
if($r1->agua>0){$agu1=$agu1+1;}
if($r1->luz>0){$luz1=$luz1+1;}
if($r1->tel>0){$tel1=$tel1+1;}
if($r1->otros>0){$otr1=$otr1+1;}

            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$ini1, $r1->suc);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$ini1, $r1->sucx);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$ini1, $r1->venta);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D'.$ini1, $r1->costo_venta);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('E'.$ini1, $r1->por_costo_venta);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$ini1, $r1->gastos);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.$ini1, $r1->porg_gastos);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('H'.$ini1, $r1->utilidad);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('I'.$ini1, $r1->por_utilidad);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('J'.$ini1, ($r1->utilidad-$monto));
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('K'.$ini1, $r1->por_utilidad_pror);
            
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('L'.$ini1, $r1->suc);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('M'.$ini1, $r1->sucx);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('N'.$ini1, $r1->renta);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('O'.$ini1, $r1->por_renta);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('P'.$ini1, $r1->nomina);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('Q'.$ini1, $r1->isr_nomina);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('R'.$ini1, $r1->por_nomina);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('S'.$ini1, $r1->insumos);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('T'.$ini1, $r1->dev);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('U'.$ini1, $r1->agua);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('V'.$ini1, $r1->luz);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('W'.$ini1, $r1->tel);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('X'.$ini1, $r1->otros);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('Y'.$ini1, $r1->por_gastos);

if($r1->por_utilidad > '9.99'){
$objPHPExcel->getActiveSheet(1)->getStyle('A'.$ini1.':J'.$ini1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
$bien1=$bien1+1;
}
if($r1->por_utilidad >= 0 and $r1->por_utilidad <= '9.99'){

$objPHPExcel->getActiveSheet(1)->getStyle('A'.$ini1.':J'.$ini1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);    
$mal1=$mal1+1;
}
if($r1->por_utilidad < 0){
$objPHPExcel->getActiveSheet(1)->getStyle('A'.$ini1.':J'.$ini1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$grave1=$grave1+1;                                  
}
if($r1->por_utilidad_pror > '9.99'){
$objPHPExcel->getActiveSheet(1)->getStyle('J'.$ini1.':K'.$ini1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
$bienp1=$bienp1+1;
}
if($r1->por_utilidad_pror >= 0 and $r1->por_utilidad_pror <= '9.99'){

$objPHPExcel->getActiveSheet(1)->getStyle('J'.$ini1.':K'.$ini1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);    
$malp1=$malp1+1;
}
if($r1->por_utilidad_pror < 0){
$objPHPExcel->getActiveSheet(1)->getStyle('J'.$ini1.':K'.$ini1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$gravep1=$gravep1+1;                                  
}

$ini1=$ini1+1;
$tventa1=$tventa1+$r1->venta;
$tcosto_venta1=$tcosto_venta1+$r1->costo_venta;
$tgastos1=$tgastos1+$r1->gastos;
$tutilidad1=$tutilidad1+$r1->utilidad;
$tutilidado_1=$tutilidado_1+($r1->utilidad-$monto);
$trenta1=$trenta1+$r1->renta;
$tnomina1=$tnomina1+$r1->nomina;
$tisr_nomina1=$tisr_nomina1+$r1->isr_nomina;
$tinsumos1=$tinsumos1+$r1->insumos;
$tdev1=$tdev1+$r1->dev;
$tagua1=$tagua1+$r1->agua;
$tluz1=$tluz1+$r1->luz;
$ttel1=$ttel1+$r1->tel;
$totros1=$totros1+$r1->otros;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
///////////////////////////////////////////////////////////////////////////////////////////////////////////TOTAL PORCENTUAL

$tpor_costo_venta1=(($tcosto_venta1/$tventa1)*100);
$tpor_gastos1=(($tgastos1/$tventa1)*100);
$tpor_utilidad1=(($tutilidad1/$tventa1)*100);

$tpor_utilidad_por1=((($tutilidad1-($monto*$num_sucursal))/$tventa1)*100);

$tpor_renta1=((($trenta1)/$tventa1)*100);
$tpor_nomina1=((($tnomina1+$tisr_nomina1)/$tventa1)*100);
$tpor_gastoscon1=((($tinsumos1+$tdev1+$tagua1+$tluz1+$ttel1+$totros1)/$tventa1)*100);

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I2', $bien1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I3', $mal1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I4', $grave1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J2', $bienp1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J3', $malp1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J4', $gravep1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('N2', $ren1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('N3', $nom1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('N4', $ins1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('S2', $dev1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('S3', $agu1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('S4', $luz1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('W2', $tel1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('W3', $otr1);
//////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->getStyle('C5:'.'K'.$ini1)->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet()->getStyle('M5:'.'Y'.$ini1)->getNumberFormat()->setFormatCode('#,#00.00');
            
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
$objPHPExcel->getActiveSheet(1)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('Q')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('R')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('S')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('T')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('V')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('W')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('X')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('Y')->setAutoSize(true);

$objPHPExcel->getActiveSheet(1)->getStyle('A2:E2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
$objPHPExcel->getActiveSheet(1)->getStyle('A3:E3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);
$objPHPExcel->getActiveSheet(1)->getStyle('A4:E4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$objPHPExcel->getActiveSheet(1)->getStyle('L2:W4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

$objPHPExcel->getActiveSheet(1)->getStyle('A2:'.'Y'.$ini1)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
//die();
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$ini1, 'TOTAL SUCURSALES '.$num_sucursal);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$ini1, $tventa1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D'.$ini1, $tcosto_venta1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E'.$ini1, $tpor_costo_venta1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$ini1, $tgastos1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.$ini1, $tpor_gastos1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H'.$ini1, $tutilidad1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I'.$ini1, $tpor_utilidad1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J'.$ini1, $tutilidado_1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K'.$ini1, $tpor_utilidad_por1);

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('M'.$ini1, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('N'.$ini1, $trenta1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('O'.$ini1, $tpor_renta1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('P'.$ini1, $tnomina1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Q'.$ini1, $tisr_nomina1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('R'.$ini1, $tpor_nomina1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('S'.$ini1, $tinsumos1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('T'.$ini1, $tdev1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('U'.$ini1, $tagua1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('V'.$ini1, $tluz1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('W'.$ini1, $ttel1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('X'.$ini1, $totros1);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Y'.$ini1, $tpor_gastoscon1);

$objPHPExcel->getActiveSheet(1)->getStyle('A'.$ini1.':Y'.$ini1)->getFill()->getStartColor()->setARGB('646363');
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//*********************************************************************************************************titulo global
//*********************************************************************************************************titulo global
$sheetId = 2;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A1', 'EVALUACION POR SUCURSAL FENIX DEL MES DE '.$mesx.' DEL '.$aaa)
            ->mergeCells('A1:G1')->getStyle()->getFont()->setBold(true);
 $objPHPExcel->getActiveSheet(2)->getStyle('A1:Y1')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A2', 'SUCURSALES CON MARGEN ARRIBA DEL 20%')->mergeCells('A2:C2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A3', 'SUCURSALES CON MARGEN DEL 0 AL 9.99 %')->mergeCells('A3:C3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A4', 'SUCURSALES CON MARGEN MENOR A 0%')->mergeCells('A4:C4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('L2', 'GASTOS DE RENTA')->mergeCells('L2:M2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('L3', 'GASTOS DE NOMINA')->mergeCells('L3:M3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('L4', 'GASTOS DE INSUMOS')->mergeCells('L4:M4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('P2', 'GASTOS DE MERMA')->mergeCells('P2:R2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('P3', 'GASTOS DE AGUA')->mergeCells('P3:R3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('P4', 'GASTOS DE LUZ')->mergeCells('P2:R2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('U2', 'GASTOS DE TEL')->mergeCells('U2:V2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('U3', 'GASTOS DE OTROS')->mergeCells('U3:V3')->getStyle()->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A5', 'NID');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('B5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('C5', 'VENTA');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('D5', 'COSTO VENTA');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('E5', '% COSTO VENTA');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('F5', 'GASTOS');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('G5', '% GASTOS');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('H5', 'UTILIDAD');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('I5', '% UTILIDAD');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('J5', '$UTILIDAD CON 40% DE GASTOS DE OFICINAS');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('K5', '% UTIL. CON 40% GASTOS DE OFICINA');


$objPHPExcel->setActiveSheetIndex(2)->setCellValue('L5', 'NID');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('M5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('N5', 'RENTA');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('o5', '% RENTA');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('P5', 'NOMINA');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('Q5', 'IMPUESTOS NOMINA');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('R5', '% NOMINA');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('S5', 'INSUMOS');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('T5', 'DEVOLUCION');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('U5', 'AGUA');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('V5', 'LUZ');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('W5', 'TEL');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('X5', 'OTROS');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('Y5', '% GASTOS');

//*********************************************************************************************************titulo global
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
$objPHPExcel->setActiveSheetIndex(2);
$ini2=6;$bien2=0;$mal2=0;$grave2=0;$bienp2=0;$malp2=0;$gravep2=0;
$nom2=0;$ren2=0;$dev2=0;$ins2=0;$agu2=0;$luz2=0;$tel2=0;$otr2=0;
$tventa2=0;$tcosto_venta2=0;$tgastos2=0;$tutilidad2=0;$tnomina2=0;$tisr_nomina2=0;$tutilidado_2=0;
$tinsumos2=0;$tdev2=0;$tagua2=0;$tluz2=0;$ttel2=0;$totros2=0;$trenta2=0;
$tpor_costo_venta2=0;$tpor_gastos2=0;
$tpor_renta2=0;$tpor_nomina2=0;$tpor_gastoscon2=0;
$num_sucursal=0;$tpor_utilidad_por2=0;
foreach($q2->result()as $r2)
{
$num_sucursal=$num_sucursal+1;
if($r2->renta>0){$ren2=$ren2+1;}
if($r2->nomina>0){$nom2=$nom2+1;}
if($r2->insumos>0){$ins2=$ins2+1;}
if($r2->dev>0){$dev2=$dev2+1;}
if($r2->agua>0){$agu2=$agu2+1;}
if($r2->luz>0){$luz2=$luz2+1;}
if($r2->tel>0){$tel2=$tel2+1;}
if($r2->otros>0){$otr2=$otr2+1;}

            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('A'.$ini2, $r2->suc);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('B'.$ini2, $r2->sucx);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('C'.$ini2, $r2->venta);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('D'.$ini2, $r2->costo_venta);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('E'.$ini2, $r2->por_costo_venta);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('F'.$ini2, $r2->gastos);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('G'.$ini2, $r2->porg_gastos);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('H'.$ini2, $r2->utilidad);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('I'.$ini2, $r2->por_utilidad);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('J'.$ini2, ($r2->utilidad-$monto));
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('K'.$ini2, $r2->por_utilidad_pror);
            
            
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('L'.$ini2, $r2->suc);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('M'.$ini2, $r2->sucx);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('N'.$ini2, $r2->renta);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('O'.$ini2, $r2->por_renta);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('P'.$ini2, $r2->nomina);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('Q'.$ini2, $r2->isr_nomina);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('R'.$ini2, $r2->por_nomina);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('S'.$ini2, $r2->insumos);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('T'.$ini2, $r2->dev);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('U'.$ini2, $r2->agua);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('V'.$ini2, $r2->luz);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('W'.$ini2, $r2->tel);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('X'.$ini2, $r2->otros);
            $objPHPExcel->setActiveSheetIndex(2)->setCellValue('Y'.$ini2, $r2->por_gastos);

if($r2->por_utilidad > '9.99'){
$objPHPExcel->getActiveSheet(2)->getStyle('A'.$ini2.':J'.$ini2)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
$bien2=$bien2+1;
}
if($r2->por_utilidad >= 0 and $r2->por_utilidad <= '9.99'){

$objPHPExcel->getActiveSheet(2)->getStyle('A'.$ini2.':J'.$ini2)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);    
$mal2=$mal2+1;
}
if($r2->por_utilidad < 0){
$objPHPExcel->getActiveSheet(2)->getStyle('A'.$ini2.':J'.$ini2)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$grave2=$grave2+1;                                  
}
if($r2->por_utilidad_pror > '9.99'){
$objPHPExcel->getActiveSheet(2)->getStyle('J'.$ini2.':K'.$ini2)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
$bienp2=$bienp2+1;
}
if($r2->por_utilidad_pror >= 0 and $r2->por_utilidad_pror <= '9.99'){

$objPHPExcel->getActiveSheet(2)->getStyle('J'.$ini2.':K'.$ini2)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);    
$malp2=$malp2+1;
}
if($r2->por_utilidad_pror < 0){
$objPHPExcel->getActiveSheet(2)->getStyle('J'.$ini2.':K'.$ini2)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$gravep2=$gravep2+1;                                  
}

$ini2=$ini2+1;
$tventa2=$tventa2+$r2->venta;
$tcosto_venta2=$tcosto_venta2+$r2->costo_venta;
$tgastos2=$tgastos2+$r2->gastos;
$tutilidad2=$tutilidad2+$r2->utilidad;
$tutilidado_2=$tutilidado_2+($r2->utilidad-$monto);
$trenta2=$trenta2+$r2->renta;
$tnomina2=$tnomina2+$r2->nomina;
$tisr_nomina2=$tisr_nomina2+$r2->isr_nomina;
$tinsumos2=$tinsumos2+$r2->insumos;
$tdev2=$tdev2+$r2->dev;
$tagua2=$tagua2+$r2->agua;
$tluz2=$tluz2+$r2->luz;
$ttel2=$ttel2+$r2->tel;
$totros2=$totros2+$r2->otros;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
///////////////////////////////////////////////////////////////////////////////////////////////////////////TOTAL PORCENTUAL

$tpor_costo_venta2=(($tcosto_venta2/$tventa2)*200);
$tpor_gastos2=(($tgastos2/$tventa2)*200);
$tpor_utilidad2=(($tutilidad2/$tventa2)*200);

$tpor_utilidad_por2=((($tutilidad2-($monto*$num_sucursal))/$tventa2)*200);

$tpor_renta2=((($trenta2)/$tventa2)*200);
$tpor_nomina2=((($tnomina2+$tisr_nomina2)/$tventa2)*200);
$tpor_gastoscon2=((($tinsumos2+$tdev2+$tagua2+$tluz2+$ttel2+$totros2)/$tventa2)*200);

$objPHPExcel->setActiveSheetIndex(2)->setCellValue('I2', $bien2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('I3', $mal2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('I4', $grave2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('J2', $bienp2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('J3', $malp2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('J4', $gravep2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('N2', $ren2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('N3', $nom2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('N4', $ins2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('S2', $dev2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('S3', $agu2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('S4', $luz2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('W2', $tel2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('W3', $otr2);
//////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->getStyle('C5:'.'K'.$ini2)->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet()->getStyle('M5:'.'Y'.$ini2)->getNumberFormat()->setFormatCode('#,#00.00');
            
$objPHPExcel->getActiveSheet(2)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('Q')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('R')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('S')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('T')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('V')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('W')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('X')->setAutoSize(true);
$objPHPExcel->getActiveSheet(2)->getColumnDimension('Y')->setAutoSize(true);

$objPHPExcel->getActiveSheet(2)->getStyle('A2:E2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
$objPHPExcel->getActiveSheet(2)->getStyle('A3:E3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);
$objPHPExcel->getActiveSheet(2)->getStyle('A4:E4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$objPHPExcel->getActiveSheet(2)->getStyle('L2:W4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

$objPHPExcel->getActiveSheet(2)->getStyle('A2:'.'Y'.$ini2)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);

//die();
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('B'.$ini2, 'TOTAL SUCURSALES '.$num_sucursal);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('C'.$ini2, $tventa2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('D'.$ini2, $tcosto_venta2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('E'.$ini2, $tpor_costo_venta2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('F'.$ini2, $tgastos2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('G'.$ini2, $tpor_gastos2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('H'.$ini2, $tutilidad2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('I'.$ini2, $tpor_utilidad2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('J'.$ini2, $tutilidado_2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('K'.$ini2, $tpor_utilidad_por2);

$objPHPExcel->setActiveSheetIndex(2)->setCellValue('M'.$ini2, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('N'.$ini2, $trenta2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('O'.$ini2, $tpor_renta2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('P'.$ini2, $tnomina2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('Q'.$ini2, $tisr_nomina2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('R'.$ini2, $tpor_nomina2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('S'.$ini2, $tinsumos2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('T'.$ini2, $tdev2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('U'.$ini2, $tagua2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('V'.$ini2, $tluz2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('W'.$ini2, $ttel2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('X'.$ini2, $totros2);
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('Y'.$ini2, $tpor_gastoscon2);

$objPHPExcel->getActiveSheet(2)->getStyle('A'.$ini2.':Y'.$ini2)->getFill()->getStartColor()->setARGB('646363');
 
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//*********************************************************************************************************titulo global
//*********************************************************************************************************titulo global
$sheetId = 3;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A1', 'EVALUACION POR SUCURSAL FARMABODEGA')
            ->mergeCells('A1:G1')->getStyle()->getFont()->setBold(true);
 $objPHPExcel->getActiveSheet(3)->getStyle('A1:Y1')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A2', 'SUCURSALES CON MARGEN ARRIBA DEL 30%')->mergeCells('A2:C2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A3', 'SUCURSALES CON MARGEN DEL 0 AL 9.99 %')->mergeCells('A3:C3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A4', 'SUCURSALES CON MARGEN MENOR A 0%')->mergeCells('A4:C4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('L2', 'GASTOS DE RENTA')->mergeCells('L2:M2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('L3', 'GASTOS DE NOMINA')->mergeCells('L3:M3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('L4', 'GASTOS DE INSUMOS')->mergeCells('L4:M4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('P2', 'GASTOS DE MERMA')->mergeCells('P2:R2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('P3', 'GASTOS DE AGUA')->mergeCells('P3:R3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('P4', 'GASTOS DE LUZ')->mergeCells('P2:R2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('U2', 'GASTOS DE TEL')->mergeCells('U2:V2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('U3', 'GASTOS DE OTROS')->mergeCells('U3:V3')->getStyle()->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A5', 'NID');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('B5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('C5', 'VENTA');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('D5', 'COSTO VENTA');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('E5', '% COSTO VENTA');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('F5', 'GASTOS');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('G5', '% GASTOS');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('H5', 'UTILIDAD');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('I5', '% UTILIDAD');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('J5', '$UTILIDAD CON 40% DE GASTOS DE OFICINAS');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('K5', '% UTIL. CON 40% GASTOS DE OFICINA');


$objPHPExcel->setActiveSheetIndex(3)->setCellValue('L5', 'NID');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('M5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('N5', 'RENTA');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('o5', '% RENTA');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('P5', 'NOMINA');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('Q5', 'IMPUESTOS NOMINA');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('R5', '% NOMINA');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('S5', 'INSUMOS');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('T5', 'DEVOLUCION');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('U5', 'AGUA');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('V5', 'LUZ');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('W5', 'TEL');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('X5', 'OTROS');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('Y5', '% GASTOS');

//*********************************************************************************************************titulo global
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
$objPHPExcel->setActiveSheetIndex(3);
$ini3=6;$bien3=0;$mal3=0;$grave3=0;$bienp3=0;$malp3=0;$gravep3=0;
$nom3=0;$ren3=0;$dev3=0;$ins3=0;$agu3=0;$luz3=0;$tel3=0;$otr3=0;
$tventa3=0;$tcosto_venta3=0;$tgastos3=0;$tutilidad3=0;$tnomina3=0;$tisr_nomina3=0;$tutilidado_3=0;
$tinsumos3=0;$tdev3=0;$tagua3=0;$tluz3=0;$ttel3=0;$totros3=0;$trenta3=0;
$tpor_costo_venta3=0;$tpor_gastos3=0;
$tpor_renta3=0;$tpor_nomina3=0;$tpor_gastoscon3=0;
$num_sucursal=0;$tpor_utilidad_por3=0;
foreach($q3->result()as $r3)
{
$num_sucursal=$num_sucursal+1;
if($r3->renta>0){$ren3=$ren3+1;}
if($r3->nomina>0){$nom3=$nom3+1;}
if($r3->insumos>0){$ins3=$ins3+1;}
if($r3->dev>0){$dev3=$dev3+1;}
if($r3->agua>0){$agu3=$agu3+1;}
if($r3->luz>0){$luz3=$luz3+1;}
if($r3->tel>0){$tel3=$tel3+1;}
if($r3->otros>0){$otr3=$otr3+1;}

            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('A'.$ini3, $r3->suc);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('B'.$ini3, $r3->sucx);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('C'.$ini3, $r3->venta);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('D'.$ini3, $r3->costo_venta);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('E'.$ini3, $r3->por_costo_venta);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('F'.$ini3, $r3->gastos);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('G'.$ini3, $r3->porg_gastos);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('H'.$ini3, $r3->utilidad);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('I'.$ini3, $r3->por_utilidad);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('J'.$ini3, ($r3->utilidad-$monto));
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('K'.$ini3, $r3->por_utilidad_pror);
            
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('L'.$ini3, $r3->suc);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('M'.$ini3, $r3->sucx);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('N'.$ini3, $r3->renta);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('O'.$ini3, $r3->por_renta);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('P'.$ini3, $r3->nomina);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('Q'.$ini3, $r3->isr_nomina);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('R'.$ini3, $r3->por_nomina);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('S'.$ini3, $r3->insumos);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('T'.$ini3, $r3->dev);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('U'.$ini3, $r3->agua);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('V'.$ini3, $r3->luz);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('W'.$ini3, $r3->tel);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('X'.$ini3, $r3->otros);
            $objPHPExcel->setActiveSheetIndex(3)->setCellValue('Y'.$ini3, $r3->por_gastos);

if($r3->por_utilidad > '9.99'){
$objPHPExcel->getActiveSheet(3)->getStyle('A'.$ini3.':J'.$ini3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
$bien3=$bien3+1;
}
if($r3->por_utilidad >= 0 and $r3->por_utilidad <= '9.99'){

$objPHPExcel->getActiveSheet(3)->getStyle('A'.$ini3.':J'.$ini3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);    
$mal3=$mal3+1;
}
if($r3->por_utilidad < 0){
$objPHPExcel->getActiveSheet(3)->getStyle('A'.$ini3.':J'.$ini3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$grave3=$grave3+1;                                  
}
if($r3->por_utilidad_pror > '9.99'){
$objPHPExcel->getActiveSheet(3)->getStyle('J'.$ini3.':K'.$ini3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
$bienp3=$bienp3+1;
}
if($r3->por_utilidad_pror >= 0 and $r3->por_utilidad_pror <= '9.99'){

$objPHPExcel->getActiveSheet(3)->getStyle('J'.$ini3.':K'.$ini3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);    
$malp3=$malp3+1;
}
if($r3->por_utilidad_pror < 0){
$objPHPExcel->getActiveSheet(3)->getStyle('J'.$ini3.':K'.$ini3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$gravep3=$gravep3+1;                                  
}

$ini3=$ini3+1;
$tventa3=$tventa3+$r3->venta;
$tcosto_venta3=$tcosto_venta3+$r3->costo_venta;
$tgastos3=$tgastos3+$r3->gastos;
$tutilidad3=$tutilidad3+$r3->utilidad;
$tutilidado_3=$tutilidado_3+($r3->utilidad-$monto);
$trenta3=$trenta3+$r3->renta;
$tnomina3=$tnomina3+$r3->nomina;
$tisr_nomina3=$tisr_nomina3+$r3->isr_nomina;
$tinsumos3=$tinsumos3+$r3->insumos;
$tdev3=$tdev3+$r3->dev;
$tagua3=$tagua3+$r3->agua;
$tluz3=$tluz3+$r3->luz;
$ttel3=$ttel3+$r3->tel;
$totros3=$totros3+$r3->otros;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
///////////////////////////////////////////////////////////////////////////////////////////////////////////TOTAL PORCENTUAL

$tpor_costo_venta3=(($tcosto_venta3/$tventa3)*300);
$tpor_gastos3=(($tgastos3/$tventa3)*300);
$tpor_utilidad3=(($tutilidad3/$tventa3)*300);

$tpor_utilidad_por3=((($tutilidad3-($monto*$num_sucursal))/$tventa3)*300);

$tpor_renta3=((($trenta3)/$tventa3)*300);
$tpor_nomina3=((($tnomina3+$tisr_nomina3)/$tventa3)*300);
$tpor_gastoscon3=((($tinsumos3+$tdev3+$tagua3+$tluz3+$ttel3+$totros3)/$tventa3)*300);

$objPHPExcel->setActiveSheetIndex(3)->setCellValue('I2', $bien3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('I3', $mal3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('I4', $grave3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('J2', $bienp3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('J3', $malp3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('J4', $gravep3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('N2', $ren3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('N3', $nom3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('N4', $ins3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('S2', $dev3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('S3', $agu3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('S4', $luz3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('W2', $tel3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('W3', $otr3);
//////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet()->getStyle('C5:'.'K'.$ini3)->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet()->getStyle('M5:'.'Y'.$ini3)->getNumberFormat()->setFormatCode('#,#00.00');
            
$objPHPExcel->getActiveSheet(3)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('Q')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('R')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('S')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('T')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('V')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('W')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('X')->setAutoSize(true);
$objPHPExcel->getActiveSheet(3)->getColumnDimension('Y')->setAutoSize(true);

$objPHPExcel->getActiveSheet(3)->getStyle('A2:E2')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
$objPHPExcel->getActiveSheet(3)->getStyle('A3:E3')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);
$objPHPExcel->getActiveSheet(3)->getStyle('A4:E4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$objPHPExcel->getActiveSheet(3)->getStyle('L2:W4')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

$objPHPExcel->getActiveSheet(3)->getStyle('A2:'.'Y'.$ini3)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);

//die();
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('B'.$ini3, 'TOTAL SUCURSALES '.$num_sucursal);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('C'.$ini3, $tventa3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('D'.$ini3, $tcosto_venta3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('E'.$ini3, $tpor_costo_venta3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('F'.$ini3, $tgastos3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('G'.$ini3, $tpor_gastos3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('H'.$ini3, $tutilidad3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('I'.$ini3, $tpor_utilidad3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('J'.$ini3, $tutilidado_1);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('K'.$ini3, $tpor_utilidad_por3);

$objPHPExcel->setActiveSheetIndex(3)->setCellValue('M'.$ini3, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('N'.$ini3, $trenta3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('O'.$ini3, $tpor_renta3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('P'.$ini3, $tnomina3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('Q'.$ini3, $tisr_nomina3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('R'.$ini3, $tpor_nomina3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('S'.$ini3, $tinsumos3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('T'.$ini3, $tdev3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('U'.$ini3, $tagua3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('V'.$ini3, $tluz3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('W'.$ini3, $ttel3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('X'.$ini3, $totros3);
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('Y'.$ini3, $tpor_gastoscon3);

$objPHPExcel->getActiveSheet(3)->getStyle('A'.$ini3.':Y'.$ini3)->getFill()->getStartColor()->setARGB('646363');

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//*********************************************************************************************************titulo global
//*********************************************************************************************************titulo global
$sheetId = 4;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('A1', 'SUCURSALES CERRADAS O MAL ASIGNADAS DEL MES DE '.$mesx.' DEL '.$aaa)
            ->mergeCells('A1:K1')->getStyle()->getFont()->setBold(true);
 $objPHPExcel->getActiveSheet(4)->getStyle('A1:P4')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
 
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('E2', 'GASTOS DE RENTA')->mergeCells('E2:F2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('E3', 'GASTOS DE NOMINA')->mergeCells('E3:F3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('E4', 'GASTOS DE INSUMOS')->mergeCells('E4:F4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('I2', 'GASTOS DE MERMA')->mergeCells('I2:J2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('I3', 'GASTOS DE AGUA')->mergeCells('I3:J3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('I4', 'GASTOS DE LUZ')->mergeCells('I4:J4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('M2', 'GASTOS DE TEL')->mergeCells('M2:N2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('M3', 'GASTOS DE OTROS')->mergeCells('M3:N3')->getStyle()->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(4)->setCellValue('A5', 'NID');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('B5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('C5', 'GASTOS');


$objPHPExcel->setActiveSheetIndex(4)->setCellValue('E5', 'NID');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('F5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('G5', 'RENTA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('H5', 'NOMINA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('I5', 'IMPUESTOS NOMINA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('J5', 'INSUMOS');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('K5', 'DEVOLUCION');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('L5', 'AGUA');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('M5', 'LUZ');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('N5', 'TEL');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('O5', 'OTROS');


/////////////////////////////////////////////////////////////////////////
//*********************************************************************************************************titulo global
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
$objPHPExcel->setActiveSheetIndex(4);
$ini4=6;$bien4=0;$mal4=0;$grave4=0;$nom4=0;$ren4=0;$dev4=0;$ins4=0;$agu4=0;$luz4=0;$tel4=0;$otr4=0;
$tventa4=0;$tcosto_venta4=0;$tgastos4=0;$tutilidad4=0;$tnomina4=0;$tisr_nomina4=0;
$tinsumos4=0;$tdev4=0;$tagua4=0;$tluz4=0;$ttel4=0;$totros4=0;$trenta4=0;
$tpor_costo_venta4=0;$tpor_gastos4=0;
foreach($q4->result()as $r4)
{
if($r4->renta>0){$ren4=$ren4+1;}
if($r4->nomina>0){$nom4=$nom4+1;}
if($r4->insumos>0){$ins4=$ins4+1;}
if($r4->dev>0){$dev4=$dev4+1;}
if($r4->agua>0){$agu4=$agu4+1;}
if($r4->luz>0){$luz4=$luz4+1;}
if($r4->tel>0){$tel4=$tel4+1;}
if($r4->otros>0){$otr4=$otr4+1;}

            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('A'.$ini4, $r4->suc);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('B'.$ini4, $r4->sucx);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('C'.$ini4, $r4->gastos);
            
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('E'.$ini4, $r4->suc);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('F'.$ini4, $r4->sucx);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('G'.$ini4, $r4->renta);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('H'.$ini4, $r4->nomina);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('I'.$ini4, $r4->isr_nomina);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('J'.$ini4, $r4->insumos);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('K'.$ini4, $r4->dev);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('L'.$ini4, $r4->agua);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('M'.$ini4, $r4->luz);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('N'.$ini4, $r4->tel);
            $objPHPExcel->setActiveSheetIndex(4)->setCellValue('O'.$ini4, $r4->otros);
            
            

if($r4->por_utilidad > '9.99'){
$objPHPExcel->getActiveSheet(4)->getStyle('A'.$ini4.':C'.$ini4)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN4);
$bien4=$bien4+1;
}
if($r4->por_utilidad >= 0 and $r4->por_utilidad <= '9.99'){

$objPHPExcel->getActiveSheet(4)->getStyle('A'.$ini4.':C'.$ini4)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);    
$mal4=$mal4+1;
}
if($r4->por_utilidad < 0){
$objPHPExcel->getActiveSheet(4)->getStyle('A'.$ini4.':C'.$ini4)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$grave4=$grave4+1;                                  
}
$ini4=$ini4+1;
$tgastos4=$tgastos4+$r4->gastos;
$trenta4=$trenta4+$r4->renta;

$tnomina4=$tnomina4+$r4->nomina;
$tisr_nomina4=$tisr_nomina4+$r4->isr_nomina;
$tinsumos4=$tinsumos4+$r4->insumos;
$tdev4=$tdev4+$r4->dev;
$tagua4=$tagua4+$r4->agua;
$tluz4=$tluz4+$r4->luz;
$ttel4=$ttel4+$r4->tel;
$totros4=$totros4+$r4->otros;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
///////////////////////////////////////////////////////////////////////////////////////////////////////////TOTAL PORCENTUAL

$objPHPExcel->setActiveSheetIndex(4)->setCellValue('G2', $ren4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('G3', $nom4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('G4', $ins4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('K2', $dev4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('K3', $agu4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('K4', $luz4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('O2', $tel4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('O3', $otr4);
//////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(4);
$objPHPExcel->getActiveSheet()->getStyle('C5:'.'C'.$ini4)->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet()->getStyle('G5:'.'P'.$ini4)->getNumberFormat()->setFormatCode('#,#00.00');
            
$objPHPExcel->getActiveSheet(4)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet(4)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet(4)->getColumnDimension('C')->setAutoSize(true);

$objPHPExcel->getActiveSheet(4)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet(4)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet(4)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet(4)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet(4)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet(4)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet(4)->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet(4)->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet(4)->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet(4)->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet(4)->getColumnDimension('P')->setAutoSize(true);

$objPHPExcel->getActiveSheet(4)->getStyle('A2:'.'C'.$ini4)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
$objPHPExcel->getActiveSheet(4)->getStyle('E2:'.'O'.$ini4)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);

//die();
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('B'.$ini4, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('C'.$ini4, $tgastos4);

$objPHPExcel->setActiveSheetIndex(4)->setCellValue('F'.$ini4, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('G'.$ini4, $trenta4);

$objPHPExcel->setActiveSheetIndex(4)->setCellValue('H'.$ini4, $tnomina4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('I'.$ini4, $tisr_nomina4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('J'.$ini4, $tinsumos4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('K'.$ini4, $tdev4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('L'.$ini4, $tagua4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('M'.$ini4, $tluz4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('N'.$ini4, $ttel4);
$objPHPExcel->setActiveSheetIndex(4)->setCellValue('O'.$ini4, $totros4);

$objPHPExcel->getActiveSheet(4)->getStyle('A'.$ini4.':O'.$ini4)->getFill()->getStartColor()->setARGB('646363');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sheetId = 5;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('A1', 'OFICINAS DEL MES DE '.$mesx.' DEL '.$aaa)
            ->mergeCells('A1:K1')->getStyle()->getFont()->setBold(true);
 $objPHPExcel->getActiveSheet(5)->getStyle('A1:P4')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
 
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('E2', 'GASTOS DE RENTA')->mergeCells('E2:F2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('E3', 'GASTOS DE NOMINA')->mergeCells('E3:F3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('E4', 'GASTOS DE INSUMOS')->mergeCells('E4:F4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('I2', 'GASTOS DE MERMA')->mergeCells('I2:J2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('I3', 'GASTOS DE AGUA')->mergeCells('I3:J3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('I4', 'GASTOS DE LUZ')->mergeCells('I4:J4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('M2', 'GASTOS DE TEL')->mergeCells('M2:N2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('M3', 'GASTOS DE OTROS')->mergeCells('M3:N3')->getStyle()->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(5)->setCellValue('A5', 'NID');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('B5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('C5', 'GASTOS');


$objPHPExcel->setActiveSheetIndex(5)->setCellValue('E5', 'NID');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('F5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('G5', 'RENTA');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('H5', 'NOMINA');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('I5', 'IMPUESTOS NOMINA');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('J5', 'INSUMOS');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('K5', 'DEVOLUCION');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('L5', 'AGUA');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('M5', 'LUZ');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('N5', 'TEL');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('O5', 'OTROS');

//*********************************************************************************************************titulo global
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
$objPHPExcel->setActiveSheetIndex(5);
$ini5=6;$bien5=0;$mal5=0;$grave5=0;$nom5=0;$ren5=0;$dev5=0;$ins5=0;$agu5=0;$luz5=0;$tel5=0;$otr5=0;
$tventa5=0;$tcosto_venta5=0;$tgastos5=0;$tutilidad5=0;$tnomina5=0;$tisr_nomina5=0;
$tinsumos5=0;$tdev5=0;$tagua5=0;$tluz5=0;$ttel5=0;$totros5=0;$trenta5=0;
$tpor_costo_venta5=0;$tpor_gastos5=0;
foreach($q5->result()as $r5)
{
if($r5->renta>0){$ren5=$ren5+1;}
if($r5->nomina>0){$nom5=$nom5+1;}
if($r5->insumos>0){$ins5=$ins5+1;}
if($r5->dev>0){$dev5=$dev5+1;}
if($r5->agua>0){$agu5=$agu5+1;}
if($r5->luz>0){$luz5=$luz5+1;}
if($r5->tel>0){$tel5=$tel5+1;}
if($r5->otros>0){$otr5=$otr5+1;}

            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('A'.$ini5, $r5->suc);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('B'.$ini5, $r5->sucx);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('C'.$ini5, $r5->gastos);
            
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('E'.$ini5, $r5->suc);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('F'.$ini5, $r5->sucx);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('G'.$ini5, $r5->renta);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('H'.$ini5, $r5->nomina);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('I'.$ini5, $r5->isr_nomina);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('J'.$ini5, $r5->insumos);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('K'.$ini5, $r5->dev);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('L'.$ini5, $r5->agua);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('M'.$ini5, $r5->luz);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('N'.$ini5, $r5->tel);
            $objPHPExcel->setActiveSheetIndex(5)->setCellValue('O'.$ini5, $r5->otros);
            
            

if($r5->por_utilidad > '9.99'){
$objPHPExcel->getActiveSheet(5)->getStyle('A'.$ini5.':C'.$ini5)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN5);
$bien5=$bien5+1;
}
if($r5->por_utilidad >= 0 and $r5->por_utilidad <= '9.99'){

$objPHPExcel->getActiveSheet(5)->getStyle('A'.$ini5.':C'.$ini5)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);    
$mal5=$mal5+1;
}
if($r5->por_utilidad < 0){
$objPHPExcel->getActiveSheet(5)->getStyle('A'.$ini5.':C'.$ini5)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$grave5=$grave5+1;                                  
}
$ini5=$ini5+1;
$tgastos5=$tgastos5+$r5->gastos;
$trenta5=$trenta5+$r5->renta;

$tnomina5=$tnomina5+$r5->nomina;
$tisr_nomina5=$tisr_nomina5+$r5->isr_nomina;
$tinsumos5=$tinsumos5+$r5->insumos;
$tdev5=$tdev5+$r5->dev;
$tagua5=$tagua5+$r5->agua;
$tluz5=$tluz5+$r5->luz;
$ttel5=$ttel5+$r5->tel;
$totros5=$totros5+$r5->otros;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
///////////////////////////////////////////////////////////////////////////////////////////////////////////TOTAL PORCENTUAL

$objPHPExcel->setActiveSheetIndex(5)->setCellValue('G2', $ren5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('G3', $nom5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('G4', $ins5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('K2', $dev5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('K3', $agu5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('K4', $luz5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('O2', $tel5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('O3', $otr5);
//////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(5);
$objPHPExcel->getActiveSheet()->getStyle('C5:'.'C'.$ini5)->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet()->getStyle('G5:'.'P'.$ini5)->getNumberFormat()->setFormatCode('#,#00.00');
            
$objPHPExcel->getActiveSheet(5)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet(5)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet(5)->getColumnDimension('C')->setAutoSize(true);

$objPHPExcel->getActiveSheet(5)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet(5)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet(5)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet(5)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet(5)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet(5)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet(5)->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet(5)->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet(5)->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet(5)->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet(5)->getColumnDimension('P')->setAutoSize(true);

$objPHPExcel->getActiveSheet(5)->getStyle('A2:'.'C'.$ini5)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
$objPHPExcel->getActiveSheet(5)->getStyle('E2:'.'O'.$ini5)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);

//die();
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('B'.$ini5, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('C'.$ini5, $tgastos5);

$objPHPExcel->setActiveSheetIndex(5)->setCellValue('F'.$ini5, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('G'.$ini5, $trenta5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('H'.$ini5, $tnomina5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('I'.$ini5, $tisr_nomina5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('J'.$ini5, $tinsumos5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('K'.$ini5, $tdev5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('L'.$ini5, $tagua5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('M'.$ini5, $tluz5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('N'.$ini5, $ttel5);
$objPHPExcel->setActiveSheetIndex(5)->setCellValue('O'.$ini5, $totros5);

$objPHPExcel->getActiveSheet(5)->getStyle('A'.$ini5.':P'.$ini5)->getFill()->getStartColor()->setARGB('656363');
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//*********************************************************************************************************titulo global
//*********************************************************************************************************titulo global
$sheetId = 6;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('A1', 'FRANQUICIAS DEL MES DE '.$mesx.' DEL '.$aaa)
            ->mergeCells('A1:K1')->getStyle()->getFont()->setBold(true);
 $objPHPExcel->getActiveSheet(6)->getStyle('A1:P4')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
 
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('E2', 'GASTOS DE RENTA')->mergeCells('E2:F2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('E3', 'GASTOS DE NOMINA')->mergeCells('E3:F3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('E4', 'GASTOS DE INSUMOS')->mergeCells('E4:F4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('I2', 'GASTOS DE MERMA')->mergeCells('I2:J2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('I3', 'GASTOS DE AGUA')->mergeCells('I3:J3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('I4', 'GASTOS DE LUZ')->mergeCells('I4:J4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('M2', 'GASTOS DE TEL')->mergeCells('M2:N2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('M3', 'GASTOS DE OTROS')->mergeCells('M3:N3')->getStyle()->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(6)->setCellValue('A5', 'NID');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('B5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('C5', 'GASTOS');


$objPHPExcel->setActiveSheetIndex(6)->setCellValue('E5', 'NID');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('F5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('G5', 'RENTA');

$objPHPExcel->setActiveSheetIndex(6)->setCellValue('H5', 'NOMINA');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('I5', 'IMPUESTOS NOMINA');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('J5', 'INSUMOS');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('K5', 'DEVOLUCION');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('L5', 'AGUA');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('M5', 'LUZ');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('N5', 'TEL');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('O5', 'OTROS');


/////////////////////////////////////////////////////////////////////////
//*********************************************************************************************************titulo global
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
$objPHPExcel->setActiveSheetIndex(6);
$ini6=6;$bien6=0;$mal6=0;$grave6=0;$nom6=0;$ren6=0;$dev6=0;$ins6=0;$agu6=0;$luz6=0;$tel6=0;$otr6=0;
$tventa6=0;$tcosto_venta6=0;$tgastos6=0;$tutilidad6=0;$tnomina6=0;$tisr_nomina6=0;
$tinsumos6=0;$tdev6=0;$tagua6=0;$tluz6=0;$ttel6=0;$totros6=0;$trenta6=0;
$tpor_costo_venta6=0;$tpor_gastos6=0;
foreach($q6->result()as $r6)
{
if($r6->renta>0){$ren6=$ren6+1;}
if($r6->nomina>0){$nom6=$nom6+1;}
if($r6->insumos>0){$ins6=$ins6+1;}
if($r6->dev>0){$dev6=$dev6+1;}
if($r6->agua>0){$agu6=$agu6+1;}
if($r6->luz>0){$luz6=$luz6+1;}
if($r6->tel>0){$tel6=$tel6+1;}
if($r6->otros>0){$otr6=$otr6+1;}

            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('A'.$ini6, $r6->suc);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('B'.$ini6, $r6->sucx);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('C'.$ini6, $r6->gastos);
            
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('E'.$ini6, $r6->suc);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('F'.$ini6, $r6->sucx);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('G'.$ini6, $r6->renta);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('H'.$ini6, $r6->nomina);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('I'.$ini6, $r6->isr_nomina);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('J'.$ini6, $r6->insumos);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('K'.$ini6, $r6->dev);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('L'.$ini6, $r6->agua);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('M'.$ini6, $r6->luz);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('N'.$ini6, $r6->tel);
            $objPHPExcel->setActiveSheetIndex(6)->setCellValue('O'.$ini6, $r6->otros);
            
            

if($r6->por_utilidad > '9.99'){
$objPHPExcel->getActiveSheet(6)->getStyle('A'.$ini6.':C'.$ini6)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN6);
$bien6=$bien6+1;
}
if($r6->por_utilidad >= 0 and $r6->por_utilidad <= '9.99'){

$objPHPExcel->getActiveSheet(6)->getStyle('A'.$ini6.':C'.$ini6)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);    
$mal6=$mal6+1;
}
if($r6->por_utilidad < 0){
$objPHPExcel->getActiveSheet(6)->getStyle('A'.$ini6.':C'.$ini6)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$grave6=$grave6+1;                                  
}
$ini6=$ini6+1;
$tgastos6=$tgastos6+$r6->gastos;
$trenta6=$trenta6+$r6->renta;
$tnomina6=$tnomina6+$r6->nomina;
$tisr_nomina6=$tisr_nomina6+$r6->isr_nomina;
$tinsumos6=$tinsumos6+$r6->insumos;
$tdev6=$tdev6+$r6->dev;
$tagua6=$tagua6+$r6->agua;
$tluz6=$tluz6+$r6->luz;
$ttel6=$ttel6+$r6->tel;
$totros6=$totros6+$r6->otros;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
///////////////////////////////////////////////////////////////////////////////////////////////////////////TOTAL PORCENTUAL

$objPHPExcel->setActiveSheetIndex(6)->setCellValue('G2', $ren6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('G3', $nom6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('G4', $ins6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('K2', $dev6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('K3', $agu6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('K4', $luz6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('O2', $tel6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('O3', $otr6);
//////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(6);
$objPHPExcel->getActiveSheet()->getStyle('C5:'.'C'.$ini6)->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet()->getStyle('G5:'.'P'.$ini6)->getNumberFormat()->setFormatCode('#,#00.00');
            
$objPHPExcel->getActiveSheet(6)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet(6)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet(6)->getColumnDimension('C')->setAutoSize(true);

$objPHPExcel->getActiveSheet(6)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet(6)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet(6)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet(6)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet(6)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet(6)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet(6)->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet(6)->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet(6)->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet(6)->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet(6)->getColumnDimension('P')->setAutoSize(true);

$objPHPExcel->getActiveSheet(6)->getStyle('A2:'.'C'.$ini6)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
$objPHPExcel->getActiveSheet(6)->getStyle('E2:'.'O'.$ini6)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);

//die();
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('B'.$ini6, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('C'.$ini6, $tgastos6);

$objPHPExcel->setActiveSheetIndex(6)->setCellValue('F'.$ini6, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('G'.$ini6, $trenta6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('H'.$ini6, $tnomina6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('I'.$ini6, $tisr_nomina6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('J'.$ini6, $tinsumos6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('K'.$ini6, $tdev6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('L'.$ini6, $tagua6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('M'.$ini6, $tluz6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('N'.$ini6, $ttel6);
$objPHPExcel->setActiveSheetIndex(6)->setCellValue('O'.$ini6, $totros6);

$objPHPExcel->getActiveSheet(6)->getStyle('A'.$ini6.':O'.$ini6)->getFill()->getStartColor()->setARGB('666363');
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//*********************************************************************************************************titulo global
//*********************************************************************************************************titulo global
$sheetId = 7;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('A1', 'SEGURO POPULAR DEL MES DE '.$mesx.' DEL '.$aaa)
            ->mergeCells('A1:K1')->getStyle()->getFont()->setBold(true);
 $objPHPExcel->getActiveSheet(7)->getStyle('A1:P4')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
 
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('E2', 'GASTOS DE RENTA')->mergeCells('E2:F2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('E3', 'GASTOS DE NOMINA')->mergeCells('E3:F3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('E4', 'GASTOS DE INSUMOS')->mergeCells('E4:F4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('I2', 'GASTOS DE MERMA')->mergeCells('I2:J2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('I3', 'GASTOS DE AGUA')->mergeCells('I3:J3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('I4', 'GASTOS DE LUZ')->mergeCells('I4:J4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('M2', 'GASTOS DE TEL')->mergeCells('M2:N2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('M3', 'GASTOS DE OTROS')->mergeCells('M3:N3')->getStyle()->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(7)->setCellValue('A5', 'NID');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('B5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('C5', 'GASTOS');


$objPHPExcel->setActiveSheetIndex(7)->setCellValue('E5', 'NID');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('F5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('G5', 'RENTA');

$objPHPExcel->setActiveSheetIndex(7)->setCellValue('H5', 'NOMINA');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('I5', 'IMPUESTOS NOMINA');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('J5', 'INSUMOS');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('K5', 'DEVOLUCION');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('L5', 'AGUA');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('M5', 'LUZ');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('N5', 'TEL');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('O5', 'OTROS');


/////////////////////////////////////////////////////////////////////////
//*********************************************************************************************************titulo global
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
$objPHPExcel->setActiveSheetIndex(7);
$ini7=6;$bien7=0;$mal7=0;$grave7=0;$nom7=0;$ren7=0;$dev7=0;$ins7=0;$agu7=0;$luz7=0;$tel7=0;$otr7=0;
$tventa7=0;$tcosto_venta7=0;$tgastos7=0;$tutilidad7=0;$tnomina7=0;$tisr_nomina7=0;
$tinsumos7=0;$tdev7=0;$tagua7=0;$tluz7=0;$ttel7=0;$totros7=0;$trenta7=0;
$tpor_costo_venta7=0;$tpor_gastos7=0;
foreach($q7->result()as $r7)
{
if($r7->renta>0){$ren7=$ren7+1;}
if($r7->nomina>0){$nom7=$nom7+1;}
if($r7->insumos>0){$ins7=$ins7+1;}
if($r7->dev>0){$dev7=$dev7+1;}
if($r7->agua>0){$agu7=$agu7+1;}
if($r7->luz>0){$luz7=$luz7+1;}
if($r7->tel>0){$tel7=$tel7+1;}
if($r7->otros>0){$otr7=$otr7+1;}

            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('A'.$ini7, $r7->suc);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('B'.$ini7, $r7->sucx);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('C'.$ini7, $r7->gastos);
            
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('E'.$ini7, $r7->suc);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('F'.$ini7, $r7->sucx);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('G'.$ini7, $r7->renta);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('H'.$ini7, $r7->nomina);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('I'.$ini7, $r7->isr_nomina);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('J'.$ini7, $r7->insumos);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('K'.$ini7, $r7->dev);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('L'.$ini7, $r7->agua);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('M'.$ini7, $r7->luz);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('N'.$ini7, $r7->tel);
            $objPHPExcel->setActiveSheetIndex(7)->setCellValue('O'.$ini7, $r7->otros);
            
            

if($r7->por_utilidad > '9.99'){
$objPHPExcel->getActiveSheet(7)->getStyle('A'.$ini7.':C'.$ini7)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN7);
$bien7=$bien7+1;
}
if($r7->por_utilidad >= 0 and $r7->por_utilidad <= '9.99'){

$objPHPExcel->getActiveSheet(7)->getStyle('A'.$ini7.':C'.$ini7)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);    
$mal7=$mal7+1;
}
if($r7->por_utilidad < 0){
$objPHPExcel->getActiveSheet(7)->getStyle('A'.$ini7.':C'.$ini7)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$grave7=$grave7+1;                                  
}
$ini7=$ini7+1;
$tgastos7=$tgastos7+$r7->gastos;
$trenta7=$trenta7+$r7->renta;
$tnomina7=$tnomina7+$r7->nomina;
$tisr_nomina7=$tisr_nomina7+$r7->isr_nomina;
$tinsumos7=$tinsumos7+$r7->insumos;
$tdev7=$tdev7+$r7->dev;
$tagua7=$tagua7+$r7->agua;
$tluz7=$tluz7+$r7->luz;
$ttel7=$ttel7+$r7->tel;
$totros7=$totros7+$r7->otros;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
///////////////////////////////////////////////////////////////////////////////////////////////////////////TOTAL PORCENTUAL

$objPHPExcel->setActiveSheetIndex(7)->setCellValue('G2', $ren7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('G3', $nom7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('G4', $ins7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('K2', $dev7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('K3', $agu7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('K4', $luz7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('O2', $tel7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('O3', $otr7);
//////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(7);
$objPHPExcel->getActiveSheet()->getStyle('C5:'.'C'.$ini7)->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet()->getStyle('G5:'.'P'.$ini7)->getNumberFormat()->setFormatCode('#,#00.00');
            
$objPHPExcel->getActiveSheet(7)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet(7)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet(7)->getColumnDimension('C')->setAutoSize(true);

$objPHPExcel->getActiveSheet(7)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet(7)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet(7)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet(7)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet(7)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet(7)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet(7)->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet(7)->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet(7)->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet(7)->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet(7)->getColumnDimension('P')->setAutoSize(true);

$objPHPExcel->getActiveSheet(7)->getStyle('A2:'.'C'.$ini7)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
$objPHPExcel->getActiveSheet(7)->getStyle('E2:'.'O'.$ini7)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);

//die();
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('B'.$ini7, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('C'.$ini7, $tgastos7);

$objPHPExcel->setActiveSheetIndex(7)->setCellValue('F'.$ini7, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('G'.$ini7, $trenta7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('H'.$ini7, $tnomina7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('I'.$ini7, $tisr_nomina7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('J'.$ini7, $tinsumos7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('K'.$ini7, $tdev7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('L'.$ini7, $tagua7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('M'.$ini7, $tluz7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('N'.$ini7, $ttel7);
$objPHPExcel->setActiveSheetIndex(7)->setCellValue('O'.$ini7, $totros7);

$objPHPExcel->getActiveSheet(7)->getStyle('A'.$ini7.':O'.$ini7)->getFill()->getStartColor()->setARGB('676363');
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//*********************************************************************************************************titulo global
//*********************************************************************************************************titulo global
$sheetId = 8;
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('A1', 'MODULOS DEL MES DE '.$mesx.' DEL '.$aaa)
            ->mergeCells('A1:K1')->getStyle()->getFont()->setBold(true);
 $objPHPExcel->getActiveSheet(8)->getStyle('A1:P4')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
 
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('E2', 'GASTOS DE RENTA')->mergeCells('E2:F2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('E3', 'GASTOS DE NOMINA')->mergeCells('E3:F3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('E4', 'GASTOS DE INSUMOS')->mergeCells('E4:F4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('I2', 'GASTOS DE MERMA')->mergeCells('I2:J2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('I3', 'GASTOS DE AGUA')->mergeCells('I3:J3')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('I4', 'GASTOS DE LUZ')->mergeCells('I4:J4')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('M2', 'GASTOS DE TEL')->mergeCells('M2:N2')->getStyle()->getFont()->setBold(true);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('M3', 'GASTOS DE OTROS')->mergeCells('M3:N3')->getStyle()->getFont()->setBold(true);

$objPHPExcel->setActiveSheetIndex(8)->setCellValue('A5', 'NID');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('B5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('C5', 'GASTOS');


$objPHPExcel->setActiveSheetIndex(8)->setCellValue('E5', 'NID');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('F5', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('G5', 'RENTA');

$objPHPExcel->setActiveSheetIndex(8)->setCellValue('H5', 'NOMINA');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('I5', 'IMPUESTOS NOMINA');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('J5', 'INSUMOS');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('K5', 'DEVOLUCION');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('L5', 'AGUA');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('M5', 'LUZ');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('N5', 'TEL');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('O5', 'OTROS');


/////////////////////////////////////////////////////////////////////////
//*********************************************************************************************************titulo global
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
$objPHPExcel->setActiveSheetIndex(8);
$ini8=6;$bien8=0;$mal8=0;$grave8=0;$nom8=0;$ren8=0;$dev8=0;$ins8=0;$agu8=0;$luz8=0;$tel8=0;$otr8=0;
$tventa8=0;$tcosto_venta8=0;$tgastos8=0;$tutilidad8=0;$tnomina8=0;$tisr_nomina8=0;
$tinsumos8=0;$tdev8=0;$tagua8=0;$tluz8=0;$ttel8=0;$totros8=0;$trenta8=0;
$tpor_costo_venta8=0;$tpor_gastos8=0;
foreach($q8->result()as $r8)
{
if($r8->renta>0){$ren8=$ren8+1;}
if($r8->nomina>0){$nom8=$nom8+1;}
if($r8->insumos>0){$ins8=$ins8+1;}
if($r8->dev>0){$dev8=$dev8+1;}
if($r8->agua>0){$agu8=$agu8+1;}
if($r8->luz>0){$luz8=$luz8+1;}
if($r8->tel>0){$tel8=$tel8+1;}
if($r8->otros>0){$otr8=$otr8+1;}

            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('A'.$ini8, $r8->suc);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('B'.$ini8, $r8->sucx);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('C'.$ini8, $r8->gastos);
            
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('E'.$ini8, $r8->suc);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('F'.$ini8, $r8->sucx);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('G'.$ini8, $r8->renta);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('H'.$ini8, $r8->nomina);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('I'.$ini8, $r8->isr_nomina);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('J'.$ini8, $r8->insumos);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('K'.$ini8, $r8->dev);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('L'.$ini8, $r8->agua);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('M'.$ini8, $r8->luz);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('N'.$ini8, $r8->tel);
            $objPHPExcel->setActiveSheetIndex(8)->setCellValue('O'.$ini8, $r8->otros);
            
            

if($r8->por_utilidad > '9.99'){
$objPHPExcel->getActiveSheet(8)->getStyle('A'.$ini8.':C'.$ini8)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN8);
$bien8=$bien8+1;
}
if($r8->por_utilidad >= 0 and $r8->por_utilidad <= '9.99'){

$objPHPExcel->getActiveSheet(8)->getStyle('A'.$ini8.':C'.$ini8)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE1);    
$mal8=$mal8+1;
}
if($r8->por_utilidad < 0){
$objPHPExcel->getActiveSheet(8)->getStyle('A'.$ini8.':C'.$ini8)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
$grave8=$grave8+1;                                  
}
$ini8=$ini8+1;
$tgastos8=$tgastos8+$r8->gastos;
$trenta8=$trenta8+$r8->renta;
$tnomina8=$tnomina8+$r8->nomina;
$tisr_nomina8=$tisr_nomina8+$r8->isr_nomina;
$tinsumos8=$tinsumos8+$r8->insumos;
$tdev8=$tdev8+$r8->dev;
$tagua8=$tagua8+$r8->agua;
$tluz8=$tluz8+$r8->luz;
$ttel8=$ttel8+$r8->tel;
$totros8=$totros8+$r8->otros;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle PORCENTUAL
///////////////////////////////////////////////////////////////////////////////////////////////////////////TOTAL PORCENTUAL

$objPHPExcel->setActiveSheetIndex(8)->setCellValue('G2', $ren8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('G3', $nom8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('G4', $ins8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('K2', $dev8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('K3', $agu8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('K4', $luz8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('O2', $tel8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('O3', $otr8);
//////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(8);
$objPHPExcel->getActiveSheet()->getStyle('C5:'.'C'.$ini8)->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet()->getStyle('G5:'.'P'.$ini8)->getNumberFormat()->setFormatCode('#,#00.00');
            
$objPHPExcel->getActiveSheet(8)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet(8)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet(8)->getColumnDimension('C')->setAutoSize(true);

$objPHPExcel->getActiveSheet(8)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet(8)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet(8)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet(8)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet(8)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet(8)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet(8)->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet(8)->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet(8)->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet(8)->getColumnDimension('O')->setAutoSize(true);


$objPHPExcel->getActiveSheet(8)->getStyle('A2:'.'C'.$ini8)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
$objPHPExcel->getActiveSheet(8)->getStyle('F2:'.'O'.$ini8)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);

//die();
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('B'.$ini8, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('C'.$ini8, $tgastos8);

$objPHPExcel->setActiveSheetIndex(8)->setCellValue('F'.$ini8, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('G'.$ini8, $trenta8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('H'.$ini8, $tnomina8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('I'.$ini8, $tisr_nomina8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('J'.$ini8, $tinsumos8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('K'.$ini8, $tdev8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('L'.$ini8, $tagua8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('M'.$ini8, $tluz8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('N'.$ini8, $ttel8);
$objPHPExcel->setActiveSheetIndex(8)->setCellValue('O'.$ini8, $totros8);

$objPHPExcel->getActiveSheet(8)->getStyle('A'.$ini8.':O'.$ini8)->getFill()->getStartColor()->setARGB('686363');
/////marca las celdas de impresion

//$objPHPExcel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_BREAK_PREVIEW);
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(3,0);
$objPHPExcel->getActiveSheet(0)->setTitle('CONCENTRADO');

$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet(1)->freezePaneByColumnAndRow(0,6);
$objPHPExcel->getActiveSheet(1)->setTitle('DOCTOR AHORRO');

$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet(2)->freezePaneByColumnAndRow(0,6);
$objPHPExcel->getActiveSheet(2)->setTitle('FENIX');

$objPHPExcel->setActiveSheetIndex(3);
$objPHPExcel->getActiveSheet(3)->freezePaneByColumnAndRow(0,6);
$objPHPExcel->getActiveSheet(3)->setTitle('FARMABODEGA');

$objPHPExcel->setActiveSheetIndex(4);
$objPHPExcel->getActiveSheet(4)->freezePaneByColumnAndRow(0,6);
$objPHPExcel->getActiveSheet(4)->setTitle('PERDIDA');

$objPHPExcel->setActiveSheetIndex(5);
$objPHPExcel->getActiveSheet(5)->freezePaneByColumnAndRow(0,6);
$objPHPExcel->getActiveSheet(5)->setTitle('OFICINAS');

$objPHPExcel->setActiveSheetIndex(6);
$objPHPExcel->getActiveSheet(6)->freezePaneByColumnAndRow(0,6);
$objPHPExcel->getActiveSheet(6)->setTitle('FRANQUICIAS');

$objPHPExcel->setActiveSheetIndex(7);
$objPHPExcel->getActiveSheet(7)->freezePaneByColumnAndRow(0,6);
$objPHPExcel->getActiveSheet(7)->setTitle('SEGPOP');

$objPHPExcel->setActiveSheetIndex(8);
$objPHPExcel->getActiveSheet(8)->freezePaneByColumnAndRow(0,6);
$objPHPExcel->getActiveSheet(8)->setTitle('MODULOS');

// Rename sheet

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename='.$nombre);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;
