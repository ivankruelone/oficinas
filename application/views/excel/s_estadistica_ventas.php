<?php

error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
require_once 'Classes/PHPExcel.php';
$nombre='ventas_zona'.$superv.'.xlsx';
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
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'VENTA DE SUCURSALES DE LA ZONA '.$superv.' DEL MES DE '.$mesx)->mergeCells('A1:M1')->getStyle()->getFont()->setBold(true);
            ;
//die();
$num_suc=0;
$ini=2;
$ini2=3;
$ini3=3;
foreach($q->result()as $r)
{
$filaf=$ini3+$r->max_dia+1;
$num_suc=$num_suc+1;  
$var1=__letra1($num_suc);
$var2=__letra2($num_suc);
$var3=__letra3($num_suc);
$var4=__letra4($num_suc);
$var5=__letra5($num_suc);
//$rango=__rango($num_suc,$ini);

$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var1.$ini, $r->nombre);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var1.$ini2, 'DIA'); 
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var2.$ini2, 'VTA M.N + VALES');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var3.$ini2, 'VTA CON TARJETA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var4.$ini2, 'TOTAL SIN RECARGA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var5.$ini2, 'VTA RECARGA');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var2.$filaf, $r->pesos);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var3.$filaf, $r->tar);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var4.$filaf, $r->tot_sin_recarga);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var5.$filaf, $r->recarga);


$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var1.$ini.':'.$var5.$ini);
$objPHPExcel->getActiveSheet()->getStyle($var1.$ini.':'.$var5.$ini)->getAlignment()->setIndent(0)
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
$objPHPExcel->getActiveSheet()->getStyle($var1.$ini2.':'.$var5.$ini2)->getAlignment()->setIndent(0)
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_DISTRIBUTED);
$objPHPExcel->getActiveSheet()->getStyle($var1.$ini.':'.$var5.$ini2)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle($var2.$filaf.':'.$var5.$filaf)->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle($var2.$filaf.':'.$var5.$filaf)->getNumberFormat()->setFormatCode('#,#00.00');
foreach ($q1 as $r1) 
{
$conteo=0;   
foreach ($r1['d'] as $r2) 
{
$conteo=$conteo+1;    
$var1=__letra1($conteo);
$var2=__letra2($conteo);
$var3=__letra3($conteo);
$var4=__letra4($conteo);
$var5=__letra5($conteo);
$fila=$ini3+$r2['dia'];
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var1.$fila, $r2['dia']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var2.$fila, $r2['pesos']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var3.$fila, $r2['tar']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var4.$fila, $r2['tot_sin_recarga']);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($var5.$fila, $r2['recarga']);    

$objPHPExcel->getActiveSheet()->getStyle($var2.$fila.':'.$var5.$fila)->getNumberFormat()->setFormatCode('#,#00.00');
}}


}
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
$objPHPExcel->getActiveSheet()->getStyle('A3:'.$var5.$filaf)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR);
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('VENTAS_DIARIAS');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename='.$nombre);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

