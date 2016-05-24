<?php

error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
$nombre='ventas_'.$regional.'.xlsx';
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
            ->setCellValue('A1', 'VENTA DEL GERENTE REGIONAL '.$gerx.' DEL MES DE '.$mesx)->mergeCells('A1:AC1')->getStyle()->getFont()->setBold(true);
            ;
 $objPHPExcel->getActiveSheet(0)->getStyle('A1:AC1')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);

$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A1', 'REGIONAL '.$gerx.' DEL MES DE '.$mesx)
            ->mergeCells('A1:J1')->getStyle()->getFont()->setBold(true);
            
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A3', 'ZONA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B3', 'SUPERVISOR');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C3', 'SUCURSALES');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D3', 'TOTAL VENTA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E3', '% CALIF. VTA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F3', '% CALIF. MERMA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G3', '% CALIF. GASTOS');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H3', '% CALIF. INV');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I3', '% CALIF. UTILIDAD');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J3', '% CALIF. TOTAL');
$objPHPExcel->getActiveSheet(1)->getStyle('A1:J3')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);


//die();
        $num_suc=0;
        $tots_vta=0;
        
$tots_vta=0;
$tots_objetivo_nivel_vta=0;
$alc_vta=0;
$cal_vta=0;
$tots_obj_merma=0;
$tots_tot_merma=0;
$cal_mer=0;
$por_mer=0;
$res_mer=0;
$tots_objetivo_gastos=0;
$tots_prome=0;
$tots_agua=0;
$tots_luz=0;
$tots_tel=0;
$tots_spt=0;
$tots_varios=0;
$tots_tot_gastos=0;
$cal_gas=0;
$res_gas=0;

$cal_inv=0;
$cal_util=0;
$t_cal_mer=0;
$t_res_mer=0;
$t_por_mer=0;
$t_alc_vta=0;
$t_cal_vta=0;

$t_res_gas=0;
$t_cal_gas=0;
        
$t_cal_inv=0;
$t_cal_util=0;

