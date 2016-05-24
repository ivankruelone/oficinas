                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <?php echo anchor('examen/nuevoReactivo/'.$examenID, 'Nuevo reactivo'); ?>
                         
                         <table class="table">
                            <caption>Total de reactivos en este examen: <span style="color: red;"><?php echo $query->num_rows(); ?></span></caption>
                            <thead>
                                <tr>
                                    <th>ID Examen</th>
                                    <th>Examen</th>
                                    <th>Reactivo ID</th>
                                    <th>Reactivo</th>
                                    <th colspan="3">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($query->result() as $row){ ?>
                                <tr>
                                    <td><?php echo $row->examenID; ?></td>
                                    <td><?php echo $row->examen; ?></td>
                                    <td><?php echo $row->reactivoID; ?></td>
                                    <td><?php echo $row->reactivo; ?></td>
                                    <td><?php echo anchor('examen/editarReactivo/'.$row->examenID.'/'.$row->reactivoID, 'Editar'); ?></td>
                                    <td><?php echo anchor('examen/opciones/'.$row->examenID.'/'.$row->reactivoID, 'Opciones'); ?></td>
                                    <td><?php echo anchor('examen/reactivoEliminar/'.$row->examenID.'/'.$row->reactivoID, 'Eliminar', array('class' => 'eliminar')); ?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                         </table>


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
