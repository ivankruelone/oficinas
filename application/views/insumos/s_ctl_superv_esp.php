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
      $l0 = anchor('insumos/inserta_insumo_super/'.$suc,'<font size="+2">Agrega nuevo pedido de insumos</font></a>', array('title' => 'Haz Click aqui para agregar pedidos de insumos!'));
    ?>
    <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                                <tr>
                                <th colspan="5"><?php echo $l0?></th>
                                </tr>
                                 <tr> 
                                     <th>Id</th>
                                     <th>Folio</th>
                                     <th>Fecha</th>
                                     <th>Acciones</th>
                                     
                                  </tr>
                             </thead>
                             <tbody>
                                <?php  $color='black';$num=0;$tot=0;$totc=0;$dif=0;
                                
                                foreach ($q->result() as $r2) {                                    
  $l1 = anchor('insumos/pedidos_super_det/'.$r2->suc.'/'.$r2->id,'Detalle</a>', array('title' => 'Haz Click aqui para Ver Detalle!', 'class' => 'encabezado'));
  $l2 = anchor('insumos/pedidos_super_borrar/'.$r2->suc.'/'.$r2->id,'Borrar</a>', array('title' => 'Haz Click aqui para Borrar!', 'class' => 'encabezados'));
                                         $num=$num+1;?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $num?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->id?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r2->fecha?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l1?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $l2?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                        </tbody>
                                <tfoot>
                              </tfoot>
                           </table>                          
                         </div>
                       </div>
                     
                      </div> 