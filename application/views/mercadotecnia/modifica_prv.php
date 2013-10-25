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
	$atributos = array('id' => 'sumit_cambia_prv');
    echo form_open('mercadotecnia/sumit_cambia_prv', $atributos);
    
    $data_razo = array(
              'name'        => 'razo',
              'id'          => 'razo',
              'value'       => $razo,
              'maxlength'   => '40',
              'size'        => '40'
              
            );
    $data_dire= array(
              'name'        => 'dire',
              'id'          => 'dire',
              'value'       => $dire,
              'maxlength'   => '50',
              'size'        => '50'
              
            );
    $data_cp= array(
              'name'        => 'cp',
              'id'          => 'cp',
              'value'       => $cp,
              'maxlength'   => '5',
              'size'        => '5'
              
            );
    $data_pobla= array(
              'name'        => 'pobla',
              'id'          => 'pobla',
              'value'       => $pobla,
              'maxlength'   => '30',
              'size'        => '30'
              
            );
    $data_rfc= array(
              'name'        => 'rfc',
              'id'          => 'rfc',
              'value'       => $rfc,
              'maxlength'   => '20',
              'size'        => '20'
              
            );
    $data_corto= array(
              'name'        => 'corto',
              'id'          => 'corto',
              'value'       => $corto,
              'maxlength'   => '15',
              'size'        => '15'
              
            );
     $data_tel= array(
              'name'        => 'tel',
              'id'          => 'tel',
              'value'       => $tel,
              'maxlength'   => '20',
              'size'        => '20'
              
            );
  
  ?>
 
  <table>
<tr>
<tr>
    <td align="left" ><font size="+1"><strong>Prv: </strong></font></td>
	<td><?php echo  $prov?></td>
	<td align="left" ><font size="+1">Provedor: </font></td>
    <td><?php echo form_input($data_razo, "", 'required');?></td>
    <td align="left" ><font size="+1">Direccion: </font></td>
    <td><?php echo form_input($data_dire, "", 'required');?></td>
</tr>
<tr>
    <td align="left" ><font size="+1">CP: </font></td>
    <td><?php echo form_input($data_cp, "", 'required');?></td>
    <td align="left" ><font size="+1"><strong>Poblacion: </strong></font></td>
	<td><?php echo form_input($data_pobla, "", 'required');?></td>
	<td align="left" ><font size="+1">RFC: </font></td>
    <td><?php echo form_input($data_rfc, "", 'required');?></td>
 </tr>
<tr>
    <td align="left" ><font size="+1">Telefono: </font></td>
    <td><?php echo form_input($data_tel, "", 'required');?></td>
    <td align="left" ><font size="+1">Nombre Corto: </font></td>
    <td><?php echo form_input($data_corto, "", 'required');?></td>
 </tr> 


	<td colspan="2"align="center"><?php echo form_submit('envio', 'CAMBIAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $prov?>" name="prov" id="prov" />
  <?php
 
	echo form_close();
  ?>


<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>