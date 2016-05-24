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
	$atributos = array('id' => 'sumit_clasifica');
    echo form_open('catalogos/sumit_clasifica', $atributos);
   
  ?>
 
  <table>
    <tr>
    <td align="left" ><font size="+1"><strong>Producto : </strong></font></td>
    <td><?php echo $sec.' '.$susa;?></td>
    </tr>
    <tr>
    <td></td>
    <td><?php echo $tipo.' - '.$obser;?></td>
    </tr>
    <tr>
    <td align="left" ><font size="+1"><strong>Clasificacion:</strong></font></td>
    <td align="left"><?php echo form_dropdown('clas', $clas, '', 'id="clas"') ;?> </td>
    </tr>
<tr>
	<td colspan="8" align="center"><?php echo form_submit('envio', 'Cambiar');?></td>
</tr>
</table>
<input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
  <?php
 
	echo form_close();
  ?>


<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>
