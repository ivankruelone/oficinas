
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                          <div align="center">
                                                   <?php
	$atributos = array('id' => 'sumit_agrega_orden_det');
    echo form_open('orden/sumit_agrega_orden_det', $atributos);
    $data_canp = array(
              'name'        => 'canp',
              'id'          => 'canp',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '7'
            );
    $data_costo = array(
              'name'        => 'costo',
              'id'          => 'costo',
              'value'       => '',
              'maxlength'   => '9',
              'size'        => '9'
            );
    $data_descu = array(
              'name'        => 'descu',
              'id'          => 'descu',
              'value'       => '',
              'maxlength'   => '9',
              'size'        => '9'
            );
   ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo;?></th>
</tr>
<?php if($edo=='alm' || $edo=='met'){?>
<tr>
    <td align="left" ><font size="+1"><strong>Producto: </strong></font></td>
	<td align="left"><?php echo form_dropdown('sec', $sec, '', 'id="sec"') ;?> </td>
</tr>

<?php }else{?>
<tr>
    <td align="left" ><font size="+1"><strong>Producto: </strong></font></td>
	<td align="left"><?php echo form_dropdown('clagob', $clagob, '', 'id="clagob"') ;?> </td>
</tr>
<?php } ?>
 <tr>
	<td align="left" ><font size="+1"><strong>Cantidad: </strong></font></td>
	<td><?php echo form_input($data_canp, "", 'required');?></td>
 </tr>
  <tr>
	<td align="left" ><font size="+1"><strong>Costo: </strong></font></td>
	<td><?php echo form_input($data_costo, "", 'required');?></td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>Descu: </strong></font></td>
	<td><?php echo form_input($data_descu, "", 'required');?></td>
 </tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'AGREGA PRODUCTO');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_orden?>" name="id_orden" id="id_orden" />
<input type="hidden" value="<?php echo $id_detalle?>" name="id_detalle" id="id_detalle" />
<input type="hidden" value="<?php echo $folprv?>" name="folprv" id="folprv" />
<input type="hidden" value="<?php echo $edo?>" name="edo" id="edo" />
<input type="hidden" value="<?php echo $base?>" name="base" id="base"/>
  <?php
	echo form_close();
  ?>

                        
                         </div>
                         </div>
                     <!-- END BLANK PAGE PORTLET-->
 