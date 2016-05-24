                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">



                        <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="color:black; text-align: left">Farmacia</th>
                                 <th style="color:black; text-align: left">Nid</th>
                                 <th style="color:black; text-align: left">Sucursal</th>
                                 <th style="color:black; text-align: left">Arrendador</th>
                                 <th style="color:black; text-align: left">Persona</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $con=0;$num=0;$tmn=0;$tusd=0;$imp=0;$ivaf=0;$isrf=0;$iva_isrf=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->tipo2x?></td>
                                   <td style="text-align: left;"><?php echo $r->suc?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->sucx?></td>
                                   <td style="text-align: left;"><?php echo $r->nom?></td>
                                   <td style="text-align: left;"><?php echo $r->auxix?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->imp,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->ivaf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->iva_isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalusd,2)?></td>
                                   
                                  </tr>
                               <?php 
                               $tmn=$tmn+$r->totalmn;
                               $tusd=$tusd+$r->totalusd;
                               $imp=$imp+$r->imp;
                               $ivaf=$ivaf+$r->ivaf;
                               $isrf=$isrf+$r->isrf;
                               $iva_isrf=$iva_isrf+$r->iva_isrf;} ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="3">TOTAL</td>
                              <td style="color:black; text-align: right;"><?php echo number_format($imp,2)?></td>
                              <td style="color:black; text-align: right;"><?php echo number_format($ivaf,2)?></td>
                              <td style="color:black; text-align: right;"><?php echo number_format($isrf,2)?></td>
                              <td style="color:black; text-align: right;"><?php echo number_format($iva_isrf,2)?></td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tmn,2)?></td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tusd,2)?></td>
                              </tr>
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>