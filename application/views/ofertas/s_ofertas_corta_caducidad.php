                 <div class="span5">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                         <div class="widget blue">
                         <div class="widget-title">
                         <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
<!---->                          
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: left"></th>
                                     <th style="text-align: left">ID</th> 
                                     <th style="text-align: left">Fecha</th> 
                                     <th style="text-align: left">Nid</th>
                                     <th style="text-align: left">Sucursal</th>
                                     <th style="text-align: left"></th>
                                    </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($q->result()as $r){
                                $l0= anchor('ofertas/s_ofertas_corta_caducidad_det/'.$r->id,'Detalle', 'class="button-link blue"');
                                $l1= anchor('ofertas/s_ofertas_corta_caducidad_bor_ctl/'.$r->id,'Borrar', 'class="button-link blue"');
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->id?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha_suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sucx?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                </tr>
                               <?php 
                                } ?>
                              </tbody>
                              <tfoot>
                              
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>