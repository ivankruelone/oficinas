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
                            <th colspan="3" style="text-align: center"></th>
                            <th colspan="2" style="text-align: center">Inv.Inicial</th>
                            <th colspan="3" style="text-align: center">Entradas</th>
                            <th colspan="4" style="text-align: center">Salidas</th>
                            <th colspan="1" style="text-align: center">Inv.Final</th>
                            <th colspan="2" style="text-align: center">Inv.Final T</th>
                            </tr>
                             <tr>
                             <th colspan="1">#</th>
                             <th colspan="1">Nid</th>
                             <th colspan="1">Sucursal</th>
                             <th style="text-align: right" colspan="1">Piezas</th>
                             <th style="text-align: right" colspan="1">Importe</th>
                             <th style="text-align: right" colspan="1">Piezas Y</th>
                             <th style="text-align: right" colspan="1">Piezas B</th>
                             <th style="text-align: right" colspan="1">Importe</th>
                             <th style="text-align: right" colspan="1">Piezas</th>
                             <th style="text-align: right" colspan="1">Contado</th>
                             <th style="text-align: right" colspan="1">credito</th>
                             <th style="text-align: right" colspan="1">Imp_Sal</th>
                             <th style="text-align: right" colspan="1">Piezas</th>
                             <th style="text-align: right" colspan="1">Piezas</th>
                             <th style="text-align: right" colspan="1">Importe</th>
                             
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
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sucx?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->inv_ini,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->imp_inv_ini,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->ent,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->ent_back,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->imp_ent,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->sal,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->imp_sal,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->imp_cred,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->imp_sal+$r->imp_cred,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format(($r->inv_ini+$r->ent+$r->ent_back-$r->sal),0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->inv_fin,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->imp_inv_fin,2)?></td>
                                
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