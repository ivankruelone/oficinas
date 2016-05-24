                <div class="span12">
                
                <?php echo anchor('ventas/fecha_submit_excel/'.$fecha_venta1.'/'.$fecha_venta2.'/'.$suc, '<i class="icon-download"></i><div></div>', array('class' => 'icon-btn span2')); ?>

                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><i class="icon-edit"></i> <?php echo $titulo; ?> </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Suc.</th>
                                        <th>Fecha</th>
                                        <th>Ticket</th>
                                        <th>Secuencia</th>
                                        <th>EAN</th>
                                        <th>Descripcion</th>
                                        <th>Cantidad</th>
                                        <th>Linea</th>
                                        <th>Importe</th>
                                        <th>Cliente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($query->result() as $row){?>
                                    <tr>
                                        <td><?php echo $row->suc; ?></td>
                                        <td><?php echo $row->fecha; ?></td>
                                        <td><?php echo $row->tic; ?></td>
                                        <td style="text-align: right;"><?php echo $row->sec; ?></td>
                                        <td style="text-align: right;"><?php echo $row->cod; ?></td>
                                        <td><?php echo $row->des; ?></td>
                                        <td style="text-align: right;"><?php echo $row->cant; ?></td>
                                        <td><?php echo $row->lin; ?></td>
                                        <td style="text-align: right;">$<?php echo $row->imp; ?></td>
                                        <td><?php echo $row->nombre; ?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>

                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>