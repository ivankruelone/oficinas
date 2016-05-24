<?php

    $sublinea = $this->maestro_model->getSublineaCombo($row->idLinea);
    
    $data_ean = array(
              'name'        => 'ean',
              'id'          => 'ean',
              'class'       => 'span4',
              'type'        => 'number',
              'required'    => 'required',
              'autofocus'   => 'autofocus',
              'value'       => $row->ean,
              'maxlength'   => '15'
     
                 );
                 
    $data_descripcion = array(
              'name'        => 'descripcion',
              'id'          => 'descripcion',
              'value'       => $row->descripcion,
              'type'        => 'text',
              'class'       => 'span12',
              'required'    => 'required'
     
                 );
                 
    $data_concentracion = array(
              'name'        => 'concentracion',
              'id'          => 'concentracion',
              'type'        => 'text',
              'value'       => $row->concentracion,
              'class'       => 'span12'
     
                 );

    $data_formaFarmaceutica = array(
              'name'        => 'formaFarmaceutica',
              'id'          => 'formaFarmaceutica',
              'value'       => $row->formaFarmaceutica,
              'type'        => 'text',
              'class'       => 'span12',
              'maxlength'   => '255'
                 );

    $data_presentacion = array(
              'name'        => 'presentacion',
              'id'          => 'presentacion',
              'value'       => $row->presentacion,
              'class'       => 'span12',
              'type'        => 'text',
              'required'    => 'required',
              'maxlength'   => '255'
                 );

    $data_unidadMedida = array(
              'name'        => 'unidadMedida',
              'class'       => 'span12',
              'id'          => 'unidadMedida',
              'value'       => $row->unidadMedida,
              'type'        => 'text',
              'required'    => 'required',
              'maxlength'   => '45'
                 );

    $data_laboratorioProvisional = array(
              'name'        => 'laboratorioProvisional',
              'class'       => 'span12',
              'id'          => 'laboratorioProvisional',
              'value'       => $row->laboratorioProvisional,
              'type'        => 'text',
              'required'    => 'required',
              'maxlength'   => '255'
                 );

    $data_registro = array(
              'name'        => 'registro',
              'class'       => 'span4',
              'id'          => 'registro',
              'value'       => $row->registro,
              'type'        => 'text',
              'maxlength'   => '45'
                 );

    $data_sustancia = array(
              'name'        => 'sustancia',
              'id'          => 'sustancia',
              'type'        => 'text',
              'value'       => $row->sustancia,
              'class'       => 'span12',
              'required'    => 'required',
              'maxlength'   => '255'
                 );

                                           
    $data_precioMaximoPublico = array(
              'name'        => 'precioMaximoPublico',
              'id'          => 'precioMaximoPublico',
              'class'       => 'span4',
              'type'        => 'text',
              'value'       => $row->precioMaximoPublico,
              'required'    => 'required'
     
                 ); 
    
    $data_precioFarmacia = array(
              'name'        => 'precioFarmacia',
              'id'          => 'precioFarmacia',
              'class'       => 'span4',
              'value'       => $row->precioFarmacia,
              'type'        => 'text',
              'required'    => 'required'
     
                 ); 
	
    $data_claseTerapeutica = array(
              'name'        => 'claseTerapeutica',
              'id'          => 'claseTerapeutica',
              'class'       => 'span2',
              'value'       => $row->claseTerapeutica,
              'type'        => 'text',
              'maxlength'   => '10'
     
                 );

