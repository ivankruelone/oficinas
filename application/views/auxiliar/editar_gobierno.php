
<div align="center">
  <?php
  
    echo form_open('maestro/actualiza_gobierno', 'id="clave"');
    
    $data_nombreGenerico = array(
              'name'        => 'nombreGenerico',
              'id'          => 'nombreGenerico',
              'type'        => 'text',
              'value'       => $row->nombreGenerico
              
                );

    $data_formaFarmaceutica = array(
              'name'        => 'formaFarmaceutica',
              'id'          => 'formaFarmaceutica',
              'type'        => 'text',
              'value'       => $row->formaFarmaceutica
              
                );
                
    $data_concentracion = array(
              'name'        => 'concentracion',
              'id'          => 'concentracion',
              'type'        => 'text',
              'value'       => $row->concentracion
              
                );            
    
    $data_presentacion = array(
              'name'        => 'presentacion',
              'id'          => 'presentacion',
              'type'        => 'text',
              'value'       => $row->presentacion
              
                );
    
    $data_unidadMedida = array(
              'name'        => 'unidadMedida',
              'id'          => 'unidadMedida',
              'type'        => 'text',
              'value'       => $row->unidadMedida
              
                );
                
    $data_envase = array(
              'name'        => 'envase',
              'id'          => 'envase',
              'type'        => 'text',
              'value'       => $row->envase
                
    )            
    
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
    <td align="left" ><font size="+1"><strong>Nombre Generico </strong></font></td>
    <td align="left"> <?php echo form_input($data_nombreGenerico, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Forma Farmaceutica </strong></font></td>
    <td align="left"> <?php echo form_input($data_formaFarmaceutica, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Concentracion </strong></font></td>
    <td align="left"> <?php echo form_input($data_concentracion, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Presentacion </strong></font></td>
    <td align="left"> <?php echo form_input($data_presentacion, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Unidad de Medida </strong></font></td>
    <td align="left"> <?php echo form_input($data_unidadMedida, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Envase </strong></font></td>
    <td align="left"> <?php echo form_input($data_envase, "", 'required'); ?></td>
</tr>
    <td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>
</table>
  <?php
    echo form_hidden('clave', $clave);
	echo form_close();
  ?>
 


</div>