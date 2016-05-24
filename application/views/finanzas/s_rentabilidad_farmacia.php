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
<?php 

$atts = array(
              'width'      => '1100',
              'height'     => '600',
              'scrollbars' => 'no',
              'status'     => 'no',
              'resizable'  => 'no',
              'screenx'    => '0',
              'screeny'    => '0'
            );
$l0 = anchor_popup('finanzas/s_rentabilidad_imp/DA', 'Vista para impresion', $atts);
//$l0=anchor('finanzas/s_rentabilidad_imp/DA','Ver','target=blank');
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                <tr>
                                <th colspan="11"><?php echo $l0?></th>
                                </tr>
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">A&ntilde;o</th>
                                     <th style="text-align: center;">Mes</th>
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
                                      $l1 = anchor('finanzas/s_rentabilidad_farmacia_det/'.$r1->aaa.'/'.$r1->mes.'/'.$r1->tipo3,$r1->mesx, array('title' => 'Haz Click aqui para Ver detalle!', 'class' => 'encabezado'));
                                       $mas_gasto=(($r1->gas_x_suc)*($r1->num_suc))+$r1->gastos;
                                       $utilidad_40=$r1->venta-(+$r1->costo_venta+$mas_gasto);
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->aaa?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->mes.' - '.$l1?></td>
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
 <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                           <span class="tools">
                           
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart1"></div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
 <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                           <span class="tools">
                           
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart2"></div>
                     </div>
                     <!-- END BLANK PAGE PORTLET--> 
                      <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget gray">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">

                             <thead>
                                
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">A&ntilde;o</th>
                                     <th style="text-align: center;">Mes</th>
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
                                     foreach ($q2->result() as $r2) {
                                      $l1 = anchor('finanzas/s_rentabilidad_farmacia_det/'.$r2->aaa.'/'.$r2->mes.'/'.$r2->tipo3,$r2->mesx, array('title' => 'Haz Click aqui para Ver detalle!', 'class' => 'encabezado'));
                                       $mas_gasto=(($r2->gas_x_suc)*($r2->num_suc))+$r2->gastos;
                                       $utilidad_40=$r2->venta-(+$r2->costo_venta+$mas_gasto);
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->aaa?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->mes.' - '.$l1?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->venta,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->costo_venta,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->gastos,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->utilidad,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo '%'.number_format($r2->p_utilidad,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->gas_x_suc,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($utilidad_40,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format((($utilidad_40/$r2->venta)*100),2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r2->venta;
                                        $tot2=$tot2+$r2->costo_venta;
                                        $tot3=$tot3+$r2->gastos;
                                        $tot4=$tot4+$r2->utilidad;
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
 <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget gray">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                           
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart3"></div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
 <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget gray">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                           
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart4"></div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                      <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo3?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla3">

                             <thead>
                                
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">A&ntilde;o</th>
                                     <th style="text-align: center;">Mes</th>
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
                                     foreach ($q3->result() as $r3) {
                                      $l1 = anchor('finanzas/s_rentabilidad_farmacia_det/'.$r3->aaa.'/'.$r3->mes.'/'.$r3->tipo3,$r3->mesx, array('title' => 'Haz Click aqui para Ver detalle!', 'class' => 'encabezado'));
                                       $mas_gasto=(($r3->gas_x_suc)*($r3->num_suc))+$r3->gastos;
                                       $utilidad_40=$r3->venta-(+$r3->costo_venta+$mas_gasto);
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r3->aaa?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r3->mes.' - '.$l1?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->venta,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->costo_venta,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->gastos,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->utilidad,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo '%'.number_format($r3->p_utilidad,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r3->gas_x_suc,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($utilidad_40,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format((($utilidad_40/$r3->venta)*100),2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot1=$tot1+$r3->venta;
                                        $tot2=$tot2+$r3->costo_venta;
                                        $tot3=$tot3+$r3->gastos;
                                        $tot4=$tot4+$r3->utilidad;
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
 <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo3?></h4>
                           <span class="tools">
                           
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart5"></div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
 <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo3?></h4>
                           <span class="tools">
                           
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart6"></div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->                   
                 </div>