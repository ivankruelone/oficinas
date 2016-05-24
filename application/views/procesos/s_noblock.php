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
	$atributos = array('id' => 'genera_noblock');
    echo form_open('procesos/genera_noblock', $atributos);
    
  ?>
 
  <table>
<tr>
<tr>
    <td align="left" ><font size="+1"><strong>Rango de Fecha: </strong></font></td>
	<td align="left"><?php echo form_dropdown('fec1', $fec1, '', 'id="fec1"') ;?> </td>
</tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'GENERAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id?>" name="id" id="id" />
  <?php
 
	echo form_close();
  ?>


<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>