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
                         
                         <?php echo form_open('checklist/editarchecklist_submit', array('class' => 'form-horizontal'));?>
                         
                         <div class="control-group">
                                    <label class="control-label">Nombre de Evaluacion</label>
                                    <div class="controls">
                                        <?php echo form_input(array('valoracion' => 'valoracion', 'name' => 'valoracion', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->valoracion); ?>
                                        <span class="help-inline">Como denominarias a la evaluacion</span>
                                    </div>
                                </div>
                         
                 
                                   <div class="control-group">
                                    <label class="control-label">Tipo</label>
                                    <div class="controls">
                                        <?php echo form_input (array('descripcion' => 'descripcion', 'name' => 'descripcion', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->descripcion); ?> 
                                        
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Instrucciones</label>
                                    <div class="controls">
                                        <?php echo form_input(array('id' => 'instrucciones', 'name' => 'instrucciones', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->instrucciones); ?>
                                        <span class="help-inline">Detalla las instrucciones</span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Objetivo</label>
                                    <div class="controls">
                                        <?php echo form_input(array('objetivo' => 'objetivo', 'name' => 'objetivo', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->objetivo); ?>
                                        <span class="help-inline">Detalla el Objetivo</span>
                                    </div>
                                </div>
                         
                              <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                                </div>
                         <?php echo form_hidden('id', $row->id);?>
                         
                         <?php echo form_close(); ?>
                         


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>