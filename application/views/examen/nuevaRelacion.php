                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <?php echo form_open('examen/nuevaRelacion_submit', array('class' => 'form-horizontal'));?>
                         
                                <div class="control-group">
                                    <label class="control-label">Concepto</label>
                                    <div class="controls">
                                        <?php echo form_input(array('id' => 'concepto', 'name' => 'concepto', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered')); ?>
                                        <span class="help-inline">Concepto.</span>
                                    </div>
                                </div>
                                
                                <div class="control-group" id="imagen_imagen">
                                
                                </div>
                                
                                <div class="control-group">
                                
                                <button class="green medium" id="upload_button">Da click aqui para seleccionar una imagen desde arhivo.</button>
                                
                                </div>
                                
                                <div class="control-group" id="imagen_preview">
                                
                                </div>

                                <div class="control-group">
                         
                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                                </div>
                                
                         <?php echo form_hidden('examenID', $examenID);?>
                         
                         <?php echo form_hidden('imagen', null);?>

                         <?php echo form_close(); ?>
                         


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
