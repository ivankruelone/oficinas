<?php
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
/** PHPExcel */
$this->load->model('catalogos_model');
require_once 'Classes/PHPExcel.php';
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Create new PHPExcel object
$cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
if (!PHPExcel_Settings::setCacheStorageMethod($cacheMethod)) {
	die($cacheMethod . " caching method is not available" . EOL);
}
// Set document properties
$objPHPExcel->getProperties()->setCreator("LIDIA VELAZQUEZ")
							 ->setLastModifiedBy("LIDIA VELAZQUEZ")
							 ->setTitle("DESPLAZAMIENTO DE PRODUCTOS")
							 ->setSubject("DESPLAZAMIENTO DE PRODUCTOS")
							 ->setDescription("DESPLAZAMIENTO DE PRODUCTOS")
							 ->setKeywords("Pedido")
							 ->setCategory("Pedido");
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('a1', 'PEDIDO DE MERCANCIA');
$objPHPExcel->getActiveSheet()->mergeCells("A1:u1"); //unir celdas

            
// Add some data

$t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$t13=0;$t14=0;$t15=0;$t16=0;$t17=0;$t18=0;$t19=0;$t20=0;
$v1=0;$v2=0;$v3=0;$v4=0;$v5=0;$v6=0;$v7=0;$v8=0;$v9=0;$v10=0;$v11=0;$v12=0;$v13=0;$v14=0;$v15=0;$v16=0;$v17=0;$v18=0;$v19=0;
$vx1=0;$vx2=0;$vx3=0;$vx4=0;$vx5=0;$vx6=0;$vx7=0;$vx8=0;$vx9=0;$vx10=0;$vx11=0;$vx12=0;$vx13=0;$vx14=0;$vx15=0;$vx16=0;$vx17=0;$vx18=0;$vx19=0;
$ini=2;$tot=0;$numx=2;
foreach ($a as $row)
{
$suc=$row['suc'];
$id=$row['id'];
$s="SELECT codigo,descri,a.fecha1,fecha2,rel1,rel2,ped 
            FROM compras.pedido_dema_c a
            join compras.pedido_dema_d b on b.id_cc=a.id
            where a.id=$id  and suc=$suc group by codigo,b.suc order by codigo";
$q=$this->db->query($s);
$num=3;
foreach($q->result() as $r){

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('a'.$num, $r->codigo);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('b'.$num, $r->descri);
if($row['suc']==103){$vx1=$row['sucx'];$v1=$r->ped;$t1=$t1+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('c'.$num, $v1);}
if($row['suc']==105){$vx2=$row['sucx'];$v2=$r->ped;$t2=$t2+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('d'.$num, $v2);}
if($row['suc']==106){$vx3=$row['sucx'];$v3=$r->ped;$t3=$t3+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('e'.$num, $v3);}
if($row['suc']==107){$vx4=$row['sucx'];$v4=$r->ped;$t4=$t4+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('f'.$num, $v4);}
if($row['suc']==108){$vx5=$row['sucx'];$v5=$r->ped;$t5=$t5+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('g'.$num, $v5);}
if($row['suc']==109){$vx6=$row['sucx'];$v6=$r->ped;$t6=$t6+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('h'.$num, $v6);}
if($row['suc']==112){$vx7=$row['sucx'];$v7=$r->ped;$t7=$t7+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('i'.$num, $v7);}
if($row['suc']==114){$vx8=$row['sucx'];$v8=$r->ped;$t8=$t8+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('j'.$num, $v8);}
if($row['suc']==116){$vx9=$row['sucx'];$v9=$r->ped;$t9=$t9+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('k'.$num, $v9);}
if($row['suc']==129){$vx10=$row['sucx'];$v10=$r->ped;$t10=$t10+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('l'.$num, $v10);}
if($row['suc']==193){$vx11=$row['sucx'];$v11=$r->ped;$t11=$t11+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('m'.$num, $v11);}
if($row['suc']==201){$vx12=$row['sucx'];$v12=$r->ped;$t12=$t12+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('n'.$num, $v12);}
if($row['suc']==202){$vx13=$row['sucx'];$v13=$r->ped;$t13=$t13+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('o'.$num, $v13);}
if($row['suc']==501){$vx14=$row['sucx'];$v14=$r->ped;$t14=$t14+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('p'.$num, $v14);}
if($row['suc']==504){$vx15=$row['sucx'];$v15=$r->ped;$t15=$t15+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('q'.$num, $v15);}
if($row['suc']==511){$vx16=$row['sucx'];$v16=$r->ped;$t16=$t16+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('r'.$num, $v16);}
if($row['suc']==552){$vx17=$row['sucx'];$v17=$r->ped;$t17=$t17+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('s'.$num, $v17);}
if($row['suc']==806){$vx18=$row['sucx'];$v18=$r->ped;$t18=$t18+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('t'.$num, $v18);}
if($row['suc']==812){$vx19=$row['sucx'];$v19=$r->ped;$t19=$t19+$r->ped;$objPHPExcel->setActiveSheetIndex(0)->setCellValue('u'.$num, $v19);}
$num++;

if($num>$numx){$numx=$num;}
}
$v1=0;$v2=0;$v3=0;$v4=0;$v5=0;$v6=0;$v7=0;$v8=0;$v9=0;$v10=0;$v11=0;$v12=0;$v13=0;$v14=0;$v15=0;$v16=0;$v17=0;$v18=0;$v19=0;
$tot=0;
}

