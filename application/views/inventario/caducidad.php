<div align="center">

<?php
	$atributos = array('id' => '#motivo');
    echo form_open('inventario/caducidad_submit');
  ?>
  
  <table>
<th colspan="2">Caducados y/o Proximos a Caducar</th>
<tr>
	<td align="left" ><font size="+1"><strong>Caducidad: </strong></font></td>
	<td align="left"><?php echo form_dropdown('id', $caducidad, '', 'id="id"') ;?> </td>
 </tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Enviar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>


</div>