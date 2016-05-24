<!------------------------------------------------------------------------------------------------->

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
                                    <th style="text-align: center;"># De Orden</th>
                                    <th style="text-align: center;">Tipo De Mantenimiento</th>
                                    <th style="text-align: center;">Tipo Operaci&oacute;n</th>
                                    <th style="text-align: center;">Operaci&oacute;n</th>
                                    <th style="text-align: center;">Servicios</th>
                                    <th style="text-align: center;">Detalle</th>
                                    <th style="text-align: center;">Detalle De Especifique</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query2->result() as $row){ 
                                
                            
                                
                                ?>
                                <tr>

                                    <td style="text-align: center;"><?php echo $row->orden; ?></td>
                                    <td style="text-align: center;"><?php echo $row->tipo_mantenimiento; ?></td>
                                    <td style="text-align: center;"><?php echo $row->tipo_operacion; ?></td>
                                    <td style="text-align: center;"><?php echo $row->operacion; ?></td>
                                    <td style="text-align: center;"><?php echo $row->servicios; ?></td>
                                    <td style="text-align: center;"><?php echo $row->detalle; ?></td>
                                    <td style="text-align: center;"><?php echo $row->especifique; ?></td>
                                </tr>
                                
                                <?php 
                                
                                
                                }
                                        
                                        
                                ?>

                            </tbody>
                         </table>
                         
                         
 <!----------------------------------------------------------------------------------------------------------------------------->                        
                          <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Observaciones Generales</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($query3->result() as $row){ 

                    
               ?>                            
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->observaciones_detalle; ?></td>
                                    
                                </tr>
                                
                                <?php 
                                
                                
                               
                                    }  
                                ?>
                                
                            
                         </table>
                         

                         </div>
                     </div>
                     
 <!-- END BLANK PAGE PORTLET-->
                             

<!------------------------------------------------------------------------------------------------->

                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Asigna Orden</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
<?php echo form_open('mantenimiento/asigna_orden_submit', array('class' => 'form-horizontal'));?>
                 
                 
                                <div class="control-group">
                                    <label class="control-label">Personal 1</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('id', $id,"nombre = 'id'");?>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Personal 2</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('id1', $id,"nombre = 'id1'");?>
                                    </div>
                                </div>
                                
                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i>Asigna</button>
                                      
                                </div>
                                    <?php echo form_hidden('orden', $orden);?>
                                     <?php echo form_close(); ?>
                                
                                
                                <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;"># De Orden</th>
                                    <th style="text-align: center;">Id</th>
                                    <th style="text-align: center;">Nombre del Trabajador</th>
                                    <th style="text-align: center;"># de Nomina</th>
                                    
                                    <th colspan="3">Accion</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                                
                                
                                ?>
                                <tr>
                                
                                    <td style="text-align: center;"><?php echo $row->orden; ?></td>
                                    <td style="text-align: center;"><?php echo $row->id; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nombre; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nomina; ?></td>
                                    <td style="text-align: center;"><?php echo anchor('mantenimiento/eliminarEmpleado/'.$row->orden. '/'.$row->id, 'Eliminar'); ?></td>
                                    </tr>
                                
                                <?php                                 
                                }      
                                ?>
                            </tbody>
                         </table>
 <?php if($query->num_rows() > 0){?>                       
 <?php echo form_open('mantenimiento/cerrar_orden_submit', array('class' => 'form-horizontal'));?>
                          
                         <div class="control-group">
                                    <label class="control-label">Tiempo De Atenci&oacute;n</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('tiempo_id', $tiempo_id,"tiempo = 'tiempo_id'");?>
                                    </div>
                                </div>
                                
                         <div class="control-group">
                                    <label class="control-label">Presupuesto</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('presupuesto_id', $presupuesto_id,"presupuesto = 'presupuesto_id'");?>
                                    </div>
                                </div>
                                
                                <div class="form-actions">
                                    
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i>Validar Orden</button>
                                      
                                </div>
                                    
                                    <?php echo form_hidden('orden', $orden);?>
                                     <?php echo form_close(); ?>
                                    <?php }else{ }?>
                                

                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>

                 
                 
                 
                 
                                