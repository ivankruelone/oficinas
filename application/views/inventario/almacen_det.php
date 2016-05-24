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
                                 <th colspan="13" style="color:gray;text-align: center">DESPLAZAMIENTO</th>
                                 </tr>
                                 <tr>
                                     <th style="text-align: left">Sec</th> 
                                     <th style="text-align: left">C</th>
                                     <th style="color:gray; text-align: left">Sustancia Activa</th>
                                     <th style="color:gray; text-align: left">Inv.Cedis</th>
                                     <th style="color:gray; text-align: right">A&ntilde;o</th>
                                     <th style="color:gray; text-align: right">Ene</th>
                                     <th style="color:gray; text-align: right">Feb</th>
                                     <th style="color:gray; text-align: right">Mar</th>
                                     <th style="color:gray; text-align: right">Abr</th>
                                     <th style="color:gray; text-align: right">May</th>
                                     <th style="color:gray; text-align: right">Jun</th>
                                     <th style="color:gray; text-align: right">Jul</th>
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
                                if($tipo<>'con'){
                                if($r->descon=='N'){$color='gray';}else{$color='red';}
                                }
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->tipo?></td>
                                <td style="size:-1; color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->inv1,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo (date('Y')-2).'<br />'.(date('Y')-1).'<br />'.date('Y')?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->aa1,0).'<br />'.number_format($r->a1,0).'<br />'.number_format($r->venta1,0) ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->aa2,0).'<br />'.number_format($r->a2,0).'<br />'.number_format($r->venta2,0) ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->aa3,0).'<br />'.number_format($r->a3,0).'<br />'.number_format($r->venta3,0) ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->aa4,0).'<br />'.number_format($r->a4,0).'<br />'.number_format($r->venta4,0) ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->aa5,0).'<br />'.number_format($r->a5,0).'<br />'.number_format($r->venta5,0) ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->aa6,0).'<br />'.number_format($r->a6,0).'<br />'.number_format($r->venta6,0) ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->aa7,0).'<br />'.number_format($r->a7,0).'<br />'.number_format($r->venta7,0) ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->aa8,0).'<br />'.number_format($r->a8,0).'<br />'.number_format($r->venta8,0) ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->aa9,0).'<br />'.number_format($r->a9,0).'<br />'.number_format($r->venta9,0) ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->aa10,0).'<br />'.number_format($r->a10,0).'<br />'.number_format($r->venta10,0) ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->aa11,0).'<br />'.number_format($r->a11,0).'<br />'.number_format($r->venta11,0) ?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->aa12,0).'<br />'.number_format($r->a12,0).'<br />'.number_format($r->venta12,0) ?></td>
                                </tr>
                               <?php 
                               $tinv=$tinv+$r->inv1;
                               $tinv_impo=$tinv_impo+$r->inv1;
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>