                 <div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: left">A&ntilde;o</th> 
                                     <th style="text-align: left">Mes</th>
                                     <th style="text-align: left">Nombre Mes</th>
                                     <th style="text-align: left">Destino</th>
                                     <th style="text-align: right">Embarque</th>
                                     <th style="text-align: right">Importe</th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; 
                                $tcan=0;$timp=0;
                                foreach ($q->result()as $r){
                                 $l1 = anchor('salidas/a_salida_segpop_pro/'.$r->aaa.'/'.$r->mes.'/'.$r->clvsucursalReferencia,'Por Producto');
                                 $l2 = anchor('salidas/a_salida_segpop_fec/'.$r->aaa.'/'.$r->mes.'/'.$r->clvsucursalReferencia,'Por Fecha');
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->aaa?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->mes?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->mesx?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->clvsucursalReferencia.' '.$r->clvsucursalReferenciax?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->embarque,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->importe,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l2?></td>
                                </tr>
                               <?php 
                               $tcan=$tcan+$r->embarque; 
                               $timp=$timp+$r->importe;
                                } ?>
                              </tbody>
                              <tfoot>
                               <tr>
                               <td colspan="4">TOTAL</td>
                               <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tcan,0)?></td>
                               <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($timp,2)?></td>
                               <td colspan="2"></td>
                               </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>