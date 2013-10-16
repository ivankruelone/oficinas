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
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: center">sucursal</th>
                                    <th style="text-align: center">sucursal</th> 
                                     <th style="text-align: right">T.Aire</th>
                                     <th style="text-align: right">Credito</th>
                                     <th style="text-align: right">Contado</th>
                                     <th style="text-align: right">Total</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $credito=0;$contado=0;$recarga=0;
                                $ttcredito=0;$ttcontado=0;$ttrecarga=0;        
                                $num=0;$tcredito=0;$tcontado=0;$trecarga=0;
                                foreach ($a as $r0) {?>
                                <tr>
                                <td></td>
                                <td></td>
                                <td style="color: maroon;"><?php echo $r0['mesx']?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                </tr>
                                <?php
                                
                                    
                                foreach ($r0['m'] as $r) {
                               
                                
                                $num=$num+1;
                                $ttcredito=$ttcredito+$r['credito'];
                                $ttcontado=$ttcontado+$r['contado'];
                                $ttrecarga=$ttrecarga+$r['recarga'];
                                $tcredito=$tcredito+$r['credito'];
                                $tcontado=$tcontado+$r['contado'];
                                $trecarga=$trecarga+$r['recarga'];
                                $credito=$credito+$r['credito'];
                                $contado=$contado+$r['contado'];
                                $recarga=$recarga+$r['recarga'];
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $r['suc']?></td>
                                <td style="color: maroon;"><?php echo str_pad($r0['mes'],2,'0',STR_PAD_LEFT).' '.$r['sucx']?></td>
                                <td style="text-align: right;"><?php echo number_format($recarga,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($credito,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($contado,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($recarga+$credito+$contado,2)?></td>
                                </tr>
                                <?php $credito=0;$contado=0;$recarga=0;
                                }?>
                                <tr>
                                <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL <?php echo $r0['mesx'] ?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($trecarga,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($tcredito,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($tcontado,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($trecarga+$tcredito+$tcontado,2)?></td>
                                </tr>
                                <?php
                                 $tcredito=0;$tcontado=0;$trecarga=0;
                                } ?>
                               
                             </tbody>
                             <tfoot>
                            <tr>
                                <td></td>
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($ttrecarga,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($ttcredito,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($ttcontado,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($ttrecarga+$ttcredito+$ttcontado,2)?></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>