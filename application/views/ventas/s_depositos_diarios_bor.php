                 <div class="span5">
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $tit?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <?php
	echo form_open('ventas/s_depositos_diarios_bor_det');
    echo "<br />";   
	
 ?>  
 <table> 
 <tr>
    <td align="left" ><font size="+1"><strong>Sucusal</strong></font></td>
	<td align="center"><?php echo form_dropdown('suc', $suc, '', 'id="suc"') ;?> </td>
    <td colspan="6"></td>
</tr>
</table>
<?php  
    echo form_submit('mysubmit', 'Ver movimientos capturados!');
    echo "<br />";
    echo "<br />";
    echo form_close();
?>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
                 </div>