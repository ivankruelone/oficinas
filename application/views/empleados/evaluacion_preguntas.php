                    
                    <?php
                    
                    foreach($preguntas->result() as $pregunta){
                    
                    ?>
                    <div class="control-group">
                         
                         <label class="control-label"><?php echo $pregunta->pregunta; ?></label>
                         
                                    <div class="controls">
                                    <h4><b><?php echo $pregunta->pregunta_texto; ?></b></h4>
                                    
                                    </div>
                                    <div class="controls">
                                    
                                        <?php
                                        
                                        foreach($respuestas->result() as $respuesta){
                                        
                                        ?>
                                    
                                        <label class="radio">
                                            <input type="radio" name="pregunta<?php echo $pregunta->pregunta; ?>" required="required" value="<?php echo $respuesta->respuesta; ?>" />
                                            <?php echo $respuesta->respuesta_texto?>
                                        
                                        </label>
                                        
                                        <?php
                                        
                                        }
                                        
                                        ?>

                                    </div>
                         </div>
                         
                         <?php
                         
                         }
                         
                         ?>