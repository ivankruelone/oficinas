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
                         
 <?php echo form_open('mantenimiento/observaciones_submit', array('class' => 'form-horizontal'));
  $observacion_personal = array(
              'name'        => 'observacion_personal',
              'id'          => 'observacion_personal',
              'value'       => '',
              'maxlength'   => '200',
              'size'        => '200',
            );

?>

<div class="control-group">

                 <label class="control-label">Detalla El Servicio</label>
                 <div class="controls">
                 
                 <?php echo form_textarea($observacion_personal, 'observacion_personal'); ?>
              
                 <span class="help-inline"></span>
                 </div>
</div> 


<div class="form-actions">

  <input type="hidden" value="<?php echo $orden?>" name="orden" id="orden"/>
  <button type="submit" class="btn blue"><i class="icon-ok"></i>Guardar</button>
                                
                                    
</div>   