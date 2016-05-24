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
                        
                        echo form_open('test/terman_merril_serie_1', array('class' => 'form-horizontal'));
                        
                        ?>
                        
                        <p class="text-info">
                        Esta  prueba  contiene  las  preguntas  para  cada  una  de  las  10  series.  Al  iniciar  cada  una,  se 
encuentran  las  instrucciones  y  unos  ejemplos  ya  resueltos.  Le&eacute;  con  atenci&oacute;n.  La  forma  de 
contestar el test es : seleccionando la respuesta que considere correcta para cada pregunta . Si tiene alguna duda, ind&iacute;quelo en ese 
momento.
                        </p>
                        
                        <p class="text-warning">Muy importante!!</p>
                        <p class="text-error">Tener una hoja en blanco y un l&aacute;piz antes de comenzar el TEST.</p>
                        <p class="text-error">Este test requiere al menos de 30 minutos libres para realizarlo, s&oacute;lo empiezalo si tienes el tiempo necesario para finalizarlo.</p>
                        <p class="text-error">Nota: Recuerda que el cron&oacute;metro no corre mientras lees las indicaciones, puedes tomarte tu tiempo ya que este comienza al darle clic al bot&oacute;n de iniciar de cada serie. </p>
                        
                            
                        <div class="form-actions">
                        
                            <button class="btn blue" type="submit">
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
                        