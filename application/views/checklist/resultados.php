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

                                    <th style="text-align: center;">Periodo</th>
                                    <th style="text-align: center;">Sucursal</th>
                                    <th style="text-align: center;">Descripci&oacute;n Sucursal</th>
                                    <th style="text-align: center;">Tipo de Farmacia</th>
                                    <th style="text-align: center;">Valor</th>
                                    <th style="text-align: center;">Maximo</th>
                                    <th style="text-align: center;">Porcentaje %</th>
                                    <th style="text-align: center;">Ponderaci&oacute;n</th>
                                    
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                                
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->periodoID; ?></td>
                                    <td style="text-align: center;"><?php echo $row->suc; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nombre; ?></td>
                                    <td style="text-align: center;"><?php echo $row->tipo3; ?></td>
                                    <td style="text-align: center;"><?php echo $row->valor; ?></td>
                                    <td style="text-align: center;"><?php echo $row->maximo; ?></td>
                                    <td style="text-align: center;"><?php echo $row->porcentaje; ?></td>
                                    <td style="text-align: center;"><?php echo $row->ponderacion; ?></td>
                                    <td style="text-align: center;"><?php echo anchor('checklist/secciones/'.$row->suc.'/'.$periodoID, 'Detalle'); ?></td>
                                    
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
                             <h4><i class="icon-reorder"></i> Farmacias Doctor Ahorro </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         
                         
                          <table class="table">
                            <thead>
                                <tr>

                                   <th style="text-align: center;">Periodo</th>
                                    <th style="text-align: center;">Sucursal</th>
                                    <th style="text-align: center;">Descripci&oacute;n Sucursal</th>
                                    <th style="text-align: center;">Tipo de Farmacia</th>
                                    <th style="text-align: center;">Valor</th>
                                    <th style="text-align: center;">Maximo</th>
                                    <th style="text-align: center;">Porcentaje %</th>
                                    <th style="text-align: center;">Ponderaci&oacute;n</th>
                                    
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                
                                foreach($query2->result() as $row){ 
                                
                            
                                
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->periodoID; ?></td>
                                    <td style="text-align: center;"><?php echo $row->suc; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nombre; ?></td>
                                    <td style="text-align: center;"><?php echo $row->tipo3; ?></td>
                                    <td style="text-align: center;"><?php echo $row->valor; ?></td>
                                    <td style="text-align: center;"><?php echo $row->maximo; ?></td>
                                    <td style="text-align: center;"><?php echo $row->porcentaje; ?></td>
                                    <td style="text-align: center;"><?php echo $row->ponderacion; ?></td>
                                    <td style="text-align: center;"><?php echo anchor('checklist/secciones/'.$row->suc.'/'.$periodoID, 'Detalle'); ?></td>
                                    
                                    
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
                                
                                