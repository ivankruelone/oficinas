<?php
    $row = $query->row(); 
	$row2 = $query2->row();
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
                         
                         <h2><?php echo $row2->reactivo; ?></h2>
                         
                         <?php echo form_open('examen/editarOpcion_submit', array('class' => 'form-horizontal'));?>
                         
                                <div class="control-group">
                                    <label class="control-label">Opcion</label>
                                    <div class="controls">
                                        <?php echo form_input(array('id' => 'opcion', 'name' => 'opcion', 'type' => 'text', 'class' => 'input-xxlarge', 'required' => 'requiered'), $row->opcion); ?>
                                        <span class="help-inline">Esta sera una de las opciones de respuesta.</span>
                                    </div>
                                </div>

                                <div class="control-group">
                         
                                <div class="form-actions">
                                    <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                                </div>
                                
                         <?php echo form_hidden('examenID', $examenID);?>
                         <?php echo form_hidden('reactivoID', $reactivoID);?>
                         <?php echo form_hidden('opcionID', $opcionID);?>
                         
                         <?php echo form_close(); ?>
                         


<!---->
 
                          
                         </div>
                     </div>
 <!-- END BLANK PAGE PORTLET-->
                     
                 </div>
                 
