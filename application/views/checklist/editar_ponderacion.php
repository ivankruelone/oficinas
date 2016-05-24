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
                         
                         <?php echo form_open('checklist/editar_ponderacion_submit', array('class' => 'form-horizontal'));?>
                         
                         <div class="control-group">
                                    <label class="control-label">Tipo Farmacia</label>
                                    <div class="controls">
                                        <?php echo form_input(array('tipoFarmacia' => 'tipoFarmacia', 'name' => 'tipoFarmacia', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->tipoFarmacia); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                         
                 
                                   <div class="control-group">
                                    <label class="control-label">Valor</label>
                                    <div class="controls">
                                        <?php echo form_input (array('valor' => 'valor', 'name' => 'valor', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->valor); ?> 
                                        
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Calificacion</label>
                                    <div class="controls">
                                        <?php echo form_input(array('id' => 'calificacion', 'name' => 'calificacion', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->calificacion); ?>
                                        <span class="help-inline">Detalla la Calificacion</span>
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