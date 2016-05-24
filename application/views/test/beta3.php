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
                        
                        <h2>Esta Serie ya fue contestada; Gracias.</h2>
                        
                        <div id="contestado">
                        
                            <?php echo anchor('test/beta4', 'Pasar a la siguiente serie.'); ?>
                        
                        </div>
                        
                        <?php
                        
                        }else{
                        
                        ?>
                        
                        <?php
                        
                        echo form_open('test/beta_serie3', array('class' => 'form-horizontal'));
                        
                        ?>
                        
                        <div class="alert alert-block alert-info fade in">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              
                              
                              <h4 class="alert-heading" style="text-align: center;">Instrucciones Generales</h4>
                              <br /><br />
                              
                              <?php
	                           echo utf8_encode('

                              <p>
                             Pares iguales y pares desiguales: <br /><br />
                             Deberá seleccionar la opción que usted crea indicada dependiendo de si los pares de dibujos, símbolos o números son iguales o diferentes.
                                  
                              </p>
                              
                              <p class="text-info"><br />
                            SUBPRUEBA 3
                            <br /><br />
                            EJEMPLO:
                            <br /><br />
                              
                              ')?>
                        </div> 
                        


<?php
	$image_properties = array(
          'src' => 'img/testbeta/SUBPRUEBA_3_ejemplo.jpg',
          'width' => '80%',
    );

    echo img($image_properties);
?>

                        <br /><br /><br /><br />
                        
    <div style="text-align: center;">                      
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA_3_EJERCICIOS1.1.jpg',
                                  'width' => '40%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA_3_EJERCICIOS1.2.jpg',
                                  'width' => '40%',
                            );
                        
                            echo img($image_properties);
                        ?>
                            <div class="span4">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option1" required=""/>
                                            IGUAL
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option2" required=""/>
                                            DIFERENTE
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span4">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios2" value="option3" required=""/>
                                            IGUAL
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios2" value="option4" required=""/>
                                            DIFERENTE
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <br /><br /><br /><br />
                            
                            
                            <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA_3_EJERCICIOS1.3.jpg',
                                  'width' => '40%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA_3_EJERCICIOS1.4.jpg',
                                  'width' => '40%',
                            );
                        
                            echo img($image_properties);
                        ?>
                            <div class="span4">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios3" value="option5" required=""/>
                                            IGUAL
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios3" value="option6" required=""/>
                                            DIFERENTE
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span4">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios4" value="option7" required=""/>
                                            IGUAL
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios4" value="option8" required=""/>
                                            DIFERENTE
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <br /><br /><br /><br />
                            
                            
                            <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA_3_EJERCICIOS1.5.jpg',
                                  'width' => '40%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA_3_EJERCICIOS1.6.jpg',
                                  'width' => '40%',
                            );
                        
                            echo img($image_properties);
                        ?>
                            <div class="span4">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios5" value="option5" required=""/>
                                            IGUAL
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios5" value="option6" required=""/>
                                            DIFERENTE
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span4">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios6" value="option7" required=""/>
                                            IGUAL
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios6" value="option8" required=""/>
                                            DIFERENTE
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <br /><br /><br /><br />
                            
                            
                            <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA_3_EJERCICIOS1.7.jpg',
                                  'width' => '40%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA_3_EJERCICIOS1.8.jpg',
                                  'width' => '40%',
                            );
                        
                            echo img($image_properties);
                        ?>
                            <div class="span4">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios7" value="option5" required=""/>
                                            IGUAL
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios7" value="option6" required=""/>
                                            DIFERENTE
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span4">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios8" value="option7" required=""/>
                                            IGUAL
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios8" value="option8" required=""/>
                                            DIFERENTE
                                        </label>
                                    </div>
                                </div>
                            </div>
    </div>
                        <div class="form-actions">
                        
                            <button class="btn  btn-primary" type="submit">
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
                        