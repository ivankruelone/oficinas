                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
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
                                     <th>#</th>
                                     <th>Id</th>
                                     <th>Articulo</th>
                                     <th>Piezas Pedidos</th>
                                     <th>Piezas Surtidas</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$totc=0;$dif=0;
                                     foreach ($q1->result() as $r1) {
  
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->id_insumos?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r1->descripcion?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->can_ped,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r1->can_sur,0)?></td>
                                        </tr>
                                        <?php $num=$num+1;
                                        $tot=$tot+$r1->can_ped;
                                        $totc=$totc+$r1->can_sur;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="3"></td>
                             <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($tot,0)?></td>
                             <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($totc,0)?></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>