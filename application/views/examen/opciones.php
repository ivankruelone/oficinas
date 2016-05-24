<?php
	$row2 = $query2->row();
?>
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
                         
                         <h2><?php echo $row2->reactivo; ?></h2>
                         
                         <?php echo anchor('examen/nuevaOpcion/'.$examenID.'/'.$reactivoID, 'Nueva opcion'); ?>
                         
                         <table class="table">
                            <caption>Total de opciones en este reactivo: <span style="color: red;"><?php echo $query->num_rows(); ?></span></caption>
                            <thead>
                                <tr>
                                    <th>ID Opcion</th>
                                    <th>Opcion</th>
                                    <th colspan="2">Accion</th>
                                    <th>Respuesta Correcta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                    
                                    if($row->correcta == 0)
                                    {
                                        $correcta = false;
                                    }else{
                                        $correcta = true;
                                    }
                                    
                                    $data = array(
                                    'name'        => 'reactivo'.$row->reactivoID,
                                    'id'          => 'reactivo'.$row->reactivoID,
                                    'value'       => $row->opcionID,
                                    'checked'     => $correcta,
                                    'style'       => 'margin:10px',
                                    );


                                
                                
                                ?>
                                <tr>
                                    <td><?php echo $row->opcionID; ?></td>
                                    <td><?php echo $row->opcion; ?></td>
                                    <td><?php echo anchor('examen/editarOpcion/'.$examenID.'/'.$row->reactivoID.'/'.$row->opcionID, 'Editar'); ?></td>
                                    <td><?php echo anchor('examen/eliminarOpcion/'.$examenID.'/'.$row->reactivoID.'/'.$row->opcionID, 'Emilinar', array('class' => 'eliminar_opcion')); ?></td>
                                    <td><?php echo form_radio($data); ?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                         </table>
                         
                         
                         <div id="respuesta"></div>


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
