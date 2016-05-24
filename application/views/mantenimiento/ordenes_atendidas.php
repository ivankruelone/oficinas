<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Ordenes de Mantenimiento Atendidas </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                                <tr>

                                    <th style="text-align: center;"># De Orden</th>
                                    <th style="text-align: center;"># De Sucursal</th>
                                    <th style="text-align: center;">Sucursal</th>
                                    <th style="text-align: center;">Fecha de Orden </th>
                                    <th style="text-align: center;">Fecha de Cierre </th>
                                    
                                    <th style="text-align: center;"colspan="3">Acci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 

                    
               ?>
                            
                                
                            
                                <tr>
                                
                                    <td style="text-align: center;"><?php echo $row->orden; ?></td>
                                    <td style="text-align: center;"><?php echo $row->suc; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nombre; ?></td>
                                    <td style="text-align: center;"><?php echo $row->fecha; ?></td>
                                    <td style="text-align: center;"><?php echo $row->fecha_cierre; ?></td>
                                    <td style="text-align: center;"><?php echo anchor('mantenimiento/observaciones/'.$row->orden, 'Observaci&oacute;n'); ?></td>
                                    <td style="text-align: center;"><?php echo anchor('mantenimiento/evaluacion_encuesta/'.$row->orden, 'Detalle de la Evaluaci&oacute;n'); ?></td>
                                </tr>
                                
                                <?php 
                               
                                    }  
                                ?>
                                
                            
                                
</tbody>
</table>
