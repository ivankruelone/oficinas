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
                        
                        echo form_open('test/beta', array('class' => 'form-horizontal'));
                        
                        ?>
                        
                        <div class="alert alert-block alert-info fade in">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              
                              
                              <h4 class="alert-heading" style="text-align: center;">Instrucciones Generales</h4>
                              <br /><br />
                              
                              <?php
	                           echo utf8_encode('

                              <p>
                             Este test contiene cinco pruebas, cada una evalúa una tarea diferente.<br /> 
                             Antes de cada prueba hay unos ejercicios de práctica que le demostrarán cómo trabajarlos.<br />
                             En cada prueba, debe contestar los ejercicios en el orden en que aparecen. No deje ninguna pregunta sin contestar.<br />
                             Todas las pruebas tienen un tiempo establecido para ser contestadas, pero no se preocupe sino las termina todas.
                                  
                              </p>
                              
                              ')?>
                        </div>
                       
                        <div class="form-actions" style="text-align: center;">
                        
                            
                            <button class="btn  btn-primary" type="submit">
                                <i class="icon-ok"></i>
                        
                                 Iniciar
                        
                            </button>
                        
                        </div>
                        
                        <?php
                        
                        echo form_close();
                        
                        
                        ?>
                        
                        </div>
                    </div>
                </div>
            </div>
                        