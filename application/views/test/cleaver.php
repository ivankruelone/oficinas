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
                        
                        echo form_open('test/cleaver_serie', array('class' => 'form-horizontal'));
                        
                        ?>
                        
                        <p class="text-info">
                        Las palabras descriptivas que ver&aacute; a continuaci&oacute;n se encuentran agrupadas en series de cuatro. 
                        Examine las palabras de cada serie y seleccione la casilla de la columna "MAS" la palabra que mejor describa en su forma de ser o de comportarse. 
                        Despu&eacute;s seleccione la casilla de la columna "MENOS" la palabra que menos lo describa o se acerque a su forma de ser.
                        </p>
                        
                            
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
                        