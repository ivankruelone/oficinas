<div class="span12">
     <!-- BEGIN BLANK PAGE PORTLET-->
          <div class="widget green">
               <div class="widget-title">
                    <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                        <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                        </span>
               </div>
          <div class="widget-body">
<?php
	$l = anchor('insumos/factura_inv_nuevo/','Agrega nueva factura</a>', array('title' => 'Haz Click aqui para agregar nueva factura', 'class' => 'encabezado'));                                        
 ?>
 <table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">

                             <thead>
                             <tr>
                             <td colspan="6" style="text-align:center; font: +1;"><?php echo $l?></td>
                             </tr>
                                 <tr> 
                                     <th>Numero de Factura</th>
                                     <th>Proveedor</th>
                                     <th>Fecha</th>
                                     <th></th>
                                     <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                                <?php  $color='blue';$tot=0;$totc=0;
                                     foreach ($q->result() as $r) {
  $l1 = anchor('insumos/factura_inv_det/'.$r->folio,'Detalle</a>', array('title' => 'Haz Click aqui para detallar la factura', 'class' => 'encabezado'));  
  $l2 = anchor('insumos/factura_inv_borrar/'.$r->folio,'Borrar</a>', array('title' => 'Haz Click aqui para borrar la factura', 'class' => 'encabezado'));                                      
                                        ?>
                                        <tr>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->folio?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->razon_social?></td>
                                        <td style="text-align: left; color: <?php echo $color ?>"><?php echo $r->fecha?></td>
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