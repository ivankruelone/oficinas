                 <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                           <span class="tools">
                            <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                               <a href="javascript:;" class="icon-chevron-down">
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: center">Clasifica</th>
                                     <th style="text-align: center">Descripcion</th>  
                                     <th style="text-align: center">Productos</th>
                                     <th style="color:green; text-align: center">Abasto</th>
                                     <th style="color:green; text-align: center">% Abasto</th>
                                     <th style="color:red; text-align: center">Faltantes</th>
                                     <th style="color:red; text-align: center">% Desabasto</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='red'; $color3='green';
                                $aaa=date('Y');$pro=0;$fal=0;$por=0;$aba=0;$paba=0;
                                foreach ($q->result()as $r){
                                $l0 = anchor('evaluacion/eval_cedis_cla/'.$r->tipo,$r->obser.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->tipo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->productos,0)?></td>
                                <td style="color: <?php echo $color3?>; text-align: right"><?php echo number_format($r->abasto,0)?></td>
                                <td style="color: <?php echo $color3?>; text-align: right"><?php echo'% '. number_format($r->p_abasto,2)?></td>
                                <td style="color: <?php echo $color2?>; text-align: right"><?php echo number_format($r->faltantes,0)?></td>
                                <td style="color: <?php echo $color2?>; text-align: right"><?php echo'% '. number_format($r->p_faltante,2)?></td>
                                </tr>
                               <?php 
                                $pro=$pro+$r->productos;
                                $fal=$fal+$r->faltantes;
                                $aba=$aba+$r->abasto;
                                }
                                $por=($fal/$pro)*100;
                                $paba=100-(($fal/$pro)*100); ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td style="color: <?php echo $color?>; text-align: right" colspan="2"><strong>TOTAL</strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($pro,0)?></strong></td>
                              <td style="color: <?php echo $color3?>; text-align: right"><strong><?php echo number_format($aba,0)?></strong></td>
                              <td style="color: <?php echo $color3?>; text-align: right"><strong><?php echo '% '. number_format($paba,2)?></strong></td>
                              <td style="color: <?php echo $color2?>; text-align: right"><strong><?php echo number_format($fal,0)?></strong></td>
                              <td style="color: <?php echo $color2?>; text-align: right"><strong><?php echo '% '. number_format($por,2)?></strong></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>