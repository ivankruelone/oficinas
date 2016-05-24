                 <div class="span20">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php
$l1=anchor('ventas/s_ventas_capturadas_dia_ger/'.$dom,$dom);
$l2=anchor('ventas/s_ventas_capturadas_dia_ger/'.$lun,$lun);
$l3=anchor('ventas/s_ventas_capturadas_dia_ger/'.$mar,$mar);
$l4=anchor('ventas/s_ventas_capturadas_dia_ger/'.$mie,$mie);    
?>                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                             <tr>
                                 <th></th>
                                 <th></th>
                                 <th colspan="3" style="text-align: center; color: blue;">DOMINGO<br /><?php echo $l1?></th>
                                 <th colspan="3" style="text-align: center; color: blueviolet;">LUNES<br /><?php echo $l2?></th>
                                 <th colspan="3" style="text-align: center; color: blue;">MARTES<br /><?php echo $l3?></th>
                                 <th colspan="3" style="text-align: center; color: blueviolet;">MIERCOLES<br /><?php echo $l4?></th>
                                 </tr>
                                 <tr>
                                     <th style="text-align: center">Nid</th>
                                     <th style="text-align: center">Sucursal</th> 
                                     <th style="text-align: right; color: blue;"># Tic</th>
                                     <th style="text-align: right; color: blue;">Vta.Con</th>
                                     <th style="text-align: right; color: blue;">Vta.Cre</th>
                                     <th style="text-align: right; color: blueviolet;"># Tic</th>
                                     <th style="text-align: right; color: blueviolet;">Vta.Con</th>
                                     <th style="text-align: right; color: blueviolet;">Vta.Cre</th>
                                     <th style="text-align: right; color: blue;"># Tic</th>
                                     <th style="text-align: right; color: blue;">Vta.Con</th>
                                     <th style="text-align: right; color: blue;">Vta.Cre</th>
                                     <th style="text-align: right; color: blueviolet;"># Tic</th>
                                     <th style="text-align: right; color: blueviolet;">Vta.Con</th>
                                     <th style="text-align: right; color: blueviolet;">Vta.Cre</th>
                                     
                                 </tr>
                                 
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$t08=0;$t09=0;$t10=0;$t11=0;$t12=0;$t13=0;
                                $t14=0;$t15=0;$t16=0;$t17=0;$t18=0;$t19=0;$t20=0;$t21=0;
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r->suc?></td>
                                <td style="color: maroon;"><?php echo $r->sucx?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->dom_tic,0)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->dom_con,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->dom_cre,2)?></td>
                                <td style="text-align: right; color: blueviolet;"><?php echo number_format($r->lun_tic,0)?></td>
                                <td style="text-align: right; color: blueviolet;"><?php echo number_format($r->lun_con,2)?></td>
                                <td style="text-align: right; color: blueviolet;"><?php echo number_format($r->lun_cre,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->mar_tic,0)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->mar_con,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->mar_cre,2)?></td>
                                <td style="text-align: right; color: blueviolet;"><?php echo number_format($r->mie_tic,0)?></td>
                                <td style="text-align: right; color: blueviolet;"><?php echo number_format($r->mie_con,2)?></td>
                                <td style="text-align: right; color: blueviolet;"><?php echo number_format($r->mie_cre,2)?></td>
                                
                                </tr>
                                <?php 
                                $t01=$t01+$r->dom_tic;
                                $t02=$t02+$r->dom_con;
                                $t03=$t03+$r->dom_cre;
                                $t04=$t04+$r->lun_tic;
                                $t05=$t05+$r->lun_con;
                                $t06=$t06+$r->lun_cre;
                                $t07=$t07+$r->mar_tic;
                                $t08=$t08+$r->mar_con;
                                $t09=$t09+$r->mar_cre;
                                $t10=$t10+$r->mie_tic;
                                $t11=$t11+$r->mie_con;
                                $t12=$t12+$r->mie_cre;
                                
                                $tm=0;
                                
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t01,0)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t02,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t03,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blueviolet;"><strong><?php echo number_format($t04,0)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blueviolet;"><strong><?php echo number_format($t05,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blueviolet;"><strong><?php echo number_format($t06,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t07,0)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t08,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t09,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blueviolet;"><strong><?php echo number_format($t10,0)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blueviolet;"><strong><?php echo number_format($t11,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blueviolet;"><strong><?php echo number_format($t12,2)?></strong></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                      <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php
$l5=anchor('ventas/s_ventas_capturadas_dia_ger/'.$jue,$jue);
$l6=anchor('ventas/s_ventas_capturadas_dia_ger/'.$vie,$vie);
$l7=anchor('ventas/s_ventas_capturadas_dia_ger/'.$sab,$sab);
?>                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                             <tr>
                                 <th></th>
                                 <th></th>
                                 <th colspan="3" style="text-align: center; color: blue;">JUEVES<br /><?php echo $l5?></th>
                                 <th colspan="3" style="text-align: center; color: blueviolet;">VIERNES<br /><?php echo $l6?></th>
                                 <th colspan="3" style="text-align: center; color: blue;">SABADO<br /><?php echo $l7?></th>
                                 </tr>
                                 <tr>
                                     <th style="text-align: center">Nid</th>
                                     <th style="text-align: center">Sucursal</th> 
                                     <th style="text-align: right; color: blue;"># Tic</th>
                                     <th style="text-align: right; color: blue;">Vta.Con</th>
                                     <th style="text-align: right; color: blue;">Vta.Cre</th>
                                     <th style="text-align: right; color: blueviolet;"># Tic</th>
                                     <th style="text-align: right; color: blueviolet;">Vta.Con</th>
                                     <th style="text-align: right; color: blueviolet;">Vta.Cre</th>
                                     <th style="text-align: right; color: blue;"># Tic</th>
                                     <th style="text-align: right; color: blue;">Vta.Con</th>
                                     <th style="text-align: right; color: blue;">Vta.Cre</th>
                                     
                                 </tr>
                                 
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$t08=0;$t09=0;$t10=0;$t11=0;$t12=0;$t13=0;
                                $t14=0;$t15=0;$t16=0;$t17=0;$t18=0;$t19=0;$t20=0;$t21=0;
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r->suc?></td>
                                <td style="color: maroon;"><?php echo $r->sucx?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->jue_tic,0)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->jue_con,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->jue_cre,2)?></td>
                                <td style="text-align: right; color: blueviolet;"><?php echo number_format($r->vie_tic,0)?></td>
                                <td style="text-align: right; color: blueviolet;"><?php echo number_format($r->vie_con,2)?></td>
                                <td style="text-align: right; color: blueviolet;"><?php echo number_format($r->vie_cre,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->sab_tic,0)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->sab_con,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->sab_cre,2)?></td>
                                
                                </tr>
                                <?php 
                                
                                $t13=$t13+$r->jue_tic;
                                $t14=$t14+$r->jue_con;
                                $t15=$t15+$r->jue_cre;
                                $t16=$t16+$r->vie_tic;
                                $t17=$t17+$r->vie_con;
                                $t18=$t18+$r->vie_cre;
                                $t19=$t19+$r->sab_tic;
                                $t20=$t20+$r->sab_con;
                                $t21=$t21+$r->sab_cre;
                                
                                $tm=0;
                                
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t13,0)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t14,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t15,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blueviolet;"><strong><?php echo number_format($t16,0)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blueviolet;"><strong><?php echo number_format($t17,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blueviolet;"><strong><?php echo number_format($t18,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t19,0)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t20,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t21,2)?></strong></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>