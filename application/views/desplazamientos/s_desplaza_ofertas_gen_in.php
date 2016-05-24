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
                                        <th>Fecha<br />Activo</th>
                                        <th>Sec</th>
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
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
                                        <th>Insentivo<br />Por Pieza</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;
                                $num=0;
                                foreach ($q->result()as $r){
                                $l1=anchor('desplazamientos/s_desplaza_ofertas_gen_in_det/'.$aaa.'/'.$r->codigo,$r->codigo);
                               $num=$num+1;
                                ?>
                                <tr>
                                
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha_activos?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
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
                                <td style="color:<?php echo $color?>; text-align: right"><?php echo number_format($r->insentivo,2)?></td>
                                
                                
                                </tr>
                               <?php 
                               $t1=$t1+$r->venta1;
                               $t2=$t2+$r->venta2;
                               $t3=$t3+$r->venta3;
                               $t4=$t4+$r->venta4;
                               $t5=$t5+$r->venta5;
                               $t6=$t6+$r->venta6;
                               $t7=$t7+$r->venta7;
                               $t8=$t8+$r->venta8;
                               $t9=$t9+$r->venta9;
                               $t10=$t10+$r->venta10;
                               $t11=$t11+$r->venta11;
                               $t12=$t12+$r->venta12;
                                }
                                ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="5" style="color:red; text-align: right">Total</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($t1,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($t2,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($t3,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($t4,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($t5,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($t6,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($t7,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($t8,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($t9,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($t10,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($t11,0)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($t12,0)?></td>
                              <td></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>