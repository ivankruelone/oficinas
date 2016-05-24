                 <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php 
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                                  
                                  <tr> 
                                     <th>Mes</th>
                                     <th>Importe Sucursal</th>
                                     <th>Importe Calculado</th>
                                     <th>Diferencia</th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$imp3=0; $imp1=0; $imp2=0;
                                     foreach ($q->result() as $r2) {
                                     ?>
                                        
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->mesx?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->sucursal,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->calculo,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->dif,2)?></td>
                                        </tr>
                                        <?php $num=$num+1;
                                        $imp1=$imp1+($r2->sucursal);
                                        $imp2=$imp2+($r2->calculo);
                                        $imp3=$imp3+($r2->dif);
                                        }?>
                                        <tfoot>
                                        <tr>
                                        <td>TOTAL</td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($imp1,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($imp2,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($imp3,2)?></td>
                                        </tr>
                                        </tfoot>
                                
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>