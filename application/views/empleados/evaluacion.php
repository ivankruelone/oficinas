                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
                         <?php echo form_open('empleados/submit_evaluacion', array('class' => 'form-horizontal')); ?>
                         
                         <?php
                         
                         foreach($areas->result() as $area){
                         
                         ?>
                         
                         <h3 style="font-weight: bolder;"><?php echo $area->descripcion_area; ?></h3>
                         
                         
                         
                         
                         
                         
                         <?php
                         
                            $paso['preguntas'] = $this->empleados_model->getPreguntas($area->area);
                            $this->load->view('empleados/evaluacion_preguntas', $paso);
                         
                         }
                         
                         ?>
                         
                         
                         <div class="control-group">
                            <label class="control-label">OBSERVACIONES COLABORADOR</label>
                            <div class="controls">
                                <textarea class="input-xxlarge" rows="3" name="observaciones_colaborador" required="required"></textarea>
                            </div>
                         </div>
                         
                         <div class="control-group">
                            <label class="control-label">OBSERVACIONES EVALUADOR</label>
                            <div class="controls">
                                <textarea class="input-xxlarge" rows="3" name="observaciones_evaluador" required="required"></textarea>
                            </div>
                         </div>
                         
                         <div class="control-group">
                            <label class="control-label">MOTIVO</label>
                            <div class="controls">
                            
                                <?php echo form_dropdown('motivo', $motivos, null, 'required="required"'); ?>
                                
                            </div>
                         </div>

                          <div class="form-actions">
                            <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                          </div>

                          <?php echo form_hidden('suc', $suc); ?>
                          <?php echo form_hidden('id', $id); ?>
                          
                          <?php echo form_close(); ?>
                         
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>                         