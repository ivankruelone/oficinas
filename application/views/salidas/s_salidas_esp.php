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
                                     <th style="text-align: left">Observacion</th> 
                                     <th style="text-align: left">Mes</th>
                                     <th style="text-align: left">Nombre Mes</th>
                                     <th style="text-align: left">Piezas</th>
                                     <th style="text-align: right">Importe</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; 
                                $tcan=0;$timp=0;
                                foreach ($q->result()as $r){
                                 $l0 = anchor('salidas/s_salidas_esp_cli/'.$r->mes.'/'.$r->uno,$r->mesx);                            
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->var?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->mes?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->piezas,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->imp,2)?></td>
                                
                                </tr>
                               <?php $tcan=$tcan+$r->piezas; $timp=$timp+$r->imp;
                                } ?>
                              </tbody>
                              <tfoot>
                               <tr>
                               <td colspan="3">TOTAL</td>
                               <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tcan,0)?></td>
                               <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($timp,2)?></td>
                               </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>