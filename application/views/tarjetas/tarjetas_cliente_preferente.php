<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Tarjetas Cliente Preferente</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;"></th>
                                    <th style="text-align: center;"># de Sucursal</th>
                                    <th style="text-align: center;">Sucursal</th>
                                    <th style="text-align: center;">Folio Inicial</th>
                                    <th style="text-align: center;">Folio Final</th>
                                    <th style="text-align: center;">Tarjetas</th>
                                    <th style="text-align: center;">Venta</th>
                                    <th style="text-align: center;">Inv</th>
                                    <th style="text-align: center;"></th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $num = 1;
                                
                                foreach($query->result() as $row){ 
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $num; ?></td>
                                    <td style="text-align: center;"><?php echo $row->suc; ?></td>
                                    <td style="text-align: center;"><?php echo $row->sucursal; ?></td>
                                    <td style="text-align: center;"><?php echo $row->fol1; ?></td>
                                    <td style="text-align: center;"><?php echo $row->fol2; ?></td>
                                    <td style="text-align: center;"><?php echo $row->tarjetas; ?></td>
                                    <td style="text-align: center;"><?php echo $row->vendidas; ?></td>
                                    <td style="text-align: center;"><?php echo $row->inv; ?></td>
                                    <td style="text-align: center;"><?php echo anchor('tarjetas/detalle_tar_pref/'.$row->suc.'/'.$row->fol1.'/'.$row->fol2.'/'.$perini.'/'.$perfin, 'Detalle'); ?></td>                  
                                </tr>
                                
                                <?php 
                                
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