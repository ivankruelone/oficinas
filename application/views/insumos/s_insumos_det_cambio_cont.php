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
	echo form_open('insumos/s_insumos_cambiar_cont');
    $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'value'       => '',
              'maxlength'   => '7',
              'size'        => '5'
            );
 ?>
 <table>
 <tr>
    <td align="left" ><font size="+1"><strong>Nombre de Empleado : </strong></font></td>
    <td align="center"><?php echo $nombre.' - '.$puestox;?> </td>
</tr>
 <tr>
    <td align="left" ><font size="+1"><strong>Art&iacute;culo : </strong></font></td>
    <td align="center"><?php echo form_dropdown('id_insumos_despues', $ide, $codigo, " ", "id='id_insumos_despues'");?> </td>
</tr>
</table>
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
<input type="hidden" value="<?php echo $fol?>" name="fol" id="fol" />
<input type="hidden" value="<?php echo $codigo?>" name="id_insumos_antes" id="id_insumos_antes" />
<input type="hidden" value="<?php echo $id_comprar?>" name="id_comprar" id="id_comprar" />

<?php  
    echo form_submit('mysubmit', 'Guardar!');
    echo "<br />";
    echo form_close();
?>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>