                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
<?php
	$atributos = array('id' => 'genera_optimogd');
    echo form_open('procesos/genera_optimogd', $atributos);
    
  ?>
 
  <table>
<tr>
<tr>
    <td align="left" ><font size="+1"><strong>Mes de evaluacion: </strong></font></td>
	<td align="left"><?php echo form_dropdown('uno', $uno, '', 'id="uno"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Mes de evaluacion: </strong></font></td>
	<td align="left"><?php echo form_dropdown('dos', $dos, '', 'id="dos"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Mes de evaluacion: </strong></font></td>
	<td align="left"><?php echo form_dropdown('tres', $tres, '', 'id="tres"') ;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Mes de evaluacion: </strong></font></td>
	<td align="left"><?php echo form_dropdown('cuatro', $cuatro, '', 'id="cuatro"') ;?> </td>
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