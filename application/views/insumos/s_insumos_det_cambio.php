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
	echo form_open('insumos/s_insumos_det_c');
    $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'value'       => $can,
              'maxlength'   => '7',
              'size'        => '5'
            );
    
    
   
 ?>  
 <table> 
 <tr>
    <td align="left" ><font size="+1"><strong>Art&iacute;culo : </strong></font></td>
    <td align="center"><?php echo $descripcion.' - '.$empaque;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Pedido: </strong></font></td>
    <td align="center"><?php echo  $canp;?> </td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Surtido: </strong></font></td>
    <td><?php echo form_input($data_can, "", 'required');?></td>
    
</tr>

</table>
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
<input type="hidden" value="<?php echo $canp?>" name="canp" id="canp" />
<input type="hidden" value="<?php echo $id?>" name="id" id="id" />
<input type="hidden" value="<?php echo $fol?>" name="fol" id="fol" />
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