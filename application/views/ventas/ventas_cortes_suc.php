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
                                     <th style="text-align: center">Sucursal</th>
                                     <th style="text-align: center">Num.Dias</th> 
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
                                foreach ($r1['tercero']as $r2) {
                                foreach ($r2['cuarto']as $r3) {
                                if(($r0['f2']==$r['tipo2']) and ($r0['f1']==$r0['mes'])){
                                $num=$num+1;
                                ?>
                                <tr>
                                <td style="color: orange;"><?php echo $num?></td>
                                <td style="text-align: right;"><?php echo $r3['suc']?></td>
                                <td><?php echo $r3['sucx']?></td>
                                <td style="text-align: right;"><?php echo $r3['num_dias']?></td>
                                <td style="text-align: right;"><?php echo number_format($r3['recarga'],2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r3['credito'],2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r3['contado'],2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r3['recarga']+$r3['credito']+$r3['contado'],2)?></td>
                                </tr>
                                <?php
                                    
                                $tcredito=$tcredito+$r3['credito'];
                                $tcontado=$tcontado+$r3['contado'];
                                $trecarga=$trecarga+$r3['recarga'];
                                
                                
                                }}}}}} ?>
                               
                             </tbody>
                             <tfoot>
                             <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>                                  
                                    <td style="text-align: right;"><?php echo number_format($trecarga,2)?></td>
                                    <td style="text-align: right;"><?php echo number_format($tcredito,2)?></td>
                                    <td style="text-align: right;"><?php echo number_format($tcontado,2)?></td>
                                    <td style="text-align: right;"><?php echo number_format($tcontado+$tcredito+$trecarga,2)?></td>
                                  </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>