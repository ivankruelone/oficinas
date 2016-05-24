                 <div class="span12">
                     
<!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange_rbcontent">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla0">
                             <thead>
                                 <tr>
                                 <th colspan="2" style="text-align: center; color:green"><?php echo $a?></th>
                                 <th colspan="2" style="text-align: center; color:blue"><?php echo $b?></th>
                                 <th colspan="2" style="text-align: center; color:green"><?php echo $c?></th>
                                 <th colspan="2" style="text-align: center; color:blue"><?php echo $d?></th>
                                 <th colspan="2" style="text-align: center; color:green"><?php echo $e?></th>
                                 <th colspan="2" style="text-align: center; color:black">TOTAL COMPRA</th>
                                 </tr>
                                 <tr>
                                     
                                     <th style="text-align: center; color:green">Compra</th>
                                     <th style="text-align: center; color:green">Importe</th>
                                     <th style="text-align: center; color:blue">Compra</th>
                                     <th style="text-align: center; color:blue">Importe</th>
                                     <th style="text-align: center; color:green">Compra</th>
                                     <th style="text-align: center; color:green">Importe</th>
                                     <th style="text-align: center; color:blue">Compra</th>
                                     <th style="text-align: center; color:blue">Importe</th>
                                     <th style="text-align: center; color:green">Compra</th>
                                     <th style="text-align: center; color:green">Importe</th>
                                     <th style="text-align: center; color:black">Compra</th>
                                     <th style="text-align: center; color:black">Importe</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$pi=0;$im=0;
                                foreach ($q2->result()as $r2){
                                $pi=($r2->compra_a+$r2->compra_b+$r2->compra_c+$r2->compra_d+$r2->compra_e);
                                $im=($r2->importe_a+$r2->importe_b+$r2->importe_c+$r2->importe_d+$r2->importe_e);
                                if($pi > 0){
                                ?>
                                <tr>
                                <td style="color:<?php echo $color3?>; text-align: right"><?php echo number_format($r2->compra_a,0)?></td>
                                <td style="color:<?php echo $color3?>; text-align: right"><?php echo number_format($r2->importe_a,2)?></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><?php echo number_format($r2->compra_b,0)?></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><?php echo number_format($r2->importe_b,2)?></td>
                                <td style="color:<?php echo $color3?>; text-align: right"><?php echo number_format($r2->compra_c,0)?></td>
                                <td style="color:<?php echo $color3?>; text-align: right"><?php echo number_format($r2->importe_c,2)?></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><?php echo number_format($r2->compra_d,0)?></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><?php echo number_format($r2->importe_d,2)?></td>
                                <td style="color:<?php echo $color3?>; text-align: right"><?php echo number_format($r2->compra_e,0)?></td>
                                <td style="color:<?php echo $color3?>; text-align: right"><?php echo number_format($r2->importe_e,2)?></td>
                                <td style="color:<?php echo $color1?>; text-align: right"><?php echo number_format($pi,0)?></td>
                                <td style="color:<?php echo $color1?>; text-align: right"><?php echo number_format($im,2)?></td>
                                
                                </tr>
                               <?php 
                                }
                                }
                                 ?>
                              </tbody>
                              <tfoot>
                              
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
<!-- BEGIN BLANK PAGE PORTLET-->
<!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th colspan="2" style="text-align: center; color:gray"></th>
                                 <th colspan="2" style="text-align: center; color:green"><?php echo $a?></th>
                                 <th colspan="2" style="text-align: center; color:blue"><?php echo $b?></th>
                                 <th colspan="2" style="text-align: center; color:green"><?php echo $c?></th>
                                 <th colspan="2" style="text-align: center; color:blue"><?php echo $d?></th>
                                 <th colspan="2" style="text-align: center; color:green"><?php echo $e?></th>
                                 <th colspan="2" style="text-align: center; color:black">TOTAL COMPRA</th>
                                 </tr>
                                 <tr>
                                     <th style="text-align: center; color:gray">Prv</th>
                                     <th style="text-align: center; color:gray">Provedor</th>
                                     <th style="text-align: center; color:green">Compra</th>
                                     <th style="text-align: center; color:green">Importe</th>
                                     <th style="text-align: center; color:blue">Compra</th>
                                     <th style="text-align: center; color:blue">Importe</th>
                                     <th style="text-align: center; color:green">Compra</th>
                                     <th style="text-align: center; color:green">Importe</th>
                                     <th style="text-align: center; color:blue">Compra</th>
                                     <th style="text-align: center; color:blue">Importe</th>
                                     <th style="text-align: center; color:green">Compra</th>
                                     <th style="text-align: center; color:green">Importe</th>
                                     <th style="text-align: center; color:black">Compra</th>
                                     <th style="text-align: center; color:black">Importe</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$pi=0;$im=0;
                                foreach ($q1->result()as $r1){
                                $pi=($r1->compra_a+$r1->compra_b+$r1->compra_c+$r1->compra_d+$r1->compra_e);
                                $im=($r1->importe_a+$r1->importe_b+$r1->importe_c+$r1->importe_d+$r1->importe_e);
                                if($pi > 0){
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->prv?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->prvx?></td>
                                <td style="color:<?php echo $color3?>; text-align: right"><?php echo number_format($r1->compra_a,0)?></td>
                                <td style="color:<?php echo $color3?>; text-align: right"><?php echo number_format($r1->importe_a,2)?></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><?php echo number_format($r1->compra_b,0)?></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><?php echo number_format($r1->importe_b,2)?></td>
                                <td style="color:<?php echo $color3?>; text-align: right"><?php echo number_format($r1->compra_c,0)?></td>
                                <td style="color:<?php echo $color3?>; text-align: right"><?php echo number_format($r1->importe_c,2)?></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><?php echo number_format($r1->compra_d,0)?></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><?php echo number_format($r1->importe_d,2)?></td>
                                <td style="color:<?php echo $color3?>; text-align: right"><?php echo number_format($r1->compra_e,0)?></td>
                                <td style="color:<?php echo $color3?>; text-align: right"><?php echo number_format($r1->importe_e,2)?></td>
                                <td style="color:<?php echo $color1?>; text-align: right"><?php echo number_format($pi,0)?></td>
                                <td style="color:<?php echo $color1?>; text-align: right"><?php echo number_format($im,2)?></td>
                                
                                </tr>
                               <?php 
                                $t1=$t1+$r1->compra_a;
                                $t2=$t2+$r1->importe_a;
                                $t3=$t3+$r1->compra_b;
                                $t4=$t4+$r1->importe_b;
                                $t5=$t5+$r1->compra_c;
                                $t6=$t6+$r1->importe_c;
                                $t7=$t7+$r1->compra_d;
                                $t8=$t8+$r1->importe_d;
                                $t9=$t9+$r1->compra_e;
                                $t10=$t10+$r1->importe_e;
                                $t11=$t11+$pi;
                                $t12=$t12+$im;
                                $pi=0;$im=0;
                                }}
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td style="color: <?php echo $color?>; text-align: right" colspan="2"><strong>TOTAL</strong></td>
                              <td style="color:<?php echo $color3?>; text-align: right"><strong><?php echo number_format($t1,0)?></strong></td>
                              <td style="color:<?php echo $color3?>; text-align: right"><strong><?php echo number_format($t2,2)?></strong></td>
                              <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($t3,0)?></strong></td>
                              <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($t4,2)?></strong></td>
                              <td style="color:<?php echo $color3?>; text-align: right"><strong><?php echo number_format($t5,0)?></strong></td>
                              <td style="color:<?php echo $color3?>; text-align: right"><strong><?php echo number_format($t6,2)?></strong></td>
                              <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($t7,0)?></strong></td>
                              <td style="color:<?php echo $color2?>; text-align: right"><strong><?php echo number_format($t8,2)?></strong></td>
                              <td style="color:<?php echo $color3?>; text-align: right"><strong><?php echo number_format($t9,0)?></strong></td>
                              <td style="color:<?php echo $color3?>; text-align: right"><strong><?php echo number_format($t10,2)?></strong></td>
                              <td style="color:<?php echo $color1?>; text-align: right"><strong><?php echo number_format($t11,0)?></strong></td>
                              <td style="color:<?php echo $color1?>; text-align: right"><strong><?php echo number_format($t12,2)?></strong></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
