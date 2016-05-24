<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Farmacias El Fenix </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                                <tr>

                                    <th>ID</th>
                                    <th>Valoraci&oacute;n</th>
                                    
                                    
                                    
                                </tr>
                                
                                
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                                
                                ?>
                                <tr>
                                
                                    <td><?php echo $row->id; ?></td>
                                    <td><?php echo $row->valoracion; ?></td>
                                    <td><?php echo anchor('checklist/Resultados_Sucursal/'.$row->suc.'/'.$row->id.'/'.$periodoID, 'Detalle'); ?></td>

                                   
                                    
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
                             <h4><i class="icon-reorder"></i> Observaciones & Comentarios </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         
                         
                          <table class="table">
                            <thead>
                                <tr>

                                   <th style="text-align: center;">Observaciones</th>
                                    <th style="text-align: center;">Comentarios</th>
                                    <th style="text-align: center;">Seguimiento de Revisi&oacute;n</th>
                                    
                                    
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                
                                foreach($query2->result() as $row){ 
                                
                            
                                
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->observaciones; ?></td>
                                    <td style="text-align: center;"><?php echo $row->comentarios; ?></td>
                                    <td style="text-align: center;"><?php echo $row->seguimiento; ?></td>
                                    
                                    
                                    
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
                                
                                


 