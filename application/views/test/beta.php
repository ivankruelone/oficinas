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
                        
                            <?php echo anchor('test/beta2', 'Pasar a la siguiente serie.'); ?>
                        
                        </div>
                        
                        <?php
                        
                        }else{
                        
                        ?>
                        
                        <?php
                        
                        echo form_open('test/beta_serie1', array('class' => 'form-horizontal'));
                        
                        ?>
                        
                       <div class="alert alert-block alert-info fade in">
                              <button data-dismiss="alert" class="close" type="button">×</button>
                              
                              
                              <h4 class="alert-heading" style="text-align: center;">Instrucciones Generales</h4>
                              <br /><br />
                              
                              <?php
	                           echo utf8_encode('

                              <p>
                             CLAVES:<br />
                             Esta prueba consiste en que mediante una clave, usted debe escribir los números que correspondan con los símbolos.
                                  
                              </p>
                              
                              <p class="text-info"><br />
                            SUBPRUEBA 1
                            <br /><br />
                            EJEMPLO:
                            <br /><br />
                              
                              ')?>
                        </div> 
                        
                        <div class="form-horizontal" style="text-align: center;">
                        
                   
<?php
	$image_properties = array(
          'src' => 'img/testbeta/SUBPRUEBA_1_ejemplo.jpg',
          'width' => '50%',
          
          
    );

    echo img($image_properties);
?>  
<br /><br /><br /><br /><br />



<?php
	$image_properties = array(
          'src' => 'img/testbeta/SUBPRUEBA_1_EJERCICIOS _1.00.jpg',
          'width' => '25%',
    );

    echo img($image_properties);
?>

<?php
	$image_properties = array(
          'src' => 'img/testbeta/SUBPRUEBA_1_EJERCICIOS_1.1.jpg',
          'width' => '25%',
    );

    echo img($image_properties);
?>

<br /><br />
<?php
	$image_properties = array(
          'src' => 'img/testbeta/SUBPRUEBA_1_EJERCICIOS _1.01.jpg',
          'width' => '25%',
    );

    echo img($image_properties);
?>

<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />



<br /><br /><br /><br />
<?php
	$image_properties = array(
          'src' => 'img/testbeta/SUBPRUEBA_1_EJERCICIOS_1.2.jpg',
          'width' => '52.50%',
    );

    echo img($image_properties);
?>
<br /><br />

<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />


<br /><br /><br /><br />

<?php
	$image_properties = array(
          'src' => 'img/testbeta/SUBPRUEBA_1_EJERCICIOS_1.3.jpg',
          'width' => '52.50%',
    );

    echo img($image_properties);
?>
<br /><br />

<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />
<input type="text" class="input-mini" name="beta" maxlength="1" pattern="([1-6]{1})" required />




                        
                        </div>
                       
                        <div class="form-actions" style="text-align: center;">
                        
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
                        