                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla">
                             <thead>
                                <tr>
                                <th colspan="10">REPORTE DE VENTAS SIN CREDITO Y SIN RECARGAS</th>
                                </tr>
                                 <tr>
                                     <th style="text-align: center">#</th>
                                     <th style="text-align: center">Mes</th>
                                     <th style="text-align: right; color: blue;">VENTA 2012</th> 
                                     <th style="text-align: right; color: blue;">VENTA 2013</th>
                                     <th style="text-align: right; color: blue;">VENTA 2014</th>
                                     <th style="text-align: right; color: blue;">VENTA 2015<br />Capturada</th>
                                     <th style="text-align: right; color: blue;">PROMEDIO</th>
                                     <th style="text-align: right; color: blue;">% DE ALCANCE</th>
                                     <th style="text-align: right; color: blue;">VENTA 2015<br />CONTA</th>
                                     <th style="text-align: right; color: green;">% DE ALCANCE<br />REAL</th>
                                 </tr>
                                 
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$porce=0;$porce_real=0;$t08=0;
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
                                if($r->porce<=50){$color='red';}else{$color='black';}
                                $l0=anchor('ventas/s_ventas_comparativas_historicas_det_ger/'.$r->mes,$r->mesx.'</a>', array('title' => 'Haz Click aqui para Borrar!', 'class' => 'encabezado'));
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r->mes?></td>
                                <td style="color: maroon;"><?php echo $l0?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->a2012,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->a2013,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->a2014,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->venta_mes,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->prome,2)?></td>
                                <td style="text-align: right; color: <?php echo $color?>"><?php echo'% '.number_format($r->porce,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->a2015,2)?></td>
                                <td style="text-align: right; color: green;"><?php echo '% '.number_format($r->porce_real,2)?></td>
                                </tr>
                                <?php 
                                $t01=$t01+$r->a2012;
                                $t02=$t02+$r->a2013;
                                $t03=$t03+$r->a2014;
                                $t04=$t04+$r->venta_mes;
                                $t05=$t05+$r->prome;
                                $t06=$t06+$r->a2015;
                                }
                                $porce=($t04/$t05)*100;
                                $porce_real=($t06/$t05)*100;
                                if($porce<=50)
                                {$color='red';}else{$color='black';}?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                            <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t01,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t02,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t03,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t04,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t05,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: <?php echo $color?>;"><strong><?php echo '% '.number_format($porce,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t06,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: <?php echo $color?>;"><strong><?php echo '% '.number_format($porce_real,2)?></strong></td>
                                
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>