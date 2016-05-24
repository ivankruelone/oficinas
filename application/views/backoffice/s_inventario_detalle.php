                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                 <tr> 
                                     <th>Id</th>
                                     <th>Pharm</th>
                                     <th>Nid</th>
                                     <th>Sucurusal</th>
                                     <th>Sem</th>
                                     <th>Dom</th>
                                     <th>Lun</th>
                                     <th>Mar</th>
                                     <th>Mie</th>
                                     <th>Jue</th>
                                     <th>Vie</th>
                                     <th>Sab</th>
                                     <th>Dif</th>
                                  </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q as $r) {
                                $num=$num+1;
                                ?> 
                                        
                                       <?php  $p1=0;$p2=0;$p3=0;$p4=0;$p5=0;$p6=0;$p7=0;$comp1=0;$comp2=0;$dif=0;
                                     foreach ($r['segundo'] as $r2) {
                                        if($r2['dia']==1){$p1=$r2['piezas'];}
                                        elseif($r2['dia']==2){$p2=$r2['piezas'];}
                                        elseif($r2['dia']==3){$p3=$r2['piezas'];}
                                        elseif($r2['dia']==4){$p4=$r2['piezas'];}
                                        elseif($r2['dia']==5){$p5=$r2['piezas'];}
                                        elseif($r2['dia']==6){$p6=$r2['piezas'];}
                                        elseif($r2['dia']==7){$p7=$r2['piezas'];}else{$p7=0;}
                                        
                                        if($r2['dia_hoy']==$r2['dia']){$comp1=$r2['piezas'];}
                                        if($r2['dia_ayer']==$r2['dia']){$comp2=$r2['piezas'];}
                                        $dif=$comp1-$comp2;
                                        }
                                        if($dif==0){$color='red';}else{$color='blue';}?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r['back']?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r['suc']?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r['sucx']?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r['sem']?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $p1?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $p2?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $p3?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $p4?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $p5?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $p6?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $p7?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $dif?></td>
                                        </tr>
                                        <?php
                                        $p1=0;$p2=0;$p3=0;$p4=0;$p5=0;$p6=0;$p7=0;$dif=0;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             
                             <td colspan="12" style="color:black; text-align: left; "><strong>Total <?php echo number_format($num,0).' meses'?></strong></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>