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
                                        <th>#</th>
                                        <th>Sec</th>
                                        <th>Clas</th>
                                        <th>Sustancia Activa</th>
                                        <th>2011</th>
                                        <th>2012</th>
                                        <th>2013</th>
                                        <th>Final</th>
                                        <th>Nuevo Maximo</th>
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
                                        <th>Inv</th>
                                        <th>Fecha Inv</th>
                                        <th>Detalle</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray';
                                $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;$t12=0;$tinv=0;
                                $num=0;
                                foreach ($a->result()as $r){
                                    
                                    
                              
                                 
                                 
                                   if($r->tipo=='a'){$maxi=$r->final*1; $finalm=$r->final*1;}////45
                               	elseif($r->tipo=='b'){$maxi=$r->final*1; $finalm=$r->final*1;}////40
                               	elseif($r->tipo=='c'){$maxi=$r->final*1; $finalm=$r->final*1;}/////30
                               	elseif($r->tipo=='d'){$maxi=$r->final*1; $finalm=$r->final*1;}/////30
                               $num=$num+1;
                               $inv=$r->cantidad; 
                               $fechai=$r->fechai; 
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $num?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->sec?></td>
                                <td style="color:<?php echo $color?>; text-align: center"><?php echo $r->tipo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->susa?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->m2011,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->m2012,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->m2013,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->final,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($finalm,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta1,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta2,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta3,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta4,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta5,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta6,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta7,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta8,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta9,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta10,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta11,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->venta12,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($inv,0)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo $fechai?></td>
                                <td style="color: <?php echo $color?>; text-align: right"></td>
                                </tr>
                               <?php 
$t1=$t1+($r->venta1);
$t2=$t2+($r->venta2);
$t3=$t3+($r->venta3);
$t4=$t4+($r->venta4);
$t5=$t5+($r->venta5);
$t6=$t6+($r->venta6);
$t7=$t7+($r->venta7);
$t8=$t8+($r->venta8);
$t9=$t9+($r->venta9);
$t10=$t10+($r->venta10);
$t11=$t11+($r->venta11);
$t12=$t12+($r->venta12);
$tinv=$tinv+($inv);  
                               
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="9" style="color:red; text-align: right">TOTAL</td>
                              <td style="color:red; text-align: right"><?php echo number_format($t1,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t2,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t3,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t4,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t5,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t6,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t7,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t8,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t9,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t10,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t11,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($t12,0)?></td>
                              <td style="color:red; text-align: right"><?php echo number_format($tinv,0)?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>