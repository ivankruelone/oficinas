                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Blank Page </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php
	$atributos = array('id' => 'generar');
    echo form_open('pedido/generar_sumit', $atributos);
    $data_pass = array(
              'name'        => 'pass',
              'id'          => 'pass',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15',
              'type'        =>'password'
              
            );
  
  ?>
 
  <table>
<tr>
<tr>
	<td align="left" ><font size="+1">PASSWORD: </font></td>
    <td><?php echo form_input($data_pass, "", 'required');?></td>
	<td align="left" ><font size="+1"><strong>ALMACEN: </strong></font></td>
	<td align="left"><?php echo form_dropdown('alm', $alm, '', 'id="alm"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>DIAS LETRA A: </strong></font></td>
	<td align="left"><?php echo form_dropdown('por1', $por1, '', 'id="por1"') ;?> </td>
 	<td align="left" ><font size="+1"><strong>DIAS LETRA B: </strong></font></td>
	<td align="left"><?php echo form_dropdown('por2', $por2, '', 'id="por2"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>DIAS LETRA C: </strong></font></td>
	<td align="left"><?php echo form_dropdown('por3', $por3, '', 'id="por3"') ;?> </td>
	<td align="left" ><font size="+1"><strong>DIAS LETRA D: </strong></font></td>
	<td align="left"><?php echo form_dropdown('por4', $por4, '', 'id="por4"') ;?> </td>
 </tr>
  <tr>
	<td align="left" ><font size="+1"><strong>DIAS LETRA E: </strong></font></td>
	<td align="left"><?php echo form_dropdown('por5', $por5, '', 'id="por5"') ;?> ESTAN LAS CLAVES NUEVAS </td>
 </tr>


	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
  ?>

<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>