  <blockquote>
    

  </blockquote>
<div align="center">
  <?php
	$atributos = array('secuencia' => 'editar_secuencia');
    echo form_open('maestro/actualiza_secuencia', $atributos);
    
    $data_sustanciaActiva = array(
              'name'        => 'sustanciaActiva',
              'id'          => 'sustanciaActiva',
              'type'        => 'text',
              'value'       => $row->sustanciaActiva
              
                );

    $data_ventaDrd = array(
              'name'        => 'ventaDrd',
              'id'          => 'ventaDrd',
              'size'        => '10',
              'value'       => $row->ventaDrd
              
                );
                
    $data_ventaGen = array(
              'name'        => 'ventaGen',
              'id'          => 'ventaGen',
              'size'        => '20',
              'value'       => $row->ventaGen
              
                );            
    
    $data_ventaFen = array(
              'name'        => 'ventaFen',
              'id'          => 'ventaFen',
              'size'        => '20',
              'value'       => $row->ventaFen
              
                );
    
    $data_ventaFbo = array(
              'name'        => 'ventaFbo',
              'id'          => 'ventaFbo',
              'size'        => '20',
              'value'       => $row->ventaFbo
              
                );
    
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>

<tr>
    <td align="left" ><font size="+1"><strong>Sustacia Activa </strong></font></td>
    <td align="left"> <?php echo form_input($data_sustanciaActiva, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Venta Doctor Descuento </strong></font></td>
    <td align="left"> <?php echo form_input($data_ventaDrd, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Venta Genericos </strong></font></td>
    <td align="left"> <?php echo form_input($data_ventaGen, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Venta Fenix </strong></font></td>
    <td align="left"> <?php echo form_input($data_ventaFen, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Venta Farmabodega </strong></font></td>
    <td align="left"> <?php echo form_input($data_ventaFbo, "", 'required'); ?></td>
</tr>
    <td colspan="2" align="center"><?php echo form_submit('envio', 'Agregar');?></td>
</tr>
</table>
  <?php
    echo form_hidden('secuencia', $secuencia);
	echo form_close();
  ?>
  
  <div>
  
  
  
  </div>


</div>