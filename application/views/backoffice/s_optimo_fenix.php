                 <div class="span5">
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
	$atributos = array('id' => 's_optimo_fenix_mes');
    echo form_open('backoffice/s_optimo_fenix_mes', $atributos);
$data_not_in = array(
                  'name'        => 'not_in',
                  'id'          => 'not_in',
                  'size'        => '15',
                  'maxlength'   => '100',
                  'value'       => 'not in(127,187)'
)
?>
<table>
<tr>
<td colspan="2">Selecciona Mes actual como optimo principal</td>
</tr>
<tr>
    <td><?php echo form_input($data_not_in, "", 'required')?>Aplica filtro el el calculo de optimo</td>
</tr>
<tr>
<td><?php echo form_dropdown('mes', $mes, null, 'id="mes"');?></td>
</tr>
<tr>
	<td colspan="2"align="center"><?php echo form_submit('envio', 'GENERAR');?></td>
</tr>
</table>
  <?php
 
	echo form_close();
?>
                              </tbody>
                              <tfoot>
                           
                             </tfoot>
                         </table>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>