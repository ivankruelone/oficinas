<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                        
                        
                         <table class="table">
                            <thead>
                            
                            
                                <tr>

                                    <th style=" text-align:center;">Periodo</th>
                                    <th style=" text-align:center;">A&ntilde;o</th>
                                    <th style=" text-align:center;">Mes</th>
                                    <th style=" text-align:center;">Sucursal</th>
                                    <th style=" text-align:center;">Nombre de Sucursal</th>
                                    <th style=" text-align:center;">Realizado</th>
                                    <th colspan="1">Accion</th>
                                    <th style=" text-align:center;">Calificacion</th>
                                    <th style=" text-align:center;">Maximo</th>
                                    <th style=" text-align:center;">Alcance</th>
                                    <th style=" text-align:center;">Ponderacion</th>
                               
                               
                                        
                               </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                            
                                
                                ?>
                                <tr>
                                    <td style=" text-align:center;"><?php echo $row->periodoID; ?></td>
                                    <td style=" text-align:center;"><?php echo $row->ano; ?></td>
                                    <td style=" text-align:center;"><?php echo $row->mes; ?></td>
                                    <td style=" text-align:center;"><?php echo $row->suc; ?></td>
                                    <td style=" text-align:center;"><?php echo $row->nombre; ?></td> 
                                    <td style=" text-align:center;"><?php echo $row->realizado; ?></td>
                                    <td><?php echo anchor('checklist/comentarios_observaciones/'.$row->periodoID.'/'.$row->periodo_sucursalID.'/'.$row->suc, 'Observaciones'); ?></td>
                                    <td style=" text-align:center;"><?php echo $row->valor; ?></td>
                                    <td style=" text-align:center;"><?php echo $row->maximo; ?></td>
                                    <td style=" text-align:center;"><?php echo number_format($row->porcentaje, 1); ?></td>
                                    <td style=" text-align:center;"><?php echo $row->ponderacion; ?></td>


                                     
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
