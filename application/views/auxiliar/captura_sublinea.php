
<div align="center">

<?php
    echo form_open('maestro/submit_sublinea', 'id="idLinea"');
     
    
    $data_idSublinea = array(
              'name'        => 'idSublinea',
              'id'          => 'idSublinea',
              'size'        => '250',
              'type'        => 'text',
              'required'    => 'required'
     
                 );
                 
     $data_sublinea = array(
              'name'        => 'sublinea',
              'id'          => 'sublinea',
              'size'        => '250',
              'type'        => 'text',
              'required'    => 'required'
     
                 );             
    
    ?>
<table>
<th colspan="2" align="center">AGREGAR UNA NUEVA SUBLINEA</th>
<tr>
	<td align="left" ><font size="+1"><strong>ID Linea: </strong></font></td>
    <td align="left"> <?php echo form_dropdown('idLinea', $linea, null, 'id="idLinea"'); ?></td>
 </tr>
<tr>
    <td align="left" ><font size="+1"><strong>ID Sublinea: </strong></font></td>
    <td align="left"> <?php echo form_input($data_idSublinea, ""); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Sublinea: </strong></font></td>
    <td align="left"> <?php echo form_input($data_sublinea, ""); ?></td>
</tr>

</table>

	<input type="submit" value="AGREGAR" class="button-link blue" />

    

<?php
	echo form_close();
?>