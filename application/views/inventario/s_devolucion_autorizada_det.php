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
                                     <th style="text-align: left">Nid</th>
                                     <th style="text-align: left">Sucursal</th>
                                     <th style="text-align: left">Sec</th>
                                     <th style="text-align: left">Sustancia Activa</th>
                                     <th style="text-align: left">Lote</th> 
                                     <th style="text-align: left">Caducidad</th>
                                     <th style="text-align: left">Capturadas</th>
                                     <th style="text-align: left">Validadas</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $tot1=0;$tot2=0;
                                $tinv_impo=0;$tinv=0;
                                foreach ($a->result()as $r){
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->nombre?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->lote?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->caducidad?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->capturadas,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->validadas,0)?></td>
                                </tr>
                               <?php 
                                $tot1=$tot1+$r->capturadas;
                                $tot2=$tot2+$r->validadas;
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="6">Total</td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($tot1,0)?></td>
                              <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($tot2,0)?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>