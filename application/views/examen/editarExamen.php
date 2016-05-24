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
                         
                         <?php echo form_open('examen/editarExamen_submit', array('class' => 'form-horizontal'));?>
                         
                                <div class="control-group">
                                    <label class="control-label">Master</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('x', $x, $row->x, 'class="input-large m-wrap"');?>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Nombre de examen</label>
                                    <div class="controls">
                                        <?php echo form_input(array('id' => 'examen', 'name' => 'examen', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->examen); ?>
                                        <span class="help-inline">Como denominarias al examen</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Tiempo</label>
                                    <div class="controls">
                                        <?php echo form_input(array('id' => 'tiempo', 'name' => 'tiempo', 'type' => 'number', 'class' => 'input-mini', 'required' => 'requiered'), $row->tiempo); ?>
                                        <span class="help-inline">Definido en minutos</span>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Tipo</label>
                                    <div class="controls">
                                        <?php echo form_dropdown('tipoID', $tipo, $row->tipoID, 'class="input-large m-wrap"');?>
                                    </div>
                                </div>
                         
                                <div class="control-group">
                                    <label class="control-label">Ponderacion</label>
                                    <div class="controls">
                                        <?php echo form_input(array('id' => 'ponderacion', 'name' => 'ponderacion', 'type' => 'text', 'class' => 'input-medium', 'required' => 'requiered'), $row->ponderacion); ?>
                                        <span class="help-inline">Cuanto vale cada reactivo.</span>
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
                                    <label class="control-label">Ejemplo: </label>
                                    <div class="controls">
                                        <textarea id="ejemplo" name="ejemplo" class="span12 wysihtmleditor5" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                                </div>
                         <?php echo form_hidden('examenID', $row->examenID);?>
                         
                         <?php echo form_close(); ?>
                         


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
