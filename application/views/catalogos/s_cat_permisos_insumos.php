<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                              <h4><i class="icon-reorder"></i>Permisos de insumos por Departamento</h4>
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
                                                <th style="text-align: center;">Acciones</th>
                                                <th style="text-align: left;">Pedido Especial</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                           $color ='blue';
                                           foreach($query->result() as $row){                                                                           
                                              
                                              if($row->especial == 0)
                                                {
                                                    $valor = FALSE;
                                                }else{
                                                    $valor = TRUE;
                                                } 
                                                $datos = array(
                                                    'name'        => 'especial_'.$row->nombre,
                                                    'value'       => $row->suc,
                                                    'checked'     => $valor,
                                                    'style'       => 'margin:10px',
                                                 );
                                            
                                             
                                           ?>
                                            <tr>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->suc; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->nombre; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo anchor('catalogos/s_cat_insumos_menu/'.$row->suc, 'Permisos'); ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo form_checkbox($datos)?></td> 
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