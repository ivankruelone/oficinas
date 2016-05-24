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
                         <caption><?php echo $query->num_rows(); ?></caption>
                            <thead>
                                <tr>


                                    <th style="text-align: center;">Periodo</th>
                                    <th style="text-align: center;">A&ntilde;o</th>
                                    <th style="text-align: center;">Mes</th>
                                    <th style="text-align: center;">Sucursal</th>
                                    <th style="text-align: center;">Valor</th>
                                    <th style="text-align: center;">Maximo</th>
                                    <th style="text-align: center;">Porcentaje</th>
                                    
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $porcentaje = 0;
                                foreach($query->result() as $row){ 
                                
                                
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->periodoID; ?></td>
                                    <td style="text-align: center;"><?php echo $row->ano; ?></td>
                                    <td style="text-align: center;"><?php echo $row->mes; ?></td>
                                    <td style="text-align: center;"><?php echo $row->suc; ?></td>
                                    <td style="text-align: center;"><?php echo $row->valor; ?></td>
                                    <td style="text-align: center;"><?php echo $row->maximo; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($row->porcentaje,1); ?></td>
                                    
                                   
                                    
                                </tr>
                                
                                <?php 
                                $porcentaje = $porcentaje + $row->porcentaje;
                                }
                                ?>
                                </tbody>
                                <tfoot> 
                                <tr>
                                    <th colspan= "8" style="text-align: right;"> Total: <?php echo $porcentaje; ?></th>
                                </tr>
                                
                                <tr>
                                    <th colspan= "8" style="text-align: right;">  Porcentaje: <?php echo  ($porcentaje) / ($query->num_rows()); ?></th>
                                </tr>

                            </tfoot>
                            
                         </table>
                                
                                


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
 
 
 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
 
                     
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
                          <caption><?php echo $query->num_rows(); ?></caption>
                            <thead>
                                <tr>

                                   <th style="text-align: center;">Periodo</th>
                                    <th style="text-align: center;">A&ntilde;o</th>
                                    <th style="text-align: center;">Mes</th>
                                    <th style="text-align: center;">Sucursal</th>
                                    <th style="text-align: center;">Valor</th>
                                    <th style="text-align: center;">Maximo</th>
                                    <th style="text-align: center;">Porcentaje</th>
                                    
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                $porcentaje = 0;
                                foreach($query2->result() as $row){ 
                                
                            
                                
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->periodoID; ?></td>
                                    <td style="text-align: center;"><?php echo $row->ano; ?></td>
                                    <td style="text-align: center;"><?php echo $row->mes; ?></td>
                                    <td style="text-align: center;"><?php echo $row->suc; ?></td>
                                    <td style="text-align: center;"><?php echo $row->valor; ?></td>
                                    <td style="text-align: center;"><?php echo $row->maximo; ?></td>
                                    <td style="text-align: center;"><?php echo number_format($row->porcentaje,1); ?></td>
                                    
                                    
                                    
                                </tr>
                                
                                <?php 
                                
                            $porcentaje = $porcentaje + $row->porcentaje;
                                }
                                ?>
                                </tbody>
                                <tfoot> 
                                <tr>
                                    <th colspan= "8" style="text-align: right;"> Total: <?php echo $porcentaje; ?></th>
                                </tr>
                                
                                <tr>
                                    <th colspan= "8" style="text-align: right;">  Porcentaje: <?php echo  ($porcentaje) / ($query2->num_rows()); ?></th>
                                </tr>

                            </tfoot>
                            
                         </table>
                         
                            <!---->
 
                          
                         </div>
                     </div>
 
 