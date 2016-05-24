                 <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: left">Fecha</th> 
                                     <th style="text-align: left">Folio</th>
                                     <th style="text-align: right">Piezas</th>
                                     <th style="text-align: right">Importe</th>
                                     
                                 </tr>
                             </thead>   
                             <tbody>
                             
                                 <?php
                                $sumaimporte = 0;
                                $sumapiezas = 0;
                                foreach ($luna->result()as $r){
                                $l0 = anchor('salidas/s_salida_esp_cli_fol/'.$mes.'/'.$uno.'/'.$r->suc,'Detalle por folio');                            
                                ?>
                                <tr>
                                <td><?php echo $r->fechasur ?></td>
                                <td><?php echo $r->id ?></td>
                                <td style="text-align: right;"><?php echo number_format($r->piezas,0) ?></td>
                                <td style="text-align: right;"><?php echo number_format($r->importe,2)?></td>
                                
                                </tr>
                               
                               <?php
                                $sumaimporte =  $sumaimporte+$r->importe;
                                $sumapiezas = $sumapiezas+$r->piezas;
                                } ?>
                              </tbody>
                              <tfoot>
                               <tr>
                               <td colspan="2">TOTAL</td>
                               <td style="text-align: right;"><strong><?php echo number_format($sumapiezas,0)?></strong></td>
                               <td style="text-align: right;"><strong><?php echo number_format($sumaimporte,2)?></strong></td>
                               
                               </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>