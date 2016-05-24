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
                        
                       
                        
                        echo form_open('test/beta1', array('class' => 'form-horizontal'));
                        
                        echo form_hidden('control', $control);
                       
                        
                        ?>
                        
                        
                        <div class="form-horizontal" style="text-align: center;">
                        
                   
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.jpg',
                                      'width' => '100%',  
                                );
                            
                                echo img($image_properties);
                            ?>  
                            <br /><br /><br /><br /><br />
                            
                            
                            
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.11.jpg',
                                      'width' => '20%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.21.jpg',
                                      'width' => '46%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            
                            <br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.12.jpg',
                                      'width' => '20%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            
                            <?php
                            
                            for($i = 1; $i <= 7; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>
                            
                            <br /><br /><br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.22.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 8; $i <= 17; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>
                            
                            
                            <br /><br /><br /><br />
                            
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.3.1.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 18; $i <= 27; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>
                            
                            <br /><br /><br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.3.2.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 28; $i <= 37; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>
                            
                            <br /><br /><br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.4.1.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 38; $i <= 47; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>
                            
                            <br /><br /><br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.4.2.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 48; $i <= 57; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>
                            
                            <br /><br /><br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.5.1.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 58; $i <= 67; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>
                            
                            <br /><br /><br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.5.2.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 68; $i <= 77; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>

                            <br /><br /><br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.6.1.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 78; $i <= 87; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>
                            
                            <br /><br /><br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.6.2.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 88; $i <= 97; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>

                            <br /><br /><br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.7.1.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 98; $i <= 107; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>
                            
                            <br /><br /><br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.7.2.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 108; $i <= 117; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>
                            
                            <br /><br /><br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.8.1.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 118; $i <= 127; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>
                            
                            <br /><br /><br /><br />
                            <?php
                            	$image_properties = array(
                                      'src' => 'img/testbeta/SUBPRUEBA_1.8.2.jpg',
                                      'width' => '66%',
                                );
                            
                                echo img($image_properties);
                            ?>
                            <br /><br />
                            
                            <?php
                            
                            for($i = 128; $i <= 137; $i++){
                            
                            
                            ?>
                            <input type="text" class="input-mini" name="beta<?php echo $i; ?>" id="beta<?php echo $i; ?>" maxlength="1" pattern="([1-9]{1})" required />
                            <?php
                            
                            }
                            
                            ?>
                        
                        </div>
                        <br /><br /><br />
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
                        