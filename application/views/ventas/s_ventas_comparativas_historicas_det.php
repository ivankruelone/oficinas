                 <div class="span10">
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
                                     <th style="text-align: center">Nid</th>
                                     <th style="text-align: center">Sucursal</th>
                                     <th style="text-align: right; color: blue;">PROMEDIO</th>
                                     <th style="text-align: right; color: blue;">VENTA 2015</th>
                                     <th style="text-align: right; color: green;">% DE ALCANCE<br />REAL</th>
                                 </tr>
                                 
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;$porce=0;$porce_real=0;
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
                                if($r->porce<=50){$color='red';}else{$color='black';}
                                $l0=anchor('ventas/s_ventas_comparativas_historicas_det_suc/'.$mes.'/'.$r->suc,$r->suc.'</a>', array('title' => 'Haz Click aqui para Ver detalle!', 'class' => 'encabezado'));
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $l0?></td>
                                <td style="color: maroon;"><?php echo $r->sucx?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->prome,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->a2015,2)?></td>
                                <td style="text-align: right; color: green;"><?php echo '% '.number_format($r->porce,2)?></td>
                                </tr>
                                <?php 
                                $t01=$t01+$r->prome;
                                $t02=$t02+$r->a2015;
                                $t03=$t03+$r->porce;
                                }
                                $porce=($t02/$t01)*100;
                                
                                ?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t01,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t02,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo '% '.number_format($porce,2)?></strong></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>