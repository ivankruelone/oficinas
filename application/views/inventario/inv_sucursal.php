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
                                     <th style="text-align: left">Sec</th> 
                                     <th style="text-align: left">Clasifica</th>
                                     <th style="color:gray; text-align: left">Sustancia Activa</th>
                                     <th style="color:gray; text-align: left">Inv Cedis</th>
                                     <th style="color:gray; text-align: right">Inv Farmacia</th>
                                     <th style="color:gray; text-align: left">Optimo</th>
                                     <th style="color:gray; text-align: right">Inv Farmacia<br />Sin excedente</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($a->result()as $r){
                                $l0 = anchor('inventario/inv_sucursal_espe/'.$r->sec,'Det</a>', array('title' => 'Haz Click aqui para ver detalle!', 'class' => 'encabezado'));
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->clasi?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->inv1,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->cantidad,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->optimo,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->exis_sin_exc,0)?></td>
                                </tr>
                               <?php 
                               $tinv=$tinv+$r->inv1;
                               $tinv_impo=$tinv_impo+$r->cantidad;
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="4">TOTAL</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv_impo,0)?></td>
                              <td></td>
                              <td></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>