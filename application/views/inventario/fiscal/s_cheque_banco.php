                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                    <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    
                                 <tr>
                                     <th></th>
                                     <th></th>   
                                     <th style="text-align: left">A&ntilde;o</th>
                                     <th style="text-align: left">Mes</th>
                                     <th style="text-align: right">Imp.Banco</th>
                                     <th style="text-align: right">Imp.conciliado</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $total=0;$tiva=0;$total_con=0;
                                foreach ($a->result()as $r){
                                $l1 = anchor('fiscal/s_cheque_banco_cia/'.$r->aaa.'/'.$r->mes,'Compa&ntilde;ia');
                                $l2 = anchor('fiscal/s_cheque_banco_prv/'.$r->aaa.'/'.$r->mes,'Proveedor');
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l2?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->aaa?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->mes?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->monto,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->imp_cxp,2)?></td>
                                </tr>
                               <?php 
                               $total=$total+$r->monto;
                               $total_con=$total_con+$r->imp_cxp;
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="text-align: right;"><strong>TOTAL</strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($total,2)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($total_con,2)?></strong></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                    <div class="widget gray">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo3?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         <?php $l0 = anchor('fiscal/s_cheque_banco_det_partida','Detalle');?>
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                 <th colspan="4"style="text-align: center"><?php echo $l0?></th>
                                 </tr>                                       
                                 <tr>
                                     <th style="text-align: left">Consecutivo</th>
                                     <th style="text-align: right">Imp.iva</th>
                                     <th style="text-align: right">Imp.Total</th>
                                     <th style="text-align: right">Encontrado</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $total=0;$tiva=0;$total_con=0;
                                foreach ($c->result()as $r){
                                
                                
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->cheque?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->iva,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->tot,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->estado_cuenta,2)?></td>
                                </tr>
                               <?php 
                               $tiva=$tiva+$r->iva;
                               $total_con=$total_con+$r->tot;
                               $total=$total+$r->estado_cuenta;
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="1" style="text-align: right;"><strong>TOTAL</strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($tiva,2)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($total_con,2)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($total,2)?></strong></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     <!-- BEGIN BLANK PAGE PORTLET-->
                    <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                    
                                 <tr>
                                     <th style="text-align: left">A&ntilde;o</th>
                                     <th style="text-align: left">Mes</th>
                                     <th style="text-align: right">Imp.Banco</th>
                                     <th style="text-align: right">Imp.conciliado</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $total=0;$tiva=0;$total_con=0;
                                foreach ($b->result()as $r){
                                $l0 = anchor('fiscal/s_cheque_banco_det/n/'.$r->aaa.'/'.$r->mes,$r->mes);
                                
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->aaa?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->monto,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->imp_cxp,2)?></td>
                                </tr>
                               <?php 
                               $total=$total+$r->monto;
                               $total_con=$total_con+$r->imp_cxp;
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="text-align: right;"><strong>TOTAL</strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($total,2)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($total_con,2)?></strong></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>