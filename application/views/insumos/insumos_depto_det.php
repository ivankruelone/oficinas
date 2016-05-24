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
<?php 
$l = anchor('insumos/pedidos_depto_cer/'.$id_cc.'/','Cerrar folio de pedido</a>', array('title' => 'Haz Click aqui para cerrar folio!', 'class' => 'encabezado'));

?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                                  <tr>
                                  <td colspan="8" style="text-align:center; font: +1;"><?php echo $l?></td>
                                  </tr>
                                  <tr> 
                                     <th>Id</th>
                                     <th></th>
                                     <th>Codigo</th>
                                     <th>Descripcion</th>
                                     <th>Presentacion</th>
                                     <th>Pedido</th>
                                     <th>Surtido</th>
                                     <th></th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$num=1;$tot=0;$totc=0; $imp1=0; $imp2=0;
                                     foreach ($q->result() as $r2) {
  $l0 = anchor('insumos/insumos_det_cero/'.$r2->id.'/'.$r2->fol.'/'.$id,'Ceros</a>', array('title' => 'Haz Click aqui para dejar ceros en cantidad surtida!', 'class' => 'encabezado'));
  $l1 = anchor('insumos/insumos_det_cambio/'.$r2->id.'/'.$r2->fol.'/'.$id,'Cambio</a>', array('title' => 'Haz Click aqui para Cambiar cantidad surtida!', 'class' => 'encabezado'));
  if($r2->canp<>$r2->cans){$color='orange';}else{$color='blue';}
                                     ?>
                                        
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l0?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->id_insumos?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->descripcion?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->empaque?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r2->canp?></td>
                                        <td style="text-align: right; color: <?php echo $color ?>"><?php echo $r2->cans?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        </tr>
                                        <?php $num=$num+1;
                                        $imp1=$imp1+($r2->canp*$r2->costo);
                                        $imp2=$imp2+($r2->cans*$r2->costo);
                                        }?>
                                        <tfoot>
                                        <tr>
                                        <td colspan="7"></td>
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