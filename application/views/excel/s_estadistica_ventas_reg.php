<?php

error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
$nombre='ventas_Global.xlsx';
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


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'VENTA DEL GLOBAL DEL MES DE '.$mesx.' CON UN GASTO ADICIONAL DE OFICINAS POR SUCURSAL DE '.number_format($monto,2))->mergeCells('A1:AC1')->getStyle()->getFont()->setBold(true);
            ;
 $objPHPExcel->getActiveSheet(0)->getStyle('A1:AG1')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A1', 'CALIFICACION DE SUCURSALES PARA INCENTIVOS')
            ->mergeCells('A1:J1')->getStyle()->getFont()->setBold(true);
            
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A3', 'ZONA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B3', 'SUPERVISOR');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C3', 'NID');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D3', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E3', '% CALIF. MERMA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F3', '% CALIF. GASTOS');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G3', '% CALIF. VTA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H3', '% CALIF. UTILIDAD');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I3', '% CALIF. INVENTARIO');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J3', '% CALIF. TOTAL');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K3', 'BONO');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L3', 'REF.UTILIDAD');
$objPHPExcel->getActiveSheet(1)->getStyle('A1:L3')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);


//die();
        $num_suc=0;
$t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$t13=0;$t14=0;$t15=0;
$t16=0;$t17=0;$t18=0;$t19=0;$t20=0;$t21=0;$t22=0;$t23=0;$t24=0;$t25=0;$t26=0;
$ini=1;
$inic=3;
$inix=3;
foreach($a as $r)
{
    $ini=$ini+1;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$ini, $r['superv'].' '.$r['supervx'])->mergeCells('A'.$ini.':B'.$ini);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$ini, 'MERMA '.$mer. '%')->mergeCells('C'.$ini.':F'.$ini);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$ini, 'GASTOS '.$gas.' %')->mergeCells('G'.$ini.':Q'.$ini);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$ini, 'VENTA '.$vta.' %')->mergeCells('R'.$ini.':V'.$ini);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.$ini, 'UTILIDAD '.$util.' %')->mergeCells('W'.$ini.':AB'.$ini);
    
    $objPHPExcel->getActiveSheet(0)->getStyle('C'.$ini.':AB'.$ini)->getAlignment()->setIndent(0)
                                  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
    $objPHPExcel->getActiveSheet(0)->getStyle('A'.$ini.':AB'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
    $objPHPExcel->getActiveSheet(0)->getStyle('A'.$ini.':AB'.$ini)->getFont()->setBold(true);
    
    $ini=$ini+1;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$ini, 'NID');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$ini, 'SUCURSAL');
    
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$ini, 'OBJETIVO MER');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$ini, 'MERMA '.$mesx);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$ini, '% MERMA');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$ini, 'CALIFICACION');
    
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$ini, 'OBJETIVO GASTOS');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$ini, 'INSUMOS');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$ini, 'AGUA');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$ini, 'LUZ');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$ini, 'TELEFONO');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$ini, 'OTROS');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$ini, 'RENTA');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$ini, 'NOMINA');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$ini, 'TOTAL GASTOS');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$ini, '% GASTOS');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$ini, 'CALIFICACION');
    
    
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$ini, 'VENTA '.$mesx);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$ini, 'OBJETIVO '.$mesx);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$ini, 'OBJETIVO CON ABASTO '.$nivel_sur.' %');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$ini, 'ALCANCE');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$ini, 'CALIFICACION');
    
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.$ini, 'VENTA '.$mesx);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.$ini, 'COSTO DE LA VENTA');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.$ini, 'GASTOS');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.$ini, 'UTILIDAD');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.$ini, '% UTILIDAD');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.$ini, 'CALIFICACION');
    
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.$ini, 'ZONA');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.$ini, 'SUPERVISOR');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE'.$ini, 'REG');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF'.$ini, 'REGIONAL');
    
    $objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':AF'.$ini)->getAlignment()->setIndent(0)
                                  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_DISTRIBUTED);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':AF'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
        
        
        foreach($r['d'] as $r1)
            {
            $ini=$ini+1;
            $inic=$inic+1;
           
//superv, supervx, suc, sucx, obj_gas, agua, luz, tel, insumos, otros, renta, nomina, tot_gas, 
//val_gas, resul_gas, obj_dev, dev, por_dev, val_dev, resul_dev, prome, ob_abas, alcance, val_ven, 
//resul_ven, venta, costo_venta, gastos, utilidad, por_util, resul_util            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$ini, $r1['suc']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$ini, $r1['sucx']);
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$ini, $r1['obj_dev']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$ini, $r1['dev']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$ini, $r1['por_dev']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$ini, $r1['resul_dev']);
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$ini, $r1['obj_gas']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$ini, $r1['insumos']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$ini, $r1['agua']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$ini, $r1['luz']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$ini, $r1['tel']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$ini, $r1['otros']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$ini, $r1['renta']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$ini, $r1['nomina']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$ini, $r1['tot_gas']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$ini, $r1['por_gas']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$ini, $r1['resul_gas']);
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$ini, $r1['venta']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$ini, $r1['prome']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$ini, $r1['ob_abas']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$ini, $r1['alcance']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$ini, $r1['resul_ven']);
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.$ini, $r1['venta']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.$ini, $r1['costo_venta']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.$ini, $r1['gastos']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.$ini, $r1['utilidad']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.$ini, $r1['por_util']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.$ini, $r1['resul_util']);
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.$ini, $r1['superv']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.$ini, $r1['supervx']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE'.$ini, $r1['reg']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF'.$ini, $r1['regx']);
            $objPHPExcel->getActiveSheet(0)->getStyle('C'.$ini.':AB'.$ini)->getNumberFormat()->setFormatCode('#,#00.00');
            
            
