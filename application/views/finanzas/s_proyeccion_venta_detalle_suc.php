                 <div class="span10">
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
                                    <td colspan="7" style=" color:red;">EL OBJETIVO DE ESTA SUCURSAL ES:<strong><?php echo ' $ '.number_format($objetivo,2)?></strong></td>
                                 </tr>
                                 <tr>
                                     <th style=" color:blue; text-align: center">DIA</th>  
                                     <th style=" color:blue; text-align: center">NOMBRE<br />DIA</th>
                                     <th style=" color:blue; text-align: center">VENTA<br />CONTADO</th>
                                     <th style=" color:blue; text-align: center">VENTA<br />ACUMULADA</th>
                                     <th style=" color:blue; text-align: center">TICKET</th>
                                     <th style=" color:blue; text-align: center">PROMEDIO<br />TICKET</th>
                                     <th style=" color:blue; text-align: center">NIVEL<br />SURTIDO</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='blue';$colorc='green'; $acumulado=0;
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;
                                foreach ($q1->result()as $r1){
                                $acumulado=$acumulado+$r1->venta_contado;
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->dia?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->diax?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r1->venta_contado,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($acumulado,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r1->tic,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r1->prome_tic,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r1->nivel_surtido,2)?></td>
                                </tr>
                               <?php 
                               $t1=$t1+$r1->venta_contado;
                               $t2=$t2+$r1->tic;
                               
                                
                                }
                               ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td style="color: <?php echo $color?>; text-align: right" colspan="3"><strong>TOTAL</strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t1,2)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($t2,0)?></strong></td>
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
