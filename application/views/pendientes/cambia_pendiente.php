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

 <!--FORMA-->
 <?php
	$atributos = array('id' => 'actualiza_p');
    echo form_open('pendientes/actualiza_p', $atributos);
    
    $fecha1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => $fecha_comp,
              'maxlength'   => '10',
              'size'        => '10',
              'type'        => 'date'
              
            );
    $data_pen = array(
              'name'        => 'pen',
              'id'          => 'pen',
              'value'       => $pendientes,
              'maxlength'   => '100',
              'size'        => '100',
              'class'       => 'input-xxlarge'
              
              
            );
    
  ?>
 
  <table>
<tr>

<tr>    
    <td align="left" ><font size="+1">Responsable.: </font></td>
   	<td align="left"><?php echo form_dropdown('res', $res, '', 'id="res"') ;?> </td>
 </tr>
 <tr>
    <td align="left" ><font size="+1">Pendiente.: </font></td>
    <td align="left"><?php echo form_input($data_pen, "", 'required'); ?></td>
</tr>
<tr>
    <td align="left" ><font size="+1">Fecha Compromiso.: </font></td>
    <td align="left"><?php echo form_input($fecha1, "", 'required')?>AAAA-MM-DD</td>
</tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'GUARDAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_cc ?>" name="id_cc" id="id_cc" />
  <?php
 
	echo form_close();
  ?> 
  <!-- FORMA-->                        
                           
                            
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>