
<div align="center">

<?php
    echo form_open('maestro/submit_linea', 'id="idLinea"');
     
    $data_idLinea = array(
              'name'        => 'idLinea',
              'id'          => 'idLinea',
              'size'        => '30',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
      
                );
    
    $data_linea = array(
              'name'        => 'linea',
              'id'          => 'linea',
              'size'        => '250',
              'type'        => 'text',
              'required'    => 'required'
     
                 );
    
    ?>
<table>
<th colspan="2" align="center">AGREGAR UNA NUEVA LINEA</th>
<tr>
	<td align="left" ><font size="+1"><strong>ID Linea: </strong></font></td>
    <td align="left"> <?php echo form_input($data_idLinea, ""); ?></td>
 </tr>
<tr>
    <td align="left" ><font size="+1"><strong>Linea: </strong></font></td>
    <td align="left"> <?php echo form_input($data_linea, ""); ?></td>
</tr>

</table>

	<input type="submit" value="AGREGAR" class="button-link blue" />

    

<?php
	echo form_close();
?>