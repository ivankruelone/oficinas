                 <div class="span10">
<table>
<tr>
<td>
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget blue">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo1?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <?php
	echo form_open('evaluacion/eval_cedis_compra_dias');
    $data_sec = array(
              'name'        => 'sec',
              'id'          => 'sec',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
            );
    echo "<br />";
    $var1='T';
    
   
 ?>  
 <table> 
 <tr>
    <td align="left" ><font size="+1"><strong>Clasificacion A: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por1', $por1, '', 'id="por1"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion B: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por2', $por2, '', 'id="por2"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion C: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por3', $por3, '', 'id="por3"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion D: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por4', $por4, '', 'id="por4"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion E: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por5', $por5, '', 'id="por4"') ;?> </td>
    <td colspan="6"></td>
</tr>
</table>
<input type="hidden" value="<?php echo $var1?>" name="var" id="var" />

<?php  
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
?>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
</td>
<td></td>
<td>
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget green">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo2?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <?php
	echo form_open('evaluacion/eval_cedis_compra_dias');
    $data_sec = array(
              'name'        => 'sec',
              'id'          => 'sec',
              'value'       => '',
              'maxlength'   => '20',
              'size'        => '20'
            );
    echo "<br />";
    $var2='C';
    
    
 ?>  
 <table> 
 <tr>
    <td align="left" ><font size="+1"><strong>Clasificacion A: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por1', $por1, '', 'id="por1"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion B: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por2', $por2, '', 'id="por2"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion C: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por3', $por3, '', 'id="por3"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion D: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por4', $por4, '', 'id="por4"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion E: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por5', $por5, '', 'id="por4"') ;?> </td>
    <td colspan="6"></td>
</tr>
</table>
<input type="hidden" value="<?php echo $var2?>" name="var" id="var" />
<?php  
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo form_close();
?>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
</td>
</tr>
</table>

<table>
<tr>
<td>
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget black">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo3?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <?php
	echo form_open('evaluacion/eval_cedis_compra_dias');
    $data_sec = array(
              'name'        => 'sec',
              'id'          => 'sec',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '100'
            );
    echo "<br />";
    $var3='P';
   
    
 ?>  
 <table> 
 <tr>
    <td align="left" ><font size="+1"><strong>Clasificacion A: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por1', $por1, '', 'id="por1"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion B: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por2', $por2, '', 'id="por2"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion C: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por3', $por3, '', 'id="por3"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion D: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por4', $por4, '', 'id="por4"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion E: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por5', $por5, '', 'id="por4"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Proveedor: </strong></font></td>
	<td align="center"><?php echo form_dropdown('prv', $prv, '', 'id="prv"') ;?> </td>
    <td colspan="6"></td>
</tr>
</table>
<input type="hidden" value="<?php echo $var3?>" name="var" id="var" />
<?php  
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo "<br />";
    echo "<br />";
    echo form_close();
?>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
</td>
<td></td>
<td>
                     <!-- BEGIN BLANK PAGE PORTLET-->
                     <div class="widget orange">
                         <div class="widget-title">
                             <h4><i class="icon-reorder"></i><?php echo $titulo4?></h4>
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                         </div>
                         <div class="widget-body">
 <?php
	echo form_open('evaluacion/eval_cedis_compra_dias');
    $data_sec = array(
              'name'        => 'sec',
              'id'          => 'sec',
              'value'       => '',
              'maxlength'   => '100',
              'size'        => '100'
            );
    echo "<br />";
    $var4='S';
    
    
 ?>  
 <table> 
 <tr>
    <td align="left" ><font size="+1"><strong>Clasificacion A: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por1', $por1, '', 'id="por1"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion B: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por2', $por2, '', 'id="por2"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion C: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por3', $por3, '', 'id="por3"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion D: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por4', $por4, '', 'id="por4"') ;?> </td>
    <td colspan="6"></td>
</tr>
<tr>
    <td align="left" ><font size="+1"><strong>Clasificacion E: </strong></font></td>
	<td align="center"><?php echo form_dropdown('por5', $por5, '', 'id="por4"') ;?> </td>
    <td colspan="6"></td>
</tr>

<tr>
	<td align="left" ><font size="+1"><strong>Secuencias: </strong></font></td>
	<td><?php echo form_input($data_sec, "", 'required');?></td>
 </tr>
</table>
<input type="hidden" value="<?php echo $var4?>" name="var" id="var" />
<input type="hidden" value="<?php echo $prv?>" name="prv" id="prv" />
<?php  
    echo form_submit('mysubmit', 'Generar!');
    echo "<br />";
    echo form_close();
?>
<!----> 
                          
                         </div>
                     </div>
                     <!-- END BLANK PAGE PORTLET-->
</td>
</tr>
</table>




                 </div>