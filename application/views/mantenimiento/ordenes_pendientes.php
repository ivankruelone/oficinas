<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Ordenes de Mantenimiento </h4>
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
                                    
                                    
                                    
                                    <th style="text-align: center;">Acci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                                if($row->id_orden_status == 2){
                        $orden = anchor('mantenimiento/imp_orden/'.$row->orden,'Imprime Orden');
                        $detalla = '';
                        //$detalla = anchor('mantenimiento/detalle_orden/'.$row->orden,'Detalle');
                       // $orden = anchor('mantenimiento/asigna_orden/'.$row->orden,'Detalle');
                 }else{
                       $orden = anchor('mantenimiento/asigna_orden/'.$row->orden,'Asigna Orden');
                       //$detalla = anchor('mantenimiento/detalle_orden/'.$row->orden,'Detalle');
                       
                  }  
               ?>
                            
                                
                            
                                <tr>
                                
                                    <td style="text-align: center;"><?php echo $row->orden; ?></td>
                                    <td style="text-align: center;"><?php echo $row->suc; ?></td>
                                    <td style="text-align: center;"><?php echo $row->nombre; ?></td>
                                    <td style="text-align: center;"><?php echo $row->fecha; ?></td>
                                    <td style="text-align: center;"><?php echo $orden; ?></td>
                                    
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
