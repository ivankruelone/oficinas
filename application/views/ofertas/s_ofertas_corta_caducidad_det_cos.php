                 <div class="span6">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo?></h4>
                         </div>
                         <div class="widget-body">
<?php 
	$atributos = array('id' => 'sumit_ofertas_corta_caducidad');
    echo form_open('ofertas/sumit_ofertas_corta_caducidad', $atributos);
  
   
 
$data_venta = array(
              'name'        => 'venta',
              'id'          => 'venta',
              'value'       => 0,
              'maxlength'   => '10',
              'size'        => '10'
            ); 
  ?>
 
  <table  class="table table-bordered table-condensed table-striped table-hover" id="tabla2">
 <tr>
   <td><?php echo $codigo?></td>
   <td><?php echo $descripcion?></td>
 </tr>
 <tr>
   <td><?php echo 'Costo Catalogo '.$costo_catalogo?></td>
   <td><?php echo 'Costo PDV '.$costo_pdv?></td>
 </tr>
 
 <tr>
	<td align="left" ><strong>Codigo: </strong></td>
    <td><?php echo $codigo?></td>
 </tr> 

 <tr>
    <td align="left" ><strong>Precio Oferta: </strong></td>
    <td><?php echo form_input($data_venta, "", 'required');?></td>
	
 </tr>   
   
<tr>
	<td colspan="6" align="center"><?php echo form_submit('envio', 'Grabar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id?>" name="id" id="id" />
<input type="hidden" value="<?php echo $costo_catalogo?>" name="costo_catalogo" id="costo_catalogo" />
<input type="hidden" value="<?php echo $costo_pdv?>" name="costo_pdv" id="costo_pdv" />
<input type="hidden" value="<?php echo $pub_pdv?>" name="pub_pdv" id="pub_pdv" />
<input type="hidden" value="<?php echo $id_cc?>" name="id_cc" id="id_cc" />
  <?php
 
	echo form_close();
  ?>
</div>
</div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>