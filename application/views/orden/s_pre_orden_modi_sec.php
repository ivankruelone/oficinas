<div class="span6">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                          <div align="center">
                                                   <?php
	$atributos = array('id' => 'sumit_cambia_pre_orden');
    echo form_open('orden/sumit_cambia_pre_orden', $atributos);
    $data_compra = array(
              'name'        => 'compra',
              'id'          => 'compra',
              'value'       => $compra,
              'maxlength'   => '7',
              'size'        => '7'
            );
    $data_costo = array(
              'name'        => 'costo',
              'id'          => 'costo',
              'value'       => $costo,
              'maxlength'   => '9',
              'size'        => '9'
            );
    $data_descu = array(
              'name'        => 'descu',
              'id'          => 'descu',
              'value'       => $descu,
              'maxlength'   => '7',
              'size'        => '7'
            );
    
   ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Sec: </strong></font></td>
	<td><?php echo $sec;?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Sustanci Activa: </strong></font></td>
	<td><?php echo $susa?></td>
</tr>
<tr>
<td align="left" ><font size="+1"><strong>Proveedor: </strong></font></td>
<td align="left"><?php echo form_dropdown('prv', $prv, '', 'id="prv"') ;?> </td>
</tr>

 <tr>
	<td align="left" ><font size="+1"><strong>Cantidad: </strong></font></td>
	<td><?php echo form_input($data_compra, "", 'required');?></td>
 </tr>
  <tr>
	<td align="left" ><font size="+1"><strong>Costo: </strong></font></td>
	<td><?php echo $costo;?></td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>Descu: </strong></font></td>
	<td><?php echo form_input($data_descu, "", 'required');?></td>
 </tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'CAMBIAR DATOS');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_pre_orden?>" name="id_pre_orden" id="id_pre_orden" />
<input type="hidden" value="<?php echo $id?>" name="id" id="id" />
<input type="hidden" value="<?php echo $sec?>" name="sec" id="sec" />
  <?php
	echo form_close();
  ?>

                        
                         </div>
                         </div>
                     <!-- END BLANK PAGE PORTLET-->
                 
                         

                 </div>