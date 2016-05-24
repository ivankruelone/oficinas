
<div align="center">

<?php
    $atributos = array('id' => '#nueva_secuencia');
	echo form_open('maestro/submit_nueva_secuencia', 'id="secuencia"');
     
    $data_secuencia = array(
              'name'        => 'secuencia',
              'id'          => 'secuencia',
              'size'        => '30',
              'type'        => 'text',
              'autofocus'   => 'autofocus',
              'required'    => 'required'
      
                );
    
    $data_sustanciaActiva = array(
              'name'        => 'sustanciaActiva',
              'id'          => 'sustanciaActiva',
              'size'        => '250',
              'type'        => 'text',
              'required'    => 'required'
     
                 );
            
     $data_ventaDrd = array(
              'name'        => 'ventaDrd',
              'id'          => 'ventaDrd',
              'size'        => '30',
              'type'        => 'text',
              'required'    => 'required'
              
                );
              
     $data_ventaGen = array(
              'name'        => 'ventaGen',
              'id'          => 'ventaGen',
              'size'        => '30',
              'type'        => 'text',
              'required'    => 'required'
              
                );
                              
     $data_ventaFen = array(
              'name'        => 'ventaFen',
              'id'          => 'ventaFen',
              'size'        => '30',
              'type'        => 'text',
              'required'    => 'required'
     
                );
            
     $data_ventaFbo = array(
              'name'        => 'ventaFbo',
              'id'          => 'ventaFbo',
              'size'        => '30',
              'type'        => 'text',
              'required'    => 'required'
     
                );
    ?>
<table>
<th colspan="2" align="center">AGREGAR UNA NUEVA SECUENCIA</th>
<tr>
	<td align="left" ><font size="+1"><strong>Secuencia: </strong></font></td>
    <td align="left"> <?php echo form_input($data_secuencia, ""); ?></td>
 </tr>
<tr>
    <td align="left" ><font size="+1"><strong>Sustancia Activa: </strong></font></td>
    <td align="left"> <?php echo form_input($data_sustanciaActiva, ""); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Venta Doctor Descuento: </strong></font></td>
    <td align="left"> <?php echo form_input($data_ventaDrd, ""); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Venta Generico: </strong></font></td>
    <td align="left"> <?php echo form_input($data_ventaGen, ""); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Venta Fenix: </strong></font></td>
    <td align="left"> <?php echo form_input($data_ventaFen, "");?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Venta Farmabodega: </strong></font></td>
    <td align="left"> <?php echo form_input($data_ventaFbo, "");?></td>
</tr>
</table>

	<input type="submit" value="AGREGAR" class="button-link blue" />

    

<?php
	echo form_close();
?>