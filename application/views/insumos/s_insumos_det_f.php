                 <div class="span12">
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
 foreach ($q2->result() as $r) {
?>
<p>Nid: <?php echo $r->suc?></p>
<p>Sucursal: <?php echo $r->nombre?></p>
<?php
}
?>
<?php 
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                  
                                  <tr> 
                                     <th>Id</th>
                                     <th>Codigo</th>
                                     <th>Descripcion</th>
                                     <th>Presentacion</th>
                                     <th>Pedido</th>
                                     <th>Calculada</th>
                                     <th>Cantidad Supervisor</th>
                                     <th>Surtido</th>
                                     <th>Imp.Ped</th>
                                     <th>Imp.Sur</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$totc=0; $imp1=0; $imp2=0;$t1=0;$t2=0;$t3=0;$t4=0;
                                     foreach ($q->result() as $r2) {
  if($r2->canp>$r2->sur){$bgcolor='orange';}else{$bgcolor='blue';}                                        
                                        ?>
                                        
                                        <tr style="bgcolor=<?php echo $bgcolor ?>">
                                        <td style="text-align: left; color: <?php echo $bgcolor ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $bgcolor ?>"><?php echo $r2->id_insumos?></td>
                                        <td style="text-align: left; color: <?php echo $bgcolor ?>"><?php echo $r2->descripcion?></td>
                                        <td style="text-align: left; color: <?php echo $bgcolor ?>"><?php echo $r2->empaque?></td>
                                        <td style="text-align: right; color: <?php echo $bgcolor ?>"><?php echo $r2->canp_suc?></td>
                                        <td style="text-align: right; color: <?php echo $bgcolor ?>"><?php echo $r2->canp?></td>
                                        <td style="text-align: right; color: <?php echo $bgcolor ?>"><?php echo $r2->canp_sup?></td>
                                        <td style="text-align: right; color: <?php echo $bgcolor ?>"><?php echo $r2->sur?></td>
                                        <td style="text-align: right; color: <?php echo $bgcolor ?>"><?php echo number_format(($r2->canp_sup*$r2->costo),2)?></td>
                                        <td style="text-align: right; color: <?php echo $bgcolor ?>"><?php echo number_format(($r2->sur*$r2->costo),2)?></td>
                                        </tr>
                                        <?php $num=$num+1;
                                        $t1=$t1+$r2->canp_suc;
                                        $t2=$t2+$r2->canp;
                                        $t3=$t3+$r2->canp_sup;
                                        $t4=$t4+$r2->sur;
                                        $imp1=$imp1+($r2->canp_sup*$r2->costo);
                                        $imp2=$imp2+($r2->sur*$r2->costo);
                                        }?>
                                        <tfoot>
                                        <tr>
                                        <td colspan="4"></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format(($t1),0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format(($t2),0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format(($t3),0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format(($t4),0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format(($imp1),2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format(($imp2),2)?></td>
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