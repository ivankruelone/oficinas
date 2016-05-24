 <div class="span12">
    <!-- BEGIN BLANK PAGE PORTLET-->
     
      <div class="widget blue">
          <div class="widget-title">
            <h4><?php echo $titulo?></h4>
              <span class="tools">
                <a href="javascript:;" class="icon-chevron-down"></a>
              </span>
           </div>

            <div class="widget-body">
                       
          <?php echo form_open ("/empleados/c_actualizar_observ", array('class' => 'form-horizontal')); ?>
          <?php echo nl2br($nomina->nomina) ?>
          <?php 

              $observacion =array(
              'name' => 'observ',
              'placeholder'=>'escribe la observacion'
               );

              $nomina =array(
              'type' => 'hidden',
              'name' => 'nomina',
              'value'=>$nomina->nomina,
               );

               $data = array(
               'name'        => 'suc',
               'value'       => 1,
               'checked'     => (set_value('suc') === '1' ? TRUE : FALSE)
                );
                  
                $datano = array(
                'name'        => 'suc',
                'value'       => 0,
                'checked'     => (set_value('suc') === '0' ? TRUE : FALSE)
                  );
             ?>


                <td align="left" ><font size=""><strong><?php echo nl2br($completo->completo) ?></strong></font></td>
 
                <?php echo form_input($nomina) ?>
                 
                  <br><br>
                  <td>
                  <?php echo form_label('Activo:','activo') ?>
                  <?php echo form_label('Si','si') ?>                            
                  <?php echo form_radio($data) ?>                            
                  <?php echo form_label('No','no') ?>
                  <?php echo form_radio($datano) ?>
                  </td>
                    <br><br>

                  <?php echo form_label('Observacion:','observ') ?>
                  <?php echo form_input($observacion) ?>

                  <br><br>
                  <td>

                  <br><br>
                 
                   <?php echo form_submit('','Guardar') ?>

                   <?php echo form_close() ?>                       
                            
             </div>
      
          </div>
    <!-- END BLANK PAGE PORTLET-->
 </div>