
<div align="center">
  <?php
  
    echo form_open('maestro/actualiza_sublinea', 'id="idLinea"');
    
    $data_idSublinea = array(
              'name'        => 'idSublinea',
              'id'          => 'idSublinea',
              'type'        => 'text',
              'value'       => $row->idSublinea
              
                );
    
    $data_sublinea = array(
              'name'        => 'sublinea',
              'id'          => 'sublinea',
              'type'        => 'text',
              'value'       => $row->sublinea
              
                );
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>ID Sublinea </strong></font></td>
    <td align="left"> <?php echo form_input($data_idSublinea, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Sublinea </strong></font></td>
    <td align="left"> <?php echo form_input($data_sublinea, "", 'required'); ?></td>
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