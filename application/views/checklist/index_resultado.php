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
                        
                        
                         <table class="table">
                            <thead>
                                <tr>

                                    <th style="text-align: center;">Periodo</th>
                                    <th style="text-align: center;">Mes</th>
                                    <th style="text-align: center;">A&ntilde;o</th>
                                    
                                    
                                    <th colspan="1" style="text-align: center;">Acci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                            
                                
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->periodoID; ?></td>
                                    <td style="text-align: center;"><?php echo $row->mes; ?></td>
                                    <td style="text-align: center;"><?php echo $row->ano; ?></td>
                                    <td style="text-align: center;"><?php echo anchor('checklist/resultados/'.$row->periodoID, 'Resultados'); ?></td>
                                    <td style="text-align: center;"><?php echo anchor('checklist/resultados_globales/'.$row->periodoID, 'Detalle Global'); ?></td>
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