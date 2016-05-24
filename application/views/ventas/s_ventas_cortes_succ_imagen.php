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
                                 <th style="text-align: center">Nid</th>
                                    <th style="text-align: center">Sucursal</th> 
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
                                foreach ($q->result() as $r) { 
                                
                               $l1 = anchor('ventas/s_ventas_cortes_succ_dia/'.$r->aaa.'/'.$r->mes.'/'.$r->suc,$r->suc);
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $l1?></td>
                                <td style="color: maroon;"><?php echo $r->sucx?></td>
                                <td style="text-align: right;"><?php echo number_format($r->recarga,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->credito,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->contado,2)?></td>
                                <td style="text-align: right;"><?php echo number_format(($r->contado+$r->credito+$r->recarga),2)?></td>
                                </tr>
                                <?php 
                                $ttrecarga=$ttrecarga+$r->recarga;
                                $ttcredito=$ttcredito+$r->credito;
                                $ttcontado=$ttcontado+$r->contado;
                                }?>
                                
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