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
  $l = anchor('insumos/folio_dev_nuevo/','Insertar Folio</a>', array('title' => 'Haz Click aqui para insertar!', 'class' => 'encabezado'));                                        
  ?>
<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                 <tr>
                                 <td colspan="6" style="text-align:center; font: +1;"><?php echo $l?></td>
                                 </tr>
                                 <tr> 
                                     <th>folio</th>
                                     <th>Nid Sucursal</th>
                                     <th>Sucursal</th>
                                     <th>fecha</th>
                                     <th>acciones</th>                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$tot=0;$totc=0;
                                     foreach ($q->result() as $r2) {
  $l1 = anchor('insumos/devolucion_insumos/'.$r2->folio.'/'.$r2->suc,'Detalle</a>', array('title' => 'Haz Click aqui para detalle', 'class' => 'encabezado'));
  $l2 = anchor('insumos/dev_ins_borrar/'.$r2->folio,'Borrar</a>', array('title' => 'Haz Click aqui para eliminar folio', 'class' => 'encabezado'));                                        
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->folio?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->suc?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->sucx?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha_cap?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l2?></td>
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