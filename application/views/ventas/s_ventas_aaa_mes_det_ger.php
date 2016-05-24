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
$l1=anchor('ventas/s_estadistica_ventas_reg/'.$aaa.'/'.$mes.'/'.$tipo3,'EVALUACION'); 
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th><?php echo $l1?></th>
                                 </tr>
                                 <tr>
                                     <th>#</th>
                                     <th>NID</th>
                                     <th>SUCURSAl</th>
                                     <th>OBJETIVO</th>
                                     <th>OBJETIVO<br />NIVEL DE<br />SURTIDO</th>
                                     <th><?php echo $mesx ?><br />VENTA 2015</th>
                                     <th>% ALCANCE<br />NIVEL<br /> DE SURTIDO</th>
                                     <th>$ UTILIDAD</th>
                                     <th>% UTIL</th>
                                     <th><?php echo $mesxa ?><br />VENTA 2015</th>
                                     <th>DIFERENCIA<br /><?php echo $mesx ?> 2015 <br /><?php echo $mesxa ?> 2015</th>
                                     <th><?php echo $mesx ?><br />VENTA 2014</th>
                                     <th>DIFERENCIA<br /><?php echo $mesx ?> 2015 <br /><?php echo $mesx ?> 2014</th>
                                     
                                     
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $t1=0;$t2=0;$t3=0;$t4=0;$t5=0;$t6=0;$t7=0;$t8=0;$t9=0;$t10=0;$t11=0;
                                $num=0; $color='blue';$color1='blue';
                                foreach ($q->result() as $r) {
                                $num=$num+1;
if($r->por_util>10){$color2='green';}elseif($r->por_util>0 and $r->por_util<=9.99){$color2='orange';}else{$color2='red';}
if($r->a2015>$r->mes_ant){$color3='green';}elseif($r->a2015==$r->mes_ant){$color3='orange';}else{$color3='red';}
if($r->a2015>$r->a2014){$color4='green';}elseif($r->a2015==$r->a2014){$color4='orange';}else{$color4='red';}
                                ?> 
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo $r->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color1 ?>"><?php echo $r->fecha_act.'- '.trim($r->sucx)?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($r->prome,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($r->prome_surtido,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($r->a2015,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color1 ?>"><?php echo number_format($r->alcance_surtido,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color2 ?>"><?php echo number_format($r->utilidad,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color2 ?>"><?php echo number_format($r->por_util,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color3 ?>"><?php echo number_format($r->mes_ant,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color3 ?>"><?php echo number_format(($r->a2015-$r->mes_ant),2)?></td>
                                        <td style="text-align: right; color: <?php echo $color4 ?>"><?php echo number_format($r->a2014,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color4 ?>"><?php echo number_format(($r->a2015-$r->a2014),2)?></td>
                                        
                                        
                                       </tr>
                                       <?php 
                                        $t1=$t1+$r->prome;
                                        $t2=$t2+$r->prome_surtido;
                                        $t3=$t3+$r->a2015;
                                        $t4='';
                                        $t5=$t5+$r->utilidad;
                                        $t6='';
                                        $t7=$t7+$r->mes_ant;
                                        $t8=$t8+($r->a2015-$r->mes_ant);
                                        $t9=$t9+$r->a2014;
                                        $t10=$t10+($r->a2015-$r->a2014);
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                                        <tr>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: left; color: <?php echo $color ?>">TOTAL</td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t1,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t2,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t3,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t4,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t5,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t6,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t7,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t8,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t9,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($t10,2)?></td>
                                        </tr>
                                       <tr>
                                     <td>#</td>
                                     <td>NID</td>
                                     <td>SUCURSAl</td>
                                     <td>OBJETIVO</td>
                                     <td>OBJETIVO<br />NIVEL DE<br />SURTIDO</td>
                                     <td><?php echo $mesx ?><br />VENTA 2015</td>
                                     <td>% ALCANCE<br />NIVEL<br /> DE SURTIDO</td>
                                     <td>$ UTILIDAD</td>
                                     <td>% UTIL</td>
                                     <td><?php echo $mesxa ?><br />VENTA 2015</td>
                                     <td>DIFERENCIA<br /><?php echo $mesx ?> 2015 <br /><?php echo $mesxa ?> 2015</td>
                                     <td><?php echo $mesx ?><br />VENTA 2014</td>
                                     <td>DIFERENCIA<br /><?php echo $mesx ?> 2015 <br /><?php echo $mesx ?> 2014</td>
                                     
                                     
                                   </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                 </div>