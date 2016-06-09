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
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                $sx = "SELECT * from vtadc.tarjetas where tipo=1 and venta between '$perini' and '$perfin' and suc = $row->suc";
                                $qx = $this->db->query($sx);
        
                                if($qx->num_rows() > 0){
                                $ventaa=$qx->num_rows();
                                $inv=(($row->tar)-($ventaa)); 
                                }else{
                                $ventaa=0;
                                $inv=$row->tar;
                                }
                                ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $row->suc; ?></td>
                                    <td style="text-align: center;"><?php echo $row->sucx; ?></td>
                                    <td style="text-align: center;"><?php echo $row->fol1; ?></td>
                                    <td style="text-align: center;"><?php echo $row->fol2; ?></td>
                                    <td style="text-align: center;"><?php echo $row->tar; ?></td>
                                    <td style="text-align: center;"><?php echo $ventaa; ?></td>
                                    <td style="text-align: center;"><?php echo $inv; ?></td>
                                    <td style="text-align: center;"><?php echo anchor('tarjetas/detalle_tar_pref/'.$row->suc.'/'.$row->fol1.'/'.$row->fol2.'/'.$perini.'/'.$perfin, 'Detalle'); ?></td>                  
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


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>