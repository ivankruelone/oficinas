                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo ?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <?php
	echo form_open('insumos/inventario_insumo_cambiar');
 ?>
 <table>
 <tr>
    <td align="left" ><font size="+1"><strong>Producto: </strong></font></td>
    <td align="center"><?php echo $descripcion;?> </td>
</tr>
 <tr>
    <td align="left" ><font size="+1"><strong>En existencia: </strong></font></td>
    <td align="center"><?php echo $existencia;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Cantidad: </strong></font></td>
    <td><?php echo form_input('existencia',$existencia,'required');?></td>
</tr>
</table>
 <tr>
 <?php
        echo form_hidden('id_insumos', $id_insumos);     
        echo "<br />";
        echo "<br />"; 
        echo form_submit('mysubmit', 'Guardar');
        echo "<br />";
        echo "<br />";
        echo form_close();
 ?>
 </tr>
</table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>