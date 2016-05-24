<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Reporte De Ordenes Atendidas Por Empleado </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                                <tr>

                                    <th style="text-align: center;">Id Empleado</th>
                                    <th style="text-align: center;">Nombre Del Empleado</th>
                                    
                                    <th style="text-align: center;"colspan="3">Acci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 

                    
               ?>
                            
                                
                            
                                <tr>
                                
                                    <td style="text-align: center;"><?php echo $row->id; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nombre; ?></td>
                                    <td style="text-align: center;"><?php echo anchor('mantenimiento/reporte_ordenes_detalle/'.$row->id, 'Detalle'); ?></td>
                                </tr>
                                
                                <?php 
                               
                                    }  
                                ?>
                                
                            
                                
</tbody>
</table>
