                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

<table class="table table-bordered table-condensed table-striped table-hover" id="tabla1">
                             <thead>
                                 <tr>
                                     <th>Id</th>
                                     <th>Orden</th>
                                     <th>Captura</th>
                                     <th>Comprador</th>
                                     <th>Fecha</th>
                                     <th>Almacen</th>
                                     <th>Prv</th>
                                     <th>Provedor</th>
                                     <th>Importe</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=1;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $l2=anchor('orden/com_orden_imp/'.$r->id_orden,'Imprimir');
                                ?>
                                        <tr>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; "><?php echo $r->folprv?></td>
                                        <td style="text-align: left; "><?php echo $r->capturax?></td>
                                        <td style="text-align: left; "><?php echo $r->comprador?></td>
                                        <td style="text-align: right; "><?php echo $r->fecha_envio?></td>
                                        <td style="text-align: left; "><?php echo $r->almacenx?></td>
                                        <td style="text-align: left; "><?php echo $r->prv?></td>
                                        <td style="text-align: left; "><?php echo $r->prvx?></td>
                                        <td style="text-align: right; "><?php echo number_format($r->imp,2)?></td>
                                        <td><?php echo $l2?></td>
                                        </tr>
                                        <?php 
                                        $num=$num+1;
                                        }?>
                                        
                                
                             </tbody>
                             <tfoot>
                             <tr>
                             </tr>
                             </tfoot>
                         </table>                        

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>