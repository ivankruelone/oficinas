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
	$atributos = array('id' => 'subir_inv_suc');
    echo form_open('procesos/subir_inv_suc', $atributos);
    
  ?>
 
  <table>
<tr>
<tr>    
    <td align="left" ><font size="+1">Sucursal.: </font></td>
   	<td align="center"><?php echo form_dropdown('sucx', $sucx, '', 'id="sucx"') ;?> </td>
 </tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'BORRAR');?></td>
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