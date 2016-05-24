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
                         
                         <?php echo anchor('examen/nuevoEnunciado/'.$examenID, 'Nuevo enunciado'); ?>
                         
                         <table class="table">
                            <caption>Total de reactivos en este examen: <span style="color: red;"><?php echo $query->num_rows(); ?></span></caption>
                            <thead>
                                <tr>
                                    <th>ID Examen</th>
                                    <th>Examen</th>
                                    <th>Enunciado ID</th>
                                    <th>Enunciado</th>
                                    <th colspan="3">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($query->result() as $row){ ?>
                                <tr>
                                    <td><?php echo $row->examenID; ?></td>
                                    <td><?php echo $row->examen; ?></td>
                                    <td><?php echo $row->enunciadoID; ?></td>
                                    <td><?php echo $row->enunciado; ?></td>
                                    <td><?php echo anchor('examen/editarEnunciado/'.$row->examenID.'/'.$row->enunciadoID, 'Editar'); ?></td>
                                    <td><?php echo anchor('examen/palabras/'.$row->examenID.'/'.$row->enunciadoID, 'Palabras'); ?></td>
                                    <td><?php echo anchor('examen/enunciadoEliminar/'.$row->examenID.'/'.$row->enunciadoID, 'Eliminar', array('class' => 'eliminar')); ?></td>
                                
                                </tr>
                                
                                
                                
                                <?php }?>
                            </tbody>
                            
                                
                               
                         </table>
 
<!---->
 
                          
                         </div>
                     </div>
                     


                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Distractores</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <?php echo anchor('examen/nuevoDistractor/'.$examenID, 'Agrega Distractor'); ?>
                         
                         <table class="table">
                            
                            <thead>
                                <tr>
                                    <th>Id Distractor</th>
                                    <th>Distractor</th>
                                    <th>Examen ID</th>
                                    <th colspan="3">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                   <?php foreach($query2->result() as $row){ ?>
                                <tr>
                                    <td><?php echo $row->distractorID;?></td>
                                    <td><?php echo $row->distractor;?></td>
                                    <td><?php echo $row->examenID;?></td>
                                     <td><?php echo anchor('examen/distractorEliminar/'.$row->examenID.'/'.$row->distractorID, 'Eliminar Distractor', array('class' => 'eliminar')); ?></td>
                                
                                
                                </tr>

                             
                            </tbody>
                            
                                         
                         </table>
 
<!---->
 
                          
                         </div>
                     </div>                     
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
 <?php }?>