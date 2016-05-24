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
	$atributos = array('id' => 'sumit_cambia_orden_det');
    echo form_open('orden/sumit_cambia_orden_det2', $atributos);
    $data_canp = array(
              'name'        => 'canp',
              'id'          => 'canp',
              'value'       => $canp,
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
              'maxlength'   => '9',
              'size'        => '9'
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
    <td align="left" ><font size="+1"><strong>Clave Gob: </strong></font></td>
	<td><?php echo $clagob?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Sustancia Activa: </strong></font></td>
	<td><?php echo $susa1?></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Descripcion: </strong></font></td>
	<td><?php echo $susa2?></td>
</tr>
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

	<td colspan="2"align="center"><?php echo form_submit('envio', 'CAMBIAR DATOS');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $clagob?>" name="clagob" id="clagob" />
<input type="hidden" value="<?php echo $sec?>" name="sec" id="sec" />
<input type="hidden" value="<?php echo $id_orden?>" name="id_orden" id="id_orden" />
<input type="hidden" value="<?php echo $id_detalle?>" name="id_detalle" id="id_detalle" />
<input type="hidden" value="<?php echo $folprv?>" name="folprv" id="folprv" />
<input type="hidden" value="<?php echo $edo?>" name="edo" id="edo" />
<input type="hidden" value="<?php echo $id_estado?>" name="id_estado" id="id_estado" />
<input type="hidden" value="<?php echo $base?>" name="base" id="base" />
<input type="hidden" value="<?php echo $id_compraped?>" name="id_compraped" id="id_compraped" />
  <?php
	echo form_close();
  ?>

                        
                         </div>
                         </div>
                     <!-- END BLANK PAGE PORTLET-->
                 
                         

                 </div>