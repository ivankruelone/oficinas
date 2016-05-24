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
                         
                         <?php echo form_open('examen/editarMaster_submit', array('class' => 'form-horizontal'));?>
                         
                                <div class="control-group">
                                    <label class="control-label">Master</label>
                                    <div class="controls">
                                        <?php echo form_input(array('id' => 'x', 'name' => 'x', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered', 'disabled' => true), $row->x); ?>
                                        <span class="help-inline">Numero de master</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Liberar</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('liberar', $liberar, $row->liberar, 'class="input-large m-wrap"');?>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                                </div>
                         <?php echo form_hidden('x', $row->x);?>
                         
                         <?php echo form_close(); ?>
                         


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