function __letra1($num_suc)
{
    if($num_suc==1){$var='A';}
elseif($num_suc==2){$var='G';}
elseif($num_suc==3){$var='M';}
elseif($num_suc==4){$var='S';}
elseif($num_suc==5){$var='Y';}
elseif($num_suc==6){$var='AE';}
elseif($num_suc==7){$var='AK';}
elseif($num_suc==8){$var='AQ';}
elseif($num_suc==9){$var='AW';}
elseif($num_suc==10){$var='BC';}
elseif($num_suc==11){$var='BI';}
elseif($num_suc==12){$var='BO';}
elseif($num_suc==13){$var='BU';}

elseif($num_suc==14){$var='CA';}
elseif($num_suc==15){$var='CG';}
elseif($num_suc==16){$var='CM';}
elseif($num_suc==17){$var='CS';}
elseif($num_suc==18){$var='CY';}
elseif($num_suc==19){$var='DE';}
elseif($num_suc==20){$var='DK';}
elseif($num_suc==21){$var='DQ';}
elseif($num_suc==22){$var='DW';}
elseif($num_suc==23){$var='EC';}
elseif($num_suc==24){$var='EI';}
elseif($num_suc==25){$var='EO';}
elseif($num_suc==26){$var='EU';}

elseif($num_suc==27){$var='FA';}
elseif($num_suc==28){$var='FG';}
elseif($num_suc==29){$var='FM';}
elseif($num_suc==30){$var='FS';}
elseif($num_suc==31){$var='FY';}
elseif($num_suc==32){$var='GE';}
elseif($num_suc==33){$var='GK';}
elseif($num_suc==34){$var='GQ';}
elseif($num_suc==35){$var='GW';}
elseif($num_suc==36){$var='HC';}
elseif($num_suc==37){$var='HI';}
elseif($num_suc==38){$var='HO';}
elseif($num_suc==39){$var='HU';}

elseif($num_suc==40){$var='IA';}
elseif($num_suc==41){$var='IG';}
elseif($num_suc==42){$var='IM';}
elseif($num_suc==43){$var='IS';}
elseif($num_suc==44){$var='IY';}
elseif($num_suc==45){$var='JE';}
elseif($num_suc==46){$var='JK';}
elseif($num_suc==47){$var='JQ';}
elseif($num_suc==48){$var='JW';}
elseif($num_suc==49){$var='KC';}
elseif($num_suc==50){$var='KI';}
elseif($num_suc==51){$var='KO';}
elseif($num_suc==52){$var='KU';}

elseif($num_suc==53){$var='LA';}
elseif($num_suc==54){$var='LG';}
elseif($num_suc==55){$var='LM';}
elseif($num_suc==56){$var='LS';}
elseif($num_suc==57){$var='LY';}
elseif($num_suc==58){$var='ME';}
elseif($num_suc==59){$var='MK';}
elseif($num_suc==60){$var='MQ';}
elseif($num_suc==61){$var='MW';}
elseif($num_suc==62){$var='NC';}
elseif($num_suc==63){$var='NI';}
elseif($num_suc==64){$var='NO';}
elseif($num_suc==65){$var='NU';}

elseif($num_suc==66){$var='OA';}
elseif($num_suc==67){$var='OG';}
elseif($num_suc==68){$var='OM';}
elseif($num_suc==69){$var='OS';}
elseif($num_suc==70){$var='OY';}
elseif($num_suc==71){$var='PE';}
elseif($num_suc==72){$var='PK';}
elseif($num_suc==73){$var='PQ';}
elseif($num_suc==74){$var='PW';}
elseif($num_suc==75){$var='QC';}
elseif($num_suc==76){$var='QI';}
elseif($num_suc==77){$var='QO';}
elseif($num_suc==78){$var='QU';}

elseif($num_suc==79){$var='RA';}
elseif($num_suc==80){$var='RG';}
elseif($num_suc==81){$var='RM';}
elseif($num_suc==82){$var='RS';}
elseif($num_suc==83){$var='RY';}
elseif($num_suc==84){$var='SE';}
elseif($num_suc==85){$var='SK';}
elseif($num_suc==86){$var='SQ';}
elseif($num_suc==87){$var='SW';}
elseif($num_suc==88){$var='TC';}
elseif($num_suc==89){$var='TI';}
elseif($num_suc==90){$var='TO';}
elseif($num_suc==91){$var='TU';}

elseif($num_suc==92){$var='UA';}
elseif($num_suc==93){$var='UG';}
elseif($num_suc==94){$var='UM';}
elseif($num_suc==95){$var='US';}
elseif($num_suc==96){$var='UY';}
elseif($num_suc==97){$var='VE';}
elseif($num_suc==98){$var='VK';}
elseif($num_suc==99){$var='VQ';}
elseif($num_suc==100){$var='VW';}
return $var;
}
function __letra2($num_suc)
{
    if($num_suc==1){$var='B';}
elseif($num_suc==2){$var='H';}
elseif($num_suc==3){$var='N';}
elseif($num_suc==4){$var='T';}
elseif($num_suc==5){$var='Z';}
elseif($num_suc==6){$var='AF';}
elseif($num_suc==7){$var='AL';}
elseif($num_suc==8){$var='AR';}
elseif($num_suc==9){$var='AX';}
elseif($num_suc==10){$var='BD';}
elseif($num_suc==11){$var='BJ';}
elseif($num_suc==12){$var='BP';}
elseif($num_suc==13){$var='BV';}

elseif($num_suc==14){$var='CB';}
elseif($num_suc==15){$var='CH';}
elseif($num_suc==16){$var='CN';}
elseif($num_suc==17){$var='CT';}
elseif($num_suc==18){$var='CZ';}
elseif($num_suc==19){$var='DF';}
elseif($num_suc==20){$var='DL';}
elseif($num_suc==21){$var='DR';}
elseif($num_suc==22){$var='DX';}
elseif($num_suc==23){$var='ED';}
elseif($num_suc==24){$var='EJ';}
elseif($num_suc==25){$var='EP';}
elseif($num_suc==26){$var='EV';}


elseif($num_suc==27){$var='FB';}
elseif($num_suc==28){$var='FH';}
elseif($num_suc==29){$var='FN';}
elseif($num_suc==30){$var='FT';}
elseif($num_suc==31){$var='FZ';}
elseif($num_suc==32){$var='GF';}
elseif($num_suc==33){$var='GL';}
elseif($num_suc==34){$var='GR';}
elseif($num_suc==35){$var='GX';}
elseif($num_suc==36){$var='HD';}
elseif($num_suc==37){$var='HJ';}
elseif($num_suc==38){$var='HP';}
elseif($num_suc==39){$var='HV';}

elseif($num_suc==40){$var='IB';}
elseif($num_suc==41){$var='IH';}
elseif($num_suc==42){$var='IN';}
elseif($num_suc==43){$var='IT';}
elseif($num_suc==44){$var='IZ';}
elseif($num_suc==45){$var='JF';}
elseif($num_suc==46){$var='JL';}
elseif($num_suc==47){$var='JR';}
elseif($num_suc==48){$var='JX';}
elseif($num_suc==49){$var='KD';}
elseif($num_suc==50){$var='KJ';}
elseif($num_suc==51){$var='KP';}
elseif($num_suc==52){$var='KV';}

elseif($num_suc==53){$var='LB';}
elseif($num_suc==54){$var='LH';}
elseif($num_suc==55){$var='LN';}
elseif($num_suc==56){$var='LT';}
elseif($num_suc==57){$var='LZ';}
elseif($num_suc==58){$var='MF';}
elseif($num_suc==59){$var='ML';}
elseif($num_suc==60){$var='MR';}
elseif($num_suc==61){$var='MX';}
elseif($num_suc==62){$var='ND';}
elseif($num_suc==63){$var='NJ';}
elseif($num_suc==64){$var='NP';}
elseif($num_suc==65){$var='NV';}

elseif($num_suc==66){$var='OB';}
elseif($num_suc==67){$var='OH';}
elseif($num_suc==68){$var='ON';}
elseif($num_suc==69){$var='OT';}
elseif($num_suc==70){$var='OZ';}
elseif($num_suc==71){$var='PF';}
elseif($num_suc==72){$var='PL';}
elseif($num_suc==73){$var='PR';}
elseif($num_suc==74){$var='PX';}
elseif($num_suc==75){$var='QD';}
elseif($num_suc==76){$var='QJ';}
elseif($num_suc==77){$var='QP';}
elseif($num_suc==78){$var='QV';}

elseif($num_suc==79){$var='RB';}
elseif($num_suc==80){$var='RH';}
elseif($num_suc==81){$var='RN';}
elseif($num_suc==82){$var='RT';}
elseif($num_suc==83){$var='RZ';}
elseif($num_suc==84){$var='SF';}
elseif($num_suc==85){$var='SL';}
elseif($num_suc==86){$var='SR';}
elseif($num_suc==87){$var='SX';}
elseif($num_suc==88){$var='TD';}
elseif($num_suc==89){$var='TJ';}
elseif($num_suc==90){$var='TP';}
elseif($num_suc==91){$var='TV';}

elseif($num_suc==92){$var='UB';}
elseif($num_suc==93){$var='UH';}
elseif($num_suc==94){$var='UN';}
elseif($num_suc==95){$var='UT';}
elseif($num_suc==96){$var='UZ';}
elseif($num_suc==97){$var='VF';}
elseif($num_suc==98){$var='VL';}
elseif($num_suc==99){$var='VR';}
elseif($num_suc==100){$var='VX';}
return $var;
}

