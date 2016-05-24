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
                         
                         <?php echo anchor('examen/nuevo', 'Nuevo examen'); ?>
                         
                         <table class="table">
                            <thead>
                                <tr>
                                    <th>Master</th>
                                    <th>ID Examen</th>
                                    <th>Examen</th>
                                    <th>Tipo</th>
                                    <th>Tiempo</th>
                                    <th>Instrucciones</th>
                                    <th>Ponderacion</th>
                                    <th>Status</th>
                                    <th colspan="3">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                                switch ($row->tipoID) {
                                    case 1:
                                        $link = anchor('examen/reactivos/'.$row->examenID, 'Reactivos');
                                        break;
                                    case 2:
                                        $link = anchor('examen/enunciados/'.$row->examenID, 'Enunciados');
                                        break;
                                    case 3:
                                        $link = anchor('examen/relaciones/'.$row->examenID, 'Relaciones');
                                        break;
                                    case 4:
                                        $link = anchor('examen/relaciones2/'.$row->examenID, 'Relaciones');
                                        break;
                                }
                                
                                ?>
                                <tr>
                                    <td><?php echo $row->x; ?></td>
                                    <td><?php echo $row->examenID; ?></td>
                                    <td><?php echo $row->examen; ?></td>
                                    <td><?php echo $row->tipoDescripcion; ?></td>
                                    <td><?php echo $row->tiempo; ?> Minuto(s)</td>
                                    <td><?php echo $row->instrucciones; ?></td>
                                    <td><?php echo $row->ponderacion; ?></td>
                                    <td><?php echo $row->liberarDescripcion; ?></td>
                                    <td><?php echo anchor('examen/editarExamen/'.$row->examenID, 'Editar'); ?></td>
                                    <td><?php echo $link; ?></td>
                                    <td><?php echo anchor('examen/imagen/'.$row->examenID, 'Agregar imagen'); ?></td>
                                </tr>
                                
                                <?php 
                                
                                    $query2 = $this->examen_model->getImagenByExamenID($row->examenID);
                                    if($query2->num_rows() > 0)
                                    {
                                        foreach($query2->result() as $row2)
                                        {
                                        
                                ?>
                                
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                    <td colspan="2"><?php echo $row2->imagen; ?></td>
                                    <td><?php echo $row2->textoImagen; ?></td>
                                    <td colspan="2"><img src="<?php echo site_url(); ?>examen/<?php echo $row2->imagen; ?>" width="30%" /></td>
                                    <td><?php echo anchor('examen/eliminaImagen/'.$row2->imagenID, 'Eliminar', array('class' => 'eliminar')); ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                
                                <?php
                                        }
                                    }
                                
                                }
                                
                                ?>
                            </tbody>
                         </table>


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
