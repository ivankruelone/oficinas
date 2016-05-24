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
                                    <th style="text-align: center">Fecha</th> 
                                     <th style="text-align: right">Deposito Sucursal</th>
                                     <th style="text-align: center">Reembolso</th>
                                     <th style="text-align: center">Deposito Sucursal<br />+<br />Reembolso</th>
                                     <th style="text-align: center">Venta Sucursal</th> 
                                     <th style="text-align: right">Deposito Banco</th>
                                     <th style="text-align: right">Deposito Sucursal<br />+<br />Reembolso<br />-<br />Venta Sucursal</th>
                                    
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $t01=0;$t02=0;$t03=0;$t04=0;$t05=0;$t06=0;       
                                $num=0;$tm=0;$ttm=0;
                                foreach ($q->result() as $r) {
                                $l0=anchor('ventas/s_depositos_dia/'.$r->fecha_vta,$r->fecha_vta.'</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));    
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $l0?></td>
                                <td style="text-align: right;"><?php echo number_format($r->depo_suc,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->reem,2)?></td>
                                <td style="text-align: right;"><?php echo number_format(($r->depo_suc+$r->reem),2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->vta_suc,2)?></td>
                                <td style="text-align: right;"><?php echo number_format($r->depo_banco,2)?></td>
                                <td style="text-align: right;"><?php echo number_format(($r->depo_suc+$r->reem-$r->vta_suc),2)?></td>
                                </tr>
                                <?php 
                                $t01=$t01+$r->depo_suc;
                                $t02=$t02+$r->reem;
                                $t03=$t03+($r->depo_suc+$r->reem);
                                $t04=$t04+$r->depo_banco;
                                $t05=$t05+($r->depo_suc+$r->reem-$r->vta_suc);
                                $t06=$t06+$r->vta_suc;
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                               
                                <td style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t01,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t02,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t03,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t06,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t04,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($t05,2)?></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>