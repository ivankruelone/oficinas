                 <div class="span5">
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
	$atributos = array('id' => 'sumit_ins_det_c');
    echo form_open('pedido/sumit_ins_det_c', $atributos);
    $data_can = array(
              'name'        => 'can',
              'id'          => 'can',
              'value'       => $canp_sup,
              'maxlength'   => '7',
              'size'        => '7',
              'type'        =>'numeric'
              
            );
  
  ?>
 
  <table>
<tr>
<td align="left" ><font size="-1">Articulo: </font></td>
<td align="left" ><font size="-1"><?php echo $descripcion?></font></td>
</tr>
<tr>
<td align="left" ><font size="-1">Cant.Calculada: </font></td>
<td align="center" ><font size="-1"><?php echo $canp?></font></td>
</tr>
<tr>
	<td align="left" ><font size="-1">Modificar: </font></td>
    <td><?php echo form_input($data_can, "", 'required');?></td>
 </tr>
 <tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id?>" name="id" id="id" />
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
  <?php
 
	echo form_close();
  ?>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>