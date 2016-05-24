                 <div class="span12">
                    <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart">

                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla3">
                             <thead>
                                 <tr>
                                     <th style=" color:blue; text-align: center">FECHA</th>
                                     <th style=" color:blue; text-align: center">DIA</th>  
                                     <th style=" color:blue; text-align: center">SUC</th>
                                     <th style=" color:blue; text-align: center">SUCURSAL</th>
                                     <th style=" color:blue; text-align: center">PROMEDIO<br />TICKET CONTADO</th>
                                     <th style=" color:blue; text-align: center">TICKET</th>
                                     <th style=" color:blue; text-align: center">VTA.CONTADO</th>
                                     <th style=" color:blue; text-align: center">VTA.CREDITO</th>
                                     <th style=" color:blue; text-align: center">VTA.SERVICIOS</th>
                                     <th style=" color:blue; text-align: center">VENTA<br />TOTAL</th>
                                     <th style=" color:blue; text-align: center">PROMEDIO<br />NIVEL SURTIDO</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='blue';$colorc='green';
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;
                                foreach ($q1->result()as $r1){
                                if($r1->tic>0){$prom_tic=$r1->venta_contado/$r1->tic;}else{$prom_tic=0;}
                                if($r1->diax=='Falta Corte'){$color='red';$colorc='red';}else{$color='blue';$colorc='green';}
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->fechacorte?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->diax?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo  $r1->suc?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $r1->nombre?></td>
                                <td style="color: <?php echo $colorc?>; text-align: right"><?php echo number_format($prom_tic,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r1->tic,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r1->venta_contado,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r1->venta_credito,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r1->venta_servicio,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r1->venta_total,2)?></td>
                                <td style="color: <?php echo $colorc?>; text-align: right"><?php echo number_format($r1->nivel_surtido,2)?></td>
                                </tr>
                               <?php 
                               $t1=$t1+$r1->tic;
                               $t2=$t2+$r1->venta_contado;
                               $t3=$t3+$r1->venta_credito;
                               $t4=$t4+$r1->venta_servicio;
                               $t6=$t6+$r1->venta_total;
                                
                                }
                               ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td style="color: <?php echo $color?>; text-align: right" colspan="4"><strong>TOTAL</strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t1,0)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t2,2)?></strong></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                       </div>              
<!-- otra vista -------------------------------------------------------------------------------------------------------------->
<!-- otra vista -------------------------------------------------------------------------------------------------------------->
