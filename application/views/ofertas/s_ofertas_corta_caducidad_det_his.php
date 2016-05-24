                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                         <div class="widget blue">
                         <div class="widget-title">
                         <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
<!---->                          
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                                 <tr>
                                     <th style="text-align: left">Estatus</th>
                                     <th style="text-align: left">Codigo</th> 
                                     <th style="text-align: left">Descripcion</th>
                                     <th style="text-align: left">Caduciad</th>
                                     <th style="text-align: left">Cantidad</th>
                                     <th style="text-align: left">Costo</th>
                                     <th style="text-align: left">Publico</th>
                                     <th style="text-align: left">Precio Oferta</th>
                                     <th style="text-align: left">Importe</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;$tot=0;
                                foreach ($q1->result()as $r1){
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->activox?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->codigo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->descripcion?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r1->cadu?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r1->cantidad,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r1->costo,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r1->pub,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r1->oferta,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format(($r1->oferta*$r1->cantidad),2)?></td>
                                
                                </tr>
                               <?php 
                               $tot=$tot+($r1->oferta*$r1->cantidad); 
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="8">TOTAL</td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($tot,2)?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>