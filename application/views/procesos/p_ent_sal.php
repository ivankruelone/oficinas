                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                             <tr><th colspan="5">Entradas y salidas</th></tr>
                            
                             <tr>
                             <th colspan="1">#</th>
                             <th colspan="1">Fecha Ini</th>
                             <th colspan="1">Fecha Fin</th>
                             <th colspan="1">Semana</th>
                             <th colspan="1">Nid</th>
                             <th colspan="1">Sucursal</th>
                             <th style="text-align: right" colspan="1">Entradas</th>
                             <th style="text-align: right" colspan="1">Salidas</th>
                             </tr>
                             </thead>
                                
                                <tbody>
                                 <?php
                                $color='green';$nume=0;
                               foreach ($q->result()as $r){
                               $nume=$nume+1;
                               ?>
                               <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $nume?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fec1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fec2?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sem?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sucx?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->ent,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->sal,0)?></td>
                                </tr>
                               <?php
                               }
                               ?>
                              </tbody>
                              <tfoot>
                           
                             </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>