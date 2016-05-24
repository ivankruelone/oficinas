
<div align="center">

<?php
    echo form_open('maestro/submit_gobierno', 'id="clave"');
     
    $data_clave = array(
              'name'        => 'clave',
              'id'          => 'clave',
              'size'        => '30',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
      
                );
    
    $data_nombreGenerico = array(
              'name'        => 'nombreGenerico',
              'id'          => 'nombreGenerico',
              'size'        => '250',
              'type'        => 'text',
              'required'    => 'required'
     
                 );
            
     $data_formaFarmaceutica = array(
              'name'        => 'formaFarmaceutica',
              'id'          => 'formaFarmaceutica',
              'size'        => '30',
              'type'        => 'text',
              'required'    => 'required'
              
                );
              
     $data_concentracion = array(
              'name'        => 'concentracion',
              'id'          => 'concentracion',
              'size'        => '30',
              'type'        => 'text',
              'required'    => 'required'
              
                );
                              
     $data_presentacion = array(
              'name'        => 'presentacion',
              'id'          => 'presentacion',
              'size'        => '30',
              'type'        => 'text',
              'required'    => 'required'
     
                );
            
     $data_unidadMedida = array(
              'name'        => 'unidadMedida',
              'id'          => 'unidadMedida',
              'size'        => '30',
              'type'        => 'text',
              'required'    => 'required'
     
                );
    ?>
<table>
<th colspan="2" align="center">AGREGAR NUEVA CLAVE GOBIERNO</th>
<tr>
	<td align="left" ><font size="+1"><strong>Clave: </strong></font></td>
    <td align="left"> <?php echo form_input($data_clave, ""); ?></td>
 </tr>
<tr>
    <td align="left" ><font size="+1"><strong>Nombre Generico: </strong></font></td>
    <td align="left"> <?php echo form_input($data_nombreGenerico, ""); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Forma Farmaceutica: </strong></font></td>
    <td align="left"> <?php echo form_input($data_formaFarmaceutica, ""); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Concentracion: </strong></font></td>
    <td align="left"> <?php echo form_input($data_concentracion, ""); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Presentacion: </strong></font></td>
    <td align="left"> <?php echo form_input($data_presentacion, "");?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Unidad de Medida: </strong></font></td>
    <td align="left"> <?php echo form_input($data_unidadMedida, "");?></td>
</tr>
</table>

	<input type="submit" value="AGREGAR" class="button-link blue" />

    

<?php
	echo form_close();
?>