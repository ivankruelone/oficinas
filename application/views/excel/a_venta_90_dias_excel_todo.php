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

$rm=$nom->row();
//*********************************************************************************************************titulo global
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'VENTA DE SUCURSALES DE 90 DIAS')->mergeCells('A1:CR1')->getStyle()->getFont()->setBold(true);
            ;
 $objPHPExcel->getActiveSheet(0)->getStyle('A1:CR3')
                                  ->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'REGIONAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', 'ZONA');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', 'SUPERVISOR');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', 'NID');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', 'SUCURSAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', $rm->d1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', $rm->d2);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H3', $rm->d3);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I3', $rm->d4);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J3', $rm->d5);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K3', $rm->d6);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L3', $rm->d7);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M3', $rm->d8);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N3', $rm->d9);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O3', $rm->d10);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P3', $rm->d11);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q3', $rm->d12);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R3', $rm->d13);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S3', $rm->d14);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T3', $rm->d15);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U3', $rm->d16);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V3', $rm->d17);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W3', $rm->d18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X3', $rm->d19);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y3', $rm->d20);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z3', $rm->d21);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA3', $rm->d22);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB3', $rm->d23);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC3', $rm->d24);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD3', $rm->d25);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE3', $rm->d26);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF3', $rm->d27);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG3', $rm->d28);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AH3', $rm->d29);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AY3', $rm->d30);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ3', $rm->d31);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK3', $rm->d32);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL3', $rm->d33);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AM3', $rm->d34);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN3', $rm->d35);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AO3', $rm->d36);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AP3', $rm->d37);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AQ3', $rm->d38);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AR3', $rm->d39);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AS3', $rm->d40);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT3', $rm->d41);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AU3', $rm->d42);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AV3', $rm->d43);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AW3', $rm->d44);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AX3', $rm->d45);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AY3', $rm->d46);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AZ3', $rm->d47);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BA3', $rm->d48);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BB3', $rm->d49);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BC3', $rm->d50);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BD3', $rm->d51);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BE3', $rm->d52);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BF3', $rm->d53);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BG3', $rm->d54);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BH3', $rm->d55);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BI3', $rm->d56);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BJ3', $rm->d57);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BK3', $rm->d58);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BL3', $rm->d59);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BM3', $rm->d60);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BN3', $rm->d61);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BO3', $rm->d62);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BP3', $rm->d63);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BQ3', $rm->d64);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BR3', $rm->d65);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BS3', $rm->d66);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BT3', $rm->d67);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BU3', $rm->d68);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BV3', $rm->d69);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BW3', $rm->d70);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BX3', $rm->d71);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BY3', $rm->d72);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BZ3', $rm->d73);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CA3', $rm->d74);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CB3', $rm->d75);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CC3', $rm->d76);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CD3', $rm->d77);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CE3', $rm->d78);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CF3', $rm->d79);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CG3', $rm->d80);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CH3', $rm->d81);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CI3', $rm->d82);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CJ3', $rm->d83);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CK3', $rm->d84);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CL3', $rm->d85);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CM3', $rm->d86);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CN3', $rm->d87);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CO3', $rm->d88);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CP3', $rm->d89);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CQ3', $rm->d90);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CR3', 'IMAGEN');
