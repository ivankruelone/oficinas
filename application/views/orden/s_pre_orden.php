                 <div class="span10">
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
                                 <th></th>
                                 <th></th>
                                 <th style="text-align: center">Fecha</th>
                                 <th style="text-align: right">Pre-Orden</th> 
                                 <th style="text-align: right">Compra</th>
                                 <th style="text-align: right">Subtotal</th>
                                 <th></th>
                                 </tr>
                             </thead>
                             <tbody>
                             
                                 <?php
                                $num=1;$compra=0;$importe=0;
                                foreach ($q->result() as $r) {
                                $l1 = anchor('orden/s_pre_orden_modi/'.$r->id_pre_orden,$r->var.'</a>', array('title' => 'Haz Click aqui para cambiar detalle!', 'class' => 'encabezado'));
                                $l2 = anchor('orden/s_pre_orden_borrar/'.$r->id_pre_orden,'Borrar</a>', array('title' => 'Haz Click aqui para borrar la pre-orden!', 'class' => 'encabezado'));
                                $l3 = anchor('orden/s_pre_orden_cerrar/'.$r->id_pre_orden,'Cerrar</a>', array('title' => 'Haz Click aqui para Cerrar la pre-orden!', 'class' => 'encabezado'));
                               ?>
                                
                                <tr>
                                <td style="color: maroon;"><?php echo $l1?></td>
                                <td style="color: maroon;"><?php echo $l3?></td>
                                <td style="color: maroon;"><?php echo $r->fecha_ger?></td>
                                <td style="color: maroon;text-align: right;"><?php echo $r->id_pre_orden?></td>
                                <td style="color: maroon; text-align: right;"><?php echo  number_format($r->compra,0)?></td>
                                <td style="color: maroon; text-align: right;"><?php echo  number_format($r->importe,2)?></td>
                                <td style="color: maroon;"><?php echo $l2?></td>
                                </tr>
                                <?php 
                                $num=$num+1;
                                $compra=$compra+$r->compra;
                                $importe=$importe+$r->importe;
                                }?>
                                
                             </tbody>
                             <tfoot>
                            <tr>
                                <td colspan="4" style="color: maroon;text-align: right;">TOTAL GENERAL </td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($compra,2)?></td>
                                <td style="color: maroon;text-align: right;"><?php echo number_format($importe,2)?></td>
                                <td></td>
                                </tr>
                                
                                
                             </tfoot>
                         </table>   
                            
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>