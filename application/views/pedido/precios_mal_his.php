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
	$atributos = array('id' => 'precios_mal_imprime');
    echo form_open('pedido/precios_mal_imprime', $atributos);
    $data_fec1 = array(
              'name'        => 'fec1',
              'id'          => 'fec1',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
              
            );
    $data_fec2 = array(
              'name'        => 'fec2',
              'id'          => 'fec2',
              'value'       => date('Y-m-d'),
              'maxlength'   => '10',
              'size'        => '10',
              'type'        =>'date'
              
            );
  
  ?>
 
  <table>
<tr>
<tr>
	<td align="left" ><font size="+1">Fecha Inicial: </font></td>
    <td><?php echo form_input($data_fec1, "", 'required');?></td>
	<td align="left" ><font size="+1">Fecha Final: </font></td>
    <td><?php echo form_input($data_fec2, "", 'required');?></td>
 </tr>
 </tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
  ?>
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>