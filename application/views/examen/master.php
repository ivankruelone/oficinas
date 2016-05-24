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
                         
                         <?php echo anchor('examen/nuevoMaster', 'Nuevo master', array('id' => 'addMaster')); ?>
                         
                         <table class="table">
                            <thead>
                                <tr>
                                    <th>Master</th>
                                    <th>Status</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                                ?>
                                <tr>
                                    <td><?php echo $row->x; ?></td>
                                    <td><?php echo $row->liberarDescripcion; ?></td>
                                    <td><?php echo anchor('examen/editarMaster/'.$row->x, 'Editar'); ?></td>
                                </tr>
                                
                                <?php 

                                }
                                
                                ?>
                            </tbody>
                         </table>


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
