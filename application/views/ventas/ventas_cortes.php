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
                                     <th style="text-align: center">Mes</th> 
                                     <th style="text-align: right">T.Aire</th>
                                     <th style="text-align: right">Credito</th>
                                     <th style="text-align: right">Contado</th>
                                     <th style="text-align: right">Total</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $credito=0;$contado=0;$recarga=0;
                                $ttcontado=0;$ttcredito=0;$ttrecarga=0;      
                                $num=0;$tcredito=0;$tcontado=0;$trecarga=0;
                                foreach ($a as $r0) {?>
                                <tr>
                                <td></td>
                                <td></td>
                                <td style="color: maroon; text-align: center"><?php echo $r0['mesx']?></td>
                                <td></td>
                                <td></td>
                                </tr>
                               
                                <?php
                               foreach ($r0['m'] as $r) {
                                $l0 = anchor('ventas/ventas_cortes_suc/'.$r0['mes'].'/'.$r['tipo2'],str_pad($r0['mes'],2,'0',STR_PAD_LEFT).' '.$r['imagen'].'</a>', array('title' => 'Haz Click aqui para ver sucursales!', 'class' => 'encabezado'));
                                foreach ($r['segundo']as $r1) { 
                                foreach ($r1['tercero']as $r2) {
                                foreach ($r2['cuarto']as $r3) {    
                                $credito=$credito+$r3['credito'];
                                $contado=$contado+$r3['contado'];
                                $recarga=$recarga+$r3['recarga'];
                                $tcredito=$tcredito+$r3['credito'];
                                $tcontado=$tcontado+$r3['contado'];
                                $trecarga=$trecarga+$r3['recarga'];
                                $ttcredito=$ttcredito+$r3['credito'];
                                $ttcontado=$tcontado+$r3['contado'];
                                $ttrecarga=$ttrecarga+$r3['recarga'];
                                }}}?> 
                                    <tr> 
                                    <td><?php echo $l0?></td>
                                    <td style="text-align: right;"><?php echo number_format($recarga,2)?></td>
                                    <td style="text-align: right;"><?php echo number_format($credito,2)?></td>
                                    <td style="text-align: right;"><?php echo number_format($contado,2)?></td>
                                    <td style="text-align: right;"><?php echo number_format($contado+$credito+$recarga,2)?></td>
                                 </tr>   
                                 <?php
                                 $contado=0;$credito=0;$recarga=0;} ?>
                                 <tr>
                                    <td style="color: maroon;text-align: right;"><?php echo 'TOTAL '.$r0['mesx']?></td>                                  
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($trecarga,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($tcredito,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($tcontado,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($tcontado+$tcredito+$trecarga,2)?></td>
                                  </tr>   
                                 <?php $tcontado=0;$tcredito=0;$trecarga=0; } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                                    <td style="color: maroon;text-align: right;">TOTAL ANUAL</td>                                  
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($ttrecarga,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($ttcredito,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($ttcontado,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($ttcontado+$ttcredito+$ttrecarga,2)?></td>
                                  </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>