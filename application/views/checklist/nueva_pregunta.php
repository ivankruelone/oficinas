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
                         
                         <?php echo form_open('checklist/nueva_pregunta_submit', array('class' => 'form-horizontal'));?>
                         

                               
                                <div class="control-group">
                                    <label class="control-label">Nueva Pregunta</label>
                                    <div class="controls">
                                        <?php echo form_input(array('pregunta' => 'pregunta', 'name' => 'pregunta', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered')); ?>
                                        <span class="help-inline"></span>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label">Tipo</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('tipo', $tipos,"","id = 'tipo'");?>
                                    </div>
                                </div>
           
                                <div class="control-group">
                                    <label class="control-label">Tipo de Farmacia</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('tipo3', $tipo3, null,"id = 'tipo3'");?>
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                                </div>
                         
                         <?php echo form_hidden('id', $id);?>
                         <?php echo form_close(); ?>
                         


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 