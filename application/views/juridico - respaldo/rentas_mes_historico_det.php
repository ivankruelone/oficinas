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

  
                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="color:black; text-align: left">#</th>
                                 <th style="color:black; text-align: left">Gupo</th>
                                 <th style="color:black; text-align: left">Nid</th>
                                 <th style="color:black; text-align: left">Sucursal</th>
                                 <th style="color:black; text-align: left">Arrendadores</th>
                                 <th style="color:black; text-align: left">Importe MN</th>
                                 <th style="color:black; text-align: left">Importe USD</th>
                                 <th style="color:black; text-align: left">Tipo de Cambio</th>
                                 <th style="color:black; text-align: left">Conversion</th>
                                 <th style="color:black; text-align: left">Importe TOTAL MN</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$color='blue';$conversion=0;
                                foreach ($q->result()as $r) {
                                $conversion=(($r->totalusd)*($r->tipo_cambio));
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->grupo?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->grupox?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->suc?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->sucx?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->arrendador?></td>                                  
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalusd,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->tipo_cambio,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($conversion,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format(($r->totalmn+$conversion),2)?></td>
                                   
                                  </tr>
                               <?php 
                               $t1=$t1+$r->arrendador;
                               $t2=$t2+$r->totalmn;
                               $t3=$t3+$r->totalusd;
                               $t4=$t4+$conversion;
                               $t5=$t5+($r->totalmn+$conversion);
                               
                               } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="5"></td>
                              <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($t2,2)?></td>
                              <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($t3,2)?></td>
                              <td></td>
                              <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($t4,2)?></td>
                              <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($t5,2)?></td>
                              </tr> 
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                 </div>