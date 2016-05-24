<div class="span12">

                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Inventario</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                <tr>
                                <th colspan="7" style="text-align: center;">INVENTARIO ALMACENES</th>
                                </tr>
                                                              
                                
                                 <tr>
                                     <th style="text-align: left">Clave</th> 
                                     <th style="color:gray; text-align: left">Descripcion</th>
                                     <th style="color:gray; text-align: left">Lote</th>
                                     <th style="color:gray; text-align: right">Caducidad</th>
                                     <th style="color:gray; text-align: right">Inventario</th>
                                     <th style="color:gray; text-align: right">Almacen</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                
                                $color='black'; 
                                $tinventario=0;
                                foreach ($query->result()as $r){
                                   
                                                                    
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->clave?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descripcion?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->lote?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->caducidad ?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->inventario,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->almacen?></td>
                                </tr>
                               <?php 
                               $tinventario=$tinventario+$r->inventario;
                     
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="4">TOTAL</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinventario,0)?></td>
                             
                                </tr>
                             </tfoot>
                         </table>
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>





</div>