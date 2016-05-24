                 <div class="span12">
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
                                     <th style="text-align: left">Estatus</th> 
                                     <th style="text-align: left">Fecha Captura</th>
                                     <th style="text-align: left">Fecha Validacion</th>
                                     <th style="text-align: left">Fecha Inicio</th>
                                     <th style="text-align: left">Fecha Fecha Final</th> 
                                     <th style="text-align: left">Nid</th>
                                     <th style="text-align: left">Sucursal</th>
                                     <th style="text-align: right">Imp.Autorizado</th>
                                    </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($q->result()as $r){
                                $l0= anchor('ofertas/s_ofertas_corta_caducidad_det_his/'.$r->id,'Detalle', 'class="button-link blue"');
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->activox?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha_suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha_compra?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha_inicio?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha_fin?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sucx?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->imp,2)?></td>
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