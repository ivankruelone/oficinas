
<div align="center">

<?php
    echo form_open('maestro/submit_laboratorio', 'id="idLaboratorio"');
     
    $data_idLaboratorio = array(
              'name'        => 'idLaboratorio',
              'id'          => 'idLaboratorio',
              'size'        => '30',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
      
                );
    
    $data_laboratorio = array(
              'name'        => 'laboratorio',
              'id'          => 'laboratorio',
              'size'        => '250',
              'type'        => 'text',
              'required'    => 'required'
     
                 );             
    
    ?>
<table>
<th colspan="2" align="center">AGREGAR NUEVO LABORATORIO</th>
<tr>
	<td align="left" ><font size="+1"><strong>ID Laboratorio: </strong></font></td>
    <td align="left"> <?php echo form_input($data_idLaboratorio, ""); ?></td>
 </tr>
<tr>
    <td align="left" ><font size="+1"><strong>Laboratorio: </strong></font></td>
    <td align="left"> <?php echo form_input($data_laboratorio, ""); ?></td>
</tr>

</table>

	<input type="submit" value="AGREGAR" class="button-link blue" />

    

<?php
	echo form_close();
?>