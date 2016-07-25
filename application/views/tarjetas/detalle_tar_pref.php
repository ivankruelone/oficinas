<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Detalle Tarjetas Preferente</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;"></th>
                                    <th style="text-align: center;">Tarjeta</th>
                                    <th style="text-align: center;">Cliente</th>
                                    <th style="text-align: center;">Fec.Venta</th>
                                    <th style="text-align: center;">Vigencia</th>
                                    <th style="text-align: center;"># Nomina</th>
                                    <th style="text-align: center;">Empleado</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $num = 1;
                                
                                foreach($query->result() as $row){ 
                                
                            
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $num; ?></td>
                                    <td style="text-align: center;"><?php echo $row->codigo; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nombre; ?></td>
                                    <td style="text-align: center;"><?php echo $row->venta; ?></td>
                                    <td style="text-align: center;"><?php echo $row->vigencia; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nomina; ?></td>
                                    <td style="text-align: center;"><?php echo $row->completo; ?></td>                                 
                                </tr>
                                
                                <?php 
                                
                            
                                    {
                                        foreach($query->result() as $row)
                                        {
                                            
                                            
                                         }
                                    }
                                $num ++;
                                }
                                        
                                        
                                ?>
                                
                            
                                

                            </tbody>
                         </table>


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>