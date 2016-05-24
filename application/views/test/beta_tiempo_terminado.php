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
                        
                        <h2>Se termino tu tiempo; Gracias.</h2>
                        
                        <div id="contestado">
                        
        
                            <?php 
                            	$serie_destino = $test + 1;
                                
                                if($serie_destino == 6){
                                    
                                    redirect('test/beta_terminado');
                                }else{
                            
                                echo anchor('test/beta' . $serie_destino, 'Pasar a la siguiente serie.'); 
                                }
                            ?>
                        
                        </div>
                        
                        </div>
                    </div>
                </div>
            </div>
                        