$ini=1;
$inix=3;
foreach($a as $r)
{
    $ini=$ini+1;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$ini, $r['superv'].' '.$r['supervx'])->mergeCells('A'.$ini.':C'.$ini);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$ini, 'MERMA '.$mer. '%')->mergeCells('D'.$ini.':I'.$ini);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$ini, 'VENTA '.$vta.' %')->mergeCells('J'.$ini.':N'.$ini);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$ini, 'GASTOS '.$gas.' %')->mergeCells('O'.$ini.':X'.$ini);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.$ini, 'INVENTARIO '.$inv.' %')->mergeCells('Y'.$ini.':AA'.$ini);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.$ini, 'UTILIDAD '.$util.' %')->mergeCells('AB'.$ini.':AD'.$ini);
    
    $objPHPExcel->getActiveSheet(0)->getStyle('D'.$ini.':AD'.$ini)->getAlignment()->setIndent(0)
                                  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
    $objPHPExcel->getActiveSheet(0)->getStyle('A'.$ini.':AD'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
    $objPHPExcel->getActiveSheet(0)->getStyle('A'.$ini.':AD'.$ini)->getFont()->setBold(true);
    
    $ini=$ini+1;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$ini, 'NID');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$ini, 'SUCURSAL');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$ini, 'VENTA '.$mesx);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$ini, 'OBJETIVO MER');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$ini, 'MERMA '.$mesx);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$ini, '% MERMA');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$ini, 'VALOR');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$ini, 'RESULTADO');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$ini, 'CALIFICACION');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$ini, 'OBJETIVO '.$mesx);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$ini, 'OBJETIVO CON ABASTO '.$nivel_sur.' %');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$ini, 'ALCANCE');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$ini, 'VALOR');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$ini, 'CALIFICACION');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$ini, 'AGUA');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$ini, 'LUZ');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$ini, 'TELEFONO');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$ini, 'SPT');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$ini, 'OTROS');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$ini, 'TOTAL');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$ini, 'OBJETIVO GASTOS');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$ini, 'RESULTADOS');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.$ini, 'VALOR');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.$ini, 'CALIFICACION');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.$ini, 'OBJETIVO');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.$ini, 'RESULTADOS');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.$ini, 'CALIFICACION');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.$ini, 'OBJETIVO');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.$ini, 'RESULTADOS');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.$ini, 'CALIFICACION');
    
    $objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':AD'.$ini)->getAlignment()->setIndent(0)
                                  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_DISTRIBUTED);
    $objPHPExcel->getActiveSheet()->getStyle('A'.$ini.':AD'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
        
        
$nu_sucursal_super=0;        
$tots_vta=0;
$tots_objetivo_nivel_vta=0;
$alc_vta=0;
$cal_vta=0;
$tots_obj_merma=0;
$tots_tot_merma=0;
$cal_mer=0;
$por_mer=0;
$res_mer=0;
$tots_objetivo_gastos=0;
$tots_prome=0;
$tots_agua=0;
$tots_luz=0;
$tots_tel=0;
$tots_spt=0;
$tots_varios=0;
$tots_tot_gastos=0;

$cal_gas=0;
$res_gas=0;

$t_cal_mer=0;
$t_res_mer=0;
$t_por_mer=0;
$t_alc_vta=0;
$t_cal_vta=0;

$t_res_gas=0;
$t_cal_gas=0;

$cal_inv=0;
$cal_util=0;
$t_cal_inv=0;
$t_cal_util=0;
      
        foreach($r['d'] as $r1)
            {
            $ini=$ini+1;
            
            
            $objetivo_merma=round(($r1['tot_sin_recarga']*(.1)),2);
            $objetivo_gastos=round(($r1['tot_sin_recarga']*(.05)),2);
            
            $objetivo_nivel_vta=($r1['prome']*($nivel_sur/100));
            $tot_gastos=$r1['agua']+$r1['luz']+$r1['tel']+$r1['varios'];
            $tot_merma=0;
            
            $alcance_vta_por=round((($r1['tot_sin_recarga']/$objetivo_nivel_vta)*100),2);
            if($tot_merma>0)
            {   $alcance_mer_por=round((($tot_merma/$objetivo_merma)*100),2);
                $alcance_vta_merma=round((($tot_merma/$r1['tot_sin_recarga'])*100),2);
            }else{
                $alcance_mer_por=0;
                $alcance_vta_merma=0;}
            if($tot_gastos>0)
            {$alcance_vta_gastos=round((($tot_gastos/$r1['tot_sin_recarga'])*100),2);
            }else{$alcance_vta_gastos=0;}
            
            
            
            if($tot_gastos<=$objetivo_gastos and $r1['tot_sin_recarga']>0){
            $cum_gas=$gas;
            $objPHPExcel->getActiveSheet(0)->getStyle('V'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
            $objPHPExcel->getActiveSheet(0)->getStyle('X'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1); 
            }else{
                $cum_gas=' ';
                $objPHPExcel->getActiveSheet(0)->getStyle('V'.$ini)
                                  ->getFont(0)->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
                $objPHPExcel->getActiveSheet(0)->getStyle('X'.$ini)
                                  ->getFont(0)->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
                }
            if($alcance_vta_por>=100  and $r1['tot_sin_recarga']>0){
                $cum_vta=$vta;
                $objPHPExcel->getActiveSheet()->getStyle('N'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
                }else{
                    $cum_vta=' ';
                }
            
            if($tot_merma<=$objetivo_merma  and $r1['tot_sin_recarga']>0){
            $cum_mer=$mer;
            $objPHPExcel->getActiveSheet(0)->getStyle('F'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1);
            $objPHPExcel->getActiveSheet(0)->getStyle('I'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1); 
            }else{
                $cum_mer=' ';
                $objPHPExcel->getActiveSheet(0)->getStyle('F'.$ini)
                                  ->getFont(0)->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
                $objPHPExcel->getActiveSheet(0)->getStyle('I'.$ini)
                                  ->getFont(0)->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
                }
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$ini, $r1['suc']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$ini, $r1['nombre']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$ini, $r1['tot_sin_recarga']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$ini, $objetivo_merma);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$ini, $tot_merma);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$ini, $alcance_vta_merma);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$ini, $mer.'%');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$ini, $alcance_mer_por);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$ini, $cum_mer);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$ini, $r1['prome']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$ini, $objetivo_nivel_vta);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$ini, $alcance_vta_por);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$ini, $vta.'%');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$ini, $cum_vta);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$ini, $r1['agua']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$ini, $r1['luz']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$ini, $r1['tel']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$ini, $r1['varios']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$ini, $tot_gastos);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$ini, $objetivo_gastos);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$ini, $alcance_vta_gastos);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.$ini, $gas.'%');
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.$ini, $cum_gas);
            
            
            $objPHPExcel->getActiveSheet(0)->getStyle('C'.$ini.':AD'.$ini)->getNumberFormat()->setFormatCode('#,#00.00');
            
            if($alcance_vta_por>=80){
               $objPHPExcel->getActiveSheet(0)->getStyle('L'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN1); 
            }elseif($alcance_vta_por>=50 and $alcance_vta_por<80){
                $objPHPExcel->getActiveSheet(0)->getStyle('L'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_ORANGE);
            }else{
                $objPHPExcel->getActiveSheet()->getStyle('L'.$ini)
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
            }
            $nu_sucursal_super=$nu_sucursal_super+1;
            $tots_vta=$tots_vta+$r1['tot_sin_recarga'];
            $tots_objetivo_nivel_vta=$tots_objetivo_nivel_vta+$objetivo_nivel_vta;
            $alc_vta=$alc_vta+$alcance_vta_por;
            $cal_vta=$cal_vta+$cum_vta;
            
            $tots_obj_merma=$tots_obj_merma+$objetivo_merma;
            $tots_tot_merma=$tots_tot_merma+$tot_merma;
            $cal_mer=$cal_mer+$cum_mer;
            $por_mer=$por_mer+$alcance_vta_merma;
            $res_mer=$res_mer+$alcance_mer_por;
            
            
            
            
            $tots_objetivo_gastos=$tots_objetivo_gastos+$objetivo_gastos;
            $tots_prome=$tots_prome+$r1['prome'];
            $tots_agua=$tots_agua+$r1['agua'];
            $tots_luz=$tots_luz+$r1['luz'];
            $tots_tel=$tots_tel+$r1['tel'];
            $tots_spt=$tots_spt+0;
            $tots_varios=$tots_varios+$r1['varios'];
            $tots_tot_gastos=$tots_tot_gastos+$tot_gastos;
            $res_gas=$res_gas+$alcance_vta_gastos;
            $cal_gas=$cal_gas+$cum_gas;
            
            $cal_inv=$cal_inv+0;
            $cal_util=$cal_util+0;
            
            }
            $ini=$ini+1;
            $t_cal_mer=($cal_mer/$nu_sucursal_super);
            $t_res_mer=($res_mer/$nu_sucursal_super);
            $t_por_mer=($por_mer/$nu_sucursal_super);
            
            $t_alc_vta=($alc_vta/$nu_sucursal_super);
            $t_cal_vta=($cal_vta/$nu_sucursal_super);
            
            $t_res_gas=($res_gas/$nu_sucursal_super);
            $t_cal_gas=($cal_gas/$nu_sucursal_super);
            
            
            $t_cal_inv=($cal_inv/$nu_sucursal_super);
            $t_cal_util=($cal_util/$nu_sucursal_super);
            
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$ini, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$ini, $tots_vta);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$ini, $tots_obj_merma);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$ini, $tots_tot_merma);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$ini, $t_por_mer);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$ini, $t_res_mer);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$ini, $t_cal_mer);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$ini, $tots_prome);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$ini, $tots_objetivo_nivel_vta);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$ini, $t_alc_vta);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$ini, $t_cal_vta);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$ini, $tots_agua);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$ini, $tots_luz);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$ini, $tots_tel);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$ini, $tots_spt);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$ini, $tots_varios);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$ini, $tots_tot_gastos);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$ini, $tots_objetivo_gastos);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$ini, $t_res_gas);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.$ini, $t_cal_gas);
        

