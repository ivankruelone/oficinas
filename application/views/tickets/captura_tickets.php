<?php

    $data_empleado = array(
              'name'        => 'empleado',
              'class'       => 'span12',
              'id'          => 'empleado',
              'type'        => 'text',
              'required'    => 'required',
              'maxlength'   => '255'
                 );
                 
    $data_areaDescripcion = array(
              'name'        => 'areaDescripcion',
              'class'       => 'span12',
              'id'          => 'areaDescripcion',
              'type'        => 'text',
              'required'    => 'required',
              'maxlength'   => '255'
                 );
                 
    $data_indicadorDescripcion = array(
              'name'        => 'indicadorDescripcion',
              'class'       => 'span24',
              'id'          => 'indicadorDescripcion',
              'type'        => 'text'
                 );                          

    $data_solicitud = array(
              'name'        => 'solicitud',
              'class'       => 'span24',
              'id'          => 'solicitud',
              'type'        => 'text'
                 );

?>
                <div class="span12">
                    <!-- BEGIN SAMPLE FORMPORTLET-->
                    <div class="widget green">
                        <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Alta de Ticket </h4>
                            <span class="tools">
                            <a href="javascript:;" class="icon-chevron-down"></a>
                            <a href="javascript:;" class="icon-remove"></a>
                            </span>
                        </div>
                        <div class="widget-body">
                            <!-- BEGIN FORM-->
                            
                            <?php //echo form_open('maestro/saveProducto', array('class' => 'form-horizontal', 'id' => 'formAltaProducto')); ?>
                            <?php //echo form_open('tickets/saveTickets', array('class' => 'form-horizontal', 'id' => 'formAltaTickets')); ?>
                            
                            <div class="control-group">
                                <label class="control-label">Empleado: </label>
                                <div class="controls">
                                    <?php echo form_dropdown('empleado', $empleado, null, 'class="span6 chzn-select" data-placeholder="Escoge un empleado" tabindex="1" id="empleado"'); ?>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Area: </label>
                                <div class="controls">
                                    <?php echo form_dropdown('areaDescripcion', $areaDescripcion, null, 'class="span6 chzn-select" data-placeholder="Escoge un area" tabindex="1" id="areaDescripcion"'); ?>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Problema con: </label>
                                <div class="controls">
                                    <?php echo form_dropdown('indicadorDescripcion', $indicadorDescripcion, null, 'class="span6 chzn-select" data-placeholder="Escoge un problema" tabindex="1" id="indicadorDescripcion"'); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Solicitud: </label>
                                <div class="controls">
                                    <?php echo form_input($data_solicitud); ?>
                                </div>
                            </div>

                           

                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                            </div>

                            <?php echo form_close(); ?>
                            
                        </div>
                    </div>
                </div>
