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
                                     <th></th>
                                     <th></th>
                                     <th>Prv</th>
                                     <th style="text-align: left">Proveedor</th>
                                     <th style="text-align: left">Sub-Total</th>
                                     <th style="text-align: right">Imp.Iva</th>
                                     <th style="text-align: right">Imp.Total</th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $color='gray'; $color1='black'; $color2='blue'; $color3='green';  $aaa=date('Y');
                                $total=0;$iva=0;$sub=0;
                                foreach ($a->result()as $r){
                                $l2 = anchor('fiscal/s_cheque_banco_det_prv/s/'.$r->aaa.'/'.$r->mes.'/'.$r->prv_cxp.'/'.$r->var,$r->prv_cxp);
                                $l1 = anchor('fiscal/plano_submit_det_prv/'.$r->aaa.'/'.$r->mes.'/'.$r->prv_cxp.'/'.$r->var,'Arc.Detalle');
                                $l0 = anchor('fiscal/plano_submit_ctl_prv/'.$r->aaa.'/'.$r->mes.'/'.$r->prv_cxp.'/'.$r->var,'Arc.Control');
                                ?>
                                <tr>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l0?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l1?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $l2?></td>
                                <td style="color:<?php echo $color?>; text-align: left"><?php echo $r->razo?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->sub,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->iva,2)?></td>
                                <td style="color: <?php echo $color?>; text-align: right"><?php echo number_format($r->tot,2)?></td>
                                </tr>
                               <?php 
                               $total=$total+$r->tot;
                               $iva=$iva+$r->iva;
                               $sub=$sub+$r->sub;
                                } ?>
                              </tbody>
                              <tfoot>
                              <tr>
                              <td colspan="4" style="text-align: right;"><strong>TOTAL</strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($sub,2)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($iva,2)?></strong></td>
                              <td style="color: <?php echo $color?>; text-align: right"><strong><?php echo number_format($total,2)?></strong></td>
                              </tr>
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                     </div>