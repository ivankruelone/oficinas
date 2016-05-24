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
                         
                         <?php echo form_open('checklist/comentarios_observaciones_submit', array('class' => 'form-horizontal'));?>
                         
                         <div class="control-group">
                                    <label class="control-label">Observaciones (Oficinas)</label>
                                    <div class="controls">
                                        <?php echo form_input(array('observaciones' => 'observaciones', 'name' => 'observaciones', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->observaciones); ?>
                                        <span class="help-inline">Ingresa alguna Observacion</span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Comentarios (Sucursal)</label>
                                    <div class="controls">
                                        <?php echo form_input(array('comentarios' => 'comentarios', 'name' => 'comentarios', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->comentarios); ?>
                                        <span class="help-inline">Ingresa un comentario</span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Seguimiento de Revision Anterior:</label>
                                    <div class="controls">
                                        <?php echo form_input(array('seguimiento' => 'seguimiento', 'name' => 'seguimiento', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->seguimiento); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                         
                              <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                                
                                    
                                </div>
                             
                             <?php echo form_hidden('periodoID', $row->periodoID);?>
                             <?php echo form_hidden('periodo_sucursalID', $row->periodo_sucursalID);?>
                             <?php echo form_hidden('suc', $row->suc);?>
                             <?php echo form_hidden('realizado', $row->realizado);?>
                    
                         <?php echo form_close(); ?>
                         


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div> 