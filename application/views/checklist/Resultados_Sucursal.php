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

                                    <th style="text-align: center;"># de Sucursal</th>
                                    <th style="text-align: center;">Sucursal</th>
                                    <th style="text-align: center;"># Pregunta</th>
                                    <th style="text-align: center;">Pregunta</th>                                    
                                    <th style="text-align: center;">Calificaci&oacute;n</th>
                                    <th style="text-align: center;">Valor</th>
                                    <th style="text-align: center;">Observaciones</th>
                                    
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $valor = 0;
                                foreach($query->result() as $row){
                                    
                                    
                                    
                                
                                
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->suc; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nombre; ?></td>
                                    <td style="text-align: center;"><?php echo $row->idpregunta; ?></td>
                                    <td style="text-align: left;"><?php echo $row->pregunta; ?></td>
                                    <td style="text-align: left;"><?php echo $row->tipo; ?></td>
                                    <td style="text-align: center;"><?php echo $row->valor; ?></td>
                                    <td style="text-align: center;"><?php echo $row->observaciones_texto; ?></td>
                                    
                                    
                                </tr>
                                <?php 
                                
                                    $valor = $valor + $row->valor;
                                }
                                ?>
                                </tbody>
                                <tfoot> 
                                <tr>
                                    <th colspan= "6" style="text-align: right;"> Total: <?php echo $valor; ?></th>
                                </tr>
                                
                                <tr>
                                    <th colspan= "6" style="text-align: right;"> Maximo: <?php echo ($query->num_rows() * 3); ?></th>
                                </tr>
                                
                                <tr>
                                    <th colspan= "6" style="text-align: right;">  Porcentaje: <?php echo $valor * 100 / ($query->num_rows() * 3); ?></th>
                                </tr>

                            </tfoot>
                            
                         </table>


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
                  </div>
      