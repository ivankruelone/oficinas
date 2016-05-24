                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i>Edita Medico</h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <?php echo form_open('medicos/edita_medico_submit', array('class' => 'form-horizontal'));
                           $especial = array(
                                            'name'        => 'especial',
                                            'id'          => 'especial',
                                            'value'       =>  $especialidad,
                                            'maxlength'   => '35',
                                            'size'        => '50');
                         
                         ?>
                         
                         
                         
                            <div class="control-group">
                                    <label class="control-label">Cedula Del Medico</label>
                                    <div class="controls">
                                        <?php echo form_input('cedula', $cedula, 'class= "mensaje" required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Apellido Paterno</label>
                                    <div class="controls">
                                        <?php echo form_input('apaterno', $apaterno, 'class= "mensaje" required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Apellido Materno</label>
                                    <div class="controls">
                                        <?php echo form_input('amaterno', $amaterno, 'class= "mensaje" required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                                         
                                <div class="control-group">
                                    <label class="control-label">Nombre Del Medico</label>
                                    <div class="controls">
                                       <?php echo form_input('nombre', $nombre, 'class= "mensaje" required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                

                                <div class="control-group">
                                    <label class="control-label">Especialidad Del Medico</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('esp',$esp, $espe,"id='esp'");?> * <?php echo form_input($especial, 'required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                 <div class="control-group">
                                    <label class="control-label">Codigo Postal</label>
                                    <div class="controls">
                                        <?php echo form_input('codp', $codp, 'class= "mensaje" id ="codp" required'); ?> * <?php echo form_dropdown('colonias',$colonias,$id_col,'id="colonias"');?>
                                        <!-- <select name="colonias" id="colonias" style="width:50%" ></select> -->
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Direcci&oacute;n</label>
                                    <div class="controls">
                                        <?php echo form_input('dire', $dire, 'class= "mensaje" id = "dire" required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Colonia</label>
                                    <div class="controls">
                                        <?php echo form_input('col', $col, 'class= "mensaje" id = "col" required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label"> Municipio</label>
                                    <div class="controls">
                                        <?php echo form_input('mnpio', $mnpio, 'class= "mensaje" id = "mnpio" required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                
                                <div class="control-group">
                                    <label class="control-label"> Ciudad</label>
                                    <div class="controls">
                                        <?php echo form_input('ciudad', $ciudad, 'class= "mensaje" id = "ciudad" required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label"> Estado</label>
                                    <div class="controls">
                                        <?php echo form_input('estado', $estado, 'class= "mensaje" id = "estado" required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Tel&eacute;fono</label>
                                    <div class="controls">
                                        <?php echo form_input('telefono', $telefono, 'class= "mensaje" required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Tipo de Comisi&oacute;n</label>
                                    <div class="controls">
                                        <?php if($id_comision == 1){?>                                       
                                        <td><input type="radio" name="tipo_com" id="tipo_com" value="1" checked="true" /> Descuento</td>
                                        <br />
                                        <td><input type="radio" name="tipo_com" id="tipo_com" value="2" /> Comisi&oacute;n de venta</td>
                                        <?php }elseif($id_comision == 2){?>
                                         <td><input type="radio" name="tipo_com" id="tipo_com" value="1" /> Descuento</td>
                                        <br />
                                        <td><input type="radio" name="tipo_com" id="tipo_com" value="2" checked="true"/> Comisi&oacute;n de venta</td>
                                        <?php }?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Numero De Cuenta</label>
                                    <div class="controls">
                                         <?php echo form_dropdown('tipo_cuenta',$tipo_cuenta,$id_cuenta,'id = "tipo_cuenta"');?> * <?php echo form_input('cuenta', $cuenta, 'class= "mensaje" id = "cuenta" required'); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                              <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                                </div>
                            <?php echo form_hidden('id_med', $id_med);?>

                         
                         <?php echo form_close(); ?>
<!---->
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                 </div>