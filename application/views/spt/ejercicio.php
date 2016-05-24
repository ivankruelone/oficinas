                 <div class="span5" >
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
                       
                         
                         
                        <div align="center">
                         <?php
	$atributos = array('id' => 'ejercicio');
    echo form_open('spt/ejercicio_medicos', $atributos);
  ?>
 
  <table>
<tr>
	<td align="left" ><font size="+1"><strong>A&Ntilde;O: </strong></font></td>
	<td align="left"><?php echo form_dropdown('aaa', $aaax, '', 'id="aaa"') ;?> </td>
 </tr>
 <tr>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mes', $mesx, '', 'id="mes"') ;?> </td>
 </tr>

	<td colspan="2"align="center"><?php echo form_submit('envio', 'ACEPTAR');?></td>
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