<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {  
    header("Access-Control-Allow-Origin: *");  
    header('Access-Control-Allow-Credentials: true');  
    header('Access-Control-Max-Age: 86400');   
}  
  
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {  
  
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))  
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  
  
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))  
        header("Access-Control-Allow-Headers: *");  
} 
?>
<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Nuevo M&eacute;dico</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         
                         <?php echo form_open('medicos/nuevo_medico_submit');
                           $cedula = array(
                                            'name'        => 'cedula',
                                            'id'          => 'cedula',
                                            'value'       => '',
                                            'maxlength'   => '35',
                                            'size'        => '50',
                                            'placeholder' => 'Ejemplo: 2010125',
                                            'type'        => 'number');
                           $especial = array(
                                            'name'        => 'especial',
                                            'id'          => 'especial',
                                            'value'       => '',
                                            'maxlength'   => '35',
                                            'size'        => '50'
                                            );
                                            
                           $codp = array(
                                            'name'        => 'codp',
                                            'id'          => 'codp',
                                            'value'       => '',
                                            'maxlength'   => '35',
                                            'size'        => '50',
                                            'placeholder' => 'Ejemplo: 12365',
                                            'type'        => 'number');
                           
                           $col = array(
                                            'name'        => 'col',
                                            'id'          => 'col',
                                            'value'       => '',
                                            'maxlength'   => '35',
                                            'size'        => '50');
                           
                           $mnpio = array(
                                            'name'        => 'mnpio',
                                            'id'          => 'mnpio',
                                            'value'       => '',
                                            'maxlength'   => '35',
                                            'size'        => '50');
                                            
                           $ciudad = array(
                                            'name'        => 'ciudad',
                                            'id'          => 'ciudad',
                                            'value'       => '',
                                            'maxlength'   => '35',
                                            'size'        => '50');
                           
                           $estado = array(
                                            'name'        => 'estado',
                                            'id'          => 'estado',
                                            'value'       => '',
                                            'maxlength'   => '35',
                                            'size'        => '50');
                            $tarjeta = array(
                                            'name'        => 'tarjeta',
                                            'id'          => 'tarjeta',
                                            'value'       => '',
                                            'maxlength'   => '35',
                                            'size'        => '50');
                         ?>
                         
                         
                                <div class="control-group">
                                    <label class="control-label">Cedula Del Medico</label>
                                    <div class="controls">
                                        <?php echo form_input($cedula, 'required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Apellido Paterno</label>
                                    <div class="controls">
                                        <?php echo form_input(array('apaterno' => 'apaterno', 'name' => 'apaterno', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered')); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Apellido Materno</label>
                                    <div class="controls">
                                        <?php echo form_input(array('amaterno' => 'amaterno', 'name' => 'amaterno', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered')); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Nombre</label>
                                    <div class="controls">
                                        <?php echo form_input(array('nombre' => 'nombre', 'name' => 'nombre', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered')); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Especialidad Del Medico</label>
                                    <div class="controls">
                                         <?php echo form_dropdown('esp',$especialidad, '','id = "esp"');?> * <?php echo form_input($especial,'required','disabled'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                  <div class="control-group">
                                    <label class="control-label">Codigo Postal</label>
                                    <div class="controls">
                                        <?php echo form_input($codp, 'required'); ?>
                                        <?php echo '<br />';?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Direcci&oacute;n</label>
                                    <div class="controls">
                                        <?php echo form_input(array('dire' => 'dire', 'name' => 'dire', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered')); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Selecciona la Colonia</label>
                                    <div class="controls">
                                        <select name="colonias" id="colonias" style="width:50%"></select>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Colonia</label>
                                    <div class="controls">
                                        <?php echo form_input($col, 'required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                 <div class="control-group">
                                    <label class="control-label">Municipio</label>
                                    <div class="controls">
                                        <?php echo form_input($mnpio, 'required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Ciudad</label>
                                    <div class="controls">
                                        <?php echo form_input($ciudad, 'required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Estado</label>
                                    <div class="controls">
                                        <?php echo form_input($estado, 'required');?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Tel&eacute;fono</label>
                                    <div class="controls">
                                        <?php echo form_input(array('telefono' => 'telefono', 'name' => 'telefono', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered')); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                    
                                <div class="control-group">
                                    <label class="control-label">Tipo de Comision</label>
                                    <div class="controls">                                       
                                        <td><input type="radio" name="tipo_com" id="tipo_com" value="1" /> Descuento</td>
                                        <br />
                                        <td><input type="radio" name="tipo_com" id="tipo_com" value="2" /> Comisi&oacute;n de venta</td>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                               <!-- <div class="control-group">
                                    <label class="control-label">Comisi&oacute;n</label>
                                    <div class="controls">                                       
                                        <?php echo form_input(array('comision' => 'comision', 'name' => 'comision', 'type' => 'text', 'class' => 'input-short', 'required' => 'requiered'));?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div> -->
                                
                                 <div class="control-group">
                                    <label class="control-label">Ingrese N&uacute;mero De Cuenta o Tarjeta</label>
                                    <div class="controls">
                                         <?php echo form_dropdown('tipo_cuenta',$tipo_cuenta, '','id = "tipo_cuenta"');?> * <?php echo form_input($tarjeta,'required','disabled'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                                </div>
                         
                         <?php echo form_close(); ?>
                            
<!---->                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>                