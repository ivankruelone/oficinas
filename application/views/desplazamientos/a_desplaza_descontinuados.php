                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 
                                     <tr>
                                        <th>#</th>
                                        <th>Sec</th>
                                        <th>Sustancia Activa</th>
                                        <th>Exis.Cedis</th>
                                        <th>Ene</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Abr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Ago</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dic</th>
                                        <th>Total</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='black';$color1='blue';
                                $t1=0;$pro=0;
                                $num=0;$t2=0;
                                foreach ($q->result()as $r){
                                $l1=anchor('desplazamientos/a_desplaza_descontinuados_det/'.$r->sec,$r->sec);
                               $num=$num+1;
                                ?>
                                <tr bgcolor="#CCFFFF">
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->inv_cedis,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta1,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta2,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta3,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta4,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta5,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta6,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta7,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta8,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta9,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta10,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta11,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->venta12,0)?></td>
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format(
                                ($r->venta1+$r->venta2+$r->venta3+$r->venta4+$r->venta5+$r->venta6+
                                $r->venta7+$r->venta8+$r->venta9+$r->venta10+$r->venta11+$r->venta12))?></td>
                                </tr>
                                
                                
                               <?php 
                               
                                }
                                ?>
                              </tbody>
                              <tfoot>
                              
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>