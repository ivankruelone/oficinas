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
                                  <th style="text-align: center">Supervisor</th> 
                                     <th style="text-align: right">T.Aire</th>
                                     <th style="text-align: right">Credito</th>
                                     <th style="text-align: right">Contado</th>
                                     <th style="text-align: right">Total</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $credito=0;$contado=0;$recarga=0;      
                                $num=0;$tcredito=0;$tcontado=0;$trecarga=0;
                                foreach ($a as $r0) {
                                
                                foreach ($r0['m'] as $r) {
                                if(($r0['f1']==$r0['mes'])and ($r0['f2']==$r['regional'])){
                                foreach ($r['segundo']as $r1) {
                                    ?>
                                
                                <?php
                                foreach ($r1['tercero']as $r2) {
                                foreach ($r2['cuarto']as $r3) {
                                
                                $num=$num+1;
                                $tcredito=$tcredito+$r3['credito'];
                                $tcontado=$tcontado+$r3['contado'];
                                $trecarga=$trecarga+$r3['recarga'];
                                $credito=$credito+$r3['credito'];
                                $contado=$contado+$r3['contado'];
                                $recarga=$recarga+$r3['recarga'];
                                
                                }}$l0 = anchor('ventas/ventas_cortes_ger_mes_sup/'.$r0['mes'].'/'.$r1['superv'],str_pad($r0['mes'],2,'0',STR_PAD_LEFT).' '.$r1['supervx'].'</a>', array('title' => 'Haz Click aqui para ver sucursales!', 'class' => 'encabezado'));
                                ?>
                                
                                <tr>
                                <td style="color: orange;"><?php echo $l0?></td>
                                <td style="text-align: right;"><?php echo number_format($recarga,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($credito,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($contado,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($recarga+$credito+$contado,2)?></td>
                                </tr>
                                <?php $credito=0;$contado=0;$recarga=0;
                                }}}} ?>
                               
                             </tbody>
                             <tfoot>
                            <tr>
                                <td style="color: maroon;text-align: right;">TOTAL </td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($trecarga,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($tcredito,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($tcontado,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($trecarga+$tcredito+$tcontado,2)?></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>