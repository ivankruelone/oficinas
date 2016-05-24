<?php
	$row = $query->row();
?>
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
                         
                         <?php echo form_open('examen/editarEnunciado_submit', array('class' => 'form-horizontal'));?>
                         
                                <div class="control-group">
                                    <label class="control-label">Reactivo</label>
                                    <div class="controls">
                                        <?php echo form_input(array('id' => 'enunciado', 'name' => 'enunciado', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->enunciado); ?>
                                        <span class="help-inline">Redacta de manera precisa el enunciado.</span>
                                    </div>
                                </div>

                                <div class="control-group">
                         
                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                                </div>
                                
                         <?php echo form_hidden('examenID', $examenID);?>
                         <?php echo form_hidden('enunciadoID', $enunciadoID);?>
                         
                         <?php echo form_close(); ?>
                         


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
