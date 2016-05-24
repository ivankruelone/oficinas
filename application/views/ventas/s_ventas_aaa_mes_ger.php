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
                                     <td>VENTA 2012</td>
                                     <th>VENTA 2013</th>
                                     <th>VENTA 2014</th>
                                     <th>VENTA 2015</th>
                                     <th>OBJETIVO</th>
                                     <th>% ALCANCE</th>
                                     <th>% NIVEL DE SURTIDO</th>
                                     <th>OBJETIVO<br />NIVEL DE SURTIDO</th>
                                     <th>% ALCANCE<br />NIVEL DE SURTIDO</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
$l1=anchor('ventas/s_ventas_aaa_mes_det_ger/'.$aaa.'/'.$r->mes.'/'.$r->tipo3,$r->mesx);

                                $num=$num+1;
                                ?> 
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->a2012,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->a2013,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->a2014,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->a2015,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->prome,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->alcance,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->nivel_surtido,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->prome_surtido,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->alcance_surtido,2)?></td>
                                        
                                        
                                       </tr>
                                       <?php 
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                 </div>