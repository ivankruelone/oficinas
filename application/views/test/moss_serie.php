            <div class="row-fluid">
                <div class="span12">
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i><?php echo $titulo; ?></h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                        
                            
                            <div class="form-horizontal">
                        
                        <?php
                        echo form_open('test/moss', array('id' => 'moss'));
                            
                        echo form_hidden('control', $control);
                        
                        foreach($preguntas->result() as $pregunta)
                        {
                            
                            $this->db->where('pregunta', $pregunta->pregunta);
                            $opciones = $this->db->get('test.moss_opcion');
                            
                            echo '
                            <p class="text-info">'.$pregunta->texto.'</p>';
                            
                            if($opciones->num_rows() > 0)
                            {
                                echo '
                                <div class="control-group">
                                    <label class="control-label"></label>
                                    <div class="controls">';
                                foreach($opciones->result() as $opcion)
                                {
                                    echo '
                                    <label class="radio line">
                                            <input type="radio" name="optionsRadios'.$pregunta->pregunta.'" value="'.$opcion->opcion.'" required />
                                            '.$opcion->textoOpcion.'
                                    </label>';
                                }
                                
                                echo '
                                </div>
                                </div>';
                                
                            }else{
                                echo '
                                <p class="text-error">Captura las opciones.</p>';
                            }

                            
                            
                        }
	
                        ?>
                        
                        </div>
                        
                        <div class="clock" style="margin:2em;"></div>
                        <div id="message"></div>
                        <br />
                        
                        <div class="form-actions" style="text-align: center;">
                        
                            <button class="btn blue" type="submit">
                                <i class="icon-ok"></i>
                        
                                 Terminar esta serie
                        
                            </button>
                        
                        </div>
                        
                        <?php
                        
                        echo form_close();
                        
                        ?>
                          
                        
                        </div>
                    </div>
                </div>
            </div>
                        