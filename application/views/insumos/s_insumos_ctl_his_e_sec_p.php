                 <div class="span8">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">


<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr> 
                                     <th>#</th>
                                     <th>Cod</th>
                                     <th>Insumo</th>
                                     <th>Pedido</th>
                                     <th>Surtido</th>
                                     <th>% de Surtido</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='black';$num=0;$tot=0;$totc=0;$dif=0;
                                     foreach ($q->result() as $r) {
                                        $l1=anchor('insumos/s_insumos_ctl_his_f_sec_p_suc/'.$fec1.'/'.$fec2.'/'.$id_comprar.'/'.$r->id_insumos,'Detalle');
                                         $num=$num+1;?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->id_insumos?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->descripcion?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r->canp?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r->cans?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo number_format($r->por_sur,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        </tr>
                                        <?php
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             <td colspan="6" style="text-align: left; color: <?php echo $color ?>">Total de pedidos: <?php echo number_format($num,0)?></td>
                             </tr>
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>