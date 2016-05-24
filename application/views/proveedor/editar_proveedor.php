  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('idProveedor' => 'editar_proveedor');
    echo form_open('maestro/actualiza_proveedor', $atributos);
    
    $data_rfc = array(
              'name'        => 'rfc',
              'id'          => 'rfc',
              'size'        => '13',
              'value'       => $row->rfc
              
                );

    $data_razonSocial = array(
              'name'        => 'razonSocial',
              'id'          => 'razonSocial',
              'type'        => 'text',
              'value'       => $row->razonSocial
              
                );
                
    $data_limiteCredito = array(
              'name'        => 'limiteCredito',
              'id'          => 'limiteCredito',
              'size'        => '9',
              'value'       => $row->limiteCredito
              
                );            
    
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
    <td align="left" ><font size="+1"><strong>Rfc </strong></font></td>
    <td align="left"> <?php echo form_input($data_rfc, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Razon Social </strong></font></td>
    <td align="left"> <?php echo form_input($data_razonSocial, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Limite de Credito </strong></font></td>
    <td align="left"> <?php echo form_input($data_limiteCredito, "", 'required'); ?></td>
</tr>
    <td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>
</table>
  <?php
    echo form_hidden('idProveedor', $idProveedor);
	echo form_close();
  ?>
  
  <div>
  
  
  
  </div>


</div>