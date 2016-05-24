                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php
$l1=anchor('ventas/s_estadistica_ventas_nac/'.$aaa.'/'.$mes.'/'.$tipo3,'EVALUACION'); 
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th><?php echo $l1?></th>
                                 </tr>
                                 <tr>
                                     <th>#</th>
                                     <th></th>
                                     <th>NID</th>
                                     <th>SUCURSAl</th>
                                     <th>VENTA 2012</th>
                                     <th>VENTA 2013</th>
                                     <th>VENTA 2014</th>
                                     <th>VENTA 2015</th>
                                     <th>VENTA 2016</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;
                                $num=0; $color='blue';$color1='blue';
                                foreach ($q->result() as $r) {
                                    if($r->fecha_act=='0000-00-00'){$campo='';}else{$campo=$r->fecha_act;}
                                $num=$num+1;
                                ?> 
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo $campo?></td>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo $r->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo trim($r->sucx)?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($r->a2012,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($r->a2013,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($r->a2014,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($r->a2015,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($r->a2016,2)?></td>
                                       </tr>
                                       <?php 
                                        $t1=$t1+$r->a2012;
                                        $t2=$t2+$r->a2013;
                                        $t3=$t3+$r->a2014;
                                        $t4=$t4+$r->a2015;
                                        $t5=$t5+$r->a2016;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                                        <tr>
                                        
                                        <td colspan="3" style="text-align: left; color: <?php echo $color ?>">TOTAL</td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t1,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t2,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t3,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t4,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t5,2)?></td>
                                        </tr>
                                       
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                        
                 </div>