<?php
        
    $sustancia = null;
    
	if($query->num_rows() > 0)
    {
        $row = $query->row();
        $sustancia = $row->sustanciaActiva;
    }
?>
                <div class="span12">
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Alta de producto </h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN FORM-->
                            
                            <?php echo form_open('auxiliar/busca_clave_secuencia_submit', array('class' => 'form-horizontal', 'id' => 'formAltaProducto')); ?>
                            <?php
	//idProducto, ean, descripcion, sustancia, formaFarmaceutica, concentracion, presentacion, unidadMedida, 
    //idLaboratorio, laboratorioProvisional, registro, secuencia, precioMaximoPublico, precioFarmacia, 
    //clave, iva, servicio, idLinea, idSublinea, familia, categoria, subcategoria, antibiotico, 
    //productoStatus, descontinuado, claseTerapeutica, persona, tsec, id, productoAlta, productoBaja, 
    //productoCambio
                            ?>

                            <div class="control-group">
                                <label class="control-label">Sustancia: </label>
                                <div class="controls">
                                    <?php echo $row->secuencia.' - '.$sustancia; ?>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">Clave de gobierno: </label>
                                <div class="controls">
                                    <?php echo form_dropdown('clave', $gobierno, null, 'class="span6 chzn-select" data-placeholder="Escoge una clave de gobierno" tabindex="1" id="clave"'); ?>
                                </div>
                            </div>


                            <div class="form-actions">
                                <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                            </div>

                            <?php 
                            
                            echo form_hidden('secuencia', $row->secuencia);
                            echo form_close(); 
                            
                            ?>
                            
                        </div>
                    </div>
                </div>
