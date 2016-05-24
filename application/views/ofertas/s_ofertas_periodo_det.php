                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: left">Fecha</th> 
                                     <th style="text-align: left">Nid</th>
                                     <th style="text-align: left">Sucursal</th>
                                     <th style="text-align: left">Factura</th>
                                     <th style="text-align: right">Codigo</th>
                                     <th style="text-align: right">Descripcion</th>
                                     <th style="text-align: right">Cantidad</th>
                                     <th style="text-align: right">$ far</th>
                                     <th style="text-align: right">% fin</th>
                                     <th style="text-align: right">% ofe</th>
                                     <th style="text-align: right">Imp.Fac</th>
                                     <th style="text-align: right">Imp con Ofe</th>
                                     <th style="text-align: right">Nota</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $imp_fac='green';  $aaa=date('Y');
                                $imp_con_ofe=0;$nota=0;
                                foreach ($q->result()as $r){
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->suc?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->nombre?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fac?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo $r->cod?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descripcion?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->can,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->far,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->fin,4)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->ofe_lab,4)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->imp_factura,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->imp_con_ofe,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->nota,2)?></td>
                                </tr>
                               <?php 
                                $imp_fac=$imp_fac+$r->imp_factura;
                                $imp_con_ofe=$imp_con_ofe+$r->imp_con_ofe;
                                $nota=$nota+$r->nota;
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="10"></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($imp_fac,2)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($imp_con_ofe,2)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($nota,2)?></strong></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>