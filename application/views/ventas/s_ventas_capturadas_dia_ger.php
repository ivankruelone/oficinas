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
                                     <th style="text-align: center">Imagen</th>
                                     <th style="text-align: center">Nid</th>
                                     <th style="text-align: center">Sucursal</th>
                                     <th style="text-align: right; color: blue;">Inicio de Turno</th> 
                                     <th style="text-align: right; color: blue;"># Tic</th>
                                     <th style="text-align: right; color: blue;">Vta.Con</th>
                                     <th style="text-align: right; color: blue;">Vta.Cre</th>
                                     <th style="text-align: right; color: blue;">Total Vta</th>
                                     <th style="text-align: right; color: blue;">Tic.Promedio</th>
                                     <th style="text-align: right; color: blue;">Fin de Turno</th>
                                     <th style="text-align: right; color: blue;">Cortes Contado</th>
                                     <th style="text-align: right; color: blue;">Cortes Credito</th>
                                     <th style="text-align: right; color: blue;">Cortes Vta.Total</th>
                                 </tr>
                                 
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;$t07=0;
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
                                if(($r->con_corte+$r->cre_corte)<>($r->con+$r->cre))
                                {$color='red';}else{$color='black';}
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r->tipo2?></td>
                                <td style="color: maroon;"><?php echo $r->suc?></td>
                                <td style="color: maroon;"><?php echo $r->sucx?></td>
                                <td style="text-align: right; color: maroon;"><?php echo $r->inicio?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->tic,0)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->con,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format($r->cre,2)?></td>
                                <td style="text-align: right; color: blue;"><?php echo number_format(($r->con+$r->cre),2)?></td>
                                <td style="text-align: right; color: blueviolet;"><?php echo number_format($r->prome,2)?></td>
                                <td style="text-align: right; color: maroon;"><?php echo $r->fin?></td>
                                <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->con_corte,2)?></td>
                                <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format($r->cre_corte,2)?></td>
                                <td style="text-align: right; color: <?php echo $color?>;"><?php echo number_format(($r->con_corte+$r->cre_corte),2)?></td>
                                </tr>
                                <?php 
                                $t01=$t01+$r->tic;
                                $t02=$t02+$r->con;
                                $t03=$t03+$r->cre;
                                $t04=$t04+$r->cre+$r->con;
                                $t05=$t05+$r->con_corte;
                                $t06=$t06+$r->cre_corte;
                                $t07=$t07+$r->con_corte+$r->cre_corte;
                                $tm=0;
                                
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t01,0)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t02,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t03,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t04,2)?></strong></td>
                                <td></td>
                                <td></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t05,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t06,2)?></strong></td>
                                <td style="color: maroon;text-align: right; color: blue;"><strong><?php echo number_format($t07,2)?></strong></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>