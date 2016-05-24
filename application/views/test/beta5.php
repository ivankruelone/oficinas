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
                        <div class="widget-body" >
                        
                        <?php if($control == 1){?>
                        
                        <h2>Este test ya fue contestado; Gracias.</h2>
                        
                       
                        
                        <?php
                        
                        }else{
                        
                        ?>
                        
                        <?php
                        
                        echo form_open('test/beta_serie5', array('class' => 'form-horizontal'));
                        
                        ?>
                        
                        <div class="alert alert-block alert-info fade in">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              
                              
                              <h4 class="alert-heading" style="text-align: center;">Instrucciones Generales</h4>
                              <br /><br />
                              
                              <?php
	                           echo utf8_encode('

                              <p>
                             Matrices: <br /><br />
                             Usted deberá elegir la imagen faltante que complete mejor un conjunto de cuatro símbolos o dibujos.
                                  
                              </p>
                              
                              <p class="text-info"><br />
                            SUBPRUEBA 5
                            <br /><br />
                            EJEMPLO:
                            <br /><br />
                              
                              ')?>
                        </div> 
                       
                        <div style="text-align: center;">

                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 5.1 EJERCICIOS.jpg',
                                  'width' => '25%',
                            );
                        
                            echo img($image_properties);
                        ?>

                        <br /><br /><br /><br />
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 5.1.1 EJERCICIOS.jpg',
                                  'width' => '90%',
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
                        
                         <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 5.2 EJERCICIOS.jpg',
                                  'width' => '25%',
                            );
                        
                            echo img($image_properties);
                        ?>

                        <br /><br /><br /><br />
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 5.2.1 EJERCICIOS.jpg',
                                  'width' => '90%',
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
                        
                         <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 5.3 EJERCICIOS.jpg',
                                  'width' => '25%',
                            );
                        
                            echo img($image_properties);
                        ?>

                        <br /><br /><br /><br />
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 5.3.1 EJERCICIOS.jpg',
                                  'width' => '90%',
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
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios3" value="option4" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                      <br /><br /><br /><br />
                        
                         <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 5.4 EJERCICIOS.jpg',
                                  'width' => '25%',
                            );
                        
                            echo img($image_properties);
                        ?>

                        <br /><br /><br /><br />
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        
                        <?php
                        	$image_properties = array(
                                  'src' => 'img/testbeta/SUBPRUEBA 5.4.1 EJERCICIOS.jpg',
                                  'width' => '90%',
                            );
                        
                            echo img($image_properties);
                        ?>
                        
                        
                        <div style="text-align: center;">  
                        
                        <br />
                      
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios4" value="option1" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios4" value="option2" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios4" value="option3" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios4" value="option4" required=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="span2">
                                <div class="control-group">
                                    <div class="controls">
                                        <label class="radio">
                                            <input type="radio" name="optionsRadios4" value="option4" required=""/>
                                        </label>
                                    </div>
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
                        </div>
                        
                        <?php
                        
                        echo form_close();
                        
                        }
                        
                        ?>
                        
                        </div>
                    </div>
                </div>
            </div>
                        