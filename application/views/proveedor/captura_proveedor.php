
<div align="center">

<?php
    echo form_open('maestro/submit_proveedor', 'id="idProveedor"');
     
    $data_idProveedor = array(
              'name'        => 'idProveedor',
              'id'          => 'idProveedor',
              'size'        => '30',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
      
                );
    
    $data_rfc = array(
              'name'        => 'rfc',
              'id'          => 'rfc',
              'size'        => '13',
              'type'        => 'text',
              'required'    => 'required'
     
                 );
                 
    $data_razonSocial = array(
              'name'        => 'razonSocial',
              'id'          => 'razonSocial',
              'size'        => '13',
              'type'        => 'text',
              'required'    => 'required'
     
                 );
                 
    $data_limiteCredito = array(
              'name'        => 'limiteCredito',
              'id'          => 'limiteCredito',
              'size'        => '13',
              'type'        => 'text',
              'required'    => 'required'
     
                 );             
                                           
    
    ?>
<table>
<th colspan="2" align="center">AGREGAR NUEVO PROVEEDOR</th>
<tr>
	<td align="left" ><font size="+1"><strong>ID Proveedor: </strong></font></td>
    <td align="left"> <?php echo form_input($data_idProveedor, ""); ?></td>
 </tr>
<tr>
    <td align="left" ><font size="+1"><strong>Rfc: </strong></font></td>
    <td align="left"> <?php echo form_input($data_rfc, ""); ?></td>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>Razon Social: </strong></font></td>
    <td align="left"> <?php echo form_input($data_razonSocial, ""); ?></td>
 </tr>
<tr>
    <td align="left" ><font size="+1"><strong>Limite de Credito: </strong></font></td>
    <td align="left"> <?php echo form_input($data_limiteCredito, ""); ?></td>
</tr>
</table>

	<input type="submit" value="AGREGAR" class="button-link blue" />

    

<?php
	echo form_close();
?>