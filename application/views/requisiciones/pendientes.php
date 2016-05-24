                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> <?php echo $tit; ?> </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Requisicion</th>
                                        <th>Fecha</th>
                                        <th>Estatus</th>
                                        <th>Suc/Depto.</th>
                                        <th>Origen</th>
                                        <th>Aprobar</th>
                                        <th>Previo</th>
                                        <th>Rechazar</th>
                                    </tr>
                                </thead>
                                <tbody>
            <?php
            	foreach($requisicion->result() as $req){
            	   
                   if($req->estatus == 0){
                    $link1 = anchor('requisiciones/detalle_requisicion/'.$req->requisicion, 'Editar');
                    $link2 = anchor('checador/previo_requisicion/'.$req->requisicion, 'Previo');
                    $link3 = anchor('checador/cerrar_requisicion/'.$req->requisicion, 'Cerrar', array('class' => 'cerrar_requisicion'));
                   }elseif($req->estatus == 1){
                    $link1 = anchor('requisiciones/aprobar_requisicion/'.$req->requisicion, 'Aprobar', array('class' => 'aprobar_requisicion'));
                    $link2 = anchor('requisiciones/detalle_requisicion/'.$req->requisicion, 'Previo');
                    $link3 = anchor('requisiciones/rechazar_requisicion/'.$req->requisicion, 'Rechazar', array('class' => 'rechazar_requisicion'));
                   }
            ?>
                                    <tr>
                                        <td><?php echo $req->requisicion; ?></td>
                                        <td><?php echo $req->fecha; ?></td>
                                        <td><?php echo $req->estatusDescripcion; ?></td>
                                        <td><?php echo $req->nombre; ?></td>
                                        <td><?php echo $req->tipoDescripcion; ?></td>
                                        <td><?php echo $link1; ?></td>
                                        <td><?php echo $link2; ?></td>
                                        <td><?php echo $link3; ?></td>
                                    </tr>
            <?php
            	}
            ?>
                                </tbody>
                            
                            </table>

                         </div>
                     </div>
                 </div>
                         