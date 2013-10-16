                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: left">Mes</th> 
                                     <th style="text-align: left">Negocio</th>
                                     <th style="text-align: right">Entradas</th>
                                     <th style="text-align: right">Venta Credito</th>
                                     <th style="text-align: right">Venta Contado</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $credito=0;$contado=0;$recarga=0;
                                $ttcontado=0;$ttcredito=0;$ttrecarga=0;      
                                $num=0;$tcredito=0;$tcontado=0;$trecarga=0;
                                foreach ($a->result()as $r){
                               $l0 = anchor('mer_inventario/inve_suc/'.$r->tipo,$r->tipo.'</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                if($r->tipo=='D' || $r->tipo=='G' || $r->tipo=='F'){$color='blue';}else{$color='green';}?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->mes?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $r->nombre?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->entrada,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->credito,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->contado,2)?></td>
                                <td></td>
                                <td></td>
                                </tr>
                               <?php  } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                    <td style="color: maroon;text-align: right;">TOTAL ANUAL</td>                                  
                                   
                                  </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>