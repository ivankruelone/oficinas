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

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>Mes</th>
                                     <th>Mes</th>
                                     <th>Suc.Con Venta<br />A&ntilde;o Actual</th>
                                     <th>VENTA 2012</th>
                                     <th>VENTA 2013</th>
                                     <th>VENTA 2014</th>
                                     <th>VENTA 2015</th>
                                     <th>VENTA 2016</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;$aaaexel=0;
                                $num=0; $color='black'; $mm=date('m');
                                foreach ($q->result() as $r) {
if($r->mes>$mm){$color='gray';$aaaexel=$aaa-1;}else{$color='blue';$aaaexel=$aaa;}
$l1=anchor('ventas/s_ventas_aaa_mes_det/'.$aaaexel.'/'.$r->mes.'/'.$r->tipo3,$r->mesx);
if($nivel<>12 and $nivel<>13){$l2=anchor('ventas/s_evaluacion_nac_suc/'.$aaaexel.'/'.$r->mes,'R');}else{$l2='';}

                                $num=$num+1;
                                ?> 
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo number_format($r->num_suc,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->a2012,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->a2013,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->a2014,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->a2015,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->a2016,2)?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l2?></td>
                                        
                                       </tr>
                                       <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                    <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart">

                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                                  <tr>
                                     <th>Mes</th>
                                     <th>Mes</th>
                                     <th>Suc.Con Venta</th>
                                     <th>VENTA 2012</th>
                                     <th>VENTA 2013</th>
                                     <th>VENTA 2014</th>
                                     <th>VENTA 2015</th>
                                     <th>VENTA 2016</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q1->result() as $r1) {
$l1=anchor('ventas/s_ventas_aaa_mes_det/'.$aaa.'/'.$r1->mes.'/'.$r1->tipo3,$r1->mesx);
$l2=anchor('ventas/s_evaluacion_nac_suc/'.$aaa.'/'.$r1->mes,'R');
                                $num=$num+1;
                                ?> 
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->num_suc,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->a2012,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->a2013,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->a2014,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->a2015,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->a2016,2)?></td>
                                        <td></td>
                                       </tr>
                                       <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             </tfoot>
                         </table>                        
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                    <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart1">

                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                      <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget gray">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit3?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla3">
                             <thead>
                                 <tr>
                                     <th>Mes</th>
                                     <th>Mes</th>
                                     <th>Suc.Con Venta</th>
                                     <th>VENTA 2012</th>
                                     <th>VENTA 2013</th>
                                     <th>VENTA 2014</th>
                                     <th>VENTA 2015</th>
                                     <th>VENTA 2016</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q2->result() as $r2) {
$l1=anchor('ventas/s_ventas_aaa_mes_det/'.$aaa.'/'.$r2->mes.'/'.$r2->tipo3,$r2->mesx);
$l2=anchor('ventas/s_evaluacion_nac_suc/'.$aaa.'/'.$r2->mes,'R');
                                $num=$num+1;
                                ?> 
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->num_suc,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->a2012,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->a2013,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->a2014,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->a2015,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->a2016,2)?></td>
                                        <td></td>
                                        
                                       </tr>
                                       <?php 
                                        }?>
                                        
                                
                             </tbody>
                             
                         </table>                        
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                    <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget gray">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit3?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart2">

                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                     
                     
                     
                     
                     
                 </div>                 