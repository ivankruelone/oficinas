                <div class="span12">
                
                <?php echo anchor('ventas/fecha2013_submit_excel/'.$mes.'/'.$suc, '<i class="icon-download"></i><div></div>', array('class' => 'icon-btn span2')); ?>

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
                                        <th>Secuencia</th>
                                        <th>EAN</th>
                                        <th>Descripcion</th>
                                        <th>Cantidad</th>
                                        <th>Linea</th>
                                        <th>Importe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($query->result() as $row){?>
                                    <tr>
                                        <td><?php echo $row->suc; ?></td>
                                        <td><?php echo $row->aaa.'-'.$mes; ?></td>
                                        <td style="text-align: right;"><?php echo $row->sec; ?></td>
                                        <td style="text-align: right;"><?php echo $row->codigo; ?></td>
                                        <td><?php echo $row->descripcion; ?></td>
                                        <td style="text-align: right;"><?php echo $row->can; ?></td>
                                        <td><?php echo $row->lin.'-'.$row->sublin.' '.$row->descrip; ?></td>
                                        <td style="text-align: right;">$<?php echo $row->importe; ?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>

                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>