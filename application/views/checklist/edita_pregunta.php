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
                         
                         <?php echo form_open('checklist/edita_pregunta_submit', array('class' => 'form-horizontal'));?>
                         
                         <div class="control-group">
                                    <label class="control-label">Pregunta</label>
                                    <div class="controls">
                                        <?php echo form_input(array('pregunta' => 'pregunta', 'name' => 'pregunta', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->pregunta); ?>
                                        <span class="help-inline">Modificar Pregunta</span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Tipo</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('tipo', $tipos, $row->tipo,"id = 'tipo'");?>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Vale</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('vale', $vale,$row->vale,"id = 'vale'");?>
                                    </div>
                                </div>
                         
                         <div class="control-group">
                                    <label class="control-label">Tipo de Farmacia</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('tipo3', $tipo3, $row->tipo3,"id = 'tipo3'");?>
                                    </div>
                                </div>
                         
                         <div class="control-group">
                                    <label class="control-label">Observaciones</label>
                                    <div class="controls">
                                       <?php echo form_input(array('observaciones' => 'observaciones', 'name' => 'observaciones', 'type' => 'text', 'class' => 'input-xxlarge'), $row->observaciones); ?>
                                        <span class="help-inline">Agrega una Observaciones</span>
                                    </div>
                                </div>
                                
                              <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                                </div>
                            <?php echo form_hidden('id', $row->id);?>
                          <?php echo form_hidden('idpregunta', $row->idpregunta);?>
                         
                         <?php echo form_close(); ?>
                         


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>