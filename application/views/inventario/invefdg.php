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
                                     <th style="text-align: left"></th> 
                                     <th style="text-align: left">Mes</th> 
                                     <th style="text-align: left">Compa�ia</th>
                                     <th style="text-align: right">Inventarios</th>
                                     <th style="text-align: right">Compras</th>
                                     <th style="text-align: right">Venta de contado</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $credito=0;$contado=0;$recarga=0;
                                $ttcontado=0;$ttcredito=0;$ttrecarga=0;      
                                $num=0;$tcredito=0;$tcontado=0;$trecarga=0;
                                foreach ($a->result()as $r){
                               $l0 = anchor('inventario/entrada/'.$r->tipo.'/'.$r->num,'_</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                if($r->tipo=='D' || $r->tipo=='G' || $r->tipo=='F'){$color='blue';}else{$color='green';}?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->mes?></td>
                                <td style="color: <?php echo $color?>; text-align: left"><?php echo $r->nombre?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->entrada,2).$l0?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->credito,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->contado,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->inv,2)?></td>
                                </tr>
                               <?php  } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>