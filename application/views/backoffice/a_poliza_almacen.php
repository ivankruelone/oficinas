                 <div class="span3">
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
	$atributos = array('id' => 'a_poliza_almacen_generar');
    echo form_open('backoffice/a_poliza_almacen_generar', $atributos);
    $data_aaa = array(
              'name'        => 'aaa',
              'id'          => 'aaa',
              'value'       => date('Y'),
              'maxlength'   => '4',
              'size'        => '4'
            );
     $data_mes = array(
              'name'        => 'mes',
              'id'          => 'mes',
              'value'       => date('m'),
              'maxlength'   => '2',
              'size'        => '2'
            );
      
   ?>
 
  <table>

 <tr>
	<td align="left" ><font size="+1"><strong>A&ntilde;o: </strong></font></td>
	<td><?php echo form_input($data_aaa, "", 'required');?></td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>Mes: </strong></font></td>
	<td><?php echo form_input($data_mes, "", 'required');?></td>
 </tr>


	<td colspan="2"align="center"><?php echo form_submit('envio', 'Generar');?></td>
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