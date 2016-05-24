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
                        
                        <?php
                        
                        $serie_destino = $serie + 1;
                        
                        echo form_open('test/terman_merril_serie_' . $serie_destino, array('class' => 'form-horizontal', 'id' => 'form_serie'));
                        
                        ?>
                        
                        
                        <h2>SERIE <span class="text-warning" id="serie"><?php echo $serie; ?></span></h2>
                        <p>Tiempo: <span class="text-warning" id="tiempo"><?php echo $info->tiempo; ?></span> minutos.</p>
                        <p>Contestado: <span class="text-warning" id="contestado"><?php echo $info->contestado; ?></span></p>
                        
                        <div id="instrucciones">
                        <h3>INSTRUCCIONES :</h3>
                        <p class="text-info">
                            <?php echo $info->instrucciones; ?>
                        </p>
                        <h4>EJEMPLO:</h4>
                        <p class="text-info"><?php echo $info->pregunta; ?></p>
                        <p><?php echo $info->opciones; ?></p>
                        

                        <div class="form-actions">
                        
                            <button class="btn blue" type="button" id="iniciar_serie">
                                <i class="icon-ok"></i>
                        
                                 Iniciar
                        
                            </button>
                        
                        </div>
                        
                        </div>
                        
                        <div id="contestado">
                        
                            <?php echo anchor('test/terman_merril_serie_' . $serie_destino, 'Pasar a la siguiente serie.'); ?>
                        
                        </div>
                        
                        <div id="preguntas">
                        
                        <?php
                        
                        foreach($preguntas->result() as $pregunta)
                        {
                            
                            $this->db->where('pregunta', $pregunta->pregunta);
                            $opciones = $this->db->get('test.tm_opcion');
                            
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
                                    <label class="radio">
                                            <input type="radio" name="optionsRadios'.$pregunta->pregunta.'" value="'.$opcion->opcion.'" />
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
                        
                        <div class="clock" style="margin:2em;"></div>
                        <div id="message"></div>

                        <div class="form-actions">
                        
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
            </div>
                        