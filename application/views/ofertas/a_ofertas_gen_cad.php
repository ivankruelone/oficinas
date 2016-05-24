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
                                     <th style="text-align: left">Inicio</th> 
                                     <th style="text-align: left">Final</th>
                                     <th style="text-align: left">Sec</th>
                                     <th style="text-align: left">Codigo</th>
                                     <th style="text-align: right">Descripcion</th>
                                     <th style="text-align: right">Precio Oferta</th>
                                     <th style="text-align: right">Incentivo</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($q->result()as $r){
                                $l1=anchor('ofertas/borrar_oferta_gen/'.$r->id,'Borrar');
                               
                                
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha_activos?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha_fin?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->codigo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descripcion?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->precio_oferta,4)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->insentivo,2)?></td>
                                <td><?php echo $l1 ?></td>
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