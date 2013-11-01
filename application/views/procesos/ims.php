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
	$atributos = array('id' => 'genera_ims');
    echo form_open('procesos/genera_ims', $atributos);
    $data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
              
            );
    $data_fec2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
              
            );
  ?>
 
  <table>
<tr>
<tr>
    <td align="left" ><font size="+1"><strong>Fecha Inicial: </strong></font></td>
	<td><?php echo form_input($data_fec1, "", 'required');?> AAAA-MM-DD</td>
</tr>
<tr>
	<td align="left" ><font size="+1">Fecha Final: </font></td>
    <td><?php echo form_input($data_fec2, "", 'required');?> AAAA-MM-DD</td>
</tr>
 


	<td colspan="2"align="center"><?php echo form_submit('envio', 'GENERAR');?></td>
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