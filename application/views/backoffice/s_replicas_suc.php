                 <div class="span3">
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
	$atributos = array('id' => 'replicas_sucursal');
    echo form_open('backoffice/replicas_sucursal', $atributos);
    
    
  ?>
 
  <table>

<tr>
<td colspan="2" align="center">GENERAR REPLICAS</td>
</tr>
<tr>
<td><?php echo form_dropdown('suc', $suc, null, 'id="suc"');?></td>}
</tr>
<tr>
<td><?php echo form_dropdown('tipo', $tipo, null, 'id="tipo"');?></td>
<tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'GENERAR');?></td>
</tr>
</table>
  
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>