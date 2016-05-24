<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                              <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
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
                                                <th style="text-align: left;">Pedido Especial</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                           $color ='blue';
                                           foreach($query->result() as $row){                    
                                             
                                           ?>
                                            <tr>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->suc; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo $row->sucx; ?></td>
                                               <td style="color:<?php echo $color?>;text-align: left;"><?php echo  $l1 = anchor('insumos/s_ctl_superv_esp/'.$row->suc,'Pedido Especial</a>');?></td> 
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