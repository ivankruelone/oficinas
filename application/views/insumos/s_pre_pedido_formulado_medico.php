<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                              <h4><i class="icon-reorder"></i>Inventario de Medicos</h4>
                             <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

                                
                  <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                                        <thead>
                                            <tr>
                                                <th style="text-align: left;">Nid</th>
                                                <th style="text-align: left;">Sucursal</th>
                                                <th style="text-align: right;">Importe</th>
                                                <th style="text-align: left;">Fecha</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                           $color ='gray';
                                           foreach($query->result() as $row)
                                           {                                                                           
                                         ?>
                                            <tr>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->suc; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->nombre; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($row->importe,2); ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->fecha; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo anchor('insumos/s_pre_pedido_formulado_medico_det/'.$row->suc, 'Detalle'); ?></td>
                                              </tr>
                                           <?php
                                           }
                                           ?>
                                         </tbody>
                                <tfoot>
                              </tfoot>
                           </table>                          
                         </div>
                       </div>
                     
                      </div>  