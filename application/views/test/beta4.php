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
                        
                            <?php echo anchor('test/beta5', 'Pasar a la siguiente serie.'); ?>
                        
                        </div>
                        
                        <?php
                        
                        }else{
                        
                        ?>
                        
                        <?php
                        
                        echo form_open('test/beta_serie4', array('class' => 'form-horizontal'));
                        
                        ?>
                        
                        <div class="alert alert-block alert-info fade in">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              
                              
                              <h4 class="alert-heading" style="text-align: center;">Instrucciones Generales</h4>
                              <br /><br />
                              
                              <?php
	                           echo utf8_encode('

                              <p>
                             Objetos Equivocados: <br /><br />
                             Deberá seleccionar aquel dibujo entre cuatro que ilustre algo que sea incorrecto o que no tiene sentido.
                                  
                              </p>
                              
                              <p class="text-info"><br />
                            SUBPRUEBA 4
                            <br /><br />
                            EJEMPLO:
                            <br /><br />
                              
                              ')?>
                        </div> 
                        
                       


<?php
	$image_properties = array(
          'src' => 'img/testbeta/SUBPRUEBA 4 ejemplo.jpg',
          'width' => '100%',
    );

    echo img($image_properties);
?>

                        <br /><br /><br /><br />
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 4 EJERCICIOS1.1.jpg',
                                  'width' => '16%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        &nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 4 EJERCICIOS1.2.jpg',
                                  'width' => '16%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        &nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 4 EJERCICIOS1.3.jpg',
                                  'width' => '16%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        &nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 4 EJERCICIOS1.4.jpg',
                                  'width' => '16%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        <div style="text-align: center;">  
                        
                        <br />
                      
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option1" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option2" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option3" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios1" value="option4" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            <br /><br /><br /><br />
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 4 EJERCICIOS2.1.jpg',
                                  'width' => '16%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        &nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 4 EJERCICIOS2.2.jpg',
                                  'width' => '16%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        &nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 4 EJERCICIOS2.3.jpg',
                                  'width' => '16%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        &nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 4 EJERCICIOS2.4.jpg',
                                  'width' => '16%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        <div style="text-align: center;">  
                        
                        <br />
                      
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios2" value="option1" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios2" value="option2" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios2" value="option3" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios2" value="option4" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                      </div>
                            <br /><br /><br /><br />
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 4 EJERCICIOS3.1.jpg',
                                  'width' => '16%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        &nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 4 EJERCICIOS3.2.jpg',
                                  'width' => '16%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        &nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 4 EJERCICIOS3.3.jpg',
                                  'width' => '16%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        &nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 4 EJERCICIOS3.4.jpg',
                                  'width' => '16%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        <div style="text-align: center;">  
                        
                        <br />
                      
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios3" value="option1" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios3" value="option2" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios3" value="option3" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios3" value="option4" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div> 
                            
                    
                    
                    <br />
                        
                        <div class="form-actions">
                        
                            <button class="btn  btn-primary" type="submit">
                                <i class="icon-ok"></i>
                        
                                 Iniciar
                        
                            </button>
                        
                        </div>
                        
                        </div>
                        
                        <?php
                        
                        echo form_close();
                        
                        }
                        
                        ?>
                        
                        </div>
                    </div>
                </div>
            </div>
                        