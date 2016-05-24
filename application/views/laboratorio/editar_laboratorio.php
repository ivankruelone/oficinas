
<div align="center">
  <?php
  
    echo form_open('maestro/actualiza_laboratorio', 'id="idLaboratorio"');
    
    $data_laboratorio = array(
              'name'        => 'laboratorio',
              'id'          => 'laboratorio',
              'type'        => 'text',
              'value'       => $row->laboratorio
              
                );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Laboratorio </strong></font></td>
    <td align="left"> <?php echo form_input($data_laboratorio, "", 'required'); ?></td>
</tr>
<tr>
    <td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>
</table>
  <?php
    echo form_hidden('idLaboratorio', $idLaboratorio);
	echo form_close();
  ?>
 


</div>