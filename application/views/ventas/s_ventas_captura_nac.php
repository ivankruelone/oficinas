                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit0?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Regional</th>
                                     <td>Supervisor</td>
                                     <th>Imagen</th>
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th>Observacion</th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tcan=0;$timp=0;$timporte=0;
                                $num=0; $color='black';
                                foreach ($q->result() as $r) {
                                $num=$num+1;
                                
                                
                                ?> 
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->regionalx?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->supervisorx?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->tipo2?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->nombre?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->obser?></td>
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
                                 
                             </thead>
                             <tbody>
                             
                                 <?php
                                $tic=0;$contado=0;$vta_total=0;$credito=0;$servicio=0;
                                $ttic=0;$tcontado=0;$tvta_total=0;$tcredito=0;$tservicio=0;
                                $num=0;
                                foreach ($a as $r0) {?>
                                <tr>
                                
                                <td colspan="6" style="color: black; text-align: center; font:+5;"><strong><?php echo 'CAPTURA DE VENTAS DIARIA '.$r0['fecha_vta']?></strong></td>
                                <tr>
                                     <th style="color: blue; text-align: center"></th> 
                                     <th style="color: blue; text-align: right">Ticket</th>
                                     <th style="color: blue; text-align: right">Vta Contado</th>
                                     <th style="color: blue; text-align: right">Vta Credito</th>
                                     <th style="color: blue; text-align: right">Vta Servicio</th>
                                     <th style="color: blue; text-align: right">Vta Total</th>
                                     <th style="color: blue; text-align: right">Prom.por Ticket</th>
                                 </tr>
                                </tr>
                                
                               
                                 <?php foreach ($r0['d'] as $r) { ?>
                                <tr>
                                
                                <td style="color: blue; text-align: left"><?php echo $r['imagen']?></td>
                                <td style="color: gray;text-align: right;"><?php echo number_format($r['tic'],0)?></td>
                                <td style="color: gray;text-align: right;"><?php echo number_format($r['vta_contado'],2)?></td>
                                <td style="color: gray;text-align: right;"><?php echo number_format($r['vta_credito'],2)?></td>
                                <td style="color: gray;text-align: right;"><?php echo number_format($r['vta_servicio'],2)?></td>
                                <td style="color: gray;text-align: right;"><?php echo number_format($r['vta_total'],2)?></td>
                                <td style="color: gray;text-align: right;"><?php echo number_format($r['prome'],4)?></td>
                                </tr>
                                   
                                 <?php 
                                 $tic=$tic+$r['tic']; 
                                 $contado=$contado+$r['vta_contado'];
                                 $credito=$credito+$r['vta_credito'];
                                 $vta_total=$vta_total+$r['vta_total'];
                                 $servicio=$servicio+$r['vta_servicio'];
                                 $ttic=$ttic+$r['tic']; 
                                 $tcontado=$tcontado+$r['vta_contado'];
                                 $tcredito=$tcredito+$r['vta_credito'];
                                 $tvta_total=$tvta_total+$r['vta_total'];
                                 $tservicio=$tservicio+$r['vta_servicio'];
                                 }
                                 
                                 ?>
                               
                                 <tr>
                                    <td style="color: black; text-align: left"><strong><?php echo $r0['nom_dia'].' TOTAL'?></strong></td>
                                    <td style="color: black;text-align: right;"><strong><?php echo number_format($tic,0)?></strong></td>                                  
                                    <td style="color: black;text-align: right;"><strong><?php echo number_format($contado,2)?></strong></td>
                                    <td style="color: black;text-align: right;"><strong><?php echo number_format($credito,2)?></strong></td>
                                    <td style="color: black;text-align: right;"><strong><?php echo number_format($servicio,2)?></strong></td>
                                    <td style="color: black;text-align: right;"><strong><?php echo number_format($vta_total,2)?></strong></td>
                                    <td></td>
                                  </tr>
                                 <?php $tic=0;$contado=0;$vta_total=0;$credito=0;$servicio=0;  }?>
                              </tbody>
                              <tfoot>
                              <tr>
                                    <td></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($ttic,0)?></td>                                  
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($tcontado,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($tcredito,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($tservicio,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($tvta_total,2)?></td>
                                    <td></td>
                                  </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     
                 </div>