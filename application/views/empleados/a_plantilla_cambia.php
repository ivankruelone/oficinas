<div class="span5">
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
	$atributos = array('id' => 'sumit_cambia_plantilla');
    echo form_open('empleados/sumit_cambia_plantilla', $atributos);
    $data_plantilla = array(
              'name'        => 'plantilla',
              'id'          => 'plantilla',
              'value'       => $plantilla,
              'class'       =>'span3',
              'maxlength'   => '4',
              'autofocus'   => 'autofocus'
            );
    $data_plantilla_med = array(
              'name'        => 'plantilla_med',
              'id'          => 'plantilla_med',
              'value'       => $plantilla_med,
              'class'       =>'span3',
              'maxlength'   => '4'
              
            );
    
   ?>
  <table>
 <tr>
 <td></td><td></td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>Plantilla de Farmacia: </strong></font></td>
	<td><?php echo form_input($data_plantilla, "", 'required');?></td>
 </tr>
<tr>
	<td align="left" ><font size="+1"><strong>Plantilla de Medicos: </strong></font></td>
	<td><?php echo form_input($data_plantilla_med, "", 'required');?></td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>Turno: </strong></font></td>
	<td align="left"><?php echo form_dropdown('turno', $turno, '', 'id="turno"') ;?> </td>
 </tr>
<tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'Cambia Datos');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $suc?>" name="suc" id="suc" />
  <?php
	echo form_close();
  ?>

                   
                         </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                         

                 </div>