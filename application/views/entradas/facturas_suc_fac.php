                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th style="text-align: left">#</th>
                                 <th style="text-align: left">Prv</th>
                                 <th style="text-align: right">Fecha Factura</th>
                                 <th style="text-align: right">Factura</th>
                                 <th style="text-align: right">Imp.Almacen</th>
                                 <th style="text-align: right">Fecha sucursal</th>
                                 <th style="text-align: right">Imp.Sucursal</th>
                                 <th style="text-align: right">Diferencia</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                 $num=0;
                                $imp_suc=0;$imp_prv=0;
                                $timp_suc=0;$timp_prv=0;
                                $ttimp_suc=0;$ttimp_prv=0;
                                foreach($a->result() as $r){
                                    
                                $ttimp_suc=$ttimp_suc+$r->importe_suc;
                                $ttimp_prv=$ttimp_prv+$r->importe_prv;
                                if(($r->importe_suc-$r->importe_prv)<0){$color='red';}else{$color='gray';}
                                
                                $num=$num+1;
                                ?> 
                                    <tr>
                                    <td><?php echo $num?></td>
                                    <td style="text-align: left;"><?php echo $r->prv.' '.$r->corto?></td>
                                    <td style="text-align: right;"><?php echo $r->fecha_prv?></td> 
                                    <td style="text-align: right;"><?php echo $r->factura?></td>
                                    <td style="text-align: right;"><?php echo number_format($r->importe_prv,2)?></td>
                                    <td style="text-align: right;"><?php echo $r->fecha_suc?></td>
                                    <td style="text-align: right;"><?php echo number_format($r->importe_suc,2)?></td>
                                    <td style="text-align: right;color:<?php echo $color?>;"><?php echo number_format($r->importe_suc-$r->importe_prv,2)?></td>
                                 </tr>   
                                 <?php
                                 $imp_suc=0;$imp_prv=0;
                                }?>
                              </tbody>
                              <tfoot>
                              <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="color: maroon;text-align: right;">TOTAL</td>                                  
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($ttimp_prv,2)?></td>
                                    <td></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($ttimp_suc,2)?></td>
                                    <td style="color: maroon;text-align: right;"><?php echo number_format($ttimp_suc-$ttimp_prv,2)?></td>
                                  </tr>
                              </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>