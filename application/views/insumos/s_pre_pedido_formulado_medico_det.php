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
                                                <th style="text-align: left;">Id_insumo</th>
                                                <th style="text-align: left;">Art&iacute;culo</th>
                                                <th style="text-align: left;">Pedico</th>
                                                <th style="text-align: right;">Importe</th>
                                                <th style="text-align: left;">Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                           $color ='gray';$tot1=0;
                                           foreach($query->result() as $row)
                                           {                                                                           
                                         ?>
                                            <tr>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->id_insumos; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->descripcion; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($row->pedido,0); ?></td>
                                               <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($row->importe,2); ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->fecha; ?></td>
                                              </tr>
                                           <?php
                                           $tot1=$tot1+$row->importe;
                                           }
                                           ?>
                                         </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td style="color:<?php echo $color?>;text-align: right;"><?php echo number_format($tot1,2); ?></td>
                                    <td></td>
                                </tr>
                              </tfoot>
                           </table>                          
                         </div>
                       </div>
                     
                      </div>  