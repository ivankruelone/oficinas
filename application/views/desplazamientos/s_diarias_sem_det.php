                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th style="text-align: center">Sec</th> 
                                     <th style="text-align: Left">Sustancia Activa</th>
                                     <th style="text-align: right">Lun</th>
                                     <th style="text-align: right">Mar</th>
                                     <th style="text-align: right">Mie</th>
                                     <th style="text-align: right">jue</th>
                                     <th style="text-align: right">Vie</th>
                                     <th style="text-align: right">Sab</th>
                                     <th style="text-align: right">Dom</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $d1=0;$d2=0;$d3=0;$d4=0;$d5=0;$d6=0;$d7=0;
                                $td1=0;$td2=0;$td3=0;$td4=0;$td5=0;$td6=0;$td7=0;
                                foreach ($a as $r0) {?>

                               <?php foreach ($r0['m'] as $r1) {
                               if($r1['dia']==0){$d1=$r1['venta'];}
                               if($r1['dia']==1){$d2=$r1['venta'];}
                               if($r1['dia']==2){$d3=$r1['venta'];}
                               if($r1['dia']==3){$d4=$r1['venta'];}
                               if($r1['dia']==4){$d5=$r1['venta'];}
                               if($r1['dia']==5){$d6=$r1['venta'];}
                               if($r1['dia']==6){$d7=$r1['venta'];}
                                ?>
                               <?php }?>   
                                <tr>
                                <td style="color: maroon; text-align: left"><?php echo $r0['sec']?></td>
                                <td style="color: maroon; text-align: left"><?php echo $r0['susa1']?></td>
                                <td style="color: maroon; text-align: left"><?php echo $d1?></td>
                                <td style="color: maroon; text-align: left"><?php echo $d2?></td>
                                <td style="color: maroon; text-align: left"><?php echo $d3?></td>
                                <td style="color: maroon; text-align: left"><?php echo $d4?></td>
                                <td style="color: maroon; text-align: left"><?php echo $d5?></td>
                                <td style="color: maroon; text-align: left"><?php echo $d6?></td>
                                <td style="color: maroon; text-align: left"><?php echo $d7?></td>
                                </tr>
                                 <?php 
                                 $td1=$td1+$d1;
                                 $td2=$td2+$d2;
                                 $td3=$td3+$d3;
                                 $td4=$td4+$d4;
                                 $td5=$td5+$d5;
                                 $td6=$td6+$d6;
                                 $td7=$td7+$d7;
                                 $d1=0;$d2=0;$d3=0;$d4=0;$d5=0;$d6=0;$d7=0;
                                 } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                    <td colspan="2" style="color: maroon;text-align: right;">TOTAL ANUAL</td>                                  
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($td1,0)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($td2,0)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($td3,0)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($td4,0)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($td5,0)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($td6,0)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($td7,0)?></td>
                                  </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>