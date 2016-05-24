<div class="span12">
       <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Datos De La Ordenes De Mantenimiento Atendidas </h4>
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
                                    <th style="text-align: center;">Fecha De Orden Levantada </th>
                                    <th style="text-align: center;">Fecha De Asignaci&oacute;n De Personal </th>
                                    <th style="text-align: center;">Fecha De Cierre De Orden </th>
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
                                    <td style="text-align: center;"><?php echo $row->fecha_asig; ?></td>
                                    <td style="text-align: center;"><?php echo $row->fecha_cierre; ?></td>
                                </tr>
                                
                                <?php 
                               
                                    }  
                                ?>
                                
                            
                                
</tbody>
</table>


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->

       <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Personal Asignado En La Orden </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;"># De Orden</th>
                                    <th style="text-align: center;"># De Nomina</th>
                                    <th style="text-align: center;">Nombre</th>
                                    <th style="text-align: center;">Hora De Entrada</th>
                                    <th style="text-align: center;">Hora De Salida</th>
                                    <th style="text-align: center;">Observaci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query2->result() as $row){ 

                    
               ?>                            
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->orden; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nomina; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nombre; ?></td>
                                    <td style="text-align: center;"><?php echo $row->hora_entrada; ?></td>
                                    <td style="text-align: center;"><?php echo $row->hora_salida; ?></td>
                                    <td style="text-align: center;"><?php echo $row->observacion_personal; ?></td>
                                </tr>
                                
                                <?php 
                               
                                    }  
                                ?>
                                
                            
                                
</tbody>
</table>

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
 
        <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Evaluaci&oacute;n Del Servicio </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;"># De Pregunta</th>
                                    <th style="text-align: center;">Pregunta</th>
                                    <th style="text-align: center;">Calificaci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $calificacion = 0;
                                foreach($query3->result() as $row){ 

                    
               ?>                            
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->idpregunta; ?></td>
                                    <td style="text-align: center;"><?php echo $row->pregunta; ?></td>
                                    <td style="text-align: center;"><?php echo $row->calificacion; ?></td>
                                </tr>
                                
                                <?php 
                                
                                $calificacion = $calificacion + $row->calificacion;
                               
                                    }  
                                ?>
                                
                                </tbody>
                                <tfoot> 
                                <tr>
                                    <th colspan= "6" style="text-align: right;"> Total: <?php echo $calificacion; ?></th>
                                </tr>
                                
                                </tfoot>
                            
                         </table>
                         
<!------------------------------------------------------------------------------------------>                         
                         <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Comentarios Del Servicio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($query4->result() as $row){ 

                    
               ?>                            
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->sugerencias; ?></td>
                                    
                                </tr>
                                
                                <?php 
                                
                                
                               
                                    }  
                                ?>
                                
                            
                         </table>
                                
                            
                                
</tbody>
</table>

<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
 
 
 
    