<!-- BEGIN BLANK PAGE PORTLET-->

                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php 
$replaced = str_replace(",","-",$sec);
$l0 = anchor('evaluacion/eval_cedis_graba/'.$por1.'/'.$por2.'/'.$por3.'/'.$por4.'/'.$por5.'/'.$var.'/'.$prv.'/'.$replaced,'Genera Compra</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));;
?>                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                             <tr>
                             <th colspan="12"><?php echo $l0?></th>
                             </tr>
                                 <tr>
                                     <th style="text-align: center">Sec</th>
                                     <th style="text-align: center">Sustancia</th>  
                                     <th style="text-align: center">Clas</th>
                                     <th style="text-align: center">Prv</th>
                                     <th style="text-align: center">Provedor</th>
                                     <th style="text-align: center">Costo</th>
                                     <th style="text-align: center">Max<br />Cedis<br />30 dias</th>
                                     <th style="text-align: center">Demanda<br />Diaria</th>
                                     <th style="text-align: center">Inv<br />Cedis</th>
                                     <th style="text-align: center">Dias<br />Inv.</th>
                                     <th style="text-align: center">Compra</th>
                                     <th style="text-align: center">Corrugado</th>
                                     <th style="text-align: center">Compra Corr</th>
                                     <th style="text-align: center">Importe</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='blue'; $color2='orange'; $color3='green';
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0; $t5_1=0;
                                foreach ($q->result()as $r){
                                if($r->comprar > 0){
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->tipo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->prv?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->prvx?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->costo,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->max_cedis,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->demanda_diaria,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->inv_cedis,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->dias,0)?></td>
                                <td style="color:<?php echo $color2?>; text-align: right"><?php echo number_format($r->comprar,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->corrugado,0)?></td>
                                <td style="color:<?php echo $color1?>; text-align: right"><?php echo number_format($r->comprar_corr,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->importe,2)?></td>
                                </tr>
                               <?php 
                                $t1=$t1+$r->max_cedis;
                                $t2=$t2+$r->demanda_diaria;
                                $t3=$t3+$r->inv_cedis;
                                
                                $t5=$t5+$r->comprar;
                                $t5_1=$t5_1+$r->comprar_corr;
                                $t6=$t6+$r->importe;
                                }}
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td style="color: <?php echo $color?>; text-align: right" colspan="6"><strong>TOTAL</strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t1,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t2,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t3,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t5_1,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t5,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t6,2)?></strong></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>