$objPHPExcel->getActiveSheet(0)->getStyle('C'.$ini.':AD'.$ini)->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet(0)->getStyle('B'.$ini.':AD'.$ini)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
            $ini=$ini+1;

//////////////////////////////////////////////////////////////////////////////////////////////segunda hoja
$inix=$inix+1;
$fin=$t_cal_vta+$t_cal_mer+$t_cal_gas+$t_cal_inv+$t_cal_util;
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A'.$inix, $r['superv']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B'.$inix, $r['supervx']);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C'.$inix, $nu_sucursal_super);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D'.$inix, $tots_vta);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E'.$inix, $t_cal_vta);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F'.$inix, $t_cal_mer);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G'.$inix, $t_cal_gas);
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H'.$inix, '');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I'.$inix, '');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J'.$inix, $fin);
$objPHPExcel->getActiveSheet(1)->getStyle('D3:D'.$inix)->getNumberFormat()->setFormatCode('#,#00.00');
$objPHPExcel->getActiveSheet(1)->getStyle('E3:J'.$inix)->getNumberFormat()->setFormatCode('#,#0.00');
//////////////////////////////////////////////////////////////////////////////////////////////segunda hoja
$objPHPExcel->getActiveSheet(1)->getStyle('A2:'.'J'.$inix)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
$objPHPExcel->getActiveSheet(1)->setTitle('CONCENTRADO POR ZONA');
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

$objPHPExcel->getActiveSheet(0)->getStyle('A2:'.'AD'.$ini)->getFill()
                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);

/////marca las celdas de impresion
//$objPHPExcel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_BREAK_PREVIEW);



// Rename sheet
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(3,0);
$objPHPExcel->getActiveSheet(0)->setTitle('ESTADISTICA POR SUCURSAL');

//$sheetId = 1;
//$objPHPExcel->createSheet();
//$objPHPExcel->setActiveSheetIndex(1);


//codiggo


//die();
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(1);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename='.$nombre);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

