<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Resultados Globales Detallado </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                                <tr>

                                    <th style="text-align: center;">ID</th>
                                    <th style="text-align: center;">Valoraci&oacute;n</th>
                                    
                                    
                                    
                                </tr>
                                
                                
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                                
                                ?>
                                <tr>
                                
                                    <td style="text-align: center;"><?php echo $row->id; ?></td>
                                    <td style="text-align: center;"><?php echo $row->valoracion; ?></td>
                                   <td><?php echo anchor('checklist/resultados_globales_detalle/'.$row->periodoID.'/'.$row->id, 'Detalle'); ?></td>
                                   
                                    
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
                         
                         </div>
                    </div>




                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Resultados Globales </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                                <tr>

                                    <th style="text-align: center;">Valoracion</th>
                                    <th style="text-align: center;">PeriodoID</th>
                                    <th style="text-align: center;">A&ntilde;o</th>
                                    <th style="text-align: center;">Mes</th>
                                    <th style="text-align: center;">Valor</th>
                                    <th style="text-align: center;">Tipo Farmacia</th>
                                    <th style="text-align: center;">Maximo</th>
                                    <th style="text-align: center;">Porcentaje</th>
                                    
                                    
                                    
                                </tr>
                                
                                
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query2->result() as $row){ 
                                
                                
                                ?>
                                <tr>
                            
                                
                                    <td style="text-align: center;"><?php echo $row->valoracion; ?></td>
                                    <td style="text-align: center;"><?php echo $row->periodoID; ?></td>
                                    <td style="text-align: center;"><?php echo $row->ano; ?></td>
                                    <td style="text-align: center;"><?php echo $row->mes; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($row->valor,2); ?></td>
                                    <td style="text-align: center;"><?php echo $row->tipo3; ?></td>
                                    <td style="text-align: center;"><?php echo $row->maximo; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($row->porcentaje,2); ?></td>
                                  
                                   
                                    
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
                         
                         </div>
                    </div>



</div>


<!---->