//*********************************************************************************************************titulo global
//***************************************************T******************************************************titulo rentas
//*********************************************************************************************************titulo global
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle rentas
$ini=4;
$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$tot8=0;$tot9=0;$tot10=0;
$tot11=0;$tot12=0;$tot13=0;$tot14=0;$tot15=0;$tot16=0;$tot17=0;$tot18=0;$tot19=0;$tot20=0;
$tot21=0;$tot22=0;$tot23=0;$tot24=0;$tot25=0;$tot26=0;$tot27=0;$tot28=0;$tot29=0;$tot30=0;
$tot31=0;$tot32=0;$tot33=0;$tot34=0;$tot35=0;$tot36=0;$tot37=0;$tot38=0;$tot39=0;$tot40=0;
$tot41=0;$tot42=0;$tot43=0;$tot44=0;$tot45=0;$tot46=0;$tot47=0;$tot48=0;$tot49=0;$tot50=0;
$tot51=0;$tot52=0;$tot53=0;$tot54=0;$tot55=0;$tot56=0;$tot57=0;$tot58=0;$tot59=0;$tot60=0;
$tot61=0;$tot62=0;$tot63=0;$tot64=0;$tot65=0;$tot66=0;$tot67=0;$tot68=0;$tot69=0;$tot70=0;
$tot71=0;$tot72=0;$tot73=0;$tot74=0;$tot75=0;$tot76=0;$tot77=0;$tot78=0;$tot79=0;$tot80=0;
$tot81=0;$tot82=0;$tot83=0;$tot84=0;$tot85=0;$tot86=0;$tot87=0;$tot88=0;$tot89=0;$tot90=0;
foreach($q1->result()as $r1)
{

$objPHPExcel->getActiveSheet(0)->getStyle('A'.$ini.':J'.$ini)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLACK);    
    //mes, mesx, suc, sucx, imp, ivaf, isrf, iva_isrf, total, total_mn
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$ini, $r1->regional);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$ini, $r1->superv);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$ini, $r1->supervx);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$ini, $r1->suc);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$ini, $r1->sucx);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$ini, $r1->dia1);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$ini, $r1->dia2);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$ini, $r1->dia3);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$ini, $r1->dia4);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$ini, $r1->dia5);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$ini, $r1->dia6);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$ini, $r1->dia7);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$ini, $r1->dia8);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$ini, $r1->dia9);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$ini, $r1->dia10);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$ini, $r1->dia11);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$ini, $r1->dia12);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$ini, $r1->dia13);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$ini, $r1->dia14);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$ini, $r1->dia15);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$ini, $r1->dia16);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$ini, $r1->dia17);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.$ini, $r1->dia18);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.$ini, $r1->dia19);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.$ini, $r1->dia20);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.$ini, $r1->dia21);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.$ini, $r1->dia22);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.$ini, $r1->dia23);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.$ini, $r1->dia24);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.$ini, $r1->dia25);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE'.$ini, $r1->dia26);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF'.$ini, $r1->dia27);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG'.$ini, $r1->dia28);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AH'.$ini, $r1->dia29);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI'.$ini, $r1->dia30);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ'.$ini, $r1->dia31);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK'.$ini, $r1->dia32);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL'.$ini, $r1->dia33);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AM'.$ini, $r1->dia34);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN'.$ini, $r1->dia35);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AO'.$ini, $r1->dia36);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AP'.$ini, $r1->dia37);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AQ'.$ini, $r1->dia38);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AR'.$ini, $r1->dia39);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AS'.$ini, $r1->dia40);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT'.$ini, $r1->dia41);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AU'.$ini, $r1->dia42);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AV'.$ini, $r1->dia43);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AW'.$ini, $r1->dia44);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AX'.$ini, $r1->dia45);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AY'.$ini, $r1->dia46);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AZ'.$ini, $r1->dia47);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BA'.$ini, $r1->dia48);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BB'.$ini, $r1->dia49);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BC'.$ini, $r1->dia50);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BD'.$ini, $r1->dia51);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BE'.$ini, $r1->dia52);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BF'.$ini, $r1->dia53);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BG'.$ini, $r1->dia54);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BH'.$ini, $r1->dia55);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BI'.$ini, $r1->dia56);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BJ'.$ini, $r1->dia57);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BK'.$ini, $r1->dia58);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BL'.$ini, $r1->dia59);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BM'.$ini, $r1->dia60);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BN'.$ini, $r1->dia61);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BO'.$ini, $r1->dia62);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BP'.$ini, $r1->dia63);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BQ'.$ini, $r1->dia64);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BR'.$ini, $r1->dia65);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BS'.$ini, $r1->dia66);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BT'.$ini, $r1->dia67);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BU'.$ini, $r1->dia68);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BV'.$ini, $r1->dia69);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BW'.$ini, $r1->dia70);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BX'.$ini, $r1->dia71);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BY'.$ini, $r1->dia72);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('BZ'.$ini, $r1->dia73);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CA'.$ini, $r1->dia74);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CB'.$ini, $r1->dia75);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CC'.$ini, $r1->dia76);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CD'.$ini, $r1->dia77);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CE'.$ini, $r1->dia78);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CF'.$ini, $r1->dia79);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CG'.$ini, $r1->dia80);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CH'.$ini, $r1->dia81);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CI'.$ini, $r1->dia82);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CJ'.$ini, $r1->dia83);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CK'.$ini, $r1->dia84);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CL'.$ini, $r1->dia85);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CM'.$ini, $r1->dia86);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CN'.$ini, $r1->dia87);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CO'.$ini, $r1->dia88);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CP'.$ini, $r1->dia89);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CQ'.$ini, $r1->dia90);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('CR'.$ini, $r1->tipo3);
            
            $objPHPExcel->getActiveSheet()->getStyle('E5:'.'CR'.$ini)->getNumberFormat()->setFormatCode('#,#00.00');
