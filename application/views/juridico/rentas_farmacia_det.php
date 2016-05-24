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
                                 <th style="color:black; text-align: left"></th>
                                 <th style="color:black; text-align: left">Local</th>
                                 <th style="color:black; text-align: left">Nid</th>
                                 <th style="color:black; text-align: left">Sucursal</th>
                                 <th style="color:black; text-align: left">Contrato</th>
                                 <th style="color:black; text-align: left">Observacion</th>
                                 <th style="color:black; text-align: left">RFC</th>
                                 <th style="color:black; text-align: left">Arrendador</th>
                                 <th style="color:black; text-align: left">Persona</th>
                                 <th style="color:black; text-align: right">Renta</th>
                                 <th style="color:black; text-align: right">IVA</th>
                                 <th style="color:black; text-align: right">ISR</th>
                                 <th style="color:black; text-align: right">IVA-ISR</th>
                                 <th style="color:black; text-align: right">Agua</th>
                                 <th style="color:black; text-align: right">Total MN</th>
                                 <th style="color:black; text-align: right">Total USD</th>
                                 <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';
                                foreach ($q->result()as $r) {
                                $l1=anchor('juridico/borrar_arrendador/'.$r->id,'Borrar');
                                $l2=anchor('juridico/rentas_cambios/'.$r->id,$r->rfc);
                                $num=$num+1;
                                ?> 
                                 <tr>
                                    <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->id?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->tipo_localx?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->suc?></td>                                  
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->sucx?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->contrato?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->observacion?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l2?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->nom?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->auxix?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->imp,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->ivaf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->isrf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->iva_isrf,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->agua,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format(($r->totalmn+$r->agua),2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalusd,2)?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $l1?></td>
                                  </tr>
                               <?php $tmn=$tmn+$r->totalmn;$tusd=$tusd+$r->totalusd;} ?>
                              </tbody>
                              <tfoot>
                               
                              <tr>
                              <td colspan="13">TOTAL</td>
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