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
                                 <th style="color:black; text-align: left">Cia</th>
                                 <th style="color:black; text-align: left">Compa&ntilde;ia</th>
                                 <th style="color:black; text-align: left">local</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 <th style="color:black; text-align: right">PAGO MN</th>
                                 <th style="color:black; text-align: right">PAGO USD</th>
                                 <th style="color:black; text-align: right">DEUDA MN</th>
                                 <th style="color:black; text-align: right">DEUDA USD</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $con=0;$num=0;$tmn=0;$tusd=0;$imp=0;$ivaf=0;$isrf=0;$iva_isrf=0;
                                 $mnpago=0;$usdpago=0;$mndeuda=0;$usddeuda=0;
                               $tmnpago=0;$tusdpago=0;$tmndeuda=0;$tusddeuda=0;
                                foreach ($q->result()as $r) {
                               $l1 = anchor('juridico/s_rentas_propias_grupo_cia/'.$r->cia.'/'.$r->rfc.'/'.$r->nu.'/'.$r->fecha_m.'/'.$r->pago,$r->cia.'</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));    
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left; color:gray;"><?php echo $l1?></td>
                                   <td style="text-align: left; color:gray;"><?php echo $r->razon?></td>                                  
                                   <td style="text-align: left; color:gray;"><?php echo $r->num?></td>
                                   <td style="text-align: right; color:gray;"><?php echo number_format($r->imp,2)?></td>
                                   <td style="text-align: right; color:gray;"><?php echo number_format($r->ivaf,2)?></td>
                                   <td style="text-align: right; color:gray;"><?php echo number_format($r->isrf,2)?></td>
                                   <td style="text-align: right; color:gray;"><?php echo number_format($r->iva_isrf,2)?></td>
                                   <td style="text-align: right; color:gray;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right; color:gray;"><?php echo number_format($r->totalusd,2)?></td>
                                   <td style="text-align: right; color:green;"><?php echo number_format($r->mnpago,2)?></td>
                                   <td style="text-align: right; color:green;"><?php echo number_format($r->usdpago,2)?></td>
                                   <td style="text-align: right; color:orange;"><?php echo number_format($r->mndeuda,2)?></td>
                                   <td style="text-align: right; color:orange;"><?php echo number_format($r->usddeuda,2)?></td>
                                   
                                  </tr>
                               <?php $tmn=$tmn+$r->totalmn;
                               $tusd=$tusd+$r->totalusd;
                               $imp=$imp+$r->imp;
                               $ivaf=$ivaf+$r->ivaf;
                               $isrf=$isrf+$r->isrf;
                               $iva_isrf=$iva_isrf+$r->iva_isrf;
                               
                               $usdpago=$usdpago+$r->usdpago;
                               $usddeuda=$usddeuda+$r->usddeuda;
                               $mnpago=$mnpago+$r->mnpago;
                               $mndeuda=$mndeuda+$r->mndeuda;
                               } ?>
                              </tbody>
                              <tfoot>
                               <tr>
                              <td  style="color:blue; text-align: right;" colspan="3"><strong>TOTAL</strong></td>
                              <td style="color:blue; text-align: right;"><strong><?php echo number_format($imp,2)?></strong></td>
                              <td style="color:blue; text-align: right;"><strong><?php echo number_format($ivaf,2)?></strong></td>
                              <td style="color:blue; text-align: right;"><strong><?php echo number_format($isrf,2)?></strong></td>
                              <td style="color:blue; text-align: right;"><strong><?php echo number_format($iva_isrf,2)?></strong></td>
                              <td style="color:blue; text-align: right;"><strong><?php echo number_format($tmn,2)?></strong></td>
                              <td style="color:blue; text-align: right;"><strong><?php echo number_format($tusd,2)?></strong></td>
                              <td style="color:green; text-align: right;"><?php echo number_format($mnpago,2)?></td>
                              <td style="color:green; text-align: right;"><?php echo number_format($usdpago,2)?></td>
                              <td style="color:orange; text-align: right;"><?php echo number_format($mndeuda,2)?></td>
                              <td style="color:orange; text-align: right;"><?php echo number_format($usddeuda,2)?></td>
                              
                              </tr>
                              </tfoot>
                         </table>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                    
                 </div>