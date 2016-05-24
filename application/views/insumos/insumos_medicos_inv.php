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
                                                <th style="text-align: left;">Numero de Sucursal</th>
                                                <th style="text-align: left;">Sucursal</th>
                                                <th style="text-align: left;">Matutino<br />Nombre del M&eacute;dico</th>
                                                <th style="text-align: left;">Vespertino<br />Nombre del M&eacute;dico</th>
                                                <th style="text-align: left;">Existencias de inventario</th>
                                                <th style="text-align: center;">Acciones</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                           $color ='blue';
                                           foreach($query->result() as $row)
                                           {                                                                           
                                         ?>
                                            <tr>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->suc; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->nombre; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->matutino; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->vespertino; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->exis; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo anchor('insumos/insumos_medicos_inv_menu/'.$row->suc, 'Detalle'); ?></td>
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