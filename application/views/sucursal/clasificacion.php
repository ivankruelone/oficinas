               <div class="span5" >
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         
                        <div align="center">
                         <?php
	$atributos = array('id' => 'clasificacion');
    echo form_open('sucursal/generaClasificacion', $atributos);
  ?>
 
  <table>
<tr>
  <th colspan="2"><?php echo $tit;?></th>
</tr>
<tr>
	<td align="left" ><font size="+1"><strong>FARMACIA: </strong></font></td>
	<td align="left"><?php echo form_dropdown('tipo', $tipo, '', 'id="tipo"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mes', $mes, '', 'id="mes"') ;?> </td>
 </tr>
 <tr>

	<td colspan="2" align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>
                        
                        </div>       
                       
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>