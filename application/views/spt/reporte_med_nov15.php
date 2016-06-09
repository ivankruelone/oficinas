<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Reporte de M&eacute;dicos Mensual</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                                <tr>

                                    <th style="text-align: center;">Per&iacute;odos</th>
                                    <th style="text-align: center;">Per&iacute;odos Status</th>
                                    <th style="text-align: center;">A&ntilde;o <!--Fecha 1--></th>
                                    <th style="text-align: center;">Mes <!--Fecha 2--></th>
                                    <th style="text-align: center;">Consultas</th>
                                    <th style="text-align: center;">Recetas Surtidas</th>
                                    <th style="text-align: center;">Importe</th>
                                    <th style="text-align: center;">Costo</th>
                                    <th style="text-align: center;">Importe Doctor</th>
                                    <th style="text-align: center;">Importe Fundaci&oacute;n</th>
                                    <th style="text-align: center;">Recaudado</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                            
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->periodo; ?></td>
                                    <td style="text-align: center;"><?php echo $row->periodoStatus; ?></td>
                                    <td style="text-align: center;"><?php echo $row->anio;//$row->fecha1; ?></td>
                                    <td style="text-align: center;"><?php echo $row->mes;//$row->fecha2; ?></td>
                                    <td style="text-align: center;"><?php echo $row->consultas; ?></td>
                                    <td style="text-align: center;"><?php echo $row->recetasSurtidas; ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->importe,2); ?></td>
                                    <td style="text-align: center;"><?php echo $row->costo; ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->impDoctor,2); ?></td>
                                    <td style="text-align: center;"><?php echo number_format ($row->impFundacion,2); ?></td> 
                                    <td style="text-align: center;"><?php echo number_format ($row->recaudado,2); ?></td>
                                    <td style="text-align: center;"><?php echo anchor('spt/detalle_medicos_nov15/'.$row->anio.'/'.$row->mes, 'Detalle Medicos');//anchor('spt/detalle_medicos_nov15/'.$row->periodo, 'Detalle Medicos'); ?></td>                                  
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
                     
                 </div>