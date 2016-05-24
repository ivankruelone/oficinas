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
                                     <th style="text-align: left">Inicio</th> 
                                     <th style="text-align: left">Final</th>
                                     <th style="text-align: left">Laboratorio o mayorista</th>
                                     <th style="text-align: left">Codigo</th>
                                     <th style="text-align: right">Descripcion</th>
                                     <th style="text-align: right">% Oferta Lab</th>
                                     <th style="text-align: right">% Oferta Far</th>
                                     <th style="text-align: right">$ Far</th>
                                     <th style="text-align: right">$ Pub</th>
                                     <th style="text-align: right">$ Cos_Mar</th>
                                     <th style="text-align: right">$ Cos_Fan</th>
                                     <th style="text-align: right">% Util_Mar</th>
                                     <th style="text-align: right">% Util_Fan</th>
                                     <th ></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($q->result()as $r){
                                if($r->activo==2){$l1='Oferta Validada '; $color='blue';$l0=' ';}else{
                                $l1= anchor('ofertas/borra_aferta/'.$r->id,'Borrar', 'class="button-link blue"');
                                $l0= anchor('ofertas/val_aferta/'.$r->id,'Val', 'class="button-link blue"');
                                $color='gray';
                                }
                                
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha2?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->labprv?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->codigo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descripcion?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->ofe_lab,4)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->ofe_far,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->farmacia,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->pub,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cos_marzam,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cos_fanasa,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->util_marzam,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->util_fanasa,2)?></td>
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