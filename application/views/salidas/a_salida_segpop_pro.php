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
                                     <th style="text-align: left">Clave</th> 
                                     <th style="text-align: left">Sustancia Activa</th>
                                     <th style="text-align: left">Descripcion</th>
                                     <th style="text-align: left">Presentacion</th>
                                     <th style="text-align: right">Embarque</th>
                                     <th style="text-align: right">Importe</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; 
                                $tcan=0;$timp=0;
                                foreach ($q->result()as $r){
                                 //id, cvearticulo, susa, descripcion, pres, piezas, importe
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->cvearticulo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descripcion?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->pres?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->piezas,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->importe,2)?></td>
                                </tr>
                               <?php 
                               $tcan=$tcan+$r->piezas; 
                               $timp=$timp+$r->importe;
                                } ?>
                              </tbody>
                              <tfoot>
                               <tr>
                               <td colspan="4">TOTAL</td>
                               <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tcan,0)?></td>
                               <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($timp,2)?></td>
                               </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>