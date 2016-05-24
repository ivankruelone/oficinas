<div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Historial de Pedidos </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                         
  <?php
	$atributos = array('id' => 'agrega');
    echo form_open('catalogos/s_cat_insumos_his_bus', $atributos);
    $data_bus = array(
              'name'        => 'bus1',
              'id'          => 'bus1',
              'value'       => '',
              'maxlength'   => '15',
              'size'        => '15'
            );
  
  ?>
  
  <table>
<tr>
	<td align="left" ><font size="+1">Buscar: </font></td>
    <td><?php echo form_input($data_bus, "", 'required');?></td>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
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