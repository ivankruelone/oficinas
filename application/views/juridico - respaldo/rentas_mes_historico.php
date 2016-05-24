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
                                 <th style="color:black; text-align: left">A&ntilde;o</th>
                                 <th style="color:black; text-align: left">Mes</th>
                                 <th style="color:black; text-align: left"># Arrendadores</th>
                                 <th style="color:black; text-align: left">Importe MN</th>
                                 <th style="color:black; text-align: left">Importe USD</th>
                                 <th style="color:black; text-align: left">Tipo de Cambio</th>
                                 <th style="color:black; text-align: left">Conversion</th>
                                 <th style="color:black; text-align: left">Importe TOTAL MN</th>
                                 <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';$conversion=0;
                                foreach ($q->result()as $r) {
                                $conversion=(($r->totalusd)*($r->tipo_cambio));
                                $l1=anchor('juridico/rentas_mes_historico_det/'.$r->aaa.'/'.$r->mes.'/'.$r->tipo_local,'Detalle');
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->aaa?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->mesx?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->arrendador?></td>                                  
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalusd,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->tipo_cambio,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($conversion,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format(($r->totalmn+$conversion),2)?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l1?></td>
                                  </tr>
                               <?php $tmn=$tmn+$r->totalmn;$tusd=$tusd+$r->totalusd;} ?>
                              </tbody>
                              <tfoot>
                               
                              
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                                 <tr>
                                 <th style="color:black; text-align: left">A&ntilde;o</th>
                                 <th style="color:black; text-align: left">Mes</th>
                                 <th style="color:black; text-align: left"># Arrendadores</th>
                                 <th style="color:black; text-align: left">Importe MN</th>
                                 <th style="color:black; text-align: left">Importe USD</th>
                                 <th style="color:black; text-align: left">Tipo de Cambio</th>
                                 <th style="color:black; text-align: left">Conversion</th>
                                 <th style="color:black; text-align: left">Importe TOTAL MN</th>
                                 <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';$conversion2=0;
                                foreach ($q2->result()as $r2) {
                                $conversion2=(($r2->totalusd)*($r2->tipo_cambio));
                                $l1=anchor('juridico/rentas_mes_historico_det/'.$r2->aaa.'/'.$r2->mes.'/'.$r2->tipo_local,'Detalle');
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r2->aaa?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r2->mesx?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r2->arrendador?></td>                                  
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r2->totalmn,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r2->totalusd,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r2->tipo_cambio,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($conversion2,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format(($r2->totalmn+$conversion2),2)?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l1?></td>
                                  </tr>
                               <?php $tmn=$tmn+$r2->totalmn;$tusd=$tusd+$r2->totalusd;} ?>
                              </tbody>
                              <tfoot>
                               
                              
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                     
                 </div>