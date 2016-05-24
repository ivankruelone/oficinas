                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">Sec</th> 
                                 <th style="text-align: left">Sustancia Activa</th>
                                 <th style="text-align: left">Descripcion</th>
                                 <th>Solicitada</th>
                                 <th>Factura</th>
                                 <th>Lote</th>
                                 <th>Caducidad</th>
                                 <th>Llego</th>
                                 
                                 
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $num=0;$compra=0;$importe=0;
                                if($q<>null){
                                foreach ($q as $r) {
                               $num=$num+1;
                               ?>
                                <td style="color: maroon;text-align: left;"><?php echo $r['sec']?></td>
                                <td style="color: maroon;text-align: left;"><?php echo $r['susa1']?></td>
                                <td style="color: maroon;text-align: left;"><?php echo $r['susa2']?></td>
                                <td style="color: maroon; text-align: right;"><?php echo  number_format($r['cans'],0)?></td>
                                
                                
                                
                                
                                
                               
                                <tr>
                                <?php 
                                foreach ($r['segundo'] as $r1) {
                                echo $r1['lote'];
                                ?>
                                <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="color: blue;"><?php echo $r1['fac'].'<br />'.$r1['fechai']?></td>
                                <td style="color: blue;"><?php echo $r1['lote']?></td>
                                <td style="color: blue;"><?php echo $r1['cadu']?></td>
                                <td style="color: green; text-align: right"><?php echo number_format($r1['can'],0)?></td>
                                </tr>
                                
                                <?php 
                                $compra=$compra+$r1['can'];
                                }
                                
                               ?>
                                
                                </tr>
                                <tr>
                                <td colspan="4" style="color: red;">
                                <?php echo 'SOLICITA: '.number_format($r['cans'],0).' LLEGARON: '.number_format($compra,0).' Y FALTAN: '.number_format(($r['cans']-$compra),0)?></td>
                                </tr>
                                <?php
                                $compra=0;
                                }
                                
                                
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td colspan="10" style="color: maroon;text-align: left;">TOTAL PRODUCTOS <?php echo $num?> </td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                                      
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">


 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">Orden</th>
                                 <th style="text-align: left">Prv</th>
                                 <th style="text-align: left">Proveedor</th>
                                 <th style="text-align: left">Sec</th>
                                 <th style="text-align: left">Sustancia Activa</th>
                                 <th style="text-align: left">Descripcion</th>
                                 <th style="text-align: right">Cantidad</th>
                                 <th style="text-align: right">Costo</th>
                                 <th style="text-align: right">Importe</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;$timp=0;$tcan=0;
                                foreach ($q1->result()as $rr) {
                                $num=$num+1;
                                
                                ?> 
                                 <tr>
                                   <td style="text-align: left;"><?php echo $rr->folprv?></td>                                  
                                   <td style="text-align: left;"><?php echo $rr->prv?></td>
                                   <td style="text-align: left;"><?php echo $rr->corto?></td>
                                   <td style="text-align: left;"><?php echo $rr->sec?></td>
                                   <td style="text-align: left;"><?php echo $rr->susa1?></td>
                                   <td style="text-align: left;"><?php echo $rr->susa2?></td>
                                   <td style="text-align: right;"><?php echo number_format(($rr->cans),0)?></td>
                                   <td style="text-align: right;"><?php echo number_format(($rr->costo),2)?></td>
                                   <td style="text-align: right;"><?php echo number_format(($rr->costo*$rr->cans),2)?></td>
                                   </tr>
                               <?php 
                               $timp=$timp+($rr->cans);$tcan=$tcan+($rr->costo*$rr->cans);
                               } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="6">TOTAL</td>
                              <td style="text-align: right;"><?php echo number_format($tcan,0)?></td>
                              <td></td>
                              <td style="text-align: right;"><?php echo number_format($timp,2)?></td>
                              </tr>
                              </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 
                     
                     
                 </div>