                 <div class="span12">
                     
<!-- BEGIN BLANK PAGE PORTLET-->

                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla">
                             <thead>
                                 <tr>
                                     
                                     <th style="text-align: center">Clas</th>
                                     <th style="text-align: center">Sec</th>
                                     <th style="text-align: center">Sustancia Activa</th>  
                                     <th style="text-align: center">Necesidad<br />Almacen</th>
                                     <th style="text-align: center">Inventarios<br />Almacen</th>
                                     <th style="text-align: center">Demanda<br />Diaria</th>
                                     <th style="text-align: center">Entradas<br />Almacen</th>
                                     <th style="text-align: center">Dias de<br />Inv</th>
                                     <th style="text-align: center">Transito<br />Compra</th>
                                     <th style="text-align: center">Demanda en<br />Farmacias</th>
                                     <th style="text-align: center">Inv<br />Farmacias</th>
                                     <th style="text-align: center">Demanda<br />Diaria<br />Farmacias</th>
                                     <th style="text-align: center">Dias de<br />Inv.Farma.</th>
                                     <th style="text-align: center">Transito<br />Sucursal</th>
                                     <th style="text-align: center">Venta<br />Diaria</th>
                                     <th style="text-align: center">Ceros<br />Almacen</th>
                                     <th style="text-align: center">Ceros<br />Sucursal</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='blue'; $color1='black'; $color2='blue'; $color3='green';
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$t13=0;$t14=0;
                                foreach ($q->result()as $r){
                                //$l0 = anchor('evaluacion/eval_cedis_cla/'.$r->tipo,$r->obser.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->tipo?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->necesidad_cedis,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->inv_cedis,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->demanda_diaria_cedis,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->entrada_cedis,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->dias_inv_cedis,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->transito_compra,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->demanda_farmacias,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->inv_farmacia,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->demanda_diaria_farma,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->dias_inv_farma,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->transito_cedis_suc,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta_diaria,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->ceros_cedis,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->ceros_farma,0)?></td>
                                </tr>
                               <?php 
                                $t1=$t1+$r->necesidad_cedis;
                                $t2=$t2+$r->inv_cedis;
                                $t3=$t3+$r->demanda_diaria_cedis;
                                $t4=$t4+$r->entrada_cedis;
                                $t5=$t5+$r->dias_inv_cedis;
                                $t6=$t6+$r->transito_compra;
                                $t7=$t7+$r->demanda_farmacias;
                                $t8=$t8+$r->inv_farmacia;
                                $t9=$t9+$r->demanda_diaria_farma;
                                $t10=$t10+$r->dias_inv_farma;
                                $t11=$t11+$r->transito_cedis_suc;
                                $t12=$t12+$r->venta_diaria;
                                $t13=$t13+$r->ceros_cedis;
                                
                                }
                                 ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td style="color: <?php echo $color?>; text-align: right" colspan="3"><strong>TOTAL</strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t1,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t2,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t3,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t4,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t5,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t6,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t7,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t8,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t9,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t10,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t11,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t12,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"><strong><?php echo number_format($t13,0)?></strong></td>
                              <td style="color:<?php echo $color?>; text-align: right"></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>