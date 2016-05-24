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

	$atributos = array('id' => 'sumit_cambia_correo');
    echo form_open('catalogos/sumit_cambia_correo', $atributos);
   
    $data_correo = array(
              'name'        => 'correo',
              'id'          => 'correo',
              'value'       => $correo,
              'maxlength'   => '80',
              'size'        => '80'
              
            );
    
  ?>
 
  <table>

    <tr>
    <td align="left" ><font size="+1" color="blue">Departamento: </font></td>
    <td><font size="+1" color="blue"><?php echo $suc.' '.$sucx;?></font></td>
    </tr>
    <tr>
    <td align="left" ><font size="+1" color="blue">Empleado: </font></td>
    <td><font size="+1" color="blue"><?php echo $nomina.' '.$nombre;?></font></td>
    </tr>
   <tr>
    <td align="left" ><font size="+1">Correo: </font></td>
    <td colspan="3"><font size="+1" color="blue"><?php echo form_input($data_correo, "", 'required');?></font></td>
    </tr>
<tr>
	<td colspan="8" align="center"><?php echo form_submit('envio', 'Actualizar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
  <?php
 
	echo form_close();
  ?>


<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