?>
                <div class="span12">
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Cambio de producto </h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN FORM-->
                            
                            <?php echo form_open('maestro/saveProducto', array('class' => 'form-horizontal', 'id' => 'formAltaProducto')); ?>
                            <?php
	//idProducto, ean, descripcion, sustancia, formaFarmaceutica, concentracion, presentacion, unidadMedida, 
    //idLaboratorio, laboratorioProvisional, registro, secuencia, precioMaximoPublico, precioFarmacia, 
    //clave, iva, servicio, idLinea, idSublinea, familia, categoria, subcategoria, antibiotico, 
    //productoStatus, descontinuado, claseTerapeutica, persona, tsec, id, productoAlta, productoBaja, 
    //productoCambio
                            ?>
                            <div class="control-group">
                                <label class="control-label">EAN: </label>
                                <div class="controls">
                                    <?php echo form_input($data_ean); ?>
                                    <span class="help-inline" id="ean_message">Introduce el codigo de barras del producto.</span>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Descripci&oacute;n: </label>
                                <div class="controls">
                                    <?php echo form_input($data_descripcion); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Sustancia: </label>
                                <div class="controls">
                                    <?php echo form_input($data_sustancia); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Forma farmaceutica: </label>
                                <div class="controls">
                                    <?php echo form_input($data_formaFarmaceutica); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Concentraci&oacute;n: </label>
                                <div class="controls">
                                    <?php echo form_input($data_concentracion); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Presentaci&oacute;n: </label>
                                <div class="controls">
                                    <?php echo form_input($data_presentacion); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Unidad de medida: </label>
                                <div class="controls">
                                    <?php echo form_input($data_unidadMedida); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Laboratorio: </label>
                                <div class="controls">
                                    <?php echo form_dropdown('idLaboartorio', $laboratorios, $row->idLaboratorio, 'class="span6 chzn-select" data-placeholder="Escoge un laboratorio" tabindex="1" id="idLaboratorio"'); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Laboratorio Provisional: </label>
                                <div class="controls">
                                    <?php echo form_input($data_laboratorioProvisional); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Registro: </label>
                                <div class="controls">
                                    <?php echo form_input($data_registro); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Secuencia: </label>
                                <div class="controls">
                                    <?php echo form_dropdown('secuencia', $secuencias, $row->secuencia, 'class="span6 chzn-select" data-placeholder="Escoge una secuencia" tabindex="1" id="secuencia"'); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Clave de gobierno: </label>
                                <div class="controls">
                                    <?php echo form_dropdown('clave', $gobierno, $row->clave, 'class="span6 chzn-select" data-placeholder="Escoge una clave de gobierno" tabindex="1" id="clave"'); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Precio Maximo Publico: </label>
                                <div class="controls">
                                    <?php echo form_input($data_precioMaximoPublico); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Precio Farmacia: </label>
                                <div class="controls">
                                    <?php echo form_input($data_precioFarmacia); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">IVA: </label>
                                <div class="controls">
                                    <?php echo form_dropdown('iva', $sino, $row->iva, 'class="span6 chzn-select" data-placeholder="Iva" tabindex="1" id="iva"'); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Servicio: </label>
                                <div class="controls">
                                    <?php echo form_dropdown('servicio', $sino, $row->servicio, 'class="span6 chzn-select" data-placeholder="Servicio" tabindex="1" id="servicio"'); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Linea: </label>
                                <div class="controls">
                                    <?php echo form_dropdown('idLinea', $linea, $row->idLinea, 'class="span6" data-placeholder="Escoge una linea" tabindex="1" id="idLinea"'); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Sublinea: </label>
                                <div class="controls">
                                    <?php echo form_dropdown('idSublinea', $sublinea, $row->idSublinea, 'class="span6" data-placeholder="Escoge una sublinea" tabindex="1" id="idSublinea"'); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Antibiotico: </label>
                                <div class="controls">
                                    <?php echo form_dropdown('antibiotico', $sino, $row->antibiotico, 'class="span6 chzn-select" data-placeholder="Servicio" tabindex="1"'); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Clase terapeutica: </label>
                                <div class="controls">
                                    <?php echo form_input($data_claseTerapeutica); ?>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                            </div>
                            
                            <?php echo form_hidden('idProducto', $row->idProducto); ?>

                            <?php echo form_close(); ?>
                            
                        </div>
                    </div>
                </div>
