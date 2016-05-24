<div class="span6">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                          <div align="center">
                                                   <?php
	$atributos = array('id' => 'a_orden_segpop_nivel_s_prv_rango');
    echo form_open('orden/a_orden_segpop_nivel_s_prv_rango', $atributos);
    $data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'class'       => 'span3',
              'value'       => $fec1,
              'maxlength'   => '10',
              'size'        => '10'
            );
    $data_fec2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'class'       => 'span3',
              'value'       => $fec2,
              'maxlength'   => '10',
              'size'        => '10'
            );
   ?>
 
  <table>
                    <div class="control-group">
                                <label class="control-label">Selecciona Rango de Fechas: </label>
                                <div class="controls">
                                <?php echo form_input($data_fec1, "", 'required');?>
                                AL
                                <?php echo form_input($data_fec2, "", 'required');?>
                                </div>
                            </div>
                    <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls">
                                <?php echo form_submit('envio', 'aceptar');?>
                                </div>
                            </div>
</table>
  <?php
	echo form_close();
  ?>

                        
                         </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                         

                 </div>