if($r1['tipo3']=='AN' or $r1['tipo3']=='CE'){
    $objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':AF'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
}else{
  $objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':AF'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);  
}
$t1=$t1+$r1['obj_dev'];
$t2=$t2+$r1['dev'];
$t3=' ';
$t4=' ';

$t5=$t5+$r1['obj_gas'];
$t6=$t6+$r1['insumos'];
$t7=$t7+$r1['agua'];
$t8=$t8+$r1['luz'];
$t9=$t9+$r1['tel'];
$t10=$t10+$r1['otros'];
$t11=$t11+$r1['renta'];
$t12=$t12+$r1['nomina'];
$t13=$t13+$r1['tot_gas'];
$t14='';
$t15=' ';

$t16=$t16+$r1['venta']; 
$t17=$t17+$r1['prome']; 
$t18=$t18+$r1['ob_abas']; 
$t19='';
$t20=$t20+$r1['resul_ven'];

$t21=$t21+$r1['venta'];

$t23=$t23+$r1['gastos'];
$t24=$t24+$r1['utilidad'];
$t25='';
$t26='';
$t27='';
$porce=($r1['resul_dev']+$r1['resul_gas']+$r1['resul_ven']+$r1['resul_util']+10);
$suc=$r1['suc'];
if(($r1['resul_dev']+$r1['resul_gas']+$r1['resul_ven']+$r1['resul_util']+10)>69.99)
{
$ss="select sum(b.monto)as bono
from catalogo.cat_empleado a
join catalogo.tabla_condicion_da b on b.puestox=a.puestox
where tipo=1 and a.succ=$suc and '$porce' between porce1 and porce2";
$qq=$this->db->query($ss);
$rr=$qq->row();
$bono=$rr->bono;
$util=$r1['utilidad'];
}else{
$bono=' ';
$util=' ';
}

            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$inic, $r['superv']);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$inic, $r['supervx']);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$inic, $r1['suc']);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('D'.$inic, $r1['sucx']);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('E'.$inic, $r1['resul_dev']);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$inic, $r1['resul_gas']);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.$inic, $r1['resul_ven']);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('H'.$inic, $r1['resul_util']);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('I'.$inic, '10');
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('J'.$inic, ($r1['resul_dev']+$r1['resul_gas']+$r1['resul_ven']+$r1['resul_util']+10));
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('K'.$inic, $bono);
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue('L'.$inic, $util);
            
if(($r1['resul_dev']+$r1['resul_gas']+$r1['resul_ven']+$r1['resul_util']+10)>69.99)
{
    $objPHPExcel->getActiveSheet(1)->getStyle('A'.$inic.':L'.$inic)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
}else{
    $objPHPExcel->getActiveSheet(1)->getStyle('A'.$inic.':L'.$inic)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);
}


}
$ini=$ini+1;
            
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$ini, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$ini, $t1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$ini, $t2);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$ini, $t3);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$ini, $t4);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$ini, $t5);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$ini, $t6);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$ini, $t7);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$ini, $t8);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$ini, $t9);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$ini, $t10);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$ini, $t11);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$ini, $t12);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$ini, $t13);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$ini, $t14);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$ini, $t15);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$ini, $t16);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$ini, $t17);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$ini, $t18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$ini, $t19);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$ini, $t20);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.$ini, $t21);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.$ini, $t23);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.$ini, $t24);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.$ini, $t25);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.$ini, $t26);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.$ini, $t27);
        

$objPHPExcel->getActiveSheet(0)->getStyle('C'.$ini.':AC'.$ini)->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet(0)->getStyle('B'.$ini.':AF'.$ini)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
            $ini=$ini+1;

//////////////////////////////////////////////////////////////////////////////////////////////segunda hoja
$t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$t13=0;$t14=0;$t15=0;
$t16=0;$t17=0;$t18=0;$t19=0;$t20=0;$t21=0;$t22=0;$t23=0;$t24=0;$t25=0;$t26=0;
$objPHPExcel->setActiveSheetIndex(0);
}
//die();



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
$objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('Q')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('R')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('S')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('T')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('V')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('W')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('X')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('Y')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('Z')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('AA')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('AB')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('AC')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('AD')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('AE')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('AF')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getColumnDimension('AG')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getStyle('A2:'.'AF'.$ini)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);

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
$objPHPExcel->getActiveSheet(1)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet(1)->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet(0)->getStyle('E4:L'.$inic)->getNumberFormat()->setFormatCode('#,#00.00');
/////marca las celdas de impresion
//$objPHPExcel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_BREAK_PREVIEW);

die();

// Rename sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(2,0);
$objPHPExcel->getActiveSheet(0)->setTitle('ESTADISTICA POR SUCURSAL');

$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet(1)->freezePaneByColumnAndRow(0,4);
$objPHPExcel->getActiveSheet(1)->setTitle('CALIF.');
//$sheetId = 1;
//$objPHPExcel->createSheet();
//$objPHPExcel->setActiveSheetIndex(1);


//codiggo
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//$objPHPExcel->setActiveSheetIndex(1);

//die();
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename='.$nombre);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

