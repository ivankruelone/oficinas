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
                                     <th>Id</th>
                                     <th style="text-align: center;">Nid</th>
                                     <th style="text-align: center;">Sucursal</th>
                                     <th style="text-align: center;">Venta</th>
                                     <th style="text-align: center;">Costo de la Venta</th>
                                     <th style="text-align: center;">Gastos</th>
                                     <th style="text-align: center;">Utilidad</th>
                                     <th style="text-align: center;">% Utilidad</th>
                                     <th style="text-align: center;">Monto por Cada sucursal</th>
                                     <th style="text-align: center;">Utilidad con 40%<br />Gastos de oficina</th>
                                     <th style="text-align: center;">% Utilidad con 40%<br />Gastos de oficina</th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$utilidad_40=0;
                                     foreach ($q1->result() as $r1) {
                                       $mas_gasto=(($r1->gas_x_suc)*($r1->num_suc))+$r1->gastos;
                                       $utilidad_40=$r1->venta-(+$r1->costo_venta+$mas_gasto);
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->sucx?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->venta,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->costo_venta,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->gastos,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->utilidad,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo '%'.number_format($r1->p_utilidad,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->gas_x_suc,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($utilidad_40,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format((($utilidad_40/$r1->venta)*100),2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r1->venta;
                                        $tot2=$tot2+$r1->costo_venta;
                                        $tot3=$tot3+$r1->gastos;
                                        $tot4=$tot4+$r1->utilidad;
                                        $tot5=$tot5+$utilidad_40;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot3,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot4,2)?></strong></td>
                             <td></td>
                             <td></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot5,2)?></strong></td>
                             <td></td>
                             </tr>
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
 
                                         
                 </div>