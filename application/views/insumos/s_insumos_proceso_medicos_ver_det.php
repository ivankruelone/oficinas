                 <div class="span10">
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
                                     <th>Nid</th>
                                     <th>Sucursal</th>
                                     <th></th>
                                     <th>Insumos</th>
                                     <th>Movimiento</th>
                                     <th>Solicita</th>
                                     <th>Existencia</th>
                                     <th>Pedido</th>
                                     
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$totc=0; $imp1=0; $imp2=0;
                                     foreach ($q->result() as $r2) {
                                     ?>
                                 <tr>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->suc?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->nombre?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->id_insumos?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->descripcion?></td>
                                 <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r2->mov?></td>
                                 <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r2->solicita?></td>
                                 <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r2->exis?></td>
                                 <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r2->pedido?></td>
                                 </tr>
                                        <?php $num=$num+1;
                                        $imp1=$imp1+($r2->pedido);
                                        
                                        }?>
                                        <tfoot>
                                        <tr>
                                        <td colspan="9" style="text-align: right;"><?php echo $imp1 ?></td>
                                        </tr>
                                        </tfoot>
                                
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
                         </table>                        

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>