                 <div class="span12">
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
$l = anchor('insumos/imp_inv_ins/','imprimir inventario</a>', array('title' => 'Haz Click aqui para imprimir inventario!', 'class' => 'encabezado'));
?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                
                          <tr>
                          <td colspan="6" style="text-align:center; font: +1;"><?php echo $l?></td>
                          </tr>
                                  <tr> 
                                     <th>Id</th>
                                     <th>Descripcion</th>
                                     <th>Presentacion</th>
                                     <th>Existencia</th>
                                     <th></th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';
                                     foreach ($q->result() as $r) {
                                  
  $l0 = anchor('insumos/inventario_insumos_depto_det/'.$r->id_insumos,'editar existencia</a>', array('title' => 'Haz Click aqui para actualizar existencia!', 'class' => 'encabezado'));
  if($r->existencia == 0){$color='red';}else{$color='blue';}
                                 ?>
                                        
                                 <tr>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->id_insumos?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->descripcion?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->empaque?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->existencia?></td>
                                 <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l0?></td>
                                 </tr>
                                   <?php 
                                   }?>                                
                             </tbody>
                             <tfoot>
                             
                             </tfoot>
                         </table>                        

<!---->
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->    
                 </div>