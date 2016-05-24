<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Detalle De Ordene De Mantenimiento </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                                <tr>
                                    <th># De Orden</th>
                                    <th>Operacion</th>
                                    <th>Detalle de Operacion</th>
                                    <th>Especifique</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                            
                                
                                ?>
                                <tr>

                                    <td><?php echo $row->orden; ?></td>
                                    <td><?php echo $row->operacion; ?></td>
                                    <td><?php echo $row->detalle; ?></td>
                                    <td><?php echo $row->especifique; ?></td>
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
