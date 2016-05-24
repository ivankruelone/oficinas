                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
<?php
	$atributos = array('id' => 'sumit_aferta_gen');
    echo form_open('ofertas/sumit_aferta_gen', $atributos);
$data_fec = array(
              'name'        => 'fec',
              'id'          => 'fec',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
            ); 
$data_inca = array(
              'name'        => 'inca',
              'id'          => 'inca',
              'value'       => ' ',
              'maxlength'   => '10',
              'size'        => '10'
            );
$data_dias = array(
              'name'        => 'dias',
              'id'          => 'dias',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            ); 
  ?>
                            <table> 
                                    <tr>
                                    <td>Sucursal</td>
                                    <td align="left"><?php echo form_dropdown('suc', $suc, '', 'id="suc"') ;?> </td>
                                    </tr>
                                    <tr> 
                                    <td>Empleado</td>
                                    <td colspan="2"><select name="nomina" id="nomina" style="width:100%"></select></td>
                                    </tr>
  <?php if($clave==644 || $clave==519 || $clave==520 || $clave==535 || $clave==519 || $clave==543 || $clave==544) {?>
                                    <tr>
                                    <td>Fecha </td>
                                    <td align="left"><?php echo form_input($data_fec, "", 'required');?></td>
                                    </tr>
  <?php }?>
  <?php if($clave==333 || $clave==331) {?>
                                    <tr>
                                    <td>Fecha </td>
                                    <td align="left"><?php echo form_dropdown('fec', $fec, '', 'id="fec"') ;?> </td>
                                    </tr>
 <?php }?>
  <?php if($clave==644) {?>
                                    <tr>
                                    <td>Folio de incapacidad</td>
                                    <td align="left"><?php echo form_input($data_inca, "", 'required');?></td>
                                    </tr>
                                    <tr>
                                    <td>Dias</td>
                                    <td align="left"><?php echo form_input($data_dias, "", 'required');?></td>
                                    </tr>
  <?php }?>
  <?php if($clave==519 || $clave==520 || $clave==535 || $clave==519 || $clave==543 || $clave==544) {?>
                                    <tr>
                                    <td>Importe</td>
                                    <td align="left"><?php echo form_input($data_importe, "", 'required');?></td>
                                    </tr>
  <?php }?>
                                    
                                   
                               </table>

  <?php
 
	echo form_close();
  ?>
</div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>