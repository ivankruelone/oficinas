<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Evaluaci&oacute;n </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                                <tr>

                                    <th>ID Evaluacion</th>
                                    <th>Evaluacion</th>
                                    <th>Tipo</th>
                                    <th>Instrucciones</th>
                                    <th>Objetivo</th>
                                    
                                    
                                    <th colspan="3">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                            
                                
                                ?>
                                <tr>
                                    <td><?php echo $row->id; ?></td>
                                    <td><?php echo $row->valoracion; ?></td>
                                    <td><?php echo $row->descripcion; ?></td>
                                    <td><?php echo $row->instrucciones; ?></td>
                                    <td><?php echo $row->objetivo; ?></td>
                                    <td><?php echo anchor('checklist/editarchecklist/'.$row->id, 'Editar'); ?></td>
                                    <td><?php echo anchor('checklist/preguntas_checklist/'.$row->id, 'Preguntas'); ?></td>
                                </tr>
                                
                                <?php 
                                
                            
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
                 
                 
                 
                  <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Ponderacriones </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         
                         
                          <table class="table">
                            <thead>
                                <tr>

                                    <th>ID Ponderacion</th>
                                    <th>Tipo Farmacia</th>
                                    <th>Valor</th>
                                    <th>Calificacion</th>
                                    
                                    
                                    <th colspan="3">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                
                                foreach($query2->result() as $row){ 
                                
                            
                                
                                ?>
                                <tr>
                                    <td><?php echo $row->id; ?></td>
                                    <td><?php echo $row->tipoFarmacia; ?></td>
                                    <td><?php echo $row->valor; ?></td>
                                    <td><?php echo $row->calificacion; ?></td>
                                    <td><?php echo anchor('checklist/editar_ponderacion/'.$row->id, 'Editar'); ?></td>
                                    
                                </tr>
                                
                                <?php 
                                
                            
                                    {
                                        foreach($query->result() as $row)
                                        {
                                            
                                            
                                         }
                                    }
                                
                                }
                                        
                                        
                                ?>
                                
                            
                                

                            </tbody>
                         </table>
                                
                                