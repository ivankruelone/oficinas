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
                                 <th colspan="2"></th>
                                 <th colspan="3" style="color:gray;text-align: center">INVENTARIOS</th>
                                 
                                 </tr>
                                 <tr>
                                     <th style="text-align: left">Sec</th> 
                                     <th style="color:gray; text-align: left">Sustancia Activa</th>
                                     <th style="color:gray; text-align: left">Lote</th>
                                     <th style="color:gray; text-align: right">Caducidad</th>
                                     <th style="color:gray; text-align: right">Piezas</th>
                                     <th style="color:gray; text-align: right">Costo</th>
                                     <th style="color:gray; text-align: right">Importe</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $tinv_impo=0;$tinv=0;
                                foreach ($a->result()as $r){
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->lote?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->cadu ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->inv1,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->costoo,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format(($r->inv1*$r->costoo),2)?></td>
                                </tr>
                               <?php 
                               $tinv=$tinv+$r->inv1;
                               $tinv_impo=$tinv_impo+($r->inv1*$r->costoo);
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="4">TOTAL</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv,0)?></td>
                              <td></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tinv_impo,2)?></td>
                              
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>