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
                                 <th style="color:black; text-align: left">Nid</th>
                                 <th style="color:black; text-align: left">Sucursal</th>
                                 <th style="color:black; text-align: left">RFC</th>
                                 <th style="color:black; text-align: left">Arrendatario</th>
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
                                 $num=0;$tmn=0;$tusd=0;
                                foreach ($q->result()as $r) {
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $r->suc?></td>                                  
                                   <td style="text-align: left;"><?php echo $r->sucx?></td>
                                   <td style="text-align: left;"><?php echo $r->rfc?></td>
                                   <td style="text-align: left;"><?php echo $r->nom?></td>
                                   <td style="text-align: left;"><?php echo $r->auxix?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->imp,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->ivaf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->iva_isrf,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right;"><?php echo number_format($r->totalusd,2)?></td>
                                   
                                  </tr>
                               <?php $tmn=$tmn+$r->totalmn;$tusd=$tusd+$r->totalusd;} ?>
                              </tbody>
                              <tfoot>
                               <tr>
                                 <td style="color:black; text-align: left">Nid</td>
                                 <td style="color:black; text-align: left">Sucursal</td>
                                 <td style="color:black; text-align: left">RFC</td>
                                 <td style="color:black; text-align: elft">Arrendatario</td>
                                 <td style="color:black; text-align: left">Persona</td>
                                 <td style="color:black; text-align: right">Renta</td>
                                 <td style="color:black; text-align: right">IVA</td>
                                 <td style="color:black; text-align: right">ISR</td>
                                 <td style="color:black; text-align: right">IVA-ISR</td>
                                 <td style="color:black; text-align: right">Total MN</td>
                                 <td style="color:black; text-align: right">Total USD</td>
                                 </tr>
                              <tr>
                              <td colspan="9">TOTAL</td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tmn,2)?></td>
                              <td style="color:black; text-align: right;"><?php echo number_format($tusd,2)?></td>
                              </tr>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>