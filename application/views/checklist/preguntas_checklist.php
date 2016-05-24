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
                        
                         <?php echo anchor('checklist/nueva_pregunta/'.$id, 'Nueva Pregunta'); ?>
                         
                         <table class="table">
                            <thead>
                                <tr>

                                    <th style="text-align: center;"># de Pregunta</th>
                                    <th style="text-align: center;">Pregunta</th>
                                    <th style="text-align: center;">Estado</th>
                                    <th style="text-align: center;">Tipo de Farmacia</th>
                                    <th style="text-align: center;">Observaciones</th>
                                    

                                    
                                    <th colspan="3">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $num = 1;
                                
                                foreach($query->result() as $row){ 
                                
                            
                                
                                ?>
                                <tr>
                                
                                    <td style="text-align: center;"><?php echo $num; ?></td>
                                    <td><?php echo $row->pregunta; ?></td>
                                    <td style="text-align: center;"><?php echo $row->vale; ?></td>
                                    <td style="text-align: center;"><?php echo $row->tipo3; ?></td>
                                    <td style="text-align: center;"><?php echo $row->observaciones; ?></td>
                                    <td style="text-align: center;"><?php echo anchor('checklist/edita_pregunta/'.$row->id. '/'.$row->idpregunta, 'Editar'); ?></td>
                                    <td style="text-align: center;"><?php echo anchor('checklist/eliminarPregunta/'.$row->id. '/'.$row->idpregunta, 'Eliminar'); ?></td>
                                    

                                </tr>
                                
                                <?php 
                                 $num ++;
                            
                                    {
                                        foreach($query->result() as $row)
                                        {
                                            
                                            
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