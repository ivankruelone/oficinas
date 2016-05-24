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
                                    <th>ExamenID</th>
                                    <th>Examen</th>
                                    <th>Tipo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                foreach($query->result() as $row){ 
                                
                                ?>
                                <tr>
                                    <td><?php echo $row->examenID; ?></td>
                                    <td><?php echo $row->examen; ?></td>
                                    <td><?php echo $row->tipoID; ?></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="3">
                                    
                                    <table style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Pregunta ID</th>
                                                <th>Pregunta</th>
                                                <th style="text-align: right;">Total</th>
                                                <th style="text-align: right;">Correctas</th>
                                                <th style="text-align: right;">Incorectas</th>
                                                <th style="text-align: right;">Porcentaje Correctas</th>
                                                <th style="text-align: right;">Porcentaje Incorrectas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            
                                            $query2 = $this->examen_model->getPorcentajeCorrectas($row->examenID);
                                            
                                            foreach($query2->result() as $row2){
                                                
                                                $pregunta = $this->examen_model->getPreguntaByExamenIDPregunta($row->examenID, $row2->pregunta, $row->tipoID);
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $row2->pregunta; ?></td>
                                                <td><?php echo $pregunta; ?></td>
                                                <td style="text-align: right; color: blue;"><?php echo $row2->total; ?></td>
                                                <td style="text-align: right; color: green;" ><?php echo number_format($row2->correctas, 0); ?> <?php echo anchor('examen/resultado_pregunta/'.$row->examenID.'/'.$row2->pregunta.'/'.$row->tipoID.'/1', '+'); ?></td>
                                                <td style="text-align: right; color: red;"><?php echo number_format($row2->incorrectas, 0); ?> <?php echo anchor('examen/resultado_pregunta/'.$row->examenID.'/'.$row2->pregunta.'/'.$row->tipoID.'/0', '+'); ?></td>
                                                <td style="text-align: right; color: green;"><?php echo number_format(($row2->correctas / $row2->total) * 100, 2); ?> %</td>
                                                <td style="text-align: right; color: red;"><?php echo number_format(($row2->incorrectas / $row2->total) * 100, 2); ?> %</td>
                                            </tr>
                                            
                                            <?php
                                            
                                            }
                                            
                                            ?>
                                        </tbody>
                                    </table>
                                    
                                    
                                    </td>
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
                 
