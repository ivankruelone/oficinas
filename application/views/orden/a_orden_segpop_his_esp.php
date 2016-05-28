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
                                     <th></th>
                                     <th>#</th>
                                     <th>Id orden</th>
                                     <th>Orden</th>
                                     <th>Fecha</th>
                                     <th>Prv</th>
                                     <th>Provedor</th>
                                     <th>Recibe</th>
                                     <th>Embarca</th>
                                     <th>Importe</th>
                                     <th>Pedido</th>
                                     <th>Recibido</th>
                                     <th>Nivel de Surtido</th>
                                     <th></th>
                                   </tr>
                             </thead>
                             <tbody>
                                 <?php
                                  $tu1=0;$tu2=0;$tu3=0;$tu4=0;
                                  $u1=0;$u2=0;$u3=0;$u4=0;
                                $num=1;$final=0;$final1=0;
                                foreach ($q->result() as $r) {
                                $l2=anchor('orden/com_orden_imp/'.$r->id_orden.'/'.$r->estatus,'Imprimir');
                                if($r->estatus==0){
                                    $l1='CANCELADA';
                                    $color='red';
                                }else{
                                   $l1=anchor('orden/borrar_orden_segpop_cerrada/'.$r->id_orden,'Borrar');
                                   $color='gray'; 
                                }
                                ?>
                                        <tr>
                                        <td><?php echo $l1?></td>
                                        <td><?php echo $num?></td>
                                        <td style="text-align: right; color: <?php echo $color?>; "><?php echo $r->id_orden?></td>
                                        <td style="text-align: right; color: <?php echo $color?>; "><?php echo $r->folprv?></td>
                                        <td style="text-align: right color: <?php echo $color?>;; "><?php echo $r->fecha_envio?></td>
                                        <td style="text-align: right; color: <?php echo $color?>; "><?php echo $r->prv?></td>
                                        <td style="text-align: left; color: <?php echo $color?>; "><?php echo $r->razo?></td>
                                        <td style="text-align: left; color: <?php echo $color?>; "><?php echo $r->recibex?></td>
                                        <td style="text-align: left; color: <?php echo $color?>; "><?php echo $r->embarcax?></td>
                                        <td style="text-align: right; color: <?php echo $color?>; "><?php echo number_format($r->total,2)?></td>
                                        <td style="text-align: right; color: <?php echo $color?>; "><?php echo number_format($r->pedido,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color?>; "><?php echo number_format($r->aplicado,0)?></td>
                                        <td style="text-align: right; color: <?php echo $color?>; "><?php echo number_format($r->nuvel_surtido,2)?></td>
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