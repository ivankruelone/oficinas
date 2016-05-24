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
                            <caption>Puntuacion maxima: <?php echo $maximo; ?></caption>
                            <thead>
                                <tr>
                                    <th>Master</th>
                                    <th>ID</th>
                                    <th>Nomina</th>
                                    <th>Paterno</th>
                                    <th>Materno</th>
                                    <th>Nombre</th>
                                    <th># Sucursal</th>
                                    <th>Sucursal</th>
                                    <th style="text-align: right;">Calificacion</th>
                                    <th style="text-align: right;">Alcance %</th>
                                    <th style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                                ?>
                                <tr>
                                    <td><?php echo $row->x; ?></td>
                                    <td><?php echo $row->id; ?></td>
                                    <td><?php echo $row->nomina; ?></td>
                                    <td><?php echo $row->pat; ?></td>
                                    <td><?php echo $row->mat; ?></td>
                                    <td><?php echo $row->nom; ?></td>
                                    <td><?php echo $row->succ; ?></td>
                                    <td><?php echo $row->nombre; ?></td>
                                    <td style="text-align: right;"><?php echo $row->calificacion; ?></td>
                                    <td style="text-align: right;"><?php echo number_format(($row->calificacion/$maximo) * 100, 2); ?> %</td>
                                    <td><?php echo anchor('examen/resultado_detalle/'.$row->x.'/'.$row->id, 'Ver detalle'); ?></td>
                                </tr>
                                
                                <?php 

                                }
                                
                                ?>
                            </tbody>
                         </table>


<!---->
 
                          
                         </div>
                     </div>
                     
                     <div class="widget red">
                         <div class="widget-title">
                             <h4>Grafico</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body" id="chart">
                       
                         
     
                       
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
