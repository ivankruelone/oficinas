       
                 <div class="span4" >
                     <!-- BEGIN SAMPLE FORMPORTLET-->
                     <div class="widget red">
                         <div class="widget-title">
                             <h4><?php echo $titulo?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                               <a href="javascript:;" class="icon-remove"></a>
                           </span>
                         </div>
                         <div class="widget-body form">



<?php
	$atributos = array('id' => '#motivo');
    echo form_open('spt/depositos_submit');
  ?>
  
  <table>
<tr>
	<td align="left" ><font size="+1"><strong>Quincena: </strong></font></td>
	<td align="left"><?php echo form_dropdown('quincena', $quincena, '', 'id="quincena"') ;?> </td>
 </tr>

<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Enviar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>
  
  <?php
	$atributos = array('periodo' => '#motivo');
    echo form_open('spt/depositos2_submit');
  ?>
  
  <table>
<tr>
	<td align="left" ><font size="+1"><strong>Quincena: </strong></font></td>
	<td align="left"><?php echo form_dropdown('periodo', $quincena2, '', 'id="periodo"') ;?> </td>
 </tr>
<tr>
	<td colspan="2" align="center"><?php echo form_submit('envio', 'Enviar');?></td>
</tr>
</table>
  <?php
	echo form_close();
  ?>





                       
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
                 

