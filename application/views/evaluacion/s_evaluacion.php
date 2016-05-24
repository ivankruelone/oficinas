                 <div class="span10">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: center">A&ntilde;o</th>
                                     <th style="text-align: center">Mes</th>  
                                     <th style="text-align: center">Imagen</th>
                                     <th style="color:green; text-align: center">Venta</th>
                                     <th style="color:green; text-align: center">Costo de Venta</th>
                                     <th style="color:red; text-align: center">Renta</th>
                                     <th style="color:red; text-align: center">Nominas</th>
                                     <th style="color:red; text-align: center">Insumos</th>
                                     <th style="color:red; text-align: center">Merma</th>
                                     <th style="color:red; text-align: center">Agua</th>
                                     <th style="color:red; text-align: center">Luz</th>
                                     <th style="color:red; text-align: center">Tel</th>
                                     <th style="color:red; text-align: center">Otros</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='red'; $color3='green';
                                $aaa=date('Y');$pro=0;$fal=0;$por=0;$aba=0;$paba=0;
                                foreach ($q->result()as $r){
                                $l0 = anchor('evaluacion/s_evaluacion_nac_suc/'.$aaa.'/'.$r->mes,$r->mes.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo  $color?>; text-align: center"><?php echo $r->aaa?></td>
                                <td style="color:<?php echo  $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $r->motivo?></td>
                                <td style="color: <?php echo $color3?>; text-align: right"><?php echo number_format($r->venta,2)?></td>
                                <td style="color: <?php echo $color3?>; text-align: right"><?php echo number_format($r->costo_venta,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->renta,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->nomina,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->insumos,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->dev,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->agua,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->luz,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->tel,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->otros,2)?></td>
                                </tr>
                               <?php 
                                
                                }
                                ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td style="color: <?php echo $color?>; text-align: right" colspan="2"><strong>TOTAL</strong></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>