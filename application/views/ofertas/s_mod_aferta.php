                 <div class="span12">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
<?php
	$atributos = array('id' => 'sumit_aferta_act');
    echo form_open('ofertas/sumit_aferta_act', $atributos);
  
  $data_ofe_lab = array(
              'name'        => 'ofe_lab',
              'id'          => 'ofe_lab',
              'value'       => $ofe_lab,
              'maxlength'   => '11',
              'size'        => '11',
              'type'        =>'decimal'
            ); 
  $data_ofe_far = array(
              'name'        => 'ofe_far',
              'id'          => 'ofe_far',
              'value'       => $ofe_far,
              'maxlength'   => '11',
              'size'        => '11',
              'type'        =>'decimal'
            ); 
 
$data_fec2 = array(
              'name'        => 'fecha2',
              'id'          => 'fecha2',
              'value'       => $fecha2,
              'maxlength'   => '10',
              'size'        => '10'
            ); 
  ?>
 
  <table  class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
   
<tr>
	<td align="left" ><strong>Producto: </strong></td>
	<td align="left"><?php echo $codigo;?></td>
    <td align="left" ><strong>F.Inicial: </strong></td>
    <td><?php echo $fecha1;?></td>
    <td align="left" ><strong>F.Final: </strong></td>
    <td><?php echo form_input($data_fec2, "", 'required');?></td>
    
 </tr>
 <tr>
    <td align="left" ><strong>Oferta Laboratorio: </strong></td>
    <td><?php echo form_input($data_ofe_lab, "", 'required');?></td>
	<td align="left" ><strong>Oferta Farmacia: </strong></td>
    <td><?php echo form_input($data_ofe_far, "", 'required');?></td>
    <td></td>
    <td></td>
 </tr>   
   
<tr>
	<td colspan="6" align="center"><?php echo form_submit('envio', 'Grabar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id?>" name="id" id="id" />
  <?php
 
	echo form_close();
  ?>
</div>
</div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>