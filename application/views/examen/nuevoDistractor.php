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
                         
                         <?php echo form_open('examen/nuevoDistractor_submit', array('class' => 'form-horizontal'));?>
                         
                                <div class="control-group">
                                    <label class="control-label">Distractor</label>
                                    <div class="controls">
                                        <?php echo form_input(array('id' => 'enunciado', 'name' => 'distractor', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered')); ?>
                                        <span class="help-inline">Ingresa el distractor.</span>
                                    </div>
                                </div>

                                <div class="control-group">
                         
                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                                </div>
                                
                         <?php echo form_hidden('examenID', $examenID);?>
                         
                         <?php echo form_close(); ?>
                         
