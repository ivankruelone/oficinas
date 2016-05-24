
<div align="center">
  <?php
  
    echo form_open('maestro/actualiza_linea', 'id="idLinea"');
    
    $data_linea = array(
              'name'        => 'linea',
              'id'          => 'linea',
              'type'        => 'text',
              'value'       => $row->linea
              
                );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
    <td align="left" ><font size="+1"><strong>Linea </strong></font></td>
    <td align="left"> <?php echo form_input($data_linea, "", 'required'); ?></td>
</tr>
<tr>
    <td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>
</table>
  <?php
    echo form_hidden('idLinea', $idLinea);
	echo form_close();
  ?>
 


</div>