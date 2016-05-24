
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
                         
                         
                         <?php
                         
                         foreach($query->result() as $row)
                         {
                            
                            echo '<h2><strong>'.$row->titulo.'</strong></h2>';
                            if(strlen(trim($row->objetivo)) != 0)
                            {
                                echo '<h3><strong>Objetivo: </strong>'.$row->objetivo.'</h3>';
                            }
                            
                            if(strlen(trim($row->nota)) != 0)
                            {
                                echo '<h4><strong>Nota: </strong>'.$row->nota.'</h4>';
                            }
                            
                            echo '<hr />';
                            
                            $query2 = $this->checklist_model->getPreguntas($row->id, $suc);
                            
                            foreach($query2->result() as $row2)
                            {
                                echo '<p><strong><font color=\"#F31818\">'.$row2->pregunta.'</font></strong></p>';
                                
                                
                                $query3 = $this->checklist_model->getValor($periodo_sucursalID, $row2->idpregunta);
                                
                                foreach($query3->result() as $row3)
                                {
                                    
                                    
                                    $data = array(
                                    'name'        => 'calificacion_'.$row2->pregunta,
                                    'id'          => 'calificacion_'.$row2->pregunta,
                                    'idpregunta'  => $row2->idpregunta,
                                    'periodo_sucursalID'   => $periodo_sucursalID,
                                    'suc'         => $suc,
                                    'value'       => $row3->valor,
                                    'checked'     => $row3->checado,
                                    'style'       => 'margin:10px',
                                    );
                                    
                                    
                                    echo '<p>'.form_radio($data).$row3->tipo.'</p>';
                                  
                                    
                                }
                                
                                
                                if (strlen($row2->observaciones) > 0 )
                                {
                                    $data1 = array(
                                    'name'        => 'texto_'.$row2->pregunta,
                                    'id'          => 'texto_'.$row2->pregunta,
                                    'idpregunta'  => $row2->idpregunta,
                                    'periodo_sucursalID'   => $periodo_sucursalID,
                                    'suc'         => $suc,
                                    'style'       => 'margin:10px',
                                    'class'         => 'span10',
                                    'maxlength'     =>'255'                                    );

                                    echo '<p style="color: red;">'.$row2->observaciones . ': '.form_input($data1).'</p>';
                                }
                            }
                            
                            
                         }
                         
                         ?>
                         
                          <?php echo form_open('checklist/Terminar_submit', array('class' => 'form-horizontal'));?>
                         
                         

                         <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Terminar</button>
                                </div>
                             

                                  <?php echo form_hidden('periodoID', $periodoID);?>
                                  <?php echo form_hidden('suc', $suc);?>
                                  <?php echo form_hidden('periodo_sucursalID', $periodo_sucursalID);?>
                           
                         <?php echo form_close(); ?>
                         </div>
                         

                     </div>
</div>
                        
                        


                              