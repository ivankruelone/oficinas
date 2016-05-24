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
	$atributos = array('id' => 's_compras_ventas_mes');
    echo form_open('compra/s_compras_ventas_mes', $atributos);
?>
<table>
<tr>
<td colspan="2">Seleccione Mes </td>
</tr>
<tr>
<td><?php echo form_dropdown('mes', $mes, null, 'id="mes"');?></td>
</tr>
<tr>
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