function __letra3($num_suc)
{
    if($num_suc==1){$var='C';}
elseif($num_suc==2){$var='I';}
elseif($num_suc==3){$var='O';}
elseif($num_suc==4){$var='U';}
elseif($num_suc==5){$var='AA';}
elseif($num_suc==6){$var='AG';}
elseif($num_suc==7){$var='AM';}
elseif($num_suc==8){$var='AS';}
elseif($num_suc==9){$var='AY';}
elseif($num_suc==10){$var='BE';}
elseif($num_suc==11){$var='BK';}
elseif($num_suc==12){$var='BQ';}
elseif($num_suc==13){$var='BW';}

elseif($num_suc==14){$var='CC';}
elseif($num_suc==15){$var='CI';}
elseif($num_suc==16){$var='CO';}
elseif($num_suc==17){$var='CU';}
elseif($num_suc==18){$var='DA';}
elseif($num_suc==19){$var='DG';}
elseif($num_suc==20){$var='DM';}
elseif($num_suc==21){$var='DS';}
elseif($num_suc==22){$var='DY';}
elseif($num_suc==23){$var='EE';}
elseif($num_suc==24){$var='EK';}
elseif($num_suc==25){$var='EQ';}
elseif($num_suc==26){$var='EW';}

elseif($num_suc==27){$var='FC';}
elseif($num_suc==28){$var='FI';}
elseif($num_suc==29){$var='FO';}
elseif($num_suc==30){$var='FU';}
elseif($num_suc==31){$var='GA';}
elseif($num_suc==32){$var='GG';}
elseif($num_suc==33){$var='GM';}
elseif($num_suc==34){$var='GS';}
elseif($num_suc==35){$var='GY';}
elseif($num_suc==36){$var='HE';}
elseif($num_suc==37){$var='HK';}
elseif($num_suc==38){$var='HQ';}
elseif($num_suc==39){$var='HW';}

elseif($num_suc==40){$var='IC';}
elseif($num_suc==41){$var='II';}
elseif($num_suc==42){$var='IO';}
elseif($num_suc==43){$var='IU';}
elseif($num_suc==44){$var='JA';}
elseif($num_suc==45){$var='JG';}
elseif($num_suc==46){$var='JM';}
elseif($num_suc==47){$var='JS';}
elseif($num_suc==48){$var='JY';}
elseif($num_suc==49){$var='KE';}
elseif($num_suc==50){$var='KK';}
elseif($num_suc==51){$var='KQ';}
elseif($num_suc==52){$var='KW';}

elseif($num_suc==53){$var='LC';}
elseif($num_suc==54){$var='LI';}
elseif($num_suc==55){$var='LO';}
elseif($num_suc==56){$var='LU';}
elseif($num_suc==57){$var='MA';}
elseif($num_suc==58){$var='MG';}
elseif($num_suc==59){$var='MM';}
elseif($num_suc==60){$var='MS';}
elseif($num_suc==61){$var='MY';}
elseif($num_suc==62){$var='NE';}
elseif($num_suc==63){$var='NK';}
elseif($num_suc==64){$var='NQ';}
elseif($num_suc==65){$var='NW';}

elseif($num_suc==66){$var='OC';}
elseif($num_suc==67){$var='OI';}
elseif($num_suc==68){$var='OO';}
elseif($num_suc==69){$var='OU';}
elseif($num_suc==70){$var='PA';}
elseif($num_suc==71){$var='PG';}
elseif($num_suc==72){$var='PM';}
elseif($num_suc==73){$var='PS';}
elseif($num_suc==74){$var='PY';}
elseif($num_suc==75){$var='QE';}
elseif($num_suc==76){$var='QK';}
elseif($num_suc==77){$var='QQ';}
elseif($num_suc==78){$var='QW';}

elseif($num_suc==79){$var='RC';}
elseif($num_suc==80){$var='RI';}
elseif($num_suc==81){$var='RO';}
elseif($num_suc==82){$var='RU';}
elseif($num_suc==83){$var='SA';}
elseif($num_suc==84){$var='SG';}
elseif($num_suc==85){$var='SM';}
elseif($num_suc==86){$var='SS';}
elseif($num_suc==87){$var='SY';}
elseif($num_suc==88){$var='TE';}
elseif($num_suc==89){$var='TK';}
elseif($num_suc==90){$var='TQ';}
elseif($num_suc==91){$var='TW';}

elseif($num_suc==92){$var='UC';}
elseif($num_suc==93){$var='UI';}
elseif($num_suc==94){$var='UO';}
elseif($num_suc==95){$var='UU';}
elseif($num_suc==96){$var='VA';}
elseif($num_suc==97){$var='VG';}
elseif($num_suc==98){$var='VM';}
elseif($num_suc==99){$var='VS';}
elseif($num_suc==100){$var='VY';}
return $var;
}

