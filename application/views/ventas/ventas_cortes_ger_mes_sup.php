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
                                 <th style="text-align: center">#</th>
                                 <th style="text-align: center">Nid</th>
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
                                $num=0;$tcredito=0;$tcontado=0;$trecarga=0;
                                foreach ($a as $r0) {
                                foreach ($r0['m'] as $r) {
                                foreach ($r['segundo']as $r1) {
                                if(($r0['f1']==$r0['mes'])and ($r0['f2']==$r1['superv'])){
                                foreach ($r1['tercero']as $r2) {
                                foreach ($r2['cuarto']as $r3) {
                                
                                $num=$num+1;
                                $tcredito=$tcredito+$r3['credito'];
                                $tcontado=$tcontado+$r3['contado'];
                                $trecarga=$trecarga+$r3['recarga'];
                               
                                ?>
                                
                                <tr>
                                <td style="text-align: right;"><?php echo $num?></td>
                               <td style="text-align: right;"><?php echo $r3['suc']?></td>
                                <td><?php echo $r3['sucx']?></td>
                                <td style="text-align: right;"><?php echo number_format($r3['recarga'],2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r3['credito'],2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r3['contado'],2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r3['recarga']+$r3['credito']+$r3['contado'],2)?></td>
                                </tr>
                                <?php $credito=0;$contado=0;$recarga=0;
                                }}}}}} ?>
                               
                             </tbody>
                             <tfoot>
                            <tr>
                            <td></td>
                            <td></td>
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