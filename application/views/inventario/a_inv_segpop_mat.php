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
                                     <th style="text-align: left">Almacen</th>
                                     <th style="text-align: left">Codigo</th> 
                                     <th style="text-align: left">Sustancia Activa</th>
                                     <th style="text-align: left">Lote</th>
                                     <th style="text-align: left">Caducidad</th>
                                     <th style="text-align: right">Existencia</th>
                                     <th style="text-align: right">Caducado</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $texis=0;$tcadu=0;
                                foreach ($a->result()as $r){
                                
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->almacenx?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->ean?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa.'<br />'.$r->des?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->lote?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->caducidad?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->existencia,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->caducado,0)?></td>
                                </tr>
                               <?php 
                               $texis=$texis+$r->existencia;
                               $tcadu=$tcadu+$r->caducado;
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="5">TOTAL</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($texis,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tcadu,0)?></td>
                              
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>