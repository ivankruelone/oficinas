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
                                     <th style="text-align: left">Inicio</th> 
                                     <th style="text-align: left">Final</th>
                                     <th style="text-align: left">Laboratorio o mayorista</th>
                                     <th style="text-align: left">Productos</th>
                                     <th style="text-align: right">Compra</th>
                                     <th style="text-align: right">Nota Marzam</th>
                                     <th style="text-align: right">Nota Farmacos</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $nota1=0;$nota2=0;
                                foreach ($q->result()as $r){
    $l1= anchor('ofertas/s_ofertas_periodo_det/'.$r->fecha1.'/'.$r->fecha2.'/'.$r->lab.'/500',' __','class="button-link blue"');
    $l2= anchor('ofertas/s_ofertas_periodo_det/'.$r->fecha1.'/'.$r->fecha2.'/'.$r->lab.'/825',' __','class="button-link blue"');
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha2?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->labor?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->productos,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->compra,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->n500,2).' '.$l1?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->n825,2).' '.$l2?></td>
                                
                                </tr>
                               <?php $nota1=$nota1+$r->n500;$nota2=$nota2+$r->n825;
                                } ?>
                              </tbody>
                              <tfoot>
                               <tr>
                               <td colspan="5"></td> 
                               <td style="color: <?php echo $color2?>; text-align: right"><strong><?php echo number_format($nota1,2).'__'?></strong></td>
                               <td style="color: <?php echo $color2?>; text-align: right"><strong><?php echo number_format($nota2,2).'__'?></strong></td>
                               </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>