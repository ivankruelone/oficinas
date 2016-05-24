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
                                 <th style="color:black; text-align: left">fecha</th>
                                 <th style="color:black; text-align: left">Nid</th>
                                 <th style="color:black; text-align: left">Sucursal</th>
                                 <th style="color:black; text-align: left">Arrendador</th>
                                 <th style="color:black; text-align: left">Meses</th>
                                 <th style="color:black; text-align: left">Importe MN</th>
                                 <th style="color:black; text-align: left">Importe USD</th>
                                 <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$tmn=0;$tusd=0;$color='blue';$conversion=0;
                                foreach ($q->result()as $r) {
                                $l1=anchor('juridico/rentas_deuda_rfc/'.$r->suc.'/'.$r->rfc.'/'.$r->tipo_local,'Actualiza Pago');
                                $num=$num+1;
                                ?> 
                                 <tr>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->fecha_act?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->suc?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->sucx?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->nom?></td>
                                   <td style="text-align: left; color: <?php echo $color?>;"><?php echo $r->meses?></td>                                  
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalmn,2)?></td>
                                   <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->totalusd,2)?></td>
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
                     
                     
                 </div>