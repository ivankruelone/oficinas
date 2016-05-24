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
                        
                        <?php if($control == 1){?>
                        
                        <h2>Este test ya fue contestado; Gracias.</h2>
                        
                        <?php
                        
                        }else{
                        
                        ?>
                        
                        <?php
                        
                        echo form_open('test/zavic_serie', array('class' => 'form-horizontal'));
                        
                        echo utf8_encode('
                        
                        
                        <p class="text-info">
                        INSTRUCCIONES
                        <br />

                        A continuación usted encontrará una serie de situaciones que le van a sugerir 4 respuestas. Lea cada una de ellas cuidadosamente y ordene las respuestas seleccionandola con un clic del mouse sin soltarlo y colocarlas de la siguiente manera:
                        <br />
                        <ul>
                        <li>Primera posición Cuando la respuesta sea más importante.</li>
                        <li>Segunda posición Cuando le sea importante pero no tanto como la anterior.</li>
                        <li>Tercera posición Cuando la prefiera menos que las anteriores.</li>
                        <li>Cuarta posición Cuando tenga menos importancia.</li>
                        </ul>
                        <br />
                        <br />
                        EJEMPLO:
                        <br /><br />');
                        
                        ?>
                        
                        <div class="form-horizontal">
                        
                        <?php
                       
                       
                        
                        foreach($preguntas->result() as $pregunta)
                        {
                            
                         
                            
                            $this->db->where('pregunta', $pregunta->pregunta);
                            $opciones = $this->db->get('test.zavic_opcion');
                            
                           
                            echo '
                            <p class="text-info">'.$pregunta->pregunta.' '.$pregunta->texto.'</p>';
                            
                            
                            if($opciones->num_rows() > 0)
                            {
                                echo '
                                <div class="control-group">
                                    <label class="control-label"></label>
                                    <div class="controls">
                                    <ul id="sortable'.$pregunta->pregunta.'" class="dd-list">';
                                foreach($opciones->result() as $opcion)
                                {
                               
                                    echo '
                                    <li  id="'.$opcion->opcion.'" class="dd-handle" >'.$opcion->textoOpcion.'</li>
                                    
                                    ';
                                }
                                
                                echo '
                                </ul>
                                </div>
                              
                                </div>';
                                
                            }else{
                                echo '
                                <p class="text-error">Captura las opciones.</p>';
                            }

                            
                            
                        }
	
                        ?>
                        
                        </div>
                        
                        <?php
                        
                       echo utf8_encode('
                       
                        <br /><br />
                        Como ha visto, es muy sencillo ahora continúe con los siguientes 20.


                        </p> '); ?>   
                       
                       
                        <div class="form-actions">
                        
                            <button class="btn blue" type="submit">
                                <i class="icon-ok"></i>
                        
                                 Iniciar
                        
                            </button>
                        
                        </div>
                        
                        <?php
                        
                        echo form_close();
                        
                        }
                        
                        ?>
                        
                        </div>
                    </div>
                </div>
            </div>
                        