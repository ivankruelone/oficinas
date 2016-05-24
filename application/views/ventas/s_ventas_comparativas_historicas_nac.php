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
                                     <th style="text-align: center">#</th>
                                     <th style="text-align: center">Mes</th>
                                     <th style="text-align: right; color: blue;">OBJETIVO</th> 
                                     <th style="text-align: right; color: blue;">VENTA 2015<br />
                                     <th style="text-align: right; color: blue;">% DE ALCANCE DE VENTA</th>
                                     
                                 </tr>
                                 
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$porce=0;
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
                                if($r->porce<=50){$color='red';}else{$color='black';}
                                $l0=anchor('ventas/s_ventas_comparativas_historicas_det_nac/'.$r->mes.'/'.$r->tipo3,$r->mesx.'</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r->mes?></td>
                                <td style="color: maroon;"><?php echo $l0?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->prome,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->a2015,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->porce,2)?></td>
                                </tr>
                                <?php 
                                $t01=$t01+$r->prome;
                                $t02=$t02+$r->a2015;
                                
                                }
                                $porce=($t02/$t01)*100;
                                if($porce<=50)
                                {$color='red';}else{$color='black';}?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                            <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t01,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t02,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: <?php echo $color?>;"><strong><?php echo '% '.number_format($porce,2)?></strong></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget gray">
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
                                     <th style="text-align: center">#</th>
                                     <th style="text-align: center">Mes</th>
                                     <th style="text-align: right; color: blue;">OBJETIVO</th> 
                                     <th style="text-align: right; color: blue;">VENTA 2015<br />
                                     <th style="text-align: right; color: blue;">% DE ALCANCE DE VENTA</th>
                                     
                                 </tr>
                                 
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$porce=0;
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q2->result() as $r2) {
                                if($r->porce<=50){$color='red';}else{$color='black';}
                                $l0=anchor('ventas/s_ventas_comparativas_historicas_det_nac/'.$r2->mes.'/'.$r2->tipo3,$r2->mesx.'</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r2->mes?></td>
                                <td style="color: maroon;"><?php echo $l0?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r2->prome,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r2->a2015,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r2->porce,2)?></td>
                                </tr>
                                <?php 
                                $t01=$t01+$r2->prome;
                                $t02=$t02+$r2->a2015;
                                
                                }
                                $porce=($t02/$t01)*100;
                                if($porce<=50)
                                {$color='red';}else{$color='black';}?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                            <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t01,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t02,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: <?php echo $color?>;"><strong><?php echo '% '.number_format($porce,2)?></strong></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
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
                                     <th style="text-align: center">#</th>
                                     <th style="text-align: center">Mes</th>
                                     <th style="text-align: right; color: blue;">OBJETIVO</th> 
                                     <th style="text-align: right; color: blue;">VENTA 2015<br />
                                     <th style="text-align: right; color: blue;">% DE ALCANCE DE VENTA</th>
                                     
                                 </tr>
                                 
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$porce=0;
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q3->result() as $r3) {
                                if($r->porce<=50){$color='red';}else{$color='black';}
                                $l0=anchor('ventas/s_ventas_comparativas_historicas_det_nac/'.$r3->mes.'/'.$r3->tipo3,$r3->mesx.'</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r3->mes?></td>
                                <td style="color: maroon;"><?php echo $l0?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r3->prome,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r3->a2015,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r3->porce,2)?></td>
                                </tr>
                                <?php 
                                $t01=$t01+$r3->prome;
                                $t02=$t02+$r3->a2015;
                                
                                }
                                $porce=($t02/$t01)*100;
                                if($porce<=50)
                                {$color='red';}else{$color='black';}?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                            <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t01,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t02,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: <?php echo $color?>;"><strong><?php echo '% '.number_format($porce,2)?></strong></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                    
                 </div>