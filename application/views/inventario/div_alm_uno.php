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
                                     <th style="text-align: left">Clave</th> 
                                     <th style="color:gray; text-align: left">Descripcion</th>
                                     <th style="color:gray; text-align: left">Lote</th>
                                     <th style="color:gray; text-align: left">Caducidad</th>
                                     <th style="color:gray; text-align: right">Piezas</th>
                                     <th style="color:gray; text-align: right">Costo</th>
                                     <th style="color:gray; text-align: right">Paquetes</th>
                                     <th style="color:gray; text-align: right">Piezas paquete</th>
                                     <th style="color:gray; text-align: right">Importe</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';
                                $tinv_impo=0;$tinv=0;$tinvf=0;$tinvf_impo=0;$tcom=0;$tfac=0;
                                foreach ($a->result()as $r){
                               if($r->paquetes>1){$paq=$r->cantidad/$r->paquetes;}else{$paq=$r->cantidad;}
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->clave?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->descri?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->lote?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->caducidad?></td>
                                <td style="color: <?php echo $color1?>; text-align: right"><?php echo number_format($r->cantidad,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->costo_base,2)?></td>
                                <td style="color: <?php echo $color1?>; text-align: right"><?php echo number_format($r->paquetes,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($paq,6)?></td>
                                <td style="color: <?php echo $color1?>; text-align: right"><?php echo number_format($r->costo_base*$paq,2)?></td>
                                </tr>
                               <?php 
                               $tinv=$tinv+$r->cantidad;
                               $tinv=$tinv+$paq;
                               $tinv_impo=$tinv_impo+($r->costo_base*$paq);
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="7">TOTAL</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv_impo,2)?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>