$ini=$ini+1;
$tot1=$tot1+$r1->dia1;$tot2=$tot2+$r1->dia2;$tot3=$tot3+$r1->dia3;$tot4=$tot4+$r1->dia4;$tot5=$tot5+$r1->dia5;
$tot6=$tot6+$r1->dia6;$tot7=$tot7+$r1->dia7;$tot8=$tot8+$r1->dia8;$tot9=$tot9+$r1->dia9;$tot10=$tot10+$r1->dia10;
$tot11=$tot11+$r1->dia11;$tot12=$tot12+$r1->dia12;$tot13=$tot13+$r1->dia13;$tot14=$tot14+$r1->dia14;$tot15=$tot15+$r1->dia15;
$tot16=$tot16+$r1->dia16;$tot17=$tot17+$r1->dia17;$tot18=$tot18+$r1->dia18;$tot19=$tot19+$r1->dia19;$tot20=$tot20+$r1->dia20;
$tot21=$tot21+$r1->dia21;$tot22=$tot22+$r1->dia22;$tot23=$tot23+$r1->dia23;$tot24=$tot24+$r1->dia24;$tot25=$tot25+$r1->dia25;
$tot26=$tot26+$r1->dia26;$tot27=$tot27+$r1->dia27;$tot28=$tot28+$r1->dia28;$tot29=$tot29+$r1->dia29;$tot30=$tot30+$r1->dia30;
$tot31=$tot31+$r1->dia31;$tot32=$tot32+$r1->dia32;$tot33=$tot33+$r1->dia33;$tot34=$tot34+$r1->dia34;$tot35=$tot35+$r1->dia35;
$tot36=$tot36+$r1->dia36;$tot37=$tot37+$r1->dia37;$tot38=$tot38+$r1->dia38;$tot39=$tot39+$r1->dia39;$tot40=$tot40+$r1->dia40;
$tot41=$tot41+$r1->dia41;$tot42=$tot42+$r1->dia42;$tot43=$tot43+$r1->dia43;$tot44=$tot44+$r1->dia44;$tot45=$tot45+$r1->dia45;
$tot46=$tot46+$r1->dia46;$tot47=$tot47+$r1->dia47;$tot48=$tot48+$r1->dia48;$tot49=$tot49+$r1->dia49;$tot50=$tot50+$r1->dia50;
$tot51=$tot51+$r1->dia51;$tot52=$tot52+$r1->dia52;$tot53=$tot53+$r1->dia53;$tot54=$tot54+$r1->dia54;$tot55=$tot55+$r1->dia55;
$tot56=$tot56+$r1->dia56;$tot57=$tot57+$r1->dia57;$tot58=$tot58+$r1->dia58;$tot59=$tot59+$r1->dia59;$tot60=$tot60+$r1->dia60;
$tot61=$tot61+$r1->dia61;$tot62=$tot62+$r1->dia62;$tot63=$tot63+$r1->dia63;$tot64=$tot64+$r1->dia64;$tot65=$tot65+$r1->dia65;
$tot66=$tot66+$r1->dia66;$tot67=$tot67+$r1->dia67;$tot68=$tot68+$r1->dia68;$tot69=$tot69+$r1->dia69;$tot70=$tot70+$r1->dia70;
$tot71=$tot71+$r1->dia71;$tot72=$tot72+$r1->dia72;$tot73=$tot73+$r1->dia73;$tot74=$tot74+$r1->dia74;$tot75=$tot75+$r1->dia75;
$tot76=$tot76+$r1->dia76;$tot77=$tot77+$r1->dia77;$tot78=$tot78+$r1->dia78;$tot79=$tot79+$r1->dia79;$tot80=$tot80+$r1->dia80;
$tot81=$tot81+$r1->dia81;$tot82=$tot82+$r1->dia82;$tot83=$tot83+$r1->dia83;$tot84=$tot84+$r1->dia84;$tot85=$tot85+$r1->dia85;
$tot86=$tot86+$r1->dia86;$tot87=$tot87+$r1->dia87;$tot88=$tot88+$r1->dia88;$tot89=$tot89+$r1->dia89;$tot90=$tot90+$r1->dia90;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle rentas
///////////////////////////////////////////////////////////////////////////////////////////////////////////detalle ventas costo
/////////////////////////////////////////////////////////////// ////////////////////////////////////////////detalle PORCENTUAL
//die();
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('e'.$ini, 'TOTAL');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$ini, $tot1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$ini, $tot2);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$ini, $tot3);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$ini, $tot4);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$ini, $tot5);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$ini, $tot6);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$ini, $tot7);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$ini, $tot8);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$ini, $tot9);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$ini, $tot10);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$ini, $tot11);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$ini, $tot12);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$ini, $tot13);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$ini, $tot14);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$ini, $tot15);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$ini, $tot16);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$ini, $tot17);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.$ini, $tot18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.$ini, $tot19);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.$ini, $tot20);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z'.$ini, $tot21);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.$ini, $tot22);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB'.$ini, $tot23);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AC'.$ini, $tot24);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AD'.$ini, $tot25);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE'.$ini, $tot26);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AF'.$ini, $tot27);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AG'.$ini, $tot28);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AH'.$ini, $tot29);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AI'.$ini, $tot30);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AJ'.$ini, $tot31);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AK'.$ini, $tot32);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AL'.$ini, $tot33);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AM'.$ini, $tot34);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AN'.$ini, $tot35);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AO'.$ini, $tot36);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AP'.$ini, $tot37);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AQ'.$ini, $tot38);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AR'.$ini, $tot39);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AS'.$ini, $tot40);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AT'.$ini, $tot41);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AU'.$ini, $tot42);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AV'.$ini, $tot43);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AW'.$ini, $tot44);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AX'.$ini, $tot45);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AY'.$ini, $tot46);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AZ'.$ini, $tot47);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BA'.$ini, $tot48);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BB'.$ini, $tot49);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BC'.$ini, $tot50);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BD'.$ini, $tot51);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BE'.$ini, $tot52);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BF'.$ini, $tot53);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BG'.$ini, $tot54);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BH'.$ini, $tot55);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BI'.$ini, $tot56);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BJ'.$ini, $tot57);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BK'.$ini, $tot58);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BL'.$ini, $tot59);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BM'.$ini, $tot60);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BN'.$ini, $tot61);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BO'.$ini, $tot62);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BP'.$ini, $tot63);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BQ'.$ini, $tot64);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BR'.$ini, $tot65);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BS'.$ini, $tot66);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BT'.$ini, $tot67);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BU'.$ini, $tot68);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BV'.$ini, $tot69);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BW'.$ini, $tot70);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BX'.$ini, $tot71);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BY'.$ini, $tot72);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('BZ'.$ini, $tot73);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CA'.$ini, $tot74);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CB'.$ini, $tot75);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CC'.$ini, $tot76);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CD'.$ini, $tot77);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CE'.$ini, $tot78);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CF'.$ini, $tot79);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CG'.$ini, $tot80);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CH'.$ini, $tot81);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CI'.$ini, $tot82);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CJ'.$ini, $tot83);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CK'.$ini, $tot84);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CL'.$ini, $tot85);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CM'.$ini, $tot86);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CN'.$ini, $tot87);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CO'.$ini, $tot88);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CP'.$ini, $tot89);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CQ'.$ini, $tot90);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('CR'.$ini, ' ');




//////////////////////////////////////////////////////////////////////////////////////////
$objPHPExcel->setActiveSheetIndex(0);
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

//$objPHPExcel->getActiveSheet(0)->getStyle('A2:'.'J'.$ini)->getFill()
//                              ->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);
//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////
/////marca las celdas de impresion
//$objPHPExcel->getActiveSheet()->getSheetView()->setView(PHPExcel_Worksheet_SheetView::SHEETVIEW_PAGE_BREAK_PREVIEW);



// Rename sheet
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);
$objPHPExcel->getActiveSheet(0)->setTitle('Venta');




//die();
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename='.$nombre);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;

