                 <div class="span6">
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
	$atributos = array('id' => 'guardar_obser');
    echo form_open('pendientes/guardar_obser', $atributos);
 $data_ob = array(
              'name'        => 'observa',
              'id'          => 'observa',
              'value'       => '',
              'maxlength'   => '255',
              'size'        => '255',
              'type'        => 'text'
              
            );

?>
 <table>
<tr>

 
<tr>
    <td align="left" ><font size="+1">Pendiente.: </font></td>
    <td><?php echo $pendientes;?></td>
</tr>

<tr>
    <td align="left" ><font size="+1">Observacion.: </font></td>
    <td><?php echo form_textarea($data_ob, "", 'required');?></td>
</tr>
<tr>
	<td align="left" ><font size="+1">Libera: </font></td>
    <td align="left"> 
    <select name="libera" id="libera">
    <option value="0" > <?php if($libera=='0')?>Pendiente</option>
    <option value="1" > <?php if($libera=='1')?>Liberado</option>
    </select>
    </td>
</tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'GUARDAR');?></td>
</tr>
<?php   
foreach($a->result()as $r){
?> 
<tr>
<td colspan="2"><?php echo $r->observa;?></td>
<td colspan="2"><?php echo $r->fec_created;?></td>
</tr>   
<?php }
?>
</table>
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
  <?php
 
	echo form_close();
  ?>


<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>