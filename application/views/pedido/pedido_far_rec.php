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
	$atributos = array('id' => 'busca_rec');
    echo form_open('pedido/busca_rec', $atributos);
    $data_receta = array(
              'name'        => 'rec',
              'id'          => 'rec',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
            );
  ?>
  <table>
<tr>
<td colspan="2">Buscar Por receta</td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Receta....: </strong></font></td>
	<td><?php echo form_input($data_receta, "", 'required');?> <?php echo form_submit('envio', 'GENERAR');?></td>
</tr>
</table>
  <?php
	echo form_close();
 	$atributos1 = array('id' => 'busca_fol');
    echo form_open('pedido/busca_fol', $atributos1);
    $data_folio = array(
              'name'        => 'folio',
              'id'          => 'folio',
              'value'       => '',
              'maxlength'   => '10',
              'size'        => '10'
            );
  ?>
  <table>
<tr>
<td colspan="2">Buscar Por folio</td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Folio.......: </strong></font></td>
	<td><?php echo form_input($data_folio, "", 'required');?> <?php echo form_submit('envio', 'GENERAR');?></td>
</tr>
</table>
  <?php
	echo form_close();
  	$atributos2 = array('id' => 'busca_fol');
    echo form_open('pedido/busca_fol', $atributos2);
  ?>
  <table>
<tr>
<td colspan="2">Buscar Por Sucursal</td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Sucursal: </strong></font></td>
	<td><?php echo form_input($data_folio, "", 'required');?> <?php echo form_submit('envio', 'GENERAR');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>


                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>