function __letra4($num_suc)
{
    if($num_suc==1){$var='D';}
elseif($num_suc==2){$var='J';}
elseif($num_suc==3){$var='P';}
elseif($num_suc==4){$var='V';}
elseif($num_suc==5){$var='AB';}
elseif($num_suc==6){$var='AH';}
elseif($num_suc==7){$var='AN';}
elseif($num_suc==8){$var='AT';}
elseif($num_suc==9){$var='AZ';}
elseif($num_suc==10){$var='BF';}
elseif($num_suc==11){$var='BL';}
elseif($num_suc==12){$var='BR';}
elseif($num_suc==13){$var='BX';}

elseif($num_suc==14){$var='CD';}
elseif($num_suc==15){$var='CJ';}
elseif($num_suc==16){$var='CP';}
elseif($num_suc==17){$var='CV';}
elseif($num_suc==18){$var='DB';}
elseif($num_suc==19){$var='DH';}
elseif($num_suc==20){$var='DN';}
elseif($num_suc==21){$var='DT';}
elseif($num_suc==22){$var='DZ';}
elseif($num_suc==23){$var='EF';}
elseif($num_suc==24){$var='EL';}
elseif($num_suc==25){$var='ER';}
elseif($num_suc==26){$var='EX';}

elseif($num_suc==27){$var='FD';}
elseif($num_suc==28){$var='FJ';}
elseif($num_suc==29){$var='FP';}
elseif($num_suc==30){$var='FV';}
elseif($num_suc==31){$var='GB';}
elseif($num_suc==32){$var='GH';}
elseif($num_suc==33){$var='GN';}
elseif($num_suc==34){$var='GT';}
elseif($num_suc==35){$var='GZ';}
elseif($num_suc==36){$var='HF';}
elseif($num_suc==37){$var='HL';}
elseif($num_suc==38){$var='HR';}
elseif($num_suc==39){$var='HX';}

elseif($num_suc==40){$var='ID';}
elseif($num_suc==41){$var='IJ';}
elseif($num_suc==42){$var='IP';}
elseif($num_suc==43){$var='IV';}
elseif($num_suc==44){$var='JB';}
elseif($num_suc==45){$var='JH';}
elseif($num_suc==46){$var='JN';}
elseif($num_suc==47){$var='JT';}
elseif($num_suc==48){$var='JZ';}
elseif($num_suc==49){$var='KF';}
elseif($num_suc==50){$var='KL';}
elseif($num_suc==51){$var='KR';}
elseif($num_suc==52){$var='KX';}

elseif($num_suc==53){$var='LD';}
elseif($num_suc==54){$var='LJ';}
elseif($num_suc==55){$var='LP';}
elseif($num_suc==56){$var='LV';}
elseif($num_suc==57){$var='MB';}
elseif($num_suc==58){$var='MH';}
elseif($num_suc==59){$var='MN';}
elseif($num_suc==60){$var='MT';}
elseif($num_suc==61){$var='MZ';}
elseif($num_suc==62){$var='NF';}
elseif($num_suc==63){$var='NL';}
elseif($num_suc==64){$var='NR';}
elseif($num_suc==65){$var='NX';}

elseif($num_suc==66){$var='OD';}
elseif($num_suc==67){$var='OJ';}
elseif($num_suc==68){$var='OP';}
elseif($num_suc==69){$var='OV';}
elseif($num_suc==70){$var='PB';}
elseif($num_suc==71){$var='PH';}
elseif($num_suc==72){$var='PN';}
elseif($num_suc==73){$var='PT';}
elseif($num_suc==74){$var='PZ';}
elseif($num_suc==75){$var='QF';}
elseif($num_suc==76){$var='QL';}
elseif($num_suc==77){$var='QR';}
elseif($num_suc==78){$var='QX';}

elseif($num_suc==79){$var='RD';}
elseif($num_suc==80){$var='RJ';}
elseif($num_suc==81){$var='RP';}
elseif($num_suc==82){$var='RV';}
elseif($num_suc==83){$var='SB';}
elseif($num_suc==84){$var='SH';}
elseif($num_suc==85){$var='SN';}
elseif($num_suc==86){$var='ST';}
elseif($num_suc==87){$var='SZ';}
elseif($num_suc==88){$var='TF';}
elseif($num_suc==89){$var='TL';}
elseif($num_suc==90){$var='TR';}
elseif($num_suc==91){$var='TX';}

elseif($num_suc==92){$var='UD';}
elseif($num_suc==93){$var='UJ';}
elseif($num_suc==94){$var='UP';}
elseif($num_suc==95){$var='UV';}
elseif($num_suc==96){$var='VB';}
elseif($num_suc==97){$var='VH';}
elseif($num_suc==98){$var='VN';}
elseif($num_suc==99){$var='VT';}
elseif($num_suc==100){$var='VZ';}
return $var;
}
function __letra5($num_suc)
{
    if($num_suc==1){$var='E';}
elseif($num_suc==2){$var='K';}
elseif($num_suc==3){$var='Q';}
elseif($num_suc==4){$var='W';}
elseif($num_suc==5){$var='AC';}
elseif($num_suc==6){$var='AI';}
elseif($num_suc==7){$var='AO';}
elseif($num_suc==8){$var='AU';}
elseif($num_suc==9){$var='BA';}
elseif($num_suc==10){$var='BG';}
elseif($num_suc==11){$var='BM';}
elseif($num_suc==12){$var='BS';}
elseif($num_suc==13){$var='BY';}

elseif($num_suc==14){$var='CE';}
elseif($num_suc==15){$var='CK';}
elseif($num_suc==16){$var='CQ';}
elseif($num_suc==17){$var='CW';}
elseif($num_suc==18){$var='DC';}
elseif($num_suc==19){$var='DI';}
elseif($num_suc==20){$var='DO';}
elseif($num_suc==21){$var='DU';}
elseif($num_suc==22){$var='EA';}
elseif($num_suc==23){$var='EG';}
elseif($num_suc==24){$var='EM';}
elseif($num_suc==25){$var='ED';}
elseif($num_suc==26){$var='EY';}

elseif($num_suc==27){$var='FE';}
elseif($num_suc==28){$var='FK';}
elseif($num_suc==29){$var='FQ';}
elseif($num_suc==30){$var='FW';}
elseif($num_suc==31){$var='GC';}
elseif($num_suc==32){$var='GI';}
elseif($num_suc==33){$var='GO';}
elseif($num_suc==34){$var='GU';}
elseif($num_suc==35){$var='HA';}
elseif($num_suc==36){$var='HG';}
elseif($num_suc==37){$var='HM';}
elseif($num_suc==38){$var='HD';}
elseif($num_suc==39){$var='HY';}

elseif($num_suc==40){$var='IE';}
elseif($num_suc==41){$var='IK';}
elseif($num_suc==42){$var='IQ';}
elseif($num_suc==43){$var='IW';}
elseif($num_suc==44){$var='JC';}
elseif($num_suc==45){$var='JI';}
elseif($num_suc==46){$var='JO';}
elseif($num_suc==47){$var='JU';}
elseif($num_suc==48){$var='KA';}
elseif($num_suc==49){$var='KG';}
elseif($num_suc==50){$var='KM';}
elseif($num_suc==51){$var='KD';}
elseif($num_suc==52){$var='KY';}

elseif($num_suc==53){$var='LE';}
elseif($num_suc==54){$var='LK';}
elseif($num_suc==55){$var='LQ';}
elseif($num_suc==56){$var='LW';}
elseif($num_suc==57){$var='MC';}
elseif($num_suc==58){$var='MI';}
elseif($num_suc==59){$var='MO';}
elseif($num_suc==60){$var='MU';}
elseif($num_suc==61){$var='NA';}
elseif($num_suc==62){$var='NG';}
elseif($num_suc==63){$var='NM';}
elseif($num_suc==64){$var='ND';}
elseif($num_suc==65){$var='NY';}

elseif($num_suc==66){$var='OE';}
elseif($num_suc==67){$var='OK';}
elseif($num_suc==68){$var='OQ';}
elseif($num_suc==69){$var='OW';}
elseif($num_suc==70){$var='PC';}
elseif($num_suc==71){$var='PI';}
elseif($num_suc==72){$var='PO';}
elseif($num_suc==73){$var='PU';}
elseif($num_suc==74){$var='QA';}
elseif($num_suc==75){$var='QG';}
elseif($num_suc==76){$var='QM';}
elseif($num_suc==77){$var='QD';}
elseif($num_suc==78){$var='QY';}

elseif($num_suc==79){$var='RE';}
elseif($num_suc==80){$var='RK';}
elseif($num_suc==81){$var='RQ';}
elseif($num_suc==82){$var='RW';}
elseif($num_suc==83){$var='SC';}
elseif($num_suc==84){$var='SI';}
elseif($num_suc==85){$var='SO';}
elseif($num_suc==86){$var='SU';}
elseif($num_suc==87){$var='TA';}
elseif($num_suc==88){$var='TG';}
elseif($num_suc==89){$var='TM';}
elseif($num_suc==90){$var='TD';}
elseif($num_suc==91){$var='TY';}

elseif($num_suc==92){$var='UE';}
elseif($num_suc==93){$var='UK';}
elseif($num_suc==94){$var='UQ';}
elseif($num_suc==95){$var='UW';}
elseif($num_suc==96){$var='VC';}
elseif($num_suc==97){$var='VI';}
elseif($num_suc==98){$var='VO';}
elseif($num_suc==99){$var='VU';}
elseif($num_suc==100){$var='WA';}
return $var;
}


