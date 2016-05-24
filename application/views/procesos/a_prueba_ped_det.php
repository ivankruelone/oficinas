                 <div class="span6">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php
	$atributos = array('id' => 'sumit_prueba_ped_det_pro');
    echo form_open('procesos/sumit_prueba_ped_det_pro', $atributos);
 $data_ean = array(
              'name'        => 'ean',
              'id'          => 'ean',
              'class'       => 'span4',
              'type'        => 'number',
              'required'    => 'required',
              'autofocus'   => 'autofocus',
              'maxlength'   => '15'
     
                 );
                 
 

  
  ?>
 
  <table>

                            <div class="control-group">
                                <label class="control-label">Codigo de Barras: </label>
                                <div class="controls">
                                    <?php echo form_input($data_ean); ?>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Descripci&oacute;n: </label>
                                <div class="controls">
                                    <span class="help-inline" id="descripcion"></span>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn blue"><i class="icon-ok"></i> Guardar</button>
                            </div>

                            <?php echo form_close(); ?>
</table>
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
  <?php
 
	echo form_close();
  ?>


<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>