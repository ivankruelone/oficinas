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
                        
                        echo form_open('test/ipv_serie', array('class' => 'form-horizontal'));
                        
                        ?>
                        
                        <p class="text-info">
                        INSTRUCCIONES: Marque una respuesta por cada pregunta. <br />
                        No deje ninguna sin contestar.<br /> 
                        Cuando termine presione en el link terminar test.  
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
                        