//die();
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('a2', 'CODIGO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('b2', 'DESCRIPCION');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', $vx1);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', $vx2);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', $vx3);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', $vx4);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', $vx5);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', $vx6);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', $vx7);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J2', $vx8);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K2', $vx9);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L2', $vx10);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M2', $vx11);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N2', $vx12);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O2', $vx13);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P2', $vx14);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q2', $vx15);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R2', $vx16);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S2', $vx17);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T2', $vx18);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('U2', $vx19);

        $num2 = $num - 1;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$numx, '')
            ->setCellValue('B'.$numx, '')
            ->setCellValue('C'.$numx, $t1)
            ->setCellValue('D'.$numx, $t2)
            ->setCellValue('E'.$numx, $t3)
            ->setCellValue('F'.$numx, $t4)
            ->setCellValue('G'.$numx, $t5)
            ->setCellValue('H'.$numx, $t6)
            ->setCellValue('I'.$numx, $t7)
            ->setCellValue('J'.$numx, $t8)
            ->setCellValue('K'.$numx, $t9)
            ->setCellValue('L'.$numx, $t10)
            ->setCellValue('M'.$numx, $t11)
            ->setCellValue('N'.$numx, $t12)
            ->setCellValue('O'.$numx, $t13)
            ->setCellValue('P'.$numx, $t14)
            ->setCellValue('Q'.$numx, $t15)
            ->setCellValue('R'.$numx, $t16)
            ->setCellValue('S'.$numx, $t17)
            ->setCellValue('T'.$numx, $t18)
            ->setCellValue('U'.$numx, $t19)

            ;

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('b')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('c')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('d')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('e')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('f')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('g')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('h')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('i')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('j')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('k')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('l')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('m')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('n')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('o')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('p')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('q')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('r')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('s')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('t')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('u')->setWidth(10);

$bordes = new PHPExcel_Style(); //nuevo estilo
 
$bordes->applyFromArray(
  array('borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));


$objPHPExcel->getActiveSheet()->getStyle('A1:u1')->getFont()->setBold(true); //renegridas
$objPHPExcel->getActiveSheet()->getStyle('a2:u2')->getAlignment()->setIndent(0)
->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS)->setWrapText(true);//alinear justificado y centrado
$objPHPExcel->getActiveSheet(0)->getStyle('A1:v2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_GRADIENT_PATH);//sombreda la celda 2 colores
$objPHPExcel->getActiveSheet()->setSharedStyle($bordes, 'a3:v'.$numx);//Borde alineado en 1

$objPHPExcel->getActiveSheet()->getStyle('A2:u2')->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getStyle('a3:a'.$numx)->getNumberFormat()->setFormatCode('##0');//formato de numero

$objPHPExcel->getActiveSheet()->getStyle('d3:u'.$numx)->getAlignment()->setIndent(0)//alinear datos 
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->getStyle('c3:u'.$numx)->getNumberFormat()->setFormatCode('#,#0');//formato de numero


$objPHPExcel->getActiveSheet()->getStyle('a'.$numx.':u'.$numx)->getFont()->setBold(true);//renegridas



// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('DEMA');

$nom = "Pedido por sucursal.xls";
// Echo memory peak usage


//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
//$objWriter->save($_SERVER['DOCUMENT_ROOT']."/oficinas/correos/".$nom);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=".$nom);
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
