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
                       
                         
                         <?php
	$atributos = array('id' => 'ventas');
    echo form_open('spt/ventas_submit', $atributos);
  ?>
 
  <table>
 <tr>
	<td align="left" ><font size="+1"><strong>MES: </strong></font></td>
	<td align="left"><?php echo form_dropdown('mes', $mesx, '', 'id="mes"') ;?> </td>
 </tr>
 <tr>

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