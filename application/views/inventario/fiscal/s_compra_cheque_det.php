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
                                     <th style="text-align: left">Archivo</th>
                                     <th style="text-align: left">Compa&ntilde;ia</th>
                                     <th style="text-align: left">Fec.Inicial</th>
                                     <th style="text-align: left">Fec.Final</th>
                                     <th style="text-align: left">Consecutivo</th>
                                     <th style="text-align: left">Cheque</th> 
                                     <th style="color:gray; text-align: right">Iva</th>
                                     <th style="color:gray; text-align: right">Importe</th>
                                     <th style="text-align: left">Fecha_banco</th>
                                     <th style="color:gray; text-align: right">Imp.Banco</th>
                                     
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $total=0;$tiva=0;$total_con=0;
                                foreach ($a->result()as $r){
                                $l0 = anchor('fiscal/s_compra_cheque_det/'.$r->fec1,$r->fec2);
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->varx?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->ciax?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fec1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fec2?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->cheque?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->cheque_real?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->iva,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->tot,2)?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->fecha_banco?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->imp_cheque,2)?></td>
                                </tr>
                               <?php 
                               $tiva=$tiva+$r->iva;
                               $total=$total+$r->tot;
                               $total_con=$total_con+$r->imp_cheque;
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="2" style="text-align: right;">TOTAL</td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($tiva,2)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($total,2)?></td>
                              <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($total_con,2)?></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>