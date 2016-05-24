                 <div class="span6">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i> Buscar existencia </h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">

                             <?php 
                               	$atributos = array('id' => 'codigo');
    echo form_open('mercadotecnia/producto_bus_codi', $atributos);
    $cod = array(
              'name'        => 'codigo',
              'id'          => 'codigo',
              'value'       => '',
              'maxlength'   => '14',
              'size'        => '14'
              
            );
    ?>

<tr>
    <td align="left" ><font size="+1"><strong>Buscar codigo: </strong></font></td>
	<td><?php echo form_input($cod, "", 'required');?></td>
    <td colspan="8" align="center"><?php echo form_submit('envio', 'Buscar');?></td>
    </tr>
                         
                               
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>