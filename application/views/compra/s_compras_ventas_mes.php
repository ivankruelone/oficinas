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

<!---->
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                                 <tr> 
                                     <th style="text-align: center;">#</th>
                                     <th style="text-align: center;">Fecha</th>
                                     <th style="text-align: center;">Compras</th>
                                     <th style="text-align: center;">Vta.Contado</th>
                                     <th style="text-align: center;">Vta_Credito</th>
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$tot1=0;$tot2=0;
                                     foreach ($q->result() as $r2) {
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fechacorte?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->compras,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->contado,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r2->credito,2)?></td>
                                        </tr>
                                        <?php $num=$num+1; 
                                        $tot=$tot+$r2->compras;
                                        $tot1=$tot1+$r2->contado;
                                        $tot2=$tot2+$r2->credito;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="2"></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot1,2)?></strong></td>
                             <td colspan="1" style="text-align: right; color: <?php echo $color ?>"><strong><?php echo number_format($tot2,2)?></strong></td>
                             </tr>
                             </tfoot>
                         </table>   
<!---->
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>