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
                                 <th style="color:black; text-align: left">Grupo</th>
                                 <th style="color:black; text-align: left">Concepto</th>
                                 <th style="color:black; text-align: right">Arrentador</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';
                                foreach ($q->result()as $r) {
                                $l2=anchor('juridico/rentas_farmacia_det/'.$r->id.'/'.$r->tipo_local,$r->id);
                                $num=$num+1;
                                ?> 
                                 <tr>
                                    <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l2?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->nombre?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo $r->num?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->imp,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->ivaf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->isrf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->iva_isrf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalusd,2)?></td>
                                  </tr>
                               <?php $tmn=$tmn+$r->totalmn;$tusd=$tusd+$r->totalusd;} ?>
                              </tbody>
                              <tfoot>
                               
                              <tr>
                              <td colspan="7">TOTAL</td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tmn,2)?></td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tusd,2)?></td>
                              <td></td>
                              </tr>
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget green">
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
                                 <th style="color:black; text-align: left">Grupo</th>
                                 <th style="color:black; text-align: left">Concepto</th>
                                 <th style="color:black; text-align: right">Arrentador</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';
                                foreach ($q2->result()as $r2) {
                                $l2=anchor('juridico/rentas_farmacia_det/'.$r2->id.'/'.$r2->tipo_local,$r2->id);
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l2?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r2->nombre?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo $r2->num?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r2->imp,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r2->ivaf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r2->isrf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r2->iva_isrf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r2->totalmn,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r2->totalusd,2)?></td>
                                 </tr>
                               <?php $tmn=$tmn+$r2->totalmn;$tusd=$tusd+$r2->totalusd;} ?>
                              </tbody>
                              <tfoot>
                               
                              <tr>
                              <td colspan="7">TOTAL</td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tmn,2)?></td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tusd,2)?></td>
                              <td></td>
                              </tr>
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                    
                 </div>