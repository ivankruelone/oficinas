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
                                     <th style="text-align: left">Fecha Banco</th>
                                     <th style="text-align: left">Archivo</th>
                                     <th style="text-align: left">Compa&ntilde;ia</th>
                                     <th style="text-align: left">Observacion</th>
                                     <th style="text-align: right">Prv</th>
                                     <th style="text-align: right">Proveedor</th>
                                     <th style="text-align: right">Cheque</th>
                                     <th style="text-align: right">Imp.banco</th>
                                     <th style="text-align: right">Imp.Cxp</th>
                                     <th style="text-align: right">Imp.iva.Cxp</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $total=0;$tiva=0;$total_con=0;
                                foreach ($a->result()as $r){
                                if($r->monto==$r->imp_cxp){$color='gray';}else{$color='red';}
                                $l0 = anchor('fiscal/s_cheque_banco_det/'.$r->aaa.'/'.$r->mes,$r->mes);
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->varx?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->ciax?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->observa?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->prv_cxp?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->razo?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->cheque?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->monto,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->imp_cxp,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->iva_cxp,2)?></td>
                                </tr>
                               <?php 
                               $total=$total+$r->monto;
                               $total_con=$total_con+$r->imp_cxp;
                               $tiva=$tiva+$r->iva_cxp;
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="7" style="text-align: right;">TOTAL</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($total,2)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($total_con,2)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tiva,2)?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>