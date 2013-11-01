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
                                 <th colspan="4" style="color:gray;text-align: center">INVENTARIOS</th>
                                 <th colspan="6" style="color:gray;text-align: center">DESPLAZAMIENTO 2012</th>
                                 </tr>
                                 <tr>
                                     <th style="text-align: left">Sec</th> 
                                     <th style="text-align: left">Clasifica</th>
                                     <th style="color:gray; text-align: left">Sustancia Activa</th>
                                     <th style="color:gray; text-align: left">Inventario</th>
                                     <th style="color:gray; text-align: right">jul</th>
                                     <th style="color:gray; text-align: right">Ago</th>
                                     <th style="color:gray; text-align: right">Sep</th>
                                     <th style="color:gray; text-align: right">Oct</th>
                                     <th style="color:gray; text-align: right">Nov</th>
                                     <th style="color:gray; text-align: right">Dic</th>
                                     
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
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->clasi?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa.'<br />'.date('Y')?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->inv1,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->m7,0).'<br />'.number_format($r->venta7,0) ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->m8,0).'<br />'.number_format($r->venta8,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->m9,0).'<br />'.number_format($r->venta9,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->m10,0).'<br />'.number_format($r->venta10,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->m11,0).'<br />'.number_format($r->venta11,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->m12,0).'<br />'.number_format($r->venta12,0)?></td>
                                </tr>
                               <?php 
                               $tinv=$tinv+$r->inv1;
                               $tinv_impo=$tinv_impo+$r->inv1;
                               
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