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
                                     <th>Id</th>
                                     <th style="text-align: center;">A&ntilde;o</th>
                                     <th style="text-align: center;">Mes</th>
                                     <th style="text-align: center;">Imp.prv</th>
                                     <th style="text-align: center;">Imp.cxp</th>
                                     <th></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;
                                     foreach ($q->result() as $r2) {
                                      $l1 = anchor('compra/s_pago_mayoristas_prv/'.$r2->aaa.'/'.$r2->mes,'VENCIMIENTO CXP</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                                        
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->aaa?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->mes.' - '.$r2->mesx?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->imp_prv,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->imp_cxp,2)?></td>
                                        <td><?php echo $l1?></td>
                                        
                                        </tr>
                                        <?php $num=$num+1; $tot=$tot+$r2->imp_prv;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot,2)?></strong></td>
                             <td colspan="3"></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla2">

                             <thead>
                                
                                 <tr> 
                                     <th>Id</th>
                                     <th style="text-align: center;">A&ntilde;o</th>
                                     <th style="text-align: center;">Mes</th>
                                     <th style="text-align: center;">Imp.prv</th>
                                     <th style="text-align: center;">Imp.cxp</th>
                                     <th></th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;
                                     foreach ($qq->result() as $rr2) {
                                      $l1 = anchor('compra/s_pago_mayoristas_prv_cal/'.$rr2->aaa.'/'.$rr2->mes,'VENCIMIENTO CALCULADO</a>', array('title' => 'Haz Click aqui para Ver provedores!', 'class' => 'encabezado'));
                                        
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $rr2->aaa?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $rr2->mes.' - '.$rr2->mesx?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($rr2->imp_prv,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($rr2->imp_cxp,2)?></td>
                                        <td><?php echo $l1?></td>
                                        
                                        </tr>
                                        <?php $num=$num+1; $tot=$tot+$rr2->imp_prv;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="4" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot,2)?></strong></td>
                             <td colspan="3"></td>
                             </tr>
                             </tfoot>
                         </table>                        
<!--------------
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>