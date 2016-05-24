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
                         
                         <?php echo anchor('examen/nuevaRelacion/'.$examenID, 'Nueva relacion'); ?>
                         
                         <table class="table">
                            <caption>Total de reactivos en este examen: <span style="color: red;"><?php echo $query->num_rows(); ?></span></caption>
                            <thead>
                                <tr>
                                    <th>ID Examen</th>
                                    <th>Examen</th>
                                    <th>Relacion ID</th>
                                    <th>Concepto</th>
                                    <th>Imagen</th>
                                    <th colspan="2">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($query->result() as $row){ ?>
                                <tr>
                                    <td><?php echo $row->examenID; ?></td>
                                    <td><?php echo $row->examen; ?></td>
                                    <td><?php echo $row->relacionID; ?></td>
                                    <td><?php echo $row->concepto; ?></td>
                                    <td style="height: 100px;"><img src="<?php echo site_url(); ?>examen/<?php echo $row->imagen; ?>" /></td>
                                    <td><?php echo anchor('examen/editarRelacion/'.$row->examenID.'/'.$row->relacionID, 'Editar'); ?></td>
                                    <td><?php echo anchor('examen/eliminarRelacion2/'.$row->examenID.'/'.$row->relacionID, 'Eliminar', array('class' => 'eliminar')); ?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                         </table>


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
