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
	$atributos = array('id' => 'sumit_cambia_orden_ctl');
    echo form_open('orden/sumit_cambia_orden_ctl', $atributos);
    $data_fechae = array(
              'name'        => 'fecha',
              'id'          => 'fecha',
              'value'       => $fecha,
              'maxlength'   => '10',
              'size'        => '10'
            );
   ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $titulo1;?></th>
</tr>
    <td align="left" ><font size="+1"><strong>Provedor: </strong></font></td>
	<td align="left"><?php echo form_dropdown('prv', $prv, '', 'id="prv"') ;?> </td>
</tr>

 <tr>
	<td align="left" ><font size="+1"><strong>Almacen: </strong></font></td>
	<td align="left"><?php echo form_dropdown('id_estado', $id_estado, '', 'id="id_estado"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>Licitacion: </strong></font></td>
	<td align="left"><?php echo form_dropdown('licitacion', $licitacion, '', 'id="licitacion"') ;?> </td>
 </tr>
 </tr>
    <td align="left" ><font size="+1"><strong>Domicilio: </strong></font></td>
	<td align="left"><?php echo form_dropdown('consigna', $consigna, '', 'id="consigna"') ;?> </td>
</tr>
 <tr>
    <td align="left" ><font size="+1"><strong>Cia: </strong></font></td>
	<td align="left"><?php echo form_dropdown('cia', $cia, '', 'id="cia"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td><?php echo form_input($data_fechae, "", 'required');?></td>
 </tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'CAMBIAR DATOS');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_orden?>" name="id_orden" id="id_orden" />
<input type="hidden" value="<?php echo $folprv?>" name="folprv" id="folprv" />
<input type="hidden" value="<?php echo $edo?>" name="edo" id="edo" />
<input type="hidden" value="<?php echo $base?>" name="base" id="base" />
<input type="hidden" value="<?php echo $aaa?>" name="aaa" id="aaa" />
<input type="hidden" value="<?php echo $mes?>" name="mes" id="mes" />
  <?php
	echo form_close();
  ?>

                        
                         </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                         

                 </div>